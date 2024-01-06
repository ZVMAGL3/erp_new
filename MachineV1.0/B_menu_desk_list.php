<?php
header( 'Content-type: text/html; charset=utf-8' ); //设定本页编码
//ini_set('error_reporting','E_ALL & ~E_NOTICE');//这里是没有定义变量时不提示错误。
include_once '../session.php';
include_once 'B_quanxian.php';
include_once '../inc/Function_All.php';
include_once '../inc/B_Config.php'; //执行接收参数及配置
include_once '../inc/B_conn.php';
include_once '../inc/B_connadmin.php';

if ( isset( $_REQUEST[ 'zwid' ] ) ) {
    $zwid = trim( $_REQUEST[ 'zwid' ] );
} else {
    $zwid = $SYS_QuanXian;
}
if ( isset( $_REQUEST[ 'nowkeyword' ] ) ) {
    $nowkeyword = $_REQUEST[ 'nowkeyword' ];
}

//==============================================接收参数开始
//$dbb = $strmkzd = $strmk = $mdb_name = $nowziduan = $bumen_id = $ZhiWei_id = $ADDcolsarry = $DELcolsarry = '';

//==============================================接收参数end=====================================

switch ( $act ) {
    case 'list': //用户菜单A常规菜单
        menuA();
        break;
    case 'list2': //用户菜单A常规菜单
        menuB();
        break;
    case 'list3': //用户菜单A常规菜单
        menuC();
        break;
    case 'menuA_date': //用户菜单A二级菜单
        // menuA_date();
        break;
    default:
        echo NoZhiLing();
}

//================================================================================================桌面菜单显示 

function menuA() {
    global $hy,$db,$db_vip,$const_q_zu,$SYS_UserName,$bh,$zwid;
    $Htmlcache = '';
    //=========================================================================权限及相关设置信息文件包含
    include_once '../inc/B_const_chache.php';
    //========================================================================= 生成动态文件内容
    $bigmenuarry = QuChong( Tablecol_list_ToStrArry( 'sys_jlmb', 'Id_MenuBigClass', "id in($const_q_cak) and sys_huis=0" ) ); //查询到实际大类菜单
    // echo $bigmenuarry;


    $const_menuaquanxian = "$const_q_cak,$const_q_tianj,$const_q_xiug,";
    $const_menuaquanxian = QuChong( $const_menuaquanxian );


    //$Htmlcache .= '<?php' . "";
    //$Htmlcache .= 'include_once "{$_SERVER[\'PATH_TRANSLATED\']}/session.php";' . "";
    //$Htmlcache .= 'include_once \'B_quanxian.php\';' . "";
    $Htmlcache .= "<div class='menudesk  nocopytext'>";
    //const_q_bigmenu='24,28,45,46,56';

    if ( '1' . $zwid == '1' ) { //为空时提示
        $Htmlcache .= "<ul><a hidefocus href='#'>&nbsp;！请联系上级授权</a></ul></li>";
    } else {
        $sql = "select id,sys_GuoChengMingChen,quanxian from `sys_menubigclass` where id in( $bigmenuarry ) and sys_huis=0 order by id Asc";
        $rs = $db_vip->query($sql);
        $i = 0;
        $NOW_menubigid = $NOW_quanxian = '';
        while ( $row = mysqli_fetch_array($rs['result']) ) {
            
            $NOW_menubigid = $row[ 'id' ];
            $NOW_quanxian = QuChong( Tablecol_list_ToStrArry( 'sys_jlmb', 'id', "Id_MenuBigClass='$NOW_menubigid' and sys_huis=0" ) ); //查询到实际大类菜单
            //$NOW_quanxian = $row[ 'quanxian' ];
            $NOW_quanxian = TWOarryy_find_chong( $NOW_quanxian, $const_menuaquanxian ); //得到交集
            $i++;
            if ( $i < 10 )$i = '0' . $i;
            $nowval = $row[ 'sys_GuoChengMingChen' ];
            $Htmlcache .= "<ul><li class='menudeskhead ellipsis1'>$nowval</li>";
            
            //echo ('</br>');
            //echo $NOW_quanxian;
            if ( '1' . $NOW_quanxian != '1' ) {
                $Htmlcache .= menuA_date( $NOW_quanxian ); //这里加载下类菜单
            }
            $Htmlcache .= "</ul>";
        };
    };
    $Htmlcache .= "</div>";
    //$nowloginxinxi=$reg_name.' > '.$const_q_zu.' > '.$SYS_UserName.'('.$bh.')';

    $Htmlcache .= "<div class='deskbottom'>$reg_name > $const_bumenname ($const_q_zu) > $SYS_UserName ($bh) <ul class='rightul'>软件名：SQPAMS V1.0&nbsp;▪&nbsp;开发商：源引力检测认证有限公司 &nbsp;▪&nbsp; SQP使命：让优秀的企业更优秀*让世界贸易成为享受！<marquee width='1px'></marquee></ul> </div>";
    $Htmlcache .= "<script>menuoverclickstyle('div.menudesk ul li.overli','overstyle','clickstyle');</script>";
    //echo $Htmlcache;
    //$Htmlcache .= ''>';
    echo $Htmlcache;
    //$current_file = str_replace( "_chache.php", "", basename( __FILE__ ) ); //得到当前文件 除”_chache.php“的文件名称
    //write_cache( '2', $Htmlcache, $current_file ); //生成模版

};
//================================================================================================桌面菜单显示 

