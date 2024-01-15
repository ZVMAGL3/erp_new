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
		include_once "{$_SERVER['PATH_TRANSLATED']}/inc/B_Connadmin.php";
        global $strmk_id,$Connadmin,$const_q_tianj;
		if ( $const_q_tianj >= 0 ) { //有修改权限时
		
		//--------------------------------------以下为查询到表的信息
	    $sql = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where sys_yfzuid='$hy' and mdb_name_SYS='msc_user_reg' ";
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
	    $sql = "select MAX(sys_bh) AS sys_bh From `msc_user_reg` where sys_yfzuid='$hy' and sys_zt='$r_zt' and sys_zt_bianhao='$r_zt_bianhao' ";
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
	    
            if( isset($_POST["SYS_GongHao"]) ){$SYS_GongHao=$_POST["SYS_GongHao"];}else{$SYS_GongHao='';};       //工号
            if( isset($_POST["SYS_reg_num"]) ){$SYS_reg_num=$_POST["SYS_reg_num"];}else{$SYS_reg_num='';};       //公司注册号id
            if( isset($_POST["SYS_UserName"]) ){$SYS_UserName=$_POST["SYS_UserName"];}else{$SYS_UserName='';};       //用户名
            if( isset($_POST["SYS_ShouJi"]) ){$SYS_ShouJi=$_POST["SYS_ShouJi"];}else{$SYS_ShouJi='';};       //手机
            if( isset($_POST["SYS_yuangongdanganbiao_id"]) ){$SYS_yuangongdanganbiao_id=$_POST["SYS_yuangongdanganbiao_id"];}else{$SYS_yuangongdanganbiao_id='';};       //对应的会员id
            if( isset($_POST["SYS_PassWord"]) ){$SYS_PassWord=$_POST["SYS_PassWord"];}else{$SYS_PassWord='';};       //密码
            if( isset($_POST["SYS_ShenFenZheng"]) ){$SYS_ShenFenZheng=$_POST["SYS_ShenFenZheng"];}else{$SYS_ShenFenZheng='';};       //身份证
            if( isset($_POST["SYS_Company_id"]) ){$SYS_Company_id=$_POST["SYS_Company_id"];}else{$SYS_Company_id='';};       //所属公司ID
            if( isset($_POST["SYS_ZD_QQ"]) ){$SYS_ZD_QQ=$_POST["SYS_ZD_QQ"];}else{$SYS_ZD_QQ='';};       //QQ
            if( isset($_POST["SYS_Email"]) ){$SYS_Email=$_POST["SYS_Email"];}else{$SYS_Email='';};       //邮件
            if( isset($_POST["SYS_ZD_ZaiZhiZhuangTai"]) ){$SYS_ZD_ZaiZhiZhuangTai=$_POST["SYS_ZD_ZaiZhiZhuangTai"];}else{$SYS_ZD_ZaiZhiZhuangTai='';};       //在职状态
            if( isset($_POST["SYS_QuanXian"]) ){$SYS_QuanXian=$_POST["SYS_QuanXian"];}else{$SYS_QuanXian='';};       //权限{职位}
            if( isset($_POST["SYS_XingBie"]) ){$SYS_XingBie=$_POST["SYS_XingBie"];}else{$SYS_XingBie='';};       //性别
            if( isset($_POST["SYS_DianHua"]) ){$SYS_DianHua=$_POST["SYS_DianHua"];}else{$SYS_DianHua='';};       //电话
            if( isset($_POST["SYS_YinXingKaHao"]) ){$SYS_YinXingKaHao=$_POST["SYS_YinXingKaHao"];}else{$SYS_YinXingKaHao='';};       //银行卡号
            if( isset($_POST["SYS_DiZhi"]) ){$SYS_DiZhi=$_POST["SYS_DiZhi"];}else{$SYS_DiZhi='';};       //地址
            if( isset($_POST["SYS_GongZi"]) ){$SYS_GongZi=$_POST["SYS_GongZi"];}else{$SYS_GongZi='';};       //工资
            if( isset($_POST["SYS_StartDate"]) ){$SYS_StartDate=$_POST["SYS_StartDate"];}else{$SYS_StartDate='';};       //入职时间
            if( isset($_POST["SYS_EndDate"]) ){$SYS_EndDate=$_POST["SYS_EndDate"];}else{$SYS_EndDate='';};       //离职时间
            if( isset($_POST["SYS_jib"]) ){$SYS_jib=$_POST["SYS_jib"];}else{$SYS_jib='';};       //级别
            if( isset($_POST["SYS_photo"]) ){$SYS_photo=$_POST["SYS_photo"];}else{$SYS_photo='';};       //头像
            if( isset($_POST["SYS_chaoguan"]) ){$SYS_chaoguan=$_POST["SYS_chaoguan"];}else{$SYS_chaoguan='';};       //超管
            if( isset($_POST["SYS_qianmin"]) ){$SYS_qianmin=$_POST["SYS_qianmin"];}else{$SYS_qianmin='';};       //个性签名

		$nowdata = date( 'Y-m-d H:i:s' );       //当前时间
		
		//--------------------------------------以下为得交数据
		$sql = "insert into  `msc_user_reg`  (SYS_GongHao,SYS_reg_num,SYS_UserName,SYS_ShouJi,SYS_yuangongdanganbiao_id,SYS_PassWord,SYS_ShenFenZheng,SYS_Company_id,SYS_ZD_QQ,SYS_Email,SYS_ZD_ZaiZhiZhuangTai,SYS_QuanXian,SYS_XingBie,SYS_DianHua,SYS_YinXingKaHao,SYS_DiZhi,SYS_GongZi,SYS_StartDate,SYS_EndDate,SYS_jib,SYS_photo,SYS_chaoguan,SYS_qianmin,sys_nowbh,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate) values ('$SYS_GongHao','$SYS_reg_num','$SYS_UserName','$SYS_ShouJi','$SYS_yuangongdanganbiao_id','$SYS_PassWord','$SYS_ShenFenZheng','$SYS_Company_id','$SYS_ZD_QQ','$SYS_Email','$SYS_ZD_ZaiZhiZhuangTai','$SYS_QuanXian','$SYS_XingBie','$SYS_DianHua','$SYS_YinXingKaHao','$SYS_DiZhi','$SYS_GongZi','$SYS_StartDate','$SYS_EndDate','$SYS_jib','$SYS_photo','$SYS_chaoguan','$SYS_qianmin','$nowbh','$bh_y','$r_zt','$r_zt_bianhao','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdata')";
		mysqli_query( $Connadmin,$sql );
		echo "<script></script>";
        $nowid = mysqli_insert_id($Connadmin);
        //--------------------------------------以下为操作记录提交
        $sys_editcontent='首次建档;';
        if($sys_editcontent!=''){
            $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	        $sys_postvalue_list = "'256','$nowid','$sys_editcontent'";		
	        Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	        LiYi_Add(256,$nowid,534,'+');       //利益函数 这里奖励货币
        }

		echo "$nowid";
		}
		mysqli_close( $Connadmin ); //关闭数据库
		
?>