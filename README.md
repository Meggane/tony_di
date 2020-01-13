This site allows you to follow the news of Tony DI, an intermittent show.

LOCAL SITE INSTALLATION : 
Install PHP 7, MYSQL 5, Composer and Symfony 4.3.
The differents bundles used :
-	Logger
-	Twig
-	Maker Bundle
-	Annotations
-	Asset (use of yarn to modify the css and js files of the site)
-	Profiler Pack
-	Apache Pack
-	Webpack Encore Bundle
-	ORM Pack
-	Swift Mailer
-	Translation
-	Web Server Bundle
-	Security Bundle
-	Ckeditor Bundle

To run the web site in local, use a web development platform and create the database with these tables :
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `comments` (`id`, `name`, `content`, `show_name`) VALUES
(4, 'soleil 078', '<p><strong>Moment de qualit&eacute; partag&eacute; avec ce com&eacute;dien</strong></p>\r\n\r\n<p><span style=\"background-color:#ffffff; color:#000000; font-family:&quot;open sans&quot;,&quot;Trebuchet MS&quot;,&quot;Gill Sans&quot;,Tahoma,Arial,sans-serif; font-size:12px\">Bravo &agrave; Tony Di pour ce one man show de qualit&eacute; o&ugrave; mon ado et moi-m&ecirc;me avons appr&eacute;ci&eacute; dans sa globalit&eacute;. Prescription en humour / bienveillance in&eacute;vitable. Le chateau de mon p&egrave;re et la gloire de ma m&egrave;re, on en redemande. Bravo et heureuse carri&egrave;re qui se d&eacute;roule.</span></p>', 'Comme à la maison (Fatto in casa)'),
(5, 'Sofinette5', '<p><strong>Super spectacle</strong></p>\r\n\r\n<p><span style=\"background-color:#ffffff; color:#000000; font-family:&quot;open sans&quot;,&quot;Trebuchet MS&quot;,&quot;Gill Sans&quot;,Tahoma,Arial,sans-serif; font-size:12px\">On se retrouve tous dans ce spectacle, italien ou non. Beaucoup d&#39;humour , des chansons avec la participation du public et de la subtilit&eacute;. Bravo!!! On attend avec impatience la suite.</span></p>', 'Comme à la maison (Fatto in casa)'),
(6, 'lilian2', '<p><strong>Excellent</strong></p>\r\n\r\n<p><span style=\"background-color:#ffffff; color:#000000; font-family:&quot;open sans&quot;,&quot;Trebuchet MS&quot;,&quot;Gill Sans&quot;,Tahoma,Arial,sans-serif; font-size:12px\">Nous avons pass&eacute; un excellent moment de rire et de partage. Spectacle empreint d&#39;&eacute;motion et d&#39;authenticit&eacute;. Un seul mot pour r&eacute;sum&eacute; : bravo et merci !!!</span></p>', 'Comme à la maison (Fatto in casa)');



DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `images` (`id`, `image`, `url_image`, `show_name`) VALUES
(7, 'D:\\Wamp\\tmp\\phpA4DC.tmp', 'images/upload/img2.jpg', 'Comme à la maison (Fatto in casa)'),
(8, 'D:\\Wamp\\tmp\\php50D8.tmp', 'images/upload/img_spectacle1.PNG', 'Comme à la maison (Fatto in casa)'),
(9, 'D:\\Wamp\\tmp\\php7D43.tmp', 'images/upload/img_spectacle2.jpg', 'Comme à la maison (Fatto in casa)'),
(10, 'D:\\Wamp\\tmp\\phpA60A.tmp', 'images/upload/img_spectacle3.jpg', 'Comme à la maison (Fatto in casa)'),
(11, 'D:\\Wamp\\tmp\\phpD374.tmp', 'images/upload/img_spectacle5.jpg', 'Comme à la maison (Fatto in casa)');



DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20191112150233', '2019-11-12 15:02:48'),
('20191120081514', '2019-11-20 08:15:34'),
('20191128101343', '2019-11-28 10:14:00'),
('20191202092529', '2019-12-02 09:25:57'),
('20191203101131', '2019-12-03 10:11:53'),
('20191204075607', '2019-12-04 07:56:27'),
('20191206083342', '2019-12-06 08:34:03'),
('20191206123449', '2019-12-06 12:35:04'),
('20191206161006', '2019-12-06 16:15:58'),
('20191220162142', '2019-12-20 16:22:04');



DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_7E8585C8E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




