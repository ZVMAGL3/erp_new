<?php
ini_set( "error_reporting", "E_ALL & ~E_NOTICE" ); //php 不定义变量
//header('Content-type: text/html; charset=utf-8');//设定本页编码
if ( !session_id() )session_start(); //初始化会话数据
date_default_timezone_set( 'PRC' );
error_reporting(E_ALL);
ini_set('display_errors', '1');
//============================================================================ 【得到路径及浏览器信息】
$urlhost = $_SERVER[ 'HTTP_HOST' ]; //获取当前域名
$urlto = $_SERVER[ 'REQUEST_URI' ]; //获取当前域名的后缀
$urlindex = "http://" . $urlhost;
$nowurlall = $urlindex . $urlto;
//echo $nowurlall;
//============================================================================ 【接收必需的_SESSION值】
$re_id = $big_id = $strmk_id = $bh = $hy = $SYS_UserName = $SYS_QuanXian = $sys_id_login = $sys_shenpi = $sys_shenpi_all = $sys_chaosong = '';
$sys_id_login = $bumen_id = $page = 0;

if ( isset( $_SESSION[ 'user_id' ] ) )$user_id = intval( $_SESSION[ 'user_id' ] ); //会员 id         9001
if ( isset( $_SESSION[ 'P_M' ] ) )$P_M = intval( $_SESSION[ 'P_M' ] ); //会员 id         9001
if ( isset( $_SESSION[ 'bh' ] ) )$bh = intval( $_SESSION[ 'bh' ] ); //会员 id         9001
if ( isset( $_SESSION[ 'SYS_UserName' ] ) )$SYS_UserName = $_SESSION[ 'SYS_UserName' ]; //会员姓名        曾小波
if ( isset( $_SESSION[ 'hy' ] ) )$hy = intval( $_SESSION[ 'hy' ] ); //公司号          9007
$SYS_Company_id = $hy; //公司号          9007
//echo $hy;
$fields_to_check = array(
    'sys_q_tianj','sys_q_shenghe',
    'sys_q_pizhun','sys_q_cak','sys_q_xiug',
    'sys_q_shanc','sys_q_huis','sys_q_dayin',
    'sys_q_xiaohui','sys_q_zhixing','sys_q_seid'
);
if ( isset( $_SESSION[ 'SYS_QuanXian' ] ) )$SYS_QuanXian = $_SESSION[ 'SYS_QuanXian' ]; 
if ( isset( $_SESSION[ 'SYS_QuanXian_list' ] ) )$SYS_QuanXian_list = $_SESSION[ 'SYS_QuanXian_list' ]; 
if ( isset( $_SESSION[ 'SonBumenList' ] ) )$SonBumenList = $_SESSION[ 'SonBumenList' ]; 
if ( isset( $_SESSION[ 'SonBumenIdxList' ] ) )$SonBumenIdxList = $_SESSION[ 'SonBumenIdxList' ]; 
if ( isset( $_SESSION[ 'topBumenIdxList' ] ) )$topBumenIdxList = $_SESSION[ 'topBumenIdxList' ]; 
if ( isset( $_SESSION[ 'topZhiWeiIdxList' ] ) )$topZhiWeiIdxList = $_SESSION[ 'topZhiWeiIdxList' ];
if ( isset( $_SESSION[ 'modRoles' ] ) )$modRoles = $_SESSION[ 'modRoles' ]; 
if ( isset( $_SESSION[ 'modRoles_pc' ] ) )$modRoles_pc = $_SESSION[ 'modRoles_pc' ]; 
if ( isset( $_SESSION[ 'SYS_QuanXian_index' ] ) ){
    $SYS_QuanXian_index = $_SESSION[ 'SYS_QuanXian_index' ] ; 
    extract($SYS_QuanXian_index);
}

if ( isset( $_SESSION[ 'const_id_login' ] ) )$sys_id_login = $_SESSION[ 'const_id_login' ] ; //员工档案id
//echo $SYS_UserName;

//============================================================================ 【接收参数开始】
$act = $nowzu = $px_ziduan = $zd = $pxv = $pok = $nowkeyword = $page_first = $page_end = $huis = $ShaiXuanSql = $ShaiXuanSql_other = $sys_adddate = $sys_adddate_g = '';

