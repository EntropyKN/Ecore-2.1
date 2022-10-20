-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Mar 28, 2021 alle 19:00
-- Versione del server: 5.6.51-log
-- Versione PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vgentrop_elsego`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `avatars`
--

CREATE TABLE `avatars` (
  `id` int(11) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `sex` enum('m','f') DEFAULT NULL,
  `invisble` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `avatars`
--

INSERT INTO `avatars` (`id`, `name`, `sex`, `invisble`) VALUES
(1, 'Monica', 'f', 0),
(2, 'John', 'm', 0),
(3, 'Grace', 'f', 0),
(1000, 'L_no_avatar', NULL, 0),
(4, 'John2', 'm', 0),
(5, 'Rose', 'f', 0),
(6, 'kate', 'f', 0),
(7, 'Giorgia', 'f', 0),
(8, 'Mario', 'm', 0),
(9, 'George', 'm', 0),
(10, 'Hassan', 'm', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `covers`
--

CREATE TABLE `covers` (
  `id` int(11) NOT NULL,
  `file` varchar(36) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `invisble` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `covers`
--

INSERT INTO `covers` (`id`, `file`, `name`, `invisble`) VALUES
(1, 'fast_car.jpg', 'Fast Car', 0),
(2, 'girl_in_town.jpg', 'Girl in town', 0),
(3, 'snow.jpg', 'Snow', 0),
(4, 'signing.jpg', 'Signing', 0),
(5, 'tiger.jpg', 'Tiger', 0),
(6, 'time_goes_by.jpg', 'Time goes by', 0),
(7, 'video_addicted.jpg', 'Video addicted', 0),
(8, 'beach.jpg', 'Beach', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `email_validation`
--

CREATE TABLE `email_validation` (
  `email` varchar(255) NOT NULL,
  `code` varchar(5) NOT NULL,
  `validatets` int(11) NOT NULL DEFAULT '0',
  `uid` int(11) NOT NULL,
  `editedts` int(11) NOT NULL,
  `createdts` int(11) NOT NULL DEFAULT '0',
  `validationIP` varchar(12) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `family`
--

CREATE TABLE `family` (
  `family` varchar(16) COLLATE latin1_general_ci NOT NULL COMMENT 'oauth_consumer_key',
  `secret` varchar(32) COLLATE latin1_general_ci NOT NULL,
  `title` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dump dei dati per la tabella `family`
--

INSERT INTO `family` (`family`, `secret`, `title`, `id`) VALUES
('demotest', '09i1o22gx9t8hgwxjxcynvp3hjdvah4t', 'Test funzionamento', 1),
('entropy', '3gpahyo442ee9881o465h9nnj3yk827c', 'Entropy Knowledge Network', 10),
('unigo', '09i1o22gx9t8hgwxjxcynvp3hjdvahss', 'University of Nowhere', 0),
('unicy', 'aa01d7jz882ucfgqi44msaddoqfpgu3z', 'University of Cyprus', 6),
('polimi', '0qm5vee72mnkdk5xll0xz3dd6p1reayj', 'Politecnico di Milano', 5),
('tusciamoodle', '11b9q67fo1h6qllqbmguwds9mlobzn8z', 'Università della Tuscia - Moodle', 14),
('mmu', 'sqpxvrhgfvxennk9aey978lypo1flupv', 'Manchester Metropolitan University', 2),
('uvt', 'ggx6vimfkad3bjf5glgwv5d98aean9w3', 'West University of Timisoara', 3),
('uca', 'gl7h3t9ticidaeqwp18p2w6084z99kwe', 'Universidad De Cadiz', 7),
('ipp', '601o6fcu0540xzi8a3rs3xog9bx0b1oz', 'Instituto politecnico Do Porto', 8),
('amu', 'q4cmyutq0kobyb6kl89w5s35ut1b6idp', 'Uniwersytet Im. Adama Mickiewicza w Poznaniu', 9),
('isp_demo', '09i1o22gx9t8hgwxjxcynvp3hjdvahst', 'Demo Platform ELSE ISP', 11),
('ibu', '12i1o2d5x9t8hgwxjxcynvp3hjdvah4s', 'International Balkan University', 12),
('umfst', '61m4p6d5x9t8hgwxjxcynvp3hjdvah8b', 'University of Târgu Mures', 13),
('tuscia_test', '40n2p6d5x9t8hgwxjxcynvp3hjdvah6d', 'Università della Tuscia - Test', 15),
('tuscia_progetti', '51s4d5x9t8hgwxjxcynvp3hjdvah6w1', 'Università della Tuscia - Progetti', 16),
('tuscia_graziano', '09i1o22gx9t8hgwxjxcynvp3hjdvaabc', 'Università degli Studi della Tuscia - Prof. Graziano', 17);

-- --------------------------------------------------------

--
-- Struttura della tabella `games`
--

CREATE TABLE `games` (
  `gameId` int(11) NOT NULL,
  `language` varchar(2) DEFAULT NULL,
  `cover_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `Description` text,
  `Goal_1` text,
  `Goal_2` text,
  `Goal_3` text,
  `Goal_4` text,
  `Goal_5` text,
  `steps` int(2) DEFAULT NULL,
  `audio` tinyint(1) DEFAULT NULL,
  `estimated_duration` varchar(255) DEFAULT NULL,
  `competence_target` varchar(255) DEFAULT NULL,
  `difficulty_level` varchar(255) DEFAULT NULL,
  `usr_female_avatar_id` int(11) DEFAULT NULL,
  `usr_male_avatar_id` int(11) DEFAULT NULL,
  `usr_description` text,
  `usr_goal1` text,
  `usr_goal2` text,
  `usr_goal3` text,
  `uid_creator` int(11) DEFAULT NULL,
  `createdTs` int(11) DEFAULT NULL,
  `uid_editor` int(11) NOT NULL,
  `editTs` int(11) NOT NULL,
  `valid_until` date DEFAULT NULL,
  `L1_comment` text NOT NULL,
  `L2_comment` text NOT NULL,
  `L3_comment` text NOT NULL,
  `L4_comment` text NOT NULL,
  `W1_comment` text NOT NULL,
  `W2_comment` text NOT NULL,
  `W3_comment` text NOT NULL,
  `W4_comment` text NOT NULL,
  `structure` enum('linear','fork') NOT NULL DEFAULT 'linear',
  `forkFrom` int(11) NOT NULL DEFAULT '0',
  `status` enum('draft','playable','offline','deleted') NOT NULL DEFAULT 'draft'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `games`
--

INSERT INTO `games` (`gameId`, `language`, `cover_id`, `title`, `Description`, `Goal_1`, `Goal_2`, `Goal_3`, `Goal_4`, `Goal_5`, `steps`, `audio`, `estimated_duration`, `competence_target`, `difficulty_level`, `usr_female_avatar_id`, `usr_male_avatar_id`, `usr_description`, `usr_goal1`, `usr_goal2`, `usr_goal3`, `uid_creator`, `createdTs`, `uid_editor`, `editTs`, `valid_until`, `L1_comment`, `L2_comment`, `L3_comment`, `L4_comment`, `W1_comment`, `W2_comment`, `W3_comment`, `W4_comment`, `structure`, `forkFrom`, `status`) VALUES
(27, 'en', 2, 'OTHERS - Online trading Heritage Enology Red Spirits', 'OTHERS – You are in Hungary for a European project, to encourage the knowledge of each partner was asked to cook a dish from another country.\nYou have to cook a traditional French dish “Boeuf Bourguignon” and pair it with wine.', 'To improve the Computational thinking skill', '', '', '', '', 9, NULL, '', '', '', NULL, NULL, 'You are one of Others\'s Participant an european project about the wine', 'Cooking the french dish and pairing it with the wine.', 'usr goal #2', '', 80, 1560092629, 2, 1568971270, NULL, 'Sorry you didn’t reach the goal. Try again and check your mistakes', 'xxx', 'xxxx', 'xxxx', 'xxx', 'xxxx', 'xxx', 'xxxx', 'fork', 5, 'deleted');

-- --------------------------------------------------------

--
-- Struttura della tabella `games_spread`
--

