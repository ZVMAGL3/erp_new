<?php
header( 'Content-type: text/html; charset=utf-8' ); //设定本页编码
include_once '../session.php';
include_once 'B_quanxian.php';
include_once '../inc/Function_All.php';
include_once '../inc/B_Config.php';//执行接收参数及配置
include_once '../inc/B_conn.php';
//include_once '../inc/Sub_All.php' ;


if ( $act == 'wjbh' ) {
	wjbh();   //加载表头锁定列时
} else {
	echo NoZhiLing();
};


function wjbh() {

	//------------------------------------------------------------------------//文件编号获取
    $wjbh= '' ;
    //echo $re_id;
	global $hy, $re_id, $nowgsbh,$const_jlbhzt,$Conn;
	$nowjlbhzt =$const_jlbhzt;//公司编号字头
	if ( $nowjlbhzt <> '' )$nowjlbhzt = $nowjlbhzt . '-';
	if ( $nowgsbh <> '' )$nowgsbh2 = $nowgsbh . '.';
	$sql = "select id,sys_card,startdate,beizhu,banben,xiugaicishu From `sys_jlmb` where `id`='$re_id'";
	$rs = mysqli_query(  $Conn , $sql );
	if ( $row = mysqli_fetch_array( $rs ) ) {
		$r_banben = $row[ 'banben' ] ;
		if ( '1' . $r_banben == '1' )$r_banben = 'A';
		$r_xiugaicishu = $row[ 'xiugaicishu' ] ;
		if ( '1' . $r_xiugaicishu == '1' )$r_xiugaicishu = 0;
		if ( $r_banben <> '' )$r_banben = '-' . $r_banben;
		$r_card = $row[ 'sys_card' ] ;
		$r_startdate = $row[ 'startdate' ] ;
		//$r_beizhu=$row['beizhu'];
	};
	$wjbh= "" . $nowgsbh2 . $nowjlbhzt . $re_id . $r_banben . "/" . $r_xiugaicishu . "&nbsp;<font>" . $r_card . "&nbsp;" . $r_startdate . "</font>";
	//echo ("<i class='fa fa-arrow-circle-right fa-fw'>&nbsp;</i>");
	//return($wjbh);
	echo( $wjbh );
	mysqli_free_result( $rs ); //释放内存

};

mysqli_close($Conn);//关闭数据库
//mysqli_close($Connadmin);//关闭云数据库

?>