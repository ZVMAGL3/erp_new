<?php

include_once '../../session.php'; //session记录
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once '../../inc/Function_All.php'; //
include_once '../../inc/Function_list.php'; //
include_once '../../inc/B_Config.php'; //执行接收参数及配置
include_once '../../inc/B_conn.php'; //
include_once '../../inc/B_connadmin.php'; //
include_once '../../inc/cache_write.php'; /*自动缓存*/
error_reporting(E_ALL);
ini_set('display_errors', '1');

//=========================================================================得到记录模版设定信息

if ( $re_id != 0 ) {
    $rs = $sql = $r_cow_height = $databiao1 = $databiao_SYS1 = $mdb_use_type = $SYS_ALL_ziduan_list = '';

    $sql = "select ul_row_height,mdb_name_SYS,Mtiaoshu,shaixuan From Sys_jlmb where id='$re_id'";
    $rs = mysqli_query( $Conn, $sql );
    $row = mysqli_fetch_array( $rs );
    $r_cow_height = intval( $row[ 'ul_row_height' ] );
    if ( '1' . $r_cow_height == '1'
        or $r_cow_height == 0 )$r_cow_height = 28;

    $databiao = $row[ 'mdb_name_SYS' ]; //原数据表名
    if(!$databiao){
        echo '没有该表,联系管理员处理!';
        exit();
    }
    $Conn = ChangeConn( $databiao ); //选择数据库

    $const_shaixuan = $row[ 'shaixuan' ]; //筛选代码
    //0【字段中文名称】,1【显示宽度】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】
    $SYS_ALL_ziduan = Tablecol_list_beizhu_cols( $databiao, 11 ); //显示列清单
    $shuoding_num_list = Tablecol_list_beizhu_cols( $databiao, 12 ); //锁定列清单

    $SYS_ALL_ziduan_list = QuChong( 'id,' . trim( $SYS_ALL_ziduan, ',' ) . ',' . trim( $shuoding_num_list, ',' ) . ',sys_id_login,sys_shenpi_all' ); //含Id字段
    $SYS_ALL_ziduan_list = move_arrynull( $SYS_ALL_ziduan_list ); //去空字符串


    $xianshi_ZD_num = Uboundarryy( $SYS_ALL_ziduan, ',' ); //查询查示的字段列数
    $xianshi_KD_num = count_col_num( $databiao, 5 ) + 300; //查询 显示列 宽度和

    $Nowmaxrecord = intval( $row[ 'Mtiaoshu' ] ); //页显示数
    //echo $xianshi_ZD_Arry;
    if (!isset($maxrecord) || $maxrecord <= 0 )$maxrecord = 20;
    mysqli_free_result( $rs ); //释放内存
    //echo ($SQX_xianshi.'</br>');
};

//$nowkeyword=iconv('gbk','utf-8',$nowkeyword);//这里执行转码为utf-8
$page_first = ( $page - 1 ) * $maxrecord + 1; //开始的记录数
$page_end = $page_first + $maxrecord - 1; //结束的记录数
$nowjilucont = $page_end - $page_first; //记录总数

//echo $xianshi_ZD_Arry;

if ( $act = 'list' ) {
    lists();
} else {
    echo( '输入有误' );
};

//};