if ( isset( $_REQUEST[ 'bh' ] ) ) {
    $sys_id_login = intval( $_REQUEST[ 'bh' ] );
}; //编制人9001
//echo $sys_id_login;
if ( isset( $_REQUEST[ 'sys_shenpi' ] ) )$sys_shenpi = $_REQUEST[ 'sys_shenpi' ]; 
if ( isset( $_REQUEST[ 'sys_shenpi_all' ] ) )$sys_shenpi_all = $_REQUEST[ 'sys_shenpi_all' ]; //批准人
if ( isset( $_REQUEST[ 'sys_chaosong' ] ) )$sys_chaosong = $_REQUEST[ 'sys_chaosong' ]; //经办人

if ( isset( $_REQUEST[ 'bumen_id' ] ) )$bumen_id = intval( $_REQUEST[ 'bumen_id' ] ); //部门ID接收
if ( isset( $_REQUEST[ 'sys_adddate' ] ) )$sys_adddate = $_REQUEST[ 'sys_adddate' ]; //添加时间 更新时间

//echo $sys_adddate;
if ( isset( $_REQUEST[ 're_id' ] ) )$re_id = intval( $_REQUEST[ 're_id' ] );
if ( '1' . $re_id == '1' )$re_id = 0;
$ToHtmlID = 'DeskMenuDiv' . $re_id; //这里是加载到的DIV ID  DeskMenuDiv0为桌面
//echo"<script>alert($ToHtmlID)</script>";
if ( isset( $_REQUEST[ 'big_id' ] ) )$big_id = intval( $_REQUEST[ 'big_id' ] );
if ( isset( $_REQUEST[ 'strmk_id' ] ) )$strmk_id = intval( $_REQUEST[ 'strmk_id' ] ); //得到修改的ID;

//===========================================================================================================【参数接收】
//echo $sys_id_login;
if ( isset( $_REQUEST[ 'act' ] ) )$act = trim( $_REQUEST[ 'act' ] ); //act接收
if ( isset( $_REQUEST[ 'id' ] ) )$id = $_REQUEST[ 'id' ]; //接收id
if ( isset( $_REQUEST[ 'parent_id' ] ) )$parent_id = $_REQUEST[ 'parent_id' ]; //接收parent_id
if ( isset( $_REQUEST[ 'zu' ] ) )$nowzu = intval( $_REQUEST[ 'zu' ] ); //分类接收
if ( isset( $_REQUEST[ 'px_name' ] ) )$px_ziduan = trim( $_REQUEST[ 'px_name' ] ); //排序字段
if ( '1' . $px_ziduan == '1' )$px_ziduan = 'id';
if ( $px_ziduan == 'sys_nowbh' ) {
    $px_ziduan = 'sys_bh';
};
if ( isset( $_REQUEST[ 'zd' ] ) )$zd = trim( $_REQUEST[ 'zd' ] ); //字段接收
if ( $px_ziduan == 'nowbh' )$px_ziduan = 'bh';
if ( isset( $_REQUEST[ 'pxv' ] ) ) {
    $pxv = trim( $_REQUEST[ 'pxv' ] );
} else {
    $pxv = 'Desc';
}; //顺序指令
if ( isset( $_REQUEST[ 'pok' ] ) )$pok = intval( $_REQUEST[ 'pok' ] ); //是否排序
if ( isset( $_REQUEST[ 'huis' ] ) )$huis = intval( $_REQUEST[ 'huis' ] ); //回收的数据为1
if ( isset( $_REQUEST[ 'keyword' ] ) )$nowkeyword = trim( $_REQUEST[ 'keyword' ] ); //搜索关键词
//$nowkeyword=iconv('gbk','utf-8',$nowkeyword);//这里执行转码为utf-8
if ( isset( $_REQUEST[ 'page' ] ) )$page = intval( $_REQUEST[ 'page' ] ); //页码接收
if ( '1' . $page == '1'
    or $page <= 0 ) {
    $page = 1;
} else {
    $page = ceil( $page );
}; //ceil有小数便进一位。

if ( isset( $_REQUEST[ 'ShaiXuanSql' ] ) )$ShaiXuanSql = $_REQUEST[ 'ShaiXuanSql' ]; //筛选sql
if ( isset( $_REQUEST[ 'ShaiXuanSql_other' ] ) )$ShaiXuanSql_other = $_REQUEST[ 'ShaiXuanSql_other' ]; //筛选sql
//------------------------------------------------------------------------------------------------//

$db = isset($_SESSION['db'])?$_SESSION['db']:'';


//global $re_id;
ini_set( 'date.timezone', 'Asia/Shanghai' );
$nowdate = date( 'Y-m-d H:i:s' ); //获得当前时间
$nowday = date( 'Y-m-d' ); //获得当前日期
//echo "<br><br><br><br>".$id ;
?>
