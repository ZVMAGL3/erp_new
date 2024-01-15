<?php

header( 'Content-type: text/html; charset=utf-8' ); //设定本页编码
include_once '../session.php';
include_once 'B_quanxian.php';
include_once '../inc/Function_All.php';
include_once '../inc/B_Config.php';//执行接收参数及配置
include_once '../inc/B_conn.php';
include_once '../inc/B_connadmin.php';
include_once '../inc/Sub_All.php';

//接收参数开始
$databiao=Find_tablename( $re_id );
//echo $databiao;
//=========================================================================================
if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";	};//关系列id
    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //j显示页面
	if ( isset( $_REQUEST[ 'huis' ] ) ){$huis = intval( $_REQUEST[ 'huis' ] );}else{$huis = 0;};                                                              //是否为回收站0为不回收
    //if ( $huis == 1){$ToHtmlID='HUIS_'.$ToHtmlID;};                                                                                                           //是否为回收站0为不回收
switch ( $act ) {
	case 'XianJieBiao': //------------------------- 链接表
		XianJieBiao();
		break;
	case 'xiuguaijilu': //------------------------- 修改记录
		xiuguaijilu();
		break;
    case 'mobanedit':   //------------------------- 模板附件修改
		mobanedit();
		break;
	case 'edit': //-------------------------------- 添加修改表
		edit();
		break;
	default:
		echo NoZhiLing();
};


