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
	    $sql = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where sys_yfzuid='$hy' and mdb_name_SYS='SQP_GuKeHeTong' ";
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
	    $sql = "select MAX(sys_bh) AS sys_bh From `SQP_GuKeHeTong` where sys_yfzuid='$hy' and sys_zt='$r_zt' and sys_zt_bianhao='$r_zt_bianhao' ";
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
	    
            if( isset($_POST["ZD_SuoShuGuKe"]) ){$ZD_SuoShuGuKe=$_POST["ZD_SuoShuGuKe"];}else{$ZD_SuoShuGuKe='';};       //所属顾客
            if( isset($_POST["ZD_HeTongBianHao"]) ){$ZD_HeTongBianHao=$_POST["ZD_HeTongBianHao"];}else{$ZD_HeTongBianHao='';};       //合同编号
            if( isset($_POST["ZD_HeTongJinE"]) ){$ZD_HeTongJinE=$_POST["ZD_HeTongJinE"];}else{$ZD_HeTongJinE='';};       //合同金额
            if( isset($_POST["ZD_XiangMu"]) ){$ZD_XiangMu=$_POST["ZD_XiangMu"];}else{$ZD_XiangMu='';};       //项目
            if( isset($_POST["ZD_LianXiRen"]) ){$ZD_LianXiRen=$_POST["ZD_LianXiRen"];}else{$ZD_LianXiRen='';};       //联系人
            if( isset($_POST["ZD_DianHua"]) ){$ZD_DianHua=$_POST["ZD_DianHua"];}else{$ZD_DianHua='';};       //电话
            if( isset($_POST["ZD_DiZhi"]) ){$ZD_DiZhi=$_POST["ZD_DiZhi"];}else{$ZD_DiZhi='';};       //地址
            if( isset($_POST["ZD_QianDingRiQi"]) ){$ZD_QianDingRiQi=$_POST["ZD_QianDingRiQi"];}else{$ZD_QianDingRiQi='';};       //签订日期
            if( isset($_POST["ZD_JiaoQi"]) ){$ZD_JiaoQi=$_POST["ZD_JiaoQi"];}else{$ZD_JiaoQi='';};       //交期
            if( isset($_POST["ZD_QianDingDiDian"]) ){$ZD_QianDingDiDian=$_POST["ZD_QianDingDiDian"];}else{$ZD_QianDingDiDian='';};       //签订地点
            if( isset($_POST["ZD_XiangMuJingLi"]) ){$ZD_XiangMuJingLi=$_POST["ZD_XiangMuJingLi"];}else{$ZD_XiangMuJingLi='';};       //项目经理
            if( isset($_POST["sys_gx_id_321"]) ){$sys_gx_id_321=$_POST["sys_gx_id_321"];}else{$sys_gx_id_321='';};       //[关系]顾客档案表ID
            if( isset($_POST["sys_gx_id_257"]) ){$sys_gx_id_257=$_POST["sys_gx_id_257"];}else{$sys_gx_id_257='';};       //[关系][SYS] 职位管理ID

		$nowdata = date( 'Y-m-d H:i:s' );       //当前时间
		
		//--------------------------------------以下为得交数据
		$sql = "insert into  `SQP_GuKeHeTong`  (ZD_SuoShuGuKe,ZD_HeTongBianHao,ZD_HeTongJinE,ZD_XiangMu,ZD_LianXiRen,ZD_DianHua,ZD_DiZhi,ZD_QianDingRiQi,ZD_JiaoQi,ZD_QianDingDiDian,ZD_XiangMuJingLi,sys_gx_id_321,sys_nowbh,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate) values ('$ZD_SuoShuGuKe','$ZD_HeTongBianHao','$ZD_HeTongJinE','$ZD_XiangMu','$ZD_LianXiRen','$ZD_DianHua','$ZD_DiZhi','$ZD_QianDingRiQi','$ZD_JiaoQi','$ZD_QianDingDiDian','$ZD_XiangMuJingLi','$sys_gx_id_321','$nowbh','$bh_y','$r_zt','$r_zt_bianhao','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdata')";
		mysqli_query( $Conn,$sql );
		echo "<script>sys_count('321','423','$sys_gx_id_321');sys_count('257','423','$sys_gx_id_257');</script>";
		//--------------------------------------以下为查询数据
		$sql = "select id From `SQP_GuKeHeTong` where   ZD_SuoShuGuKe='$ZD_SuoShuGuKe' and ZD_HeTongBianHao='$ZD_HeTongBianHao' and ZD_HeTongJinE='$ZD_HeTongJinE' and ZD_XiangMu='$ZD_XiangMu' and ZD_LianXiRen='$ZD_LianXiRen' and ZD_DianHua='$ZD_DianHua' and ZD_DiZhi='$ZD_DiZhi' and ZD_QianDingRiQi='$ZD_QianDingRiQi' and ZD_JiaoQi='$ZD_JiaoQi' and ZD_QianDingDiDian='$ZD_QianDingDiDian' and ZD_XiangMuJingLi='$ZD_XiangMuJingLi' and sys_gx_id_321='$sys_gx_id_321'   order by `id` desc";
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
	        $sys_postvalue_list = "'423','$nowid','$sys_editcontent'";		
	        Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	        LiYi_Add(423,$nowid,534,'+');       //利益函数 这里奖励货币
        }

		echo "$nowid";
		}
		mysqli_close( $Conn ); //关闭数据库
		
?>