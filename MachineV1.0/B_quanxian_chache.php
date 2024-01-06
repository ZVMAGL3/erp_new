<?php

include_once '../session.php';
include_once '../inc/Function_All.php';

//include_once '../inc/B_conn.php';
include_once '../inc/B_connadmin.php';
include_once '../inc/cache_write.php'; /*自动缓存*/
//获得职位id
//global $act,$zwid,$SYS_QuanXian;

if ( isset( $_REQUEST[ 'zwid' ] ) ) {
    $zwid = trim($_REQUEST[ 'zwid' ]);
} else {
    $zwid = $SYS_QuanXian;
}
//echo $zwid;
if ( isset( $_REQUEST[ 'act' ] ) ) {
    $act = $_REQUEST[ 'act' ];
}

if ( $act == 'list' ) {
    lists();
}

function lists() {
    $Htmlcache = '';
    global $hy,$Conn, $db, $ToHtmlID, $zwid, $SYS_Company_id; //得到全局变量
    //=========================================================================权限及相关设置信息文件包含
    include_once '../inc/B_const_chache.php';
    //========================================================================= 生成动态文件内容
    $Htmlcache .= '<?php' . "\n";
    $Htmlcache .= 'include_once "{$_SERVER[\'PATH_TRANSLATED\']}/session.php";' . "\n";
    $Htmlcache .= '$const_q_zu=\'' . $const_q_zu . "';\n";
    $Htmlcache .= '$const_id_fz=\'' . $const_id_fz . "';\n";
    $Htmlcache .= '$const_id_bumen=\'' . $const_id_bumen . "';\n";
    $Htmlcache .= '$const_bumenname=\'' . $const_bumenname . "';\n";
    $Htmlcache .= '$const_q_fanwei=\'' . $const_q_fanwei . "';\n";
    $Htmlcache .= '$const_q_tianj=\'' . $const_q_tianj . "';\n";
    $Htmlcache .= '$const_q_xiug=\'' . $const_q_xiug . "';\n";
    $Htmlcache .= '$const_q_shenghe=\'' . $const_q_shenghe . "';\n";
    $Htmlcache .= '$const_q_pizhun=\'' . $const_q_pizhun . "';\n";
    $Htmlcache .= '$const_q_zhixing=\'' . $const_q_zhixing . "';\n";
    $Htmlcache .= '$const_q_shanc=\'' . $const_q_shanc . "';\n";
    $Htmlcache .= '$const_q_cak=\'' . $const_q_cak . "';\n";
    $Htmlcache .= '$const_q_dayin=\'' . $const_q_dayin . "';\n";
    $Htmlcache .= '$const_q_xiaohui=\'' . $const_q_xiaohui . "';\n";
    $Htmlcache .= '$const_q_huis=\'' . $const_q_huis . "';\n";
    $Htmlcache .= '$const_q_seid=\'' . $const_q_seid . "';\n";
    $Htmlcache .= '$const_q_dian=\'' . $const_q_dian . "';\n";
    $Htmlcache .= '$regid=\'' . $regid . "';\n";
    $Htmlcache .= '$reg_name=\'' . $reg_name . "';\n";
    $Htmlcache .= '$reg_banben=\'' . $reg_banben . "';\n";
    $Htmlcache .= '$data_use=\'' . $data_use . "';\n";
    $Htmlcache .= '$const_jlbhzt=\'' . $const_jlbhzt . "';\n";
    $Htmlcache .= '$maxrecord=\'' . $maxrecord . "';\n";
    $Htmlcache .= 'if ( $maxrecord == \'\' )$maxrecord = 20;' . "\n";
    $Htmlcache .= '$nowlockd=\'' . $nowlockd . "';\n";
    $Htmlcache .= '$usermoban=\'' . $usermoban . "';\n";
    $Htmlcache .= '$nowgsbh=\'' . $nowgsbh . "';\n";

    $Htmlcache .= '?>';

    $current_file = str_replace( "_chache.php", "", basename( __FILE__ ) ); //得到当前文件 除”_chache.php“的文件名称
    write_cache( '2', $Htmlcache, $current_file ); //生成模版
}

//http://localhost/MachineV1.0/B_moban_edit_chache.php?act=list&strmk_id=30121&page=1&zu=0&keyword=&re_id=321&zd=0&px_name=id&pxv=Desc&pok=1&bh=9001&hy=9007&scroll_left=0
?>