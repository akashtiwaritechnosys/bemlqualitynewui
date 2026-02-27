<?php

/*+********************************************************************************
 * The content of this file is subject to the Reports 4 You license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ********************************************************************************/

// __construct process checkPermission editLicense deactivateLicense checkLicense checkURL getCompanyInfo getURL getUserKey

//$adb=  PearDatabase::getInstance();$adb->setDebug(true);
define("FOR_MODULE","ITS4YouReports");
define("MODULE_INITIALS","RP");
define("RP_TYPE","professional");

class ITS4YouReports_License_Action extends Vtiger_Action_Controller {

    function __construct() {
        parent::__construct();
        $this->exposeMethod("deactivateLicense");
        $this->exposeMethod("editLicense");
    }

    function checkPermission(Vtiger_Request $request) {
      return;
    }
    
    function process(Vtiger_Request $request) {
        $mode = $request->get("mode");

        if(!empty($mode)) {
                $this->invokeExposedMethod($mode, $request);
                return;
        }
    }

    public function editLicense(Vtiger_Request $request) {
        require_once("libraries/nusoap/nusoap.php");

        $sl = "soap_log"; 
        global $$sl; 
        if (!$$sl) $$sl = LoggerManager::getLogger("SOAP");
        
        $ITS4YouReports = new ITS4YouReports_Module_Model();
        
        $t = "type";
        $r_type = $request->get($t);
        $l = "licensekey";
        $key = $request->get($l);
        
        $url = $this->getCheckString(RP_TYPE);
        
        $soapurl = "http://www.its4you.sk/ITS4YouWS/ITS4YouWS_3.php";

        if (class_exists("soapclient2")) {

          $client = new soapclient2($soapurl, false);
          $client->soap_defencoding = "UTF-8";
          $err = $client->getError();

          if ($err == false) {
              $validate = "";
              //$type = $request->get("type");
              if ($key != "") {
                  $validate = $this->controlITS4YouReportsVersion($r_type,$key,$client,$type, $url);
              }
              if ($validate == "validated") {
                  $this->setLicense( RP_TYPE, $key, $url );

                  $result = array("success"=>true,"message"=>vtranslate("REACTIVATE_SUCCESS", FOR_MODULE),"licensekey" => $key);
              }
              else {
                  if (trim($validate) != "" && trim($validate) != "invalidated" && trim($validate) != "validate_err")
                      $result = array("success"=>false,"message"=>$validate);
                  else
                      $result = array("success"=>false,"message"=>vtranslate("LBL_INVALID_KEY", FOR_MODULE));
              }
          } else {
              $result = array("success"=>false,"message"=>vtranslate("LBL_VALIDATION_ERROR", FOR_MODULE));
          }
        } else {
            $result = array("success"=>false,"message"=>vtranslate("LBL_CLASS_SOAPCLIENT2_DOES_NOT_EXIST", FOR_MODULE));
        }

        $response = new Vtiger_Response();
        try {
            $response->setResult($result);
        } catch (Exception $e) {
            $response->setError($e->getCode(), $e->getMessage());
        }
        $response->emit();
    }
    
    private function setLicense( $type, $key, $url ) {
      $adb = vglobal("adb");
      $v = "vtiger_current_version";
      $vcv = vglobal($v);
        
      $lic_inf = $this->getLicenseInfo(substr($type,0,4), $key);
                  
      $adb->pquery("DELETE FROM  its4you_reports4you_license",Array());
      $adb->pquery("INSERT INTO  its4you_reports4you_license VALUES(?,?,?)",Array($type,$key,$lic_inf));

      $adb->pquery("DELETE FROM its4you_reports4you_version WHERE version=?", Array($vcv));
      $adb->pquery("INSERT INTO its4you_reports4you_version VALUES (?,?)", Array($vcv,$url));
    }
    
