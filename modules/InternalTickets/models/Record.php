<?php

class InternalTickets_Record_Model extends Inventory_Record_Model {

   public function getImageDetails() {
        global $site_URL;
        $db = PearDatabase::getInstance();
        $imageDetails = array();
        $recordId = $this->getId();
        if ($recordId) {
            $sql = "SELECT vtiger_attachments.*, vtiger_crmentity.setype, vtiger_crmentity.deleted FROM vtiger_attachments
                INNER JOIN vtiger_seattachmentsrel ON vtiger_seattachmentsrel.attachmentsid = vtiger_attachments.attachmentsid
                INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_attachments.attachmentsid
                WHERE vtiger_seattachmentsrel.crmid = ? AND vtiger_crmentity.deleted = 0";
            $result = $db->pquery($sql, array($recordId));
            $count = $db->num_rows($result);
            for ($i = 0; $i < $count; $i++) {
                $imageId = $db->query_result($result, $i, 'attachmentsid');
                $imageIdsList[] = $db->query_result($result, $i, 'attachmentsid');
                $imagePathList[] = $db->query_result($result, $i, 'path');
                $storedname[] = $db->query_result($result, $i, 'storedname');
                $imageName = $db->query_result($result, $i, 'name');
                $fieldName[] = $db->query_result($result, $i, 'subject');
                $url = \Vtiger_Functions::getFilePublicURL($imageId, $imageName);
                $imageOriginalNamesList[] = urlencode(decode_html($imageName));
                $imageNamesList[] = $imageName;
                $imageUrlsList[] = $url;
                $descriptionOffield[] = $db->query_result($result, $i, 'description');
            }
            if (is_array($imageOriginalNamesList)) {
                $countOfImages = count($imageOriginalNamesList);
                for ($j = 0; $j < $countOfImages; $j++) {
                    $imageDetails[] = array(
                        'id' => $imageIdsList[$j],
                        'orgname' => $imageOriginalNamesList[$j],
                        'path' => $imagePathList[$j] . $imageIdsList[$j],
                        'location' => $imagePathList[$j] . $imageIdsList[$j] . '_' . $storedname[$j],
                        'name' => $imageNamesList[$j],
                        'url' => $imageUrlsList[$j],
                        'field' => $imageUrlsList[$j],
                        'fieldNameFromDB' => $fieldName[$j],
                        'descriptionOffield' => $descriptionOffield[$j]
                    );
                }
            }
        }
        return $imageDetails;
    }
}
