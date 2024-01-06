<?php
header( 'Content-type: text/html; charset=utf-8' ); //设定本页编码
include_once '../session.php';
include_once 'B_quanxian.php';
include_once '../inc/Function_All.php';
include_once '../inc/B_Config.php';//执行接收参数及配置
include_once '../inc/B_connadmin.php';
include_once '../inc/B_conn.php';
	$act = $nowzu = $zd = '';
	if ( isset( $_REQUEST[ 'act' ] ) )$act = $_REQUEST[ 'act' ];
	if ( isset( $_REQUEST[ 'zu' ] ) )$nowzu = htmlspecialchars( $_REQUEST[ 'zu' ] ); //分类接收
	if ( '1' . $nowzu == '1' )$nowzu = 0;
	if ( isset( $_REQUEST[ 'zd' ] ) )$zd = htmlspecialchars( $_REQUEST[ 'zd' ] ); //字段接收
	if ( '1' . $zd == '1' )$zd = 0;
	if($re_id)
	$databiao=Find_tablename( $re_id );   //得到表名
	$connect=Changedb($databiao);

//==============================================以下为得到数据

if ( $act == 'content_right_menu' ) {                 //
	content_right_menu();
}else if($act == 'shuqianmenu'){                      //书签
	shuqianmenu();
}else if($act == 'shuqianmenu_update'){               //书签记忆加载
	shuqianmenu_update();
}else if($act == 'BiaoQian_loading'){                 //书签更新
	BiaoQian_loading();
}else if($act == 'BiaoQian_look'){                    //书签对比
	BiaoQian_look();
}else if($act == 'BiaoQian_change'){                  //书签更新
	BiaoQian_change();	
}else if($act == 'shuqianmenu_user_update'){          //用户使用记忆功能
	shuqianmenu_user_update();
} else {
	echo '没有要执行的指令';
}
function BiaoQian_loading() { //标签加载
	global  $connect,$hy,$bh,$re_id;
    $html='';
	$rs=$sql=$row='';
	//===================================================================================================判断
	$sql = "select * From `sys_biaoqian_user` where `sys_const_re_id`='$re_id' and `sys_yfzuid`='$hy' and `sys_id_login`='$bh'";
	//echo $sql;
	$rs = $connect -> query($sql);
	//$countcords=0;
	if($row = mysqli_fetch_array($rs['result'])){
		//$countcords=mysqli_num_rows($rs);
		//$row = mysqli_fetch_array( $rs );
	    //--------------------------------------------------------------------------查询到数据
		//$id = $row[ 'id' ];            		                                                  //ID
		$html.='sys_const_biaoqian_id===='  .$row[ 'sys_const_biaoqian_id' ].'$_=nZζPξz=_$';      //标签id
	    $html.='keyword===='                .$row[ 'sys_const_keyword' ].'$_=nZζPξz=_$';          //关键词                  
		$html.='sys_const_id_bumen===='     .$row[ 'sys_const_id_bumen' ].'$_=nZζPξz=_$';         //部门  
		$html.='sys_const_bh===='           .$row[ 'sys_const_bh' ].'$_=nZζPξz=_$';               //编制人
		$html.='sys_const_shenpi===='       .$row[ 'sys_const_shenpi' ].'$_=nZζPξz=_$';           //审核人
		$html.='sys_const_shenpi_all===='   .$row[ 'sys_const_shenpi_all' ].'$_=nZζPξz=_$';       //批准人
		$html.='sys_const_chaosong===='     .$row[ 'sys_const_chaosong' ].'$_=nZζPξz=_$';         //经办人
		$html.='sys_const_adddate===='      .$row[ 'sys_const_adddate' ].'$_=nZζPξz=_$';          //添加或更新时间
		$html.='sys_const_qx===='           .$row[ 'sys_const_qx' ].'$_=nZζPξz=_$';
		$html.='sys_const_pagetype===='     .$row[ 'sys_const_pagetype' ].'$_=nZζPξz=_$';
		$html.='sys_const_page===='         .$row[ 'sys_const_page' ].'$_=nZζPξz=_$';             //当前页码    
		$html.='sys_const_big_id===='       .$row[ 'sys_const_big_id' ].'$_=nZζPξz=_$';
		$html.='sys_const_px_name===='      .$row[ 'sys_const_px_name' ].'$_=nZζPξz=_$';
		$html.='sys_const_pxv===='          .$row[ 'sys_const_pxv' ].'$_=nZζPξz=_$'; 
		$html.='sys_const_pok===='          .$row[ 'sys_const_pok' ].'$_=nZζPξz=_$';              //排序
		$html.='zu===='                     .$row[ 'sys_const_zu' ].'$_=nZζPξz=_$';               //分类
		$html.='zd===='                     .$row[ 'sys_const_zd' ].'$_=nZζPξz=_$';               //字段
		$html.='ShaiXuanSql_other===='      .$row[ 'sys_const_ShaiXuanSql_other' ].'';     //

	}
	echo $html;
}
function BiaoQian_look() { //标签对比
	global  $connect,$hy;
	
	//$sys_const_keyword=$_REQUEST[ 'sys_const_keyword' ];
	$sys_const_id_bumen=$_REQUEST[ 'sys_const_id_bumen' ];
	$sys_const_bh=$_REQUEST[ 'sys_const_bh' ];
	$sys_shenpi=$_REQUEST[ 'sys_shenpi' ];                                        //审核人
	$sys_shenpi_all=$_REQUEST[ 'sys_shenpi_all' ];                                //批准人
	$sys_chaosong=$_REQUEST[ 'sys_chaosong' ];                                    //经办人
	
	$sys_const_adddate=$_REQUEST[ 'sys_const_adddate' ];
	$re_id=$_REQUEST[ 're_id' ];
	$sys_const_zu=$_REQUEST[ 'sys_const_zu' ];
	$ShaiXuanSql_other=$_REQUEST[ 'ShaiXuanSql_other' ];
	
		 
	if( ($sys_const_id_bumen=='0' or $sys_const_id_bumen=='') and ($sys_const_bh=='' or $sys_const_bh=='0') and ($sys_shenpi=='' or $sys_shenpi=='0')  and ($sys_shenpi_all=='' or $sys_shenpi_all=='0')  and ($sys_chaosong=='' or $sys_chaosong=='0')  and ($sys_const_adddate=='0' or $sys_const_adddate=='') and ($sys_const_zu=='0' or $sys_const_zu=='') and ($ShaiXuanSql_other=='0' or $ShaiXuanSql_other=='' ) ){
		$id=-1;
	}else{
		//--------------------------------------------------------------------------查询到数据
	    $sql = "select * From `sys_biaoqian` where ";
	    //$sql.='sys_const_keyword = \''          .$sys_const_keyword.'\' and ';    //关键词                     
	  
		$sql.=" sys_const_id_bumen = '$sys_const_id_bumen' and ";                   //部门
		if($sys_const_bh==''){
			$sql.=" (sys_const_bh = '' or sys_const_bh is NULL) and ";              //编制人
		}else{
			$sql.=" sys_const_bh = '$sys_const_bh' and ";                
		}
		if($sys_shenpi==''){
			$sql.=" (sys_const_shenpi = '' or sys_const_shenpi is NULL) and ";      //审核人
		}else{
			$sql.=" sys_const_shenpi = '$sys_shenpi' and ";                
		}
		
		if($sys_shenpi_all==''){
			$sql.=" (sys_const_shenpi_all = '' or sys_const_shenpi_all is NULL) and ";     //批准人
		}else{
			$sql.=" sys_const_shenpi_all = '$sys_shenpi_all' and ";                
		}
		
		if($sys_chaosong==''){
			$sql.=" (sys_const_chaosong = '' or sys_const_chaosong is NULL) and ";     //经办人
		}else{
			$sql.=" sys_const_chaosong = '$sys_chaosong' and ";                
		}
		if($sys_const_adddate==''){
			$sql.=" (sys_const_adddate = '' or sys_const_adddate is NULL) and ";     //添加或更新时间
		}else{
			$sql.=" sys_const_adddate = '$sys_const_adddate' and ";                
		}
		
		$sql.='sys_const_re_id = \''            .$re_id.'\' and ';                 //re_id 这里不能开启
		$sql.='sys_const_zu = \''               .$sys_const_zu.'\' and ';          //分类
		$sql.='sys_const_ShaiXuanSql_other = \''.$ShaiXuanSql_other.'\' and ';     //
		$sql.='sys_yfzuid = \''.$hy.'\'';                                          //
	    //echo $sql;
	    $rs = $connect -> query($sql);
	    $row = mysqli_fetch_array( $rs['result'] );
	    $id=$row['id'];
	}
	echo $id;
	
}

