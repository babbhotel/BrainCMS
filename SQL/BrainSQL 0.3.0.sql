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

ALTER TABLE users ADD pin VARCHAR(4);

DROP TABLE IF EXISTS `uotw`;
CREATE TABLE `uotw` (
  `userid` varchar(255) DEFAULT NULL,
  `text` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of uotw
-- ----------------------------
INSERT INTO `uotw` VALUES ('115', 'Ik ben de beste speler!');