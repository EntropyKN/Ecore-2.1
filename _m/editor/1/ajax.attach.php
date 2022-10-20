<?php
ini_set("display_errors", "1");
include_once("../../../config/config.inc.php");
//if ($_SESSION["ulevel"]<1) die("false|-|you don't have the right permissions");
/*function audioNameCreate($D){
	$name=$D["gameId"]."_".$D["step"].".mp3";
	return $name." ";
}
*/
$D=$_POST;
$D=array_map("trim",$D);


if ($D["cmd"]=="url"	){

	function is_url($url){
			$response = array();
			//Check if URL is empty
			if(!empty($url)) {
				$response = @get_headers($url);
			}
			if (!$response) return false;
			
			if (
			
			@in_array("HTTP/1.1 200 OK", $response)
			|| 	@in_array("HTTP/1.0 200 OK", $response)
			|| 	@in_array(" 200 OK", $response)
			) return true;
			return false;
			
			//return (bool)@in_array("HTTP/1.1 200 OK", $response, true);
	
		}  
		
	function get_title($url){
	  $str = file_get_contents($url);
	  if(strlen($str)>0){
		$str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
		preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
		return $title[1];
	  }
	}	
	
	if ($D["step"] && is_numeric($D["step"])	&& $D["url"]	){	
		if (substr(strtolower($D["url"]), 0, 4)=="www.") $D["url"]="https://".$D["url"];
	
		$D["is_url"]=is_url($D["url"]);
		
		if ($D["is_url"]) {
			$D["title1"]=(		get_title($D["url"]));
			$D["title"]=html_entity_decode($D["title1"], ENT_QUOTES, "UTF-8");

			
			$D["Q"]="INSERT INTO `games_steps_attachments` (`gameId`, `step`,`scene`, `title`, `path`, type)  VALUES (".$D["gameId"].", ".$D["step"].", '".$D["scene"]."', '".db_string($D["title"])."', '".db_string($D["url"])."'	,'link'			);";

			sql_query($D["Q"]);
			$id=sql_id();
			//$D["utrackingGameEditor"]=utrackingGameEditor($D["gameId"], $D["step"], "games_steps_url_add", $D["url"]) ;
			//true|-|39|-|Acqua atomica|-|/data/attachments/acqua_atomica_1_1.docx|-|attach|
			
			echo "true|-|";
			echo $id."|-|"; // id
			echo "".$D["title"]."|-|"; // name
			echo "".$D["url"]."|-|"; // title
			echo "link|-|"; // type
						
			
			

		}else{
			$D["resp"]=@get_headers($D["url"]);
			require_once(C_ROOT."/config/lang.inc.php");
			echo "false|-|".L_the_url_does_not_seem_to_be_correct." :-(";
			echo "|-|";
		}

		print_r($D);
		
	}
	die();
}


if ($D["cmd"]=="delete"	){
	if ($D["step"] && is_numeric($D["step"])	&& $D["path"]	){	

		$D["unlink"]=@unlink(			C_ROOT.$D["path"]				);
		$D["Q"]="DELETE FROM `games_steps_attachments` WHERE gameId = ".$D["gameId"]." AND step = ".$D["step"]." AND idAttachment = ".$D["idAttachment"]."";
		sql_query($D["Q"]);
		if (sql_error()) $D["e"]=sql_error();
		//$D["utrackingGameEditor"]=utrackingGameEditor($D["gameId"], $D["step"], "games_steps_attachment_delete_id", $D["path"]) ;		
		
		echo "true|-|";
		print_r($D);
	}
}else{

    ini_set("post_max_size", "30M");
    ini_set("upload_max_filesize", "30M");
    ini_set("memory_limit", "20000M"); 
	require_once(C_ROOT."/config/lang.inc.php");
    $acceptable_mime = array(
	'text/xml',
	'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',

	'application/vnd.ms-excel',
	'application/vnd.ms-powerpoint',
		'application/pdf',
		'image/jpeg',
'image/pjpeg',
		'image/jpg',
		'image/gif',
		'image/png',
		'application/pdf',
		'application/msword',
		'audio/mpeg',
		'audio/mpeg3',
		'audio/x-mpeg-3',
		'video/mpeg',
		'video/x-mpeg',
		'video/mpeg',
		'application/excel',
		'application/x-msexcel',
		'text/css',
		'text/plain',
		'text/html',
		'audio/x-aiff',
		'audio/aiff',
		'audio/basic',
		'audio/x-au',
		'application/vnd.oasis.opendocument.text',
		'application/vnd.oasis.opendocument.spreadsheet',
		'application/vnd.oasis.opendocument.presentation',
		'application/mspowerpoint',
		'application/powerpoint',
		'application/x-mspowerpoint',
		
		'application/vnd.openxmlformats-officedocument.wordprocessingml',
		
		'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    );

	
	if ( 0 < $_FILES['file']['error'] ) die("false|-|fileError:".$_FILES['file']['error']);
	//2.097.152*2=4.194.304
    if (($_FILES['file']['size']  > 4194304)) die("false|-|File too large. File must be less than 4 megabytes.");
	if(!in_array($_FILES['file']['type'], $acceptable_mime))  die("false|-|".L_sorry.", ".L_this_type_of_file_is_not_acceptable.": ".$_FILES['file']['type'].""); //die("false|-|Invalid file type. ".$_FILES['file']['type']." type not acceptable");
	
	$D["ext"]=substr($_FILES["file"]['name'], strrpos($_FILES["file"]['name'], '.')+1);
	
	$_FILES["file"]['nameC']=str_replace(	".".$D["ext"], 	"", $_FILES["file"]['name']);
	
	$D["fileName"]=make_urlable($_FILES["file"]['nameC'])."_".$D["gameId"]."_".$D["step"].".".$D["ext"];
	$filepath=C_ROOT."/data/attachments/";
	//[type] => audio/mpeg
	
	// move	
	move_uploaded_file($_FILES['file']['tmp_name'], $filepath. $D["fileName"]);
	///img/ico/link60.png			/img/ico/attach60.png
	$D["Q"]="INSERT INTO `games_steps_attachments` (`gameId`, `step`, `scene`,`title`, `path`)  VALUES (".$D["gameId"].", ".$D["step"].", '".$D["scene"]."','".db_string($_FILES["file"]['nameC'])."', '/data/attachments/".db_string($D["fileName"])."');";
	//utrackingGameEditor($gameId, $step, $action) 
	//$D["utrackingGameEditor"]=utrackingGameEditor($D["gameId"], $D["step"], "games_steps_attachment_add", $D["fileName"]) ;
	
	sql_query($D["Q"]);
	$id=sql_id();
	echo "true|-|";
	echo $id."|-|"; // id
	echo "".$_FILES["file"]['nameC']."|-|"; // name
	echo "data/attachments/".$D["fileName"]."|-|"; // url
	echo "attach|-|"; // type
	
	print_r($D);
	echo "<br>-----<br>";
	print_r($_FILES);
	//print_r (pathinfo($_FILES['file']['tmp_name'])); 
} //cmd
?>