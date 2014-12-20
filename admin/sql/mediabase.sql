-- MySQL dump 10.13  Distrib 5.1.49, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: experimentaltv
-- ------------------------------------------------------
-- Server version	5.1.49-3

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
-- Table structure for table `nkm_channels`
--

DROP TABLE IF EXISTS `nkm_channels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nkm_channels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creation_date` datetime DEFAULT NULL,
  `status` varchar(100) NOT NULL DEFAULT '',
  `start_page` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `channel_name` varchar(150) NOT NULL,
  `meta_description` varchar(150) NOT NULL,
  `meta_keywords` varchar(150) NOT NULL,
  `language` varchar(100) NOT NULL DEFAULT '',
  `location` varchar(100) NOT NULL DEFAULT '',
  `external_url` varchar(255) NOT NULL DEFAULT '',
  `header_pic` varchar(255) NOT NULL DEFAULT '',
  `standby_pic` varchar(255) NOT NULL DEFAULT '',
  `background_pic` varchar(255) NOT NULL DEFAULT '',
  `background_conf` varchar(50) NOT NULL DEFAULT '',
  `mountpoint_url` varchar(200) NOT NULL DEFAULT '',
  `default_live` varchar(3) NOT NULL,
  `player_width` varchar(4) NOT NULL DEFAULT '',
  `player_height` varchar(4) NOT NULL DEFAULT '',
  `player_type` varchar(10) NOT NULL,
  `player_lang` varchar(10) NOT NULL,
  `footer_text` varchar(100) NOT NULL DEFAULT '',
  `font_color` varchar(6) NOT NULL DEFAULT '',
  `links_color` varchar(6) NOT NULL DEFAULT '',
  `background_color` varchar(6) NOT NULL DEFAULT '',
  `background_page_color` varchar(6) NOT NULL DEFAULT '',
  `uptext_live` text NOT NULL,
  `lowtext1_live` text NOT NULL,
  `lowtext2_live` text NOT NULL,
  `order_videos` varchar(50) NOT NULL DEFAULT '',
  `country` varchar(50) NOT NULL,
  `uptext_mb` text NOT NULL,
  `lowtext1_mb` text NOT NULL,
  `lowtext2_mb` text NOT NULL,
  `background_menu_color` varchar(6) NOT NULL,
  `background_playlist_color` varchar(6) NOT NULL,
  `font_menu_color` varchar(6) NOT NULL,
  `draw_menu_lines` varchar(1) NOT NULL,
  `twitter_search` varchar(100) NOT NULL,
  `upload_date` datetime DEFAULT NULL,
  `main_player_type` varchar(45) DEFAULT NULL,
  `player_controls` varchar(45) DEFAULT NULL,
  `player_autoplay` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nkm_media`
--

DROP TABLE IF EXISTS `nkm_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nkm_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(100) NOT NULL DEFAULT '',
  `order_number` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `weight` varchar(100) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `views` varchar(100) NOT NULL,
  `thumbnail` varchar(100) NOT NULL DEFAULT '',
  `upload_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `creation_date` datetime NOT NULL,
  `channel` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `technical_details` varchar(100) NOT NULL,
  `keywords` varchar(100) NOT NULL,
  `platform` varchar(100) NOT NULL,
  `file` varchar(200) NOT NULL,
  `format` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nkm_pictures_galleries`
--

DROP TABLE IF EXISTS `nkm_pictures_galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nkm_pictures_galleries` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `dr_folder` smallint(6) NOT NULL,
  `creation_date` datetime DEFAULT NULL,
  `status` int(1) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `default_album_action` varchar(20) NOT NULL,
  `default_gallery_action` varchar(20) NOT NULL,
  `max_resize_width` int(11) NOT NULL,
  `max_resize_height` int(11) NOT NULL,
  `max_thumb_width` int(11) NOT NULL,
  `max_thumb_height` int(11) NOT NULL,
  `scaleType` varchar(1) NOT NULL DEFAULT 'h',
  `animate` int(1) NOT NULL DEFAULT '1',
  `animateFade` int(1) NOT NULL DEFAULT '1',
  `animSequence` varchar(4) NOT NULL DEFAULT 'wh',
  `autoplayMovies` int(1) NOT NULL DEFAULT '1',
  `continuous` int(1) NOT NULL DEFAULT '0',
  `counterType` varchar(7) NOT NULL DEFAULT 'default',
  `counterLimit` int(4) NOT NULL DEFAULT '10',
  `displayCounter` int(1) NOT NULL DEFAULT '1',
  `displayNav` int(1) NOT NULL DEFAULT '1',
  `enableKeys` int(1) NOT NULL DEFAULT '1',
  `fadeDuration` varchar(4) NOT NULL DEFAULT '0.35',
  `flashParams` varchar(100) NOT NULL DEFAULT '{bgcolor:"#000000"}',
  `flashVars` varchar(100) NOT NULL DEFAULT '{}',
  `flashVersion` varchar(7) NOT NULL DEFAULT '9.0.0',
  `handleOversize` varchar(6) NOT NULL DEFAULT 'drag',
  `handleUnsupported` varchar(6) NOT NULL DEFAULT 'link',
  `initialWidth` int(5) NOT NULL DEFAULT '320',
  `initialHeight` int(5) NOT NULL DEFAULT '160',
  `modal` int(1) NOT NULL DEFAULT '0',
  `onChange` varchar(100) DEFAULT NULL,
  `onClose` varchar(100) DEFAULT NULL,
  `onFinish` varchar(100) DEFAULT NULL,
  `onOpen` varchar(100) DEFAULT NULL,
  `overlayColor` varchar(7) NOT NULL DEFAULT '#000',
  `overlayOpacity` varchar(7) NOT NULL DEFAULT '0.5',
  `resizeDuration` varchar(7) NOT NULL DEFAULT '0.35',
  `showOverlay` int(1) NOT NULL DEFAULT '1',
  `showMovieControls` int(1) NOT NULL DEFAULT '1',
  `skipSetup` int(1) NOT NULL DEFAULT '1',
  `slideshowDelay` varchar(7) NOT NULL DEFAULT '0',
  `troubleElements` varchar(100) NOT NULL DEFAULT '["select", "object", "embed", "canvas"]',
  `viewportPadding` int(3) NOT NULL DEFAULT '20',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nkm_reports`
--

DROP TABLE IF EXISTS `nkm_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nkm_reports` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `dr_folder` varchar(100) NOT NULL DEFAULT '',
  `creation_date` date NOT NULL DEFAULT '0000-00-00',
  `status` varchar(100) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `report` varchar(100) NOT NULL,
  `template` int(11) NOT NULL,
  `params` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL DEFAULT '',
  `sendreport` varchar(255) NOT NULL DEFAULT '',
  `sendreport_email` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-20 11:29:56
