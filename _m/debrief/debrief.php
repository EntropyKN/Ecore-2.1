<?php 
////////////////////////////
include_once(C_ROOT."/config/php.function.games.php");
$D=finalCalc2($DIRA[1],false);
$D["idm"]=$DIRA[1];
if (!$D["match"]["end"])  die("this match is not over yet<pre>".print_r($D, true)."<pre>");
/////////////////////////////
$D["20HEIGHT"]=-10;
$picShow="";
$spacePic=90;
$topStart=-20;

foreach($D["s"] as $k => $v) {
	//$O.="$k $v <br />";
	$D["sss"][]=$v;
}

foreach($D["sss"] as $k => $exc) {
	
		//$O.="<pre>".print_r($exc,true)."</pre>";
		//$O.="$k1 <br />";
		if ($exc["type"]) break;
		$classColorDot="darkRed";
		if ($exc["scorePercentShow"]>49.999999999) {$classColorDot="darkGreen";}
			
		
		$top=$topStart+(($k+1)*$spacePic );
		$D["20HEIGHT"]=$topStart+(($k+1)*$spacePic);
		$picShow.='<div id="stGr_'.$k.'" style="top:'.$top.'px" class="exchange"><span style="left:'.$exc["scorePercent"].'%" title="'.$exc["scorePercent"].'%"	>';
			$picShow.='<img class="opacityNO" src="/data/scenarios/'.$exc["scenario_id"].'_640.jpg" alt="" />';
			$picShow.='<div class="stGr_in opacity90 '.$classColorDot.'"></div>';
			$picShow.='<div class="stGr_text">'.$exc["scorePercent"].'%</div>';
		$picShow.='</span></div>'; //.$exc["question"].
		
	}

$D["20HEIGHT"]=$D["20HEIGHT"]+100;

$HEAD_ADD.='<style>.d20 span{height:'.$D["20HEIGHT"].'px}</style>';

/////////////////////////////
$commentBasic=array(
"L1"=>L_L1_SHORT_COMMENT,
"L2"=>L_L2_SHORT_COMMENT,
"L3"=>L_L3_SHORT_COMMENT,
"L4"=>L_L4_SHORT_COMMENT,

"W1"=>L_W1_SHORT_COMMENT,
"W2"=>L_W2_SHORT_COMMENT,
"W3"=>L_W3_SHORT_COMMENT,
"W4"=>L_W4_SHORT_COMMENT,
);

///////////////////////
$NOTE="";
$NOTE.="<span class=\"lll\">".L_the_scale_of_values_varies_from_0_to_100_percent."</span> ";
//$NOTE.=" &bull; ";
$the_winning_area_goes=L_the_winning_area_goes_from_X_to_Y;
$the_winning_area_goes=str_replace("#X#","50%", $the_winning_area_goes);
$the_winning_area_goes=str_replace("#Y#","100%", $the_winning_area_goes);

$NOTE.="<span class=\"lll\">".$the_winning_area_goes."</span> ";


$NOTE.="<span class=\"lll\">";
	$NOTE.="<strong>";
	$NOTE.=L_reached_score;
	$NOTE.="</strong>";
	$NOTE.=": ";
	$NOTE.=''.$D["scorePercent"].'%';
$NOTE.="</span>";





$NOTE.="<span class=\"lll\">";
	$NOTE.="<strong>";
	$NOTE.=L_total_time_played;
	$NOTE.="</strong>";
	$NOTE.=": ";
	$NOTE.=getElapsedTimeString($D["match"]["end"]-$D["match"]["start"]);
$NOTE.="</span>";


//////////////////////
$CSSA[]=''.C_DIR.'/_m/debrief/response.css?'.PAGE_RANDOM;	
$O.='<div id="mask" class="opacity50"></div>';
$O.='<div id="core" data-gameId="'.$gameId.'">';

require_once(C_ROOT."/_m/header/header.inc.php");
$O.='<div id="coreIn">';
	


