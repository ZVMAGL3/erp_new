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
	    $sql = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where sys_yfzuid='$hy' and mdb_name_SYS='SQP_JianCeHeCeLiangZiYuanTaiZhang' ";
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
	    $sql = "select MAX(sys_bh) AS sys_bh From `SQP_JianCeHeCeLiangZiYuanTaiZhang` where sys_yfzuid='$hy' and sys_zt='$r_zt' and sys_zt_bianhao='$r_zt_bianhao' ";
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
	    
            if( isset($_POST["MingChen"]) ){$MingChen=$_POST["MingChen"];}else{$MingChen='';};       //名称
            if( isset($_POST["GuiGe"]) ){$GuiGe=$_POST["GuiGe"];}else{$GuiGe='';};       //规格
            if( isset($_POST["ZhiZaoChangShang"]) ){$ZhiZaoChangShang=$_POST["ZhiZaoChangShang"];}else{$ZhiZaoChangShang='';};       //制造厂商
            if( isset($_POST["ChuChangBianHao"]) ){$ChuChangBianHao=$_POST["ChuChangBianHao"];}else{$ChuChangBianHao='';};       //出厂编号
            if( isset($_POST["ShiYongRiQi"]) ){$ShiYongRiQi=$_POST["ShiYongRiQi"];}else{$ShiYongRiQi='';};       //始用日期
            if( isset($_POST["ShiYongBuMen"]) ){$ShiYongBuMen=$_POST["ShiYongBuMen"];}else{$ShiYongBuMen='';};       //使用部门
            if( isset($_POST["GuanLiZeRenRen"]) ){$GuanLiZeRenRen=$_POST["GuanLiZeRenRen"];}else{$GuanLiZeRenRen='';};       //管理责任人
            if( isset($_POST["BaoFeiRiQi"]) ){$BaoFeiRiQi=$_POST["BaoFeiRiQi"];}else{$BaoFeiRiQi='';};       //报废日期

		$nowdata = date( 'Y-m-d H:i:s' );       //当前时间
		
		//--------------------------------------以下为得交数据
		$sql = "insert into  `SQP_JianCeHeCeLiangZiYuanTaiZhang`  (MingChen,GuiGe,ZhiZaoChangShang,ChuChangBianHao,ShiYongRiQi,ShiYongBuMen,GuanLiZeRenRen,BaoFeiRiQi,sys_nowbh,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate) values ('$MingChen','$GuiGe','$ZhiZaoChangShang','$ChuChangBianHao','$ShiYongRiQi','$ShiYongBuMen','$GuanLiZeRenRen','$BaoFeiRiQi','$nowbh','$bh_y','$r_zt','$r_zt_bianhao','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdata')";
		mysqli_query( $Conn,$sql );
		echo "<script></script>";
		//--------------------------------------以下为查询数据
		$sql = "select id From `SQP_JianCeHeCeLiangZiYuanTaiZhang` where   MingChen='$MingChen' and GuiGe='$GuiGe' and ZhiZaoChangShang='$ZhiZaoChangShang' and ChuChangBianHao='$ChuChangBianHao' and ShiYongRiQi='$ShiYongRiQi' and ShiYongBuMen='$ShiYongBuMen' and GuanLiZeRenRen='$GuanLiZeRenRen' and BaoFeiRiQi='$BaoFeiRiQi'   order by `id` desc";
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
	        $sys_postvalue_list = "'230','$nowid','$sys_editcontent'";		
	        Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	        LiYi_Add(230,$nowid,534,'+');       //利益函数 这里奖励货币
        }

		echo "$nowid";
		}
		mysqli_close( $Conn ); //关闭数据库
		
?>