<?php
header( 'Content-type: text/html; charset=utf-8' ); //设定本页编码
include_once '../session.php';
include_once 'B_quanxian.php';
include_once '../inc/Function_All.php';
include_once '../inc/B_Config.php';//执行接收参数及配置
include_once '../inc/B_conn.php';
include_once '../inc/B_Connadmin.php';

//include_once '../inc/Sub_All.php' ;

$scroll_left = '';
$scroll_left = $_REQUEST[ 'scroll_left' ]; //得到滚动条位置

//==================================================================================================以下为获得参数据
if ( $re_id <> 0 ) {
	$rs = $sql = $databiao1 = $databiao_SYS1 = $mdb_use_type = $databiao_SYS = '';
	$sql = 'select * From Sys_jlmb where id=' . $re_id;
	
	$rs = $db_vip->query($sql);
	
	$row = mysqli_fetch_array( $rs['result'] );
	$databiao = htmlspecialchars( trim( $row[ 'mdb_name_SYS' ] ) ); //原数据表名
	$r_banben = $row[ 'banben' ] ;
	if ( '1' . $r_banben == '1' )$r_banben = 'A';
	$r_xiugaicishu = $row[ 'xiugaicishu' ] ;
	if ( '1' . $r_xiugaicishu == '1' )$r_xiugaicishu = 0;
	if ( $r_banben <> '' )$r_banben = '-' . $r_banben;
	$r_card = $row[ 'sys_card' ] ;
	$r_startdate = $row[ 'startdate' ] ;

	$xianshi_KD_num = count_col_num( $databiao, 5 )+3500; //查询到宽度和
	// echo $xianshi_KD_num;

	$shuoding_num = Uboundarryy( Tablecol_list_beizhu_cols( $databiao, 6 ), ',' );//查询锁定例清单后进行统计个数
	if ( $shuoding_num == 0 )$shuoding_num = 1; //默认锁定第一列
	//$shuoding_num = intval( $row[ 'shuoding_num' ] ); //锁定列数
	
	//echo $shuoding_num;
	if ( $nowgsbh <> '' )$nowgsbh2 = $nowgsbh . '.';
	
	$wjbh= "<div class='wjbh' style='border:0;'><strong><font title='该记录文件编号' class='redfont' style='margin-top:-6px;line-height:12px;'>&nbsp;" . $nowgsbh2 . $re_id . $r_banben . "/" . $r_xiugaicishu . "&nbsp;</font><font style='color:#666'>" . $r_card . "&nbsp;" . $r_startdate . "</font></strong></div>";
};


if ( $act == 'list' ) {     //加载表头
	toplist(); 
} elseif ( $act == 'biaoqian' ) { //标签	
	biaoqian(); 
} else {
	echo NoZhiLing();
};
//==================================================================================================标签
function biaoqian() { //表头
	global $Conn,$hy,$bh,$hy,$re_id,$SYS_UserName,$ToHtmlID;

	$re_id=$_REQUEST[ 're_id' ];                                                    //re_id
    $sys_const_biaoqian_id=$_REQUEST[ 'sys_const_biaoqian_id' ];                  //标签id
    //alert($sys_const_biaoqian_id);
	if($re_id==506){//当为工资统计表时
		//----------------------------------------------------------以下为标签
		$nowhtml='';
		$sql = "select id,sys_name From `sys_biaoqian` where sys_yfzuid='$hy' and sys_const_re_id='$re_id' and sys_huis='0' order by id Asc";
		//echo $sql;
		$rs = mysqli_query($Conn,$sql);
		
		//if(is_array($sql)){//有数据时
			while( $row = mysqli_fetch_array( $rs ) ) {
				$id = $row[ 'id' ];                  //ID
				$sys_name = $row[ 'sys_name' ]; //标签名称 
				if($id==$sys_const_biaoqian_id){
					$selectTag='selectTag';
					$sys_const_biaoqian_id=$id;
				}else{
					$selectTag="";
				}
				$nowhtml.="<li id='$id' class='overli {$selectTag}' onclick=\"shuqianmenu_TOTO(this,'$ToHtmlID')\">$sys_name</li>";
			}
		//}else{
			//$nowhtml="";
		//}
		mysqli_free_result( $rs ); //释放内存
		
		if($sys_const_biaoqian_id >0){ $selectTag=""; }else{ $selectTag='selectTag'; };
		$nowhtml="<div  style='display:none;' id='head_biaoqian_copy'>$nowhtml<li id=\"0\" class=\"overli {$selectTag}\" onclick=\"shuqianmenu_TOTO(this,'$ToHtmlID')\">全部</li><li class=\"overli\" onclick=\"shuqianmenu(this,'$ToHtmlID')\">&nbsp;★&nbsp;</li></div>";
		return $nowhtml;
		
	}else{
		//----------------------------------------------------------以下为标签
		$nowhtml='';
		$sql = "select id,sys_name From `sys_biaoqian` where sys_yfzuid='$hy' and sys_const_re_id='$re_id' and sys_huis='0' order by id Asc";
		//echo $sql;
		$rs = mysqli_query($Conn,$sql);
		//if(is_array($sql)){//有数据时
			while( $row = mysqli_fetch_array( $rs ) ) {
				
				$id = $row[ 'id' ];                  //ID
				$sys_name = $row[ 'sys_name' ]; //标签名称 
				if($id==$sys_const_biaoqian_id){
					$selectTag='selectTag';
					$sys_const_biaoqian_id=$id;
				}else{
					$selectTag="";
				}
				$nowhtml.="<li id='$id' class='overli {$selectTag}' onclick=\"shuqianmenu_TOTO(this,'$ToHtmlID',$re_id)\">$sys_name</li>";
			}
		//}else{
			//$nowhtml="";
		//}
		
		mysqli_free_result( $rs ); //释放内存
		
		if($sys_const_biaoqian_id >0){ $selectTag=""; }else{ $selectTag='selectTag'; };
		$nowhtml="<div  style='display:none;' id='head_biaoqian_copy'>$nowhtml<li id=\"0\" class=\"overli {$selectTag}\" onclick=\"shuqianmenu_TOTO(this,'$ToHtmlID')\">全部</li><li class=\"overli\" onclick=\"shuqianmenu(this,'$ToHtmlID')\">&nbsp;★&nbsp;</li></div>";
		return $nowhtml;
	}
	
	
	
}

