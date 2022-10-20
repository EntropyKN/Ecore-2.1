<?php
//https://cloud.google.com/text-to-speech/


/*
<script src="//code.responsivevoice.org/responsivevoice.js?key=hZR1J9Tp"></script>

AIzaSyDkEBkFR5aQen7yOr0t1X4B6ExUkXKbwjY 

1024X576
512X288
640x360
*/
$JSA[]=''.C_DIR.'/_m/editor/editorCommon.js?'.PAGE_RANDOM;
//$JSA[]=''.C_DIR.'/js/plugins/nstslider/jquery.nstSlider.min.js?'.PAGE_RANDOM;
//$CSSA[]=''.C_DIR.'/js/plugins/nstslider/jquery.nstSlider.min.css?'.PAGE_RANDOM;
//$JSA[]=''.C_DIR.'/js/plugins/jRange/jquery.range-min.js?'.PAGE_RANDOM;	//http://nitinhayaran.github.io/jRange/demo/
//$CSSA[]=''.C_DIR.'/js/plugins/jRange/css.css?'.PAGE_RANDOM;


$CSSA[]=''.C_DIR.'/_m/editor/editCommon.css?'.PAGE_RANDOM;
$CSSA[]=''.C_DIR.'/_m/editor/0/editor_0.css?'.PAGE_RANDOM;
$CSSA[]=''.C_DIR.'/_m/editor/1/editor_1.css?a'.PAGE_RANDOM;

$CSSA[]=''.C_DIR.'/_m/avatars.css.php?screenW=500'; //<--!



$JSA[]='https://code.jquery.com/ui/1.12.1/jquery-ui.js';
//$JSA[]='//code.responsivevoice.org/responsivevoice.js?key=hZR1J9Tp';
//
$JSA[]=''.C_DIR.'/_m/editor/1/editor_1.js?'.PAGE_RANDOM;


#### DATA STEP FORM
/*		scenario
		avatar
		avatar's position
		avatar's sentence=>audio		
		camera on protagonist only		
		answers_N	--->answers' score
*/

$F1=array(
"scene",
"scenario_id",
"avatar_id",
//"avatar_pos_id",
"avatar_sentence",
//"camera_protagonist",
"answer_1",
"ascore_1",
"answer_2",
"ascore_2",
"answer_3",
"ascore_3",
"answer_4",
"ascore_4",
);

$F1t=array(
L_scenario,
L_avatar,
//L_avatar_position,
L_avatar_sentence,
//L_camera_on_protagonist_only,
L_answer." 1",
"",
L_answer." 2",
"",
L_answer." 3",
"",
L_answer." 4"	,
""		//L_score
);

//$F1f=array();


#### DATA GAME
$strG="SELECT C.file coverPath, G.* FROM games G 
LEFT JOIN covers C on G.cover_id=C.id
WHERE G.gameId =".$gameId." ";

$D=sql_fetch_assoc(sql_query($strG));
/*
if ($D["status"]=="playable") {
	header("location: /");
	exit();
}
	
	*/

//echo sql_error();

$HEAD_ADD.='<script type="text/javascript">var D='.json_encode($D).';var F1='.json_encode($F1).';var F1t='.json_encode($F1t).';</script>';
$HEAD_ADD.='<script type="text/javascript">L_sentence="'.L_sentence.'";L_avatar_sentence="'.L_avatar_sentence.'"; var L_loosing_end="'.L_loosing_end.'";var L_winning_end="'.L_winning_end.'"; var L_COMPULSORY_ATTACHMENTS_YES="'.L_COMPULSORY_ATTACHMENTS_YES.'";var L_COMPULSORY_ATTACHMENTS_NO="'.L_COMPULSORY_ATTACHMENTS_NO.'";</script>';


// 

$SQ=sql_query("SELECT * FROM games_steps WHERE gameId =".$gameId." ORDER BY step ASC, scene ASC");	//
$Kstep=0;
while (	$S=sql_assoc($SQ)	){
	$Kstep++;
	$D["s"][		$S["step"]	][		$S["scene"]				]=$S;

}

############### DATA ENDS


