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
	$databiao="msc_zhiwei";
	$const_shaixuan="";
	$SYS_ALL_ziduan_list="id,zu,sys_q_zhixing,sys_q_fanwei,sys_q_cak,sys_q_tianj,sys_q_xiug,sys_q_shanc,sys_q_dayin,sys_q_xiaohui,sys_q_huis,sys_q_seid,sys_q_shenghe,sys_q_pizhun,sys_zhiwugongzi,sys_jichugongzi";
	$xianshi_ZD_num="15";
	$xianshi_KD_num="1375";
	$shuoding_num="1";
	$maxrecord="50";
	$FormattingXianShi_idlist="2,1";
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
   $Tablecol_list="id,sys_yfzuid,xu,zu,bumen,bigmenu,beizhu,FuZeRen,sys_q_zhixing,sys_q_fanwei,sys_q_cak,sys_q_tianj,sys_q_xiug,sys_q_shanc,sys_q_dayin,sys_q_xiaohui,sys_q_huis,sys_q_dian,sys_q_seid,sys_q_shenghe,sys_q_pizhun,rzyq,paixu,xueli,xinbie,nianl1,nianl2,jiny,chizu,minge,gongzi,sys_zhiwugongzi,sys_jichugongzi,kaig,sys_huis,sys_id_bumen,sys_shenpi,sys_id_fz,sys_web_shenpi,sys_shenpi_all,sys_adddate,sys_adddate_g,sys_id_zu,sys_login,sys_id_login,sys_bh,sys_zt,sys_zt_bianhao,sys_nowbh,sys_chaosong,sys_paixu";

   $sql2 = "select (@rownum:=@rownum+1) as rownum,msc_zhiwei.id  from `msc_zhiwei`,(select @rownum:=0) as msc_zhiwei where  sys_yfzuid='$hy' and sys_huis='$huis' "; //这里得到查询id清单的sql
   if($sys_guanxibiao_id != '' && $GuanXi_id != ""){$sql2 .=" and  sys_gx_id_{$sys_guanxibiao_id}='{$GuanXi_id}'";}
   $sql2 =sql_search($databiao,$sql2,$nowkeyword, 0);
   $sql2 .= " order by $px_ziduan $pxv"; //这里得到排序
   $sql2 = "select id from ($sql2) as t where rownum between $page_first and  $page_end ";
   $sql_all_id_list = sql_all_id_list($sql2,$Connadmin );

   if ( !$sql_all_id_list ) {
      echo( "<div class='nodata' tabindex='-1'><div class='nodata_center'><i class='fa fa-nodata' style='margin-top:-1px'></i>&nbsp; Sorry, No Data！</div></div>" );
   } else { 
      $sql = "select  id,zu,sys_q_zhixing,sys_q_fanwei,sys_q_cak,sys_q_tianj,sys_q_xiug,sys_q_shanc,sys_q_dayin,sys_q_xiaohui,sys_q_huis,sys_q_seid,sys_q_shenghe,sys_q_pizhun,sys_zhiwugongzi,sys_jichugongzi  from `msc_zhiwei` where id in($sql_all_id_list) and sys_yfzuid='$hy' and sys_huis='$huis'";
      $sql .= " order by $px_ziduan $pxv";
      $rs = mysqli_query( $Connadmin, $sql );
      echo( "<div id='para'  tabindex='-1' class='tables'  style='border:0;border-bottom:1px solid #CCC;min-width:100%;width:1375'>" );

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
	
	
              echo("<li id='c_tdtop1'  class='shuodingli  border_shuoding  ET_zu$now_id F_M_XS_2' ET='ET_zu'  xstypeid='2' name='zu' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['zu'])."</li>");
              echo("<li class='contentli ET_sys_q_zhixing$now_id F_M_XS_2' ET='ET_sys_q_zhixing'  xstypeid='2' name='sys_q_zhixing' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_q_zhixing'])."</li>");
              echo("<li class='contentli ET_sys_q_fanwei$now_id F_M_XS_2' ET='ET_sys_q_fanwei'  xstypeid='2' name='sys_q_fanwei' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_q_fanwei'])."</li>");
              echo("<li class='contentli ET_sys_q_cak$now_id F_M_XS_2' ET='ET_sys_q_cak'  xstypeid='2' name='sys_q_cak' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_q_cak'])."</li>");
              echo("<li class='contentli ET_sys_q_tianj$now_id F_M_XS_2' ET='ET_sys_q_tianj'  xstypeid='2' name='sys_q_tianj' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_q_tianj'])."</li>");
              echo("<li class='contentli ET_sys_q_xiug$now_id F_M_XS_2' ET='ET_sys_q_xiug'  xstypeid='2' name='sys_q_xiug' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_q_xiug'])."</li>");
              echo("<li class='contentli ET_sys_q_shanc$now_id F_M_XS_2' ET='ET_sys_q_shanc'  xstypeid='2' name='sys_q_shanc' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_q_shanc'])."</li>");
              echo("<li class='contentli ET_sys_q_dayin$now_id F_M_XS_2' ET='ET_sys_q_dayin'  xstypeid='2' name='sys_q_dayin' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_q_dayin'])."</li>");
              echo("<li class='contentli ET_sys_q_xiaohui$now_id F_M_XS_2' ET='ET_sys_q_xiaohui'  xstypeid='2' name='sys_q_xiaohui' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_q_xiaohui'])."</li>");
              echo("<li class='contentli ET_sys_q_huis$now_id F_M_XS_2' ET='ET_sys_q_huis'  xstypeid='2' name='sys_q_huis' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_q_huis'])."</li>");
              echo("<li class='contentli ET_sys_q_seid$now_id F_M_XS_2' ET='ET_sys_q_seid'  xstypeid='2' name='sys_q_seid' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_q_seid'])."</li>");
              echo("<li class='contentli ET_sys_q_shenghe$now_id F_M_XS_2' ET='ET_sys_q_shenghe'  xstypeid='2' name='sys_q_shenghe' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_q_shenghe'])."</li>");
              echo("<li class='contentli ET_sys_q_pizhun$now_id F_M_XS_2' ET='ET_sys_q_pizhun'  xstypeid='2' name='sys_q_pizhun' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_q_pizhun'])."</li>");
              echo("<li class='contentli ET_sys_zhiwugongzi$now_id F_M_XS_1' ET='ET_sys_zhiwugongzi'  xstypeid='1' name='sys_zhiwugongzi' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['sys_zhiwugongzi'])."</li>");
              echo("<li class='contentli ET_sys_jichugongzi$now_id F_M_XS_1' ET='ET_sys_jichugongzi'  xstypeid='1' name='sys_jichugongzi' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['sys_jichugongzi'])."</li>");

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
mysqli_close( $Connadmin ); //关闭数据库
?>
