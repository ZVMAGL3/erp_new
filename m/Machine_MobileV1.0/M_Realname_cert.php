<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width,user-scalable=0,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="format-detection" content="telephone=no"/>
<title>SQP Certificate Mobile</title>
<link href="theme/style.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<div id="wrapper"> 
    <!--
		<div  id="header" class="footermenu" style="height: 55px;line-height: 55px;">
       		<div class='widd'><a href="M_desk.php" class="menu site1">桌 面</a></div>
			<div class='widd'><a href="M_work.php" class="menu site2">工 作</a></div>
			<div class='widd'><a href="M_find.php" class="menu site3">发 现</a></div>
			<div class='widd'><a href="M_set.php" class="menu site4">我</a></div>
		</div>
        !-->
    <div id="header"> <a href="javascript:history.go(-1)" class="home"></a> <em class="eleft">&nbsp;&nbsp;</em> <a href="M_right_menu.php" class="siteMap"></a> </div>
    <div class="headpadd"></div>
    <div id="index"> 
        
        <!--!-->
        <div id="catalog">
            <ul>
                <li><a href="M_info_basic.php">基本资料<font color="#CCC"> . My info</font></a></li>
                <li><a href="M_standard.php">实名认证<font color="#CCC"> . Standard</font></a></li>
                <li><a href="M_Org.php">公司<font color="#CCC"> . Org</font></a></li>
                <li><a href="M_team.php">团队<font color="#CCC"> . Team</font></a></li>
            </ul>
        </div>
    </div>
    <?php include_once( 'M_foot.php' );?>
    <?php include_once( 'M_bottom.php' );?>
</div>
</body>
</html>
<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../js/B_login_fnction.js"></script>