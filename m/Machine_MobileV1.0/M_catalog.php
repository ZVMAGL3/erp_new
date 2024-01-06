<?php

$nowid = $page = $parent_id = 0;

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
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,user-scalable=0,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=no" />
<title>Web Map</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="generator" content="SQP V1.0" />
<link href="theme/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="theme/default/images/jquery.min.js"></script> 
<script type="text/javascript" src="theme/default/images/global.js"></script>
</head>
<body>
<div id="wrapper">
    <div id="header"> <a href="javascript:history.go(-1)" class="home"></a> <em class="eleft">SQP Web Map</em> <a href="M_catalog.php" class="siteMap"></a></div>
    <div class="headpadd"></div>
    <div class="urHere">当前位置：<a href=index.php>首页</a> > <a href='#'>站点地图</a></div>
    <div id="catalog">
        <ul>
            <li><a href="../M_reg.php">注册.Reg</a></li>
            <li><a href="index.php">登录.Login</a></li>
            <li><a href="M_about.php">关于.About SQP</a></li>
            <li><a href="M_product.php">我们的服务.Our Services </a></li>
        </ul>
    </div>
    <?php include_once( 'M_foot.php' );?>
    <?php include_once( 'M_bottom.php' );?>
</div>
</body>
</html>