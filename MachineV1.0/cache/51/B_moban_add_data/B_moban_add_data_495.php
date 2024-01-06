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
	    $sql = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where sys_yfzuid='$hy' and mdb_name_SYS='SQP_FuWuLiuChengDan' ";
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
	    $sql = "select MAX(sys_bh) AS sys_bh From `SQP_FuWuLiuChengDan` where sys_yfzuid='$hy' and sys_zt='$r_zt' and sys_zt_bianhao='$r_zt_bianhao' ";
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
	    
            if( isset($_POST["sys_gx_id_321"]) ){$sys_gx_id_321=$_POST["sys_gx_id_321"];}else{$sys_gx_id_321='';};       //[关系]顾客档案表ID
            if( isset($_POST["ZD_GongSiMingChen"]) ){$ZD_GongSiMingChen=$_POST["ZD_GongSiMingChen"];}else{$ZD_GongSiMingChen='';};       //公司名称
            if( isset($_POST["sys_gx_id_423"]) ){$sys_gx_id_423=$_POST["sys_gx_id_423"];}else{$sys_gx_id_423='';};       //[关系]顾客合同ID
            if( isset($_POST["RenZhengXinXi"]) ){$RenZhengXinXi=$_POST["RenZhengXinXi"];}else{$RenZhengXinXi='';};       //认证信息
            if( isset($_POST["XiangMuQianShou"]) ){$XiangMuQianShou=$_POST["XiangMuQianShou"];}else{$XiangMuQianShou='';};       //项目签收
            if( isset($_POST["ZD_RuChang"]) ){$ZD_RuChang=$_POST["ZD_RuChang"];}else{$ZD_RuChang='';};       //①入厂
            if( isset($_POST["ZD_ShenQing"]) ){$ZD_ShenQing=$_POST["ZD_ShenQing"];}else{$ZD_ShenQing='';};       //②申请
            if( isset($_POST["ZD_ZiLiao"]) ){$ZD_ZiLiao=$_POST["ZD_ZiLiao"];}else{$ZD_ZiLiao='';};       //③资料
            if( isset($_POST["ZD_JiLiangJianDing"]) ){$ZD_JiLiangJianDing=$_POST["ZD_JiLiangJianDing"];}else{$ZD_JiLiangJianDing='';};       //④计量检定
            if( isset($_POST["ZD_TeZhongJianDing"]) ){$ZD_TeZhongJianDing=$_POST["ZD_TeZhongJianDing"];}else{$ZD_TeZhongJianDing='';};       //⑤特种检定
            if( isset($_POST["ZD_YanShou"]) ){$ZD_YanShou=$_POST["ZD_YanShou"];}else{$ZD_YanShou='';};       //⑥验收
            if( isset($_POST["ZD_ShenHe"]) ){$ZD_ShenHe=$_POST["ZD_ShenHe"];}else{$ZD_ShenHe='';};       //⑦审核
            if( isset($_POST["ZD_ZhengGai"]) ){$ZD_ZhengGai=$_POST["ZD_ZhengGai"];}else{$ZD_ZhengGai='';};       //⑧整改
            if( isset($_POST["ZD_JiaoJie"]) ){$ZD_JiaoJie=$_POST["ZD_JiaoJie"];}else{$ZD_JiaoJie='';};       //⑨交接
            if( isset($_POST["ZD_TiChengJieSuan"]) ){$ZD_TiChengJieSuan=$_POST["ZD_TiChengJieSuan"];}else{$ZD_TiChengJieSuan='';};       //提成结算
            if( isset($_POST["ZD_RenShuChanPin"]) ){$ZD_RenShuChanPin=$_POST["ZD_RenShuChanPin"];}else{$ZD_RenShuChanPin='';};       //人数/产品
            if( isset($_POST["LianXiRen"]) ){$LianXiRen=$_POST["LianXiRen"];}else{$LianXiRen='';};       //联系人
            if( isset($_POST["DianHua"]) ){$DianHua=$_POST["DianHua"];}else{$DianHua='';};       //电话
            if( isset($_POST["ZhiDaoXingShi"]) ){$ZhiDaoXingShi=$_POST["ZhiDaoXingShi"];}else{$ZhiDaoXingShi='';};       //指导形式
            if( isset($_POST["ZD_ShenHeYuan"]) ){$ZD_ShenHeYuan=$_POST["ZD_ShenHeYuan"];}else{$ZD_ShenHeYuan='';};       //审核员
            if( isset($_POST["ShenHeShiJian"]) ){$ShenHeShiJian=$_POST["ShenHeShiJian"];}else{$ShenHeShiJian='';};       //审核时间
            if( isset($_POST["JiaoTongJieDai"]) ){$JiaoTongJieDai=$_POST["JiaoTongJieDai"];}else{$JiaoTongJieDai='';};       //交通接待
            if( isset($_POST["ZiXunFeiYong"]) ){$ZiXunFeiYong=$_POST["ZiXunFeiYong"];}else{$ZiXunFeiYong='';};       //咨询费用
            if( isset($_POST["QiTaYaoQiu"]) ){$QiTaYaoQiu=$_POST["QiTaYaoQiu"];}else{$QiTaYaoQiu='';};       //其它要求
            if( isset($_POST["ZD_ZiLiaoFuZeRen"]) ){$ZD_ZiLiaoFuZeRen=$_POST["ZD_ZiLiaoFuZeRen"];}else{$ZD_ZiLiaoFuZeRen='';};       //①资料（负责人）
            if( isset($_POST["ZD_ZiLiaoZhuDao"]) ){$ZD_ZiLiaoZhuDao=$_POST["ZD_ZiLiaoZhuDao"];}else{$ZD_ZiLiaoZhuDao='';};       //②资料（主导）
            if( isset($_POST["ZD_JiLiangQiJu"]) ){$ZD_JiLiangQiJu=$_POST["ZD_JiLiangQiJu"];}else{$ZD_JiLiangQiJu='';};       //③计量器具
            if( isset($_POST["ZD_PeiShenYanChang"]) ){$ZD_PeiShenYanChang=$_POST["ZD_PeiShenYanChang"];}else{$ZD_PeiShenYanChang='';};       //④陪审/验厂
            if( isset($_POST["ZD_PeiXun"]) ){$ZD_PeiXun=$_POST["ZD_PeiXun"];}else{$ZD_PeiXun='';};       //⑤培训
            if( isset($_POST["ZD_HeJiTiCheng"]) ){$ZD_HeJiTiCheng=$_POST["ZD_HeJiTiCheng"];}else{$ZD_HeJiTiCheng='';};       //合计提成
            if( isset($_POST["ZD_ShenHeTianShu"]) ){$ZD_ShenHeTianShu=$_POST["ZD_ShenHeTianShu"];}else{$ZD_ShenHeTianShu='';};       //审核天数
            if( isset($_POST["ZD_JiaoQi"]) ){$ZD_JiaoQi=$_POST["ZD_JiaoQi"];}else{$ZD_JiaoQi='';};       //交期
            if( isset($_POST["sys_gx_id_510"]) ){$sys_gx_id_510=$_POST["sys_gx_id_510"];}else{$sys_gx_id_510='';};       //[关系]客户证书管理ID
            if( isset($_POST["sys_gx_id_529"]) ){$sys_gx_id_529=$_POST["sys_gx_id_529"];}else{$sys_gx_id_529='';};       //[关系]用户和公司关系ID

		$nowdata = date( 'Y-m-d H:i:s' );       //当前时间
		
		//--------------------------------------以下为得交数据
		$sql = "insert into  `SQP_FuWuLiuChengDan`  (sys_gx_id_321,ZD_GongSiMingChen,sys_gx_id_423,RenZhengXinXi,XiangMuQianShou,ZD_RuChang,ZD_ShenQing,ZD_ZiLiao,ZD_JiLiangJianDing,ZD_TeZhongJianDing,ZD_YanShou,ZD_ShenHe,ZD_ZhengGai,ZD_JiaoJie,ZD_TiChengJieSuan,ZD_RenShuChanPin,LianXiRen,DianHua,ZhiDaoXingShi,ZD_ShenHeYuan,ShenHeShiJian,JiaoTongJieDai,ZiXunFeiYong,QiTaYaoQiu,ZD_ZiLiaoFuZeRen,ZD_ZiLiaoZhuDao,ZD_JiLiangQiJu,ZD_PeiShenYanChang,ZD_PeiXun,ZD_HeJiTiCheng,ZD_ShenHeTianShu,ZD_JiaoQi,sys_nowbh,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate) values ('$sys_gx_id_321','$ZD_GongSiMingChen','$sys_gx_id_423','$RenZhengXinXi','$XiangMuQianShou','$ZD_RuChang','$ZD_ShenQing','$ZD_ZiLiao','$ZD_JiLiangJianDing','$ZD_TeZhongJianDing','$ZD_YanShou','$ZD_ShenHe','$ZD_ZhengGai','$ZD_JiaoJie','$ZD_TiChengJieSuan','$ZD_RenShuChanPin','$LianXiRen','$DianHua','$ZhiDaoXingShi','$ZD_ShenHeYuan','$ShenHeShiJian','$JiaoTongJieDai','$ZiXunFeiYong','$QiTaYaoQiu','$ZD_ZiLiaoFuZeRen','$ZD_ZiLiaoZhuDao','$ZD_JiLiangQiJu','$ZD_PeiShenYanChang','$ZD_PeiXun','$ZD_HeJiTiCheng','$ZD_ShenHeTianShu','$ZD_JiaoQi','$nowbh','$bh_y','$r_zt','$r_zt_bianhao','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdata')";
		mysqli_query( $Conn,$sql );
		echo "<script>sys_count('321','495','$sys_gx_id_321');sys_count('423','495','$sys_gx_id_423');sys_count('510','495','$sys_gx_id_510');sys_count('529','495','$sys_gx_id_529');</script>";
        $nowid = mysqli_insert_id($Conn)
        //--------------------------------------以下为操作记录提交
        $sys_editcontent='首次建档;';
        if($sys_editcontent!=''){
            $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	        $sys_postvalue_list = "'495','$nowid','$sys_editcontent'";		
	        Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	        LiYi_Add(495,$nowid,534,'+');       //利益函数 这里奖励货币
        }

		echo "$nowid";
		}
		mysqli_close( $Conn ); //关闭数据库
		
?>