    public function deactivateLicense(Vtiger_Request $request) {
        $adb = PearDatabase::getInstance();

        $error = "";
        $currentUserModel = Users_Record_Model::getCurrentUserModel();
        if($currentUserModel->isAdminUser()) {

            require_once("libraries/nusoap/nusoap.php");

          $sl = "soap_log"; 
          global $$sl; 
          if (!$$sl) $$sl = LoggerManager::getLogger("SOAP");

          $ITS4YouReports = new ITS4YouReports_ITS4YouReports_Model();

        $v = "vtiger_current_version";
          $vcv = vglobal($v);
          $s = "site_URL";
          $salt = vglobal($s);
          $val_str = "its4you_validated_ok";

          $soapurl = "http://www.its4you.sk/ITS4YouWS/ITS4YouWS_3.php";
          
          if (class_exists("soapclient2")) {
            $client = new soapclient2($soapurl, false);
            $client->soap_defencoding = "UTF-8";
            $err = $client->getError();

            if ($err == false) {
                $validate = "validate_err";

                $version_type = $ITS4YouReports->GetVersionType();
                $license_key = $ITS4YouReports->GetLicenseKey();

                $url = $this->getCheckString(RP_TYPE);
// oldo
                if($version_type == "professional" OR $version_type == "basic") {
                    $key = $request->get("key");
                    $type = $request->get("type");
                    if (isset($type) && $type == "control") {

                        if ($key != "") $validate = $this->controlITS4YouReportsVersion("deactivate",$key,$client,$version_type, $url, "control");
                        if ($validate != "validated") {
                            $result = array("success"=>false,"deactivate"=>vtranslate("LBL_INVALID_KEY", FOR_MODULE));
                        }
                        else
                        {
                            $result = array("success"=>true,"deactivate"=>"ok");
                        }
                    } else {

                        if ($key != "") $deactivate = $this->controlITS4YouReportsVersion("deactivate",$key,$client,$version_type, $url, "deactivate");

                        if ($deactivate == "validated") {
                            $adb->pquery("DELETE FROM its4you_reports4you_license",Array());
                            $adb->pquery("INSERT INTO its4you_reports4you_license VALUES(?,?,?)",Array("deactivate","",""));

                            $adb->pquery("UPDATE its4you_reports4you_version SET license=? WHERE version=?", Array($deactivate,$vcv));

                            $result = array("success"=>true,"deactivate"=>vtranslate("LBL_DEACTIVATE_SUCCESS", FOR_MODULE));
                        } else {
                            if (trim($validate) != "" && trim($deactivate) != "invalidated" && trim($deactivate) != "validate_err")
                                $result = array("success"=>false,"message"=>$deactivate);
                            else
                                $result = array("success"=>false,"message"=>vtranslate("LBL_INVALID_KEY", FOR_MODULE));
                        }
                    }
                } else {
                    $result = array("success"=>false,"deactivate"=>vtranslate("LBL_DEACTIVATE_ERROR", FOR_MODULE));
                }
            } else {
                $result = array("success"=>false,"deactivate"=>vtranslate("LBL_DEACTIVATE_ERROR", FOR_MODULE));
            }
              } else {
                $error = vtranslate("LBL_CLASS_SOAPCLIENT2_DOES_NOT_EXIST", FOR_MODULE);
            }

        } else {
            $error = vtranslate("LBL_PERMISSION_DENIED", "Vtiger");
        }

        
        $response = new Vtiger_Response();
        try {
            $response->setResult($result);
        } catch (Exception $e) {
            $response->setError($e->getCode(), $e->getMessage());
        }
        $response->emit();
    }
    
    public function checkLicense() {
        $adb = PearDatabase::getInstance();
            
        $result = $adb->pquery("SELECT version_type,license_key , license_info FROM its4you_reports4you_license", Array());
        $db_licinfo = $adb->query_result($result, 0, "license_info");

        $db_key = $adb->query_result($result, 0, "license_key");
        $version_type = $adb->query_result($result, 0, "version_type");
        $type = substr($version_type,0,4);
        
        $DB_Licinfo = explode(";", $db_licinfo);
        
        if(!$result )
        {
          return 4;
        }
        $mismatch = 0;
        if( !$this->checkURL() )
        {
          $mismatch += 1;
        }
        if($DB_Licinfo[0] != $this->getCompanyInfo($type, $db_key))
        {
          $mismatch += 1;
        }
        if($DB_Licinfo[1] != $this->getUserKey($type, $db_key))
        {
          $mismatch += 1;
        }
        return MODULE_INITIALS.$mismatch.substr($version_type, 0, 4);
    }
    
