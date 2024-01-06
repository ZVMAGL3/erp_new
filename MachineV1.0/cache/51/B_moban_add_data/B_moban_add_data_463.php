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
		include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Connadmin.php";
        global $strmk_id,$Connadmin,$const_q_tianj;
		if ( $const_q_tianj >= 0 ) { //有修改权限时
		
		//--------------------------------------以下为查询到表的信息
	    $sql = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where sys_yfzuid='$hy' and mdb_name_SYS='msc_yonghudenglujilu' ";
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
	    $sql = "select MAX(sys_bh) AS sys_bh From `msc_yonghudenglujilu` where sys_yfzuid='$hy' and sys_zt='$r_zt' and sys_zt_bianhao='$r_zt_bianhao' ";
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
	    
            if( isset($_POST["SYS_YongHuMing"]) ){$SYS_YongHuMing=$_POST["SYS_YongHuMing"];}else{$SYS_YongHuMing='';};       //用户名
            if( isset($_POST["SYS_ShouJi"]) ){$SYS_ShouJi=$_POST["SYS_ShouJi"];}else{$SYS_ShouJi='';};       //手机
            if( isset($_POST["SYS_SuoShuGongSi"]) ){$SYS_SuoShuGongSi=$_POST["SYS_SuoShuGongSi"];}else{$SYS_SuoShuGongSi='';};       //所属公司
            if( isset($_POST["SYS_IPDiZhi"]) ){$SYS_IPDiZhi=$_POST["SYS_IPDiZhi"];}else{$SYS_IPDiZhi='';};       //IP地址
            if( isset($_POST["SYS_QuanXian"]) ){$SYS_QuanXian=$_POST["SYS_QuanXian"];}else{$SYS_QuanXian='';};       //职位ID
            if( isset($_POST["SYS_QuanXian_Name"]) ){$SYS_QuanXian_Name=$_POST["SYS_QuanXian_Name"];}else{$SYS_QuanXian_Name='';};       //职位名称
            if( isset($_POST["SYS_DiZhi"]) ){$SYS_DiZhi=$_POST["SYS_DiZhi"];}else{$SYS_DiZhi='';};       //地址
            if( isset($_POST["SYS_HTTP_REFERER"]) ){$SYS_HTTP_REFERER=$_POST["SYS_HTTP_REFERER"];}else{$SYS_HTTP_REFERER='';};       //来路网址
            if( isset($_POST["SYS_PC_Mobile"]) ){$SYS_PC_Mobile=$_POST["SYS_PC_Mobile"];}else{$SYS_PC_Mobile='';};       //设备

		$nowdata = date( 'Y-m-d H:i:s' );       //当前时间
		
		//--------------------------------------以下为得交数据
		$sql = "insert into  `msc_yonghudenglujilu`  (SYS_YongHuMing,SYS_ShouJi,SYS_SuoShuGongSi,SYS_IPDiZhi,SYS_QuanXian,SYS_QuanXian_Name,SYS_DiZhi,SYS_HTTP_REFERER,SYS_PC_Mobile,sys_nowbh,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate) values ('$SYS_YongHuMing','$SYS_ShouJi','$SYS_SuoShuGongSi','$SYS_IPDiZhi','$SYS_QuanXian','$SYS_QuanXian_Name','$SYS_DiZhi','$SYS_HTTP_REFERER','$SYS_PC_Mobile','$nowbh','$bh_y','$r_zt','$r_zt_bianhao','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdata')";
		mysqli_query( $Connadmin,$sql );
		echo "<script></script>";
		//--------------------------------------以下为查询数据
		$sql = "select id From `msc_yonghudenglujilu` where   SYS_YongHuMing='$SYS_YongHuMing' and SYS_ShouJi='$SYS_ShouJi' and SYS_SuoShuGongSi='$SYS_SuoShuGongSi' and SYS_IPDiZhi='$SYS_IPDiZhi' and SYS_QuanXian='$SYS_QuanXian' and SYS_QuanXian_Name='$SYS_QuanXian_Name' and SYS_DiZhi='$SYS_DiZhi' and SYS_HTTP_REFERER='$SYS_HTTP_REFERER' and SYS_PC_Mobile='$SYS_PC_Mobile'   order by `id` desc";
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
	        $sys_postvalue_list = "'463','$nowid','$sys_editcontent'";		
	        Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	        LiYi_Add(463,$nowid,534,'+');       //利益函数 这里奖励货币
        }

		echo "$nowid";
		}
		mysqli_close( $Connadmin ); //关闭数据库
		
?>