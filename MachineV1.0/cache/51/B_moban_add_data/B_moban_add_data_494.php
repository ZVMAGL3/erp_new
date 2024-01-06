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
	    $sql = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where sys_yfzuid='$hy' and mdb_name_SYS='SQP_QingJiaDiaoXiuJiaBanWaiChuDan' ";
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
	    $sql = "select MAX(sys_bh) AS sys_bh From `SQP_QingJiaDiaoXiuJiaBanWaiChuDan` where sys_yfzuid='$hy' and sys_zt='$r_zt' and sys_zt_bianhao='$r_zt_bianhao' ";
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
	    
            if( isset($_POST["ZhiWu"]) ){$ZhiWu=$_POST["ZhiWu"];}else{$ZhiWu='';};       //职务
            if( isset($_POST["ZD_ShenQingRen"]) ){$ZD_ShenQingRen=$_POST["ZD_ShenQingRen"];}else{$ZD_ShenQingRen='';};       //申请人
            if( isset($_POST["sys_id_zu"]) ){$sys_id_zu=$_POST["sys_id_zu"];}else{$sys_id_zu='';};       //分类
            if( isset($_POST["ZD_ShenQingShiJian"]) ){$ZD_ShenQingShiJian=$_POST["ZD_ShenQingShiJian"];}else{$ZD_ShenQingShiJian='';};       //申请时间
            if( isset($_POST["ShiYou"]) ){$ShiYou=$_POST["ShiYou"];}else{$ShiYou='';};       //事由
            if( isset($_POST["ZD_BeiZhu"]) ){$ZD_BeiZhu=$_POST["ZD_BeiZhu"];}else{$ZD_BeiZhu='';};       //备注
            if( isset($_POST["sys_shenpi"]) ){$sys_shenpi=$_POST["sys_shenpi"];}else{$sys_shenpi='';};       //审核
            if( isset($_POST["sys_shenpi_all"]) ){$sys_shenpi_all=$_POST["sys_shenpi_all"];}else{$sys_shenpi_all='';};       //批准
            if( isset($_POST["sys_gx_id_529"]) ){$sys_gx_id_529=$_POST["sys_gx_id_529"];}else{$sys_gx_id_529='';};       //[关系]用户和公司关系ID

		$nowdata = date( 'Y-m-d H:i:s' );       //当前时间
		
		//--------------------------------------以下为得交数据
		$sql = "insert into  `SQP_QingJiaDiaoXiuJiaBanWaiChuDan`  (ZhiWu,ZD_ShenQingRen,sys_id_zu,ZD_ShenQingShiJian,ShiYou,ZD_BeiZhu,sys_shenpi,sys_shenpi_all,sys_nowbh,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate) values ('$ZhiWu','$ZD_ShenQingRen','$sys_id_zu','$ZD_ShenQingShiJian','$ShiYou','$ZD_BeiZhu','$sys_shenpi','$sys_shenpi_all','$nowbh','$bh_y','$r_zt','$r_zt_bianhao','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdata')";
		mysqli_query( $Conn,$sql );
		echo "<script>sys_count('529','494','$sys_gx_id_529');</script>";
		//--------------------------------------以下为查询数据
		$sql = "select id From `SQP_QingJiaDiaoXiuJiaBanWaiChuDan` where   ZhiWu='$ZhiWu' and ZD_ShenQingRen='$ZD_ShenQingRen' and sys_id_zu='$sys_id_zu' and ZD_ShenQingShiJian='$ZD_ShenQingShiJian' and ShiYou='$ShiYou' and ZD_BeiZhu='$ZD_BeiZhu' and sys_shenpi='$sys_shenpi' and sys_shenpi_all='$sys_shenpi_all'   order by `id` desc";
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
	        $sys_postvalue_list = "'494','$nowid','$sys_editcontent'";		
	        Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	        LiYi_Add(494,$nowid,534,'+');       //利益函数 这里奖励货币
        }

		echo "$nowid";
		}
		mysqli_close( $Conn ); //关闭数据库
		
?>