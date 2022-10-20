<?php
include_once("config/config.inc.php");

if ($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || $_SERVER['HTTPS'] == 'on') {$protocal = 'https';}else{$protocal = 'http';}
if (!$protocal) $protocal = 'http';
//define(C_PROTOCAL, "".$protocal);
/*
if ($protocal!="https") {
	echo ("This is site need an SSL certificate (https)");//, try to call  it at 
	exit();
	die();
}
*/


$page=array();


#### COMMON CSS & JS
$CSSA=array();$JSA=array();
//$CSSA[]="http://fonts.googleapis.com/css?family=Open+Sans"; //:Open+Sans+Condensed:700,300 400,300,700
$CSSA[]=''.C_DIR.'/css/base.css?'.PAGE_RANDOM;
$CSSA[]=''.C_DIR.'/css/mobileOFF.css';


$JSA[]=$protocal.'://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js?a';

//$JSA[]='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js';

if (!$_COOKIE["cookieLaw"]) { //!$_COOKIE["cookieLaw"] && 
	$JSA[]=''.C_DIR.'/js/plugins/jquery.cookie.js';
	$JSA[]=''.C_DIR.'/_m/cookie_law/cookieLaw.js';
	$CSSA[]=''.C_DIR.'/_m/cookie_law/cookieLaw.css';
}




#### GET RIGHT PAGE

///  DIR METHOD

$URLcall=( $_SERVER['REQUEST_URI']);// urldecode
$URLcall= str_replace("%2F", "/",$URLcall);
$URLcall= str_replace("/?/", "/?",$URLcall);
//$URLcall= str_replace("?", "",$URLcall);


//echo " ".$URLcall;
//die;

$DIRAT=explode("?", (	$URLcall	));
$DIRA=explode("/", (	$DIRAT[1]));
$DIRA=array_filter($DIRA);
$i=0;
$LANGURL=false;
foreach( $DIRA as $key => $value ) {
	
	$DIR[$i]=$value;
	if (strpos($value, 'lang:') !== false) {
		$langUrlTemp=explode(":",$value);
		$LANGURL=$langUrlTemp[1];
	}
	$i++;
	
}

//print_r($DIRA);


/// GET VARIABLES METHOD

/*if (sizeof($_GET) ) {	
	$loop=0;
	$username_try=false;
	$expId_try=false;
	//$DEBUG.=print_r($_GET, true);
	foreach ($_GET as $key => $value) {
		//echo "<br />K:". $key."<br />";
		$key=ltrim($key, "/"); 	// ok "?/username/" as well as "?username/"  as well as "?username"
		$DIR=explode("/", $key);
		$DIR[$loop]=trim(strtolower(	str_replace("/","", $DIR[0])));
//		echo "<br />V:". $DIR[0]."<br />";
		$loop++;
		if ($loop>0) break;
	}
}
*/
############# assign pageID
$pageID="home";
$lang_trigger="usr";

if ($DIRA[1]!="response"  && strlen($DIRA[2])!=32) {
	if (!loggedIn()	) 	$pageID="login";
}else{
}



////////////////////////
/*
if ($DIRA[1]=="emailgo" && $DIRA[2] && loggedIn()	){
	setcookie("PHPSESSID","1",time()-3600,"/");
	setcookie("_gat","1",time()-3600,"/");
	
	setcookie('remeberMe', '', time() - 3600,"/");
	//unset($_COOKIE['remeberMe']);
	
	setcookie('iduLogin', '', time() - 3600,"/");
	
	
	setcookie('dvmarkUser', '0', time() - 3600,"/");
	
	$_SESSION["userLogged"]=0;
	
	$_SESSION = array();
	
	if (ini_get('session.use_cookies')){
		$p = session_get_cookie_params();
		setcookie(session_name(), '', time() - 31536000, "/");
	}
	
	
	session_destroy();
	session_unset();
		session_write_close();
		setcookie(session_name(),'',0,'/');
		session_regenerate_id(true);
		
	header("location:/?emailgo/".$DIRA[2]);
	exit();
}
*/
/////////////////////////////
switch ($DIRA[0]) :
	/*case "response":
		if (strlen($DIRA[2])>31) $pageID="response";
	break;	
	*/
	case "admin":
	if ($_SESSION["ulevel"]>=3 ) $pageID="admin";
	break;
		case "editor":
		$pageID="editor";
		$lang_trigger="edt";
	break;
	
	case "player01":case "desktopplayer": case "player02":case "mobileplayer":
		//$pageID="player";
		$pageID="playergo"; //03
	break;

	case "playergo":
		$pageID="playergo";//03
	break;

	
	case "debrief":
		$pageID="debrief";
	break;
	case "groups":case "groups2.0":
	if ($_SESSION["ulevel"]>0 ){
		$lang_trigger="edt";
		$pageID="groups";
	}
	break;	
	case "game":
		$pageID="game";
	break;	
	
	case "globalinsights":
		$pageID="globalinsights";
	break;

	case "insights":
		$pageID="insights";
	break;
	
endswitch; // DIR

################# LANG
require_once(C_ROOT."/config/lang.inc.php");
if (LANG=="ar") $CSSA[]=''.C_DIR.'/css/ar.css?'.PAGE_RANDOM;


if (!loggedIn()	&& $pageID!="login" && $pageID!="response" ) 	header("location:/?login");
$JSA[]=''.C_DIR.'/js/base.js?changed';

