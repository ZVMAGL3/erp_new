<?php
header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
include_once "B_quanxian.php";
include_once "{$_SERVER['PATH_TRANSLATED']}/inc/Function_All.php";
include_once "{$_SERVER['PATH_TRANSLATED']}/inc/Function_list.php";
include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Config.php";
include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Connadmin.php";
$startime = microtime( true ); //这里计算时间开始

global $const_q_cak,$ToHtmlID,$const_q_shanc,$const_q_xiug,$nowkeyword,$px_ziduan,$pxv,$Connadmin,$hy;
	$r_cow_height="28";
	$databiao="msc_yonghudenglujilu";
	$const_shaixuan="";
	$SYS_ALL_ziduan_list="id,sys_adddate,SYS_YongHuMing,SYS_ShouJi,SYS_SuoShuGongSi,SYS_IPDiZhi,SYS_QuanXian,SYS_QuanXian_Name,SYS_DiZhi,SYS_HTTP_REFERER,SYS_PC_Mobile,sys_id_login,sys_shenpi_all";
	$xianshi_ZD_num="10";
	$xianshi_KD_num="1788";
	$shuoding_num="3";
	$maxrecord="20";
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
   $Tablecol_list="id,sys_id_login,sys_login,sys_id_zu,sys_yfzuid,sys_bh,sys_zt,sys_zt_bianhao,sys_nowbh,sys_huis,sys_id_bumen,sys_shenpi,sys_id_fz,sys_web_shenpi,sys_adddate,sys_adddate_g,SYS_SuoShuGongSi_id,sys_shenpi_all,SYS_YongHuMing,SYS_ShouJi,SYS_SuoShuGongSi,SYS_IPDiZhi,SYS_QuanXian,SYS_QuanXian_Name,SYS_DiZhi,SYS_HTTP_REFERER,SYS_PC_Mobile,sys_chaosong,sys_paixu";

   $sql2 = "select (@rownum:=@rownum+1) as rownum,msc_yonghudenglujilu.id  from `msc_yonghudenglujilu`,(select @rownum:=0) as msc_yonghudenglujilu where  sys_yfzuid='$hy' and sys_huis='$huis' "; //这里得到查询id清单的sql
   if($sys_guanxibiao_id != '' && $GuanXi_id != ""){$sql2 .=" and  sys_gx_id_{$sys_guanxibiao_id}='{$GuanXi_id}'";}
   $sql2 =sql_search($databiao,$sql2,$nowkeyword, 0);
   $sql2 .= " order by $px_ziduan $pxv"; //这里得到排序
   $sql2 = "select id from ($sql2) as t where rownum between $page_first and  $page_end ";
   $sql_all_id_list = sql_all_id_list($sql2,$Connadmin );

   if ( !$sql_all_id_list ) {
      echo( "<div class='nodata' tabindex='-1'><div class='nodata_center'><i class='fa fa-nodata' style='margin-top:-1px'></i>&nbsp; Sorry, No Data！</div></div>" );
   } else { 
      $sql = "select  id,sys_adddate,SYS_YongHuMing,SYS_ShouJi,SYS_SuoShuGongSi,SYS_IPDiZhi,SYS_QuanXian,SYS_QuanXian_Name,SYS_DiZhi,SYS_HTTP_REFERER,SYS_PC_Mobile,sys_id_login,sys_shenpi_all  from `msc_yonghudenglujilu` where id in($sql_all_id_list) and sys_yfzuid='$hy' and sys_huis='$huis'";
      $sql .= " order by $px_ziduan $pxv";
      $rs = mysqli_query( $Connadmin, $sql );
      echo( "<div id='para'  tabindex='-1' class='tables'  style='border:0;border-bottom:1px solid #CCC;min-width:100%;width: 1788px'>" );

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
			echo( "  style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;min-width:100%;width:1788px'> " );
			echo( "<li class='cols1 shuodingli'  title='$now_id'  style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;text-align:center;'></li>" );
	
	
              echo("<li id='c_tdtop1'  class='shuodingli   ET_SYS_YongHuMing$now_id F_M_XS_1' ET='ET_SYS_YongHuMing'  xstypeid='1' name='SYS_YongHuMing' style='height:28px;line-height:28px;width:125px;'>".DeleteHtml($row['SYS_YongHuMing'])."</li>");
              echo("<li  class='shuodingli   ET_SYS_ShouJi$now_id F_M_XS_1' ET='ET_SYS_ShouJi'  xstypeid='1' name='SYS_ShouJi' style='height:28px;line-height:28px;width:150px;'>".DeleteHtml($row['SYS_ShouJi'])."</li>");
              echo("<li  class='contentli ET_sys_adddate$now_id F_M_XS_1' ET='ET_sys_adddate'  xstypeid='1' name='sys_adddate' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['sys_adddate'])."</li>");
              echo("<li  class='contentli ET_SYS_SuoShuGongSi$now_id F_M_XS_1' ET='ET_SYS_SuoShuGongSi'  xstypeid='1' name='SYS_SuoShuGongSi' style='height:28px;line-height:28px;width:257px;'>".DeleteHtml($row['SYS_SuoShuGongSi'])."</li>");
              echo("<li  class='contentli ET_SYS_IPDiZhi$now_id F_M_XS_1' ET='ET_SYS_IPDiZhi'  xstypeid='1' name='SYS_IPDiZhi' style='height:28px;line-height:28px;width:122px;'>".DeleteHtml($row['SYS_IPDiZhi'])."</li>");
              echo("<li  class='contentli ET_SYS_QuanXian$now_id F_M_XS_1' ET='ET_SYS_QuanXian'  xstypeid='1' name='SYS_QuanXian' style='height:28px;line-height:28px;width:65px;'>".DeleteHtml($row['SYS_QuanXian'])."</li>");
              echo("<li  class='contentli ET_SYS_QuanXian_Name$now_id F_M_XS_1' ET='ET_SYS_QuanXian_Name'  xstypeid='1' name='SYS_QuanXian_Name' style='height:28px;line-height:28px;width:83px;'>".DeleteHtml($row['SYS_QuanXian_Name'])."</li>");
              echo("<li  class='contentli ET_SYS_DiZhi$now_id F_M_XS_1' ET='ET_SYS_DiZhi'  xstypeid='1' name='SYS_DiZhi' style='height:28px;line-height:28px;width:175px;'>".DeleteHtml($row['SYS_DiZhi'])."</li>");
              echo("<li  class='contentli ET_SYS_HTTP_REFERER$now_id F_M_XS_1' ET='ET_SYS_HTTP_REFERER'  xstypeid='1' name='SYS_HTTP_REFERER' style='height:28px;line-height:28px;width:352px;'>".DeleteHtml($row['SYS_HTTP_REFERER'])."</li>");
              echo("<li  class='contentli ET_SYS_PC_Mobile$now_id F_M_XS_1' ET='ET_SYS_PC_Mobile'  xstypeid='1' name='SYS_PC_Mobile' style='height:28px;line-height:28px;width:109px;'>".DeleteHtml($row['SYS_PC_Mobile'])."</li>");

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
mysqli_close( $Connadmin ); //关闭数据库
?>