-- MySQL dump 10.13  Distrib 5.1.50, for Win32 (ia32)
--
-- Host: localhost    Database: myblog
-- ------------------------------------------------------
-- Server version	5.1.50-community

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
-- Table structure for table `mb_admin`
--

DROP TABLE IF EXISTS `mb_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mb_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `account` varchar(30) NOT NULL DEFAULT '',
  `password` varchar(40) NOT NULL COMMENT '密码',
  `rights` varchar(50) NOT NULL DEFAULT '0',
  `created` int(11) DEFAULT '0',
  `logintime` int(11) DEFAULT '0',
  `loginip` varchar(60) DEFAULT NULL,
  `config` text CHARACTER SET latin1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `account_UNIQUE` (`account`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mb_admin`
--

LOCK TABLES `mb_admin` WRITE;
/*!40000 ALTER TABLE `mb_admin` DISABLE KEYS */;
INSERT INTO `mb_admin` VALUES (1,'管理员','admin','e10adc3949ba59abbe56e057f20f883e','11111111111111111111111111111111111111111111111111',1336546958,1340630248,'127.0.0.1','s:7:\"s:0:\"\";\";'),(2,'张明敏','test','c4ca4238a0b923820dcc509a6f75849b','00000000000000000000000000000000000000000000000000',1337062973,1337071867,'127.0.0.1',NULL);
/*!40000 ALTER TABLE `mb_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mb_admin_log`
--

DROP TABLE IF EXISTS `mb_admin_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mb_admin_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) DEFAULT '0' COMMENT '时间',
  `userid` int(11) DEFAULT NULL,
  `user` varchar(100) DEFAULT '0' COMMENT '用户ID',
  `log` varchar(255) DEFAULT NULL COMMENT '备注',
  `ip` varchar(50) DEFAULT NULL COMMENT 'IP',
  PRIMARY KEY (`id`),
  KEY `created` (`created`),
  KEY `user` (`user`),
  KEY `ip` (`ip`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='管理日志';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mb_admin_log`
--

LOCK TABLES `mb_admin_log` WRITE;
/*!40000 ALTER TABLE `mb_admin_log` DISABLE KEYS */;
INSERT INTO `mb_admin_log` VALUES (1,1337440096,0,'','Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0; BOIE9;ZHCN)：','127.0.0.1'),(2,1337440097,0,'','Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0; BOIE9;ZHCN)：','127.0.0.1'),(3,1337440108,0,'','Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0; BOIE9;ZHCN)：','127.0.0.1'),(4,1337440108,1,'admin','登陆成功：','127.0.0.1'),(5,1337440110,0,'','Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0; BOIE9;ZHCN)：','127.0.0.1'),(6,1337440110,0,'','Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0; BOIE9;ZHCN)：','127.0.0.1'),(7,1337440110,0,'','Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0; BOIE9;ZHCN)：','127.0.0.1'),(8,1337440112,0,'','Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0; BOIE9;ZHCN)：','127.0.0.1'),(9,1337440113,0,'','Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0; BOIE9;ZHCN)：','127.0.0.1'),(10,1337440148,0,'','Shockwave Flash：','127.0.0.1'),(11,1337440366,1,'admin','登陆成功：','127.0.0.1'),(12,1337474213,1,'admin','登陆成功：','127.0.0.1'),(13,1337475689,0,'','{\"url\":\"\",\"state\":\"\\u4e0d\\u5141\\u8bb8\\u4e0a\\u4f20\\u7684\\u6587\\u4ef6\\u683c\\u5f0f.;\",\"fileType\":\"..\"}：','127.0.0.1'),(14,1337475992,0,'','{\"url\":\"null\",\"fileType\":\"null\",\"state\":\"\\u4e0d\\u5141\\u8bb8\\u4e0a\\u4f20\\u7684\\u6587\\u4ef6\\u683c\\u5f0f.;\"}：','127.0.0.1'),(15,1337476007,0,'','{\"url\":\"133747600735839800.txt\",\"state\":\"SUCCESS\",\"fileType\":\"..txt\"}：','127.0.0.1'),(16,1337476079,0,'','{\"url\":\"133747607938172300.rar\",\"state\":\"SUCCESS\",\"fileType\":\"..rar\"}：','127.0.0.1'),(17,1337476126,0,'','{\"url\":\"133747612637085900.rar\",\"state\":\"SUCCESS\",\"fileType\":\".rar\"}：','127.0.0.1'),(18,1337780556,1,'admin','登陆成功：','127.0.0.1'),(19,1339504083,NULL,'admin','登陆失败：Password not matching','127.0.0.1'),(20,1339504091,NULL,'shirne','登陆失败：User not found','127.0.0.1'),(21,1339504095,1,'admin','登陆成功：','127.0.0.1'),(22,1339507384,1,'admin','登陆成功：','127.0.0.1'),(23,1339593916,1,'admin','登陆成功：','127.0.0.1'),(24,1339679557,1,'admin','登陆成功：','127.0.0.1'),(25,1340630248,1,'admin','登陆成功：','127.0.0.1');
/*!40000 ALTER TABLE `mb_admin_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mb_articles`
--

DROP TABLE IF EXISTS `mb_articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mb_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL COMMENT '标题',
  `cate` int(11) DEFAULT NULL COMMENT '分类ID',
  `path` varchar(255) NOT NULL,
  `state` int(11) DEFAULT NULL COMMENT '状态',
  `author` varchar(45) DEFAULT NULL COMMENT '作者',
  `date` int(11) DEFAULT NULL COMMENT '添加日期',
  `mdate` int(11) DEFAULT NULL COMMENT '修改日期',
  `tags` varchar(250) DEFAULT NULL COMMENT '标签',
  `thumb` varchar(250) DEFAULT NULL COMMENT '缩略图',
  `refer` varchar(250) DEFAULT NULL COMMENT '来源',
  `hits` int(11) DEFAULT '0' COMMENT '点击',
  `attribute` text COMMENT '属性',
  `summary` varchar(250) DEFAULT NULL COMMENT '摘要',
  `content` text COMMENT '内容',
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `tag` (`tags`),
  KEY `date` (`date`),
  KEY `mdate` (`mdate`),
  KEY `state` (`state`),
  KEY `cate` (`cate`),
  KEY `hits` (`hits`),
  KEY `summary` (`summary`),
  KEY `author` (`author`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='文章表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mb_articles`
--

LOCK TABLES `mb_articles` WRITE;
/*!40000 ALTER TABLE `mb_articles` DISABLE KEYS */;
INSERT INTO `mb_articles` VALUES (1,'第一篇日记',1,'0',3,'admin',1336891992,1336893011,'博客,首篇','','baidu',NULL,NULL,'','<p style=\"white-space:normal;\"><a>测试&gt;内容asdasd</a></p>'),(2,'第二篇　文章',1,'0',7,'admin',1336964170,1336964184,'好吧,博客','','',0,NULL,'','<p>文章内容</p>');
/*!40000 ALTER TABLE `mb_articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `mb_articles_list`
--

DROP TABLE IF EXISTS `mb_articles_list`;
/*!50001 DROP VIEW IF EXISTS `mb_articles_list`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `mb_articles_list` (
  `id` int(11),
  `title` varchar(150),
  `cate` int(11),
  `path` varchar(255),
  `state` int(11),
  `author` varchar(45),
  `date` int(11),
  `mdate` int(11),
  `tags` varchar(250),
  `thumb` varchar(250),
  `refer` varchar(250),
  `hits` int(11),
  `summary` varchar(250),
  `cmtcount` bigint(21)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `mb_cates`
--

DROP TABLE IF EXISTS `mb_cates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mb_cates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL COMMENT '分类名称',
  `pid` int(11) DEFAULT '0' COMMENT '父类id',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  `path` varchar(255) NOT NULL DEFAULT '0',
  `colkey` varchar(20) NOT NULL COMMENT '键名',
  `thumb` varchar(150) DEFAULT NULL COMMENT '图片',
  `detail` text COMMENT '说明',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `pid` (`pid`),
  KEY `sort` (`sort`),
  KEY `colkey` (`colkey`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='分类表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mb_cates`
--

LOCK TABLES `mb_cates` WRITE;
/*!40000 ALTER TABLE `mb_cates` DISABLE KEYS */;
INSERT INTO `mb_cates` VALUES (1,'临风小记',0,0,'0','article','',''),(2,'学习笔记',0,1,'0','article','','');
/*!40000 ALTER TABLE `mb_cates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `mb_cates_count`
--

DROP TABLE IF EXISTS `mb_cates_count`;
/*!50001 DROP VIEW IF EXISTS `mb_cates_count`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `mb_cates_count` (
  `id` int(11),
  `name` varchar(150),
  `pid` int(11),
  `sort` int(11),
  `path` varchar(255),
  `colkey` varchar(20),
  `thumb` varchar(150),
  `detail` text,
  `count` bigint(21)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `mb_column`
--

DROP TABLE IF EXISTS `mb_column`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mb_column` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `type` tinyint(4) DEFAULT '0' COMMENT '0->链接到分类\n1->链接到单页\n2->外链',
  `link` varchar(150) DEFAULT NULL,
  `showsub` tinyint(4) DEFAULT '0' COMMENT '如果链接到分类，是否显示子类',
  `view` varchar(150) DEFAULT NULL COMMENT '图标',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='栏目表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mb_column`
--

LOCK TABLES `mb_column` WRITE;
/*!40000 ALTER TABLE `mb_column` DISABLE KEYS */;
/*!40000 ALTER TABLE `mb_column` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `mb_comment_count`
--

DROP TABLE IF EXISTS `mb_comment_count`;
/*!50001 DROP VIEW IF EXISTS `mb_comment_count`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `mb_comment_count` (
  `aid` int(11),
  `count` bigint(21)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `mb_comments`
--

DROP TABLE IF EXISTS `mb_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mb_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aid` int(11) DEFAULT NULL COMMENT '文章ID',
  `rid` int(11) DEFAULT '0' COMMENT '回复的ID',
  `date` datetime DEFAULT NULL COMMENT '日期',
  `state` int(11) DEFAULT NULL COMMENT '状态',
  `ava` varchar(150) DEFAULT NULL COMMENT '头像',
  `name` varchar(100) DEFAULT NULL COMMENT '名称',
  `email` varchar(150) DEFAULT NULL COMMENT '邮箱',
  `link` varchar(250) DEFAULT NULL COMMENT '链接',
  `content` text COMMENT '内容',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`),
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mb_comments`
--

LOCK TABLES `mb_comments` WRITE;
/*!40000 ALTER TABLE `mb_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `mb_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mb_config`
--

DROP TABLE IF EXISTS `mb_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mb_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '配置名称',
  `value` text NOT NULL COMMENT '配置值,多个键值对序列',
  `description` varchar(255) DEFAULT NULL COMMENT '配置说明',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mb_config`
--

LOCK TABLES `mb_config` WRITE;
/*!40000 ALTER TABLE `mb_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `mb_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mb_craft`
--

DROP TABLE IF EXISTS `mb_craft`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mb_craft` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `table` varchar(150) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `saved` int(11) DEFAULT NULL COMMENT '最后保存日期',
  `title` varchar(200) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='草稿';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mb_craft`
--

LOCK TABLES `mb_craft` WRITE;
/*!40000 ALTER TABLE `mb_craft` DISABLE KEYS */;
/*!40000 ALTER TABLE `mb_craft` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mb_links`
--

DROP TABLE IF EXISTS `mb_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mb_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '网站名称',
  `link` varchar(255) NOT NULL COMMENT '网站链接',
  `describ` varchar(150) DEFAULT NULL COMMENT '网站说明',
  `master` varchar(50) DEFAULT NULL COMMENT '站长',
  `email` varchar(150) DEFAULT NULL COMMENT '站长邮箱',
  `state` tinyint(4) DEFAULT '0' COMMENT '状态',
  `cate` int(11) NOT NULL COMMENT '类别',
  PRIMARY KEY (`id`),
  KEY `cate` (`cate`),
  KEY `title` (`title`),
  KEY `link` (`link`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='友情链接表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mb_links`
--

LOCK TABLES `mb_links` WRITE;
/*!40000 ALTER TABLE `mb_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `mb_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mb_member`
--

DROP TABLE IF EXISTS `mb_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mb_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admid` int(11) DEFAULT '0',
  `email` varchar(150) NOT NULL,
  `name` varchar(150) DEFAULT NULL COMMENT '名称',
  `phone` varchar(45) DEFAULT NULL,
  `site` varchar(150) DEFAULT NULL COMMENT '网址',
  `avachr` varchar(250) DEFAULT NULL COMMENT '头像',
  `created` int(11) DEFAULT NULL COMMENT '创建日期',
  `password` varchar(40) DEFAULT NULL COMMENT '密码',
  `actived` int(11) DEFAULT '0' COMMENT '激活日期\n0代表未激活',
  `visited` int(11) DEFAULT NULL COMMENT '最后访问时间',
  `level` tinyint(4) DEFAULT NULL COMMENT '评级',
  `memo` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `created` (`created`),
  KEY `actived` (`actived`),
  KEY `visited` (`visited`),
  KEY `level` (`level`),
  KEY `admid` (`admid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mb_member`
--

LOCK TABLES `mb_member` WRITE;
/*!40000 ALTER TABLE `mb_member` DISABLE KEYS */;
/*!40000 ALTER TABLE `mb_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mb_menu`
--

DROP TABLE IF EXISTS `mb_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mb_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `control` varchar(45) NOT NULL COMMENT '一级菜单为默认的操作',
  `action` varchar(45) DEFAULT NULL,
  `parent` int(11) DEFAULT '0',
  `sort` int(11) DEFAULT '0',
  `right` varchar(50) CHARACTER SET latin1 DEFAULT '0',
  `show` tinyint(4) DEFAULT '1' COMMENT '是否显示在菜单',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COMMENT='后台菜单';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mb_menu`
--

LOCK TABLES `mb_menu` WRITE;
/*!40000 ALTER TABLE `mb_menu` DISABLE KEYS */;
INSERT INTO `mb_menu` VALUES (1,'系统管理','system','index',0,0,'00000000000000000000000000000000000000000000000000',1),(2,'修改资料','system','admindata',1,20,'00000000000000000000000000000000000000000000000000',1),(3,'页面管理','page','index',0,2,'00000000000000010000000000000000000000000000000000',1),(4,'添加页面','page','addpage',3,0,'00000000000000010000000000000000000000000000000000',1),(5,'文章管理','article','index',0,1,'00000000000000000000000000000000000000000000000000',1),(6,'会员管理','member','index',0,3,'00000000000000000000000001000000000000000000000000',1),(7,'附加功能','other','index',0,4,'00000000000000000000000000000000000000001000000000',1),(8,'添加文章','article','add',5,1,'00000000000000000000000000000000000000000000000100',1),(9,'评论管理','article','comment',5,4,'00000000000000000000000000000000000000000000100000',1),(10,'标签管理','article','tags',5,5,'00000000000000000000000000000000000000000001000000',1),(11,'草稿箱','article','craft',5,6,'00000000000000000000000000000000000000000000000000',1),(12,'留言管理','other','message',7,0,'00000000000000000000000000000000000000010000000000',1),(13,'友情链接','other','link',7,0,'00000000000000000000000000000000000000100000000000',1),(14,'系统配置','system','config',1,1,'00000100000000000000000000000000000000000000000000',1),(15,'保存配置','system','configsave',1,2,'00000100000000000000000000000000000000000000000000',0),(16,'用户配置','system','userconfig',1,3,'00000000000000000000000000000000000000000000000000',1),(17,'保存用户配置','system','userconfigsave',1,4,'00000000000000000000000000000000000000000000000000',0),(18,'菜单管理','system','menumanage',1,5,'10000000000000000000000000000000000000000000000000',1),(19,'添加菜单','system','menuadd',1,8,'10000000000000000000000000000000000000000000000000',1),(21,'菜单状态更改','system','menustat',1,7,'10000000000000000000000000000000000000000000000000',0),(22,'保存菜单','system','menusave',1,9,'10000000000000000000000000000000000000000000000000',0),(23,'删除菜单','system','menudel',1,11,'10000000000000000000000000000000000000000000000000',0),(24,'管理员管理','system','adminmanage',1,12,'00000000001000000000000000000000000000000000000000',1),(25,'添加管理员','system','adminadd',1,14,'00000000001000000000000000000000000000000000000000',1),(26,'删除管理员','system','admindel',1,19,'00000000001000000000000000000000000000000000000000',0),(27,'保存管理员','system','adminsave',1,16,'00000000001000000000000000000000000000000000000000',0),(28,'管理员信息批量处理','system','adminbatch',1,13,'00000000001000000000000000000000000000000000000000',0),(29,'管理首页','system','index',1,0,'00000000000000000000000000000000000000000000000000',1),(30,'文章列表','article','index',5,0,'00000000000000000000000000000000000000000000000001',1),(31,'保存文章','article','save',5,0,'00000000000000000000000000000000000000000000000001',0),(32,'文章批量处理保存','article','batch',5,0,'00000000000000000000000000000000000000000000000010',0),(33,'分类管理','article','cate',5,2,'00000000000000000000000000000000000000000000010000',1),(34,'添加分类','article','cateadd',5,3,'00000000000000000000000000000000000000000000010000',1),(35,'分类保存','article','catesave',5,0,'00000000000000000000000000000000000000000000010000',0),(36,'分类批量处理保存','article','catebatch',5,0,'00000000000000000000000000000000000000000000010000',0),(37,'修改分类','article','cateedit',5,0,'00000000000000000000000000000000000000000000010000',0),(38,'保存资料','system','admindatasave',1,21,'00000000000000000000000000000000000000000000000000',0),(39,'修改菜单','system','menuedit',1,10,'00000100000000000000000000000000000000000000000000',0),(40,'修改管理员','system','adminedit',1,15,'00000000001000000000000000000000000000000000000000',0),(41,'管理员权限修改','system','adminright',1,17,'00000000001000000000000000000000000000000000000000',0),(42,'管理员权限保存','system','adminrightsave',1,18,'00000000001000000000000000000000000000000000000000',0);
/*!40000 ALTER TABLE `mb_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mb_message`
--

DROP TABLE IF EXISTS `mb_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mb_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `ava` varchar(150) DEFAULT NULL,
  `link` varchar(150) DEFAULT NULL,
  `reply` text,
  `retime` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mb_message`
--

LOCK TABLES `mb_message` WRITE;
/*!40000 ALTER TABLE `mb_message` DISABLE KEYS */;
/*!40000 ALTER TABLE `mb_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mb_pages`
--

DROP TABLE IF EXISTS `mb_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mb_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cate` int(11) DEFAULT '0',
  `path` varchar(255) DEFAULT '0',
  `page` varchar(255) NOT NULL,
  `title` varchar(150) NOT NULL,
  `thumb` varchar(200) DEFAULT NULL,
  `tags` varchar(200) DEFAULT NULL,
  `describ` varchar(255) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_UNIQUE` (`page`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mb_pages`
--

LOCK TABLES `mb_pages` WRITE;
/*!40000 ALTER TABLE `mb_pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `mb_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mb_session`
--

DROP TABLE IF EXISTS `mb_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mb_session` (
  `session_id` varchar(40) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `ip_address` varchar(16) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `user_agent` varchar(120) CHARACTER SET latin1 NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mb_session`
--

LOCK TABLES `mb_session` WRITE;
/*!40000 ALTER TABLE `mb_session` DISABLE KEYS */;
INSERT INTO `mb_session` VALUES ('020d3e3a78850e2ccdf57e1e023dfeba','127.0.0.1','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.46 Safari/536.5',1339837406,'a:2:{s:9:\"user_data\";s:0:\"\";s:8:\"SYS_code\";s:8:\"a6qf3rkt\";}'),('116125191e2029e8ac3054aa8027aeaf','127.0.0.1','MMHttp (Windows; Version:12.0)',1340629381,'a:2:{s:9:\"user_data\";s:0:\"\";s:8:\"SYS_code\";s:8:\"zjpecbv8\";}'),('4d95e4781c9b87f7f62585bfd6685413','127.0.0.1','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.46 Safari/536.5',1340630755,'a:2:{s:9:\"user_data\";s:0:\"\";s:11:\"SYS_USER_ID\";i:1;}'),('56d32f94acbda72152ce224999d86eeb','127.0.0.1','MMHttp (Windows; Version:12.0)',1340629381,''),('b501bbb18746da8b3cc2b819b28161b1','127.0.0.1','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.5 (KHTML, like Gecko) Chrome/19.0.1084.46 Safari/536.5',1339679538,'a:2:{s:9:\"user_data\";s:0:\"\";s:11:\"SYS_USER_ID\";i:1;}');
/*!40000 ALTER TABLE `mb_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mb_tags`
--

DROP TABLE IF EXISTS `mb_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mb_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(50) NOT NULL,
  `detail` varchar(250) DEFAULT '',
  `vice` varchar(250) DEFAULT '' COMMENT '副标签',
  `hits` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tag` (`tag`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='标签表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mb_tags`
--

LOCK TABLES `mb_tags` WRITE;
/*!40000 ALTER TABLE `mb_tags` DISABLE KEYS */;
INSERT INTO `mb_tags` VALUES (1,'博客','','',0),(2,'首篇','','',0),(3,'好吧','','',0);
/*!40000 ALTER TABLE `mb_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `mb_tags_count`
--

DROP TABLE IF EXISTS `mb_tags_count`;
/*!50001 DROP VIEW IF EXISTS `mb_tags_count`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `mb_tags_count` (
  `id` int(11),
  `tag` varchar(50),
  `vice` varchar(250),
  `detail` varchar(250),
  `hits` int(11),
  `count` bigint(21)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `mb_articles_list`
--

/*!50001 DROP TABLE IF EXISTS `mb_articles_list`*/;
/*!50001 DROP VIEW IF EXISTS `mb_articles_list`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `mb_articles_list` AS select `a`.`id` AS `id`,`a`.`title` AS `title`,`a`.`cate` AS `cate`,`a`.`path` AS `path`,`a`.`state` AS `state`,`a`.`author` AS `author`,`a`.`date` AS `date`,`a`.`mdate` AS `mdate`,`a`.`tags` AS `tags`,`a`.`thumb` AS `thumb`,`a`.`refer` AS `refer`,`a`.`hits` AS `hits`,`a`.`summary` AS `summary`,count(`b`.`id`) AS `cmtcount` from (`mb_articles` `a` left join `mb_comments` `b` on((`a`.`id` = `b`.`aid`))) group by `a`.`id` order by `a`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `mb_cates_count`
--

/*!50001 DROP TABLE IF EXISTS `mb_cates_count`*/;
/*!50001 DROP VIEW IF EXISTS `mb_cates_count`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `mb_cates_count` AS select `a`.`id` AS `id`,`a`.`name` AS `name`,`a`.`pid` AS `pid`,`a`.`sort` AS `sort`,`a`.`path` AS `path`,`a`.`colkey` AS `colkey`,`a`.`thumb` AS `thumb`,`a`.`detail` AS `detail`,count(`b`.`id`) AS `count` from (`mb_cates` `a` left join `mb_articles` `b` on(find_in_set(`a`.`id`,`b`.`path`))) group by `b`.`id` order by `a`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `mb_comment_count`
--

/*!50001 DROP TABLE IF EXISTS `mb_comment_count`*/;
/*!50001 DROP VIEW IF EXISTS `mb_comment_count`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `mb_comment_count` AS select `mb_comments`.`aid` AS `aid`,count(`mb_comments`.`id`) AS `count` from `mb_comments` group by `mb_comments`.`aid` order by `mb_comments`.`aid` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `mb_tags_count`
--

/*!50001 DROP TABLE IF EXISTS `mb_tags_count`*/;
/*!50001 DROP VIEW IF EXISTS `mb_tags_count`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `mb_tags_count` AS select `a`.`id` AS `id`,`a`.`tag` AS `tag`,`a`.`vice` AS `vice`,`a`.`detail` AS `detail`,`a`.`hits` AS `hits`,count(`b`.`id`) AS `count` from (`mb_tags` `a` left join `mb_articles` `b` on(find_in_set(`a`.`tag`,`b`.`tags`))) group by `a`.`id` order by `a`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-06-29  7:08:43