function BiaoQian_change() { //标签加载
	global  $connect,$hy;
    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                            //j显示页面
	if ( isset( $_REQUEST[ 'id' ] ) ){$id = $_REQUEST[ 'id' ];}else{$id = 0;};                                                                    //id
	
	//--------------------------------------------------------------------------查询到数据
	if($id > 0){
	    $sql = "select * From `sys_biaoqian` where id='$id' ";
		// echo $sql;
		$rs = $connect -> query($sql);
		$row = mysqli_fetch_array( $rs['result'] );
		// $id = $row[ 'id' ];                                                          //ID
		$html ='sys_const_biaoqian_id===='  .$id.'$_=nZζPξz=_$';                                  //标签id
	    $html.='keyword===='                .$row[ 'sys_const_keyword' ].'$_=nZζPξz=_$';          //关键词
	    //$html.='sys_const_company_id===='   .$row[ 'sys_const_company_id' ].'$_=nZζPξz=_$';     //公司id                      
		$html.='sys_const_id_bumen===='     .$row[ 'sys_const_id_bumen' ].'$_=nZζPξz=_$';         //部门
		$html.='sys_const_hy===='           .$row[ 'sys_const_hy' ].'$_=nZζPξz=_$';               //会员      
		$html.='sys_const_bh===='           .$row[ 'sys_const_bh' ].'$_=nZζPξz=_$';               //编制人
		$html.='sys_const_shenpi===='       .$row[ 'sys_const_shenpi' ].'$_=nZζPξz=_$';           //审核人
		$html.='sys_const_shenpi_all===='   .$row[ 'sys_const_shenpi_all' ].'$_=nZζPξz=_$';       //批准人
		$html.='sys_const_chaosong===='     .$row[ 'sys_const_chaosong' ].'$_=nZζPξz=_$';         //经办人
		
		$html.='sys_const_adddate===='      .$row[ 'sys_const_adddate' ].'$_=nZζPξz=_$';          //添加或更新时间
		$html.='sys_const_qx===='           .$row[ 'sys_const_qx' ].'$_=nZζPξz=_$';
		$html.='sys_const_pagetype===='     .$row[ 'sys_const_pagetype' ].'$_=nZζPξz=_$';
		$html.='sys_const_page===='         .$row[ 'sys_const_page' ].'$_=nZζPξz=_$';             //当前页码    
		//$html.='sys_const_re_id===='      .$row[ 'sys_const_re_id' ].'$_=nZζPξz=_$';            //re_id 这里不能开启
		$html.='sys_const_big_id===='       .$row[ 'sys_const_big_id' ].'$_=nZζPξz=_$';
		//$html.='sys_const_huis===='         .$row[ 'sys_const_huis' ].'$_=nZζPξz=_$';             //回收
		$html.='sys_const_px_name===='      .$row[ 'sys_const_px_name' ].'$_=nZζPξz=_$';
		$html.='sys_const_pxv===='          .$row[ 'sys_const_pxv' ].'$_=nZζPξz=_$'; 
		$html.='sys_const_pok===='          .$row[ 'sys_const_pok' ].'$_=nZζPξz=_$';              //排序
		//$html.='sys_const_tuodongok===='    .$row[ 'sys_const_tuodongok' ].'$_=nZζPξz=_$';
		//$html.='sys_const_s_h===='          .$row[ 'sys_const_s_h' ].'$_=nZζPξz=_$';
		//$html.='sys_const_q_h===='          .$row[ 'sys_const_q_h' ].'$_=nZζPξz=_$';
		//$html.='sys_const_c_ok===='         .$row[ 'sys_const_c_ok' ].'$_=nZζPξz=_$';
		//$html.='sys_const_b_ok===='         .$row[ 'sys_const_b_ok' ].'$_=nZζPξz=_$';
		//$html.='sys_const_C_xu_now===='     .$row[ 'sys_const_C_xu_now' ].'$_=nZζPξz=_$';
		//$html.='sys_const_Start_Suoding===='.$row[ 'sys_const_Start_Suoding' ].'$_=nZζPξz=_$';
		//$html.='sys_const_End_Suoding===='  .$row[ 'sys_const_End_Suoding' ].'$_=nZζPξz=_$';
		//$html.='sys_const_prev_zd===='      .$row[ 'sys_const_prev_zd' ].'$_=nZζPξz=_$';
		//$html.='sys_const_ChangePrev_zd===='.$row[ 'sys_const_ChangePrev_zd' ].'$_=nZζPξz=_$';
		//$html.='sys_const_ChangeNext_zd===='.$row[ 'sys_const_ChangeNext_zd' ].'$_=nZζPξz=_$';    //        
		//$html.='sys_const_this_zd===='      .$row[ 'sys_const_this_zd' ].'$_=nZζPξz=_$';          //
		$html.='zu===='                     .$row[ 'sys_const_zu' ].'$_=nZζPξz=_$';               //分类
		$html.='zd===='                     .$row[ 'sys_const_zd' ].'$_=nZζPξz=_$';               //字段  
		$html.='ShaiXuanSql_other===='      .$row[ 'sys_const_ShaiXuanSql_other' ].''; //
		//$html.='sys_const_ShaiXuanSql_ALL===='.$sys_const_ShaiXuanSql_ALL.';

	}
	echo $html;
}