DROP TABLE IF EXISTS `post_dates`;
CREATE TABLE IF NOT EXISTS `post_dates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` datetime NOT NULL,
  `spectacle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `post_dates` (`id`, `start_date`, `spectacle`, `lieu`, `category`, `end_date`) VALUES
(13, '2019-02-21 20:30:00', 'Comme à la maison', 'Le Carioca Meximieux (01)', 'Seul en scène', '2019-02-21 20:30:00'),
(14, '2019-03-06 20:30:00', 'Comme à la maison', 'Groupama Privé', 'Seul en scène', '2019-03-06 20:30:00'),
(15, '2019-03-07 20:30:00', 'Comme à la maison', 'St Marcel (71)', 'Seul en scène', '2019-03-07 20:30:00'),
(16, '2019-03-13 20:30:00', 'Comme à la maison', 'La Ricane St Etienne (42)', 'Seul en scène', '2019-03-14 20:30:00'),
(17, '2019-03-19 20:30:00', 'Comme à la maison', 'Groupama Privé', 'Seul en scène', '2019-03-19 20:30:00'),
(18, '2019-03-21 20:30:00', 'Comme à la maison', 'Quimper (29)', 'Seul en scène', '2019-03-21 20:30:00'),
(19, '2019-04-09 20:30:00', 'Comme à la maison', 'L\'Ane Rouge à Lyon (69)', 'Seul en scène', '2019-04-30 20:30:00'),
(20, '2019-04-17 15:30:00', 'Comme à la maison', 'Groupama Privé', 'Seul en scène', '2019-04-17 15:30:00'),
(21, '2019-04-23 15:30:00', 'Comme à la maison', 'Groupama Privé', 'Seul en scène', '2019-04-24 15:30:00'),
(22, '2019-05-29 20:30:00', 'Comme à la maison', 'L\'Imprimerie à Rive De Gier (42)', 'Seul en scène', '2019-05-29 20:30:00');



DROP TABLE IF EXISTS `post_one_man_show`;
CREATE TABLE IF NOT EXISTS `post_one_man_show` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_teaser` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_EF71767E2B36786B` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `post_one_man_show` (`id`, `title`, `image`, `url_image`, `content`, `link_teaser`) VALUES
(1, 'Comme à la maison (Fatto in casa)', 'D:\\Wamp\\tmp\\phpA0C5.tmp', 'images/upload/affiche.jpg', '<p style=\"text-align:center\"><strong>Une ode au multiculturalisme</strong></p>\r\n\r\n<p style=\"text-align:center\">Les souvenirs d&#39;enfance d&#39;un fils d&#39;Italiens qui, avant la scolarit&eacute;, ne parle que la langue de ses parents : le Fran&ccedil;ais &quot;fatto in casa&quot; (fait &agrave; la maison).</p>\r\n\r\n<p style=\"text-align:center\">Tony nous transporte dans un univers ensoleill&eacute;, parsem&eacute; d&#39;odeurs de thym, de laurier et de m&eacute;diterran&eacute;e.</p>\r\n\r\n<p style=\"text-align:center\">Son &quot;italianitude&quot; est un pr&eacute;texte pour crier son amour de la France. Parce que, comme disaient ses parents, la terre d&#39;accueil est un bien &agrave; ch&eacute;rir.</p>\r\n\r\n<p style=\"text-align:center\">Un spectacle plein d&#39;amour, de rires et de sinc&eacute;rit&eacute;.</p>\r\n\r\n<p style=\"text-align:center\">&Agrave; d&eacute;guster comme une tasse de caf&eacute; !!!</p>', 'https://www.youtube.com/watch?v=e0mUbqAaC-4&t=2s');



DROP TABLE IF EXISTS `post_theater`;
CREATE TABLE IF NOT EXISTS `post_theater` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_teaser` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `post_theater` (`id`, `title`, `image`, `url_image`, `content`, `link_teaser`) VALUES
(4, 'Poupée Gonflante', 'D:\\Wamp\\tmp\\php2AC7.tmp', 'images/upload/poupée_gonflante.jpg', '<p>Apr&egrave;s 15 ans de mariage c&#39;est la saint-valentin de trop !<br />\r\nL&#39;&eacute;change de cadeau vire &agrave; la catastrophe !<br />\r\nTout fout le campet comme on dit : &quot; &agrave; part un miracle on n&#39;est pas sorti des ronces. &quot;<br />\r\nMais l&#39;amour n&#39;a pas dit son dernier mot !</p>', 'https://www.facebook.com/TheatreLulusurLaColline/videos/1305127799588577/'),
(5, 'Tinder Surprise', 'D:\\Wamp\\tmp\\php2891.tmp', 'images/upload/tinder_surprise.jpg', '<p>Chlo&eacute; et Fred se sont rencontr&eacute;s sur Tinder, ont d&eacute;cid&eacute; de faire un enfant et pendant 9 mois, ils vont aller de surprise en surprise...<br />\r\nElle, c&#39;est Chlo&eacute;, une trentenaire souriante, au caract&egrave;re bien tremp&eacute;, adepte du &quot;Girl Power&quot;. Lui, c&#39;est Fred, son petit mari d&#39;amour, adolescent attard&eacute;, ascendant gros nounours.<br />\r\nIls se sont rencontr&eacute;s sur Tinder, ont d&eacute;cid&eacute; de faire un enfant et pendant 9 mois, vont aller de surprise en surprise...</p>', 'https://www.youtube.com/watch?v=VdPf1tDlcl0'),
(6, 'Opération Hermès', 'D:\\Wamp\\tmp\\php26A9.tmp', 'images/upload/opération_hermès.jpg', '<p>Un agent secret hyper entra&icirc;n&eacute; se retrouve &agrave; voyager dans le temps malgr&eacute; lui et &agrave; devoir, en plus sauver le monde entour&eacute; d&#39;une &eacute;quipe d&#39;amateurs<br />\r\nVous aimez les s&eacute;ries t&eacute;l&eacute; am&eacute;ricaines, les personnages attachants, les intrigues, les dialogues incisifs ? Pour la premi&egrave;re fois, une &eacute;quipe d&#39;auteurs et de com&eacute;diens inventent le concept de &quot;s&eacute;rie t&eacute;l&eacute; th&eacute;&acirc;tre&quot;.<br />\r\nRetrouvez une Dream Team d&#39;agents secrets d&eacute;cal&eacute;s et d&eacute;sopilants dans leur premi&egrave;re saison, &agrave; la poursuite de l&#39;ange du mal.</p>', NULL),
(7, 'La croisière ça use', 'D:\\Wamp\\tmp\\php4AB4.tmp', 'images/upload/la_croisière_ca_use.jpeg', '<p>Faux semblants et vrais d&eacute;lires, la travers&eacute;e va virer &agrave; la d&eacute;bandade...<br />\r\nAntoine, skipper, doit convoyer un voilier de Tanger &agrave; Ibiza. Afin de lier l&#39;utile &agrave; l&#39;agr&eacute;able, il a pass&eacute; une annonce pour partager la travers&eacute;e avec 3 &eacute;quipi&egrave;res.<br />\r\nEmbarquent M&eacute;lanie, une superbe jeune femme qui serait plus &agrave; sa place dans un &eacute;mission de t&eacute;l&eacute; r&eacute;alit&eacute; que sur la m&eacute;diterran&eacute;e, Joanna, baroudeuse et chienne de garde et Alex... un homme ! Premiers couacs d&#39;une croisi&egrave;re tr&egrave;s secou&eacute;e...<br />\r\nEntre incompatibilit&eacute; d&#39;humeur et avaries en cascade, la temp&ecirc;te &agrave; bord est in&eacute;vitable... Surtout quand les &eacute;quipiers ne sont pas vraiment ce qu&#39;ils pr&eacute;tendent &ecirc;tre... La croisi&egrave;re &ccedil;a use !</p>', 'https://www.youtube.com/watch?v=4K0e6MTFkqA'),
(8, 'Douce France', 'D:\\Wamp\\tmp\\php2110.tmp', 'images/upload/douce_france.jpg', '<p>Max politiquement tr&egrave;s &agrave; droite attend un travail, Miguel tr&egrave;s &agrave; gauche attend un rendez-vous Tinder, et Patrick tr&egrave;s au centre attend un enfant.<br />\r\nLa pr&eacute;sence d&#39;Emmanuel Macron dans le quartier, bloque ce gilet bleu, ce gilet rouge et ce gilet orange dans le &quot;Bar Des Amis&quot;.<br />\r\nEnferm&eacute;s, ces trois grandes gueules vont faire l&#39;&eacute;tat des lieux du pays, sans filtre, et tout le monde va en prendre pour son compte!<br />\r\nMais quand un &eacute;v&eacute;nement fait basculer la br&egrave;ve de comptoir en fait divers, c&#39;est toute la France des gilets jaunes qui se retrouve.<br />\r\nLe bar, c&#39;est la v&eacute;ritable Assembl&eacute;e nationale des Fran&ccedil;ais...<br />\r\nOn discute de tout, de rien ;<br />\r\nOn a raison, on a tort ;<br />\r\nOn s&#39;aime, on se d&eacute;teste ;<br />\r\nOn rit, on pleure ;<br />\r\nOn est intelligent, on est con ;<br />\r\nOn est fran&ccedil;ais quoi !</p>', 'https://www.youtube.com/watch?v=ZE-J34Q3h0s');



DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_emails` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

Then, edit .env file with the elements concerning your database. Create a user that you will pass an administrator in the database directly in the “role” field like this : [“ROLE_ADMIN”].
