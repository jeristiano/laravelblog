/*
Navicat MySQL Data Transfer

Source Server         : laravel
Source Server Version : 50709
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50709
File Encoding         : 65001

Date: 2017-02-14 17:50:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bg_article
-- ----------------------------
DROP TABLE IF EXISTS `bg_article`;
CREATE TABLE `bg_article` (
  `art_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '//文章id',
  `art_title` varchar(100) DEFAULT NULL COMMENT '//文章标题',
  `art_tag` varchar(100) DEFAULT NULL COMMENT '文章标签',
  `art_description` varchar(255) DEFAULT NULL COMMENT '文章描述',
  `art_thumb` varchar(255) DEFAULT NULL COMMENT '文章缩略图',
  `art_content` text COMMENT '文章内容',
  `art_view` int(11) DEFAULT '1' COMMENT '文章查看次数',
  `created_at` varchar(15) DEFAULT NULL COMMENT '发布时间',
  `art_editor` varchar(50) DEFAULT NULL COMMENT '更新时间',
  `cate_id` int(11) DEFAULT NULL,
  `updated_at` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`art_id`),
  KEY `tags` (`art_tag`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Records of bg_article
-- ----------------------------
INSERT INTO `bg_article` VALUES ('14', '西西弗的神话', '哲学', '《哲学家们都干了些什么?》内容简介：这是一本有趣的哲学简明史，也是人类最厉害的天才们自我折磨的历史。哲学家们只想在思考中寻找终极真理，但在他们的争吵中，世界却意外地被改变。现在，就让我们跟随作者的笔触，走进这些天才们的精神世界，做一次轻松幽默的哲学之旅吧。', '20170120172518460.jpg', '<p><span style=\"color: rgb(17, 17, 17); font-family: Arial, Helvetica, sans-serif; font-size: 13px; line-height: 23.4px; white-space: pre-wrap; widows: 1; background-color: rgb(255, 255, 255);\">加缪的名篇《西西弗的神话》里讲述了一个希腊神话，说西西弗被众神惩罚，把一个巨石推向山顶。但是石头一到山顶，马上又自己滚下来。西西弗必须再次重复这苦役，一直到永远。这很像是咱们神话传说里砍树的吴刚。加缪用这个例子来说明我们生活的荒谬。就像工人每天重复同样的工作，却不知道自己工作的意义何在一样(马克思也有类似的观点)。\r\n但加缪说，西西弗的胜利在于，他意识到了这种荒谬，以乐观的方式对待这种荒谬。虽然他无法改变自己的处境，但是由于对待处境的方式变了，他也就成为了生活的胜利者。加缪对待荒谬的解决方法，我们可以只作个参考。\r\n我觉得值得注意的是他对荒谬生活的比喻。在生活中，我们处处可以找到类似的情景。比如我们生于消费时代，很多人把得到某种物质享乐当做了生活目标。每天辛苦工作、忍受痛苦，为的是买一套房子、一辆车。当这些目标实现之后，人自然而然地又会生出新的目标，仍旧需要为了这个目标忍受痛苦。 这种处境就很像西西弗，但是有很多人意识不到这种生活的荒谬，为了追求物质不仅耗费了毕生的精力，也给自己带来了无尽的痛苦。而且即便我们意识到生活的荒谬，我们就像西西弗一样，很难彻底改变这种处境。很多人都说钱乃身外之物，谁又能真的放弃一切物质享受呢？</span></p>', '13', '1484904387', '林新浩', '12', '1486372653');

-- ----------------------------
-- Table structure for bg_category
-- ----------------------------
DROP TABLE IF EXISTS `bg_category`;
CREATE TABLE `bg_category` (
  `cate_id` int(11) NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(50) DEFAULT NULL,
  `cate_title` varchar(255) DEFAULT NULL,
  `cate_keywords` varchar(255) DEFAULT NULL,
  `cate_description` varchar(255) DEFAULT NULL,
  `cate_view` int(8) DEFAULT '0',
  `cate_order` tinyint(4) DEFAULT '0' COMMENT '排序',
  `cate_pid` int(11) DEFAULT NULL,
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='文章分类';

-- ----------------------------
-- Records of bg_category
-- ----------------------------
INSERT INTO `bg_category` VALUES ('9', '杂谈', '杂谈', '杂谈', '', '1', '3', '0');
INSERT INTO `bg_category` VALUES ('10', '经济学', '经济学', '杂谈 经济学', '', '1', '0', '9');
INSERT INTO `bg_category` VALUES ('11', '学习', '学习', '学习', '', '0', '0', '0');
INSERT INTO `bg_category` VALUES ('12', '生活', '生活', '生活', '', '3', '2', '0');

-- ----------------------------
-- Table structure for bg_config
-- ----------------------------
DROP TABLE IF EXISTS `bg_config`;
CREATE TABLE `bg_config` (
  `conf_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_name` varchar(50) DEFAULT NULL COMMENT '名称',
  `conf_content` varchar(255) DEFAULT NULL COMMENT '内容',
  `conf_order` int(2) DEFAULT NULL COMMENT '排序',
  `conf_title` varchar(100) DEFAULT NULL COMMENT '标题',
  `field_type` varchar(20) DEFAULT NULL COMMENT '类型',
  `field_value` varchar(255) DEFAULT NULL COMMENT '值',
  `conf_tips` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`conf_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bg_config
-- ----------------------------
INSERT INTO `bg_config` VALUES ('6', 'description', '目的虽有，却无路可循，我们称之为路的无非是踌躇.', '3', '网站描述', 'textarea', '', '网站描述');
INSERT INTO `bg_config` VALUES ('3', 'web_title', '苏客blog', '0', '网站标题', 'input', '', '网站的标题');
INSERT INTO `bg_config` VALUES ('4', 'seo_title', '一块红布', '1', '辅助标题', 'input', '', '辅助标题');
INSERT INTO `bg_config` VALUES ('5', 'keywords', '红布,苏客,博客,卡夫卡', '2', '关键词', 'input', '', '关键词');
INSERT INTO `bg_config` VALUES ('7', 'copyright', 'Copyright@2017 Powered by Jeristiano <a href=\'https://github.com/jeristiano\' target=\'_blank\'>https://github.com/jeristiano</a>', '4', '版权信息', 'textarea', '', '版权信息');
INSERT INTO `bg_config` VALUES ('8', 'web_count', '', '5', '网站统计', 'textarea', '', '网站统计');

-- ----------------------------
-- Table structure for bg_links
-- ----------------------------
DROP TABLE IF EXISTS `bg_links`;
CREATE TABLE `bg_links` (
  `lk_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '链接id',
  `lk_title` varchar(40) DEFAULT NULL COMMENT '链接标题',
  `lk_url` varchar(255) DEFAULT NULL COMMENT '链接网址',
  `lk_name` varchar(40) DEFAULT NULL COMMENT '链接名字',
  `lk_order` int(2) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`lk_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bg_links
-- ----------------------------
INSERT INTO `bg_links` VALUES ('1', '1', '1', '1', '0');
INSERT INTO `bg_links` VALUES ('2', '11', '11', '11', '1');
INSERT INTO `bg_links` VALUES ('3', '22', '22', '122', '3');

-- ----------------------------
-- Table structure for bg_navi
-- ----------------------------
DROP TABLE IF EXISTS `bg_navi`;
CREATE TABLE `bg_navi` (
  `nv_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `nv_name` varchar(50) DEFAULT NULL COMMENT '导航名',
  `nv_alias` varchar(50) DEFAULT NULL COMMENT '导航别名',
  `nv_url` varchar(255) DEFAULT NULL COMMENT '导航地址',
  `nv_order` int(2) DEFAULT NULL,
  PRIMARY KEY (`nv_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bg_navi
-- ----------------------------
INSERT INTO `bg_navi` VALUES ('1', '首页', 'homepage', 'http://blog.hd/laravel/admin/index', '0');
INSERT INTO `bg_navi` VALUES ('2', '关于我', 'about me', '', '1');
INSERT INTO `bg_navi` VALUES ('3', '慢生活', 'life', '', '2');
INSERT INTO `bg_navi` VALUES ('4', '闲言碎语', 'words', '', '3');
INSERT INTO `bg_navi` VALUES ('5', '模板分享', 'share', '', '4');
INSERT INTO `bg_navi` VALUES ('6', '学无止境', 'knowledge', '', '5');
INSERT INTO `bg_navi` VALUES ('7', '留言板', 'msssage', '', '6');

-- ----------------------------
-- Table structure for bg_user
-- ----------------------------
DROP TABLE IF EXISTS `bg_user`;
CREATE TABLE `bg_user` (
  `user_id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='后台管理员';

-- ----------------------------
-- Records of bg_user
-- ----------------------------
INSERT INTO `bg_user` VALUES ('1', 'root', 'eyJpdiI6Ik1vMlwvc1dWaU1BWlQ1MFFGZnI4NUZ3PT0iLCJ2YWx1ZSI6InBXMTA2YU5zRnd2aDg3T2VaMTdJb1E9PSIsIm1hYyI6IjBjOTk0MTQ4OGM4M2YzNjhmNDVmNjkxZjQxYjIxMjEwYzA2NWUyMWRjMjVmNzNhNThjOWEyZmE4N2IyYTM2NmYifQ==');
