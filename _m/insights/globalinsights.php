<?php
//$JSA[]=''.C_DIR.'/_m/insights/insights.js?'.PAGE_RANDOM;
//$JSA[]='https://www.gstatic.com/charts/loader.js?';
error_reporting(E_ALL ^ E_NOTICE);ini_set("display_errors",1); 
$CSSA[]=''.C_DIR.'/_m/insights/insights.css?aXz';


//require_once(C_ROOT."/config/php.function.group.php");

/*
https://palma.entropy4fad.it/?/insights
/custom_0
/views
/0
/01-02-2017
/07-03-2017

Palestre totali playable realizzate
Palestre totali draft realizzate
Palestre totali deleted
Giocatori Totali
Tempo totale
Tempo Medio


Dati per famiglie
Palestre playable realizzate per famiglie
palestre draft per famiglie
Palestre deleted per famiglie
Giocatori Distinti per famiglie
Tempo totale per famiglie
Tempo tale medio per famiglie


*/
//////////////////////////////
$q=sql_query("SELECT * from family where  family NOT IN ('tuscia_graziano','tuscia_progetti','tuscia_test') ORDER BY title ASC");
$z=0;
while (	$d=sql_fetch_assoc($q)) {
	$D["f"][$z]["family"]=str_replace(" w Poznaniu", "", $d["title"]);
	$D["f"][$z]["familyId"]=$d["family"];

		// 'draft', 'playable', 'offline', 'deleted'
	// playable
	$D["f"][$z]["Q"]["playable"]=("SELECT COUNT(G.gameId) N FROM games G WHERE G.status= 'playable' AND uid_creator  IN  (SELECT users_id FROM users WHERE family='".$d["family"]."')");
	$playable=sql_queryt($D["f"][$z]["Q"]["playable"]);
	$D["f"][$z]["playables"]=$playable["N"];

	// draft
	$D["f"][$z]["Q"]["draft"]=("SELECT COUNT(G.gameId) N FROM games G WHERE G.status= 'draft' AND uid_creator  IN  (SELECT users_id FROM users WHERE family='".$d["family"]."')");
	$draft=sql_queryt($D["f"][$z]["Q"]["draft"]);
	$D["f"][$z]["draft"]=$draft["N"];
	
	// offline
	$D["f"][$z]["Q"]["offline"]=("SELECT COUNT(G.gameId) N FROM games G WHERE G.status= 'offline' AND uid_creator  IN  (SELECT users_id FROM users WHERE family='".$d["family"]."')");
	$offline=sql_queryt($D["f"][$z]["Q"]["offline"]);
	$D["f"][$z]["offline"]=$offline["N"];
	if (sql_error()) $D["f"][$z]["offlineR"]=sql_error();
	
	// deleted
	$D["f"][$z]["Q"]["deleted"]=("SELECT COUNT(G.gameId) N FROM games G WHERE G.status= 'deleted' AND uid_creator  IN  (SELECT users_id FROM users WHERE family='".$d["family"]."')");
	$deleted=sql_queryt($D["f"][$z]["Q"]["deleted"]);
	$D["f"][$z]["deleted"]=$deleted["N"];
	
	// matches		, final
	$D["f"][$z]["Q"]["matches"]=("SELECT start, end, uid FROM matches WHERE uid  IN  (SELECT users_id FROM users WHERE family='".$d["family"]."')");
	$qm=sql_query($D["f"][$z]["Q"]["matches"]);
	
	$D["f"][$z]["matches_notFinished"]=0;
	$D["f"][$z]["matches_Finished"]=0;
	$D["f"][$z]["minutes_played"]=0;
	$D["f"][$z]["playersUids"]=array();
	while (	$m=sql_fetch_assoc($qm)) {
		//$D["f"][$z]["matches"][]=$m;
		
		if (!$m["end"]) {
			$D["f"][$z]["matches_notFinished"]++;
		}else{
			$D["f"][$z]["playersUids"][]=$m["uid"];
			$D["f"][$z]["matches_Finished"]++;	
			$D["f"][$z]["minutes_played"]	+= ($m["end"]-$m["start"]);
			
			
		}
	}
	$D["f"][$z]["playersUids"]=array_unique($D["f"][$z]["playersUids"]);
	$D["f"][$z]["unique_players"]=sizeof($D["f"][$z]["playersUids"]); unset ($D["f"][$z]["playersUids"]);
	$D["f"][$z]["minutes_played"]=ceil($D["f"][$z]["minutes_played"]/60);
	$D["total"]["minutes_played"]	+= $D["f"][$z]["minutes_played"];
	
	$D["f"][$z]["minutes_played_user_average"]=0;if ($D["f"][$z]["unique_players"]) $D["f"][$z]["minutes_played_user_average"]=ceil($D["f"][$z]["minutes_played"]/$D["f"][$z]["unique_players"]);
	
	// totals
	$D["total"]["playables"]+=$D["f"][$z]["playables"];
	$D["total"]["draft"]+=$D["f"][$z]["draft"];
	$D["total"]["offline"]+=$D["f"][$z]["offline"];
	$D["total"]["deleted"]+=$D["f"][$z]["deleted"];
	
	$D["total"]["matches_notFinished"]+=$D["f"][$z]["matches_notFinished"];
	$D["total"]["matches_Finished"]+=$D["f"][$z]["matches_Finished"];
	unset ($D["f"][$z]["Q"]);

	$z++;
}

