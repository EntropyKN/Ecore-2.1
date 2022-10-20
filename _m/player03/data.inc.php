<?php
if (!$DIRA[1] || !is_numeric($DIRA[1])) {header("location:/".C_DIRNS."?/".$DIRA[1]."__NOT_FOUND");exit();}


require_once(C_ROOT."/config/php.function.youtube.inc.php");

######## DATA EXCHANGE

$G=sql_fetch_assoc(	sql_query("
SELECT 
G.gameId,
G.language,
G.title,
G.Description,
G.Goal_1,G.Goal_2,G.Goal_3,G.Goal_4,
G.Goal_5,
G.steps,
G.usr_female_avatar_id,
G.usr_male_avatar_id,
G.usr_description,
G.usr_goal1,
G.usr_goal1,
G.usr_goal1,
G.status,
G.structure,
G.forkFrom,
concat ('".COVERPATH."', C.file) coverPath
FROM games G 
		LEFT JOIN covers C on G.cover_id=C.id
		WHERE gameId='".(trim($DIRA[1]))."'
"));
if ( !$G['gameId']	) {header("location:/".C_DIRNS."?/".$DIRA[1]."__NOT_FOUND");exit();}
$strS="SELECT 
/*A.*,*/
S.step,
S.scene,
concat ('".SCENARIOPATH."', S.scenario_id,'_1024.jpg') scenario,
S.avatar_id,
S.avatar_size,
S.avatar_pos,
S.balloon_pos,
S.arrowY,
S.arrowPos,
S.avatar_sentence,
S.avatar_audio,
concat ('".AUDIOPATH."', S.avatar_audio) avatar_audio,
S.compulsoryAttachments,
S.answer_1,S.ascore_1,S.goto1,
S.answer_2,S.ascore_2,S.goto2,
S.answer_3,S.ascore_3,S.goto3,
S.answer_4,S.ascore_4,S.goto4,
S.type
FROM games_steps S 
/*LEFT JOIN avatars A on A.id=S.avatar_id */
WHERE S.gameId =".$G['gameId']." 

ORDER BY step ASC";  /*ids ASC, */
//$G["strS"]=$strS;
$qS=sql_query($strS);
if (sql_error()) {
	echo sql_error();
	die();
}
$FACTOR=2;
$G["AB"]=array();
$stepC=0;
while (	$ST=sql_fetch_assoc($qS)	){
	
	$ST["answerN"]=2;if ($ST["answer_3"]) $ST["answerN"]=3;if ($ST["answer_4"]) $ST["answerN"]=4;;if ($ST["answer_5"]) $ST["answerN"]=5;
	$ST["avatar_posA"]=explode(",",$ST["avatar_pos"] ); 
	@$ST["avatar_posA"][0]=$ST["avatar_posA"][0]*$FACTOR;
	$ST["avatar_posA"][1]=$ST["avatar_posA"][1]*$FACTOR;
	$ST["balloon_posA"]=explode(",",$ST["balloon_pos"] ); 
	$ST["balloon_posA"][0]=$ST["balloon_posA"][0]*$FACTOR;
	$ST["balloon_posA"][1]=$ST["balloon_posA"][1]*$FACTOR;

	$ST["arrowY"]=$ST["arrowY"]*$FACTOR;
	$ST["A"]=array();
	$ST["attQ"]="SELECT scene, title, path, type
	FROM games_steps_attachments WHERE gameId=".$G['gameId']." AND step=".$ST['step']." ORDER BY idAttachment ASC";
	$aA=sql_query($ST["attQ"]);
	if (sql_error()) $ST["attQE"]=sql_error();
	unset ($ST["attQ"]);
	
	while (	$ATT=sql_fetch_assoc($aA)	){	
		$ATT["open"]="out";
		$ATT["info"]=$ATT["type"];
		
		if ($ATT["type"]=="attach") {
			$tmpi=explode(".", $ATT["path"]);
			$ATT["info"]=strtolower($tmpi[	(sizeof($tmpi)-1)			]);
			$ATT["path"]=ltrim($ATT["path"], "/");
			#####################
			if ($ATT["info"]=="jpg" || $ATT["info"]=="png") {

				$ATT["open"]="in";
				$size=@getimagesize(C_ROOT."/".$ATT["path"]);
				$ATT["H"]=$size[1];
				$ATT["W"]=$size[0];
				$ATT["majordim"]="W";
				if ($ATT["H"]>$ATT["W"]) $ATT["majordim"]="H";
				if ($ATT["H"]==$ATT["W"]) $ATT["majordim"]="H";
				//////////////////
				if ($ATT["majordim"]=="W") {
					if ($ATT["W"]<1000)  {
						$ATT["W1"]=$ATT["W"];
					}else{
						$ATT["W1"]=1000;
					}
					$ATT["H1"]="auto";
				}
				
				if ($ATT["majordim"]=="H") {
					if ($ATT["H"]<562.50)  {
						$ATT["H1"]=$ATT["H"];
					}else{
						$ATT["H1"]=562.50;
					}
					$ATT["W1"]="auto";
				}				
				/////////////			
			}
		}
		
		//is_youtube_video
		if ($ATT["type"]=="link") {
			if (is_youtube_video($ATT["path"])) {
				$ATT["open"]="in";
				$ATT["info"]="youtube";
				$ATT["ytid"]=yt_url2id($ATT["path"])	;
			
				
				
			}
		}		
		$ATT["test"]=$ATT["scene"]." vs ".$ST["scene"];
		if ($ATT["scene"]==$ST["scene"])	$ST["A"][]=$ATT;
		else $ST["compulsoryAttachments"]=0;
		//$ST[	$ATT["scene"]		][]=$ATT;
	}
	$G["AB"][			$ST["scene"].$ST["step"]				]=$stepC	;
	
	$G["ss"][		$ST["scene"]	][		($ST["step"]-1)		]=$ST;
	
	$G["s"][$stepC]=$ST;
	
	$stepC++;
}
$G["avatarsIds"]=array();
if ($G["s"]) foreach($G["s"] as $stepIndex => $step) {
	if ($step["avatar_id"]!=1000	&& 	!in_array($step["avatar_id"], $G["avatarsIds"])	) 	$G["avatarsIds"][]=$step["avatar_id"];
	
	//$O.='<div class="avatar_'.$step["avatar_id"].'_talk wait_S avatarSpriteTalkOff" ></div>';
}

//////////////////////// inizialize Match
if (!$_SESSION["idm_playing"]) {
	//sql_query("TRUNCATE `matches`");sql_query("TRUNCATE `matches_step`");
	$G["Q1"]="INSERT INTO `matches` (`gameId`, `uid`, `start`) VALUES (".$G["gameId"].", ".$_SESSION["uid"].", ".C_TIME.")";
	sql_query($G["Q1"]);
	if (sql_error()) {
		echo sql_error();
		die();
	}
	$G["idm"]=sql_id();	
	
}

///////////////////////////



//////////////////////////

$HEAD_ADD.='<script type="text/javascript">';
$HEAD_ADD.='var G='.json_encode($G).';';
$HEAD_ADD.='</script>';


$AUDIOHTML.='<audio  preload="auto" class="aud" id="aansw" src="" type="audio/mpeg" controls="controls"></audio>'; 
$AUDIOHTML.='<audio  preload="auto" class="aud" id="fx1" src="data/audiosys/Device-start-up-sound-effect.mp3" type="audio/mpeg" controls="controls"></audio>'; 
$AUDIOHTML.='<audio  preload="auto" class="aud" id="fx2" src="data/audiosys/Mario_Jumping-Mike_Koenig-989896458.mp3" type="audio/mpeg" controls="controls"></audio>'; 

//$AUDIOHTML.= '<audio  loop preload="auto" class="aud" id="auback" src="data/audiosys/playerloop02.mp3" type="audio/mpeg"></audio>'; 
$totalSize=0;





//$O.="<pre>".print_r($D,true)."</pre>";$O.="<pre>".print_r($D,true)."</pre>";
//print_r($G);
//die;


/*
$HEAD_ADD.='<script type="text/javascript">';
$HEAD_ADD.='var D='.json_encode($D).';';
if ($PRELOAD)  $HEAD_ADD.='var F='.json_encode($FILES).';var totalSize='.$totalSize.';';
$HEAD_ADD.='var v0='.$G["v0"].';var v1='.$G["v1"].';var v2='.$G["v2"].';var v3='.$G["v3"].';';

$HEAD_ADD.='var useaudio='.$G["audio"].';';
$HEAD_ADD.='var usr_avatar_id='.$G["usr_avatar_id"].';';


$HEAD_ADD.='</script>';

*/













?>