    public function checkURL() {
        $adb = PearDatabase::getInstance();
        $n = "vtiger_current_version";
        $vcv = vglobal($n);
        
        $result = $adb->pquery("SELECT license FROM its4you_reports4you_version WHERE version=?", Array($vcv));
        $db_lic = $adb->query_result($result, 0, "license");
        
        $result = $adb->pquery("SELECT version_type FROM its4you_reports4you_license", Array());
        $version_type = $adb->query_result($result, 0, "version_type");
        
        $lic = $this->getCheckString($version_type);
        
        if(!$result )
        {
          return false;
        }
        if($db_lic != $lic )
        {
          return false;
        }
        return true;
    }

    private function controlITS4YouReportsVersion($call_type, $key, $client, $type, $url, $mode = "") {

        $control = str_replace(" ", "_", ITS4YouReports_Version_Helper::getVersion());
        $v = "vtiger_current_version";
        $vcv = vglobal($v);
        $time = time();
        
        if ($call_type == "deactivate")
        {
            $params = array("key" => $key,
                "type" => $type,
                "vtiger" => $vcv,
                "module" => FOR_MODULE,
                "mode" => $control,
                "url" => $url,
                "vmode" => $mode,
                "time" => $time);
        } 
        else
        {    
            $params = array("key" => $key,
            "type" => $type,
            "vtiger" => $vcv,
            "module" => FOR_MODULE,
            "mode" => $control,
            "url" => $url,
            "time" => $time);
        }
        $validate = $client->call($call_type."_license", $params);
        
        if (!$validate) {
            $validate = $client->getError();    
        } else {    

            if ($validate != "invalidated" && $validate != "validate_err" && $validate != "") {
                $V = explode("_", $validate);
                $validate = "invalidated";

                $minus = date("y6Y",$time);
                $url_len = strlen($url);
                $type_len = strlen(RP_TYPE);

                $kontrola = $minus;
                $kontrola -= $time;
                $kontrola -= ($type_len + $url_len);
                if ($V[1] == abs($kontrola))
                    $validate = $V[0];
            }
        }

        return $validate;
    }
    
    private function getCheckString( $type )
    {
      $vti = "vti6";
      return md5( MODULE_INITIALS.md5($type."/".$this->getURL().$vti) );
    }
    
    private function getLicenseInfo($type, $key)
    {
      return $this->getCompanyInfo($type, $key).";".$this->getUserKey($type, $key);
    }
    
    private function getCompanyInfo($type, $key)
    {
      $tabid = getTabid(FOR_MODULE);
      $company_details = Vtiger_CompanyDetails_Model::getInstanceById();
      $comp = "comp:";
      $org = "organizationname";
      $company = $company_details->get($org);

      return md5(MODULE_INITIALS.$type.$tabid.$comp.$company.$key);
    }
    
    private function getURL()
    {
      $s = "site_URL";
      $web = "web:";
      return md5(MODULE_INITIALS.$web.vglobal($s));
    }
    
    private function getUserKey($type, $key)
    {
      $tabid = getTabid(FOR_MODULE);
      $dir="user_privileges/user_privileges_";
      $acc="";
      foreach (glob($dir."*.php") as $file) 
      {
        $user_id = substr($file,32,-4);

        if(is_file($dir.$user_id.".php")) 
        { 
          $user = new Users();
          $user->retrieveCurrentUserInfoFromFile($user_id);

          if(isset($user->column_fields["accesskey"]) && $user->column_fields["accesskey"] != "")
          {
            $acc = $user->column_fields["accesskey"];
            break;
          }
        }
      }

      if( $acc == '' )
      {
        $active_user = Users::getActiveAdminUser();
        $acc = $active_user->column_fields["user_name"];
      }
      return md5(MODULE_INITIALS.$type.$tabid.$txt.$acc.$key);
    }
}