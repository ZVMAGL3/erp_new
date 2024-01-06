<?php
header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
include_once "{$_SERVER['PATH_TRANSLATED']}/inc/Function_All.php";
include_once "{$_SERVER['PATH_TRANSLATED']}/inc/Sub_All.php";
        //--------------------------------------文件存在读取，不存在时生成
		$cache_file="../B_quanxian/B_quanxian_$SYS_QuanXian.php";
		if( file_exists( $cache_file ) ){//文件存在时
		    include_once ($cache_file);
		}else{
		    echo "<script>UpdatePhp_Zw($SYS_QuanXian);</script>";
		}
		include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Conn.php";
        global $strmk_id,$Conn,$const_q_tianj;
		if ( $const_q_tianj >= 0 ) { //有修改权限时
		
		//--------------------------------------以下为查询到表的信息
	    $sql = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where sys_yfzuid='$hy' and mdb_name_SYS='SQP_GongXianZhi' ";
	    //echo $sql;
	    $rs = mysqli_query(  $Conn , $sql );
	    $row = mysqli_fetch_array( $rs );
	    $r_zt = $row[ 'sys_zt' ];                             //设定的字头
	    //if($r_zt.'1'=='1'){ $r_zt=0 };
        $r_zt_bianhao = $row[ 'sys_zt_bianhao' ];             //设定的字头编号
	    if($r_zt_bianhao.'1'=='1'){ $r_zt_bianhao=0; }; 
	    //echo $r_zt;
	    mysqli_free_result( $rs );                          //释放内存
	
	    //--------------------------------------以下为查询到自动编号
	    $sql = "select MAX(sys_bh) AS sys_bh From `SQP_GongXianZhi` where sys_yfzuid='$hy' and sys_zt='$r_zt' and sys_zt_bianhao='$r_zt_bianhao' ";
	    //echo $sql;
	    $rs = mysqli_query(  $Conn , $sql );
	    $row = mysqli_fetch_array( $rs );
		$maxbh=$row[ "sys_bh" ];
	    if ( $maxbh == "" ) {
		    $bh_y = $r_zt_bianhao;                          //字头
	    } else {
		    $bh_y = $maxbh + 1;                     //编号+1
	    };
	    $nowbh = $r_zt . $bh_y;
		mysqli_free_result( $rs );                          //释放内存
		
		//--------------------------------------以下为接收的数据
	    
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

		$nowdata = date( 'Y-m-d H:i:s' );       //当前时间
		
		//--------------------------------------以下为得交数据
		$sql = "insert into  `SQP_GongXianZhi`  (ZD_XingMing,ZD_GongXianZhi,ZD_JiFen,ZD_GongXianZhi2020827‎16‎‎40‎‎1012,ZD_JiFen2020827‎16‎‎40‎‎142964,ZD_GongXianZhi2020827‎16‎‎40‎‎252196,ZD_JiFen2020827‎16‎‎40‎‎332199,ZD_GongXianZhi2020827‎16‎‎40‎‎402031,ZD_JiFen2020827‎16‎‎40‎‎46924,ZD_GongXianZhi2020827‎16‎‎41‎‎00300,ZD_JiFen2020827‎16‎‎41‎‎12810,ZD_GongXianZhi2020827‎16‎‎41‎‎24450,ZD_JiFen2020827‎16‎‎56‎‎012850,ZD_GongXianZhi2020827‎16‎‎54‎‎322661,ZD_JiFen2020827‎16‎‎41‎‎331482,ZD_GongXianZhi2020827‎16‎‎41‎‎42138,ZD_JiFen2020827‎16‎‎41‎‎462247,ZD_GongXianZhi2020827‎16‎‎41‎‎531791,ZD_JiFen2020827‎16‎‎41‎‎572919,ZD_GongXianZhi2020827‎16‎‎46‎‎12927,ZD_JiFen2020827‎16‎‎46‎‎172175,ZD_GongXianZhi2020827‎16‎‎46‎‎241170,ZD_JiFen2020827‎16‎‎46‎‎301743,ZD_GongXianZhi2020827‎16‎‎46‎‎361122,ZD_JiFen2020827‎16‎‎46‎‎4115,ZD_ZongGongXianZhi,ZD_ZongJiFen,ZD_HeJi,ZD_BeiZhu,sys_nowbh,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate) values ('$ZD_XingMing','$ZD_GongXianZhi','$ZD_JiFen','$ZD_GongXianZhi2020827‎16‎‎40‎‎1012','$ZD_JiFen2020827‎16‎‎40‎‎142964','$ZD_GongXianZhi2020827‎16‎‎40‎‎252196','$ZD_JiFen2020827‎16‎‎40‎‎332199','$ZD_GongXianZhi2020827‎16‎‎40‎‎402031','$ZD_JiFen2020827‎16‎‎40‎‎46924','$ZD_GongXianZhi2020827‎16‎‎41‎‎00300','$ZD_JiFen2020827‎16‎‎41‎‎12810','$ZD_GongXianZhi2020827‎16‎‎41‎‎24450','$ZD_JiFen2020827‎16‎‎56‎‎012850','$ZD_GongXianZhi2020827‎16‎‎54‎‎322661','$ZD_JiFen2020827‎16‎‎41‎‎331482','$ZD_GongXianZhi2020827‎16‎‎41‎‎42138','$ZD_JiFen2020827‎16‎‎41‎‎462247','$ZD_GongXianZhi2020827‎16‎‎41‎‎531791','$ZD_JiFen2020827‎16‎‎41‎‎572919','$ZD_GongXianZhi2020827‎16‎‎46‎‎12927','$ZD_JiFen2020827‎16‎‎46‎‎172175','$ZD_GongXianZhi2020827‎16‎‎46‎‎241170','$ZD_JiFen2020827‎16‎‎46‎‎301743','$ZD_GongXianZhi2020827‎16‎‎46‎‎361122','$ZD_JiFen2020827‎16‎‎46‎‎4115','$ZD_ZongGongXianZhi','$ZD_ZongJiFen','$ZD_HeJi','$ZD_BeiZhu','$nowbh','$bh_y','$r_zt','$r_zt_bianhao','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdata')";
		mysqli_query( $Conn,$sql );
		echo "<script></script>";
		//--------------------------------------以下为查询数据
		$sql = "select id From `SQP_GongXianZhi` where   ZD_XingMing='$ZD_XingMing' and ZD_GongXianZhi='$ZD_GongXianZhi' and ZD_JiFen='$ZD_JiFen' and ZD_GongXianZhi2020827‎16‎‎40‎‎1012='$ZD_GongXianZhi2020827‎16‎‎40‎‎1012' and ZD_JiFen2020827‎16‎‎40‎‎142964='$ZD_JiFen2020827‎16‎‎40‎‎142964' and ZD_GongXianZhi2020827‎16‎‎40‎‎252196='$ZD_GongXianZhi2020827‎16‎‎40‎‎252196' and ZD_JiFen2020827‎16‎‎40‎‎332199='$ZD_JiFen2020827‎16‎‎40‎‎332199' and ZD_GongXianZhi2020827‎16‎‎40‎‎402031='$ZD_GongXianZhi2020827‎16‎‎40‎‎402031' and ZD_JiFen2020827‎16‎‎40‎‎46924='$ZD_JiFen2020827‎16‎‎40‎‎46924' and ZD_GongXianZhi2020827‎16‎‎41‎‎00300='$ZD_GongXianZhi2020827‎16‎‎41‎‎00300' and ZD_JiFen2020827‎16‎‎41‎‎12810='$ZD_JiFen2020827‎16‎‎41‎‎12810' and ZD_GongXianZhi2020827‎16‎‎41‎‎24450='$ZD_GongXianZhi2020827‎16‎‎41‎‎24450' and ZD_JiFen2020827‎16‎‎56‎‎012850='$ZD_JiFen2020827‎16‎‎56‎‎012850' and ZD_GongXianZhi2020827‎16‎‎54‎‎322661='$ZD_GongXianZhi2020827‎16‎‎54‎‎322661' and ZD_JiFen2020827‎16‎‎41‎‎331482='$ZD_JiFen2020827‎16‎‎41‎‎331482' and ZD_GongXianZhi2020827‎16‎‎41‎‎42138='$ZD_GongXianZhi2020827‎16‎‎41‎‎42138' and ZD_JiFen2020827‎16‎‎41‎‎462247='$ZD_JiFen2020827‎16‎‎41‎‎462247' and ZD_GongXianZhi2020827‎16‎‎41‎‎531791='$ZD_GongXianZhi2020827‎16‎‎41‎‎531791' and ZD_JiFen2020827‎16‎‎41‎‎572919='$ZD_JiFen2020827‎16‎‎41‎‎572919' and ZD_GongXianZhi2020827‎16‎‎46‎‎12927='$ZD_GongXianZhi2020827‎16‎‎46‎‎12927' and ZD_JiFen2020827‎16‎‎46‎‎172175='$ZD_JiFen2020827‎16‎‎46‎‎172175' and ZD_GongXianZhi2020827‎16‎‎46‎‎241170='$ZD_GongXianZhi2020827‎16‎‎46‎‎241170' and ZD_JiFen2020827‎16‎‎46‎‎301743='$ZD_JiFen2020827‎16‎‎46‎‎301743' and ZD_GongXianZhi2020827‎16‎‎46‎‎361122='$ZD_GongXianZhi2020827‎16‎‎46‎‎361122' and ZD_JiFen2020827‎16‎‎46‎‎4115='$ZD_JiFen2020827‎16‎‎46‎‎4115' and ZD_ZongGongXianZhi='$ZD_ZongGongXianZhi' and ZD_ZongJiFen='$ZD_ZongJiFen' and ZD_HeJi='$ZD_HeJi' and ZD_BeiZhu='$ZD_BeiZhu'   order by `id` desc";
	    //echo $sql;
	    $rs = mysqli_query(  $Conn , $sql );
	    if ( $rs ) {
		   $row = mysqli_fetch_array( $rs );
		   $nowid = $row[ 'id' ];
	    };
		mysqli_free_result( $rs ); //释放内存
        //--------------------------------------以下为操作记录提交
        $sys_editcontent='首次建档;';
        if($sys_editcontent!=''){
            $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	        $sys_postvalue_list = "'504','$nowid','$sys_editcontent'";		
	        Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	        LiYi_Add(504,$nowid,534,'+');       //利益函数 这里奖励货币
        }

		echo "$nowid";
		}
		mysqli_close( $Conn ); //关闭数据库
		
?>