<?php

/*+********************************************************************************
 * The content of this file is subject to the Reports 4 You license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ********************************************************************************/

class ITS4YouReports_TabularCalculations_Config
{

    public static function avgUseEmptyRowsCount()
    {
        $restrictedUsersFilePath = 'modules/ITS4YouReports/configs/env/UseEmptyRowsCount';
        $useEmptyRowsCount = 1;

        if (file_exists($restrictedUsersFilePath)) {
            $useEmptyRowsCount = intval(file_get_contents($restrictedUsersFilePath));
        }

        return $useEmptyRowsCount;
    }
}
