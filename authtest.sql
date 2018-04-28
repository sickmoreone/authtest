/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : zidoo_app

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-04-28 17:21:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_apk
-- ----------------------------
DROP TABLE IF EXISTS `t_apk`;
CREATE TABLE `t_apk` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT COMMENT 'apk表',
  `name` varchar(40) NOT NULL COMMENT 'apk名称',
  `remark` varchar(255) DEFAULT NULL COMMENT 'apk备注',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `f_model` varchar(255) DEFAULT NULL COMMENT 'apk所属型号[a,b]型号id',
  `create_people` int(12) unsigned DEFAULT NULL COMMENT '创建人userid',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_apk
-- ----------------------------
INSERT INTO `t_apk` VALUES ('1', '天气', '天气111', '2018-04-25 12:01:29', '', '1');
INSERT INTO `t_apk` VALUES ('2', '时间', '@@', '2018-04-27 20:24:25', '6,5,3,4,11', '1');
INSERT INTO `t_apk` VALUES ('3', '附近', '附近备注', '2018-04-27 10:01:06', '3,11,6,5', '1');
INSERT INTO `t_apk` VALUES ('4', '开心消消乐', '娱乐', '2018-04-27 12:03:54', '11,6', '1');

-- ----------------------------
-- Table structure for t_apk_bug
-- ----------------------------
DROP TABLE IF EXISTS `t_apk_bug`;
CREATE TABLE `t_apk_bug` (
  `id` int(128) unsigned NOT NULL AUTO_INCREMENT COMMENT 'apk bug表',
  `f_id` int(128) NOT NULL COMMENT '关联apk版本id',
  `bug_info` text NOT NULL COMMENT 'bug信息',
  `post_p` tinyint(4) NOT NULL COMMENT 'bug提交人',
  `relation_p` varchar(255) DEFAULT NULL COMMENT 'bug关联人员[user.id,,,]',
  `create_time` datetime NOT NULL COMMENT 'bug创建时间',
  `is_ok` tinyint(4) NOT NULL COMMENT '是否修复0未1已修复',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_apk_bug
-- ----------------------------

-- ----------------------------
-- Table structure for t_apk_version
-- ----------------------------
DROP TABLE IF EXISTS `t_apk_version`;
CREATE TABLE `t_apk_version` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT COMMENT 'apk版本表',
  `f_id` int(12) NOT NULL COMMENT '关联apk.id',
  `address` varchar(255) NOT NULL COMMENT '版本地址',
  `version` varchar(20) NOT NULL COMMENT '版本号',
  `post_statu` smallint(1) NOT NULL DEFAULT '0' COMMENT '发布状态0未发布1已发布',
  `post_people` varchar(40) NOT NULL COMMENT '发布人员',
  `test_statu` smallint(1) NOT NULL DEFAULT '0' COMMENT '测试状态0未测试1测试中2测试通过3测试不通过4取消测试',
  `create_time` datetime NOT NULL COMMENT '版本创建时间',
  `update_info` text NOT NULL COMMENT '更新信息',
  `create_people` varchar(40) DEFAULT '' COMMENT '创建人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_apk_version
-- ----------------------------
INSERT INTO `t_apk_version` VALUES ('1', '2', 'www.baidu.com', '1.0.1', '0', '肖健雄', '0', '2018-04-17 16:33:49', '1.哈哈', '肖健雄');
INSERT INTO `t_apk_version` VALUES ('2', '2', 'www.baidu.com', '1.0.2', '0', '肖健雄', '0', '2018-04-19 16:51:11', '1.的点点滴滴', '肖健雄');

-- ----------------------------
-- Table structure for t_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `t_auth_group`;
CREATE TABLE `t_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组表-权限',
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_auth_group
-- ----------------------------
INSERT INTO `t_auth_group` VALUES ('1', '超级管理员', '1', '1,2,3,4,5,6,7,8,9,10,11,12,13');
INSERT INTO `t_auth_group` VALUES ('2', '产品经理', '1', '1,2,9,8,7,6,10,11,12,13');

-- ----------------------------
-- Table structure for t_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `t_auth_group_access`;
CREATE TABLE `t_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL COMMENT '用户-权限组关联表',
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_auth_group_access
-- ----------------------------
INSERT INTO `t_auth_group_access` VALUES ('1', '1');
INSERT INTO `t_auth_group_access` VALUES ('2', '2');
INSERT INTO `t_auth_group_access` VALUES ('3', '2');

-- ----------------------------
-- Table structure for t_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `t_auth_rule`;
CREATE TABLE `t_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '基本权限规则表',
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_auth_rule
-- ----------------------------
INSERT INTO `t_auth_rule` VALUES ('1', 'Login/login', '登录', '1', '1', '');
INSERT INTO `t_auth_rule` VALUES ('2', 'Index/index', '首页', '1', '1', '');
INSERT INTO `t_auth_rule` VALUES ('9', 'ProgramList/edit', '修改方案页面', '1', '1', '');
INSERT INTO `t_auth_rule` VALUES ('8', 'Program/programm', '方案管理页面', '1', '1', '');
INSERT INTO `t_auth_rule` VALUES ('7', 'ProgramList/programList', '方案管理列表显示页面', '1', '1', '');
INSERT INTO `t_auth_rule` VALUES ('6', 'Login/logout', '退出', '1', '1', '');
INSERT INTO `t_auth_rule` VALUES ('10', 'ProgramList/addprogram', '添加方案', '1', '1', '');
INSERT INTO `t_auth_rule` VALUES ('11', 'Program/delList', 'ajax删除方案', '1', '1', '');
INSERT INTO `t_auth_rule` VALUES ('12', 'Program/modpage', '修改方案的页面', '1', '1', '');
INSERT INTO `t_auth_rule` VALUES ('13', 'Program/suremod', '确认修改方案', '1', '1', '');

-- ----------------------------
-- Table structure for t_a_test_case
-- ----------------------------
DROP TABLE IF EXISTS `t_a_test_case`;
CREATE TABLE `t_a_test_case` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT COMMENT 'apk测试用例表',
  `f_id` varchar(255) DEFAULT NULL COMMENT '所属的apk，一对多[apk.id,,,]',
  `example` varchar(255) DEFAULT NULL COMMENT 'apk测试用例',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_a_test_case
-- ----------------------------

-- ----------------------------
-- Table structure for t_firmware
-- ----------------------------
DROP TABLE IF EXISTS `t_firmware`;
CREATE TABLE `t_firmware` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'firmware固件表',
  `name` varchar(40) NOT NULL COMMENT '固件名称',
  `remark` varchar(255) DEFAULT NULL COMMENT '固件备注',
  `create_time` datetime NOT NULL COMMENT '固件创建时间',
  `f_model` varchar(255) NOT NULL COMMENT '父级模型，一对多关联[model.id,,,]',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_firmware
-- ----------------------------

-- ----------------------------
-- Table structure for t_firmware_bug
-- ----------------------------
DROP TABLE IF EXISTS `t_firmware_bug`;
CREATE TABLE `t_firmware_bug` (
  `id` int(128) unsigned NOT NULL AUTO_INCREMENT COMMENT '固件bug表',
  `f_id` int(128) NOT NULL COMMENT '关联固件firmware.version.id',
  `bug_info` text NOT NULL COMMENT '固件bug信息',
  `post_p` tinyint(4) NOT NULL COMMENT '固件bug提交人员',
  `relation_p` varchar(255) DEFAULT NULL COMMENT '固件bug关联人员[user.id]',
  `create_time` datetime NOT NULL COMMENT '固件bug创建时间',
  `is_ok` tinyint(255) NOT NULL COMMENT '是否修复0未修复1已修复',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_firmware_bug
-- ----------------------------

-- ----------------------------
-- Table structure for t_firmware_version
-- ----------------------------
DROP TABLE IF EXISTS `t_firmware_version`;
CREATE TABLE `t_firmware_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '固件版本表',
  `f_id` int(11) DEFAULT NULL COMMENT '关联固件firmware.id',
  `address` varchar(255) DEFAULT NULL COMMENT '固件地址',
  `version` varchar(40) NOT NULL COMMENT '版本号',
  `post_statu` tinyint(4) NOT NULL COMMENT '发布状态0未1已',
  `post_people` varchar(40) DEFAULT NULL COMMENT '发布人员',
  `test_statu` tinyint(4) NOT NULL COMMENT '测试状态0未测1测试通过2测试不通过',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_firmware_version
-- ----------------------------

-- ----------------------------
-- Table structure for t_f_test_case
-- ----------------------------
DROP TABLE IF EXISTS `t_f_test_case`;
CREATE TABLE `t_f_test_case` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT COMMENT '固件测试用例表',
  `f_id` varchar(200) DEFAULT NULL COMMENT '属于哪个固件，一对多，[firmware.id]',
  `example` text COMMENT '测试用例',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_f_test_case
-- ----------------------------

-- ----------------------------
-- Table structure for t_model
-- ----------------------------
DROP TABLE IF EXISTS `t_model`;
CREATE TABLE `t_model` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT COMMENT '模型表',
  `name` varchar(100) NOT NULL COMMENT '型号名称',
  `remark` varchar(255) DEFAULT NULL COMMENT '型号备注',
  `f_program` int(12) NOT NULL COMMENT '所属方案 关联program.id',
  `asso_person` varchar(255) DEFAULT NULL COMMENT '关联人员[a,b,c]方式',
  `create_time` datetime DEFAULT NULL COMMENT '型号创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_model
-- ----------------------------
INSERT INTO `t_model` VALUES ('3', 'XX111', '完美', '9', '1,2,3', '2018-04-24 10:17:20');
INSERT INTO `t_model` VALUES ('4', 'XX112', '所得到的', '9', '', '2018-04-24 11:52:04');
INSERT INTO `t_model` VALUES ('5', 'XX113', '牛啊', '9', '1,2,3', '2018-04-24 11:52:57');
INSERT INTO `t_model` VALUES ('6', 'RK3328-A', 'RK33', '11', '2', '2018-04-24 17:05:46');
INSERT INTO `t_model` VALUES ('11', 'zxc', '啥', '9', '1,6,7', '2018-04-25 10:28:35');

-- ----------------------------
-- Table structure for t_program
-- ----------------------------
DROP TABLE IF EXISTS `t_program`;
CREATE TABLE `t_program` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT COMMENT '方案表',
  `name` varchar(40) NOT NULL COMMENT '方案名称',
  `create_time` datetime NOT NULL COMMENT '方案创建时间',
  `remark` varchar(255) DEFAULT NULL COMMENT '方案创建时备注',
  `bodyid` int(12) NOT NULL COMMENT '方案创建人 关联user.id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_program
-- ----------------------------
INSERT INTO `t_program` VALUES ('9', 'H8', '2018-04-23 14:24:18', '台湾', '1');
INSERT INTO `t_program` VALUES ('11', 'RK3328', '2018-04-24 17:05:03', '啦啦', '1');

-- ----------------------------
-- Table structure for t_user
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户表',
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `nickname` varchar(100) NOT NULL COMMENT '昵称',
  `password` char(32) NOT NULL COMMENT '密码',
  `create_time` bigint(100) NOT NULL COMMENT '用户创建时间',
  `last_time` bigint(100) DEFAULT NULL COMMENT '最后一次登录时间',
  `last_ip` varchar(20) DEFAULT NULL COMMENT '最后一次登录的ip',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_user
-- ----------------------------
INSERT INTO `t_user` VALUES ('1', 'admin', '肖健雄', 'e10adc3949ba59abbe56e057f20f883e', '1524123539', '1524123539', '113.116.48.229');
INSERT INTO `t_user` VALUES ('2', 'kefu', 'kefu', 'e10adc3949ba59abbe56e057f20f883e', '1524123539', '1524123539', '113.116.48.229');
INSERT INTO `t_user` VALUES ('3', '123456', '阿萨德', 'e10adc3949ba59abbe56e057f20f883e', '1524123539', null, null);
INSERT INTO `t_user` VALUES ('4', '1', '撒旦法', 'e10adc3949ba59abbe56e057f20f883e', '1524123539', null, null);
INSERT INTO `t_user` VALUES ('5', '2', '沙发斯蒂芬', 'e10adc3949ba59abbe56e057f20f883e', '0', null, null);
INSERT INTO `t_user` VALUES ('6', '3', '发斯蒂芬', 'e10adc3949ba59abbe56e057f20f883e', '0', null, null);
INSERT INTO `t_user` VALUES ('7', '4', '芬', 'e10adc3949ba59abbe56e057f20f883e', '0', null, null);
SET FOREIGN_KEY_CHECKS=1;