//==========================================================================================中间表格数据
function lists() {
    $Htmlcache = $Htmlcache07 = '';
    global $reg_name, $reg_database, $reg_banben, $regid, $hy, $bh, $re_id, $ToHtmlID, $big_id, $const_jlbhzt, $maxrecord, $nowlockd, $nowgsbh, $const_zcxh, $nowzzzt, $userjib, $SYS_UserName, $nowbianhao, $const_id_fz, $SYS_QuanXian, $const_id_bumen, $const_q_tianj, $const_q_xiug, $const_q_shanc, $const_q_cak, $const_q_dayin, $const_q_huis, $const_q_seid, $const_q_dian, $const_q_shenghe, $const_q_pizhun, $const_q_zu, $databiao, $ToHtmlID, $SYS_ALL_ziduan_list, $nowkeyword, $Conn, $xianshi_ZD_Arry, $xianshi_KD_num, $r_cow_height, $nowjilucont, $page_first, $page_end, $startime, $xt_m_ziduan, $xt_m_ziduan_Name, $xianshi_ZD_num, $const_shaixuan, $page, $act, $nowzu, $px_ziduan, $shuoding_num_list, $zd, $pxv, $pok; //全局变量
    //echo $startime;

    $IsConn = IsConn( $databiao ); //查出所属表的数据库
    $zu_all_list = zu_all_list( $re_id ); //查询到分组清单
    $FormattingXianShi_idlist = FormattingXianShi_idlist( $Conn, $databiao, $ToHtmlID ); //显示界面格式化样式

    $rs = $strsql = $rsArray = $maxsu = $id = $now_id = $tdqaqclass = $III = $ES_xianshi = $S_xianshi = $c_kuandu = $c_leixin = $colls2 = $classss = $II = $IISS = $suju = $sql_all_id_list = $sql2 = $row1 = $nowidhtml = "";
    //-----------------------------------------------------缓存生成
    $Htmlcache .= '<?php' . "\n";
    $Htmlcache .= 'header( "Content-type: text/html; charset=utf-8" ); //设定本页编码' . "\n";
    $Htmlcache .= 'include_once "{$_SERVER[\'PATH_TRANSLATED\']}/session.php";' . "\n";
    $Htmlcache .= 'include_once \'M_quanxian.php\';' . "\n";
    $Htmlcache .= 'include_once \'../../inc/Function_All.php\';' . "\n";
    $Htmlcache .= 'include_once \'../../inc/Function_list.php\';' . "\n";
    $Htmlcache .= 'include_once \'../../inc/B_Config.php\';' . "\n";
    $Htmlcache .= 'include_once \'../../inc/B_' . $IsConn . '.php\';' . "\n";

    $Htmlcache .= '$startime = microtime( true ); //这里计算时间开始' . "\n\n";

    $Htmlcache .= 'global $const_q_cak,$ToHtmlID,$const_q_shanc,$const_q_xiug,$nowkeyword,$px_ziduan,$pxv,$' . $IsConn . ';' . "\n"
    . '$r_cow_height="' . $r_cow_height . '";' . "\n"
    . '$databiao="' . $databiao . '";' . "\n"
    . '$const_shaixuan="' . $const_shaixuan . '";' . "\n"
    . '$SYS_ALL_ziduan_list="' . $SYS_ALL_ziduan_list . '";' . "\n"
    . '$xianshi_ZD_num="' . $xianshi_ZD_num . '";' . "\n"
    . '$xianshi_KD_num="' . $xianshi_KD_num . '";' . "\n"
    . '$shuoding_num_list="' . $shuoding_num_list . '";
	   $maxrecord="' . $maxrecord . '";
       $FormattingXianShi_idlist="' . $FormattingXianShi_idlist . '";
	   $zu_all_list="' . $zu_all_list . '";
	   if ( isset( $_REQUEST[ \'page\' ] ) ){$page = intval( $_REQUEST[ \'page\' ] );}else{$page = 1;};                                                                //页码接收
	
	   if ( isset( $_REQUEST[ \'sys_guanxibiao_id\' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ \'sys_guanxibiao_id\' ] );}else{$sys_guanxibiao_id = \'\';};         //关系表id
	   if ( isset( $_REQUEST[ \'GuanXi_id\' ] ) ){$GuanXi_id = intval( $_REQUEST[ \'GuanXi_id\' ] );}else{$GuanXi_id = "";};   //关系列id
	   if ( isset( $_REQUEST[ \'ToHtmlID\' ] ) ){$ToHtmlID = $_REQUEST[ \'ToHtmlID\' ];};                                                                              //显示页面
	   if ( isset( $_REQUEST[ \'huis\' ] ) ){$huis = intval( $_REQUEST[ \'huis\' ] );}else{$huis = 0;};                                                                //1回收站0为不回收
	   //if ( $huis == 1){$ToHtmlID=\'HUIS_\'.$ToHtmlID;};                                                                                                               //是否为回收站0为不回收
	   if ($page <= 0){$page=1;};
	   $page_first = ( $page - 1 ) * $maxrecord + 1;
	   $page_end = $page_first + $maxrecord - 1;
	   $nowjilucont = $page_end - $page_first;
	   if ( isset( $_REQUEST[ \'sys_const_pagetype\' ] ) ){$sys_const_pagetype = $_REQUEST[ \'sys_const_pagetype\' ];}else{$sys_const_pagetype = \'listpage\';};
	' . "\n\n";


    //-----------------------------------------------------缓存生成
    $Htmlcache .= 'if ( "1" . $databiao == "1" ) {' . "\n";
    $Htmlcache .= '   echo nonelist();' . "\n";
    $Htmlcache .= '} else {' . "\n";
    $Tablecol_list = move_arrynull( Tablecol_list( $databiao ) ); //得到表的字段清单
    if ( $Tablecol_list == '' ) {
        $Tablecol_list = 'sys_nowbh';
    }

    $sql2 = sql_all_id_cache( $databiao, 'id', $nowkeyword ); //这里得到查询id清单的sql
    $Htmlcache .= '   $Tablecol_list="' . $Tablecol_list . '";' . "\n\n"; //得到字段的清单
    $Htmlcache .= '   $sql2 = "' . $sql2 . '"; //这里得到查询id清单的sql' . "\n";
    $Htmlcache .= '    if($sys_guanxibiao_id != \'\' && $GuanXi_id != ""){$sql2 .=" and  sys_gx_id_{$sys_guanxibiao_id}=\'{$GuanXi_id}\'";}' . "\n";
    $Htmlcache .= '   $sql2 =sql_search($databiao,$sql2,$nowkeyword, 0);' . "\n";
    $Htmlcache .= '   $sql2 .= " order by $px_ziduan $pxv"; //这里得到排序' . "\n";
    $Htmlcache .= '   $sql2 = "select id from ($sql2) as t where rownum between $page_first and  $page_end ";' . "\n";
    $Htmlcache .= '   $sql_all_id_list = sql_all_id_list($sql2,$' . $IsConn . ');' . "\n\n";
    $Htmlcache .= '   if ( !$sql_all_id_list ) {' . "\n";
    $Htmlcache .= '      echo( "<li><a href=\'#\'><font color=\'#CCC\'>Sorry,  No Data！</font></a></li>" );' . "\n";
    $Htmlcache .= '   } else { ' . "\n";
    //$shuoding_num=1;
    $SYS_ALL_ziduan_list = $SYS_ALL_ziduan_list . ',' . $shuoding_num_list;
    $sql = sql_all_cache( $databiao, $SYS_ALL_ziduan_list, 0, $nowkeyword, 0 ); //这里查询到最终数据sql
    //echo $sql;
    //exit;
    $Htmlcache .= '      $sql = "' . $sql . '";' . "\n";
    $Htmlcache .= '      $sql .= "' . ' order by $px_ziduan $pxv' . '";' . "\n";
    //$Htmlcache .= '   echo $sql;' . "\n";
    $Htmlcache .= '      $rs = mysqli_query($' . $IsConn . ', $sql );' . "\n";

    //-----------------------------------------------------缓存生成

    $Htmlcache .= '      $i = 0;' . "\n";
    $Htmlcache .= '      while ( $row = mysqli_fetch_array( $rs ) ) {' . "\n";
    $Htmlcache .= '        $now_id_login = $row[ "sys_id_login" ]; //得到员工工号 ' . "\n";
    $Htmlcache .= '        if ( $const_q_cak >= 0 or $now_id_login == $bh ) {' . "\n";
    $Htmlcache .= '            $i++;' . "\n";
    $Htmlcache .= '            $now_id = $row[ "id" ];' . "\n";
    $Htmlcache .= '            $now_shenpi_all = $row[ "sys_shenpi_all" ]; //审批' . "\n";
    $Htmlcache .= '            $tdqaqclass = "tdsclass" . $i;' . "\n";
    $Htmlcache07 = table_cols_cache_mobile( $Conn, $databiao, $Tablecol_list ); //这里得到所有例的值
    //echo $Htmlcache07;
    $Htmlcache .= $Htmlcache07 . "\n";
    $Htmlcache .= '        };' . "\n";
    $Htmlcache .= '      };//while end' . "\n";
    $Htmlcache .= '      mysqli_free_result( $rs ); //释放内存' . "\n";
    $Htmlcache .= '   };' . "\n";


    $Htmlcache .= '   $endtime = microtime( true ); //这里获取程序执行结束时间 //计算数据加载时间' . "\n";
    $Htmlcache .= '   $ymdate = $endtime - $startime;' . "\n";
    $Htmlcache .= '   $ymdate = round( $ymdate, 3 );' . "\n";
    $nowtongji = "'#" . $ToHtmlID . " #tongji'";
    $Htmlcache .= '   echo \'<script>$("#loadingtimes").html("\'.$ymdate.\'ms");list_data_end_mobile("\'.$sys_const_pagetype.\'","'.$ToHtmlID.'");</script>\';' . "\n";
    $Htmlcache .= '};' . "\n";
    //$Htmlcache .= " echo( \"<script>ListLoadEND('".$ToHtmlID."');</script>\" );" . "\n";
    $Htmlcache .= 'mysqli_close( $' . $IsConn . ' ); //关闭数据库' . "\n";
    $Htmlcache .= '?>' . "\n";
    //echo $Htmlcache02;
    //lists_data();
    $current_file = str_replace( "_chache.php", "", basename( __FILE__ ) ); //得到当前文件 除”_chache.php“的文件名称
    write_cache( '1', $Htmlcache, $current_file ); //生成模版

};

mysqli_close( $Conn ); //关闭数据库
//mysqli_close($Connadmin);//关闭云数据库
//http://localhost/MachineV1.0/B_moban_list_chache.php?act=list&page=1&zu=0&keyword=&re_id=321&zd=0&px_name=id&pxv=Desc&pok=1&bh=9001&hy=9007&scroll_left=0
//http://localhost/MachineV1.0/cache/9007/B_moban_list/B_moban_list_321.php?act=list&page=1&zu=0&keyword=&re_id=321&zd=0&px_name=id&pxv=Desc&pok=1&bh=9001&hy=9007&scroll_left=0
?>