$singleEdit=false;
// pop
$O.='<div class="popup">';
	$O.='<div class="popin">';
		$O.=L_do_you_want_to_save_the_changes;
		$O.='<div class="popLine">';
			$O.='<div class="popButt pos" id="ipos">'.L_yes.'</div>';
			$O.='<div class="popButt neg" id="ineg">'.L_no.'</div>';
		$O.='</div>';
	$O.='</div>';
$O.='</div>';
$O.='<div id="spinLoad"></div>';
$O.='<div id="mask" class="opacity50"></div>';


$O.='<div id="core" data-gameId="'.$gameId.'" data-step="'.$D["steps"].'" data-cmtedit="null">';


//
	require_once(C_ROOT."/_m/header/header.inc.php");	
		$O.='<input id="title" type="text" value="'.$D["title"].'">';
		
$O.='<div id="coverMask">';
	$O.='<img src="/data/covers/'.$D["coverPath"].'" width="100%" height="auto" alt="" />';
$O.='</div>';

$O.='<div id="upContainer" class="">';
	//$O.='<div id="mask" class="opacity50"></div>';
	$O.='<div id="upContainerL" class="">';
	
	//if ($D["structure"]	=="fork" && $stepN> $D["forkFrom"]) {	
	for ($stepN = 1; $stepN<= $D["steps"]+2; $stepN++) {
		$step=$D["s"][$stepN];
		
		
		//////////////////////////////////////////////////////////////////
		if (sizeOf($step)	>1) $O.='<div class="contFork">'; 
		
		foreach($step as $scene => $V){
			$addClass="";if ($V["type"]=="winning") $addClass=" winningStep";if ($V["type"]=="loosing") $addClass=" loosingStep";

			$scenePrint="";
			if ($D["forkFrom"]>0		&& sizeOf($step)	>1	)  $scenePrint=" ".$V["scene"];
			
			$O.='<div id="stepM_'.$V["step"].'_'.$V["scene"].'" class="upContainerBox'.$addClass.'">';
			
			if (sizeOf($step)	>1) 	$O.='<div class="linePathM"></div>'; 
			else 							$O.='<div class="linePathFork"></div>'; 
			
			if ($V["step"]==3) $O.='<div id="editingAdvice"><span>'.L_editing.'</span><div class="triangleEdit"></div></div>';
			if ($V["scenario_id"]) 
				$O.='<img class="upContainerBoxImg boxScenario" src="/data/scenarios/'.$V["scenario_id"].'_640.jpg" width="100%" height="auto" alt="" />';
			else 
				$O.='<img class="upContainerBoxImg" src="/data/scenarios/editMenu_640x360.png?b" width="100%" height="auto" alt="" />';				

			if (!$V["type"]) 	$O.='<div class="upContainerBoxLegend">'.$V["step"].'/'.$D["steps"].$scenePrint.'</div>';
			if ($V["type"]=="winning") $O.='<div class="upContainerBoxLegend">'.L_winning_end.'</div>';
			if ($V["type"]=="loosing") $O.='<div class="upContainerBoxLegend">'.L_loosing_end.'</div>';
	
			$O.='</div>';		
		}
		if (sizeOf($step)	>1) $O.='<div class="clear"></div></div>'; 
		////////////////////////////////////////////		

	}
	
	// winning 

	
	//loosing	
	
	
		//$V=$D["s"][$K];
		// io sono k e devo vedere se esiste $D["s"][)$k+2)]
		
		
