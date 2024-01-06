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
	$databiao="SQP_ZongGuoChengQingDan";
	$const_shaixuan="";
	$SYS_ALL_ziduan_list="id,username,DianHua3,startdate,enddate,beizhu,qq,sys_id_zu,card,bianhao,sys_nowbh,sys_id_bumen,sys_shenpi,sys_id_fz,sys_web_shenpi,sys_shenpi_all,sys_adddate,sys_adddate_g,sys_login,sys_chaosong,sys_paixu";
	$xianshi_ZD_num="20";
	$xianshi_KD_num="1545";
	$shuoding_num="1";
	$maxrecord="50";
	$FormattingXianShi_idlist="1,15,20,22";
	$zu_all_list="";
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
   $Tablecol_list="id,username,DianHua3,startdate,enddate,beizhu,qq,sys_id_zu,card,sys_yfzuid,bianhao,sys_bh,sys_zt,sys_zt_bianhao,sys_nowbh,sys_huis,sys_id_bumen,sys_shenpi,sys_id_fz,sys_web_shenpi,sys_shenpi_all,sys_adddate,sys_adddate_g,sys_login,sys_id_login,sys_chaosong,sys_paixu";

   $sql2 = "select (@rownum:=@rownum+1) as rownum,SQP_ZongGuoChengQingDan.id  from `SQP_ZongGuoChengQingDan`,(select @rownum:=0) as SQP_ZongGuoChengQingDan where  sys_yfzuid='$hy' and sys_huis='$huis' "; //这里得到查询id清单的sql
   if($sys_guanxibiao_id != '' && $GuanXi_id != ""){$sql2 .=" and  sys_gx_id_{$sys_guanxibiao_id}='{$GuanXi_id}'";}
   $sql2 =sql_search($databiao,$sql2,$nowkeyword, 0);
   $sql2 .= " order by $px_ziduan $pxv"; //这里得到排序
   $sql2 = "select id from ($sql2) as t where rownum between $page_first and  $page_end ";
   $sql_all_id_list = sql_all_id_list($sql2,$Conn );

   if ( !$sql_all_id_list ) {
      echo( "<div class='nodata' tabindex='-1'><div class='nodata_center'><i class='fa fa-nodata' style='margin-top:-1px'></i>&nbsp; Sorry, No Data！</div></div>" );
   } else { 
      $sql = "select  id,username,DianHua3,startdate,enddate,beizhu,qq,sys_id_zu,card,bianhao,sys_nowbh,sys_id_bumen,sys_shenpi,sys_id_fz,sys_web_shenpi,sys_shenpi_all,sys_adddate,sys_adddate_g,sys_login,sys_chaosong,sys_paixu  from `SQP_ZongGuoChengQingDan` where id in($sql_all_id_list) and sys_yfzuid='$hy' and sys_huis='$huis'";
      $sql .= " order by $px_ziduan $pxv";
      $rs = mysqli_query( $Conn, $sql );
      echo( "<div id='para'  tabindex='-1' class='tables'  style='border:0;border-bottom:1px solid #CCC;min-width:100%;width: 1545px'>" );

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
			echo( "  style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;min-width:100%;width:1545px'> " );
			echo( "<li class='cols1 shuodingli'  title='$now_id'  style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;text-align:center;'></li>" );
	
	
              echo("<li id='c_tdtop1'  class='shuodingli  border_shuoding  ET_sys_nowbh$now_id F_M_XS_1' ET='ET_sys_nowbh'  xstypeid='1' name='sys_nowbh' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_nowbh'])."</li>");
              echo("<li class='contentli ET_username$now_id F_M_XS_1' ET='ET_username'  xstypeid='1' name='username' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['username'])."</li>");
              echo("<li class='contentli ET_DianHua3$now_id F_M_XS_1' ET='ET_DianHua3'  xstypeid='1' name='DianHua3' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['DianHua3'])."</li>");
              echo("<li class='contentli ET_startdate$now_id F_M_XS_1' ET='ET_startdate'  xstypeid='1' name='startdate' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['startdate'])."</li>");
              echo("<li class='contentli ET_enddate$now_id F_M_XS_1' ET='ET_enddate'  xstypeid='1' name='enddate' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['enddate'])."</li>");
              echo("<li class='contentli ET_beizhu$now_id F_M_XS_1' ET='ET_beizhu'  xstypeid='1' name='beizhu' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['beizhu'])."</li>");
              echo("<li class='contentli ET_qq$now_id F_M_XS_1' ET='ET_qq'  xstypeid='1' name='qq' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['qq'])."</li>");
              echo("<li class='contentli ET_sys_id_zu$now_id F_M_XS_15' ET='ET_sys_id_zu'  xstypeid='15' name='sys_id_zu' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['sys_id_zu'])."</li>");
              echo("<li class='contentli ET_card$now_id F_M_XS_1' ET='ET_card'  xstypeid='1' name='card' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['card'])."</li>");
              echo("<li class='contentli ET_bianhao$now_id F_M_XS_1' ET='ET_bianhao'  xstypeid='1' name='bianhao' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['bianhao'])."</li>");
              echo("<li class='contentli ET_sys_id_bumen$now_id F_M_XS_1' ET='ET_sys_id_bumen'  xstypeid='1' name='sys_id_bumen' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['sys_id_bumen'])."</li>");
              echo("<li class='contentli ET_sys_shenpi$now_id F_M_XS_20' ET='ET_sys_shenpi'  xstypeid='20' name='sys_shenpi' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_shenpi'])."</li>");
              echo("<li class='contentli ET_sys_id_fz$now_id F_M_XS_1' ET='ET_sys_id_fz'  xstypeid='1' name='sys_id_fz' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['sys_id_fz'])."</li>");
              echo("<li class='contentli ET_sys_web_shenpi$now_id F_M_XS_1' ET='ET_sys_web_shenpi'  xstypeid='1' name='sys_web_shenpi' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['sys_web_shenpi'])."</li>");
              echo("<li class='contentli ET_sys_shenpi_all$now_id F_M_XS_22' ET='ET_sys_shenpi_all'  xstypeid='22' name='sys_shenpi_all' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_shenpi_all'])."</li>");
              echo("<li class='contentli ET_sys_adddate$now_id F_M_XS_1' ET='ET_sys_adddate'  xstypeid='1' name='sys_adddate' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['sys_adddate'])."</li>");
              echo("<li class='contentli ET_sys_adddate_g$now_id F_M_XS_1' ET='ET_sys_adddate_g'  xstypeid='1' name='sys_adddate_g' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['sys_adddate_g'])."</li>");
              echo("<li class='contentli ET_sys_login$now_id F_M_XS_1' ET='ET_sys_login'  xstypeid='1' name='sys_login' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['sys_login'])."</li>");
              echo("<li class='contentli ET_sys_chaosong$now_id F_M_XS_1' ET='ET_sys_chaosong'  xstypeid='1' name='sys_chaosong' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_chaosong'])."</li>");
              echo("<li class='endli ET_sys_paixu$now_id F_M_XS_1' ET='ET_sys_paixu'  xstypeid='1' name='sys_paixu' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_paixu'])."</li>");

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
