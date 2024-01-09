<?php

header( 'Content-type: text/html; charset=utf-8' ); //设定本页编码
include_once '../session.php';
include_once 'B_quanxian.php';

include_once '../inc/Function_All.php';
include_once '../inc/B_Config.php';//执行接收参数及配置
include_once '../inc/B_conn.php';
include_once '../inc/B_connadmin.php';
include_once '../inc/Sub_All.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');
//接收参数开始

$dbb = $strmkzd = $strmk = $mdb_name = $nowziduan = $Now_ZD = $ZhiWei_id = $ADDcolsarry = $DELcolsarry = $kd = $zhiduan = $scroll_left = $c_ok = $b_ok = '';
$databiao=Find_tablename( $re_id );
//echo $databiao;
//=========================================================================================

if ( isset( $_POST[ 'dbb' ] ) )$dbb = htmlspecialchars( $_POST[ 'dbb' ] ); //dbb
if ( isset( $_POST[ 'strmkzd' ] ) )$strmkzd = htmlspecialchars( trim( $_POST[ 'strmkzd' ] ) );    //字段数组接收
if ( isset( $_POST[ 'strmk' ] ) )$strmk = htmlspecialchars( trim( $_POST[ 'strmk' ] ) );          //
if ( isset( $_POST[ 'mdb_name' ] ) )$mdb_name = htmlspecialchars( trim( $_POST[ 'mdb_name' ] ) ); //表名
if ( isset( $_POST[ 'zd' ] ) )$nowziduan = htmlspecialchars( trim( $_POST[ 'zd' ] ) );            //字段
if ( isset( $_POST[ 'ZhiWei_id' ] ) )$ZhiWei_id = intval( $_POST[ 'ZhiWei_id' ] );                //职位ID
if ( isset( $_POST[ 'ADDcolsarry' ] ) )$ADDcolsarry = trim( $_POST[ 'ADDcolsarry' ] );            //添加数组接收
if ( isset( $_POST[ 'DELcolsarry' ] ) )$DELcolsarry = trim( $_POST[ 'DELcolsarry' ] );            //删除数组接收
//if(isset($_POST['Now_ZD']))        $Now_ZD=trim($_POST['Now_ZD']);

//==========================================================================================以下为表头调整参数
if ( isset( $_POST[ 'kd' ] ) )$kd = intval( $_POST[ 'kd' ] );                                     //宽度
if ( isset( $_POST[ 'zhiduan' ] ) )$zhiduan = htmlspecialchars( $_POST[ 'zhiduan' ] );            //字段
if ( isset( $_POST[ 'scroll_left' ] ) )$scroll_left = $_POST[ 'scroll_left' ];                    //得到滚动条位置
if ( isset( $_POST[ 'c_ok' ] ) )$c_ok = htmlspecialchars( $_POST[ 'c_ok' ] );                     //初宽度
if ( $c_ok == 'undefined' )$c_ok = '';
if ( isset( $_POST[ 'b_ok' ] ) )$b_ok = htmlspecialchars( $_POST[ 'b_ok' ] );                     //后宽度
if ( $b_ok == 'undefined' )$b_ok = '';

