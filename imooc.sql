/*
SQLyog Ultimate v11.24 (32 bit)
MySQL - 5.6.17 : Database - imooc_mail
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`imooc_mail` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `imooc_mail`;

/*Table structure for table `im_goods` */

DROP TABLE IF EXISTS `im_goods`;

CREATE TABLE `im_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `name` varchar(100) NOT NULL COMMENT '商品名称',
  `price` int(11) NOT NULL COMMENT '商品价格',
  `pic` varchar(255) NOT NULL COMMENT '商品图片',
  `des` varchar(200) NOT NULL COMMENT '商品简介',
  `content` longtext NOT NULL COMMENT '商品详情信息',
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `create_time` int(11) NOT NULL COMMENT '发布时间',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  `view` int(11) NOT NULL COMMENT '浏览次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='商品表';

/*Data for the table `im_goods` */

insert  into `im_goods`(`id`,`name`,`price`,`pic`,`des`,`content`,`user_id`,`create_time`,`update_time`,`view`) values (2,'1111',11111,'http://localhost/mall/static/file/2017/0622/594b75939512e6938.jpg','111111','1111111111',24,1498117523,1498117523,19),(3,'333',222,'http://localhost/mall/static/file/2017/0623/594cc685938798989.png','222222','<p>\r\n	444444444422222\r\n</p>\r\n<p>\r\n	55555555555\r\n</p>',24,1498203781,1498203781,9),(4,'2',2,'http://localhost/mall/static/file/2017/0627/59523b3c2632c7826.png','2','222',28,1498561340,1498561340,0),(5,'3',3,'http://localhost/mall/static/file/2017/0627/59523b5993fc19143.png','3','3',28,1498561369,1498561369,0),(6,'4',4,'http://localhost/mall/static/file/2017/0627/59523b7fab7748695.png','4','4',28,1498561407,1498561407,0),(7,'5',5,'http://localhost/mall/static/file/2017/0627/59523b98e9d486514.png','5','5',28,1498561432,1498561432,0),(9,'67',7,'http://localhost/mall/static/file/2017/0627/59523bb672db84320.png','7','7',28,1498561462,1498561462,4),(10,'8',8,'http://localhost/mall/static/file/2017/0627/59523bc445a3e3493.png','8','8',28,1498561476,1498561476,0),(11,'9',9,'http://localhost/mall/static/file/2017/0627/59523bd01d4732819.png','9','9',28,1498561488,1498561488,0),(12,'11',9,'http://localhost/mall/static/file/2017/0627/59523bde67f0d7581.png','11','11',28,1498561502,1498561502,0),(13,'做一个程序员',20,'http://localhost/mall/static/file/2017/0628/59533f4ec083c6954.png','Github','111111',28,1498627918,1498627918,0);

/*Table structure for table `im_user` */

DROP TABLE IF EXISTS `im_user`;

CREATE TABLE `im_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='用户名';

/*Data for the table `im_user` */

insert  into `im_user`(`id`,`username`,`password`,`create_time`) values (12,'sss','7e0b2750e0c4e1724ba35ff8ce361563',1497428205),(24,'admin','a02daa14133ae6bd41e1eae87eef2e11',1498020469),(28,'admin11','a02daa14133ae6bd41e1eae87eef2e11',1498032065),(29,'admin1','a02daa14133ae6bd41e1eae87eef2e11',1498032103),(30,'abcd','a02daa14133ae6bd41e1eae87eef2e11',1498194807);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