/*		$O.='<div class="test">';
			$O.="$K ".$step["step"]." ".$step["scene"];
//			$O.=" {prossima B? ".$D["s"][	($k+1)		] ["scene"] ."} ";
		$O.='</div>';
	}
*/	
/*		for ($step = 1; $step<= ($D["steps"]+2); $step++) {
			$addClass="";if ($D["s"][$step]["type"]=="winning") $addClass=" winningStep";if ($D["s"][$step]["type"]=="loosing") $addClass=" loosingStep";
			$scene=$D["s"][$step]["scene"];

//			if ($D["s"][$step]["forkFrom"]) 
			
			// case linear:							
			$O.='<div id="stepM_'.$step.'_'.$scene.'" class="upContainerBox'.$addClass.'">';
				if ($step==3) $O.='<div id="editingAdvice"><span>'.L_editing.'</span><div id="triangleEdit"></div></div>';				
				if ($step==$D["steps"]+1)  $O.='<div class="ending upContainerBoxLegend">'.L_endings.':</div>';				
				if ($D["s"][		$step		]["scenario_id"]) 
					$O.='<img class="upContainerBoxImg boxScenario" src="/data/scenarios/'.$D["s"][		$step		]["scenario_id"].'_640.jpg" width="100%" height="auto" alt="" />';
				else 
					$O.='<img class="upContainerBoxImg" src="/data/scenarios/editMenu_640x360.png?b" width="100%" height="auto" alt="" />';
				if (!$D["s"][$step]["type"]) $O.='<div class="upContainerBoxLegend">'.$step.''.$scene.'/'.$D["steps"].'</div>';
				else 
				if ($D["s"][$step]["type"]=="winning") $O.='<div class="upContainerBoxLegend">'.L_winning_end.'</div>';
				if ($D["s"][$step]["type"]=="loosing") $O.='<div class="upContainerBoxLegend">'.L_loosing_end.'</div>';
				
				//$O.='<img class="boxAvatar" src="/data/scenarios/editMenu_640x360.png?b" width="100%" height="auto" alt="" />';
				
				
			$O.='</div>';				
			$O.='<div class="clear"></div>';		
//			$O.='<div id="" class="upContainerBox">'.$step.'</div>';
		}
		
	*/	
	$O.='</div>';	

	$O.='<div id="upContainerR" class="">';
			## title
		$O.='<div id="stepTit">Step <span>1</span>/'.$D["steps"];
		if ($D["forkFrom"]>0) $O.='<span>A</span>';
		$O.='</div>';
		$O.='<div id="stepTitEnding">';$O.='</div>';
		$O.='<div class="clear"></div>';			
		/*
		
		scenario
		avatar
		avatar's position
		avatar's sentence=>audio		
		camera on protagonist only		
		answers
		answers' score
    [0] => scenario_id
    [1] => avatar_id
    [2] => avatar_sentence
    [3] => answer_1
    [4] => ascore_1
    [5] => answer_2
    [6] => ascore_2
    [7] => answer_3
    [8] => ascore_3
    [9] => answer_4
    [10] => ascore_4		
		
		*/

 foreach($F1 as $key => $f){
	
	switch ($f) {
		case "scenario_id":
			// select scenario
			$O.='<select size="1" name="'. $f.''.PAGE_RANDOM.'" class="select230" id="'.$f.'">';
				$O.='<option value="0">'.L_select_scenario.' 0</option>'; 			
				$scenarioQ=sql_query	("SELECT id, name FROM scenarios order by name ASC");
				echo sql_error();
				$AFC=0;
				while (	$scenario=sql_assoc($scenarioQ)	){
					//$sourceS="/data/avatar_prev/".$scenario["id"].".mp4";
					$O.='<option id="'.$scenario["id"].'" value="'.$scenario["id"].'"'.$selected.'>'.$scenario["name"].'</option>';
					$AFC++;
				}
			 $O.='</select>';
			 
			// select avatar
			$O.='<select size="1" name="avatar_id'.PAGE_RANDOM.'" class="select230" id="avatar_id">';
				$O.='<option value="0" selected="selected">'.L_select_avatar.'</option>'; 			
				$QAF=sql_query	("SELECT id, name FROM avatars where 1 AND  id!=4 order by FIELD(id, 1000) ASC  , name ASC");
				while (	$avatar=sql_assoc($QAF)	){
					if ($avatar["name"]=="L_no_avatar") $avatar["name"]=L_no_avatar;
					$O.='<option id="'.$avatar["id"].'" value="'.$avatar["id"].'"'.$selected.'>'.$avatar["name"].'</option>';
				}
			 $O.='</select>';			 
			 
			 
			$O.='<div class="clear"></div>';

			$O.='<div id="fakePlayer">'; //pointer_left.png
				$O.='<div id="balloon"><span>Hola chico!</span><img src="/img/pointer_left.png" id="leftArrow" alt="" /><img src="/img/pointer_right.png" id="rightArrow" alt="" /></div>';
				$O.='<img src="/data/scenarios/0_640.jpg" class="sceneimg" alt="" />';
				//$O.='<div id="avatar" class="avatar_500 wait_1"></div>';
				//$O.='<div id="avatar" class="avatar_H260 wait_1"></div>';
				
				//$O.='<div class="avatar_1 wait_W500"></div>';  left:277px;top:16px
				$O.='<div  id="avatarSprite" data-currentAvatar="0" data-pos="264,3" data-currentSize="S" class="avatar_0 wait_S" title="'.L_drag_to_reposition.'"></div>';
				
				//$O.='<div class="monster3_500"></div>';
				
				//$O.='<img src="/data/avatar_prev/1/1_listen_w360.gif" class="sceneavatar" alt="" />';
//				$O.='<img src="/data/avatar_prev/0/0_listen_w360.png?'.PAGE_RANDOM.'" class="sceneavatar sceneavatarPrimo" alt="" />';
			$O.='</div>';	
			
			$O.='<div id="avatarDims">';
				$O.='<span>'.L_avatar_size.":</span>";
				$O.='<a href="#" id="as_XS">XS</a> ';
				$O.='<a href="#" class="don" id="as_S">S</a> ';
				$O.='<a href="#" id="as_M">M</a> ';
				$O.='<a href="#" id="as_L">L</a> ';
				$O.='<a href="#" id="as_XL">XL</a> ';
				
			$O.='</div>';	
			//$O.='<div class="monster1_500"></div>';

			//$O.='<div class="avatar_3_500"></div>';
		break;

		case "avatar_sentence":
/*
Rayo de sol,
buscador del inspiraciòn,
forma el paisaje de la vida,
dibujas a pintadas libres,
el tango de la naturaleza,
como el toque suave
de la mano velazqueziana
en su lienzo "las meninas".
*/		
		
			$O.='<div id="avatar_sentence_title" class="subtitle"><span>'.L_avatar_sentence.'</span>:<div id="digit" class="advice">'.L_digit.'</div></div>';
			$O.='<textarea maxlength="800" rows="4" id="avatar_sentence" class="get textarea" cols="50" style="height: 55px;"></textarea>';
			$O.='<div id="audioManage">';$O.='</div>';	
			//if ($D["audio"]){
			$O.='<div class="audioline">';
				$O.='';
			
				$O.='<div id="loadingAudio" class="loading"></div>';
				$O.='<img id="imgAudio" src="/img/ico/audio16off.png?asd" alt=""  />';		
						
				$O.='<div id="audioCmd">';
					$O.='<a href="#" id="generateAudio">'.L_generate.'</a> <span>'.L_OR.'</span>';
					$O.='<a href="#" id="upLoadAudio" class="audioLoadFake tip" data-d="au'.($p+1).'" id="auimg'.($p+1).'" data-titlebis="'.L_delete_the_current_audiofile_and_upload_a_new_one.'" title="'.L_upload_an_audio_file.'">'.L_upload.'</a> ';
				$O.='</div>';
				
				$O.='<span id="audioControls">';
					$O.='<img data-file="" class="audioPlay tip" data-d="au'.($p+1).'" id="auimgplay'.($p+1).'" src="/img/ico/audioPlay14on.png" alt="" title="'.L_play.'" />';
					$O.='<img class="audioPause tip" data-d="au'.($p+1).'" id="auimgpause'.($p+1).'" src="/img/ico/audioPause14on.png" alt="" title="'.L_pause.'" />';
					$O.='<img class="audioDelete tip" id="audioDelete"  src="/img/ico/cross16.png" alt="" title="'.L_remove.'" />';
					$O.='</span>';
				$O.='<input id="au'.($p+1).'" type="file" class="audioLoad" name="a'.PAGE_RANDOM.'" accept="audio/*"/>';
				
				
//				$O.='<div class="fileUpload">';
					//$O.='<img class="audioLoadFake tip" data-d="au'.($p+1).'" id="auimg'.($p+1).'" src="/img/ico/audio16off.png?asd" alt="" data-titlebis="'.L_delete_the_current_audiofile_and_upload_a_new_one.'" title="'.L_upload_an_audio_file.'" />';
//				$O.='</div>';

			$O.='<span id="generateGroup">';
			 $O.='<select class="select230" id="voice">';
				$O.='<option value="'.$languages_lcode[$D["language"]][0].',female"'.$selected.'>'.$languages_names[$D["language"]].' ('.strtoupper($languages_lcode[$D["language"]][0]).') '.L_feminine.'</option>';
				$O.='<option value="'.$languages_lcode[$D["language"]][0].',male"'.$selected.'>'.$languages_names[$D["language"]].' ('.strtoupper($languages_lcode[$D["language"]][0]).') '. L_masculine.'</option>';
			 $O.='</select>';
			$O.='<a href="#" id="generateGo">'.L_generate.'</a>';
			$O.='</span>';


					$O.='<audio id="player" controls="controls" >'; //
							//$O.='<source src="/data/audio/TEST.mp3" type="audio/mpeg">';//pds
					$O.='</audio>';
	
	

			$O.='</div>'; //audioline
			

			
		break;
	}
	
	
 }

