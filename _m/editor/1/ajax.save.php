<?php
ini_set("display_errors", "1");
include_once("../../../config/config.inc.php");
if ($_SESSION["ulevel"]<1) die("false|-|you don't have the right permissions");

$D=$_POST;$D=array_map("trim",$D);
/*
if ($D["scene"]) {
	echo "false|-|noScene|-|";
	print_r($D);
	die();
}*/
$D["Q"]=false;
if (!$D["table"]) {
	if ($D["gameId"]  && is_numeric($D["gameId"])  && $D["step"]  && is_numeric($D["step"])  && $D["what"] )  {	
		
		if (		$D["what"]!="compulsoryAttachments" && $D["what"]!="ascore_1" && $D["what"]!="ascore_2" && $D["what"]!="ascore_3" && $D["what"]!="ascore_4") {
			
			if (!$D["val"]) $D["Q"]="update games_steps set ".$D["what"]."=NULL WHERE gameId=".$D["gameId"]." AND step=".$D["step"]." AND scene='".$D["scene"]."' ";
			else
			$D["Q"]="update games_steps set ".$D["what"]."='".db_string($D["val"] )."' WHERE gameId=".$D["gameId"]." AND step=".$D["step"]." AND scene='".$D["scene"]."' ";
		}else{
			$D["Q"]="update games_steps set ".$D["what"]."=".$D["val"]." WHERE gameId=".$D["gameId"]." AND step=".$D["step"]." AND scene='".$D["scene"]."'" ;
			if ($D["val"]=="na") $D["Q"]="update games_steps set ".$D["what"]."=NULL WHERE gameId=".$D["gameId"]." AND step=".$D["step"]." AND scene='".$D["scene"]."' ";
		}
		
		//utrackingGameEditor($gameId, $step, $action) 
		//$D["utrackingGameEditor"]=utrackingGameEditor($D["gameId"], $D["step"], $D["what"]) ;
		
	}
	
	
	
}

if ($D["table"]=="attachments"		&& is_numeric(	$D["whereId"]	)) {
		$D["Q"]="update games_steps_attachments set ".$D["what"]."='".db_string($D["val"] )."' WHERE gameId=".$D["gameId"]." AND step=".$D["step"]."  AND scene='".$D["scene"]."' AND idAttachment=".$D["whereId"];
//		$D["utrackingGameEditor"]=utrackingGameEditor($D["gameId"], $D["step"], $D["table"]) ;
}

if ($D["table"]=="comments"		&& is_numeric(	$D["gameId"]	)) {
		$D["Q"]="update games set ".$D["what"]."='".db_string($D["val"] )."' WHERE gameId=".$D["gameId"]."";
//		$D["utrackingGameEditor"]=utrackingGameEditor($D["gameId"], 0, $D["table"]) ;
}






if ($D["Q"]) {
	sql_query($D["Q"]);
	$D["e"]=sql_error();

}

	echo "true|-|";
	print_r($D);
?>