<?php
class Mobile_WS_GetPickListValuesOfField extends Mobile_WS_Controller {
    function process(Mobile_API_Request $request) {
        $response = new Mobile_API_Response();
        $field = $request->get('field');
        if (empty($field)) {
            $response->setError(100, 'Field Name Is Missing');
            return $response;
        }
        $picklistvaluesmap = getAllPickListValues($field);
        $pickList = [];
        foreach ($picklistvaluesmap as $targetValue) {
            array_push($pickList, array($field => decode_html($targetValue)));
        }
        $fieldListPicklist[$field] = $pickList;
        $response->setApiSucessMessage('Successfully Fetched Data');
        $response->setResult($fieldListPicklist);
        return $response;
    }
}
