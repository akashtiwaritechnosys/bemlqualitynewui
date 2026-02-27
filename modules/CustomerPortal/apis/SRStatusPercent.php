<?php
/* +**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * ***********************************************************************************/

class CustomerPortal_SRStatusPercent extends CustomerPortal_API_Abstract {

	function process(CustomerPortal_API_Request $request) {
		$response = new CustomerPortal_API_Response();
		$customerId = $this->getActiveCustomer()->id;
		$moduleModel = Vtiger_Module_Model::getInstance('HelpDesk');
		$counts['sr_percentage'] = $moduleModel->getTicketsByStatusPercentageCustomer('' , '', $customerId);
        $moduleModel = Vtiger_Module_Model::getInstance('Equipment');
        $counts['eq_population'] =  $moduleModel->getEquipmentByStatusPercentageCustomer('' , '');
        $counts['eq_status'] = $moduleModel->getEquipmentByStatusCustomers('' , '');
		$response->setResult($counts);
        return $response;
	}

}
