<?php
class Contacts_DetailView_Model extends Accounts_DetailView_Model {
    public function getDetailViewLinks($linkParams) {
        $linkModelList = parent::getDetailViewLinks($linkParams);
        $recordModel = $this->getRecord();
        $recordId = $recordModel->getId();
        $acceptStatus =  $recordModel->get('con_approval_status');
        if (empty($acceptStatus)) {
            $basicActionLink = array(
                'linktype' => 'DETAILVIEWBASIC',
                'linklabel' => 'Approve',
                'linkurl' => "javascript:Contacts_Detail_Js.approveOrReject('index.php?module=" . $this->getModule()->getName() .
                    "&action=ApproveOrReject&record=$recordId&source_module=Contacts','Accepted')",
                'linkicon' => ''
            );
            $linkModelList['DETAILVIEWBASIC'][] = Vtiger_Link_Model::getInstanceFromValues($basicActionLink);

            $basicActionLink = array(
                'linktype' => 'DETAILVIEWBASIC',
                'linklabel' => 'Reject',
                'linkurl' => "javascript:Contacts_Detail_Js.approveOrReject('index.php?module=" . $this->getModule()->getName() .
                    "&action=ApproveOrReject&record=$recordId&source_module=Contacts', 'Rejected')",
                'linkicon' => ''
            );
            $linkModelList['DETAILVIEWBASIC'][] = Vtiger_Link_Model::getInstanceFromValues($basicActionLink);
        }
        return $linkModelList;
    }
}
