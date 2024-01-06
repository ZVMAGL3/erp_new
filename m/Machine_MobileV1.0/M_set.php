<?php
include_once( '../../session.php' ); //接收session信息
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
        <em class="eleft">我的</em> <a href="M_right_menu.php" class="siteMap"></a>
    </div>
    <div id="index"> 
        
        <!--!-->
        <div id="catalog">
            <ul>
                <li><a href="M_info.php">N-<i class='fa fa-21-1'></i>我的资料<font color="#CCC"> . My info</font></a></li>
                <li><a href="M_Org.php"><i class='fa fa-21-1'></i>我的公司<font color="#CCC"> . My Org</font></a></li>
                <li><a href="M_standard.php"><i class='fa fa-21-1'></i>认证标准<font color="#CCC"> . Cert Standard</font></a></li>
                <li><a href="M_Template.php"><i class='fa fa-21-1'></i>认证模版<font color="#CCC"> . Cert Standard Template</font></a></li>
                <li><a href="M_GroupBranch.php"><i class='fa fa-21-1'></i>集团分支<font color="#CCC"> . Group Branch</font></a></li>
                <li><a href="M_Department.php"><i class='fa fa-21-1'></i>部门<font color="#CCC"> . Department</font></a></li>
                <li><a href="M_Position.php"><i class='fa fa-21-1'></i>职位<font color="#CCC"> . Position</font></a></li>
                <li><a href="M_RenMing.php"><i class='fa fa-21-1'></i>岗位任命<font color="#CCC"> . Post appointment</font></a></li>
                <li><a href="M_RecordList.php"><i class='fa fa-21-1'></i>记录清单<font color="#CCC"> . Record Listing</font></a></li>
                
                <li><a href="M_ZhiQuan.php"><i class='fa fa-21-1'></i>职权分配<font color="#CCC"> . The Function</font></a></li>
  
                <li><a href="M_GongZiSitting.php">N-<i class='fa fa-21-1'></i>利益工资<font color="#CCC"> . Salary Setting</font></a></li>
                <li><a href="M_Jurisdiction.php"><i class='fa fa-21-1'></i>云帐户<font color="#CCC"> . Jurisdiction</font></a></li>
                <li><a href="M_DataCheck.php"><i class='fa fa-21-1'></i>数据检查<font color="#CCC"> . Data Check</font></a></li>
                <li><a href="M_Setting.php"><i class='fa fa-21-1'></i>公司信息<font color="#CCC"> . Setting</font></a></li>
                <li><a href="M_edit_password.php"><i class='fa fa-21-1'></i>密码<font color="#CCC"> . Password</font></a></li>
                <li><a href="../../exit.php"><i class='fa fa-21-1'></i>退出<font color="#CCC"> . Exit</font></a></li>
            </ul>
        </div>
    </div>
    <?php include_once( 'M_foot.php' );?>
    <?php include_once( 'M_bottom.php' );?>
</div>
</body>
</html>