function menuB() {
    global $hy,$db,$db_vip,$const_q_zu,$SYS_UserName,$bh,$zwid,$nowkeyword;
    $Htmlcache = '';

    //=========================================================================权限及相关设置信息文件包含
    include_once '../inc/B_const_chache.php';
    //========================================================================= 生成动态文件内容
    $bigmenuarry = QuChong( Tablecol_list_ToStrArry( 'sys_jlmb', 'Id_MenuBigClass', "id in($const_q_cak) and sys_huis=0" ) ); //查询到实际大类菜单

    $const_menuaquanxian = "$const_q_cak,$const_q_tianj,$const_q_xiug,";
    $const_menuaquanxian = QuChong( $const_menuaquanxian );


    $Htmlcache .= "<div class='shell'>";
    $Htmlcache .= "<div class='inner_shell'>";
    // $Htmlcache .= "<div class='inner_shell'>";

    // $Htmlcache .= "</div>";

    if (!$bigmenuarry) { //为空时提示
        $Htmlcache .= "<ul><a hidefocus href='#'>&nbsp;！请联系上级授权</a></ul></li>";
    } else {
        $sql = "select id,sys_GuoChengMingChen,quanxian from `sys_menubigclass` where id in($bigmenuarry) and sys_huis=0 order by id Asc";
        //echo($sql);
        $rs = $db_vip -> query($sql);
        $i = 0;
        // echo $db_vip -> numRows($rs['result']);
        while ( $row = mysqli_fetch_array( $rs['result'] ) ) {
            $HtmlcacheTem = '';
            $NOW_menubigid = $row[ 'id' ];
            // $sys_card = QuChong( Tablecol_list_ToStrArry( 'sys_jlmb','sys_card',"Id_MenuBigClass='$NOW_menubigid' and id in($const_menuaquanxian) and sys_huis=0" ) ); //查询到实际大类菜单
            //$NOW_quanxian = $row[ 'quanxian' ];
            $sql = "select id,sys_card From sys_jlmb where Id_MenuBigClass='$NOW_menubigid' and id in($const_menuaquanxian) and sys_huis=0 and sys_card LIKE '%$nowkeyword%' order by id Asc";
            $rs2 = $db_vip -> query($sql);
            if($i){
                $HtmlcacheTem .= "<div class='divider'></div>";
            }
            $i++;
            $nowval = $row[ 'sys_GuoChengMingChen' ];
            $HtmlcacheTem .= "<div class='parentNavbar'><div class='condition'>";
            $HtmlcacheTem .= "<div class='label'>". explode(" ", $nowval)[0] ."</div>";
            $HtmlcacheTem .= "<div class='parentNavbarName'>". explode(" ", $nowval)[1] ."</div>";
            $HtmlcacheTem .= "<div class='childNavbarBox'>";
            $j = 0;
            while ( $row2 = mysqli_fetch_array( $rs2['result'] ) ) {
                $j++;
                $sys_card = $row2['sys_card'];
                $re_id = $row2['id'];
                $HtmlcacheTem .= "<div class='childNavbar' onclick=\"changeright(this, 0, '$re_id', '$sys_card')\">$sys_card</div>";
            }
            $HtmlcacheTem .= "</div></div></div>";
            if($j){
                $Htmlcache .= $HtmlcacheTem;
            }
        };

    };
    $Htmlcache .= "</div>";
    $Htmlcache .= "</div>";

    $Htmlcache .= "<div class='deskbottom'>$reg_name > $const_bumenname ($const_q_zu) > $SYS_UserName ($bh) <ul class='rightul'>软件名：SQPAMS V1.0&nbsp;▪&nbsp;开发商：源引力检测认证有限公司 &nbsp;▪&nbsp; SQP使命：让优秀的企业更优秀*让世界贸易成为享受！<marquee width='1px'></marquee></ul> </div>";
    $Htmlcache .= "<script>menuoverclickstyle('div.menudesk ul li.overli','overstyle','clickstyle');</script>";
    echo $Htmlcache;

};
function menuC() {
    global $hy,$db,$db_vip,$const_q_zu,$SYS_UserName,$bh,$zwid,$nowkeyword;
    $Htmlcache = '';

    //=========================================================================权限及相关设置信息文件包含
    include_once '../inc/B_const_chache.php';
    //========================================================================= 生成动态文件内容
    $bigmenuarry = QuChong( Tablecol_list_ToStrArry( 'sys_jlmb', 'Id_MenuBigClass', "id in($const_q_cak) and sys_huis=0" ) ); //查询到实际大类菜单

    $const_menuaquanxian = "$const_q_cak,$const_q_tianj,$const_q_xiug,";
    $const_menuaquanxian = QuChong( $const_menuaquanxian );


    $Htmlcache .= "<div class='shell'>";
    $Htmlcache .= "<div class='inner_shell'>";
    // $Htmlcache .= "<div class='inner_shell'>";

    // $Htmlcache .= "</div>";

    if (!$bigmenuarry) { //为空时提示
        $Htmlcache .= "<ul><a hidefocus href='#'>&nbsp;！请联系上级授权</a></ul></li>";
    } else {
        $sql = "select id,sys_GuoChengMingChen,quanxian from `sys_menubigclass` where id in($bigmenuarry) and sys_huis=0 order by id Asc";
        //echo($sql);
        $rs = $db_vip -> query($sql);
        $i = 0;
        // echo $db_vip -> numRows($rs['result']);
        while ( $row = mysqli_fetch_array( $rs['result'] ) ) {
            $HtmlcacheTem = '';
            $NOW_menubigid = $row[ 'id' ];
            // $sys_card = QuChong( Tablecol_list_ToStrArry( 'sys_jlmb','sys_card',"Id_MenuBigClass='$NOW_menubigid' and id in($const_menuaquanxian) and sys_huis=0" ) ); //查询到实际大类菜单
            //$NOW_quanxian = $row[ 'quanxian' ];
            $sql = "select id,sys_card From sys_jlmb where Id_MenuBigClass='$NOW_menubigid' and id in($const_menuaquanxian) and sys_huis=0 and sys_card LIKE '%$nowkeyword%' order by id Asc";
            $rs2 = $db_vip -> query($sql);
            if($i){
                $HtmlcacheTem .= "<div class='divider'></div>";
            }
            $i++;
            $nowval = $row[ 'sys_GuoChengMingChen' ];
            $HtmlcacheTem .= "<div class='parentNavbar'><div class='condition'>";
            $HtmlcacheTem .= "<div class='label'>". explode(" ", $nowval)[0] ."</div>";
            $HtmlcacheTem .= "<div class='parentNavbarName'>". explode(" ", $nowval)[1] ."</div>";
            $HtmlcacheTem .= "<div class='childNavbarBox'>";
            $j = 0;
            while ( $row2 = mysqli_fetch_array( $rs2['result'] ) ) {
                $j++;
                $sys_card = $row2['sys_card'];
                $re_id = $row2['id'];
                $HtmlcacheTem .= "<div class='childNavbar' onclick=\"LiuCheng_choose( '$re_id', '$sys_card')\">$sys_card</div>";
            }
            $HtmlcacheTem .= "</div></div></div>";
            if($j){
                $Htmlcache .= $HtmlcacheTem;
            }
        };

    };
    $Htmlcache .= "</div>";
    $Htmlcache .= "</div>";

    $Htmlcache .= "<div class='deskbottom'>$reg_name > $const_bumenname ($const_q_zu) > $SYS_UserName ($bh) <ul class='rightul'>软件名：SQPAMS V1.0&nbsp;▪&nbsp;开发商：源引力检测认证有限公司 &nbsp;▪&nbsp; SQP使命：让优秀的企业更优秀*让世界贸易成为享受！<marquee width='1px'></marquee></ul> </div>";
    $Htmlcache .= "<script>menuoverclickstyle('div.menudesk ul li.overli','overstyle','clickstyle');</script>";
    echo $Htmlcache;

};
//================================================================================================//菜单二级菜单
function menuA_date( $nsquanxian ) {
    global $db_vip, $re_id;
    $sql = "select id,menuimg,banben,sys_card,startdate,xiugaicishu,mdb_name_SYS From sys_jlmb where sys_huis=0 and id in($nsquanxian) order by sys_card Asc";
    //echo $sql;
    $rs = $db_vip->query($sql);
    //$nowrscount2=mysqli_num_rows($rs2);//统计数量 无用

     $re_mdb_name_SYS = $re_id = $ttbanben = $ttxiugaicishu = $ttcard = $ttstartdate = $strdesk = '';
    while ( $row = mysqli_fetch_assoc($rs['result']) ) {

        $re_mdb_name_SYS = $row[ 'mdb_name_SYS' ]; //初始表
        $re_id = $row[ 'id' ];
        $ttbanben = $row[ 'banben' ];
        if ( '1' . $ttbanben == '1' )$ttbanben = 'A';
        $ttxiugaicishu = $row[ 'xiugaicishu' ];
        if ( '1' . $ttxiugaicishu == '1' )$ttxiugaicishu = 0;
        $ttcard = $row[ 'sys_card' ];
        if ( $ttcard <> '' )$ttcard = $ttcard . ' ';
        $ttstartdate = $row[ 'startdate' ]; //条款
        if ( $ttstartdate <> '' )$ttstartdate = $ttstartdate;
        //if ( $const_q_cak >= 0 or $const_q_tianj >= 0 or $const_q_xiug >= 0 or $const_q_shanc >= 0 or $const_q_dayin >= 0 or $const_q_huis >= 0 ) {
        $nowcard = $row[ 'sys_card' ];
        $nowmenuimg = $row[ 'menuimg' ];
        //$nowclickhtml="alert('0')";
        if ( '1' . $nowmenuimg == '1' )$nowmenuimg = 'images/menu/edge.png';
        $strdesk .= "<li cus='$re_mdb_name_SYS'   onclick=\"changeright(this,0,{$re_id},'{$nowcard}');\" class='overli'><div class='head00'><img src=' $nowmenuimg'  height='30' alt=''/></div><div class='head01 ellipsis1' title='$nowcard'>$nowcard</div></li>";
    };
    return $strdesk;

};
mysqli_close( $Conn ); //关闭数据库
//mysqli_close($Connadmin);//关闭云数据库
?>