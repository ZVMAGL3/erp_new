<?php
//测试function

//测试end
ini_set('memory_limit',"256M");//内存大小
//=======================================================================定义cache参数
$CACHE_ROOT=$curfile= '';
//=======================================================================系统参数开始
$xt_m_ziduan = $xt_m_ziduan_Name = $xt_m_ziduan_hidden = $SF_str_start = $SF_str_end = $SF_SQL = $Sqlarr = $All_XT_ZiDuan = '';

$xt_m_ziduan = 'id,sys_zt,sys_zt_bianhao,sys_nowbh,sys_id_zu,sys_huis,sys_yfzuid,sys_id_fz,bumen_id,sys_id_login,sys_login,sys_shenpi,sys_web_shenpi,sys_shenpi_all,sys_adddate,sys_adddate_g,sys_leixin,hy,sys_bh,sys_chaosong,sys_paixu'; //公用部份关键词

$xt_m_ziduan_Name = 'ID,[系统]字头,[系统]字头编号,自动编号,分类,回收状态,公司ID,分支,部门,编制人工号,编制人,审核,允许WEB访问,批准,编制时间,更新时间,类型,会员,[系统]自动编号,经办人,排序'; //公用部份关键词对应名称
$Axt_m_ziduan_hidden = 'sys_zt_bianhao,sys_zt,sys_bh,sys_id_login,sys_yfzuid,sys_huis,sys_id'; //这里需隐藏的字段
$SF_edit = 'id,gh'; //禁止修改的字段
//$SF_str_start='$_PZζ_tξa_t$';//字符串传递前分隔符
//$SF_str_end='$_PZζ_E_ξn_D$';//字符串传递前分隔
//$SF_SQL='$_nZζPξz_$';//过滤字符串参数
$Sqlarr = 'and,exec,insert,select,delete,update,count,chr,mid,master,truncate,char,declare,or,dbcc,alter,sp_rename,drop';
$All_XT_ZiDuan = ',' . $xt_m_ziduan . ',' . $xt_m_ziduan_Name . ',' . $Sqlarr . ',';

//=======================================================================SESSION参数获取[公司级]

if ( isset( $_REQUEST[ 'reg_name' ] ) ) { //REQUEST优先  
	$reg_name = $_REQUEST[ 'reg_name' ];           //公司名称
	$reg_database = $_REQUEST[ 'reg_database' ];   //数据库名称 botelerp
	$reg_banben = $_REQUEST[ 'reg_banben' ];       //版本号 MachineV1.0
	$regid = intval( $_REQUEST[ 'regid' ] );       //注册的公司ID 5
	$hy = intval( $_REQUEST[ 'hy' ] );             //注册的公司hy号9007
};

//echo $reg_name.'_';
//【ok】=========================================================================返回权限值
function Q_fanwei_ID( $q_fanwei, $jlmbid ) {
	if ( '1' . $q_fanwei == '1'
		or '1' . $jlmbid == '1' ) {
		return '0';
	} else {
		if ( getN( $q_fanwei, $jlmbid . '_0' ) > -1 ) {
			return '0';
		} elseif ( getN( $q_fanwei, $jlmbid . '_1' ) > -1 ) {
			return '1';
		} elseif ( getN( $q_fanwei, $jlmbid . '_2' ) > -1 ) {
			return '2';
		} elseif ( getN( $q_fanwei, $jlmbid . '_3' ) > -1 ) {
			return '3';
		} else {
			return '0';
		};
	};
} //function end

//[ok]=========================================================================返回一个元素在数组中位置的函数function
function getN( $arrx, $y ,$fh=',') { //在$arrx中查找$y的位置getN($nsquanxian,$re_id)>-1
	$arrx = strtolower( $arrx );
    //echo $arrx;
	$y = strtolower( $y ); //转化为小写
	$fharry = '';
	$getN = -1;
	$fharry = explode( $fh, $arrx );
	for ( $i = 0; $i < count( $fharry ); $i++ ) {
		$nowval = $fharry[ $i ];
		if ( $nowval == $y ) {
			return $i;
		}
	}
	return $getN;
} //function end
//[ok]=========================================================================返回一个元素在前后都有符号包住的数组中位置的函数function
function getN_TWOFH( $arrx,$y,$FH1,$FH2) {                                    //getN_TWOFH('301_人本,302_中国', '301',',','_')
	$arrx = strtolower( $arrx );
	$y = strtolower( $y ); //转化为小写
	$fharry = '';
	$getN_TWOFH = -1;
	$fharry = explode( $FH1, $arrx );
	for ( $i = 0; $i < count( $fharry ); $i++ ) {
		$nowval = $fharry[ $i ];               //得到：301_人本
		
		$nowhas=getN( $nowval, $y ,$fh='_');   //这里查询到301是否在 ”301_人本“ 中
		if ( $nowhas >=0 ) {                   //当有时
			return $i;
		}
	}
	return $getN_TWOFH;
} //function end
//[ok]================================================================================================== [以re_id查找，并更新所有的update_sys_top_menu] 

function update_sys_top_menu($re_id,$name) { //  321，顾客档案表
	//查询是否有这个表
	global $Conn,$hy;                                               //得到全局变量
	$newvalue=$re_id.'_'.$name;                                     //得到新的菜单
	$sql = "select * from sys_top_menu where sys_yfzuid='$hy' ";
	//echo $sql;
	$rs = mysqli_query( $Conn , $sql );
	while ( $row = mysqli_fetch_array( $rs ) ) {
		$id = $row['id'];
		$Menu_Id_List = $row['Menu_Id_List'];                       //所有菜单集合
		if ( getN_TWOFH($Menu_Id_List, $re_id ,',','_') >= 0 ) {    //当有时，更新标签
			$fharry = explode( ',', $Menu_Id_List );                        //字符串转为数组
			for ( $i = 0; $i < count( $fharry ); $i++ ) {
		        $nowval = $fharry[ $i ];                            //得到：301_人本
		        $nowhas=getN( $nowval, $re_id ,'_');                //这里查询到301是否在 ”301_人本“ 中
		        if ( $nowhas >=0 && $nowval != $newvalue) {         //当re_id有,但是后面的中文名不同时将执行
			       $nowupdata_str=str_replace($nowval,$newvalue,$Menu_Id_List);   //将旧值替换成新值
				   $sqls="UPDATE `sys_top_menu` SET `Menu_Id_List`='$nowupdata_str' WHERE id='$id'";
				   mysqli_query($Conn,$sqls);                       //这里执行更新内容
		        }
	        }       
		}
	}
	mysqli_free_result( $rs ); //释放内存
} //function end	
    
//【ok】=========================================================================清除所有html标签
function DeleteHtml( $str ) {
	$subject = strip_tags( $str ); //去除html标签
	$pattern = '/\s/'; //去除空白
	//$str = preg_replace( $pattern, '', $subject );
	$str = trim( $subject ); //清除字符串两边的空格
	$str = preg_replace( "/\t/", "", $str ); //使用正则表达式替换内容，如：空格，换行，并将替换为空。
	$str = preg_replace( "/\r\n/", "", $str );
	$str = preg_replace( "/\r/", "", $str );
	$str = preg_replace( "/\n/", "", $str );
	//$str = preg_replace( "/ /", "", $str );
	//$str = preg_replace( "/  /", "", $str ); //匹配html中的空格
	return trim( $str ); //返回字符串
};
?>