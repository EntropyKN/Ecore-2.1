<?php
//error_reporting(E_ERROR  | E_PARSE ); //| E_WARNING
//error_reporting(E_ALL ^ E_NOTICE);ini_set("display_errors",1); 

############### DATABASE CONFIG
define("DB_HOST", "localhost");
define("DB_USERNAME", "ENTER HERE");
define("DB_PASSWORD", 'ENTER HERE');
define("DB_NAME", "ENTER HERE");

############### PATH CONFIGURATION:
/*
ex: the platform will be on https://www.domain.com/directory
$serverRoot="/home/www/etc/etc/directory/"; // DON'T FORGET the final slash
$serverDir="/directory/"; // MUST CONTAIN 2 slashes
*/

$serverRoot="/home/vgentrop/test.entropylearningplatform.it/";
$serverDir="/elseFiles/";

/*
The following directories have to be WRITEBLE (chmode 777):
data/audio/
data/attachments/

*/

##############  DO NOT TOUCH ABOVE
define("C_ROOT", str_replace("//", "/", $serverRoot.$serverDir));
define("C_DIR", $serverDir);
define("C_DIRNS", trim( C_DIR,"/"));

define("C_AUDIOKEY", "kvfbSITh");


session_start();

//////////////////////////////////////////////////////////////////////////////////////

define("PAGE_RANDOM",md5(time()));
require_once(C_ROOT."/config/function.common.inc.php");
$conni=conni();

define ("C_TIME",time());
//define ("CDEVIP","93.41.108.103");

define ("COVERPATH","data/covers/");
define ("AUDIOPATH","data/audio/");
define ("AVATARPATH","data/avatar_prev/1/");
define ("SCENARIOPATH","data/scenarios/");


?>