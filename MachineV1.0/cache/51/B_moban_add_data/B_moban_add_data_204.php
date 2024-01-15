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
	    $sql = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where sys_yfzuid='$hy' and mdb_name_SYS='sys_yuangongdanganbiao' ";
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
	    $sql = "select MAX(sys_bh) AS sys_bh From `sys_yuangongdanganbiao` where sys_yfzuid='$hy' and sys_zt='$r_zt' and sys_zt_bianhao='$r_zt_bianhao' ";
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
	    
            if( isset($_POST["SYS_UserName"]) ){$SYS_UserName=$_POST["SYS_UserName"];}else{$SYS_UserName='';};       //姓名
            if( isset($_POST["XingBie"]) ){$XingBie=$_POST["XingBie"];}else{$XingBie='';};       //性别
            if( isset($_POST["SYS_GongHao"]) ){$SYS_GongHao=$_POST["SYS_GongHao"];}else{$SYS_GongHao='';};       //工号
            if( isset($_POST["SYS_QuanXian"]) ){$SYS_QuanXian=$_POST["SYS_QuanXian"];}else{$SYS_QuanXian='';};       //职位
            if( isset($_POST["SYS_ShouJi"]) ){$SYS_ShouJi=$_POST["SYS_ShouJi"];}else{$SYS_ShouJi='';};       //联系方式
            if( isset($_POST["GongZi"]) ){$GongZi=$_POST["GongZi"];}else{$GongZi='';};       //工资
            if( isset($_POST["ZD_GongZiFaFangZhangHu"]) ){$ZD_GongZiFaFangZhangHu=$_POST["ZD_GongZiFaFangZhangHu"];}else{$ZD_GongZiFaFangZhangHu='';};       //工资发放账户
            if( isset($_POST["SYS_ShenFenZheng"]) ){$SYS_ShenFenZheng=$_POST["SYS_ShenFenZheng"];}else{$SYS_ShenFenZheng='';};       //身份证
            if( isset($_POST["ZD_XianZhuDiZhi"]) ){$ZD_XianZhuDiZhi=$_POST["ZD_XianZhuDiZhi"];}else{$ZD_XianZhuDiZhi='';};       //现住地址
            if( isset($_POST["QQ"]) ){$QQ=$_POST["QQ"];}else{$QQ='';};       //QQ
            if( isset($_POST["SYS_Email"]) ){$SYS_Email=$_POST["SYS_Email"];}else{$SYS_Email='';};       //邮箱
            if( isset($_POST["SYS_StartDate"]) ){$SYS_StartDate=$_POST["SYS_StartDate"];}else{$SYS_StartDate='';};       //入职时间
            if( isset($_POST["SYS_EndDate"]) ){$SYS_EndDate=$_POST["SYS_EndDate"];}else{$SYS_EndDate='';};       //离职时间
            if( isset($_POST["zzzt"]) ){$zzzt=$_POST["zzzt"];}else{$zzzt='';};       //在职状态
            if( isset($_POST["ZD_HunYinZhuangTai"]) ){$ZD_HunYinZhuangTai=$_POST["ZD_HunYinZhuangTai"];}else{$ZD_HunYinZhuangTai='';};       //婚姻状态
            if( isset($_POST["sys_gx_id_204"]) ){$sys_gx_id_204=$_POST["sys_gx_id_204"];}else{$sys_gx_id_204='';};       //关系字段:sys_gx_id_204

		$nowdata = date( 'Y-m-d H:i:s' );       //当前时间
		
		//--------------------------------------以下为得交数据
		$sql = "insert into  `sys_yuangongdanganbiao`  (SYS_UserName,XingBie,SYS_GongHao,SYS_QuanXian,SYS_ShouJi,GongZi,ZD_GongZiFaFangZhangHu,SYS_ShenFenZheng,ZD_XianZhuDiZhi,QQ,SYS_Email,SYS_StartDate,SYS_EndDate,zzzt,ZD_HunYinZhuangTai,sys_nowbh,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate) values ('$SYS_UserName','$XingBie','$SYS_GongHao','$SYS_QuanXian','$SYS_ShouJi','$GongZi','$ZD_GongZiFaFangZhangHu','$SYS_ShenFenZheng','$ZD_XianZhuDiZhi','$QQ','$SYS_Email','$SYS_StartDate','$SYS_EndDate','$zzzt','$ZD_HunYinZhuangTai','$nowbh','$bh_y','$r_zt','$r_zt_bianhao','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdata')";
		mysqli_query( $Conn,$sql );
		echo "<script>sys_count('204','204','$sys_gx_id_204');</script>";
        $nowid = mysqli_insert_id($Conn);
        //--------------------------------------以下为操作记录提交
        $sys_editcontent='首次建档;';
        if($sys_editcontent!=''){
            $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	        $sys_postvalue_list = "'204','$nowid','$sys_editcontent'";		
	        Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	        LiYi_Add(204,$nowid,534,'+');       //利益函数 这里奖励货币
        }

		echo "$nowid";
		}
		mysqli_close( $Conn ); //关闭数据库
		
?>