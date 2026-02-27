<?php

include_once('include/utils/GeneralUtils.php');

class Mobile_WS_GetLeadsLifeCycle extends Mobile_WS_Controller {
    function process(Mobile_API_Request $request) {
        global $adb;
        $response = new Mobile_API_Response();
        $responseObject = [];
              
        /** New Code Start */
        $dateRange = $request->get('dateRange');
		         
		$fromDate = $request->get('fromDate');         
		$toDate = $request->get('toDate');         
		
		$ticketType = $request->get('ticketType');		
		$equipmentModel = $request->get('equipmentModel');
		$warrantyStatus = $request->get('warrantyStatus');	

		$conditions = [];
		$params = [];
		$typeCategory = '';		

		if (!empty($dateRange)) {
			foreach ($dateRange as $range) {
				$conditions[] = "a.ticket_date >= DATE_SUB(CURDATE(), INTERVAL $range)";
			}
		}

		if (!empty($fromDate) && !empty($toDate)) {
			$conditions[] = "a.ticket_date BETWEEN ? AND ?";
			$params[] = $fromDate;
			$params[] = $toDate;
		}

		if (!empty($ticketType)) {
			$sql = "SELECT 
				COUNT(a.ticketid) AS no_of_tickets,
				SUM(CASE WHEN a.status = 'Open' THEN 1 ELSE 0 END) AS open_tickets,
				SUM(CASE WHEN a.status = 'Closed' THEN 1 ELSE 0 END) AS closed_tickets,
				a.sr_equip_model
				FROM vtiger_troubletickets AS a
				WHERE a.ticket_type = ?";

			$params[] = $ticketType;
			
			if (!empty($conditions)) {
				$sql .= " AND (" . implode(' AND ', $conditions) . ")";
			}

			$sql .= " GROUP BY a.sr_equip_model";	

			/*$sqlResult = $adb->pquery($sql, $params);
			$num_rows = $adb->num_rows($sqlResult);

			$resultData = [];
			if ($num_rows > 0) {
				for ($i = 0; $i < $num_rows; $i++) {
					$row = $adb->fetchByAssoc($sqlResult, $i);
					$resultData[] = $row;
				}
			}*/
			
			$typeCategory="TicketType";

		} elseif(!empty($equipmentModel)){

			$sql = "SELECT 
					count(a.ticketid) as no_of_tickets,
					SUM(CASE WHEN a.status = 'Open' THEN 1 ELSE 0 END) AS open_tickets,
					SUM(CASE WHEN a.status = 'Closed' THEN 1 ELSE 0 END) AS closed_tickets,
					a.sr_equip_model
					FROM vtiger_troubletickets AS a
					WHERE a.sr_equip_model = ?";				

			$params[] = $equipmentModel;	
			
			if (!empty($conditions)) {
				$sql .= " AND (" . implode(' AND ', $conditions) . ")";
			}
			
			$sql .= " GROUP BY a.sr_equip_model";	

			/*$sqlResult2 = $adb->pquery($sql, $params);
			$num_rows = $adb->num_rows($sqlResult2);

			$resultData = [];
			if ($num_rows > 0) {
				for ($i = 0; $i < $num_rows; $i++) {
					$row = $adb->fetchByAssoc($sqlResult2, $i);
					$resultData[] = $row;
				}
			}*/
			$typeCategory="EquipmentModel";

		} elseif(!empty($warrantyStatus)){

			$sql = "SELECT 
					count(a.ticketid) as no_of_tickets,
					SUM(CASE WHEN a.status = 'Open' THEN 1 ELSE 0 END) AS open_tickets,
					SUM(CASE WHEN a.status = 'Closed' THEN 1 ELSE 0 END) AS closed_tickets,
					b.sr_war_status
					FROM vtiger_troubletickets AS a 
					JOIN vtiger_servicereports as b ON a.ticketid=b.ticket_id
					WHERE b.sr_war_status = ?";
			
			$params[] = $warrantyStatus;	
			
			if (!empty($conditions)) {
				$sql .= " AND (" . implode(' AND ', $conditions) . ")";
			}
			
			$sql .= " GROUP BY b.sr_war_status";

			$typeCategory = "WarrantyStatus";
		}


			$sqlResult2 = $adb->pquery($sql, $params);
			$num_rows = $adb->num_rows($sqlResult2);

			$resultData = [];
			if ($num_rows > 0) {
				for ($i = 0; $i < $num_rows; $i++) {
					$row = $adb->fetchByAssoc($sqlResult2, $i);
					$resultData[] = $row;
				}
			}
		//$viewer->assign('typeCategory',$typeCategory);
		//$viewer->assign('resultData', $resultData);
        $responseObject['typeCategory']=$typeCategory;    
        $responseObject['resultData']=$resultData;
        $response->setResult($responseObject);
		
		return $response;
        /** New Code End */
    }

       

    
    
}