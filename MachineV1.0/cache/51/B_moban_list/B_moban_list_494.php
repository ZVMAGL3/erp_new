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
	$databiao="SQP_QingJiaDiaoXiuJiaBanWaiChuDan";
	$const_shaixuan="";
	$SYS_ALL_ziduan_list="id,sys_nowbh,ZhiWu,ZD_ShenQingRen,sys_id_zu,ZD_ShenQingShiJian,ShiYou,ZD_BeiZhu,sys_shenpi,sys_shenpi_all,sys_adddate";
	$xianshi_ZD_num="10";
	$xianshi_KD_num="1895";
	$shuoding_num="4";
	$maxrecord="50";
	$FormattingXianShi_idlist="1,24,23,15,25,2,20,22";
	$zu_all_list="394=丧假,390=事假,393=产假,398=出差,396=加班,400=外出,391=婚假,397=审核,392=年假,434=病假,395=调休,";
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
   $Tablecol_list="sys_nowbh,ZhiWu,id,sys_id_login,sys_login,sys_id_fz,sys_yfzuid,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_bumen,sys_web_shenpi,sys_adddate_g,ZD_ShenQingRen,sys_id_zu,ZD_ShenQingShiJian,ShiYou,ZD_BeiZhu,sys_shenpi,sys_shenpi_all,sys_adddate,sys_chaosong,sys_paixu";

   $sql2 = "select (@rownum:=@rownum+1) as rownum,SQP_QingJiaDiaoXiuJiaBanWaiChuDan.id  from `SQP_QingJiaDiaoXiuJiaBanWaiChuDan`,(select @rownum:=0) as SQP_QingJiaDiaoXiuJiaBanWaiChuDan where  sys_yfzuid='$hy' and sys_huis='$huis' "; //这里得到查询id清单的sql
   if($sys_guanxibiao_id != '' && $GuanXi_id != ""){$sql2 .=" and  sys_gx_id_{$sys_guanxibiao_id}='{$GuanXi_id}'";}
   $sql2 =sql_search($databiao,$sql2,$nowkeyword, 0);
   $sql2 .= " order by $px_ziduan $pxv"; //这里得到排序
   $sql2 = "select id from ($sql2) as t where rownum between $page_first and  $page_end ";
   $sql_all_id_list = sql_all_id_list($sql2,$Conn );

   if ( !$sql_all_id_list ) {
      echo( "<div class='nodata' tabindex='-1'><div class='nodata_center'><i class='fa fa-nodata' style='margin-top:-1px'></i>&nbsp; Sorry, No Data！</div></div>" );
   } else { 
      $sql = "select  id,sys_nowbh,ZhiWu,ZD_ShenQingRen,sys_id_zu,ZD_ShenQingShiJian,ShiYou,ZD_BeiZhu,sys_shenpi,sys_shenpi_all,sys_adddate  from `SQP_QingJiaDiaoXiuJiaBanWaiChuDan` where id in($sql_all_id_list) and sys_yfzuid='$hy' and sys_huis='$huis'";
      $sql .= " order by $px_ziduan $pxv";
      $rs = mysqli_query( $Conn, $sql );
      echo( "<div id='para'  tabindex='-1' class='tables'  style='border:0;border-bottom:1px solid #CCC;min-width:100%;width:1895'>" );

	      $i = 0;
	      while ( $row = mysqli_fetch_array( $rs ) ) {
	      if ( $const_q_cak >= 0 ) {
	        $i++;
	        $now_id = $row[ "id" ];
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
			echo( "  style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;min-width:100%;'> " );
			echo( "<li class='cols1 shuodingli'  title='$now_id'  style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;text-align:center;'></li>" );
	
	
              echo("<li id='c_tdtop1'  class='shuodingli   ET_sys_nowbh$now_id F_M_XS_1' ET='ET_sys_nowbh'  xstypeid='1' name='sys_nowbh' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_nowbh'])."</li>");
              echo("<li  class='shuodingli   ET_ZhiWu$now_id F_M_XS_24' ET='ET_ZhiWu'  xstypeid='24' name='ZhiWu' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZhiWu'])."</li>");
              echo("<li  class='shuodingli   ET_ZD_ShenQingRen$now_id F_M_XS_23' ET='ET_ZD_ShenQingRen'  xstypeid='23' name='ZD_ShenQingRen' style='height:28px;line-height:28px;width:120px;'>".DeleteHtml($row['ZD_ShenQingRen'])."</li>");
              echo("<li  class='shuodingli  border_shuoding  ET_ZD_ShenQingShiJian$now_id F_M_XS_25' ET='ET_ZD_ShenQingShiJian'  xstypeid='25' name='ZD_ShenQingShiJian' style='height:28px;line-height:28px;width:150px;'>".DeleteHtml($row['ZD_ShenQingShiJian'])."</li>");
              echo("<li class='contentli ET_sys_id_zu$now_id F_M_XS_15' ET='ET_sys_id_zu'  xstypeid='15' name='sys_id_zu' style='height:28px;line-height:28px;width:120px;'>".DeleteHtml($row['sys_id_zu'])."</li>");
              echo("<li class='contentli ET_ShiYou$now_id F_M_XS_2' ET='ET_ShiYou'  xstypeid='2' name='ShiYou' style='height:28px;line-height:28px;width:500px;'>".DeleteHtml($row['ShiYou'])."</li>");
              echo("<li class='contentli ET_ZD_BeiZhu$now_id F_M_XS_1' ET='ET_ZD_BeiZhu'  xstypeid='1' name='ZD_BeiZhu' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['ZD_BeiZhu'])."</li>");
              echo("<li class='contentli ET_sys_shenpi$now_id F_M_XS_20' ET='ET_sys_shenpi'  xstypeid='20' name='sys_shenpi' style='height:28px;line-height:28px;width:250px;'>".DeleteHtml($row['sys_shenpi'])."</li>");
              echo("<li class='contentli ET_sys_shenpi_all$now_id F_M_XS_22' ET='ET_sys_shenpi_all'  xstypeid='22' name='sys_shenpi_all' style='height:28px;line-height:28px;width:250px;'>".DeleteHtml($row['sys_shenpi_all'])."</li>");
              echo("<li class='contentli ET_sys_adddate$now_id F_M_XS_1' ET='ET_sys_adddate'  xstypeid='1' name='sys_adddate' style='height:28px;line-height:28px;width:130px;'>".DeleteHtml($row['sys_adddate'])."</li>");

              if ($const_q_shanc < 0) { //没有权限时 
                $nowdisabled = " disabled='true' ";
              };
                echo("<li  class='tdpp rightli center'   style='height:28px;line-height:28px; width:22px;'><input type='checkbox'  tabindex='-1' name='ID' value='$now_id' ></li> ");
                $imgedit = "<i class='fa fa-edit-mini'></i>";
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
