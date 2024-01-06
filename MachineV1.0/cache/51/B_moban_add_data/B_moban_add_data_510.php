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
	    $sql = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where sys_yfzuid='$hy' and mdb_name_SYS='SQP_KeHuZhengShuGuanLi' ";
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
	    $sql = "select MAX(sys_bh) AS sys_bh From `SQP_KeHuZhengShuGuanLi` where sys_yfzuid='$hy' and sys_zt='$r_zt' and sys_zt_bianhao='$r_zt_bianhao' ";
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
	    
            if( isset($_POST["ZD_ZhengShuHao"]) ){$ZD_ZhengShuHao=$_POST["ZD_ZhengShuHao"];}else{$ZD_ZhengShuHao='';};       //证书号
            if( isset($_POST["sys_gx_id_321"]) ){$sys_gx_id_321=$_POST["sys_gx_id_321"];}else{$sys_gx_id_321='';};       //[关系]顾客档案表ID
            if( isset($_POST["ZD_KeHuMingChen"]) ){$ZD_KeHuMingChen=$_POST["ZD_KeHuMingChen"];}else{$ZD_KeHuMingChen='';};       //客户名称
            if( isset($_POST["ZD_XiangMu"]) ){$ZD_XiangMu=$_POST["ZD_XiangMu"];}else{$ZD_XiangMu='';};       //项目
            if( isset($_POST["ZD_ChuShenShiJian"]) ){$ZD_ChuShenShiJian=$_POST["ZD_ChuShenShiJian"];}else{$ZD_ChuShenShiJian='';};       //初审时间
            if( isset($_POST["ZD_JianShiJian"]) ){$ZD_JianShiJian=$_POST["ZD_JianShiJian"];}else{$ZD_JianShiJian='';};       //监①时间
            if( isset($_POST["ZD_JianShiJian1629904411348"]) ){$ZD_JianShiJian1629904411348=$_POST["ZD_JianShiJian1629904411348"];}else{$ZD_JianShiJian1629904411348='';};       //监②时间
            if( isset($_POST["ZD_HuanZhengShiJian"]) ){$ZD_HuanZhengShiJian=$_POST["ZD_HuanZhengShiJian"];}else{$ZD_HuanZhengShiJian='';};       //换证时间
            if( isset($_POST["ZD_RenZhengFanWei"]) ){$ZD_RenZhengFanWei=$_POST["ZD_RenZhengFanWei"];}else{$ZD_RenZhengFanWei='';};       //认证范围
            if( isset($_POST["ZD_LianXiRen"]) ){$ZD_LianXiRen=$_POST["ZD_LianXiRen"];}else{$ZD_LianXiRen='';};       //联系人
            if( isset($_POST["ZD_DianHua"]) ){$ZD_DianHua=$_POST["ZD_DianHua"];}else{$ZD_DianHua='';};       //电话
            if( isset($_POST["ZD_GongSiDiZhi"]) ){$ZD_GongSiDiZhi=$_POST["ZD_GongSiDiZhi"];}else{$ZD_GongSiDiZhi='';};       //公司地址
            if( isset($_POST["ZD_XiangMuFuZeRen"]) ){$ZD_XiangMuFuZeRen=$_POST["ZD_XiangMuFuZeRen"];}else{$ZD_XiangMuFuZeRen='';};       //项目负责人
            if( isset($_POST["ZD_RenZhengFei"]) ){$ZD_RenZhengFei=$_POST["ZD_RenZhengFei"];}else{$ZD_RenZhengFei='';};       //认证费
            if( isset($_POST["ZD_ZiXunFei"]) ){$ZD_ZiXunFei=$_POST["ZD_ZiXunFei"];}else{$ZD_ZiXunFei='';};       //104
            if( isset($_POST["sys_gx_id_423"]) ){$sys_gx_id_423=$_POST["sys_gx_id_423"];}else{$sys_gx_id_423='';};       //[关系]顾客合同ID
            if( isset($_POST["ZD_GenJinYueFen"]) ){$ZD_GenJinYueFen=$_POST["ZD_GenJinYueFen"];}else{$ZD_GenJinYueFen='';};       //跟进月份
            if( isset($_POST["sys_id_zu"]) ){$sys_id_zu=$_POST["sys_id_zu"];}else{$sys_id_zu='';};       //分类
            if( isset($_POST["ZD_RenZhengJiGou"]) ){$ZD_RenZhengJiGou=$_POST["ZD_RenZhengJiGou"];}else{$ZD_RenZhengJiGou='';};       //认证机构

		$nowdata = date( 'Y-m-d H:i:s' );       //当前时间
		
		//--------------------------------------以下为得交数据
		$sql = "insert into  `SQP_KeHuZhengShuGuanLi`  (ZD_ZhengShuHao,sys_gx_id_321,ZD_KeHuMingChen,ZD_XiangMu,ZD_ChuShenShiJian,ZD_JianShiJian,ZD_JianShiJian1629904411348,ZD_HuanZhengShiJian,ZD_RenZhengFanWei,ZD_LianXiRen,ZD_DianHua,ZD_GongSiDiZhi,ZD_XiangMuFuZeRen,ZD_RenZhengFei,ZD_ZiXunFei,sys_gx_id_423,ZD_GenJinYueFen,sys_id_zu,ZD_RenZhengJiGou,sys_nowbh,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate) values ('$ZD_ZhengShuHao','$sys_gx_id_321','$ZD_KeHuMingChen','$ZD_XiangMu','$ZD_ChuShenShiJian','$ZD_JianShiJian','$ZD_JianShiJian1629904411348','$ZD_HuanZhengShiJian','$ZD_RenZhengFanWei','$ZD_LianXiRen','$ZD_DianHua','$ZD_GongSiDiZhi','$ZD_XiangMuFuZeRen','$ZD_RenZhengFei','$ZD_ZiXunFei','$sys_gx_id_423','$ZD_GenJinYueFen','$sys_id_zu','$ZD_RenZhengJiGou','$nowbh','$bh_y','$r_zt','$r_zt_bianhao','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdata')";
		mysqli_query( $Conn,$sql );
		echo "<script>sys_count('321','510','$sys_gx_id_321');sys_count('423','510','$sys_gx_id_423');</script>";
		//--------------------------------------以下为查询数据
		$sql = "select id From `SQP_KeHuZhengShuGuanLi` where   ZD_ZhengShuHao='$ZD_ZhengShuHao' and sys_gx_id_321='$sys_gx_id_321' and ZD_KeHuMingChen='$ZD_KeHuMingChen' and ZD_XiangMu='$ZD_XiangMu' and ZD_ChuShenShiJian='$ZD_ChuShenShiJian' and ZD_JianShiJian='$ZD_JianShiJian' and ZD_JianShiJian1629904411348='$ZD_JianShiJian1629904411348' and ZD_HuanZhengShiJian='$ZD_HuanZhengShiJian' and ZD_RenZhengFanWei='$ZD_RenZhengFanWei' and ZD_LianXiRen='$ZD_LianXiRen' and ZD_DianHua='$ZD_DianHua' and ZD_GongSiDiZhi='$ZD_GongSiDiZhi' and ZD_XiangMuFuZeRen='$ZD_XiangMuFuZeRen' and ZD_RenZhengFei='$ZD_RenZhengFei' and ZD_ZiXunFei='$ZD_ZiXunFei' and sys_gx_id_423='$sys_gx_id_423' and ZD_GenJinYueFen='$ZD_GenJinYueFen' and sys_id_zu='$sys_id_zu' and ZD_RenZhengJiGou='$ZD_RenZhengJiGou'   order by `id` desc";
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
	        $sys_postvalue_list = "'510','$nowid','$sys_editcontent'";		
	        Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	        LiYi_Add(510,$nowid,534,'+');       //利益函数 这里奖励货币
        }

		echo "$nowid";
		}
		mysqli_close( $Conn ); //关闭数据库
		
?>