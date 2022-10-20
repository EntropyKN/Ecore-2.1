<?php
ini_set("display_errors", "1");
include_once("../../../config/config.inc.php");

if (!loggedIn()) die("false|-|you are not logged");
if ($_SESSION["ulevel"]<1) die("false|-|you don't have the right permissions");
$D=$_POST["D"];
$D=array_map("trim",$D);

if (!$D["steps"] || !is_numeric($D["steps"])) echo "false|-|no steps";

if (!$D["valid_until"]) {
	//unset ($D["valid_until"]);
	$D["valid_until"]="NULL";
}else {
	$D["valid_until"]=(dateIT2dateDb(		$D["valid_until"]				));
}

$Ddb=array_map("db_string",$D);
$D["gameIdNew"]=0;
unset ($Ddb["stepsBefore"],$Ddb["structureBefore"] );
if (!$D["gameId"]) {
	
	$Ddb["uid_creator"]=$_SESSION["uid"];
	$Ddb["createdTs"]=time();	
	unset ($Ddb["gameId"]);$fields="";$values="";
	foreach($Ddb as $key => $value){
		$fields.="$key,";
		$values.="'$value',";
	}
	$values=str_replace("'NULL'", "NULL", $values);
	
	$D["Q"]="INSERT INTO games (".trim($fields, ",").") VALUES (".trim($values, ",").")";
	//sql_query("TRUNCATE games");
	sql_query($D["Q"]);
	
	$D["gameIdNew"]=sql_id();
	$D["Qe"]=sql_error();
	if (!$D["Qe"]) echo "true|-|".$D["gameIdNew"];
	if ($D["Qe"]) echo "false|-|db error: ".$D["Qe"];
	

	
	
}else{
	unset ($Ddb["gameId"]);
	$Ddb["uid_editor"]=$_SESSION["uid"];
	$Ddb["editTs"]=time();	

	$D["Q"]="UPDATE games SET ";
	foreach($Ddb as $key => $value){
	  $D["Q"].="$key='$value', ";
	}
	$D["Q"]=str_replace("'NULL'", "NULL", $D["Q"]);
	$D["Q"]=trim($D["Q"], ", ");
	$D["Q"].=" WHERE gameId=".$D["gameId"];

	 sql_query($D["Q"]);
	$D["Qe"]=sql_error();

	if (!$D["Qe"]) {
		$D["QupX"]="UPDATE games SET editTs=".C_TIME.", uid_editor=".$_SESSION["uid"]." WHERE gameId =".$D["gameId"]."" ;
		sql_query(  $D["QupX"]   );	
		
		
		echo "true|-|".$D["gameId"];
	}else{
		
		echo "false|-|db error: ".$D["Qe"];
	}
	//echo "false|-|update ";	

}


$D["addQ1"]=array();
$D["addQstru"]=array();

$D["gameIdStep"]=$D["gameIdNew"];
if (!$D["gameIdStep"]) $D["gameIdStep"]=$D["gameId"];



if ($D["stepsBefore"] != $D["steps"] || $D["structureBefore"] != $D["structure"]) {
	
	sql_query("DELETE FROM `games_steps` WHERE gameId=".$D["gameIdStep"]." AND step>".$D["steps"]);
	if (sql_error()) $D["addQ1"][0]=sql_error();	
	
	for ($stepp = 1; $stepp <= $D["steps"]; $stepp++) {
		sql_query("INSERT INTO `games_steps` (gameId, step) VALUES  (".$D["gameIdStep"].", $stepp			)");
		if (sql_error()) $D["addQ1"][$stepp]=sql_error();	
	}
	sql_query("UPDATE `games_steps`  SET type=NULL WHERE	gameId=".$D["gameIdStep"]."");
		//$D["uptype"]=""
	$stepp++;
	sql_query("INSERT INTO `games_steps` (`gameId`, `step`, type) VALUES (".$D["gameIdStep"].", ".($D["steps"] +1).",'winning'			)");
	if (sql_error())  $D["addQ1"][$stepp]=sql_error();	
	
	$stepp++;
	sql_query("INSERT INTO `games_steps` (`gameId`, `step`, type) VALUES (".$D["gameIdStep"].", ".($D["steps"] +2).",'loosing'			)");
	if (sql_error())  $D["addQ1"][$stepp]=sql_error();	

}//if ($D["stepsBefore"] != $D["steps"]) {

if ($D["structureBefore"] != $D["structure"]) {
	if ($D["structure"]=="linear") {
		// linear
		sql_query("DELETE FROM `games_steps` WHERE gameId=".$D["gameIdStep"]." AND scene='B'");
		if (sql_error()) $D["addQstru"][]=sql_error();
	}else{
		// fork
		for ($ST = ($D["forkFrom"]+1); $ST <= $D["steps"]; $ST++) {
			$D["Bside"][$ST]="INSERT INTO `games_steps` (`gameId`, `step`, scene) VALUES (".$D["gameIdStep"].", $ST,'B'			)";
			sql_query($D["Bside"][$ST]);
			if (sql_error())  $D["addQstru"][$stepp]=sql_error();				
		}
	}
}
///////////////////////////////////////////////////
$D["adaptQ1"]="UPDATE `games_steps`  SET goto1='A',goto2='A',goto3='A',goto4='A' WHERE	gameId=".$D["gameIdStep"]." AND step>".$D["forkFrom"];

sql_query($D["adaptQ1"]);
if ($D["structure"]!="linear")  {
$D["adaptQ2"]="UPDATE `games_steps`  SET goto1='B',goto2='B',goto3='B',goto4='B' WHERE	gameId=".$D["gameIdStep"]." AND scene='B' AND step>".$D["forkFrom"];
	sql_query($D["adaptQ2"]);
}
//////////////////////////////////////////////////
echo "|-|";
echo sql_error();
/*echo $D["stepsBefore"] .",".$D["steps"] ."---".$D["structureBefore"] .",".$D["structure"] ."==";
if (			$D["stepsBefore"] != $D["steps"] || $D["structureBefore"] != $D["structure"]) echo "changed";
else echo "not_changed";
*/
echo "|-|";
print_r($D);

//////////////


?>