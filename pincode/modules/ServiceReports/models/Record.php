<?php

class ServiceReports_Record_Model extends Inventory_Record_Model {

    public static $OPEN = '';
    public static $PARTIALLY_REDEEMED = 'Partially';
    public static $FULLY_REDEEMED = 'Fully';
    public static $VOID = 'Void';
    public static $CREDIT_TYPE = 'credited';
    public static $REFUNDED_TYPE = 'refunded';

    public function getStatus() {
        return '';
    }

    public function isOpen() {
        $status = $this->getStatus();
        return $status == self::$OPEN;
    }

    public function isUsed() {
        $used = false;
        $status = $this->getStatus();
        if (in_array($status, array(self::$PARTIALLY_REDEEMED, self::$FULLY_REDEEMED))) {
            $used = true;
        }
        return $used;
    }
    public function getImageDetails() {
        global $site_URL;
        $db = PearDatabase::getInstance();
        $imageDetails = array();
        $recordId = $this->getId();
        if ($recordId) {
            $sql = "SELECT vtiger_attachments.*, vtiger_crmentity.setype FROM vtiger_attachments
                INNER JOIN vtiger_seattachmentsrel ON vtiger_seattachmentsrel.attachmentsid = vtiger_attachments.attachmentsid
                INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_attachments.attachmentsid
                WHERE vtiger_crmentity.setype In ('ServiceReports Attachment' , 'ServiceReports Image')  AND vtiger_seattachmentsrel.crmid = ?";
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


    public function isEditable() {
        $status = $this->getStatus();
        if (in_array($status, array(self::$PARTIALLY_REDEEMED, self::$FULLY_REDEEMED))) {
            return false;
        }
        return parent::isEditable();
    }

    public function isDeletable() {
        $status = $this->getStatus();
        if ($status !== self::$OPEN) {
            return false;
        }
        return parent::isDeletable();
    }

    public function getParentRecord() {
        $related_to = false;
        $rel_acc = $this->get('account_id');
        $rel_cont = $this->get('contact_id');
        if ($rel_acc && isRecordExists($rel_acc)) {
            $related_to = $rel_acc;
        } else if ($rel_cont && isRecordExists($rel_cont)) {
            $related_to = $rel_cont;
        }
        return $related_to ? Vtiger_Record_Model::getInstanceById($related_to) : $related_to;
    }

}
