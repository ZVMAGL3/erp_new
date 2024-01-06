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
	$databiao="SQP_JianLiZhongXin";
	$const_shaixuan="";
	$SYS_ALL_ziduan_list="id,sys_nowbh,ZD_XingBie,ZD_JiGuan,ZD_MinZu,ZD_ShenQingRiQi,ZD_ShenQingGangWei,ZD_QiWangXinZi,ZD_XueLi,ZD_XingMing,ZD_HunYin,ZD_ShenGao,ZD_TiZhong,ZD_WaiYuDengJi,ZD_XingQuAiHao,ZD_ShenFenZhengDiZhi,ZD_XianZhuDiZhi,ZD_ShenFenZhengHaoMa,ZD_LianXiDianHua,ZD_JinJiLianXiRenDianHua,ZD_XueXiJingLi,ZD_ZhuYaoGongZuoJingLi,ZD_JiaTingQingKuang,ZD_ZiWoPingJia,ZD_RenShiBuPingYu,ZD_BuMenJingLiPingYu,ZD_ZongJingLiPingYu,ZD_JieLun,ZD_RuZhiShiJian,ZD_ShiXiQiXin,ZD_ZhuanZhengHouXin,ZD_ZhuSuAnPai,ZD_BeiZhu";
	$xianshi_ZD_num="32";
	$xianshi_KD_num="2754";
	$shuoding_num="2";
	$maxrecord="20";
	$FormattingXianShi_idlist="1,11,2";
	$zu_all_list="286=已处理,287=试用,285=重要类别,";
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
   $Tablecol_list="sys_nowbh,id,ZD_XingBie,ZD_JiGuan,ZD_MinZu,ZD_ShenQingRiQi,ZD_ShenQingGangWei,ZD_QiWangXinZi,ZD_XueLi,sys_id_zu,ZD_XingMing,ZD_HunYin,ZD_ShenGao,ZD_TiZhong,ZD_WaiYuDengJi,ZD_XingQuAiHao,ZD_ShenFenZhengDiZhi,ZD_XianZhuDiZhi,ZD_ShenFenZhengHaoMa,ZD_LianXiDianHua,ZD_JinJiLianXiRenDianHua,ZD_XueXiJingLi,ZD_ZhuYaoGongZuoJingLi,ZD_JiaTingQingKuang,ZD_ZiWoPingJia,ZD_RenShiBuPingYu,ZD_BuMenJingLiPingYu,sys_yfzuid,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,ZD_ZongJingLiPingYu,ZD_JieLun,ZD_RuZhiShiJian,sys_id_bumen,sys_shenpi,sys_id_fz,sys_web_shenpi,sys_shenpi_all,sys_adddate_g,sys_login,sys_id_login,ZD_ShiXiQiXin,ZD_ZhuanZhengHouXin,ZD_ZhuSuAnPai,ZD_BeiZhu,sys_adddate,sys_chaosong,ZD_XiangPian,sys_paixu,sys_gx_id_198";

   $sql2 = "select (@rownum:=@rownum+1) as rownum,SQP_JianLiZhongXin.id  from `SQP_JianLiZhongXin`,(select @rownum:=0) as SQP_JianLiZhongXin where  sys_yfzuid='$hy' and sys_huis='$huis' "; //这里得到查询id清单的sql
   if($sys_guanxibiao_id != '' && $GuanXi_id != ""){$sql2 .=" and  sys_gx_id_{$sys_guanxibiao_id}='{$GuanXi_id}'";}
   $sql2 =sql_search($databiao,$sql2,$nowkeyword, 0);
   $sql2 .= " order by $px_ziduan $pxv"; //这里得到排序
   $sql2 = "select id from ($sql2) as t where rownum between $page_first and  $page_end ";
   $sql_all_id_list = sql_all_id_list($sql2,$Conn );

   if ( !$sql_all_id_list ) {
      echo( "<div class='nodata' tabindex='-1'><div class='nodata_center'><i class='fa fa-nodata' style='margin-top:-1px'></i>&nbsp; Sorry, No Data！</div></div>" );
   } else { 
      $sql = "select  id,sys_nowbh,ZD_XingBie,ZD_JiGuan,ZD_MinZu,ZD_ShenQingRiQi,ZD_ShenQingGangWei,ZD_QiWangXinZi,ZD_XueLi,ZD_XingMing,ZD_HunYin,ZD_ShenGao,ZD_TiZhong,ZD_WaiYuDengJi,ZD_XingQuAiHao,ZD_ShenFenZhengDiZhi,ZD_XianZhuDiZhi,ZD_ShenFenZhengHaoMa,ZD_LianXiDianHua,ZD_JinJiLianXiRenDianHua,ZD_XueXiJingLi,ZD_ZhuYaoGongZuoJingLi,ZD_JiaTingQingKuang,ZD_ZiWoPingJia,ZD_RenShiBuPingYu,ZD_BuMenJingLiPingYu,ZD_ZongJingLiPingYu,ZD_JieLun,ZD_RuZhiShiJian,ZD_ShiXiQiXin,ZD_ZhuanZhengHouXin,ZD_ZhuSuAnPai,ZD_BeiZhu  from `SQP_JianLiZhongXin` where id in($sql_all_id_list) and sys_yfzuid='$hy' and sys_huis='$huis'";
      $sql .= " order by $px_ziduan $pxv";
      $rs = mysqli_query( $Conn, $sql );
      echo( "<div id='para'  tabindex='-1' class='tables'  style='border:0;border-bottom:1px solid #CCC;min-width:100%;width: 2754px'>" );

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
			echo( "  style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;min-width:100%;width:2754px'> " );
			echo( "<li class='cols1 shuodingli'  title='$now_id'  style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;text-align:center;'></li>" );
	
	
              echo("<li id='c_tdtop1'  class='shuodingli   ET_sys_nowbh$now_id F_M_XS_1' ET='ET_sys_nowbh'  xstypeid='1' name='sys_nowbh' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_nowbh'])."</li>");
              echo("<li  class='shuodingli  border_shuoding  ET_ZD_XingMing$now_id F_M_XS_1' ET='ET_ZD_XingMing'  xstypeid='1' name='ZD_XingMing' style='height:28px;line-height:28px;width:60px;'>".DeleteHtml($row['ZD_XingMing'])."</li>");
              echo("<li class='contentli ET_ZD_XingBie$now_id F_M_XS_11' ET='ET_ZD_XingBie'  xstypeid='11' name='ZD_XingBie' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_XingBie'])."</li>");
              echo("<li class='contentli ET_ZD_JiGuan$now_id F_M_XS_1' ET='ET_ZD_JiGuan'  xstypeid='1' name='ZD_JiGuan' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_JiGuan'])."</li>");
              echo("<li class='contentli ET_ZD_MinZu$now_id F_M_XS_1' ET='ET_ZD_MinZu'  xstypeid='1' name='ZD_MinZu' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_MinZu'])."</li>");
              echo("<li class='contentli ET_ZD_ShenQingRiQi$now_id F_M_XS_1' ET='ET_ZD_ShenQingRiQi'  xstypeid='1' name='ZD_ShenQingRiQi' style='height:28px;line-height:28px;width:120px;'>".DeleteHtml($row['ZD_ShenQingRiQi'])."</li>");
              echo("<li class='contentli ET_ZD_ShenQingGangWei$now_id F_M_XS_1' ET='ET_ZD_ShenQingGangWei'  xstypeid='1' name='ZD_ShenQingGangWei' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZD_ShenQingGangWei'])."</li>");
              echo("<li class='contentli ET_ZD_QiWangXinZi$now_id F_M_XS_1' ET='ET_ZD_QiWangXinZi'  xstypeid='1' name='ZD_QiWangXinZi' style='height:28px;line-height:28px;width:60px;'>".DeleteHtml($row['ZD_QiWangXinZi'])."</li>");
              echo("<li class='contentli ET_ZD_XueLi$now_id F_M_XS_1' ET='ET_ZD_XueLi'  xstypeid='1' name='ZD_XueLi' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_XueLi'])."</li>");
              echo("<li class='contentli ET_ZD_HunYin$now_id F_M_XS_1' ET='ET_ZD_HunYin'  xstypeid='1' name='ZD_HunYin' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_HunYin'])."</li>");
              echo("<li class='contentli ET_ZD_ShenGao$now_id F_M_XS_1' ET='ET_ZD_ShenGao'  xstypeid='1' name='ZD_ShenGao' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_ShenGao'])."</li>");
              echo("<li class='contentli ET_ZD_TiZhong$now_id F_M_XS_1' ET='ET_ZD_TiZhong'  xstypeid='1' name='ZD_TiZhong' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_TiZhong'])."</li>");
              echo("<li class='contentli ET_ZD_WaiYuDengJi$now_id F_M_XS_1' ET='ET_ZD_WaiYuDengJi'  xstypeid='1' name='ZD_WaiYuDengJi' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_WaiYuDengJi'])."</li>");
              echo("<li class='contentli ET_ZD_XingQuAiHao$now_id F_M_XS_1' ET='ET_ZD_XingQuAiHao'  xstypeid='1' name='ZD_XingQuAiHao' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZD_XingQuAiHao'])."</li>");
              echo("<li class='contentli ET_ZD_ShenFenZhengDiZhi$now_id F_M_XS_1' ET='ET_ZD_ShenFenZhengDiZhi'  xstypeid='1' name='ZD_ShenFenZhengDiZhi' style='height:28px;line-height:28px;width:150px;'>".DeleteHtml($row['ZD_ShenFenZhengDiZhi'])."</li>");
              echo("<li class='contentli ET_ZD_XianZhuDiZhi$now_id F_M_XS_1' ET='ET_ZD_XianZhuDiZhi'  xstypeid='1' name='ZD_XianZhuDiZhi' style='height:28px;line-height:28px;width:150px;'>".DeleteHtml($row['ZD_XianZhuDiZhi'])."</li>");
              echo("<li class='contentli ET_ZD_ShenFenZhengHaoMa$now_id F_M_XS_1' ET='ET_ZD_ShenFenZhengHaoMa'  xstypeid='1' name='ZD_ShenFenZhengHaoMa' style='height:28px;line-height:28px;width:150px;'>".DeleteHtml($row['ZD_ShenFenZhengHaoMa'])."</li>");
              echo("<li class='contentli ET_ZD_LianXiDianHua$now_id F_M_XS_1' ET='ET_ZD_LianXiDianHua'  xstypeid='1' name='ZD_LianXiDianHua' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZD_LianXiDianHua'])."</li>");
              echo("<li class='contentli ET_ZD_JinJiLianXiRenDianHua$now_id F_M_XS_1' ET='ET_ZD_JinJiLianXiRenDianHua'  xstypeid='1' name='ZD_JinJiLianXiRenDianHua' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['ZD_JinJiLianXiRenDianHua'])."</li>");
              echo("<li class='contentli ET_ZD_XueXiJingLi$now_id F_M_XS_2' ET='ET_ZD_XueXiJingLi'  xstypeid='2' name='ZD_XueXiJingLi' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['ZD_XueXiJingLi'])."</li>");
              echo("<li class='contentli ET_ZD_ZhuYaoGongZuoJingLi$now_id F_M_XS_2' ET='ET_ZD_ZhuYaoGongZuoJingLi'  xstypeid='2' name='ZD_ZhuYaoGongZuoJingLi' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['ZD_ZhuYaoGongZuoJingLi'])."</li>");
              echo("<li class='contentli ET_ZD_JiaTingQingKuang$now_id F_M_XS_2' ET='ET_ZD_JiaTingQingKuang'  xstypeid='2' name='ZD_JiaTingQingKuang' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['ZD_JiaTingQingKuang'])."</li>");
              echo("<li class='contentli ET_ZD_ZiWoPingJia$now_id F_M_XS_1' ET='ET_ZD_ZiWoPingJia'  xstypeid='1' name='ZD_ZiWoPingJia' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['ZD_ZiWoPingJia'])."</li>");
              echo("<li class='contentli ET_ZD_RenShiBuPingYu$now_id F_M_XS_1' ET='ET_ZD_RenShiBuPingYu'  xstypeid='1' name='ZD_RenShiBuPingYu' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZD_RenShiBuPingYu'])."</li>");
              echo("<li class='contentli ET_ZD_BuMenJingLiPingYu$now_id F_M_XS_1' ET='ET_ZD_BuMenJingLiPingYu'  xstypeid='1' name='ZD_BuMenJingLiPingYu' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZD_BuMenJingLiPingYu'])."</li>");
              echo("<li class='contentli ET_ZD_ZongJingLiPingYu$now_id F_M_XS_1' ET='ET_ZD_ZongJingLiPingYu'  xstypeid='1' name='ZD_ZongJingLiPingYu' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['ZD_ZongJingLiPingYu'])."</li>");
              echo("<li class='contentli ET_ZD_JieLun$now_id F_M_XS_1' ET='ET_ZD_JieLun'  xstypeid='1' name='ZD_JieLun' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_JieLun'])."</li>");
              echo("<li class='contentli ET_ZD_RuZhiShiJian$now_id F_M_XS_1' ET='ET_ZD_RuZhiShiJian'  xstypeid='1' name='ZD_RuZhiShiJian' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_RuZhiShiJian'])."</li>");
              echo("<li class='contentli ET_ZD_ShiXiQiXin$now_id F_M_XS_1' ET='ET_ZD_ShiXiQiXin'  xstypeid='1' name='ZD_ShiXiQiXin' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_ShiXiQiXin'])."</li>");
              echo("<li class='contentli ET_ZD_ZhuanZhengHouXin$now_id F_M_XS_1' ET='ET_ZD_ZhuanZhengHouXin'  xstypeid='1' name='ZD_ZhuanZhengHouXin' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_ZhuanZhengHouXin'])."</li>");
              echo("<li class='contentli ET_ZD_ZhuSuAnPai$now_id F_M_XS_1' ET='ET_ZD_ZhuSuAnPai'  xstypeid='1' name='ZD_ZhuSuAnPai' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ZD_ZhuSuAnPai'])."</li>");
              echo("<li class='contentli ET_ZD_BeiZhu$now_id F_M_XS_1' ET='ET_ZD_BeiZhu'  xstypeid='1' name='ZD_BeiZhu' style='height:28px;line-height:28px;width:54px;'>".DeleteHtml($row['ZD_BeiZhu'])."</li>");

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
