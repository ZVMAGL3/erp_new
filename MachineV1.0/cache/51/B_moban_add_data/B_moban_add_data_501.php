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
	    $sql = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where sys_yfzuid='$hy' and mdb_name_SYS='SQP_ChanPinQingDan' ";
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
	    $sql = "select MAX(sys_bh) AS sys_bh From `SQP_ChanPinQingDan` where sys_yfzuid='$hy' and sys_zt='$r_zt' and sys_zt_bianhao='$r_zt_bianhao' ";
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
	    
            if( isset($_POST["ZD_ShiYongFanWei"]) ){$ZD_ShiYongFanWei=$_POST["ZD_ShiYongFanWei"];}else{$ZD_ShiYongFanWei='';};       //适用范围
            if( isset($_POST["ZD_QuZhengZhouQi"]) ){$ZD_QuZhengZhouQi=$_POST["ZD_QuZhengZhouQi"];}else{$ZD_QuZhengZhouQi='';};       //取证周期
            if( isset($_POST["ZD_ChanPinMingChen"]) ){$ZD_ChanPinMingChen=$_POST["ZD_ChanPinMingChen"];}else{$ZD_ChanPinMingChen='';};       //产品名称
            if( isset($_POST["ZD_YouXiaoQi"]) ){$ZD_YouXiaoQi=$_POST["ZD_YouXiaoQi"];}else{$ZD_YouXiaoQi='';};       //有效期
            if( isset($_POST["ZD_RenShuYuChanPin"]) ){$ZD_RenShuYuChanPin=$_POST["ZD_RenShuYuChanPin"];}else{$ZD_RenShuYuChanPin='';};       //人数与产品
            if( isset($_POST["ZD_ShouFeiBiaoZhun"]) ){$ZD_ShouFeiBiaoZhun=$_POST["ZD_ShouFeiBiaoZhun"];}else{$ZD_ShouFeiBiaoZhun='';};       //收费标准
            if( isset($_POST["ZD_ReDu"]) ){$ZD_ReDu=$_POST["ZD_ReDu"];}else{$ZD_ReDu='';};       //热度
            if( isset($_POST["ZD_HeZuoJiGou"]) ){$ZD_HeZuoJiGou=$_POST["ZD_HeZuoJiGou"];}else{$ZD_HeZuoJiGou='';};       //合作机构
            if( isset($_POST["ZD_RenZhengXuYaoZhunBeiDeCaiLiao"]) ){$ZD_RenZhengXuYaoZhunBeiDeCaiLiao=$_POST["ZD_RenZhengXuYaoZhunBeiDeCaiLiao"];}else{$ZD_RenZhengXuYaoZhunBeiDeCaiLiao='';};       //认证需要准备的材料
            if( isset($_POST["ZD_XiangMuJianJie"]) ){$ZD_XiangMuJianJie=$_POST["ZD_XiangMuJianJie"];}else{$ZD_XiangMuJianJie='';};       //项目简介
            if( isset($_POST["sys_gx_id_321"]) ){$sys_gx_id_321=$_POST["sys_gx_id_321"];}else{$sys_gx_id_321='';};       //[关系]顾客档案表ID
            if( isset($_POST["sys_gx_id_257"]) ){$sys_gx_id_257=$_POST["sys_gx_id_257"];}else{$sys_gx_id_257='';};       //[关系][SYS] 职位管理ID

		$nowdata = date( 'Y-m-d H:i:s' );       //当前时间
		
		//--------------------------------------以下为得交数据
		$sql = "insert into  `SQP_ChanPinQingDan`  (ZD_ShiYongFanWei,ZD_QuZhengZhouQi,ZD_ChanPinMingChen,ZD_YouXiaoQi,ZD_RenShuYuChanPin,ZD_ShouFeiBiaoZhun,ZD_ReDu,ZD_HeZuoJiGou,ZD_RenZhengXuYaoZhunBeiDeCaiLiao,ZD_XiangMuJianJie,sys_nowbh,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate) values ('$ZD_ShiYongFanWei','$ZD_QuZhengZhouQi','$ZD_ChanPinMingChen','$ZD_YouXiaoQi','$ZD_RenShuYuChanPin','$ZD_ShouFeiBiaoZhun','$ZD_ReDu','$ZD_HeZuoJiGou','$ZD_RenZhengXuYaoZhunBeiDeCaiLiao','$ZD_XiangMuJianJie','$nowbh','$bh_y','$r_zt','$r_zt_bianhao','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdata')";
		mysqli_query( $Conn,$sql );
		echo "<script>sys_count('321','501','$sys_gx_id_321');sys_count('257','501','$sys_gx_id_257');</script>";
		//--------------------------------------以下为查询数据
		$sql = "select id From `SQP_ChanPinQingDan` where   ZD_ShiYongFanWei='$ZD_ShiYongFanWei' and ZD_QuZhengZhouQi='$ZD_QuZhengZhouQi' and ZD_ChanPinMingChen='$ZD_ChanPinMingChen' and ZD_YouXiaoQi='$ZD_YouXiaoQi' and ZD_RenShuYuChanPin='$ZD_RenShuYuChanPin' and ZD_ShouFeiBiaoZhun='$ZD_ShouFeiBiaoZhun' and ZD_ReDu='$ZD_ReDu' and ZD_HeZuoJiGou='$ZD_HeZuoJiGou' and ZD_RenZhengXuYaoZhunBeiDeCaiLiao='$ZD_RenZhengXuYaoZhunBeiDeCaiLiao' and ZD_XiangMuJianJie='$ZD_XiangMuJianJie'   order by `id` desc";
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
	        $sys_postvalue_list = "'501','$nowid','$sys_editcontent'";		
	        Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	        LiYi_Add(501,$nowid,534,'+');       //利益函数 这里奖励货币
        }

		echo "$nowid";
		}
		mysqli_close( $Conn ); //关闭数据库
		
?>