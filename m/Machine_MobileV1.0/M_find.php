<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
?>
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
    <div id="header"> 
        <!--
			<em class="logo"><img src="../../images/logo-sqp.png"></em>
            !--> 
        <em class="eleft"> 发现</em> <a href="M_right_menu.php" class="siteMap"></a> </div>
    <div class="headpadd"></div>
    <div id="index"> 
        
        <!--
			<div id="mainNav" class="top_bottom_line">
				<ul>
            		<li><a href="product.php">我们的服务</a></li>
		

                 <li><a href='#'>000</a></li>
				</ul>
			</div>
       
  
      !-->
        <div  class="incBox_login">
            <form action="../../index_save.php?action=login" method="post" name="form1" id="form1">
                <div class="LoginBox">
                    <div class="divcss5"><img src="../../images/logo-sqp02.png" class="logo"><br>
                        <strong>User Login For SQP</strong></div>
                </div>
            </form>
        </div>
        
        <!--!-->
        <div id="catalog">
            <ul>
                <li><a href="../M_reg.php">注册.Reg</a></li>
                <li><a href="M_about.php">关于.About SQP</a></li>
            </ul>
        </div>
    </div>
    <?php include_once( 'M_foot.php' );?>
    <?php include_once( 'M_bottom.php' );?>
</div>
</body>
</html>
