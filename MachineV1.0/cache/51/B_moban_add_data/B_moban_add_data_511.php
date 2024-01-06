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
	    $sql = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where sys_yfzuid='$hy' and mdb_name_SYS='SQP_CCCFeiYongChaXun' ";
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
	    $sql = "select MAX(sys_bh) AS sys_bh From `SQP_CCCFeiYongChaXun` where sys_yfzuid='$hy' and sys_zt='$r_zt' and sys_zt_bianhao='$r_zt_bianhao' ";
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
	    
            if( isset($_POST["sys_id_zu"]) ){$sys_id_zu=$_POST["sys_id_zu"];}else{$sys_id_zu='';};       //分类
            if( isset($_POST["ZD_ChanPinMingChen"]) ){$ZD_ChanPinMingChen=$_POST["ZD_ChanPinMingChen"];}else{$ZD_ChanPinMingChen='';};       //产品名称
            if( isset($_POST["ZD_DuiYingXiangGuanChanPinMingChen"]) ){$ZD_DuiYingXiangGuanChanPinMingChen=$_POST["ZD_DuiYingXiangGuanChanPinMingChen"];}else{$ZD_DuiYingXiangGuanChanPinMingChen='';};       //对应相关产品名称
            if( isset($_POST["ZD_ZhiXingBiaoZhun"]) ){$ZD_ZhiXingBiaoZhun=$_POST["ZD_ZhiXingBiaoZhun"];}else{$ZD_ZhiXingBiaoZhun='';};       //执行标准
            if( isset($_POST["ZD_QuanXiangJianCeFei"]) ){$ZD_QuanXiangJianCeFei=$_POST["ZD_QuanXiangJianCeFei"];}else{$ZD_QuanXiangJianCeFei='';};       //全项检测费
            if( isset($_POST["ZD_ZiXunFei"]) ){$ZD_ZiXunFei=$_POST["ZD_ZiXunFei"];}else{$ZD_ZiXunFei='';};       //咨询费
            if( isset($_POST["sys_gx_id_198"]) ){$sys_gx_id_198=$_POST["sys_gx_id_198"];}else{$sys_gx_id_198='';};       //[关系]质量记录归档登记表ID

		$nowdata = date( 'Y-m-d H:i:s' );       //当前时间
		
		//--------------------------------------以下为得交数据
		$sql = "insert into  `SQP_CCCFeiYongChaXun`  (sys_id_zu,ZD_ChanPinMingChen,ZD_DuiYingXiangGuanChanPinMingChen,ZD_ZhiXingBiaoZhun,ZD_QuanXiangJianCeFei,ZD_ZiXunFei,sys_nowbh,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate) values ('$sys_id_zu','$ZD_ChanPinMingChen','$ZD_DuiYingXiangGuanChanPinMingChen','$ZD_ZhiXingBiaoZhun','$ZD_QuanXiangJianCeFei','$ZD_ZiXunFei','$nowbh','$bh_y','$r_zt','$r_zt_bianhao','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdata')";
		mysqli_query( $Conn,$sql );
		echo "<script>sys_count('198','511','$sys_gx_id_198');</script>";
		//--------------------------------------以下为查询数据
		$sql = "select id From `SQP_CCCFeiYongChaXun` where   sys_id_zu='$sys_id_zu' and ZD_ChanPinMingChen='$ZD_ChanPinMingChen' and ZD_DuiYingXiangGuanChanPinMingChen='$ZD_DuiYingXiangGuanChanPinMingChen' and ZD_ZhiXingBiaoZhun='$ZD_ZhiXingBiaoZhun' and ZD_QuanXiangJianCeFei='$ZD_QuanXiangJianCeFei' and ZD_ZiXunFei='$ZD_ZiXunFei'   order by `id` desc";
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
	        $sys_postvalue_list = "'511','$nowid','$sys_editcontent'";		
	        Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	        LiYi_Add(511,$nowid,534,'+');       //利益函数 这里奖励货币
        }

		echo "$nowid";
		}
		mysqli_close( $Conn ); //关闭数据库
		
?>