$O.='<div id="noFinalBlock">';

	$O.='<div id="players_answers_title" class="subtitle">'.L_players_answers.':<div class="subtitleR1">'.L_goto.':</div><div class="subtitleR">'.L_score.':</div></div>';
	// "answer_1", "ascore_1",
	for ($answ = 1; $answ<= 4; $answ++) {
		if ($answ > 2) {
			$O.='<div id="ascore_v_'.$answ .'">';
		}
		// textarea_answTight
		//$addClass=""; 
		$O.='<textarea maxlength="255" rows="2" id="answer_'.$answ.'" class="textarea_answ textarea" cols="50" style="height: 33px;"></textarea>';
		$O.='<select class="select ascore" id="ascore_'.$answ.'">';
			$O.='<option value="na">?</option>';
			for ($v = 0; $v<= 10; $v++) {	$O.='<option value="'.$v.'">'.$v.'</option>';	}
		$O.='</select>';

		$O.='<select class="select goto" id="goto'.$answ.'">';
			//$O.='<option value="na">?</option>';
			$O.='<option id="goto_'.$answ.'_A" value="A">2/3 A</option>';
			$O.='<option id="goto_'.$answ.'_B" value="B">2/3 B</option>'; //data-a="A" selected="selected"
		$O.='</select>';

		
		if ($answ == 3 ) $O.='<div class="clear"></div><a class="addAnswer" id="addAnswer_'.($answ+1).'" href="#">+ '.L_add_an_answer.'</a>';
		
		$O.='<div class="clear"></div>';
		if ($answ > 2) $O.='</div>';
	}
	
	
	$O.='<div class="subtitle">'.L_attachments.':</div>';

		$O.='<div id="attachmentLine">';
			$O.='<a id="file" class="attLnk" href="#">'.L_file.'</a> <span class="or">'.L_OR.'</span> '; 
			$O.='<input id="url" value="" name="url'.PAGE_RANDOM.'" type="text">';
			$O.='<a id="link" class="attLnk" href="#">'.L_add_url.'</a>';
			$O.='<input id="attachmentInput" type="file" class="attachmentInputC" name="ATT'.PAGE_RANDOM.'" >'; //accept="audio/*"/
		$O.='</div>';
		
	

		$O.='<div id="attachments">';
		for ($att = 1; $att<= 5; $att++) {
			$attType="attach";
			if ($att == 3 || $att === 5) $attType="link";
			$O.='<div id="attachments_L_'.$att.'" class="attachments_L">';
			//$O.=$att;
				$O.='<a id="href_att_'.$att.'" href="#" target="_BLANK"><img class="attImg" src="img/ico/'.$attType.'60.png" width="32" height="32" alt="" /></a>';
				$O.='<input class="attTitle" title="'.L_edit_title.'" data-ida="0" id="attTitle_'.$att.'" value="" name="attTitle'.PAGE_RANDOM.'" type="text">';
				$O.='<img class="attDelete" id="attDelete_'.$att.'" data-ida="0" src="/img/ico/cross16.png" alt="" title="'.L_remove.'" />';
				$O.='<div class="clear"></div>';
			$O.='</div>';
		}
		$O.='</div>';

		$O.='<div id="compulsoryAttachmentsBox" data-compulsoryAttachments="0">';
			$O.='<div id="compulsoryAttachmentsMsg">';	
			$O.=L_COMPULSORY_ATTACHMENTS_NO."";
			$O.='</div>';
			$O.='<div id="compulsoryAttachmentsChange">';	
			$O.=L_change."";
			$O.='</div>';
		$O.='</div>';

