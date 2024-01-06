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
    <div id="header"> <a href="javascript:history.go(-1)" class="home"></a> <em class="eleft">标准条款</em> <a href="M_right_menu.php" class="siteMap"></a> </div>
    <div class="headpadd"></div>
    <div id="index"> 
        
        <!--!-->
        <div id="catalog"  class='height100'>
            <ul>
                <?php
                $sql = $rs = $xianshi_ZD_num = '';
                $sql = "select * From `msc_iso_tk`  where sys_id_zu = $id  order by id Desc";
                //echo $sql.'_'; 
                $rs = mysqli_query( $Connadmin, $sql );
                $record_count = mysqli_num_rows( $rs ); //统计总记录数

                //echo record_count.'_'; 

                $i = 0;
                if ( $record_count == 0 ) {
                    echo '<li><a href="#">sorry,<font color="#CCC"> . 没有数据，请添加</font></a></li>';
                } else {
                    while ( $row = mysqli_fetch_array( $rs ) ) {
                        $i++;
                        $id = $row[ 'id' ]; //id
                        $tiaok = $row[ 'tiaok' ]; //标准号
                        $tiaok_dl = $row[ 'tiaok_dl' ]; //版本
                        $tiaok_xl = $row[ 'tiaok_xl' ]; //标准名称


                        echo '<li><a href="#">' . $tiaok . ':' . $tiaok_dl . '&nbsp;&nbsp;' . $tiaok_xl . '<font color="#CCC">.&nbsp;[0]</font></a></li>';
                    }
                    mysqli_free_result( $rs ); //释放内存
                }

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