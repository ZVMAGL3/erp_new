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
    if( isset($_POST["sys_gx_id_321"]) ){$sys_gx_id_321=$_POST["sys_gx_id_321"];}else{$sys_gx_id_321='';};       //[关系]顾客档案表ID
    if( isset($_POST["ZD_GongSiMingChen"]) ){$ZD_GongSiMingChen=$_POST["ZD_GongSiMingChen"];}else{$ZD_GongSiMingChen='';};       //公司名称
    if( isset($_POST["sys_gx_id_423"]) ){$sys_gx_id_423=$_POST["sys_gx_id_423"];}else{$sys_gx_id_423='';};       //[关系]顾客合同ID
    if( isset($_POST["RenZhengXinXi"]) ){$RenZhengXinXi=$_POST["RenZhengXinXi"];}else{$RenZhengXinXi='';};       //认证信息
    if( isset($_POST["XiangMuQianShou"]) ){$XiangMuQianShou=$_POST["XiangMuQianShou"];}else{$XiangMuQianShou='';};       //项目签收
    if( isset($_POST["ZD_RuChang"]) ){$ZD_RuChang=$_POST["ZD_RuChang"];}else{$ZD_RuChang='';};       //①入厂
    if( isset($_POST["ZD_ShenQing"]) ){$ZD_ShenQing=$_POST["ZD_ShenQing"];}else{$ZD_ShenQing='';};       //②申请
    if( isset($_POST["ZD_ZiLiao"]) ){$ZD_ZiLiao=$_POST["ZD_ZiLiao"];}else{$ZD_ZiLiao='';};       //③资料
    if( isset($_POST["ZD_JiLiangJianDing"]) ){$ZD_JiLiangJianDing=$_POST["ZD_JiLiangJianDing"];}else{$ZD_JiLiangJianDing='';};       //④计量检定
    if( isset($_POST["ZD_TeZhongJianDing"]) ){$ZD_TeZhongJianDing=$_POST["ZD_TeZhongJianDing"];}else{$ZD_TeZhongJianDing='';};       //⑤特种检定
    if( isset($_POST["ZD_YanShou"]) ){$ZD_YanShou=$_POST["ZD_YanShou"];}else{$ZD_YanShou='';};       //⑥验收
    if( isset($_POST["ZD_ShenHe"]) ){$ZD_ShenHe=$_POST["ZD_ShenHe"];}else{$ZD_ShenHe='';};       //⑦审核
    if( isset($_POST["ZD_ZhengGai"]) ){$ZD_ZhengGai=$_POST["ZD_ZhengGai"];}else{$ZD_ZhengGai='';};       //⑧整改
    if( isset($_POST["ZD_JiaoJie"]) ){$ZD_JiaoJie=$_POST["ZD_JiaoJie"];}else{$ZD_JiaoJie='';};       //⑨交接
    if( isset($_POST["ZD_TiChengJieSuan"]) ){$ZD_TiChengJieSuan=$_POST["ZD_TiChengJieSuan"];}else{$ZD_TiChengJieSuan='';};       //提成结算
    if( isset($_POST["ZD_RenShuChanPin"]) ){$ZD_RenShuChanPin=$_POST["ZD_RenShuChanPin"];}else{$ZD_RenShuChanPin='';};       //人数/产品
    if( isset($_POST["LianXiRen"]) ){$LianXiRen=$_POST["LianXiRen"];}else{$LianXiRen='';};       //联系人
    if( isset($_POST["DianHua"]) ){$DianHua=$_POST["DianHua"];}else{$DianHua='';};       //电话
    if( isset($_POST["ZhiDaoXingShi"]) ){$ZhiDaoXingShi=$_POST["ZhiDaoXingShi"];}else{$ZhiDaoXingShi='';};       //指导形式
    if( isset($_POST["ZD_ShenHeYuan"]) ){$ZD_ShenHeYuan=$_POST["ZD_ShenHeYuan"];}else{$ZD_ShenHeYuan='';};       //审核员
    if( isset($_POST["ShenHeShiJian"]) ){$ShenHeShiJian=$_POST["ShenHeShiJian"];}else{$ShenHeShiJian='';};       //审核时间
    if( isset($_POST["JiaoTongJieDai"]) ){$JiaoTongJieDai=$_POST["JiaoTongJieDai"];}else{$JiaoTongJieDai='';};       //交通接待
    if( isset($_POST["ZiXunFeiYong"]) ){$ZiXunFeiYong=$_POST["ZiXunFeiYong"];}else{$ZiXunFeiYong='';};       //咨询费用
    if( isset($_POST["QiTaYaoQiu"]) ){$QiTaYaoQiu=$_POST["QiTaYaoQiu"];}else{$QiTaYaoQiu='';};       //其它要求
    if( isset($_POST["ZD_ZiLiaoFuZeRen"]) ){$ZD_ZiLiaoFuZeRen=$_POST["ZD_ZiLiaoFuZeRen"];}else{$ZD_ZiLiaoFuZeRen='';};       //①资料（负责人）
    if( isset($_POST["ZD_ZiLiaoZhuDao"]) ){$ZD_ZiLiaoZhuDao=$_POST["ZD_ZiLiaoZhuDao"];}else{$ZD_ZiLiaoZhuDao='';};       //②资料（主导）
    if( isset($_POST["ZD_JiLiangQiJu"]) ){$ZD_JiLiangQiJu=$_POST["ZD_JiLiangQiJu"];}else{$ZD_JiLiangQiJu='';};       //③计量器具
    if( isset($_POST["ZD_PeiShenYanChang"]) ){$ZD_PeiShenYanChang=$_POST["ZD_PeiShenYanChang"];}else{$ZD_PeiShenYanChang='';};       //④陪审/验厂
    if( isset($_POST["ZD_PeiXun"]) ){$ZD_PeiXun=$_POST["ZD_PeiXun"];}else{$ZD_PeiXun='';};       //⑤培训
    if( isset($_POST["ZD_HeJiTiCheng"]) ){$ZD_HeJiTiCheng=$_POST["ZD_HeJiTiCheng"];}else{$ZD_HeJiTiCheng='';};       //合计提成
    if( isset($_POST["ZD_ShenHeTianShu"]) ){$ZD_ShenHeTianShu=$_POST["ZD_ShenHeTianShu"];}else{$ZD_ShenHeTianShu='';};       //审核天数
    if( isset($_POST["ZD_JiaoQi"]) ){$ZD_JiaoQi=$_POST["ZD_JiaoQi"];}else{$ZD_JiaoQi='';};       //交期
    if( isset($_POST["sys_gx_id_510"]) ){$sys_gx_id_510=$_POST["sys_gx_id_510"];}else{$sys_gx_id_510='';};       //[关系]客户证书管理ID
    if( isset($_POST["ZD_HongLiuFeng"]) ){$ZD_HongLiuFeng=$_POST["ZD_HongLiuFeng"];}else{$ZD_HongLiuFeng='';};       //洪柳凤
    if( isset($_POST["ZD_WanGongDan"]) ){$ZD_WanGongDan=$_POST["ZD_WanGongDan"];}else{$ZD_WanGongDan='';};       //完工单
    if( isset($_POST["ZD_HeZuoWeiJieSuan"]) ){$ZD_HeZuoWeiJieSuan=$_POST["ZD_HeZuoWeiJieSuan"];}else{$ZD_HeZuoWeiJieSuan='';};       //合作未结算
    if( isset($_POST["sys_gx_id_529"]) ){$sys_gx_id_529=$_POST["sys_gx_id_529"];}else{$sys_gx_id_529='';};       //[关系]用户和公司关系ID

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_FuWuLiuChengDan`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_sys_gx_id_321=$row2['sys_gx_id_321'];
    $Y_ZD_GongSiMingChen=$row2['ZD_GongSiMingChen'];
    $Y_sys_gx_id_423=$row2['sys_gx_id_423'];
    $Y_RenZhengXinXi=$row2['RenZhengXinXi'];
    $Y_XiangMuQianShou=$row2['XiangMuQianShou'];
    $Y_ZD_RuChang=$row2['ZD_RuChang'];
    $Y_ZD_ShenQing=$row2['ZD_ShenQing'];
    $Y_ZD_ZiLiao=$row2['ZD_ZiLiao'];
    $Y_ZD_JiLiangJianDing=$row2['ZD_JiLiangJianDing'];
    $Y_ZD_TeZhongJianDing=$row2['ZD_TeZhongJianDing'];
    $Y_ZD_YanShou=$row2['ZD_YanShou'];
    $Y_ZD_ShenHe=$row2['ZD_ShenHe'];
    $Y_ZD_ZhengGai=$row2['ZD_ZhengGai'];
    $Y_ZD_JiaoJie=$row2['ZD_JiaoJie'];
    $Y_ZD_TiChengJieSuan=$row2['ZD_TiChengJieSuan'];
    $Y_ZD_RenShuChanPin=$row2['ZD_RenShuChanPin'];
    $Y_LianXiRen=$row2['LianXiRen'];
    $Y_DianHua=$row2['DianHua'];
    $Y_ZhiDaoXingShi=$row2['ZhiDaoXingShi'];
    $Y_ZD_ShenHeYuan=$row2['ZD_ShenHeYuan'];
    $Y_ShenHeShiJian=$row2['ShenHeShiJian'];
    $Y_JiaoTongJieDai=$row2['JiaoTongJieDai'];
    $Y_ZiXunFeiYong=$row2['ZiXunFeiYong'];
    $Y_QiTaYaoQiu=$row2['QiTaYaoQiu'];
    $Y_ZD_ZiLiaoFuZeRen=$row2['ZD_ZiLiaoFuZeRen'];
    $Y_ZD_ZiLiaoZhuDao=$row2['ZD_ZiLiaoZhuDao'];
    $Y_ZD_JiLiangQiJu=$row2['ZD_JiLiangQiJu'];
    $Y_ZD_PeiShenYanChang=$row2['ZD_PeiShenYanChang'];
    $Y_ZD_PeiXun=$row2['ZD_PeiXun'];
    $Y_ZD_HeJiTiCheng=$row2['ZD_HeJiTiCheng'];
    $Y_ZD_ShenHeTianShu=$row2['ZD_ShenHeTianShu'];
    $Y_ZD_JiaoQi=$row2['ZD_JiaoQi'];
    $Y_sys_gx_id_510=$row2['sys_gx_id_510'];
    $Y_ZD_HongLiuFeng=$row2['ZD_HongLiuFeng'];
    $Y_ZD_WanGongDan=$row2['ZD_WanGongDan'];
    $Y_ZD_HeZuoWeiJieSuan=$row2['ZD_HeZuoWeiJieSuan'];
    $Y_sys_gx_id_529=$row2['sys_gx_id_529'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_FuWuLiuChengDan`  set `sys_gx_id_321`='$sys_gx_id_321',`ZD_GongSiMingChen`='$ZD_GongSiMingChen',`sys_gx_id_423`='$sys_gx_id_423',`RenZhengXinXi`='$RenZhengXinXi',`XiangMuQianShou`='$XiangMuQianShou',`ZD_RuChang`='$ZD_RuChang',`ZD_ShenQing`='$ZD_ShenQing',`ZD_ZiLiao`='$ZD_ZiLiao',`ZD_JiLiangJianDing`='$ZD_JiLiangJianDing',`ZD_TeZhongJianDing`='$ZD_TeZhongJianDing',`ZD_YanShou`='$ZD_YanShou',`ZD_ShenHe`='$ZD_ShenHe',`ZD_ZhengGai`='$ZD_ZhengGai',`ZD_JiaoJie`='$ZD_JiaoJie',`ZD_TiChengJieSuan`='$ZD_TiChengJieSuan',`ZD_RenShuChanPin`='$ZD_RenShuChanPin',`LianXiRen`='$LianXiRen',`DianHua`='$DianHua',`ZhiDaoXingShi`='$ZhiDaoXingShi',`ZD_ShenHeYuan`='$ZD_ShenHeYuan',`ShenHeShiJian`='$ShenHeShiJian',`JiaoTongJieDai`='$JiaoTongJieDai',`ZiXunFeiYong`='$ZiXunFeiYong',`QiTaYaoQiu`='$QiTaYaoQiu',`ZD_ZiLiaoFuZeRen`='$ZD_ZiLiaoFuZeRen',`ZD_ZiLiaoZhuDao`='$ZD_ZiLiaoZhuDao',`ZD_JiLiangQiJu`='$ZD_JiLiangQiJu',`ZD_PeiShenYanChang`='$ZD_PeiShenYanChang',`ZD_PeiXun`='$ZD_PeiXun',`ZD_HeJiTiCheng`='$ZD_HeJiTiCheng',`ZD_ShenHeTianShu`='$ZD_ShenHeTianShu',`ZD_JiaoQi`='$ZD_JiaoQi',`ZD_HongLiuFeng`='$ZD_HongLiuFeng',`ZD_WanGongDan`='$ZD_WanGongDan',`ZD_HeZuoWeiJieSuan`='$ZD_HeZuoWeiJieSuan',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_sys_gx_id_321!=$sys_gx_id_321){
		$sys_editcontent.='[关系]顾客档案表ID:  '.$Y_sys_gx_id_321.'=>'.$sys_gx_id_321.';</br>';
	};
	if($Y_ZD_GongSiMingChen!=$ZD_GongSiMingChen){
		$sys_editcontent.='公司名称:  '.$Y_ZD_GongSiMingChen.'=>'.$ZD_GongSiMingChen.';</br>';
	};
	if($Y_sys_gx_id_423!=$sys_gx_id_423){
		$sys_editcontent.='[关系]顾客合同ID:  '.$Y_sys_gx_id_423.'=>'.$sys_gx_id_423.';</br>';
	};
	if($Y_RenZhengXinXi!=$RenZhengXinXi){
		$sys_editcontent.='认证信息:  '.$Y_RenZhengXinXi.'=>'.$RenZhengXinXi.';</br>';
	};
	if($Y_XiangMuQianShou!=$XiangMuQianShou){
		$sys_editcontent.='项目签收:  '.$Y_XiangMuQianShou.'=>'.$XiangMuQianShou.';</br>';
	};
	if($Y_ZD_RuChang!=$ZD_RuChang){
		$sys_editcontent.='①入厂:  '.$Y_ZD_RuChang.'=>'.$ZD_RuChang.';</br>';
	};
	if($Y_ZD_ShenQing!=$ZD_ShenQing){
		$sys_editcontent.='②申请:  '.$Y_ZD_ShenQing.'=>'.$ZD_ShenQing.';</br>';
	};
	if($Y_ZD_ZiLiao!=$ZD_ZiLiao){
		$sys_editcontent.='③资料:  '.$Y_ZD_ZiLiao.'=>'.$ZD_ZiLiao.';</br>';
	};
	if($Y_ZD_JiLiangJianDing!=$ZD_JiLiangJianDing){
		$sys_editcontent.='④计量检定:  '.$Y_ZD_JiLiangJianDing.'=>'.$ZD_JiLiangJianDing.';</br>';
	};
	if($Y_ZD_TeZhongJianDing!=$ZD_TeZhongJianDing){
		$sys_editcontent.='⑤特种检定:  '.$Y_ZD_TeZhongJianDing.'=>'.$ZD_TeZhongJianDing.';</br>';
	};
	if($Y_ZD_YanShou!=$ZD_YanShou){
		$sys_editcontent.='⑥验收:  '.$Y_ZD_YanShou.'=>'.$ZD_YanShou.';</br>';
	};
	if($Y_ZD_ShenHe!=$ZD_ShenHe){
		$sys_editcontent.='⑦审核:  '.$Y_ZD_ShenHe.'=>'.$ZD_ShenHe.';</br>';
	};
	if($Y_ZD_ZhengGai!=$ZD_ZhengGai){
		$sys_editcontent.='⑧整改:  '.$Y_ZD_ZhengGai.'=>'.$ZD_ZhengGai.';</br>';
	};
	if($Y_ZD_JiaoJie!=$ZD_JiaoJie){
		$sys_editcontent.='⑨交接:  '.$Y_ZD_JiaoJie.'=>'.$ZD_JiaoJie.';</br>';
	};
	if($Y_ZD_TiChengJieSuan!=$ZD_TiChengJieSuan){
		$sys_editcontent.='提成结算:  '.$Y_ZD_TiChengJieSuan.'=>'.$ZD_TiChengJieSuan.';</br>';
	};
	if($Y_ZD_RenShuChanPin!=$ZD_RenShuChanPin){
		$sys_editcontent.='人数/产品:  '.$Y_ZD_RenShuChanPin.'=>'.$ZD_RenShuChanPin.';</br>';
	};
	if($Y_LianXiRen!=$LianXiRen){
		$sys_editcontent.='联系人:  '.$Y_LianXiRen.'=>'.$LianXiRen.';</br>';
	};
	if($Y_DianHua!=$DianHua){
		$sys_editcontent.='电话:  '.$Y_DianHua.'=>'.$DianHua.';</br>';
	};
	if($Y_ZhiDaoXingShi!=$ZhiDaoXingShi){
		$sys_editcontent.='指导形式:  '.$Y_ZhiDaoXingShi.'=>'.$ZhiDaoXingShi.';</br>';
	};
	if($Y_ZD_ShenHeYuan!=$ZD_ShenHeYuan){
		$sys_editcontent.='审核员:  '.$Y_ZD_ShenHeYuan.'=>'.$ZD_ShenHeYuan.';</br>';
	};
	if($Y_ShenHeShiJian!=$ShenHeShiJian){
		$sys_editcontent.='审核时间:  '.$Y_ShenHeShiJian.'=>'.$ShenHeShiJian.';</br>';
	};
	if($Y_JiaoTongJieDai!=$JiaoTongJieDai){
		$sys_editcontent.='交通接待:  '.$Y_JiaoTongJieDai.'=>'.$JiaoTongJieDai.';</br>';
	};
	if($Y_ZiXunFeiYong!=$ZiXunFeiYong){
		$sys_editcontent.='咨询费用:  '.$Y_ZiXunFeiYong.'=>'.$ZiXunFeiYong.';</br>';
	};
	if($Y_QiTaYaoQiu!=$QiTaYaoQiu){
		$sys_editcontent.='其它要求:  '.$Y_QiTaYaoQiu.'=>'.$QiTaYaoQiu.';</br>';
	};
	if($Y_ZD_ZiLiaoFuZeRen!=$ZD_ZiLiaoFuZeRen){
		$sys_editcontent.='①资料（负责人）:  '.$Y_ZD_ZiLiaoFuZeRen.'=>'.$ZD_ZiLiaoFuZeRen.';</br>';
	};
	if($Y_ZD_ZiLiaoZhuDao!=$ZD_ZiLiaoZhuDao){
		$sys_editcontent.='②资料（主导）:  '.$Y_ZD_ZiLiaoZhuDao.'=>'.$ZD_ZiLiaoZhuDao.';</br>';
	};
	if($Y_ZD_JiLiangQiJu!=$ZD_JiLiangQiJu){
		$sys_editcontent.='③计量器具:  '.$Y_ZD_JiLiangQiJu.'=>'.$ZD_JiLiangQiJu.';</br>';
	};
	if($Y_ZD_PeiShenYanChang!=$ZD_PeiShenYanChang){
		$sys_editcontent.='④陪审/验厂:  '.$Y_ZD_PeiShenYanChang.'=>'.$ZD_PeiShenYanChang.';</br>';
	};
	if($Y_ZD_PeiXun!=$ZD_PeiXun){
		$sys_editcontent.='⑤培训:  '.$Y_ZD_PeiXun.'=>'.$ZD_PeiXun.';</br>';
	};
	if($Y_ZD_HeJiTiCheng!=$ZD_HeJiTiCheng){
		$sys_editcontent.='合计提成:  '.$Y_ZD_HeJiTiCheng.'=>'.$ZD_HeJiTiCheng.';</br>';
	};
	if($Y_ZD_ShenHeTianShu!=$ZD_ShenHeTianShu){
		$sys_editcontent.='审核天数:  '.$Y_ZD_ShenHeTianShu.'=>'.$ZD_ShenHeTianShu.';</br>';
	};
	if($Y_ZD_JiaoQi!=$ZD_JiaoQi){
		$sys_editcontent.='交期:  '.$Y_ZD_JiaoQi.'=>'.$ZD_JiaoQi.';</br>';
	};
	if($Y_sys_gx_id_510!=$sys_gx_id_510){
		$sys_editcontent.='[关系]客户证书管理ID:  '.$Y_sys_gx_id_510.'=>'.$sys_gx_id_510.';</br>';
	};
	if($Y_ZD_HongLiuFeng!=$ZD_HongLiuFeng){
		$sys_editcontent.='洪柳凤:  '.$Y_ZD_HongLiuFeng.'=>'.$ZD_HongLiuFeng.';</br>';
	};
	if($Y_ZD_WanGongDan!=$ZD_WanGongDan){
		$sys_editcontent.='完工单:  '.$Y_ZD_WanGongDan.'=>'.$ZD_WanGongDan.';</br>';
	};
	if($Y_ZD_HeZuoWeiJieSuan!=$ZD_HeZuoWeiJieSuan){
		$sys_editcontent.='合作未结算:  '.$Y_ZD_HeZuoWeiJieSuan.'=>'.$ZD_HeZuoWeiJieSuan.';</br>';
	};
	if($Y_sys_gx_id_529!=$sys_gx_id_529){
		$sys_editcontent.='[关系]用户和公司关系ID:  '.$Y_sys_gx_id_529.'=>'.$sys_gx_id_529.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'495','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(495,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(495,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script>sys_count('321','495','$sys_gx_id_321');sys_count('423','495','$sys_gx_id_423');sys_count('510','495','$sys_gx_id_510');sys_count('529','495','$sys_gx_id_529');</script>";
mysqli_close( $Conn ); //关闭数据库
?>
