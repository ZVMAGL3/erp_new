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
	$databiao="SQP_GongXianZhi";
	$const_shaixuan="";
	$SYS_ALL_ziduan_list="id,sys_nowbh,ZD_XingMing,ZD_GongXianZhi,ZD_JiFen,ZD_GongXianZhi2020827‎16‎‎40‎‎1012,ZD_JiFen2020827‎16‎‎40‎‎142964,ZD_GongXianZhi2020827‎16‎‎40‎‎252196,ZD_JiFen2020827‎16‎‎40‎‎332199,ZD_GongXianZhi2020827‎16‎‎40‎‎402031,ZD_JiFen2020827‎16‎‎40‎‎46924,ZD_GongXianZhi2020827‎16‎‎41‎‎00300,ZD_JiFen2020827‎16‎‎41‎‎12810,ZD_GongXianZhi2020827‎16‎‎41‎‎24450,ZD_JiFen2020827‎16‎‎56‎‎012850,ZD_GongXianZhi2020827‎16‎‎54‎‎322661,ZD_JiFen2020827‎16‎‎41‎‎331482,ZD_GongXianZhi2020827‎16‎‎41‎‎42138,ZD_JiFen2020827‎16‎‎41‎‎462247,ZD_GongXianZhi2020827‎16‎‎41‎‎531791,ZD_JiFen2020827‎16‎‎41‎‎572919,ZD_GongXianZhi2020827‎16‎‎46‎‎12927,ZD_JiFen2020827‎16‎‎46‎‎172175,ZD_GongXianZhi2020827‎16‎‎46‎‎241170,ZD_JiFen2020827‎16‎‎46‎‎301743,ZD_GongXianZhi2020827‎16‎‎46‎‎361122,ZD_JiFen2020827‎16‎‎46‎‎4115,ZD_ZongGongXianZhi,ZD_ZongJiFen,ZD_HeJi,ZD_BeiZhu";
	$xianshi_ZD_num="30";
	$xianshi_KD_num="2005";
	$shuoding_num="2";
	$maxrecord="50";
	$FormattingXianShi_idlist="1";
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
   $Tablecol_list="id,sys_id_login,sys_login,sys_id_zu,sys_id_fz,sys_yfzuid,sys_bh,sys_zt,sys_zt_bianhao,sys_nowbh,sys_huis,sys_id_bumen,sys_shenpi,sys_web_shenpi,sys_adddate,sys_adddate_g,sys_shenpi_all,ZD_XingMing,ZD_GongXianZhi,ZD_JiFen,ZD_GongXianZhi2020827‎16‎‎40‎‎1012,ZD_JiFen2020827‎16‎‎40‎‎142964,ZD_GongXianZhi2020827‎16‎‎40‎‎252196,ZD_JiFen2020827‎16‎‎40‎‎332199,ZD_GongXianZhi2020827‎16‎‎40‎‎402031,ZD_JiFen2020827‎16‎‎40‎‎46924,ZD_GongXianZhi2020827‎16‎‎41‎‎00300,ZD_JiFen2020827‎16‎‎41‎‎12810,ZD_GongXianZhi2020827‎16‎‎41‎‎24450,ZD_JiFen2020827‎16‎‎56‎‎012850,ZD_GongXianZhi2020827‎16‎‎54‎‎322661,ZD_JiFen2020827‎16‎‎41‎‎331482,ZD_GongXianZhi2020827‎16‎‎41‎‎42138,ZD_JiFen2020827‎16‎‎41‎‎462247,ZD_GongXianZhi2020827‎16‎‎41‎‎531791,ZD_JiFen2020827‎16‎‎41‎‎572919,ZD_GongXianZhi2020827‎16‎‎46‎‎12927,ZD_JiFen2020827‎16‎‎46‎‎172175,ZD_GongXianZhi2020827‎16‎‎46‎‎241170,ZD_JiFen2020827‎16‎‎46‎‎301743,ZD_GongXianZhi2020827‎16‎‎46‎‎361122,ZD_JiFen2020827‎16‎‎46‎‎4115,ZD_ZongGongXianZhi,ZD_ZongJiFen,ZD_HeJi,ZD_BeiZhu,sys_chaosong,sys_paixu";

   $sql2 = "select (@rownum:=@rownum+1) as rownum,SQP_GongXianZhi.id  from `SQP_GongXianZhi`,(select @rownum:=0) as SQP_GongXianZhi where  sys_yfzuid='$hy' and sys_huis='$huis' "; //这里得到查询id清单的sql
   if($sys_guanxibiao_id != '' && $GuanXi_id != ""){$sql2 .=" and  sys_gx_id_{$sys_guanxibiao_id}='{$GuanXi_id}'";}
   $sql2 =sql_search($databiao,$sql2,$nowkeyword, 0);
   $sql2 .= " order by $px_ziduan $pxv"; //这里得到排序
   $sql2 = "select id from ($sql2) as t where rownum between $page_first and  $page_end ";
   $sql_all_id_list = sql_all_id_list($sql2,$Conn );

   if ( !$sql_all_id_list ) {
      echo( "<div class='nodata' tabindex='-1'><div class='nodata_center'><i class='fa fa-nodata' style='margin-top:-1px'></i>&nbsp; Sorry, No Data！</div></div>" );
   } else { 
      $sql = "select  id,sys_nowbh,ZD_XingMing,ZD_GongXianZhi,ZD_JiFen,ZD_GongXianZhi2020827‎16‎‎40‎‎1012,ZD_JiFen2020827‎16‎‎40‎‎142964,ZD_GongXianZhi2020827‎16‎‎40‎‎252196,ZD_JiFen2020827‎16‎‎40‎‎332199,ZD_GongXianZhi2020827‎16‎‎40‎‎402031,ZD_JiFen2020827‎16‎‎40‎‎46924,ZD_GongXianZhi2020827‎16‎‎41‎‎00300,ZD_JiFen2020827‎16‎‎41‎‎12810,ZD_GongXianZhi2020827‎16‎‎41‎‎24450,ZD_JiFen2020827‎16‎‎56‎‎012850,ZD_GongXianZhi2020827‎16‎‎54‎‎322661,ZD_JiFen2020827‎16‎‎41‎‎331482,ZD_GongXianZhi2020827‎16‎‎41‎‎42138,ZD_JiFen2020827‎16‎‎41‎‎462247,ZD_GongXianZhi2020827‎16‎‎41‎‎531791,ZD_JiFen2020827‎16‎‎41‎‎572919,ZD_GongXianZhi2020827‎16‎‎46‎‎12927,ZD_JiFen2020827‎16‎‎46‎‎172175,ZD_GongXianZhi2020827‎16‎‎46‎‎241170,ZD_JiFen2020827‎16‎‎46‎‎301743,ZD_GongXianZhi2020827‎16‎‎46‎‎361122,ZD_JiFen2020827‎16‎‎46‎‎4115,ZD_ZongGongXianZhi,ZD_ZongJiFen,ZD_HeJi,ZD_BeiZhu  from `SQP_GongXianZhi` where id in($sql_all_id_list) and sys_yfzuid='$hy' and sys_huis='$huis'";
      $sql .= " order by $px_ziduan $pxv";
      $rs = mysqli_query( $Conn, $sql );
      echo( "<div id='para'  tabindex='-1' class='tables'  style='border:0;border-bottom:1px solid #CCC;min-width:100%;width:2005'>" );

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
              echo("<li  class='shuodingli  border_shuoding  ET_ZD_XingMing$now_id F_M_XS_1' ET='ET_ZD_XingMing'  xstypeid='1' name='ZD_XingMing' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_XingMing'])."</li>");
              echo("<li class='contentli ET_ZD_GongXianZhi$now_id F_M_XS_1' ET='ET_ZD_GongXianZhi'  xstypeid='1' name='ZD_GongXianZhi' style='height:28px;line-height:28px;width:60px;'>".DeleteHtml($row['ZD_GongXianZhi'])."</li>");
              echo("<li class='contentli ET_ZD_JiFen$now_id F_M_XS_1' ET='ET_ZD_JiFen'  xstypeid='1' name='ZD_JiFen' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_JiFen'])."</li>");
              echo("<li class='contentli ET_ZD_GongXianZhi2020827‎16‎‎40‎‎1012$now_id F_M_XS_1' ET='ET_ZD_GongXianZhi2020827‎16‎‎40‎‎1012'  xstypeid='1' name='ZD_GongXianZhi2020827‎16‎‎40‎‎1012' style='height:28px;line-height:28px;width:60px;'>".DeleteHtml($row['ZD_GongXianZhi2020827‎16‎‎40‎‎1012'])."</li>");
              echo("<li class='contentli ET_ZD_JiFen2020827‎16‎‎40‎‎142964$now_id F_M_XS_1' ET='ET_ZD_JiFen2020827‎16‎‎40‎‎142964'  xstypeid='1' name='ZD_JiFen2020827‎16‎‎40‎‎142964' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_JiFen2020827‎16‎‎40‎‎142964'])."</li>");
              echo("<li class='contentli ET_ZD_GongXianZhi2020827‎16‎‎40‎‎252196$now_id F_M_XS_1' ET='ET_ZD_GongXianZhi2020827‎16‎‎40‎‎252196'  xstypeid='1' name='ZD_GongXianZhi2020827‎16‎‎40‎‎252196' style='height:28px;line-height:28px;width:60px;'>".DeleteHtml($row['ZD_GongXianZhi2020827‎16‎‎40‎‎252196'])."</li>");
              echo("<li class='contentli ET_ZD_JiFen2020827‎16‎‎40‎‎332199$now_id F_M_XS_1' ET='ET_ZD_JiFen2020827‎16‎‎40‎‎332199'  xstypeid='1' name='ZD_JiFen2020827‎16‎‎40‎‎332199' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_JiFen2020827‎16‎‎40‎‎332199'])."</li>");
              echo("<li class='contentli ET_ZD_GongXianZhi2020827‎16‎‎40‎‎402031$now_id F_M_XS_1' ET='ET_ZD_GongXianZhi2020827‎16‎‎40‎‎402031'  xstypeid='1' name='ZD_GongXianZhi2020827‎16‎‎40‎‎402031' style='height:28px;line-height:28px;width:60px;'>".DeleteHtml($row['ZD_GongXianZhi2020827‎16‎‎40‎‎402031'])."</li>");
              echo("<li class='contentli ET_ZD_JiFen2020827‎16‎‎40‎‎46924$now_id F_M_XS_1' ET='ET_ZD_JiFen2020827‎16‎‎40‎‎46924'  xstypeid='1' name='ZD_JiFen2020827‎16‎‎40‎‎46924' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_JiFen2020827‎16‎‎40‎‎46924'])."</li>");
              echo("<li class='contentli ET_ZD_GongXianZhi2020827‎16‎‎41‎‎00300$now_id F_M_XS_1' ET='ET_ZD_GongXianZhi2020827‎16‎‎41‎‎00300'  xstypeid='1' name='ZD_GongXianZhi2020827‎16‎‎41‎‎00300' style='height:28px;line-height:28px;width:60px;'>".DeleteHtml($row['ZD_GongXianZhi2020827‎16‎‎41‎‎00300'])."</li>");
              echo("<li class='contentli ET_ZD_JiFen2020827‎16‎‎41‎‎12810$now_id F_M_XS_1' ET='ET_ZD_JiFen2020827‎16‎‎41‎‎12810'  xstypeid='1' name='ZD_JiFen2020827‎16‎‎41‎‎12810' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_JiFen2020827‎16‎‎41‎‎12810'])."</li>");
              echo("<li class='contentli ET_ZD_GongXianZhi2020827‎16‎‎41‎‎24450$now_id F_M_XS_1' ET='ET_ZD_GongXianZhi2020827‎16‎‎41‎‎24450'  xstypeid='1' name='ZD_GongXianZhi2020827‎16‎‎41‎‎24450' style='height:28px;line-height:28px;width:60px;'>".DeleteHtml($row['ZD_GongXianZhi2020827‎16‎‎41‎‎24450'])."</li>");
              echo("<li class='contentli ET_ZD_JiFen2020827‎16‎‎56‎‎012850$now_id F_M_XS_1' ET='ET_ZD_JiFen2020827‎16‎‎56‎‎012850'  xstypeid='1' name='ZD_JiFen2020827‎16‎‎56‎‎012850' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_JiFen2020827‎16‎‎56‎‎012850'])."</li>");
              echo("<li class='contentli ET_ZD_GongXianZhi2020827‎16‎‎54‎‎322661$now_id F_M_XS_1' ET='ET_ZD_GongXianZhi2020827‎16‎‎54‎‎322661'  xstypeid='1' name='ZD_GongXianZhi2020827‎16‎‎54‎‎322661' style='height:28px;line-height:28px;width:60px;'>".DeleteHtml($row['ZD_GongXianZhi2020827‎16‎‎54‎‎322661'])."</li>");
              echo("<li class='contentli ET_ZD_JiFen2020827‎16‎‎41‎‎331482$now_id F_M_XS_1' ET='ET_ZD_JiFen2020827‎16‎‎41‎‎331482'  xstypeid='1' name='ZD_JiFen2020827‎16‎‎41‎‎331482' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_JiFen2020827‎16‎‎41‎‎331482'])."</li>");
              echo("<li class='contentli ET_ZD_GongXianZhi2020827‎16‎‎41‎‎42138$now_id F_M_XS_1' ET='ET_ZD_GongXianZhi2020827‎16‎‎41‎‎42138'  xstypeid='1' name='ZD_GongXianZhi2020827‎16‎‎41‎‎42138' style='height:28px;line-height:28px;width:60px;'>".DeleteHtml($row['ZD_GongXianZhi2020827‎16‎‎41‎‎42138'])."</li>");
              echo("<li class='contentli ET_ZD_JiFen2020827‎16‎‎41‎‎462247$now_id F_M_XS_1' ET='ET_ZD_JiFen2020827‎16‎‎41‎‎462247'  xstypeid='1' name='ZD_JiFen2020827‎16‎‎41‎‎462247' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_JiFen2020827‎16‎‎41‎‎462247'])."</li>");
              echo("<li class='contentli ET_ZD_GongXianZhi2020827‎16‎‎41‎‎531791$now_id F_M_XS_1' ET='ET_ZD_GongXianZhi2020827‎16‎‎41‎‎531791'  xstypeid='1' name='ZD_GongXianZhi2020827‎16‎‎41‎‎531791' style='height:28px;line-height:28px;width:60px;'>".DeleteHtml($row['ZD_GongXianZhi2020827‎16‎‎41‎‎531791'])."</li>");
              echo("<li class='contentli ET_ZD_JiFen2020827‎16‎‎41‎‎572919$now_id F_M_XS_1' ET='ET_ZD_JiFen2020827‎16‎‎41‎‎572919'  xstypeid='1' name='ZD_JiFen2020827‎16‎‎41‎‎572919' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_JiFen2020827‎16‎‎41‎‎572919'])."</li>");
              echo("<li class='contentli ET_ZD_GongXianZhi2020827‎16‎‎46‎‎12927$now_id F_M_XS_1' ET='ET_ZD_GongXianZhi2020827‎16‎‎46‎‎12927'  xstypeid='1' name='ZD_GongXianZhi2020827‎16‎‎46‎‎12927' style='height:28px;line-height:28px;width:60px;'>".DeleteHtml($row['ZD_GongXianZhi2020827‎16‎‎46‎‎12927'])."</li>");
              echo("<li class='contentli ET_ZD_JiFen2020827‎16‎‎46‎‎172175$now_id F_M_XS_1' ET='ET_ZD_JiFen2020827‎16‎‎46‎‎172175'  xstypeid='1' name='ZD_JiFen2020827‎16‎‎46‎‎172175' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_JiFen2020827‎16‎‎46‎‎172175'])."</li>");
              echo("<li class='contentli ET_ZD_GongXianZhi2020827‎16‎‎46‎‎241170$now_id F_M_XS_1' ET='ET_ZD_GongXianZhi2020827‎16‎‎46‎‎241170'  xstypeid='1' name='ZD_GongXianZhi2020827‎16‎‎46‎‎241170' style='height:28px;line-height:28px;width:60px;'>".DeleteHtml($row['ZD_GongXianZhi2020827‎16‎‎46‎‎241170'])."</li>");
              echo("<li class='contentli ET_ZD_JiFen2020827‎16‎‎46‎‎301743$now_id F_M_XS_1' ET='ET_ZD_JiFen2020827‎16‎‎46‎‎301743'  xstypeid='1' name='ZD_JiFen2020827‎16‎‎46‎‎301743' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_JiFen2020827‎16‎‎46‎‎301743'])."</li>");
              echo("<li class='contentli ET_ZD_GongXianZhi2020827‎16‎‎46‎‎361122$now_id F_M_XS_1' ET='ET_ZD_GongXianZhi2020827‎16‎‎46‎‎361122'  xstypeid='1' name='ZD_GongXianZhi2020827‎16‎‎46‎‎361122' style='height:28px;line-height:28px;width:60px;'>".DeleteHtml($row['ZD_GongXianZhi2020827‎16‎‎46‎‎361122'])."</li>");
              echo("<li class='contentli ET_ZD_JiFen2020827‎16‎‎46‎‎4115$now_id F_M_XS_1' ET='ET_ZD_JiFen2020827‎16‎‎46‎‎4115'  xstypeid='1' name='ZD_JiFen2020827‎16‎‎46‎‎4115' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_JiFen2020827‎16‎‎46‎‎4115'])."</li>");
              echo("<li class='contentli ET_ZD_ZongGongXianZhi$now_id F_M_XS_1' ET='ET_ZD_ZongGongXianZhi'  xstypeid='1' name='ZD_ZongGongXianZhi' style='height:28px;line-height:28px;width:70px;'>".DeleteHtml($row['ZD_ZongGongXianZhi'])."</li>");
              echo("<li class='contentli ET_ZD_ZongJiFen$now_id F_M_XS_1' ET='ET_ZD_ZongJiFen'  xstypeid='1' name='ZD_ZongJiFen' style='height:28px;line-height:28px;width:70px;'>".DeleteHtml($row['ZD_ZongJiFen'])."</li>");
              echo("<li class='contentli ET_ZD_HeJi$now_id F_M_XS_1' ET='ET_ZD_HeJi'  xstypeid='1' name='ZD_HeJi' style='height:28px;line-height:28px;width:70px;'>".DeleteHtml($row['ZD_HeJi'])."</li>");
              echo("<li class='contentli ET_ZD_BeiZhu$now_id F_M_XS_1' ET='ET_ZD_BeiZhu'  xstypeid='1' name='ZD_BeiZhu' style='height:28px;line-height:28px;width:150px;'>".DeleteHtml($row['ZD_BeiZhu'])."</li>");

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
