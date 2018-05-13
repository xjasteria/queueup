/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : queueup

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2018-05-13 17:25:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `updated_at` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Table types';

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'A', '1-2人', '1524820956');
INSERT INTO `category` VALUES ('2', 'B', '3-4人', '1524820960');
INSERT INTO `category` VALUES ('3', 'C', '5-10人', '1524820963');
INSERT INTO `category` VALUES ('4', 'D', '包间（支持10人以上）', '1525509754');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `updated_at` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '冰淇淋', 'http://localhost:8080/queueup/Public/menupicture/2018-05-05/5aed6f79c9d82.jpg', '8', '夏日美味', '1', '1525510029');
INSERT INTO `menu` VALUES ('2', '小龙虾', 'http://localhost:8080/queueup/Public/menupicture/2018-05-05/5aed6fbf2e085.jpg', '58', '必不可少的辣！！', '1', '1525510085');
INSERT INTO `menu` VALUES ('3', '炒面', 'http://localhost:8080/queueup/Public/menupicture/2018-05-05/5aed6ff7e99da.jpg', '12', '一小盘炒面，便宜又好吃', '1', '1525510154');
INSERT INTO `menu` VALUES ('4', '月亮', 'http://localhost:8080/queueup/Public/menupicture/2018-05-07/5af00ae15be20.jpg', '222', 'lalala', '1', '1525680880');

-- ----------------------------
-- Table structure for queue
-- ----------------------------
DROP TABLE IF EXISTS `queue`;
CREATE TABLE `queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guest_id` char(28) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `number` int(10) NOT NULL,
  `table_id` int(10) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `updated_at` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of queue
-- ----------------------------

-- ----------------------------
-- Table structure for tables
-- ----------------------------
DROP TABLE IF EXISTS `tables`;
CREATE TABLE `tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inner_number` varchar(100) NOT NULL,
  `category_id` int(10) NOT NULL,
  `updated_at` int(10) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tables
-- ----------------------------
INSERT INTO `tables` VALUES ('1', '001', '1', '1524821034', '0');
INSERT INTO `tables` VALUES ('2', '002', '1', '1524821045', '0');
INSERT INTO `tables` VALUES ('3', '003', '1', '1524821050', '0');
INSERT INTO `tables` VALUES ('4', '004', '1', '1524821054', '0');
INSERT INTO `tables` VALUES ('5', '005', '2', '1524821061', '0');
INSERT INTO `tables` VALUES ('6', '006', '2', '1524821068', '0');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `session_key` char(24) NOT NULL,
  `openid` char(28) NOT NULL,
  `expires_in` int(10) NOT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
