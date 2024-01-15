<?php

include_once '../../session.php';
include_once '../../inc/Function_All.php';
//include_once '../../inc/B_conn.php';
include_once '../../inc/B_connadmin.php';
include_once '../../inc/cache_write.php'; /*自动缓存*/
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
    global $Conn, $Connadmin, $ToHtmlID, $zwid, $SYS_Company_id; //得到全局变量
    //=========================================================================权限及相关设置信息文件包含
    include_once '../../inc/B_sys_chache.php';
    //========================================================================= 生成动态文件内容
    $Htmlcache .= '<?php' . "\n";
    $Htmlcache .= 'include_once "{$_SERVER[\'PATH_TRANSLATED\']}/session.php";' . "\n";
    $Htmlcache .= '$sys_q_zu=\'' . $sys_q_zu . "';\n";
    $Htmlcache .= '$sys_id_fz=\'' . $sys_id_fz . "';\n";
    $Htmlcache .= '$bumen_id=\'' . $bumen_id . "';\n";
    $Htmlcache .= '$bumen_name=\'' . $bumen_name . "';\n";
    $Htmlcache .= '$sys_q_fanwei=\'' . $sys_q_fanwei . "';\n";
    $Htmlcache .= '$sys_q_tianj=\'' . $sys_q_tianj . "';\n";
    $Htmlcache .= '$sys_q_xiug=\'' . $sys_q_xiug . "';\n";
    $Htmlcache .= '$sys_q_shenghe=\'' . $sys_q_shenghe . "';\n";
    $Htmlcache .= '$sys_q_pizhun=\'' . $sys_q_pizhun . "';\n";
    $Htmlcache .= '$sys_q_zhixing=\'' . $sys_q_zhixing . "';\n";
    $Htmlcache .= '$sys_q_shanc=\'' . $sys_q_shanc . "';\n";
    $Htmlcache .= '$sys_q_cak=\'' . $sys_q_cak . "';\n";
    $Htmlcache .= '$sys_q_dayin=\'' . $sys_q_dayin . "';\n";
    $Htmlcache .= '$sys_q_xiaohui=\'' . $sys_q_xiaohui . "';\n";
    $Htmlcache .= '$sys_q_huis=\'' . $sys_q_huis . "';\n";
    $Htmlcache .= '$sys_q_seid=\'' . $sys_q_seid . "';\n";
    $Htmlcache .= '$sys_q_dian=\'' . $sys_q_dian . "';\n";
    $Htmlcache .= '$regid=\'' . $regid . "';\n";
    $Htmlcache .= '$reg_name=\'' . $reg_name . "';\n";
    $Htmlcache .= '$reg_banben=\'' . $reg_banben . "';\n";
    $Htmlcache .= '$data_use=\'' . $data_use . "';\n";
    $Htmlcache .= '$sys_jlbhzt=\'' . $sys_jlbhzt . "';\n";
    $Htmlcache .= '$maxrecord=\'' . $maxrecord . "';\n";
    $Htmlcache .= 'if ( $maxrecord == \'\' )$maxrecord = 20;' . "\n";
    $Htmlcache .= '$nowlockd=\'' . $nowlockd . "';\n";
    $Htmlcache .= '$usermoban=\'' . $usermoban . "';\n";
    $Htmlcache .= '$nowgsbh=\'' . $nowgsbh . "';\n";

    $Htmlcache .= '?>';

    $current_file = str_replace( "_chache.php", "", basename( __FILE__ ) ); //得到当前文件 除”_chache.php“的文件名称
    write_cache( '2', $Htmlcache, $current_file ); //生成模版
}


mysqli_close( $Connadmin ); //关闭数据库
//http://localhost/MachineV1.0/B_moban_edit_chache.php?act=list&strmk_id=30121&page=1&zu=0&keyword=&re_id=321&zd=0&px_name=id&pxv=Desc&pok=1&bh=9001&hy=9007&scroll_left=0
?>