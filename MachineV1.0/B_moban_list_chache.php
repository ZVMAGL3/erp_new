<?php

include_once '../session.php'; //session记录
include_once 'B_quanxian.php'; //接收职位权限信息
include_once '../inc/Function_All.php';
include_once '../inc/Function_list.php';
include_once '../inc/B_Config.php';              //执行接收参数及配置
include_once '../inc/B_conn.php';
include_once '../inc/B_connadmin.php';
include_once '../inc/cache_write.php';           /*自动缓存*/

//=========================================================================得到记录模版设定信息

if ( $re_id != 0 ) {
	$rs = $sql = $r_cow_height = $databiao1 = $databiao_SYS1 = $mdb_use_type = $SYS_ALL_ziduan_list = '';

	$sql = "select ul_row_height,mdb_name_SYS,Mtiaoshu,shaixuan From Sys_jlmb where id='$re_id'";
	// echo $sql;
	$rs = mysqli_query( $Conn, $sql );
	$row = mysqli_fetch_array( $rs );
	$r_cow_height = intval( $row[ 'ul_row_height' ] );
	if ( '1' . $r_cow_height == '1'	or $r_cow_height == 0 )$r_cow_height = 28;

	if($databiao = $row[ 'mdb_name_SYS' ]){
		$ConnXXX=ChangeConn($databiao);//选择数据库
		$sys_shaixuan = $row[ 'shaixuan' ]; //筛选代码
		//$wheretext = "mdb_name='$databiao' and qx_xianshi=1";         //查询显示的字段条件
		//0【字段中文名称】,1【显示宽度】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】
		$SYS_ALL_ziduan = Tablecol_list_beizhu_cols( $databiao, 5 );     //显示列清单
		$SYS_ALL_ziduan_list = QuChong( 'id,' . $SYS_ALL_ziduan ); //含Id字段
		$SYS_ALL_ziduan_list = move_arrynull( $SYS_ALL_ziduan_list ); //去空字符串
		$xianshi_ZD_num = Uboundarryy( $SYS_ALL_ziduan, ',' ); //查询查示的字段列数
		$xianshi_KD_num =count_col_num( $databiao, 5 ); //查询到宽度和; //查询 显示列 宽度和
		$shuoding_num = Uboundarryy( Tablecol_list_beizhu_cols( $databiao, 6 ), ',' );//查询锁定例清单后进行统计个数
		if ( $shuoding_num == 0 )$shuoding_num = 1; //默认锁定第一列
		$maxrecord = intval( $row[ 'Mtiaoshu' ] ); //页显示数
		
		if ( $maxrecord  <= 0 )$maxrecord = 20;
		mysqli_free_result( $rs ); //释放内存
		//echo ($SQX_xianshi.'</br>');
	}else{
		echo '没有该表,联系管理员处理!';
		exit();
	} //原数据表名

};
//$nowkeyword=iconv('gbk','utf-8',$nowkeyword);//这里执行转码为utf-8
$page_first = ( $page - 1 ) * $maxrecord + 1; //开始的记录数
$page_end = $page_first + $maxrecord - 1; //结束的记录数
$nowjilucont = $page_end - $page_first; //记录总数

if ( $act = 'list' ) {
	lists();
} else {
	echo( '输入有误' );
};

