<?php
/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Public License Version 1.1.2
 * ("License"); You may not use this file except in compliance with the 
 * License. You may obtain a copy of the License at http://www.sugarcrm.com/SPL
 * Software distributed under the License is distributed on an  "AS IS"  basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License for
 * the specific language governing rights and limitations under the License.
 * The Original Code is:  SugarCRM Open Source
 * The Initial Developer of the Original Code is SugarCRM, Inc.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.;
 * All Rights Reserved.
 * Contributor(s): ______________________________________.
********************************************************************************/

// Adjust error_reporting favourable to deployment.
version_compare(PHP_VERSION, '5.5.0') <= 0 ? error_reporting(E_WARNING & ~E_NOTICE & ~E_DEPRECATED & E_ERROR) : error_reporting(E_WARNING & ~E_NOTICE & ~E_DEPRECATED  & E_ERROR & ~E_STRICT); // PRODUCTION
//ini_set('display_errors','on'); version_compare(PHP_VERSION, '5.5.0') <= 0 ? error_reporting(E_WARNING & ~E_NOTICE & ~E_DEPRECATED) : error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);   // DEBUGGING
// ini_set('display_errors','on'); error_reporting(E_ALL); // STRICT DEVELOPMENT


include('vtigerversion.php');

// more than 8MB memory needed for graphics
// memory limit default value = 64M
ini_set('memory_limit','512M');
// ini_set('session.cookie_secure', '1');
// ini_set('session.cookie_httponly', '1');
// ini_set('session.use_only_cookies', 1);  // Prevent session ID in URL
// ini_set('session.use_strict_mode', 1);   // Refuse uninitialized IDs
// ini_set('session.sid_length', 64);
// ini_set('session.sid_bits_per_character', 6);
// ini_set('session.hash_function', 'sha256');
// ini_set('session.gc_maxlifetime', 900);
// ini_set('session.cookie_domain', '');  // Leave empty or set to your domain
// ini_set('session.cookie_path', '/');


// show or hide calendar, world clock, calculator, chat and CKEditor 
// Do NOT remove the quotes if you set these to false! 
$CALENDAR_DISPLAY = 'true';
$USE_RTE = 'true';

// helpdesk support email id and support name (Example: 'support@vtiger.com' and 'vtiger support')
$HELPDESK_SUPPORT_EMAIL_ID = 'cchs_crm@outlook.com';
$HELPDESK_SUPPORT_NAME = 'BEML SUPPORT';
$HELPDESK_SUPPORT_EMAIL_REPLY_ID = $HELPDESK_SUPPORT_EMAIL_ID;

// Pincode database
$pincodeDatabaseName = 'pincode';
$pincodeDatabaseUser = 'vtiger';
$pincodeDatabaseNamePassword = 'Belcome@123';

$dbconfig['db_server'] = 'localhost';
$dbconfig['db_port'] = ':3306';
$dbconfig['db_username'] = 'root';
$dbconfig['db_password'] = 'Belcome@123';
$dbconfig['db_name'] = 'bemlquality';
$dbconfig['db_type'] = 'mysqli';
$dbconfig['db_status'] = 'true';
$smsEndPoint = 'https://digimate.airtel.in:15443/BULK_API/SendMessage';
// TODO: test if port is empty
// TODO: set db_hostname dependending on db_type
$dbconfig['db_hostname'] = $dbconfig['db_server'].$dbconfig['db_port'];

// log_sql default value = false
$dbconfig['log_sql'] = false;

// persistent default value = true
$dbconfigoption['persistent'] = true;

// autofree default value = false
$dbconfigoption['autofree'] = false;

// debug default value = 0
$dbconfigoption['debug'] = 0;

// seqname_format default value = '%s_seq'
$dbconfigoption['seqname_format'] = '%s_seq';

// portability default value = 0
$dbconfigoption['portability'] = 0;

// ssl default value = false http://3.110.197.233/dashboard/
$dbconfigoption['ssl'] = false;

$host_name = $dbconfig['db_hostname'];

