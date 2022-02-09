-- MySQL dump 10.14  Distrib 5.5.68-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: yann-spadari_blog
-- ------------------------------------------------------
-- Server version	5.5.68-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(80) NOT NULL,
  `article` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `nom_image` varchar(255) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (21,'Sketch2Code','Le processus de conception dâ€™un service web ou dâ€™une application commence usuellement par le partage dâ€™idÃ©es entre les concepteurs sur un Â« white board Â». Une fois le concept validÃ©, il est gÃ©nÃ©ralement traduit manuellement par des dÃ©veloppeurs en un wireframe HTML fonctionnel. Cette Ã©tape prend souvent du temps et demande beaucoup dâ€™efforts aux Ã©quipes de dÃ©veloppement.\r\n\r\nÃ‰manent de ce constat, les Ã©quipes de Microsoft se sont donc penchÃ©es sur la simplification de cette Ã©tape grÃ¢ce Ã  lâ€™IA. Sketch2code met ainsi Ã  disposition dâ€™un service de reconnaissance visuelle basÃ© sur la combinaison des API Custom Vision et Computer Vision pour la dÃ©tection d\'objets, et OCR (Optical Character Recognition) pour la reconnaissance de l\'Ã©criture manuscrite. De cette faÃ§on, Sketch2code permet de gÃ©nÃ©rer du code HTML directement Ã  partir d\'une image dessinÃ©e Ã  la main.','5f6c7410bd02ff584dcdd1cd_schema-fonctionnement-sketch2code.png','5f6c7410bd02ff584dcdd1cd_schema-fonctionnement-sketch2code',28,21,'2022-02-09 13:59:37'),(22,'Dying Light 2','Le voilÃ  enfin, ce Dying Light 2. NÃ© sur les cendres de Dead Island, Dying Light a Ã©tÃ© un Ã©tonnant succÃ¨s, parvenant Ã  s\'assurer une certaine longÃ©vitÃ© et susciter un vif intÃ©rÃªt dans le milieu du jeu de survie avec des zombies, rapidement saturÃ© a force que l\'industrie l\'ait rÃ©gurgitÃ© ad nauseam. Suivi soignÃ©, Spin off battle Royal injustement sous-cotÃ© avec Dying Light Bad Blood... la franchise n\'a jamais vraiment quittÃ© les radars des joueurs et nous revient aujourd\'hui avec un Ã©pisode 2 qui dÃ©borde d\'ambitions. 6 ans de dÃ©veloppement semÃ© d\'embÃ»ches auront Ã©tÃ© nÃ©cessaires pour que Dying Light 2 voie le jour et autant dire que ces efforts et cette tÃ©nacitÃ© ont Ã©tÃ© payants.','dyinglight2-cover_a84k.jpg','dyinglight2-cover_a84k',28,23,'2022-02-09 14:12:02'),(23,'La Steam Deck de Valve','Valve a annoncÃ© aujourd\'hui sa toute nouvelle console portable bÃ¢ptisÃ© Steam Deck. La semaine derniÃ¨re, IGN a eu, en exclusivitÃ© mondiale, l\'opportunitÃ© de visiter les bureaux de Valve pour un premier test Hands On du Steam Deck et pour en parler avec les personnes qui l\'ont crÃ©Ã©. AprÃ¨s avoir passÃ© plusieurs heures, sur deux jours, Ã  jouer Ã  une grande diversitÃ© de jeux, il est trÃ¨s difficile de ne pas Ãªtre impressionnÃ© par l\'Ã©quilibre du prix, de la puissance, de la forme et des fonctionnalitÃ©s que Valve a rÃ©ussi Ã  atteindre.\r\n\r\nPour tester ses capacitÃ©s, j\'ai testÃ© une dizaine de jeux diffÃ©rents, certains Ã  la premiÃ¨re personne comme Doom Eternal ou Portal 2 ou d\'autres Ã  la troisiÃ¨me personne comme Death Stranding et Star Wars: Jedi Fallen Order et d\'autres en 3D isometric comme Stardew Valley ou Hades. Pour la plus part, ces jeux tournaient sans aucun problÃ¨me dans leurs rÃ©glages de base sur l\'Ã©cran en 720p de la console portable et celle ci est restÃ©e assez froide pendant toutes ces sessions.','dyinglight2-cover_a84k.jpg','dyinglight2-cover_a84k',28,23,'2022-02-09 14:13:01'),(24,'Les dangers du Metavers','Au-delÃ  des risques purement politiques et juridiques, le metaverse prÃ©sente de nombreux sujets de prÃ©occupations :\r\n\r\nLe premier, dâ€™ordre psychologique, tendrait Ã  rendre un peu plus poreuse la distinction entre le rÃ©el et le virtuel ;\r\n\r\nLe second relÃ¨verait de la sÃ©curitÃ© et porterait sur les risques cybers corrÃ©lÃ©s Ã  lâ€™augmentation de la surface dâ€™exposition quâ€™engendrerait une interconnexion des plateformes entre elles. Une faille de sÃ©curitÃ© permettrait de corrompre lâ€™ensemble du systÃ¨me.\r\n\r\nLe troisiÃ¨me concernerait les discriminations vÃ©hiculÃ©es par un tel univers autant que notre santÃ©. A lâ€™heure des tentatives de rÃ©gulation du temps dâ€™Ã©cran auprÃ¨s des jeunes gÃ©nÃ©rations et de la modÃ©ration des contenus, le metaverse les ferait basculer tout entier dans ce monde virtuel. Il importe Ã©galement de sâ€™interroger sur la place des personnes dÃ©favorisÃ©es et sÃ©niors au sein du metaverse. Ceux-ci sâ€™en trouveraient dâ€™autant plus isolÃ©s par cette rÃ©volution virtuelle.','horizon-worlds.jpg','horizon-worlds',28,21,'2022-02-09 14:16:10'),(25,'Un malware : EvilModel','L\'intelligence artificielle est capable de prouesses. Elle sait reconnaÃ®tre des objets sur les photos, gÃ©nÃ©rer du texte semblant avoir Ã©tÃ© rÃ©digÃ© par un humain et devient de plus en plus performante pour ce qui est de la reconnaissance vocale. Mais, selon les chercheurs de l\'UniversitÃ© de Californie, de San Diego et de l\'UniversitÃ© de l\'Illinois, les rÃ©seaux de neurones, qui constituent l\'IA, pourraient Ã©galement servir Ã  dissimuler de redoutables malwares qui passeraient entre les mailles du filet des solutions de sÃ©curitÃ©. Il faut dire que, par leur nature mÃªme, ces rÃ©seaux sont conÃ§us pour ingurgiter des quantitÃ©s Ã©normes de donnÃ©es pour consolider leur apprentissage. Ils peuvent tout aussi bien assimiler du code malveillant.\r\n\r\nCe code est placÃ© dans des donnÃ©es semblant inoffensives, selon la mÃ©thode de la stÃ©ganographie, c\'est dire l\'art de faire passer inaperÃ§u un message dans un autre message. Pour prouver leur thÃ©orie, les chercheurs ont utilisÃ© ce qu\'on appelle dÃ©sormais un EvilModel, une suite de code malveillant pesant 26,8 Mo. Ils l\'ont inoculÃ© dans une IA convolutive. Ils ont choisi AlexNet, une IA de 178 Mo spÃ©cialisÃ©e dans la reconnaissance des images. FragmentÃ©, ce code malveillant n\'a pas vraiment perturbÃ© le rÃ©seau neuronal puisque la perte de prÃ©cision de celui-ci a Ã©tÃ© limitÃ©e Ã  1 %, selon leurs mesures de performances.\r\n\r\nCela signifie que l\'utilisateur ne peut pas soupÃ§onner la prÃ©sence d\'un problÃ¨me puisque le rÃ©seau neuronal ne faillit pas Ã  ses tÃ¢ches habituelles. Et surtout, aucun des antivirus n\'a Ã©tÃ© capable de dÃ©tecter la prÃ©sence de ces 26,8 Mo de malwares. AprÃ¨s cet entraÃ®nement intÃ©grant ce code, les chercheurs ont ensuite augmentÃ© le volume de malwares Ã  36,9 Mo. EntraÃ®nÃ© avec cette nouvelle base de donnÃ©es, les performances ont dÃ©clinÃ© seulement de 10 %, ce qui reste suffisant pour faire illusion. Ils ont Ã©galement testÃ© EvilModel sur d\'autres IA, notamment VGG, Resnet, Inception et Mobilenet et obtenus des rÃ©sultats similaires.','intelligence-artificielle.jpg','intelligence-artificielle',28,22,'2022-02-09 14:55:00'),(26,'Le Canon PX','Je suis le fantÃ´me de ma famille, lâ€™homme qui nâ€™apparaÃ®t jamais sur les photos. Bien cachÃ© derriÃ¨re mon appareil, je ne cours pas aprÃ¨s la lumiÃ¨re. Mais depuis la naissance de ma fille, je commence Ã  regretter lâ€™absence dâ€™images qui raconteraient notre relation. VoilÃ  pourquoi ce robot photographe de Canon mâ€™intrigue.\r\n\r\nCommercialisÃ© mi-novembre au prix de 470 euros, le Powershot PX mitraille automatiquement les Â« instants importants de votre vie Â», selon sa page de prÃ©sentation. PosÃ© dans le salon, il suit nos dÃ©placements grÃ¢ce au moteur qui lâ€™autorise Ã  tourner sur lui-mÃªme, et grÃ¢ce Ã  son petit zoom optique X3. Haut comme une poire, cet automate aurait-il le pouvoir de me faire rÃ©apparaÃ®tre sur mes photos de famille ?','14c2c945-nda-canon-presente-le-powershot-px-une-camera-automatique-pour-toute-la-famille__1200_1200__1303-937-3926-3560.jpeg','14c2c945-nda-canon-presente-le-powershot-px-une-camera-automatique-pour-toute-la-famille__1200_1200__1303-937-3926-3560',27,22,'2022-02-09 16:02:06'),(27,'Le Wifi 6','Selon un nouveau rapport de TrendForce, la norme actuelle du Wi-Fi est sur le point de disparaitre. Rattrapant lentement son prÃ©dÃ©cesseur, le wi-fi 6 pourrait atteindre jusquâ€™Ã  60 % de part de marchÃ© en 2022. Le passage Ã  une technologie plus rapide peut apporter beaucoup Ã  lâ€™utilisateur final, rÃ©pondant aux exigences du mÃ©tavers et diverses applications de rÃ©alitÃ© virtuelle.\r\n\r\nLâ€™accÃ¨s au Wi-Fi 5 est lâ€™option grand public actuelle offerte par la plupart des appareils dotÃ©s dâ€™une connectivitÃ© Internet. Mais depuis un certain temps maintenant, nous avons commencÃ© Ã  voir la montÃ©e en puissance de la technologie Wi-Fi 6. Cette derniÃ¨re est supÃ©rieure au 5, mais ce nâ€™est certainement pas encore la technologie standard.','wifi-2-4-ou-5-ghz-quelle-frequence-choisir-pour-bien-capter-internet.jpeg','wifi-2-4-ou-5-ghz-quelle-frequence-choisir-pour-bien-capter-internet',28,24,'2022-02-09 16:04:39');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (21,'RÃ©alitÃ© Virtuelle'),(22,'Intelligence Artificielle'),(23,'Jeux VidÃ©os'),(24,'Communication');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` varchar(1024) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentaires`
