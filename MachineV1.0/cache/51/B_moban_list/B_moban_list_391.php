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
	$databiao="sys_file";
	$const_shaixuan="";
	$SYS_ALL_ziduan_list="id,title,path,time,sort,size,ext,tidno,idno,filetype,classid,sys_nowbh";
	$xianshi_ZD_num="11";
	$xianshi_KD_num="1890";
	$shuoding_num="2";
	$maxrecord="50";
	$FormattingXianShi_idlist="1";
	$zu_all_list="209=产品图片,208=文件类,230=证件类,";
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
   $Tablecol_list="id,title,path,src,time,userid,lable,sort,size,des,ext,itemid,iscomplete,tidno,idno,filetype,classid,type,sys_id_zu,sys_id_fz,sys_yfzuid,sys_bh,sys_zt,sys_zt_bianhao,sys_nowbh,sys_huis,sys_id_bumen,sys_web_shenpi,sys_adddate,sys_adddate_g,sys_id_login,sys_login,sys_shenpi,sys_shenpi_all,sys_chaosong,sys_paixu";

   $sql2 = "select (@rownum:=@rownum+1) as rownum,sys_file.id  from `sys_file`,(select @rownum:=0) as sys_file where  sys_yfzuid='$hy' and sys_huis='$huis' "; //这里得到查询id清单的sql
   if($sys_guanxibiao_id != '' && $GuanXi_id != ""){$sql2 .=" and  sys_gx_id_{$sys_guanxibiao_id}='{$GuanXi_id}'";}
   $sql2 =sql_search($databiao,$sql2,$nowkeyword, 0);
   $sql2 .= " order by $px_ziduan $pxv"; //这里得到排序
   $sql2 = "select id from ($sql2) as t where rownum between $page_first and  $page_end ";
   $sql_all_id_list = sql_all_id_list($sql2,$Conn );

   if ( !$sql_all_id_list ) {
      echo( "<div class='nodata' tabindex='-1'><div class='nodata_center'><i class='fa fa-nodata' style='margin-top:-1px'></i>&nbsp; Sorry, No Data！</div></div>" );
   } else { 
      $sql = "select  id,title,path,time,sort,size,ext,tidno,idno,filetype,classid,sys_nowbh  from `sys_file` where id in($sql_all_id_list) and sys_yfzuid='$hy' and sys_huis='$huis'";
      $sql .= " order by $px_ziduan $pxv";
      $rs = mysqli_query( $Conn, $sql );
      echo( "<div id='para'  tabindex='-1' class='tables'  style='border:0;border-bottom:1px solid #CCC;min-width:100%;width: 1890px'>" );

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
			echo( "  style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;min-width:100%;width:1890px'> " );
			echo( "<li class='cols1 shuodingli'  title='$now_id'  style='height:" . $r_cow_height . "px;line-height:" . $r_cow_height . "px;text-align:center;'></li>" );
	
	
              echo("<li id='c_tdtop1'  class='shuodingli   ET_title$now_id F_M_XS_1' ET='ET_title'  xstypeid='1' name='title' style='height:28px;line-height:28px;width:400px;'>".DeleteHtml($row['title'])."</li>");
              echo("<li  class='shuodingli  border_shuoding  ET_sys_nowbh$now_id F_M_XS_1' ET='ET_sys_nowbh'  xstypeid='1' name='sys_nowbh' style='height:28px;line-height:28px;width:80px;'>".DeleteHtml($row['sys_nowbh'])."</li>");
              echo("<li class='contentli ET_path$now_id F_M_XS_1' ET='ET_path'  xstypeid='1' name='path' style='height:28px;line-height:28px;width:300px;'>".DeleteHtml($row['path'])."</li>");
              echo("<li class='contentli ET_time$now_id F_M_XS_1' ET='ET_time'  xstypeid='1' name='time' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['time'])."</li>");
              echo("<li class='contentli ET_sort$now_id F_M_XS_1' ET='ET_sort'  xstypeid='1' name='sort' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['sort'])."</li>");
              echo("<li class='contentli ET_size$now_id F_M_XS_1' ET='ET_size'  xstypeid='1' name='size' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['size'])."</li>");
              echo("<li class='contentli ET_ext$now_id F_M_XS_1' ET='ET_ext'  xstypeid='1' name='ext' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['ext'])."</li>");
              echo("<li class='contentli ET_tidno$now_id F_M_XS_1' ET='ET_tidno'  xstypeid='1' name='tidno' style='height:28px;line-height:28px;width:160px;'>".DeleteHtml($row['tidno'])."</li>");
              echo("<li class='contentli ET_idno$now_id F_M_XS_1' ET='ET_idno'  xstypeid='1' name='idno' style='height:28px;line-height:28px;width:200px;'>".DeleteHtml($row['idno'])."</li>");
              echo("<li class='contentli ET_filetype$now_id F_M_XS_1' ET='ET_filetype'  xstypeid='1' name='filetype' style='height:28px;line-height:28px;width:100px;'>".DeleteHtml($row['filetype'])."</li>");
              echo("<li class='contentli ET_classid$now_id F_M_XS_1' ET='ET_classid'  xstypeid='1' name='classid' style='height:28px;line-height:28px;width:50px;'>".DeleteHtml($row['classid'])."</li>");

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
