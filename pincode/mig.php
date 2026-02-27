<?php
require_once("modules/com_vtiger_workflow/include.inc");
require_once("modules/com_vtiger_workflow/tasks/VTEntityMethodTask.inc");
require_once("modules/com_vtiger_workflow/VTEntityMethodManager.inc");
require_once("include/database/PearDatabase.php");
$adb = PearDatabase::getInstance();
$emm = new VTEntityMethodManager($adb);
require_once 'vtlib/Vtiger/Module.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Contacts');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('chargeable_outside_war', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'chargeable_outside_war';
        $field->column = 'chargeable_outside_war';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Chargeable For Outside Warranty';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 2;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- chargeable_outside_war In Contacts Module --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_BLOCK_GENERAL_INFORMATION in Contacts -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Contacts');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('business_sector', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'business_sector';
        $fieldInstance->label = 'Business Sector';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'business_sector';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Coal', 'Cement', 'Iron'));
    } else {
        echo "field is already Present --- business_sector in Contacts Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Contacts');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('customer_type', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'customer_type';
        $fieldInstance->label = 'Customer Type';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'customer_type';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('PSU', 'State Govt.', 'Central Govt.', 'Private'));
    } else {
        echo "field is already Present --- customer_type in Contacts Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Contacts');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('nearest_office', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'nearest_office';
        $fieldInstance->label = 'Nearest Office';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'nearest_office';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Bilaspur', 'Neyveli', 'Dhanbad', 'Hyderabad'));
    } else {
        echo "field is already Present --- nearest_office in Contacts Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Contacts');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('office_type', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'office_type';
        $fieldInstance->label = 'Office Type';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'office_type';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Headquarter/Corporate Office', 'Area office', 'Project Office', 'Plant office','Site Office', 'Workshop'));
    } else {
        echo "field is already Present --- office_type in Contacts Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Contacts');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('user_password', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'user_password';
        $fieldInstance->label = 'Set Password';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'user_password';
        $fieldInstance->uitype = '99';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'P~M';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- user_password in Contacts Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Contacts');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('confirm_password', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'confirm_password';
        $fieldInstance->label = 'Re-Type Password';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'confirm_password';
        $fieldInstance->uitype = '99';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'P~M';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- confirm_password in Contacts Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Contacts');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('manual_company', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'manual_company';
        $fieldInstance->label = 'Company Name';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'manual_company';
        $fieldInstance->uitype = '2';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(200)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
//        $fieldInstance->setPicklistValues(array('PUTTUR'));
    } else {
        echo "field is already Present --- manual_company in Contacts Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION  in Contacts -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$emm = null;
$emm = new VTEntityMethodManager($adb);
$result = $adb->pquery("SELECT function_name FROM com_vtiger_workflowtasks_entitymethod WHERE module_name=? AND method_name=?", array('Accounts', 'AccountsExternalAppSync'));
if ($adb->num_rows($result) == 0) {
    $emm->addEntityMethod("Accounts", "AccountsExternalAppSync", "modules/Accounts/AccountsExternalAppSync.php", "AccountsExternalAppSync");
} else {
    print_r("already exits --- workflow function -- AccountsExternalAppSync in Accounts Module <br> ");
}
$emm = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('ticket_type', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'ticket_type';
        $fieldInstance->label = 'Type';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'ticket_type';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Periodic Maintenance', 'Breakdown', 'General Inspection', 'Sub Assembly Fitment','Service for Spares','Initial Commissioning'));
    } else {
        echo "field is already Present --- ticket_type in HelpDesk Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('system_affected', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'system_affected';
        $fieldInstance->label = 'System Affected';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'system_affected';
        $fieldInstance->uitype = 33;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'TEXT';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Engine'));
    } else {
        echo "field is already Present --- system_affected in HelpDesk Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('equip_status', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'equip_status';
        $fieldInstance->label = 'Equipment Status';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'equip_status';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('On Road', 'Off Road', 'Running With Problem'));
    } else {
        echo "field is already Present --- equip_status in HelpDesk Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('equipment_id', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'equipment_id';
        $field->column = 'equipment_id';
        $field->uitype = 10;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Equipment Serial No.';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(10)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $id = $blockInstance->addFieldIgnite($field);
        echo "igggggggggggggggggggg mission created field --- $id ";
        // ------------------ invoga
       
        $invogamoduleInstance = Vtiger_Module::getInstance('Equipment');
        $relationLabel  = 'HelpDesk';
        $invogamoduleInstance->setRelatedList(
              $invoiceModule, $relationLabel, Array('ADD'), 'get_dependents_list' //you can do select also Array('ADD','SELECT')
        );
        // ------------------------invoga
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'HelpDesk', 'Equipment', NULL, NULL)";
        $adb->pquery($tom);
    } else {
        echo "field is present -- equipment_id  in HelpDesk--- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_CUSTOM_INFORMATION in HelpDesk -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('hmr', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'hmr';
        $fieldInstance->column = 'hmr';
        $fieldInstance->uitype = 7;
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->label = 'Hour Meter Reading';
        $fieldInstance->summaryfield = 1;
        $fieldInstance->readonly = 1;
        $fieldInstance->presence = 2;
        $fieldInstance->typeofdata = 'I~O';
        $fieldInstance->columntype = 'INT(15)';
        $fieldInstance->quickcreate = 3;
        $fieldInstance->displaytype = 1;
        $fieldInstance->masseditable = 1;
        $fieldInstance->defaultvalue = 0;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- hmr in HelpDesk Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION in HelpDesk -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('kilometer_reading', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'kilometer_reading';
        $fieldInstance->column = 'kilometer_reading';
        $fieldInstance->uitype = 7;
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->label = 'Kilometer Reading (Km)';
        $fieldInstance->summaryfield = 1;
        $fieldInstance->readonly = 1;
        $fieldInstance->presence = 2;
        $fieldInstance->typeofdata = 'I~O';
        $fieldInstance->columntype = 'INT(15)';
        $fieldInstance->quickcreate = 3;
        $fieldInstance->displaytype = 1;
        $fieldInstance->masseditable = 1;
        $fieldInstance->defaultvalue = 0;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- kilometer_reading in HelpDesk Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION in HelpDesk -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('date_of_failure', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'date_of_failure';
        $fieldInstance->label = 'Date Of Failure';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'date_of_failure';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- date_of_failure in HelpDesk Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Contacts');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('other_customer_type', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'other_customer_type';
        $fieldInstance->label = 'Other Customer Type';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'other_customer_type';
        $fieldInstance->uitype = '2';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(200)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- other_customer_type in Contacts Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION  in Contacts -- <br>";
}
$moduleInstance = null;
$blockInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Contacts');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('other_business_sector', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'other_business_sector';
        $fieldInstance->label = 'Other Business Sector';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'other_business_sector';
        $fieldInstance->uitype = '2';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(200)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- other_business_sector in Contacts Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION  in Contacts -- <br>";
}
$moduleInstance = null;
$blockInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Contacts');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('other_office_type', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'other_office_type';
        $fieldInstance->label = 'Other Office Type';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'other_office_type';
        $fieldInstance->uitype = '2';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(200)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- other_office_type in Contacts Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION  in Contacts -- <br>";
}
$moduleInstance = null;
$blockInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('business_vertical', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'business_vertical';
        $fieldInstance->label = 'Business Vertical';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'business_vertical';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Defence', 'Mining & Construction', 'Both Defence and Mining & Construction'));
    } else {
        echo "field is already Present --- business_vertical in ServiceEngineer Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_USERLOGIN_ROLE -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('date_of_birth', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'date_of_birth';
        $fieldInstance->label = 'Date Of Birth';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'date_of_birth';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- date_of_birth in HelpDesk Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_USERLOGIN_ROLE -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('date_of_joining', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'date_of_joining';
        $fieldInstance->label = 'Date Of Joining';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'date_of_joining';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- date_of_joining in HelpDesk Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_USERLOGIN_ROLE -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('office', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'office';
        $fieldInstance->label = 'Office';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'office';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Corporate Office-BEML Soudha', 'Marketing Headquarter-Unity Buildings', 'Regional Office','District Office','Activity Centre','Service Centre','Production Division','International Business Division-New Delhi'));
    } else {
        echo "field is already Present --- office in ServiceEngineer Module --- <br>";
    }
} else {
    echo "Block does not exits --- LBL_USERLOGIN_ROLE -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('regional_office', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'regional_office';
        $fieldInstance->label = 'Regional Office';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'regional_office';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Neyveli', 'Sambalpur', 'Kolkata','Dhanbad','Bangalore','Hyderabad','New Delhi','Nagpur'));
    } else {
        echo "field is already Present --- regional_office in ServiceEngineer Module --- <br>";
    }
} else {
    echo "Block does not exits --- LBL_USERLOGIN_ROLE -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sub_service_manager_role', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'sub_service_manager_role';
        $fieldInstance->label = 'Sub Servie Manager Role';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'sub_service_manager_role';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Regional Manager', 'Regional Service Manager', 'Service Centre In-charge','District Manager','District Service Manager','International Business Division-Support','Service Manager- Support','Sales Manager','Parts Manager'));
    } else {
        echo "field is already Present --- sub_service_manager_role in ServiceEngineer Module --- <br>";
    }
} else {
    echo "Block does not exits --- LBL_USERLOGIN_ROLE -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('cust_role', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'cust_role';
        $fieldInstance->label = 'Role';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'cust_role';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('BEML Management', 'BEML Marketing HQ', 'Divisonal Service Support','Service Manager','Service Engineer'));
    } else {
        echo "field is already Present --- cust_role in ServiceEngineer Module --- <br>";
    }
} else {
    echo "Block does not exits --- LBL_USERLOGIN_ROLE -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('designaion', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'designaion';
        $fieldInstance->label = 'Designation';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'designaion';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Chairman & Managing Director', 'Director(Mining & Construction Business)', 'Director(Defence Business)','Director','Executive Director','Executive Director','General Manager','Deputy General Manager','Assistant General Manager','Senior Manager','Manager','Assistant Manager','Engineer','Assistant Engineer','Senior Supervisor-S-6','Senior Supervisor-S-5','Senior Supervisor-S-4','Supervisor- S-3','Joint Supervisior-S-2','Deputy Supervisor-S-1','Master Skilled Technician-Gr.-E','High Skilled Technician-Gr.-D','Senior Technician-Gr.-C','Technician-Gr.-B','Helper- Gr-A'));
    } else {
        echo "field is already Present --- cust_role in ServiceEngineer Module --- <br>";
    }
} else {
    echo "Block does not exits --- LBL_USERLOGIN_ROLE -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('user_password', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'user_password';
        $fieldInstance->label = 'Set Password';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'user_password';
        $fieldInstance->uitype = '99';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'P~M';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- user_password in ServiceEngineer Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_USERLOGIN_ROLE -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('confirm_password', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'confirm_password';
        $fieldInstance->label = 'Re-Type Password';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'confirm_password';
        $fieldInstance->uitype = '99';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'P~M';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- confirm_password in ServiceEngineer Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_USERLOGIN_ROLE -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('badge_no', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'badge_no';
        $field->column = 'badge_no';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Badge Number';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(10)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- badge_no ServiceEngineer --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_USERLOGIN_ROLE in ServiceEngineer -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('email', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'email';
        $field->column = 'email';
        $field->uitype = 13;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Email Id';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'E~O';
        $field->columntype = 'VARCHAR(50)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- email ServiceEngineer --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_USERLOGIN_ROLE in ServiceEngineer -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('phone', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'phone';
        $field->column = 'phone';
        $field->uitype = 11;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Mobile Number';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(30)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- phone ServiceEngineer --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_USERLOGIN_ROLE in ServiceEngineer -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('district_office', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'district_office';
        $fieldInstance->label = 'District Office';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'district_office';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Neyveli', 'Sambalpur', 'Kolkata','Dhanbad','Bangalore','Hyderabad','New Delhi','Nagpur'));
    } else {
        echo "field is already Present --- district_office in ServiceEngineer Module --- <br>";
    }
} else {
    echo "Block does not exits --- LBL_USERLOGIN_ROLE -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('activity_centre', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'activity_centre';
        $fieldInstance->label = 'Activity Centre';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'activity_centre';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Neyveli', 'Sambalpur', 'Kolkata','Dhanbad','Bangalore','Hyderabad','New Delhi','Nagpur'));
    } else {
        echo "field is already Present --- activity_centre in ServiceEngineer Module --- <br>";
    }
} else {
    echo "Block does not exits --- LBL_USERLOGIN_ROLE -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('service_centre', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'service_centre';
        $fieldInstance->label = 'Service Centre';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'service_centre';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Neyveli', 'Sambalpur', 'Kolkata','Dhanbad','Bangalore','Hyderabad','New Delhi','Nagpur'));
    } else {
        echo "field is already Present --- service_centre in ServiceEngineer Module --- <br>";
    }
} else {
    echo "Block does not exits --- LBL_USERLOGIN_ROLE -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('production_division', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'production_division';
        $fieldInstance->label = 'Production Division';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'production_division';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Neyveli', 'Sambalpur', 'Kolkata','Dhanbad','Bangalore','Hyderabad','New Delhi','Nagpur'));
    } else {
        echo "field is already Present --- production_division in ServiceEngineer Module --- <br>";
    }
} else {
    echo "Block does not exits --- LBL_USERLOGIN_ROLE -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Contacts');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('distance_from_project', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'distance_from_project';
        $fieldInstance->column = 'distance_from_project';
        $fieldInstance->uitype = 7;
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->label = 'Distance From Project';
        $fieldInstance->summaryfield = 1;
        $fieldInstance->readonly = 1;
        $fieldInstance->presence = 2;
        $fieldInstance->typeofdata = 'I~O';
        $fieldInstance->columntype = 'INT(15)';
        $fieldInstance->quickcreate = 3;
        $fieldInstance->displaytype = 1;
        $fieldInstance->masseditable = 1;
        $fieldInstance->defaultvalue = 0;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- distance_from_project in Contacts Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION in Contacts -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

// ignite special addres ends here
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('auto_asgn_ticket', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'auto_asgn_ticket';
        $field->column = 'auto_asgn_ticket';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Assign SR Automaticaly';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- auto_asgn_ticket In ServiceEngineer Module --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_USERLOGIN_ROLE in Sales Order -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('yoe', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'yoe';
        $fieldInstance->column = 'yoe';
        $fieldInstance->uitype = 7;
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->label = 'Years Of Expirience';
        $fieldInstance->summaryfield = 1;
        $fieldInstance->readonly = 1;
        $fieldInstance->presence = 2;
        $fieldInstance->typeofdata = 'NN~O';
        $fieldInstance->columntype = 'DECIMAL(3,2)';
        $fieldInstance->quickcreate = 3;
        $fieldInstance->displaytype = 1;
        $fieldInstance->masseditable = 1;
        $fieldInstance->defaultvalue = 0;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- yoe in ServiceEngineer Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_USERLOGIN_ROLE -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$emm = new VTEntityMethodManager($adb);
$result = $adb->pquery("SELECT function_name FROM com_vtiger_workflowtasks_entitymethod WHERE module_name=? AND method_name=?", array('ServiceEngineer', 'calculateYOE'));
if ($adb->num_rows($result) == 0) {
    $emm->addEntityMethod("ServiceEngineer", "calculateYOE", "modules/ServiceEngineer/calculateYOE.php", "calculateYOE");
} else {
    print_r("already exits --- workflow function -- calculateYOE <br> ");
}
$emm = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('approval_status', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'approval_status';
        $fieldInstance->label = 'Approval Status';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'approval_status';
        $fieldInstance->uitype = '15';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Pending', 'Accepted', 'Rejected'));
    } else {
        echo "field is already Present --- approval_status in ServiceEngineer Module --- <br>";
    }
} else {
    echo "Block does not exits --- LBL_USERLOGIN_ROLE -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$emm = new VTEntityMethodManager($adb);
$result = $adb->pquery("SELECT function_name FROM com_vtiger_workflowtasks_entitymethod WHERE module_name=? AND method_name=?", array('ServiceEngineer', 'createUserOnApproval'));
if ($adb->num_rows($result) == 0) {
    $emm->addEntityMethod("ServiceEngineer", "createUserOnApproval", "modules/ServiceEngineer/createUserOnApproval.php", "createUserOnApproval");
} else {
    print_r("already exits --- workflow function -- createUserOnApproval <br> ");
}
$emm = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sys_detect_role', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'sys_detect_role';
        $field->column = 'sys_detect_role';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'System Detected Role';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- sys_detect_role ServiceEngineer --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_USERLOGIN_ROLE in ServiceEngineer -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('purpose', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'purpose';
        $fieldInstance->label = 'Purpose';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'purpose';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Rehabilitation', 'Overhaul', 'Up gradation','Parts Requirement','Equipment Health Check up'));
    } else {
        echo "field is already Present --- purpose in HelpDesk Module --- <br>";
    }
} else {
    echo "Block does not exits --- LBL_CUSTOM_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;


$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('manual_equ_ser', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'manual_equ_ser';
        $field->column = 'manual_equ_ser';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Manual Equipment Sl.No.';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- manual_equ_ser in HelpDesk --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_CUSTOM_INFORMATION in HelpDesk -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('opp_name', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'opp_name';
        $field->column = 'opp_name';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Name';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- opp_name in HelpDesk --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_CUSTOM_INFORMATION in HelpDesk -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('phone', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'phone';
        $field->column = 'phone';
        $field->uitype = 11;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Mobile Number';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(30)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- phone HelpDesk --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_CUSTOM_INFORMATION in HelpDesk -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('yoe_inequi_aggre', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'yoe_inequi_aggre';
        $fieldInstance->column = 'yoe_inequi_aggre';
        $fieldInstance->uitype = 7;
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->label = 'Experience in Equipment Model & Aggregates';
        $fieldInstance->summaryfield = 1;
        $fieldInstance->readonly = 1;
        $fieldInstance->presence = 2;
        $fieldInstance->typeofdata = 'NN~O';
        $fieldInstance->columntype = 'DECIMAL(3,2)';
        $fieldInstance->quickcreate = 3;
        $fieldInstance->displaytype = 1;
        $fieldInstance->masseditable = 1;
        $fieldInstance->defaultvalue = 0;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- yoe_inequi_aggre in ServiceEngineer Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_USERLOGIN_ROLE -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Contacts');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('con_approval_status', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'con_approval_status';
        $fieldInstance->label = 'Approval Status';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'con_approval_status';
        $fieldInstance->uitype = '15';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Pending', 'Accepted', 'Rejected'));
    } else {
        echo "field is already Present --- con_approval_status in Contacts Module --- <br>";
    }
} else {
    echo "Block does not exits --- LBL_CUSTOM_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$emm = new VTEntityMethodManager($adb);
$result = $adb->pquery("SELECT function_name FROM com_vtiger_workflowtasks_entitymethod WHERE module_name=? AND method_name=?", array('Contacts', 'handleCustomerPortalUser'));
if ($adb->num_rows($result) == 0) {
    $emm->addEntityMethod("Contacts", "handleCustomerPortalUser", "modules/Contacts/handleCustomerPortalUser.php", "handleCustomerPortalUser");
} else {
    print_r("already exits --- workflow function -- handleCustomerPortalUser In Contacts <br> ");
}
$emm = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Equipment');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('equip_model', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'equip_model';
        $field->column = 'equip_model';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Equipment Model';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- equip_model in Equipment --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_BLOCK_GENERAL_INFORMATION in Equipment -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('imagename', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'imagename';
        $field->column = 'imagename';
        $field->uitype = 69;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Upload Image';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(150)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- imagename in HelpDesk --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_CUSTOM_INFORMATION in HelpDesk -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Accounts');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('external_app_num', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'external_app_num';
        $field->column = 'external_app_num';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'SAP Reference Number';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- external_app_num in Accounts --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_CUSTOM_INFORMATION in Accounts -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Equipment');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('functional_loc', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'functional_loc';
        $field->column = 'functional_loc';
        $field->uitype = 10;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Functional Location';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(10)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $id = $blockInstance->addFieldIgnite($field);
        echo "igggggggggggggggggggg mission created field --- $id ";
        // ------------------ invoga
        $invogamoduleInstance = Vtiger_Module::getInstance('FunctionalLocations');
        $relationLabel  = 'Equipments';
        $invogamoduleInstance->setRelatedList(
              $invoiceModule, $relationLabel, Array('ADD'), 'get_dependents_list' //you can do select also Array('ADD','SELECT')
        );
        // ------------------------invoga
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'Equipment', 'FunctionalLocations', NULL, NULL)";
        $adb->pquery($tom);
    } else {
        echo "field is present -- functional_loc  in Equipment--- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_BLOCK_GENERAL_INFORMATION in Equipment -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('FunctionalLocations');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('ftl_loc_desc', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'ftl_loc_desc';
        $field->column = 'ftl_loc_desc';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Description';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- ftl_loc_desc FunctionalLocations --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_BLOCK_GENERAL_INFORMATION in FunctionalLocations -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Equipment');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('equi_desc', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'equi_desc';
        $field->column = 'equi_desc';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Description';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- equi_desc Equipment --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_BLOCK_GENERAL_INFORMATION in Equipment -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Equipment');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('eq_equip_status', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'eq_equip_status';
        $fieldInstance->label = 'Equipment Status';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'eq_equip_status';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('AVLB'));
    } else {
        echo "field is already Present --- eq_equip_status in Equipment Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_BLOCK_GENERAL_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Equipment');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('maintain_plant', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'maintain_plant';
        $field->column = 'maintain_plant';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Maint Plant';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(100)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- maintain_plant Equipment --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_BLOCK_GENERAL_INFORMATION in Equipment -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Equipment');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('eq_valid_from', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'eq_valid_from';
        $fieldInstance->label = 'Valid From';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'eq_valid_from';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- eq_valid_from in Equipment Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_BLOCK_GENERAL_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Equipment');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('eq_valid_to', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'eq_valid_to';
        $fieldInstance->label = 'Valid To';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'eq_valid_to';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- eq_valid_to in Equipment Module --- <br>";
    }
} else {
    echo "block does not exits --- LBL_BLOCK_GENERAL_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Equipment');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('account_id', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'account_id';
        $field->column = 'account_id';
        $field->uitype = 10;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Customer Number';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(10)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $id = $blockInstance->addFieldIgnite($field);
        echo "igggggggggggggggggggg mission created field --- $id ";
        // ------------------ invoga
        $invogamoduleInstance = Vtiger_Module::getInstance('Accounts');
        $relationLabel  = 'Equipments';
        $invogamoduleInstance->setRelatedList(
              $invoiceModule, $relationLabel, Array('ADD'), 'get_dependents_list' //you can do select also Array('ADD','SELECT')
        );
        // ------------------------invoga
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'Equipment', 'Accounts', NULL, NULL)";
        $adb->pquery($tom);
    } else {
        echo "field is present -- account_id  in Equipment--- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_BLOCK_GENERAL_INFORMATION in Equipment -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('date_of_delivery', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'date_of_delivery';
        $fieldInstance->label = 'Date Of Delivery';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'date_of_delivery';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- date_of_delivery in HelpDesk Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('pre_address', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'pre_address';
        $field->column = 'pre_address';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Address';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- pre_address HelpDesk --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_CUSTOM_INFORMATION in HelpDesk -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('pincode', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'pincode';
        $field->column = 'pincode';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Pincode';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(20)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- pincode HelpDesk --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_CUSTOM_INFORMATION in HelpDesk -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('city', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'city';
        $field->column = 'city';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'City';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(100)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- city HelpDesk --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_CUSTOM_INFORMATION in HelpDesk -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('state', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'state';
        $field->column = 'state';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'State';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(100)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- state HelpDesk --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_CUSTOM_INFORMATION in HelpDesk -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('nearest_railway', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'nearest_railway';
        $field->column = 'nearest_railway';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Nearest Railyway Station';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- nearest_railway HelpDesk --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_CUSTOM_INFORMATION in HelpDesk -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('func_loc_id', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'func_loc_id';
        $field->column = 'func_loc_id';
        $field->uitype = 10;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Equipment Location';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(10)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $id = $blockInstance->addFieldIgnite($field);
        echo "igggggggggggggggggggg mission created field --- $id ";
        // ------------------ invoga
       
        $invogamoduleInstance = Vtiger_Module::getInstance('FunctionalLocations');
        $relationLabel  = 'HelpDesk';
        $invogamoduleInstance->setRelatedList(
              $invoiceModule, $relationLabel, Array('ADD'), 'get_dependents_list' //you can do select also Array('ADD','SELECT')
        );
        // ------------------------invoga
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'HelpDesk', 'FunctionalLocations', NULL, NULL)";
        $adb->pquery($tom);
    } else {
        echo "field is present -- func_loc_id  in HelpDesk--- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_CUSTOM_INFORMATION in HelpDesk -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('chg_func_loc', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'chg_func_loc';
        $field->column = 'chg_func_loc';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Change Functional Location';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- chg_func_loc In HelpDesk Module --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_CUSTOM_INFORMATION in HelpDesk -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

// $invoiceModule = null;
// $blockInstance = null;
// $fieldInstance = null;
// $invoiceModule = Vtiger_Module::getInstance('HelpDesk');
// $blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $invoiceModule);
// if ($blockInstance) {
//     $fieldInstance = Vtiger_Field::getInstance('manual_loc', $invoiceModule);
//     if (!$fieldInstance) {
//         $field = new Vtiger_Field();
//         $field->name = 'manual_loc';
//         $field->column = 'manual_loc';
//         $field->uitype = 2;
//         $field->table = $invoiceModule->basetable;
//         $field->label = 'Other Location';
//         $field->summaryfield = 1;
//         $field->readonly = 1;
//         $field->presence = 2;
//         $field->typeofdata = 'V~O';
//         $field->columntype = 'VARCHAR(250)';
//         $field->quickcreate = 3;
//         $field->displaytype = 1;
//         $field->masseditable = 1;
//         $blockInstance->addField($field);
//     } else {
//         echo "field is present -- manual_loc in HelpDesk --- <br>";
//     }
// } else {
//     echo "Block Does not exits -- LBL_CUSTOM_INFORMATION in HelpDesk -- <br>";
// }
// $invoiceModule = null;
// $blockInstance = null;
// $fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sub_assembly', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'sub_assembly';
        $fieldInstance->label = 'SUB ASSEMBLY';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'sub_assembly';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('NEW', 'RECON', 'REPAIR'));
    } else {
        echo "field is already Present --- sub_assembly in HelpDesk Module --- <br>";
    }
} else {
    echo "block does not exits --- LBL_CUSTOM_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('det_of_sub_asmbl', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'det_of_sub_asmbl';
        $field->column = 'det_of_sub_asmbl';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'det_of_sub_asmbl';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- det_of_sub_asmbl in HelpDesk --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_CUSTOM_INFORMATION in HelpDesk -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('war_claim_dte', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'war_claim_dte';
        $fieldInstance->label = 'war_claim_dte';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'war_claim_dte';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('DATE OF SUPPLY', 'DATE OF FITMENT'));
    } else {
        echo "field is already Present --- war_claim_dte in HelpDesk Module --- <br>";
    }
} else {
    echo "block does not exits --- LBL_CUSTOM_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('purchase_ref', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'purchase_ref';
        $field->column = 'purchase_ref';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'PURCHASE ORDER REF';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(50)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- purchase_ref in HelpDesk --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_CUSTOM_INFORMATION in HelpDesk -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('SYSTEM INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sr_system_affected', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'sr_system_affected';
        $fieldInstance->label = 'System Affected';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'sr_system_affected';
        $fieldInstance->uitype = 33;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'TEXT';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Engine'));
    } else {
        echo "field is already Present --- sr_system_affected in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- SYSTEM INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('SYSTEM INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sr_hmr', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'sr_hmr';
        $fieldInstance->label = 'HMR Date';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'sr_hmr';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- sr_hmr in Equipment Module --- <br>";
    }
} else {
    echo "block does not exits --- SYSTEM INFORMATION in ServiceReports-- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('SYSTEM INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('symptoms', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'symptoms';
        $field->column = 'symptoms';
        $field->uitype = 21;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Symptoms';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'TEXT';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- symptoms ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- SYSTEM INFORMATION in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('SYSTEM INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('dte_of_commissing', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'dte_of_commissing';
        $fieldInstance->label = 'Date Of Commisioning';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'dte_of_commissing';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- dte_of_commissing in Equipment Module --- <br>";
    }
} else {
    echo "block does not exits --- SYSTEM INFORMATION in ServiceReports-- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('SYSTEM INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('warranty_end_dte', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'warranty_end_dte';
        $fieldInstance->label = 'Warranty End Date';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'warranty_end_dte';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- warranty_end_dte in ServiceReports Module --- <br>";
    }
} else {
    echo "block does not exits --- SYSTEM INFORMATION in ServiceReports-- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('SYSTEM INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sr_war_status', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'sr_war_status';
        $fieldInstance->label = 'Status';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'sr_war_status';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Coal'));
    } else {
        echo "field is already Present --- sr_war_status in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- SYSTEM INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('SYSTEM INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sr_warranty_terms', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'sr_warranty_terms';
        $field->column = 'sr_warranty_terms';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Warranty Terms';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(200)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- sr_warranty_terms ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- SYSTEM INFORMATION in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Contacts');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('rejection_reason', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'rejection_reason';
        $field->column = 'rejection_reason';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Rejection Reason';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(500)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- rejection_reason Contacts --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_CUSTOM_INFORMATION in Contacts -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Contacts');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('usr_log_plat', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'usr_log_plat';
        $fieldInstance->label = 'Accessing Portals';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'usr_log_plat';
        $fieldInstance->uitype = 33;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(500)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Mobile App','Web Portal'));
    } else {
        echo "field is already Present --- usr_log_plat in Contacts Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('rejection_reason', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'rejection_reason';
        $field->column = 'rejection_reason';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Rejection Reason';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(500)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- rejection_reason Contacts --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_USERLOGIN_ROLE in ServiceEngineer -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('ser_usr_log_plat', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'ser_usr_log_plat';
        $fieldInstance->label = 'Accessing Portals';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'ser_usr_log_plat';
        $fieldInstance->uitype = 33;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(500)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Mobile App','Web Portal'));
    } else {
        echo "field is already Present --- ser_usr_log_plat in ServiceEngineer Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_USERLOGIN_ROLE -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sr_dep_system', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'sr_dep_system';
        $fieldInstance->label = 'Select System';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'sr_dep_system';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('test value'));
    } else {
        echo "field is already Present --- sr_dep_system in HelpDesk Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('SYSTEM INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('ticket_date', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'ticket_date';
        $fieldInstance->label = 'Ticket Date';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'ticket_date';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- ticket_date in ServiceReports Module --- <br>";
    }
} else {
    echo "block does not exits --- SYSTEM INFORMATION in ServiceReports-- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('SYSTEM INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('opp_name', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'opp_name';
        $field->column = 'opp_name';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Name';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- opp_name in ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- SYSTEM INFORMATION in HelpDesk -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('SYSTEM INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('phone', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'phone';
        $field->column = 'phone';
        $field->uitype = 11;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Mobile Number';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(30)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- phone ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- SYSTEM INFORMATION in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('SYSTEM INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('reported_by', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'reported_by';
        $field->column = 'reported_by';
        $field->uitype = 10;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Reported By';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(10)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $id = $blockInstance->addFieldIgnite($field);
        echo "igggggggggggggggggggg mission created field --- $id ";
        // ------------------ invoga
       
        // $invogamoduleInstance = Vtiger_Module::getInstance('Equipment');
        // $relationLabel  = 'HelpDesk';
        // $invogamoduleInstance->setRelatedList(
        //       $invoiceModule, $relationLabel, Array('ADD'), 'get_dependents_list' //you can do select also Array('ADD','SELECT')
        // );
        // ------------------------invoga
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'ServiceReports', 'Contacts', NULL, NULL)";
        $adb->pquery($tom);
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'ServiceReports', 'Users', NULL, NULL)";
        $adb->pquery($tom);
    } else {
        echo "field is present -- reported_by  in ServiceReports--- <br>";
    }
} else {
    echo "Block Does not exits -- SYSTEM INFORMATION in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('SYSTEM INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('account_id', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'account_id';
        $field->column = 'account_id';
        $field->uitype = 10;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Organisation Name';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(10)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $id = $blockInstance->addFieldIgnite($field);
        echo "igggggggggggggggggggg mission created field --- $id ";
        // ------------------ invoga
       
        $invogamoduleInstance = Vtiger_Module::getInstance('Accounts');
        $relationLabel  = 'Service Reports';
        $invogamoduleInstance->setRelatedList(
              $invoiceModule, $relationLabel, Array('ADD'), 'get_dependents_list' //you can do select also Array('ADD','SELECT')
        );
        // ------------------------invoga
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'ServiceReports', 'Accounts', NULL, NULL)";
        $adb->pquery($tom);
       
    } else {
        echo "field is present -- account_id  in ServiceReports--- <br>";
    }
} else {
    echo "Block Does not exits -- SYSTEM INFORMATION in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('SYSTEM INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('func_loc_id', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'func_loc_id';
        $field->column = 'func_loc_id';
        $field->uitype = 10;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Project Name';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(10)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $id = $blockInstance->addFieldIgnite($field);
        echo "igggggggggggggggggggg mission created field --- $id ";
        // ------------------ invoga
       
        $invogamoduleInstance = Vtiger_Module::getInstance('FunctionalLocations');
        $relationLabel  = 'ServiceReports';
        $invogamoduleInstance->setRelatedList(
              $invoiceModule, $relationLabel, Array('ADD'), 'get_dependents_list' //you can do select also Array('ADD','SELECT')
        );
        // ------------------------invoga
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'ServiceReports', 'FunctionalLocations', NULL, NULL)";
        $adb->pquery($tom);
    } else {
        echo "field is present -- func_loc_id  in ServiceReports--- <br>";
    }
} else {
    echo "Block Does not exits -- SYSTEM INFORMATION in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('SYSTEM INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('area_name', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'area_name';
        $field->column = 'area_name';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Area Name';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- area_name ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- SYSTEM INFORMATION in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('SYSTEM INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sr_ticket_type', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'sr_ticket_type';
        $fieldInstance->label = 'Type';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'sr_ticket_type';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Periodic Maintenance', 'Breakdown', 'General Inspection', 'Sub Assembly Fitment','Service for Spares','Initial Commissioning'));
    } else {
        echo "field is already Present --- sr_ticket_type in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- SYSTEM INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$emm = null;
$emm = new VTEntityMethodManager($adb);
$result = $adb->pquery("SELECT function_name FROM com_vtiger_workflowtasks_entitymethod WHERE module_name=? AND method_name=?", array('HelpDesk', 'HandleTicketAssignment'));
if ($adb->num_rows($result) == 0) {
    $emm->addEntityMethod("HelpDesk", "HandleTicketAssignment", "modules/HelpDesk/HandleTicketAssignment.php", "HandleTicketAssignment");
} else {
    print_r("already exits --- workflow function -- HandleTicketAssignment in HelpDesk Module <br> ");
}
$emm = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('tket_acc_status', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'tket_acc_status';
        $fieldInstance->label = 'Acceptance Status';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'tket_acc_status';
        $fieldInstance->uitype = '15';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Pending', 'Accepted', 'Rejected'));
    } else {
        echo "field is already Present --- tket_acc_status in HelpDesk Module --- <br>";
    }
} else {
    echo "Block does not exits --- LBL_CUSTOM_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('rejection_reason', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'rejection_reason';
        $field->column = 'rejection_reason';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Rejection Reason';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(500)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- rejection_reason HelpDesk --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_CUSTOM_INFORMATION in HelpDesk -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Contacts');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('con_role', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'con_role';
        $fieldInstance->label = 'Contact Role';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'con_role';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Customer HQ', 'Area Manager', 'Staff officer','Area GM','Project Engineer','Project In charge'));
    } else {
        echo "field is already Present --- con_role in Contacts Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('SYSTEM INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('ticket_id', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'ticket_id';
        $field->column = 'ticket_id';
        $field->uitype = 10;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Ticket Id';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(10)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $id = $blockInstance->addFieldIgnite($field);
        echo "igggggggggggggggggggg mission created field --- $id ";
        // ------------------ invoga
       
        $invogamoduleInstance = Vtiger_Module::getInstance('HelpDesk');
        $relationLabel  = 'ServiceReports';
        $invogamoduleInstance->setRelatedList(
              $invoiceModule, $relationLabel, Array('ADD'), 'get_dependents_list' //you can do select also Array('ADD','SELECT')
        );
        // ------------------------invoga
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'ServiceReports', 'HelpDesk', NULL, NULL)";
        $adb->pquery($tom);
    } else {
        echo "field is present -- ticket_id  in ServiceReports--- <br>";
    }
} else {
    echo "Block Does not exits -- SYSTEM INFORMATION in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Equipment');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_SYSTEM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('eq_last_hmr', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'eq_last_hmr';
        $fieldInstance->column = 'eq_last_hmr';
        $fieldInstance->uitype = 7;
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->label = 'Hour Meter Reading';
        $fieldInstance->summaryfield = 1;
        $fieldInstance->readonly = 1;
        $fieldInstance->presence = 2;
        $fieldInstance->typeofdata = 'I~O';
        $fieldInstance->columntype = 'INT(15)';
        $fieldInstance->quickcreate = 3;
        $fieldInstance->displaytype = 1;
        $fieldInstance->masseditable = 1;
        $fieldInstance->defaultvalue = 0;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- eq_last_hmr in Equipment Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_BLOCK_SYSTEM_INFORMATION in Equipment -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('LBL_ITEM_DETAILS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sr_action_one', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'sr_action_one';
        $fieldInstance->label = 'Action 1';
        $fieldInstance->table = 'vtiger_inventoryproductrel';
        $fieldInstance->column = 'sr_action_one';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('To be replaced', 'Can be used'));
    } else {
        echo "field is present -- sr_action_one In ServiceReports Module --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_ITEM_DETAILS in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('LBL_ITEM_DETAILS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sr_action_two', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'sr_action_two';
        $fieldInstance->label = 'Action 1';
        $fieldInstance->table = 'vtiger_inventoryproductrel';
        $fieldInstance->column = 'sr_action_two';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Required', 'Repaired'));
    } else {
        echo "field is present -- sr_action_two In ServiceReports Module --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_ITEM_DETAILS in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('LBL_ITEM_DETAILS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sr_replace_action', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'sr_replace_action';
        $fieldInstance->label = 'Replacement Action';
        $fieldInstance->table = 'vtiger_inventoryproductrel';
        $fieldInstance->column = 'sr_replace_action';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('From BEML', 'From Vendor','From Customer'));
    } else {
        echo "field is present -- sr_replace_action In ServiceReports Module --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_ITEM_DETAILS in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('Equipment Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sr_equip_status', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'sr_equip_status';
        $fieldInstance->label = 'Equipment Status';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'sr_equip_status';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('On Road', 'Off Road', 'Running With Problem'));
    } else {
        echo "field is already Present --- sr_equip_status in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- Equipment Details in ServiceReports -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('Equipment Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('eng_sl_no', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'eng_sl_no';
        $field->column = 'eng_sl_no';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Engine Sl No';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- eng_sl_no in ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- Equipment Details in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('Equipment Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('trans_sl_no', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'trans_sl_no';
        $field->column = 'trans_sl_no';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Transmission Sl No';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- trans_sl_no in ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- Equipment Details in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('Equipment Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('motor_sl_no', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'motor_sl_no';
        $field->column = 'motor_sl_no';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Motor Sl No';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- motor_sl_no in ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- Equipment Details in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('Equipment Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('date_of_failure', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'date_of_failure';
        $fieldInstance->label = 'Failure Date';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'date_of_failure';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- date_of_failure in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- Equipment Details -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('Equipment Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('hmr', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'hmr';
        $fieldInstance->column = 'hmr';
        $fieldInstance->uitype = 7;
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->label = 'Meter reading';
        $fieldInstance->summaryfield = 1;
        $fieldInstance->readonly = 1;
        $fieldInstance->presence = 2;
        $fieldInstance->typeofdata = 'I~O';
        $fieldInstance->columntype = 'INT(15)';
        $fieldInstance->quickcreate = 3;
        $fieldInstance->displaytype = 1;
        $fieldInstance->masseditable = 1;
        $fieldInstance->defaultvalue = 0;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- hmr in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- Equipment Details in ServiceReports -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('Equipment Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('kilometer_reading', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'kilometer_reading';
        $fieldInstance->column = 'kilometer_reading';
        $fieldInstance->uitype = 7;
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->label = 'Kilometer';
        $fieldInstance->summaryfield = 1;
        $fieldInstance->readonly = 1;
        $fieldInstance->presence = 2;
        $fieldInstance->typeofdata = 'I~O';
        $fieldInstance->columntype = 'INT(15)';
        $fieldInstance->quickcreate = 3;
        $fieldInstance->displaytype = 1;
        $fieldInstance->masseditable = 1;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- kilometer_reading in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- Equipment Details in ServiceReports -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('Equipment Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('kilo_date', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'kilo_date';
        $fieldInstance->label = 'Kilometer Date';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'kilo_date';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- kilo_date in ServiceReports Module --- <br>";
    }
} else {
    echo "block does not exits --- Equipment Details in ServiceReports-- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('SYSTEM INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('project_name', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'project_name';
        $field->column = 'project_name';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Project Name';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- project_name ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- SYSTEM INFORMATION in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('Warranty / Contract Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('type_of_conrt', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'type_of_conrt';
        $fieldInstance->label = 'Type of Contract';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'type_of_conrt';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('GPCC', 'COSTCAP', 'FMC','MARC','AMC'));
    } else {
        echo "field is already Present --- type_of_conrt in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- Warranty / Contract Details in ServiceReports -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('Warranty / Contract Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('cont_start_date', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'cont_start_date';
        $fieldInstance->label = 'Contract Start Date';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'cont_start_date';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- cont_start_date in ServiceReports Module --- <br>";
    }
} else {
    echo "block does not exits --- Warranty / Contract Details in ServiceReports-- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('Warranty / Contract Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('cont_end_date', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'cont_end_date';
        $fieldInstance->label = 'Contract End Date';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'cont_end_date';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- cont_end_date in ServiceReports Module --- <br>";
    }
} else {
    echo "block does not exits --- Warranty / Contract Details in ServiceReports-- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('Warranty / Contract Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('run_year_cont', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'run_year_cont';
        $fieldInstance->column = 'run_year_cont';
        $fieldInstance->uitype = 7;
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->label = 'Running year of Contract';
        $fieldInstance->summaryfield = 1;
        $fieldInstance->readonly = 1;
        $fieldInstance->presence = 2;
        $fieldInstance->typeofdata = 'I~O';
        $fieldInstance->columntype = 'INT(10)';
        $fieldInstance->displaytype = 1;
        $fieldInstance->masseditable = 1;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- run_year_cont in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- Warranty / Contract Details in ServiceReports -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('Warranty / Contract Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sr_eq_warranty_terms', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'sr_eq_warranty_terms';
        $field->column = 'sr_eq_warranty_terms';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Equipment Warranty Terms';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(200)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- sr_eq_warranty_terms ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- Warranty / Contract Details in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('Warranty / Contract Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sr_agg_warranty_terms', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'sr_agg_warranty_terms';
        $field->column = 'sr_agg_warranty_terms';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Aggregate Warranty Details';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(200)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- sr_agg_warranty_terms ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- Warranty / Contract Details in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('Warranty / Contract Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sr_transmission', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'sr_transmission';
        $field->column = 'sr_transmission';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Transmission';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(200)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- sr_transmission ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- Warranty / Contract Details in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('Warranty / Contract Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sr_engine', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'sr_engine';
        $field->column = 'sr_engine';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Engine';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(200)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- sr_engine ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- Warranty / Contract Details in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('Warranty / Contract Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sr_final_drive', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'sr_final_drive';
        $field->column = 'sr_final_drive';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Final Drive';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(200)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- sr_final_drive ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- Warranty / Contract Details in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('Warranty / Contract Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sr_rear_axle', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'sr_rear_axle';
        $field->column = 'sr_rear_axle';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Rear Axle';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(200)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present --   ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- Warranty / Contract Details in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('Warranty / Contract Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sr_chassis', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'sr_chassis';
        $field->column = 'sr_chassis';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Chassis';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(200)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- sr_chassis   ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- Warranty / Contract Details in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Equipment');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('plant_name', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'plant_name';
        $field->column = 'plant_name';
        $field->uitype = 10;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Plant';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(10)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $id = $blockInstance->addFieldIgnite($field);
        echo "igggggggggggggggggggg mission created field --- $id ";
        // ------------------ invoga
        $invogamoduleInstance = Vtiger_Module::getInstance('MaintenancePlant');
        $relationLabel  = 'Equipments';
        $invogamoduleInstance->setRelatedList(
              $invoiceModule, $relationLabel, Array('ADD'), 'get_dependents_list' //you can do select also Array('ADD','SELECT')
        );
        // ------------------------invoga
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'Equipment', 'MaintenancePlant', NULL, NULL)";
        $adb->pquery($tom);
    } else {
        echo "field is present -- plant_name  in Equipment--- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_BLOCK_GENERAL_INFORMATION in Equipment -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('StockTransferOrders');
$blockInstance = Vtiger_Block::getInstance('LBL_SYSTEM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('ticket_id', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'ticket_id';
        $field->column = 'ticket_id';
        $field->uitype = 10;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Ticket Id';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(10)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $id = $blockInstance->addFieldIgnite($field);
        echo "igggggggggggggggggggg mission created field --- $id ";
        // ------------------ invoga
        $invogamoduleInstance = Vtiger_Module::getInstance('HelpDesk');
        $relationLabel  = 'StockTransfer Orders';
        $invogamoduleInstance->setRelatedList(
              $invoiceModule, $relationLabel, Array('ADD'), 'get_dependents_list' //you can do select also Array('ADD','SELECT')
        );
        // ------------------------invoga
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'StockTransferOrders', 'HelpDesk', NULL, NULL)";
        $adb->pquery($tom);
    } else {
        echo "field is present -- ticket_id  in StockTransferOrders--- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_SYSTEM_INFORMATION in StockTransferOrders -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

// $invoiceModule = null;
// $blockInstance = null;
// $fieldInstance = null;
// $invoiceModule = Vtiger_Module::getInstance('BankGuarantee');
// $blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $invoiceModule);
// if ($blockInstance) {
//     $fieldInstance = Vtiger_Field::getInstance('equ_ser_no', $invoiceModule);
//     if (!$fieldInstance) {
//         $field = new Vtiger_Field();
//         $field->name = 'equ_ser_no';
//         $field->column = 'equ_ser_no';
//         $field->uitype = 2;
//         $field->table = $invoiceModule->basetable;
//         $field->label = 'Equipment Sl.No.';
//         $field->summaryfield = 1;
//         $field->readonly = 1;
//         $field->presence = 2;
//         $field->typeofdata = 'V~O';
//         $field->columntype = 'VARCHAR(250)';
//         $field->quickcreate = 3;
//         $field->displaytype = 1;
//         $field->masseditable = 1;
//         $field->defaultvalue = 0;
//         $blockInstance->addField($field);
//     } else {
//         echo "field is present -- equ_ser_no in BankGuarantee --- <br>";
//     }
// } else {
//     echo "Block Does not exits -- LBL_BLOCK_GENERAL_INFORMATION in BankGuarantee -- <br>";
// }
// $invoiceModule = null;
// $blockInstance = null;
// $fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('BankGuarantee');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('plant_name', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'plant_name';
        $field->column = 'plant_name';
        $field->uitype = 10;
        $field->table = $invoiceModule->basetable;
        $field->label = 'REGION / PLANT';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(30)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $id = $blockInstance->addFieldIgnite($field);
        echo "igggggggggggggggggggg mission created field --- $id ";
        // ------------------ invoga
        $invogamoduleInstance = Vtiger_Module::getInstance('MaintenancePlant');
        $relationLabel  = 'BankGuarantees';
        $invogamoduleInstance->setRelatedList(
              $invoiceModule, $relationLabel, Array('ADD'), 'get_dependents_list' //you can do select also Array('ADD','SELECT')
        );
        // ------------------------invoga
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'BankGuarantee', 'MaintenancePlant', NULL, NULL)";
        $adb->pquery($tom);
    } else {
        echo "field is present -- plant_name  in BankGuarantee--- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_BLOCK_GENERAL_INFORMATION in BankGuarantee -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('BankGuarantee');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('bg_val', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'bg_val';
        $fieldInstance->column = 'bg_val';
        $fieldInstance->uitype = 7;
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->label = 'BankGuarantee Value';
        $fieldInstance->summaryfield = 1;
        $fieldInstance->readonly = 1;
        $fieldInstance->presence = 2;
        $fieldInstance->typeofdata = 'NN~O';
        $fieldInstance->columntype = 'DECIMAL(30,5)';
        $fieldInstance->quickcreate = 3;
        $fieldInstance->displaytype = 1;
        $fieldInstance->masseditable = 1;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- bg_val in BankGuarantee Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_BLOCK_GENERAL_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('BankGuarantee');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('zbg_region', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'zbg_region';
        $field->column = 'zbg_region';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'REGION';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- zbg_region in BankGuarantee --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_BLOCK_GENERAL_INFORMATION in BankGuarantee -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('BankGuarantee');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('account_id', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'account_id';
        $field->column = 'account_id';
        $field->uitype = 10;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Customer Number';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(30)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $id = $blockInstance->addFieldIgnite($field);
        echo "igggggggggggggggggggg mission created field --- $id ";
        // ------------------ invoga
        $invogamoduleInstance = Vtiger_Module::getInstance('Accounts');
        $relationLabel  = 'BankGuarantees';
        $invogamoduleInstance->setRelatedList(
              $invoiceModule, $relationLabel, Array('ADD'), 'get_dependents_list' //you can do select also Array('ADD','SELECT')
        );
        // ------------------------invoga
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'BankGuarantee', 'Accounts', NULL, NULL)";
        $adb->pquery($tom);
    } else {
        echo "field is present -- account_id  in BankGuarantee--- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_BLOCK_GENERAL_INFORMATION in BankGuarantee -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('BankGuarantee');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('bg_valid_from', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'bg_valid_from';
        $fieldInstance->label = 'BG Validity from';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'bg_valid_from';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- bg_valid_from in BankGuarantee Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_BLOCK_GENERAL_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('BankGuarantee');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('bg_valid_to', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'bg_valid_to';
        $fieldInstance->label = 'BG Validity Upto';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'bg_valid_to';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- bg_valid_to in BankGuarantee Module --- <br>";
    }
} else {
    echo "block does not exits --- LBL_BLOCK_GENERAL_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('BankGuarantee');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('zbg_no', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'zbg_no';
        $field->column = 'zbg_no';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'BG NUmber';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- zbg_no in BankGuarantee --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_BLOCK_GENERAL_INFORMATION in BankGuarantee -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sr_equip_model', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'sr_equip_model';
        $fieldInstance->label = 'Equipment Model';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'sr_equip_model';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('BH100', 'BWS70', 'BG825'));
    } else {
        echo "field is already Present --- sr_equip_model in HelpDesk Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_CUSTOM_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('usr_verification', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'usr_verification';
        $field->column = 'usr_verification';
        $field->table = $invoiceModule->basetable;
        $field->label = 'User Verification';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 2;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- usr_verification In ServiceEngineer Module --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_USERLOGIN_ROLE in ServiceEngineer -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceEngineer');
$blockInstance = Vtiger_Block::getInstance('LBL_USERLOGIN_ROLE', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('ticket_assign', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'ticket_assign';
        $field->column = 'ticket_assign';
        $field->table = $invoiceModule->basetable;
        $field->label = 'Ticket Assignment';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- ticket_assign In ServiceEngineer Module --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_USERLOGIN_ROLE in ServiceEngineer -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
//################################################################################
//genchk_engine
//genchk_engine
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_engine', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_engine';
        $fieldInstance->label = 'Engine';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_engine';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK', 'NA'));
    } else {
        echo "field is already Present --- genchk_engine in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;



$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_oil_pressure', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_oil_pressure';
        $fieldInstance->label = 'Oil Pressure';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_oil_pressure';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK'));
    } else {
        echo "field is already Present --- genchk_oil_pressure in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_oil_temperature', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_oil_temperature';
        $fieldInstance->label = 'Oil Temperature';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_oil_temperature';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK'));
    } else {
        echo "field is already Present --- genchk_oil_temperature in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_coolant_temperature', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_coolant_temperature';
        $fieldInstance->label = 'Coolant Temperature';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_coolant_temperature';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK'));
    } else {
        echo "field is already Present --- genchk_coolant_temperature in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;


$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_transmission', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_transmission';
        $fieldInstance->label = 'Transmission';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_transmission';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK', 'NA'));
    } else {
        echo "field is already Present --- genchk_transmission in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;


$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_brake', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_brake';
        $fieldInstance->label = 'Brake';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_brake';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK'));
    } else {
        echo "field is already Present --- genchk_brake in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_air_pressure', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_air_pressure';
        $fieldInstance->label = 'Air Pressure';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_air_pressure';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK','NA'));
    } else {
        echo "field is already Present --- genchk_air_pressure in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_electrical', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_electrical';
        $fieldInstance->label = 'Electrical';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_electrical';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK','NA'));
    } else {
        echo "field is already Present --- genchk_electrical in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_motor', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_motor';
        $fieldInstance->label = 'Motor(AC/DC)';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_motor';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK','NA'));
    } else {
        echo "field is already Present --- genchk_motor in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;


$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_transformer', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_transformer';
        $fieldInstance->label = 'Transformer';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_transformer';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK','NA'));
    } else {
        echo "field is already Present --- genchk_transformer in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;


$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_field_switch', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_field_switch';
        $fieldInstance->label = 'Field Switch';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_field_switch';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK','NA'));
    } else {
        echo "field is already Present --- genchk_field_switch in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_auto_electrical_system', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_auto_electrical_system';
        $fieldInstance->label = 'Auto Electrical System(DC)';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_auto_electrical_system';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK','NA'));
    } else {
        echo "field is already Present --- genchk_auto_electrical_system in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_hi_volt_ele_system', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_hi_volt_ele_system';
        $fieldInstance->label = 'High Voltage Electrical System';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_hi_volt_ele_system';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK','NA'));
    } else {
        echo "field is already Present --- genchk_hi_volt_ele_system in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;


$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_battery_voltage', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_battery_voltage';
        $fieldInstance->label = 'Battery Voltage';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_battery_voltage';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK','NA'));
    } else {
        echo "field is already Present --- genchk_battery_voltage in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;


$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_hydraulic', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_hydraulic';
        $fieldInstance->label = 'Hydraulic';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_hydraulic';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK','NA'));
    } else {
        echo "field is already Present --- genchk_hydraulic in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;



$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_cylinders', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_cylinders';
        $fieldInstance->label = 'Cylinders';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_cylinders';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK','NA'));
    } else {
        echo "field is already Present --- genchk_cylinders in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;


$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_suspension', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_suspension';
        $fieldInstance->label = 'Suspension';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_suspension';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK','NA'));
    } else {
        echo "field is already Present --- genchk_suspension in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_pumps', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_pumps';
        $fieldInstance->label = 'Pumps';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_pumps';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK','NA'));
    } else {
        echo "field is already Present --- genchk_pumps in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;


$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_oil_cooler', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_oil_cooler';
        $fieldInstance->label = 'Oil Cooler';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_oil_cooler';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK','NA'));
    } else {
        echo "field is already Present --- genchk_oil_cooler in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_structure', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_structure';
        $fieldInstance->label = 'Structure';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_structure';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK'));
    } else {
        echo "field is already Present --- genchk_structure in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_auto_lubrication', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_auto_lubrication';
        $fieldInstance->label = 'Auto Lubrication';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_auto_lubrication';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK','NA'));
    } else {
        echo "field is already Present --- genchk_auto_lubrication in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;


$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_air_conditionn', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_air_conditionn';
        $fieldInstance->label = 'Air Condition';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_air_conditionn';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK','NA'));
    } else {
        echo "field is already Present --- genchk_air_conditionn in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;


$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('GENERAL_CHECKS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('genchk_auto_fire_protection', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'genchk_auto_fire_protection';
        $fieldInstance->label = 'Auto Fire Protection';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'genchk_auto_fire_protection';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('OK', 'NOT OK','NA'));
    } else {
        echo "field is already Present --- genchk_auto_fire_protection in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- GENERAL_CHECKS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('VISUAL_CHECKS', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('vis_chk_external_damages', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'vis_chk_external_damages';
        $field->column = 'vis_chk_external_damages';
        $field->table = $invoiceModule->basetable."cf";
        $field->label = 'External Damages';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- vis_chk_external_damages In ServiceReports Module --- <br>";
    }
} else {
    echo "Block Does not exits -- VISUAL_CHECKS in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('VISUAL_CHECKS', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('vis_chk_hydraulic_air_leakages', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'vis_chk_hydraulic_air_leakages';
        $field->column = 'vis_chk_hydraulic_air_leakages';
        $field->table = $invoiceModule->basetable."cf";
        $field->label = 'Hydraulic & Air Leakages';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- vis_chk_hydraulic_air_leakages In ServiceReports Module --- <br>";
    }
} else {
    echo "Block Does not exits -- VISUAL_CHECKS in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('VISUAL_CHECKS', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('vis_chk_work_loseing_hders', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'vis_chk_work_loseing_hders';
        $field->column = 'vis_chk_work_loseing_hders';
        $field->table = $invoiceModule->basetable."cf";
        $field->label = 'Work loosening of Hardwares';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- vis_chk_work_loseing_hders In ServiceReports Module --- <br>";
    }
} else {
    echo "Block Does not exits -- VISUAL_CHECKS in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('VISUAL_CHECKS', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('vis_chk_lubrication', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'vis_chk_lubrication';
        $field->column = 'vis_chk_lubrication';
        $field->table = $invoiceModule->basetable."cf";
        $field->label = 'Lubrication';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- vis_chk_lubrication In ServiceReports Module --- <br>";
    }
} else {
    echo "Block Does not exits -- VISUAL_CHECKS in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;


$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('VISUAL_CHECKS', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('vis_chk_oil_levels', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'vis_chk_oil_levels';
        $field->column = 'vis_chk_oil_levels';
        $field->table = $invoiceModule->basetable."cf";
        $field->label = 'Oil Levels';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- vis_chk_oil_levels In ServiceReports Module --- <br>";
    }
} else {
    echo "Block Does not exits -- VISUAL_CHECKS in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_TICKET_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('ticket_date', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'ticket_date';
        $fieldInstance->label = 'Ticket Date ';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'ticket_date';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->displaytype = 2;
        $fieldInstance->columntype = 'DATE';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- ticket_date in HelpDesk Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_TICKET_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

//ServiceReports_FAILURE_DETAILS
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('FAILURE_DETAILS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('fail_de_failure_investigation', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'fail_de_failure_investigation';
        $fieldInstance->label = 'Failure Investigation';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'fail_de_failure_investigation';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('testval'));
    } else {
        echo "field is already Present --- fail_de_failure_investigation in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- FAILURE_DETAILS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('FAILURE_DETAILS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('fail_de_failure_on_account_of', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'fail_de_failure_on_account_of';
        $fieldInstance->label = 'Failure on account of';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'fail_de_failure_on_account_of';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('testval'));
    } else {
        echo "field is already Present --- fail_de_failure_on_account_of in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- FAILURE_DETAILS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('FAILURE_DETAILS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('fail_de_system_affected', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'fail_de_system_affected';
        $fieldInstance->label = 'System Affected';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'fail_de_system_affected';
        $fieldInstance->uitype = '33';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'TEXT';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('testval'));
    } else {
        echo "field is already Present --- fail_de_system_affected in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- FAILURE_DETAILS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('FAILURE_DETAILS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('fail_de_parts_affected', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'fail_de_parts_affected';
        $fieldInstance->label = 'Parts Affected';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'fail_de_parts_affected';
        $fieldInstance->uitype = '33';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'TEXT';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('testval'));
    } else {
        echo "field is already Present --- fail_de_parts_affected in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- FAILURE_DETAILS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('FAILURE_DETAILS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('fail_de_type_of_damage', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'fail_de_type_of_damage';
        $fieldInstance->label = 'Type of damage';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'fail_de_type_of_damage';
        $fieldInstance->uitype = '33';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'TEXT';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('testval'));
    } else {
        echo "field is already Present --- fail_de_type_of_damage in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- FAILURE_DETAILS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('FAILURE_DETAILS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('fail_de_part_pertains_to', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'fail_de_part_pertains_to';
        $fieldInstance->label = 'Part pertains to';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'fail_de_part_pertains_to';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('BEML','Vendor'));
    } else {
        echo "field is already Present --- fail_de_part_pertains_to in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- FAILURE_DETAILS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('FAILURE_DETAILS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('fail_de_sap_noti_type', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'fail_de_sap_noti_type';
        $fieldInstance->label = 'Select SAP Service Notification type';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'fail_de_sap_noti_type';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('ZW', 'ZJ','ZC','ZF','ZH','ZO'));
    } else {
        echo "field is already Present --- fail_de_sap_noti_type in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- FAILURE_DETAILS -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('CallAssistance');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('call_equip_model', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'call_equip_model';
        $fieldInstance->label = 'Equipment Model';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'call_equip_model';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('BH100', 'BWS70', 'BG825'));
    } else {
        echo "field is already Present --- call_equip_model in CallAssistance Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_BLOCK_GENERAL_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('CallAssistance');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('phone', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'phone';
        $field->column = 'phone';
        $field->uitype = 11;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Mobile Number';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(30)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- phone CallAssistance --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_BLOCK_GENERAL_INFORMATION in CallAssistance -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('CallAssistance');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('service_engineerid', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'service_engineerid';
        $field->column = 'service_engineerid';
        $field->uitype = 10;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Employee Name';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(30)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $id = $blockInstance->addFieldIgnite($field);
        echo "igggggggggggggggggggg mission created field --- $id ";
        // ------------------ invoga
       
        $invogamoduleInstance = Vtiger_Module::getInstance('ServiceEngineer');
        $relationLabel  = 'CallAssistance';
        $invogamoduleInstance->setRelatedList(
              $invoiceModule, $relationLabel, Array('ADD'), 'get_dependents_list' //you can do select also Array('ADD','SELECT')
        );
        // ------------------------invoga
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'CallAssistance', 'ServiceEngineer', NULL, NULL)";
        $adb->pquery($tom);
    } else {
        echo "field is present -- service_engineerid  in CallAssistance--- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_BLOCK_GENERAL_INFORMATION in CallAssistance -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$emm = null;
$emm = new VTEntityMethodManager($adb);
$result = $adb->pquery("SELECT function_name FROM com_vtiger_workflowtasks_entitymethod WHERE module_name=? AND method_name=?", array('HelpDesk', 'SyncToExternalOnAccept'));
if ($adb->num_rows($result) == 0) {
    $emm->addEntityMethod("HelpDesk", "SyncToExternalOnAccept", "modules/HelpDesk/SyncToExternalOnAccept.php", "SyncToExternalOnAccept");
} else {
    print_r("already exits --- workflow function -- SyncToExternalOnAccept in HelpDesk Module <br> ");
}
$emm = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('HelpDesk');
$blockInstance = Vtiger_Block::getInstance('LBL_CUSTOM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('external_app_num', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'external_app_num';
        $field->column = 'external_app_num';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'SAP Reference Number';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 2;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- external_app_num in HelpDesk --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_CUSTOM_INFORMATION in HelpDesk -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Equipment');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_SYSTEM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('last_hmr_date', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'last_hmr_date';
        $fieldInstance->label = 'Last HMR Date';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'last_hmr_date';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- last_hmr_date in Equipment Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_BLOCK_SYSTEM_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Equipment');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_SYSTEM_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('last_hmr_time', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'last_hmr_time';
        $fieldInstance->label = 'Last HMR Time';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'last_hmr_time';
        $fieldInstance->uitype = 14;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'T~O';
        $fieldInstance->columntype = 'TIME';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- last_hmr_time in Equipment Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_BLOCK_SYSTEM_INFORMATION -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('Products');
$blockInstance = Vtiger_Block::getInstance('LBL_PRODUCT_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('plant_name', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'plant_name';
        $field->column = 'plant_name';
        $field->uitype = 10;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Plant';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(10)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $id = $blockInstance->addFieldIgnite($field);
        echo "igggggggggggggggggggg mission created field --- $id ";
        // ------------------ invoga
        $invogamoduleInstance = Vtiger_Module::getInstance('MaintenancePlant');
        $relationLabel  = 'Products';
        $invogamoduleInstance->setRelatedList(
              $invoiceModule, $relationLabel, Array('ADD'), 'get_dependents_list' //you can do select also Array('ADD','SELECT')
        );
        // ------------------------invoga
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'Products', 'MaintenancePlant', NULL, NULL)";
        $adb->pquery($tom);
    } else {
        echo "field is present -- plant_name  in Products--- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_PRODUCT_INFORMATION in Products -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('BankGuarantee');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('equipment_id', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'equipment_id';
        $field->column = 'equipment_id';
        $field->uitype = 10;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Equipment Serial No.';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(10)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $id = $blockInstance->addFieldIgnite($field);
        echo "igggggggggggggggggggg mission created field --- $id ";
       
        $invogamoduleInstance = Vtiger_Module::getInstance('Equipment');
        $relationLabel  = 'BankGuarantees';
        $invogamoduleInstance->setRelatedList(
              $invoiceModule, $relationLabel, Array('ADD'), 'get_dependents_list' //you can do select also Array('ADD','SELECT')
        );
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'BankGuarantee', 'Equipment', NULL, NULL)";
        $adb->pquery($tom);
    } else {
        echo "field is present -- equipment_id  in BankGuarantee--- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_BLOCK_GENERAL_INFORMATION in BankGuarantee -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Equipment');
$blockInstance = Vtiger_Block::getInstance('Customer_Warranty', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('cust_begin_guar', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'cust_begin_guar';
        $fieldInstance->label = 'Begin guarantee';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'cust_begin_guar';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- cust_begin_guar in Equipment Module --- <br>";
    }
} else {
    echo " block does not exits --- Customer_Warranty -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Equipment');
$blockInstance = Vtiger_Block::getInstance('Customer_Warranty', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('cust_war_end', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'cust_war_end';
        $fieldInstance->label = 'Warranty end';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'cust_war_end';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- cust_war_end in Equipment Module --- <br>";
    }
} else {
    echo " block does not exits --- Customer_Warranty -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

// vendor warranty ######################################################
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Equipment');
$blockInstance = Vtiger_Block::getInstance('Vendor_Warranty', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('ven_begin_guar', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'ven_begin_guar';
        $fieldInstance->label = 'Begin guarantee';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'ven_begin_guar';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- ven_begin_guar in Equipment Module --- <br>";
    }
} else {
    echo " block does not exits --- Vendor_Warranty -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Equipment');
$blockInstance = Vtiger_Block::getInstance('Vendor_Warranty', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('ven_war_end', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'ven_war_end';
        $fieldInstance->label = 'Warranty end';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'ven_war_end';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- ven_war_end in Equipment Module --- <br>";
    }
} else {
    echo " block does not exits --- Vendor_Warranty -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('HMREntries');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('equipment_id', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'equipment_id';
        $field->column = 'equipment_id';
        $field->uitype = 10;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Equipment Serial No.';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(10)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $id = $blockInstance->addFieldIgnite($field);
        echo "igggggggggggggggggggg mission created field --- $id ";
       
        $invogamoduleInstance = Vtiger_Module::getInstance('Equipment');
        $relationLabel  = 'HMR Entries';
        $invogamoduleInstance->setRelatedList(
              $invoiceModule, $relationLabel, Array('ADD'), 'get_dependents_list' //you can do select also Array('ADD','SELECT')
        );
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'HMREntries', 'Equipment', NULL, NULL)";
        $adb->pquery($tom);
    } else {
        echo "field is present -- equipment_id  in HMREntries--- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_BLOCK_GENERAL_INFORMATION in HMREntries -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Equipment');
$blockInstance = Vtiger_Block::getInstance('Customer_Warranty', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('eq_type_of_conrt', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'eq_type_of_conrt';
        $fieldInstance->label = 'Type of Contract';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'eq_type_of_conrt';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('GPCC', 'COSTCAP', 'FMC','MARC','AMC'));
    } else {
        echo "field is already Present --- eq_type_of_conrt in Equipment Module --- <br>";
    }
} else {
    echo " block does not exits --- Customer_Warranty in Equipment -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Equipment');
$blockInstance = Vtiger_Block::getInstance('Customer_Warranty', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('eq_run_war_st', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'eq_run_war_st';
        $fieldInstance->label = 'Running Status';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'eq_run_war_st';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Under Warranty', 'Aggregate Warranty', 'Contract','Outside Warranty'));
    } else {
        echo "field is already Present --- eq_run_war_st in Equipment Module --- <br>";
    }
} else {
    echo " block does not exits --- Customer_Warranty in Equipment -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('BankGuarantee');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('bnk_pre_status', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'bnk_pre_status';
        $fieldInstance->label = 'Present Status';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'bnk_pre_status';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Live', 'Extended', 'Availability Signed','Availability Under Reconciliation','Under Collection'));
    } else {
        echo "field is already Present --- bnk_pre_status in BankGuarantee Module --- <br>";
    }
} else {
    echo " block does not exits --- LBL_BLOCK_GENERAL_INFORMATION in BankGuarantee -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Equipment');
$blockInstance = Vtiger_Block::getInstance('Customer_Warranty', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('cont_start_date', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'cont_start_date';
        $fieldInstance->label = 'Contract Start Date';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'cont_start_date';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- cont_start_date in Equipment Module --- <br>";
    }
} else {
    echo "block does not exits --- Customer_Warranty in Equipment-- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Equipment');
$blockInstance = Vtiger_Block::getInstance('Customer_Warranty', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('cont_end_date', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'cont_end_date';
        $fieldInstance->label = 'Contract End Date';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'cont_end_date';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- cont_end_date in Equipment Module --- <br>";
    }
} else {
    echo "block does not exits --- Customer_Warranty in Equipment-- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('Equipment');
$blockInstance = Vtiger_Block::getInstance('Customer_Warranty', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('run_year_cont', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'run_year_cont';
        $fieldInstance->column = 'run_year_cont';
        $fieldInstance->uitype = 7;
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->label = 'Running year of Contract';
        $fieldInstance->summaryfield = 1;
        $fieldInstance->readonly = 1;
        $fieldInstance->presence = 2;
        $fieldInstance->typeofdata = 'I~O';
        $fieldInstance->columntype = 'INT(10)';
        $fieldInstance->displaytype = 1;
        $fieldInstance->masseditable = 1;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- run_year_cont in Equipment Module --- <br>";
    }
} else {
    echo " block does not exits --- Customer_Warranty in Equipment -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('FAILURE_DETAILS', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('fd_ag_war_avl', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'fd_ag_war_avl';
        $field->column = 'fd_ag_war_avl';
        $field->table = $invoiceModule->basetable."cf";
        $field->label = 'Aggregate Warranty Applicable';
        $field->uitype = 56;
        $field->columntype = 'INT(1) DEFAULT 0';
        $field->typeofdata = 'I~O';
        $field->displaytype = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- fd_ag_war_avl In ServiceReports Module --- <br>";
    }
} else {
    echo "Block Does not exits -- FAILURE_DETAILS in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('FAILURE_DETAILS', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('fd_obvservation', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'fd_obvservation';
        $field->column = 'fd_obvservation';
        $field->uitype = 21;
        $field->table = $invoiceModule->basetable."cf";
        $field->label = 'Observations after failure investigation';
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'TEXT';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- fd_obvservation In ServiceReports Module --- <br>";
    }
} else {
    echo "Block Does not exits -- FAILURE_DETAILS -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('FAILURE_DETAILS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('fd_sub_div', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'fd_sub_div';
        $fieldInstance->label = 'Select Division';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'fd_sub_div';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Engine', 'Truck', 'H&P', 'EM'));
    } else {
        echo "field is already Present --- fd_sub_div in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- FAILURE_DETAILS -- <br>";
}

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('FAILURE_DETAILS', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('vendor_id', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'vendor_id';
        $field->column = 'vendor_id';
        $field->uitype = 10;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Vendor Details';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(30)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $id = $blockInstance->addFieldIgnite($field);
        echo "created field --- $id ";
        $invogamoduleInstance = Vtiger_Module::getInstance('Accounts');
        $relationLabel  = 'ServiceReports';
        $invogamoduleInstance->setRelatedList(
              $invoiceModule, $relationLabel, Array('ADD'), 'get_dependents_list' //you can do select also Array('ADD','SELECT')
        );
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'ServiceReports', 'Vendors', NULL, NULL)";
        $adb->pquery($tom);
    } else {
        echo "field is present -- vendor_id  in ServiceReports--- <br>";
    }
} else {
    echo "Block Does not exits -- FAILURE_DETAILS in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('FAILURE_DETAILS', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('fd_ser_id', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'fd_ser_id';
        $field->column = 'fd_ser_id';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Serial No';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(200)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- fd_ser_id in ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- FAILURE_DETAILS in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('Equipment Details', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('eq_sr_equip_model', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'eq_sr_equip_model';
        $fieldInstance->label = 'Equipment Model';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'eq_sr_equip_model';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('BH100', 'BWS70', 'BG825'));
    } else {
        echo "field is already Present --- eq_sr_equip_model in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- Equipment Details -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('Equipment Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('equipment_id', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'equipment_id';
        $field->column = 'equipment_id';
        $field->uitype = 10;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Equipment Serial No.';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(10)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $id = $blockInstance->addFieldIgnite($field);
        echo "created field --- $id ";
        $invogamoduleInstance = Vtiger_Module::getInstance('Equipment');
        $relationLabel  = 'ServiceReports';
        $invogamoduleInstance->setRelatedList(
              $invoiceModule, $relationLabel, Array('ADD'), 'get_dependents_list' //you can do select also Array('ADD','SELECT')
        );
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'ServiceReports', 'Equipment', NULL, NULL)";
        $adb->pquery($tom);
    } else {
        echo "field is present -- equipment_id  in ServiceReports--- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_CUSTOM_INFORMATION in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('FunctionalLocations');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('func_area_name', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'func_area_name';
        $field->column = 'func_area_name';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Area Name';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- func_area_name FunctionalLocations --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_BLOCK_GENERAL_INFORMATION in FunctionalLocations -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('FunctionalLocations');
$blockInstance = Vtiger_Block::getInstance('LBL_BLOCK_GENERAL_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('func_proj_name', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'func_proj_name';
        $field->column = 'func_proj_name';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Project Name';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $field->defaultvalue = 0;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- func_proj_name FunctionalLocations --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_BLOCK_GENERAL_INFORMATION in FunctionalLocations -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('FAILURE_DETAILS', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('fd_eq_sta_bsr', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'fd_eq_sta_bsr';
        $fieldInstance->label = 'Status of Equipment Before SR Generation';
        $fieldInstance->table = $moduleInstance->basetable."cf";
        $fieldInstance->column = 'fd_eq_sta_bsr';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('On Road', 'Off Road', 'Running with Problem'));
    } else {
        echo "field is already Present --- fd_eq_sta_bsr in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- FAILURE_DETAILS -- <br>";
}

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('SER_ENGG_DETAIL', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('badge_no', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'badge_no';
        $field->column = 'badge_no';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable.'cf';
        $field->label = 'Badge Number';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(10)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- badge_no ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- SER_ENGG_DETAIL in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('SER_ENGG_DETAIL', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('ser_eng_name', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'ser_eng_name';
        $field->column = 'ser_eng_name';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Name';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- ser_eng_name in ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- SER_ENGG_DETAIL in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('SER_ENGG_DETAIL', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sr_designaion', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'sr_designaion';
        $fieldInstance->label = 'Designation';
        $fieldInstance->table = $moduleInstance->basetable;
        $fieldInstance->column = 'sr_designaion';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Chairman & Managing Director', 'Director(Mining & Construction Business)', 'Director(Defence Business)','Director','Executive Director','Executive Director','General Manager','Deputy General Manager','Assistant General Manager','Senior Manager','Manager','Assistant Manager','Engineer','Assistant Engineer','Senior Supervisor-S-6','Senior Supervisor-S-5','Senior Supervisor-S-4','Supervisor- S-3','Joint Supervisior-S-2','Deputy Supervisor-S-1','Master Skilled Technician-Gr.-E','High Skilled Technician-Gr.-D','Senior Technician-Gr.-C','Technician-Gr.-B','Helper- Gr-A'));
    } else {
        echo "field is already Present --- sr_designaion in ServiceReports Module --- <br>";
    }
} else {
    echo "Block does not exits --- SER_ENGG_DETAIL -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('SER_ENGG_DETAIL', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('sr_regional_office', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'sr_regional_office';
        $fieldInstance->label = 'Regional Office';
        $fieldInstance->table = $moduleInstance->basetable.'cf';
        $fieldInstance->column = 'sr_regional_office';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Neyveli', 'Sambalpur', 'Kolkata','Dhanbad','Bangalore','Hyderabad','New Delhi','Nagpur'));
    } else {
        echo "field is already Present --- sr_regional_office in ServiceReports Module --- <br>";
    }
} else {
    echo "Block does not exits --- SER_ENGG_DETAIL -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('SER_ENGG_DETAIL', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('dist_off_or_act_cen', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'dist_off_or_act_cen';
        $fieldInstance->label = 'District Office / Activity Centre';
        $fieldInstance->table = $moduleInstance->basetable.'cf';
        $fieldInstance->column = 'dist_off_or_act_cen';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('Neyveli', 'Sambalpur', 'Kolkata','Dhanbad','Bangalore','Hyderabad','New Delhi','Nagpur'));
    } else {
        echo "field is already Present --- dist_off_or_act_cen in ServiceReports Module --- <br>";
    }
} else {
    echo "Block does not exits --- SER_ENGG_DETAIL -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('Equipment Details', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('imagename', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'imagename';
        $field->column = 'imagename';
        $field->uitype = 69;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Upload Image';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(150)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- imagename in ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- Equipment Details in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('VISUAL_CHECKS', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('vis_chk_ext_dam', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'vis_chk_ext_dam';
        $field->column = 'vis_chk_ext_dam';
        $field->uitype = 21;
        $field->table = $invoiceModule->basetable."cf";
        $field->label = 'Remarks';
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(500)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- vis_chk_ext_dam In ServiceReports Module --- <br>";
    }
} else {
    echo "Block Does not exits -- VISUAL_CHECKS -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('VISUAL_CHECKS', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('vis_chk_hyd_air', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'vis_chk_hyd_air';
        $field->column = 'vis_chk_hyd_air';
        $field->uitype = 21;
        $field->table = $invoiceModule->basetable."cf";
        $field->label = 'Remarks';
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(500)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- vis_chk_hyd_air In ServiceReports Module --- <br>";
    }
} else {
    echo "Block Does not exits -- VISUAL_CHECKS -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('VISUAL_CHECKS', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('vis_chk_wrk_los', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'vis_chk_wrk_los';
        $field->column = 'vis_chk_wrk_los';
        $field->uitype = 21;
        $field->table = $invoiceModule->basetable."cf";
        $field->label = 'Remarks';
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(500)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- vis_chk_wrk_los In ServiceReports Module --- <br>";
    }
} else {
    echo "Block Does not exits -- VISUAL_CHECKS -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('VISUAL_CHECKS', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('vis_chk_lub_rem', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'vis_chk_lub_rem';
        $field->column = 'vis_chk_lub_rem';
        $field->uitype = 21;
        $field->table = $invoiceModule->basetable."cf";
        $field->label = 'Remarks';
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(500)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- vis_chk_lub_rem In ServiceReports Module --- <br>";
    }
} else {
    echo "Block Does not exits -- VISUAL_CHECKS -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('VISUAL_CHECKS', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('vis_chk_oil_rem', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'vis_chk_oil_rem';
        $field->column = 'vis_chk_oil_rem';
        $field->uitype = 21;
        $field->table = $invoiceModule->basetable."cf";
        $field->label = 'Remarks';
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(500)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- vis_chk_oil_rem In ServiceReports Module --- <br>";
    }
} else {
    echo "Block Does not exits -- VISUAL_CHECKS -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('VISUAL_CHECKS', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('vis_chk_ext_dam_img', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'vis_chk_ext_dam_img';
        $field->column = 'vis_chk_ext_dam_img';
        $field->uitype = 69;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Upload Image';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(150)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- vis_chk_ext_dam_img in ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- VISUAL_CHECKS in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('VISUAL_CHECKS', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('vis_chk_ext_dam_img', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'vis_chk_ext_dam_img';
        $field->column = 'vis_chk_ext_dam_img';
        $field->uitype = 69;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Upload Image';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(150)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- vis_chk_ext_dam_img in ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- VISUAL_CHECKS in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('VISUAL_CHECKS', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('vis_hyd_air_dam_img', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'vis_hyd_air_dam_img';
        $field->column = 'vis_hyd_air_dam_img';
        $field->uitype = 69;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Upload Image';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(150)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- vis_hyd_air_dam_img in ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- VISUAL_CHECKS in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('VISUAL_CHECKS', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('vis_hyd_wrk_los_img', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'vis_hyd_wrk_los_img';
        $field->column = 'vis_hyd_wrk_los_img';
        $field->uitype = 69;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Upload Image';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(150)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- vis_hyd_wrk_los_img in ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- VISUAL_CHECKS in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('VISUAL_CHECKS', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('vis_lub_los_img', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'vis_lub_los_img';
        $field->column = 'vis_lub_los_img';
        $field->uitype = 69;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Upload Image';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(150)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- vis_lub_los_img in ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- VISUAL_CHECKS in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('VISUAL_CHECKS', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('vis_oil_lev_img', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'vis_oil_lev_img';
        $field->column = 'vis_oil_lev_img';
        $field->uitype = 69;
        $field->table = $invoiceModule->basetable.'cf';
        $field->label = 'Upload Image';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(150)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- vis_oil_lev_img in ServiceReports --- <br>";
    }
} else {
    echo "Block Does not exits -- VISUAL_CHECKS in ServiceReports -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$emm = null;
$emm = new VTEntityMethodManager($adb);
$result = $adb->pquery("SELECT function_name FROM com_vtiger_workflowtasks_entitymethod WHERE module_name=? AND method_name=?", array('ServiceReports', 'SyncToExternalOnSERCreate'));
if ($adb->num_rows($result) == 0) {
    $emm->addEntityMethod("ServiceReports", "SyncToExternalOnSERCreate", "modules/ServiceReports/SyncToExternalOnSERCreate.php", "SyncToExternalOnSERCreate");
} else {
    print_r("already exits --- workflow function -- SyncToExternalOnSERCreate in ServiceReports Module <br> ");
}
$emm = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('ACTION_TAKEN', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('action_taken_block', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'action_taken_block';
        $field->column = 'action_taken_block';
        $field->uitype = 21;
        $field->table = $invoiceModule->basetable."cf";
        $field->label = 'Action Taken';
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(500)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- action_taken_block In ServiceReports Module --- <br>";
    }
} else {
    echo "Block Does not exits -- ACTION_TAKEN -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('ACTION_TAKEN', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('eq_sta_aft_act_taken', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'eq_sta_aft_act_taken';
        $fieldInstance->label = 'eq_sta_aft_act_taken';
        $fieldInstance->table = $moduleInstance->basetable.'cf';
        $fieldInstance->column = 'eq_sta_aft_act_taken';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('On Road', 'Off Road', 'Running with Problem'));
    } else {
        echo "field is already Present --- eq_sta_aft_act_taken in ServiceReports Module --- <br>";
    }
} else {
    echo "Block does not exits --- ACTION_TAKEN -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('ACTION_TAKEN', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('restoration_date', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'restoration_date';
        $fieldInstance->label = 'Restoration Date';
        $fieldInstance->table = $moduleInstance->basetable.'cf';
        $fieldInstance->column = 'restoration_date';
        $fieldInstance->uitype = 5;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'D~O';
        $fieldInstance->columntype = 'DATE';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- restoration_date in ServiceReports Module --- <br>";
    }
} else {
    echo "block does not exits --- ACTION_TAKEN in ServiceReports-- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('ACTION_TAKEN', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('restoration_time', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'restoration_time';
        $fieldInstance->label = 'Restoration Time';
        $fieldInstance->table = $moduleInstance->basetable.'cf';
        $fieldInstance->column = 'restoration_time';
        $fieldInstance->uitype = 14;
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'T~O';
        $fieldInstance->columntype = 'TIME';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
    } else {
        echo "field is already Present --- restoration_time in ServiceReports Module --- <br>";
    }
} else {
    echo " block does not exits --- ACTION_TAKEN -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('ACTION_TAKEN', $moduleInstance);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('off_on_account_of', $moduleInstance);
    if (!$fieldInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = 'off_on_account_of';
        $fieldInstance->label = 'Off Road on Account of';
        $fieldInstance->table = $moduleInstance->basetable.'cf';
        $fieldInstance->column = 'off_on_account_of';
        $fieldInstance->uitype = '16';
        $fieldInstance->presence = '0';
        $fieldInstance->typeofdata = 'V~O';
        $fieldInstance->columntype = 'VARCHAR(100)';
        $fieldInstance->defaultvalue = NULL;
        $blockInstance->addField($fieldInstance);
        $fieldInstance->setPicklistValues(array('BEML', 'CUSTOMER'));
    } else {
        echo "field is already Present --- off_on_account_of in ServiceReports Module --- <br>";
    }
} else {
    echo "Block does not exits --- ACTION_TAKEN -- <br>";
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceReports');
$blockInstance = Vtiger_Block::getInstance('FAILURE_DETAILS', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('remarks_for_offroad', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'remarks_for_offroad';
        $field->column = 'remarks_for_offroad';
        $field->uitype = 21;
        $field->table = $invoiceModule->basetable."cf";
        $field->label = 'Remarks for Off Road';
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(500)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- remarks_for_offroad In ServiceReports Module --- <br>";
    }
} else {
    echo "Block Does not exits -- FAILURE_DETAILS -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceOrders');
$blockInstance = Vtiger_Block::getInstance('LBL_SYSTEM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('ticket_id', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'ticket_id';
        $field->column = 'ticket_id';
        $field->uitype = 10;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Ticket Id';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(30)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $id = $blockInstance->addFieldIgnite($field);
        echo "created field --- $id ";
        $invogamoduleInstance = Vtiger_Module::getInstance('HelpDesk');
        $relationLabel  = 'ServiceOrders';
        $invogamoduleInstance->setRelatedList(
              $invoiceModule, $relationLabel, Array('ADD'), 'get_dependents_list' //you can do select also Array('ADD','SELECT')
        );
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'ServiceOrders', 'HelpDesk', NULL, NULL)";
        $adb->pquery($tom);
    } else {
        echo "field is present -- ticket_id  in ServiceOrders--- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_SYSTEM_INFORMATION in ServiceOrders -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('ServiceOrders');
$blockInstance = Vtiger_Block::getInstance('LBL_SYSTEM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('external_app_num', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'external_app_num';
        $field->column = 'external_app_num';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'SAP Reference Number';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 2;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- external_app_num in ServiceOrders --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_SYSTEM_INFORMATION in ServiceOrders -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('StockTransferOrders');
$blockInstance = Vtiger_Block::getInstance('LBL_STO_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('collective_no', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'collective_no';
        $field->column = 'collective_no';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Collective No.';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- collective_no in StockTransferOrders --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_STO_INFORMATION in StockTransferOrders -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('StockTransferOrders');
$blockInstance = Vtiger_Block::getInstance('LBL_STO_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('your_ref', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'your_ref';
        $field->column = 'your_ref';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Your Reference';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(150)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- your_ref in StockTransferOrders --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_STO_INFORMATION in StockTransferOrders -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('StockTransferOrders');
$blockInstance = Vtiger_Block::getInstance('LBL_STO_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('our_ref', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'our_ref';
        $field->column = 'our_ref';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Our Reference';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(150)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- our_ref in StockTransferOrders --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_STO_INFORMATION in StockTransferOrders -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('StockTransferOrders');
$blockInstance = Vtiger_Block::getInstance('LBL_STO_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('plant_name', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'plant_name';
        $field->column = 'plant_name';
        $field->uitype = 10;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Supplying Plant';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(30)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $id = $blockInstance->addFieldIgnite($field);
        echo " created field --- $id ";
        $invogamoduleInstance = Vtiger_Module::getInstance('MaintenancePlant');
        $relationLabel  = 'Stock Transfer Orders';
        $invogamoduleInstance->setRelatedList(
              $invoiceModule, $relationLabel, Array('ADD'), 'get_dependents_list' //you can do select also Array('ADD','SELECT')
        );
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'StockTransferOrders', 'MaintenancePlant', NULL, NULL)";
        $adb->pquery($tom);
    } else {
        echo "field is present -- plant_name  in StockTransferOrders--- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_STO_INFORMATION in StockTransferOrders -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$emm = null;
$emm = new VTEntityMethodManager($adb);
$result = $adb->pquery("SELECT function_name FROM com_vtiger_workflowtasks_entitymethod WHERE module_name=? AND method_name=?", array('StockTransferOrders', 'SyncToExternalOnSTOCreate'));
if ($adb->num_rows($result) == 0) {
    $emm->addEntityMethod("StockTransferOrders", "SyncToExternalOnSTOCreate", "modules/StockTransferOrders/SyncToExternalOnSTOCreate.php", "SyncToExternalOnSTOCreate");
} else {
    print_r("already exits --- workflow function -- SyncToExternalOnSTOCreate in StockTransferOrders Module <br> ");
}
$emm = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('StockTransferOrders');
$blockInstance = Vtiger_Block::getInstance('LBL_STO_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('external_app_num', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'external_app_num';
        $field->column = 'external_app_num';
        $field->uitype = 2;
        $field->table = $invoiceModule->basetable;
        $field->label = 'SAP Reference Number';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'V~O';
        $field->columntype = 'VARCHAR(250)';
        $field->quickcreate = 3;
        $field->displaytype = 2;
        $field->masseditable = 1;
        $blockInstance->addField($field);
    } else {
        echo "field is present -- external_app_num in StockTransferOrders --- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_STO_INFORMATION in StockTransferOrders -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('StockTransferOrders');
$blockInstance = Vtiger_Block::getInstance('LBL_STO_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('rec_plant_name', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'rec_plant_name';
        $field->column = 'rec_plant_name';
        $field->uitype = 10;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Receiving Plant';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(30)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $id = $blockInstance->addFieldIgnite($field);
        echo " created field --- $id ";
        // $invogamoduleInstance = Vtiger_Module::getInstance('MaintenancePlant');
        // $relationLabel  = 'Stock Transfer Orders';
        // $invogamoduleInstance->setRelatedList(
        //       $invoiceModule, $relationLabel, Array('ADD'), 'get_dependents_list' //you can do select also Array('ADD','SELECT')
        // );
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'StockTransferOrders', 'MaintenancePlant', NULL, NULL)";
        $adb->pquery($tom);
    } else {
        echo "field is present -- rec_plant_name  in StockTransferOrders--- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_STO_INFORMATION in StockTransferOrders -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;
$invoiceModule = Vtiger_Module::getInstance('StockTransferOrders');
$blockInstance = Vtiger_Block::getInstance('LBL_SYSTEM_INFORMATION', $invoiceModule);
if ($blockInstance) {
    $fieldInstance = Vtiger_Field::getInstance('servicereport_id', $invoiceModule);
    if (!$fieldInstance) {
        $field = new Vtiger_Field();
        $field->name = 'servicereport_id';
        $field->column = 'servicereport_id';
        $field->uitype = 10;
        $field->table = $invoiceModule->basetable;
        $field->label = 'Service Report Number';
        $field->summaryfield = 1;
        $field->readonly = 1;
        $field->presence = 2;
        $field->typeofdata = 'I~O';
        $field->columntype = 'INT(30)';
        $field->quickcreate = 3;
        $field->displaytype = 1;
        $field->masseditable = 1;
        $id = $blockInstance->addFieldIgnite($field);
        echo " created field --- $id ";
        $invogamoduleInstance = Vtiger_Module::getInstance('ServiceReports');
        $relationLabel  = 'StockTransferOrders';
        $invogamoduleInstance->setRelatedList(
              $invoiceModule, $relationLabel, Array('ADD'), 'get_dependents_list' //you can do select also Array('ADD','SELECT')
        );
        $tom = "INSERT INTO `vtiger_fieldmodulerel` (`fieldid`, `module`, `relmodule`, `status`, `sequence`) VALUES ('$id', 'StockTransferOrders', 'ServiceReports', NULL, NULL)";
        $adb->pquery($tom);
    } else {
        echo "field is present -- servicereport_id  in StockTransferOrders--- <br>";
    }
} else {
    echo "Block Does not exits -- LBL_SYSTEM_INFORMATION in StockTransferOrders -- <br>";
}
$invoiceModule = null;
$blockInstance = null;
$fieldInstance = null;

$emm = null;
$emm = new VTEntityMethodManager($adb);
$result = $adb->pquery("SELECT function_name FROM com_vtiger_workflowtasks_entitymethod WHERE module_name=? AND method_name=?", array('Products', 'ProductsExternalAppSyncUpdated'));
if ($adb->num_rows($result) == 0) {
    $emm->addEntityMethod("Products", "ProductsExternalAppSyncUpdated", "modules/Products/ProductsExternalAppSyncUpdated.php", "ProductsExternalAppSyncUpdated");
} else {
    print_r("already exits --- workflow function -- ProductsExternalAppSyncUpdated in Products Module <br> ");
}
$emm = null;