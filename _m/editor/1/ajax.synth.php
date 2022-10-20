<?php
//ini_set("display_errors", "1");
include_once("../../../config/config.inc.php");

if (!loggedIn()) die("false|-|you are not logged");
if ($_SESSION["ulevel"]<1) die("false|-|you don't have the right permissions");



$G=array_map("trim",$_GET);
$voice=explode(",",$G["voice"]);
$D["gender"]=$voice[1];
$D["tl"]=$voice[0];
$G["text"]=strip_tags($G["text"]);

$G["key"]=C_AUDIOKEY; // it may change
/////////////////  WfWmvaX0



//$D["tl"]="it";
//$D["url"]="https://code.responsivevoice.org/getvoice.php?t=".urlencode($G["text"])."&tl=".$D["tl"]."&sv=g1&vn=&pitch=0.5&rate=0.5&vol=1&gender=".$D["gender"];

//https://code.responsivevoice.org/getvoice.php?text=oblomov&lang=it&engine=g1&name=&pitch=0.5&rate=0.5&volume=1&key=WGciAW2s&gender=female
//$D["url"]="https://code.responsivevoice.org/getvoice.php?t=".urlencode($G["text"])."&tl=".$D["tl"]."&sv=g1&vn=&pitch=0.5&rate=0.5&vol=1&gender=".$D["gender"];

$D["url"]="https://code.responsivevoice.org/getvoice.php?text=".urlencode($G["text"])."&lang=".$D["tl"]."&engine=g1&name=&pitch=0.5&rate=0.5&volume=1&key=".$G["key"]."&gender=".$D["gender"];


$D["fileName"]=$G["gameId"]."_".$G["step"]."_".$G["scene"].".mp3";

file_put_contents(C_ROOT. '/data/audio/'.$D["fileName"], fopen(	$D["url"]		, 'r'));


$D["post"]=$G;
echo "true|-|";
echo "data/audio/".$D["fileName"];
echo "|-|";
echo "<pre>";
print_r($D);
?>