$O.='</div>';	//id="noFinalBlock">';



	
	
	$O.='</div>';	 ///////////////////////////////////////////////////////cont





$O.='</div>';	//upContainer end
/*

$O.='<div  id="rangeGraph200T" class="int">'.L_qualitative_comment.'</div>';

$O.='<div id="rangeGraph200">';

	$O.='<div id="rgl0"><span>0</span></div>';
	$O.='<div id="rgl100p">-100</div>';
	$O.='<div id="rgl100m">+100</div>';
	$O.='<div id="sorange"></div>';
	$O.='<div class="gradientGreyWhite" id="rg1"><span>-0</span></div>';// -100 v1
	$O.='<div class="gradientGreyWhite" id="rg2"><span>+0</span></div>'; // v1 v2
	
	for ($p = 1; $p <= 8; $p++) {
		if ($p>=3 && $p<=6) {
			$class="ppp pppC";
		}else{
			$class="ppp";
		}
		$O.='<div class="'.$class.'" id="p'.$p.'">';

			$cmtvalue=""; $cmtclass="";
			if ($D[	'fc'.$p		]) {$cmtvalue=$D[	'fc'.$p		];$cmtclass=" cmton";}			
			$O.='<div title="'.L_insert_comment.'" class="cmt'.$cmtclass.'" id="cmt_fc_'.$p.'"></div>';
			$O.='<div data-delta="x,y" class="cmtareac" id="cmtareac_fc_'.$p.'"><div  id="faketxt_fc_'.$p.'" class="faketxt">'.L_comment_result_for_this_range.'</div><div class="pointer_up"></div><textarea  name="cmtarea_fc_'.$p.''.PAGE_RANDOM.'" id="cmtarea_fc_'.$p.'" />'.$cmtvalue.'</textarea><div id="cmtsave_fc_'.$p.'" class="cmtsave">'.L_ok.'</div></div>';
	
			$O.='<span>'.$p.'</span>';
		$O.='</div>';	
	}

$O.='</div>';
*/
$O.='<div class="clear"></div>';
$O.='<div class="downContainer" id="qualitativeBox" data-available="0">';
	$O.='<div class="downContainerIN">';
	
	$O.='<div class="subtitlePar">'.L_score.' '.L_AND.' '.L_qualitative_comments.':</div>'; 
	$O.='<div id="fgraphNotAvailable">'.L_not_available_yet.'&gt; <span>...<span></div>';
	
	$O.='<div id="fgraph">';	
		///data/scenarios/6_640.jpg
		$O.='<div id="loosing" data-step="'.($D["steps"]+2).'">';
			$O.='<div class="lwArea">'.L_loosing_area.' &lt;</div>';
		
			$scen="editMenu_640x360.png";$addClassS="";if ($D["s"][	$D["steps"]+2	]["scenario_id"]) {$scen=$D["s"][	$D["steps"]+2	]["scenario_id"]."_640.jpg";$addClassS="isScenario";}
			$O.='<img class="'.$addClassS.'" id="boxScenarioLose" src="/data/scenarios/'.$scen.'" alt="" />';
		$O.='</div>';
		
		
		$O.='<div id="winning" data-step="'.($D["steps"]+1).'">';
			$O.='<div class="lwArea">&gt; '.L_winning_area.'</div>';
			$scen="editMenu_640x360.png";$addClassS="";if ($D["s"][	$D["steps"]+1	]["scenario_id"]) {$scen=$D["s"][	$D["steps"]+1	]["scenario_id"]."_640.jpg";$addClassS="isScenario";}
			$O.='<img class="'.$addClassS.'" id="boxScenarioWin" src="/data/scenarios/'.$scen.'" alt="" />';

		$O.='</div>';

		$O.='<div class="gLegend" id="gLegend0">0%<div class="subGlegend">Score:<span>0</span></div></div>';
		$O.='<div class="gSeparator" id="gSeparator0"></div>';


		$O.='<div class="gLegend" id="gLegend50">50%<div class="subGlegend">Score:<span>70</span></div></div>';
		$O.='<div class="gSeparator" id="gSeparator50"></div>';

		$O.='<div class="gLegend" id="gLegend100">100%<div class="subGlegend">Score:<span>140</span></div></div>';
		$O.='<div class="gSeparator" id="gSeparator100"></div>';


	$O.='<div class="boxQuarterL" title="'.L_insert_comment.'" id="L1">L1';
		$O.='<div title="'.L_insert_comment.'" class="cmt" id="cmt_L1"></div>'; $p="L1";
		$O.='<div data-delta="x,y" class="cmtareac" id="cmtareac_fc_'.$p.'"><div  id="faketxt_fc_'.$p.'" class="faketxt">'.L_comment_result_for_this_range.'</div><div class="pointer_up"></div><textarea  name="cmtarea_fc_'.$p.''.PAGE_RANDOM.'" id="cmtarea_fc_'.$p.'" />'.$cmtvalue.'</textarea><div id="cmtsave_fc_'.$p.'" class="cmtsave">'.L_ok.'</div></div>';		
	$O.='</div>';
	$O.='<div class="boxQuarterL" title="'.L_insert_comment.'" id="L2">L2';
		$O.='<div title="'.L_insert_comment.'" class="cmt" id="cmt_L2"></div>';$p="L2";
		$O.='<div data-delta="x,y" class="cmtareac" id="cmtareac_fc_'.$p.'"><div  id="faketxt_fc_'.$p.'" class="faketxt">'.L_comment_result_for_this_range.'</div><div class="pointer_up"></div><textarea  name="cmtarea_fc_'.$p.''.PAGE_RANDOM.'" id="cmtarea_fc_'.$p.'" />'.$cmtvalue.'</textarea><div id="cmtsave_fc_'.$p.'" class="cmtsave">'.L_ok.'</div></div>';		
	$O.='</div>';
	
	$O.='<div class="boxQuarterL" title="'.L_insert_comment.'" id="L3">L3';
		$O.='<div title="'.L_insert_comment.'" class="cmt" id="cmt_L3"></div>';$p="L3";
		$O.='<div data-delta="x,y" class="cmtareac" id="cmtareac_fc_'.$p.'"><div  id="faketxt_fc_'.$p.'" class="faketxt">'.L_comment_result_for_this_range.'</div><div class="pointer_up"></div><textarea  name="cmtarea_fc_'.$p.''.PAGE_RANDOM.'" id="cmtarea_fc_'.$p.'" />'.$cmtvalue.'</textarea><div id="cmtsave_fc_'.$p.'" class="cmtsave">'.L_ok.'</div></div>';		
	$O.='</div>';

	
	$O.='<div class="boxQuarterL" title="'.L_insert_comment.'" id="L4">L4';
		$O.='<div title="'.L_insert_comment.'" class="cmt" id="cmt_L4"></div>';$p="L4";
		$O.='<div data-delta="x,y" class="cmtareac" id="cmtareac_fc_'.$p.'"><div  id="faketxt_fc_'.$p.'" class="faketxt">'.L_comment_result_for_this_range.'</div><div class="pointer_up"></div><textarea  name="cmtarea_fc_'.$p.''.PAGE_RANDOM.'" id="cmtarea_fc_'.$p.'" />'.$cmtvalue.'</textarea><div id="cmtsave_fc_'.$p.'" class="cmtsave">'.L_ok.'</div></div>';		
	$O.='</div>';
	
	$O.='<div title="'.L_insert_comment.'" class="boxQuarterW"  id="W1">W1';
		$O.='<div title="'.L_insert_comment.'" class="cmt" id="cmt_W1"></div>';;$p="W1";
		$O.='<div data-delta="x,y" class="cmtareac" id="cmtareac_fc_'.$p.'"><div  id="faketxt_fc_'.$p.'" class="faketxt">'.L_comment_result_for_this_range.'</div><div class="pointer_up"></div><textarea  name="cmtarea_fc_'.$p.''.PAGE_RANDOM.'" id="cmtarea_fc_'.$p.'" />'.$cmtvalue.'</textarea><div id="cmtsave_fc_'.$p.'" class="cmtsave">'.L_ok.'</div></div>';		
	$O.='</div>';	
	
	$O.='<div title="'.L_insert_comment.'" class="boxQuarterW"  id="W2">W2';
		$O.='<div title="'.L_insert_comment.'" class="cmt" id="cmt_W2"></div>';;$p="W2";
		$O.='<div data-delta="x,y" class="cmtareac" id="cmtareac_fc_'.$p.'"><div  id="faketxt_fc_'.$p.'" class="faketxt">'.L_comment_result_for_this_range.'</div><div class="pointer_up"></div><textarea  name="cmtarea_fc_'.$p.''.PAGE_RANDOM.'" id="cmtarea_fc_'.$p.'" />'.$cmtvalue.'</textarea><div id="cmtsave_fc_'.$p.'" class="cmtsave">'.L_ok.'</div></div>';		
	$O.='</div>';	
	
	$O.='<div title="'.L_insert_comment.'" class="boxQuarterW"  id="W3">W3';
		$O.='<div title="'.L_insert_comment.'" class="cmt" id="cmt_W3"></div>';;$p="W3";
		$O.='<div data-delta="x,y" class="cmtareac" id="cmtareac_fc_'.$p.'"><div  id="faketxt_fc_'.$p.'" class="faketxt">'.L_comment_result_for_this_range.'</div><div class="pointer_up"></div><textarea  name="cmtarea_fc_'.$p.''.PAGE_RANDOM.'" id="cmtarea_fc_'.$p.'" />'.$cmtvalue.'</textarea><div id="cmtsave_fc_'.$p.'" class="cmtsave">'.L_ok.'</div></div>';		
	$O.='</div>';	
	$O.='<div title="'.L_insert_comment.'" class="boxQuarterW"  id="W4">W4';
		$O.='<div title="'.L_insert_comment.'" class="cmt" id="cmt_W4"></div>';$p="W4";
		$O.='<div data-delta="x,y" class="cmtareac" id="cmtareac_fc_'.$p.'"><div  id="faketxt_fc_'.$p.'" class="faketxt">'.L_comment_result_for_this_range.'</div><div class="pointer_up"></div><textarea  name="cmtarea_fc_'.$p.''.PAGE_RANDOM.'" id="cmtarea_fc_'.$p.'" />'.$cmtvalue.'</textarea><div id="cmtsave_fc_'.$p.'" class="cmtsave">'.L_ok.'</div></div>';		
	$O.='</div>';	



	$O.='</div>';//downContainerIN
	$O.='</div>';

