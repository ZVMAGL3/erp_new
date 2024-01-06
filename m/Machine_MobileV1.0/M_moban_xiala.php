<?php
header( 'Content-type: text/html; charset=utf-8' ); //设定本页编码
include_once '../../session.php';
include_once( 'M_quanxian.php' );                      //接收职位权限信息
include_once '../../inc/Function_All.php';
include_once '../../inc/B_Config.php';//执行接收参数及配置
include_once '../../inc/B_conn.php';



$act = $nowzu = $zd = '';
if ( isset( $_REQUEST[ 'act' ] ) )$act = $_REQUEST[ 'act' ];
if ( isset( $_REQUEST[ 'zu' ] ) )$nowzu = htmlspecialchars( $_REQUEST[ 'zu' ] ); //分类接收
if ( '1' . $nowzu == '1' )$nowzu = 0;
if ( isset( $_REQUEST[ 'zd' ] ) )$zd = htmlspecialchars( $_REQUEST[ 'zd' ] ); //字段接收
if ( '1' . $zd == '1' )$zd = 0;
if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";	};//关系列id
    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //j显示页面
	if ( isset( $_REQUEST[ 'huis' ] ) ){$huis = intval( $_REQUEST[ 'huis' ] );}else{$huis = 0;};                                                              //是否为回收站0为不回收
    //if ( $huis == 1){$ToHtmlID='HUIS_'.$ToHtmlID;};                                                                                                           //是否为回收站0为不回收
//==============================================以下为得到数据

if ( $act == 'sousuoxiala' ) {
	sousuoxiala();
} else {
	echo '没有要执行的指令';
};

function sousuoxiala() { //分类下拉
	global $hy, $re_id, $Conn,$ToHtmlID;
	$rs = $sql = $rsArray = $now_id = $now_lname1 = '';
	echo( "<ul id='zulist' class='clearboth'>" );
	echo( "<li id='0' tit='所有分类' class='shadowdiv shadowadddiv clearboth' onclick='xiala_menu_checked_mobile(this,0,\"$ToHtmlID\")'><i class='fa fa-22-1'></i>&nbsp;所有分类</li>" );
	$sql = 'select id,lname1 From Sys_ZuAll where sys_yfzuid=' . $hy . ' and tableid=' . $re_id . ' and sys_huis<>1 order by sys_nowbh Asc';
	$rs = mysqli_query(  $Conn , $sql );
	//$recordcount=mysqli_num_rows($rs);//得到总数 无用

	while ( $row = mysqli_fetch_array( $rs ) ) {
		$now_id = $row[ 'id' ];
		$now_lname1 = $row[ 'lname1' ];
		echo( "<li id='" . $now_id . "' tit='" . $now_lname1 . "' class='shadowdiv overli clearboth' onclick='xiala_menu_checked_mobile(this,$now_id,\"$ToHtmlID\")'><i class='fa fa-22-1'></i>&nbsp;" . $now_lname1 . "</li>" );
	};
	mysqli_free_result( $rs ); //释放内存
	echo( "<li id='-1' class='shadowdiv shadowadddiv clearboth'><i  class='fa fa-add-mini'></i>&nbsp;添加</li>" );
	
};
mysqli_close($Conn);//关闭数据库
//mysqli_close($Connadmin);//关闭云数据库
//http://localhost/MachineV1.0/B_moban_xiala.php?re_id=321&act=sousuoxiala&zu=0&zd=0
?>