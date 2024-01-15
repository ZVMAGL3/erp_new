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
	    $sql = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where sys_yfzuid='$hy' and mdb_name_SYS='msc_RenZhengMoBan' ";
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
	    $sql = "select MAX(sys_bh) AS sys_bh From `msc_RenZhengMoBan` where sys_yfzuid='$hy' and sys_zt='$r_zt' and sys_zt_bianhao='$r_zt_bianhao' ";
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
	    
            if( isset($_POST["sys_title"]) ){$sys_title=$_POST["sys_title"];}else{$sys_title='';};       //模版名
            if( isset($_POST["sys_hangye"]) ){$sys_hangye=$_POST["sys_hangye"];}else{$sys_hangye='';};       //所属行业
            if( isset($_POST["sys_name"]) ){$sys_name=$_POST["sys_name"];}else{$sys_name='';};       //替换为
            if( isset($_POST["sys_file"]) ){$sys_file=$_POST["sys_file"];}else{$sys_file='';};       //文件清单
            if( isset($_POST["sys_beizhu"]) ){$sys_beizhu=$_POST["sys_beizhu"];}else{$sys_beizhu='';};       //说明
            if( isset($_POST["sys_Id_MenuBigClass"]) ){$sys_Id_MenuBigClass=$_POST["sys_Id_MenuBigClass"];}else{$sys_Id_MenuBigClass='';};       //所属标准
            if( isset($_POST["sys_id_zu"]) ){$sys_id_zu=$_POST["sys_id_zu"];}else{$sys_id_zu='';};       //分类

		$nowdata = date( 'Y-m-d H:i:s' );       //当前时间
		
		//--------------------------------------以下为得交数据
		$sql = "insert into  `msc_RenZhengMoBan`  (sys_title,sys_hangye,sys_name,sys_file,sys_beizhu,sys_Id_MenuBigClass,sys_id_zu,sys_nowbh,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate) values ('$sys_title','$sys_hangye','$sys_name','$sys_file','$sys_beizhu','$sys_Id_MenuBigClass','$sys_id_zu','$nowbh','$bh_y','$r_zt','$r_zt_bianhao','0','$bh','$SYS_UserName','$hy','$const_id_fz','$bumen_id','$nowdata')";
		mysqli_query( $Connadmin,$sql );
		echo "<script></script>";
		//--------------------------------------以下为查询数据
		$sql = "select id From `msc_RenZhengMoBan` where   sys_title='$sys_title' and sys_hangye='$sys_hangye' and sys_name='$sys_name' and sys_file='$sys_file' and sys_beizhu='$sys_beizhu' and sys_Id_MenuBigClass='$sys_Id_MenuBigClass' and sys_id_zu='$sys_id_zu'   order by `id` desc";
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
	        $sys_postvalue_list = "'517','$nowid','$sys_editcontent'";		
	        Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	        LiYi_Add(517,$nowid,534,'+');       //利益函数 这里奖励货币
        }

		echo "$nowid";
		}
		mysqli_close( $Connadmin ); //关闭数据库
		
?>