<?php
$page["titlePre"]="Editor - ";


//print_r($DIRA);die;
/* Array ( 
	[1] => editor
	[2] gameId  // 0 new
	[3] => 1 edit step 0 1 2
	
	Array ( 
	[1] => editor 
	[2] => 1 
	[3] => 2 ) 
) 
/2/1

/?editor/216/1
*/
//print_r($DIRA);die();
$editorstep=0;if ($DIRA[2]==1) $editorstep=1;
$gameId=0; if ($DIRA[1] && is_numeric($DIRA[1]) ) $gameId=$DIRA[1];

require_once(C_ROOT."/_m/editor/$editorstep/editor_$editorstep.inc.php");




?>
