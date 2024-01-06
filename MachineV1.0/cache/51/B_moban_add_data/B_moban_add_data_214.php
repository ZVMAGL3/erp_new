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
	    $sql = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where sys_yfzuid='$hy' and mdb_name_SYS='SQP_JiChuSheShiBaoYangJiHua' ";
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
	    $sql = "select MAX(sys_bh) AS sys_bh From `SQP_JiChuSheShiBaoYangJiHua` where sys_yfzuid='$hy' and sys_zt='$r_zt' and sys_zt_bianhao='$r_zt_bianhao' ";
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
	    
            if( isset($_POST["SheBeiMingChen"]) ){$SheBeiMingChen=$_POST["SheBeiMingChen"];}else{$SheBeiMingChen='';};       //设备名称
            if( isset($_POST["XingHaoGuiGe"]) ){$XingHaoGuiGe=$_POST["XingHaoGuiGe"];}else{$XingHaoGuiGe='';};       //型号规格
            if( isset($_POST["BaoYangZhouQi"]) ){$BaoYangZhouQi=$_POST["BaoYangZhouQi"];}else{$BaoYangZhouQi='';};       //保养周期
            if( isset($_POST["ZD_1Yue"]) ){$ZD_1Yue=$_POST["ZD_1Yue"];}else{$ZD_1Yue='';};       //1月
            if( isset($_POST["ZD_2Yue"]) ){$ZD_2Yue=$_POST["ZD_2Yue"];}else{$ZD_2Yue='';};       //2月
            if( isset($_POST["ZD_3Yue"]) ){$ZD_3Yue=$_POST["ZD_3Yue"];}else{$ZD_3Yue='';};       //3月
            if( isset($_POST["ZD_4Yue"]) ){$ZD_4Yue=$_POST["ZD_4Yue"];}else{$ZD_4Yue='';};       //4月
            if( isset($_POST["ZD_5Yue"]) ){$ZD_5Yue=$_POST["ZD_5Yue"];}else{$ZD_5Yue='';};       //5月
            if( isset($_POST["ZD_6Yue"]) ){$ZD_6Yue=$_POST["ZD_6Yue"];}else{$ZD_6Yue='';};       //6月
            if( isset($_POST["ZD_7Yue"]) ){$ZD_7Yue=$_POST["ZD_7Yue"];}else{$ZD_7Yue='';};       //7月
            if( isset($_POST["ZD_8Yue"]) ){$ZD_8Yue=$_POST["ZD_8Yue"];}else{$ZD_8Yue='';};       //8月
            if( isset($_POST["ZD_9Yue"]) ){$ZD_9Yue=$_POST["ZD_9Yue"];}else{$ZD_9Yue='';};       //9月
            if( isset($_POST["ZD_10Yue"]) ){$ZD_10Yue=$_POST["ZD_10Yue"];}else{$ZD_10Yue='';};       //10月
            if( isset($_POST["ZD_11Yue"]) ){$ZD_11Yue=$_POST["ZD_11Yue"];}else{$ZD_11Yue='';};       //11月
            if( isset($_POST["ZD_12Yue"]) ){$ZD_12Yue=$_POST["ZD_12Yue"];}else{$ZD_12Yue='';};       //12月
            if( isset($_POST["BeiZhu2020730下午324562448"]) ){$BeiZhu2020730下午324562448=$_POST["BeiZhu2020730下午324562448"];}else{$BeiZhu2020730下午324562448='';};       //备注

		$nowdata = date( 'Y-m-d H:i:s' );       //当前时间
		
		//--------------------------------------以下为得交数据
		$sql = "insert into  `SQP_JiChuSheShiBaoYangJiHua`  (SheBeiMingChen,XingHaoGuiGe,BaoYangZhouQi,ZD_1Yue,ZD_2Yue,ZD_3Yue,ZD_4Yue,ZD_5Yue,ZD_6Yue,ZD_7Yue,ZD_8Yue,ZD_9Yue,ZD_10Yue,ZD_11Yue,ZD_12Yue,BeiZhu2020730下午324562448,sys_nowbh,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate) values ('$SheBeiMingChen','$XingHaoGuiGe','$BaoYangZhouQi','$ZD_1Yue','$ZD_2Yue','$ZD_3Yue','$ZD_4Yue','$ZD_5Yue','$ZD_6Yue','$ZD_7Yue','$ZD_8Yue','$ZD_9Yue','$ZD_10Yue','$ZD_11Yue','$ZD_12Yue','$BeiZhu2020730下午324562448','$nowbh','$bh_y','$r_zt','$r_zt_bianhao','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdata')";
		mysqli_query( $Conn,$sql );
		echo "<script></script>";
		//--------------------------------------以下为查询数据
		$sql = "select id From `SQP_JiChuSheShiBaoYangJiHua` where   SheBeiMingChen='$SheBeiMingChen' and XingHaoGuiGe='$XingHaoGuiGe' and BaoYangZhouQi='$BaoYangZhouQi' and ZD_1Yue='$ZD_1Yue' and ZD_2Yue='$ZD_2Yue' and ZD_3Yue='$ZD_3Yue' and ZD_4Yue='$ZD_4Yue' and ZD_5Yue='$ZD_5Yue' and ZD_6Yue='$ZD_6Yue' and ZD_7Yue='$ZD_7Yue' and ZD_8Yue='$ZD_8Yue' and ZD_9Yue='$ZD_9Yue' and ZD_10Yue='$ZD_10Yue' and ZD_11Yue='$ZD_11Yue' and ZD_12Yue='$ZD_12Yue' and BeiZhu2020730下午324562448='$BeiZhu2020730下午324562448'   order by `id` desc";
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
	        $sys_postvalue_list = "'214','$nowid','$sys_editcontent'";		
	        Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	        LiYi_Add(214,$nowid,534,'+');       //利益函数 这里奖励货币
        }

		echo "$nowid";
		}
		mysqli_close( $Conn ); //关闭数据库
		
?>