CREATE TABLE `games_spread` (
  `gameId` int(11) NOT NULL,
  `spread` enum('L1','L2','L3','L4','W1','W2','W3','W4') NOT NULL,
  `spreadLP` decimal(10,2) NOT NULL,
  `spreadRP` decimal(10,2) NOT NULL,
  `spreadL` decimal(10,2) NOT NULL,
  `spreadR` decimal(10,2) NOT NULL,
  `idSpread` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `games_spread`
--

INSERT INTO `games_spread` (`gameId`, `spread`, `spreadLP`, `spreadRP`, `spreadL`, `spreadR`, `idSpread`) VALUES
(27, 'L1', 0.00, 12.50, 0.00, 8.00, 6290),
(27, 'L2', 12.50, 25.00, 8.00, 16.00, 6291),
(27, 'L3', 25.00, 37.50, 16.00, 24.00, 6292),
(27, 'L4', 37.50, 50.00, 24.00, 32.00, 6293),
(27, 'W1', 50.00, 62.50, 32.00, 40.00, 6294),
(27, 'W2', 62.50, 75.00, 48.00, 48.00, 6295),
(27, 'W3', 75.00, 87.50, 48.00, 56.00, 6296),
(27, 'W4', 87.50, 100.00, 56.00, 65.00, 6297);

-- --------------------------------------------------------

--
-- Struttura della tabella `games_steps`
--

CREATE TABLE `games_steps` (
  `gameId` int(11) NOT NULL,
  `step` int(2) NOT NULL,
  `scene` enum('A','B','C') NOT NULL DEFAULT 'A',
  `scenario_id` int(11) DEFAULT NULL,
  `avatar_id` int(11) DEFAULT NULL,
  `avatar_size` varchar(16) DEFAULT 'S',
  `avatar_pos` varchar(255) DEFAULT NULL,
  `balloon_pos` varchar(16) DEFAULT '157,31',
  `arrowY` varchar(3) DEFAULT '11',
  `arrowPos` varchar(12) NOT NULL DEFAULT 'left',
  `avatar_sentence` text,
  `avatar_audio` varchar(255) DEFAULT NULL,
  `compulsoryAttachments` tinyint(1) NOT NULL DEFAULT '0',
  `answer_1` text,
  `ascore_1` int(2) DEFAULT NULL,
  `goto1` enum('A','B','C') NOT NULL DEFAULT 'A',
  `answer_2` text,
  `ascore_2` int(2) DEFAULT NULL,
  `goto2` enum('A','B','C') NOT NULL DEFAULT 'A',
  `answer_3` text,
  `ascore_3` int(2) DEFAULT NULL,
  `goto3` enum('A','B','C') NOT NULL DEFAULT 'A',
  `answer_4` text,
  `ascore_4` int(2) DEFAULT NULL,
  `goto4` enum('A','B','C') NOT NULL DEFAULT 'A',
  `type` enum('winning','loosing') DEFAULT NULL,
  `idStep` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `games_steps`
--

INSERT INTO `games_steps` (`gameId`, `step`, `scene`, `scenario_id`, `avatar_id`, `avatar_size`, `avatar_pos`, `balloon_pos`, `arrowY`, `arrowPos`, `avatar_sentence`, `avatar_audio`, `compulsoryAttachments`, `answer_1`, `ascore_1`, `goto1`, `answer_2`, `ascore_2`, `goto2`, `answer_3`, `ascore_3`, `goto3`, `answer_4`, `ascore_4`, `goto4`, `type`, `idStep`) VALUES
(27, 1, 'A', 12, 5, 'XL', '-44.984375,11', '137,48', '28', 'right', 'Have you heard what a nice idea? To help get a better mutual knowledge it has been required to cook a \nforeign dish. \nYours is a French dish “Boeuf Bourguignon”', '27_1_A.mp3', 0, 'Wow! It never happens to me. Very interesting, even if cooking is not my thing', 0, 'A', 'Yes, I heard it. It’s a tough challenge…A French dish eh? It’s an easy task!', 3, 'A', 'Very well I’ve already had some ideas', 0, 'A', NULL, NULL, 'A', NULL, 436),
(27, 2, 'A', 13, 1000, 'S', NULL, '145,87.000015258', '11', 'left', 'Well, and now where do I begin?', '27_2_A.mp3', 1, 'I’m going to do a research…But how do I understand if I can trust it?!', 0, 'A', 'I remember that my friend Pierre was good in cooking in addition to French, I’ll ask him', 3, 'A', 'Ok lets get going. I’ll look online for some key words such as beef, sauce ecc… I can’t find anything. I’ll look for French words', 5, 'A', NULL, NULL, 'A', NULL, 437),
(27, 3, 'A', 14, 1000, 'S', NULL, '157,31', '11', 'left', 'Now you have the recipe. \nHow do you solve the issue to do the shopping for a French \ndish in Hungary?\nHow could you be sure to get the right ingredients in spite of \nlanguage issue? And not only language', '27_3_A.mp3', 0, 'I look for on google translator. I wouldn’t have any trouble. I can manage it on my own', 0, 'A', 'I’m going to the supermarket I’ll find everything there. Also, people are very nice', 2, 'A', 'Ok let\'s do it. Translation of ingredients in Hungarian. I\'ll take a picture and a map of shops and supermarket around', 4, 'A', NULL, NULL, 'A', NULL, 438),
(27, 4, 'A', 10, 8, 'L', '332,23', '53,44.0000152587', '11', 'left', 'Hi, are you one of the Others’ project? I’ve heard of it, it’s \nseems very interesting, it’s a good idea to promote \nintegration. \n\nNice to meet you I’m PIOTR, I’m Hungarian, I’m a truck driver and as well as in your country we really love to eat. If you \nneed anything, just ring the bell. I’ll be here', '27_4_A.mp3', 0, 'Nice to meet you to. You’ve already all information. Yes, Others is one of the best projects I’ve been involved in. I’ll be very happy to provide you all the detail information. Right now, I’m going out but as soon as I’ll be back, I’ll Knock', 3, 'A', 'Nice to meet you PIOTR. I see you already know everything about OTHERS. I’m very proud of being involved in this project\nNow, I’m in a rush. See you soon', 0, 'A', 'Nice to meet you PIOTR. Yes, also in my country truck driver really like to eat well. I suppose you know well both restaurant and the whereabouts\nThank you for your time, see you soon', 5, 'A', NULL, NULL, 'A', NULL, 439),
(27, 5, 'A', 14, 1000, 'S', NULL, '157,31', '11', 'left', 'Is a question of Honour, Paris!', '27_5_A.mp3', 1, 'Oh no I miss a casserole. Let me check better. Among everything I have, I’ll find something useful', 0, 'A', 'Well, keep calm. I don’t have an 18 cm casserole. What should I use? Look there an 18 cm pan. Let’s use this', 2, 'A', 'Right. No issue here. I’m going to ask PIOTR. In Hungarian cuisine they use casserole. Lets hope he also like cooking not only eating', 4, 'B', NULL, NULL, 'A', NULL, 440),
(27, 6, 'A', 11, 1000, 'S', NULL, '73,223.000007629', '11', 'left', 'You solved with the 18 cm pan you found. But you realize \nthat something wrong ...', '27_6_A.mp3', 0, 'It’s too thick. Should I add more wine and water? I’ll make a mix of both of it', 0, 'A', 'It’s too thick! I’m going to look on internet for any suggestion', 0, 'A', 'It’s going too thick very quickly. The casserole would have been better. I should have asked PIOTR', 3, 'A', NULL, NULL, 'A', NULL, 441),
(27, 7, 'A', 14, 7, 'L', '301,3', '14,29', '11', 'left', 'Hi, I’m Amandine.. I\'m the manager of the Residence.\nWhat a nice smell.. \nAre you cooking a French dish? I can\'t resist to the scents of my home country! \nBut wait..I can smell that something is missing. In the original recipe we use laurels. \nBut I guess you didn’t use it', '27_7_A.mp3', 0, 'Of course, laurel is missing but we don’t care. In my recipe it was not specify.', 0, 'A', 'Oh my god the laurel, and now? I don’t want start from scratch. Lets add it now, but I have to go back to Piotr', 3, 'A', 'What if I add it now? It’s a joke. Right let’s start again. I’m going to eat this one.', 1, 'A', NULL, NULL, 'A', NULL, 442),
(27, 8, 'A', 13, 1000, 'S', NULL, '142,85', '11', 'left', 'I almost there. I’m only missing the wine', '27_8_A.mp3', 0, 'I joined the project related drinking and instead I’m cooking.\nLet\'s look for the proper wine for meat and that’s it', 0, 'A', 'Ok French dish and wine. Let\'s look for a red for beef. Maybe Amandine can help me.', 1, 'A', 'And if instead of a classic French wine I would go for a south African or Californian wine? That’s would be the main scope of others', 2, 'A', NULL, NULL, 'A', NULL, 443),
(27, 9, 'A', 12, 5, 'XL', '159,-10.989990234375', '46,83.0000152587', '11', 'left', 'It\'s your turn!... And now ladies and gentlemen…', '27_9_A.mp3', 0, 'The destiny choose for me to cook the boeuf bourguignon.. and destiny will decide if you will survive. Eat it paired with a “Sangue di Toro\" and good luck', 0, 'A', 'I’ve been really engaged in cooking a typical French dish. I’m never heard about and to pair the wine, I’ve searched the best sommelier suggestion on the web. Enjoy it with a French Cabernet Sauvignon of course. Parbeu…Bon Appetit', 1, 'A', 'This is a typical dish made with beef to pair it with a Californian Cabernet Sauvignon made in 2000, tasted fruity and lasting\nNow, it’s up to you OTHERS', 2, 'A', NULL, NULL, 'A', NULL, 444),
(27, 6, 'B', 15, 8, 'L', '310,-3', '30,41', '11', 'left', 'Hi, have a seat. You just arrived at the right moment. \nI was just starting to have dinner. \nCould you stay so we can have a chat?', '27_6_B.mp3', 0, 'Thank you very much but I can’t as I have some work to complete. Any chance do you have a casserole? I’m cooking for the project', 5, 'B', 'Thanks, but I can’t accept. I just came to ask you for a casserole. Do you have it? I must cook a dish for the project', 0, 'B', 'Thanks for inviting me, but I can’t stay this evening. Could you land me a casserole? I don’t have it and it’s important for the dish, I’m cooking for the project.\nIf everyone will survive, I’ll cook another one for you too', 8, 'B', NULL, NULL, 'B', NULL, 447),
(27, 7, 'B', 14, 7, 'L', '314,2', '28,38', '11', 'left', 'Hi, I’m Amandine.. I\'m the manager of the Residence.\nWhat a nice smell.. \nAre you cooking a French dish? I can\'t resist to the scents of my home country! \nBut wait..I can smell that something is missing. In the original recipe we use laurels. \nBut I guess you didn’t use it', '27_7_B.mp3', 0, 'Of course, laurel is missing but we don’t care. In my recipe it was not specify. How do you know yours is right?', 0, 'B', 'Oh my god the laurel and now? I don’t want start from scratch. Lets add it now, but I have to go back to Piotr', 8, 'B', 'What if I add it now? It’s a joke. Right let’s start again. I’m going to eat this one.', 5, 'B', NULL, NULL, 'B', NULL, 448),
(27, 8, 'B', 13, 1000, 'S', NULL, '143,89.000015258', '11', 'left', 'I almost there. I’m only missing the wine', '27_8_B.mp3', 0, 'I joined the project related drinking. And instead I’m cooking\nLet\'s look for the proper wine for meat and that’s it', 0, 'B', 'Ok French dish and wine. Let\'s look for a red for beef. Maybe Amandine can help me.', 4, 'B', 'And if instead of a classic French wine I would go for a south African or Californian wine? That’s would be the main scope of others', 8, 'B', NULL, NULL, 'B', NULL, 449),
(27, 9, 'B', 12, 5, 'XL', '166,-14', '48,73.0000009536', '11', 'left', 'It\'s your turn!... And now ladies and gentlemen…', '27_9_B.mp3', 0, 'The destiny choose for me to cook the boeuf bourguignon.. and destiny will decide if you will survive. Eat it paired with a “Sangue di Toro”….good luck', 0, 'B', 'I’ve been really engaged in cooking a typical French dish. I’m never heard about and to pair the wine, I’ve searched the best sommelier suggestion on the web. Enjoy it with a French Cabernet Sauvignon of course. Parbeu…Bon Appetit', 7, 'B', 'This is a typical dish made with beef to pair it with a Californian Cabernet Sauvignon made in 2000, tasted fruity and lasting\nNow, it’s up to you OTHERS', 10, 'B', NULL, NULL, 'B', NULL, 450),
(27, 10, 'A', 12, 5, 'XL', '-38,-8', '157,31', '11', 'right', 'Bravo, you did it! Your colleagues really enjoyed the dish and your group will get the \"BEST Spirit of OTHERS\" prize', '27_10_A.mp3', 0, NULL, NULL, 'A', NULL, NULL, 'A', NULL, NULL, 'A', NULL, NULL, 'A', 'winning', 538),
(27, 11, 'A', 12, 5, 'XL', '-38,-7', '157,31', '11', 'right', 'So far you have failed! Your dish is placed as last. You were not careful to stick into the original recipe and you’re not able to find the correct ingredients to do it.', '27_11_A.mp3', 0, NULL, NULL, 'A', NULL, NULL, 'A', NULL, NULL, 'A', NULL, NULL, 'A', 'loosing', 539);

-- --------------------------------------------------------

--
-- Struttura della tabella `games_steps_attachments`
--

CREATE TABLE `games_steps_attachments` (
  `gameId` int(11) NOT NULL,
  `step` int(2) NOT NULL,
  `scene` enum('A','B','C') NOT NULL DEFAULT 'A',
  `title` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `type` varchar(32) NOT NULL DEFAULT 'attach',
  `idAttachment` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `games_steps_attachments`
--

INSERT INTO `games_steps_attachments` (`gameId`, `step`, `scene`, `title`, `path`, `type`, `idAttachment`) VALUES
(27, 2, 'A', 'Recettes du boeuf bourguignon | La sélection de 750g</title> <meta name=\"description\" content=\"Recettes du boeuf bourguignon : les 9 recettes coup de cœur, rigoureusement sélectionnées par Chef Damien et Chef Christophe.\" /> <meta name=\"keywords\" content=', 'https://www.750g.com/recettes_boeuf_bourguignon.htm', 'link', 121),
(27, 5, 'A', 'receipt', '/data/attachments/receipt_0619654001559998471_27_5.gif', 'attach', 123),
(27, 8, 'B', 'Wine 101: How to Pair Wine and Food - YouTube', 'https://www.youtube.com/watch?v=KRGsify9KyM', 'link', 134),
(27, 2, 'A', 'https://www.lecreuset.de/boeuf-bourguignon', 'https://www.lecreuset.de/boeuf-bourguignon', 'link', 138),
(27, 2, 'A', 'https://www.bbc.com/food/recipes/boeuf_bourguignon_25475', 'https://www.bbc.com/food/recipes/boeuf_bourguignon_25475', 'link', 139),
(27, 5, 'A', 'bistecchiera', '/data/attachments/bistecchiera_27_5.jpg', 'attach', 141),
(27, 8, 'B', 'FOOD & WINE', '/data/attachments/food_&_wine_27_8.png', 'attach', 143),
(27, 5, 'B', 'bistecchiera', '/data/attachments/bistecchiera_27_5.jpg', 'attach', 144),
(27, 8, 'A', 'Wine 101: How to Pair Wine and Food - YouTube', 'https://www.youtube.com/watch?v=KRGsify9KyM', 'link', 145),
(27, 8, 'A', 'Food & Wine Pairings For Beginners - YouTube', 'https://www.youtube.com/watch?v=6TZHxNx24E8', 'link', 146),
(27, 8, 'A', 'FOOD & WINE', '/data/attachments/food_&_wine_27_8.png', 'attach', 148),
(27, 8, 'B', 'unconventional pairing food and wine', 'https://www.forbes.com/sites/lesliewu/2016/04/29/through-the-looking-glass-two-innovative-ways-sommeliers-are-taking-a-new-perspective-on-wine-pairings-part-two/#8fed3ea97550', 'link', 152),
(27, 5, 'A', 'set di padelle', '/data/attachments/set_di_padelle_27_5.jpeg', 'attach', 153),
(27, 5, 'A', 'bistecchiera', '/data/attachments/bistecchiera_27_5.jpg', 'attach', 154);

-- --------------------------------------------------------

--
-- Struttura della tabella `game_family`
--

CREATE TABLE `game_family` (
  `gameId` int(11) DEFAULT NULL,
  `family` varchar(16) COLLATE latin1_general_ci DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `game_usersgroups`
--

CREATE TABLE `game_usersgroups` (
  `gameId` int(11) NOT NULL,
  `idgroup` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `matches`
--

CREATE TABLE `matches` (
  `idm` int(11) NOT NULL,
  `gameId` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) DEFAULT NULL,
  `final` varchar(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `matches`
--

INSERT INTO `matches` (`idm`, `gameId`, `uid`, `start`, `end`, `final`) VALUES
(1, 27, 1, 1616945796, 1616946268, 'L4'),
(2, 27, 1, 1616949216, 1616949830, 'L2'),
(3, 27, 1, 1616949918, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `matches_step`
--

CREATE TABLE `matches_step` (
  `idm` int(11) NOT NULL,
  `step` int(11) NOT NULL,
  `scene` enum('A','B','C') NOT NULL DEFAULT 'A',
  `steps` int(11) NOT NULL,
  `ascore` int(11) NOT NULL,
  `answerN` int(2) NOT NULL,
  `ts` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `matches_step`
--

INSERT INTO `matches_step` (`idm`, `step`, `scene`, `steps`, `ascore`, `answerN`, `ts`, `id`) VALUES
(1, 1, 'A', 9, 3, 2, 1616945831, 1),
(1, 2, 'A', 9, 3, 2, 1616945858, 2),
(1, 3, 'A', 9, 0, 1, 1616945912, 3),
(1, 4, 'A', 9, 3, 1, 1616945954, 4),
(1, 5, 'A', 9, 4, 3, 1616945980, 5),
(1, 6, 'B', 9, 0, 2, 1616945994, 6),
(1, 7, 'B', 9, 5, 3, 1616946013, 7),
(1, 8, 'B', 9, 8, 3, 1616946040, 8),
(1, 9, 'B', 9, 0, 1, 1616946048, 9),
(2, 1, 'A', 9, 3, 2, 1616949259, 10),
(2, 2, 'A', 9, 0, 1, 1616949292, 11),
(2, 3, 'A', 9, 0, 1, 1616949316, 12),
(2, 4, 'A', 9, 3, 1, 1616949397, 13),
(2, 5, 'A', 9, 0, 1, 1616949436, 14),
(2, 6, 'A', 9, 3, 3, 1616949452, 15),
(2, 7, 'A', 9, 3, 2, 1616949510, 16),
(2, 8, 'A', 9, 0, 1, 1616949529, 17),
(2, 9, 'A', 9, 1, 2, 1616949537, 18);

-- --------------------------------------------------------

--
-- Struttura della tabella `plang`
--

CREATE TABLE `plang` (
  `name` varchar(255) NOT NULL,
  `usr` enum('0','1') DEFAULT '0',
  `edt` enum('0','1') NOT NULL DEFAULT '0',
  `it` text NOT NULL,
  `en` text NOT NULL,
  `ar` text NOT NULL,
  `es` text NOT NULL,
  `de` text NOT NULL,
  `fr` text NOT NULL,
  `pt` text NOT NULL COMMENT 'português',
  `id` int(11) NOT NULL,
  `note` varchar(1024) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `plang`
--

INSERT INTO `plang` (`name`, `usr`, `edt`, `it`, `en`, `ar`, `es`, `de`, `fr`, `pt`, `id`, `note`) VALUES
('month_january', '1', '0', 'gennaio', 'January', '', 'enero', 'Jänner', 'janvier', 'janeiro', 1, ''),
('month_february', '1', '0', 'febbraio', 'February', '', 'febrero', 'Februar', 'février', 'fevereiro', 2, ''),
('month_march', '1', '0', 'marzo', 'March', '', 'marzo', 'März', 'mars', 'março', 3, ''),
('month_april', '1', '0', 'aprile', 'April', '', 'abril', 'April', 'avril', 'abril', 4, ''),
('month_may', '1', '0', 'maggio', 'May', '', 'mayo', 'Mai', 'mai', 'maio', 5, ''),
('month_june', '1', '0', 'giugno', 'June', '', 'junio', 'Juni', 'juin', 'junho', 6, ''),
('month_july', '1', '0', 'luglio', 'July', '', 'julio', 'Juli', 'juillet', 'julho', 7, ''),
('month_august', '1', '0', 'agosto', 'August', '', 'agosto', 'August', 'août', 'agosto', 8, ''),
('month_september', '1', '0', 'settembre', 'September', '', 'septiembre', 'September', 'septembre', 'setembro', 9, ''),
('month_october', '1', '0', 'ottobre', 'October', '', 'octubre', 'Oktober', 'octobre', 'outubro', 10, ''),
('month_november', '1', '0', 'novembre', 'November', '', 'noviembre', 'November', 'novembre', 'novembro', 11, ''),
('month_december', '1', '0', 'dicembre', 'December', '', 'diciembre', 'Dezember', 'décembre', 'dezembro', 12, ''),
('monday', '1', '0', 'lunedì', 'Monday', '', 'lunes', 'Montag', 'lundi', 'segunda', 13, ''),
('tuesday', '1', '0', 'martedì', 'Tuesday', '', 'martes', 'Dienstag', 'mardi', 'terça', 14, ''),
('wednesday', '1', '0', 'mercoledì', 'Wednesday', '', 'miércoles', 'Mittwoch', 'mercredi', 'quarta', 15, ''),
('thursday', '1', '0', 'giovedì', 'Thursday', '', 'jueves', 'Donnerstag', 'jeudi', 'quinta', 16, ''),
('friday', '1', '0', 'venerdì', 'Friday', '', 'viernes', 'Freitag', 'vendredi', 'sexta', 17, ''),
('saturday', '1', '0', 'sabato', 'Saturday', '', 'sábado', 'Samstag', 'samedi', 'sábado', 18, ''),
('sunday', '1', '0', 'domenica', 'Sunday', '', 'domingo', 'Sonntag', 'dimanche', 'domingo', 19, ''),
('msg_QUESTION_DOTS_on_facebook_and_google_too', '0', '0', '...anche su FB e Google?', '..on FB and Google as well?', '', '...¿también en FB y Google?', '', '...même sur FB et Google?', '...Também no FB e Google?', 20, ''),
('about_a_week_ago', '1', '0', 'la settimana scorsa', 'a week ago', '', '', '', '', '', 1487, ''),
('day', '1', '0', 'Giorno', 'Day', '', 'Día', 'Tag', 'Jour', 'Dia', 22, ''),
('month', '1', '0', 'Mese', 'Month', '', 'Mes', 'Monat', 'Mois', 'Mês', 23, ''),
('year', '1', '0', 'Anno', 'Year', '', 'Año', 'Jahr', 'Année', 'Ano', 24, ''),
('we_re_sorry_too_many_connections', '0', '0', 'Ci spiace ma in questo momento ci sono un po\' troppe connessioni', 'Sorry, too many connections at the moment', '', 'Lo siento, demasiadas conexiones en este momento', '', 'Désolés, mais dans ce moment il y a trop de connexions', 'Desculpe, actualmente existem muitas conexões', 25, ''),
('try_later', '0', '0', 'Riprova tra qualche istante', 'Try later', '', 'Por favor, intentelo más tarde', 'versuchen Sie es späte', 'Réessayez après quelques instants', 'Tente novamente em alguns minutos', 26, ''),
('birth_date', '0', '0', 'Data di nascita', 'Birth date', '', 'Fecha del nacimiento', '', 'Date de naissance', 'Data de nascimento', 27, ''),
('msg_sign_up_digit_your_new_password', '0', '0', 'Digita la tua nuova password', 'Digit your new password', '', 'Escriba su nueva contraseña', '', 'Saisissez votre nouveau mot de passe', 'Digite a sua nova senha', 912, ''),
('tag', '0', '0', 'Tag', 'Tag', '', 'Tag', '', 'Tag', 'Tag', 31, ''),
('undo', '0', '0', 'ripristina', 'Undo', '', 'restaurar', '', 'rétablir', 'restaurar', 46, ''),
('msg_sharing_box_edit', '0', '0', 'modifica', 'Edit', '', 'editar', '', 'modifier', 'editar', 47, ''),
('msg_txt_tags', '0', '0', 'Tags', 'Tags', '', 'Tags', '', 'Tags', 'Tags', 49, ''),
('msg_txt_add', '0', '0', 'Aggiungi', 'Add', '', 'Añadir', '', 'Ajoutez', 'adicionar', 70, ''),
('are_you_sure', '1', '1', 'Sei sicuro?', 'Are you sure?', 'هل أنت واثق؟', '¿Está seguro?', '', 'êtes-vous sûrs?', 'Tem certeza?', 81, ''),
('read_more', '0', '0', 'mostra tutto', 'Show all', '', 'Ver más', '', 'afficher tout', 'ver mais', 100, ''),
('show_less', '0', '0', 'riduci', 'show less', '', 'Ver menos', '', 'masquer', 'ver menos', 101, ''),
('loading', '1', '0', 'Sto caricando', 'Loading', 'المحمل', 'Estoy cargando (Lo juro)', '', 'Chargement (Je jure)', 'estou carregando (eu juro:-)', 102, ''),
('close', '1', '0', 'chiudi', 'close', 'أغلق', 'cerrar', '', 'fermer', 'fechar', 103, ''),
('image_doesnt_exist', '0', '0', 'Immagine inesistente', 'The image doesn\'t exist', '', 'la imagen no existe', '', 'Image inexistante', 'A imagem não existe', 106, ''),
('image_doesnt_exist_description', '0', '0', 'L\'immagine non esiste più... probabilmente é stata rimossa, o spostata', 'The image doesn\'t exists anymore... maybe it has been removed or moved', '', 'La imagen no existe más ... Tal vez se ha eliminado o movido', '', 'L\'image n\'existe plus...probablement elle a été supprimée, ou déplacée', 'A imagem não existe mais... Talvez tenha sido excluído ou movido', 107, ''),
('vabe', '1', '0', 'Vabé', 'That\'s right', '', 'No pasa nada', '', 'Bien', 'Ok', 108, ''),
('error', '1', '0', 'errorino', 'small mistake', 'خطأ صغير', 'problemita', '', 'petit erreur', 'Houston, temos um problema', 109, ''),
('error_description', '0', '0', 'sembra che ci sia un problemino, prova a controllare la tua connessione', 'it seems like you have a little problem, check your connection', '', 'parece que hay un problema, prueba a ver tu conección', '', 'il semble qu\'il y a un petit problème, esseyez de contrôler votre connexion', 'parece ser um problema, tente verificar a sua conexão', 110, ''),
('msg_txt_login', '1', '0', 'Entra', 'LogIn', 'تسجيل الدخول', 'Acceder', '', 'Connexion', 'Entrar', 126, ''),
('logout', '1', '1', 'Esci', 'LogOut', 'خروج', 'Salir', '', 'Déconnexion', 'Sair', 127, ''),
('to', '1', '1', 'a', 'To', 'To(ar)', 'Para', '', 'À', 'Para', 130, ''),
('from', '1', '1', 'Da', 'From', 'From(ar)', 'de', '', 'De', 'Do', 131, ''),
('send', '1', '0', 'Invia', 'Send', 'إرسال', 'Envíar', '', 'Envoyer', 'Enviar', 135, ''),
('cancel', '1', '1', 'Annulla', 'Cancel', '', 'Cancelar', '', 'Annuler', 'cancelar', 136, ''),
('AND', '0', '0', 'e', 'and', '', 'y', '', 'et', 'e', 138, ''),
('OR', '0', '0', 'o', 'or', '', 'o', '', 'ou', 'ou', 139, ''),
('peoples', '0', '0', 'persone', 'people', '', 'personas', '', 'personnes', 'pessoas', 140, ''),
('person', '0', '0', 'persona', 'person', '', 'persona', '', 'personne', 'pessoa', 141, ''),
('remove', '0', '0', 'elimina', 'remove', '', 'elimina', '', 'supprimer', 'remover', 176, ''),
('sign_up', '1', '0', 'Iscriviti', 'SignUp', 'الاشتراك', 'Regístrate', '', 'Inscrivez-vous', 'Cadastre-se', 223, ''),
('signup_form', '0', '0', 'Iscrizione', 'signup form', '', 'Regístrate', '', 'Inscription', 'Inscrição', 224, ''),
('please_be_honest', '0', '0', 'per favore sii sincero', 'please be honest', '', 'por favor, se honesto', '', 'soyez sincères, s\'il vous plaît', 'por favor, seja honesto', 225, ''),
('log_in', '1', '0', 'Accedi', 'Log In', 'تسجيل الدخول', 'Entrar', '', 'Connexion', 'Accesse', 226, ''),
('keep_me_logged_in', '0', '0', 'resta connesso', 'keep me logged in', '', 'no cerrar sesión', '', 'garder ma session active', 'Mantenha-me conectado', 227, ''),
('msg_txt_continue', '1', '0', 'Continua', 'Continue', '', 'Siguen', '', 'Continuer', 'Continuar', 244, ''),
('msg_login_banned', '0', '0', 'Account sospeso', 'Account suspended', '', 'Cuenta suspendida', '', 'Compte suspendu', 'Conta suspensa', 260, ''),
('msg_login_banned_description', '0', '0', 'ci spiace comunicarti che il tuo account é stato sospeso.', 'we are sorry to inform you that your account has been suspended.', '', 'Lamentamos informarte que tu cuenta ha sido suspendida.', '', 'désolés de vous communiquer que votre compte a été suspendu', 'Lamentamos informar que sua conta foi suspensa', 261, ''),
('msg_txt_account', '0', '0', 'Account', 'Account', '', 'Cuenta', '', 'Compte', 'Conta', 268, ''),
('user', '1', '1', 'Utente', 'User', 'مستخدم', 'Usuario', '', 'Utilisateur', 'Usuário', 281, ''),
('password', '1', '1', 'Password', 'Password', 'كلمة المرور', 'Contraseña', '', 'Mot de passe', 'Senha', 282, ''),
('email', '1', '1', 'Email', 'Email', '', 'Tu correo electrónico', '', 'Adresse électronique', 'E-mail', 283, ''),
('username', '0', '0', 'Nome Utente', 'UserName', '', 'Nombre de usuario', '', 'Nom d\'utilisateur', 'Nome de usuário', 284, ''),
('lastname', '1', '1', 'Cognome', 'Last Name', '', 'Apellido', '', 'Nom de famille', 'Sobrenome', 286, ''),
('firstname', '1', '1', 'Nome', 'First Name', '', 'Nombre', '', 'Prénom', 'Nombre', 287, ''),
('your_real_lastname', '0', '0', 'il tuo VERO Cognome', 'Your real Last Name', '', 'Su apellido REAL', '', 'Votre vrai nom de famille', 'seu VERDADEIRO Sobrenome', 288, ''),
('your_real_firstname', '0', '0', 'il tuo VERO Nome', 'Your real first Name', '', 'Su nombre REAL', '', 'Votre vrai prénom', 'seu VERDADEIRO Nombre', 289, ''),
('reenter_email', '1', '0', 'Per sicurezza, riscrivi la tua email', 'Please, re-enter your email again', '', 'Por seguridad, escribe de nuevo tu correo electrónico', '', 'Pour être plus sûrs, récrivez votre adresse électronique', 'Para maior segurança, digite seu e-mail novamente', 290, ''),
('msg_sign_up_digit_your_password', '0', '0', 'Digita la tua password', 'Digit your password', '', 'Escriba su contraseña', '', 'Écrivez votre mot de passe', 'Digite sua senha', 291, ''),
('not_correct', '0', '0', 'Non corretto', 'incorrect', '', 'incorrecto', '', 'pas exact', 'incorreto', 292, ''),
('digit', '0', '1', 'Digita', 'Digit', '', 'Escribir', '', 'Écrivez', 'Digite', 293, ''),
('it_cant_be_changed', '0', '0', 'non può essere cambiato', 'it cannot be changed', '', 'no puede ser cambiado', '', 'ne peut pas être changé', 'não pode ser alterado', 296, ''),
('attention', '0', '1', 'Attenzione', 'Attention', 'ملاحظة', 'Cuidado', '', 'Attention', 'Atenção', 297, ''),
('save', '1', '1', 'Salva', 'Save', 'حفظ', 'Guardar', '', 'Enregistrer', 'salvar', 298, ''),
('not_available', '1', '1', 'Non disponibile', 'Not available', '', 'No está disponible', '', 'Non disponible', 'Indisponível', 301, ''),
('available', '0', '0', 'disponibile', 'available', '', 'disponible', '', 'disponible', 'disponível', 302, ''),
('too_short', '0', '1', 'Troppo breve', 'too short', '', 'demasiado corto', '', 'Trop bref', 'muito curto', 303, ''),
('too_long', '0', '0', 'Troppo lungo', 'too long', '', 'demasiado largo', '', 'Trop long', 'muito longo', 304, ''),
('not_complete', '0', '0', 'incompleto', 'incomplete', '', 'incompleto', '', 'incomplet', 'incompleto', 305, ''),
('checking', '0', '0', 'do una controllata...', 'let\'s check...', '', 'veamos un poco', '', 'je contrôle un peu...', 'estou verificando', 306, ''),
('email_exists', '1', '0', 'Email già registrata', 'This email already exists', '', 'Correo ya registrado', '', 'Adresse électronique déjà enregistrée', 'E-mail já registrada', 307, ''),
('sex', '1', '1', 'Sesso', 'Gender', '', 'Sexo', '', 'Sexe', 'Gênero', 308, ''),
('male', '1', '1', 'Maschio', 'Male', '', 'Hombre', '', 'Homme', 'Masculino', 309, ''),
('female', '1', '1', 'Femmina', 'Female', '', 'Mujer', '', 'Femme', 'Feminino', 310, ''),
('province', '0', '0', 'Provincia', 'Province', '', 'Provincia', '', 'Province', 'Condado', 324, ''),
('country', '0', '0', 'Nazione', 'Nation', '', 'Nación', '', 'État', 'Nação', 325, ''),
('region', '0', '0', 'Regione', 'Region', '', 'Región', '', 'Région', 'Região', 326, ''),
('note', '1', '0', 'NOTA', 'NOTE', 'ملاحظة', 'NOTA', '', 'NOTE', 'NOTA', 339, ''),
('sorry', '1', '1', 'Ci spiace', 'We are sorry', 'آسف', 'Lo sentimos', '', 'Désolés', 'Desculpe', 342, ''),
('it_seems_like_you_are_not_logged', '0', '0', 'sembra che tu non sia connesso in questo momento', 'it seems like you cannot connect at the moment', '', 'parece que no está conectado en este momento', '', 'il semble que vous n\'êtes pas connectés dans ce moment', 'Parece que você não está conectado neste momento', 343, ''),
('try_to_log_in_again', '0', '0', 'prova ad effettuare nuovamente il LOG-IN', 'try to LOGIN again', '', 'Tratar de entrar de nuevo', '', 'essayez à effectuer de nouveau le LOG-IN', 'Tente fazer o login novamente', 344, ''),
('show_all_SINGULAR', '1', '0', 'Mostra tutto', 'Show all', '\nعرض الكل', 'Mostra todo', '', 'Afficher tout', 'Ver todos', 385, ''),
('show_all_PLURAL', '1', '0', 'Mostra tutti', 'Show all', 'عرض الكل', 'Mostrar todos', '', 'Afficher tous', 'Ver todos', 386, ''),
('show_all_about', '0', '0', 'Mostra tutto su', 'Show all about', '', 'Muestra todo sobre', '', 'Afficher tout sur', 'Mostra tudo sobre', 387, ''),
('tags', '0', '0', 'tags', 'tags', '', 'tags', '', 'tags', 'tags', 391, ''),
('page_not_found', '0', '0', 'Pagina non trovata', 'Page not found', '', 'Página no encontrada', '', 'Page introuvable', 'Página não encontrada', 392, ''),
('the_page_you_requested_was_not_found', '0', '0', 'La pagina richiesta non è stata trovata', 'The page you requested was not found', '', 'No se pudo encontrar la página solicitada', '', 'La page cherchée est introuvable', 'A página solicitada não foi encontrada', 393, ''),
('you_may_have_clicked_an_expired_link_or_mistyped_the_address', '1', '0', 'Potresti aver cliccato su un link scaduto o aver digitato male l\'indirizzo', 'you may have clicked an expired link or mistyped the address', '', 'Puedes que hicieras clic en un enlace caducado o que escribieras mal la dirección', '', 'Ce lien n\'existe plus ou vous avez saisi une adresse incorrecte', 'Você pode ter clicado em um link expirado ou digitado o endereço errado', 394, ''),
('return_home', '0', '0', 'Torna in home page', 'Back home', '', 'Volver a la página de inicio', '', 'Retour à la page d\'accueil', 'Retornar à página inicial', 396, ''),
('home_page', '0', '0', 'Home Page', 'Home Page', '', 'Página de inicio', '', 'Accueil', 'Página inicial', 397, ''),
('go_back_to_the_previous_page', '0', '0', 'Torna alla pagina precedente', 'Back to the previous page', '', 'Volver a la página anterior', '', 'Retour à la page précédente', 'Retornar à página anterior', 398, ''),
('msg_tab_real_time', '0', '0', 'Tempo reale', 'Real Time', '', 'Tiempo real', '', 'Temps réel', 'Tempo real', 400, ''),
('yes', '1', '1', 'Sì', 'Yes', 'بلى', 'Sì', '', 'Oui', 'Sim', 461, ''),
('no', '1', '1', 'No', 'No', 'لا', 'No', '', 'Non', 'Não', 462, ''),
('moderator_options', '1', '0', 'Moderator\'s Options', 'Moderator\'s Options', 'Moderator\'s Options', 'Opciones de moderador', '', 'options du modérateur', 'Opções do moderador', 472, ''),
('ok', '1', '1', 'OK', 'OK', 'حسنا', 'OK', '', 'OK', 'OK', 473, ''),
('it_seems_like_youre_not_logged_in', '0', '0', 'Sembra che tu non abbia effettuato l\'accesso', 'It seems like you\'re not logged in', '', 'Parece que tú no está conectado', '', 'Il semble que vous n\'avez pas effectué la connexion', 'Parece que você não está conectado', 615, ''),
('log_in_and_try_again', '0', '0', 'Accedi e riprova', 'Log in and try again', '', 'Entrar y vuelva a intentarlo', '', 'Connettez-vous et ressayez', 'Entra e tente novamente', 616, ''),
('try_again', '0', '0', 'Riprova', 'Try again', '', 'volver a probar', '', 'Ressayez', 'tente novamente', 618, ''),
('suggest', '0', '0', 'Suggerisci', 'Suggest', '', 'sugerir', '', 'Suggérez', 'sugerir', 623, ''),
('when', '0', '0', 'Quando', 'When', '', 'Cuando', '', 'Quand', 'Quando', 624, ''),
('from_DATE', '1', '0', 'Da', 'From', '', 'Del', '', 'De', 'De', 625, ''),
('to_DATE', '1', '0', 'a', 'To', '', 'Al', '', 'à', 'a', 626, ''),
('tomorrow', '0', '0', 'domani', 'tomorrow', '', 'mañana', '', 'demain', 'amanhã', 647, ''),
('tonight', '0', '0', 'stasera', 'tonight', '', 'esta noche', '', 'ce soir', 'esta noite', 648, ''),
('today', '0', '0', 'oggi', 'today', '', 'hoy', '', 'aujourd\'hui', 'hoje', 649, ''),
('in_all', '0', '0', 'in tutto', 'in all', '', 'en total', '', 'en tout', 'no total', 659, ''),
('users', '1', '1', 'Utenti', 'Users', '', 'Usuarios', '', 'Utilisateurs', 'Usuarios', 673, ''),
('select_your_language', '1', '0', 'Seleziona la tua lingua', 'Select Your Language', 'اختر لغتك', 'Selecciona tu idioma', '', 'Sélectionnez votre langue', 'Selecione seu idioma', 675, ''),
('see_available_languages', '1', '0', 'Visualizza le lingue disponibili', 'Show available languages', 'مشاهدة اللغات المتوفرة', 'Mostrar los idiomas disponibles', '', 'Afficher toutes les langues disponibles', 'Mostrar idiomas disponíveis', 679, ''),
('privacy', '0', '0', 'Privacy', 'Privacy', '', 'Privacy', 'Privacy', 'Confidentialité', 'Privacidade', 701, 'no dialetto'),
('see_more_results_for', '0', '0', 'Visualizza tutti i risultati per', 'See more results for', '', 'Ver más resultados para', '', 'Voir tous les résultats pour', 'Ver todos os resultados para', 711, ''),
('displayed_results', '0', '0', 'Risultati visualizzati', 'Displayed results', '', 'Resultados mostrados', '', 'Résultats vus', 'Resultados exibidos', 712, ''),
('search', '0', '0', 'cerca', 'search', '', 'buscar', '', 'recherche', 'procurar', 724, ''),
('search_results', '0', '0', 'Risultati di ricerca', 'Search results', '', 'Resultados de búsqueda', '', 'Résultats de la recherche', 'Resultados da Pesquisa', 725, ''),
('search_results_for_TERM', '0', '0', 'Risultati di ricerca per', 'Search results for', '', 'Resultados de búsqueda para', '', 'Résultats de la recherche pour', 'Resultados da Pesquisa por', 726, ''),
('log_in_or_sign_up', '0', '0', 'Accedi o registrati', 'Log in or sign up', '', 'Ingresa o regístrate', '', 'Connettez-vous ou enregistrez-vous', 'Entre ou Cadastre-se', 768, ''),
('more', '1', '0', 'Altro', 'More', '', 'Más', '', 'Plus', 'Mais', 794, ''),
('welcome_MALE', '1', '0', 'Benvenuto', 'Welcome', 'ترحيب', 'Bienvenido', '', 'Bienvenu', 'Bem vindo', 853, ''),
('welcome_FEMALE', '1', '0', 'Benvenuta', 'Welcome', 'ترحيب', 'Bienvenida', '', 'Bienvenue', 'Ben vinda', 854, ''),
('welcomeback_MALE', '0', '0', 'Bentornato', 'Welcome back', '', 'Bienvenido de nuevo', '', 'Bienvenu', 'Bem-vindo de volta', 855, ''),
('welcomeback_FEMALE', '0', '0', 'Bentornata', 'Welcome back', '', 'Bienvenida de nuevo', '', 'Bienvenue', 'Bem-vinda de volta', 856, ''),
('title_is_too_short', '0', '0', 'Il titolo è troppo breve', 'The title is too short', '', 'El título es demasiado corto', '', 'Le titre est trop bref', 'O título é demasiado curto', 921, ''),
('no_title', '1', '0', 'Nessun titolo', 'No title', 'بلا عنوان', 'Sin título', '', 'Sans titre', 'Sem título', 929, ''),
('edit_title', '0', '0', 'modifica titolo', 'edit title', '', 'cambiar el título', '', 'modifier le titre', 'mudar o título', 931, ''),
('download_and_print', '0', '0', 'Scarica e Stampa', 'Download and Print', '', 'Descargue e Imprima', '', 'Téléchargez et Imprimez', 'Descarregar e Imprimir', 932, 'no dialetto'),
('last_update', '0', '0', 'ultimo aggiornamento', 'last update', '', 'última actualización', '', 'dernière actualisation', 'última actualização', 933, 'no dialetto'),
('INFO_main', '1', '0', 'Informazioni di base', 'Session Info', 'معلومات الدورة', '', '', '', '', 999, ''),
('charaters', '1', '1', 'Personaggi', 'Charaters', 'الأحرف', '', '', '', '', 1000, ''),
('goals', '1', '0', 'Obiettivi', 'Goals', 'أهداف', '', '', '', '', 1001, ''),
('show_all', '1', '0', 'Mostra tutto', 'Show all', 'عرض الكل', 'Mostra todo', '', 'Afficher tout', 'Ver todos', 1002, ''),
('next', '1', '0', 'prossimo', 'next', 'بعد', '', '', '', '', 1003, ''),
('previous', '1', '0', 'precedente', 'previous', 'سابق', '', '', '', '', 1004, ''),
('DFORM_send', '1', '0', 'Invia', 'Send', 'إرسال', 'Envíar', '', 'Envoyer', 'Enviar', 1005, ''),
('show_session_info', '1', '0', 'informazioni sulla sessione', 'Show Session info', 'معلومات اللعبة', '', '', '', '', 1006, ''),
('available_languages', '1', '0', 'Lingue disponibili', 'Available languages', 'اللغات المتوفرة', 'Idiomas disponibles', '', 'Langues disponibles', 'Idiomas disponíveis', 1007, ''),
('preview', '1', '0', 'Anteprima', 'Preview', 'معاينة', '', '', '', '', 1008, ''),
('show_last_exchange', '1', '0', 'Mostra l\'ultimo scambio', 'Show last exchange', 'عرض التبادل الماضي', '', '', '', '', 1010, ''),
('username_or_password_not_correct', '1', '0', 'lo username o la password non sono corretti', 'The Username or Password is incorrect', 'اسم المستخدم أو كلمة المرور غير صحيح', '', '', '', '', 1011, ''),
('LOGIN_username', '1', '0', 'Username', 'Username', 'اسم المستخدم', '', '', '', '', 1012, ''),
('LOGIN_password', '1', '0', 'Password', 'Password', 'كلمه السر', '', '', '', '', 1013, ''),
('you', '1', '0', 'Tu', 'You', 'أنت', 'Tu', '', 'Vous', 'Você', 120, ''),
('dashboard', '1', '1', 'Dash Board', 'Dash Board', 'لوحة القيادة', 'Tablero', '', '', '', 1014, ''),
('editor', '1', '1', 'Editor', 'Editor', 'محرر', '', '', '', '', 1015, ''),
('bot', '1', '1', 'Bot', 'Bot', 'رجل الالي', '', '', '', '', 1016, ''),
('parallel_sentences', '0', '1', 'Frasi parallele', 'Parallel sentences', 'الجمل المتوازية', '', '', '', '', 1017, ''),
('mood', '0', '1', 'Mood', 'Mood', 'مزاج', '', '', '', '', 1018, ''),
('do_you_want_to_save_the_changes', '0', '1', 'Salvare le modifiche?', 'Do you want to save the changes?', 'هل تريد حفظ التغييرات؟', '', '', '', '', 1019, ''),
('draft', '1', '1', 'Bozza', 'Draft', 'مسودة', '', '', '', '', 1020, ''),
('drafts', '1', '1', 'Bozze', 'Drafts', 'الداما', '', '', '', '', 1021, ''),
('normale_sereno', '1', '1', 'Normale, sereno', 'Normal, peaceful', 'Normale, sereno (ar)', '', '', '', '', 1023, ''),
('gioia', '1', '1', 'Gioia', 'Joy', 'Gioia (ar)', '', '', '', '', 1024, ''),
('sorpresa', '1', '1', 'Sorpresa', 'Surprise', 'Surprise (ar)', '', '', '', '', 1025, ''),
('rabbia_irritazione_disappunto', '1', '1', 'Rabbia, irritazione, disappunto', 'Anger, irritation, disappointment', 'Rabbia, irritazione, disappunto (ar)', '', '', '', '', 1026, ''),
('ansia_paura', '1', '1', 'Ansia, Paura', 'Anxiety , Fear', 'Anxiety , Fear (ar)', '', '', '', '', 1027, ''),
('diffidenza', '1', '1', 'Diffidenza', 'Distrust', 'distrust (ar)', '', '', '', '', 1028, ''),
('entusiasmo', '1', '1', 'Entusiasmo', 'Enthusiasm', 'Enthusiasm (ar)', '', '', '', '', 1029, ''),
('dispiacere', '1', '1', 'Dispiacere', 'Displeasure ', 'Displeasure (ar)', '', '', '', '', 1030, ''),
('interesse', '1', '1', 'Interesse', 'Interest', 'interest (ar)', '', '', '', '', 1031, ''),
('fiducia', '1', '1', 'Fiducia', 'Confidence ', 'Confidence (ar)', '', '', '', '', 1032, ''),
('upload_an_audio_file', '0', '1', 'Carica un file audio', 'Upload an audio file', 'Upload an audio file (AR)', '', '', '', '', 1033, ''),
('play', '0', '1', 'Play', 'Play', 'Play (ar)', '', '', '', '', 1034, ''),
('delete_the_current_audiofile_and_upload_a_new_one', '0', '1', 'Cancella questo file audio e caricane un altro', 'Delete the current audio file and upload a new one', 'حذف الملف الصوتي الحالي وتحميل واحدة جديدة', '', '', '', '', 1035, ''),
('pause', '0', '1', 'Pause', 'Pause', 'Pause (ar)', '', '', '', '', 1036, ''),
('insert_comment', '1', '1', 'inserisci un commento', 'Insert comment', 'Insert comment (ar)', '', '', '', '', 1037, ''),
('comment_this_exchange', '0', '1', 'Commenta questo scambio', 'Comment this exchange', 'Comment this exchange (ar)', '', '', '', '', 1038, ''),
('happy_assertive_ending', '1', '1', 'Lieto fine assertivo', 'Happy assertive ending', 'Happy \'assertive\' ending (ar)', '', '', '', '', 1039, ''),
('bot_temperament', '1', '1', 'Temperamento del Bot', 'Bot temperament', 'Bot temperament (ar)', '', '', '', '', 1042, ''),
('very_submissive', '1', '1', 'Molto inibito', 'Very shy', 'Very submissive (ar)', '', '', '', '', 1043, ''),
('submissive', '1', '1', 'Inibito', 'Shy', 'Submissive (ar)', '', '', '', '', 1044, ''),
('assertive', '1', '1', 'Assertivo', 'Assertive', 'Assertive (ar)', '', '', '', '', 1045, ''),
('aggressive', '1', '1', 'Aggressivo', 'Aggressive', 'Aggressive (ar)', '', '', '', '', 1046, ''),
('very_aggressive', '1', '1', 'Molto aggressivo', 'Very aggressive', 'Very aggressive (ar)', '', '', '', '', 1047, ''),
('BOT_TEMPERAMENT_INDEFINITE', '0', '1', 'Non lo so :-( prova ad assegnare più punteggi', 'I dont know :-( Try to assign more \"scores\"', 'I dont know :-( Try to complete more scores (ar)', '', '', '', '', 1048, ''),
('delete', '0', '1', 'Cancella', 'Delete', 'Delete (ar)', '', '', '', '', 1049, ''),
('add', '0', '1', 'Aggiungi', 'Add', 'Add(ar)', '', '', '', '', 1050, ''),
('back', '1', '1', 'Indietro', 'Back', 'الى الخلف', '', '', '', '', 1051, ''),
('go_to_next_step', '1', '1', 'Vai al prossimo step', 'Go to the next step', 'Go to the next step(ar)', '', '', '', '', 1052, ''),
('to_the_first_step', '0', '1', 'al primo step', 'to the first step', 'إلى الخطوة الأولى', '', '', '', '', 1053, ''),
('debriefing_simulation', '0', '1', 'Debriefing Simulation', 'Debriefing Simulation', 'Debriefing Simulation(ar)', '', '', '', '', 1054, ''),
('scores_are_not_properly_assigned', '0', '1', 'Punteggi non assegnati correttamente', 'Scores are not properly assigned', 'Scores are not properly assigned (ar)', '', '', '', '', 1055, ''),
('qualitative_comment', '1', '1', 'Commento Qualitativo', 'Qualitative Comment', 'Qualitative Comment (ar)', '', '', '', '', 1056, ''),
('quantitative_comment', '1', '1', 'Commento Quantitativo', 'Quantitative Comment', 'Quantitative Comment (ar)', '', '', '', '', 1057, ''),
('EDITOR_CHECK_TEXT', '0', '1', 'Il Game è attualmente in modalità DRAFT e quindi non disponibile per il gioco. \r\nPer renderlo \'Playable\'...\r\n', 'The Game is actually saved as a DRAFT so it\'s not playble yet.<br />To save it as Playable, Please...', '', '', '', '', '', 1058, ''),
('step', '0', '1', 'Step', 'Step', '', '', '', '', '', 1552, ''),
('missing', '0', '1', 'Mancante', 'Missing', '', '', '', '', '', 1553, ''),
('check_missing_values', '0', '1', 'Controlla valori mancanti', 'Check missing values', 'تحقق القيم المفقودة', '', '', '', '', 1059, ''),
('comment_result_for_this_range', '0', '1', 'Commento per il risultato in questo range', 'Comment result for this range ', 'Comment result for this range (ar)', '', '', '', '', 1060, ''),
('add_user_goal', '0', '1', 'Aggiungi Scopo Utente', 'Add User Goal', 'Add User Goal (ar)', '', '', '', '', 1062, ''),
('add_bot_goal', '0', '1', 'Aggiungi Scopo Bot', 'Add Bot Goal', 'Add Bot Goal (ar)', '', '', '', '', 1063, ''),
('state', '1', '1', 'Stato', 'State', 'State(ar)', '', '', '', '', 1065, ''),
('not_completed', '1', '1', 'Non completato', 'Not completed', 'Not completed(ar)', '', '', '', '', 1066, ''),
('group', '1', '1', 'Gruppo', 'Group', 'Group(ar)', '', '', '', '', 1067, ''),
('score_not_propertly_assigned', '0', '1', 'Punteggi non assegnati correttamente', 'Scores not properly assigned', 'Scores not properly assigned (ar)', '', '', '', '', 1068, ''),
('range', '0', '1', 'Range', 'Range', 'Range(ar)', '', '', '', '', 1069, ''),
('exchange', '1', '1', 'Scambio', 'Exchange', 'Exchange(ar)', '', '', '', '', 1070, ''),
('session_date', '1', '1', 'Data Sessione', 'Session Date', 'Session Date(ar)', '', '', '', '', 1071, ''),
('my_last_sessions', '1', '0', 'Le mie ultime sessioni', 'My last sessions', 'My last sessions(ar)', '', '', '', '', 1072, ''),
('bot_initial_escalation', '0', '1', 'Escalation Iniziale del Bot', 'Bot Initial Escalation', 'Bot Initial Escalation(ar)', '', '', '', '', 1074, ''),
('missing_comment_s', '0', '1', 'uno o più commenti mancanti', 'one or more comments are missing', '', '', '', '', '', 1075, ''),
('missing_the_final_comment', '0', '1', 'Manca il commento finale', 'The final comment is missing', 'Missing the final comment(ar)', '', '', '', '', 1076, ''),
('missing_one_or_more_user_texts', '0', '1', 'Mancano uno o più testi dello User', 'One or more User\'s texts are missing', 'Missing one or more User\'s texts(ar)', '', '', '', '', 1077, ''),
('missing_one_or_more_bot_texts', '', '1', 'Mancano uno o più testi del Bot', 'one or more of Bot\'s texts are missing', 'Missing one or more Bot\'s texts(ar)', '', '', '', '', 1078, ''),
('missing_the_bot_emotion', '', '1', 'Manca l\'emozione del Bot', 'Bot emotion is missing', 'Missing the Bot emotion(ar)', '', '', '', '', 1079, ''),
('missing_the_user_emotion', '', '1', 'Manca l\'emozione dello user', 'User’s emotion is missing', 'Missing the User emotion(ar)', '', '', '', '', 1080, ''),
('missing_one_or_more_bot_audioclips', '0', '1', 'Mancano una o più audio clip del Bot', 'One or more Bot audioclips are missing', 'Missing one or more Bot audioclips (ar)', '', '', '', '', 1081, ''),
('missing_one_or_more_user_audioclips', '0', '1', 'Mancano una o più audio clip dello User', 'One or more User audioclips are missing', 'Missing one or more User audioclips (ar)', '', '', '', '', 1082, ''),
('not_commented', '0', '1', 'non commentato', 'not commented', 'not commented(ar)', '', '', '', '', 1083, ''),
('playing_simulation', '0', '1', 'Simulazione di gioco', 'Game simulation', 'Playing simulation(ar)', '', '', '', '', 1084, ''),
('SAVE_PLAYABLE_ADVICE', '0', '1', 'ATTENZIONE: non potrai modificare più il Game, potrai però cancellarlo o copiarlo', 'WARNING: you won\'t be able to edit it anymore. You\'ll be able to delete or copy it', '', '', '', '', '', 1086, ''),
('the_first_two_answers_are_mandatory', '0', '1', 'Le prime due risposte sono obbligatorie', 'The first two answers are mandatory', '', '', '', '', '', 1555, ''),
('operations', '1', '1', 'operazioni', 'operations', 'operations(ar)', '', '', '', '', 1088, ''),
('create_a_copy_in_drafts', '1', '0', 'Crea una copia in Bozze', 'Create a copy in Drafts', 'Create a copy in Drafts(ar)', '', '', '', '', 1089, ''),
('set_offline', '1', '0', 'Metti OffLine', 'Set OffLine', 'Set OffLine(ar)', '', '', '', '', 1090, ''),
('copy_of_SOMETHING', '1', '1', 'Copia di', 'Copy of', 'نسخة من', '', '', '', '', 1091, ''),
('end_of_match', '1', '1', 'Fine Match', 'End of the Match', 'نهاية المباراة', '', '', '', '', 1093, ''),
('the_complete_results', '1', '1', 'I Risultati completi', 'The Complete results', 'النتائج الكاملة', '', '', '', '', 1094, ''),
('DIALOGUE_BOX_LOG_INTRO', '1', '0', 'Qui troverai tutti gli scambi effettuati durante il dialogo tra #user# e #bot#', 'Here you will find all the dialogue exchanges between #user# and #bot#', 'هنا سوف تجد جميع التبادلات الحوار بينك وبين بوت', '', '', '', '', 1095, ''),
('dialogue', '1', '0', 'Dialogo', 'Dialogue', 'حوار', '', '', '', '', 1096, ''),
('evaluating_your_performance', '1', '0', 'Sto valutando la tua performance', 'Evaulating your performance', 'تقييم أدائك', '', '', '', '', 1097, ''),
('say_it', '1', '0', 'Dillo', 'Choose', 'قل', '', '', '', '', 1098, ''),
('final', '1', '1', 'Finale', 'Final', 'نهائي', '', '', '', '', 1099, ''),
('BOT_INITIAL_ESCALATON_DISCLAIMER_NEGATIVE', '1', '0', 'Il Bot partiva con un atteggiamento iniziale di sottomissione pari a', 'The Bot started with an initial submissive attitude of', 'بدأ الصبي مع الموقف المبدئي منقاد من', '', '', '', '', 1100, ''),
('BOT_INITIAL_ESCALATON_DISCLAIMER_POSITIVE', '1', '0', 'Il Bot partiva con un atteggiamento iniziale di aggressività pari a', 'The Bot started with an initial aggressive attitude of', 'بدأ الصبي مع الموقف المبدئي منقاد من', '', '', '', '', 1101, ''),
('the_scale_of_values_varies_from_100_to_100', '1', '0', 'La scala di valori varia da -100 a +100', 'The scale of values varies from -100 to +100', 'سلم القيم يختلف من -100 إلى +100', '', '', '', '', 1102, ''),
('the_winning_area_goes_from_X_to_Y', '1', '0', 'L\'area vincente va da #X# a #Y#', 'The winning area goes from #X# to #Y#', 'منطقة كسب وغني عن #X# إلى #Y#', '', '', '', '', 1103, ''),
('bot_initiial_temperament', '1', '0', 'Orientamento iniziale del Bot', 'Bot starting temperament ', 'Bot starting temperament(AR)', '', '', '', '', 1104, ''),
('total_time_played', '1', '0', 'Tempo totale di gioco', 'Total time played', 'الوقت الإجمالي لعبت', '', '', '', '', 1105, ''),
('reached_score', '1', '0', 'Punteggio Conseguito', ' Score Reached ', 'النتيجة التي تم التوصل إليها', '', '', '', '', 1106, ''),
('epic_fail', '1', '0', 'Epic Fail', 'Epic Fail', 'Epic FailAR', '', '', '', '', 1107, ''),
('magic_moment', '1', '0', 'Magic Moment', 'Magic Moment', 'Magic MomentAR', '', '', '', '', 1108, ''),
('watch_again', '1', '1', 'Rivedi', 'Watch again', 'نهاية المباراة', '', '', '', '', 1109, ''),
('watch_the_full_movie_of_your_match', '1', '0', 'Guarda il \"film\" del tuo Match', 'Watch the full movie of your match', 'مشاهدة الفيلم الكامل لمباراة الخاص بك', '', '', '', '', 1110, ''),
('thirty_years_old_man', '1', '1', 'Uomo trentenne', 'A thirty-year-old man', 'رجل في الثلاثين من عمره', '', '', '', '', 1111, ''),
('thirty_years_old_woman', '1', '1', 'Donna trentenne', 'A thirty-year-old woman', 'رجل في الثلاثين من عمره', '', '', '', '', 1112, ''),
('forty_years_old_woman', '1', '1', 'Donna quarantenne', 'A forty-year-old woman', 'رجل في الثلاثين من عمره', '', '', '', '', 1113, ''),
('fifty_years_old_man', '1', '1', 'Uomo cinquantenne', 'A fifty-year-old man', 'رجل في الثلاثين من عمره', '', '', '', '', 1114, ''),
('title', '0', '1', 'Titolo', 'Title', 'Title(ar)', '', '', '', '', 1116, ''),
('description', '1', '1', 'Descrizione', 'Description', 'DescriptionAR', '', '', '', '', 1118, ''),
('scenario', '0', '1', 'Scenario', 'Scenario', 'ScenarioAR', '', '', '', '', 1119, ''),
('states', '0', '1', 'Stati', 'States', 'StatesAR', '', '', '', '', 1120, ''),
('sentences_groups', '0', '1', 'Gruppi di frasi', 'Groups of sentencs', 'Sentences GroupsAR', '', '', '', '', 1121, ''),
('select', '0', '1', 'Seleziona', 'Select', 'SelectAR', '', '', '', '', 1122, ''),
('will_you_use_audio', '0', '1', 'Vuoi usare audio?', 'Will you use audio?', 'سوف تستخدم الصوت؟', '', '', '', '', 1123, ''),
('user_avatar', '0', '1', 'Avatar dell\'Utente', 'User\'s avatar', 'User s avatarAR', '', '', '', '', 1124, ''),
('user_avatar_name', '0', '1', 'Nome dell\'avatar Utente', 'User\'s avatar’s name', 'User\'s avatar nameAR', '', '', '', '', 1125, ''),
('user_avatar_description', '0', '1', 'Descrizione dell\'avatar Utente', 'User\'s avatar’s description', 'User\'s avatar descriptionAR', '', '', '', '', 1126, ''),
('user_goal', '0', '1', 'Obiettivo dell\'utente', 'User\'s goal', 'User s goalAR', '', '', '', '', 1127, ''),
('bot_avatar', '0', '1', 'Avatar del Bot', 'Bot\'s Avatar', 'Bot s AvatarAR', '', '', '', '', 1128, ''),
('bot_avatar_name', '0', '1', 'Nome dell\'avatar Bot', 'Bot\'s avatar’s name', 'Bot s avatar nameAR', '', '', '', '', 1129, ''),
('bot_avatar_description', '0', '1', 'Descrizione dell\'avatar del Bot', 'Bot\'s avatar’s description', 'Bot s avatar descriptionAR', '', '', '', '', 1130, ''),
('bot_goal', '0', '1', 'Obiettivo del Bot', 'Bot\'s goal', 'Bot s goal', '', '', '', '', 1131, ''),
('my_matches', '1', '0', 'I miei match', 'My Matches', 'مبارياتي', '', '', '', '', 1132, ''),
('more_matches', '1', '0', 'Altri Match', 'More Matches', 'المزيد من المباريات', '', '', '', '', 1133, ''),
('more_drafts', '1', '0', 'Altre Bozze', 'More Drafts', 'المزيد من المسودات', '', '', '', '', 1135, ''),
('NO_RESULTS_MATCHES', '1', '0', 'Non hai ancora avuto nessun match... <br/>\r\nComincia subito: clicca su uno dei game qui sopra!', 'you have no matches yet...<br/> Start now: click on a Game above ', '', '', '', '', '', 1136, ''),
('the_first_three_answers_are_mandatory', '0', '1', 'Le prime tre risposte sono obbligatorie', 'The first three answers are mandatory', '', '', '', '', '', 1585, ''),
('NO_RESULTS_DRAFTS', '1', '0', 'La cartella bozze è vuota', 'The draft box is empty\n', '', '', '', '', '', 1137, ''),
('last_match', '1', '0', 'Ultimo Match', 'Last Match', 'المبارة الاخيرة', '', '', '', '', 1138, ''),
('N_months_ago', '1', '0', 'mesi fa', 'months ago', 'قبل أشهر', '', '', '', '', 1139, ''),
('N_days_ago', '1', '0', 'giorni fa', 'days ago', 'قبل أشهر', '', '', '', '', 1140, ''),
('N_hours_ago', '1', '0', 'ore fa', 'hours ago', 'قبل أشهر', '', '', '', '', 1141, ''),
('N_years_ago', '1', '0', 'anni fa', 'years ago', 'قبل أشهر', '', '', '', '', 1142, ''),
('N_weeks_ago', '1', '0', 'settimane fa', 'weeks ago', 'قبل أشهر', '', '', '', '', 1143, ''),
('N_minutes_ago', '1', '0', 'minuti fa', 'minutes ago', 'قبل أشهر', '', '', '', '', 1144, ''),
('N_seconds_ago', '1', '0', 'secondi fa', 'seconds ago', 'قبل أشهر', '', '', '', '', 1145, ''),
('show_report', '1', '0', 'Mostra Report', 'Show Report', 'عرض تقرير', '', '', '', '', 1146, ''),
('play_ESCLAMATIVE', '1', '0', 'Gioca!', 'Play now!', 'العب الان!', '', '', '', '', 1147, ''),
('edit', '1', '0', 'Modifica', 'Edit', 'تعديل', 'cambiar', '', 'modifier', 'mudar', 1148, ''),
('offline', '1', '0', 'Offline', 'Offline', 'غير متصل', 'Desconectado', '', '', '', 1150, ''),
('beginner', '1', '0', 'Beginner', 'Beginner', 'مبتدئ', '', '', '', '', 1152, ''),
('cover', '0', '1', 'Copertina', 'Cover', 'صورة الغلاف', '', '', '', '', 1153, ''),
('please_select_the_avatars', '0', '1', 'Per favore seleziona i due avatar', 'Please, select the two avatars', 'رجاءا، اختر الآلهة', '', '', '', '', 1154, ''),
('the_user_character', '0', '1', 'Il personaggio dello User', 'the User character', 'شخصية المستخدم', '', '', '', '', 1155, ''),
('the_bot_character', '0', '1', 'Il personaggio del Bot', 'The Bot character', 'الطابع بوت', '', '', '', '', 1156, ''),
('sorry_the_following_fields_marked_in_red_are_not_correct', '0', '1', 'Mi spiace ma i seguenti campi - evidenziati in rosso - non sembrano corretti', 'Sorry, the following fields - marked in red - are not correct', 'عذرا، الحقول التالية - باللون الأحمر - غير صحيحة', '', '', '', '', 1157, ''),
('click_on_a_cover_to_select', '0', '1', 'fai click su una copertina per selezionarla', 'Click on a cover to select it', 'انقر على غلاف لتحديده', '', '', '', '', 1158, ''),
('optional_information', '0', '1', 'Informazioni facoltative', 'Optional Information', 'Optional Information', '', '', '', '', 1159, ''),
('estimated_duration', '1', '1', 'Durata Stimata', 'Estimated Duration', 'Estimated Duration', '', '', '', '', 1160, ''),
('competence_target', '1', '1', 'Obiettivo competenza', 'Competence Target', 'Competence Target', '', '', '', '', 1161, ''),
('difficulty_level', '1', '1', 'Livello di Difficoltà', 'Difficulty Level', 'Difficulty Level', '', '', '', '', 1162, ''),
('sign_up_for_free', '1', '0', 'Iscriviti', 'Sign up', '', '', '', '', '', 1163, ''),
('new_password', '1', '1', 'Nuova Password', 'New Password', '', '', '', '', '', 1164, ''),
('SIGN_UP_DISCLAIMER', '1', '0', 'Cliccando su Iscriviti, accetti le nostre Condizioni e confermi di aver letto <a  target=\"_BLANK\" href=\"/informativa.pdf\">la nostra Normativa sui dati</a>, e sull\\\'uso dei cookie', 'By clicking Sign Up, you agree to our Terms and confirm that you have read <a href=\"/informativa .pdf\" target=\"_BLANK\">our Data Policy</a>, including our Cookie Use.', '', '', '', '', '', 1166, ''),
('EMAIL_ACCOUNT_CONFIRM_SUBJECT', '1', '0', 'Azione richiesta: conferma il tuo account PAL.MA.', 'Action required: confirm your PAL.MA. account', '', 'Acción requerida: Confirmar cuenta de PAL.MA.', '', 'Action demandée: confirmer votre compte PAL.MA.', 'Ação necessária: Confirme sua conta PAL.MA.', 1391, ''),
('EMAIL_ACCOUNT_CONFIRM_BODY', '1', '0', 'Ciao #!name!#,\n\nRecentemente ti sei iscritto/a a PAL.MA. \n\nPer completare l\'iscrizione, segui questo link:\n#!url!#\n\nGrazie,\nPal.Ma. Team\nhttps://palma.entropy4fad.it', 'Ciao #!name!#,   You\'ve recently signed up to AL.MA.   Follow this link to complete your registration: #!url!#  Thanks The Team of Pal.Ma.  https://palma.entropy4fad.it', '', 'Hola #!name!#,\n\nRecientemente se ha inscrito en PAL.MA.\n\nPara completar la inscripción, siga este enlace:\n\n#!url!#\n\nGracias,\nEl equipo de Pal.Ma. \nhttps://palma.entropy4fad.it', '', 'Salut #!name!#,\n\nRécemment vous vous êtes inscrit(e) à PAL.MA. \n\nPour compléter l\'inscrition, suivez ce lien:\n#!url!#\nMerci,\nLe team de Pal.Ma. \nhttps://palma.entropy4fad.it', 'Olá #!name!#,\n\nRecentemente, se inscreveu en PAL.MA.\n\nPara concluir a inscrição, siga este link:\n\n#!url!#\n\nObrigado,\nA equipe Pal.Ma. Team\nhttps://palma.entropy4fad.it', 1392, ''),
('EMAIL_ACCOUNT_CONFIRM_REMINDER_SUBJECT', '1', '0', 'Per #!name!# da Pal.Ma.', 'To #!name!# from PAL.MA.', '', 'Para #!name!# desde PAL.MA.', '', 'Pour #!name!# de PAL.MA.', 'Para #!name!# do PAL.MA.', 1398, ''),
('EMAIL_ACCOUNT_CONFIRM_REMINDER_BODY', '1', '0', 'Ciao #!name!#,\nScusa se ti disturbiamo ma abbiamo notato che nonostante ti sia iscritto non hai ancora confermato il tuo indirizzo email. \n\nPer farlo basta cliccare questo link:\n#!url!#\n\nPer qualunque altro problema non esitare.\n\nPal.Ma. Team\nhttps://palma.entropy4fad.it', 'Ciao #!name!#, sorry to disturb you, but we have noticed you have not validated your email address yet.  Just click this link to complete your registration: #!url!#  For any problems please don\'t hesitate to contact us.  Pal.Ma. Team https://palma.entropy4fad.it', '', 'Hola #!name!#,\nSoy Corinne de AL.MA.\nPerdona que te moleste,\npero hemos notado que todavía no se ha activado su cuenta\nPara completar la inscripción, siga este enlace:\n#!url!#\no puedo hacerlo manualmente Si responde a este mensaje.\n\nBuen día \nEl equipo de \nPal.Ma. Team\nhttps://palma.entropy4fad.it', '', 'Salut #!name!#,\nDésolé de vous déranger,\n\nrécemment vous vous êtes inscrit(e) à AL.MA. Pour compléter l\'inscrition, suivez ce lien:\n#!url!#\nMerci,\nLe team de Pal.Ma.\nhttps://palma.entropy4fad.it', 'Olá #!name!#,\nSou Corinne de AL.MA.\nnotamos que você não ativou sua conta ainda\n\nPara concluir a inscrição, siga este link:\n#!url!#\nou eu posso fazê-lo manualmente se você responder a este e-mail\n\nTenha um bom dia \nA equipe Pal.Ma.\nhttps://palma.entropy4fad.it', 1399, 'Altrimenti posso farlo io manualmente se rispondi a questa email.  or i can do this manually if you reply to this mail.'),
('your_email_has_already_been_verified', '1', '0', 'La tua email è stata già verificata', 'Your email has already been verified', '', '', '', '', '', 1419, ''),
('your_email_has_been_verified', '1', '0', 'La tua email è stata verificata', 'Your email has been verified', '', '', '', '', '', 1420, ''),
('email_confirmation', '1', '0', 'Conferma email', 'Email Confirmation', '', '', '', '', '', 1421, ''),
('thanks', '1', '0', 'Grazie', 'Thanks', '', '', '', '', '', 1422, ''),
('insert_your_email_and_password_to_login', '1', '1', 'Inserisci email e password per accedere', 'Insert your email and password to log in', '', '', '', '', '', 1423, ''),
('please_confirm_your_email_by_clicking_on_the_link_we_sent_you', '1', '0', 'Per favore, conferma la tua email facendo click sul link che ti abbiamo inviato', 'Please, confirm your email address by clicking on the link we sent you', '', '', '', '', '', 1424, ''),
('send_me_the_email_again', '1', '0', 'Inviami nuovamente l\'email', 'Send me the email again', '', '', '', '', '', 1426, ''),
('SIGN_UP_OK_MESSAGE', '1', '0', 'Bene #user,<br />\nabbiamo appena inviato una email a #email<br /><br />\nClicca sul link che trovi nel messaggio per confermare il tuo indirizzo email.<br /><br />\nSe non trovi il messaggio non dimenticare di cercare nello spam.', 'Bene #user,<br />\nWe have just sent an email to #email<br /><br />\nClick the confirmation link that you will find in the message to confirm your email address.<br /><br />\nIf you don’t find the message, don’t forget to check the spam folder', '', '', '', '', '', 1425, 'manca'),
('EMAIL_CONFIRMATION_CODE_ERROR', '1', '0', 'Ci Spiace ma il codice (#code) non sembra corretto.<br /><br />\nFai click nuovamente sul link contenuto nell\'email e controlla anche nello spam<br ><br >\nOppure entra con email e password e poi scegli \'#L_send_me_the_email_again\'', 'We are sorry, but the code (#code) is incorrect.<br /><br />\nClick the link again and check the spam folder<br ><br >\nor login with your email and password and then choose \'#L_send_me_the_email_again\'', '', '', '', '', '', 1427, 'manca'),
('usersX', '1', '1', 'Utenti', 'Users', '', '', '', '', '', 1429, ''),
('group_name', '1', '1', 'Nome del Gruppo', 'Group\'s Name', '', '', '', '', '', 1430, ''),
('groups', '1', '1', 'Gruppi', 'Groups', '', '', '', '', '', 1431, ''),
('nothing_yet', '1', '1', 'Ancora nulla', 'Nothing yet', '', '', '', '', '', 1432, ''),
('new_group', '0', '1', 'Nuovo Gruppo', 'New Group', '', '', '', '', '', 1433, ''),
('edit_group', '0', '1', 'Modifica Gruppo', 'Edit Group', '', '', '', '', '', 1434, ''),
('no_results', '1', '1', 'Nessun risultato', 'No results', '', 'Resultados mostrados', '', 'Résultats vus', 'Resultados exibidos', 1435, ''),
('the_groups_name_is_too_short', '0', '1', 'Il titolo è troppo breve', 'the Group\'s Name is too short', '', 'El título es demasiado corto', '', 'Le titre est trop bref', 'O título é demasiado curto', 1437, ''),
('delete_this_group', '0', '1', 'Cancella questo gruppo', 'Delete this group', '', '', '', '', '', 1438, ''),
('saved', '0', '1', 'Salvato', 'Saved', '', '', '', '', '', 1439, ''),
('user_edit', '0', '1', 'Modifica Utente', 'Edit User', '', '', '', '', '', 1442, ''),
('role', '1', '1', 'Ruolo', 'Role', '', '', '', '', '', 1443, ''),
('moderator', '1', '1', 'Moderatore', 'Moderator', '', '', '', '', '', 1444, ''),
('super_user', '1', '1', 'Super User', 'Super User', '', '', '', '', '', 1445, ''),
('add_groups', '0', '1', 'Aggiungi Gruppi', 'Add Groups', '', '', '', '', '', 1446, ''),
('activity', '1', '1', 'Attività', 'Activity', '', '', '', '', '', 1447, ''),
('duration', '1', '1', 'Durata', 'Duration', 'Duration(ar)', '', '', '', '', 1448, ''),
('date_time', '1', '1', 'Data/Ora', 'Date/Time', 'Date/Time', '', '', '', '', 1449, ''),
('add_insighters', '0', '1', 'Aggiungi Insighters', 'Add Insighters', '', '', '', '', '', 1450, ''),
('insighters', '0', '1', 'Insighters', 'Insighters', '', '', '', '', '', 1451, ''),
('insights', '1', '1', 'Insights', 'Insights', '', '', '', '', '', 1452, ''),
('actually_you_have_no_permission_to_access_this_area', '1', '1', 'Al momento non hai alcun permesso per accedere a quest\'area', 'At the moment you have no permission to access this area', '', '', '', '', '', 1453, ''),
('this_week', '1', '0', 'Questa settimana', 'This week', '', '', '', '', '', 1454, ''),
('last_week', '1', '0', 'La scorsa settimana', 'Last week', '', '', '', '', '', 1455, ''),
('NUMBER_weeks_ago', '1', '0', 'settimane fa', 'weeks ago', '', '', '', '', '', 1456, ''),
('NUMBER_months_ago', '1', '0', 'mesi fa', 'months ago', '', '', '', '', '', 1457, ''),
('NUMBER_days_ago', '1', '0', 'giorni fa', 'days ago', '', '', '', '', '', 1458, ''),
('this_month', '1', '0', 'Questo mese', 'This month', '', '', '', '', '', 1459, ''),
('last_month', '1', '0', 'Il mese scorso', 'last month', '', '', '', '', '', 1460, ''),
('custom_period', '1', '0', 'Periodo personalizzato', 'Customized period', '', '', '', '', '', 1462, ''),
('generate', '1', '0', 'Genera', 'Generate', '', '', '', '', '', 1463, ''),
('all', '1', '0', 'Tutti', 'All', '', 'Todos', '', 'Tous', 'Todos', 1464, ''),
('none', '1', '0', 'Nessuno', 'None', '', '', '', '', '', 1465, ''),
('matches', '1', '0', 'Matches', 'Matches', '', '', '', '', '', 1466, ''),
('unique_players', '1', '0', 'Giocatori unici', 'Unique players', '', '', '', '', '', 1467, ''),
('players', '1', '0', 'Players', 'Players', '', '', '', '', '', 1468, ''),
('player', '1', '0', 'Player', 'Player', '', '', '', '', '', 1469, ''),
('durations_are_expressed_in_minutes', '1', '0', 'Le durate sono espresse in Minuti', 'Duration is expressed in minutes', '', '', '', '', '', 1470, ''),
('details', '1', '0', 'Dettagli', 'Details', '', '', '', '', '', 1472, ''),
('status', '1', '0', 'Status', 'Status', '', '', '', '', '', 1473, ''),
('history', '1', '0', 'History', 'History', '', '', '', '', '', 1475, ''),
('change_status', '1', '0', 'Cambio stato', 'Status Change', '', '', '', '', '', 1476, ''),
('options', '1', '0', 'Opzioni', 'Options', '', '', '', '', '', 1477, ''),
('anonymous', '1', '0', 'Anonimo', 'Anonymous', '', '', '', '', '', 1478, ''),
('TIME_ago_post', '1', '1', 'fa', 'ago', '', '', '', '', '', 1479, ''),
('TIME_ago_pre', '0', '0', '', '', '', '', '', '', '', 1480, ''),
('TIME_at', '0', '0', 'alle', 'at', '', '', '', '', '', 1481, ''),
('days', '1', '0', 'giorni', 'days', '', '', '', '', '', 1482, ''),
('hours', '1', '0', 'ore', 'hours', '', '', '', '', '', 1483, ''),
('seconds', '1', '0', 'secondi', 'seconds', '', '', '', '', '', 1484, ''),
('years', '1', '0', 'anni', 'years', '', '', '', '', '', 1485, ''),
('months', '1', '0', 'mesi', 'months', '', '', '', '', '', 1486, ''),
('language', '1', '0', 'Lingua', 'Language', 'لغة', 'Idioma', 'Language', '', '', 21, ''),
('a_months_ago', '1', '0', 'un mese fa', 'a month ago', '', '', '', '', '', 1488, ''),
('minutes', '1', '0', 'minuti', 'minutes', '', '', '', '', '', 1489, ''),
('yesterday', '1', '0', 'ieri', 'yesterday', '', '', '', '', '', 1490, ''),
('the_games', '1', '0', 'i Games', 'The Games', '', '', '', '', '', 1491, ''),
('the_game', '1', '0', 'il Game', 'the Game', '', '', '', '', '', 1492, ''),
('create_a_new_game', '1', '1', 'Crea un nuovo Game', 'Create a new Game', '', '', '', '', '', 1493, ''),
('add_game_goal', '0', '1', 'Aggiungi scopo al game', 'Add Game Goal', '', '', '', '', '', 1494, ''),
('game_debriefing', '1', '1', 'Debriefing Game', 'Game Debriefing', '', '', '', '', '', 1495, ''),
('save_the_game_as_playable', '0', '1', 'Salva il Game come PLAYABLE', 'Save the Game as PLAYABLE', '', '', '', '', '', 1496, ''),
('ALERT_GAME_SAVED_AS_PLAYABLE', '1', '1', 'Il Game è stato salvato come PLAYABLE ed è ora disponibile per il gioco se inserito in uno o più gruppi', 'The Game has been saved as PLAYABLE and it\'s now available to play if added to groups', '', '', '', '', '', 1497, ''),
('ALERT_GAME_COPIED', '1', '1', 'E\' stata creata una copia del Game disponibile nelle Bozze', 'The copy of the Game is now available in Drafts', '', '', '', '', '', 1498, ''),
('game_goal', '0', '1', 'Scopo del Game', 'Game goal', '', '', '', '', '', 1510, ''),
('more_games', '1', '0', 'Altri Games', 'More Games', '', '', '', '', '', 1511, ''),
('ALERT_GAME_SETTED_OFF', '1', '0', 'Il Game è ora \'offline\' quindi non disponibile per il gioco', 'The Game is now offline; therefore, it is so not visible nor playable', '', '', '', '', '', 1512, ''),
('more_offline_games', '1', '0', 'Altri game offline', 'More offline games', '', '', '', '', '', 1513, ''),
('never_been_in_a_game', '1', '0', 'Mai stato in un serious Game?', 'Never been in a serious Game?', '', '', '', '', '', 1514, '');
INSERT INTO `plang` (`name`, `usr`, `edt`, `it`, `en`, `ar`, `es`, `de`, `fr`, `pt`, `id`, `note`) VALUES
('games', '1', '1', 'Games', 'Games', '', '', '', '', '', 1515, ''),
('add_games_and_users', '0', '1', 'Aggiungi Game e Utenti', 'Add Games and Users', '', '', '', '', '', 1516, ''),
('game', '1', '1', 'Game', 'Game', '', '', '', '', '', 1517, ''),
('games_without_group', '1', '0', 'Games senza gruppo', 'Games without group', '', '', '', '', '', 1518, ''),
('valid_until', '1', '1', 'Valido fino al', 'Valid until', '', '', '', '', '', 1519, ''),
('masculine_avatar', '0', '1', 'Avatar Maschile', 'Masculine Avatar', '', '', '', '', '', 1520, ''),
('feminine_avatar', '0', '1', 'Avatar femminile', 'Feminine avatar', '', '', '', '', '', 1521, ''),
('forever', '0', '1', 'per sempre', 'forever', '', '', '', '', '', 1522, ''),
('editing', '0', '1', 'Editing', 'Editing', '', '', '', '', '', 1523, ''),
('avatar', '1', '1', 'Avatar', 'Avatar', '', 'Avatar', '', '', '', 1524, ''),
('avatar_position', '0', '1', 'Posizione Avatar', 'Avatar\'s Position', '', '', '', '', '', 1525, ''),
('camera_on_protagonist_only', '0', '1', 'Inquadratura solo sul protagonista', 'Camera on protagonist only', '', '', '', '', '', 1526, ''),
('answer', '1', '1', 'Risposta', 'Answer', '', '', '', '', '', 1527, ''),
('score', '1', '1', 'Punteggio', 'Score', '', '', '', '', '', 1528, ''),
('avatar_sentence', '0', '1', 'Battuta dell\'Avatar', 'Avatar\'s sentence', '', '', '', '', '', 1529, ''),
('select_scenario', '0', '1', 'Seleziona Scenario', 'Select Scenario', '', '', '', '', '', 1530, ''),
('select_avatar', '0', '1', 'Seleziona Avatar', 'Select Avatar', '', '', '', '', '', 1531, ''),
('avatar_size', '0', '1', 'Taglia Avatar', 'Avatar\'s Size', '', '', '', '', '', 1532, ''),
('drag_to_reposition', '0', '1', 'Trascina per riposizionare', 'Drag to reposition', '', '', '', '', '', 1533, ''),
('upload', '0', '1', 'Carica', 'Upload', '', '', '', '', '', 1534, ''),
('feminine', '0', '1', 'Femminile', 'Feminine', '', '', '', '', '', 1535, ''),
('masculine', '0', '1', 'Maschile', 'Masculine', '', '', '', '', '', 1536, ''),
('steps', '1', '1', 'Step', 'Step', '', '', '', '', '', 1537, ''),
('saving', '1', '1', 'Sto salvando', 'Saving', '', '', '', '', '', 1538, ''),
('add_an_answer', '0', '1', 'Aggiungi una risposta', 'Add an answer', '', '', '', '', '', 1539, ''),
('players_answers', '0', '1', 'Risposte del giocatore', 'Player\'s Answers', '', '', '', '', '', 1540, ''),
('attachments', '1', '1', 'Allegati', 'Attachments', '', '', '', '', '', 1541, ''),
('file', '1', '1', 'File', 'File', '', '', '', '', '', 1542, ''),
('youtube_video', '1', '1', 'Video Youtube', 'Youtube Video', '', '', '', '', '', 1543, ''),
('link', '1', '1', 'Link', 'Link', '', '', '', '', '', 1544, ''),
('load', '1', '1', 'Carica', 'Load', '', '', '', '', '', 1545, ''),
('add_url', '1', '1', 'Aggiungi URL', 'Add URL', '', '', '', '', '', 1546, ''),
('this_type_of_file_is_not_acceptable', '0', '1', 'Questo tipo di file non è accettato', 'this type of file is not_supported', '', '', '', '', '', 1547, ''),
('the_url_does_not_seem_to_be_correct', '1', '1', 'L\'url non sembra essere corretta', 'The url does not seem to be correct', '', '', '', '', '', 1548, ''),
('COMPULSORY_ATTACHMENTS_YES', '0', '1', 'Il player DEVE cliccare su ognuno degli allegati per poter proseguire e scegliere una risposta', 'The player MUST click on each attachment to go on playing and pick an answer', '', '', '', '', '', 1549, ''),
('change', '0', '1', 'Cambia', 'Change', '', '', '', '', '', 1550, ''),
('COMPULSORY_ATTACHMENTS_NO', '0', '1', 'Il player può continuare il gioco anche se non ha cliccato su alcun allegato', 'The player can go on playing even if he didn\'t click on attachment links', '', '', '', '', '', 1551, ''),
('avatar_sentence_audio', '0', '1', 'Audio della frase dell\'avatar', 'audio of the Avatar\'s sentence', '', '', '', '', '', 1554, ''),
('you_cannot_use_question_4_without_using_question_3', '0', '1', 'La domanda 4 non può essere usata se prima non si utilizza la domanda 3', 'You cannot use question 4 without first using question 3', '', '', '', '', '', 1556, ''),
('questions_score', '0', '1', 'punteggio della domanda', 'question\'s score', '', '', '', '', '', 1557, ''),
('answers_have_the_same_score', '0', '1', 'Le risposte hanno tutte lo stesso punteggio', 'All answers have the same score', '', '', '', '', '', 1558, ''),
('endings', '0', '1', 'Finali', 'Endings', '', '', '', '', '', 1559, ''),
('winning_end', '0', '1', 'Finale vincente', 'Winning end', '', '', '', '', '', 1560, ''),
('loosing_end', '0', '1', 'Finale perdente', 'Losing end', '', '', '', '', '', 1561, ''),
('loosing_area', '0', '1', 'Area perdente', 'Losing area', '', '', '', '', '', 1562, ''),
('winning_area', '0', '1', 'Area vincente', 'Winning area', '', '', '', '', '', 1563, ''),
('not_available_yet', '1', '1', 'Non ancora disponibile', 'Not available yet', '', '', '', '', 'Indisponível', 1564, ''),
('final_sentence', '1', '1', 'Frase finale', 'Final sentence', '', '', '', '', '', 1565, ''),
('final_sentence_audio', '1', '1', 'Audio della frase finale', 'Audio of the final sentence', '', '', '', '', '', 1566, ''),
('comment', '1', '1', 'Commento', 'Comment', '', '', '', '', '', 1567, ''),
('qualitative_comments', '1', '1', 'Commenti qualitativi', 'Qualitative comments', '', '', '', '', '', 1568, ''),
('no_avatar', '0', '1', 'Nessun avatar', 'No avatar', '', '', '', '', '', 1569, ''),
('sentence', '0', '1', 'Frase', 'Sentence', '', '', '', '', '', 1570, ''),
('DIALOGUES_BOX_LOG_INTRO', '1', '0', 'Qui troverai tutti gli scambi effettuati durante il dialogo tra te e gli avatar', 'Here you will find all the dialogue exchanges between you and the avatars', '', '', '', '', '', 1571, ''),
('thinking_over', '1', '0', 'Rifletto', 'Thinking over', '', '', '', '', '', 1572, ''),
('please_take_a_look_at_the_following_attachments_before_answering', '1', '0', 'Si consiglia di visionare gli allegati prima di rispondere', 'Please, take a look at the attachments before answering', '', '', '', '', '', 1573, ''),
('you_cant_answer_before_reading_the_following_attachments', '1', '0', 'Visiona gli allegati per continuare il gioco', 'Read the attachments to continue the game', '', '', '', '', '', 1574, ''),
('show', '1', '1', 'Mostra', 'Show', '', '', '', '', '', 1575, ''),
('L1_SHORT_COMMENT', '1', '1', 'Purtroppo è andata decisiamente male', 'Unfortunately, you did fail', '', '', '', '', '', 1576, ''),
('L2_SHORT_COMMENT', '1', '1', 'E\' andata male, ma c\'e\' di peggio', 'You failed! But it is not that bad', '', '', '', '', '', 1577, ''),
('L3_SHORT_COMMENT', '1', '1', 'E\' andata maluccio', 'It didn’t go well!', '', '', '', '', '', 1578, ''),
('L4_SHORT_COMMENT', '1', '1', 'Non hai vinto, ma c\'eri quasi', 'You were almost there', '', '', '', '', '', 1579, ''),
('W1_SHORT_COMMENT', '1', '1', 'Hai vinto. Per un pelo ma hai vinto', 'You barely made it', '', '', '', '', '', 1580, ''),
('W2_SHORT_COMMENT', '1', '1', 'Hai vinto, un buon risultato ma puoi dare di più', 'Hey you got a good score, but you can improve!', '', '', '', '', '', 1581, ''),
('W3_SHORT_COMMENT', '1', '1', 'Benissimo, manca poco all\'eccellenza', 'Very well, almost excellent. Try again', '', '', '', '', '', 1582, ''),
('W4_SHORT_COMMENT', '1', '1', 'Un risultato eccellente, complimenti', 'Great, you totally rocked!', '', '', '', '', '', 1583, ''),
('the_scale_of_values_varies_from_0_to_100_percent', '1', '0', 'La scala di valori varia da 0% a +100', 'Scores range from 0 to 100%', '', '', '', '', '', 1584, ''),
('at_least_one_score_must_be_zero', '0', '1', 'Almeno un punteggio deve essere pari a zero', 'At least one score must be zero', '', '', '', '', '', 1586, ''),
('structure', '0', '1', 'Struttura', 'Structure', '', '', '', '', '', 1587, ''),
('sequential', '0', '1', 'Sequenziale', 'Sequential', '', '', '', '', '', 1588, ''),
('parallel', '0', '1', 'Parallela', 'Parallel', '', '', '', '', '', 1589, ''),
('forkFrom', '0', '1', 'Biforca da', 'Fork off from', '', '', '', '', '', 1590, ''),
('story_structure', '0', '1', 'struttura della storia', 'Story structure', '', '', '', '', '', 1591, ''),
('goto', '0', '1', 'vai a', 'Go to', '', '', '', '', '', 1592, ''),
('administrator', '1', '1', 'Administrator', 'Administrator', '', '', '', '', '', 1593, ''),
('create_the_first_group', '1', '0', 'Crea il primo gruppo', 'Create the first group', '', '', '', '', '', 1594, ''),
('admin', '1', '0', 'Admin', 'Admin', '', '', '', '', '', 1595, ''),
('STATUS_LEGENDA_HTML', '1', '0', '&bull; <span>Draft:</span> Il game è visibile solo agli editor, non è quindi online per gli utenti<br />&bull; <span>Playable:</span> Il game è disponibile online ai giocatori in funzione dei gruppi<br />&bull; <span>Offline:</span> Il game non è, o non è più, disponibile agli utenti<br />&bull; <span>Deleted:</span> Il game è off line e inoltre, non è visibile negli insights', '&bull; <span>Draft:</span> Users can not play the Game, it\'s a draft<br />&bull; <span>Playable:</span> Users, as per groups, can play the Game<br />&bull; <span>Offline:</span> the Gameis not (or not anymomore) available to users<br />&bull; <span>Deleted:</span> the Game is off line and it\'s not visible in the insights section', '', '', '', '', '', 1596, '');

-- --------------------------------------------------------

--
-- Struttura della tabella `scenarios`
--

CREATE TABLE `scenarios` (
  `id` int(11) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `invisble` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `scenarios`
--

INSERT INTO `scenarios` (`id`, `name`, `invisble`) VALUES
(1, 'Office 1', 0),
(2, 'Meeting room 1', 0),
(3, 'Waiting room 1', 0),
(4, 'Office 2', 0),
(5, 'Office in Rome', 0),
(6, 'the Desert!', 0),
(7, 'The cockpit I', 0),
(8, 'Romance I', 0),
(9, 'Green I', 0),
(10, 'E Corridor', 0),
(11, 'E Kitchen', 0),
(12, 'E Presentation', 0),
(13, 'E PC', 0),
(14, 'E Apartament I', 0),
(15, 'E Apartament II', 0),
(17, 'Apartment III', 0),
(18, 'Boxes', 0),
(19, 'Cafeteria', 0),
(20, 'Library Room', 0),
(21, 'meeting room 2', 0),
(22, 'Meeting Room 3', 0),
(23, 'Office 3', 0),
(24, 'PC II', 0),
(16, 'Eyes in the dark', 0),
(25, 'Newsagent', 0),
(26, 'Realtor 1', 0),
(27, 'House AR 1', 0),
(28, 'Opnhouse', 0),
(29, 'Realtor 2', 0),
(30, 'House AR 2', 0),
(31, 'Handshake', 0),
(32, 'Search house 1', 0),
(33, 'Search house 2', 0),
(34, 'Businessman 1', 0),
(35, 'Realtor 3', 0),
(36, 'Laptop', 0),
(37, 'Alone', 0),
(38, 'Drawing', 0),
(39, 'Businessman 2', 0),
(40, 'Plan', 0),
(41, 'Typing', 0),
(42, 'Pet 1', 0),
(43, 'Pet 2', 0),
(44, 'Architect', 0),
(45, 'Friends', 0),
(46, 'Jazz', 0),
(47, 'Woman 1', 0),
(48, 'Man 1', 0),
(49, 'Man 2', 0),
(50, 'Director', 0),
(51, 'Woman 2', 0),
(52, 'Old man and dog', 0),
(53, 'Angry man', 0),
(54, 'Police', 0),
(55, 'Jazz orchestra', 0),
(56, 'Man 3', 0),
(57, 'Music', 0),
(58, 'Thinking woman bw', 0),
(59, 'Classrom 1', 0),
(60, 'Watching 1', 0),
(61, 'Business meeting 1', 0),
(62, 'Business meeting 2', 0),
(63, 'Business meeting 3', 0),
(64, 'Camera Eddie', 0),
(65, 'Camera Theodore', 0),
(66, 'Cucina I', 0),
(67, 'Sala I', 0),
(68, 'Salotto I', 0),
(69, 'Studio I', 0),
(70, 'Studio II', 0),
(71, 'Studio III', 0),
(72, 'Il nuovo lavoro', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `users_id` int(255) NOT NULL,
  `muser_id` int(11) DEFAULT NULL,
  `user_level` int(1) NOT NULL DEFAULT '0' COMMENT '0 L_user, 1 L_editor, 2 L_administrator, 3 L_super_user',
  `family` varchar(16) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_pass` varchar(255) DEFAULT NULL,
  `user_real_name` varchar(255) NOT NULL,
  `user_real_surname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `role0` varchar(64) DEFAULT NULL,
  `role1` varchar(64) DEFAULT NULL,
  `role2` varchar(64) DEFAULT NULL,
  `role3` varchar(64) DEFAULT NULL,
  `user_phone` varchar(255) DEFAULT NULL,
  `sex` enum('na','male','female') NOT NULL DEFAULT 'na',
  `birthdate` date NOT NULL,
  `notActiveSince` int(22) NOT NULL DEFAULT '0',
  `created` bigint(20) NOT NULL,
  `updated` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`users_id`, `muser_id`, `user_level`, `family`, `user_name`, `user_pass`, `user_real_name`, `user_real_surname`, `user_email`, `role0`, `role1`, `role2`, `role3`, `user_phone`, `sex`, `birthdate`, `notActiveSince`, `created`, `updated`) VALUES
(1, NULL, 0, 'entropy', 'general1', 'general1', 'general', '', 'xxx@xxx', '', NULL, NULL, NULL, NULL, 'na', '0000-00-00', 0, 1615907358, 1615907358);

-- --------------------------------------------------------

--
-- Struttura della tabella `usersgroups`
--

CREATE TABLE `usersgroups` (
  `idgroup` int(11) NOT NULL,
  `family` varchar(16) DEFAULT NULL,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `orderg` smallint(3) NOT NULL,
  `description_it` text NOT NULL,
  `description_en` text NOT NULL,
  `createts` int(11) NOT NULL,
  `editedts` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `usersgroups_insighters`
--

CREATE TABLE `usersgroups_insighters` (
  `uid` int(11) NOT NULL,
  `idgroup` int(11) NOT NULL,
  `addedTs` int(11) NOT NULL,
  `idr` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `user_tracking`
--

CREATE TABLE `user_tracking` (
  `ida` int(11) NOT NULL,
  `idu` int(11) NOT NULL,
  `action` char(33) NOT NULL,
  `actionSecondary` varchar(33) NOT NULL,
  `idu2` int(11) NOT NULL DEFAULT '0',
  `gameId` int(11) NOT NULL DEFAULT '0',
  `step` int(255) NOT NULL DEFAULT '0',
  `data` varchar(255) NOT NULL,
  `timestamp` int(11) NOT NULL DEFAULT '0',
  `privacyLevel` int(3) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `device_type` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `user_usersgroups`
--

CREATE TABLE `user_usersgroups` (
  `uid` int(11) NOT NULL,
  `idgroup` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `avatars`
--
ALTER TABLE `avatars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `sex` (`sex`),
  ADD KEY `invisble` (`invisble`);

--
-- Indici per le tabelle `covers`
--
ALTER TABLE `covers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `invisble` (`invisble`);

--
-- Indici per le tabelle `email_validation`
--
ALTER TABLE `email_validation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `editedts` (`editedts`),
  ADD KEY `email` (`email`),
  ADD KEY `code` (`code`),
  ADD KEY `validatets` (`validatets`);

--
-- Indici per le tabelle `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`family`),
  ADD UNIQUE KEY `secret` (`secret`);

--
-- Indici per le tabelle `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`gameId`),
  ADD KEY `usr_female_avatar_id` (`usr_female_avatar_id`),
  ADD KEY `usr_male_avatar_id` (`usr_male_avatar_id`),
  ADD KEY `title` (`title`),
  ADD KEY `language` (`language`);

--
-- Indici per le tabelle `games_spread`
--
ALTER TABLE `games_spread`
  ADD PRIMARY KEY (`idSpread`),
  ADD UNIQUE KEY `gameSpread` (`gameId`,`spread`),
  ADD KEY `gameId` (`gameId`);

--
-- Indici per le tabelle `games_steps`
--
ALTER TABLE `games_steps`
  ADD PRIMARY KEY (`idStep`),
  ADD UNIQUE KEY `gameStepScene` (`gameId`,`step`,`scene`) USING BTREE,
  ADD KEY `gameId` (`gameId`),
  ADD KEY `state` (`step`),
  ADD KEY `scenario_id` (`scenario_id`),
  ADD KEY `avatar_id` (`avatar_id`),
  ADD KEY `avatar_pos_id` (`avatar_size`);

--
-- Indici per le tabelle `games_steps_attachments`
--
ALTER TABLE `games_steps_attachments`
  ADD PRIMARY KEY (`idAttachment`),
  ADD KEY `gameId` (`gameId`),
  ADD KEY `state` (`step`),
  ADD KEY `gameIdStep` (`gameId`,`step`),
  ADD KEY `scene` (`scene`);

--
-- Indici per le tabelle `game_family`
--
ALTER TABLE `game_family`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gameId` (`gameId`),
  ADD KEY `family` (`family`);

--
-- Indici per le tabelle `game_usersgroups`
--
ALTER TABLE `game_usersgroups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idgroup` (`idgroup`),
  ADD KEY ` idgym` (`gameId`);

--
-- Indici per le tabelle `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`idm`),
  ADD KEY `gameId` (`gameId`),
  ADD KEY `uid` (`uid`),
  ADD KEY `start` (`start`);

--
-- Indici per le tabelle `matches_step`
--
ALTER TABLE `matches_step`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idm` (`idm`),
  ADD KEY `step` (`step`),
  ADD KEY `scene` (`scene`);

--
-- Indici per le tabelle `plang`
--
ALTER TABLE `plang`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `name` (`name`) USING BTREE,
  ADD KEY `vis` (`usr`),
  ADD KEY `edt` (`edt`);

--
-- Indici per le tabelle `scenarios`
--
ALTER TABLE `scenarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `invisble` (`invisble`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD UNIQUE KEY `emailFamily` (`user_email`,`family`),
  ADD KEY `user_name` (`user_name`),
  ADD KEY `user_pass` (`user_pass`),
  ADD KEY `family` (`family`);

--
-- Indici per le tabelle `usersgroups`
--
ALTER TABLE `usersgroups`
  ADD PRIMARY KEY (`idgroup`),
  ADD KEY `createts` (`createts`),
  ADD KEY `editedts` (`editedts`),
  ADD KEY `name` (`name`);

--
-- Indici per le tabelle `usersgroups_insighters`
--
ALTER TABLE `usersgroups_insighters`
  ADD PRIMARY KEY (`idr`),
  ADD KEY `idgroup` (`idgroup`),
  ADD KEY `uid` (`uid`);

--
-- Indici per le tabelle `user_tracking`
--
ALTER TABLE `user_tracking`
  ADD PRIMARY KEY (`ida`),
  ADD KEY `idu` (`idu`),
  ADD KEY `action` (`action`),
  ADD KEY `actionSecondary` (`actionSecondary`),
  ADD KEY `timestamp` (`timestamp`),
  ADD KEY `gameId` (`gameId`);

--
-- Indici per le tabelle `user_usersgroups`
--
ALTER TABLE `user_usersgroups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idgroup` (`idgroup`),
  ADD KEY `uid` (`uid`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `avatars`
--
ALTER TABLE `avatars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- AUTO_INCREMENT per la tabella `covers`
--
ALTER TABLE `covers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `email_validation`
--
ALTER TABLE `email_validation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `games`
--
ALTER TABLE `games`
  MODIFY `gameId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT per la tabella `games_spread`
--
ALTER TABLE `games_spread`
  MODIFY `idSpread` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6298;

--
-- AUTO_INCREMENT per la tabella `games_steps`
--
ALTER TABLE `games_steps`
  MODIFY `idStep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=540;

--
-- AUTO_INCREMENT per la tabella `games_steps_attachments`
--
ALTER TABLE `games_steps_attachments`
  MODIFY `idAttachment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT per la tabella `game_family`
--
ALTER TABLE `game_family`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `game_usersgroups`
--
ALTER TABLE `game_usersgroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `matches`
--
ALTER TABLE `matches`
  MODIFY `idm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `matches_step`
--
ALTER TABLE `matches_step`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT per la tabella `plang`
--
ALTER TABLE `plang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1597;

--
-- AUTO_INCREMENT per la tabella `scenarios`
--
ALTER TABLE `scenarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `usersgroups`
--
ALTER TABLE `usersgroups`
  MODIFY `idgroup` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `usersgroups_insighters`
--
ALTER TABLE `usersgroups_insighters`
  MODIFY `idr` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `user_tracking`
--
ALTER TABLE `user_tracking`
  MODIFY `ida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `user_usersgroups`
--
ALTER TABLE `user_usersgroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