function content_right_menu() { //分类下拉
	global  $connect,$hy,$ToHtmlID,$databiao,$zu,$sys_id_bumen,$sys_adddate,$re_id,$big_id,$strmk_id,$nowzu,$px_ziduan,$px_ziduan,$zd,$pxv,$pok,$huis,$nowkeyword,$page,$ShaiXuanSql,$ShaiXuanSql_other;
	$rs = $sql = $rsArray = $now_id = $now_lname1 =$zu_menuimg_id_bumen=$zu_menuimg_id_login=$zu_menuimg_adddate= '';
	//------------------------识别是否为页中页
	if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";	};//关系列id
    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                            //j显示页面
	
	if ( isset( $_REQUEST[ 'zu' ] ) ){$nowzu = $_REQUEST[ 'zu' ];}else{$nowzu = 0;};                                                                          //zu
	if ( isset( $_REQUEST[ 'sys_id_bumen' ] ) ){$sys_id_bumen = $_REQUEST[ 'sys_id_bumen' ];}else{$sys_id_bumen = 0;};                                        //sys_id_bumen
	
	if ( isset( $_REQUEST[ 'bh' ] ) ){$bh = $_REQUEST[ 'bh' ];}else{$bh = 0;};                                                                                //编制人
	if ( isset( $_REQUEST[ 'sys_shenpi' ] ) ){$sys_shenpi = $_REQUEST[ 'sys_shenpi' ];}else{$sys_shenpi = 0;};                                                //审核人
	if ( isset( $_REQUEST[ 'sys_shenpi_all' ] ) ){$sys_shenpi_all = $_REQUEST[ 'sys_shenpi_all' ];}else{$sys_shenpi_all = 0;};                                //批准人
	if ( isset( $_REQUEST[ 'sys_chaosong' ] ) ){$sys_chaosong = $_REQUEST[ 'sys_chaosong' ];}else{$sys_chaosong = 0;};                                        //经办人
	
	if ( isset( $_REQUEST[ 'sys_adddate' ] ) ){$sys_adddate = $_REQUEST[ 'sys_adddate' ];}else{$sys_adddate = 0;};                                            //是否为回收
	if ( isset( $_REQUEST[ 'ed_id' ] ) ){$ed_id = $_REQUEST[ 'ed_id' ];}else{$ed_id = 0;};                                                                    //ed_id
	if ( isset( $_REQUEST[ 'ShaiXuanSql_other' ] ) ){$sys_const_ShaiXuanSql_other = $_REQUEST[ 'ShaiXuanSql_other' ];};                                       //其它
	if ( isset( $_REQUEST[ 'sys_const_biaoqian_id' ] ) ){$sys_const_biaoqian_id = $_REQUEST[ 'sys_const_biaoqian_id' ];};                                     //标签id
    
	//--------------------------------------------------------------------------查询到数据
	
	if($ed_id > 0){
	    $sql = "select * From `sys_biaoqian` where id='$ed_id' ";
		//echo $sql;
		$rs = $connect -> query($sql);
		$row = mysqli_fetch_array( $rs['result'] );
	    $bh = $row[ 'sys_const_bh' ];                                              //编制人 9001
		$sys_shenpi = $row[ 'sys_const_shenpi' ];                                  //审核人
		$sys_shenpi_all = $row[ 'sys_const_shenpi_all' ];                          //批准人
		$sys_chaosong = $row[ 'sys_const_chaosong' ];                              //经办人

	    $sys_id_bumen = $row[ 'sys_const_id_bumen' ];                              //sys_id_bumen
	    $nowzu = $row[ 'sys_const_zu' ];                                           //nowzu
	    $sys_adddate = $row[ 'sys_const_adddate' ];                                //sys_adddate
		$sys_const_ShaiXuanSql_other = $row[ 'sys_const_ShaiXuanSql_other' ];      //ShaiXuanSql_other
		$nowclosedclick='$(this).parents(".rightmenu").hide(500)';
	}else{
		$nowclosedclick='$(this).parents("#'.$ToHtmlID.'_content_right_menu").hide(500)';
	}
	
	echo( "<div class='right' ed_id='$ed_id'>" );
	echo "<li name='sys_id_zu' class='shadowdiv overli clearboth headmenuhead nocopytext' ondblclick='$nowclosedclick' >筛选<i class=\"fa fa-del-mini fa_margrin_right\" style='margin-right:20px' onclick='".$nowclosedclick."'>&nbsp;</i></li>";
	//-------------------------------------------------------------------------------- 分类
	if($nowzu>0){$nowimg='<i class="fa fa-25-02"></i>';	}else{$nowimg='<i class="fa fa-21-1"></i>';	};
	echo( "<li name='sys_id_zu' class='shadowdiv overli clearboth headmenu' ><font class='cols01'>$nowimg</font>" );
	echo content_right_menu_data('sys_id_zu',$re_id , $ed_id); 
	echo"<img src='../images/xiala.gif' /></li>";
	//-------------------------------------------------------------------------------- 部门
	if($sys_id_bumen!='0' && $sys_id_bumen!=''){$nowimg='<i class="fa fa-25-02"></i>';	}else{$nowimg='<i class="fa fa-21-1"></i>';	};
	echo( "<li name='sys_id_bumen' class='shadowdiv overli clearboth headmenu' ><font class='cols01'>$nowimg</font>" );
	echo content_right_menu_data('sys_id_bumen',$re_id, $ed_id);
	echo"<img src='../images/xiala.gif' /></li>";
	//-------------------------------------------------------------------------------- 编制人
	if($bh != 0 && $bh != ''){$nowimg='<i class="fa fa-25-02"></i>';}else{$nowimg='<i class="fa fa-21-1"></i>';	};
	echo( "<li name='sys_id_login' class='shadowdiv overli clearboth headmenu' ><font class='cols01'>$nowimg</font><strong>编制人：</strong>" );
	echo content_right_menu_data('sys_id_login',$re_id, $ed_id);
	echo"<img src='../images/xiala.gif' /></li>";
	//-------------------------------------------------------------------------------- 审核人
	if($sys_shenpi != 0 && $sys_shenpi != ''){$nowimg='<i class="fa fa-25-02"></i>';}else{$nowimg='<i class="fa fa-21-1"></i>';	};
	echo( "<li name='sys_shenpi' class='shadowdiv overli clearboth headmenu' ><font class='cols01'>$nowimg</font><strong>审核人：</strong>" );
	echo content_right_menu_data('sys_shenpi',$re_id, $ed_id);
	echo"<img src='../images/xiala.gif' /></li>";
	//-------------------------------------------------------------------------------- 批准人
	if($sys_shenpi_all != 0 && $sys_shenpi_all != ''){$nowimg='<i class="fa fa-25-02"></i>';}else{$nowimg='<i class="fa fa-21-1"></i>';	};
	echo( "<li name='sys_shenpi_all' class='shadowdiv overli clearboth headmenu' ><font class='cols01'>$nowimg</font><strong>批准人：</strong>" );
	echo content_right_menu_data('sys_shenpi_all',$re_id, $ed_id);
	echo"<img src='../images/xiala.gif' /></li>";
	//-------------------------------------------------------------------------------- 经办人
	if($sys_chaosong != 0 && $sys_chaosong != ''){$nowimg='<i class="fa fa-25-02"></i>';}else{$nowimg='<i class="fa fa-21-1"></i>';	};
	echo( "<li name='sys_chaosong' class='shadowdiv overli clearboth headmenu' ><font class='cols01'>$nowimg</font><strong>经办人：</strong>" );
	echo content_right_menu_data('sys_chaosong',$re_id, $ed_id);
	echo"<img src='../images/xiala.gif' /></li>";
	//-------------------------------------------------------------------------------- 时间
	if($sys_adddate!='' && $sys_adddate!='0' ){$nowimg='<i class="fa fa-25-02"></i>';	}else{$nowimg='<i class="fa fa-21-1"></i>';	};
	echo( "<li name='sys_adddate' title='$sys_adddate' class='shadowdiv overli clearboth headmenu' ><font class='cols01'>$nowimg</font>" );
	echo content_right_menu_data('sys_adddate',$re_id, $ed_id);
	echo"<img src='../images/xiala.gif' /></li>";
	//-------------------------------------------------------------------------------- 其它
	if($sys_const_ShaiXuanSql_other!=''){$nowimg='<i class="fa fa-25-02"></i>';	}else{$nowimg='<i class="fa fa-21-1"></i>';	};
	echo( "<li name='sys_other' class='shadowdiv overli clearboth headmenu' onclick=\"zuchange_menu(this,'$ToHtmlID')\"><font class='cols01'>$nowimg</font><strong>其&nbsp;&nbsp;&nbsp;它：</strong><img src='../images/xiala.gif' />" );
	echo"</li>";
	echo content_right_menu_data('sys_other',$re_id, $ed_id);               

	echo( "</div>" );
	//-------------------------------------------------------------------------------- 下方菜单
	if($ed_id == 0){
	   echo( "<ul class='foot'>" );
	   echo( "<a id='-1' class='shadowdiv shadowadddiv' onclick=\"xialaclose(this,'$ToHtmlID')\" >⊗&nbsp;关闭&nbsp;&nbsp;</a>" );
	   echo( "<a id='-2' class='shadowdiv shadowadddiv clear' onclick=\"clearsearch(this,'$ToHtmlID')\" >↯&nbsp;清除筛选&nbsp;&nbsp;</a>" );
	   //echo( "<a id='-3'  name='sys_suqian' class='shadowdiv shadowadddiv' onclick=\"zuchange_menu(this,'$ToHtmlID')\" ><i  class='fa fa-sitting-ziduan'></i>书签&nbsp;&nbsp;</a>" );
	   echo( "</ul>" );
	}
	/*
	zuchange_menu(this,'DeskMenuDiv321')
	*/
	//echo( "</ul>" );
	
	
};

