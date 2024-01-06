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
	    $sql = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where sys_yfzuid='$hy' and mdb_name_SYS='SQP_JieChuLaoDongHeTongZhengMingShu' ";
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
	    $sql = "select MAX(sys_bh) AS sys_bh From `SQP_JieChuLaoDongHeTongZhengMingShu` where sys_yfzuid='$hy' and sys_zt='$r_zt' and sys_zt_bianhao='$r_zt_bianhao' ";
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
            if( isset($_POST["ZD_XingBie"]) ){$ZD_XingBie=$_POST["ZD_XingBie"];}else{$ZD_XingBie='';};       //性别
            if( isset($_POST["ZD_ShenFenZhengHao"]) ){$ZD_ShenFenZhengHao=$_POST["ZD_ShenFenZhengHao"];}else{$ZD_ShenFenZhengHao='';};       //身份证号
            if( isset($_POST["ZD_QiShiGongZuoShiJian"]) ){$ZD_QiShiGongZuoShiJian=$_POST["ZD_QiShiGongZuoShiJian"];}else{$ZD_QiShiGongZuoShiJian='';};       //起始工作时间
            if( isset($_POST["ZD_SuoJieChuLaoDongHeTongQiXian"]) ){$ZD_SuoJieChuLaoDongHeTongQiXian=$_POST["ZD_SuoJieChuLaoDongHeTongQiXian"];}else{$ZD_SuoJieChuLaoDongHeTongQiXian='';};       //所解除劳动合同期限
            if( isset($_POST["ZD_LiZhiYuanYin"]) ){$ZD_LiZhiYuanYin=$_POST["ZD_LiZhiYuanYin"];}else{$ZD_LiZhiYuanYin='';};       //离职原因
            if( isset($_POST["ZD_JieChuLaoDongHeTongShiJian"]) ){$ZD_JieChuLaoDongHeTongShiJian=$_POST["ZD_JieChuLaoDongHeTongShiJian"];}else{$ZD_JieChuLaoDongHeTongShiJian='';};       //解除劳动合同时间
            if( isset($_POST["ZD_LaoDongZheQianZi"]) ){$ZD_LaoDongZheQianZi=$_POST["ZD_LaoDongZheQianZi"];}else{$ZD_LaoDongZheQianZi='';};       //劳动者签字

		$nowdata = date( 'Y-m-d H:i:s' );       //当前时间
		
		//--------------------------------------以下为得交数据
		$sql = "insert into  `SQP_JieChuLaoDongHeTongZhengMingShu`  (ZD_XingMing,ZD_XingBie,ZD_ShenFenZhengHao,ZD_QiShiGongZuoShiJian,ZD_SuoJieChuLaoDongHeTongQiXian,ZD_LiZhiYuanYin,ZD_JieChuLaoDongHeTongShiJian,ZD_LaoDongZheQianZi,sys_nowbh,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate) values ('$ZD_XingMing','$ZD_XingBie','$ZD_ShenFenZhengHao','$ZD_QiShiGongZuoShiJian','$ZD_SuoJieChuLaoDongHeTongQiXian','$ZD_LiZhiYuanYin','$ZD_JieChuLaoDongHeTongShiJian','$ZD_LaoDongZheQianZi','$nowbh','$bh_y','$r_zt','$r_zt_bianhao','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdata')";
		mysqli_query( $Conn,$sql );
		echo "<script></script>";
		//--------------------------------------以下为查询数据
		$sql = "select id From `SQP_JieChuLaoDongHeTongZhengMingShu` where   ZD_XingMing='$ZD_XingMing' and ZD_XingBie='$ZD_XingBie' and ZD_ShenFenZhengHao='$ZD_ShenFenZhengHao' and ZD_QiShiGongZuoShiJian='$ZD_QiShiGongZuoShiJian' and ZD_SuoJieChuLaoDongHeTongQiXian='$ZD_SuoJieChuLaoDongHeTongQiXian' and ZD_LiZhiYuanYin='$ZD_LiZhiYuanYin' and ZD_JieChuLaoDongHeTongShiJian='$ZD_JieChuLaoDongHeTongShiJian' and ZD_LaoDongZheQianZi='$ZD_LaoDongZheQianZi'   order by `id` desc";
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
	        $sys_postvalue_list = "'503','$nowid','$sys_editcontent'";		
	        Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	        LiYi_Add(503,$nowid,534,'+');       //利益函数 这里奖励货币
        }

		echo "$nowid";
		}
		mysqli_close( $Conn ); //关闭数据库
		
?>