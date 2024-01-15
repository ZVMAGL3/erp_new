<?php
header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
include_once 'M_quanxian.php';
include_once '../../inc/Function_All.php';
include_once '../../inc/Function_list.php';
include_once '../../inc/B_Config.php';
include_once '../../inc/B_Conn.php';
$startime = microtime( true ); //这里计算时间开始

global $const_q_cak,$ToHtmlID,$const_q_shanc,$const_q_xiug,$nowkeyword,$px_ziduan,$pxv,$Conn;
$r_cow_height="28";
$databiao="SQP_QingJiaDiaoXiuJiaBanWaiChuDan";
$const_shaixuan="";
$SYS_ALL_ziduan_list="id,ZD_ShenQingRen,ShiYou,ZD_ShenQingShiJian,sys_id_login,sys_shenpi_all";
$xianshi_ZD_num="2";
$xianshi_KD_num="2195";
$shuoding_num_list="ZD_ShenQingShiJian";
	   $maxrecord="20";
       $FormattingXianShi_idlist="1,24,23,15,25,2,20,22";
	   $zu_all_list="394=丧假,390=事假,393=产假,398=出差,396=加班,400=外出,391=婚假,397=审核,392=年假,434=病假,395=调休,";
	   if ( isset( $_REQUEST[ 'page' ] ) ){$page = intval( $_REQUEST[ 'page' ] );}else{$page = 1;};                                                                //页码接收
	
	   if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表id
	   if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";};   //关系列id
	   if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //显示页面
	   if ( isset( $_REQUEST[ 'huis' ] ) ){$huis = intval( $_REQUEST[ 'huis' ] );}else{$huis = 0;};                                                                //1回收站0为不回收
	   //if ( $huis == 1){$ToHtmlID='HUIS_'.$ToHtmlID;};                                                                                                               //是否为回收站0为不回收
	   if ($page <= 0){$page=1;};
	   $page_first = ( $page - 1 ) * $maxrecord + 1;
	   $page_end = $page_first + $maxrecord - 1;
	   $nowjilucont = $page_end - $page_first;
	   if ( isset( $_REQUEST[ 'sys_const_pagetype' ] ) ){$sys_const_pagetype = $_REQUEST[ 'sys_const_pagetype' ];}else{$sys_const_pagetype = 'listpage';};
	

if ( "1" . $databiao == "1" ) {
   echo nonelist();
} else {
   $Tablecol_list="sys_nowbh,ZhiWu,id,sys_id_login,sys_login,sys_id_fz,sys_yfzuid,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_bumen,sys_web_shenpi,sys_adddate_g,ZD_ShenQingRen,sys_id_zu,ZD_ShenQingShiJian,ShiYou,ZD_BeiZhu,sys_shenpi,sys_shenpi_all,sys_adddate,sys_chaosong,sys_paixu";

   $sql2 = "select (@rownum:=@rownum+1) as rownum,SQP_QingJiaDiaoXiuJiaBanWaiChuDan.id  from `SQP_QingJiaDiaoXiuJiaBanWaiChuDan`,(select @rownum:=0) as SQP_QingJiaDiaoXiuJiaBanWaiChuDan where  sys_yfzuid='$hy' and sys_huis='$huis' "; //这里得到查询id清单的sql
    if($sys_guanxibiao_id != '' && $GuanXi_id != ""){$sql2 .=" and  sys_gx_id_{$sys_guanxibiao_id}='{$GuanXi_id}'";}
   $sql2 =sql_search($databiao,$sql2,$nowkeyword, 0);
   $sql2 .= " order by $px_ziduan $pxv"; //这里得到排序
   $sql2 = "select id from ($sql2) as t where rownum between $page_first and  $page_end ";
   $sql_all_id_list = sql_all_id_list($sql2,$Conn);

   if ( !$sql_all_id_list ) {
      echo( "<li><a href='#'><font color='#CCC'>Sorry,  No Data！</font></a></li>" );
   } else { 
      $sql = "select  id,ZD_ShenQingRen,ShiYou,ZD_ShenQingShiJian,sys_id_login,sys_shenpi_all,ZD_ShenQingShiJian  from `SQP_QingJiaDiaoXiuJiaBanWaiChuDan` where id in($sql_all_id_list) and sys_yfzuid='$hy' and sys_huis='$huis'";
      $sql .= " order by $px_ziduan $pxv";
      $rs = mysqli_query($Conn, $sql );
      $i = 0;
      while ( $row = mysqli_fetch_array( $rs ) ) {
        $now_id_login = $row[ "sys_id_login" ]; //得到员工工号 
        if ( $const_q_cak >= 0 or $now_id_login == $bh ) {
            $i++;
            $now_id = $row[ "id" ];
            $now_shenpi_all = $row[ "sys_shenpi_all" ]; //审批
            $tdqaqclass = "tdsclass" . $i;
              echo("<li onclick=edit_data(this,'$now_id','$ToHtmlID','$hy')><a><label class='nowcolfirst'><input type='checkbox'  name='ID' value='".$row["id"]."' style='display: inline-block;'></label> ");
              echo("<font  style=width:120px class='F_M_XS_23 ET_ZD_ShenQingRen$now_id'>".DeleteHtml($row['ZD_ShenQingRen'])."&nbsp;</font>");
              echo("<font  style=width:500px class='F_M_XS_2 ET_ShiYou$now_id'>".DeleteHtml($row['ShiYou'])."&nbsp;</font>");
              echo("</a>");
              echo("<em>".DeleteHtml($row[textN($shuoding_num_list,0, ',')])."</em>");
              echo("</li>");

        };
      };//while end
      mysqli_free_result( $rs ); //释放内存
   };
   $endtime = microtime( true ); //这里获取程序执行结束时间 //计算数据加载时间
   $ymdate = $endtime - $startime;
   $ymdate = round( $ymdate, 3 );
   echo '<script>$("#loadingtimes").html("'.$ymdate.'ms");list_data_end_mobile("'.$sys_const_pagetype.'","DeskMenuDiv494");</script>';
};
mysqli_close( $Conn ); //关闭数据库
?>
