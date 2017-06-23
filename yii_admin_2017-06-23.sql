# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.42)
# Database: yii_admin
# Generation Time: 2017-06-23 09:47:36 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table yii_menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `yii_menu`;

CREATE TABLE `yii_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(128) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父级ID',
  `icon` varchar(32) NOT NULL DEFAULT '' COMMENT '图标',
  `route` varchar(64) NOT NULL DEFAULT '' COMMENT '路由规则',
  `sort` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

LOCK TABLES `yii_menu` WRITE;
/*!40000 ALTER TABLE `yii_menu` DISABLE KEYS */;

INSERT INTO `yii_menu` (`id`, `name`, `pid`, `icon`, `route`, `sort`, `created_at`)
VALUES
	(1,'系统管理',0,'fa-cog','system',1,1498091848),
	(2,'管理员信息',1,'','admin/list',1,1498091848),
	(3,'角色管理',1,'','role/list',2,1498091848),
	(4,'权限管理',1,'','permission/list',3,1498091848),
	(5,'菜单管理',1,'','menu/list',4,1498091848),
	(6,'日志管理',1,'','operate/list',5,1498091848),
	(7,'网站管理',0,'fa-bold','site',2,1498091848),
	(8,'用户管理',7,'','user/list',1,1498091848),
	(9,'音乐管理',7,'','music/list',2,1498091848),
	(10,'视频管理',7,'','video/list',3,1498091848),
	(11,'文章管理',7,'','article/list',4,1498091848),
	(12,'日志管理',7,'','log/list',5,1498091848);

/*!40000 ALTER TABLE `yii_menu` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table yii_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `yii_user`;

CREATE TABLE `yii_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(256) NOT NULL,
  `password_reset_token` varchar(256) DEFAULT NULL,
  `email` varchar(256) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