################ total
$uniqueTotalPlayer=sql_queryt("SELECT COUNT(DISTINCT`uid`) N FROM `matches` where end is not null ");
$D["f"][$z]=array(
"family" => "Total",
"playables" => $D["total"]["playables"],
"draft" => $D["total"]["draft"],
"offline" => $D["total"]["offline"],
"deleted" => $D["total"]["deleted"],
"matches_notFinished" => $D["total"]["matches_notFinished"],
"matches_Finished" => $D["total"]["matches_Finished"],
"minutes_played" => $D["total"]["minutes_played"],
"unique_players" => $uniqueTotalPlayer["N"],
"minutes_played_user_average" => ceil ($D["total"]["minutes_played"]/$uniqueTotalPlayer["N"])

);






/*

[family] => West University of Timisoara
[familyId] => uvt
[playables] => 0
[draft] => 1
[offline] => 0
[deleted] => 0
[matches_notFinished] => 64
[matches_Finished] => 24
[minutes_played] => 478
[unique_players] => 16
[minutes_played_user_average] => 30

	$D["gymsQ"]="SELECT  G.title, G.gameId, G.status 
	FROM games G
	WHERE  G.status!='draft' AND  G.status!='deleted' AND G.gameId IN 
	(SELECT 
	DISTINCT GG.gameId
	FROM game_usersgroups GG
	WHERE GG.idgroup IN (".@implode(", ", $idGroupsArray).") 
	)
	ORDER BY title ASC ";
	$q=sql_query($D["gymsQ"]);
	if (sql_error()) $D["gymsQe"]=sql_error();
	while ($GY=sql_fetch_assoc(	$q	)){
		$D["gyms"][]=$GY;
		$D["ids_gym"][]=$GY["gameId"];
	}
*/




///////////////////////////////////////////////////////////////////////////////
$page["titlePre"]="Global ".L_insights." ";
//$O.='hei';


$O.='<div id="mask" class="opacity50"></div>';
$O.='<div id="core" data-idtrans="'.$idtrans.'" data-tsaved="'.$tsaved.'">';
	require_once(C_ROOT."/_m/header/header.inc.php");

	$O.='<div id="coreIn">';
	if ($_SESSION["ulevel"]==0				 ) {
		$O.='<div style="font-size:21px;color:#888">';
		$O.=L_sorry;
		$O.=", ";
		$O.="<br />".L_actually_you_have_no_permission_to_access_this_area;
		$O.='</div>';	
	}else{
		
	$O.="<table class=\"globaltable\">";
	$O.="<tr class=\"globaltableTR1\" >";
	$O.="<td class=\"globaltableTD1\">Family</td>";
	$O.="<td>playables</td>";
	$O.="<td>draft</td>";
	$O.="<td>offline</td>";
	$O.="<td>deleted</td>";
	$O.="<td>matches:notFinished</td>";
	$O.="<td>matches:finished</td>";
	$O.="<td>minutes played</td>";
	$O.="<td>unique players</td>";
	$O.="<td>user average</td>";	
	$O.="</tr>";
	
if (!empty($D["f"])) foreach($D["f"]  as $k => $v ) {
	
	if ($v["family"]!="Total") $O.="<tr>";
	else $O.="<tr class=\"globaltableTR1\" >";
	
	$O.="<td class=\"globaltableTD1\">".$v["family"]."</td>";
	$O.="<td>".$v["playables"]."</td>";
	$O.="<td>".$v["draft"]."</td>";
	$O.="<td>".$v["offline"]."</td>";
	$O.="<td>".$v["deleted"]."</td>";
	$O.="<td>".$v["matches_notFinished"]."</td>";
	$O.="<td>".$v["matches_Finished"]."</td>";
	$O.="<td>".$v["minutes_played"]."</td>";
	$O.="<td>".$v["unique_players"]."</td>";
	$O.="<td>".$v["minutes_played_user_average"]."</td>";
	$O.="</tr>";	
}
	
	$O.="</table>";
		
		//require_once(C_ROOT."/_m/insights/01.menu.time.inc.php");
		//require_once(C_ROOT."/_m/insights/02.gug.inc.php");
		//$O.="insights ";
		$O.='<div class="clear"></div>';
		//$O.='<div class="chartSub" id="chartSub3">'.L_durations_are_expressed_in_minutes.'</div>';


	}
	


// debug
if ($_COOKIE["debugX"]) { 
		$O.='<div class="clear"></div>';
		//$O.='<pre>'.print_r($_SESSION,true).'</pre>';
		//$O.='<pre>'.print_r($COM,true).'</pre>';
		//$O.= "\$days $days,inMenuId $inMenuId, idcomStats $idcomStats";
		//$O.='<pre>'.print_r($DIRA,true).'</pre>';
		//$O.='<pre>'.print_r($_SESSION,true).'</pre>';
		$O.='<pre>
		//// data
		'.print_r($D,true).'</pre>';	
}
// core coreIn
$O.='</div>';	
$O.='</div>';	

?>