<?php
//ini_set("display_errors", "1");

include_once("../../config/config.inc.php");
if(!$_SESSION["ulevel"]>0){echo "false|-|not_logged"; return;}	
$D=$_GET;
print_r($D);

if ($D["action"]=="search" || $D["action"]=="searchall"|| $D["action"]=="searchGroup") {
	if ($D["action"]=="searchall"){
		$lang_trigger="edt";require_once(C_ROOT."/config/lang.inc.php");
	}
	$D["q"]=strtolower(	trim($D["q"]));

	$D["query"]="
	SELECT * FROM 
	(SELECT 
		'gym' as type, 
		G.gameId as id, 
		G.title as title , 
		G.status as status
		/*,'A' as inDb*/
		FROM games G 
		WHERE 1 
		AND G.status='playable' 
		/*AND 
		(
		G.uid_creator IN (SELECT users_id FROM users WHERE family='".$_SESSION["family"]."' )
		OR G.gameId IN (SELECT gameId FROM game_family WHERE family='".$_SESSION["family"]."' )
		)
		*/
		";	 
		
		//status!='offline'
	//if ($D["idgr"]&& is_numeric($D["idgr"]) ) $D["query"].=" AND G.gameId NOT IN (SELECT gameId FROM gym_usersgroups WHERE idgroup=".$D["idgr"]." IS NOT NULL) ";		
		
	$D["query"].="	UNION
SELECT 
		'user' as type, 
		U.users_id as id, 
		Concat(user_real_name ,' ',user_real_surname )  as title , 
		'' as status
		/*,GR.uid as inDb*/
		FROM users U 
		/*LEFT JOIN user_usersgroups GR on (GR.uid=U.users_id)*/
		WHERE U.family='".$_SESSION["family"]."'  
		";	
	//if ($D["idgr"]&& is_numeric($D["idgr"]) ) $D["query"].=" AND U.users_id NOT IN (SELECT uid FROM user_usersgroups WHERE idgroup=".$D["idgr"]." IS NOT NULL) ";

	if ($D["action"]=="searchall")
	$D["query"].="	UNION
SELECT 
		'group' as type, 
		G.idgroup as id, 
		G.name as title , 
		'' as status
		FROM usersgroups G 
		WHERE G.family='".$_SESSION["family"]."' 
		";	

if ($D["action"]=="searchGroup"){ //reset for group only
	$D["query"]="SELECT * FROM 
	(	SELECT 
		'group' as type, 
		G.idgroup as id, 
		G.name as title , 
		'' as status
		FROM usersgroups G 
		WHERE G.family='".$_SESSION["family"]."'  
		";		
}
	
	$D["query"].="
	
	) AS SRCTMP
		WHERE SRCTMP.title LIKE  '%".db_string($D["q"])."%'	
	ORDER BY CASE
		WHEN (title = '".db_string($D["q"])."'  ) THEN 1
		WHEN (title LIKE '".db_string($D["q"])."%'  ) THEN 2	
		WHEN title LIKE '%".db_string($D["q"])."%' THEN 3
		END
		LIMIT 0,20
	";





$qU=@sql_query($D["query"]);
if (sql_error() ) {echo "false|-||-|".sql_error();die;	}
$D["homany"]=0;

while ($d=sql_fetch_assoc($qU) ):
	
	$d["ClassinDb"]="";
	if ($d["type"]=="user") {
		if (in_array(	$d["id"], 		explode(",",$D["usersCSV"])	)) $d["ClassinDb"]=" inDB";
		$idDiv='tagusr_'.$d["id"];
		$idDivA='tagusrs_'.$d["id"];
		@$typeTxt=L_user;
	}

	if ($d["type"]=="gym") {
		if (in_array(	$d["id"], 		explode(",",$D["gymsCSV"])	)) $d["ClassinDb"]=" inDB";
		$idDiv='taggym_'.$d["id"];
		$idDivA='taggyms_'.$d["id"];
		@$typeTxt=L_gym;
	}
	if ($d["type"]=="group") {
		$d["ClassinDb"]="";
		if ($D["action"]=="searchGroup") if (in_array(	$d["id"], 		explode(",",$D["groupCSV"])	)) $d["ClassinDb"]=" inDB";
		
		$typeTxt=L_group;
		$idDivA='taggroups_'.$d["id"]; //NOT taggroup!
		$idDiv='taggroup_'.$d["id"];
	}
	if ($D["action"]=="search")			$OUT.='<div class="tag '.$d["type"].$d["ClassinDb"].'" id="'.$idDiv.'">'.$d["title"].'</div>';
	if ($D["action"]=="searchall")	 	$OUT.='<div class="hd_notification_linelink" id="'.$idDivA.'"><span class="hd_notification_text">'.$d["title"].'</span><span class="hd_notification_date">'.$typeTxt.'</span></div>';	
	if ($D["action"]=="searchGroup")	$OUT.='<div class="tag '.$d["type"].$d["ClassinDb"].'" id="'.$idDiv.'">'.$d["title"].'</div>';
	
	//hd_notification_linelink
	
	
	$D["d"][]=$d;
	$D["homany"]++;
endwhile;
if (!$D["homany"]) {
	$lang_trigger="usr";
	require_once(C_ROOT."/config/lang.inc.php");	
	
	if ($D["action"]=="search")	 $OUT='<div id="noResults">'.L_no_results.'</div>';
	else $OUT='<div class="noResults">'.L_no_results.'</div>';
	echo "true|-|".$OUT;
	return;
}
echo "true|-|".$OUT."|-|".$D["homany"]."|-|".print_r($D,true);
	
/*
wher 	OR hash LIKE '%#".db_string($D["q"])." %' 
	OR hash LIKE '%#".db_string($D["q"])."%' 

*/

//OR hash LIKE '%#".db_string($D["q"])." %' 
//OR hash LIKE '%#".db_string($D["q"])."%' 


	
/*	$OUT.='<div class="tag" id="suggtag1">Apecheronza</div>';
	$OUT.='<div class="tag" id="suggtag11">Rododentro</div>';
	$OUT.='<div class="tag" id="suggtag12">management</div>';
	$OUT.='<div class="tag" id="suggtag13">Cosmo</div>';
	$OUT.='<div class="tag" id="suggtag14">Apecheronza</div>';
	$OUT.='<div class="tag" id="suggtag15">supercalifragilista</div>';
	$OUT.='<div class="tag" id="suggtag16">Apecheronza</div>';
	$OUT.='<div class="tag" id="suggtag17">fun</div>';
	$OUT.='<div class="tag" id="suggtag18">ciccia</div>';
	$OUT.='<div class="tag" id="suggtag19">Apecheronza</div>';
	$OUT.='<div class="tag" id="suggtag111">Apecheronza</div>';
	$OUT.='<div class="tag" id="suggtag112">Apecheronza</div>';
	$OUT.='<div class="tag" id="suggtag113">Roma</div>';*/

}
	die;
/* UNION DA CONSERVARE
  
		  SELECT 'product' as type, idp as id, name AS title, descriptionShort as description , image as img, hashtags as hash
		  ,status as status, Concat('idcom|', idcom) as data
		  FROM products WHERE status!='deleted' 
  
  
   UNION
  
		  SELECT 'company' as type, idcom as id, brandname AS title, description as description , image as img,'' as hash
		  ,statusc as status, '' as data
		  FROM company WHERE statusc!='deleted' 
  
  UNION
				(SELECT * FROM (
				SELECT 'hash' as type , 0 as id, tag as title,  '' as description , 0 as img,'' as hash, '' as status, '' as data
				FROM ad_hashtag GROUP BY tag  
				UNION
				SELECT 'hash' as type , 0 as id, tag as title,  '' as description , 0 as img,'' as hash, '' as status, '' as data
				FROM products_hashtag GROUP BY tag  
				
				) as hash)
*/


if (($D["action"]!="search") &&$D["action"]!="searchall" && ($D["action"]!="add")	) {echo "false|-|no_action"; return;}

//$USER_LOGGED=loggedIn();
//print_r($_SESSION);



	
############################################ SEARCH
if ($D["action"]=="search") {
	/*$Q=strtolower(	trim($D["q"]));
	$R=depure_tag($Q);
	$Q=$R["Q"];
	
	if (!$R["ret"]) {
		$OUT='1 <div id="noResults">{'.$R["msg"].'}</div>';
		echo "true|-|".$OUT;
		return;
	}
	*/
	

	// exist exact?
	/* $EXIST_EXACT=false;
	$str="select id FROM yt_tag WHERE 
	(approved=1 OR (approved=0 AND proponentIdu=".$_SESSION["idu"].")) 
	 AND tag = '".db_string($Q)."' AND proponentIdu=".$_SESSION["idu"];
	$q=@sql_query($str);
	$D=@sql_fetch_assoc($q);	
	if ($D['id']) $EXIST_EXACT=$D['id'];
	
	//echo "\$EXIST_EXACT $EXIST_EXACT<br />";
	
	$str="select id,tag FROM yt_tag WHERE 
	(approved=1 OR (approved=0 AND proponentIdu=".$_SESSION["idu"]."))
	
	AND tag LIKE '%".db_string($Q)."%' ORDER BY tag LIKE '".db_string($Q)."%' DESC, tag ASC";
	//echo $str; 

	$q=@sql_query($str);
	
	$OUT="";
	$R=0;
	while ($D=@sql_fetch_assoc($q)){
		$R++;
		$OUT.='<div class="tag" id="suggtag'.$D['id'].'">'.$D['tag'].'</div>';//.$D['id'].' '
	}
	
	if (!$EXIST_EXACT) {
		$OUT='<div id="addTag">&rsaquo; {L_create_new_tag} <span>'.$Q.'</span></div>'.$OUT;
	}
	
	*/
	

	$OUT.="OUT:";
	/*;*/
	
	//echo $OUT;
	
	echo "true|-|".$OUT."|-|".print_r($D,true);
	
	//	$Q= preg_replace('/[^A-Za-z0-9\-\(\) ]/', '', $Q);
	//	$Q = preg_replace("/[^[:alnum:][:punct:]]/","",$Q);
	//	$Q = $Q.replace(/[-'`~!@#$%^&*()_|+=?;:'",.<>\{\}\[\]\\\/]/gi, '')
} ################################################################################ search end

############################################ SEARCH
/*if ($D["action"]=="add") {
	//print_r($D);
	$TAG=strtolower(	trim($D["q"]));
	if (!$TAG) {
		echo "false|-|no_tag";
		return;
	}

	// exist exact WHATEVER proponentIdu?
	$EXIST_EXACT=false;
	$str="select id FROM yt_tag WHERE tag = '".db_string($TAG)."'";
	//echo $str; 
	$q=@sql_query($str);
	$D=@sql_fetch_assoc($q);
	//echo  sql_error();
	//print_r($D);
	if ($D['id']) {
		echo "true|-|".$D['id']."|-|not_created";
		return;
	}
	
	
	$str="INSERT INTO yt_tag(`tag`, `proposedTime`, `proponentIdu`) VALUES ('".db_string(strtolower($TAG))."', '".time()."', '".$_SESSION["idu"]."')";

	@sql_query($str);	
	if (sql_error()) {
		echo "false|-|".sql_error();	
	}else{
		echo "true|-|".sql_insert_id()."|-|created";
	}

}
*/
?>