//==================================================================================================表头+文件编号
function toplist() { //表头
	$Htmlcache = $Htmlcache2 = '' ;
	global $hy,$bh, $re_id, $sys_q_cak , $databiao, $databiao_SYS1,$sys_q_shanc, $databiao_SYS, $xianshi_KD_num, $shuoding_num, $databiao1, $ToHtmlID, $scroll_left, $scroll_left, $sys_q_cak, $xt_m_ziduan, $xt_m_ziduan_Name,$SYS_UserName,$wjbh;

	// echo $sys_q_tianj . $re_id;
	if ( !(getN( $sys_q_cak, $re_id ) >= 0) ) { //这个是当没有权限时执行
		echo "<li style='width:100px;'>您没有该表查看权限</li>";
	} else {
			
		$Conn=ChangeConn($databiao); //依据表自动选择数据库
		
		$classss = $getN_XTZD = $onmouseover='';
		
		//识别是否为页中页
		if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
		if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";	};//关系列id
		if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                            //j显示页面
		if ( isset( $_REQUEST[ 'huis' ] ) ){$huis = intval( $_REQUEST[ 'huis' ] );}else{$huis = 0;};                                                              //是否为回站0为不回收

		$biaoqian=biaoqian();//得到标签代码
		$Htmlcache2.= $wjbh.$biaoqian."<div  id='theObjTable' title='' name='headall' class='tables' style='border:0;padding:0;margin:0;min-width:100%;width:25px;width:auto'  onselectstart=self.event.returnValue=false>" ;
		$Htmlcache.= "<li class='cols1 shuodingli wjbhparnt'></li>" ;

		// echo $re_id;
		
		if ( '1' . $databiao == '1' ) { //没有初始化时
			$Htmlcache.= "<div style='width:100px;'>该表没有源表，请初始化</div>";
		} else {
			//=================================================================================================================【锁定列数】
			
			$shuodingnum=SHOW_FULL_COLUMNS($databiao,6);//返回6列为锁定列的总数
			//echo $shuodingnum;
			//=================================================================================================================【锁定列】
			//
			$sql = "SHOW FULL COLUMNS FROM `$databiao`";
			// echo $sql.'_'; 
			//EXIT();
			$rs = mysqli_query( $Conn , $sql );
			$xianshi_ZD_num = mysqli_num_rows( $rs ); //总数
			// echo $xianshi_ZD_num.'_'; 

			$i =0;
			if ( $xianshi_ZD_num == 0 ) {
				$Htmlcache.= "<li class='shuodingli border_shuoding' style='width:350px'>请设定好显示的列后再试...</li>" ; //没有设定列时
			} else {
				while ( $row = mysqli_fetch_array( $rs ) ) {
					$zd_en_name = $row[ 'Field' ]; //字段
					$zdbeizhu = $row[ 'Comment' ]; //备注
					$NEW_zdbeizhu=colbeizhu($zdbeizhu,$zd_en_name);
					//echo $NEW_zdbeizhu;
					//0【字段中文名称】,1【显示宽度】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】
					$zd_cn_name=textN( $NEW_zdbeizhu, 0, ',' );             //中文字段名
					
					$zd_xianshi_width = textN( $NEW_zdbeizhu, 1, ',' );      //字段显示宽度
					// echo $zd_en_name.':'.$zd_xianshi_width.'_';
					$zd_xianshi_is = textN( $NEW_zdbeizhu, 5, ',' );         //5为显示
					$zd_shuoding_is = textN( $NEW_zdbeizhu, 6, ',' );        //6为锁定列
					
					if($zd_xianshi_is==1 and $zd_shuoding_is==1 and $zd_en_name!='id'){
						$i++;
						$zd_xianshi_width=XianShiWidthMoren($zd_en_name,$zd_xianshi_width);//设定系统默认宽度和最小显示宽度
						// echo $zd_xianshi_width.'_';
						$getN_XTZD = getN( $xt_m_ziduan, strtolower( $zd_en_name ) ); //当>=0为系统字段时
						if ( $getN_XTZD >= 0 ) {
							$zd_cn_name = textN( $xt_m_ziduan_Name, $getN_XTZD, ',' ); //显示字段系统名称					
						};
						$zd_cn_name = SysChangeName( $zd_cn_name, $databiao ); //变更系统设定名
						//$colls='coll'.'_'.$re_id.'_'.$III+1;
						//if ( $i < $shuoding_num ) {
							//$classss = "shuodingli";
						//}

						$classss = "shuodingli  ";	
						if ( $i == $shuodingnum ) { //结束列
							$classss .= "border_shuoding  libottom_line " ;
						};
						$classss .= ' ET_' . $zd_en_name;
						$onmouseover="dootstart('l','$ToHtmlID')";
						
						$ET='ET_' . $zd_en_name;
						if($bh != '9001'){
							$Htmlcache.= "<li class='$classss' name='$zd_en_name' ET='$ET' style='width:" . $zd_xianshi_width . "px' onclick=\"sortCol(this,'$ToHtmlID')\" >$zd_cn_name";
							$Htmlcache.= "</li>";
						}else{
							$Htmlcache.= "<li class='$classss' name='$zd_en_name' style='width:{$zd_xianshi_width}px' onclick=\"sortCol(this,'$ToHtmlID')\"  onMouseDown=\"copycol_down(this,'$ToHtmlID');\" onMouseover=\"copycol_over(this,'$ToHtmlID');$onmouseover\" onMouseUp=\"copycol_up(this, '$ToHtmlID');\" onMouseout=\"copycol_out(this, '$ToHtmlID')\">$zd_cn_name";
						
							$Htmlcache.= "<dd class='ToResize' onMouseDown=\"MouseDownToResize(this,'$ET', 'x', '$ToHtmlID');\" onMousemove =\"MouseMoveToResize(this,'$ET', 'x', '$ToHtmlID')\" onMouseover=\"MouseoverToResize(this,'$ToHtmlID')\" onMouseout=\"MouseoutToResize(this,'$ToHtmlID')\" onMouseUp=\"MouseUpToResize(this,'$zd_en_name', 'x', '$ToHtmlID');\" >&nbsp;</dd>";
							$Htmlcache.= "</li>";
						}
						
					}
				};
				mysqli_free_result( $rs ); //释放内存
			};
			
			
			//=================================================================================================================【非锁定列】
			$sql2 = "SHOW FULL COLUMNS FROM `$databiao`";
			//echo $sql.'_'; 
			//EXIT();
			$rs2 = mysqli_query( $Conn , $sql2 );
			$xianshi_ZD_num = mysqli_num_rows( $rs2 ); //总数
			//echo $xianshi_ZD_num.'_'; 

			$i = 0;
			if ( $xianshi_ZD_num == 0 ) {
				//$Htmlcache.= "<li class='shuodingli border_shuoding' style='width:350px'>请设定好显示的列后再试...</li>" ; //没有设定列时
			} else {
				$zd_xianshi_width_sum = 100000;
				while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
					$i++;
					$zd_en_name = $row2[ 'Field' ]; //字段
					$zdbeizhu = $row2[ 'Comment' ]; //备注
					$NEW_zdbeizhu=colbeizhu($zdbeizhu,$zd_en_name);
					//echo $NEW_zdbeizhu;
					//0【字段中文名称】,1【显示宽度】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】
					$zd_cn_name=textN( $NEW_zdbeizhu, 0, ',' );             //中文字段名
					
					$zd_xianshi_width = textN( $NEW_zdbeizhu, 1, ',' );     //字段显示宽度
					$zd_xianshi_is = textN( $NEW_zdbeizhu, 5, ',' );         //5为显示
					$zd_shuoding_is = textN( $NEW_zdbeizhu, 6, ',' );        //6为锁定列
					if($zd_xianshi_is==1 and $zd_shuoding_is==0 and $zd_en_name!='id'){
						$zd_xianshi_width=XianShiWidthMoren($zd_en_name,$zd_xianshi_width);//设定系统默认宽度和最小显示宽度
						$getN_XTZD = getN( $xt_m_ziduan, strtolower( $zd_en_name ) ); //当>=0为系统字段时'
						// $zd_xianshi_width_sum+=$zd_xianshi_width;
						// echo $zd_xianshi_width.'_';
						// echo $zd_xianshi_width_sum.'_';
						if ( $getN_XTZD >= 0 ) {
							$zd_cn_name = textN( $xt_m_ziduan_Name, $getN_XTZD, ',' ); //显示字段系统名称					
						};
						$zd_cn_name = SysChangeName( $zd_cn_name, $databiao ); //变更系统设定名
						//$colls='coll'.'_'.$re_id.'_'.$III+1;
						if ( $i == $xianshi_ZD_num ) { //结束列
							$classss = "endli ";
							$classss = $classss . ' ET_' . $zd_en_name;
						} else { //常规列
							$classss = "contentli libottom_line "; //内容列样式
							$classss = $classss . 'ET_' . $zd_en_name;
							$onmouseover='';
						};
						$ET='ET_' . $zd_en_name;
						if($bh != '9001'){
							$Htmlcache.= "<li class='$classss' name='$zd_en_name' ET='$ET' style='width:" . $zd_xianshi_width . "px' onclick=\"sortCol(this,'$ToHtmlID')\" >$zd_cn_name";
							$Htmlcache.= "</li>";
						}else{
							$Htmlcache.= "<li class='$classss' name='$zd_en_name' style='width:" . $zd_xianshi_width . "px' onclick=\"sortCol(this,'$ToHtmlID')\"  onMouseDown=\"copycol_down(this,'$ToHtmlID');\" onMouseover=\"copycol_over(this,'$ToHtmlID');$onmouseover\" onMouseUp=\"copycol_up(this, '$ToHtmlID');\" onMouseout=\"copycol_out(this, '$ToHtmlID')\">$zd_cn_name";
						
							$Htmlcache.= "<div class='ToResize' onMouseDown=\"MouseDownToResize(this,'$ET', 'x', '$ToHtmlID');\" on onmousemove =\"MouseMoveToResize(this,'$ET', 'x', '$ToHtmlID')\" onMouseover=\"MouseoverToResize(this,'$ToHtmlID')\" onMouseout=\"MouseoutToResize(this,'$ToHtmlID')\" onMouseUp=\"MouseUpToResize(this,'$zd_en_name', 'x', '$ToHtmlID');\" >&nbsp;</div>";
							$Htmlcache.= "</li>";
						}
					}
				};
				mysqli_free_result( $rs2 ); //释放内存
			};
		};
		$Htmlcache.= '</ul></div>' ;
		$Htmlcache.= "<script>
			Copy_Head('#theObjTable','$ToHtmlID');
			$('')
		</script>"; //这里为拷贝生成滚动条
		
		if ( $scroll_left > 0 ) {
			$Htmlcache.= "<script>$('" . "#" . $ToHtmlID . "_content" . "').scrollLeft(" . $scroll_left . ");</script>" ;
			//document.'".$ToHtmlID."'.content.scrollLeft=".$scroll_left;
		};
		
		if ( $databiao . '1' != '1'	and $sys_q_shanc >= 0 ) { //没有权限时
			$Htmlcache.= "<script>$('#" . $ToHtmlID . " #chkall').eq(0).attr({'disabled':false,'title':''});</script>";
		};
		$Htmlcache2.= "<ul class='thead' style='width:$zd_xianshi_width_sum"."px'>" ;
		$Htmlcache = $Htmlcache2 . $Htmlcache;
		echo $Htmlcache;
		
		
		//find_cache('1',$Htmlcache);
		mysqli_close($Conn);//关闭数据库
	}
}


?>