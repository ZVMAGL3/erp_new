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
    if( isset($_POST["ZD_XingMing"]) ){$ZD_XingMing=$_POST["ZD_XingMing"];}else{$ZD_XingMing='';};       //姓名
    if( isset($_POST["ZD_GongXianZhi"]) ){$ZD_GongXianZhi=$_POST["ZD_GongXianZhi"];}else{$ZD_GongXianZhi='';};       //①贡献值
    if( isset($_POST["ZD_JiFen"]) ){$ZD_JiFen=$_POST["ZD_JiFen"];}else{$ZD_JiFen='';};       //①积分
    if( isset($_POST["ZD_GongXianZhi2020827‎16‎‎40‎‎1012"]) ){$ZD_GongXianZhi2020827‎16‎‎40‎‎1012=$_POST["ZD_GongXianZhi2020827‎16‎‎40‎‎1012"];}else{$ZD_GongXianZhi2020827‎16‎‎40‎‎1012='';};       //②贡献值
    if( isset($_POST["ZD_JiFen2020827‎16‎‎40‎‎142964"]) ){$ZD_JiFen2020827‎16‎‎40‎‎142964=$_POST["ZD_JiFen2020827‎16‎‎40‎‎142964"];}else{$ZD_JiFen2020827‎16‎‎40‎‎142964='';};       //②积分
    if( isset($_POST["ZD_GongXianZhi2020827‎16‎‎40‎‎252196"]) ){$ZD_GongXianZhi2020827‎16‎‎40‎‎252196=$_POST["ZD_GongXianZhi2020827‎16‎‎40‎‎252196"];}else{$ZD_GongXianZhi2020827‎16‎‎40‎‎252196='';};       //③贡献值
    if( isset($_POST["ZD_JiFen2020827‎16‎‎40‎‎332199"]) ){$ZD_JiFen2020827‎16‎‎40‎‎332199=$_POST["ZD_JiFen2020827‎16‎‎40‎‎332199"];}else{$ZD_JiFen2020827‎16‎‎40‎‎332199='';};       //③积分
    if( isset($_POST["ZD_GongXianZhi2020827‎16‎‎40‎‎402031"]) ){$ZD_GongXianZhi2020827‎16‎‎40‎‎402031=$_POST["ZD_GongXianZhi2020827‎16‎‎40‎‎402031"];}else{$ZD_GongXianZhi2020827‎16‎‎40‎‎402031='';};       //④贡献值
    if( isset($_POST["ZD_JiFen2020827‎16‎‎40‎‎46924"]) ){$ZD_JiFen2020827‎16‎‎40‎‎46924=$_POST["ZD_JiFen2020827‎16‎‎40‎‎46924"];}else{$ZD_JiFen2020827‎16‎‎40‎‎46924='';};       //④积分
    if( isset($_POST["ZD_GongXianZhi2020827‎16‎‎41‎‎00300"]) ){$ZD_GongXianZhi2020827‎16‎‎41‎‎00300=$_POST["ZD_GongXianZhi2020827‎16‎‎41‎‎00300"];}else{$ZD_GongXianZhi2020827‎16‎‎41‎‎00300='';};       //⑤贡献值
    if( isset($_POST["ZD_JiFen2020827‎16‎‎41‎‎12810"]) ){$ZD_JiFen2020827‎16‎‎41‎‎12810=$_POST["ZD_JiFen2020827‎16‎‎41‎‎12810"];}else{$ZD_JiFen2020827‎16‎‎41‎‎12810='';};       //⑤积分
    if( isset($_POST["ZD_GongXianZhi2020827‎16‎‎41‎‎24450"]) ){$ZD_GongXianZhi2020827‎16‎‎41‎‎24450=$_POST["ZD_GongXianZhi2020827‎16‎‎41‎‎24450"];}else{$ZD_GongXianZhi2020827‎16‎‎41‎‎24450='';};       //⑥贡献值
    if( isset($_POST["ZD_JiFen2020827‎16‎‎56‎‎012850"]) ){$ZD_JiFen2020827‎16‎‎56‎‎012850=$_POST["ZD_JiFen2020827‎16‎‎56‎‎012850"];}else{$ZD_JiFen2020827‎16‎‎56‎‎012850='';};       //⑥积分
    if( isset($_POST["ZD_GongXianZhi2020827‎16‎‎54‎‎322661"]) ){$ZD_GongXianZhi2020827‎16‎‎54‎‎322661=$_POST["ZD_GongXianZhi2020827‎16‎‎54‎‎322661"];}else{$ZD_GongXianZhi2020827‎16‎‎54‎‎322661='';};       //⑦贡献值
    if( isset($_POST["ZD_JiFen2020827‎16‎‎41‎‎331482"]) ){$ZD_JiFen2020827‎16‎‎41‎‎331482=$_POST["ZD_JiFen2020827‎16‎‎41‎‎331482"];}else{$ZD_JiFen2020827‎16‎‎41‎‎331482='';};       //⑦积分
    if( isset($_POST["ZD_GongXianZhi2020827‎16‎‎41‎‎42138"]) ){$ZD_GongXianZhi2020827‎16‎‎41‎‎42138=$_POST["ZD_GongXianZhi2020827‎16‎‎41‎‎42138"];}else{$ZD_GongXianZhi2020827‎16‎‎41‎‎42138='';};       //⑧贡献值
    if( isset($_POST["ZD_JiFen2020827‎16‎‎41‎‎462247"]) ){$ZD_JiFen2020827‎16‎‎41‎‎462247=$_POST["ZD_JiFen2020827‎16‎‎41‎‎462247"];}else{$ZD_JiFen2020827‎16‎‎41‎‎462247='';};       //⑧积分
    if( isset($_POST["ZD_GongXianZhi2020827‎16‎‎41‎‎531791"]) ){$ZD_GongXianZhi2020827‎16‎‎41‎‎531791=$_POST["ZD_GongXianZhi2020827‎16‎‎41‎‎531791"];}else{$ZD_GongXianZhi2020827‎16‎‎41‎‎531791='';};       //⑨贡献值
    if( isset($_POST["ZD_JiFen2020827‎16‎‎41‎‎572919"]) ){$ZD_JiFen2020827‎16‎‎41‎‎572919=$_POST["ZD_JiFen2020827‎16‎‎41‎‎572919"];}else{$ZD_JiFen2020827‎16‎‎41‎‎572919='';};       //⑨积分
    if( isset($_POST["ZD_GongXianZhi2020827‎16‎‎46‎‎12927"]) ){$ZD_GongXianZhi2020827‎16‎‎46‎‎12927=$_POST["ZD_GongXianZhi2020827‎16‎‎46‎‎12927"];}else{$ZD_GongXianZhi2020827‎16‎‎46‎‎12927='';};       //⑩贡献值
    if( isset($_POST["ZD_JiFen2020827‎16‎‎46‎‎172175"]) ){$ZD_JiFen2020827‎16‎‎46‎‎172175=$_POST["ZD_JiFen2020827‎16‎‎46‎‎172175"];}else{$ZD_JiFen2020827‎16‎‎46‎‎172175='';};       //⑩积分
    if( isset($_POST["ZD_GongXianZhi2020827‎16‎‎46‎‎241170"]) ){$ZD_GongXianZhi2020827‎16‎‎46‎‎241170=$_POST["ZD_GongXianZhi2020827‎16‎‎46‎‎241170"];}else{$ZD_GongXianZhi2020827‎16‎‎46‎‎241170='';};       //⑪贡献值
    if( isset($_POST["ZD_JiFen2020827‎16‎‎46‎‎301743"]) ){$ZD_JiFen2020827‎16‎‎46‎‎301743=$_POST["ZD_JiFen2020827‎16‎‎46‎‎301743"];}else{$ZD_JiFen2020827‎16‎‎46‎‎301743='';};       //⑪积分
    if( isset($_POST["ZD_GongXianZhi2020827‎16‎‎46‎‎361122"]) ){$ZD_GongXianZhi2020827‎16‎‎46‎‎361122=$_POST["ZD_GongXianZhi2020827‎16‎‎46‎‎361122"];}else{$ZD_GongXianZhi2020827‎16‎‎46‎‎361122='';};       //⑫贡献值
    if( isset($_POST["ZD_JiFen2020827‎16‎‎46‎‎4115"]) ){$ZD_JiFen2020827‎16‎‎46‎‎4115=$_POST["ZD_JiFen2020827‎16‎‎46‎‎4115"];}else{$ZD_JiFen2020827‎16‎‎46‎‎4115='';};       //⑫积分
    if( isset($_POST["ZD_ZongGongXianZhi"]) ){$ZD_ZongGongXianZhi=$_POST["ZD_ZongGongXianZhi"];}else{$ZD_ZongGongXianZhi='';};       //总贡献值
    if( isset($_POST["ZD_ZongJiFen"]) ){$ZD_ZongJiFen=$_POST["ZD_ZongJiFen"];}else{$ZD_ZongJiFen='';};       //总积分
    if( isset($_POST["ZD_HeJi"]) ){$ZD_HeJi=$_POST["ZD_HeJi"];}else{$ZD_HeJi='';};       //合计
    if( isset($_POST["ZD_BeiZhu"]) ){$ZD_BeiZhu=$_POST["ZD_BeiZhu"];}else{$ZD_BeiZhu='';};       //备注

    //-----------------------------------------------------------查询原记录
    $sql2 = "select * From  `SQP_GongXianZhi`  where `id`='$strmk_id'";
    $rs2 = mysqli_query( $Conn, $sql2 );
    $row2 = mysqli_fetch_array( $rs2 );
	$Y_ZD_XingMing=$row2['ZD_XingMing'];
    $Y_ZD_GongXianZhi=$row2['ZD_GongXianZhi'];
    $Y_ZD_JiFen=$row2['ZD_JiFen'];
    $Y_ZD_GongXianZhi2020827‎16‎‎40‎‎1012=$row2['ZD_GongXianZhi2020827‎16‎‎40‎‎1012'];
    $Y_ZD_JiFen2020827‎16‎‎40‎‎142964=$row2['ZD_JiFen2020827‎16‎‎40‎‎142964'];
    $Y_ZD_GongXianZhi2020827‎16‎‎40‎‎252196=$row2['ZD_GongXianZhi2020827‎16‎‎40‎‎252196'];
    $Y_ZD_JiFen2020827‎16‎‎40‎‎332199=$row2['ZD_JiFen2020827‎16‎‎40‎‎332199'];
    $Y_ZD_GongXianZhi2020827‎16‎‎40‎‎402031=$row2['ZD_GongXianZhi2020827‎16‎‎40‎‎402031'];
    $Y_ZD_JiFen2020827‎16‎‎40‎‎46924=$row2['ZD_JiFen2020827‎16‎‎40‎‎46924'];
    $Y_ZD_GongXianZhi2020827‎16‎‎41‎‎00300=$row2['ZD_GongXianZhi2020827‎16‎‎41‎‎00300'];
    $Y_ZD_JiFen2020827‎16‎‎41‎‎12810=$row2['ZD_JiFen2020827‎16‎‎41‎‎12810'];
    $Y_ZD_GongXianZhi2020827‎16‎‎41‎‎24450=$row2['ZD_GongXianZhi2020827‎16‎‎41‎‎24450'];
    $Y_ZD_JiFen2020827‎16‎‎56‎‎012850=$row2['ZD_JiFen2020827‎16‎‎56‎‎012850'];
    $Y_ZD_GongXianZhi2020827‎16‎‎54‎‎322661=$row2['ZD_GongXianZhi2020827‎16‎‎54‎‎322661'];
    $Y_ZD_JiFen2020827‎16‎‎41‎‎331482=$row2['ZD_JiFen2020827‎16‎‎41‎‎331482'];
    $Y_ZD_GongXianZhi2020827‎16‎‎41‎‎42138=$row2['ZD_GongXianZhi2020827‎16‎‎41‎‎42138'];
    $Y_ZD_JiFen2020827‎16‎‎41‎‎462247=$row2['ZD_JiFen2020827‎16‎‎41‎‎462247'];
    $Y_ZD_GongXianZhi2020827‎16‎‎41‎‎531791=$row2['ZD_GongXianZhi2020827‎16‎‎41‎‎531791'];
    $Y_ZD_JiFen2020827‎16‎‎41‎‎572919=$row2['ZD_JiFen2020827‎16‎‎41‎‎572919'];
    $Y_ZD_GongXianZhi2020827‎16‎‎46‎‎12927=$row2['ZD_GongXianZhi2020827‎16‎‎46‎‎12927'];
    $Y_ZD_JiFen2020827‎16‎‎46‎‎172175=$row2['ZD_JiFen2020827‎16‎‎46‎‎172175'];
    $Y_ZD_GongXianZhi2020827‎16‎‎46‎‎241170=$row2['ZD_GongXianZhi2020827‎16‎‎46‎‎241170'];
    $Y_ZD_JiFen2020827‎16‎‎46‎‎301743=$row2['ZD_JiFen2020827‎16‎‎46‎‎301743'];
    $Y_ZD_GongXianZhi2020827‎16‎‎46‎‎361122=$row2['ZD_GongXianZhi2020827‎16‎‎46‎‎361122'];
    $Y_ZD_JiFen2020827‎16‎‎46‎‎4115=$row2['ZD_JiFen2020827‎16‎‎46‎‎4115'];
    $Y_ZD_ZongGongXianZhi=$row2['ZD_ZongGongXianZhi'];
    $Y_ZD_ZongJiFen=$row2['ZD_ZongJiFen'];
    $Y_ZD_HeJi=$row2['ZD_HeJi'];
    $Y_ZD_BeiZhu=$row2['ZD_BeiZhu'];
    
    mysqli_free_result( $rs2 ); //释放内存


	$nowdates = date( "Y-m-d H:i:s" );
	//-----------------------------------------------------------更新记录
	$sql = "UPDATE  `SQP_GongXianZhi`  set `ZD_XingMing`='$ZD_XingMing',`ZD_GongXianZhi`='$ZD_GongXianZhi',`ZD_JiFen`='$ZD_JiFen',`ZD_GongXianZhi2020827‎16‎‎40‎‎1012`='$ZD_GongXianZhi2020827‎16‎‎40‎‎1012',`ZD_JiFen2020827‎16‎‎40‎‎142964`='$ZD_JiFen2020827‎16‎‎40‎‎142964',`ZD_GongXianZhi2020827‎16‎‎40‎‎252196`='$ZD_GongXianZhi2020827‎16‎‎40‎‎252196',`ZD_JiFen2020827‎16‎‎40‎‎332199`='$ZD_JiFen2020827‎16‎‎40‎‎332199',`ZD_GongXianZhi2020827‎16‎‎40‎‎402031`='$ZD_GongXianZhi2020827‎16‎‎40‎‎402031',`ZD_JiFen2020827‎16‎‎40‎‎46924`='$ZD_JiFen2020827‎16‎‎40‎‎46924',`ZD_GongXianZhi2020827‎16‎‎41‎‎00300`='$ZD_GongXianZhi2020827‎16‎‎41‎‎00300',`ZD_JiFen2020827‎16‎‎41‎‎12810`='$ZD_JiFen2020827‎16‎‎41‎‎12810',`ZD_GongXianZhi2020827‎16‎‎41‎‎24450`='$ZD_GongXianZhi2020827‎16‎‎41‎‎24450',`ZD_JiFen2020827‎16‎‎56‎‎012850`='$ZD_JiFen2020827‎16‎‎56‎‎012850',`ZD_GongXianZhi2020827‎16‎‎54‎‎322661`='$ZD_GongXianZhi2020827‎16‎‎54‎‎322661',`ZD_JiFen2020827‎16‎‎41‎‎331482`='$ZD_JiFen2020827‎16‎‎41‎‎331482',`ZD_GongXianZhi2020827‎16‎‎41‎‎42138`='$ZD_GongXianZhi2020827‎16‎‎41‎‎42138',`ZD_JiFen2020827‎16‎‎41‎‎462247`='$ZD_JiFen2020827‎16‎‎41‎‎462247',`ZD_GongXianZhi2020827‎16‎‎41‎‎531791`='$ZD_GongXianZhi2020827‎16‎‎41‎‎531791',`ZD_JiFen2020827‎16‎‎41‎‎572919`='$ZD_JiFen2020827‎16‎‎41‎‎572919',`ZD_GongXianZhi2020827‎16‎‎46‎‎12927`='$ZD_GongXianZhi2020827‎16‎‎46‎‎12927',`ZD_JiFen2020827‎16‎‎46‎‎172175`='$ZD_JiFen2020827‎16‎‎46‎‎172175',`ZD_GongXianZhi2020827‎16‎‎46‎‎241170`='$ZD_GongXianZhi2020827‎16‎‎46‎‎241170',`ZD_JiFen2020827‎16‎‎46‎‎301743`='$ZD_JiFen2020827‎16‎‎46‎‎301743',`ZD_GongXianZhi2020827‎16‎‎46‎‎361122`='$ZD_GongXianZhi2020827‎16‎‎46‎‎361122',`ZD_JiFen2020827‎16‎‎46‎‎4115`='$ZD_JiFen2020827‎16‎‎46‎‎4115',`ZD_ZongGongXianZhi`='$ZD_ZongGongXianZhi',`ZD_ZongJiFen`='$ZD_ZongJiFen',`ZD_HeJi`='$ZD_HeJi',`ZD_BeiZhu`='$ZD_BeiZhu',`sys_adddate_g`='$nowdates' where `id`='$strmk_id'";
	mysqli_query( $Conn,$sql );


    //------------------------执行更新对比
    $sys_editcontent='';
	if($Y_ZD_XingMing!=$ZD_XingMing){
		$sys_editcontent.='姓名:  '.$Y_ZD_XingMing.'=>'.$ZD_XingMing.';</br>';
	};
	if($Y_ZD_GongXianZhi!=$ZD_GongXianZhi){
		$sys_editcontent.='①贡献值:  '.$Y_ZD_GongXianZhi.'=>'.$ZD_GongXianZhi.';</br>';
	};
	if($Y_ZD_JiFen!=$ZD_JiFen){
		$sys_editcontent.='①积分:  '.$Y_ZD_JiFen.'=>'.$ZD_JiFen.';</br>';
	};
	if($Y_ZD_GongXianZhi2020827‎16‎‎40‎‎1012!=$ZD_GongXianZhi2020827‎16‎‎40‎‎1012){
		$sys_editcontent.='②贡献值:  '.$Y_ZD_GongXianZhi2020827‎16‎‎40‎‎1012.'=>'.$ZD_GongXianZhi2020827‎16‎‎40‎‎1012.';</br>';
	};
	if($Y_ZD_JiFen2020827‎16‎‎40‎‎142964!=$ZD_JiFen2020827‎16‎‎40‎‎142964){
		$sys_editcontent.='②积分:  '.$Y_ZD_JiFen2020827‎16‎‎40‎‎142964.'=>'.$ZD_JiFen2020827‎16‎‎40‎‎142964.';</br>';
	};
	if($Y_ZD_GongXianZhi2020827‎16‎‎40‎‎252196!=$ZD_GongXianZhi2020827‎16‎‎40‎‎252196){
		$sys_editcontent.='③贡献值:  '.$Y_ZD_GongXianZhi2020827‎16‎‎40‎‎252196.'=>'.$ZD_GongXianZhi2020827‎16‎‎40‎‎252196.';</br>';
	};
	if($Y_ZD_JiFen2020827‎16‎‎40‎‎332199!=$ZD_JiFen2020827‎16‎‎40‎‎332199){
		$sys_editcontent.='③积分:  '.$Y_ZD_JiFen2020827‎16‎‎40‎‎332199.'=>'.$ZD_JiFen2020827‎16‎‎40‎‎332199.';</br>';
	};
	if($Y_ZD_GongXianZhi2020827‎16‎‎40‎‎402031!=$ZD_GongXianZhi2020827‎16‎‎40‎‎402031){
		$sys_editcontent.='④贡献值:  '.$Y_ZD_GongXianZhi2020827‎16‎‎40‎‎402031.'=>'.$ZD_GongXianZhi2020827‎16‎‎40‎‎402031.';</br>';
	};
	if($Y_ZD_JiFen2020827‎16‎‎40‎‎46924!=$ZD_JiFen2020827‎16‎‎40‎‎46924){
		$sys_editcontent.='④积分:  '.$Y_ZD_JiFen2020827‎16‎‎40‎‎46924.'=>'.$ZD_JiFen2020827‎16‎‎40‎‎46924.';</br>';
	};
	if($Y_ZD_GongXianZhi2020827‎16‎‎41‎‎00300!=$ZD_GongXianZhi2020827‎16‎‎41‎‎00300){
		$sys_editcontent.='⑤贡献值:  '.$Y_ZD_GongXianZhi2020827‎16‎‎41‎‎00300.'=>'.$ZD_GongXianZhi2020827‎16‎‎41‎‎00300.';</br>';
	};
	if($Y_ZD_JiFen2020827‎16‎‎41‎‎12810!=$ZD_JiFen2020827‎16‎‎41‎‎12810){
		$sys_editcontent.='⑤积分:  '.$Y_ZD_JiFen2020827‎16‎‎41‎‎12810.'=>'.$ZD_JiFen2020827‎16‎‎41‎‎12810.';</br>';
	};
	if($Y_ZD_GongXianZhi2020827‎16‎‎41‎‎24450!=$ZD_GongXianZhi2020827‎16‎‎41‎‎24450){
		$sys_editcontent.='⑥贡献值:  '.$Y_ZD_GongXianZhi2020827‎16‎‎41‎‎24450.'=>'.$ZD_GongXianZhi2020827‎16‎‎41‎‎24450.';</br>';
	};
	if($Y_ZD_JiFen2020827‎16‎‎56‎‎012850!=$ZD_JiFen2020827‎16‎‎56‎‎012850){
		$sys_editcontent.='⑥积分:  '.$Y_ZD_JiFen2020827‎16‎‎56‎‎012850.'=>'.$ZD_JiFen2020827‎16‎‎56‎‎012850.';</br>';
	};
	if($Y_ZD_GongXianZhi2020827‎16‎‎54‎‎322661!=$ZD_GongXianZhi2020827‎16‎‎54‎‎322661){
		$sys_editcontent.='⑦贡献值:  '.$Y_ZD_GongXianZhi2020827‎16‎‎54‎‎322661.'=>'.$ZD_GongXianZhi2020827‎16‎‎54‎‎322661.';</br>';
	};
	if($Y_ZD_JiFen2020827‎16‎‎41‎‎331482!=$ZD_JiFen2020827‎16‎‎41‎‎331482){
		$sys_editcontent.='⑦积分:  '.$Y_ZD_JiFen2020827‎16‎‎41‎‎331482.'=>'.$ZD_JiFen2020827‎16‎‎41‎‎331482.';</br>';
	};
	if($Y_ZD_GongXianZhi2020827‎16‎‎41‎‎42138!=$ZD_GongXianZhi2020827‎16‎‎41‎‎42138){
		$sys_editcontent.='⑧贡献值:  '.$Y_ZD_GongXianZhi2020827‎16‎‎41‎‎42138.'=>'.$ZD_GongXianZhi2020827‎16‎‎41‎‎42138.';</br>';
	};
	if($Y_ZD_JiFen2020827‎16‎‎41‎‎462247!=$ZD_JiFen2020827‎16‎‎41‎‎462247){
		$sys_editcontent.='⑧积分:  '.$Y_ZD_JiFen2020827‎16‎‎41‎‎462247.'=>'.$ZD_JiFen2020827‎16‎‎41‎‎462247.';</br>';
	};
	if($Y_ZD_GongXianZhi2020827‎16‎‎41‎‎531791!=$ZD_GongXianZhi2020827‎16‎‎41‎‎531791){
		$sys_editcontent.='⑨贡献值:  '.$Y_ZD_GongXianZhi2020827‎16‎‎41‎‎531791.'=>'.$ZD_GongXianZhi2020827‎16‎‎41‎‎531791.';</br>';
	};
	if($Y_ZD_JiFen2020827‎16‎‎41‎‎572919!=$ZD_JiFen2020827‎16‎‎41‎‎572919){
		$sys_editcontent.='⑨积分:  '.$Y_ZD_JiFen2020827‎16‎‎41‎‎572919.'=>'.$ZD_JiFen2020827‎16‎‎41‎‎572919.';</br>';
	};
	if($Y_ZD_GongXianZhi2020827‎16‎‎46‎‎12927!=$ZD_GongXianZhi2020827‎16‎‎46‎‎12927){
		$sys_editcontent.='⑩贡献值:  '.$Y_ZD_GongXianZhi2020827‎16‎‎46‎‎12927.'=>'.$ZD_GongXianZhi2020827‎16‎‎46‎‎12927.';</br>';
	};
	if($Y_ZD_JiFen2020827‎16‎‎46‎‎172175!=$ZD_JiFen2020827‎16‎‎46‎‎172175){
		$sys_editcontent.='⑩积分:  '.$Y_ZD_JiFen2020827‎16‎‎46‎‎172175.'=>'.$ZD_JiFen2020827‎16‎‎46‎‎172175.';</br>';
	};
	if($Y_ZD_GongXianZhi2020827‎16‎‎46‎‎241170!=$ZD_GongXianZhi2020827‎16‎‎46‎‎241170){
		$sys_editcontent.='⑪贡献值:  '.$Y_ZD_GongXianZhi2020827‎16‎‎46‎‎241170.'=>'.$ZD_GongXianZhi2020827‎16‎‎46‎‎241170.';</br>';
	};
	if($Y_ZD_JiFen2020827‎16‎‎46‎‎301743!=$ZD_JiFen2020827‎16‎‎46‎‎301743){
		$sys_editcontent.='⑪积分:  '.$Y_ZD_JiFen2020827‎16‎‎46‎‎301743.'=>'.$ZD_JiFen2020827‎16‎‎46‎‎301743.';</br>';
	};
	if($Y_ZD_GongXianZhi2020827‎16‎‎46‎‎361122!=$ZD_GongXianZhi2020827‎16‎‎46‎‎361122){
		$sys_editcontent.='⑫贡献值:  '.$Y_ZD_GongXianZhi2020827‎16‎‎46‎‎361122.'=>'.$ZD_GongXianZhi2020827‎16‎‎46‎‎361122.';</br>';
	};
	if($Y_ZD_JiFen2020827‎16‎‎46‎‎4115!=$ZD_JiFen2020827‎16‎‎46‎‎4115){
		$sys_editcontent.='⑫积分:  '.$Y_ZD_JiFen2020827‎16‎‎46‎‎4115.'=>'.$ZD_JiFen2020827‎16‎‎46‎‎4115.';</br>';
	};
	if($Y_ZD_ZongGongXianZhi!=$ZD_ZongGongXianZhi){
		$sys_editcontent.='总贡献值:  '.$Y_ZD_ZongGongXianZhi.'=>'.$ZD_ZongGongXianZhi.';</br>';
	};
	if($Y_ZD_ZongJiFen!=$ZD_ZongJiFen){
		$sys_editcontent.='总积分:  '.$Y_ZD_ZongJiFen.'=>'.$ZD_ZongJiFen.';</br>';
	};
	if($Y_ZD_HeJi!=$ZD_HeJi){
		$sys_editcontent.='合计:  '.$Y_ZD_HeJi.'=>'.$ZD_HeJi.';</br>';
	};
	if($Y_ZD_BeiZhu!=$ZD_BeiZhu){
		$sys_editcontent.='备注:  '.$Y_ZD_BeiZhu.'=>'.$ZD_BeiZhu.';</br>';
	};
if($sys_editcontent!=''){
    $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	$sys_postvalue_list = "'504','$strmk_id','$sys_editcontent'";		
	Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	LiYi_Add(504,$strmk_id,535,'+');       //利益函数 这里奖励货币
}


    Sys_XuanYongMoban(504,$strmk_id);//利益函数 这里奖励货币 


}
echo "<script></script>";
mysqli_close( $Conn ); //关闭数据库
?>
