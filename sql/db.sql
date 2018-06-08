SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for txl_guid_quanxian
-- ----------------------------
DROP TABLE IF EXISTS `txl_guid_quanxian`;
CREATE TABLE `txl_guid_quanxian` (
  `GUID` char(36) NOT NULL,
  `USER_ID` varchar(50) DEFAULT NULL,
  `QUAN_XIAN` int(1) DEFAULT NULL,
  `ZU_ID` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`GUID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for txl_jichushuju
-- ----------------------------
DROP TABLE IF EXISTS `txl_jichushuju`;
CREATE TABLE `txl_jichushuju` (
  `GUID` char(36) NOT NULL,
  `XING_MING` varchar(50) NOT NULL,
  `XIANG_MU` varchar(100) NOT NULL,
  `NEI_RONG` text NOT NULL,
  PRIMARY KEY (`GUID`,`XIANG_MU`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for txl_user
-- ----------------------------
DROP TABLE IF EXISTS `txl_user`;
CREATE TABLE `txl_user` (
  `USER_ID` varchar(50) NOT NULL,
  `USER_NAME` varchar(50) NOT NULL,
  `PASS` varchar(50) NOT NULL,
  `USER_TYPE` decimal(1,0) NOT NULL,
  `FAILED_LOGINS` decimal(1,0) DEFAULT NULL,
  `JOIN_DATE` datetime DEFAULT NULL,
  `LAST_LOGIN` datetime DEFAULT NULL,
  `LAST_IP` varchar(15) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`USER_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for txl_user_zu
-- ----------------------------
DROP TABLE IF EXISTS `txl_user_zu`;
CREATE TABLE `txl_user_zu` (
  `USER_ID` varchar(50) NOT NULL,
  `ZU_ID` varchar(50) NOT NULL,
  PRIMARY KEY (`USER_ID`,`ZU_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for txl_yuyan
-- ----------------------------
DROP TABLE IF EXISTS `txl_yuyan`;
CREATE TABLE `txl_yuyan` (
  `YE_MIAN_MING` varchar(50) NOT NULL,
  `YU_ZHONG` varchar(2) NOT NULL,
  `XU_HAO` varchar(50) NOT NULL,
  `WEN_ZI` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`YE_MIAN_MING`,`YU_ZHONG`,`XU_HAO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for txl_zu
-- ----------------------------
DROP TABLE IF EXISTS `txl_zu`;
CREATE TABLE `txl_zu` (
  `ZU_ID` varchar(50) NOT NULL,
  `PARENT_ID` varchar(50) DEFAULT NULL,
  `ZU_NAME` varchar(50) NOT NULL,
  PRIMARY KEY (`ZU_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `txl_user` (`USER_ID`, `USER_NAME`, `PASS`, `USER_TYPE`, `FAILED_LOGINS`, `JOIN_DATE`, `LAST_LOGIN`, `LAST_IP`, `EMAIL`) VALUES ('admin', 'admin', 'c3284d0f94606de1fd2af172aba15bf3', '2', NULL, '2000-01-01 12:05:49', NULL, NULL, '');
INSERT INTO `txl_user_zu` (`USER_ID`, `ZU_ID`) VALUES ('admin', '0');
INSERT INTO `txl_zu` (`ZU_ID`, `PARENT_ID`, `ZU_NAME`) VALUES ('0', NULL, '通讯录系统 - GABS');
INSERT INTO `txl_zu` (`ZU_ID`, `PARENT_ID`, `ZU_NAME`) VALUES ('1', '0', 'A公司');
INSERT INTO `txl_zu` (`ZU_ID`, `PARENT_ID`, `ZU_NAME`) VALUES ('2', '0', 'B公司');
INSERT INTO `txl_zu` (`ZU_ID`, `PARENT_ID`, `ZU_NAME`) VALUES ('1001', '1', '技术部');
INSERT INTO `txl_zu` (`ZU_ID`, `PARENT_ID`, `ZU_NAME`) VALUES ('1002', '1', '财务部');
INSERT INTO `txl_zu` (`ZU_ID`, `PARENT_ID`, `ZU_NAME`) VALUES ('1001001', '1001', '研发组');
INSERT INTO `txl_zu` (`ZU_ID`, `PARENT_ID`, `ZU_NAME`) VALUES ('1001002', '1001', '运维组');

INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('account', 'CN', '通讯录', '通讯录');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('account', 'CN', '密码', '密码');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('account', 'CN', '用户名', '用户名');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('account', 'CN', '登录', '登录');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('account', 'EN', '通讯录', 'GABS');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('account', 'EN', '密码', 'Password');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('account', 'EN', '用户名', 'Username');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('account', 'EN', '登录', 'Login');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiangZuIframe', 'CN', '修改', '修改');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiangZuIframe', 'EN', '修改', 'Change');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiangZuIframe', 'CN', '取消', '取消');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiangZuIframe', 'EN', '取消', 'Cancel');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'CN', '保存编辑', '保存编辑');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'EN', '保存编辑', 'Save Change');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'CN', '批量修改组', '批量修改组');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'EN', '批量修改组', 'Batch Edit Group');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'CN', '批量修改权限', '批量修改权限');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'EN', '批量修改权限', 'Batch Edit Permissions');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'CN', '批量删除', '批量删除');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'EN', '批量删除', 'Batch Delete');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiangQuanxianIframe', 'CN', '权限', '权限');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiangQuanxianIframe', 'EN', '权限', 'Permissions');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiangQuanxianIframe', 'CN', '修改', '修改');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiangQuanxianIframe', 'EN', '修改', 'Change');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiangQuanxianIframe', 'CN', '取消', '取消');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiangQuanxianIframe', 'EN', '取消', 'Cancel');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('view', 'CN', '系统管理', '系统管理');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('view', 'EN', '系统管理', 'System Manage');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('view', 'CN', '组织结构管理', '组织结构管理');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('view', 'EN', '组织结构管理', 'Group Manage');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('zuManage', 'CN', '添加组织结构', '添加组织结构');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('zuManage', 'EN', '添加组织结构', 'Add Group');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('zuManage', 'CN', '父节点ID', '父节点ID');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('zuManage', 'EN', '父节点ID', 'Parent ID');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('zuManage', 'CN', '组织结构名', '组织结构名');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('zuManage', 'EN', '组织结构名', 'Group Name');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('zuManage', 'CN', '添加', '添加');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('zuManage', 'EN', '添加', 'Add');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('zuManage', 'CN', '保存', '保存');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('zuManage', 'EN', '保存', 'Save');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('zuManageIframe', 'CN', '父节点ID', '父节点ID');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('zuManageIframe', 'EN', '父节点ID', 'Parent ID');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('zuManageIframe', 'CN', '组织结构名', '组织结构名');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('zuManageIframe', 'EN', '组织结构名', 'Group Name');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('zuManageIframe', 'CN', '添加', '添加');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('zuManageIframe', 'EN', '添加', 'Add');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('zuManageIframe', 'CN', '取消', '取消');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('zuManageIframe', 'EN', '取消', 'Cancel');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('view', 'CN', '用户管理', '用户管理');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('view', 'EN', '用户管理', 'User Manage');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManage', 'CN', '新增用户', '新增用户');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManage', 'EN', '新增用户', 'Add User');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManage', 'CN', '用户名', '用户名');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManage', 'EN', '用户名', 'User Name');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManage', 'CN', '权限', '权限');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManage', 'EN', '权限', 'Permission');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManage', 'CN', '登录失败次数', '登录失败次数');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManage', 'EN', '登录失败次数', 'Failed Login');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManage', 'CN', '最后登录IP', '最后登录IP');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManage', 'EN', '最后登录IP', 'Last IP');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManage', 'CN', '注册日期', '注册日期');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManage', 'EN', '注册日期', 'Join Date');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManage', 'CN', '最后登录时间', '最后登录时间');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManage', 'EN', '最后登录时间', 'Last Login Time');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManage', 'CN', '邮箱', '邮箱');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManage', 'EN', '邮箱', 'Email');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManageIframe', 'CN', '密码', '密码');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManageIframe', 'EN', '密码', 'Password');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManageIframe', 'CN', '用户名', '用户名');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManageIframe', 'EN', '用户名', 'User Name');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManageIframe', 'CN', '权限', '权限');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManageIframe', 'EN', '权限', 'Permission');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManageIframe', 'CN', '邮箱', '邮箱');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('nav', 'CN', '退出', '退出');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('nav', 'CN', '首页', '首页');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManageIframe', 'EN', '邮箱', 'Email');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManageIframe', 'CN', '添加', '添加');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManageIframe', 'EN', '添加', 'Add');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManageIframe', 'CN', '取消', '取消');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManageIframe', 'EN', '取消', 'Cancel');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManageIframe', 'CN', '保存', '保存');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('nav', 'EN', '更改密码', 'Change Password');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManageIframe', 'EN', '保存', 'Save');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManage', 'CN', '所在组', '所在组');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManage', 'EN', '所在组', 'Group');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('nav', 'EN', '退出', 'Logout');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('nav', 'EN', '首页', 'Home');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManageIframe', 'CN', '组', '组');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('userManageIframe', 'EN', '组', 'Group');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('account', 'EN', '注册', 'Register');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('account', 'EN', '暂未开放', 'Not Opened');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('account', 'CN', '注册', '注册');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('nav', 'CN', '更改密码', '更改密码');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('account', 'CN', '暂未开放', '暂未开放');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('nav', 'CN', '通讯录', '通讯录');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('nav', 'EN', '通讯录', 'GABS');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('nav', 'CN', '管理', '管理');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('nav', 'EN', '管理', 'Manage');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'CN', '姓名', '姓名');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'EN', '姓名', 'Name');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'CN', '手机', '手机');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'EN', '手机', 'Mobile');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'CN', '座机', '座机');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'EN', '座机', 'Landline');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'CN', '邮箱', '邮箱');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'EN', '邮箱', 'Email');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'CN', '公司', '公司');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'EN', '公司', 'Company');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'CN', '备注', '备注');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'EN', '备注', 'Remark');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'CN', '姓名', '姓名');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'EN', '姓名', 'Name');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'CN', '拼音', '拼音');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'EN', '拼音', 'Nickname');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'CN', '公司', '公司');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'EN', '公司', 'Company');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'CN', '手机', '手机');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'EN', '手机', 'Mobile');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'CN', '座机', '座机');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'EN', '座机', 'Landline');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'CN', '邮箱', '邮箱');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'EN', '邮箱', 'Email');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'CN', '备注', '备注');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'EN', '备注', 'Remark');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'CN', '添加', '添加');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'EN', '添加', 'Add');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'CN', '更多信息', '更多信息');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'EN', '更多信息', 'More');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'CN', '取消', '取消');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'EN', '取消', 'Cancel');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'CN', '添加联系人', '添加联系人');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'EN', '添加联系人', 'Add contacts');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'CN', '批量管理', '批量管理');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'EN', '批量管理', 'Batch manage');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'CN', '性别', '性别');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'EN', '性别', 'Sex');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'CN', '增加条目', '增加条目');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'EN', '增加条目', 'Add information');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'CN', '男', '男');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'EN', '男', 'M');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'CN', '女', '女');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'EN', '女', 'F');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'CN', '未知', '未知');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'EN', '未知', 'No');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'CN', '姓名', '姓名');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'EN', '姓名', 'Name');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'CN', '拼音', '拼音');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'EN', '拼音', 'Nickname');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'CN', '公司', '公司');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'EN', '公司', 'Company');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'CN', '手机', '手机');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'EN', '手机', 'Mobile');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'CN', '座机', '座机');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'EN', '座机', 'Landline');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'CN', '邮箱', '邮箱');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'EN', '邮箱', 'Email');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'CN', '备注', '备注');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'EN', '备注', 'Remark');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'CN', '保存', '保存');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'EN', '保存', 'Save');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'CN', '关闭', '关闭');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'EN', '关闭', 'Exit');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'CN', '启用编辑', '启用编辑');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'EN', '启用编辑', 'Enable editor');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'CN', '增加条目', '增加条目');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'EN', '增加条目', 'Add information');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'CN', '男', '男');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'EN', '男', 'M');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'CN', '女', '女');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'EN', '女', 'F');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'CN', '未知', '未知');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'EN', '未知', 'No');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'CN', '性别', '性别');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'EN', '性别', 'Sex');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'CN', '删除', '删除');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'EN', '删除', 'Delete');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'CN', '所有人', '所有人');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'EN', '所有人', 'All User');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'CN', '本组', '本组');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'EN', '本组', 'Group');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'CN', '私有', '私有');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'EN', '私有', 'Privately');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'CN', '权限', '权限');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('editIframe', 'EN', '权限', 'Permission');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'CN', '权限', '权限');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'EN', '权限', 'Permission');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'CN', '所有人', '所有人');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'EN', '所有人', 'All User');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'CN', '本组', '本组');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'EN', '本组', 'Group');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'CN', '私有', '私有');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('addIframe', 'EN', '私有', 'Privately');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('view', 'CN', '通讯录管理', '通讯录管理');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('view', 'EN', '通讯录管理', 'Address Book Manage');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('view', 'CN', '批量管理', '批量管理');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('view', 'EN', '批量管理', 'Batch manage');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'CN', '权限', '权限');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'EN', '权限', 'Permission');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('zuIframe', 'CN', '取消', '取消');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('zuIframe', 'EN', '取消', 'Cancel');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('zuIframe', 'CN', '私有', '私有');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('zuIframe', 'EN', '私有', 'Privately');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'CN', '权限', '权限');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'EN', '权限', 'Permission');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'CN', '筛选', '筛选');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'EN', '筛选', 'Filter');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('filterIframe', 'CN', '筛选', '筛选');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('filterIframe', 'EN', '筛选', 'Filter');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('filterIframe', 'CN', '取消', '取消');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('filterIframe', 'EN', '取消', 'Cancel');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('view', 'CN', '个人管理', '个人管理');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('view', 'EN', '个人管理', 'Personal Manage');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('changePass', 'CN', '用户ID', '用户ID');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('changePass', 'EN', '用户ID', 'User ID');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('changePass', 'CN', '原密码', '原密码');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('changePass', 'EN', '原密码', 'Old Password');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('changePass', 'CN', '新密码', '新密码');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('changePass', 'EN', '新密码', 'New Password');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('changePass', 'CN', '修改', '修改');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('changePass', 'EN', '修改', 'Change');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('changePass', 'CN', '重置', '重置');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('changePass', 'EN', '重置', 'Reset');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('manage', 'CN', '功能', '功能');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('manage', 'EN', '功能', 'Function');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('manage', 'CN', '描述', '描述');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('manage', 'EN', '描述', 'Describe');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('manage', 'CN', '使用批量工具管理通讯录', '使用批量工具管理自己的通讯录');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('manage', 'EN', '使用批量工具管理通讯录', 'Use batch tools to manage own contacts');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('manage', 'CN', '修改自己账号的密码', '修改自己账号的密码');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('manage', 'EN', '修改自己账号的密码', 'Change your account password');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'CN', '操作', '操作');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'EN', '操作', 'Manage');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'CN', '姓名', '姓名');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'EN', '姓名', 'Name');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'CN', '公司', '公司');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'EN', '公司', 'Company');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'CN', '手机', '手机');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'EN', '手机', 'Mobile');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'CN', '座机', '座机');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'EN', '座机', 'Landline');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'CN', '邮箱', '邮箱');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'EN', '邮箱', 'Email');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'CN', '备注', '备注');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'EN', '备注', 'Remark');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'CN', '性别', '性别');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'EN', '性别', 'Sex');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'CN', '拼音', '拼音');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'EN', '拼音', 'Nickname');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'CN', '组', '组');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'EN', '组', 'Group');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiangZuIframe', 'CN', '选择组', '选择组');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiangZuIframe', 'EN', '选择组', 'Group');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('view', 'CN', '批量导入', '批量导入');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('view', 'EN', '批量导入', 'Bulk Import');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('view', 'CN', '语言注册', '语言注册');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('view', 'EN', '语言注册', 'Language Register');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiangImport', 'CN', 'TXT上传', 'TXT上传');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiangImport', 'EN', 'TXT上传', 'TXT Upload');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiangImport', 'CN', 'Excel上传', 'Excel上传');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiangImport', 'EN', 'Excel上传', 'Excel Upload');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiangImport', 'CN', 'Excel模板下载', 'Excel模板下载');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiangImport', 'EN', 'Excel模板下载', 'Excel Template Download');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiangImport', 'CN', '确认导入', '确认导入');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiangImport', 'EN', '确认导入', 'Confirm Import');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiangImport', 'CN', '预览区', '预览区');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiangImport', 'EN', '预览区', 'Preview Area');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'CN', '共', '共');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'EN', '共', ' ');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'CN', '位联系人', '位联系人');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('index', 'EN', '位联系人', 'Contacts');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('manage', 'CN', '使用Excel、TXT等方式轻松导入联系人', '使用Excel、TXT等方式轻松导入联系人');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('manage', 'EN', '使用Excel、TXT等方式轻松导入联系人', 'Easily import contacts using Excel, TXT, etc');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'CN', '批量导出', '批量导出');
INSERT INTO `txl_yuyan` (`YE_MIAN_MING`, `YU_ZHONG`, `XU_HAO`, `WEN_ZI`) VALUES ('piLiang', 'EN', '批量导出', 'Batch Export');
