<?php

/*+********************************************************************************
 * The content of this file is subject to the Reports 4 You license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ********************************************************************************/

class ITS4YouReports_GeoLocationsLatLong_Helper {

    private static $db = null;
    private static $tableName = 'its4you_reports_geolocations';

    public $latitude = null;
    public $longitude = null;

    /**
     * ITS4YouReports_GeoLocationsLatLong_Helper constructor.
     */
    public function __construct() {
        self::$db = PearDatabase::getInstance();
    }

    /**
     * @param string $locationText
     *
     * @return ITS4YouReports_GeoLocationsLatLong_Helper|null
     */
    public static function getInstance($locationText = '') {
        $returnGeoLatLongObj = null;

        if (!empty($locationText)) {
            $getLatLongObj = new self();
            if (!empty($getLatLongObj->loadLatLong($locationText))) {
                $returnGeoLatLongObj = $getLatLongObj;
            }
        }

        return $returnGeoLatLongObj;
    }

    /**
     * @return string
     */
    private static function getSelectLatLongQuery() {
        return sprintf('SELECT latitude, longitude FROM %s WHERE location_text=?', self::$tableName);
    }

    /**
     * @return string
     */
    private static function getInsertLatLongQuery() {
        return sprintf('INSERT INTO %s (`location_text`, `latitude`, `longitude`) VALUES (?, ?, ?)', self::$tableName);
    }

    /**
     * @return string
     */
    private static function getUpdateLatLongQuery() {
        return sprintf('UPDATE %s SET `latitude`=?, `longitude`=? WHERE location_text=?', self::$tableName);
    }

    /**
     * @param $locationText
     *
     * @return array
     */
    private function loadLatLong($locationText) {
        if (!empty($locationText)) {
            $result = self::$db->pquery(self::getSelectLatLongQuery(), [$locationText]);

            if ($result && self::$db->num_rows($result)) {
                $row = self::$db->fetchByAssoc($result, 0);
                $this->setLat($row['latitude']);
                $this->setLong($row['longitude']);
            }
        }
        return self::getLatLong();
    }

    /**
     * @param $locationText
     * @param $latitude
     * @param $longitude
     *
     * @return ITS4YouReports_GeoLocationsLatLong_Helper
     * @throws Exception
     */
    public static function saveLatLong($locationText, $latitude, $longitude) {
        $geoLatLongObj = new self();

        if (!empty($locationText)) {
            $geoLatLongObj->setLat($latitude);
            $geoLatLongObj->setLong($longitude);

            try {
                $loaded = $geoLatLongObj->loadLatLong($locationText);
//                self::$db->setDebug(1);

                if (!empty($loaded) && 2 === ITS4YouReports_Functions_Helper::count($loaded->getLatLong) && $latitude != $loaded->getLatLong[0] && $longitude != $loaded->getLatLong[1]) {
                    self::$db->pquery(self::getUpdateLatLongQuery(), [$latitude, $longitude, $locationText]);
                } else {
                    self::$db->pquery(self::getInsertLatLongQuery(), [$locationText, $latitude, $longitude]);
                }
//                self::$db->setDebug(0);
            } catch (Exception $e) {
                throw new Exception('saveLatLong: ' . self::$db->convert2Sql(self::getInsertLatLongQuery(), [$locationText, $latitude, $longitude, $locationText]) . PHP_EOL . $e->getMessage());
            }
        }

        return $geoLatLongObj;
    }

    /**
     * @param null $latitude
     */
    public function setLat($latitude) {
        $this->latitude = $latitude;
    }

    /**
     * @param null $longitude
     */
    public function setLong($longitude) {
        $this->longitude = $longitude;
    }

    /**
     * @return array
     */
    public function getLatLong() {
        $return = [];

        if ('' !== (string) $this->latitude && '' !== (string) $this->longitude) {
            $return = [$this->latitude, $this->longitude];
        }

        return $return;
    }

}