function content_right_menu_data($menu,$re_id,$id=0) { //分类下拉数据
	global $connect,$db,$hy,$ToHtmlID,$databiao,$zu,$sys_id_bumen,$sys_adddate,$re_id,$big_id,$strmk_id,$nowzu,$px_ziduan,$px_ziduan,$zd,$pxv,$pok,$huis,$nowkeyword,$page,$ShaiXuanSql,$ShaiXuanSql_other,$sys_const_ShaiXuanSql_other,$bh;
	//------------------------识别是否为页中页
	if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";	};//关系列id
    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                            //j显示页面
	
	if ( isset( $_REQUEST[ 'zu' ] ) ){$nowzu = $_REQUEST[ 'zu' ];}else{$nowzu = 0;};                                                                          //zu
	if ( isset( $_REQUEST[ 'sys_id_bumen' ] ) ){$sys_id_bumen = $_REQUEST[ 'sys_id_bumen' ];}else{$sys_id_bumen = 0;};                                        //sys_id_bumen
	
	if ( isset( $_REQUEST[ 'bh' ] ) ){$bh = $_REQUEST[ 'bh' ];}else{$bh = 0;};                                                                                //编制人
	if ( isset( $_REQUEST[ 'sys_shenpi' ] ) ){$sys_shenpi = $_REQUEST[ 'sys_shenpi' ];}else{$sys_shenpi = 0;};                                                //审核人
	if ( isset( $_REQUEST[ 'sys_shenpi_all' ] ) ){$sys_shenpi_all = $_REQUEST[ 'sys_shenpi_all' ];}else{$sys_shenpi_all = 0;};                                //批准人
	if ( isset( $_REQUEST[ 'sys_chaosong' ] ) ){$sys_chaosong = $_REQUEST[ 'sys_chaosong' ];}else{$sys_chaosong = 0;};                                        //经办人
	
	if ( isset( $_REQUEST[ 'sys_adddate' ] ) ){$sys_adddate = $_REQUEST[ 'sys_adddate' ];}else{$sys_adddate = 0;};                                            //是否为回收
	if ( isset( $_REQUEST[ 'ed_id' ] ) ){$ed_id = $_REQUEST[ 'ed_id' ];}else{$ed_id = 0;};                                                                    //ed_id
	if ( isset( $_REQUEST[ 'ShaiXuanSql_other' ] ) ){$sys_const_ShaiXuanSql_other = $_REQUEST[ 'ShaiXuanSql_other' ];};                                       //其它
	//--------------------------------------------------------------------------查询到数据
	if($id>0){
	    $sql = "select * From `sys_biaoqian` where id='$id' ";
		//echo $sql;
		$rs = $connect -> query($sql);
		$row = mysqli_fetch_array( $rs['result'] );
		$id = $row[ 'id' ];                                                        //ID
		$sys_name = $row[ 'sys_name' ];                                            //标签名称
	    $bh = $row[ 'sys_const_bh' ];                                              //编制人
		$sys_shenpi = $row[ 'sys_const_shenpi' ];                                  //审核人
		$sys_shenpi_all = $row[ 'sys_const_shenpi_all' ];                          //批准人
		$sys_chaosong = $row[ 'sys_const_chaosong' ];                              //经办人
		
	    $sys_id_bumen = $row[ 'sys_const_id_bumen' ];                              //sys_id_bumen
	    $nowzu = $row[ 'sys_const_zu' ];                                           //nowzu
	    $sys_adddate = $row[ 'sys_const_adddate' ];                                //sys_adddate
		$sys_const_ShaiXuanSql_other = $row[ 'sys_const_ShaiXuanSql_other' ];      //sys_const_ShaiXuanSql_other
	}else{
		
	}
	//-------------------------------------------------------------------------- 分类
	if($menu=='sys_id_zu'){
		echo "<strong>分&nbsp;&nbsp;&nbsp;类：</strong><select   onchange=\"zuchange(this,'$ToHtmlID')\" >";
		  echo "<option value=\"0\">所有分类</option>";
		  $sql = 'select id,lname1 From Sys_ZuAll where sys_yfzuid=' . $hy . ' and tableid=' . $re_id . ' and sys_huis <> 1 order by sys_paixu Asc';
	      $rs = $connect -> query($sql);
	      //$recordcount=mysqli_num_rows($rs);//得到总数 无用
	      while ( $row = mysqli_fetch_array( $rs['result'] ) ) {
		      $now_id = $row[ 'id' ];
		      $now_lname1 = $row[ 'lname1' ];
			  if($nowzu==$now_id){
				  $menucheckded='selected';
			  }else{
				  $menucheckded='';
				 
			  };
			  echo "<option value=\"$now_id\" $menucheckded>$now_lname1</option>";
	      };
		  echo "<option value=\"-1\"> + 添加</option>";
		echo "</select>";
	//-------------------------------------------------------------------------- 部门
	}else if($menu=='sys_id_bumen'){
		echo "<strong>部&nbsp;&nbsp;&nbsp;门：</strong><select name='{$menu}'  id='{$menu}' onchange=\"zuchange(this,'$ToHtmlID')\" class=\"addboxinput inputfocus\">";
		  echo "<option value=\"0\">所有部门</option>";
		  $sql = "select * From `msc_bumenlist` where sys_yfzuid='$hy' and sys_huis <> 1 order by id Asc";
	      $rs = $db -> query($sql);
	      //$recordcount=mysqli_num_rows($rs);//得到总数 无用
	      while ( $row = mysqli_fetch_array( $rs['result'] ) ) {
		      $id = $row[ 'id' ];
		      $bumenname = $row[ 'bumenname' ];
			  if($sys_id_bumen==$id){
				  $menucheckded='selected';
			  }else{
				  $menucheckded='';
				 
			  };
			  echo "<option value=\"$id\" $menucheckded>$bumenname</option>";
	      };
		  //echo "<option value=\"-1\"> + 添加</option>";
		echo "</select>";
	//-------------------------------------------------------------------------- 编制人	
	}else if($menu=='sys_id_login'){
		if ( isset( $_REQUEST[ 'bh' ] ) ){$sys_id_login = $_REQUEST[ 'bh' ];}else{$sys_id_login = 0;}; 
		echo "<select  name='{$menu}'  id='{$menu}' onchange=\"zuchange(this,'$ToHtmlID')\" class=\"addboxinput inputfocus\">";
		  echo "<option value=\"0\">所有职员</option>";
		  $sql = "select * From `msc_user_reg` where sys_yfzuid='$hy' and sys_huis <> 1 order by id Asc";
	      $rs = $db -> query($sql);
	      //$recordcount=mysqli_num_rows($rs);//得到总数 无用
	      while ( $row = mysqli_fetch_array( $rs['result'] ) ) {
		      $id = $row[ 'id' ];
		      $SYS_UserName = $row[ 'SYS_UserName' ]; //职位名称
			  $SYS_GongHao = $row[ 'SYS_GongHao' ];   //职位名称
			  if($sys_id_login==$SYS_GongHao){
				  $menucheckded='selected';
			  }else{
				  $menucheckded='';
			  };
			  echo "<option value=\"$SYS_GongHao\" $menucheckded>{$SYS_UserName}（{$SYS_GongHao}）</option>";
	      };
		  //echo "<option value=\"-1\"> + 添加</option>";
		echo "</select>";
	//-------------------------------------------------------------------------- 审核人
	}else if($menu=='sys_shenpi'){
		if ( isset( $_REQUEST[ 'sys_shenpi' ] ) ){$sys_shenpi = $_REQUEST[ 'sys_shenpi' ];}else{$sys_shenpi ='';}; 
		echo "<select  name='{$menu}'  id='{$menu}' onchange=\"zuchange(this,'$ToHtmlID')\" class=\"addboxinput inputfocus\">";
		  echo "<option value=\"0\">所有职员</option>";
		  $sql = "select * From `msc_user_reg` where sys_yfzuid='$hy' and sys_huis <> 1 order by id Asc";
	      $rs = $db -> query($sql);
	      //$recordcount=mysqli_num_rows($rs);//得到总数 无用
	      while ( $row = mysqli_fetch_array( $rs['result'] ) ) {
		      $id = $row[ 'id' ];
		      $SYS_UserName = $row[ 'SYS_UserName' ]; //职位名称
			  $SYS_GongHao = $row[ 'SYS_GongHao' ]; //职位名称
			  if($sys_shenpi==$SYS_GongHao){
				  $menucheckded='selected';
			  }else{
				  $menucheckded='';
			  };
			  echo "<option value=\"$SYS_GongHao\" $menucheckded>{$SYS_UserName}（{$SYS_GongHao}）</option>";
	      };
		  //echo "<option value=\"-1\"> + 添加</option>";
		echo "</select>";
	//-------------------------------------------------------------------------- 批准人
	}else if($menu=='sys_shenpi_all'){
		if ( isset( $_REQUEST[ 'sys_shenpi_all' ] ) ){$sys_shenpi_all = $_REQUEST[ 'sys_shenpi_all' ];}else{$sys_shenpi_all = 0;}; 
		echo "<select  name='{$menu}'  id='{$menu}' onchange=\"zuchange(this,'$ToHtmlID')\" class=\"addboxinput inputfocus\">";
		  echo "<option value=\"0\">所有职员</option>";
		  $sql = "select * From `msc_user_reg` where sys_yfzuid='$hy' and sys_huis <> 1 order by id Asc";
	      $rs = $db -> query($sql);
	      //$recordcount=mysqli_num_rows($rs);//得到总数 无用
	      while ( $row = mysqli_fetch_array( $rs['result'] ) ) {
		      $id = $row[ 'id' ];
		      $SYS_UserName = $row[ 'SYS_UserName' ]; //职位名称
			  $SYS_GongHao = $row[ 'SYS_GongHao' ]; //职位名称
			  if($sys_shenpi_all==$SYS_GongHao){
				  $menucheckded='selected';
			  }else{
				  $menucheckded='';
			  };
			  echo "<option value=\"$SYS_GongHao\" $menucheckded>{$SYS_UserName}（{$SYS_GongHao}）</option>";
	      };
		  //echo "<option value=\"-1\"> + 添加</option>";
		echo "</select>";
	//-------------------------------------------------------------------------- 经办人
	}else if($menu=='sys_chaosong'){
		if ( isset( $_REQUEST[ 'sys_chaosong' ] ) ){$sys_chaosong = $_REQUEST[ 'sys_chaosong' ];}else{$sys_chaosong = 0;}; 
		echo "<select  name='{$menu}'  id='{$menu}' onchange=\"zuchange(this,'$ToHtmlID')\" class=\"addboxinput inputfocus\">";
		  echo "<option value=\"0\">所有职员</option>";
		  $sql = "select * From `msc_user_reg` where sys_yfzuid='$hy' and sys_huis <> 1 order by id Asc";
	      $rs = $db -> query($sql);
	      //$recordcount=mysqli_num_rows($rs);//得到总数 无用
	      while ( $row = mysqli_fetch_array( $rs['result'] ) ) {
		      $id = $row[ 'id' ];
		      $SYS_UserName = $row[ 'SYS_UserName' ]; //职位名称
			  $SYS_GongHao = $row[ 'SYS_GongHao' ]; //职位名称
			  if($sys_chaosong==$SYS_GongHao){
				  $menucheckded='selected';
			  }else{
				  $menucheckded='';
			  };
			  echo "<option value=\"$SYS_GongHao\" $menucheckded>{$SYS_UserName}（{$SYS_GongHao}）</option>";
	      };
		  //echo "<option value=\"-1\"> + 添加</option>";
		echo "</select>";
	//-------------------------------------------------------------------------- 添加时间
	}else if($menu=='sys_adddate'){
		  echo "<strong>时&nbsp;&nbsp;&nbsp;间：</strong><select  name='{$menu}'  id='{$menu}' onchange=\"zuchange(this,'$ToHtmlID')\" class=\"addboxinput inputfocus\">";
		  echo "<option value=\"0\">所有时间</option>";
		  echo "<option value=\"0\" disabled=\"disabled\">添加时间</option>";

		$menucheckded="";
		if($sys_adddate==''){$menucheckded='selected';};
		    //------------------------------------------------------------------------------------------------------天
		if($sys_adddate=='to_days(sys_adddate) = to_days(now())'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value=\"to_days(sys_adddate) = to_days(now())\" $menucheckded>|-今天（添加）</option>";   
		if($sys_adddate=='TO_DAYS(NOW())-TO_DAYS(sys_adddate)=1'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value=\"TO_DAYS(NOW())-TO_DAYS(sys_adddate)=1\" $menucheckded>|-昨天（添加）</option>";
		if($sys_adddate=='DATE_SUB(CURDATE(),INTERVAL 7 DAY)<=date(sys_adddate)'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value=\"DATE_SUB(CURDATE(),INTERVAL 7 DAY)<=date(sys_adddate)\" $menucheckded>|-昨天（添加）</option>";
		if($sys_adddate=='DATE_SUB(CURDATE(),INTERVAL 30 DAY)<=date(sys_adddate)'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value=\"DATE_SUB(CURDATE(),INTERVAL 30 DAY)<=date(sys_adddate)\" $menucheckded>|-近30天（添加）</option>";
		    //------------------------------------------------------------------------------------------------------周
		if($sys_adddate=='YEARWEEK(date_format(sys_adddate,"%Y-%m-%d")) = YEARWEEK(now())'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value='YEARWEEK(date_format(sys_adddate,\"%Y-%m-%d\")) = YEARWEEK(now())' $menucheckded>|-本周（添加）</option>";
		if($sys_adddate=='YEARWEEK(date_format(sys_adddate,"%Y-%m-%d")) = YEARWEEK(now())-1'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value='YEARWEEK(date_format(sys_adddate,\"%Y-%m-%d\")) = YEARWEEK(now())-1' $menucheckded>|-上周（添加）</option>";
		    //------------------------------------------------------------------------------------------------------月
		if($sys_adddate=='DATE_FORMAT(sys_adddate,"%Y%m") = DATE_FORMAT(CURDATE(),"%Y%m")'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value='DATE_FORMAT(sys_adddate,\"%Y%m\") = DATE_FORMAT(CURDATE(),\"%Y%m\")' $menucheckded>|-本月（添加）</option>";
		if($sys_adddate=='PERIOD_DIFF(date_format(now(),"%Y%m"),date_format(sys_adddate,"%Y%m"))=1'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value='PERIOD_DIFF(date_format(now(),\"%Y%m\"),date_format(sys_adddate,\"%Y%m\"))=1' $menucheckded>|-上月（添加）</option>";
		    //------------------------------------------------------------------------------------------------------季
		if($sys_adddate=='QUARTER(sys_adddate)=QUARTER(now())'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value='QUARTER(sys_adddate)=QUARTER(now())' $menucheckded>|-本季度（添加）</option>";
		if($sys_adddate=='QUARTER(sys_adddate)=QUARTER(DATE_SUB(now(),interval 1 QUARTER))'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value='QUARTER(sys_adddate)=QUARTER(DATE_SUB(now(),interval 1 QUARTER))' $menucheckded>|-上季度（添加）</option>";
		    //------------------------------------------------------------------------------------------------------年
		if($sys_adddate=='sys_adddate between date_sub(now(),interval 6 month) and now()'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value='sys_adddate between date_sub(now(),interval 6 month) and now()' $menucheckded>|-半年（添加）</option>";
		if($sys_adddate=='YEAR(sys_adddate)=YEAR(NOW())'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value='YEAR(sys_adddate)=YEAR(NOW())' $menucheckded>|-本年（添加）</option>";
		if($sys_adddate=='year(sys_adddate)=year(date_sub(now(),interval 1 year))'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value='year(sys_adddate)=year(date_sub(now(),interval 1 year))' $menucheckded>|-上年（添加）</option>";
		echo "<option value=\"0\" disabled=\"disabled\">更新时间</option>";
		    //------------------------------------------------------------------------------------------------------天
		if($sys_adddate=='to_days(sys_adddate_g) = to_days(now())'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value='to_days(sys_adddate_g) = to_days(now())' $menucheckded>|-今天（更新）</option>";
		if($sys_adddate=='TO_DAYS(NOW())-TO_DAYS(sys_adddate_g)=1'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value='TO_DAYS(NOW())-TO_DAYS(sys_adddate_g)=1' $menucheckded>|-昨天（更新）</option>";
		if($sys_adddate=='DATE_SUB(CURDATE(),INTERVAL 7 DAY)<=date(sys_adddate_g)'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value='DATE_SUB(CURDATE(),INTERVAL 7 DAY)<=date(sys_adddate_g)' $menucheckded>|-近7天（更新）</option>";
		if($sys_adddate=='DATE_SUB(CURDATE(),INTERVAL 30 DAY)<=date(sys_adddate_g)'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value='DATE_SUB(CURDATE(),INTERVAL 30 DAY)<=date(sys_adddate_g)' $menucheckded>|-近30天（更新）</option>";
		    //------------------------------------------------------------------------------------------------------周
		if($sys_adddate=='YEARWEEK(date_format(sys_adddate_g,"%Y-%m-%d")) = YEARWEEK(now())'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value='YEARWEEK(date_format(sys_adddate_g,\"%Y-%m-%d\")) = YEARWEEK(now())' $menucheckded>|-本周（更新）</option>";
		if($sys_adddate=='YEARWEEK(date_format(sys_adddate_g,"%Y-%m-%d")) = YEARWEEK(now())-1'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value='YEARWEEK(date_format(sys_adddate_g,\"%Y-%m-%d\")) = YEARWEEK(now())-1' $menucheckded>|-上周（更新）</option>";
		    //------------------------------------------------------------------------------------------------------月
		if($sys_adddate=='DATE_FORMAT(sys_adddate_g,"%Y%m") = DATE_FORMAT(CURDATE(),"%Y%m")'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value='DATE_FORMAT(sys_adddate_g,\"%Y%m\") = DATE_FORMAT(CURDATE(),\"%Y%m\")' $menucheckded>|-本月（更新）</option>";
		if($sys_adddate=='PERIOD_DIFF(date_format(now(),"%Y%m"),date_format(sys_adddate_g,"%Y%m"))=1'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value='PERIOD_DIFF(date_format(now(),\"%Y%m\"),date_format(sys_adddate_g,\"%Y%m\"))=1' $menucheckded>|-上月（更新）</option>";
		    //------------------------------------------------------------------------------------------------------季
		if($sys_adddate=='QUARTER(sys_adddate_g)=QUARTER(now())'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value='QUARTER(sys_adddate_g)=QUARTER(now())' $menucheckded>|-本季度（更新）</option>";
		
		if($sys_adddate=='QUARTER(sys_adddate_g)=QUARTER(DATE_SUB(now(),interval 1 QUARTER))'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value='QUARTER(sys_adddate_g)=QUARTER(DATE_SUB(now(),interval 1 QUARTER))' $menucheckded>|-上季度（更新）</option>";
		    //------------------------------------------------------------------------------------------------------年
		
		if($sys_adddate=='sys_adddate_g between date_sub(now(),interval 6 month) and now()'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value='sys_adddate_g between date_sub(now(),interval 6 month) and now()' $menucheckded>|-半年（更新）</option>";
		
		if($sys_adddate=='YEAR(sys_adddate_g)=YEAR(NOW())'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value='YEAR(sys_adddate_g)=YEAR(NOW())' $menucheckded>|-本年（更新）</option>";
		
		if($sys_adddate=='year(sys_adddate_g)=year(date_sub(now(),interval 1 year))'){$menucheckded='selected';}else{$menucheckded='';};
		    echo "<option value='year(sys_adddate_g)=year(date_sub(now(),interval 1 year))' $menucheckded>|-上年（更新）</option>";
		
		echo "</select>";
		
	//-------------------------------------------------------------------------- 其它
	}else if($menu=='sys_other'){
		
		
		if($sys_const_ShaiXuanSql_other!=''){
			$menucheckded='menucheckded';
			$zu_menuimg="<i class='fa fa-gou fa_margrin_right'></i>";
		}else{
			$menucheckded='';
			$zu_menuimg="";
		};
		echo( "<ul id='sys_other' style='display:none;'>" );
		echo( "<li id='0' tit='所有字段' class='shadowdiv shadowadddiv clearboth $menucheckded'  onclick=\"zuchange(this,'$ToHtmlID')\" >&nbsp;<i class='fa fa-25-1'></i>&nbsp;所有字段$zu_menuimg</li>" );
		$hiddenziduan='id,sys_huis,sys_yfzuid,sys_login,sys_id_fz,sys_bh,sys_zt,sys_zt_bianhao,';//隐藏字段
		//-------------------------------------------------------------------------------优先分类
		$sql = "SHOW FULL COLUMNS FROM `$databiao` ";
		$rs = $connect -> query($sql);
		//$recordcount=mysqli_num_rows($rs);//得到总数 无用
    	$showziduan='sys_id_zu,sys_id_bumen,sys_id_login,sys_adddate,sys_adddate_g';    //显示字段
	    
		while ( $row = mysqli_fetch_array( $rs['result'] ) ) {
			$zd_en_name = $row[ 'Field' ]; //字段
			$zdbeizhu = $row[ 'Comment' ]; //备注
			$NEW_zdbeizhu=colbeizhu($zdbeizhu,$zd_en_name);
		    $zd_cn_name=textN( $NEW_zdbeizhu, 0, ',' );                    //中文字段名
			$zd_xianshi_input_id = textN( $NEW_zdbeizhu, 4, ',' );         //显示类型
			if(getN( "2,6,7,10,12,14,20,21,22,23,24", $zd_xianshi_input_id ) > -1){      //审核框、多行文本框、批准框、分类筛选框那里特别显示的样式
				$zd_xianshi_input_id2 = 1;//改变显示样式
			}else{
				$zd_xianshi_input_id2 = 0;
			}
			
			$nowvalue=sqlarrvalue($sys_const_ShaiXuanSql_other,$zd_en_name,$zd_xianshi_input_id);  //得到value值
			//echo $nowvalue;
            $nowaddbox=".mains_right_menu";
			$zd_xianshi_input = Get_out_InputTypes_cols( $zd_xianshi_input_id,$zd_en_name,$zd_en_name,'addboxinput inputfocus sqlval',$nowvalue,'540px','0',$re_id,'Daima_xianshi',$nowaddbox," checked='checked' ",'onchange=zuchange(this,\''.$ToHtmlID.'\')',$zd_xianshi_input_id2); //这里为输出input样式
			//0【字段中文名称】,1【显示宽度】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】
			if (getN( $showziduan, $zd_en_name ) == -1 and getN( $hiddenziduan, $zd_en_name ) == -1){//如果查得到该字段时
				
				//-------------------------------------输出结果
				
					$select="<select name='fh' onchange=\"zuchange(this,'$ToHtmlID')\" enzdname='$zd_en_name' class='addboxinput inputfocus' style='width:65px'>";
					if(strpos($sys_const_ShaiXuanSql_other,'and '.$zd_en_name.' =') !== false){$selected=" selected='selected' ";}else{$selected="";}        //等于
				    $select.="<option sqltype='and=' value='and ".$zd_en_name." =' $selected>=</option>";
				
				    if(strpos($sys_const_ShaiXuanSql_other,'and '.$zd_en_name.' >') !== false){$selected=" selected='selected' ";}else{$selected="";}        //大于
				    $select.="<option sqltype='and>' value='and ".$zd_en_name." >' $selected> > </option>";
				    
				    if(strpos($sys_const_ShaiXuanSql_other,'and '.$zd_en_name.' <') !== false){	$selected=" selected='selected' ";}else{$selected="";}       //小于
				    $select.="<option sqltype='and<' value='and ".$zd_en_name." <' $selected> < </option>";
				
				    if(strpos($sys_const_ShaiXuanSql_other,'and '.$zd_en_name.' <>') !== false){	$selected=" selected='selected' ";}else{$selected="";}   //不等于
					$select.="<option sqltype='and<>' value='and ".$zd_en_name." <>' $selected>不等于</option>";
				    
				    if(strpos($sys_const_ShaiXuanSql_other,'and '.$zd_en_name.' like') !== false){	$selected=" selected='selected' ";}else{$selected="";}   //包含like
				    $select.="<option sqltype='andlike' value='and ".$zd_en_name." like' $selected> 包含 </option>";
				
				    if(strpos($sys_const_ShaiXuanSql_other,'and '.$zd_en_name.' not like') !== false){	$selected=" selected='selected' ";}else{$selected="";}   //不包含 not like
				    $select.="<option sqltype='andnotlike' value='and ".$zd_en_name." not like' $selected> 不包含 </option>";
					
				    if(strpos($sys_const_ShaiXuanSql_other,'or '.$zd_en_name.' =') !== false){$selected=" selected='selected' ";}else{$selected="";}         //or等于
					$select.="<option sqltype='or=' value='or ".$zd_en_name." =' $selected>or =</option>";
				
				    if(strpos($sys_const_ShaiXuanSql_other,'or '.$zd_en_name.' >') !== false){$selected=" selected='selected' ";}else{$selected="";}         //or 大于
				    $select.="<option sqltype='or>' value='or ".$zd_en_name." >' $selected>or > </option>";
				
				    if(strpos($sys_const_ShaiXuanSql_other,'or '.$zd_en_name.' <') !== false){	$selected=" selected='selected' ";}else{$selected="";}       //or 小于
				    $select.="<option sqltype='or<' value='or ".$zd_en_name." <' $selected>or < </option>";
				
				    if(strpos($sys_const_ShaiXuanSql_other,'or '.$zd_en_name.' <>') !== false){	$selected=" selected='selected' ";}else{$selected="";}       //or 不等于
					$select.="<option sqltype='or<>' value='or ".$zd_en_name." <>' $selected>or 不等于</option>";
				
				    if(strpos($sys_const_ShaiXuanSql_other,'or '.$zd_en_name.' like') !== false){	$selected=" selected='selected' ";}else{$selected="";}   //or like
				    $select.="<option sqltype='orlike' value='or ".$zd_en_name." like' $selected>or 包含 </option>";
				    $select.="</select>";
			
				
				if(strpos($sys_const_ShaiXuanSql_other,' '.$zd_en_name.' ') !== false){//包含
					$nowchceked=' checked ';
				}else{
					$nowchceked='';
				}
		    	echo( "<li id='$zd_en_name' typeid='$zd_xianshi_input_id'  tit='更多字段'  class='shadowdiv overli clearboth otherzd'>&nbsp;<input type='checkbox' onchange=\"zuchange(this,'$ToHtmlID')\" name='xuanzhong' class='addboxinput ' $nowchceked >&nbsp;" . $zd_cn_name . "<h1>{$select}</h1><h2>{$zd_xianshi_input}</h2></li>" );
			}
		};
		
		echo( "<li style='height:55px;'>&nbsp;&nbsp;</li>" );
		echo( "</ul>" );
	//}else if($menu=='sys_suqian'){ //书签
		
	}
}

function shuqianmenu() { //书签
	global $db_vip,$hy,$ToHtmlID,$databiao,$zu,$sys_id_bumen,$sys_adddate,$re_id,$big_id,$strmk_id,$nowzu,$px_ziduan,$px_ziduan,$zd,$pxv,$pok,$huis,$nowkeyword,$page,$ShaiXuanSql,$ShaiXuanSql_other,$sys_id_login;
	if ( isset( $_REQUEST[ 'sys_const_biaoqian_id' ] ) ){$sys_const_biaoqian_id = $_REQUEST[ 'sys_const_biaoqian_id' ];};                                     //标签id
	if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                     //标签id
	$nowclosedclick='$(this).parents("#'.$ToHtmlID.'_content_right_menu").hide(500)';
	echo( "<ul class='leftmenuhead nocopytext' onDblclick='$nowclosedclick' >书签</ul>" );
	echo( "<ul class='leftmenu nocopytext2'>" );
	
	//-------------------------------------------------------------------------------优先分类
		$sql = "select id,sys_name,sys_const_ShaiXuanSql_other From `sys_biaoqian` where sys_yfzuid='$hy' and sys_const_re_id='$re_id' and sys_huis='0' order by id Asc";
		//echo $sql;
		$rs = $db_vip -> query($sql);
		$countcords=mysqli_num_rows($rs['result']);
	    //echo $countcords;
	    if($countcords==0){
			echo( "<a class='beizhu'>&nbsp;&nbsp;将筛选结果存为书签，快捷访问。</a>" );
		}else{
			$i=0;
			while ( $row = mysqli_fetch_array( $rs['result'] ) ) {
				// echo $row['id'];	
				$i++;
				if($i<10){
					$i='0'.$i;
				}
				$id = $row[ 'id' ];                  //ID
				$sys_name = $row[ 'sys_name' ]; //标签名称
				// $sys_const_ShaiXuanSql_other = $row[ 'sys_const_ShaiXuanSql_other' ]; 
				if($sys_const_biaoqian_id==$id){
					$selectTag='selectTag';
				}else{
					$selectTag='';
				}
				echo "<a class='overli biaoqian {$selectTag}' id='$id' onclick='shuqianmenu_TOTO(this,\"".$ToHtmlID."\",$re_id)'><input  class='biaoqian_input' name='sys_name' Table_Name='sys_biaoqian' tit='$sys_name' value='$sys_name' onchange='edit_ajax(this,\"".$ToHtmlID."\")' readonly />
				<div class='biaoqian_i'><i class='fa fa-del-mini' onclick='shuqianmenu_del(this,\"".$ToHtmlID."\")'></i></div>
				</a>";
			};
		}
	    //echo "<a class='overli' id='0' onclick=''>+添加标签</a>";
	    echo( "<a class='exitedit' title='退出编辑' onclick='Edit_BiaoQian_Menu_Exit(this,\"".$ToHtmlID."\")'>↩</a>" );
	echo( "</ul>" );
	echo( "<ul class='rightmenu'>&nbsp;分类显示区...</ul>" );
	
	
	echo( "<ul class='foot'>" );
	echo( "<a id='-1' class='shadowdiv shadowadddiv' onclick=\"xialaclose(this,'$ToHtmlID')\" style='width:34%'>⊗&nbsp;关闭&nbsp;&nbsp;</a>" );
	echo( "<a id='-2' class='shadowdiv shadowadddiv' onclick=\"shuqianmenu_add(this,'$ToHtmlID')\"  style='width:33%'>✚&nbsp;添加&nbsp;&nbsp;</a>" );
	echo( "<a id='-3' class='shadowdiv shadowadddiv' onclick=\"Edit_BiaoQian_Menu(this,'$ToHtmlID')\"  style='width:33%'><i class='fa fa-edit-mini'></i>&nbsp;编辑&nbsp;&nbsp;</a>" );
	echo( "</ul>" );
}

function shuqianmenu_update() { //书签更新
	global $connect,$Connadmin,$bh,$hy,$ToHtmlID,$databiao,$const_id_fz,$SYS_UserName,$SYS_Company_id,$zu,$sys_id_bumen,$sys_adddate,$re_id,$big_id,$strmk_id,$nowzu,$px_ziduan,$zd,$pxv,$pok,$huis,$nowkeyword,$page,$ShaiXuanSql,$ShaiXuanSql_other,$sys_id_login;
	$sys_id_bumen_const=$sys_id_bumen;
	$hy_const=$hy;
	$bh_const=$bh;
	
	$id=$_POST['ed_id'];                                //编辑id
	$sys_const_keyword=$_POST['keyword'];               //关键词
	$SYS_Company_id=$_POST['SYS_Company_id'];           //
	   if($SYS_Company_id=='')$SYS_Company_id=0;
	$sys_id_bumen=$_POST['sys_id_bumen'];               //
	   if($sys_id_bumen=='')$sys_id_bumen=0;
	$hy=$_POST['hy'];                                   //
	   if($hy=='')$hy=0;
	$bh=$_POST['bh'];                                   //编制人
	$sys_shenpi=$_POST['sys_shenpi'];                   //审核人
	$sys_shenpi_all=$_POST['sys_shenpi_all'];           //批准人
	$sys_chaosong=$_POST['sys_chaosong'];               //经办人
	
	$sys_adddate=$_POST['sys_adddate'];                 //
	$sys_const_qx=$_POST['sys_const_qx'];               //
	$page=$_POST['page'];                               //
	$re_id=$_POST['re_id'];                             //
	$big_id=$_POST['big_id'];                           //
	   if($big_id=='')$big_id=0;
	$huis=$_POST['huis'];                               //
	   if($huis=='')$huis=0;
	$zu=$_POST['zu'];                                   //
	   if($zu=='')$zu=0;
	//$ShaiXuanSql=$_POST['ShaiXuanSql'];                 //
	$ShaiXuanSql_other=$_POST['ShaiXuanSql_other'];     //
	$px_ziduan=$_POST['px_ziduan'];                     //
	$zd=$_POST['zd'];                                   //	
	$px_name=$_POST['px_name'];                         //
	$pxv=$_POST['pxv'];                                 //
	$pok=$_POST['pok'];                                 //
    $scroll_left=$_POST['scroll_left'];                 //
	$sys_const_pagetype=$_POST['sys_const_pagetype'];   //		   
	$sys_guanxibiao_id=$_POST['sys_guanxibiao_id'];     //		   
	$GuanXi_id=$_POST['GuanXi_id'];                     //		   
    $sys_const_tuodongok=$_POST['sys_const_tuodongok']; //拖动开始
	$sys_const_s_h=$_POST['sys_const_s_h'];             //
	$sys_const_q_h=$_POST['sys_const_q_h'];             //
	$sys_const_c_ok=$_POST['sys_const_c_ok'];           //
	$sys_const_b_ok=$_POST['sys_const_b_ok'];           //
	$sys_const_C_xu_now=$_POST['sys_const_C_xu_now'];           //
	$sys_const_Start_Suoding=$_POST['sys_const_Start_Suoding'];           //
	$sys_const_End_Suoding=$_POST['sys_const_End_Suoding'];           //
	$sys_const_prev_zd=$_POST['sys_const_prev_zd'];           //
	$sys_const_ChangePrev_zd=$_POST['sys_const_ChangePrev_zd'];           //
	$sys_const_ChangeNext_zd=$_POST['sys_const_ChangeNext_zd'];           //
	$sys_const_this_zd=$_POST['sys_const_this_zd'];           //
	
	$nowdata = date( 'Y-m-d H:i:s' );

	//`sys_const_huis` ='$huis',
	$sql = "UPDATE  `sys_biaoqian`  set 
	`sys_const_keyword` ='$sys_const_keyword',
	`sys_const_company_id` ='$SYS_Company_id',
	`sys_const_id_bumen` ='$sys_id_bumen',
	`sys_const_hy` ='$hy',
	`sys_const_bh` ='$bh',
	`sys_const_shenpi` ='$sys_shenpi',
	`sys_const_shenpi_all` ='$sys_shenpi_all',
	`sys_const_chaosong` ='$sys_chaosong',
	`sys_const_adddate` ='$sys_adddate',
	`sys_const_qx` ='$sys_const_qx',
	`sys_const_pagetype` ='$sys_const_pagetype',
	`sys_const_page` ='$page',
	`sys_const_re_id` ='$re_id',
	`sys_const_big_id` ='$big_id',
	
	`sys_const_px_name`='$px_name',
	`sys_const_pxv` ='$pxv',
	`sys_const_pok` ='$pok',
	`sys_const_tuodongok` ='$sys_const_tuodongok',
	`sys_const_s_h` ='$sys_const_s_h',
    `sys_const_q_h` ='$sys_const_q_h',
	`sys_const_c_ok` ='$sys_const_c_ok',
	`sys_const_b_ok` ='$sys_const_b_ok',
    `sys_const_C_xu_now` ='$sys_const_C_xu_now',
    `sys_const_Start_Suoding` ='$sys_const_Start_Suoding',
    `sys_const_End_Suoding` ='$sys_const_End_Suoding',
    `sys_const_prev_zd` ='$sys_const_prev_zd',
    `sys_const_ChangePrev_zd` ='$sys_const_ChangePrev_zd',
    `sys_const_ChangeNext_zd` ='$sys_const_ChangeNext_zd',
    `sys_const_this_zd` ='$sys_const_this_zd',
	`sys_const_zu` ='$zu',
	`sys_const_zd` ='$zd',
	
	`sys_const_ShaiXuanSql_other` ='$ShaiXuanSql_other',
	
	`sys_id_login` ='$bh_const',
	`sys_login`='$SYS_UserName',
	`sys_yfzuid`='$hy_const',
	`sys_id_fz`='$const_id_fz',
	`sys_id_bumen`='$sys_id_bumen_const',
	`sys_adddate`='$nowdata'
	WHERE id='$id' ";
	
	//echo $sql;
	//if ( SYS_str( $Xcoid_txt ) == 0 ) { //当为0时不为系统字段 1代表为系统字段//检查不为系统字段时执行
		$connect -> query($sql);
}
function shuqianmenu_user_update() { //用户记忆功能
	global $connect,$bh,$hy,$const_id_fz,$SYS_UserName,$SYS_Company_id,$zu,$sys_id_bumen,$sys_adddate,$re_id,$big_id,$strmk_id,$nowzu,$px_ziduan,$zd,$pxv,$pok,$huis,$nowkeyword,$page,$ShaiXuanSql,$ShaiXuanSql_other,$sys_id_login;
	$sys_id_bumen_const=$sys_id_bumen;
	$hy_const=$hy;
	$bh_const=$bh;
	//===================================================================================================接收参数
	//$id=$_POST['ed_id'];                                         //编辑id
	$sys_const_biaoqian_id=$_POST['sys_const_biaoqian_id'];      //标签id
	if($sys_const_biaoqian_id=='') $sys_const_biaoqian_id=0;
	$sys_const_keyword=$_POST['keyword'];                        //关键词
	if(isset($_POST['SYS_Company_id']))$SYS_Company_id=$_POST['SYS_Company_id'];                    //
	if($SYS_Company_id=='')$SYS_Company_id=0;
	$sys_id_bumen=$_POST['sys_id_bumen'];                        //
	if($sys_id_bumen=='')$sys_id_bumen=0;
	$hy=$_POST['hy'];                                            //
	if($hy=='')$hy=0;
	$bh=$_POST['bh'];                                            //编制人
	$sys_shenpi=$_POST['sys_shenpi'];                            //审核人
	$sys_shenpi_all=$_POST['sys_shenpi_all'];                    //批准人
	$sys_chaosong=$_POST['sys_chaosong'];                        //经办人
	
	$sys_adddate=$_POST['sys_adddate'];                          //
	$sys_const_qx=$_POST['sys_const_qx'];                        //
	$page=$_POST['page'];                                        //
	$re_id=$_POST['re_id'];                                      //
	if(isset($_POST['big_id']))$big_id=$_POST['big_id'];                                    //
	   if($big_id=='')$big_id=0;
	$huis=$_POST['huis'];                                        //
	   if($huis=='')$huis=0;
	$zu=$_POST['zu'];                                            //
	   if($zu=='')$zu=0;
	$ShaiXuanSql=$_POST['ShaiXuanSql'];                          //
	$ShaiXuanSql_other=$_POST['ShaiXuanSql_other'];              //
	if(isset($_POST['px_ziduan']))$px_ziduan=$_POST['px_ziduan'];                              //
	$zd=$_POST['zd'];                                            //	
	$px_name=$_POST['px_name'];                                  //
	$pxv=$_POST['pxv'];                                          //
	$pok=$_POST['pok'];                                          //
	$sys_const_pagetype=$_POST['sys_const_pagetype'];            //		   
    $sys_const_tuodongok=$_POST['sys_const_tuodongok'];          //拖动开始
	$sys_const_s_h=$_POST['sys_const_s_h'];                      //
	$sys_const_q_h=$_POST['sys_const_q_h'];                      //
	$sys_const_c_ok=$_POST['sys_const_c_ok'];                    //
	$sys_const_b_ok=$_POST['sys_const_b_ok'];                    //
	$sys_const_C_xu_now=$_POST['sys_const_C_xu_now'];            //
	$sys_const_Start_Suoding=$_POST['sys_const_Start_Suoding'];  //
	$sys_const_End_Suoding=$_POST['sys_const_End_Suoding'];      //
	$sys_const_prev_zd=$_POST['sys_const_prev_zd'];              //
	$sys_const_ChangePrev_zd=$_POST['sys_const_ChangePrev_zd'];  //
	$sys_const_ChangeNext_zd=$_POST['sys_const_ChangeNext_zd'];  //
	$sys_const_this_zd=$_POST['sys_const_this_zd'];              //
	if(isset($_POST['sys_const_shenpi']))$sys_const_shenpi=$_POST['sys_const_shenpi'];
	if(isset($_POST['sys_const_shenpi_all']))$sys_const_shenpi_all=$_POST['sys_const_shenpi_all'];
	if(isset($_POST['sys_const_chaosong']))$sys_const_chaosong=$_POST['sys_const_chaosong'];
	
	$nowdata = date( 'Y-m-d H:i:s' );

	//===================================================================================================判断
	$sqlaa = "select id From `sys_biaoqian_user` where sys_const_re_id='$re_id' and sys_yfzuid='$hy_const' and sys_id_login='$bh_const'";
		//echo $sql;
	$rsaa = $connect -> query($sqlaa);
	$countcords=$connect -> numRows($rsaa['result']);
	if($countcords==0){//没有时添加
		$sql = "INSERT INTO `sys_biaoqian_user` (sys_const_biaoqian_id,sys_const_keyword,sys_const_company_id,sys_const_id_bumen,sys_const_hy,sys_const_bh,sys_const_shenpi,sys_const_shenpi_all,sys_const_chaosong,sys_const_adddate,sys_const_qx,sys_const_pagetype,sys_const_page,sys_const_big_id,sys_const_huis,sys_const_px_name,sys_const_pxv,sys_const_pok,sys_const_tuodongok,sys_const_s_h,sys_const_q_h,sys_const_c_ok,sys_const_b_ok,sys_const_C_xu_now,sys_const_Start_Suoding,sys_const_End_Suoding,sys_const_prev_zd,sys_const_ChangePrev_zd,sys_const_ChangeNext_zd,sys_const_this_zd,sys_const_zu,sys_const_zd,sys_const_ShaiXuanSql,sys_const_ShaiXuanSql_other,sys_login,sys_id_fz,sys_id_bumen,sys_adddate,sys_const_re_id,sys_yfzuid,sys_id_login) VALUES ('$sys_const_biaoqian_id', '$sys_const_keyword', '$SYS_Company_id','$sys_id_bumen','$hy','$bh','$sys_const_shenpi','$sys_const_shenpi_all','$sys_const_chaosong','$sys_adddate','$sys_const_qx','$sys_const_pagetype','$page','$big_id','$huis','$px_name','$pxv','$pok','$sys_const_tuodongok','$sys_const_s_h','$sys_const_q_h','$sys_const_c_ok','$sys_const_b_ok','$sys_const_C_xu_now','$sys_const_Start_Suoding','$sys_const_End_Suoding','$sys_const_prev_zd','$sys_const_ChangePrev_zd','$sys_const_ChangeNext_zd','$sys_const_this_zd','$zu','$zd','$ShaiXuanSql','$ShaiXuanSql_other','$SYS_UserName','$const_id_fz','$sys_id_bumen_const','$nowdata','$re_id','$hy_const','$bh_const')";
		
		$connect -> query($sql);
	}else{//修改
		//`sys_const_huis` ='$huis',`sys_const_ShaiXuanSql` ='$ShaiXuanSql',
		$sql = "UPDATE  `sys_biaoqian_user`  set 
	    `sys_const_biaoqian_id` ='$sys_const_biaoqian_id',
	    `sys_const_keyword` ='$sys_const_keyword',
	    `sys_const_company_id` ='$SYS_Company_id',
	    `sys_const_id_bumen` ='$sys_id_bumen',
	    `sys_const_hy` ='$hy',
	    `sys_const_bh` ='$bh',
		`sys_const_shenpi` ='$sys_shenpi',
		`sys_const_shenpi_all` ='$sys_shenpi_all',
		`sys_const_chaosong` ='$sys_chaosong',
	    `sys_const_adddate` ='$sys_adddate',
	    `sys_const_qx` ='$sys_const_qx',
	    `sys_const_pagetype` ='$sys_const_pagetype',
	    `sys_const_page` ='$page',
	    `sys_const_big_id` ='$big_id',
	    
	    `sys_const_px_name`='$px_name',
	    `sys_const_pxv` ='$pxv',
	    `sys_const_pok` ='$pok',
	    `sys_const_tuodongok` ='$sys_const_tuodongok',
	    `sys_const_s_h` ='$sys_const_s_h',
        `sys_const_q_h` ='$sys_const_q_h',
	    `sys_const_c_ok` ='$sys_const_c_ok',
	    `sys_const_b_ok` ='$sys_const_b_ok',
        `sys_const_C_xu_now` ='$sys_const_C_xu_now',
        `sys_const_Start_Suoding` ='$sys_const_Start_Suoding',
        `sys_const_End_Suoding` ='$sys_const_End_Suoding',
        `sys_const_prev_zd` ='$sys_const_prev_zd',
        `sys_const_ChangePrev_zd` ='$sys_const_ChangePrev_zd',
        `sys_const_ChangeNext_zd` ='$sys_const_ChangeNext_zd',
        `sys_const_this_zd` ='$sys_const_this_zd',
	    `sys_const_zu` ='$zu',
	    `sys_const_zd` ='$zd',
	    
	    `sys_const_ShaiXuanSql_other` ='$ShaiXuanSql_other',
	    `sys_login`='$SYS_UserName',
	    `sys_id_fz`='$const_id_fz',
	    `sys_id_bumen`='$sys_id_bumen_const',
	    `sys_adddate_g`='$nowdata'
	    WHERE sys_const_re_id='$re_id' and sys_yfzuid='$hy_const' and sys_id_login='$bh_const'";
	
	    // echo $sql;
	    //if ( SYS_str( $Xcoid_txt ) == 0 ) { //当为0时不为系统字段 1代表为系统字段//检查不为系统字段时执行
		$connect -> query($sql);
	}
}

?>