/////////////////////////
	$O.="<span class=\"note\">$NOTE</span>";
	
	$O.='<div class="titleD">';
		$O.=$D["game"]["title"];
	$O.="</div>";


	$O.='<div class="subtitle">';
		$O.=L_session_date." ";
		// timestamp2red($ts, $mode="long", $lang="it")
		$O.=timestamp2red($D["match"]["start"], $mode="long",$_SESSION["lang"]);
		$O.=" - ".timestamp2red($D["match"]["end"], $mode="long", $_SESSION["lang"]);
		//;
	$O.="</div>";
	
	
	

$page["titlePre"]=L_game_debriefing." - ".$D["game"]['title']." ".timestamp2red($D["match"]["start"], "long", $_SESSION["lang"])." - ";

/////////////////////////
$O.='<div class="titleRes">'.$commentBasic[				$D["spread"]["spread"]			]		.': '.$D["scorePercent"].'%</div>';
$O.='<div class="commentQ">'.$D["comment"]	.'</div>';



/*	$O.='<div class="titleNF">'.L_debrief.'</div>';
*/
	$classColor="darkRed";$colA="red";
	if ($D["scorePercent"]>49.999999999) {$classColor="darkGreen";$colA="green";}
	
	$O.='<div id="containerRightP">';
		//$O.='<div id="containerRightPtitle">Livello totale '.$D["scorePercentPrint"]."%: ".UC_first($D["comment"]);
		//$O.='right</div>';
		$O.='<div id="termometro">';
				$O.='<div id="mercurioBack" class="opacity70"></div>';	
				$O.='<div id="mercurio" class="'.$classColor.'" style="width:'.$D["scorePercent"].'%"></div>';				
				
				$O.='<div id="termometroScoreCont" class="'.$classColor.'" style="left:'.$D["scorePercent"].'%">';
					$O.=''.$D["scorePercentPrint"].'%';
					$O.='<span class="'.$classColor.'Left"></span>';
					$O.='<div id="arrow" style="background-image:url(\'img/arrowDown16x16_'.$colA.'.png\')"></div>';		
				$O.='</div>';		
					
				$O.='<div class="d20" id="L1"><span></span><div class="tarea">L1</div>';$O.='</div>';
				$O.='<div class="d20" id="L2"><span></span><div class="tarea">L2</div>';$O.='</div>';
				$O.='<div class="d20" id="L3"><span></span><div class="tarea">L3</div>';$O.='</div>';
				$O.='<div class="d20" id="L4"><span></span><div class="tarea">L4</div>';$O.='</div>';
				$O.='<div class="d20" id="W1"><span></span><div class="tarea">W1</div>';$O.='</div>';
				$O.='<div class="d20" id="W2"><span></span><div class="tarea">W2</div>';$O.='</div>';
				$O.='<div class="d20" id="W3"><span></span><div class="tarea">W3</div>';$O.='</div>';
				$O.='<div class="d20" id="W4"><span></span><div class="tarea">W4</div>';
				$O.='<span id="closeRight"></span>';$O.='</div>';						
		
			$O.='<div id="mercurioCont"></div>';
		
		////////////////////////////////////
			$O.=$picShow;
		///////////////////////////
		$O.='</div>';	 // termometro

	$O.='</div>';//containerRightP



/////////////////////////////////////
$O.='<div class="clear"></div>';
$O.='</div>';//coreIn
$O.='</div>';//core
$O.='<div class="clear"></div>';
	/*$O.="<br /><br /><br /><pre>";
	$O.=print_r($D["s"], true);
	$O.="</pre>";
*/
if ($_COOKIE["debug"]	|| $_SESSION["uid"]=="328"){
	$O.="<pre>";
	$O.=print_r($D, true);
	$O.="</pre>";
}

$O.="<br /><br /><br /><br /><br /><br /><br /><br /></div>";//


?>