//【ok】=========================================================================================链接表
function XianJieBiao() {
	global $Conn, $re_id, $bh,$hy,$SYS_UserName,$ToHtmlID; //得到全局变量
	$i = $rs = $sql = $sys_guanxibiao_id = '';
    
	if ( isset( $_POST[ 'GuanXi_id' ] ) )$GuanXi_id = $_POST[ 'GuanXi_id' ];
	if ( isset( $_POST[ 'sys_guanxibiao_id' ] ) )$sys_guanxibiao_id = $_POST[ 'sys_guanxibiao_id' ];
	if ($sys_guanxibiao_id == 0) {
		$sys_guanxibiao_id = 1;
	}
	//echo $sys_guanxibiao_id;
	//echo ($sys_guanxibiao_id);
	if( $sys_guanxibiao_id == 0 ) {
		XianJieBiao_SET(); //设定关系表
	} else {
		$sql = "select * From `sys_guanxibiao`  where sys_huis=0  and id='$sys_guanxibiao_id'";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		$nowid = $row[ 'id' ];
		$databiaoYY = Find_tablename( $row[ 'sys_re_id_02' ] );
		$nowid_guanxi_col = $row[ 'sys_nowid_guanxi_col' ];
		$zdlist = 'sys_zdlist'; //字段清单
		//echo( $nowid . $databiaoYY.$nowid_guanxi_col.'</br>' );
		mysqli_free_result( $rs ); //释放内存

		$sql = "select * From  `$databiaoYY` where sys_huis='0' and `$nowid_guanxi_col`='$GuanXi_id' order by sys_adddate Asc";
		//echo $sql;
		$rs = mysqli_query(  $Conn , $sql );
		$nowrscount = mysqli_num_rows( $rs ); //统计数量
		
	//if($nowrscount>0){
		
		$postform = "post_form_" . $re_id;
		echo "<form id='$postform'  autocomplete='off' tit='' sys_guanxibiao_id='$nowid' sys_postzd_list='$zdlist' sys_databiao='$databiaoYY' style='padding-top:15px;'><div class='chatmsg'  ondblclick=\"edit_ul_msg(this,'$ToHtmlID')\">";
		if ( $nowrscount == 0 )echo "<ul class='msglist nodatas'>&nbsp;还没有记录。</ul>";
		$i = 0;
        //echo $re_id;
		while ( $row = mysqli_fetch_array( $rs ) ) {
			$i++;
			$id = $row[ 'id' ];
			$adddate = $row[ 'sys_adddate' ];
			$sys_jilu = $row[ 'sys_jilu' ];
			$id_login = $row[ 'sys_id_login' ]; //id
			$login = $row[ 'sys_login' ]; //姓名
			$leixin = $row[ 'leixin' ]; //类型
			
			//$ismy = $row[ 'ismy' ]; //就否自己修改
			if( $leixin == 1 ) { //修改记录
				echo( " <ul id='$id' title='$id' class='msglist hui'>" );
			}else{
				echo( " <ul id='$id' title='$id' class='msglist'>" );
			};
			echo( "<li class='xu'> $i </li> " );
			
			if($id_login==$bh) { //自己修改时
				
				echo( "<li class='del'><i class='fa fa-del-mini'></i></li> " );
				echo( "<li class='edit'><i class='fa fa-edit-mini'></i></li> " );
			}else{
				echo( "<li class='edit_h'><i class='fa fa-del-mini_h'></i></li> " );
				echo( "<li class='edit_h'><i class='fa fa-edit-mini_h'></i></li> " );
			};
			if($id_login==$bh) { //自己修改时
				echo( "<li>$login-$id_login;</li>" );
			} else {
				echo( "<li class='ismy'>$login-$id_login;</li>" );
			};
			echo( "<li>$adddate</li>" );
			//echo"</div>";
			
			echo( "<div class='clear'></div>" );
			echo( "<li class='text' zdname='sys_jilu' style='padding-left:39px;'>$sys_jilu</li>" );
			//echo"<div>";
			echo( "<div class='clear'></div>" );
			echo( " </ul>" );
		};

		echo "<dd id='endid'>--- the end ---</dd></div>";
		if(isset($_REQUEST['editname'])){
			echo "<div id='editname'>与：{".$_REQUEST['editname']."} </div>";
		}
		mysqli_free_result( $rs ); //释放内存
		//$nowclick="alert('0')";
		echo( " <div class='hoverbg addmenu' id='msg'><div style='width:92%' class='left'>
		
		<textarea name='sys_jilu' tablename='$databiaoYY' editid='' class='inputmsg'></textarea>
		<input name='sys_nowid_guanxi_col' value='$nowid_guanxi_col' type='hidden' />
		<input name='strmk_id' value='' type='hidden' />
		<input name='id_huiyuan_id' value='$GuanXi_id' type='hidden' />
		<input name='sys_guanxibiao_id' value='$nowid' type='hidden' />
		<input name='act' value='edit' type='hidden' />
		
		</div> <div  style='width:7%' class='hoverbg buttondiv'><div class='line25 hoverbg'></div><input id='SYS_submit' value='提交' type='button' class='hoverbg noappleinput' title='Ctrl+Enter提交' bh='$bh' login='$SYS_UserName' hy='$hy' onclick=\"add_Msg(this,'$ToHtmlID')\" /></div><div></form>" );
		//echo "<a class='RightEditOpen' onclick=\"edit_ul_msg('.chatmsg','$ToHtmlID')\" >管理记录</a>";//出现管理记录菜单
		
		//echo "<script>chatmsg('$ToHtmlID','$postform');</script>";
		echo "<script>$('#".$ToHtmlID.' .chatmsg'."').scrollTop($('#".$ToHtmlID.' .chatmsg'."')[0].scrollHeight);$('#".$ToHtmlID.' .inputmsg'."').focus();</script>";
	//}else{
		//echo "该表未设定对应的关系表。";
	//}

	};
};

