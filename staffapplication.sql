/*
Navicat MySQL Data Transfer

Source Server         : Beta
Source Server Version : 50714
Source Host           : 127.0.0.1:3306
Source Database       : hotel

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2016-10-24 19:23:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `staffapplication`
-- ----------------------------
DROP TABLE IF EXISTS `staffapplication`;
CREATE TABLE `staffapplication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text,
  `realname` text,
  `skype` text,
  `age` text,
  `functie` text,
  `onlinetime` text,
  `knowing` text,
  `quarrel` text,
  `serious` text,
  `improve` text,
  `microphone` text,
  `ip` text,
  `date` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3746 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of staffapplication
-- ----------------------------