if (loggedIn()) {
	//if ($pageID!="editor") 
											//0				1					2					3
	$HYRARCHY_NAMES=array(L_user, L_editor, L_administrator, L_super_user); // L_beginner
	define ("ULEV", $HYRARCHY_NAMES[$_SESSION["ulevel"]]);
}
//echo "\$pageID $pageID ";print_r($DIRA);die;

## output init
$O.='';
if ($_COOKIE["debug"])	{

	$O.='<div id="closedebug">X</div>';
	$O.='<div id="debug">debug</div>';
}
## PAGE switch

switch ($pageID) :
	case "admin":########################################################
		require_once(C_ROOT."/_m/admin/admin.php");
	break;

	case "game":########################################################
		//echo "\$pageID $pageID ";print_r($DIRA);die;
		require_once(C_ROOT."/_m/game/game.php");
		
	break;

	case "login":########################################################
		require_once(C_ROOT."/_m/login/login.php");
	break;
	case "home":########################################################
		require_once(C_ROOT."/_m/home/home.php");
	break;
	case "editor":########################################################
		require_once(C_ROOT."/_m/editor/edit.php");
	break;
	case "groups":########################################################
		require_once(C_ROOT."/_m/groups2.0/groups.php");
	break;
	case "player":########################################################
		//$gymPath=C_ROOT_GYM.$DIRA[2].".gym";
		//if ( !$DIRA[2]&& is_numeric($DIRA[1]) ) {header("location:/?/".$DIRA[1]."__NOT_FOUND");exit();}
		require_once(C_ROOT."/_m/player02/player.php");
	break;
	
	case "playergo":########################################################
		//$gymPath=C_ROOT_GYM.$DIRA[2].".gym";
		//if ( !$DIRA[2]&& is_numeric($DIRA[1]) ) {header("location:/?/".$DIRA[1]."__NOT_FOUND");exit();}
		require_once(C_ROOT."/_m/player03/player.php");
	break;	
	

	case "debrief":########################################################
		//if ( !$DIRA[2]&& is_numeric($DIRA[1]) ) {header("location:/?/".$DIRA[1]."__NOT_FOUND");exit();}
		require_once(C_ROOT."/_m/debrief/debrief.php");
	break;
	case "insights":########################################################
		require_once(C_ROOT."/_m/insights/insights.php");
	break;	
	
	case "globalinsights":########################################################
		require_once(C_ROOT."/_m/insights/globalinsights.php");
	break;		
endswitch;


################### CSS explode
$CSS="";

$CSSA=array_unique($CSSA);
foreach ($CSSA as $sheet) {
	$CSSclass="";if ($sheet==''.C_DIR.'/css/mobileOFF.css')	$CSSclass=' id="switchCss" ';
	$CSS.='<link'.$CSSclass.' href="'.$sheet.'" rel="stylesheet" type="text/css" />';		

	}
############## JS explode
//$JSA[]=''.C_DIR.'/handler/headerMenu/headerMenu.js?'.PAGE_RANDOM;

$JS="";
/*
$JS.="<script>(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga');ga('create', 'UA-67307625-1', 'auto');ga('send', 'pageview');</script>";
*/
$JSA=array_unique($JSA);
foreach ($JSA as $script) {$JS.="<script type=\"text/javascript\" charset=\"UTF-8\" src=\"".$script."\"></script>";}



######################## HEADER
//$page["titlePre"]="xxx - ";
@$page["titleMedium"]="Else";
//if ($pageID=="home" || $pageID=="login" ) @$page["title"]="Else "; //L_the_managerial_gym
if (!@$page["title"]) @$page["title"]=@$page["titlePre"].$page["titleMedium"].@$page["titlePost"];

//@$page["keywords"]=@$page["keywordsAdd"]."XXX"; ####### TO DO 

if (!@$page["description"]) $page["description"]="";

$PAGE_HEADER='<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
$PAGE_HEADER.='<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW, NOARCHIVE" />';
$PAGE_HEADER.='<meta name="viewport" content="width=device-width, user-scalable=no,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">';
$PAGE_HEADER.='<title>'.htmlspecialchars($page["title"]).'</title>';


if ($HEAD_ADD) $PAGE_HEADER.=$HEAD_ADD;

$JS=str_replace("//", "/", $JS);
$CSS=str_replace("//", "/", $CSS);

$JS=str_replace("https:/", "https://", $JS);
$JS=str_replace("https:/", "https://", $JS);
$JS=str_replace("///", "//", $JS);
$CSS=str_replace("///", "//", $CSS);

$PAGE_HEADER.='<script type="text/javascript">var CD="/'.C_DIRNS.'"</script>';
$PAGE_HEADER.=$JS;
$PAGE_HEADER.=$CSS;
$PAGE_HEADER.='<link rel="icon" href="data:;base64,iVBORw0KGgo="></head>';
$datapageID=$pageID;

$PAGE_HEADER.='<body data-pageID="'.$datapageID.'" data-lang="'.$_SESSION["lang"].'">';

## FOOTER  $sessionOPT
$PAGE_FOOTER=""; //$FOOTERO;
$PAGE_FOOTER.='</body></html>';

## PRINT
$FINAL_HTML="";
$FINAL_HTML.= trim($PAGE_HEADER);
//	$FINAL_HTML.= $PAGE_HEADER_COMMON;

$O=str_replace('src="/img/', 'src="img/', $O);
$O=str_replace('src="/data/', 'src="data/', $O);
$O=str_replace('data-path="/data/', 'data-path="data/', $O);



		$FINAL_HTML.= $O;	// left+right
//	echo $PAGE_FOOTER_COMMON;
$FINAL_HTML.= $PAGE_FOOTER;

echo $FINAL_HTML;
?>
