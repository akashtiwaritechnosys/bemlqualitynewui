<?php
function SendSMSOnRejection($entityData) {
    $data = $entityData->{'data'};
    global $smsEndPoint;
	$name = $data['service_engineer_name'];
	$badgeNo = $data['badge_no'];
	$text = urlencode("Dear Sir / madam,
    Hi, $name, Your account validation has not been successful due to data mismatch. For details, please check your registered mail id.
    BEML CRM Project");
	$reusultOfCUrl = '';
	$mobile = $data['phone'];
	$url = "$smsEndPoint?loginID=beml_htuser&mobile=$mobile&text=$text&senderid=BEMLHQ"
	. "&DLT_TM_ID=1001096933494158&DLT_CT_ID=1007925891162007824"
	. "&DLT_PE_ID=1001209734454178165&route_id=DLT_SERVICE_IMPLICT&Unicode=0&camp_name=beml_htuser&password=beml@123";
	if (!empty($mobile)) {
		$header = array('Content-Type:multipart/form-data');
		$resource = curl_init();
		curl_setopt($resource, CURLOPT_URL, $url);
		curl_setopt($resource, CURLOPT_HTTPHEADER, $header);
		curl_setopt($resource, CURLOPT_POST, 1);
		curl_setopt($resource, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($resource, CURLOPT_POSTFIELDS, array());
		$reusultOfCUrl = trim(curl_exec($resource));
	}
}
