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
	    $sql = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where sys_yfzuid='$hy' and mdb_name_SYS='sys_gukedanganbiao' ";
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
	    $sql = "select MAX(sys_bh) AS sys_bh From `sys_gukedanganbiao` where sys_yfzuid='$hy' and sys_zt='$r_zt' and sys_zt_bianhao='$r_zt_bianhao' ";
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
	    
            if( isset($_POST["ZD_BeiZhuQiYeGongShangXinYongDeng"]) ){$ZD_BeiZhuQiYeGongShangXinYongDeng=$_POST["ZD_BeiZhuQiYeGongShangXinYongDeng"];}else{$ZD_BeiZhuQiYeGongShangXinYongDeng='';};       //备注【企业工商信用等】
            if( isset($_POST["ZD_GongSiMingChen"]) ){$ZD_GongSiMingChen=$_POST["ZD_GongSiMingChen"];}else{$ZD_GongSiMingChen='';};       //公司名称
            if( isset($_POST["ZD_FuZeRen"]) ){$ZD_FuZeRen=$_POST["ZD_FuZeRen"];}else{$ZD_FuZeRen='';};       //负责人
            if( isset($_POST["ZD_YiXiangFuWu"]) ){$ZD_YiXiangFuWu=$_POST["ZD_YiXiangFuWu"];}else{$ZD_YiXiangFuWu='';};       //意向服务
            if( isset($_POST["XiangMuJingLi"]) ){$XiangMuJingLi=$_POST["XiangMuJingLi"];}else{$XiangMuJingLi='';};       //项目经理
            if( isset($_POST["ZD_ChengJiaoXiangMu"]) ){$ZD_ChengJiaoXiangMu=$_POST["ZD_ChengJiaoXiangMu"];}else{$ZD_ChengJiaoXiangMu='';};       //成交项目
            if( isset($_POST["ZD_DengJi"]) ){$ZD_DengJi=$_POST["ZD_DengJi"];}else{$ZD_DengJi='';};       //等级
            if( isset($_POST["XingBie"]) ){$XingBie=$_POST["XingBie"];}else{$XingBie='';};       //性别
            if( isset($_POST["DianHua"]) ){$DianHua=$_POST["DianHua"];}else{$DianHua='';};       //电话
            if( isset($_POST["sys_gx_id_223"]) ){$sys_gx_id_223=$_POST["sys_gx_id_223"];}else{$sys_gx_id_223='';};       //[关系]合作伙伴ID
            if( isset($_POST["ShengChanChanPin"]) ){$ShengChanChanPin=$_POST["ShengChanChanPin"];}else{$ShengChanChanPin='';};       //生产产品
            if( isset($_POST["DiZhi"]) ){$DiZhi=$_POST["DiZhi"];}else{$DiZhi='';};       //地址
            if( isset($_POST["sys_id_zu"]) ){$sys_id_zu=$_POST["sys_id_zu"];}else{$sys_id_zu='';};       //分类
            if( isset($_POST["sys_chaosong"]) ){$sys_chaosong=$_POST["sys_chaosong"];}else{$sys_chaosong='';};       //经办人
            if( isset($_POST["ZD_WeiXin"]) ){$ZD_WeiXin=$_POST["ZD_WeiXin"];}else{$ZD_WeiXin='';};       //微信
            if( isset($_POST["sys_gx_id_256"]) ){$sys_gx_id_256=$_POST["sys_gx_id_256"];}else{$sys_gx_id_256='';};       //[关系]SYS云帐户ID

		$nowdata = date( 'Y-m-d H:i:s' );       //当前时间
		
		//--------------------------------------以下为得交数据
		$sql = "insert into  `sys_gukedanganbiao`  (ZD_BeiZhuQiYeGongShangXinYongDeng,ZD_GongSiMingChen,ZD_FuZeRen,ZD_YiXiangFuWu,XiangMuJingLi,ZD_ChengJiaoXiangMu,ZD_DengJi,XingBie,DianHua,sys_gx_id_223,ShengChanChanPin,DiZhi,sys_id_zu,sys_chaosong,ZD_WeiXin,sys_nowbh,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate) values ('$ZD_BeiZhuQiYeGongShangXinYongDeng','$ZD_GongSiMingChen','$ZD_FuZeRen','$ZD_YiXiangFuWu','$XiangMuJingLi','$ZD_ChengJiaoXiangMu','$ZD_DengJi','$XingBie','$DianHua','$sys_gx_id_223','$ShengChanChanPin','$DiZhi','$sys_id_zu','$sys_chaosong','$ZD_WeiXin','$nowbh','$bh_y','$r_zt','$r_zt_bianhao','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdata')";
		mysqli_query( $Conn,$sql );
		echo "<script>sys_count('223','321','$sys_gx_id_223');sys_count('256','321','$sys_gx_id_256');</script>";
        $nowid = mysqli_insert_id($Conn)
        //--------------------------------------以下为操作记录提交
        $sys_editcontent='首次建档;';
        if($sys_editcontent!=''){
            $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	        $sys_postvalue_list = "'321','$nowid','$sys_editcontent'";		
	        Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	        LiYi_Add(321,$nowid,534,'+');       //利益函数 这里奖励货币
        }

		echo "$nowid";
		}
		mysqli_close( $Conn ); //关闭数据库
		
?>