//$site_URL = 'http://crm.bemlindia.in/bemlqualitynew';
// $site_URL = '';
// $site_URL_NonHttp = '';
// if($_SERVER['HTTP_HOST'] == 'crm.bemlindia.in') {
// 	$site_URL = 'https://'. $_SERVER['HTTP_HOST'] .'/bemlqualitynew/';
// 	$site_URL_NonHttp = 'http://'. $_SERVER['HTTP_HOST'] .'/bemlqualitynew/';
// } else {
// 	$site_URL = 'http://'. $_SERVER['HTTP_HOST'] .'/bemlqualitynew/';
// 	$site_URL_NonHttp = 'http://'. $_SERVER['HTTP_HOST'] .'/bemlqualitynew/';
// }
// $site_URL_Another = 'https://crm.bemlindia.in/bemlqualitynew/';
// // url for customer portal (Example: http://vtiger.com/portal)
// $PORTAL_URL = $site_URL.'customerportal';
// // root directory path
// $root_directory = '/var/www/html/bemlqualitynew/';
// ini_set('session.save_path', $root_directory.'igSession/');


$site_URL_NonHttp = '';
$host_name = $dbconfig['db_hostname'];
if($_SERVER['HTTP_HOST'] == 'crm.beml.in') {
    $site_URL = 'https://'. $_SERVER['HTTP_HOST'] .'/bemlquality/';
    $site_URL_NonHttp = 'http://'. $_SERVER['HTTP_HOST'] .'/bemlquality/';
} else {
    $site_URL = 'http://'. $_SERVER['HTTP_HOST'] .'/bemlquality/';
	$site_URL_NonHttp = 'http://'. $_SERVER['HTTP_HOST'] .'/bemlquality/';
}

// url for customer portal (Example: http://vtiger.com/portal)
$PORTAL_URL = $site_URL.'customerportal1';
// root directory path
$root_directory = 'C:/wamp64/www/bemlquality/';//'/home2/bitechnosys/democrm.crm-doctor.com/armstrongnew/';
// ini_set('session.save_path', $root_directory.'/igSession/');


// cache direcory path
$cache_dir = 'cache/';

// tmp_dir default value prepended by cache_dir = images/
$tmp_dir = 'cache/images/';

// import_dir default value prepended by cache_dir = import/
$import_dir = 'cache/import/';

// upload_dir default value prepended by cache_dir = upload/
$upload_dir = 'cache/upload/';

// maximum file size for uploaded files in bytes also used when uploading import files
// upload_maxsize default value = 3000000
$upload_maxsize = 41943040;//3MB

// flag to allow export functionality
// 'all' to allow anyone to use exports 
// 'admin' to only allow admins to export 
// 'none' to block exports completely 
// allow_exports default value = all
$allow_exports = 'all';

// files with one of these extensions will have '.txt' appended to their filename on upload
// upload_badext default value = php, php3, php4, php5, pl, cgi, py, asp, cfm, js, vbs, html, htm
$upload_badext = array('php', 'php3', 'php4', 'php5', 'pl', 'cgi', 'py', 'asp', 'cfm', 'js', 'vbs', 'html', 'htm', 'exe', 'bin', 'bat', 'sh', 'dll', 'phps', 'phtml', 'xhtml', 'rb', 'msi', 'jsp', 'shtml', 'sth', 'shtm');

// list_max_entries_per_page default value = 20
$list_max_entries_per_page = '10';

// history_max_viewed default value = 5
$history_max_viewed = '5';

// default_action default value = index
$default_action = 'index';

// set default theme
// default_theme default value = blue
$default_theme = 'softed';

// default text that is placed initially in the login form for user name
// no default_user_name default value
$default_user_name = '';

// default text that is placed initially in the login form for password
// no default_password default value
$default_password = '';

// create user with default username and password
// create_default_user default value = false
$create_default_user = false;

//Master currency name
$currency_name = 'USA, Dollars';

// default charset
// default charset default value = 'UTF-8' or 'ISO-8859-1'
$default_charset = 'UTF-8';

// default language
// default_language default value = en_us
$default_language = 'en_us';

//Option to hide empty home blocks if no entries.
$display_empty_home_blocks = false;

//Disable Stat Tracking of vtiger CRM instance
$disable_stats_tracking = false;

// Generating Unique Application Key
$application_unique_key = 'cc7ec50939910345c769fbf0a10e39dc';

// trim descriptions, titles in listviews to this value
$listview_max_textlength = '100';

// Maximum time limit for PHP script execution (in seconds)
$php_max_execution_time = 0;

// Set the default timezone as per your preference
$default_timezone = 'UTC';

/** If timezone is configured, try to set it */
if(isset($default_timezone) && function_exists('date_default_timezone_set')) {
	@date_default_timezone_set($default_timezone);
}

//Set the default layout 
$default_layout = 'v7';

include_once 'config.security.php';
$currentAppVersion = '1.0.0';
?>
