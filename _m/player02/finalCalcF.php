<?php
ini_set("display_errors", "1");
include_once($_SERVER['DOCUMENT_ROOT']."/config/config.inc.php");
if (!loggedIn()) die("false|-|you are not logged");
include_once($_SERVER['DOCUMENT_ROOT']."/config/php.function.games.php");
//$G=$_POST["data"];
echo "<pre> ciao";
print_r(finalCalc2(263,false)); //129 b  
//print_r(matchExchanges(1,false));
//print_r(matchExchanges(68));



function finalCalc2($idMatch, $update=false){
	$d["score"]=0;
	$d["max"]=0;
	$d["scorePercent"]="0";

	$d["spread"]=array();
	
	$d["match"]=sql_queryt("SELECT idm, gameId, start, end FROM matches WHERE idm=$idMatch");	
	$d["gameId"]=$d["match"]["gameId"]; //unset($d["game"]);
	
	$d["match"]["startH"]=timestamp2it($d["match"]["start"]);
	if ($d["match"]["end"]) $d["match"]["endH"]=timestamp2it($d["match"]["end"]);
	
	
	if (!$d["gameId"]) return $d;
	/*if ($d["gameId"] && !$update) {
		$d["game"]=sql_queryt("SELECT G.title,  C.file coverPath FROM games G 
		LEFT JOIN covers C on G.cover_id=C.id		
		WHERE G.gameId=".$d["gameId"]);	

	}
	*/
	
	$d["score"]=0;
	// load questions and answers
	$d["q1"]="SELECT 
		step, scene, scenario_id, avatar_id, avatar_sentence, answer_1,answer_2, answer_3, answer_4
		, ascore_1,ascore_2, ascore_3, ascore_4
	 FROM games_steps WHERE gameId=".$d["gameId"]." ORDER BY step ASC, scene ASC ";
	$qS=sql_query($d["q1"]);
	if (sql_error()) 	return sql_error();
	$ii=0;
	while (	$ST=sql_fetch_assoc($qS)	){
		/*$ST["max"]=0;$ST["min"]=NULL;
		for ($i=1; $i<=4; $i++) {
			if ($ST["answer_".$i]	&& $ST["ascore_".$i]>$ST["max"]		) 	$ST["max"]=$ST["ascore_".$i];
			
			
			if (
			($ST["answer_".$i]	 && is_numeric($ST["ascore_".$i])	 && $ST["ascore_".$i]<$ST["min"]		)
			|| is_null($ST["min"])
			) 		$ST["min"]=$ST["ascore_".$i];
		}
		
		
		$ST["delta"]=($ST["max"]-$ST["min"]);
		//unset ($ST["max"], $ST["min"]);
		*/
		$ST["maxScore"]=max(
			$ST["ascore_1"],
			$ST["ascore_2"],
			$ST["ascore_3"],
			$ST["ascore_4"]
		);
		$d["G"][$ST["scene"].$ST["step"]		]=$ST;
		$ii++;
	}		
	
	/// match
	$d["q"]="SELECT * FROM matches_step WHERE idm=$idMatch ORDER BY id ASC ";

	$qS=sql_query($d["q"]);
	if (sql_error()) 	return sql_error();
	$Stt=0;
	while (	$ST=sql_fetch_assoc($qS)	){
		$sceneStep=$ST["scene"].$ST["step"];
		//if ($Stt==2) 
		$ST["score"]=$d["G"][	$sceneStep	]["ascore_".$ST["answerN"]];
		$ST["scorePercent"]=euroFormatDot($ST["score"]/$d["G"][$sceneStep]["maxScore"]*100);
		if ($ST["scorePercent"]=="-") $ST["scorePercent"]="0";
		$ST["scorePercent"]=str_replace(".00", "", $ST["scorePercent"]);


		
		$d["score"]+=$ST["score"];
		/*$ST["ascoreNormalized"]=$ST["ascore"]-$d["G"][$ST["step"]-1]["min"];
		
		$d["score"]+=$ST["ascore"];
		$ST["delta"]=$d["G"][$ST["step"]-1]["delta"]	;
		if (!$d["G"][$ST["step"]-1]["delta"]) 		$ST["scorePercent"]=0;
		else													$ST["scorePercent"]=$ST["ascoreNormalized"]	/			$d["G"][$ST["step"]-1]["delta"]*100;
		$ST["scorePercentShow"]=euroFormatDot($ST["scorePercent"]);
		$ST["scorePercentShow"]=str_replace(".00", "", $ST["scorePercentShow"]);
		
		//$ST["scorePercentT"]=$ST["ascore"]." /".$d["G"][$ST["step"]-1]["delta"];

			
		*/
		$ST["scenario_id"]=$d["G"][$sceneStep	]["scenario_id"];	
		$ST["question"]=$d["G"][$sceneStep	]["avatar_sentence"];	
		$ST["answer"]=$d["G"][$sceneStep	]["answer_".$ST["answerN"]];
		
		$ST["type"]=NULL;
		$Stt++;
		$d["s"][$sceneStep	]=$ST;
		
//		$d["s"][]=$ST;
	}
	
	
	
	############ numbers
	//if ($d["match"]["end"])  {
		// spread this match

		$d["spreadQ"]="SELECT * FROM games_spread WHERE gameId=".$d["gameId"]." AND (".$d["score"].">=spreadL AND ".$d["score"]."< spreadR ) /* A primo tentativo*/";
		$d["spread"]=sql_queryt($d["spreadQ"]);
		// caso di punteggio massimo 

		if (!$d["spread"]["spread"]) {
			$d["spreadQ"]="SELECT * FROM games_spread WHERE gameId=".$d["gameId"]." AND (".$d["score"].">spreadL AND ".$d["score"]."<= spreadR ) /* A secondo tentativo*/";
			$d["spread"]=sql_queryt($d["spreadQ"]);
		}
		unset ($d["spread"]["gameId"]);
		//$d["commentQQ"]="SELECT ".$d["spread"]["spread"]."_comment FROM games WHERE gameId=".$d["gameId"]." ";
		$d["commentQ"]=sql_queryt("SELECT ".$d["spread"]["spread"]."_comment FROM games WHERE gameId=".$d["gameId"]." ");
		$d["comment"]=$d["commentQ"][		$d["spread"]["spread"]."_comment"				]; unset ($d["commentQ"]);	
	

		// spread ALL
		$d["spreadQA"]="SELECT * FROM games_spread WHERE gameId=".$d["gameId"]."  ";
		$QAS=sql_query($d["spreadQA"]);
		$spi=0;
		while (	$SP=sql_fetch_assoc($QAS)	){
			unset ($SP["gameId"]); 
			$d["spreadAll"][$spi]=$SP;
			$spi++;
		}
		/// match's result

		
		
		
		
		$d["min"]=$d["spreadAll"][0]["spreadL"];
		$d["max"]=$d["spreadAll"][7]["spreadR"];
		unset (
		//$d["spreadAll"],
		$d["spreadQ"]
		);
		
		
		
		/////////////////////////////////////////////////////////

		
		$d["scorePercent"]=euroFormatDot($d["score"]/$d["max"]*100);
		if ($d["scorePercent"]=="-") $d["scorePercent"]="0";
		$d["scorePercentPrint"]=str_replace(".00", "", $d["scorePercent"]);
				$d["scorePercentDecimal2"]=$d["scorePercent"]/100;
		////////////////////////////////////////////////////
		
			
		// add score percent each played step
		/*if ($d["s"]) foreach($d["s"] as $stepIndex => $step) {
			//$d["s"][$stepIndex]["scoreNormalized"]=$step["ascore"]-$d["min"];
			//$d["s"][$stepIndex]["scorePercent"]=euroFormatSmart($d["s"][$stepIndex]["scoreNormalized"]/$d["delta"]*100);
			
		}
*/
		// spread this match
		if ($d["s"]) {
			$d["spreadQ"]="SELECT * FROM games_spread WHERE gameId=".$d["gameId"]." AND (".$d["score"].">=spreadL AND ".$d["score"]."< spreadR ) /* B primo */";
			$d["spread"]=sql_queryt($d["spreadQ"]); 
			if (!$d["spread"]["spread"]) {
				$d["spreadQ"]="SELECT * FROM games_spread WHERE gameId=".$d["gameId"]." AND (".$d["score"].">spreadL AND ".$d["score"]."<= spreadR ) /* B secondo tentativo*/";
				$d["spread"]=sql_queryt($d["spreadQ"]);
			}
		}

		
		// type
		$d["LW"]=substr($d["spread"]["spread"],0,1);
		if ($d["LW"]=="W") 
			$type="winning";
		else 
			$type="loosing";
			
		// final step
		$d["stepFinalQ"]="SELECT step, scenario_id, avatar_id,avatar_size,avatar_pos,balloon_pos, arrowY, arrowPos, avatar_sentence, avatar_audio
		FROM games_steps WHERE gameId=".$d["gameId"]." AND type='$type' ";
		$d["stepFinal"]=sql_queryt("SELECT step, scenario_id, avatar_id,avatar_size,avatar_pos,balloon_pos, arrowY, arrowPos, avatar_sentence, avatar_audio
		FROM games_steps WHERE gameId=".$d["gameId"]." AND type='$type' ");
 
		if ($d["match"]["end"]) 
			$d["s"][]=array(
			"step"=>$d["stepFinal"]["step"],
			"question"=>$d["stepFinal"]["avatar_sentence"],
			"ts"=>$d["stepFinal"]["ts"],
			"type"=>$type,
			);
		

 
 
	$d["update"]=$update;
	if ($update) {
		$d["update"]=1;
		$us="UPDATE matches SET end =".C_TIME." ,final ='".$d["spread"]["spread"]."' WHERE idm=$idMatch";
		sql_query($us);
		//if (sql_error()) 	return sql_error()." $us";
	}



	unset ($d["q"]);
	return $d;
	
}


?>