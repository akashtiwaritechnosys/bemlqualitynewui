<?php
function AccountsExternalAppSync($entityData) {
    $xml = file_get_contents("http://10.80.2.84/phprfcbeml/sapclasses/examples/example_connect2.php");
    $xml = json_decode($xml);
    foreach ($xml as $key => $value) {
        $focus = CRMEntity::getInstance('Accounts');
        $focus->column_fields['accountname'] = $value->{'NAME1'};
        $focus->column_fields['bill_city'] = $value->{'ORT01'};
        $focus->column_fields['email1'] = $value->{'SMTP_ADDR'};
        $focus->column_fields['phone'] = $value->{'TELF1'};
        $focus->save("Accounts");
    }
}
