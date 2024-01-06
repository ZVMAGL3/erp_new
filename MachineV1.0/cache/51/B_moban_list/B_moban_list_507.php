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
	$databiao="SQP_JiaBanDiaoXiuShiJianHuiZong";
	$const_shaixuan="";
	$SYS_ALL_ziduan_list="id,sys_nowbh,ZD_XingMing,ZD_NianFen,ZD_1Ri,ZD_2Ri,ZD_3Ri,ZD_4Ri,ZD_5Ri,ZD_6Ri,ZD_7Ri,ZD_8Ri,ZD_9Ri,ZD_10Ri,ZD_11Ri,ZD_12Ri,ZD_13Ri,ZD_14Ri,ZD_15Ri,ZD_16Ri,ZD_17Ri,ZD_18Ri,ZD_19Ri,ZD_20Ri,ZD_21Ri,ZD_22Ri,ZD_23Ri,ZD_24Ri,ZD_25Ri,ZD_26Ri,ZD_27Ri,ZD_28Ri,ZD_29Ri,ZD_30Ri,ZD_31Ri,ZD_HeJiShiJian,ZD_DiaoXiuShiJian,ZD_ShiJiJiaBanShiJian,ZD_JiaBanGongZi,ZD_BeiZhu,sys_id_login,sys_shenpi_all";
	$xianshi_ZD_num="39";
	$xianshi_KD_num="1658";
	$shuoding_num="2";
	$maxrecord="50";
	$FormattingXianShi_idlist="1,2";
	$zu_all_list="470=10月,471=11月,472=12月,461=1月,462=2月,463=3月,464=4月,465=5月,466=6月,467=7月,468=8月,469=9月,";
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
   $Tablecol_list="sys_nowbh,id,sys_id_login,sys_login,sys_id_fz,sys_yfzuid,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_bumen,sys_shenpi,sys_web_shenpi,sys_adddate,sys_adddate_g,sys_shenpi_all,ZD_XingMing,ZD_NianFen,sys_id_zu,ZD_1Ri,ZD_2Ri,ZD_3Ri,ZD_4Ri,ZD_5Ri,ZD_6Ri,ZD_7Ri,ZD_8Ri,ZD_9Ri,ZD_10Ri,ZD_11Ri,ZD_12Ri,ZD_13Ri,ZD_14Ri,ZD_15Ri,ZD_16Ri,ZD_17Ri,ZD_18Ri,ZD_19Ri,ZD_20Ri,ZD_21Ri,ZD_22Ri,ZD_23Ri,ZD_24Ri,ZD_25Ri,ZD_26Ri,ZD_27Ri,ZD_28Ri,ZD_29Ri,ZD_30Ri,ZD_31Ri,ZD_HeJiShiJian,ZD_DiaoXiuShiJian,ZD_ShiJiJiaBanShiJian,ZD_JiaBanGongZi,ZD_BeiZhu,sys_gx_id_204,sys_chaosong,sys_paixu";

   $sql2 = "select (@rownum:=@rownum+1) as rownum,SQP_JiaBanDiaoXiuShiJianHuiZong.id  from `SQP_JiaBanDiaoXiuShiJianHuiZong`,(select @rownum:=0) as SQP_JiaBanDiaoXiuShiJianHuiZong where  sys_yfzuid='$hy' and sys_huis='$huis' "; //这里得到查询id清单的sql
   if($sys_guanxibiao_id != '' && $GuanXi_id != ""){$sql2 .=" and  sys_gx_id_{$sys_guanxibiao_id}='{$GuanXi_id}'";}
   $sql2 =sql_search($databiao,$sql2,$nowkeyword, 0);
   $sql2 .= " order by $px_ziduan $pxv"; //这里得到排序
   $sql2 = "select id from ($sql2) as t where rownum between $page_first and  $page_end ";
   $sql_all_id_list = sql_all_id_list($sql2,$Conn );

   if ( !$sql_all_id_list ) {
      echo( "<div class='nodata' tabindex='-1'><div class='nodata_center'><i class='fa fa-nodata' style='margin-top:-1px'></i>&nbsp; Sorry, No Data！</div></div>" );
   } else { 
      $sql = "select  id,sys_nowbh,ZD_XingMing,ZD_NianFen,ZD_1Ri,ZD_2Ri,ZD_3Ri,ZD_4Ri,ZD_5Ri,ZD_6Ri,ZD_7Ri,ZD_8Ri,ZD_9Ri,ZD_10Ri,ZD_11Ri,ZD_12Ri,ZD_13Ri,ZD_14Ri,ZD_15Ri,ZD_16Ri,ZD_17Ri,ZD_18Ri,ZD_19Ri,ZD_20Ri,ZD_21Ri,ZD_22Ri,ZD_23Ri,ZD_24Ri,ZD_25Ri,ZD_26Ri,ZD_27Ri,ZD_28Ri,ZD_29Ri,ZD_30Ri,ZD_31Ri,ZD_HeJiShiJian,ZD_DiaoXiuShiJian,ZD_ShiJiJiaBanShiJian,ZD_JiaBanGongZi,ZD_BeiZhu,sys_id_login,sys_shenpi_all  from `SQP_JiaBanDiaoXiuShiJianHuiZong` where id in($sql_all_id_list) and sys_yfzuid='$hy' and sys_huis='$huis'";
      $sql .= " order by $px_ziduan $pxv";
      $rs = mysqli_query( $Conn, $sql );
      echo( "<div id='para'  tabindex='-1' class='tables'  style='border:0;border-bottom:1px solid #CCC;min-width:100%;width: 1658px'>" );

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
			echo( "  style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;min-width:100%;width:1658px'> " );
			echo( "<li class='cols1 shuodingli'  title='$now_id'  style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;text-align:center;'></li>" );
	
	
              echo("<li id='c_tdtop1'  class='shuodingli   ET_sys_nowbh$now_id F_M_XS_1' ET='ET_sys_nowbh'  xstypeid='1' name='sys_nowbh' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_nowbh'])."</li>");
              echo("<li  class='shuodingli  border_shuoding  ET_ZD_XingMing$now_id F_M_XS_1' ET='ET_ZD_XingMing'  xstypeid='1' name='ZD_XingMing' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_XingMing'])."</li>");
              echo("<li  class='contentli ET_ZD_NianFen$now_id F_M_XS_1' ET='ET_ZD_NianFen'  xstypeid='1' name='ZD_NianFen' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_NianFen'])."</li>");
              echo("<li  class='contentli ET_ZD_1Ri$now_id F_M_XS_1' ET='ET_ZD_1Ri'  xstypeid='1' name='ZD_1Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_1Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_2Ri$now_id F_M_XS_1' ET='ET_ZD_2Ri'  xstypeid='1' name='ZD_2Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_2Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_3Ri$now_id F_M_XS_1' ET='ET_ZD_3Ri'  xstypeid='1' name='ZD_3Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_3Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_4Ri$now_id F_M_XS_1' ET='ET_ZD_4Ri'  xstypeid='1' name='ZD_4Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_4Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_5Ri$now_id F_M_XS_1' ET='ET_ZD_5Ri'  xstypeid='1' name='ZD_5Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_5Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_6Ri$now_id F_M_XS_1' ET='ET_ZD_6Ri'  xstypeid='1' name='ZD_6Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_6Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_7Ri$now_id F_M_XS_1' ET='ET_ZD_7Ri'  xstypeid='1' name='ZD_7Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_7Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_8Ri$now_id F_M_XS_1' ET='ET_ZD_8Ri'  xstypeid='1' name='ZD_8Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_8Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_9Ri$now_id F_M_XS_1' ET='ET_ZD_9Ri'  xstypeid='1' name='ZD_9Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_9Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_10Ri$now_id F_M_XS_1' ET='ET_ZD_10Ri'  xstypeid='1' name='ZD_10Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_10Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_11Ri$now_id F_M_XS_1' ET='ET_ZD_11Ri'  xstypeid='1' name='ZD_11Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_11Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_12Ri$now_id F_M_XS_1' ET='ET_ZD_12Ri'  xstypeid='1' name='ZD_12Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_12Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_13Ri$now_id F_M_XS_1' ET='ET_ZD_13Ri'  xstypeid='1' name='ZD_13Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_13Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_14Ri$now_id F_M_XS_1' ET='ET_ZD_14Ri'  xstypeid='1' name='ZD_14Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_14Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_15Ri$now_id F_M_XS_1' ET='ET_ZD_15Ri'  xstypeid='1' name='ZD_15Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_15Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_16Ri$now_id F_M_XS_1' ET='ET_ZD_16Ri'  xstypeid='1' name='ZD_16Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_16Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_17Ri$now_id F_M_XS_1' ET='ET_ZD_17Ri'  xstypeid='1' name='ZD_17Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_17Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_18Ri$now_id F_M_XS_1' ET='ET_ZD_18Ri'  xstypeid='1' name='ZD_18Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_18Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_19Ri$now_id F_M_XS_1' ET='ET_ZD_19Ri'  xstypeid='1' name='ZD_19Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_19Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_20Ri$now_id F_M_XS_1' ET='ET_ZD_20Ri'  xstypeid='1' name='ZD_20Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_20Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_21Ri$now_id F_M_XS_1' ET='ET_ZD_21Ri'  xstypeid='1' name='ZD_21Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_21Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_22Ri$now_id F_M_XS_1' ET='ET_ZD_22Ri'  xstypeid='1' name='ZD_22Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_22Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_23Ri$now_id F_M_XS_1' ET='ET_ZD_23Ri'  xstypeid='1' name='ZD_23Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_23Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_24Ri$now_id F_M_XS_1' ET='ET_ZD_24Ri'  xstypeid='1' name='ZD_24Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_24Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_25Ri$now_id F_M_XS_1' ET='ET_ZD_25Ri'  xstypeid='1' name='ZD_25Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_25Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_26Ri$now_id F_M_XS_1' ET='ET_ZD_26Ri'  xstypeid='1' name='ZD_26Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_26Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_27Ri$now_id F_M_XS_1' ET='ET_ZD_27Ri'  xstypeid='1' name='ZD_27Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_27Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_28Ri$now_id F_M_XS_1' ET='ET_ZD_28Ri'  xstypeid='1' name='ZD_28Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_28Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_29Ri$now_id F_M_XS_1' ET='ET_ZD_29Ri'  xstypeid='1' name='ZD_29Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_29Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_30Ri$now_id F_M_XS_1' ET='ET_ZD_30Ri'  xstypeid='1' name='ZD_30Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_30Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_31Ri$now_id F_M_XS_1' ET='ET_ZD_31Ri'  xstypeid='1' name='ZD_31Ri' style='height:28px;line-height:28px;width:28px;'>".DeleteHtml($row['ZD_31Ri'])."</li>");
              echo("<li  class='contentli ET_ZD_HeJiShiJian$now_id F_M_XS_1' ET='ET_ZD_HeJiShiJian'  xstypeid='1' name='ZD_HeJiShiJian' style='height:28px;line-height:28px;width:70px;'>".DeleteHtml($row['ZD_HeJiShiJian'])."</li>");
              echo("<li  class='contentli ET_ZD_DiaoXiuShiJian$now_id F_M_XS_1' ET='ET_ZD_DiaoXiuShiJian'  xstypeid='1' name='ZD_DiaoXiuShiJian' style='height:28px;line-height:28px;width:60px;'>".DeleteHtml($row['ZD_DiaoXiuShiJian'])."</li>");
              echo("<li  class='contentli ET_ZD_ShiJiJiaBanShiJian$now_id F_M_XS_1' ET='ET_ZD_ShiJiJiaBanShiJian'  xstypeid='1' name='ZD_ShiJiJiaBanShiJian' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZD_ShiJiJiaBanShiJian'])."</li>");
              echo("<li  class='contentli ET_ZD_JiaBanGongZi$now_id F_M_XS_1' ET='ET_ZD_JiaBanGongZi'  xstypeid='1' name='ZD_JiaBanGongZi' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_JiaBanGongZi'])."</li>");
              echo("<li  class='contentli ET_ZD_BeiZhu$now_id F_M_XS_2' ET='ET_ZD_BeiZhu'  xstypeid='2' name='ZD_BeiZhu' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_BeiZhu'])."</li>");

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
