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
	$r_cow_height="25";
	$databiao="SQP_CCCFeiYongChaXun";
	$const_shaixuan="";
	$SYS_ALL_ziduan_list="id,sys_id_zu,sys_nowbh,ZD_ChanPinMingChen,ZD_DuiYingXiangGuanChanPinMingChen,ZD_ZhiXingBiaoZhun,ZD_ShiShiXiZe,ZD_QuanXiangJianCeFei,ZD_ZiXunFei,ZD_JianCeTiaoMu";
	$xianshi_ZD_num="9";
	$xianshi_KD_num="1591";
	$shuoding_num="3";
	$maxrecord="50";
	$FormattingXianShi_idlist="15,1,6";
	$zu_all_list="504=一、电线组件,510=七、热熔断器,506=三、家用及类似用途插头插座,512=九、小型熔断器的管状熔断体,505=二、电线电缆产品,523=二十、轮胎产品,524=二十一、安全玻璃,530=二十七、安全技术防范产品,526=二十三、橡胶避孕套产品,532=二十九、装饰装修产品,525=二十二、植物保护机械,528=二十五、医疗器材产品,531=二十八、汽车安全带产品,529=二十六、消防产品,527=二十四、电信终端设备,508=五、工业用插头插座和耦合器,511=八、家用及类似用途固定式电器装置电器附件外壳,509=六、家用及类似用途的器具耦合器,513=十、低压器具,514=十一、小功率电动机,520=十七、照明电器,516=十三、电焊机,522=十九、摩托车及摩托车发动机,515=十二、电动工具,518=十五、音视频设备,521=十八、汽车产品,519=十六、信息技术设备,517=十四、家用和类似用途设备,507=四、家用及类似用途固定式电器装置的开关,";
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
   $Tablecol_list="id,sys_id_zu,sys_id_fz,sys_yfzuid,sys_bh,sys_zt,sys_zt_bianhao,sys_nowbh,sys_huis,sys_id_bumen,sys_web_shenpi,sys_adddate,sys_adddate_g,sys_id_login,sys_login,sys_shenpi,sys_shenpi_all,sys_chaosong,ZD_ChanPinMingChen,ZD_DuiYingXiangGuanChanPinMingChen,ZD_ZhiXingBiaoZhun,ZD_ShiShiXiZe,ZD_QuanXiangJianCeFei,ZD_ZiXunFei,ZD_JianCeTiaoMu,sys_paixu,ZD_ChanPinQingDan,sys_gx_id_198";

   $sql2 = "select (@rownum:=@rownum+1) as rownum,SQP_CCCFeiYongChaXun.id  from `SQP_CCCFeiYongChaXun`,(select @rownum:=0) as SQP_CCCFeiYongChaXun where  sys_yfzuid='$hy' and sys_huis='$huis' "; //这里得到查询id清单的sql
   if($sys_guanxibiao_id != '' && $GuanXi_id != ""){$sql2 .=" and  sys_gx_id_{$sys_guanxibiao_id}='{$GuanXi_id}'";}
   $sql2 =sql_search($databiao,$sql2,$nowkeyword, 0);
   $sql2 .= " order by $px_ziduan $pxv"; //这里得到排序
   $sql2 = "select id from ($sql2) as t where rownum between $page_first and  $page_end ";
   $sql_all_id_list = sql_all_id_list($sql2,$Conn );

   if ( !$sql_all_id_list ) {
      echo( "<div class='nodata' tabindex='-1'><div class='nodata_center'><i class='fa fa-nodata' style='margin-top:-1px'></i>&nbsp; Sorry, No Data！</div></div>" );
   } else { 
      $sql = "select  id,sys_id_zu,sys_nowbh,ZD_ChanPinMingChen,ZD_DuiYingXiangGuanChanPinMingChen,ZD_ZhiXingBiaoZhun,ZD_ShiShiXiZe,ZD_QuanXiangJianCeFei,ZD_ZiXunFei,ZD_JianCeTiaoMu  from `SQP_CCCFeiYongChaXun` where id in($sql_all_id_list) and sys_yfzuid='$hy' and sys_huis='$huis'";
      $sql .= " order by $px_ziduan $pxv";
      $rs = mysqli_query( $Conn, $sql );
      echo( "<div id='para'  tabindex='-1' class='tables'  style='border:0;border-bottom:1px solid #CCC;min-width:100%;width: 1591px'>" );

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
			echo( "  style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;min-width:100%;width:1591px'> " );
			echo( "<li class='cols1 shuodingli'  title='$now_id'  style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;text-align:center;'></li>" );
	
	
              echo("<li id='c_tdtop1'  class='shuodingli   ET_sys_nowbh$now_id F_M_XS_1' ET='ET_sys_nowbh'  xstypeid='1' name='sys_nowbh' style='height:25px;line-height:25px;width:80px;'>".DeleteHtml($row['sys_nowbh'])."</li>");
              echo("<li  class='shuodingli   ET_ZD_ChanPinMingChen$now_id F_M_XS_1' ET='ET_ZD_ChanPinMingChen'  xstypeid='1' name='ZD_ChanPinMingChen' style='height:25px;line-height:25px;width:300px;'>".DeleteHtml($row['ZD_ChanPinMingChen'])."</li>");
              echo("<li  class='shuodingli  border_shuoding  ET_ZD_DuiYingXiangGuanChanPinMingChen$now_id F_M_XS_1' ET='ET_ZD_DuiYingXiangGuanChanPinMingChen'  xstypeid='1' name='ZD_DuiYingXiangGuanChanPinMingChen' style='height:25px;line-height:25px;width:200px;'>".DeleteHtml($row['ZD_DuiYingXiangGuanChanPinMingChen'])."</li>");
              echo("<li class='contentli ET_sys_id_zu$now_id F_M_XS_15' ET='ET_sys_id_zu'  xstypeid='15' name='sys_id_zu' style='height:25px;line-height:25px;width:300px;'>".DeleteHtml($row['sys_id_zu'])."</li>");
              echo("<li class='contentli ET_ZD_ZhiXingBiaoZhun$now_id F_M_XS_1' ET='ET_ZD_ZhiXingBiaoZhun'  xstypeid='1' name='ZD_ZhiXingBiaoZhun' style='height:25px;line-height:25px;width:120px;'>".DeleteHtml($row['ZD_ZhiXingBiaoZhun'])."</li>");
              echo("<li class='contentli ET_ZD_ShiShiXiZe$now_id F_M_XS_6' ET='ET_ZD_ShiShiXiZe'  xstypeid='6' name='ZD_ShiShiXiZe' style='height:25px;line-height:25px;width:120px;'>".DeleteHtml($row['ZD_ShiShiXiZe'])."</li>");
              echo("<li class='contentli ET_ZD_QuanXiangJianCeFei$now_id F_M_XS_1' ET='ET_ZD_QuanXiangJianCeFei'  xstypeid='1' name='ZD_QuanXiangJianCeFei' style='height:25px;line-height:25px;width:100px;'>".DeleteHtml($row['ZD_QuanXiangJianCeFei'])."</li>");
              echo("<li class='contentli ET_ZD_ZiXunFei$now_id F_M_XS_1' ET='ET_ZD_ZiXunFei'  xstypeid='1' name='ZD_ZiXunFei' style='height:25px;line-height:25px;width:80px;'>".DeleteHtml($row['ZD_ZiXunFei'])."</li>");
              echo("<li class='contentli ET_ZD_JianCeTiaoMu$now_id F_M_XS_6' ET='ET_ZD_JianCeTiaoMu'  xstypeid='6' name='ZD_JianCeTiaoMu' style='height:25px;line-height:25px;width:180px;'>".DeleteHtml($row['ZD_JianCeTiaoMu'])."</li>");

              if ($const_q_shanc < 0) { //没有权限时 
                $nowdisabled = " disabled='true' ";
              };
                echo("<li  class='tdpp rightli center'   style='height:25px;line-height:25px; width:22px;'><input type='checkbox'  tabindex='-1' name='ID' value='$now_id' ></li> ");
                $imgedit = "<i class='fa fa-edit-mini'></i>";
              if ($const_q_xiug < 0) { //没有权限时
                echo("<li  class='tdpp rightli center'  style='height:25px;line-height:25px; width:22px;'  title='没修改权限！'></li> ");
              } else {
                echo("<li  class='tdpp rightli center'   style='height:25px;line-height:25px; width:22px;' onclick=edit_data(this,'$now_id','$ToHtmlID','$hy') >$imgedit</li> ");
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
