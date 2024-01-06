<?php
header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
include_once "B_quanxian.php";
include_once "{$_SERVER['PATH_TRANSLATED']}/inc/Function_All.php";
include_once "{$_SERVER['PATH_TRANSLATED']}/inc/Function_list.php";
include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Config.php";
include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
$startime = microtime( true ); //这里计算时间开始

global $const_q_cak,$ToHtmlID,$const_q_shanc,$const_q_xiug,$nowkeyword,$px_ziduan,$pxv,$Conn,$hy;
	$r_cow_height="28";
	$databiao="sys_gukedanganbiao";
	$const_shaixuan="and (leixin=1 or leixin=3)";
	$SYS_ALL_ziduan_list="id,sys_nowbh,ZD_BeiZhuQiYeGongShangXinYongDeng,ZD_GongSiMingChen,ZD_FuZeRen,ZD_YiXiangFuWu,ZD_ChengJiaoXiangMu,ZD_DengJi,DianHua,ShengChanChanPin,DiZhi,sys_id_zu,XiangMuJingLi,sys_chaosong,sys_count_510,ZD_WeiXin,ZD_BaoJiaFuJian,sys_id_login,sys_shenpi_all";
	$xianshi_ZD_num="16";
	$xianshi_KD_num="2466";
	$shuoding_num="10";
	$maxrecord="20";
	$FormattingXianShi_idlist="1,2,15,18,6";
	$zu_all_list="291=失效,116=意向,290=汇淡中,369=潜在,121=老客户,368=跟进中,";
	if ( isset( $_REQUEST[ 'page' ] ) ){$page = intval( $_REQUEST[ 'page' ] );}else{$page = 1;};//页码接收
	if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
	if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};                                           //关系表id
	if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
	if ( isset( $_REQUEST[ 'huis' ] ) ){$huis = intval( $_REQUEST[ 'huis' ] );}else{$huis = 0;};                                                                //1回收站0为不回收
	//if ( $huis == 1){$ToHtmlID='HUIS_'.$ToHtmlID;};                                                                                                             //是否为回收站0为不回收
	if ($page <= 0){$page=1;};
	$page_first = ( $page - 1 ) * $maxrecord + 1;
	$page_end = $page_first + $maxrecord - 1;
	$nowjilucont = $page_end - $page_first;

