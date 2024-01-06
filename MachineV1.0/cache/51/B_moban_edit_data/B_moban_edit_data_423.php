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
    if( isset($_POST["ZD_HeTongFuJian"]) ){$ZD_HeTongFuJian=$_POST["ZD_HeTongFuJian"];}else{$ZD_HeTongFuJian='';};       //合同附件
    if( isset($_POST["ZD_SuoShuGuKe"]) ){$ZD_SuoShuGuKe=$_POST["ZD_SuoShuGuKe"];}else{$ZD_SuoShuGuKe='';};       //所属顾客
    if( isset($_POST["ZD_HeTongBianHao"]) ){$ZD_HeTongBianHao=$_POST["ZD_HeTongBianHao"];}else{$ZD_HeTongBianHao='';};       //合同编号
    if( isset($_POST["ZD_HeTongJinE"]) ){$ZD_HeTongJinE=$_POST["ZD_HeTongJinE"];}else{$ZD_HeTongJinE='';};       //合同金额
    if( isset($_POST["ZD_XiangMu"]) ){$ZD_XiangMu=$_POST["ZD_XiangMu"];}else{$ZD_XiangMu='';};       //项目
    if( isset($_POST["ZD_LianXiRen"]) ){$ZD_LianXiRen=$_POST["ZD_LianXiRen"];}else{$ZD_LianXiRen='';};       //联系人
    if( isset($_POST["ZD_DianHua"]) ){$ZD_DianHua=$_POST["ZD_DianHua"];}else{$ZD_DianHua='';};       //电话
    if( isset($_POST["ZD_DiZhi"]) ){$ZD_DiZhi=$_POST["ZD_DiZhi"];}else{$ZD_DiZhi='';};       //地址
    if( isset($_POST["ZD_QianDingRiQi"]) ){$ZD_QianDingRiQi=$_POST["ZD_QianDingRiQi"];}else{$ZD_QianDingRiQi='';};       //签订日期
    if( isset($_POST["ZD_JiaoQi"]) ){$ZD_JiaoQi=$_POST["ZD_JiaoQi"];}else{$ZD_JiaoQi='';};       //交期
    if( isset($_POST["ZD_QianDingDiDian"]) ){$ZD_QianDingDiDian=$_POST["ZD_QianDingDiDian"];}else{$ZD_QianDingDiDian='';};       //签订地点
    if( isset($_POST["ZD_XiangMuJingLi"]) ){$ZD_XiangMuJingLi=$_POST["ZD_XiangMuJingLi"];}else{$ZD_XiangMuJingLi='';};       //项目经理
    if( isset($_POST["sys_gx_id_321"]) ){$sys_gx_id_321=$_POST["sys_gx_id_321"];}else{$sys_gx_id_321='';};       //[关系]顾客档案表ID
    if( isset($_POST["sys_gx_id_257"]) ){$sys_gx_id_257=$_POST["sys_gx_id_257"];}else{$sys_gx_id_257='';};       //[关系][SYS] 职位管理ID

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_GuKeHeTong`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_ZD_HeTongFuJian=$row2['ZD_HeTongFuJian'];
    $Y_ZD_SuoShuGuKe=$row2['ZD_SuoShuGuKe'];
    $Y_ZD_HeTongBianHao=$row2['ZD_HeTongBianHao'];
    $Y_ZD_HeTongJinE=$row2['ZD_HeTongJinE'];
    $Y_ZD_XiangMu=$row2['ZD_XiangMu'];
    $Y_ZD_LianXiRen=$row2['ZD_LianXiRen'];
    $Y_ZD_DianHua=$row2['ZD_DianHua'];
    $Y_ZD_DiZhi=$row2['ZD_DiZhi'];
    $Y_ZD_QianDingRiQi=$row2['ZD_QianDingRiQi'];
    $Y_ZD_JiaoQi=$row2['ZD_JiaoQi'];
    $Y_ZD_QianDingDiDian=$row2['ZD_QianDingDiDian'];
    $Y_ZD_XiangMuJingLi=$row2['ZD_XiangMuJingLi'];
    $Y_sys_gx_id_321=$row2['sys_gx_id_321'];
    $Y_sys_gx_id_257=$row2['sys_gx_id_257'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_GuKeHeTong`  set `ZD_HeTongFuJian`='$ZD_HeTongFuJian',`ZD_SuoShuGuKe`='$ZD_SuoShuGuKe',`ZD_HeTongBianHao`='$ZD_HeTongBianHao',`ZD_HeTongJinE`='$ZD_HeTongJinE',`ZD_XiangMu`='$ZD_XiangMu',`ZD_LianXiRen`='$ZD_LianXiRen',`ZD_DianHua`='$ZD_DianHua',`ZD_DiZhi`='$ZD_DiZhi',`ZD_QianDingRiQi`='$ZD_QianDingRiQi',`ZD_JiaoQi`='$ZD_JiaoQi',`ZD_QianDingDiDian`='$ZD_QianDingDiDian',`ZD_XiangMuJingLi`='$ZD_XiangMuJingLi',`sys_gx_id_321`='$sys_gx_id_321',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_ZD_HeTongFuJian!=$ZD_HeTongFuJian){
		$sys_editcontent.='合同附件:  '.$Y_ZD_HeTongFuJian.'=>'.$ZD_HeTongFuJian.';</br>';
	};
	if($Y_ZD_SuoShuGuKe!=$ZD_SuoShuGuKe){
		$sys_editcontent.='所属顾客:  '.$Y_ZD_SuoShuGuKe.'=>'.$ZD_SuoShuGuKe.';</br>';
	};
	if($Y_ZD_HeTongBianHao!=$ZD_HeTongBianHao){
		$sys_editcontent.='合同编号:  '.$Y_ZD_HeTongBianHao.'=>'.$ZD_HeTongBianHao.';</br>';
	};
	if($Y_ZD_HeTongJinE!=$ZD_HeTongJinE){
		$sys_editcontent.='合同金额:  '.$Y_ZD_HeTongJinE.'=>'.$ZD_HeTongJinE.';</br>';
	};
	if($Y_ZD_XiangMu!=$ZD_XiangMu){
		$sys_editcontent.='项目:  '.$Y_ZD_XiangMu.'=>'.$ZD_XiangMu.';</br>';
	};
	if($Y_ZD_LianXiRen!=$ZD_LianXiRen){
		$sys_editcontent.='联系人:  '.$Y_ZD_LianXiRen.'=>'.$ZD_LianXiRen.';</br>';
	};
	if($Y_ZD_DianHua!=$ZD_DianHua){
		$sys_editcontent.='电话:  '.$Y_ZD_DianHua.'=>'.$ZD_DianHua.';</br>';
	};
	if($Y_ZD_DiZhi!=$ZD_DiZhi){
		$sys_editcontent.='地址:  '.$Y_ZD_DiZhi.'=>'.$ZD_DiZhi.';</br>';
	};
	if($Y_ZD_QianDingRiQi!=$ZD_QianDingRiQi){
		$sys_editcontent.='签订日期:  '.$Y_ZD_QianDingRiQi.'=>'.$ZD_QianDingRiQi.';</br>';
	};
	if($Y_ZD_JiaoQi!=$ZD_JiaoQi){
		$sys_editcontent.='交期:  '.$Y_ZD_JiaoQi.'=>'.$ZD_JiaoQi.';</br>';
	};
	if($Y_ZD_QianDingDiDian!=$ZD_QianDingDiDian){
		$sys_editcontent.='签订地点:  '.$Y_ZD_QianDingDiDian.'=>'.$ZD_QianDingDiDian.';</br>';
	};
	if($Y_ZD_XiangMuJingLi!=$ZD_XiangMuJingLi){
		$sys_editcontent.='项目经理:  '.$Y_ZD_XiangMuJingLi.'=>'.$ZD_XiangMuJingLi.';</br>';
	};
	if($Y_sys_gx_id_321!=$sys_gx_id_321){
		$sys_editcontent.='[关系]顾客档案表ID:  '.$Y_sys_gx_id_321.'=>'.$sys_gx_id_321.';</br>';
	};
	if($Y_sys_gx_id_257!=$sys_gx_id_257){
		$sys_editcontent.='[关系][SYS] 职位管理ID:  '.$Y_sys_gx_id_257.'=>'.$sys_gx_id_257.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'423','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(423,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(423,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script>sys_count('321','423','$sys_gx_id_321');sys_count('257','423','$sys_gx_id_257');</script>";
mysqli_close( $Conn ); //关闭数据库
?>
