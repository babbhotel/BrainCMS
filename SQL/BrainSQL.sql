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
-- Table structure for `uotw`
-- ----------------------------

DROP TABLE IF EXISTS `uotw`;
CREATE TABLE `uotw` (
  `userid` varchar(255) DEFAULT NULL,
  `text` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of uotw
-- ----------------------------
INSERT INTO `uotw` VALUES ('115', 'Ik ben de beste speler!');

-- ----------------------------
-- Table structure for `teams`
-- ----------------------------
DROP TABLE IF EXISTS `teams`;
CREATE TABLE `teams` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `badgeid` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of teams
-- ----------------------------
INSERT INTO `teams` VALUES ('1', 'Spam Team', 'SPAM');
INSERT INTO `teams` VALUES ('3', 'Bouw Team', 'BOUW');
INSERT INTO `teams` VALUES ('4', 'Event Team', 'EVENT');
INSERT INTO `teams` VALUES ('5', 'Pixelaar', 'PIXEL');
INSERT INTO `teams` VALUES ('6', 'Gok Team', 'GOK');

-- ----------------------------

ALTER TABLE users ADD pin VARCHAR(4);
ALTER TABLE users ADD teamrank int(1) DEFAULT 0;
ALTER TABLE users ADD fbid varchar(255) DEFAULT NULL;
ALTER TABLE users ADD fbenable  enum('0','1','2') DEFAULT 2;


-- ----------------------------
-- Table structure for `cms_news_like`
-- ----------------------------
DROP TABLE IF EXISTS `cms_news_like`;
CREATE TABLE `cms_news_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(255) DEFAULT NULL,
  `newsid` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for `cms_news_message`
-- ----------------------------
DROP TABLE IF EXISTS `cms_news_message`;
CREATE TABLE `cms_news_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL DEFAULT '0',
  `newsid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `message` varchar(250) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;