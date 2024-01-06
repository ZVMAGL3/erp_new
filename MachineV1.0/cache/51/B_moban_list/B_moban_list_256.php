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
	$databiao="msc_user_reg";
	$const_shaixuan="";
	$SYS_ALL_ziduan_list="id,SYS_GongHao,SYS_reg_num,SYS_UserName,SYS_ShouJi,SYS_yuangongdanganbiao_id,SYS_PassWord,SYS_ShenFenZheng,SYS_Company_id,SYS_ZD_QQ,SYS_Email,SYS_ZD_ZaiZhiZhuangTai,sys_gonglinggongzi,sys_zhiwugongzi,sys_jichugongzi";
	$xianshi_ZD_num="14";
	$xianshi_KD_num="1706";
	$shuoding_num="4";
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
   $Tablecol_list="id,sys_yfzuid,SYS_GongHao,SYS_reg_num,SYS_UserName,SYS_ShouJi,sys_isVerified,SYS_yuangongdanganbiao_id,SYS_PassWord,SYS_ShenFenZheng,SYS_Company_id,SYS_ZD_QQ,SYS_Email,SYS_ZD_DengLuCiShu,SYS_ZD_ZaiXianBiaoZhi,SYS_ZD_ZaiZhiZhuangTai,SYS_a_logintime,SYS_b_logintime,sys_adddate,sys_web_shenpi,sys_id_login,sys_login,sys_id_zu,sys_id_fz,sys_bh,sys_zt,sys_zt_bianhao,sys_nowbh,sys_huis,sys_id_bumen,sys_shenpi,sys_adddate_g,sys_shenpi_all,SYS_QuanXian,SYS_XingBie,SYS_DianHua,SYS_YinXingKaHao,SYS_DiZhi,SYS_GongZi,SYS_StartDate,SYS_EndDate,SYS_jib,SYS_photo,SYS_chaoguan,SYS_qianmin,sys_chaosong,sys_gonglinggongzi,sys_zhiwugongzi,sys_jichugongzi,sys_paixu";

   $sql2 = "select (@rownum:=@rownum+1) as rownum,msc_user_reg.id  from `msc_user_reg`,(select @rownum:=0) as msc_user_reg where  sys_yfzuid='$hy' and sys_huis='$huis' "; //这里得到查询id清单的sql
   if($sys_guanxibiao_id != '' && $GuanXi_id != ""){$sql2 .=" and  sys_gx_id_{$sys_guanxibiao_id}='{$GuanXi_id}'";}
   $sql2 =sql_search($databiao,$sql2,$nowkeyword, 0);
   $sql2 .= " order by $px_ziduan $pxv"; //这里得到排序
   $sql2 = "select id from ($sql2) as t where rownum between $page_first and  $page_end ";
   $sql_all_id_list = sql_all_id_list($sql2,$Connadmin );

   if ( !$sql_all_id_list ) {
      echo( "<div class='nodata' tabindex='-1'><div class='nodata_center'><i class='fa fa-nodata' style='margin-top:-1px'></i>&nbsp; Sorry, No Data！</div></div>" );
   } else { 
      $sql = "select  id,SYS_GongHao,SYS_reg_num,SYS_UserName,SYS_ShouJi,SYS_yuangongdanganbiao_id,SYS_PassWord,SYS_ShenFenZheng,SYS_Company_id,SYS_ZD_QQ,SYS_Email,SYS_ZD_ZaiZhiZhuangTai,sys_gonglinggongzi,sys_zhiwugongzi,sys_jichugongzi  from `msc_user_reg` where id in($sql_all_id_list) and sys_yfzuid='$hy' and sys_huis='$huis'";
      $sql .= " order by $px_ziduan $pxv";
      $rs = mysqli_query( $Connadmin, $sql );
      echo( "<div id='para'  tabindex='-1' class='tables'  style='border:0;border-bottom:1px solid #CCC;min-width:100%;width:1706'>" );

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
	
	
              echo("<li id='c_tdtop1'  class='shuodingli   ET_SYS_GongHao$now_id F_M_XS_1' ET='ET_SYS_GongHao'  xstypeid='1' name='SYS_GongHao' style='height:28px;line-height:28px;width:65px;'>".DeleteHtml($row['SYS_GongHao'])."</li>");
              echo("<li  class='shuodingli   ET_SYS_UserName$now_id F_M_XS_1' ET='ET_SYS_UserName'  xstypeid='1' name='SYS_UserName' style='height:28px;line-height:28px;width:82px;'>".DeleteHtml($row['SYS_UserName'])."</li>");
              echo("<li  class='shuodingli   ET_SYS_ShouJi$now_id F_M_XS_1' ET='ET_SYS_ShouJi'  xstypeid='1' name='SYS_ShouJi' style='height:28px;line-height:28px;width:149px;'>".DeleteHtml($row['SYS_ShouJi'])."</li>");
              echo("<li  class='shuodingli  border_shuoding  ET_SYS_ZD_ZaiZhiZhuangTai$now_id F_M_XS_1' ET='ET_SYS_ZD_ZaiZhiZhuangTai'  xstypeid='1' name='SYS_ZD_ZaiZhiZhuangTai' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['SYS_ZD_ZaiZhiZhuangTai'])."</li>");
              echo("<li class='contentli ET_SYS_reg_num$now_id F_M_XS_1' ET='ET_SYS_reg_num'  xstypeid='1' name='SYS_reg_num' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['SYS_reg_num'])."</li>");
              echo("<li class='contentli ET_SYS_yuangongdanganbiao_id$now_id F_M_XS_1' ET='ET_SYS_yuangongdanganbiao_id'  xstypeid='1' name='SYS_yuangongdanganbiao_id' style='height:28px;line-height:28px;width:87px;'>".DeleteHtml($row['SYS_yuangongdanganbiao_id'])."</li>");
              echo("<li class='contentli ET_SYS_PassWord$now_id F_M_XS_1' ET='ET_SYS_PassWord'  xstypeid='1' name='SYS_PassWord' style='height:28px;line-height:28px;width:274px;'>".DeleteHtml($row['SYS_PassWord'])."</li>");
              echo("<li class='contentli ET_SYS_ShenFenZheng$now_id F_M_XS_1' ET='ET_SYS_ShenFenZheng'  xstypeid='1' name='SYS_ShenFenZheng' style='height:28px;line-height:28px;width:209px;'>".DeleteHtml($row['SYS_ShenFenZheng'])."</li>");
              echo("<li class='contentli ET_SYS_Company_id$now_id F_M_XS_1' ET='ET_SYS_Company_id'  xstypeid='1' name='SYS_Company_id' style='height:28px;line-height:28px;width:85px;'>".DeleteHtml($row['SYS_Company_id'])."</li>");
              echo("<li class='contentli ET_SYS_ZD_QQ$now_id F_M_XS_1' ET='ET_SYS_ZD_QQ'  xstypeid='1' name='SYS_ZD_QQ' style='height:28px;line-height:28px;width:103px;'>".DeleteHtml($row['SYS_ZD_QQ'])."</li>");
              echo("<li class='contentli ET_SYS_Email$now_id F_M_XS_1' ET='ET_SYS_Email'  xstypeid='1' name='SYS_Email' style='height:28px;line-height:28px;width:121px;'>".DeleteHtml($row['SYS_Email'])."</li>");
              echo("<li class='contentli ET_sys_gonglinggongzi$now_id F_M_XS_1' ET='ET_sys_gonglinggongzi'  xstypeid='1' name='sys_gonglinggongzi' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['sys_gonglinggongzi'])."</li>");
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
