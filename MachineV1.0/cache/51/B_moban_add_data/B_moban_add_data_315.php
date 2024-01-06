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
	    $sql = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where sys_yfzuid='$hy' and mdb_name_SYS='SQP_JianLiZhongXin' ";
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
	    $sql = "select MAX(sys_bh) AS sys_bh From `SQP_JianLiZhongXin` where sys_yfzuid='$hy' and sys_zt='$r_zt' and sys_zt_bianhao='$r_zt_bianhao' ";
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
	    
            if( isset($_POST["ZD_XingBie"]) ){$ZD_XingBie=$_POST["ZD_XingBie"];}else{$ZD_XingBie='';};       //性别
            if( isset($_POST["ZD_JiGuan"]) ){$ZD_JiGuan=$_POST["ZD_JiGuan"];}else{$ZD_JiGuan='';};       //籍贯
            if( isset($_POST["ZD_MinZu"]) ){$ZD_MinZu=$_POST["ZD_MinZu"];}else{$ZD_MinZu='';};       //民族
            if( isset($_POST["ZD_ShenQingRiQi"]) ){$ZD_ShenQingRiQi=$_POST["ZD_ShenQingRiQi"];}else{$ZD_ShenQingRiQi='';};       //申请日期
            if( isset($_POST["ZD_ShenQingGangWei"]) ){$ZD_ShenQingGangWei=$_POST["ZD_ShenQingGangWei"];}else{$ZD_ShenQingGangWei='';};       //申请岗位
            if( isset($_POST["ZD_QiWangXinZi"]) ){$ZD_QiWangXinZi=$_POST["ZD_QiWangXinZi"];}else{$ZD_QiWangXinZi='';};       //期望薪资
            if( isset($_POST["ZD_XueLi"]) ){$ZD_XueLi=$_POST["ZD_XueLi"];}else{$ZD_XueLi='';};       //学历
            if( isset($_POST["ZD_XingMing"]) ){$ZD_XingMing=$_POST["ZD_XingMing"];}else{$ZD_XingMing='';};       //姓名
            if( isset($_POST["ZD_HunYin"]) ){$ZD_HunYin=$_POST["ZD_HunYin"];}else{$ZD_HunYin='';};       //婚姻
            if( isset($_POST["ZD_ShenGao"]) ){$ZD_ShenGao=$_POST["ZD_ShenGao"];}else{$ZD_ShenGao='';};       //身高
            if( isset($_POST["ZD_TiZhong"]) ){$ZD_TiZhong=$_POST["ZD_TiZhong"];}else{$ZD_TiZhong='';};       //体重
            if( isset($_POST["ZD_WaiYuDengJi"]) ){$ZD_WaiYuDengJi=$_POST["ZD_WaiYuDengJi"];}else{$ZD_WaiYuDengJi='';};       //外语等级
            if( isset($_POST["ZD_XingQuAiHao"]) ){$ZD_XingQuAiHao=$_POST["ZD_XingQuAiHao"];}else{$ZD_XingQuAiHao='';};       //兴趣爱好
            if( isset($_POST["ZD_ShenFenZhengDiZhi"]) ){$ZD_ShenFenZhengDiZhi=$_POST["ZD_ShenFenZhengDiZhi"];}else{$ZD_ShenFenZhengDiZhi='';};       //身份证地址
            if( isset($_POST["ZD_XianZhuDiZhi"]) ){$ZD_XianZhuDiZhi=$_POST["ZD_XianZhuDiZhi"];}else{$ZD_XianZhuDiZhi='';};       //现住地址
            if( isset($_POST["ZD_ShenFenZhengHaoMa"]) ){$ZD_ShenFenZhengHaoMa=$_POST["ZD_ShenFenZhengHaoMa"];}else{$ZD_ShenFenZhengHaoMa='';};       //身份证号码
            if( isset($_POST["ZD_LianXiDianHua"]) ){$ZD_LianXiDianHua=$_POST["ZD_LianXiDianHua"];}else{$ZD_LianXiDianHua='';};       //联系电话
            if( isset($_POST["ZD_JinJiLianXiRenDianHua"]) ){$ZD_JinJiLianXiRenDianHua=$_POST["ZD_JinJiLianXiRenDianHua"];}else{$ZD_JinJiLianXiRenDianHua='';};       //紧急联系人/电话
            if( isset($_POST["ZD_XueXiJingLi"]) ){$ZD_XueXiJingLi=$_POST["ZD_XueXiJingLi"];}else{$ZD_XueXiJingLi='';};       //学习经历
            if( isset($_POST["ZD_ZhuYaoGongZuoJingLi"]) ){$ZD_ZhuYaoGongZuoJingLi=$_POST["ZD_ZhuYaoGongZuoJingLi"];}else{$ZD_ZhuYaoGongZuoJingLi='';};       //主要工作经历
            if( isset($_POST["ZD_JiaTingQingKuang"]) ){$ZD_JiaTingQingKuang=$_POST["ZD_JiaTingQingKuang"];}else{$ZD_JiaTingQingKuang='';};       //家庭情况
            if( isset($_POST["ZD_ZiWoPingJia"]) ){$ZD_ZiWoPingJia=$_POST["ZD_ZiWoPingJia"];}else{$ZD_ZiWoPingJia='';};       //自我评价
            if( isset($_POST["ZD_BeiZhu"]) ){$ZD_BeiZhu=$_POST["ZD_BeiZhu"];}else{$ZD_BeiZhu='';};       //备注
            if( isset($_POST["sys_gx_id_198"]) ){$sys_gx_id_198=$_POST["sys_gx_id_198"];}else{$sys_gx_id_198='';};       //[关系]质量记录归档登记表ID

		$nowdata = date( 'Y-m-d H:i:s' );       //当前时间
		
		//--------------------------------------以下为得交数据
		$sql = "insert into  `SQP_JianLiZhongXin`  (ZD_XingBie,ZD_JiGuan,ZD_MinZu,ZD_ShenQingRiQi,ZD_ShenQingGangWei,ZD_QiWangXinZi,ZD_XueLi,ZD_XingMing,ZD_HunYin,ZD_ShenGao,ZD_TiZhong,ZD_WaiYuDengJi,ZD_XingQuAiHao,ZD_ShenFenZhengDiZhi,ZD_XianZhuDiZhi,ZD_ShenFenZhengHaoMa,ZD_LianXiDianHua,ZD_JinJiLianXiRenDianHua,ZD_XueXiJingLi,ZD_ZhuYaoGongZuoJingLi,ZD_JiaTingQingKuang,ZD_ZiWoPingJia,ZD_BeiZhu,sys_gx_id_198,sys_nowbh,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate) values ('$ZD_XingBie','$ZD_JiGuan','$ZD_MinZu','$ZD_ShenQingRiQi','$ZD_ShenQingGangWei','$ZD_QiWangXinZi','$ZD_XueLi','$ZD_XingMing','$ZD_HunYin','$ZD_ShenGao','$ZD_TiZhong','$ZD_WaiYuDengJi','$ZD_XingQuAiHao','$ZD_ShenFenZhengDiZhi','$ZD_XianZhuDiZhi','$ZD_ShenFenZhengHaoMa','$ZD_LianXiDianHua','$ZD_JinJiLianXiRenDianHua','$ZD_XueXiJingLi','$ZD_ZhuYaoGongZuoJingLi','$ZD_JiaTingQingKuang','$ZD_ZiWoPingJia','$ZD_BeiZhu','$sys_gx_id_198','$nowbh','$bh_y','$r_zt','$r_zt_bianhao','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdata')";
		mysqli_query( $Conn,$sql );
		echo "<script>sys_count('198','315','$sys_gx_id_198');</script>";
		//--------------------------------------以下为查询数据
		$sql = "select id From `SQP_JianLiZhongXin` where   ZD_XingBie='$ZD_XingBie' and ZD_JiGuan='$ZD_JiGuan' and ZD_MinZu='$ZD_MinZu' and ZD_ShenQingRiQi='$ZD_ShenQingRiQi' and ZD_ShenQingGangWei='$ZD_ShenQingGangWei' and ZD_QiWangXinZi='$ZD_QiWangXinZi' and ZD_XueLi='$ZD_XueLi' and ZD_XingMing='$ZD_XingMing' and ZD_HunYin='$ZD_HunYin' and ZD_ShenGao='$ZD_ShenGao' and ZD_TiZhong='$ZD_TiZhong' and ZD_WaiYuDengJi='$ZD_WaiYuDengJi' and ZD_XingQuAiHao='$ZD_XingQuAiHao' and ZD_ShenFenZhengDiZhi='$ZD_ShenFenZhengDiZhi' and ZD_XianZhuDiZhi='$ZD_XianZhuDiZhi' and ZD_ShenFenZhengHaoMa='$ZD_ShenFenZhengHaoMa' and ZD_LianXiDianHua='$ZD_LianXiDianHua' and ZD_JinJiLianXiRenDianHua='$ZD_JinJiLianXiRenDianHua' and ZD_XueXiJingLi='$ZD_XueXiJingLi' and ZD_ZhuYaoGongZuoJingLi='$ZD_ZhuYaoGongZuoJingLi' and ZD_JiaTingQingKuang='$ZD_JiaTingQingKuang' and ZD_ZiWoPingJia='$ZD_ZiWoPingJia' and ZD_BeiZhu='$ZD_BeiZhu' and sys_gx_id_198='$sys_gx_id_198'   order by `id` desc";
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
	        $sys_postvalue_list = "'315','$nowid','$sys_editcontent'";		
	        Jilu_add_Modular( 'sys_xiuguaijilu', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	        LiYi_Add(315,$nowid,534,'+');       //利益函数 这里奖励货币
        }

		echo "$nowid";
		}
		mysqli_close( $Conn ); //关闭数据库
		
?>