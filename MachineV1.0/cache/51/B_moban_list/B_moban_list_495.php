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
	$databiao="SQP_FuWuLiuChengDan";
	$const_shaixuan="";
	$SYS_ALL_ziduan_list="id,sys_nowbh,sys_gx_id_321,ZD_GongSiMingChen,sys_gx_id_423,RenZhengXinXi,sys_id_zu,XiangMuQianShou,ZD_RuChang,ZD_ShenQing,ZD_ZiLiao,ZD_JiLiangJianDing,ZD_TeZhongJianDing,ZD_YanShou,ZD_ShenHe,ZD_ZhengGai,ZD_JiaoJie,ZD_TiChengJieSuan,ZD_RenShuChanPin,LianXiRen,DianHua,ZhiDaoXingShi,ZD_ShenHeYuan,ShenHeShiJian,JiaoTongJieDai,ZiXunFeiYong,QiTaYaoQiu,ZD_ZiLiaoFuZeRen,ZD_ZiLiaoZhuDao,ZD_JiLiangQiJu,ZD_PeiShenYanChang,ZD_PeiXun,ZD_HeJiTiCheng,ZD_ShenHeTianShu,ZD_JiaoQi,ZD_HongLiuFeng,ZD_WanGongDan,ZD_HeZuoWeiJieSuan";
	$xianshi_ZD_num="37";
	$xianshi_KD_num="3611";
	$shuoding_num="9";
	$maxrecord="50";
	$FormattingXianShi_idlist="1,15,21,18,8,6";
	$zu_all_list="401=初审,403=复评,402=监审,";
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
   $Tablecol_list="sys_nowbh,sys_gx_id_321,ZD_GongSiMingChen,sys_gx_id_423,RenZhengXinXi,id,sys_id_login,sys_login,sys_id_zu,XiangMuQianShou,sys_id_fz,sys_yfzuid,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_bumen,sys_shenpi,sys_web_shenpi,sys_shenpi_all,ZD_RuChang,ZD_ShenQing,ZD_ZiLiao,ZD_JiLiangJianDing,ZD_TeZhongJianDing,ZD_YanShou,ZD_ShenHe,ZD_ZhengGai,ZD_JiaoJie,ZD_TiChengJieSuan,ZD_RenShuChanPin,LianXiRen,DianHua,ZhiDaoXingShi,ZD_ShenHeYuan,ShenHeShiJian,JiaoTongJieDai,ZiXunFeiYong,QiTaYaoQiu,ZD_ZiLiaoFuZeRen,ZD_ZiLiaoZhuDao,ZD_JiLiangQiJu,ZD_PeiShenYanChang,ZD_PeiXun,ZD_HeJiTiCheng,sys_adddate,sys_adddate_g,ZD_ShenHeTianShu,ZD_JiaoQi,sys_chaosong,sys_gx_id_510,sys_count_264,ZD_GuKeDangAnBiaoID,ZD_HongLiuFeng,ZD_WanGongDan,sys_paixu,ZD_HeZuoWeiJieSuan,sys_gx_id_529";

   $sql2 = "select (@rownum:=@rownum+1) as rownum,SQP_FuWuLiuChengDan.id  from `SQP_FuWuLiuChengDan`,(select @rownum:=0) as SQP_FuWuLiuChengDan where  sys_yfzuid='$hy' and sys_huis='$huis' "; //这里得到查询id清单的sql
   if($sys_guanxibiao_id != '' && $GuanXi_id != ""){$sql2 .=" and  sys_gx_id_{$sys_guanxibiao_id}='{$GuanXi_id}'";}
   $sql2 =sql_search($databiao,$sql2,$nowkeyword, 0);
   $sql2 .= " order by $px_ziduan $pxv"; //这里得到排序
   $sql2 = "select id from ($sql2) as t where rownum between $page_first and  $page_end ";
   $sql_all_id_list = sql_all_id_list($sql2,$Conn );

   if ( !$sql_all_id_list ) {
      echo( "<div class='nodata' tabindex='-1'><div class='nodata_center'><i class='fa fa-nodata' style='margin-top:-1px'></i>&nbsp; Sorry, No Data！</div></div>" );
   } else { 
      $sql = "select  id,sys_nowbh,sys_gx_id_321,ZD_GongSiMingChen,sys_gx_id_423,RenZhengXinXi,sys_id_zu,XiangMuQianShou,ZD_RuChang,ZD_ShenQing,ZD_ZiLiao,ZD_JiLiangJianDing,ZD_TeZhongJianDing,ZD_YanShou,ZD_ShenHe,ZD_ZhengGai,ZD_JiaoJie,ZD_TiChengJieSuan,ZD_RenShuChanPin,LianXiRen,DianHua,ZhiDaoXingShi,ZD_ShenHeYuan,ShenHeShiJian,JiaoTongJieDai,ZiXunFeiYong,QiTaYaoQiu,ZD_ZiLiaoFuZeRen,ZD_ZiLiaoZhuDao,ZD_JiLiangQiJu,ZD_PeiShenYanChang,ZD_PeiXun,ZD_HeJiTiCheng,ZD_ShenHeTianShu,ZD_JiaoQi,ZD_HongLiuFeng,ZD_WanGongDan,ZD_HeZuoWeiJieSuan  from `SQP_FuWuLiuChengDan` where id in($sql_all_id_list) and sys_yfzuid='$hy' and sys_huis='$huis'";
      $sql .= " order by $px_ziduan $pxv";
      $rs = mysqli_query( $Conn, $sql );
      echo( "<div id='para'  tabindex='-1' class='tables'  style='border:0;border-bottom:1px solid #CCC;min-width:100%;width:3611'>" );

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
              echo("<li  class='shuodingli   ET_sys_gx_id_321$now_id F_M_XS_1' ET='ET_sys_gx_id_321'  xstypeid='1' name='sys_gx_id_321' style='height:28px;line-height:28px;width:120px;'>".DeleteHtml($row['sys_gx_id_321'])."</li>");
              echo("<li  class='shuodingli   ET_ZD_GongSiMingChen$now_id F_M_XS_1' ET='ET_ZD_GongSiMingChen'  xstypeid='1' name='ZD_GongSiMingChen' style='height:28px;line-height:28px;width:179px;'>".DeleteHtml($row['ZD_GongSiMingChen'])."</li>");
              echo("<li  class='shuodingli   ET_sys_gx_id_423$now_id F_M_XS_1' ET='ET_sys_gx_id_423'  xstypeid='1' name='sys_gx_id_423' style='height:28px;line-height:28px;width:120px;'>".DeleteHtml($row['sys_gx_id_423'])."</li>");
              echo("<li  class='shuodingli   ET_RenZhengXinXi$now_id F_M_XS_1' ET='ET_RenZhengXinXi'  xstypeid='1' name='RenZhengXinXi' style='height:28px;line-height:28px;width:231px;'>".DeleteHtml($row['RenZhengXinXi'])."</li>");
              echo("<li  class='shuodingli   ET_XiangMuQianShou$now_id F_M_XS_21' ET='ET_XiangMuQianShou'  xstypeid='21' name='XiangMuQianShou' style='height:28px;line-height:28px;width:304px;'>".DeleteHtml($row['XiangMuQianShou'])."</li>");
              echo("<li  class='shuodingli   ET_ZD_ShenHeTianShu$now_id F_M_XS_1' ET='ET_ZD_ShenHeTianShu'  xstypeid='1' name='ZD_ShenHeTianShu' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_ShenHeTianShu'])."</li>");
              echo("<li  class='shuodingli   ET_ZD_JiaoQi$now_id F_M_XS_8' ET='ET_ZD_JiaoQi'  xstypeid='8' name='ZD_JiaoQi' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['ZD_JiaoQi'])."</li>");
              echo("<li  class='shuodingli  border_shuoding  ET_ZD_HeZuoWeiJieSuan$now_id F_M_XS_21' ET='ET_ZD_HeZuoWeiJieSuan'  xstypeid='21' name='ZD_HeZuoWeiJieSuan' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZD_HeZuoWeiJieSuan'])."</li>");
              echo("<li class='contentli ET_sys_id_zu$now_id F_M_XS_15' ET='ET_sys_id_zu'  xstypeid='15' name='sys_id_zu' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['sys_id_zu'])."</li>");
              echo("<li class='contentli ET_ZD_RuChang$now_id F_M_XS_18' ET='ET_ZD_RuChang'  xstypeid='18' name='ZD_RuChang' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_RuChang'])."</li>");
              echo("<li class='contentli ET_ZD_ShenQing$now_id F_M_XS_18' ET='ET_ZD_ShenQing'  xstypeid='18' name='ZD_ShenQing' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_ShenQing'])."</li>");
              echo("<li class='contentli ET_ZD_ZiLiao$now_id F_M_XS_18' ET='ET_ZD_ZiLiao'  xstypeid='18' name='ZD_ZiLiao' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_ZiLiao'])."</li>");
              echo("<li class='contentli ET_ZD_JiLiangJianDing$now_id F_M_XS_18' ET='ET_ZD_JiLiangJianDing'  xstypeid='18' name='ZD_JiLiangJianDing' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_JiLiangJianDing'])."</li>");
              echo("<li class='contentli ET_ZD_TeZhongJianDing$now_id F_M_XS_18' ET='ET_ZD_TeZhongJianDing'  xstypeid='18' name='ZD_TeZhongJianDing' style='height:28px;line-height:28px;width:82px;'>".DeleteHtml($row['ZD_TeZhongJianDing'])."</li>");
              echo("<li class='contentli ET_ZD_YanShou$now_id F_M_XS_18' ET='ET_ZD_YanShou'  xstypeid='18' name='ZD_YanShou' style='height:28px;line-height:28px;width:62px;'>".DeleteHtml($row['ZD_YanShou'])."</li>");
              echo("<li class='contentli ET_ZD_ShenHe$now_id F_M_XS_18' ET='ET_ZD_ShenHe'  xstypeid='18' name='ZD_ShenHe' style='height:28px;line-height:28px;width:62px;'>".DeleteHtml($row['ZD_ShenHe'])."</li>");
              echo("<li class='contentli ET_ZD_ZhengGai$now_id F_M_XS_18' ET='ET_ZD_ZhengGai'  xstypeid='18' name='ZD_ZhengGai' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_ZhengGai'])."</li>");
              echo("<li class='contentli ET_ZD_JiaoJie$now_id F_M_XS_18' ET='ET_ZD_JiaoJie'  xstypeid='18' name='ZD_JiaoJie' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_JiaoJie'])."</li>");
              echo("<li class='contentli ET_ZD_TiChengJieSuan$now_id F_M_XS_18' ET='ET_ZD_TiChengJieSuan'  xstypeid='18' name='ZD_TiChengJieSuan' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_TiChengJieSuan'])."</li>");
              echo("<li class='contentli ET_ZD_RenShuChanPin$now_id F_M_XS_1' ET='ET_ZD_RenShuChanPin'  xstypeid='1' name='ZD_RenShuChanPin' style='height:28px;line-height:28px;width:84px;'>".DeleteHtml($row['ZD_RenShuChanPin'])."</li>");
              echo("<li class='contentli ET_LianXiRen$now_id F_M_XS_1' ET='ET_LianXiRen'  xstypeid='1' name='LianXiRen' style='height:28px;line-height:28px;width:85px;'>".DeleteHtml($row['LianXiRen'])."</li>");
              echo("<li class='contentli ET_DianHua$now_id F_M_XS_1' ET='ET_DianHua'  xstypeid='1' name='DianHua' style='height:28px;line-height:28px;width:127px;'>".DeleteHtml($row['DianHua'])."</li>");
              echo("<li class='contentli ET_ZhiDaoXingShi$now_id F_M_XS_1' ET='ET_ZhiDaoXingShi'  xstypeid='1' name='ZhiDaoXingShi' style='height:28px;line-height:28px;width:96px;'>".DeleteHtml($row['ZhiDaoXingShi'])."</li>");
              echo("<li class='contentli ET_ZD_ShenHeYuan$now_id F_M_XS_1' ET='ET_ZD_ShenHeYuan'  xstypeid='1' name='ZD_ShenHeYuan' style='height:28px;line-height:28px;width:112px;'>".DeleteHtml($row['ZD_ShenHeYuan'])."</li>");
              echo("<li class='contentli ET_ShenHeShiJian$now_id F_M_XS_1' ET='ET_ShenHeShiJian'  xstypeid='1' name='ShenHeShiJian' style='height:28px;line-height:28px;width:110px;'>".DeleteHtml($row['ShenHeShiJian'])."</li>");
              echo("<li class='contentli ET_JiaoTongJieDai$now_id F_M_XS_1' ET='ET_JiaoTongJieDai'  xstypeid='1' name='JiaoTongJieDai' style='height:28px;line-height:28px;width:130px;'>".DeleteHtml($row['JiaoTongJieDai'])."</li>");
              echo("<li class='contentli ET_ZiXunFeiYong$now_id F_M_XS_1' ET='ET_ZiXunFeiYong'  xstypeid='1' name='ZiXunFeiYong' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZiXunFeiYong'])."</li>");
              echo("<li class='contentli ET_QiTaYaoQiu$now_id F_M_XS_1' ET='ET_QiTaYaoQiu'  xstypeid='1' name='QiTaYaoQiu' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['QiTaYaoQiu'])."</li>");
              echo("<li class='contentli ET_ZD_ZiLiaoFuZeRen$now_id F_M_XS_1' ET='ET_ZD_ZiLiaoFuZeRen'  xstypeid='1' name='ZD_ZiLiaoFuZeRen' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['ZD_ZiLiaoFuZeRen'])."</li>");
              echo("<li class='contentli ET_ZD_ZiLiaoZhuDao$now_id F_M_XS_1' ET='ET_ZD_ZiLiaoZhuDao'  xstypeid='1' name='ZD_ZiLiaoZhuDao' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['ZD_ZiLiaoZhuDao'])."</li>");
              echo("<li class='contentli ET_ZD_JiLiangQiJu$now_id F_M_XS_1' ET='ET_ZD_JiLiangQiJu'  xstypeid='1' name='ZD_JiLiangQiJu' style='height:28px;line-height:28px;width:70px;'>".DeleteHtml($row['ZD_JiLiangQiJu'])."</li>");
              echo("<li class='contentli ET_ZD_PeiShenYanChang$now_id F_M_XS_1' ET='ET_ZD_PeiShenYanChang'  xstypeid='1' name='ZD_PeiShenYanChang' style='height:28px;line-height:28px;width:70px;'>".DeleteHtml($row['ZD_PeiShenYanChang'])."</li>");
              echo("<li class='contentli ET_ZD_PeiXun$now_id F_M_XS_1' ET='ET_ZD_PeiXun'  xstypeid='1' name='ZD_PeiXun' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_PeiXun'])."</li>");
              echo("<li class='contentli ET_ZD_HeJiTiCheng$now_id F_M_XS_1' ET='ET_ZD_HeJiTiCheng'  xstypeid='1' name='ZD_HeJiTiCheng' style='height:28px;line-height:28px;width:70px;'>".DeleteHtml($row['ZD_HeJiTiCheng'])."</li>");
              echo("<li class='contentli ET_ZD_HongLiuFeng$now_id F_M_XS_21' ET='ET_ZD_HongLiuFeng'  xstypeid='21' name='ZD_HongLiuFeng' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_HongLiuFeng'])."</li>");
              echo("<li class='contentli ET_ZD_WanGongDan$now_id F_M_XS_6' ET='ET_ZD_WanGongDan'  xstypeid='6' name='ZD_WanGongDan' style='height:28px;line-height:28px;width:84px;'>".DeleteHtml($row['ZD_WanGongDan'])."</li>");

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
