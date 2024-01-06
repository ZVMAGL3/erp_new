<?php
header( 'Content-type: text/html; charset=utf-8' ); //设定本页编码
include_once '../session.php';
include_once 'B_quanxian.php';
include_once '../inc/Function_All.php';
include_once '../inc/B_Config.php';//执行接收参数及配置
include_once '../inc/B_conn.php';
//include_once '../inc/Sub_All.php' ;


if ( $act == 'sign' ) { //获得签名
	sign();   //加载表头锁定列时
} else {
	echo NoZhiLing();
};


//------------------------------------------------------------------------//获得签名
function sign() {
	global $SYS_UserName,$bh;
	echo $SYS_UserName.'('.$bh.') '.date('Y-m-d H:i:s').";";
};

mysqli_close($Conn);//关闭数据库
//mysqli_close($Connadmin);//关闭云数据库

?>