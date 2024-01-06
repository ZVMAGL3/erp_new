<?php
//header( 'Content-type: text/html; charset=utf-8' ); //设定本页编码
include_once '../../session.php';
include_once( 'M_quanxian.php' );                      //接收职位权限信息
include_once '../../inc/Function_All.php';
include_once '../../inc/B_Config.php';//执行接收参数及配置
include_once '../../inc/B_conn.php';
include_once '../../inc/B_connadmin.php';


//include 'inc/Sub_All.php' ;

$scroll_left = '';
$scroll_left = $_REQUEST[ 'scroll_left' ]; //得到滚动条位置

//==================================================================================================以下为获得参数据
if ( $re_id <> 0 ) {
	$rs = $sql = $databiao1 = $databiao_SYS1 = $mdb_use_type = $databiao_SYS = $xianshi_KD_num=$xianshi_KD_num='';
	$sql = 'select mdb_name_SYS From Sys_jlmb where id=' . $re_id;
	$rs = mysqli_query(  $Conn , $sql );
	$row = mysqli_fetch_array( $rs );
	$databiao = htmlspecialchars(trim($row['mdb_name_SYS']));//原数据表名

	$Conn=ChangeConn($databiao);
	$xianshi_KD_num = count_col_num( $databiao, 5 ); //查询到宽度和
	//echo $xianshi_KD_num;

	$shuoding_num = Uboundarryy( Tablecol_list_beizhu_cols( $databiao, 6 ), ',' );//查询锁定例清单后进行统计个数
	if ( $shuoding_num == 0 )$shuoding_num = 1; //默认锁定第一列
	mysqli_free_result( $rs ); //释放内存
	//echo $shuoding_num;
};

if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );}else{$sys_guanxibiao_id = '';};         //关系表re_id
    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ){$GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );}else{$GuanXi_id = "";	};//关系列id
    if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ){$ToHtmlID = $_REQUEST[ 'ToHtmlID' ];};                                                                              //j显示页面
	if ( isset( $_REQUEST[ 'huis' ] ) ){$huis = intval( $_REQUEST[ 'huis' ] );}else{$huis = 0;};                                                              //是否为回收站0为不回收
    //if ( $huis == 1){$ToHtmlID='HUIS_'.$ToHtmlID;};                                                                                                           //是否为回收站0为不回收

if ( $act == 'left' ) {
	//toplist_left();//加载表头锁定列时
} elseif ( $act == 'list' ) {
	toplist(); //加载表头
} else {
	echo NoZhiLing();
};

//==================================================================================================表头
function toplist() { //表头
	$Htmlcache= '' ;
	global $Conn,$hy, $re_id, $databiao, $databiao_SYS1,$const_q_shanc, $databiao_SYS, $xianshi_KD_num, $shuoding_num, $databiao1, $ToHtmlID, $scroll_left, $scroll_left, $const_q_cak, $xt_m_ziduan, $xt_m_ziduan_Name,$SYS_UserName;

	$II = $ES_xianshi = $S_xianshi = $datezd = $c_kuandu = $colls = $classss = $getN_XTZD = $getN_XTZD_Name = '';

	$xianshi_KD_num = $xianshi_KD_num + 650;
	//echo $xianshi_KD_num;
	//exit;
	$wjbh=wjbh();//得到文件编号
	$Htmlcache.= "$wjbh<div  id='theObjTable' name='headall' class='tables' style='border:0;padding:0;margin:0;min-width:100%;width:25px;width:" . $xianshi_KD_num . "px'  onselectstart=self.event.returnValue=false>" ;
	$Htmlcache.= "<ul class='thead' style='min-width:100%;width:" . $xianshi_KD_num . "px'>" ;
	$Htmlcache.= "<li class='cols1 shuodingli wjbhparnt'></li>" ;
	//if ( $const_q_cak < 0 ) { //这个是当没有权限时执行
		//echo "<li style='width:100px;'>您没有该表查看权限</li>";
	//} else
	if ( '1' . $databiao_SYS1 == '1' ) { //没有初始化时
		$Htmlcache.= "<li style='width:100px;'>该表没有源表，请初始化</li>";
	} else {
		//非锁定列
		$sql = "SHOW FULL COLUMNS FROM `$databiao`";
		//echo $sql.'_'; 
		$rs = mysqli_query( $Conn , $sql );
		$xianshi_ZD_num = mysqli_num_rows( $rs ); //总数
		//echo $xianshi_ZD_num.'_'; 

		$i = 0;
		if ( $xianshi_ZD_num == 0 ) {
			$Htmlcache.= "<li class='shuodingli border_shuoding' style='width:350px'>请设定好显示的列后再试...</li>" ; //没有设定列时
		} else {
			while ( $row = mysqli_fetch_array( $rs ) ) {
				$i++;
				$zd_en_name = $row[ 'Field' ]; //字段
				$zdbeizhu = $row[ 'Comment' ]; //备注
				$NEW_zdbeizhu=colbeizhu($zdbeizhu,$zd_en_name);
				//0【字段中文名称】,1【显示宽度】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】
				$zd_cn_name=textN( $NEW_zdbeizhu, 0, ',' );             //中文字段名
				 $zd_xianshi_is = textN( $NEW_zdbeizhu, 5, ',' );         //1为显示
			 if($zd_xianshi_is==1){
				$zd_xianshi_width = textN( $NEW_zdbeizhu, 1, ',' );     //字段显示宽度

				
				if ( $zd_xianshi_width <= 20 ) {
					$zd_xianshi_width = 20;
				}; //设定最少宽度
				$getN_XTZD = getN( $xt_m_ziduan, strtolower( $zd_en_name ) ); //当>=0为系统字段时
				if ( $getN_XTZD >= 0 ) {
					$zd_cn_name = textN( $xt_m_ziduan_Name, $getN_XTZD, ',' ); //显示字段系统名称					
				};
				$zd_cn_name = SysChangeName( $zd_cn_name, $databiao ); //变更系统设定名
				//$colls='coll'.'_'.$re_id.'_'.$III+1;
				if ( $i < $shuoding_num ) {
					$classss = "shuodingli";
				} elseif ( $i == $shuoding_num ) { //锁定列
					$classss = "shuodingli border_shuoding";
				} elseif ( $i == $xianshi_ZD_num ) { //结束列
					$classss = "endli";
				} else { //常规列
					$classss = "contentli libottom_line"; //内容列样式
				};
				$Htmlcache.= "<li class='$classss' name='$zd_en_name' style='width:" . $zd_xianshi_width . "px'>$zd_cn_name</li>";
			 }
		  };
			mysqli_free_result( $rs ); //释放内存
		};


	};
	$Htmlcache.= '</ul></div>' ;
	//$Htmlcache.= "<script>copy('#theObjTable','#banner_left','.shuodingli','$ToHtmlID');$('#".$ToHtmlID." #const_now_login').val('$SYS_UserName');</script>"; //这里为拷贝生成滚动条
	

	
	if ( $databiao . '1' != '1'
		and $const_q_shanc >= 0 ) { //没有权限时
		//$Htmlcache.= "<script>$('#" . $ToHtmlID . " #chkall').attr({'disabled':false,'title':''});</script>";
	};
	
	echo $Htmlcache;
	//find_cache('1',$Htmlcache);
};



mysqli_close($Conn);//关闭数据库
//mysqli_close($Connadmin);//关闭云数据库

?>