//【ok】=========================================================================================修改记录
function xiuguaijilu() {
	global $Conn, $re_id, $bh,$hy,$SYS_UserName,$ToHtmlID; //得到全局变量
	$i = $rs = $sql = $sys_guanxibiao_id = '';

	if ( isset( $_POST[ 'GuanXi_id' ] ) )$GuanXi_id = $_POST[ 'GuanXi_id' ];
	if ( isset( $_POST[ 'sys_guanxibiao_id' ] ) )$sys_guanxibiao_id = $_POST[ 'sys_guanxibiao_id' ];
	if ($sys_guanxibiao_id == 0) {
		$sys_guanxibiao_id = 1;
	}
	//echo $sys_guanxibiao_id;
	//echo ($sys_guanxibiao_id);
	if( $sys_guanxibiao_id == 0 ) {
		
	} else {
		
		$zdlist = 'sys_editcontent'; //字段清单
		//echo( $nowid . $databiaoYY.$nowid_guanxi_col.'</br>' );
	

		$sql = "select * From  `sys_xiuguaijilu` where sys_huis='0' and sys_re_id=$sys_guanxibiao_id and `sys_edit_id`='$GuanXi_id' order by sys_adddate Asc";
		//echo $sql;
		$rs = mysqli_query(  $Conn , $sql );
		$nowrscount = mysqli_num_rows( $rs ); //统计数量
		
	//if($nowrscount>0){
		$nowid='';
		$postform = "post_form_" . $re_id;
		echo "<form id='$postform'  autocomplete='off' tit='' sys_guanxibiao_id='$nowid' sys_postzd_list='$zdlist' sys_databiao='sys_xiuguaijilu' style='padding-top:15px;padding-bottom:35px;'><div class='chatmsg'>";
		if ( $nowrscount == 0 )echo "<ul class='msglist nodatas'>&nbsp;还没有记录。</ul>";
		$i = 0;
        //echo $re_id;
		while ( $row = mysqli_fetch_array( $rs ) ) {
			$i++;
			$id = $row[ 'id' ];
			$adddate = $row[ 'sys_adddate' ];
			$sys_jilu = $row[ 'sys_editcontent' ];
			$id_login = $row[ 'sys_id_login' ]; //id
			$login = $row[ 'sys_login' ]; //姓名
			$leixin = 0; //类型
			
			//$ismy = $row[ 'ismy' ]; //就否自己修改
			if( $leixin == 1 ) { //修改记录
				echo( " <ul id='$id' title='$id' class='msglist hui'>" );
			}else{
				echo( " <ul id='$id' title='$id' class='msglist'>" );
			};
			echo( "<li class='xu'> $i </li> " );
			
			if($id_login==$bh) { //自己修改时
				//echo( "<li class='del'><i class='fa fa-del-mini'></i></li> " );
				//echo( "<li class='edit'><i class='fa fa-edit-mini'></i></li> " );
			}else{
				//echo( "<li class='edit_h'><i class='fa fa-del-mini_h'></i></li> " );
				//echo( "<li class='edit_h'><i class='fa fa-edit-mini_h'></i></li> " );
			};
			if($id_login==$bh) { //自己修改时
				echo( "<li>修改人：$login-$id_login;</li>" );
			} else {
				echo( "<li class='ismy'>修改人：$login-$id_login;</li>" );
			};
			echo( "<li>$adddate</li>" );
			//echo"</div>";
			
			echo( "<div class='clear'></div>" );
			echo( "<li class='text' zdname='sys_jilu' style='padding-left:39px;'>$sys_jilu</li>" );
			//echo"<div>";
			echo( "<div class='clear'></div>" );
			echo( " </ul>" );
		};

		//echo "<dd id='endid'>--- the end ---</dd></div>";
		//echo "<div id='editname'>与：{".$_REQUEST['editname']."} </div>";
		mysqli_free_result( $rs ); //释放内存
		//$nowclick="alert('0')";
		echo( " <br><br><br><br><br><br><br><div></form>" );
	};
};
//【ok】=========================================================================================模板附件修改
function mobanedit() {
	global $Conn, $re_id, $bh,$hy,$SYS_UserName,$ToHtmlID; //得到全局变量
	$i = $rs = $sql = $sys_guanxibiao_id = '';

	if ( isset( $_POST[ 'GuanXi_id' ] ) )$GuanXi_id = $_POST[ 'GuanXi_id' ];
	if ( isset( $_POST[ 'sys_guanxibiao_id' ] ) )$sys_guanxibiao_id = $_POST[ 'sys_guanxibiao_id' ];
	if ($sys_guanxibiao_id == 0) {
		$sys_guanxibiao_id = 1;
	}
	//echo $sys_guanxibiao_id;
	//echo ($sys_guanxibiao_id);
	if( $sys_guanxibiao_id == 0 ) {
		
	} else {
		
		$zdlist = 'sys_editcontent'; //字段清单
		//echo( $nowid . $databiaoYY.$nowid_guanxi_col.'</br>' );
	

		$sql = "select * From  `sys_xiuguaijilu` where sys_huis='0' and sys_re_id=$sys_guanxibiao_id and `sys_edit_id`='$GuanXi_id' order by sys_adddate Asc";
		//echo $sql;
		$rs = mysqli_query(  $Conn , $sql );
		$nowrscount = mysqli_num_rows( $rs ); //统计数量
		
	//if($nowrscount>0){
		$nowid='';
		$postform = "post_form_" . $re_id;
		echo "<form id='$postform'  autocomplete='off' tit='' sys_guanxibiao_id='$nowid' sys_postzd_list='$zdlist' sys_databiao='sys_xiuguaijilu' style='padding-top:15px;padding-bottom:35px;'><div class='chatmsg'>";
		if ( $nowrscount == 0 )echo "<ul class='msglist nodatas'>&nbsp;还没有记录。</ul>";
		$i = 0;
        //echo $re_id;
		while ( $row = mysqli_fetch_array( $rs ) ) {
			$i++;
			$id = $row[ 'id' ];
			$adddate = $row[ 'sys_adddate' ];
			$sys_jilu = $row[ 'sys_editcontent' ];
			$id_login = $row[ 'sys_id_login' ]; //id
			$login = $row[ 'sys_login' ]; //姓名
			$leixin = 0; //类型
			
			//$ismy = $row[ 'ismy' ]; //就否自己修改
			if( $leixin == 1 ) { //修改记录
				echo( " <ul id='$id' title='$id' class='msglist hui'>" );
			}else{
				echo( " <ul id='$id' title='$id' class='msglist'>" );
			};
			echo( "<li class='xu'> $i </li> " );
			
			if($id_login==$bh) { //自己修改时
				//echo( "<li class='del'><i class='fa fa-del-mini'></i></li> " );
				//echo( "<li class='edit'><i class='fa fa-edit-mini'></i></li> " );
			}else{
				//echo( "<li class='edit_h'><i class='fa fa-del-mini_h'></i></li> " );
				//echo( "<li class='edit_h'><i class='fa fa-edit-mini_h'></i></li> " );
			};
			if($id_login==$bh) { //自己修改时
				echo( "<li>修改人：$login-$id_login;</li>" );
			} else {
				echo( "<li class='ismy'>修改人：$login-$id_login;</li>" );
			};
			echo( "<li>$adddate</li>" );
			//echo"</div>";
			
			echo( "<div class='clear'></div>" );
			echo( "<li class='text' zdname='sys_jilu' style='padding-left:39px;'>$sys_jilu</li>" );
			//echo"<div>";
			echo( "<div class='clear'></div>" );
			echo( " </ul>" );
		};

		//echo "<dd id='endid'>--- the end ---</dd></div>";
		//echo "<div id='editname'>与：{".$_REQUEST['editname']."} </div>";
		mysqli_free_result( $rs ); //释放内存
		//$nowclick="alert('0')";
		echo( " <br><br><br><br><br><br><br><div></form>" );
	};
};
//【ok】=========================================================================================设定关系表
function XianJieBiao_SET() {
	echo "设定关系表";
}