if (function_exists($act)) {
	$act();
}else{
	echo NoZhiLing();
};
//======================================================================================================设定为使用原数据表
function edit_ajax() { //修改单独表中指定字段的值
	global $re_id,$Conn,$bh,$SYS_UserName,$hy,$const_id_fz,$const_id_bumen;
	
	if ( isset( $_POST[ 'Table_Name' ] ) )$Table_Name = $_POST[ 'Table_Name' ] ;
	if ( isset( $_POST[ 'zdname' ] ) )$zdname = $_POST[ 'zdname' ] ;
	if ( isset( $_POST[ 'id' ] ) )$id = $_POST[ 'id' ] ;
	if ( isset( $_POST[ 'nowvalue' ] ) )$nowvalue = $_POST[ 'nowvalue' ] ;
	$nowdate = date( 'Y-m-d H:i:s' );
	//echo $tableneme,$zdname,$id,$nowvalue;
	if ( $id > 0 ) {//修改
		$sql = "UPDATE  `$Table_Name`  set `$zdname` ='$nowvalue',`sys_adddate_g`='$nowdate' WHERE id='$id' ";
		//echo $sql;
	    mysqli_query( $Conn , $sql );

	}else{          //添加
		//echo $Table_Name,$zdname,$nowvalue;
		$sys_postzd_list = "$zdname,sys_const_re_id,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate"; //加上系统默认值
	    $sys_postvalue_list = "'$nowvalue','$re_id','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdate'";
	    //echo $sys_postvalue_list;
	    //--------------------------------------以下为执行添加
	    $sql = "insert into `$Table_Name` ($sys_postzd_list) values ($sys_postvalue_list)";
		//echo $sql;
	    mysqli_query( $Conn ,$sql ); //执行添加
	    //这里执行检查是否有同步的列
	    $now_add_id = ADD_Col_id( $Table_Name, $sys_postzd_list, $sys_postvalue_list ); //查询添加的id

	    //==========================================================查询到添加的id值
	    echo( $now_add_id );
		//Jilu_add_Modular($Table_Name,$zdname,$nowvalue);//添加数据
	}
}
//======================================================================================================分页设定更新
function fenye_update() { 
	global $re_id,$Conn,$hy;
	$sys_fenye ='';
	if ( isset( $_POST[ 'sys_fenye' ] ) )$sys_fenye = trim( $_POST[ 'sys_fenye' ] );

	$sql = 'select id From sys_fenye where sys_yfzuid=' . $hy . ' and sys_re_id=' . $re_id . ' and sys_huis <> 1 order by id Asc';
	// echo $sql;
	$rs = mysqli_query(  $Conn , $sql );
	$recordcount=mysqli_num_rows($rs);//得到总数
	mysqli_free_result( $rs ); //释放内存
	//echo $recordcount;
	if ( $recordcount == 0 ) {//没有时添加
		$sys_fenye='\''.$sys_fenye.'\',\''.$re_id.'\'';
		echo '_'.$sys_fenye.'_';
		Jilu_add_Modular( 'sys_fenye', 'sys_fenye,sys_re_id', $sys_fenye); //添加数据 并生成添加的id
		//echo "执行添加";
	}else{                    //有时更新
		Jilu_update_Modular( 'sys_fenye', "`sys_re_id`='$re_id'", 'sys_fenye', $sys_fenye ,$Conn); //改为原表模式
	}
}
//======================================================================================================设定为使用原数据表
function JL_updata_one() { //修改单独表中指定字段的值
	global $re_id,$Conn;
	$mdb_name = '';
	if ( isset( $_POST[ 'mdb_name' ] ) )$mdb_name = trim( $_POST[ 'mdb_name' ] );
	if ( $re_id <> 0 ) {
		Jilu_update_Modular( 'Sys_Jlmb', "`id`='$re_id'", 'mdb_use_type', 0 ,$Conn); //改为原表模式
	}
}
//======================================================================================================设定为使用原数据表
function JL_updata_changdata() { 
	if ( isset( $_POST[ 'Connnow' ] ) )     $Connnow = trim( $_POST[ 'Connnow' ] );                      //得到 表名
	if ( isset( $_POST[ 'tablename' ] ) )   $tablename = trim( $_POST[ 'tablename' ] );                //搜索 字段名
	if ( isset( $_POST[ 'id' ] ) )          $id = trim( $_POST[ 'id' ] );                                     //搜索值
	if ( isset( $_POST[ 'ziduan' ] ) )      $ziduan = trim( $_POST[ 'ziduan' ] );                         //需修改的 字段名
	if ( isset( $_POST[ 'newvale' ] ) )     $newvale = trim( $_POST[ 'newvale' ] );                      //修改后的值
	UpdataJilu($tablename,$id,$ziduan,$newvale);
}
//[ok]======================================================================================================修改记录
function edit_biao_col() { //修改单独表中指定字段的值【单条与多条均可】
	global $re_id,$Conn;
	$tableneme = $search_zd = $search_value = $tochang_zd = $tochang_value = '';
	if ( isset( $_POST[ 'tableneme' ] ) )$tableneme = trim( $_POST[ 'tableneme' ] );                //得到 表名
	if ( isset( $_POST[ 'search_zd' ] ) )$search_zd = trim( $_POST[ 'search_zd' ] );                //搜索 字段名
	if ( isset( $_POST[ 'search_value' ] ) )$search_value = trim( $_POST[ 'search_value' ] );       //搜索值
	if ( isset( $_POST[ 'tochang_zd' ] ) )$tochang_zd = trim( $_POST[ 'tochang_zd' ] );             //需修改的 字段名
	if ( isset( $_POST[ 'tochang_value' ] ) )$tochang_value = trim( $_POST[ 'tochang_value' ] );    //修改后的值
	if ( isset( $_POST[ 'onlyone' ] ) )$onlyone = intval( $_POST[ 'onlyone' ] );                    //单选1   多选为0
	
	
	//echo ('tableneme:'.$tableneme.'+search_zd:'.$search_zd.'+search_value:'.$search_value.'+tochang_zd:'.$tochang_zd.'+tochang_value:'.$tochang_value.'+onlyone:'.$onlyone);
	if($onlyone==1){
		Jilu_update_Modular( $tableneme, "`$tochang_zd`='1'", $tochang_zd, 0 ,$Conn);                     //先将查询到的所有数据设置为未选中，为后面再选中单个做基础。
	}
	if ( '1' . $tableneme != '1'
		and '1' . $search_zd != '1'
		and '1' . $search_value != '1'
		and '1' . $tochang_zd != '1' ) {
		Jilu_update_Modular( $tableneme, "`$search_zd`='$search_value'", $tochang_zd, $tochang_value ,$Conn); //修改记录
		//echo ($tableneme.'_'.$search_zd.'_'.$search_value.'_'.$tochang_zd.'_'.$tochang_value);
	} else {
		//echo($tableneme.'_'.$tochang_zd.'_'.$tochang_value);
		$tochang_zd .= ",re_id";
		$tochang_value .= ",$re_id";
		//echo "$tableneme, $tochang_zd, $tochang_value";
		Jilu_add_Modular( $tableneme, $tochang_zd, $tochang_value); //添加新记录
		//Jilu_update_Modular( $tableneme, "`$search_zd`='$search_value'" , $tochang_zd, $tochang_value ,$Conn); //修改记录
	};
	//MachineV1.0/moban_set_data.php?act=edit_biao_col&tableneme=Sys_jlmb&search_zd=id&search_value=321&tochang_zd=ul_row_height&tochang_value=29&re_id=321
};
//[ok]======================================================================================================字段排序
function ZiDuanPaiXu() {
	global $databiao,$Conn;
	$ZDList = '';
	if ( isset( $_POST[ 'ZDList' ] ) )$ZDList = trim( $_POST[ 'ZDList' ] ); //字段清单
	$ZDList = move_arrynull( QuChong( $ZDList ) ); //去重去空

	$fharry = explode( ',', $ZDList );

};
//======================================================================================================编辑修改字段类型
function ziduan_lx_edit() {
	global $databiao;
	$SSYSS_zdname = $SSYSS_xsys_id = $SSYSS_xsys = $Y_SSYSS_mrz = $SSYSS_cd = $SSYSS_xs = $SSYSS_zdlx = $nowzdlx = $nowbeizhu = '';
	if ( isset( $_POST[ 'SSYSS_zdname' ] ) )$SSYSS_zdname = trim( $_POST[ 'SSYSS_zdname' ] ); //字段名字
	if ( isset( $_POST[ 'SSYSS_xsys_id' ] ) )$SSYSS_xsys_id = substr( trim( $_POST[ 'SSYSS_xsys_id' ] ), 0, 3 ); //样式ID
	if ( isset( $_POST[ 'SSYSS_xsys' ] ) )$SSYSS_xsys = trim( $_POST[ 'SSYSS_xsys' ] ); //显示样式名称
	if ( isset( $_POST[ 'Y_SSYSS_mrz' ] ) )$Y_SSYSS_mrz = trim( $_POST[ 'Y_SSYSS_mrz' ] ); //原默认值
	if ( isset( $_POST[ 'SSYSS_mrz' ] ) )$SSYSS_mrz = trim( $_POST[ 'SSYSS_mrz' ] ); //目的默认值
	if ( isset( $_POST[ 'SSYSS_cd' ] ) )$SSYSS_cd = intval( substr( trim( $_POST[ 'SSYSS_cd' ] ), 0, 15 ) ); //长度
	if ( '1' . $SSYSS_cd == '1'
		or $SSYSS_cd == 0 )$SSYSS_cd = 50;
	if ( isset( $_POST[ 'SSYSS_xs' ] ) )$SSYSS_xs = intval( substr( trim( $_POST[ 'SSYSS_xs' ] ), 0, 2 ) ); //小数位数
	if ( '1' . $SSYSS_xs == '1' )$SSYSS_xs = 2;
	if ( isset( $_POST[ 'SSYSS_zdlx' ] ) )$SSYSS_zdlx = substr( trim( $_POST[ 'SSYSS_zdlx' ] ), 0, 20 ); //字段数据类型int

	$nowzdlx = str_replace( '$sys_xs_s$', $SSYSS_xs, str_replace( '$sys_kd_s$', $SSYSS_cd, $SSYSS_zdlx ) ); //替换成var(x,y)样式
	//$nowzdlx=str_replace('$sys_xs_s$',$SSYSS_xs,$SSYSS_zdlx);
	$nowbeizhu = updateN( colbeizhu( $databiao, $SSYSS_zdname ), 3, $SSYSS_xsys_id, ',' ); //.$databiao.$SSYSS_zdname.$nowzdlx.$SSYSS_mrz得到备注并更换
	ziduan_edit_Modular( $databiao, $SSYSS_zdname, $SSYSS_zdname, $nowbeizhu, $nowzdlx, $SSYSS_mrz ); //更新备注、类型、默认值
	//echo ($databiao);
	//echo ($SSYSS_zdname.','.$SSYSS_xsys_id.','.$SSYSS_xsys.','.$SSYSS_mrz.','.$SSYSS_cd.','.$SSYSS_xs.','.$SSYSS_zdlx)FuZeRen,33,短日期/时,getdate(),,0,smalldatetime;
};
//======================================================================================================密码修改
function MimaXG() {
	global $Connadmin, $const_id_login, $hy; //得到全局变量
	$ymima = $Xmima = $Xmima2 = '';
	if ( isset( $_POST[ 'ymima' ] ) )$ymima = trim( $_POST[ 'ymima' ] );
	if ( isset( $_POST[ 'Xmima' ] ) )$Xmima = trim( $_POST[ 'Xmima' ] );
	if ( isset( $_POST[ 'Xmima2' ] ) )$Xmima2 = trim( $_POST[ 'Xmima2' ] );
	if ( $ymima <> ''
		and $Xmima <> ''
		and $Xmima2 <> ''
		and $Xmima == $Xmima2 ) { //三个不为空
		$sql = "select * From `msc_user_reg` where (id='$const_id_login' and sys_yfzuid='$hy')";
		$rs = mysqli_query(  $Connadmin , $sql );
		$row = mysqli_fetch_array( $rs );
		if ( !$row ) {
			//echo ('修改失败！原密码错误!')
			echo( "<script>$('#ymima_error').html('修改失败！原密码错误!')</script>" );
		} elseif ( $Xmima <> $Xmima2 ) {
			echo( '修改失败！新密码两次输入不一致!' );
		} else { //员工验证通过时执行
			$SYS_PassWord = md5( $Xmima );
			$userid = $row[ 'id' ];
			Jilu_update_Modular( 'msc_user_reg', "`id`='$userid'", 'SYS_PassWord', $SYS_PassWord ,$Connadmin); //删到回收站//执行更新
			echo( '密码修改成功！请退出后使用新密码登入！' );
		};
		mysqli_free_result( $rs ); //释放内存
	}; //if end
}; //function end
//======================================================================================================修改
function edit_Text_Post() {
	global $bh, $hy, $reg_num;
	$Table_Name='MSC_User_Reg';
	$Conn=ChangeConn($Table_Name);    //依据表自动选择数据库
	
	$note_text = '';
	if ( isset( $_POST[ 'note_text' ] ) )$note_text = $_POST[ 'note_text' ];
	$sql = "select * From MSC_User_Reg where (SYS_GongHao='" . $bh . "' and $reg_num='" . $hy . "')";
	$rs = mysqli_query(  $Conn , $sql );
	if ( !$row = mysqli_fetch_array( $rs ) ) {
		echo( '保存失败！系统错误!' );
	} else { //员工验证通过时执行
		$row[ 'note_text' ] = $note_text;
		//mysqli_query( $Conn , $sql );//执行添加与更新
		echo( '保存成功！' );
	}; // if end
}; //function end
//======================================================================================================添加修改单独表
function daohangmenu() { //修改单独表中指定字段的值，及添加值 //act=daohangmenu.$fieldsname=总经理.newfieldsname=总经理2.fieldsTable=msc_zhiwei.newfieldsnameZD=zu.bigid=43.bigZD=id.Tsid=1.Tszd=id.GXzd=bumen;
	global $Conn, $re_id; //得到全局变量
	$fieldsTable = $newfieldsnameZD = $fieldsname = $newfieldsname = $nowTsid = $nowTszd = $nowGXzd = $nowbigid = $nowbigZD = $sys_postzd_list = $sys_postvalue_list = '';
	if ( isset( $_REQUEST[ 'fieldsTable' ] ) )$fieldsTable = $_REQUEST[ 'fieldsTable' ];             //表名:      msc_zhiwei
	if ( isset( $_REQUEST[ 'newfieldsnameZD' ] ) )$newfieldsnameZD = $_REQUEST[ 'newfieldsnameZD' ]; //字段名     zu
	if ( isset( $_REQUEST[ 'fieldsname' ] ) )$fieldsname = $_REQUEST[ 'fieldsname' ];                //原值       总经理
	if ( isset( $_REQUEST[ 'newfieldsname' ] ) )$newfieldsname = $_REQUEST[ 'newfieldsname' ];       //新值       总经理2
	if ( isset( $_REQUEST[ 'Tsid' ] ) )$nowTsid = intval( $_REQUEST[ 'Tsid' ] );                     //当前ID     1
	if ( isset( $_REQUEST[ 'Tszd' ] ) )$nowTszd = $_REQUEST[ 'Tszd' ];                               //当前字段    id
	if ( isset( $_REQUEST[ 'GXzd' ] ) )$nowGXzd = $_REQUEST[ 'GXzd' ];                               //关系字段    bumen
	if ( isset( $_REQUEST[ 'bigid' ] ) )$nowbigid = intval( $_REQUEST[ 'bigid' ] );                  //上级大类ID  43
	if ( isset( $_REQUEST[ 'bigZD' ] ) )$nowbigZD = $_REQUEST[ 'bigZD' ];                            //大类字段    id
	//all Jilu_update_Modular('msc_zhiwei',"`bumen`='1'" ,'zu','总经理2',$Conn)                       //更新单条的对应表
    
	if ( '1' . $fieldsname == '1' ) { //当没有时添加大类
		//echo $newfieldsnameZD;
		$sys_postzd_list = trim( $newfieldsnameZD ); //字段名
		$sys_postvalue_list = "'" . trim( $newfieldsname ) . "'"; //对应值

		if ( $fieldsTable == 'Sys_ZuAll' ) {
			$sys_postzd_list = trim( $sys_postzd_list, ',' ) . ',re_id'; //字段名
			$sys_postvalue_list = trim( $sys_postvalue_list, ',' ) . ",'" . $re_id . "'"; //对应值
		};

		if ( $nowGXzd . '1' != '1'
			and $nowbigid . '1' != '1' ) { //有上级大类id时
			$sys_postzd_list = trim( $sys_postzd_list, ',' ) . ',' . $nowGXzd; //大类字段名
			$sys_postvalue_list = trim( $sys_postvalue_list, ',' ) . ",'" . $nowbigid . "'"; //对应值
		};
		//$sys_postzd_list=trim($sys_postzd_list,",");
		//echo $sys_postzd_list."_".$sys_postvalue_list;
		Jilu_add_Modular( $fieldsTable, $sys_postzd_list, $sys_postvalue_list); //执行添加
		//exit;
		//===========================查询到记录ID值返回
		$nowid1 = MAX_col_id( $fieldsTable, $newfieldsnameZD, $newfieldsname );
		echo( $nowid1 ); //这里为必须的输出，为添加后返回的id值
	} else { //有时便更新
		$wheretext=" `$nowTszd`='$nowTsid' ";
		//echo ($fieldsTable.";".$wheretext.";".$newfieldsnameZD.";".$newfieldsname);
		Jilu_update_Modular( $fieldsTable,$wheretext,$newfieldsnameZD,$newfieldsname ,$Conn); //更新单条的对应表
	};
};
////*************************************************表处理*************************************////
//[ok]======================================================================================================添加修改质量记录清单
function Table_Edit_Jlmb() {
	global $Conn, $hy, $bh, $SYS_UserName, $const_id_fz, $const_id_bumen; //得到全局变量
	$fieldsname = $fieldsnamePY = $newfieldsname = $newfieldsnamePY = ''; 
	$nowbigid = 0;
	if ( isset( $_POST[ 'Tsid' ] ) )$nowTsid = intval( $_POST[ 'Tsid' ] );                       //记录清单id
	if ( isset( $_POST[ 'fieldsname' ] ) )$fieldsname = $_POST[ 'fieldsname' ];                  //原名称cn
	if ( isset( $_POST[ 'fieldsnamePY' ] ) )$fieldsnamePY = $_POST[ 'fieldsnamePY' ];            //原名称拼英en
	if ( isset( $_POST[ 'newfieldsname' ] ) )$newfieldsname = $_POST[ 'newfieldsname' ];         //新名称cn
	if ( isset( $_POST[ 'newfieldsnamePY' ] ) )$newfieldsnamePY = $_POST[ 'newfieldsnamePY' ];   //新名称拼音en
	if ( isset( $_POST[ 'bigid' ] ) )$nowbigid = intval( $_POST[ 'bigid' ] ); //上级大类ID  43
    //echo "$nowTsid'_'$fieldsname'_'$fieldsnamePY'_'$newfieldsname'_'$newfieldsnamePY'_'$nowbigid";
	if ( '1' . $fieldsname == '1' and $nowTsid==0) {                                             //在记录模版中添加
		//echo "添加";
		table_add_Modular( $newfieldsnamePY,$newfieldsname,$nowbigid,0);                         //添加/修改新表及备注
	} else {                                                                                     //在记录模版中修改
		//echo "修改";
		table_edit_Modular($fieldsnamePY, $newfieldsnamePY, $newfieldsname,$nowTsid);            //修改 原表名en,新表名en,备注cn
		update_sys_top_menu($nowTsid,$newfieldsname);                                            //更新sys_top_menu菜单名
	}
}
//======================================================================================================删除表、表备注
function biao_del() {
	$fieldsname = '';
	if ( isset( $_POST[ 'fieldsname' ] ) )$fieldsname = trim( $_POST[ 'fieldsname' ] ); //删除表
	if ( $fieldsname <> '' ) {
		table_del_Modular( $fieldsname ); //$Table_Name表名
	};
};
//======================================================================================================添加、修改字段及说明
function ziduan_edit() { //添加也在这里
	global $Conn, $xt_m_ziduan, $databiao; //得到全局变量
	$fieldsname = $newfieldsname = '';
	if ( isset( $_POST[ 'fieldsname' ] ) )$fieldsname = trim( $_POST[ 'fieldsname' ] );                     //原值
	if ( isset( $_POST[ 'newfieldsname' ] ) )$newfieldsname = trim($_POST[ 'newfieldsname' ] );             //新值
	if ( isset( $_POST[ 'thisvalue' ] ) )$thisvalue = htmlspecialchars( trim( $_POST[ 'thisvalue' ] ) );    //当前中文名
	if ( getN( $xt_m_ziduan, $fieldsname ) >= 0 ) { //当为系统字段时不保持原值
		$newfieldsname = $fieldsname;
	}
	echo $fieldsname;
	if ( $fieldsname != '' ) { //修改数据表字段名
		echo $databiao.';', $fieldsname.';', $newfieldsname.';', $thisvalue.';';
		ziduan_edit_Modular( $databiao, $fieldsname, $newfieldsname, $thisvalue, '', '' ); //更新字段名及备注
		
	} else { //以下为新增字段
		$fieldtype = 'varchar(255)';
		$morenzhi = '';
		$thisvalue .= ',80,0,0,2,0,0,0,0,0,0,0,0,0,0';
		echo $databiao.';', $newfieldsname.';', $fieldtype.';', $thisvalue.';', $morenzhi.';';
		ziduan_add_Modular( $databiao, $newfieldsname, $fieldtype, $thisvalue, $morenzhi ); //这里添加字段、类型、备注
	};

};
//======================================================================================================修改字段说明中权限
function ziduan_beizhu_edit(){
		
	$tableneme = trim($_POST['tableneme']);    //表名
	$zd_en_name = trim($_POST['zd_en_name']);  //字段名
	$zdname = trim($_POST['ziduanname']);      //权限属性名
	$thisvalue=trim($_POST['thisvalue']);      //备注名
	$moren=isset($_POST['moren'])?$_POST['moren']:'';                    //默认值
		//echo $moren;
	//$danxuan=trim($_POST['danxuan']);          //danxuan代表单选
	//echo "$moren,$tableneme,$zd_en_name,$thisvalue";
	//echo $tableneme;
	$nowbeizhu=findzdbeizhu($tableneme,$zd_en_name); //查询到原始表备注信息
		//0【备注】,1【显示宽】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】
	//echo $nowbeizhu;
		$fh=',';
	switch ( $zdname ) {
		case 'zd_cn_name': //----------------------------- 【字段说明】    0
			
			break;
		case 'zd_xianshi_width': //----------------------- 【显示宽度】    1
			if($thisvalue==''){
				$thisvalue=1;   //宽度当为空时设定为1
			}
			$nowbeizhu=updateN( $nowbeizhu, 1, $thisvalue, $fh );
			break;
		case 'qx_bitian': //------------------------------ 【必填】       2
			$nowbeizhu=updateN( $nowbeizhu, 2, $thisvalue, $fh );
			break;
		case 'qx_wuchongfu': //--------------------------- 【无重复】     3
			$nowbeizhu=updateN( $nowbeizhu, 3, $thisvalue, $fh );
			break;
		case 'XStype': //--------------------------------- 【显示样式id】  4
			$nowbeizhu=updateN( $nowbeizhu, 4, $thisvalue, $fh );
			ziduan_edit_Modular( $tableneme, $zd_en_name,'','','',$thisvalue,'changbeizhu'); //这里强行更新默认值
			
			break;
		case 'zd_Default': //----------------------------- 【默认值】
			ziduan_edit_Modular( $tableneme, $zd_en_name,'','','',$thisvalue,'changbeizhu'); //这里强行更新默认值
			break;
		case 'qx_xianshi': //----------------------------- 【显示】        5
			// echo $nowbeizhu."_".$thisvalue."_".$fh;
			$nowbeizhu=updateN( $nowbeizhu, 5, $thisvalue, $fh );
			// echo $nowbeizhu;
			break;
		case 'qx_shuoding': //---------------------------- 【冻结】        6
			$nowbeizhu=updateN( $nowbeizhu, 6, $thisvalue, $fh );
			ziduan_edit_Modular( $tableneme, $zd_en_name,'', $nowbeizhu, '', ''); //这里更新备注
			break;
		case 'qx_tianjia': //----------------------------- 【添加】        7
			$nowbeizhu=updateN( $nowbeizhu, 7, $thisvalue, $fh );
			break;
		case 'now_xiugai': //----------------------------- 【修改】        8
			$nowbeizhu=updateN( $nowbeizhu, 8, $thisvalue, $fh );
			break;
		case 'now_baidu': //----------------------------- 【百度】        9
			$nowbeizhu=updateN( $nowbeizhu, 9, $thisvalue, $fh );
			break;
		case 'zd_xianshi_height': //----------------------- 【显示高度】    10
			if($thisvalue==''){
				$thisvalue=1;   //宽度当为空时设定为1
			}
			$nowbeizhu=updateN( $nowbeizhu, 10, $thisvalue, $fh );
			break;
		case 'qx_xianshi_mobile': //---------------------- 【M显示】       11
			$nowbeizhu=updateN( $nowbeizhu, 11, $thisvalue, $fh );
			break;
		case 'qx_shuoding_mobile': //--------------------- 【M冻结】       12
			$nowbeizhu=updateN( $nowbeizhu, 12, $thisvalue, $fh );//最多选一项
			
			break;
		default:
			echo NoZhiLing();
	}
	// echo $zdname;
	if($zdname<>"zd_Default" &&  $zdname<>"qx_shuoding"){
		// echo $tableneme."_".$zd_en_name."_".$nowbeizhu;
		ziduan_edit_Modular( $tableneme, $zd_en_name,'', $nowbeizhu, '', ''); //这里更新备注
	}
	
	if($zdname=="XStype"){
		ziduan_edit_Modular( $tableneme, $zd_en_name,'','','',$moren,'changbeizhu'); //这里强行更新默认值
	}
	//echo $nowbeizhu;
	//if ($newfieldsname <>'' and $fieldsname <>'' and $databiao <>'') then   //修改数据表字段名

	//end if
};
//======================================================================================================删除字段
function ziduan_del() {
	global $Conn, $databiao; //得到全局变量
	$fieldsname = '';
	if ( isset( $_POST[ 'fieldsname' ] ) )$fieldsname = trim( $_POST[ 'fieldsname' ] );
	if ( $databiao . '1' != '1'	and $fieldsname <> '' ) {
		ziduan_del_Modular( $databiao, $fieldsname ); //删除字段
	}
}
//======================================================================================================修改权限
function quanxian() {
	global $databiao, $re_id;
	$beizhucolid = $thisvalue = $nowziduan = $updatecolname = $nowbeizhu = '';
	if ( isset( $_POST[ 'beizhucolid' ] ) )$beizhucolid = intval( trim( $_POST[ 'beizhucolid' ] ) );
	if ( isset( $_POST[ 'thisvalue' ] ) )$thisvalue = intval( trim( $_POST[ 'thisvalue' ] ) );
	if ( isset( $_POST[ 'zd' ] ) )$nowziduan = htmlspecialchars( trim( $_POST[ 'zd' ] ) );
	if ( isset( $_POST[ 'updatecolname' ] ) )$updatecolname = htmlspecialchars( trim( $_POST[ 'updatecolname' ] ) );

	$nowbeizhu = updateN( colbeizhu( $databiao, $nowziduan ), $beizhucolid, $thisvalue, ',' ); //得到备注并更换
	ziduan_edit_Modular( $databiao, $nowziduan, $nowziduan, $nowbeizhu, '', '' ); //更新备注
};
//=================================================================================================以下为表头动态改变
function e_kd() { //表头拖动改变列宽更新数据
	//echo (zd_xu)
	global $Conn, $re_id, $databiao, $zhiduan, $nowbeizhu, $kd; //得到全局变量
	$nowbeizhu = '';
	    
		echo $databiao.','. $zhiduan.','.$nowbeizhu.','.$kd;
		//mysqli_query( $Conn , $sql );//执行添加与更新

		$nowbeizhu=updateN( findzdbeizhu($databiao,$zhiduan), 1,$kd, ',');       //得到备注并更换宽度
		  
	    ziduan_edit_Modular( $databiao, $zhiduan, $zhiduan, $nowbeizhu, '', '' ); //更新备注
	/**/
	
};
function e_col() { //表头列位置改变
	global $Conn, $c_ok, $b_ok, $databiao, $re_id, $scroll_left; //得到全局变量
	
	
	if ( isset( $_POST[ 'scroll_left' ] ) )$scroll_left = $_POST[ 'scroll_left' ];                     //当前字段
	
	if ( isset( $_POST[ 'sys_const_Start_Suoding' ] ) )$sys_const_Start_Suoding = $_POST[ 'sys_const_Start_Suoding' ];     //1从锁定列开始
	if ( isset( $_POST[ 'sys_const_End_Suoding' ] ) )$sys_const_End_Suoding = $_POST[ 'sys_const_End_Suoding' ];           //结束时，1在锁定列上 0没在锁定列上
	
	if ( isset( $_POST[ 'sys_const_this_zd' ] ) )$sys_const_this_zd = $_POST[ 'sys_const_this_zd' ];                     //当前字段
	if ( isset( $_POST[ 'sys_const_prev_zd' ] ) )$sys_const_prev_zd = $_POST[ 'sys_const_prev_zd' ];                     //前一个字段
	
	if ( isset( $_POST[ 'sys_const_ChangePrev_zd' ] ) )$sys_const_ChangePrev_zd = $_POST[ 'sys_const_ChangePrev_zd' ];   //改变后前一个字段
	if ( isset( $_POST[ 'sys_const_ChangeNext_zd' ] ) )$sys_const_ChangeNext_zd = $_POST[ 'sys_const_ChangeNext_zd' ];   //改变后后一面字段
	//echo  $sys_const_this_zd.'_'.$sys_const_prev_zd.'_'.$sys_const_ChangePrev_zd.'_'.$sys_const_ChangeNext_zd.'_';
	
	if ( $sys_const_this_zd <> '' and $sys_const_prev_zd <> '' and  $sys_const_ChangePrev_zd <> '' and $sys_const_ChangeNext_zd<>'') {//在中间时
		//sys_const_ChangePrev_zd后面插入sys_const_this_zd
		ZiDuan_PaiXu( $databiao,$sys_const_this_zd,$sys_const_ChangePrev_zd,'after');//往后插入
	}elseif($sys_const_this_zd <> '' and $sys_const_prev_zd <> '' and  $sys_const_ChangePrev_zd == '' and $sys_const_ChangeNext_zd<>''){
		ZiDuan_PaiXu( $databiao,$sys_const_this_zd,$sys_const_ChangePrev_zd,'first');//排到第一
	}elseif( $sys_const_this_zd <> '' and $sys_const_prev_zd <> '' and  $sys_const_ChangePrev_zd <> '' and $sys_const_ChangeNext_zd==''){
		ZiDuan_PaiXu( $databiao,$sys_const_this_zd,$sys_const_ChangePrev_zd,'after');//往后插入
	};
	//echo $sys_const_Start_Suoding.'_'.$sys_const_End_Suoding;
	
	//以下为执行锁定列
	if($sys_const_Start_Suoding=='1' and $sys_const_End_Suoding=='0'){        //从锁定列移到非锁定列时   $sys_const_this_zd改变其状态为非锁定
		
         $nowbeizhu=updateN( findzdbeizhu($databiao,$sys_const_this_zd), 6,'0', ',');//得到备注并更换
		  
	     ziduan_edit_Modular( $databiao, $sys_const_this_zd, $sys_const_this_zd, $nowbeizhu, '', '' ); //更新备注
		
	}elseif($sys_const_Start_Suoding == 0 and $sys_const_End_Suoding == 1){   //从非锁定 => 移动到锁定列  $sys_const_this_zd 变成锁定
		  
		$nowbeizhu=updateN( findzdbeizhu($databiao,$sys_const_this_zd), 6,'1', ',');//得到备注并更换
		 //echo $nowbeizhu;
	     ziduan_edit_Modular( $databiao, $sys_const_this_zd, $sys_const_this_zd, $nowbeizhu, '', '' ); //更新备注
		
	}
	
	echo '<script>document.all.content.scrollLeft=' . $scroll_left . ';</script>';//返回横向滚动条位置
    /**/
};
//【ok】================================================================================================职能分配表编辑
function Edit_Bmquanxian() {
	global $Connadmin,$Conn; //得到全局变量
	$rs = $strsql = $hy = $colsre_id = $nowchecked = $nowbumenid = $nowinputname = $nowrstext = '';
	if ( isset( $_POST[ 'hy' ] ) )$hy = intval( $_POST[ 'hy' ] ); //会员
	if ( isset( $_POST[ 'colsre_id' ] ) )$colsre_id = trim( $_POST[ 'colsre_id' ] ); //记录编号
	if ( isset( $_POST[ 'nowchecked' ] ) )$nowchecked = trim( $_POST[ 'nowchecked' ] ); //选中状态
	if ( isset( $_POST[ 'nowbumenid' ] ) )$nowbumenid = trim( $_POST[ 'nowbumenid' ] ); //部门id
	if ( isset( $_POST[ 'nowinputname' ] ) )$nowinputname = trim( $_POST[ 'nowinputname' ] ); //选项框名
	//http://localhost/MachineV1.0/moban_set_data.php?act=Edit_Bmquanxian&colsre_id=383&nowinputname=SYS_b_m43&nowchecked=checked&nowbumenid=43&hy=9007
	//colsarry=trim($_POST['colsarry']);//部门ID集合
	if ( $colsre_id . '1' != '1'
		and $nowbumenid . '1' != '1' ) {
		//=========================================将$colsre_id在所有部门中去除
		$sql = 'select quanxianlist From msc_bumenlist where sys_yfzuid=' . $hy . ' and id=' . $nowbumenid;
		$rs = mysqli_query(  $Connadmin , $sql );

		if ( $row = mysqli_fetch_array( $rs ) ) {
			$nowrstext = move_arrynull( $row[ 'quanxianlist' ] ); //得到当前部门的职能分配清单
			if ( $nowchecked == 'checked' ) { //当为选中时
				$nowrstext = $nowrstext . ',' . $colsre_id . ',';
			} else {
				$nowrstext = movetext( $nowrstext, $colsre_id ) . ',';
			};
			$nowrstext = QuChong( trim( $nowrstext, ',' ) );
			//echo ($nowrstext);
			Jilu_update_Modular( 'msc_bumenlist', "`id`='$nowbumenid'", 'quanxianlist', $nowrstext ,$Connadmin); ////执行更新
		};
		mysqli_free_result( $rs ); //释放内存
	};
};
//[ok]==================================================================================================职责权限更新
function Edit_ZWquanxian_Update() { //职权更新
	global $Conn,$Connadmin; //得到全局变量
	$colsre_id = $nowchecked = $nowbumenid = $nowinputname = $nowrstext = $nowq_fanwei = $removearry = '';
	if ( isset( $_POST[ 'hy' ] ) )$hy = intval( trim( $_POST[ 'hy' ] ) );                          //会员
	if ( isset( $_POST[ 'colsre_id' ] ) )$colsre_id = trim( $_POST[ 'colsre_id' ] );               //记录编号
	if ( isset( $_POST[ 'nowchecked' ] ) )$nowchecked = trim( $_POST[ 'nowchecked' ] );            //选中状态
	if ( isset( $_POST[ 'nowbumenid' ] ) )$nowbumenid = intval( trim( $_POST[ 'nowbumenid' ] ) );  //职位id
	if ( isset( $_POST[ 'nowinputname' ] ) )$nowinputname = trim( $_POST[ 'nowinputname' ] );      //字段名
	if ( isset( $_POST[ 'checkvalue' ] ) )$checkvalue = trim( $_POST[ 'checkvalue' ] );            //选中值
	//echo ("hy=".$hy.".nowchecked=".$nowchecked.".nowbumenid=".$nowbumenid.".nowinputname=".$nowinputname);
	//--------------------------------------------以下为更新对应权限
	if ( $colsre_id . '1' != '1' and $nowbumenid . '1' != '1' and $nowinputname . '1' != '1' ) {
		//=========================================将$colsre_id在所有部门中去除
		$sql = 'select ' . $nowinputname . ' From msc_zhiwei where sys_yfzuid=' . $hy . ' and id=' . $nowbumenid;
		$rs = mysqli_query(  $Connadmin , $sql );
		// echo ($sql);
		if ( $row = mysqli_fetch_array( $rs ) ) {
			$nowrstext = $row[ $nowinputname ]; //得到当前职位的职能分配清单

			if ( $nowinputname == 'sys_q_fanwei' ) { //当为管理范围时
				$removearry = $colsre_id . '_0,' . $colsre_id . '_1,' . $colsre_id . '_2,' . $colsre_id . '_3'; //需去除的所有权限
				$nowrstext = TwoArryQuChong( $nowrstext, $removearry, ',' ); //先去除所有权限
				echo ($nowrstext);

				$nowq_fanwei = $colsre_id . '_' . $checkvalue; //需添加的权限190_2
				//act=Edit_ZWquanxian_Update&colsre_id=190&nowinputname=sys_q_fanwei&nowchecked=undefined&nowbumenid=2&hy=9007

				$nowrstext .= ',' . $nowq_fanwei; //在权限里加上该权限值
				
				$nowrstext = move_arrynull( QuChong( $nowrstext ) ); //去空和重值
				//echo "'msc_zhiwei', 'id', $nowbumenid, $nowinputname, $nowrstext";
				Jilu_update_Modular( 'msc_zhiwei', "`id`='$nowbumenid'", $nowinputname, $nowrstext ,$Connadmin); ////执行更新
			} else {
				if ( $nowchecked == 'checked' ) { //当为选中时
					$nowrstext .= ',' . $colsre_id;
				} else {
					$nowrstext = movetext( $nowrstext, $colsre_id ) . ',';
				};
				$nowrstext = move_arrynull( $nowrstext );
				//echo (" 'msc_zhiwei', "`id`='$nowbumenid'" , '$nowinputname', '$nowrstext' ");
				Jilu_update_Modular( 'msc_zhiwei', "`id`='$nowbumenid'", $nowinputname, $nowrstext ,$Connadmin); ////执行更新
				Sys_Zu_ZhiWei_bigmenu_updata( $nowbumenid ); //以下为更新对应大类菜单
			};
		};
		mysqli_free_result( $rs ); //释放内存
	};
};
//[ok]==================================================================================================职责权限更新[多个权限同时设定]
function Edit_ZWquanxian_Update_hengxiang() {                                                          //职权更新
	global $Conn,$Connadmin,$hy; //得到全局变量
	$colsre_id = $nowchecked = $nowbumenid = $nowinputname = $nowrstext = $nowq_fanwei = $removearry = '';
	if ( isset( $_POST[ 'colsre_id' ] ) )$colsre_id = trim( $_POST[ 'colsre_id' ] );               //记录编号
	if ( isset( $_POST[ 'nowchecked' ] ) )$nowchecked = trim( $_POST[ 'nowchecked' ] );          //选中状态
	if ( isset( $_POST[ 'ZhiWei_id' ] ) )$ZhiWei_id = intval( trim( $_POST[ 'ZhiWei_id' ] ) );     //职位id
	
	//--------------------------------------------以下为更新对应权限
	if ( $colsre_id . '1' != '1'	and $ZhiWei_id . '1' != '1') { 
		//=========================================将$colsre_id在所中去除
		$sql = 'select * From `msc_zhiwei` where sys_yfzuid=' . $hy . ' and id=' . $ZhiWei_id;
		$rs = mysqli_query(  $Connadmin , $sql );
		//echo ($strsql)
		if ( $row = mysqli_fetch_array( $rs ) ) {
			$now_q_cak=$row['sys_q_cak'];             //查看
			$now_q_tianj=$row['sys_q_tianj'];         //添加
			$now_q_xiug=$row['sys_q_xiug'];           //修改
			$now_q_shenghe=$row['sys_q_shenghe'];     //审核
			$now_q_pizhun=$row['sys_q_pizhun'];       //批准
			$now_q_zhixing=$row['sys_q_zhixing'];     //执行
			$now_q_shanc=$row['sys_q_shanc'];         //删除
			$now_q_huis=$row['sys_q_huis'];           //回收
			$now_q_dayin=$row['sys_q_dayin'];         //打印
			$now_q_xiaohui=$row['sys_q_xiaohui'];     //销毁
            $now_q_seid=$row['sys_q_seid'];           //设定
            if($nowchecked==1){//批量选中
				//以下为批量添加的处理结果值
			    $now_q_cak=move_arrynull( QuChong( $now_q_cak.','.$colsre_id ) );             //查看
				$now_q_tianj=move_arrynull( QuChong( $now_q_tianj.','.$colsre_id ) );         //添加
				$now_q_xiug=move_arrynull( QuChong( $now_q_xiug.','.$colsre_id ) );           //修改
				$now_q_zhixing=move_arrynull( QuChong( $now_q_zhixing.','.$colsre_id ) );     //执行
				$now_q_shenghe=move_arrynull( QuChong( $now_q_shenghe.','.$colsre_id ) );     //审核
				$now_q_pizhun=move_arrynull( QuChong( $now_q_pizhun.','.$colsre_id ) );       //批准
				$now_q_shanc=move_arrynull( QuChong( $now_q_shanc.','.$colsre_id ) );         //删除
				$now_q_huis=move_arrynull( QuChong( $now_q_huis.','.$colsre_id ) );           //回收
				$now_q_dayin=move_arrynull( QuChong( $now_q_dayin.','.$colsre_id ) );         //打印
				$now_q_xiaohui=move_arrynull( QuChong( $now_q_xiaohui.','.$colsre_id ) );     //销毁
				$now_q_seid=move_arrynull( QuChong( $now_q_seid.','.$colsre_id ) );           //设定
		        
			}else{             //批量不选中
				                                                                              //先去除所有权限
				
			    $now_q_cak=TwoArryQuChong( $now_q_cak, $colsre_id, ',' );                     //查看
				$now_q_tianj=TwoArryQuChong( $now_q_tianj, $colsre_id, ',' );                 //添加
				$now_q_xiug=TwoArryQuChong( $now_q_xiug, $colsre_id, ',' );                   //修改
				$now_q_zhixing=TwoArryQuChong( $now_q_zhixing, $colsre_id, ',' );             //执行
				$now_q_shenghe=TwoArryQuChong( $now_q_shenghe, $colsre_id, ',' );             //审核
				$now_q_pizhun=TwoArryQuChong( $now_q_pizhun, $colsre_id, ',' );               //批准
				$now_q_shanc=TwoArryQuChong( $now_q_shanc, $colsre_id, ',' );                 //删除
				$now_q_huis=TwoArryQuChong( $now_q_huis, $colsre_id, ',' );                   //回收
				$now_q_dayin=TwoArryQuChong( $now_q_dayin, $colsre_id, ',' );                 //打印
				$now_q_xiaohui=TwoArryQuChong( $now_q_xiaohui, $colsre_id, ',' );             //销毁
				$now_q_seid=TwoArryQuChong( $now_q_seid, $colsre_id, ',' );                   //设定
				
			}
		}
		mysqli_free_result( $rs ); //释放内存
		
		$sql = "UPDATE  `msc_zhiwei`  set  `sys_q_cak` ='$now_q_cak', `sys_q_tianj` ='$now_q_tianj', `sys_q_xiug` ='$now_q_xiug', `sys_q_zhixing` ='$now_q_zhixing', `sys_q_shenghe` ='$now_q_shenghe', `sys_q_pizhun` ='$now_q_pizhun', `sys_q_shanc` ='$now_q_shanc', `sys_q_huis` ='$now_q_huis', `sys_q_dayin` ='$now_q_dayin', `sys_q_xiaohui` ='$now_q_xiaohui',`sys_q_seid` ='$now_q_seid' WHERE id=$ZhiWei_id ";
	       //echo $sql;
	    mysqli_query(  $Connadmin , $sql );
	}
}
function Edit_ZWquanxian_Update_new() { //职权更新
    global $hy,$db;
	$modRoles_pc = $_SESSION['modRoles_pc'];
	$re_id = $modRoles_pc['re_id'];
	$modRoles_pc_id = [];
	foreach ($modRoles_pc['data'] as $object) {
		$modRoles_pc_id[$object['id']] = $object;
	}
    $session_keys = ['id', 'checked', 'checkName'];
    $returnData = array(
        'data' => null,
        'error' => null
    );

	$thisError = function ($text) use (&$returnData){
		$returnData['error'] = $text;
		echo json_encode($returnData, JSON_UNESCAPED_UNICODE);
	};

    foreach ($session_keys as $item) {
        if (isset($_POST['data'][$item])) {
            $$item = $_POST['data'][$item];  // 修正此处，使用数组索引
        } else {
            $thisError($returnData,"异常错误: $item:".$$item);
            return;
        }
    }
	
	if (isset($modRoles_pc_id[$id])) {
		$foundObject = $modRoles_pc_id[$id];
	} else {
		$thisError($returnData,"异常错误: 没有权限!!!!");
		return ;
	}

	$sql = "select * From msc_zhiwei where sys_yfzuid= $hy and id = $id";
	$queryResult = $db->query($sql);
	if ($queryResult['error'] == null) {
		if ($db->numRows($queryResult['result']) > 0) {
			$result = mysqli_fetch_assoc($queryResult['result']);
		}
	}else{
		$thisError($returnData,"异常错误: 没有权限!!!");
		return ;
	}

	if ( $checkName == 'sys_q_fanwei' ) { //当为管理范围时
		if($foundObject['permissionControl'] && $foundObject['permissionControl']['fanwei'] >= $checked){
			$removearry = $re_id . '_0,' . $re_id . '_1,' . $re_id . '_2,' . $re_id . '_3'; //需去除的所有权限
			$nowrstext = TwoArryQuChong( $result['sys_q_fanwei'], $removearry, ',' ); 
			$nowrstext = $nowrstext.','.$re_id.'_'.$checked; 
			$nowrstext = move_arrynull( QuChong( $nowrstext ));
			$sql = "
				UPDATE msc_zhiwei
				SET sys_q_fanwei = '$nowrstext'
				WHERE sys_yfzuid= $hy and id = $id
			";
			// echo $sql;
			$queryResult = $db->query($sql);
		}else{
			$thisError("异常错误: 没有权限!");
			return ;
		}
	}else if( $checkName == 'sys_q_all' ){
		if($foundObject['permissionControl'] && $foundObject['permissionControl']['quanxian']){
			foreach($foundObject['permissionControl']['quanxian'] as $item){
				if($checked === 'true'){
					$nowrstext =  $result[$item].','.$re_id ;
				}else{
					$nowrstext = movetext( $result[$item], $re_id );
				}
					
				$nowrstext = move_arrynull( QuChong( $nowrstext ));
				$sql = "
					UPDATE msc_zhiwei
					SET $item = '$nowrstext'
					WHERE sys_yfzuid= $hy and id = $id
				";
				// echo $sql;
				$queryResult = $db->query($sql);
			}
		}else{
			$thisError("异常错误: 没有权限!");
			return ;
		}
	}else{
		if($foundObject['permissionControl'] && in_array($checkName,$foundObject['permissionControl']['quanxian'])){
			if($checked === 'true'){
				$nowrstext =  $result[$checkName].','.$re_id ;
			}else{
				$nowrstext = movetext( $result[$checkName], $re_id );
			}
			$nowrstext = move_arrynull( QuChong( $nowrstext ));
			$sql = "
				UPDATE msc_zhiwei
				SET $checkName = '$nowrstext'
				WHERE sys_yfzuid= $hy and id = $id
			";
			// echo $sql;
			$queryResult = $db->query($sql);
			return ;
		}else{
			$thisError("异常错误: 没有权限!!");
			return ;
		}
	}

    echo json_encode($returnData, JSON_UNESCAPED_UNICODE);
}
//[ok]======================================================================================================头部导航Menu添加修改
function TopsMenu() {
	global $Conn, $re_id, $hy, $bh, $SYS_UserName, $const_id_fz, $const_id_bumen; //得到全局变量
	$fieldsname = $nowrsnovalue = '';
	if ( isset( $_POST[ 'fieldsname' ] ) )$fieldsname = $_POST[ 'fieldsname' ]; //得到表名  员工档案
	if ( isset( $_POST[ 're_id' ] ) )$re_id = $_POST[ 're_id' ]; //得到re_id  204
	//$nowre_id=intval($_POST['Menuid']);
	// $_SESSION['currentPageTitle'] = $re_id;
	//查询到头部标签是否有
	$sys_postvalue = trim( $re_id . '_' . $fieldsname, ',' ); //得到标签组合
	$sql = "select * from sys_top_menu where sys_yfzuid='$hy' and sys_id_login='$bh'  ";
	$rs = mysqli_query(  $Conn , $sql );
	$row = mysqli_fetch_array( $rs );
	$count_rows = mysqli_num_rows( $rs ); //得到总数
	$Menu_Id_List = trim( $row[ 'Menu_Id_List' ], ',' ); //查询到所有标签
	
	if ( $count_rows == 0 ) { //没有数据时便添加一条记录
		if ( $re_id == 0 ) { //为桌面选定时
			Jilu_add_Modular( 'sys_top_menu', 'Menu_checd_Id', $re_id); //添加一条
		} else {
			$sys_postzd01 = "Menu_Id_List,Menu_checd_Id";
			$sys_postvalue01 = "'$sys_postvalue','$re_id'";
			Jilu_add_Modular( 'sys_top_menu', $sys_postzd01, $sys_postvalue01); //添加一条
		};
	} else { //执行更新
		Jilu_update_Modular( 'sys_top_menu', "`sys_id_login`='$bh'", 'Menu_checd_Id', $re_id ); //设定显示列
		if ( $re_id > 0 ) { //为其它标签时
			if ( getN_TWOFH($Menu_Id_List, $re_id ,',','_') < 0 ) { //当没有时，添加标签
				$sys_postvalue = $Menu_Id_List . ',' . $sys_postvalue;
				Jilu_update_Modular( 'sys_top_menu', "`sys_id_login`='$bh'", 'Menu_Id_List', trim( $sys_postvalue, ',' )); //设定显示列
			}
		}
	}
	mysqli_free_result( $rs ); //释放内存
    
}
//[ok]======================================================================================================头部导航Menu删除
function Top_Menu_Del() {
	global $Conn, $re_id, $hy, $bh; //得到全局变量
	if ( $re_id > 0 ) {
		$sql = 'select id,Menu_Id_List From sys_top_menu where sys_yfzuid=' . $hy . ' and sys_id_login=' . $bh;
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		$nowrscount = mysqli_num_rows( $rs ); //统计数量
		$nowrsnovalue = trim( $row[ 'Menu_Id_List' ], ',' );
		$id = $row[ 'id' ];
		mysqli_free_result( $rs ); //释放内存

		if ( $nowrscount > 0 ) { //当有数据时执行
			$dataArray = explode(',', $nowrsnovalue);
			$arr = array_map(function($val) {
				return explode('_', $val)[0];
			}, $dataArray);
			// echo json_encode($arr, JSON_UNESCAPED_UNICODE);
			$idx = array_search($re_id,$arr);
			if($idx){
				updateSysTopMenu($arr[$idx - 1],$dataArray,$idx,$id);
				echo $arr[$idx - 1];
			}else{
				if($idx === 0){
					updateSysTopMenu(0,$dataArray,$idx,$id);
					echo 0;
				}else{
					return '数据库错误：查询不到该元素';
				}
			}
		}else{
			return '数据库错误，请联系管理员';
		}

	};
};
//更新标签表
function updateSysTopMenu($newval,$arr,$idx,$id){
	global $Conn; //得到全局变量
	unset($arr[$idx]);
	// echo json_encode($arr, JSON_UNESCAPED_UNICODE);
	$nowrsnovalue = implode(',', $arr);
	$sql = "
		UPDATE sys_top_menu
		SET Menu_Id_List = '$nowrsnovalue', Menu_checd_Id = $newval
		WHERE id = $id;
	";
	// echo $sql;
	mysqli_query(  $Conn , $sql );
	// echo mysqli_error($Conn);
}
//[ok]======================================================================================================验证单行文本框重值
function YanZhenChongFu() {
	global $Conn, $hy; //得到全局变量
	$nowzhiall = $ZDid = $ZDname = $Zdvalue = $nowvalue = '';
	//$strmk_id=intval(trim($_POST['strmk_id']));                       //得到修改的ID
	if ( isset( $_REQUEST[ 'Zdid' ] ) )$ZDid = intval( $_REQUEST[ 'Zdid' ] ); //字段ID查询的ID
	if ( isset( $_REQUEST[ 'Zdname' ] ) )$ZDname = trim( $_REQUEST[ 'Zdname' ] ); //字段名
	if ( isset( $_REQUEST[ 'Zdvalue' ] ) )$Zdvalue = trim( $_REQUEST[ 'Zdvalue' ] ); //字段内容
	$Zdvalue = str_replace( ' ', '', $Zdvalue ); //清除空格
	$zdnamebitian = $ZDname . '_bitian';
	if ( isset( $_REQUEST[ 'BiaoName' ] ) )$BiaoName = trim( $_REQUEST[ 'BiaoName' ] ); //表名
	$nowzdnamelist = 'id,sys_login,sys_nowbh,' . $ZDname;
	//echo ($ZDname.'.'.$BiaoName.'.'.$re_id.'.'.$Zdvalue.'.'.$hy)
	// $sql=$rs=$rsArray='';
	if ( $BiaoName == '' or $ZDname == '' ) {
		echo( '表或字段为空。' );exit();
	} elseif ( $Zdvalue == '' ) {
		echo( '' );
		
	};
	//echo $Zdvalue;
	//exit;
	//$sql='select '.$nowzdnamelist.' From '.$BiaoName.' where '.$ZDname."='".$Zdvalue."'";
	if ( $ZDid <> 0 ) {
		$sql = "select $nowzdnamelist From `$BiaoName` where sys_yfzuid='$hy' and sys_huis='0' and `$ZDname`='$Zdvalue' and id<>'$ZDid'";
	} else {
		$sql = "select $nowzdnamelist From `$BiaoName` where sys_yfzuid='$hy' and `$ZDname`='$Zdvalue' and sys_huis='0'";
	};
	//echo ($sql);
	
	$rs = mysqli_query(  $Conn , $sql );
	$nowrecordcount = mysqli_num_rows( $rs ); //统计数量
	if ( $nowrecordcount == 0 ) {
		echo( "<i class='fa fa-gou tishi' title='通过校检。'></i>" );
		//echo "<script>$('#SYS_submit').attr({'disabled':false});<//script>";
	
	} elseif ( $nowrecordcount > 0 ) {
		$ZDname = trim( $ZDname );
		//echo $ZDname;
		$i = 0;
		while ( $rows = mysqli_fetch_array( $rs ) ) { //当有数据时
			//echo $ZDname;
			$i++;
			$nowid = $rows[ 'id' ];
			$nowbh = $rows[ 'sys_nowbh' ];
			$nowvalue = $rows[ $ZDname ]; //这里有问题
			$nowlogin = $rows[ 'sys_login' ];
			$nowzhiall = $nowzhiall . $i . ') ' . $nowvalue . "&nbsp;[" . $nowbh . "]" . "[" . $nowlogin . "]" . "&#13;";
		};
		echo( "<i class='fa fa-nodata bitiantishi chongfuzhi tishi' title='有[" . $nowrecordcount . "]条重复值:&#13;" . $nowzhiall . "'></i>" );
		//echo "<script>$('#SYS_submit').attr({'disabled':'disabled'});<//script>";
	} else {
		echo( '无法识别！' );
	};
	mysqli_free_result( $rs ); //释放内存
	
	//echo ("<li style='height:10px;'>&nbsp;</li>");
	//http://localhost/MachineV1.0/moban_set_data.php?act=YanZhenChongFu&Zdid=0&Zdname=GongSiMingChen=&BiaoName=sys_GuKeDangAnBiao&Zdvalue=123131
};
//[ok]=========================================================================================添加记录
function add() {
	global $Conn, $databiao, $hy,  $now_xianshi, $sys_postvalue_list, $bh, $SYS_UserName, $const_id_fz, $const_id_bumen,$re_id; //得到全局变量
	$rs = $sql = $sys_postzd_list = $i = $sys_post_ADD_value_list  = $Ubound_postzd_list = $nowdates = $now_xianshi_value = '';
	$r_zt='GK';
	$r_zt_bianhao='1';
	
	if ( isset( $_REQUEST[ 'sys_postzd_list' ] ) ) {
		$sys_postzd_list = trim( $_REQUEST[ 'sys_postzd_list' ] ); //============字段
	};
    //echo $sys_postzd_list;
	//exit();
	$Ubound_postzd_list = Uboundarryy( $sys_postzd_list, ',' ); //得到数组总数8
	//echo $sys_postzd_list,$Ubound_postzd_list;
	for ( $i = 0; $i < $Ubound_postzd_list; $i++ ) {
		$now_xianshi = textN( $sys_postzd_list, $i, ',' ); //得到当前显示字段

		$nowinput_id = 1; //得到字段样式ID

		//mysqli_free_result( $rs ); //释放内存
		//---------------------接收post值
		if ( isset( $_REQUEST[ $now_xianshi ] ) ) { //员工工号9001
			$now_xianshi_value = htmlspecialchars( $_REQUEST[ $now_xianshi ] ); 
		};

		if ( $nowinput_id == 10 ) { //为密码时
			if ( '1' . $now_xianshi_value != '1' ) { //密码不为空时加密
				$sys_postvalue_list = $sys_postvalue_list . "," . $now_xianshi . "='" . md5( $now_xianshi_value ) . "'";
				$sys_post_ADD_value_list .= "'" . md5( $now_xianshi_value ) . "',";
				echo md5( $now_xianshi_value ); //这里返回值到显示页面显示
			} else {
				$sys_postvalue_list = $sys_postvalue_list;
			};

		} else { //默认执行
			$sys_postvalue_list = $sys_postvalue_list . "," . $now_xianshi . "='" . $now_xianshi_value . "'";
			$sys_post_ADD_value_list .= "'" . $now_xianshi_value . "',";
		};
		//$now_xianshi_value = htmlspecialchars( trim( $_REQUEST[ $now_xianshi ] ) ); //【调试用】
	};
	//================================================以下为系统自动生成部份
	$nowdates = date( "Y-m-d H:i:s" ); //$_SERVER['REQUEST_TIME']
	//$sys_postzd_list = $sys_postzd_list; //添加影响的字段清单
	$sys_postvalue_list = trim( $sys_postvalue_list, ',' );
	$sys_post_ADD_value_list = trim( $sys_post_ADD_value_list, ',' );
	//echo $sys_postvalue_list;
	//echo ( $databiao."_".$sys_postzd_list."_".$sys_post_ADD_value_list );
	Jilu_add_Modular( $databiao, $sys_postzd_list, $sys_post_ADD_value_list); //添加数据
};
//[ok]=========================================================================================修改记录
function edit() {
	global $Conn, $databiao, $hy, $now_xianshi, $sys_postvalue_list, $bh, $SYS_UserName, $const_id_fz, $const_id_bumen,$re_id; //得到全局变量
	
	$strmk_id = $rs = $sql = $sys_postzd_list = $i = $sys_post_ADD_value_list  = $Ubound_postzd_list = $nowdates = $now_xianshi_value = '';
	if ( isset( $_POST[ 'strmk_id' ] ) ) {
		$strmk_id = intval( trim( $_POST[ 'strmk_id' ] ) ); //==================得到修改的ID
	};
    //echo $strmk_id;
	if ( isset( $_POST[ 'sys_postzd_list' ] ) ) {
		$sys_postzd_list = trim( $_POST[ 'sys_postzd_list' ] ); //============字段
	};
    //echo $sys_postzd_list;
	
	$Ubound_postzd_list = Uboundarryy( $sys_postzd_list, ',' ); //得到数组总数8
	//echo $sys_postzd_list,$Ubound_postzd_list;
	for ( $i = 0; $i < $Ubound_postzd_list; $i++ ) {
		$now_xianshi = textN( $sys_postzd_list, $i, ',' ); //得到当前显示字段
		
		$nowinput_id = 1; //得到字段样式ID

		//mysqli_free_result( $rs ); //释放内存
		//---------------------接收post值
		if ( isset( $_POST[ $now_xianshi ] ) ) { //员工工号9001
			$now_xianshi_value = htmlspecialchars( addslashes($_POST[ $now_xianshi ] ) ); 
		};

		if ( $nowinput_id == 10 ) { //为密码时
			if ( '1' . $now_xianshi_value != '1' ) { //密码不为空时加密
				$sys_postvalue_list = $sys_postvalue_list . "," . $now_xianshi . "='" . md5( $now_xianshi_value ) . "'";
				$sys_post_ADD_value_list .= "'" . md5( $now_xianshi_value ) . "',";
				echo md5( $now_xianshi_value ); //这里返回值到显示页面显示
			} else {
				$sys_postvalue_list = $sys_postvalue_list;
			};

		} else { //默认执行
			$sys_postvalue_list = $sys_postvalue_list . "," . $now_xianshi . "='" . $now_xianshi_value . "'";
			$sys_post_ADD_value_list .= "'" . $now_xianshi_value . "',";
		};
		//$now_xianshi_value = htmlspecialchars( trim( $_POST[ $now_xianshi ] ) ); //【调试用】
	};
	//================================================以下为系统自动生成部份
	$nowdates = date( "Y-m-d H:i:s" ); //$_SERVER['REQUEST_TIME']
	//$sys_postzd_list = $sys_postzd_list; //添加影响的字段清单
	$sys_postvalue_list = trim( $sys_postvalue_list, ',' );
	$sys_post_ADD_value_list = trim( $sys_post_ADD_value_list, ',' );
	//echo $sys_postvalue_list;
	if ( $strmk_id > 0 ) { //有id时执行修改
		$sql = "UPDATE `$databiao`  set " . $sys_postvalue_list . ",sys_adddate_g='$nowdates'  where id='$strmk_id'"; //更新SQL
		//echo $sql;
		mysqli_query( $Conn , $sql ); //执行更新
		//---------------------------更新云端注册信息
		if ( $databiao == 'sys_yuangongdanganbiao' ) { //当修改员工档案表时
			//echo $strmk_id;
			echo msc_user_reg( $strmk_id );
		};
	}
};
//======================================================================================================编辑数据单条，ID
function Edit_zd() {
	global $Conn;
	$Table_Name = $zd = $ZDid = $ZDval = '';
	if ( isset( $_POST[ 'tablename' ] ) )$Table_Name = trim( $_POST[ 'tablename' ] ); //表
	if ( isset( $_POST[ 'zd' ] ) )$zd = trim( $_POST[ 'zd' ] ); //字段
	if ( isset( $_POST[ 'ZDid' ] ) )$ZDid = trim( $_POST[ 'ZDid' ] ); //id值 查询
	if ( isset( $_POST[ 'ZDval' ] ) )$ZDval = trim( $_POST[ 'ZDval' ] ); //更新值

	if ( $ZDid . '1' != '1'
		and $Table_Name . '1' != '1'
		and $zd . '1' != '1' ) {
		Jilu_update_Modular( $Table_Name, "`id`='$ZDid'", $zd, $ZDval ,$Conn);
	};
};
//【ok】====================================================================================================== 关系表统计数据
function sys_count() {
	global $Conn;
	if ( isset( $_POST[ 'parentre_id' ] ) ) $parentre_id = $_POST[ 'parentre_id' ];       //父级re_id
	if ( isset( $_POST[ 're_id' ] ) ) $re_id = $_POST[ 're_id' ];                         //关系re_id
	if ( isset( $_POST[ 'parentdataid' ] ) )$parentdataid = $_POST[ 'parentdataid' ];     //父数据id
	sys_count_updata($parentre_id,$re_id,$parentdataid);                                  //更新父级统计字段
}
//=========================================================================================================== 奖罚更新
function JiangFaUpdate() { //修改单独表中指定字段的值
	global $re_id,$Conn;
	$sys_jiangli_rmb=$sys_jiangli_jifen=$sys_chufa_rmb=$sys_chufa_jifen='';
	if ( isset( $_POST[ 'sys_jiangli_rmb' ] ) )     $sys_jiangli_rmb = trim( $_POST[ 'sys_jiangli_rmb' ] );
	if ( isset( $_POST[ 'sys_jiangli_jifen' ] ) )   $sys_jiangli_jifen = trim( $_POST[ 'sys_jiangli_jifen' ] );
	if ( isset( $_POST[ 'sys_chufa_rmb' ] ) )       $sys_chufa_rmb = trim( $_POST[ 'sys_chufa_rmb' ] );
	if ( isset( $_POST[ 'sys_chufa_jifen' ] ) )     $sys_chufa_jifen = trim( $_POST[ 'sys_chufa_jifen' ] );
	
	if ( $re_id <> 0 ) {
		//Jilu_update_Modular( 'Sys_Jlmb', "`id`='$re_id'", 'mdb_use_type', 0 ,$Conn); //改为原表模式
		$nowdates = date( "Y-m-d H:i:s" );
	    //-----------------------------------------------------------更新记录
	    $sql = "UPDATE  `Sys_Jlmb`  set `sys_jiangli_rmb`='$sys_jiangli_rmb',`sys_jiangli_jifen`='$sys_jiangli_jifen',`sys_chufa_rmb`='$sys_chufa_rmb',`sys_chufa_jifen`='$sys_chufa_jifen',`sys_adddate_g`='$nowdates' where `id`='$re_id'";
		//echo $sql;
	    mysqli_query( $Conn,$sql );
	}
}
mysqli_close($Conn);//关闭数据库
//mysqli_close($Connadmin);//关闭云数据库
?>