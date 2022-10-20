<?php
$F1=array(
"language",
"title",
"Description",
"Goal_1",
"Goal_2",
"Goal_3",
"Goal_4",
"Goal_5",
//"background_id", //8
"stepsBefore",//10
"steps",
"structure",
"structureBefore",
"forkFrom",
//"sgroups",
//"sparallel",	//11
//"audio", //12

"valid_until", //13 new

"estimated_duration",
"competence_target",
"difficulty_level", //15


//"usr_female_avatar_id", // 16
//"usr_male_avatar_id", // 17
"usr_description",
"usr_goal1",
"usr_goal2",
"usr_goal3",

"cover_id",
);

$F1t=array(
L_language,
L_title,
L_description,
L_game_goal,
L_game_goal." 2",
L_game_goal." 3",
L_game_goal." 4",
L_game_goal." 5",
//L_scenario, //8
"",//10
L_steps, // 
L_structure,
"structureBefore",//structureBefore
L_forkFrom,

//L_sentences_groups,  // 10
//L_parallel_sentences, // 11
//L_will_you_use_audio,////////////////////////////////
L_valid_until, 
L_estimated_duration,
L_competence_target,
L_difficulty_level,

//L_feminine_avatar, //"usr_female_avatar_id", // 16
//L_masculine_avatar, //"usr_male_avatar_id", // 17
L_user_avatar_description,//"User character description",
L_user_goal,//"User Goal",
L_user_goal." 2",
L_user_goal." 3",

L_cover,
);
/*
('select', '0', '1', 'Seleziona', 'Select', 'SelectAR'), 
('parallel_sentences', '0', '1', 'Seleziona', 'Select', 'SelectAR'), 
('will_you_use_audio', '0', '1', 'Vuoi usare audio?', 'Will you use audio?', 'سوف تستخدم الصوت؟'), 
('user_avatar', '0', '1', 'Avatar dell'Utente', 'User's avatar', 'User's avatarAR'), 

('user_avatar_name', '0', '1', 'Nome dell'avatar Utente', 'User's avatar name', 'User's avatar nameAR'), 
('user_avatar_description', '0', '1', 'Descrizione dell'avatar Utente', 'User's avatar description', 'User's avatar descriptionAR'), 
('user_goal', '0', '1', 'Obiettivo dell'utente', 'User's goal', 'User's goalAR'), 
('bot_avatar', '0', '1', 'Avatar del Bot', 'Bot's Avatar', 'Bot's AvatarAR'), 
('bot_avatar_name', '0', '1', 'Nome dell'avatar Bot', 'Bot's avatar name', 'Bot's avatar nameAR'), 
('bot_avatar_description', '0', '1', 'Descrizione dell'avatar del Bot', 'Bot's avatar description', 'Bot's avatar descriptionAR'), 
('bot_goal', '0', '1', 'Obiettivo del Bot', 'Bot's goal', 'Bot's goal')


*/



$F1f=array(
"language", //"language",
"input",
"area",
"area",
"area",
"area",
"area",
"area",
//"scenario", //8
"input",//10
"select,3,16", //9
"structure", //L_structure,
"input", //structureBefore,
"select,1,15", //L_forkFrom,


//"select,3,12", // 10
//"select,1,12",// 11
//"select,0,1",// 12

"input",//L_valid_until
"input",//L_estimated_duration,
"input",//L_competence_target,
"input",//L_difficulty_level,

//"usr_female_avatar_id", // L_user_avatar." ".L_female, //"usr_female_avatar_id", // 16
//"usr_male_avatar_id", //L_user_avatar." ".L_male, //"usr_male_avatar_id", // 17
"area",//L_user_avatar_description,//"User character description",
"area",//L_user_goal,//"User Goal",
"area",//L_user_goal." 2",
"area",//L_user_goal." 3",
"cover_id"

);


/*
INSERT INTO `entropy4_palma`.`plang` (`name` ,`usr` ,`edt` ,`it` ,`en` ,`ar` )
VALUES 
('select', '0', '1', 'Seleziona', 'Select', 'SelectAR'), 
('parallel_sentences', '0', '1', 'Seleziona', 'Select', 'SelectAR'), 
('will_you_use_audio', '0', '1', 'Vuoi usare audio?', 'Will you use audio?', 'سوف تستخدم الصوت؟'), 
('user_avatar', '0', '1', 'Avatar dell Utente', 'User s avatar', 'User s avatarAR'), 

('user_avatar_name', '0', '1', 'Nome dell avatar Utente', 'User s avatar name', 'User s avatar nameAR'), 
('user_avatar_description', '0', '1', 'Descrizione dell avatar Utente', 'User s avatar description', 'User s avatar descriptionAR'), 
('user_goal', '0', '1', 'Obiettivo dell utente', 'User s goal', 'User s goalAR'), 
('bot_avatar', '0', '1', 'Avatar del Bot', 'Bot s Avatar', 'Bot s AvatarAR'), 
('bot_avatar_name', '0', '1', 'Nome dell avatar Bot', 'Bot s avatar name', 'Bot s avatar nameAR'), 
('bot_avatar_description', '0', '1', 'Descrizione dell avatar del Bot', 'Bot s avatar description', 'Bot s avatar descriptionAR'), 
('bot_goal', '0', '1', 'Obiettivo del Bot', 'Bot s goal', 'Bot s goal')


*/

?>