<?php
//$CSSA[]=''.C_DIR.'/_m/editor/edit.css?'.PAGE_RANDOM;
//$JSA[]=''.C_DIR.'/js/plugins/datepick/dp.js';
//$JSA[]=''.C_DIR.'js/plugins/datepick/datepicker.it.js';

$JSA[]=''.C_DIR.'/js/plugins/datepick/dp.js';
$JSA[]=''.C_DIR.'js/plugins/datepick/datepicker.it.js';
$CSSA[]=''.C_DIR.'js/plugins/datepick/datepicker.min.css';

require_once(C_ROOT."/_m/editor/0/data.inc.php");

//$JSA[]='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js';
$JSA[]=''.C_DIR.'/_m/editor/editorCommon.js?'.PAGE_RANDOM;
$JSA[]=''.C_DIR.'/_m/editor/0/editor_0.js?'.PAGE_RANDOM;
//$CSSA[]=''.C_DIR.'js/plugins/datepick/datepicker.min.css';

$CSSA[]=''.C_DIR.'/_m/editor/editCommon.css?'.PAGE_RANDOM;
$CSSA[]=''.C_DIR.'/_m/editor/0/editor_0.css?'.PAGE_RANDOM;
$CSSA[]=''.C_DIR.'/_m/avatars.css.php'; //<--!


$HEAD_ADD.='<script type="text/javascript">var F1='.json_encode($F1).';var F1t='.json_encode($F1t).';var F1f='.json_encode($F1f).'</script>';


if ($gameId>0) {
	$D=sql_queryt("SELECT * FROM games WHERE gameId=$gameId");
	if ($D["status"]=="playable") {
		header("location: /");
		exit();
	}
	
	
	$D["stepsBefore"]=$D["steps"];
	$D["structureBefore"]=$D["structure"];

	if ($D["valid_until"]) $D["valid_until"]=timestamp2it(strtotime($D["valid_until"]),"official");
	if ($D["structure"]!="linear") $disableSteps=" disabled=\"disabled\" ";
}else{
	$disableSteps="";
}
$O.='<div id="mask" class="opacity50"></div>';
$O.='<div id="core" data-gameId="'.$gameId.'">';
require_once(C_ROOT."/_m/header/header.inc.php");

//if ($D) $O.=print_r($D,true);
//$O.="step 1/3<br />";
	$O.='<div class="gymSep">';
	//if ($_COOKIE["debug"])	$O.="<span id=\"fill\" >Fill</span>";
	$O.=L_the_game;
	$O.='</div>';
	
