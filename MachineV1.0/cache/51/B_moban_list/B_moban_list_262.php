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
	$databiao="sys_jlmb";
	$const_shaixuan="";
	$SYS_ALL_ziduan_list="id,sys_nowbh,sys_card,mdb_name_SYS,Id_MenuBigClass,banben,xiugaicishu,ul_row_height,sys_id_login,sys_shenpi_all";
	$xianshi_ZD_num="7";
	$xianshi_KD_num="1104";
	$shuoding_num="3";
	$maxrecord="20";
	$FormattingXianShi_idlist="1";
	$zu_all_list="366=国内公司注册(Domestic Company reg),367=国外公司注册(Abroad Company reg),364=法律顾问 (Legal advisor),362=知识产权 (property),363=管理顾问 (consultant),361=认证服务 (Certification),";
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
   $Tablecol_list="sys_nowbh,id,menuimg,tel,sys_card,mdb_name_SYS,Id_MenuBigClass,sys_id_standard,fenlei_K_G,sys_banshi,startdate,beizhu,sys_id_zu,banben,xiugaicishu,tiaok,ul_row_height,sys_yfzuid,ok,jilu_del,MenuBigClass,mdb_name,mdb_use_type,datapage_list,datapage_add,datapage_edit,datapage_del,shaixuan,xianshi,SYS_ALL_ziduan_list,xianshi_ZD_Arry,xianshi_ZD_num,xianshi_KD_num,shuoding,shuoding_num,tianjia,tianjia_ZD_Arry,xiugai,xiugai_ZD_Arry,sousuo,sousuo_name,bitian,Wuchongfu,Mtiaoshu,jiami,zt_bt,s_bianh,x_bianhao,sys_bh,sys_jiangli_rmb,sys_jiangli_jifen,sys_chufa_rmb,sys_chufa_jifen,sys_zt,sys_zt_bianhao,sys_huis,sys_id_bumen,sys_shenpi,sys_id_fz,sys_web_shenpi,sys_shenpi_all,sys_adddate,sys_adddate_g,sys_login,sys_id_login,sys_chaosong,sys_paixu";

   $sql2 = "select (@rownum:=@rownum+1) as rownum,sys_jlmb.id  from `sys_jlmb`,(select @rownum:=0) as sys_jlmb where  sys_yfzuid='$hy' and sys_huis='$huis' "; //这里得到查询id清单的sql
   if($sys_guanxibiao_id != '' && $GuanXi_id != ""){$sql2 .=" and  sys_gx_id_{$sys_guanxibiao_id}='{$GuanXi_id}'";}
   $sql2 =sql_search($databiao,$sql2,$nowkeyword, 0);
   $sql2 .= " order by $px_ziduan $pxv"; //这里得到排序
   $sql2 = "select id from ($sql2) as t where rownum between $page_first and  $page_end ";
   $sql_all_id_list = sql_all_id_list($sql2,$Conn );

   if ( !$sql_all_id_list ) {
      echo( "<div class='nodata' tabindex='-1'><div class='nodata_center'><i class='fa fa-nodata' style='margin-top:-1px'></i>&nbsp; Sorry, No Data！</div></div>" );
   } else { 
      $sql = "select  id,sys_nowbh,sys_card,mdb_name_SYS,Id_MenuBigClass,banben,xiugaicishu,ul_row_height,sys_id_login,sys_shenpi_all  from `sys_jlmb` where id in($sql_all_id_list) and sys_yfzuid='$hy' and sys_huis='$huis'";
      $sql .= " order by $px_ziduan $pxv";
      $rs = mysqli_query( $Conn, $sql );
      echo( "<div id='para'  tabindex='-1' class='tables'  style='border:0;border-bottom:1px solid #CCC;min-width:100%;width: 1104px'>" );

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
			echo( "  style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;min-width:100%;width:1104px'> " );
			echo( "<li class='cols1 shuodingli'  title='$now_id'  style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;text-align:center;'></li>" );
	
	
              echo("<li id='c_tdtop1'  class='shuodingli   ET_sys_nowbh$now_id F_M_XS_1' ET='ET_sys_nowbh'  xstypeid='1' name='sys_nowbh' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_nowbh'])."</li>");
              echo("<li  class='shuodingli   ET_sys_card$now_id F_M_XS_1' ET='ET_sys_card'  xstypeid='1' name='sys_card' style='height:28px;line-height:28px;width:152px;'>".DeleteHtml($row['sys_card'])."</li>");
              echo("<li  class='shuodingli  border_shuoding  ET_mdb_name_SYS$now_id F_M_XS_1' ET='ET_mdb_name_SYS'  xstypeid='1' name='mdb_name_SYS' style='height:28px;line-height:28px;width:350px;'>".DeleteHtml($row['mdb_name_SYS'])."</li>");
              echo("<li  class='contentli ET_Id_MenuBigClass$now_id F_M_XS_1' ET='ET_Id_MenuBigClass'  xstypeid='1' name='Id_MenuBigClass' style='height:28px;line-height:28px;width:72px;'>".DeleteHtml($row['Id_MenuBigClass'])."</li>");
              echo("<li  class='contentli ET_banben$now_id F_M_XS_1' ET='ET_banben'  xstypeid='1' name='banben' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['banben'])."</li>");
              echo("<li  class='contentli ET_xiugaicishu$now_id F_M_XS_1' ET='ET_xiugaicishu'  xstypeid='1' name='xiugaicishu' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['xiugaicishu'])."</li>");
              echo("<li  class='contentli ET_ul_row_height$now_id F_M_XS_1' ET='ET_ul_row_height'  xstypeid='1' name='ul_row_height' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ul_row_height'])."</li>");

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
