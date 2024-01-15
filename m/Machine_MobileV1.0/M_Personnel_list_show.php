<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
$id = 0;
if ( isset( $_REQUEST[ 'id' ] ) )$id = intval( $_REQUEST[ 'id' ] ); //得到修改的ID;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width,user-scalable=0,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="format-detection" content="telephone=no"/>
<title>标准条款 </title>
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
    <div id="header"> <a href="javascript:history.go(-1)" class="home"></a> <em class="eleft">公司资料</em> <a href="M_right_menu.php" class="siteMap"></a> </div>
    <div class="headpadd"></div>
    <div id="index"> 
        
        <!--!-->
        <div id="catalog"  class='height100'>
            <ul>
                <?php
                $sql = $rs = $xianshi_ZD_num = '';
                $sql = "select * From `msc_user_reg`  where id = $id";
                //echo $sql.'_'; 
                $rs = mysqli_query( $Connadmin, $sql );
                $row = mysqli_fetch_array( $rs );

                $id = $row[ 'id' ]; //员工档案id
                $SYS_GongHao = $row[ "SYS_GongHao" ]; //工号
                //$web_shenpi = $row[ "sys_web_shenpi" ];                         //云端访问权限 0 为禁止 1为允许访问
                //$nowzzzt = intval( $row[ 'zzzt' ] );                        //在职状态0为在职，1为离职
                //$userjib = $row[ 'jib' ];                                   //级别工种
                $SYS_UserName = $row[ 'SYS_UserName' ]; //姓名
                $photo = $row[ 'photo' ]; //头像
                $XingBie = $row[ 'XingBie' ]; //性别
                $DiZhi = $row[ 'DiZhi' ]; //地址
                $SYS_ShouJi = $row[ 'SYS_ShouJi' ]; //手机
                $SYS_Email = $row[ 'SYS_Email' ]; //邮件
                $SYS_qianmin = $row[ 'SYS_qianmin' ]; //签名
                $YinXingKaHao = $row[ 'YinXingKaHao' ]; //银行卡号
                $adddate = $row[ 'sys_adddate' ]; //注册时间


                echo '<li class="touxiang"><a href="M_edit.php?id=' . $id . '&Tablename=msc_user_reg&zdname=photo&TitleName=头像&InputType=input&thisvale=' . $photo . '">头像<font color="#CCC"> . My img</font><em>' . $photo . '</em></a></li>';

                echo '<li><a href="M_edit.php?id=' . $id . '&Tablename=msc_user_reg&zdname=SYS_UserName&TitleName=名字&InputType=input&thisvale=' . $SYS_UserName . '">名字<font color="#CCC"> . my name</font><em>' . $SYS_UserName . '</em></a></li>';

                echo '<li><a href="M_edit.php?id=' . $id . '&Tablename=msc_user_reg&zdname=SYS_GongHao&TitleName=注册号&InputType=NO_input&thisvale=' . $SYS_GongHao . '">注册号<font color="#CCC"> . Org</font><em>' . $SYS_GongHao . '</em></a></li>';

                echo '<li><a href="M_edit.php?id=' . $id . '&Tablename=msc_user_reg&zdname=XingBie&TitleName=性别&InputType=input&thisvale=' . $XingBie . '">性别<font color="#CCC"> . Gender</font><em>' . $XingBie . '</em></a></li>';

                echo '<li><a href="M_edit.php?id=' . $id . '&Tablename=msc_user_reg&zdname=DiZhi&TitleName=联络地址&InputType=input&thisvale=' . $DiZhi . '">联络地址<font color="#CCC"> . C.add </font><em>' . $DiZhi . '</em></a></li>';

                echo '<li><a href="M_edit.php?id=' . $id . '&Tablename=msc_user_reg&zdname=SYS_ShouJi&TitleName=手机&InputType=NO_input&thisvale=' . $SYS_ShouJi . '">手机<font color="#CCC"> . Mob</font><em>' . $SYS_ShouJi . '</em></a></li>';

                echo '<li><a href="M_edit.php?id=' . $id . '&Tablename=msc_user_reg&zdname=SYS_Email&TitleName=邮箱&InputType=input&thisvale=' . $SYS_Email . '">邮箱<font color="#CCC"> . E_mail</font><em>' . $SYS_Email . '</em></a></li>';

                echo '<li><a href="M_edit.php?id=' . $id . '&Tablename=msc_user_reg&zdname=SYS_qianmin&TitleName=个性签名&InputType=input&thisvale=' . $SYS_qianmin . '">个性签名<font color="#CCC"> . Signature</font><em>' . $SYS_qianmin . '</em></a></li>';

                echo '<li><a href="M_edit.php?id=' . $id . '&Tablename=msc_user_reg&zdname=YinXingKaHao&TitleName=收款帐号&InputType=input&thisvale=' . $YinXingKaHao . '">收款帐号<font color="#CCC"> . Account number</font><em>' . $YinXingKaHao . '</em></a></li>';

                echo '<li><a href="M_edit.php?id=' . $id . '&Tablename=msc_user_reg&zdname=adddate&TitleName=注册时间&InputType=NO_input&thisvale=' . $adddate . '">注册时间<font color="#CCC"> . Registration time</font><em>' . $adddate . '</em></a></li>';


                mysqli_free_result( $rs ); //释放内存


                mysqli_close( $Connadmin ); //关闭数据库 

                ?>
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