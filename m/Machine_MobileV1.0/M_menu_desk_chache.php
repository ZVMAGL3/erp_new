<?php

header( 'Content-type: text/html; charset=utf-8' ); //设定本页编码
//ini_set('error_reporting','E_ALL & ~E_NOTICE');//这里是没有定义变量时不提示错误。
include_once '../../session.php';
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once '../../inc/Function_All.php';
include_once '../../inc/B_Config.php'; //执行接收参数及配置
include_once '../../inc/cache_write.php'; /*自动缓存*/
include_once '../../inc/B_conn.php';
include_once '../../inc/B_connadmin.php';

$asd = $nsquanxian;
if ( isset( $_REQUEST[ 'zwid' ] ) ) {
    $zwid = trim( $_REQUEST[ 'zwid' ] );
} else {
    $zwid = $SYS_QuanXian;
}
//echo $zwid;
if ( isset( $_REQUEST[ 'act' ] ) ) {
    $act = $_REQUEST[ 'act' ];
}

//==============================================接收参数开始
//$dbb = $strmkzd = $strmk = $mdb_name = $nowziduan = $bumen_id = $ZhiWei_id = $ADDcolsarry = $DELcolsarry = '';

//==============================================接收参数end=====================================

switch ( $act ) {
    case 'list': //用户菜单A常规菜单
        menuA();
        break;
    // case 'menuA_date': //用户菜单A二级菜单
    //     menuA_date();
    //     break;
    default:
        echo NoZhiLing();
};

//================================================================================================桌面菜单显示 

function menuA() {
    $Htmlcache = '';
    global $Conn, $Connadmin, $ToHtmlID, $zwid, $SYS_Company_id; //得到全局变量
    //=========================================================================权限及相关设置信息文件包含
    include_once '../../inc/B_sys_chache.php';
    //========================================================================= 生成动态文件内容
    $bigmenuarry = QuChong( Tablecol_list_ToStrArry( 'sys_jlmb', 'Id_MenuBigClass', "id in($sys_q_cak) and sys_huis=0" ) ); //查询到实际大类菜单
    //echo $bigmenuarry;
    $sys_menuaquanxian = "$sys_q_cak,$sys_q_tianj,$sys_q_xiug,";
    $sys_menuaquanxian = QuChong( $sys_menuaquanxian );
    $Htmlcache .= '<?php' . "\n";
    $Htmlcache .= 'include_once "{$_SERVER[\'PATH_TRANSLATED\']}/session.php";' . "\n";
    $Htmlcache .= 'include_once \'M_quanxian.php\';' . "\n";
    $Htmlcache .= "echo\"<div class='menudesk  nocopytext'>\n";
    //sys_q_bigmenu='24,28,45,46,56';

    if ( '1' . $zwid == '1' ) { //为空时提示
        $Htmlcache .= "<ul><a hidefocus href='#'>&nbsp;！请联系上级授权</a></ul></li>";
    } else {
        $sql = "select id,sys_GuoChengMingChen,quanxian from `sys_menubigclass` where id in($bigmenuarry) and sys_huis=0 order by id Asc";
        //echo($sql);
        $rs = mysqli_query( $Conn, $sql );
        $nowrscount = mysqli_num_rows( $rs ); //统计数量 无用

        $i = 0;
        $NOW_menubigid = $NOW_quanxian = '';
        while ( $row = mysqli_fetch_array( $rs ) ) {
            $NOW_menubigid = $row[ 'id' ];
            $NOW_quanxian = QuChong( Tablecol_list_ToStrArry( 'sys_jlmb', 'id', "Id_MenuBigClass='$NOW_menubigid' and sys_huis=0" ) ); //查询到实际大类菜单
            //$NOW_quanxian = $row[ 'quanxian' ];
            $NOW_quanxian = TWOarryy_find_chong( $NOW_quanxian, $sys_menuaquanxian ); //得到交集
            $i++;
            if ( $i < 10 )$i = '0' . $i;
            $nowval = $row[ 'sys_GuoChengMingChen' ];
            $Htmlcache .= "\n<a class='line'>&nbsp;</a><a class='biaoti'><li class='menudeskhead ellipsis1'><font class='deskbh'>$i&nbsp;</font>  $nowval</li>\n";
            //echo ('</br>');
            //echo $NOW_quanxian;
            if ( '1' . $NOW_quanxian != '1' ) {
                $Htmlcache .= menuA_date( $NOW_quanxian ); //这里加载下类菜单
            };
            $Htmlcache .= "</a>\n";

        };
        mysqli_free_result( $rs ); //释放内存
    };
    //$Htmlcache .= "\n</div>\n\";\n";
    $Htmlcache .= "\n</div>\n<script>menuoverclickstyle('div.menudesk ul li.overli','overstyle','clickstyle');</script>\";\n";
    //echo $Htmlcache;
    $Htmlcache .= '?>';

    $current_file = str_replace( "_chache.php", "", basename( __FILE__ ) ); //得到当前文件 除”_chache.php“的文件名称
    write_cache( '2', $Htmlcache, $current_file ); //生成模版
    mysqli_close( $Connadmin ); //关闭云数据库
};

