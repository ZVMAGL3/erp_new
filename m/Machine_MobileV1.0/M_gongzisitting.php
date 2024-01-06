<?php
include_once( '../../session.php' ); //接收session信息
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
<link href='../../style/menuimage.css' rel='stylesheet' type='text/css' />
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
    <div id="header"> 
        <!--
			<em class="logo"><img src="../../images/logo-sqp.png"></em>
            !--> 
        
        <?php   
            if($P_M){
        ?>
        <a href="M_set.php" class="home"></a> 
        <?php
            }
        ?>        
        <em class="eleft">工资利益分配</em> <a href="M_right_menu.php" class="siteMap"></a> </div>
    <div id="index"> 
        
        <!--!-->
        <div id="catalog">
            <ul>
                <li><a href="M_info.php"><i class='fa fa-21-1'></i>薪酬设计<font color="#CCC"> . My info</font></a></li>
                <li><a href="M_Org.php"><i class='fa fa-21-1'></i>职位薪酬<font color="#CCC"> . My Org</font></a></li>
                <li><a href="M_standard.php"><i class='fa fa-21-1'></i>我的薪酬<font color="#CCC"> . Cert Standard</font></a></li>
                <li><a href="M_standard.php"><i class='fa fa-21-1'></i>奖罚<font color="#CCC"> . Cert Standard</font></a></li>
                <li><a href="M_standard.php"><i class='fa fa-21-1'></i>绩效<font color="#CCC"> . Cert Standard</font></a></li>
                <li><a href="M_standard.php"><i class='fa fa-21-1'></i>我的工资<font color="#CCC"> . Cert Standard</font></a></li>
                
            </ul>
        </div>
    </div>
    <?php include_once( 'M_foot.php' );?>
    <?php include_once( 'M_bottom.php' );?>
</div>
</body>
</html>
