--
-- 表的结构 `edd_imgs`
--

CREATE TABLE IF NOT EXISTS `edd_imgs` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`img_size` varchar(255) DEFAULT NULL,
`upload_date` varchar(255) DEFAULT NULL COMMENT '上传日期',
`user_id` varchar(255) DEFAULT NULL COMMENT '操作者',
`ip` varchar(255) DEFAULT NULL COMMENT '操作ip',
`img_path` varchar(255) DEFAULT NULL COMMENT '图片路径',
`type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '来源0-本地1-七牛',
PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='图片管理' AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `edd_log`
--

CREATE TABLE IF NOT EXISTS `edd_log` (
`log_id` int(11) NOT NULL AUTO_INCREMENT,
`content` text,
`log_time` int(11) DEFAULT NULL,
`from_id` varchar(255) DEFAULT NULL,
PRIMARY KEY (`log_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='操作日志记录' AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `edd_log`
--

INSERT INTO `edd_log` (`log_id`, `content`, `log_time`, `from_id`) VALUES
(13, '管理员编辑提交', 1490085875, '13'),
(14, '管理员编辑提交', 1490085928, '13'),
(15, '管理员编辑提交', 1490086060, '13'),
(16, '管理员编辑提交', 1490086067, '13'),
(17, '管理员编辑提交', 1490086113, '13'),
(18, '管理员编辑提交', 1490086118, '13'),
(19, '管理员编辑提交', 1491459715, '13');

-- --------------------------------------------------------

--
-- 表的结构 `edd_menu`
--

