<?php
ini_set( 'date.timezone', 'Asia/Shanghai' );

$nowid = $page = $parent_id = 0;
$nowid = 6;
if ( isset( $_REQUEST[ 'id' ] ) ) {
    $nowid = intval( $_REQUEST[ 'id' ] );
};
if ( isset( $_REQUEST[ 'parent_id' ] ) ) {
    $parent_id = intval( $_REQUEST[ 'parent_id' ] );
};
// Page分页函数
if ( isset( $_REQUEST[ 'page' ] ) ) {
    $page = intval( $_REQUEST[ 'page' ] );
};
include 'M_top.php';
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=0,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<title>About SQP</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="generator" content="SQP V1.0" />
<link href="theme/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="theme/default/images/jquery.min.js"></script> 
<script type="text/javascript" src="theme/default/images/global.js"></script>
</head>
<body>
<div id="wrapper">
    <div id="header"> <a href="javascript:history.back()" class="home"></a> <em class="eleft">About SQP</em> <a href="M_catalog.php" class="siteMap"></a> </div>
    <div class="headpadd"></div>
    <div class="urHere">当前位置：<a href="index.php">首页</a><b>></b><a href="#">关于我们</a></div>
    <div class="treeBox"> </div>
    <div id="page">
        <h1>关于我们</h1>
        <div class="content"> </br>
            </br>
            &nbsp;&nbsp;&nbsp;&nbsp;ＳＱＰ是（SUNLIGHT  QUALITY  PRODUCTION）缩写，是一个独立的，不以营利为目的非政府组织。SQP致力于商品制造过程或服务提供过程的质量管控、产品或服务安全、环境的保护领域的标准制订、产品测试和认证服务工作，是国际产品质量与安全领域的权威机构； </br>
            </br>
            &nbsp;&nbsp;&nbsp;&nbsp;ＳＱＰ创建了阳光质造认证标准，并申请了《一种新的认证方法-阳光质造》，版权号：00970636；ＳＱＰ的使命是：让优秀的企业更优秀，让全球采购成为享受； </br>
            </br>
            <strong>阳光质造产生的历史背景：</strong> </br>
            &nbsp;&nbsp;&nbsp;&nbsp;随着互联网及物流的飞速发展，世界贸易产生了巨大变化，以往需要实地采购的机会，被互联网所替代，给采购商带来便利的同时也产生了许多的困扰；互联网的传播成本低，假货横行难辨真伪，往往容易找到的却是些伪实力厂商，从而造成采购的产品劣质，甚至是仿冒件；
            因此，采购商们产生了渴望，渴望生产厂商的真实情况得以如实鉴证。而在这瞬息万变的今天，普通的认证模式已然不能满足互联网时代发展需求，更不能让客户得到预想和期望的信息；
            为此，SQP为贸易商的期望做了不懈努力，通过先进、公正、智能化鉴证系统，力争实时反馈获证组织实际生产或经营情况，并关注采购商希望得到的信息，为之不懈努力，力求让世界贸易变得更加纯净，让世界贸易成为一种享受，促使获证组织得到持续改进、降低成本、提升品质，各行业良性发展；最终让优秀的企业更优秀！ </br>
            </br>
            &nbsp;&nbsp;&nbsp;&nbsp; </div>
    </div>
    <?php include_once( 'M_foot.php' );?>
    <?php include_once( 'M_bottom.php' );?>
</div>
</body>
</html>