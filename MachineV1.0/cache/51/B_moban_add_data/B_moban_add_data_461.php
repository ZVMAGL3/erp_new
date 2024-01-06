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
	    $sql = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where sys_yfzuid='$hy' and mdb_name_SYS='SQP_WenJianZiDongHua' ";
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
	    $sql = "select MAX(sys_bh) AS sys_bh From `SQP_WenJianZiDongHua` where sys_yfzuid='$hy' and sys_zt='$r_zt' and sys_zt_bianhao='$r_zt_bianhao' ";
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
	    
            if( isset($_POST["ZD_GongSiMingChen"]) ){$ZD_GongSiMingChen=$_POST["ZD_GongSiMingChen"];}else{$ZD_GongSiMingChen='';};       //公司名称
            if( isset($_POST["ZD_GongSiDiZhi"]) ){$ZD_GongSiDiZhi=$_POST["ZD_GongSiDiZhi"];}else{$ZD_GongSiDiZhi='';};       //公司地址
            if( isset($_POST["ZD_GongSiDianHua"]) ){$ZD_GongSiDianHua=$_POST["ZD_GongSiDianHua"];}else{$ZD_GongSiDianHua='';};       //公司电话
            if( isset($_POST["ZD_GongSiChuanZhen"]) ){$ZD_GongSiChuanZhen=$_POST["ZD_GongSiChuanZhen"];}else{$ZD_GongSiChuanZhen='';};       //公司传真
            if( isset($_POST["ZD_ZongJingLi"]) ){$ZD_ZongJingLi=$_POST["ZD_ZongJingLi"];}else{$ZD_ZongJingLi='';};       //总经理
            if( isset($_POST["ZD_GuanLiZheDaiBiao"]) ){$ZD_GuanLiZheDaiBiao=$_POST["ZD_GuanLiZheDaiBiao"];}else{$ZD_GuanLiZheDaiBiao='';};       //管理者代表
            if( isset($_POST["ZD_AnQuanShiWuDaiBiao"]) ){$ZD_AnQuanShiWuDaiBiao=$_POST["ZD_AnQuanShiWuDaiBiao"];}else{$ZD_AnQuanShiWuDaiBiao='';};       //安全事务代表
            if( isset($_POST["ZD_ShouCeBianZhiRen"]) ){$ZD_ShouCeBianZhiRen=$_POST["ZD_ShouCeBianZhiRen"];}else{$ZD_ShouCeBianZhiRen='';};       //手册编制人

		$nowdata = date( 'Y-m-d H:i:s' );       //当前时间
		
		//--------------------------------------以下为得交数据
		$sql = "insert into  `SQP_WenJianZiDongHua`  (ZD_GongSiMingChen,ZD_GongSiDiZhi,ZD_GongSiDianHua,ZD_GongSiChuanZhen,ZD_ZongJingLi,ZD_GuanLiZheDaiBiao,ZD_AnQuanShiWuDaiBiao,ZD_ShouCeBianZhiRen,sys_nowbh,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate) values ('$ZD_GongSiMingChen','$ZD_GongSiDiZhi','$ZD_GongSiDianHua','$ZD_GongSiChuanZhen','$ZD_ZongJingLi','$ZD_GuanLiZheDaiBiao','$ZD_AnQuanShiWuDaiBiao','$ZD_ShouCeBianZhiRen','$nowbh','$bh_y','$r_zt','$r_zt_bianhao','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdata')";
		mysqli_query( $Conn,$sql );
		echo "<script></script>";
		//--------------------------------------以下为查询数据
		$sql = "select id From `SQP_WenJianZiDongHua` where   ZD_GongSiMingChen='$ZD_GongSiMingChen' and ZD_GongSiDiZhi='$ZD_GongSiDiZhi' and ZD_GongSiDianHua='$ZD_GongSiDianHua' and ZD_GongSiChuanZhen='$ZD_GongSiChuanZhen' and ZD_ZongJingLi='$ZD_ZongJingLi' and ZD_GuanLiZheDaiBiao='$ZD_GuanLiZheDaiBiao' and ZD_AnQuanShiWuDaiBiao='$ZD_AnQuanShiWuDaiBiao' and ZD_ShouCeBianZhiRen='$ZD_ShouCeBianZhiRen'   order by `id` desc";
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
	        $sys_postvalue_list = "'461','$nowid','$sys_editcontent'";		
	        Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	        LiYi_Add(461,$nowid,534,'+');       //利益函数 这里奖励货币
        }

		echo "$nowid";
		}
		mysqli_close( $Conn ); //关闭数据库
		
?>