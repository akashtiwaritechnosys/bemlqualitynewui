<?php

/* +********************************************************************************
 * The content of this file is subject to the Reports 4 You license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ****************************************************************************** */

class ITS4YouReports_CronExport_Model extends Vtiger_Base_Model
{
    protected static function getDb()
    {
        return PearDatabase::getInstance();
    }

    public static function saveRequest($reportId, $userId, $type)
    {
        $checkResult = self::getDb()->pquery(
            '
            SELECT id 
            FROM its4you_reports4you_cron_export 
            WHERE reportid = ?
              AND userid=?
              AND type=? 
              AND status=0 
        ',
            [
                $reportId,
                $userId,
                $type
            ]
        );

        if (!self::getDb()->num_rows($checkResult)) {
            self::getDb()->pquery(
                'INSERT INTO its4you_reports4you_cron_export (reportid, userid, type) 
                                   VALUES (?,?,?)',
                [
                    [$reportId, $userId, $type]
                ]
            );
        }
    }

    public static function updateStatusDone($reportId, $userId)
    {
        self::getDb()->pquery(
            'UPDATE its4you_reports4you_cron_export 
                    SET status=? 
                    WHERE reportid=? 
                      AND userid=?',
            [
                [1, $reportId, $userId]
            ]
        );
    }

    public static function getAll()
    {
        $result = self::getDb()->pquery(
            '
            SELECT *
            FROM its4you_reports4you_cron_export 
            WHERE status=? 
                ORDER BY userid, reportid
        ',
            [
                0
            ]
        );

        $reports = [];
        while ($row = self::getDb()->fetchByAssoc($result)) {
            if (!in_array($row['type'], $reports[$row['userid']][$row['reportid']])) {
                $reports[$row['userid']][$row['reportid']][] = $row['type'];
            }
        }

        return $reports;
    }
}
