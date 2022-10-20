<?php
ini_set("display_errors", "1");
include_once("../../../config/config.inc.php");
if ($_SESSION["ulevel"]<1) die("false|-|you don't have the right permissions");

$D=$_POST;
if ($_GET) {
	$D=$_GET;

}
$D=array_map("trim",$D);
if (!$D["gameId"]  || !is_numeric($D["gameId"])  )  die("false|-|data errors...".print_r($D,true));
$gameId=$D["gameId"];


///////////////////////////////////////////////////////


function gameIntervalCalc2($gameId){
	$str="SELECT step, scene,
	answer_1, answer_2, answer_3, answer_4, 
	ascore_1,ascore_2,ascore_3, ascore_4 FROM games_steps WHERE gameId =$gameId and type IS NULL order by step ASC";
	$Q=sql_query($str);
	$D=array(
	"response"=>1,
	"reason"=>"",
	"max"=>0,
	"min"=>0,
	"report"=>"",
	"game"=>sql_queryt("SELECT structure, forkFrom from games where gameId=$gameId"),
	"maxesL"=>array(),//lineari
	"maxesA"=>array(),
	"maxesB"=>array(),
	//"MAX_L"=>0,	
	"MAX_A"=>0,	
	"MAX_B"=>0,		
	"MAX"=>0,	
	);

	if (sql_error()) return sql_error();
	require_once(C_ROOT."/config/lang.inc.php");
	while (	$S=sql_assoc($Q)	){
		$S=array_map("trim", $S);
		// At least one score
		$S["scoresA"]=array();
		for ($p = 1; $p <=4; $p++) {
			if (is_numeric($S["ascore_".$p]) ) $S["scoresA"][]=$S["ascore_".$p];
		}
		$S["MINSCORE"]=@min($S["scoresA"]);
		if (	$S["MINSCORE"]>0  ){
			$D["response"]=0;
			$D["reason"]=L_step." ".$S["step"]." ".$S["scene"].": ".L_at_least_one_score_must_be_zero; //
			return $D;
		}		
		
		
		if (	!$S["answer_1"] || !$S["answer_2"] || !$S["answer_3"]  ){
			$D["response"]=0;
			$D["reason"]=L_step." ".$S["step"]." ".$S["scene"].": ".L_the_first_three_answers_are_mandatory; //
			return $D;
		}
		if (!$S["answer_3"]	 && $S["answer_4"]			){	// c'e' la quattro ma non la tre
			$D["response"]=0;
			$D["reason"]=L_step." ".$S["step"]." ".$S["scene"].": ".L_you_cannot_use_question_4_without_using_question_3; // cannot use question 4 without use question 3
			return $D;	
		}
		$S["questNumb"]=3;
		if ($S["answer_4"]) $S["questNumb"]=4;
		unset ($S["answer_1"],$S["answer_2"],$S["answer_3"],$S["answer_4"]);
		

		$D["d"][]=$S;
	}
	///////////////////////////////// endwhile
	
	
	
	
	// verifica score not null  
	if ($D["response"]	&& $D["d"]) {
	 foreach($D["d"] as $K => $V){
		for ($s = 1; $s<=$V["questNumb"]; $s++) {				
			if (!is_numeric($V["ascore_".$s])) {

				$D["response"]=0;
				$D["reason"]=L_missing.": ".L_step." ".$V["step"]."  ".$V["scene"]." ".L_questions_score." ".$s;
				return $D;
			}else{
				$D["d"][$K]["values"][]=$V["ascore_".$s];
			}
		}		 
	  } //each
	  
	 }else{
		 return $D;
	 }

	// max
	foreach($D["d"] as $K => $V){
		if (isHomogenous($V["values"] )){
			$D["response"]=0;
			$D["reason"]=L_step." ".$V["step"]."  ".$V["scene"]." ".L_answers_have_the_same_score	;	//
			return $D;	
		}
		/*if (array_unique ($V["values"]) !=$V["values"] ) {
			$D["response"]=0;
			$D["reason"]=L_step." ".$V["step"]." ".L_some_questions_have_the_same_score	;	//
			return $D;			
		}
		*/
		
		$D["d"][$K]["max"]=max($V["values"]);
		//$D["max"]+=$D["d"][$K]["max"];
		//$D["d"][$K]["min"]=min($V["values"]);
		//$D["min"]+=$D["d"][$K]["min"];		
		
		//	3 path=>		." ".$D["d"][$K]["step"]
		$stepPrintHere="";
		//$stepPrintHere.=" ".$D["d"][$K]["step"]." ".$D["d"][$K]["scene"];
		if ($D["game"]["structure"]=="linear") {
			$D["maxesA"][]=$D["d"][$K]["max"].$stepPrintHere;
		}else{
			if ($D["d"][$K]["step"]<=$D["game"]["forkFrom"])  {	
				$D["maxesL"][]=$D["d"][$K]["max"].$stepPrintHere;
				$D["maxesA"][]=$D["d"][$K]["max"].$stepPrintHere;
				$D["maxesB"][]=$D["d"][$K]["max"].$stepPrintHere;			
				
			}else{
				if ($D["d"][$K]["scene"]=="A") $D["maxesA"][]=$D["d"][$K]["max"].$stepPrintHere;
				if ($D["d"][$K]["scene"]=="B") $D["maxesB"][]=$D["d"][$K]["max"].$stepPrintHere;
			}
		}
		
	}
	$D["min"]=0;
//	$D["mergeLA"]=array_combine($D["maxesL"], $D["maxesA"]);
//	$D["MAX_L"]=max($D["maxesL"]);
	$D["MAX_A"]=@array_sum($D["maxesA"]);
	$D["MAX_B"]=@array_sum($D["maxesB"]);	
	$D["MAX"]		=@max($D["MAX_A"],$D["MAX_B"]);
/*		INTERVALLI


										50%
				losing area			 |			winning area
										 |
		|_L4_|_L3_|_L2_|_L1_||_W1_|_W2_|_W3_|_W4_|
		
		
*/	
	$pass=100/8;
	$D["Ip"]=array(
	0,1*$pass,		2*$pass,	3*$pass,		4*$pass
	,	5*$pass,	6*$pass,	7*$pass,	8*$pass	
	);

//	$D["minMaxDiff"]=$D["max"]-$D["min"];
//	$D["minMaxDiff"]=$D["max"]-$D["min"];
	
	foreach($D["Ip"] as $K => $P){
		$D["I"][$K]=($D["MAX"]*$P/100);
		$D["I"][$K]=euroFormatSmart($D["I"][$K]);
	}
	

	$D["s"]=array(
		"L1"=>array("spreadLP"=>	$D["Ip"][0],"spreadRP"=>$D["Ip"][1], "spreadL"=>0,"spreadR"=>$D["I"][1]	),
		"L2"=>array("spreadLP"=>	$D["Ip"][1],"spreadRP"=>$D["Ip"][2],"spreadL"=>$D["I"][1],"spreadR"=>$D["I"][2]	),		
		"L3"=>array("spreadLP"=>	$D["Ip"][2],"spreadRP"=>$D["Ip"][3],"spreadL"=>$D["I"][2],"spreadR"=>$D["I"][3]		),
		"L4"=>array("spreadLP"=>	$D["Ip"][3],"spreadRP"=>$D["Ip"][4],"spreadL"=>$D["I"][3],"spreadR"=>$D["I"][4]),
		
		"W1"=>array("spreadLP"=>	$D["Ip"][4],"spreadRP"=>$D["Ip"][5],"spreadL"=>$D["I"][4],"spreadR"=>$D["I"][5]),
		
		"W2"=>array("spreadLP"=>	$D["Ip"][5],"spreadRP"=>$D["Ip"][6],"spreadL"=>$D["I"][5],"spreadR"=>$D["I"][6]),
		"W3"=>array("spreadLP"=>	$D["Ip"][6],"spreadRP"=>$D["Ip"][7],"spreadL"=>$D["I"][6],"spreadR"=>$D["I"][7]),
		"W4"=>array("spreadLP"=>	$D["Ip"][7],"spreadRP"=>$D["Ip"][8],"spreadL"=>$D["I"][7],"spreadR"=>$D["I"][8]),
	);
// INSERT INTO `games_spread` (`gameId`, `spread`
//		, `spreadLP`, `spreadRP`, `spreadL`, `spreadR`) VALUES 
	$D["q"]=" INSERT INTO `games_spread` 
	(`gameId`, `spread`,`spreadLP`, `spreadRP`, `spreadL`, `spreadR`) VALUES 
	 ";
	foreach($D["s"] as $K => $SS){
		$D["q"].="( $gameId, '".$K."','".$SS["spreadLP"]."','".$SS["spreadRP"]."','".$SS["spreadL"]."','".$SS["spreadR"]."' ),
";
	}
	$D["q"]=trim($D["q"],",\n" );
	sql_query("DELETE FROM games_spread WHERE gameId=$gameId");
	sql_query($D["q"]);
	$D["e"]=sql_error();	
	return $D;	
}





/////////////////////////////////////////////////////////////////
$D["s"]=gameIntervalCalc2($gameId);
$R=$D["s"];

if ($R["response"]){
	echo "true|-|";
	echo json_encode($R["s"]);
}else{
	echo "false|-|".$R["reason"];
}

echo "|-|<br /> ";
	echo "<pre>";
print_r($D);
?>