//==========================================================================================中间表格数据
function lists() {
	$Htmlcache07= '';
	global $Connadmin, $reg_banben, $regid, $hy, $bh, $re_id, $big_id, $sys_jlbhzt, $maxrecord, $nowlockd, $nowgsbh, $sys_zcxh, $nowzzzt, $userjib, $SYS_UserName, $nowbianhao, $sys_id_fz, $SYS_QuanXian, $bumen_id, $sys_q_tianj, $sys_q_xiug, $sys_q_shanc, $sys_q_cak, $sys_q_dayin, $sys_q_huis, $sys_q_seid, $sys_q_dian, $sys_q_shenghe, $sys_q_pizhun, $sys_q_zu, $databiao, $ToHtmlID, $SYS_ALL_ziduan_list, $nowkeyword, $ConnXXX, $xianshi_ZD_Arry, $xianshi_KD_num, $r_cow_height, $shuoding_num, $nowjilucont, $page_first, $page_end, $startime, $xt_m_ziduan, $xt_m_ziduan_Name, $xianshi_ZD_num, $sys_shaixuan, $page, $act, $nowzu, $px_ziduan, $zd, $pxv, $pok; //全局变量
	//echo $startime;
	$IsConn=IsConn($databiao);            //查出所属表的数据库
    $zu_all_list=zu_all_list($re_id);     //查询到分组清单
	$FormattingXianShi_idlist=FormattingXianShi_idlist($ConnXXX,$databiao,$ToHtmlID);    //显示界面格式化样式
	
	//-----------------------------------------------------缓存生成
	$Htmlcache ='<?php'."\n";
	$Htmlcache.='header( "Content-type: text/html; charset=utf-8" ); //设定本页编码'."\n";
    $Htmlcache.='include_once "{$_SERVER[\'PATH_TRANSLATED\']}/session.php";'."\n";
	$Htmlcache.='include_once "B_quanxian.php";'."\n";
	$Htmlcache.='include_once "{$_SERVER[\'PATH_TRANSLATED\']}/inc/Function_All.php";'."\n";
    $Htmlcache.='include_once "{$_SERVER[\'PATH_TRANSLATED\']}/inc/Function_list.php";'."\n";
	$Htmlcache.='include_once "{$_SERVER[\'PATH_TRANSLATED\']}/inc/B_Config.php";'."\n";
	$Htmlcache.='include_once "{$_SERVER[\'PATH_TRANSLATED\']}/inc/B_'.$IsConn.'.php";'."\n";
	$Htmlcache.='$startime = microtime( true ); //这里计算时间开始'."\n\n";
	$Htmlcache .= 'global $sys_q_cak,$ToHtmlID,$sys_q_shanc,$sys_q_xiug,$nowkeyword,$px_ziduan,$pxv,$'.$IsConn.',$hy;
	$r_cow_height="' . $r_cow_height . '";
	$databiao="' . $databiao . '";
	$sys_shaixuan="' . $sys_shaixuan . '";
	$SYS_ALL_ziduan_list="' . $SYS_ALL_ziduan_list . '";
	$xianshi_ZD_num="' . $xianshi_ZD_num . '";
	$xianshi_KD_num="' . $xianshi_KD_num . '";
	$shuoding_num="' . $shuoding_num . '";
	$maxrecord="' . $maxrecord . '";
	$FormattingXianShi_idlist="' . $FormattingXianShi_idlist . '";
	$zu_all_list="' . $zu_all_list . '";
	if ( isset( $_REQUEST[ \'page\' ] ) ){$page = intval( $_REQUEST[ \'page\' ] );}else{$page = 1;};//页码接收
	if ( isset( $_REQUEST[ \'sys_guanxibiao_id\' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ \'sys_guanxibiao_id\' ] );}else{$sys_guanxibiao_id = \'\';};         //关系表re_id
	if ( isset( $_REQUEST[ \'GuanXi_id\' ] ) ){$GuanXi_id = intval( $_REQUEST[ \'GuanXi_id\' ] );}else{$GuanXi_id = "";};                                           //关系表id
	if ( isset( $_REQUEST[ \'ToHtmlID\' ] ) ){$ToHtmlID = $_REQUEST[ \'ToHtmlID\' ];};                                                                              //显示页面
	if ( isset( $_REQUEST[ \'huis\' ] ) ){$huis = intval( $_REQUEST[ \'huis\' ] );}else{$huis = 0;};                                                                //1回收站0为不回收
	//if ( $huis == 1){$ToHtmlID=\'HUIS_\'.$ToHtmlID;};                                                                                                             //是否为回收站0为不回收
	if ($page <= 0){$page=1;};
	$page_first = ( $page - 1 ) * $maxrecord + 1;
	$page_end = $page_first + $maxrecord - 1;
	$nowjilucont = $page_end - $page_first;' . "\n\n";
    
	
	//-----------------------------------------------------缓存生成
	$Htmlcache .= 'if ( "1" . $databiao == "1" ) {' . "\n";
	$Htmlcache .= '   echo nonelist();' . "\n";
	$Htmlcache .= '} else {' . "\n";
	$Tablecol_list = Tablecol_list( $databiao ); //得到表的字段清单
	if ($Tablecol_list==''){
		$Tablecol_list='sys_nowbh';
	}
	$sql2 = sql_all_id_cache( $databiao, 'id', $nowkeyword); //这里得到查询id清单的sql
	//$sql_all_id_list = sql_all_id_list( $sql2 );
	//echo $sql2;
	//exit;
	$Htmlcache .= '   $Tablecol_list="' . $Tablecol_list . '";' . "\n\n"; //得到字段的清单
    $Htmlcache .= '   $sql2 = "'.$sql2.'"; //这里得到查询id清单的sql' . "\n";
	$Htmlcache .= '   if($sys_guanxibiao_id != \'\' && $GuanXi_id != ""){$sql2 .=" and  sys_gx_id_{$sys_guanxibiao_id}=\'{$GuanXi_id}\'";}'."\n";
	$Htmlcache .= '   $sql2 =sql_search($databiao,$sql2,$nowkeyword, 0);' . "\n";
	$Htmlcache .= '   $sql2 .= " order by $px_ziduan $pxv"; //这里得到排序' . "\n";
	$Htmlcache .= '   $sql2 = "select id from ($sql2) as t where rownum between $page_first and  $page_end ";' . "\n";
	$Htmlcache .= '   $sql_all_id_list = sql_all_id_list($sql2,$'.$IsConn.' );' . "\n\n";
	$Htmlcache .= '   if ( !$sql_all_id_list ) {' . "\n";
	$Htmlcache .= '      echo( "<div class=\'nodata\' tabindex=\'-1\'><div class=\'nodata_center\'><i class=\'fa fa-nodata\' style=\'margin-top:-1px\'></i>&nbsp; Sorry, No Data！</div></div>" );' . "\n";
	$Htmlcache .= '   } else { ' . "\n";
	//$shuoding_num=1;
	$sql = sql_all_cache( $databiao, $SYS_ALL_ziduan_list, 0, $nowkeyword, 0); //这里查询到最终数据sql
	//echo $sql;
	//exit;
	$Htmlcache .= '      $sql = "'.$sql. '";'."\n";
	$Htmlcache .= '      $sql .= "'.' order by $px_ziduan $pxv'. '";'."\n";
	//$Htmlcache .= '   echo $sql;' . "\n";
	$Htmlcache .= '      $rs = mysqli_query( $'.$IsConn.', $sql );' . "\n";

	//-----------------------------------------------------缓存生成
	$Htmlcache .= "      echo( \"<div id='para'  tabindex='-1' class='tables'  style='border:0;border-bottom:1px solid #CCC;min-width:100%;width:$xianshi_KD_num'>\" );" . "\n";
	$Htmlcache .= '
	      $i = 0;
	      while ( $row = mysqli_fetch_array( $rs ) ) {
	      if ( $sys_q_cak >= 0 ) {
	        $i++;
	        $now_id = $row[ "id" ];
	        $tdqaqclass = "tdsclass" . $i;
	        echo( "<ul class=\'ul_over_" . $i . "\' overid=\'ul_over_" . $i . "\' " );
	        //if ($sys_q_xiug > -1){//有权限时
			    $part_ToHtmlID = str_replace(\'E_\',\'\', substr($ToHtmlID,0,strlen($ToHtmlID)-strlen(\'_MenuDiv_\'.$re_id)) );
	            if(substr($ToHtmlID,0,13)==\'E_DeskMenuDiv\'){
				    echo( "  onDblclick=GetPage(this,\'$now_id\',\'$ToHtmlID\',\'$part_ToHtmlID\')" );
			    }else{
	                echo( "  onDblclick=edit_data(this,\'$now_id\',\'$ToHtmlID\',\'$hy\')");
				}
			//}
			echo( "  style=\'height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;min-width:100%;\'> " );
			echo( "<li class=\'cols1 shuodingli\'  title=\'$now_id\'  style=\'height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;text-align:center;\'></li>" );
	
	' . "\n";
	//显示所有列输出
	$Htmlcache07 = table_cache( $ConnXXX, $databiao, $Tablecol_list ); //这里得到所有例的值
	//echo $Htmlcache07;
	$Htmlcache .= $Htmlcache07 .  "\n";
	//echo  ("<li  onselectstart='return false' style='text-align: center; width:600px;'>&nbsp;</li>");
	//echo  ("<li align='center' class='tdpp tdppright'   onselectstart='return false' width='auto'>&nbsp;</li>");
	$nowstyle = "height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px; width:22px;";
	$Htmlcache .= '              if ($sys_q_shanc < 0) { //没有权限时 ' . "\n";
	$Htmlcache .= '                $nowdisabled = " disabled=\'true\' ";' . "\n";
	$Htmlcache .= '              };' . "\n";
	//$Htmlcache .= '              if ($now_shenpi_all == \'1\') {' . "\n";
	//$Htmlcache .= '                echo("<li  class=\'tdpp rightli center\'  style=\'' . $nowstyle . '\'><i class=\'fa fa-mixcloud\'></i></li> ");' . "\n";
	//$Htmlcache .= '              } else { ' . "\n";
	$Htmlcache .= '                echo("<li  class=\'tdpp rightli center\'   style=\'' . $nowstyle . '\'><input type=\'checkbox\'  tabindex=\'-1\' name=\'ID\' value=\'$now_id\' ></li> ");' . "\n";
	//$Htmlcache .= '              };' . "\n";

	$Htmlcache .= '                $imgedit = "<i class=\'fa fa-edit-mini\'></i>";' . "\n";

	$Htmlcache .= '              if ($sys_q_xiug < 0) { //没有权限时' . "\n";
	$Htmlcache .= '                echo("<li  class=\'tdpp rightli center\'  style=\'' . $nowstyle . '\'  title=\'没修改权限！\'></li> ");' . "\n";
	$Htmlcache .= '              } else {' . "\n";
	$Htmlcache .= '                echo("<li  class=\'tdpp rightli center\'   style=\'' . $nowstyle . '\' onclick=edit_data(this,\'$now_id\',\'$ToHtmlID\',\'$hy\') >$imgedit</li> ");' . "\n";
	$Htmlcache .= '              };' . "\n";
	$Htmlcache .= '            echo("</ul>");' . "\n";
	$Htmlcache .= '        };' . "\n";
	$Htmlcache .= '      };//while end' . "\n";
	$Htmlcache .= '      echo(" </div>");' . "\n";
	$Htmlcache .= '      mysqli_free_result( $rs ); //释放内存' . "\n";
	$Htmlcache .= '   };' . "\n";
	
	//mysqli_free_result( $rs ); //释放内存
	$Htmlcache .= '   $endtime = microtime( true ); //这里获取程序执行结束时间 //计算数据加载时间' . "\n";
	$Htmlcache .= '   $ymdate = $endtime - $startime;' . "\n";
	$Htmlcache .= '   $ymdate = round( $ymdate, 3 );' . "\n";
	$nowtongji = "'#" . '$ToHtmlID' . " #tongji'";
	$Htmlcache .= '   echo("<script>$(' . $nowtongji . ').html(\'Data Loading times:$ymdate s\');</script>");' . "\n";
	$Htmlcache .= '};' . "\n";

	$Htmlcache .= "   echo( \"<script>ListLoadEND('".'$ToHtmlID'."',".'\'$FormattingXianShi_idlist\''.",".'\'$zu_all_list\''.");</script>\" );" . "\n";
	$Htmlcache.='mysqli_close( $'.$IsConn.' ); //关闭数据库'."\n";
	$Htmlcache.='?>'."\n";
	//echo $Htmlcache02;
	//lists_data();
	$current_file=str_replace("_chache.php","",basename(__FILE__));       //得到当前文件 除”_chache.php“的文件名称
	write_cache('1',$Htmlcache,$current_file);                 //生成模版

};

mysqli_close( $Conn ); //关闭数据库

?>