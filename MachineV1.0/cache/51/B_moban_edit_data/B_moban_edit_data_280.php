<?php
		header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
		include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
		include_once "{$_SERVER['PATH_TRANSLATED']}/inc/Function_All.php";
		include_once "{$_SERVER['PATH_TRANSLATED']}/inc/Sub_All.php";
		include_once "{$_SERVER['PATH_TRANSLATED']}/phpword/extend/PHPWord/PHPWord.php";              //php处理word替换
		include_once "{$_SERVER['PATH_TRANSLATED']}/phpword/extend/PHPWord/PHPWord/IOFactory.php";    //php处理word替换
		$cache_file="../B_quanxian/B_quanxian_$SYS_QuanXian.php";
		if( file_exists( $cache_file ) ){//文件存在时
		    include_once ($cache_file);
		}else{
		    echo "<script>UpdatePhp_Zw($SYS_QuanXian);</script>";
		}
	
		include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
		global $strmk_id,$Conn,$const_q_xiug,$const_id_login,$bh,$hy,$SYS_UserName,$const_id_fz,$const_id_bumen;
		
		
if ( $const_q_xiug >= 0 ) { //有修改权限时
    if( isset($_POST["GongZuoXiangMu"]) ){$GongZuoXiangMu=$_POST["GongZuoXiangMu"];}else{$GongZuoXiangMu='';};       //工作项目
    if( isset($_POST["NaRongYaoQiu"]) ){$NaRongYaoQiu=$_POST["NaRongYaoQiu"];}else{$NaRongYaoQiu='';};       //内容要求
    if( isset($_POST["JiaoQi"]) ){$JiaoQi=$_POST["JiaoQi"];}else{$JiaoQi='';};       //交期
    if( isset($_POST["WanCheng"]) ){$WanCheng=$_POST["WanCheng"];}else{$WanCheng='';};       //完成
    if( isset($_POST["sys_gx_id_321"]) ){$sys_gx_id_321=$_POST["sys_gx_id_321"];}else{$sys_gx_id_321='';};       //关系字段:sys_gx_id_321
    if( isset($_POST["sys_gx_id_198"]) ){$sys_gx_id_198=$_POST["sys_gx_id_198"];}else{$sys_gx_id_198='';};       //[关系]质量记录归档登记表ID

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_GongZuoJiHua`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_GongZuoXiangMu=$row2['GongZuoXiangMu'];
    $Y_NaRongYaoQiu=$row2['NaRongYaoQiu'];
    $Y_JiaoQi=$row2['JiaoQi'];
    $Y_WanCheng=$row2['WanCheng'];
    $Y_sys_gx_id_321=$row2['sys_gx_id_321'];
    $Y_sys_gx_id_198=$row2['sys_gx_id_198'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_GongZuoJiHua`  set `GongZuoXiangMu`='$GongZuoXiangMu',`NaRongYaoQiu`='$NaRongYaoQiu',`JiaoQi`='$JiaoQi',`WanCheng`='$WanCheng',`sys_gx_id_198`='$sys_gx_id_198',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_GongZuoXiangMu!=$GongZuoXiangMu){
		$sys_editcontent.='工作项目:  '.$Y_GongZuoXiangMu.'=>'.$GongZuoXiangMu.';</br>';
	};
	if($Y_NaRongYaoQiu!=$NaRongYaoQiu){
		$sys_editcontent.='内容要求:  '.$Y_NaRongYaoQiu.'=>'.$NaRongYaoQiu.';</br>';
	};
	if($Y_JiaoQi!=$JiaoQi){
		$sys_editcontent.='交期:  '.$Y_JiaoQi.'=>'.$JiaoQi.';</br>';
	};
	if($Y_WanCheng!=$WanCheng){
		$sys_editcontent.='完成:  '.$Y_WanCheng.'=>'.$WanCheng.';</br>';
	};
	if($Y_sys_gx_id_321!=$sys_gx_id_321){
		$sys_editcontent.='关系字段:sys_gx_id_321:  '.$Y_sys_gx_id_321.'=>'.$sys_gx_id_321.';</br>';
	};
	if($Y_sys_gx_id_198!=$sys_gx_id_198){
		$sys_editcontent.='[关系]质量记录归档登记表ID:  '.$Y_sys_gx_id_198.'=>'.$sys_gx_id_198.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'280','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(280,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(280,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script>sys_count('321','280','$sys_gx_id_321');sys_count('198','280','$sys_gx_id_198');</script>";
mysqli_close( $Conn ); //关闭数据库
?>