CREATE TABLE IF NOT EXISTS `edd_menu` (
`id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
`parentid` smallint(6) unsigned NOT NULL DEFAULT '0',
`module` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '模块',
`controller` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '控制器',
`method` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '操作名称',
`data` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '额外参数',
`type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '菜单类型 1：权限认证；0：只作为菜单',
`status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态，1显示，0禁用',
`name` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '菜单名称',
`icon` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT '菜单图标',
`remark` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '备注',
`listorder` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '排序ID',
`nav_list` varchar(255) CHARACTER SET utf8 DEFAULT '0' COMMENT '层级关系',
PRIMARY KEY (`id`),
KEY `status` (`status`),
KEY `parentid` (`parentid`),
KEY `model` (`controller`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='后台菜单表' AUTO_INCREMENT=348 ;

--
-- 转存表中的数据 `edd_menu`
--

INSERT INTO `edd_menu` (`id`, `parentid`, `module`, `controller`, `method`, `data`, `type`, `status`, `name`, `icon`, `remark`, `listorder`, `nav_list`) VALUES
(211, 249, 'admin', 'core.Menu', 'home_page', '', 0, 1, '后台菜单', 'fa fa-sitemap', '', 2, '249-211'),
(216, 0, 'admin', 'Default', 'default', '', 0, 1, '管理组', 'fa fa-users', '12323', 0, '216'),
(217, 216, 'admin', 'core.Admin', 'home_page', '', 0, 1, '管理员', 'fa fa-user', '', 0, '216-217'),
(218, 216, 'admin', 'core.Role', 'home_page', '', 0, 1, '角色管理', 'fa fa-map-marker', '', 0, '216-218'),
(249, 0, 'admin', 'Default', 'default', '', 0, 1, '设置', 'fa fa-gears', '', 0, '249'),
(250, 249, 'admin', 'core.Setting', 'home_page', '', 0, 1, '网站信息', 'fa fa-cog', '', 0, '249-250'),
(252, 249, 'admin', 'core.Dblist', 'home_page', '', 0, 1, '数据库备份', 'fa fa-cloud-download', '', 0, '249-252'),
(265, 0, 'admin', 'Default', 'default', '', 0, 1, '公告管理', 'fa fa-rss-square', '', 0, '265'),
(266, 265, 'admin', 'core.Posts', 'home_page_posts', '', 0, 1, '文章管理', 'fa fa-file-text', '', 0, '265-266'),
(267, 265, 'admin', 'core.Posts', 'home_page_term', '', 0, 1, '文章分类', 'fa fa-code-fork', '', 0, '265-267'),
(304, 249, 'admin', 'core.Imgs', 'home_page', '', 0, 1, '系统图库', 'glyphicon glyphicon-picture', '', 0, '249-304'),
(305, 217, 'admin', 'core.Admin', 'add_think', '', 1, 1, '管理员添加逻辑', '', '', 0, '216-217-305'),
(306, 217, 'admin', 'core.Admin', 'edit_think', '', 1, 1, '管理员编辑逻辑', '', '', 0, '216-217-306'),
(307, 217, 'admin', 'core.Admin', 'del_think', '', 1, 1, '管理员删除逻辑', '', '', 0, '216-217-307'),
(308, 218, 'admin', 'core.Role', 'add_think', '', 1, 1, '角色添加逻辑', '', '', 0, '216-218-308'),
(309, 218, 'admin', 'core.Role', 'del_think', '', 1, 1, '角色删除逻辑', '', '', 0, '216-218-309'),
(310, 218, 'admin', 'core.Role', 'edit_think', '', 1, 1, '角色编辑逻辑', '', '', 0, '216-218-310'),
(311, 250, 'admin', 'core.Setting', 'save_sites', '', 1, 1, '存储网站配置信息', '', '', 0, '249-250-311'),
(312, 250, 'admin', 'core.Setting', 'save_seo', '', 1, 1, '存储完整seo', '', '', 0, '249-250-312'),
(313, 266, 'admin', 'core.Posts', 'edit_think_posts', '', 1, 1, '文章编辑逻辑', '', '', 0, '265-266-313'),
(314, 266, 'admin', 'core.Posts', 'del_think_posts', '', 1, 1, '文章删除逻辑', '', '', 0, '265-266-314'),
(315, 266, 'admin', 'core.Posts', 'add_think_posts', '', 1, 1, '文章添加逻辑', '', '', 0, '265-266-315'),
(316, 211, 'admin', 'core.Menu', 'del_think', '', 1, 1, '后台菜单删除逻辑', '', '', 0, '249-211-316'),
(317, 211, 'admin', 'core.Menu', 'add_think', '', 1, 1, '后台菜单添加逻辑', '', '', 0, '249-211-317'),
(318, 211, 'admin', 'core.Menu', 'edit_think', '', 1, 1, '后台菜单编辑逻辑', '', '', 0, '249-211-318'),
(319, 252, 'admin', 'core.Dblist', 'export_more', '', 1, 1, '多表导出逻辑', '', '', 0, '249-252-319'),
(320, 252, 'admin', 'core.Dblist', 'export_one', '', 1, 1, '单表导出逻辑', '', '', 0, '249-252-320'),
(321, 252, 'admin', 'core.Dblist', 'del', '', 1, 1, '删除文件', '', '', 0, '249-252-321'),
(322, 304, 'admin', 'core.Imgs', 'del_think', '', 1, 1, '删除图库文件', '', '', 0, '249-304-322'),
(323, 267, 'admin', 'core.Posts', 'add_think_term', '', 1, 1, '文章分类添加逻辑', '', '', 0, '265-267-323'),
(324, 267, 'admin', 'core.Posts', 'del_think_term', '', 1, 1, '文章分类删除逻辑', '', '', 0, '265-267-324'),
(325, 267, 'admin', 'core.Posts', 'edit_think_term', '', 1, 1, '文章分类编辑逻辑', '', '', 0, '265-267-325'),
(326, 328, 'admin', 'core.Upload', 'upload_sigle', '', 1, 1, '单图片上传逻辑', '', '', 0, '328-326'),
(327, 328, 'admin', 'core.Upload', 'del_sigle_file', '', 1, 1, '单图片删除逻辑', '', '', 0, '328-327'),
(328, 0, 'admin', 'Default', 'default', '', 0, 0, '功能模块', '', '', 0, '328'),
(329, 252, 'admin', 'core.Dblist', 'download', '', 1, 1, '数据文件下载', '', '', 0, '249-252-329'),
(330, 252, 'admin', 'core.Dblist', 'restore', '', 1, 1, '数据库文件执行', '', '', 0, '249-252-330'),
(331, 249, 'admin', 'core.Setting', 'plugins_home', '', 0, 1, '插件库', 'fa fa-dropbox', '微信、淘宝、短信接口参数', 0, '249-331'),
(345, 0, 'admin', 'Default', 'default', '', 0, 1, '模板', '', '', 0, '345'),
(346, 345, 'admin', 'Test', 'homePage', '', 0, 1, '模板1', '', '', 0, '345-346'),
(347, 345, 'admin', 'Test2', 'homePage', '', 0, 1, '模板2', '', '', 0, '345-347');

-- --------------------------------------------------------

--
-- 表的结构 `edd_options`
--

CREATE TABLE IF NOT EXISTS `edd_options` (
`option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`option_name` varchar(64) CHARACTER SET utf8 NOT NULL COMMENT '配置名',
`option_value` longtext CHARACTER SET utf8 NOT NULL COMMENT '配置值',
`autoload` int(2) NOT NULL DEFAULT '1' COMMENT '是否自动加载',
`is_close` tinyint(3) NOT NULL DEFAULT '0' COMMENT '1开启网站，0关闭网站',
PRIMARY KEY (`option_id`),
UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='全站配置表' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `edd_options`
--

INSERT INTO `edd_options` (`option_id`, `option_name`, `option_value`, `autoload`, `is_close`) VALUES
(1, 'member_email_active', '{"title":"ThinkCMF\\u90ae\\u4ef6\\u6fc0\\u6d3b\\u901a\\u77e5.","template":"<p>\\u672c\\u90ae\\u4ef6\\u6765\\u81ea<a href=\\"http:\\/\\/www.thinkcmf.com\\">ThinkCMF<\\/a><br\\/><br\\/>&nbsp; &nbsp;<strong>---------------<strong style=\\"white-space: normal;\\">---<\\/strong><\\/strong><br\\/>&nbsp; &nbsp;<strong>\\u5e10\\u53f7\\u6fc0\\u6d3b\\u8bf4\\u660e<\\/strong><br\\/>&nbsp; &nbsp;<strong>---------------<strong style=\\"white-space: normal;\\">---<\\/strong><\\/strong><br\\/><br\\/>&nbsp; &nbsp; \\u5c0a\\u656c\\u7684<span style=\\"FONT-SIZE: 16px; FONT-FAMILY: Arial; COLOR: rgb(51,51,51); LINE-HEIGHT: 18px; BACKGROUND-COLOR: rgb(255,255,255)\\">#username#\\uff0c\\u60a8\\u597d\\u3002<\\/span>\\u5982\\u679c\\u60a8\\u662fThinkCMF\\u7684\\u65b0\\u7528\\u6237\\uff0c\\u6216\\u5728\\u4fee\\u6539\\u60a8\\u7684\\u6ce8\\u518cEmail\\u65f6\\u4f7f\\u7528\\u4e86\\u672c\\u5730\\u5740\\uff0c\\u6211\\u4eec\\u9700\\u8981\\u5bf9\\u60a8\\u7684\\u5730\\u5740\\u6709\\u6548\\u6027\\u8fdb\\u884c\\u9a8c\\u8bc1\\u4ee5\\u907f\\u514d\\u5783\\u573e\\u90ae\\u4ef6\\u6216\\u5730\\u5740\\u88ab\\u6ee5\\u7528\\u3002<br\\/>&nbsp; &nbsp; \\u60a8\\u53ea\\u9700\\u70b9\\u51fb\\u4e0b\\u9762\\u7684\\u94fe\\u63a5\\u5373\\u53ef\\u6fc0\\u6d3b\\u60a8\\u7684\\u5e10\\u53f7\\uff1a<br\\/>&nbsp; &nbsp; <a title=\\"\\" href=\\"http:\\/\\/#link#\\" target=\\"_self\\">http:\\/\\/#link#<\\/a><br\\/>&nbsp; &nbsp; (\\u5982\\u679c\\u4e0a\\u9762\\u4e0d\\u662f\\u94fe\\u63a5\\u5f62\\u5f0f\\uff0c\\u8bf7\\u5c06\\u8be5\\u5730\\u5740\\u624b\\u5de5\\u7c98\\u8d34\\u5230\\u6d4f\\u89c8\\u5668\\u5730\\u5740\\u680f\\u518d\\u8bbf\\u95ee)<br\\/>&nbsp; &nbsp; \\u611f\\u8c22\\u60a8\\u7684\\u8bbf\\u95ee\\uff0c\\u795d\\u60a8\\u4f7f\\u7528\\u6109\\u5feb\\uff01<br\\/><br\\/>&nbsp; &nbsp; \\u6b64\\u81f4<br\\/>&nbsp; &nbsp; ThinkCMF \\u7ba1\\u7406\\u56e2\\u961f.<\\/p>"}', 1, 0),
                        (6, 'site_options', '{"site_name":"AlphaCMS","site_addr":"","site_admin_email":"","tel":"","icp":"","site_copyright":""}', 1, 1),
                        (7, 'site_seo', '{"seo_title":"123123123","seo_key":"Give yourself a future!,123123,asdas","seo_remark":"\\u6211\\u4e0d\\u660e\\u767d\\uff0c\\u5929\\u7a7a\\u7684\\u9634\\u973e\\uff0c\\u662f\\u4f60\\u7684\\u4f24\\u6000\\u8fd8\\u662f\\u6211\\u7684\\u60b2\\u54c0\\uff0c\\u8c01\\u66fe\\u4ece\\u8c01\\u7684\\u9752\\u6625\\u91cc\\u8d70\\u8fc7\\uff0c\\u7559\\u4e0b\\u4e86\\u7b11\\u9765\\uff0c\\u8c01\\u66fe\\u5728\\u8c01\\u7684\\u82b1\\u5b63\\u91cc\\u505c\\u7559\\uff0c\\u6e29\\u6696\\u4e86\\u60f3\\u5ff5\\uff0c\\u8c01\\u53c8\\u4ece\\u8c01\\u7684\\u96e8\\u5b63\\u91cc\\u6d88\\u5931\\uff0c\\u6cdb\\u6ee5\\u4e86\\u773c\\u6cea\\u3002"}', 1, 1);

                        -- --------------------------------------------------------

                        --
                        -- 表的结构 `edd_posts`
                        --

                        CREATE TABLE IF NOT EXISTS `edd_posts` (
                        `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                        `post_author` bigint(20) unsigned DEFAULT '0' COMMENT '发表者id',
                        `post_keywords` varchar(150) CHARACTER SET utf8 DEFAULT '' COMMENT 'seo keywords',
                        `post_source` varchar(150) CHARACTER SET utf8 DEFAULT NULL COMMENT '转载文章的来源',
                        `post_date` varchar(255) CHARACTER SET utf8 DEFAULT '' COMMENT 'post发布日期',
                        `post_content` longtext CHARACTER SET utf8 COMMENT 'post内容',
                        `post_title` text CHARACTER SET utf8 COMMENT 'post标题',
                        `post_excerpt` text CHARACTER SET utf8 COMMENT 'post摘要',
                        `post_status` int(2) DEFAULT '0' COMMENT 'post状态，1已审核，0未审核,3删除',
                        `comment_status` int(2) DEFAULT '1' COMMENT '评论状态，1允许，0不允许',
                        `post_modified` varchar(255) CHARACTER SET utf8 DEFAULT '' COMMENT 'post更新时间，可在前台修改，显示给用户',
                        `post_content_filtered` longtext CHARACTER SET utf8,
                        `post_parent` bigint(20) unsigned DEFAULT '0' COMMENT 'post的父级post id,表示post层级关系',
                        `post_type` int(2) DEFAULT '1' COMMENT 'post类型，1文章,2页面',
                        `post_mime_type` varchar(100) CHARACTER SET utf8 DEFAULT '',
                        `comment_count` bigint(20) DEFAULT '0',
                        `smeta` text CHARACTER SET utf8 COMMENT 'post的扩展字段，保存相关扩展属性，如缩略图；格式为json',
                        `post_hits` int(11) DEFAULT '0' COMMENT 'post点击数，查看数',
                        `post_like` int(11) DEFAULT '0' COMMENT 'post赞数',
                        `istop` tinyint(1) NOT NULL DEFAULT '0' COMMENT '置顶 1置顶； 0不置顶',
                        `recommended` tinyint(1) NOT NULL DEFAULT '0' COMMENT '推荐 1推荐 0不推荐',
                        PRIMARY KEY (`id`),
                        KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`id`),
                        KEY `post_parent` (`post_parent`),
                        KEY `post_author` (`post_author`),
                        KEY `post_date` (`post_date`) USING BTREE
                        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='Portal文章表' AUTO_INCREMENT=7 ;

                        --
                        -- 转存表中的数据 `edd_posts`
                        --

                        INSERT INTO `edd_posts` (`id`, `post_author`, `post_keywords`, `post_source`, `post_date`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `post_modified`, `post_content_filtered`, `post_parent`, `post_type`, `post_mime_type`, `comment_count`, `smeta`, `post_hits`, `post_like`, `istop`, `recommended`) VALUES
                        (6, 1, '', '', '1499226343', '<p>123</p>', '123', '123', 1, 1, '', '', 0, 1, '', 0, '{"term_relation":"24","thumb":""}', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `edd_role`
--

CREATE TABLE IF NOT EXISTS `edd_role` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '角色名称',
`pid` smallint(6) DEFAULT NULL COMMENT '父角色ID',
`status` tinyint(1) unsigned DEFAULT '0' COMMENT '0禁用 1开启',
`remark` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '备注',
`create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
`update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
`listorder` int(3) NOT NULL DEFAULT '0' COMMENT '排序字段',
`rules` text CHARACTER SET utf8 COMMENT '拥有的权限规则',
`nav_list` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '该角色对应首页导航',
PRIMARY KEY (`id`),
KEY `parentId` (`pid`),
KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='角色表' AUTO_INCREMENT=25 ;

--
-- 转存表中的数据 `edd_role`
--

INSERT INTO `edd_role` (`id`, `name`, `pid`, `status`, `remark`, `create_time`, `update_time`, `listorder`, `rules`, `nav_list`) VALUES
(23, '超级管理员', 0, 1, '', 1513757032, 1516688138, 0, '216,218,310,309,308,217,307,306,305,249,331,304,322,252,330,329,321,320,319,250,312,311,211,318,317,316,265,267,325,324,323,266,315,314,313,328,327,326', '216-217'),
(24, '运营', NULL, 1, '', 1517386880, 1517386929, 0, '216,218,310,309,308,217,307,306,305', '249-211');

-- --------------------------------------------------------

--
-- 表的结构 `edd_role_user`
--

CREATE TABLE IF NOT EXISTS `edd_role_user` (
`role_user_id` int(11) NOT NULL AUTO_INCREMENT,
`user_id` int(11) DEFAULT NULL,
`role_id` int(11) DEFAULT NULL,
PRIMARY KEY (`role_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='角色用户关联表' AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `edd_role_user`
--

INSERT INTO `edd_role_user` (`role_user_id`, `user_id`, `role_id`) VALUES
(14, 39, 2),
(15, 1, 22),
(16, 1, 23);

-- --------------------------------------------------------

--
-- 表的结构 `edd_terms`
--

CREATE TABLE IF NOT EXISTS `edd_terms` (
`term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类id',
`name` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT '分类名称',
`slug` varchar(200) CHARACTER SET utf8 DEFAULT '',
`taxonomy` varchar(32) CHARACTER SET utf8 DEFAULT NULL COMMENT '分类类型',
`description` longtext CHARACTER SET utf8 COMMENT '分类描述',
`parent` bigint(20) unsigned DEFAULT '0' COMMENT '分类父id',
`count` bigint(20) DEFAULT '0' COMMENT '分类文章数',
`path` varchar(500) CHARACTER SET utf8 DEFAULT NULL COMMENT '分类层级关系路径',
`seo_title` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
`seo_keywords` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
`seo_description` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
`list_tpl` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT '分类列表模板',
`one_tpl` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT '分类文章页模板',
`listorder` int(5) NOT NULL DEFAULT '0' COMMENT '排序',
`status` int(2) DEFAULT '1' COMMENT '状态，1发布，0不发布',
PRIMARY KEY (`term_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='Portal 文章分类表' AUTO_INCREMENT=25 ;

--
-- 转存表中的数据 `edd_terms`
--

INSERT INTO `edd_terms` (`term_id`, `name`, `slug`, `taxonomy`, `description`, `parent`, `count`, `path`, `seo_title`, `seo_keywords`, `seo_description`, `list_tpl`, `one_tpl`, `listorder`, `status`) VALUES
(24, '首页', '', '文章', 'sdfsdf213', 0, 0, '0', '', '', '', 'news', 'content', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `edd_term_relationships`
--

CREATE TABLE IF NOT EXISTS `edd_term_relationships` (
`tid` bigint(20) NOT NULL AUTO_INCREMENT,
`object_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'posts表里文章id',
`term_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '分类id',
`listorder` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
`status` int(2) NOT NULL DEFAULT '1' COMMENT '状态，1发布，0不发布',
PRIMARY KEY (`tid`),
KEY `term_taxonomy_id` (`term_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='Portal 文章分类对应表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `edd_term_relationships`
--

INSERT INTO `edd_term_relationships` (`tid`, `object_id`, `term_id`, `listorder`, `status`) VALUES
(2, 6, 24, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `edd_test`
--

CREATE TABLE IF NOT EXISTS `edd_test` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-one 1-two 2-three',
`name` varchar(8) DEFAULT NULL,
`c_time` INT (11) DEFAULT '0' COMMENT '创建时间',
`u_time` INT (11) DEFAULT '0' COMMENT '编辑时间',
`d_time` INT (11) DEFAULT '0' COMMENT '软删除',
PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='模板表,其余表按这张表字段编写' AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `edd_test`
--

INSERT INTO `edd_test` (`id`, `type`, `c_time`, `u_time`, `d_time`, `name`) VALUES
(1, 0, 1499229055, '', '', ''),
(2, 1, 1499229055, '', '', ''),
(3, 0, 1499229055, '', '', ''),
(4, 1, 1499229055, '', '', ''),
(5, 0, 1499229055, '', '', ''),
(6, 1, 1499229055, '', '', ''),
(7, 0, 1499229055, '', '', ''),
(8, 1, 1499229055, '', '', ''),
(9, 0, 1499229055, '', '', ''),
(10, 1, 1499229055, '', '', ''),
(11, 0, 1499229055, '', '', ''),
(12, 1, 1499229055, '', '', ''),
(13, 0, 1499229055, '', '', ''),
(17, 0, 1516688852, '', '', '345345');

-- --------------------------------------------------------

--
-- 表的结构 `edd_users`
--

CREATE TABLE IF NOT EXISTS `edd_users` (
`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`user_login` varchar(60) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '用户名',
`avatar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
`user_pass` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '登录密码；sp_password加密',
`user_pass_salt` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '密码验证',
`user_nicename` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '用户美名',
`user_email` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '登录邮箱',
`last_login_ip` varchar(16) CHARACTER SET utf8 DEFAULT NULL COMMENT '最后登录ip',
`last_login_time` varchar(255) CHARACTER SET utf8 DEFAULT '0' COMMENT '最后登录时间',
`update_time` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0' COMMENT '更新时间',
`create_time` varchar(255) CHARACTER SET utf8 DEFAULT '0' COMMENT '注册时间',
`user_status` int(11) NOT NULL DEFAULT '0' COMMENT '用户状态 0：禁用； 1：正常 ；2：未验证',
`mobile` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '' COMMENT '手机号',
`user_hits` int(11) DEFAULT '0' COMMENT '登陆次数',
PRIMARY KEY (`id`),
KEY `user_login_key` (`user_login`),
KEY `user_nicename` (`user_nicename`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='用户表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `edd_users`
--

INSERT INTO `edd_users` (`id`, `user_login`, `avatar`, `user_pass`, `user_pass_salt`, `user_nicename`, `user_email`, `last_login_ip`, `last_login_time`, `update_time`, `create_time`, `user_status`, `mobile`, `user_hits`) VALUES
(1, 'admin', '', 'f354bc916f4979959bb4c274e8e92976', 'aZKZBygJtL', 'admin', 'dc_wen663@163.com', '127.0.0.1', '1517386997', '1517207080', '1489155324', 1, '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `edd_widgets`
--

CREATE TABLE IF NOT EXISTS `edd_widgets` (
`wid_id` int(11) NOT NULL AUTO_INCREMENT,
`wid_params` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '参数',
`wid_color` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '模块颜色',
`wid_icon` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '模块图标',
`wid_date` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '模块时间',
`wid_admin` int(11) DEFAULT NULL COMMENT '操作者',
`wid_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '插件名字',
`wid_key` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '插件关键词',
PRIMARY KEY (`wid_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='插件表' AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `edd_widgets`
--

INSERT INTO `edd_widgets` (`wid_id`, `wid_params`, `wid_color`, `wid_icon`, `wid_date`, `wid_admin`, `wid_name`, `wid_key`) VALUES
(10, 'api_key=78aac6166f2318bd2eaceae0fba6aa84|sign=marsmob', 'default', 'fa fa-comments-o', '1499931295', 1, '短信接口', 'msn'),
(11, 'url=https://captcha.luosimao.com/api/site_verify|api_key=fbdd90fa23bf05f970badd9a7fde8d0b|site_key=19d4e7396b5bda1e1db0442b9d28219d', 'info', 'fa fa-cogs', '1501487859', 1, '螺丝帽验证接口', 'lsm_verify'),
(12, 'ak=YwBMfAjdDqGQMWrwWgQrkHoES8h_sfQ4oJT7esdG|sk=b-laMNJSLbOyGj-W7qfyFOGWEtvinnaeOLZtAs2-|bucket=alphacms|cdn=p2otxz81j.bkt.clouddn.com', 'success', 'fa fa-thermometer-0', '1516242221', 1, '七牛', 'qiniu');