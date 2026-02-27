<?php
function createUserOnApproval($entityData) {
	$data = $entityData->{'data'};
	require_once('modules/Users/Users.php');
	$focus = new Users();
	global $adb;

	// getting the id of the created record it in the format 12x237
	$recId = $data['id'];
	$idsOfCreated = explode('x', $recId);
	$data['id'] = $idsOfCreated[1];

	$username = preg_replace('/\s+/', '', $data['badge_no']);
	$password = preg_replace('/\s+/', '', $data['user_password']);
	$result = $adb->pquery('SELECT 1 FROM `vtiger_users` where user_name = ?', array($username));
	$rowCount = $adb->num_rows($result);
	if ($rowCount > 0) {
		$viewer = new Vtiger_Viewer();
		$viewer->assign('MESSAGE', "Badge Number is Alredy Exits");
		$viewer->view('OperationNotPermitted.tpl', 'Vtiger');
		die();
	}
	$role = getRoleIdBasedOnRoleName($data['sys_detect_role']);
	if(empty($role)){
		$viewer = new Vtiger_Viewer();
		$viewer->assign('MESSAGE', "Unable To Find The User Role");
		$viewer->view('OperationNotPermitted.tpl', 'Vtiger');
		die();
	}
	$focus->column_fields['user_name'] =   $data['badge_no'];
	$focus->column_fields['first_name'] =  $data['service_engineer_name'];
	$focus->column_fields['last_name'] =  '';
	$focus->column_fields['status'] =  'Active';
	$focus->column_fields['is_admin'] =  'off';
	$focus->column_fields['user_password'] =   $password;
	$focus->column_fields['confirm_password'] =   $password;
	$focus->column_fields['email1'] =   $data['email'];
	// $focus->column_fields['address_street'] = $data['bill_street'];
	$focus->column_fields['phone_mobile'] = $data['phone'];
	$focus->column_fields['roleid'] =  $role; //'H37';
	$focus->column_fields['tz'] =  'Asia/Kolkata';
	$focus->column_fields['time_zone'] =  'Asia/Kolkata';
	$focus->column_fields['date_format'] =  'dd/mm/yyyy';
	$focus->column_fields['title'] =  'Asia';
	$focus->save("Users");
	require_once('modules/Users/CreateUserPrivilegeFile.php');
	createUserPrivilegesfile($focus->id);
}

function getRoleIdBasedOnRoleName($roleName) {
	global $adb;
	$sql = "SELECT * FROM `vtiger_role` where rolename = ?";
	$result = $adb->pquery($sql, array($roleName));
	$dataRow = $adb->fetchByAssoc($result, 0);
	if (empty($dataRow['roleid'])) {
		return 'H2';
	} else {
		return $dataRow['roleid'];
	}
}
