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
	$databiao="SQP_KeHuZhengShuGuanLi";
	$const_shaixuan="";
	$SYS_ALL_ziduan_list="id,ZD_ZhengShuHao,ZD_ZhengShuTuPian,sys_gx_id_321,sys_nowbh,ZD_KeHuMingChen,ZD_XiangMu,ZD_ChuShenShiJian,ZD_JianShiJian,ZD_JianShiJian1629904411348,ZD_HuanZhengShiJian,ZD_RenZhengFanWei,ZD_LianXiRen,ZD_DianHua,ZD_GongSiDiZhi,ZD_XiangMuFuZeRen,ZD_RenZhengFei,ZD_GenJinYueFen,ZD_RenZhengJiGou";
	$xianshi_ZD_num="18";
	$xianshi_KD_num="2860";
	$shuoding_num="9";
	$maxrecord="50";
	$FormattingXianShi_idlist="1,6,27";
	$zu_all_list="487=撤消,486=暂停,492=有效,";
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
   $Tablecol_list="ZD_ZhengShuHao,ZD_ZhengShuTuPian,sys_gx_id_321,sys_nowbh,ZD_KeHuMingChen,ZD_XiangMu,id,sys_id_login,sys_login,sys_id_fz,sys_yfzuid,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_chaosong,sys_id_bumen,sys_shenpi,sys_web_shenpi,sys_adddate_g,sys_shenpi_all,ZD_ChuShenShiJian,ZD_JianShiJian,ZD_JianShiJian1629904411348,ZD_HuanZhengShiJian,ZD_RenZhengFanWei,ZD_LianXiRen,ZD_DianHua,ZD_GongSiDiZhi,ZD_XiangMuFuZeRen,ZD_RenZhengFei,ZD_ZiXunFei,sys_adddate,sys_gx_id_423,sys_count_495,ZD_GenJinYueFen,sys_id_zu,ZD_RenZhengJiGou,sys_paixu";

   $sql2 = "select (@rownum:=@rownum+1) as rownum,SQP_KeHuZhengShuGuanLi.id  from `SQP_KeHuZhengShuGuanLi`,(select @rownum:=0) as SQP_KeHuZhengShuGuanLi where  sys_yfzuid='$hy' and sys_huis='$huis' "; //这里得到查询id清单的sql
   if($sys_guanxibiao_id != '' && $GuanXi_id != ""){$sql2 .=" and  sys_gx_id_{$sys_guanxibiao_id}='{$GuanXi_id}'";}
   $sql2 =sql_search($databiao,$sql2,$nowkeyword, 0);
   $sql2 .= " order by $px_ziduan $pxv"; //这里得到排序
   $sql2 = "select id from ($sql2) as t where rownum between $page_first and  $page_end ";
   $sql_all_id_list = sql_all_id_list($sql2,$Conn );

   if ( !$sql_all_id_list ) {
      echo( "<div class='nodata' tabindex='-1'><div class='nodata_center'><i class='fa fa-nodata' style='margin-top:-1px'></i>&nbsp; Sorry, No Data！</div></div>" );
   } else { 
      $sql = "select  id,ZD_ZhengShuHao,ZD_ZhengShuTuPian,sys_gx_id_321,sys_nowbh,ZD_KeHuMingChen,ZD_XiangMu,ZD_ChuShenShiJian,ZD_JianShiJian,ZD_JianShiJian1629904411348,ZD_HuanZhengShiJian,ZD_RenZhengFanWei,ZD_LianXiRen,ZD_DianHua,ZD_GongSiDiZhi,ZD_XiangMuFuZeRen,ZD_RenZhengFei,ZD_GenJinYueFen,ZD_RenZhengJiGou  from `SQP_KeHuZhengShuGuanLi` where id in($sql_all_id_list) and sys_yfzuid='$hy' and sys_huis='$huis'";
      $sql .= " order by $px_ziduan $pxv";
      $rs = mysqli_query( $Conn, $sql );
      echo( "<div id='para'  tabindex='-1' class='tables'  style='border:0;border-bottom:1px solid #CCC;min-width:100%;width:2860'>" );

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
	
	
              echo("<li id='c_tdtop1'  class='shuodingli   ET_ZD_ZhengShuHao$now_id F_M_XS_1' ET='ET_ZD_ZhengShuHao'  xstypeid='1' name='ZD_ZhengShuHao' style='height:28px;line-height:28px;width:120px;'>".DeleteHtml($row['ZD_ZhengShuHao'])."</li>");
              echo("<li  class='shuodingli   ET_ZD_ZhengShuTuPian$now_id F_M_XS_6' ET='ET_ZD_ZhengShuTuPian'  xstypeid='6' name='ZD_ZhengShuTuPian' style='height:28px;line-height:28px;width:84px;'>".DeleteHtml($row['ZD_ZhengShuTuPian'])."</li>");
              echo("<li  class='shuodingli   ET_sys_gx_id_321$now_id F_M_XS_1' ET='ET_sys_gx_id_321'  xstypeid='1' name='sys_gx_id_321' style='height:28px;line-height:28px;width:120px;'>".DeleteHtml($row['sys_gx_id_321'])."</li>");
              echo("<li  class='shuodingli   ET_sys_nowbh$now_id F_M_XS_1' ET='ET_sys_nowbh'  xstypeid='1' name='sys_nowbh' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_nowbh'])."</li>");
              echo("<li  class='shuodingli   ET_ZD_KeHuMingChen$now_id F_M_XS_1' ET='ET_ZD_KeHuMingChen'  xstypeid='1' name='ZD_KeHuMingChen' style='height:28px;line-height:28px;width:200px;'>".DeleteHtml($row['ZD_KeHuMingChen'])."</li>");
              echo("<li  class='shuodingli   ET_ZD_XiangMu$now_id F_M_XS_1' ET='ET_ZD_XiangMu'  xstypeid='1' name='ZD_XiangMu' style='height:28px;line-height:28px;width:264px;'>".DeleteHtml($row['ZD_XiangMu'])."</li>");
              echo("<li  class='shuodingli   ET_ZD_GenJinYueFen$now_id F_M_XS_27' ET='ET_ZD_GenJinYueFen'  xstypeid='27' name='ZD_GenJinYueFen' style='height:28px;line-height:28px;width:76px;'>".DeleteHtml($row['ZD_GenJinYueFen'])."</li>");
              echo("<li  class='shuodingli   ET_ZD_RenZhengJiGou$now_id F_M_XS_1' ET='ET_ZD_RenZhengJiGou'  xstypeid='1' name='ZD_RenZhengJiGou' style='height:28px;line-height:28px;width:125px;'>".DeleteHtml($row['ZD_RenZhengJiGou'])."</li>");
              echo("<li class='contentli ET_ZD_ChuShenShiJian$now_id F_M_XS_1' ET='ET_ZD_ChuShenShiJian'  xstypeid='1' name='ZD_ChuShenShiJian' style='height:28px;line-height:28px;width:175px;'>".DeleteHtml($row['ZD_ChuShenShiJian'])."</li>");
              echo("<li class='contentli ET_ZD_JianShiJian$now_id F_M_XS_1' ET='ET_ZD_JianShiJian'  xstypeid='1' name='ZD_JianShiJian' style='height:28px;line-height:28px;width:175px;'>".DeleteHtml($row['ZD_JianShiJian'])."</li>");
              echo("<li class='contentli ET_ZD_JianShiJian1629904411348$now_id F_M_XS_1' ET='ET_ZD_JianShiJian1629904411348'  xstypeid='1' name='ZD_JianShiJian1629904411348' style='height:28px;line-height:28px;width:199px;'>".DeleteHtml($row['ZD_JianShiJian1629904411348'])."</li>");
              echo("<li class='contentli ET_ZD_HuanZhengShiJian$now_id F_M_XS_1' ET='ET_ZD_HuanZhengShiJian'  xstypeid='1' name='ZD_HuanZhengShiJian' style='height:28px;line-height:28px;width:189px;'>".DeleteHtml($row['ZD_HuanZhengShiJian'])."</li>");
              echo("<li class='contentli ET_ZD_RenZhengFanWei$now_id F_M_XS_1' ET='ET_ZD_RenZhengFanWei'  xstypeid='1' name='ZD_RenZhengFanWei' style='height:28px;line-height:28px;width:200px;'>".DeleteHtml($row['ZD_RenZhengFanWei'])."</li>");
              echo("<li class='contentli ET_ZD_LianXiRen$now_id F_M_XS_1' ET='ET_ZD_LianXiRen'  xstypeid='1' name='ZD_LianXiRen' style='height:28px;line-height:28px;width:175px;'>".DeleteHtml($row['ZD_LianXiRen'])."</li>");
              echo("<li class='contentli ET_ZD_DianHua$now_id F_M_XS_1' ET='ET_ZD_DianHua'  xstypeid='1' name='ZD_DianHua' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['ZD_DianHua'])."</li>");
              echo("<li class='contentli ET_ZD_GongSiDiZhi$now_id F_M_XS_1' ET='ET_ZD_GongSiDiZhi'  xstypeid='1' name='ZD_GongSiDiZhi' style='height:28px;line-height:28px;width:200px;'>".DeleteHtml($row['ZD_GongSiDiZhi'])."</li>");
              echo("<li class='contentli ET_ZD_XiangMuFuZeRen$now_id F_M_XS_1' ET='ET_ZD_XiangMuFuZeRen'  xstypeid='1' name='ZD_XiangMuFuZeRen' style='height:28px;line-height:28px;width:131px;'>".DeleteHtml($row['ZD_XiangMuFuZeRen'])."</li>");
              echo("<li class='contentli ET_ZD_RenZhengFei$now_id F_M_XS_1' ET='ET_ZD_RenZhengFei'  xstypeid='1' name='ZD_RenZhengFei' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['ZD_RenZhengFei'])."</li>");

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