if ( "1" . $databiao == "1" ) {
   echo nonelist();
} else {
   $Tablecol_list="sys_nowbh,ZD_BeiZhuQiYeGongShangXinYongDeng,id,ZD_GongSiMingChen,ZD_FuZeRen,ZD_YiXiangFuWu,ZD_ChengJiaoXiangMu,ZD_DengJi,XingBie,DianHua,sys_gx_id_223,ShengChanChanPin,DiZhi,YouXiang,WangZhi,sys_id_zu,sys_adddate,sys_yfzuid,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_bumen,sys_shenpi,sys_id_fz,sys_web_shenpi,sys_shenpi_all,sys_adddate_g,TiChengJieSuan,ZD_TiXiGenJin,XiangMuJingLi,sys_login,sys_id_login,sys_chaosong,sys_count_499,sys_count_495,sys_count_423,sys_count_501,sys_count_308,sys_count_471,sys_count_264,sys_count_510,ZD_WeiXin,ZD_BaoJiaFuJian,sys_paixu";

   $sql2 = "select (@rownum:=@rownum+1) as rownum,sys_gukedanganbiao.id  from `sys_gukedanganbiao`,(select @rownum:=0) as sys_gukedanganbiao where  sys_yfzuid='$hy' and sys_huis='$huis' "; //这里得到查询id清单的sql
   if($sys_guanxibiao_id != '' && $GuanXi_id != ""){$sql2 .=" and  sys_gx_id_{$sys_guanxibiao_id}='{$GuanXi_id}'";}
   $sql2 =sql_search($databiao,$sql2,$nowkeyword, 0);
   $sql2 .= " order by $px_ziduan $pxv"; //这里得到排序
   $sql2 = "select id from ($sql2) as t where rownum between $page_first and  $page_end ";
   $sql_all_id_list = sql_all_id_list($sql2,$Conn );

   if ( !$sql_all_id_list ) {
      echo( "<div class='nodata' tabindex='-1'><div class='nodata_center'><i class='fa fa-nodata' style='margin-top:-1px'></i>&nbsp; Sorry, No Data！</div></div>" );
   } else { 
      $sql = "select  id,sys_nowbh,ZD_BeiZhuQiYeGongShangXinYongDeng,ZD_GongSiMingChen,ZD_FuZeRen,ZD_YiXiangFuWu,ZD_ChengJiaoXiangMu,ZD_DengJi,DianHua,ShengChanChanPin,DiZhi,sys_id_zu,XiangMuJingLi,sys_chaosong,sys_count_510,ZD_WeiXin,ZD_BaoJiaFuJian,sys_id_login,sys_shenpi_all  from `sys_gukedanganbiao` where id in($sql_all_id_list) and sys_yfzuid='$hy' and sys_huis='$huis'";
      $sql .= " order by $px_ziduan $pxv";
      $rs = mysqli_query( $Conn, $sql );
      echo( "<div id='para'  tabindex='-1' class='tables'  style='border:0;border-bottom:1px solid #CCC;min-width:100%;width: 2466px'>" );

	      $i = 0;
	      while ( $row = mysqli_fetch_array( $rs ) ) {
	      $now_id_login = $row[ "sys_id_login" ]; //得到员工工号
	      if ( $const_q_cak >= 0 or $now_id_login == $bh ) {
	        $i++;
	        $now_id = $row[ "id" ];
	        $now_shenpi_all = $row[ "sys_shenpi_all" ]; //审批
	        $tdqaqclass = "tdsclass" . $i;
	        echo( "<ul class='ul_over_" . $i . "' overid='ul_over_" . $i . "' " );
	        //if ($const_q_xiug > -1){//有权限时
			    $part_ToHtmlID = str_replace('E_','', substr($ToHtmlID,0,strlen($ToHtmlID)-strlen('_MenuDiv_'.$re_id)) );
	            if(substr($ToHtmlID,0,13)=='E_DeskMenuDiv'){
				    echo( "  onDblclick=GetPage(this,'$now_id','$ToHtmlID','$part_ToHtmlID')" );
			    }else{
	                echo( "  onDblclick=edit_data(this,'$now_id','$ToHtmlID','$hy')");
				}
			//}
			echo( "  style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;min-width:100%;width:2466px'> " );
			echo( "<li class='cols1 shuodingli'  title='$now_id'  style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;text-align:center;'></li>" );
	
	
              echo("<li id='c_tdtop1'  class='shuodingli   ET_sys_nowbh$now_id F_M_XS_1' ET='ET_sys_nowbh'  xstypeid='1' name='sys_nowbh' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_nowbh'])."</li>");
              echo("<li  class='shuodingli   ET_ZD_GongSiMingChen$now_id F_M_XS_1' ET='ET_ZD_GongSiMingChen'  xstypeid='1' name='ZD_GongSiMingChen' style='height:28px;line-height:28px;width:264px;'>".DeleteHtml($row['ZD_GongSiMingChen'])."</li>");
              echo("<li  class='shuodingli   ET_ZD_FuZeRen$now_id F_M_XS_1' ET='ET_ZD_FuZeRen'  xstypeid='1' name='ZD_FuZeRen' style='height:28px;line-height:28px;width:59px;'>".DeleteHtml($row['ZD_FuZeRen'])."</li>");
              echo("<li  class='shuodingli   ET_ZD_YiXiangFuWu$now_id F_M_XS_1' ET='ET_ZD_YiXiangFuWu'  xstypeid='1' name='ZD_YiXiangFuWu' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['ZD_YiXiangFuWu'])."</li>");
              echo("<li  class='shuodingli   ET_ZD_ChengJiaoXiangMu$now_id F_M_XS_1' ET='ET_ZD_ChengJiaoXiangMu'  xstypeid='1' name='ZD_ChengJiaoXiangMu' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['ZD_ChengJiaoXiangMu'])."</li>");
              echo("<li  class='shuodingli   ET_ZD_DengJi$now_id F_M_XS_1' ET='ET_ZD_DengJi'  xstypeid='1' name='ZD_DengJi' style='height:28px;line-height:28px;width:90px;'>".DeleteHtml($row['ZD_DengJi'])."</li>");
              echo("<li  class='shuodingli   ET_XiangMuJingLi$now_id F_M_XS_1' ET='ET_XiangMuJingLi'  xstypeid='1' name='XiangMuJingLi' style='height:28px;line-height:28px;width:132px;'>".DeleteHtml($row['XiangMuJingLi'])."</li>");
              echo("<li  class='shuodingli   ET_sys_count_510$now_id F_M_XS_1' ET='ET_sys_count_510'  xstypeid='1' name='sys_count_510' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_count_510'])."</li>");
              echo("<li  class='shuodingli   ET_ZD_WeiXin$now_id F_M_XS_18' ET='ET_ZD_WeiXin'  xstypeid='18' name='ZD_WeiXin' style='height:28px;line-height:28px;width:39px;'>".DeleteHtml($row['ZD_WeiXin'])."</li>");
              echo("<li  class='shuodingli  border_shuoding  ET_ZD_BaoJiaFuJian$now_id F_M_XS_6' ET='ET_ZD_BaoJiaFuJian'  xstypeid='6' name='ZD_BaoJiaFuJian' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZD_BaoJiaFuJian'])."</li>");
              echo("<li  class='contentli ET_ZD_BeiZhuQiYeGongShangXinYongDeng$now_id F_M_XS_2' ET='ET_ZD_BeiZhuQiYeGongShangXinYongDeng'  xstypeid='2' name='ZD_BeiZhuQiYeGongShangXinYongDeng' style='height:28px;line-height:28px;width:260px;'>".DeleteHtml($row['ZD_BeiZhuQiYeGongShangXinYongDeng'])."</li>");
              echo("<li  class='contentli ET_DianHua$now_id F_M_XS_1' ET='ET_DianHua'  xstypeid='1' name='DianHua' style='height:28px;line-height:28px;width:209px;'>".DeleteHtml($row['DianHua'])."</li>");
              echo("<li  class='contentli ET_ShengChanChanPin$now_id F_M_XS_1' ET='ET_ShengChanChanPin'  xstypeid='1' name='ShengChanChanPin' style='height:28px;line-height:28px;width:194px;'>".DeleteHtml($row['ShengChanChanPin'])."</li>");
              echo("<li  class='contentli ET_DiZhi$now_id F_M_XS_1' ET='ET_DiZhi'  xstypeid='1' name='DiZhi' style='height:28px;line-height:28px;width:349px;'>".DeleteHtml($row['DiZhi'])."</li>");
              echo("<li  class='contentli ET_sys_id_zu$now_id F_M_XS_15' ET='ET_sys_id_zu'  xstypeid='15' name='sys_id_zu' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['sys_id_zu'])."</li>");
              echo("<li  class='contentli ET_sys_chaosong$now_id F_M_XS_1' ET='ET_sys_chaosong'  xstypeid='1' name='sys_chaosong' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_chaosong'])."</li>");

              if ($const_q_shanc < 0) { //没有权限时 
                $nowdisabled = " disabled='true' ";
              };
                echo("<li  class='tdpp rightli center'   style='height:28px;line-height:28px; width:22px;'><input type='checkbox'  tabindex='-1' name='ID' value='$now_id' ></li> ");
              if ($now_shenpi_all == "1") {
                $imgedit = "<i class='fa fa-mixcloud'></i>";
              } else { 
                $imgedit = "<i class='fa fa-edit-mini'></i>";
              };
              if ($const_q_xiug < 0) { //没有权限时
                echo("<li  class='tdpp rightli center'  style='height:28px;line-height:28px; width:22px;'  title='没修改权限！'></li> ");
              } else {
                echo("<li  class='tdpp rightli center'   style='height:28px;line-height:28px; width:22px;' onclick=edit_data(this,'$now_id','$ToHtmlID','$hy') >$imgedit</li> ");
              };
            echo("</ul>");
        };
      };//while end
      echo(" </div>");
      mysqli_free_result( $rs ); //释放内存
   };
   $endtime = microtime( true ); //这里获取程序执行结束时间 //计算数据加载时间
   $ymdate = $endtime - $startime;
   $ymdate = round( $ymdate, 3 );
   echo("<script>$('#$ToHtmlID #tongji').html('Data Loading times:$ymdate s');</script>");
};
   echo( "<script>ListLoadEND('$ToHtmlID','$FormattingXianShi_idlist','$zu_all_list');</script>" );
mysqli_close( $Conn ); //关闭数据库
?>
