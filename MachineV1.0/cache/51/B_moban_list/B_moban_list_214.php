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
	$databiao="SQP_JiChuSheShiBaoYangJiHua";
	$const_shaixuan="";
	$SYS_ALL_ziduan_list="id,sys_nowbh,SheBeiMingChen,XingHaoGuiGe,BaoYangZhouQi,ZD_1Yue,ZD_2Yue,ZD_3Yue,ZD_4Yue,ZD_5Yue,ZD_6Yue,ZD_7Yue,ZD_8Yue,ZD_9Yue,ZD_10Yue,ZD_11Yue,ZD_12Yue,BeiZhu2020730下午324562448,isok,guige,photo,bianhao,zu";
	$xianshi_ZD_num="23";
	$xianshi_KD_num="1604";
	$shuoding_num="2";
	$maxrecord="200";
	$FormattingXianShi_idlist="1,19";
	$zu_all_list="376=不需要,378=以后不要再打电话,377=需要时再联系,";
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
   $Tablecol_list="sys_nowbh,id,SheBeiMingChen,XingHaoGuiGe,BaoYangZhouQi,ZD_1Yue,ZD_2Yue,ZD_3Yue,ZD_4Yue,ZD_5Yue,ZD_6Yue,ZD_7Yue,ZD_8Yue,ZD_9Yue,ZD_10Yue,ZD_11Yue,ZD_12Yue,BeiZhu2020730下午324562448,isok,guige,photo,bianhao,zu,x_bianhao,s_sellbianh,hth,bbb,sys_yfzuid,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,danwei,beizhu,zekou,zu22,sys_id_bumen,sys_shenpi,sys_id_fz,sys_web_shenpi,sys_shenpi_all,sys_adddate,sys_adddate_g,sys_login,sys_id_login,sys_id_zu,sys_chaosong,sys_paixu";

   $sql2 = "select (@rownum:=@rownum+1) as rownum,SQP_JiChuSheShiBaoYangJiHua.id  from `SQP_JiChuSheShiBaoYangJiHua`,(select @rownum:=0) as SQP_JiChuSheShiBaoYangJiHua where  sys_yfzuid='$hy' and sys_huis='$huis' "; //这里得到查询id清单的sql
   if($sys_guanxibiao_id != '' && $GuanXi_id != ""){$sql2 .=" and  sys_gx_id_{$sys_guanxibiao_id}='{$GuanXi_id}'";}
   $sql2 =sql_search($databiao,$sql2,$nowkeyword, 0);
   $sql2 .= " order by $px_ziduan $pxv"; //这里得到排序
   $sql2 = "select id from ($sql2) as t where rownum between $page_first and  $page_end ";
   $sql_all_id_list = sql_all_id_list($sql2,$Conn );

   if ( !$sql_all_id_list ) {
      echo( "<div class='nodata' tabindex='-1'><div class='nodata_center'><i class='fa fa-nodata' style='margin-top:-1px'></i>&nbsp; Sorry, No Data！</div></div>" );
   } else { 
      $sql = "select  id,sys_nowbh,SheBeiMingChen,XingHaoGuiGe,BaoYangZhouQi,ZD_1Yue,ZD_2Yue,ZD_3Yue,ZD_4Yue,ZD_5Yue,ZD_6Yue,ZD_7Yue,ZD_8Yue,ZD_9Yue,ZD_10Yue,ZD_11Yue,ZD_12Yue,BeiZhu2020730下午324562448,isok,guige,photo,bianhao,zu  from `SQP_JiChuSheShiBaoYangJiHua` where id in($sql_all_id_list) and sys_yfzuid='$hy' and sys_huis='$huis'";
      $sql .= " order by $px_ziduan $pxv";
      $rs = mysqli_query( $Conn, $sql );
      echo( "<div id='para'  tabindex='-1' class='tables'  style='border:0;border-bottom:1px solid #CCC;min-width:99%;'>" );

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
              echo("<li  class='shuodingli  border_shuoding  ET_SheBeiMingChen$now_id F_M_XS_1' ET='ET_SheBeiMingChen'  xstypeid='1' name='SheBeiMingChen' style='height:28px;line-height:28px;width:150px;'>".DeleteHtml($row['SheBeiMingChen'])."</li>");
              echo("<li class='contentli ET_XingHaoGuiGe$now_id F_M_XS_1' ET='ET_XingHaoGuiGe'  xstypeid='1' name='XingHaoGuiGe' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['XingHaoGuiGe'])."</li>");
              echo("<li class='contentli ET_BaoYangZhouQi$now_id F_M_XS_1' ET='ET_BaoYangZhouQi'  xstypeid='1' name='BaoYangZhouQi' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['BaoYangZhouQi'])."</li>");
              echo("<li class='contentli ET_ZD_1Yue$now_id F_M_XS_19' ET='ET_ZD_1Yue'  xstypeid='19' name='ZD_1Yue' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_1Yue'])."</li>");
              echo("<li class='contentli ET_ZD_2Yue$now_id F_M_XS_19' ET='ET_ZD_2Yue'  xstypeid='19' name='ZD_2Yue' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_2Yue'])."</li>");
              echo("<li class='contentli ET_ZD_3Yue$now_id F_M_XS_19' ET='ET_ZD_3Yue'  xstypeid='19' name='ZD_3Yue' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_3Yue'])."</li>");
              echo("<li class='contentli ET_ZD_4Yue$now_id F_M_XS_19' ET='ET_ZD_4Yue'  xstypeid='19' name='ZD_4Yue' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_4Yue'])."</li>");
              echo("<li class='contentli ET_ZD_5Yue$now_id F_M_XS_19' ET='ET_ZD_5Yue'  xstypeid='19' name='ZD_5Yue' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_5Yue'])."</li>");
              echo("<li class='contentli ET_ZD_6Yue$now_id F_M_XS_19' ET='ET_ZD_6Yue'  xstypeid='19' name='ZD_6Yue' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_6Yue'])."</li>");
              echo("<li class='contentli ET_ZD_7Yue$now_id F_M_XS_19' ET='ET_ZD_7Yue'  xstypeid='19' name='ZD_7Yue' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_7Yue'])."</li>");
              echo("<li class='contentli ET_ZD_8Yue$now_id F_M_XS_19' ET='ET_ZD_8Yue'  xstypeid='19' name='ZD_8Yue' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_8Yue'])."</li>");
              echo("<li class='contentli ET_ZD_9Yue$now_id F_M_XS_19' ET='ET_ZD_9Yue'  xstypeid='19' name='ZD_9Yue' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_9Yue'])."</li>");
              echo("<li class='contentli ET_ZD_10Yue$now_id F_M_XS_19' ET='ET_ZD_10Yue'  xstypeid='19' name='ZD_10Yue' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_10Yue'])."</li>");
              echo("<li class='contentli ET_ZD_11Yue$now_id F_M_XS_19' ET='ET_ZD_11Yue'  xstypeid='19' name='ZD_11Yue' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_11Yue'])."</li>");
              echo("<li class='contentli ET_ZD_12Yue$now_id F_M_XS_19' ET='ET_ZD_12Yue'  xstypeid='19' name='ZD_12Yue' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_12Yue'])."</li>");
              echo("<li class='contentli ET_BeiZhu2020730下午324562448$now_id F_M_XS_1' ET='ET_BeiZhu2020730下午324562448'  xstypeid='1' name='BeiZhu2020730下午324562448' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['BeiZhu2020730下午324562448'])."</li>");
              echo("<li class='contentli ET_isok$now_id F_M_XS_1' ET='ET_isok'  xstypeid='1' name='isok' style='height:28px;line-height:28px;width:84px;'>".DeleteHtml($row['isok'])."</li>");
              echo("<li class='contentli ET_guige$now_id F_M_XS_1' ET='ET_guige'  xstypeid='1' name='guige' style='height:28px;line-height:28px;width:54px;'>".DeleteHtml($row['guige'])."</li>");
              echo("<li class='contentli ET_photo$now_id F_M_XS_1' ET='ET_photo'  xstypeid='1' name='photo' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['photo'])."</li>");
              echo("<li class='contentli ET_bianhao$now_id F_M_XS_1' ET='ET_bianhao'  xstypeid='1' name='bianhao' style='height:28px;line-height:28px;width:109px;'>".DeleteHtml($row['bianhao'])."</li>");
              echo("<li class='contentli ET_zu$now_id F_M_XS_1' ET='ET_zu'  xstypeid='1' name='zu' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['zu'])."</li>");

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
