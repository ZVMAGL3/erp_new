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
	    $sql = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where sys_yfzuid='$hy' and mdb_name_SYS='SQP_HeZuoHuoBan' ";
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
	    $sql = "select MAX(sys_bh) AS sys_bh From `SQP_HeZuoHuoBan` where sys_yfzuid='$hy' and sys_zt='$r_zt' and sys_zt_bianhao='$r_zt_bianhao' ";
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
	    
            if( isset($_POST["ZD_GongSi"]) ){$ZD_GongSi=$_POST["ZD_GongSi"];}else{$ZD_GongSi='';};       //公司
            if( isset($_POST["ZD_FaRen"]) ){$ZD_FaRen=$_POST["ZD_FaRen"];}else{$ZD_FaRen='';};       //法人
            if( isset($_POST["ZD_JianChen"]) ){$ZD_JianChen=$_POST["ZD_JianChen"];}else{$ZD_JianChen='';};       //简称
            if( isset($_POST["ZD_XingBie"]) ){$ZD_XingBie=$_POST["ZD_XingBie"];}else{$ZD_XingBie='';};       //性别
            if( isset($_POST["ZD_DianHua"]) ){$ZD_DianHua=$_POST["ZD_DianHua"];}else{$ZD_DianHua='';};       //电话
            if( isset($_POST["BeiZhu"]) ){$BeiZhu=$_POST["BeiZhu"];}else{$BeiZhu='';};       //备注
            if( isset($_POST["ZD_DiZhi"]) ){$ZD_DiZhi=$_POST["ZD_DiZhi"];}else{$ZD_DiZhi='';};       //地址
            if( isset($_POST["ZD_SheBaoRenShu"]) ){$ZD_SheBaoRenShu=$_POST["ZD_SheBaoRenShu"];}else{$ZD_SheBaoRenShu='';};       //社保人数
            if( isset($_POST["ZD_WeiXin"]) ){$ZD_WeiXin=$_POST["ZD_WeiXin"];}else{$ZD_WeiXin='';};       //微信
            if( isset($_POST["ZD_HeZuo"]) ){$ZD_HeZuo=$_POST["ZD_HeZuo"];}else{$ZD_HeZuo='';};       //合作
            if( isset($_POST["ZD_QuFang"]) ){$ZD_QuFang=$_POST["ZD_QuFang"];}else{$ZD_QuFang='';};       //去访
            if( isset($_POST["LaiFang"]) ){$LaiFang=$_POST["LaiFang"];}else{$LaiFang='';};       //来访
            if( isset($_POST["PeiXun"]) ){$PeiXun=$_POST["PeiXun"];}else{$PeiXun='';};       //培训
            if( isset($_POST["ZD_XiTong"]) ){$ZD_XiTong=$_POST["ZD_XiTong"];}else{$ZD_XiTong='';};       //系统
            if( isset($_POST["ZD_JiHuaBaiFang"]) ){$ZD_JiHuaBaiFang=$_POST["ZD_JiHuaBaiFang"];}else{$ZD_JiHuaBaiFang='';};       //计划拜访
            if( isset($_POST["ZD_ZhuYingYeWu"]) ){$ZD_ZhuYingYeWu=$_POST["ZD_ZhuYingYeWu"];}else{$ZD_ZhuYingYeWu='';};       //主营业务

		$nowdata = date( 'Y-m-d H:i:s' );       //当前时间
		
		//--------------------------------------以下为得交数据
		$sql = "insert into  `SQP_HeZuoHuoBan`  (ZD_GongSi,ZD_FaRen,ZD_JianChen,ZD_XingBie,ZD_DianHua,BeiZhu,ZD_DiZhi,ZD_SheBaoRenShu,ZD_WeiXin,ZD_HeZuo,ZD_QuFang,LaiFang,PeiXun,ZD_XiTong,ZD_JiHuaBaiFang,ZD_ZhuYingYeWu,sys_nowbh,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate) values ('$ZD_GongSi','$ZD_FaRen','$ZD_JianChen','$ZD_XingBie','$ZD_DianHua','$BeiZhu','$ZD_DiZhi','$ZD_SheBaoRenShu','$ZD_WeiXin','$ZD_HeZuo','$ZD_QuFang','$LaiFang','$PeiXun','$ZD_XiTong','$ZD_JiHuaBaiFang','$ZD_ZhuYingYeWu','$nowbh','$bh_y','$r_zt','$r_zt_bianhao','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdata')";
		mysqli_query( $Conn,$sql );
		echo "<script></script>";
		//--------------------------------------以下为查询数据
		$sql = "select id From `SQP_HeZuoHuoBan` where   ZD_GongSi='$ZD_GongSi' and ZD_FaRen='$ZD_FaRen' and ZD_JianChen='$ZD_JianChen' and ZD_XingBie='$ZD_XingBie' and ZD_DianHua='$ZD_DianHua' and BeiZhu='$BeiZhu' and ZD_DiZhi='$ZD_DiZhi' and ZD_SheBaoRenShu='$ZD_SheBaoRenShu' and ZD_WeiXin='$ZD_WeiXin' and ZD_HeZuo='$ZD_HeZuo' and ZD_QuFang='$ZD_QuFang' and LaiFang='$LaiFang' and PeiXun='$PeiXun' and ZD_XiTong='$ZD_XiTong' and ZD_JiHuaBaiFang='$ZD_JiHuaBaiFang' and ZD_ZhuYingYeWu='$ZD_ZhuYingYeWu'   order by `id` desc";
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
	        $sys_postvalue_list = "'223','$nowid','$sys_editcontent'";		
	        Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	        LiYi_Add(223,$nowid,534,'+');       //利益函数 这里奖励货币
        }

		echo "$nowid";
		}
		mysqli_close( $Conn ); //关闭数据库
		
?>