//================================================================================================//菜单二级菜单
function menuA_date( $nsquanxian ) {
    global $sys_jlbhzt, $Conn, $nowgsbh, $re_id, $sys_q_xiug, $sys_q_shanc, $sys_q_cak, $sys_q_dayin, $sys_q_huis, $sys_q_smallmenu;
    $rs2 = $sql2 = $nowrscount2 = $row2 = $ii = '';
    $sql2 = "select id,menuimg,banben,sys_card,startdate,xiugaicishu,datapage_list,mdb_name_SYS From sys_jlmb where sys_huis=0 and id in($nsquanxian) order by sys_card Asc";
    //echo $sql;
    $rs2 = mysqli_query( $Conn, $sql2 );
    //$nowrscount2=mysqli_num_rows($rs2);//统计数量 无用

    $re_datapage_list = $re_SYS_ALL_ziduan_list = $re_mdb_name_SYS = $re_id = $nowgsbh2 = $sys_jlbhzt2 = $ttusername = $ttbanben = $ttxiugaicishu = $ttbanci = $ttcard = $ttstartdate = $tt = $strdesk = '';
    while ( $row2 = mysqli_fetch_array( $rs2 ) ) {

        $re_datapage_list = $row2[ 'datapage_list' ];
        $re_mdb_name_SYS = $row2[ 'mdb_name_SYS' ]; //初始表
        $re_id = $row2[ 'id' ];
        if ( $nowgsbh != '' )$nowgsbh2 = $nowgsbh . '.';
        if ( $sys_jlbhzt <> '' )$sys_jlbhzt2 = $sys_jlbhzt . '-';
        $ttusername = $row2[ 'id' ] . '-';
        $ttbanben = $row2[ 'banben' ];
        if ( '1' . $ttbanben == '1' )$ttbanben = 'A';
        $ttxiugaicishu = $row2[ 'xiugaicishu' ];
        if ( '1' . $ttxiugaicishu == '1' )$ttxiugaicishu = 0;
        $ttbanci = $ttbanben . '/' . $ttxiugaicishu . ' ';
        $ttcard = $row2[ 'sys_card' ];
        if ( $ttcard <> '' )$ttcard = $ttcard . ' ';
        $ttstartdate = $row2[ 'startdate' ]; //条款
        if ( $ttstartdate <> '' )$ttstartdate = $ttstartdate;
        //$tt='&nbsp;|<font color=#FF0000 title=该记录文件编号><strong>'.$nowgsbh2.$sys_jlbhzt2.$ttusername.$ttbanci.'</strong></font>'.$ttcard.$ttstartdate
        $tt = "";
        $nowcard = $row2[ 'sys_card' ];
        $nowmenuimg = $row2[ 'menuimg' ];

        if ( '1' . $nowmenuimg == '1' ) {
            $nowmenuimg = 'theme/default/images/note.png';
        } else {
            $nowmenuimg = 'theme/default/images/' . $nowmenuimg;
        };
        $strdesk .= "<a href='M_moban.php?re_id=$re_id'><ul><h1><img src='$nowmenuimg' class='logo'></h1><h2>$nowcard</h2></ul></a>\n";


    };
    return $strdesk;
    mysqli_free_result( $rs2 ); //释放内存

};
mysqli_close( $Conn ); //关闭数据库
//mysqli_close($Connadmin);//关闭云数据库
?>