for ($f = 0; $f < sizeof($F1); $f++) {
	$addClassLine="";
	if ($F1[$f]=="valid_until"||$F1[$f]=="estimated_duration"||$F1[$f]=="competence_target"||$F1[$f]=="difficulty_level")  $addClassLine=" optionsGroup";
	if ($F1[$f]=="stepsBefore") 	$addClassLine=" hidden";
	
	$O.='<div class="line'.$addClassLine.'" id="L_'.$F1[$f].'" >';
		
		$O.='<div class="field">';
			$O.=$F1t[$f];
			$O.=":";
		$O.="</div>";
		$inA=explode(",",$F1f[$f]);
		$value=$D[	$F1[$f]	];
		
		$addClass="";
		if ($F1[$f]=="valid_until")  		$addClass='  class="datepicker-here" data-autoClose="true" data-position="bottom left"  data-language="it" readonly="readonly" data-timepicker="false" data-min-view="days" data-view="days" ';
		//if ($F1[$f]=="stepsBefore") 	$addClass=" class=\"hidden\"";
		if ($inA[0]=="input")
			$O.='<input id="'.$F1[$f].'" '.$addClass.' value="'.$value.'" type="text">';
		if ($inA[0]=="area"){
			$O.='<textarea rows="4" id="'.$F1[$f].'" class="get textarea" cols="50">'.$value.'</textarea>';
			if ($F1[$f]=="Goal_1" ||$F1[$f]=="Goal_2" ||$F1[$f]=="Goal_3" ||$F1[$f]=="Goal_4" ) 
				$O.='<a class="addGymGoal" id="addg_'.$F1[$f].'" href="#">+ '.L_add_game_goal.'</a>';
			if ($F1[$f]=="usr_goal1" ||$F1[$f]=="usr_goal2") 
				$O.='<a class="addUsrGoal" id="addgu_'.$F1[$f].'" href="#">+ '.L_add_user_goal.'</a>';
			if ($F1[$f]=="bot_goal1" ||$F1[$f]=="bot_goal2") 
				$O.='<a class="addBotGoal" id="addgb_'.$F1[$f].'" href="#">+ '.L_add_bot_goal.'</a>';
		}
		if ($F1[$f]=="valid_until") $O.='<a id="valid_forever" href="#">'.L_forever.'</a>';


		if ($inA[0]=="select"){
//			 $O.='<select class="select60" id="'.$F1[$f].'">';

			 $O.='<select class="select60" id="'.$F1[$f].'"';
				if ($F1[$f]=="steps"	||$F1[$f]=="forkFrom" ) 	 $O.=$disableSteps;
						 
			 $O.='>';
			 
			 for ($x = $inA[1]; $x <= $inA[2]; $x++) {
				$selected=""; if ($x==$value) $selected=' selected="selected"';
				$xprint=$x;
				if ($F1[$f]=="audio"){
					$xprint=L_no; if ($x>0) $xprint=L_yes;
				}
				$O.='<option value="'.$x.'"'.$selected.'>'.$xprint.'</option>';
			 }
			 $O.='</select>';
			 
			 
			 
		}
		// structure
		if ($F1[$f]=="steps") {
			$O.='<img id="structureImg_linear" src="/img/structure/linear_edit0.png" width="185" height="42" alt="" />';
			$O.='<img id="structureImg_fork" src="/img/structure/fork1_edit0.png" width="187" height="90" alt="" />';
		}		
				
		 if ($F1[$f]=="structure")  	{
			 if (!$value) $value="linear";
			 
			 
			$O.='<select'.$disableSteps.' size="'.$selectSize.'" name="'.$F1[$f].''.PAGE_RANDOM.'" class="select100" id="'.$F1[$f].'">';
				$selected=""; if ($value=="linear") $selected=' selected="selected"';	
				$O.='<option '.$selected.' value="linear">'.L_sequential.'</option>';
				$selected=""; if ($value=="fork") $selected=' selected="selected"';	
				$O.='<option '.$selected.' value="fork">'.L_parallel.'</option>';
			$O.='</select>';
		 }
		
		
		// lang
		if ($inA[0]=="language"){
			if (!$value) $value=$_SESSION["lang"];
			$O.='<select size="'.$selectSize.'" name="'.$F1[$f].''.PAGE_RANDOM.'" class="select230" id="'.$F1[$f].'">';
			foreach($languages_names as $code => $langg) {
				$selected=""; if ($value==$code) $selected=' selected="selected"';				
				
				$O.='<option '.$selected.' value="'.$code.'">'.$langg.'</option>'; //selected="selected"
			}

			$O.='</select>';
		}

		//////////////////////////////////////
		$selectSize=1;
		if ($inA[0]=="usr_female_avatar_id"){
			$O.='<select size="'.$selectSize.'" name="'.$F1[$f].''.PAGE_RANDOM.'" class="select230" id="'.$F1[$f].'">';
			//$O.='<option value="0">'.L_select.'</option>'; //selected="selected"
			
			$QAF=sql_query	("SELECT id, name FROM avatars where sex='f' order by name ASC");
			$AFC=0;

			while (	$avatarF=sql_assoc($QAF)	){
				$selected=""; 
				//
				
				$selected=""; 
				if ($avatarF["id"] && $value==$avatarF["id"]) {
					$selected=' selected="selected"';//$sourceF="/data/avatar_prev/".$value.".mp4";
								$selected_avatar_id=$value;
				}else{ 
					if (!$AFC) {
						$selected=' selected="selected"'; //$sourceF="/data/avatar_prev/".$avatarF["id"].".mp4";
						$selected_avatar_id=$avatarF["id"];
					}
				}
				$O.='<option id="optusr'.$avatarF["id"].'" value="'.$avatarF["id"].'"'.$selected.'>'.$avatarF["name"].'</option>';
				$AFC++;
			}
			
			 $O.='</select>';
			 $O.='<div id="avatarcanvasF"  data-currentAvatar="'.$selected_avatar_id.'" class="avatar_'.$selected_avatar_id.' wait_S"></div>';
			 
			//$source="";if ($value>0)  $source="/data/avatar_prev/1.mp4?";  $CSSA[]=''.C_DIR.'/_m/avatars.css.php'; //<--!
			
			//$O.='<video loop autoplay preload="auto" id="avatarcanvasF"><source src="'.$sourceF.'" type=\'video/mp4; codecs="avc1.42E01E, mp4a.40.2"\'></video>';
		}
		////////////////////////////////////////////////////////////////////////////////
		
		if ($inA[0]=="usr_male_avatar_id"){
			$O.='<select size="'.$selectSize.'" name="'.$F1[$f].''.PAGE_RANDOM.'" class="select230" id="'.$F1[$f].'">';

			$QAF=sql_query	("SELECT id, name FROM avatars where sex='m' order by name ASC");
			$AFC=0;
			while (	$avatarM=sql_assoc($QAF)	){
				$selected=""; 
				if ($avatarM["id"] && $value==$avatarM["id"]) {
					$selected=' selected="selected"';$selected_avatar_id=$value;
				}else{ 
					if (!$AFC) {$selected=' selected="selected"'; $selected_avatar_id=$avatarM["id"];}
				}
				$O.='<option id="optusr'.$avatarM["id"].'" value="'.$avatarM["id"].'"'.$selected.'>'.$avatarM["name"].'</option>';
				$AFC++;
			}
			 $O.='</select>';
			 $O.='<div id="avatarcanvasM"  data-currentAvatar="'.$selected_avatar_id.'" class="avatar_'.$selected_avatar_id.' wait_S"></div>';
//			 $source="";if ($value>0)  $source="/data/video/white/$value.mp4?";
//			 $O.='<video loop autoplay preload="auto" id="avatarcanvasM"><source src="'.$sourceM.'" type=\'video/mp4; codecs="avc1.42E01E, mp4a.40.2"\'></video>';
			 
			 
			//$O.='<img id="avatarcanvasBot" src="/img/avatar/gif/'.$imgShow.'.gif?" alt="" />';
		}


		if ($inA[0]=="cover_id"){

			$QAF=sql_query	("SELECT id, name, file FROM covers where 1 order by name ASC");
			while (	$covers=sql_assoc($QAF)	){
				$D["covers"][]=$covers;
				$D["coversID"][]=$covers["id"];
				$D["coversPath"][]=$covers["file"];

			}
			
			if (!$value) {
				$RANDOM=random_int(0, sizeof($D["covers"])	-1	);
				$D["covers_selected"]=$D["covers"][$RANDOM]["id"];
				$D["covers_selectedPath"]=$D["covers"][$RANDOM]["file"];
			}else{
				 $D["covers_selected"]=$value;
				 $D["covers_selectedPath"]=$D["covers"][				array_search($value,$D["coversID"])					]["file"];
			}
    	//<option value="volvo" data-class="avatar" data-style="background-image: url(&apos;http://www.gravatar.com/avatar/b3e04a46e85ad3e165d66f5d927eb609?d=monsterid&amp;r=g&amp;s=16&apos;);">John Resig</option>
	
			$O.='<select size="1" name="'.$F1[$f].''.PAGE_RANDOM.'" class="select230" id="'.$F1[$f].'">';
			foreach($D["covers"] as $k => $co) {
				$selected=""; if ($co["id"]==$D["covers_selected"]) $selected=' selected="selected"';				
				$O.='<option data-path="/data/covers/'.$co["file"] .'" '.$selected.' value="'.$co["id"].'">'.$co["name"].'</option>'; //selected="selected"		//
			}

			$O.='</select>';
			$O.='<img id="covercanvas" src="/data/covers/'.$D["covers_selectedPath"] .'" alt="" />';
			
			$O.='<img id="coverPlus" src="/img/arrowBigLeft999.png" alt="" />';
			$O.='<img id="coverMinus" src="/img/arrowBigRight999.png" alt="" />';
			$HEAD_ADD.='<script type="text/javascript">var coversID='.json_encode($D["coversID"]).';var coversPath='.json_encode($D["coversPath"]).';</script>';
			
			
			/*$O.='<input id="'.$F1[$f].'" name="'.$F1[$f].''.PAGE_RANDOM.'" value="0" type="text">';
			$O.='<div class="cover_msg" id="covermsg_notselected">'.L_please_select_the_avatars.'</div>';
			$O.='<div class="cover_msg" id="covermsg_selected">'.L_click_on_a_cover_to_select.'</div>';
			$O.='<div id="coverlist"></div>';
			*/
		}
		
	$O.="</div>";	
	
	//if ($F1[$f]=="forkFrom") $O.='<div class="gymSep">'.L_optional_information.'</div>';
	//if ($F1[$f]=="forkFrom") $O.='<a id="optionsGroupShow" href="#">'.L_show.'</a>';
	if ($F1[$f]=="Goal_3") $O.='<div class="gymSep">'.L_story_structure.'</div>';
	//if ($F1[$f]=="difficulty_level") $O.='<div class="gymSep">'.L_user_avatar.'</div>';
	
	//if ($F1[$f]=="usr_goal3") $O.='<div class="gymSep">'.L_the_bot_character.'</div>';
	if ($F1[$f]=="usr_goal3") $O.='<div class="gymSep">'.L_cover.'</div>';




}
$O.='<div class="line">';
$O.='<div id="errorList"><div>'.L_sorry_the_following_fields_marked_in_red_are_not_correct.':</div><span></span></div>';
	$O.='<div id="S1" class="editButt noselect"><span class="l1">'.L_save.'</span><span class="l2">'.L_go_to_next_step.'</span><img class="editButtArrow" src="/img/arrowBigRight.png" alt="" /></div>';
$O.="</div>";	

if ($_COOKIE["debug"]){
	$O.="<pre>";
	$O.=print_r($D, true);
	$O.="</pre>";
}
$O.="<br /><br /><br /><br /><br /><br /><br /><br /></div>";//

?>


