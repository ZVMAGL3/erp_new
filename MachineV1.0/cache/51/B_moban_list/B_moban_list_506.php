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
	$databiao="sys_GongZiBiao";
	$const_shaixuan="";
	$SYS_ALL_ziduan_list="id,sys_nowbh,ZD_XingMing,bumen_id,ZD_JiBenGongZi,ZD_ZhiWuGongZi,ZD_NianDuJiaXin,ZD_ChuQinTianShu,ZD_GeRenSheBaoKouChu,ZD_JiaBanGongZi,ZD_ChuChaBuTie,ZD_XiangMuTiCheng,ZD_YeWuTiCheng,ZD_QingJiaTianShu,ZD_QingJiaKouChu,ZD_QuanQinJiang,ZD_GongSiSheBaoZhiChu,ZD_JiaBanFei,ZD_HuoShiBuTie,ZD_QiYouBuTie,ZD_DangYueShiFa,ZD_BeiZhu,ZD_SuoShuNianFen,ZD_SuoShuYueFen,sys_id_login,sys_shenpi_all";
	$xianshi_ZD_num="23";
	$xianshi_KD_num="2438";
	$shuoding_num="5";
	$maxrecord="50";
	$FormattingXianShi_idlist="1,2";
	$zu_all_list="451=10月,452=11月,453=12月,442=1月,443=2月,444=3月,445=4月,446=5月,447=6月,448=7月,449=8月,450=9月,";
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
   $Tablecol_list="id,sys_id_login,sys_login,sys_id_fz,sys_yfzuid,sys_bh,sys_zt,sys_zt_bianhao,sys_nowbh,ZD_XingMing,sys_id_zu,sys_huis,bumen_id,sys_shenpi,sys_web_shenpi,sys_adddate,sys_adddate_g,sys_shenpi_all,ZD_JiBenGongZi,ZD_ZhiWuGongZi,ZD_NianDuJiaXin,ZD_ChuQinTianShu,ZD_GeRenSheBaoKouChu,ZD_JiaBanGongZi,ZD_ChuChaBuTie,ZD_XiangMuTiCheng,ZD_YeWuTiCheng,ZD_QingJiaTianShu,ZD_QingJiaKouChu,ZD_QuanQinJiang,sys_gx_id_204,sys_chaosong,sys_paixu,ZD_GongSiSheBaoZhiChu,ZD_JiaBanFei,ZD_HuoShiBuTie,ZD_QiYouBuTie,ZD_DangYueShiFa,ZD_BeiZhu,ZD_JiFen,ZD_SuoShuNianFen,ZD_SuoShuYueFen";

   $sql2 = "select (@rownum:=@rownum+1) as rownum,sys_GongZiBiao.id  from `sys_GongZiBiao`,(select @rownum:=0) as sys_GongZiBiao where  sys_yfzuid='$hy' and sys_huis='$huis' "; //这里得到查询id清单的sql
   if($sys_guanxibiao_id != '' && $GuanXi_id != ""){$sql2 .=" and  sys_gx_id_{$sys_guanxibiao_id}='{$GuanXi_id}'";}
   $sql2 =sql_search($databiao,$sql2,$nowkeyword, 0);
   $sql2 .= " order by $px_ziduan $pxv"; //这里得到排序
   $sql2 = "select id from ($sql2) as t where rownum between $page_first and  $page_end ";
   $sql_all_id_list = sql_all_id_list($sql2,$Conn );

   if ( !$sql_all_id_list ) {
      echo( "<div class='nodata' tabindex='-1'><div class='nodata_center'><i class='fa fa-nodata' style='margin-top:-1px'></i>&nbsp; Sorry, No Data！</div></div>" );
   } else { 
      $sql = "select  id,sys_nowbh,ZD_XingMing,bumen_id,ZD_JiBenGongZi,ZD_ZhiWuGongZi,ZD_NianDuJiaXin,ZD_ChuQinTianShu,ZD_GeRenSheBaoKouChu,ZD_JiaBanGongZi,ZD_ChuChaBuTie,ZD_XiangMuTiCheng,ZD_YeWuTiCheng,ZD_QingJiaTianShu,ZD_QingJiaKouChu,ZD_QuanQinJiang,ZD_GongSiSheBaoZhiChu,ZD_JiaBanFei,ZD_HuoShiBuTie,ZD_QiYouBuTie,ZD_DangYueShiFa,ZD_BeiZhu,ZD_SuoShuNianFen,ZD_SuoShuYueFen,sys_id_login,sys_shenpi_all  from `sys_GongZiBiao` where id in($sql_all_id_list) and sys_yfzuid='$hy' and sys_huis='$huis'";
      $sql .= " order by $px_ziduan $pxv";
      $rs = mysqli_query( $Conn, $sql );
      echo( "<div id='para'  tabindex='-1' class='tables'  style='border:0;border-bottom:1px solid #CCC;min-width:100%;width: 2438px'>" );

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
			echo( "  style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;min-width:100%;width:2438px'> " );
			echo( "<li class='cols1 shuodingli'  title='$now_id'  style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;text-align:center;'></li>" );
	
	
              echo("<li id='c_tdtop1'  class='shuodingli   ET_sys_nowbh$now_id F_M_XS_1' ET='ET_sys_nowbh'  xstypeid='1' name='sys_nowbh' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_nowbh'])."</li>");
              echo("<li  class='shuodingli   ET_ZD_XingMing$now_id F_M_XS_1' ET='ET_ZD_XingMing'  xstypeid='1' name='ZD_XingMing' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_XingMing'])."</li>");
              echo("<li  class='shuodingli   ET_bumen_id$now_id F_M_XS_1' ET='ET_bumen_id'  xstypeid='1' name='bumen_id' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['bumen_id'])."</li>");
              echo("<li  class='shuodingli   ET_ZD_SuoShuNianFen$now_id F_M_XS_1' ET='ET_ZD_SuoShuNianFen'  xstypeid='1' name='ZD_SuoShuNianFen' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZD_SuoShuNianFen'])."</li>");
              echo("<li  class='shuodingli  border_shuoding  ET_ZD_SuoShuYueFen$now_id F_M_XS_1' ET='ET_ZD_SuoShuYueFen'  xstypeid='1' name='ZD_SuoShuYueFen' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZD_SuoShuYueFen'])."</li>");
              echo("<li  class='contentli ET_ZD_JiBenGongZi$now_id F_M_XS_1' ET='ET_ZD_JiBenGongZi'  xstypeid='1' name='ZD_JiBenGongZi' style='height:28px;line-height:28px;width:70px;'>".DeleteHtml($row['ZD_JiBenGongZi'])."</li>");
              echo("<li  class='contentli ET_ZD_ZhiWuGongZi$now_id F_M_XS_1' ET='ET_ZD_ZhiWuGongZi'  xstypeid='1' name='ZD_ZhiWuGongZi' style='height:28px;line-height:28px;width:70px;'>".DeleteHtml($row['ZD_ZhiWuGongZi'])."</li>");
              echo("<li  class='contentli ET_ZD_NianDuJiaXin$now_id F_M_XS_1' ET='ET_ZD_NianDuJiaXin'  xstypeid='1' name='ZD_NianDuJiaXin' style='height:28px;line-height:28px;width:70px;'>".DeleteHtml($row['ZD_NianDuJiaXin'])."</li>");
              echo("<li  class='contentli ET_ZD_ChuQinTianShu$now_id F_M_XS_1' ET='ET_ZD_ChuQinTianShu'  xstypeid='1' name='ZD_ChuQinTianShu' style='height:28px;line-height:28px;width:70px;'>".DeleteHtml($row['ZD_ChuQinTianShu'])."</li>");
              echo("<li  class='contentli ET_ZD_GeRenSheBaoKouChu$now_id F_M_XS_1' ET='ET_ZD_GeRenSheBaoKouChu'  xstypeid='1' name='ZD_GeRenSheBaoKouChu' style='height:28px;line-height:28px;width:70px;'>".DeleteHtml($row['ZD_GeRenSheBaoKouChu'])."</li>");
              echo("<li  class='contentli ET_ZD_JiaBanGongZi$now_id F_M_XS_1' ET='ET_ZD_JiaBanGongZi'  xstypeid='1' name='ZD_JiaBanGongZi' style='height:28px;line-height:28px;width:70px;'>".DeleteHtml($row['ZD_JiaBanGongZi'])."</li>");
              echo("<li  class='contentli ET_ZD_ChuChaBuTie$now_id F_M_XS_1' ET='ET_ZD_ChuChaBuTie'  xstypeid='1' name='ZD_ChuChaBuTie' style='height:28px;line-height:28px;width:70px;'>".DeleteHtml($row['ZD_ChuChaBuTie'])."</li>");
              echo("<li  class='contentli ET_ZD_XiangMuTiCheng$now_id F_M_XS_1' ET='ET_ZD_XiangMuTiCheng'  xstypeid='1' name='ZD_XiangMuTiCheng' style='height:28px;line-height:28px;width:74px;'>".DeleteHtml($row['ZD_XiangMuTiCheng'])."</li>");
              echo("<li  class='contentli ET_ZD_YeWuTiCheng$now_id F_M_XS_1' ET='ET_ZD_YeWuTiCheng'  xstypeid='1' name='ZD_YeWuTiCheng' style='height:28px;line-height:28px;width:70px;'>".DeleteHtml($row['ZD_YeWuTiCheng'])."</li>");
              echo("<li  class='contentli ET_ZD_QingJiaTianShu$now_id F_M_XS_1' ET='ET_ZD_QingJiaTianShu'  xstypeid='1' name='ZD_QingJiaTianShu' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZD_QingJiaTianShu'])."</li>");
              echo("<li  class='contentli ET_ZD_QingJiaKouChu$now_id F_M_XS_1' ET='ET_ZD_QingJiaKouChu'  xstypeid='1' name='ZD_QingJiaKouChu' style='height:28px;line-height:28px;width:70px;'>".DeleteHtml($row['ZD_QingJiaKouChu'])."</li>");
              echo("<li  class='contentli ET_ZD_QuanQinJiang$now_id F_M_XS_1' ET='ET_ZD_QuanQinJiang'  xstypeid='1' name='ZD_QuanQinJiang' style='height:28px;line-height:28px;width:70px;'>".DeleteHtml($row['ZD_QuanQinJiang'])."</li>");
              echo("<li  class='contentli ET_ZD_GongSiSheBaoZhiChu$now_id F_M_XS_1' ET='ET_ZD_GongSiSheBaoZhiChu'  xstypeid='1' name='ZD_GongSiSheBaoZhiChu' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZD_GongSiSheBaoZhiChu'])."</li>");
              echo("<li  class='contentli ET_ZD_JiaBanFei$now_id F_M_XS_1' ET='ET_ZD_JiaBanFei'  xstypeid='1' name='ZD_JiaBanFei' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZD_JiaBanFei'])."</li>");
              echo("<li  class='contentli ET_ZD_HuoShiBuTie$now_id F_M_XS_1' ET='ET_ZD_HuoShiBuTie'  xstypeid='1' name='ZD_HuoShiBuTie' style='height:28px;line-height:28px;width:84px;'>".DeleteHtml($row['ZD_HuoShiBuTie'])."</li>");
              echo("<li  class='contentli ET_ZD_QiYouBuTie$now_id F_M_XS_1' ET='ET_ZD_QiYouBuTie'  xstypeid='1' name='ZD_QiYouBuTie' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZD_QiYouBuTie'])."</li>");
              echo("<li  class='contentli ET_ZD_DangYueShiFa$now_id F_M_XS_1' ET='ET_ZD_DangYueShiFa'  xstypeid='1' name='ZD_DangYueShiFa' style='height:28px;line-height:28px;width:70px;'>".DeleteHtml($row['ZD_DangYueShiFa'])."</li>");
              echo("<li  class='contentli ET_ZD_BeiZhu$now_id F_M_XS_2' ET='ET_ZD_BeiZhu'  xstypeid='2' name='ZD_BeiZhu' style='height:28px;line-height:28px;width:500px;'>".DeleteHtml($row['ZD_BeiZhu'])."</li>");

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
