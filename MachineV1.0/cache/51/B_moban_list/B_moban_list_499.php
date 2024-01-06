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
	$databiao="SQP_HeTongXiangMuGenZongJiLu";
	$const_shaixuan="";
	$SYS_ALL_ziduan_list="id,sys_nowbh,ZD_QianDingRiQi,ZD_HeTongBianHao,ZD_GongSiMingChen,ZD_XiangMu,ZD_JiaoQi,ZD_LianXiRen,ZD_DianHua,ZD_YuFuKuanJinERiQiZhangHao,ZD_HeTongShangChuan,ZD_FuWuLiuChengDanQianShouRiQi,ZD_XiangMuWanChengRiQi,ZD_WeiKuan,ZD_ZhengShuShangChuan,ZD_PaiZhaoXuanChuan,ZD_BeiZhu,sys_id_login,sys_shenpi_all";
	$xianshi_ZD_num="16";
	$xianshi_KD_num="1810";
	$shuoding_num="2";
	$maxrecord="50";
	$FormattingXianShi_idlist="1,8,6";
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
   $Tablecol_list="id,sys_id_login,sys_login,sys_id_zu,sys_id_fz,sys_yfzuid,sys_bh,sys_zt,sys_zt_bianhao,sys_nowbh,sys_huis,sys_id_bumen,sys_shenpi,sys_web_shenpi,sys_adddate,sys_adddate_g,sys_shenpi_all,ZD_QianDingRiQi,ZD_HeTongBianHao,ZD_GongSiMingChen,ZD_XiangMu,ZD_JiaoQi,ZD_LianXiRen,ZD_DianHua,ZD_YuFuKuanJinERiQiZhangHao,ZD_HeTongJiLu,ZD_HeTongShangChuan,ZD_FuWuLiuChengDanQianShouRiQi,ZD_XiangMuWanChengRiQi,ZD_WeiKuan,ZD_ZhengShuShangChuan,ZD_PaiZhaoXuanChuan,ZD_BeiZhu,sys_chaosong,sys_gx_id_321,sys_gx_id_423,sys_paixu,sys_gx_id_257";

   $sql2 = "select (@rownum:=@rownum+1) as rownum,SQP_HeTongXiangMuGenZongJiLu.id  from `SQP_HeTongXiangMuGenZongJiLu`,(select @rownum:=0) as SQP_HeTongXiangMuGenZongJiLu where  sys_yfzuid='$hy' and sys_huis='$huis' "; //这里得到查询id清单的sql
   if($sys_guanxibiao_id != '' && $GuanXi_id != ""){$sql2 .=" and  sys_gx_id_{$sys_guanxibiao_id}='{$GuanXi_id}'";}
   $sql2 =sql_search($databiao,$sql2,$nowkeyword, 0);
   $sql2 .= " order by $px_ziduan $pxv"; //这里得到排序
   $sql2 = "select id from ($sql2) as t where rownum between $page_first and  $page_end ";
   $sql_all_id_list = sql_all_id_list($sql2,$Conn );

   if ( !$sql_all_id_list ) {
      echo( "<div class='nodata' tabindex='-1'><div class='nodata_center'><i class='fa fa-nodata' style='margin-top:-1px'></i>&nbsp; Sorry, No Data！</div></div>" );
   } else { 
      $sql = "select  id,sys_nowbh,ZD_QianDingRiQi,ZD_HeTongBianHao,ZD_GongSiMingChen,ZD_XiangMu,ZD_JiaoQi,ZD_LianXiRen,ZD_DianHua,ZD_YuFuKuanJinERiQiZhangHao,ZD_HeTongShangChuan,ZD_FuWuLiuChengDanQianShouRiQi,ZD_XiangMuWanChengRiQi,ZD_WeiKuan,ZD_ZhengShuShangChuan,ZD_PaiZhaoXuanChuan,ZD_BeiZhu,sys_id_login,sys_shenpi_all  from `SQP_HeTongXiangMuGenZongJiLu` where id in($sql_all_id_list) and sys_yfzuid='$hy' and sys_huis='$huis'";
      $sql .= " order by $px_ziduan $pxv";
      $rs = mysqli_query( $Conn, $sql );
      echo( "<div id='para'  tabindex='-1' class='tables'  style='border:0;border-bottom:1px solid #CCC;min-width:100%;width: 1810px'>" );

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
			echo( "  style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;min-width:100%;width:1810px'> " );
			echo( "<li class='cols1 shuodingli'  title='$now_id'  style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;text-align:center;'></li>" );
	
	
              echo("<li id='c_tdtop1'  class='shuodingli   ET_sys_nowbh$now_id F_M_XS_1' ET='ET_sys_nowbh'  xstypeid='1' name='sys_nowbh' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_nowbh'])."</li>");
              echo("<li  class='shuodingli  border_shuoding  ET_ZD_GongSiMingChen$now_id F_M_XS_1' ET='ET_ZD_GongSiMingChen'  xstypeid='1' name='ZD_GongSiMingChen' style='height:28px;line-height:28px;width:150px;'>".DeleteHtml($row['ZD_GongSiMingChen'])."</li>");
              echo("<li  class='contentli ET_ZD_QianDingRiQi$now_id F_M_XS_8' ET='ET_ZD_QianDingRiQi'  xstypeid='8' name='ZD_QianDingRiQi' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZD_QianDingRiQi'])."</li>");
              echo("<li  class='contentli ET_ZD_HeTongBianHao$now_id F_M_XS_1' ET='ET_ZD_HeTongBianHao'  xstypeid='1' name='ZD_HeTongBianHao' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZD_HeTongBianHao'])."</li>");
              echo("<li  class='contentli ET_ZD_XiangMu$now_id F_M_XS_1' ET='ET_ZD_XiangMu'  xstypeid='1' name='ZD_XiangMu' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZD_XiangMu'])."</li>");
              echo("<li  class='contentli ET_ZD_JiaoQi$now_id F_M_XS_1' ET='ET_ZD_JiaoQi'  xstypeid='1' name='ZD_JiaoQi' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['ZD_JiaoQi'])."</li>");
              echo("<li  class='contentli ET_ZD_LianXiRen$now_id F_M_XS_1' ET='ET_ZD_LianXiRen'  xstypeid='1' name='ZD_LianXiRen' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZD_LianXiRen'])."</li>");
              echo("<li  class='contentli ET_ZD_DianHua$now_id F_M_XS_1' ET='ET_ZD_DianHua'  xstypeid='1' name='ZD_DianHua' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['ZD_DianHua'])."</li>");
              echo("<li  class='contentli ET_ZD_YuFuKuanJinERiQiZhangHao$now_id F_M_XS_1' ET='ET_ZD_YuFuKuanJinERiQiZhangHao'  xstypeid='1' name='ZD_YuFuKuanJinERiQiZhangHao' style='height:28px;line-height:28px;width:150px;'>".DeleteHtml($row['ZD_YuFuKuanJinERiQiZhangHao'])."</li>");
              echo("<li  class='contentli ET_ZD_HeTongShangChuan$now_id F_M_XS_6' ET='ET_ZD_HeTongShangChuan'  xstypeid='6' name='ZD_HeTongShangChuan' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZD_HeTongShangChuan'])."</li>");
              echo("<li  class='contentli ET_ZD_FuWuLiuChengDanQianShouRiQi$now_id F_M_XS_1' ET='ET_ZD_FuWuLiuChengDanQianShouRiQi'  xstypeid='1' name='ZD_FuWuLiuChengDanQianShouRiQi' style='height:28px;line-height:28px;width:130px;'>".DeleteHtml($row['ZD_FuWuLiuChengDanQianShouRiQi'])."</li>");
              echo("<li  class='contentli ET_ZD_XiangMuWanChengRiQi$now_id F_M_XS_1' ET='ET_ZD_XiangMuWanChengRiQi'  xstypeid='1' name='ZD_XiangMuWanChengRiQi' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['ZD_XiangMuWanChengRiQi'])."</li>");
              echo("<li  class='contentli ET_ZD_WeiKuan$now_id F_M_XS_1' ET='ET_ZD_WeiKuan'  xstypeid='1' name='ZD_WeiKuan' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZD_WeiKuan'])."</li>");
              echo("<li  class='contentli ET_ZD_ZhengShuShangChuan$now_id F_M_XS_6' ET='ET_ZD_ZhengShuShangChuan'  xstypeid='6' name='ZD_ZhengShuShangChuan' style='height:28px;line-height:28px;width:60px;'>".DeleteHtml($row['ZD_ZhengShuShangChuan'])."</li>");
              echo("<li  class='contentli ET_ZD_PaiZhaoXuanChuan$now_id F_M_XS_6' ET='ET_ZD_PaiZhaoXuanChuan'  xstypeid='6' name='ZD_PaiZhaoXuanChuan' style='height:28px;line-height:28px;width:60px;'>".DeleteHtml($row['ZD_PaiZhaoXuanChuan'])."</li>");
              echo("<li  class='contentli ET_ZD_BeiZhu$now_id F_M_XS_1' ET='ET_ZD_BeiZhu'  xstypeid='1' name='ZD_BeiZhu' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['ZD_BeiZhu'])."</li>");

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