//////////////////////////////////////////////////



$O.='<div class="downContainer" id="downContainerStatus">';
$O.='<div class="downContainerIN">';
	$O.='<a href="/'.C_DIRNS.'/?editor/'.$gameId.'/0/" href="" class="editButt backbtn noselect"><img class="editButtArrowR" src="/img/arrowBigLeft999.png" alt="" /><span class="l1">'.L_back.'</span><span class="l2">'.L_to_the_first_step.'</span></a>';

	$O.='<div id="centrend">';
		$O.='<span id="missingmsg">'.L_EDITOR_CHECK_TEXT.'<br /><a id="checkmissing" href="#">'.L_check_missing_values.'</a></span>';
		$O.='<span id="missingList"></span>';
		$O.='<span id="okmsg" class="noselect">';
			$O.=L_save_the_game_as_playable;
				$O.='<span>';
				$O.=L_SAVE_PLAYABLE_ADVICE; 
				$O.='</span>';
		$O.='</span>';
	$O.='</div>';

	$O.='<a href="/'.C_DIRNS.'/?/desktopplayer/'.$D["gameId"].'/simulate" target="_blank"  id="playerSimLilnk" class="editButt rightbtn noselect"><img class="editButtArrow" src="/img/arrowBigRight999.png" alt="" /><span class="l3">'.L_playing_simulation.'</span></a>';
	$O.='<a href="/'.C_DIRNS.'/?debrief/1/1/" target="_blank"  id="debriefSimLilnk" class="editButt rightbtn noselect simLink"><img class="editButtArrow" src="/img/arrowBigRight999.png" alt="" /><span class="l3">'.L_debriefing_simulation.'</span></a>';


$O.='</div>';//"downContainerIN">';
$O.='</div>';




$O.='<div class="clear"></div>';






if ($_COOKIE["debug"]){
	$O.= "<pre><br />";
	$O.=print_r(gameIntervalCalc($gameId) ,true);
	$O.=print_r($D,true);
	//print_r($voice);
	//$O.=$gameId;
	//	$O.="comm";
	//$O.=print_r(	aDim(0,550)			,true);
	//$O.=print_r(	aDim(250,0)			,true);
	//	$O.=print_r($F1t,true);
	//	$O.=print_r($F1,true);
	//	$O.=print_r($sentences,true);
	
	//	$O.=print_r($D,true);
	//	$O.="</pre>";
}
$O.="</div>";// core




?>