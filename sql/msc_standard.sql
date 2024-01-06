-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2022-07-25 10:12:28
-- 服务器版本： 8.0.12
-- PHP 版本： 5.6.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `msc_huiyuanadminloginnestmanagement`
--

-- --------------------------------------------------------

--
-- 表的结构 `msc_standard`
--

CREATE TABLE `msc_standard` (
  `id` int(11) NOT NULL COMMENT '自动序号',
  `number` varchar(90) DEFAULT NULL COMMENT '标准号',
  `name` varchar(50) DEFAULT NULL COMMENT '标准名称',
  `sys_beizhu` varchar(2000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标准说明',
  `sys_id_bumen` int(8) DEFAULT '0' COMMENT '部门,50,0,0,1,0,0,0,0,0,0,0,0,0,0',
  `sys_shenpi` varchar(255) DEFAULT NULL COMMENT '审核,80,0,0,20,0,0,0,0,0,0,0,0,0,0',
  `sys_id_fz` int(5) DEFAULT NULL COMMENT '分支,50,0,0,1,0,0,0,0,0,0,0,0,0,0',
  `sys_web_shenpi` int(1) DEFAULT '0' COMMENT '网络显示,50,0,0,1,0,0,0,0,0,0,0,0,0,0',
  `sys_shenpi_all` varchar(255) DEFAULT NULL COMMENT '批准,80,0,0,22,0,0,0,0,0,0,0,0,0,0',
  `sys_adddate_g` datetime DEFAULT NULL COMMENT '更新时间,50,0,0,1,0,0,0,0,0,0,0,0,0,0',
  `sys_id_login` int(8) DEFAULT '0' COMMENT '编制人ID,50,0,0,1,0,0,0,0,0,0,0,0,0,0',
  `sys_login` varchar(50) DEFAULT NULL COMMENT '编制人,50,0,0,1,0,0,0,0,0,0,0,0,0,0',
  `sys_id_zu` varchar(200) DEFAULT NULL COMMENT '分类,50,0,0,1,0,0,0,0,0,0,0,0,0,0',
  `sys_yfzuid` varchar(50) DEFAULT NULL COMMENT '公司ID,50,0,0,1,0,0,0,0,0,0,0,0,0,0',
  `sys_bh` int(11) DEFAULT NULL COMMENT '[系统]编号,50,0,0,1,0,0,0,0,0,0,0,0,0,0',
  `sys_zt` varchar(10) DEFAULT NULL COMMENT '[系统]字头,50,0,0,1,0,0,0,0,0,0,0,0,0,0',
  `sys_zt_bianhao` int(11) DEFAULT NULL COMMENT '[系统]字头编号,50,0,0,1,0,0,0,0,0,0,0,0,0,0',
  `sys_nowbh` varchar(50) DEFAULT NULL COMMENT '[系统]自动编号,50,0,0,1,0,0,0,0,0,0,0,0,0,0',
  `sys_huis` int(1) DEFAULT '0' COMMENT '回收,50,0,0,1,0,0,0,0,0,0,0,0,0,0',
  `sys_adddate` datetime DEFAULT NULL COMMENT '创建时间,50,0,0,1,0,0,0,0,0,0,0,0,0,0',
  `sys_chaosong` varchar(255) DEFAULT NULL COMMENT '经办人,50,0,0,1,0,0,0,0,0,0,0,0,0,0',
  `sys_paixu` int(8) DEFAULT NULL COMMENT '排序,80,0,0,1,0,0,0,0,0,0,0,0,0,0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='标准条款' ROW_FORMAT=DYNAMIC;

--
-- 转存表中的数据 `msc_standard`
--

INSERT INTO `msc_standard` (`id`, `number`, `name`, `sys_beizhu`, `sys_id_bumen`, `sys_shenpi`, `sys_id_fz`, `sys_web_shenpi`, `sys_shenpi_all`, `sys_adddate_g`, `sys_id_login`, `sys_login`, `sys_id_zu`, `sys_yfzuid`, `sys_bh`, `sys_zt`, `sys_zt_bianhao`, `sys_nowbh`, `sys_huis`, `sys_adddate`, `sys_chaosong`, `sys_paixu`) VALUES
(1, 'SQP 2001:2019', '阳光质造 现场规范化管理体系', '', NULL, '0', NULL, 0, NULL, '2022-06-27 19:25:58', NULL, NULL, NULL, '9007', NULL, 'P2', NULL, NULL, 0, NULL, NULL, NULL),
(8, 'ISO 9001:2015', '国际质量管理体系', '', NULL, '0', NULL, 0, NULL, '2022-06-27 19:09:30', NULL, NULL, NULL, '9007', NULL, 'QR', NULL, NULL, 0, NULL, NULL, NULL),
(9, 'SQP 3001:2019', '阳光质造 产品溯源管理体系', '', NULL, '0', NULL, 0, NULL, '2022-06-27 19:26:07', NULL, NULL, NULL, '9007', NULL, 'P3', NULL, NULL, 0, NULL, NULL, NULL),
(10, 'SQP 1001:2019', '阳光质造 质量管理溯源管理体系', '', NULL, '0', NULL, 0, NULL, '2022-06-27 19:25:50', NULL, NULL, NULL, '9007', NULL, 'P1', NULL, NULL, 0, NULL, NULL, NULL),
(11, 'IATF 16949:2016', '汽车生产件及相关服务件组织的质量管理体系', '', NULL, '0', NULL, 0, NULL, '2022-06-27 19:12:49', NULL, NULL, NULL, '9007', NULL, 'IATF', NULL, NULL, 0, NULL, NULL, NULL),
(12, 'ISO14001', '环境管理体系', '', 43, NULL, 96, 0, NULL, '2022-06-27 19:09:56', 9001, '曾小波', NULL, '9007', NULL, 'ER', NULL, NULL, 0, '2022-06-19 21:55:46', NULL, NULL);

--
-- 转储表的索引
--

--
-- 表的索引 `msc_standard`
--
ALTER TABLE `msc_standard`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `msc_standard`
--
ALTER TABLE `msc_standard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自动序号', AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
