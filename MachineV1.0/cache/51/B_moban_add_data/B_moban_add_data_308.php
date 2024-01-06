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
	    $sql = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where sys_yfzuid='$hy' and mdb_name_SYS='SQP_GuKeCaiChanQingDan' ";
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
	    $sql = "select MAX(sys_bh) AS sys_bh From `SQP_GuKeCaiChanQingDan` where sys_yfzuid='$hy' and sys_zt='$r_zt' and sys_zt_bianhao='$r_zt_bianhao' ";
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
	    
            if( isset($_POST["sys_gx_id_321"]) ){$sys_gx_id_321=$_POST["sys_gx_id_321"];}else{$sys_gx_id_321='';};       //关系字段:sys_gx_id_321
            if( isset($_POST["ZD_GuKeMingChen"]) ){$ZD_GuKeMingChen=$_POST["ZD_GuKeMingChen"];}else{$ZD_GuKeMingChen='';};       //顾客名称
            if( isset($_POST["ZD_CaiChanMingChen"]) ){$ZD_CaiChanMingChen=$_POST["ZD_CaiChanMingChen"];}else{$ZD_CaiChanMingChen='';};       //财产名称
            if( isset($_POST["ZD_XingHaoGuiGe"]) ){$ZD_XingHaoGuiGe=$_POST["ZD_XingHaoGuiGe"];}else{$ZD_XingHaoGuiGe='';};       //型号/规格
            if( isset($_POST["ZD_BenChangBianHao"]) ){$ZD_BenChangBianHao=$_POST["ZD_BenChangBianHao"];}else{$ZD_BenChangBianHao='';};       //本厂编号
            if( isset($_POST["ZD_ShuLiang"]) ){$ZD_ShuLiang=$_POST["ZD_ShuLiang"];}else{$ZD_ShuLiang='';};       //数量
            if( isset($_POST["ZD_JieShouRiQi"]) ){$ZD_JieShouRiQi=$_POST["ZD_JieShouRiQi"];}else{$ZD_JieShouRiQi='';};       //接收日期
            if( isset($_POST["ZD_ShiYongBuMen"]) ){$ZD_ShiYongBuMen=$_POST["ZD_ShiYongBuMen"];}else{$ZD_ShiYongBuMen='';};       //使用部门
            if( isset($_POST["ZD_WanHaoZhuangTai"]) ){$ZD_WanHaoZhuangTai=$_POST["ZD_WanHaoZhuangTai"];}else{$ZD_WanHaoZhuangTai='';};       //完好状态
            if( isset($_POST["ZD_CunFangDiDian"]) ){$ZD_CunFangDiDian=$_POST["ZD_CunFangDiDian"];}else{$ZD_CunFangDiDian='';};       //存放地点
            if( isset($_POST["ZD_BaoFeiRiQi"]) ){$ZD_BaoFeiRiQi=$_POST["ZD_BaoFeiRiQi"];}else{$ZD_BaoFeiRiQi='';};       //报废日期
            if( isset($_POST["ZD_BeiZhu"]) ){$ZD_BeiZhu=$_POST["ZD_BeiZhu"];}else{$ZD_BeiZhu='';};       //备注

		$nowdata = date( 'Y-m-d H:i:s' );       //当前时间
		
		//--------------------------------------以下为得交数据
		$sql = "insert into  `SQP_GuKeCaiChanQingDan`  (sys_gx_id_321,ZD_GuKeMingChen,ZD_CaiChanMingChen,ZD_XingHaoGuiGe,ZD_BenChangBianHao,ZD_ShuLiang,ZD_JieShouRiQi,ZD_ShiYongBuMen,ZD_WanHaoZhuangTai,ZD_CunFangDiDian,ZD_BaoFeiRiQi,ZD_BeiZhu,sys_nowbh,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate) values ('$sys_gx_id_321','$ZD_GuKeMingChen','$ZD_CaiChanMingChen','$ZD_XingHaoGuiGe','$ZD_BenChangBianHao','$ZD_ShuLiang','$ZD_JieShouRiQi','$ZD_ShiYongBuMen','$ZD_WanHaoZhuangTai','$ZD_CunFangDiDian','$ZD_BaoFeiRiQi','$ZD_BeiZhu','$nowbh','$bh_y','$r_zt','$r_zt_bianhao','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdata')";
		mysqli_query( $Conn,$sql );
		echo "<script>sys_count('321','308','$sys_gx_id_321');</script>";
		//--------------------------------------以下为查询数据
		$sql = "select id From `SQP_GuKeCaiChanQingDan` where   sys_gx_id_321='$sys_gx_id_321' and ZD_GuKeMingChen='$ZD_GuKeMingChen' and ZD_CaiChanMingChen='$ZD_CaiChanMingChen' and ZD_XingHaoGuiGe='$ZD_XingHaoGuiGe' and ZD_BenChangBianHao='$ZD_BenChangBianHao' and ZD_ShuLiang='$ZD_ShuLiang' and ZD_JieShouRiQi='$ZD_JieShouRiQi' and ZD_ShiYongBuMen='$ZD_ShiYongBuMen' and ZD_WanHaoZhuangTai='$ZD_WanHaoZhuangTai' and ZD_CunFangDiDian='$ZD_CunFangDiDian' and ZD_BaoFeiRiQi='$ZD_BaoFeiRiQi' and ZD_BeiZhu='$ZD_BeiZhu'   order by `id` desc";
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
	        $sys_postvalue_list = "'308','$nowid','$sys_editcontent'";		
	        Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	        LiYi_Add(308,$nowid,534,'+');       //利益函数 这里奖励货币
        }

		echo "$nowid";
		}
		mysqli_close( $Conn ); //关闭数据库
		
?>