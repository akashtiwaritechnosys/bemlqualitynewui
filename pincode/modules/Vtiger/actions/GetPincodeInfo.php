<?php

class Vtiger_GetPincodeInfo_Action extends Vtiger_IndexAjax_View {
    public function requiresPermission(\Vtiger_Request $request) {
		return [];
	}
    public function process(Vtiger_Request $request) {
        $pincode = $request->get('pincode');
        $url = 'https://api.postalpincode.in/pincode/' . $pincode;
        $res = file_get_contents($url);
        $res = json_decode($res, true);
        $address = $res[0]['PostOffice'][0];
        $response = new Vtiger_Response();
        $response->setResult(array('success' => true, 'data' => $address ));
        $response->emit();
    }

}
