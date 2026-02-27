<?php
class Mobile_WS_Login extends Mobile_WS_Controller {

	function requireLogin() {
		return false;
	}

	function process(Mobile_API_Request $request) {
		$response = new Mobile_API_Response();
		$username = $request->get('username');
		$password = $request->get('password');
		if (empty($username)) {
			$response->setError(1501, 'Username Is Missing');
			return $response;
		}
		if (empty($password)) {
			$response->setError(1501, 'Password Is Missing');
			return $response;
		}
		$current_user = CRMEntity::getInstance('Users');
		$current_user->column_fields['user_name'] = $username;
		if (vtlib_isModuleActive('Mobile') === false) {
			$response->setError(1501, 'Service not available');
			return $response;
		}

		$loginPlat = $this->getAccessiblePlatforms($username);
		$webPlatStatus = strpos($loginPlat, 'Mobile App') === FALSE ? FALSE : TRUE;
		if ($webPlatStatus != true && $username != 'admin') {
			$response->setError(1501, 'You Are Not Allowed To Login From Mobile App');
			return $response;
		}

		if (!$current_user->doLogin($password)) {
			$response->setError(1210, 'Authentication Failed');
		} else {
			$sessionid = Mobile_API_Session::init();
			if ($sessionid === false) {
				echo "Session init failed $sessionid\n";
			}
			$current_user->id = $current_user->retrieve_user_id($username);
			$current_user->retrieveCurrentUserInfoFromFile($current_user->id);
			$this->setActiveUser($current_user);
			$data = $this->getUserDetailsBasedOnEmployeeModule($current_user->user_name);
			if ($data == false) {
				$response->setError(1501, 'Not Able To Find User Details');
				return $response;
			}
			$date = new DateTime();
			$result = array(
				'usercreatedid' => $data['serviceengineerid'],
				'usertype' => "BEMLUSER",
				'usermobilenumber' => $data['phone'],
				'useruniqeid' => 'Unique Id From Server//to do',
				'timestamp' => $date->getTimestamp(),
				'message' => 'Thank You Have Been Login Succesfully',
				'session' => $sessionid,
			);
			$response->setApiSucessMessage('Successfully Logged In');
			$response->setResult($result);
			$this->postProcess($response);
		}
		return $response;
	}

	function getAccessiblePlatforms($userName) {
		global $adb;
		$sql = 'select ser_usr_log_plat from vtiger_serviceengineer where badge_no = ? ';
		$result = $adb->pquery($sql, array($userName));
		$loginPlatforms = '';
		while ($row = $adb->fetch_array($result)) {
			$loginPlatforms =  $row['ser_usr_log_plat'];
		}
		return $loginPlatforms;
	}

	function getUserDetailsBasedOnEmployeeModule($badgeNo) {
		global $adb;
		$sql = 'select serviceengineerid,phone from vtiger_serviceengineer '
			. ' inner join vtiger_crmentity on vtiger_crmentity.crmid = vtiger_serviceengineer.serviceengineerid '
			. ' where vtiger_serviceengineer.badge_no = ? and vtiger_crmentity.deleted = 0';
		$sqlResult = $adb->pquery($sql, array($badgeNo));
		$num_rows = $adb->num_rows($sqlResult);
		if ($num_rows == 1) {
			$dataRow = $adb->fetchByAssoc($sqlResult, 0);
			return $dataRow;
		} else {
			return false;
		}
	}

	function postProcess(Mobile_API_Response $response) {
		return $response;
	}
}
