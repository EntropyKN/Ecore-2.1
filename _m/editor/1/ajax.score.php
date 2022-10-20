<?php
include_once("../../../php.config.inc.php");
if (!loggedIn()) die("false|-|you are not logged");
if ($_SESSION["ulevel"]<1) die("false|-|you don't have the right permissions");
$D=$_POST;//["D"]
$D=array_map("trim",$D);
$D["ida"]=explode("_", $D["id"]);	//9_3  $D["state"]_$D["idsentence"]
$D["state"]=$D["ida"][0]+1;
$D["idsentence"]=$D["ida"][1]+1;
//unset($D["ida"],$D["id"]);
conn();
/*
 [0] => A [1] => B
*/

if ($D["ida"][0]=="A" && $D["ida"][1]=="B" ) {
	if (	!is_numeric($D["idg"]) )  die("false|-|data errors...".print_r($D,true));	
	$D["Q"]="UPDATE palma_gym SET bot_initial_escalation = ".$D["val"]." WHERE idgym =".$D["idg"];
}else{

	if (	
	!is_numeric($D["idg"]) 
	|| !is_numeric($D["state"]) || $D["state"]=="0"	
	|| !is_numeric($D["idsentence"]) || $D["idsentence"]=="0" 
	) 
	die("false|-|data errors...".print_r($D,true));
	
	//exist?
	
	$WHERE =" WHERE idgym =".$D["idg"]." AND state=".$D["state"]." AND idsentence=".$D["idsentence"];
	$strS="SELECT score,state FROM palma_sentences $WHERE ";
	$D["strS"]=$strS;
	$C=mysql_fetch_assoc(mysql_query($strS));
	if (mysql_error()) $D["e"]=mysql_error();
	$D["update"]=false;if ($C["state"]) $D["update"]=true;
	
	$Ddb=$D;
	if (!$D["update"]) {
		$fields.="idgym,";$values.="'".$Ddb["idg"]."',";
		$fields.="state,";$values.="'".$Ddb["state"]."',";
		$fields.="idsentence,";$values.="'".$Ddb["idsentence"]."',";	
		$fields.="score,";$values.="'".$Ddb["val"]."' ";
		$D["Q"]="INSERT INTO palma_sentences (".trim($fields, ",").") VALUES (".trim($values, ",").") ";
	}else{
		$D["Q"]="UPDATE palma_sentences SET ";
		$D["Q"].="score='".$Ddb["val"]."' $WHERE";
	}
}// fine BIE
mysql_query($D["Q"]);
$D["Qe"]=mysql_error();
$D["QupX"]="ciao";

if ($D["Qe"]) {
	echo "false|-|db error: ".$D["Qe"];
}else{
	$D["QupXXXXXX"]="UPDATE palma_gym SET editTs=".C_TIME.", uid_editor=".$_SESSION["uid"]." WHERE idgym =".$D["idg"]."" ;
	mysql_query(  $D["QupXXXXXX"]   );
}
echo "true|-|";
print_r($D);
echo "ajaxScore";
?>