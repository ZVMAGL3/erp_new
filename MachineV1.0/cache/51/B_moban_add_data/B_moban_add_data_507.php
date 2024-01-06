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
	    $sql = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where sys_yfzuid='$hy' and mdb_name_SYS='SQP_JiaBanDiaoXiuShiJianHuiZong' ";
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
	    $sql = "select MAX(sys_bh) AS sys_bh From `SQP_JiaBanDiaoXiuShiJianHuiZong` where sys_yfzuid='$hy' and sys_zt='$r_zt' and sys_zt_bianhao='$r_zt_bianhao' ";
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
            if( isset($_POST["ZD_NianFen"]) ){$ZD_NianFen=$_POST["ZD_NianFen"];}else{$ZD_NianFen='';};       //年份
            if( isset($_POST["ZD_1Ri"]) ){$ZD_1Ri=$_POST["ZD_1Ri"];}else{$ZD_1Ri='';};       //1日
            if( isset($_POST["ZD_2Ri"]) ){$ZD_2Ri=$_POST["ZD_2Ri"];}else{$ZD_2Ri='';};       //2日
            if( isset($_POST["ZD_3Ri"]) ){$ZD_3Ri=$_POST["ZD_3Ri"];}else{$ZD_3Ri='';};       //3日
            if( isset($_POST["ZD_4Ri"]) ){$ZD_4Ri=$_POST["ZD_4Ri"];}else{$ZD_4Ri='';};       //4日
            if( isset($_POST["ZD_5Ri"]) ){$ZD_5Ri=$_POST["ZD_5Ri"];}else{$ZD_5Ri='';};       //5日
            if( isset($_POST["ZD_6Ri"]) ){$ZD_6Ri=$_POST["ZD_6Ri"];}else{$ZD_6Ri='';};       //6日
            if( isset($_POST["ZD_7Ri"]) ){$ZD_7Ri=$_POST["ZD_7Ri"];}else{$ZD_7Ri='';};       //7日
            if( isset($_POST["ZD_8Ri"]) ){$ZD_8Ri=$_POST["ZD_8Ri"];}else{$ZD_8Ri='';};       //8日
            if( isset($_POST["ZD_9Ri"]) ){$ZD_9Ri=$_POST["ZD_9Ri"];}else{$ZD_9Ri='';};       //9日
            if( isset($_POST["ZD_10Ri"]) ){$ZD_10Ri=$_POST["ZD_10Ri"];}else{$ZD_10Ri='';};       //10日
            if( isset($_POST["ZD_11Ri"]) ){$ZD_11Ri=$_POST["ZD_11Ri"];}else{$ZD_11Ri='';};       //11日
            if( isset($_POST["ZD_12Ri"]) ){$ZD_12Ri=$_POST["ZD_12Ri"];}else{$ZD_12Ri='';};       //12日
            if( isset($_POST["ZD_13Ri"]) ){$ZD_13Ri=$_POST["ZD_13Ri"];}else{$ZD_13Ri='';};       //13日
            if( isset($_POST["ZD_14Ri"]) ){$ZD_14Ri=$_POST["ZD_14Ri"];}else{$ZD_14Ri='';};       //14日
            if( isset($_POST["ZD_15Ri"]) ){$ZD_15Ri=$_POST["ZD_15Ri"];}else{$ZD_15Ri='';};       //15日
            if( isset($_POST["ZD_16Ri"]) ){$ZD_16Ri=$_POST["ZD_16Ri"];}else{$ZD_16Ri='';};       //16日
            if( isset($_POST["ZD_17Ri"]) ){$ZD_17Ri=$_POST["ZD_17Ri"];}else{$ZD_17Ri='';};       //17日
            if( isset($_POST["ZD_18Ri"]) ){$ZD_18Ri=$_POST["ZD_18Ri"];}else{$ZD_18Ri='';};       //18日
            if( isset($_POST["ZD_19Ri"]) ){$ZD_19Ri=$_POST["ZD_19Ri"];}else{$ZD_19Ri='';};       //19日
            if( isset($_POST["ZD_20Ri"]) ){$ZD_20Ri=$_POST["ZD_20Ri"];}else{$ZD_20Ri='';};       //20日
            if( isset($_POST["ZD_21Ri"]) ){$ZD_21Ri=$_POST["ZD_21Ri"];}else{$ZD_21Ri='';};       //21日
            if( isset($_POST["ZD_22Ri"]) ){$ZD_22Ri=$_POST["ZD_22Ri"];}else{$ZD_22Ri='';};       //22日
            if( isset($_POST["ZD_23Ri"]) ){$ZD_23Ri=$_POST["ZD_23Ri"];}else{$ZD_23Ri='';};       //23日
            if( isset($_POST["ZD_24Ri"]) ){$ZD_24Ri=$_POST["ZD_24Ri"];}else{$ZD_24Ri='';};       //24日
            if( isset($_POST["ZD_25Ri"]) ){$ZD_25Ri=$_POST["ZD_25Ri"];}else{$ZD_25Ri='';};       //25日
            if( isset($_POST["ZD_26Ri"]) ){$ZD_26Ri=$_POST["ZD_26Ri"];}else{$ZD_26Ri='';};       //26日
            if( isset($_POST["ZD_27Ri"]) ){$ZD_27Ri=$_POST["ZD_27Ri"];}else{$ZD_27Ri='';};       //27日
            if( isset($_POST["ZD_28Ri"]) ){$ZD_28Ri=$_POST["ZD_28Ri"];}else{$ZD_28Ri='';};       //28日
            if( isset($_POST["ZD_29Ri"]) ){$ZD_29Ri=$_POST["ZD_29Ri"];}else{$ZD_29Ri='';};       //29日
            if( isset($_POST["ZD_30Ri"]) ){$ZD_30Ri=$_POST["ZD_30Ri"];}else{$ZD_30Ri='';};       //30日
            if( isset($_POST["ZD_31Ri"]) ){$ZD_31Ri=$_POST["ZD_31Ri"];}else{$ZD_31Ri='';};       //31日
            if( isset($_POST["ZD_HeJiShiJian"]) ){$ZD_HeJiShiJian=$_POST["ZD_HeJiShiJian"];}else{$ZD_HeJiShiJian='';};       //合计时间
            if( isset($_POST["ZD_DiaoXiuShiJian"]) ){$ZD_DiaoXiuShiJian=$_POST["ZD_DiaoXiuShiJian"];}else{$ZD_DiaoXiuShiJian='';};       //调休时间
            if( isset($_POST["ZD_ShiJiJiaBanShiJian"]) ){$ZD_ShiJiJiaBanShiJian=$_POST["ZD_ShiJiJiaBanShiJian"];}else{$ZD_ShiJiJiaBanShiJian='';};       //实际加班时间
            if( isset($_POST["ZD_JiaBanGongZi"]) ){$ZD_JiaBanGongZi=$_POST["ZD_JiaBanGongZi"];}else{$ZD_JiaBanGongZi='';};       //加班工资
            if( isset($_POST["ZD_BeiZhu"]) ){$ZD_BeiZhu=$_POST["ZD_BeiZhu"];}else{$ZD_BeiZhu='';};       //备注
            if( isset($_POST["sys_gx_id_204"]) ){$sys_gx_id_204=$_POST["sys_gx_id_204"];}else{$sys_gx_id_204='';};       //关系字段:sys_gx_id_204

		$nowdata = date( 'Y-m-d H:i:s' );       //当前时间
		
		//--------------------------------------以下为得交数据
		$sql = "insert into  `SQP_JiaBanDiaoXiuShiJianHuiZong`  (ZD_XingMing,ZD_NianFen,ZD_1Ri,ZD_2Ri,ZD_3Ri,ZD_4Ri,ZD_5Ri,ZD_6Ri,ZD_7Ri,ZD_8Ri,ZD_9Ri,ZD_10Ri,ZD_11Ri,ZD_12Ri,ZD_13Ri,ZD_14Ri,ZD_15Ri,ZD_16Ri,ZD_17Ri,ZD_18Ri,ZD_19Ri,ZD_20Ri,ZD_21Ri,ZD_22Ri,ZD_23Ri,ZD_24Ri,ZD_25Ri,ZD_26Ri,ZD_27Ri,ZD_28Ri,ZD_29Ri,ZD_30Ri,ZD_31Ri,ZD_HeJiShiJian,ZD_DiaoXiuShiJian,ZD_ShiJiJiaBanShiJian,ZD_JiaBanGongZi,ZD_BeiZhu,sys_nowbh,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate) values ('$ZD_XingMing','$ZD_NianFen','$ZD_1Ri','$ZD_2Ri','$ZD_3Ri','$ZD_4Ri','$ZD_5Ri','$ZD_6Ri','$ZD_7Ri','$ZD_8Ri','$ZD_9Ri','$ZD_10Ri','$ZD_11Ri','$ZD_12Ri','$ZD_13Ri','$ZD_14Ri','$ZD_15Ri','$ZD_16Ri','$ZD_17Ri','$ZD_18Ri','$ZD_19Ri','$ZD_20Ri','$ZD_21Ri','$ZD_22Ri','$ZD_23Ri','$ZD_24Ri','$ZD_25Ri','$ZD_26Ri','$ZD_27Ri','$ZD_28Ri','$ZD_29Ri','$ZD_30Ri','$ZD_31Ri','$ZD_HeJiShiJian','$ZD_DiaoXiuShiJian','$ZD_ShiJiJiaBanShiJian','$ZD_JiaBanGongZi','$ZD_BeiZhu','$nowbh','$bh_y','$r_zt','$r_zt_bianhao','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdata')";
		mysqli_query( $Conn,$sql );
		echo "<script>sys_count('204','507','$sys_gx_id_204');</script>";
		//--------------------------------------以下为查询数据
		$sql = "select id From `SQP_JiaBanDiaoXiuShiJianHuiZong` where   ZD_XingMing='$ZD_XingMing' and ZD_NianFen='$ZD_NianFen' and ZD_1Ri='$ZD_1Ri' and ZD_2Ri='$ZD_2Ri' and ZD_3Ri='$ZD_3Ri' and ZD_4Ri='$ZD_4Ri' and ZD_5Ri='$ZD_5Ri' and ZD_6Ri='$ZD_6Ri' and ZD_7Ri='$ZD_7Ri' and ZD_8Ri='$ZD_8Ri' and ZD_9Ri='$ZD_9Ri' and ZD_10Ri='$ZD_10Ri' and ZD_11Ri='$ZD_11Ri' and ZD_12Ri='$ZD_12Ri' and ZD_13Ri='$ZD_13Ri' and ZD_14Ri='$ZD_14Ri' and ZD_15Ri='$ZD_15Ri' and ZD_16Ri='$ZD_16Ri' and ZD_17Ri='$ZD_17Ri' and ZD_18Ri='$ZD_18Ri' and ZD_19Ri='$ZD_19Ri' and ZD_20Ri='$ZD_20Ri' and ZD_21Ri='$ZD_21Ri' and ZD_22Ri='$ZD_22Ri' and ZD_23Ri='$ZD_23Ri' and ZD_24Ri='$ZD_24Ri' and ZD_25Ri='$ZD_25Ri' and ZD_26Ri='$ZD_26Ri' and ZD_27Ri='$ZD_27Ri' and ZD_28Ri='$ZD_28Ri' and ZD_29Ri='$ZD_29Ri' and ZD_30Ri='$ZD_30Ri' and ZD_31Ri='$ZD_31Ri' and ZD_HeJiShiJian='$ZD_HeJiShiJian' and ZD_DiaoXiuShiJian='$ZD_DiaoXiuShiJian' and ZD_ShiJiJiaBanShiJian='$ZD_ShiJiJiaBanShiJian' and ZD_JiaBanGongZi='$ZD_JiaBanGongZi' and ZD_BeiZhu='$ZD_BeiZhu'   order by `id` desc";
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
	        $sys_postvalue_list = "'507','$nowid','$sys_editcontent'";		
	        Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	        LiYi_Add(507,$nowid,534,'+');       //利益函数 这里奖励货币
        }

		echo "$nowid";
		}
		mysqli_close( $Conn ); //关闭数据库
		
?>