//[ok]=========================================================================================添加 修改记录
function edit() {
	global $Conn, $databiao, $hy, $r_zt, $r_zt_bianhao, $now_xianshi, $sys_postvalue_list, $bh, $SYS_UserName, $sys_id_fz, $bumen_id; //得到全局变量
	$Y_re_id = $strmk_id = $rs = $sql = $sys_postzd_list = $i = $sys_post_ADD_value_list = $Ubound_postzd_list = $nowdates = $now_xianshi_value = '';
	if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ) {
		$sys_guanxibiao_id = intval( trim( $_REQUEST[ 'sys_guanxibiao_id' ] ) ); //==================得到关系表的ID
	}

	if ( isset( $_REQUEST[ 'strmk_id' ] ) ) {
		$strmk_id = intval( trim( $_REQUEST[ 'strmk_id' ] ) ); //==================得到修改的ID
	}

    if ( isset( $_REQUEST[ 'id_huiyuan_id' ] ) ) {
		$id_huiyuan_id = trim( $_REQUEST[ 'id_huiyuan_id' ] ); //============修改表的id
	}

	if ( isset( $_REQUEST[ 'sys_postzd_list' ] ) ) {
		$sys_postzd_list = trim( $_REQUEST[ 'sys_postzd_list' ] ); //============字段
	}

	$sql = "select * From `sys_guanxibiao`  where sys_huis=0  and id='$sys_guanxibiao_id'";
	// echo $sql;
	$rs = mysqli_query(  $Conn , $sql );
	$row = mysqli_fetch_array( $rs );
	$nowid = $row[ 'id' ];
	$databiaoYY = Find_tablename( $row[ 'sys_re_id_02' ] );
	$zdlist = 'sys_jilu'; //字段清单
	//echo( $nowid . $databiaoYY.'</br>' );
	mysqli_free_result( $rs ); //释放内存
    //echo $sys_postzd_list;
	$Ubound_postzd_list = Uboundarryy( $sys_postzd_list, ',' ); //得到数组总数8
	//echo $sys_postzd_list,$Ubound_postzd_list;
	for ( $i = 0; $i < $Ubound_postzd_list; $i++ ) {
		$now_xianshi = textN( $sys_postzd_list, $i, ',' ); //得到当前显示字段
		
		//---------------------接收post值
		if ( isset( $_POST[ $now_xianshi ] ) ) { //员工工号9001
			$now_xianshi_value = trim( htmlspecialchars( $_POST[ $now_xianshi ] ) ); //【调试用】
		};

			$sys_postvalue_list = $sys_postvalue_list . "," . $now_xianshi . "='" . $now_xianshi_value . "'";
			$sys_post_ADD_value_list .= "'" . $now_xianshi_value . "',";
		//};
		//$now_xianshi_value = htmlspecialchars( trim( $_POST[ $now_xianshi ] ) ); //【调试用】
	};
	//echo $sys_post_ADD_value_list;
	
	$databiaoYY='sys_msn';
	
	if ( isset( $_POST[ 'strmk_id' ] ) ) {
		$strmk_id = intval( $_POST[ 'strmk_id' ] );         //==================得到sys_msn修改的ID
	}
	if ( isset( $_POST[ 'id_huiyuan_id' ] ) ) {
		$id_huiyuan_id = $_POST[ 'id_huiyuan_id' ];         //==================修改表的关系id
	}
	if ( isset( $_POST[ 'sys_nowid_guanxi_col' ] ) ) {
		$sys_nowid_guanxi_col = $_POST[ 'sys_nowid_guanxi_col' ] ; //============关系字段
	}
	if ( isset( $_POST[ 'sys_jilu' ] ) ) {
		$sys_jilu = $_POST[ 'sys_jilu' ]; //============字段
	}
	//================================================以下为系统自动生成部份
	$nowdates = date( "Y-m-d H:i:s" ); //$_SERVER['REQUEST_TIME']当前时间
	//$sys_postzd_list = $sys_postzd_list; //添加影响的字段清单
	$sys_postvalue_list = trim( $sys_postvalue_list, ',' );
	$sys_post_ADD_value_list = trim( $sys_post_ADD_value_list, ',' );
	//echo $sys_postvalue_list;
	if ( $strmk_id > 0 ) { //有id时执行修改
		$sql = "UPDATE " . $databiaoYY . "  set  sys_jilu='$sys_jilu',$sys_nowid_guanxi_col='$id_huiyuan_id',sys_adddate_g='" . date( "Y-m-d H:i:s" ) . "'  where id=" . $strmk_id; //更新SQL
		//echo $sql;
		mysqli_query(  $Conn , $sql ); //执行添加与更新
		
		
	} else { //执行添加
		//echo ( $databiao."_".$sys_postzd_list."_".$sys_post_ADD_value_list );
		$sys_postzd_list="sys_jilu,$sys_nowid_guanxi_col";
		$sys_postvalue_list="'$sys_jilu','$id_huiyuan_id'";
		//echo $sys_postzd_list.'___'.$sys_postvalue_list;
		Jilu_add_Modular( 'sys_msn', $sys_postzd_list, $sys_postvalue_list);    //添加数据 并生成添加的id
		//Jilu_add_Modular( $databiaoYY, $sys_postzd_list, $sys_post_ADD_value_list); //添加数据并查询到添加的值
		
	};

};

mysqli_close($Conn);//关闭数据库
mysqli_close($Connadmin);//关闭云数据库
?>