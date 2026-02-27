<?php

/*+********************************************************************************
 * The content of this file is subject to the Reports 4 You license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ********************************************************************************/

class ITS4YouReports_XlsCurrencyColumn_Config
{

    public static function showXlsCurrencyColumn()
    {
        $restrictedUsersFilePath = 'modules/ITS4YouReports/configs/env/XlsCurrencyColumn';
        $showXlsCurrencyColumn = 1;

        if (file_exists($restrictedUsersFilePath)) {
            $showXlsCurrencyColumn = intval(file_get_contents($restrictedUsersFilePath));
        }

        return $showXlsCurrencyColumn;
    }
}
