<?php
$langLink=$_SERVER["REQUEST_URI"];
$langLink=str_replace("/lang:en", "",$langLink );
$langLink=str_replace("/lang:it", "", $langLink);
$langLink=str_replace("/lang:ar", "", $langLink);
//+393927884489
if (strpos($langLink, '?') === false) $langLink="/?/".$langLink;
$langLink.="/lang:";
while( strpos($langLink, '//') !== false ) {
   $langLink = str_replace('//','/',$langLink);
}
$selectedEN="";
$selectedIT="";
$selectedAR="";
if ($_SESSION["lang"]=="en") {$selectedEN=" optionS";$radicEN=" &radic; ";}
if ($_SESSION["lang"]=="it") {$selectedIT=" optionS";$radicIT=" &radic; ";}
if ($_SESSION["lang"]=="ar") {$selectedAR=" optionS";$radicAR=" &radic; ";}


//$F.='<span class="separator">'.ULEV.'</span>';
//$F.='<span class="separator">'.L_available_languages.'</span>';
if ($pageID!="home") $F.='<a class="option" href="?">'.L_dashboard.'</a>';
if ($pageID!="home") $F.='<span class="separator"></span>';

if ($_SESSION["ulevel"]>=1 ) 	{// 1 => editorr
	$F.='<a class="option" href="?/editor/0/0">'.L_create_a_new_game.'</a>';
}
if ($_SESSION["ulevel"]>=1 || $_SESSION["ulevel"]>=2  )  $F.='<a class="option" href="?/groups">'.L_groups.'</a>';
if ($_SESSION["ulevel"]>=2 ) 	{// 2 => Administrator
	
	$F.='<a class="option" href="?/insights">'.L_insights.'</a>';
}
if ($_SESSION["ulevel"]>=3 ) {	// 3 => super user
	$F.='<a class="option" href="?/admin">'.L_admin.'</a>';
	$F.='<a class="option" href="?/globalinsights">Global Insights</a>';
//	$F.='<a class="option" href="?/insights">'.L_insights.'</a>';
}

if ($_SESSION["ulevel"]>0) $F.='<span class="separator"></span>';

/*
if (!empty($_SESSION["insights"]["groups"] )		|| $_SESSION["ulevel"]> 0				 )  {
	$F.='<a class="option" href="?/insights">'.L_insights.'</a>';	
}
*/
/*

*/

/*$F.='<a class="option" href="/">'.L_vabe.'</a>';

if ($_SESSION["ulevel"]>0 ) {
	$F.='<span class="separator"></span>';
	$F.='<a class="option" href="?/editor/0/0">'.L_create_a_new_gym.'</a>';
	$F.='<a class="option" href="?/groups">'.L_groups.'</a>';
}

if (!empty($_SESSION["insights"]["groups"] )		|| $_SESSION["ulevel"]> 0				 )  {
	$F.='<a class="option" href="?/insights">'.L_insights.'</a>';	
}
*/


	$F.='<a class="option'.$selectedEN.'" href="'.$langLink.'en">'.$languages_names["en"].''.$radicEN.'</a>';
	$F.='<a class="option'.$selectedIT.'" href="'.$langLink.'it">'.$languages_names["it"].''.$radicIT.'</a>';
	//$F.='<a class="option'.$selectedAR.'" href="#">العربية'.$radicAR.'</a>'; //'.$langLink.'ar


$F.='<span class="separator"></span>';
$F.='<a id="hd_settings_logout" class="option" href="logout/">'.L_logout.'</a>';


?>