--

LOCK TABLES `commentaires` WRITE;
/*!40000 ALTER TABLE `commentaires` DISABLE KEYS */;
INSERT INTO `commentaires` VALUES (24,'Je m\'en doutais.',27,27,'2022-02-09 16:06:40');
/*!40000 ALTER TABLE `commentaires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `droits`
--

DROP TABLE IF EXISTS `droits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `droits` (
  `id` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `droits`
--

LOCK TABLES `droits` WRITE;
/*!40000 ALTER TABLE `droits` DISABLE KEYS */;
INSERT INTO `droits` VALUES (1,'utilisateur'),(42,'moderateur'),(1337,'administrateur');
/*!40000 ALTER TABLE `droits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_droits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateurs`
--

LOCK TABLES `utilisateurs` WRITE;
/*!40000 ALTER TABLE `utilisateurs` DISABLE KEYS */;
INSERT INTO `utilisateurs` VALUES (27,'Yann','$2y$12$Z7v5C7Q07z6aRTbExDGvzOMY67Jos4W1sKxoN7PUVvjvyrh4/Aj8e','yann.spadari@laplateforme.io',42),(28,'admin','$2y$12$8Z7NIwGxjyW.8eDHz8JIjOfRtWKjdlv7Q/dfENF3RN5KSSrceRz2.','admin@admin.fr',1337);
/*!40000 ALTER TABLE `utilisateurs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-09 17:09:05
