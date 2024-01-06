<?php
header( 'Content-type: text/html; charset=utf8' ); //设定本页编码
include_once '../../session.php';
include_once 'M_quanxian.php';
include_once '../../inc/Function_All.php';
include_once '../../inc/B_Config.php';//执行接收参数及配置
include_once '../../inc/B_conn.php';
include_once '../../inc/B_connadmin.php';
include_once '../../inc/cache_write.php';/*自动缓存*/
$databiao=Find_tablename( $re_id );   //得到表名
$Conn=ChangeConn($databiao);//选择数据库

//接收参数开始

if ( $act == 'list' ) {
	lists();
}

function lists() {
	    $Htmlcache=$Htmlcache_sql= '' ;
	    global $Conn,  $databiao, $strmk_id, $bitian_Arry, $const_q_xiug, $re_id, $const_q_cak, $xt_m_ziduan, $xt_m_ziduan_Name, $ToHtmlID; //得到全局变量
	    $IsConn=IsConn($databiao);            //查出所属表的数据库
	    $Htmlcache.='<?php
		header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
		include_once "{$_SERVER[\'PATH_TRANSLATED\']}/session.php";
		$cache_file="../../M_quanxian/M_quanxian_$SYS_QuanXian.php";
		if( file_exists( $cache_file ) ){//文件存在时
		    include_once ($cache_file);
		}else{
		    echo "<script>UpdatePhp_Zw($SYS_QuanXian);</script>";
		}
	
		include_once "{$_SERVER[\'PATH_TRANSLATED\']}/inc/B_'.$IsConn.'.php";
		global $strmk_id,$'.$IsConn.',$const_q_xiug;
		
		';


	    $rs = $sql = $row = $firstinputname = $nowUboundarry = $qx_wuchongfu = $TianJia_POST_Arry = $Wuchongfu_Arry = $zd_Default = $wuchongfu_html = $bitian_Arry = '';
        $Tablecol_list=Tablecol_list( $databiao );//得到表的字段清单
		//echo $Tablecol_list;
	    $sql = "SHOW FULL COLUMNS FROM `$databiao` ";
	    //echo $sql;
	
	    $rs = mysqli_query( $Conn,$sql );
	    $countcords=mysqli_num_rows($rs);
		//echo $countcords;
	    //exit();
	    $Htmlcache.="\n";
	    $Htmlcache.='if ( $const_q_xiug >= 0 ) { //有修改权限时'. "\n";
	    $Htmlcache_sql.='    $sql = "UPDATE  `'.$databiao.'`  set '."\n"; //更新SQL';

	    if ( '1' . $databiao == '1') {
	        $Htmlcache= "echo '未设定表';\n" ;
	    } elseif ( $countcords == 0 ) {
	        $Htmlcache= "还没有设定允许修改字段，请联系上级设定好。" ;
	    } else {
		//echo ($re_id);

		//==============================================以下为获取显示区域
        
		$i = 0;	
		//$data = array();
		while ( $row = mysqli_fetch_array( $rs ) ) {
			//echo $row['id'];
			$i++;
			$zd_en_name = $row[ 'Field' ]; //字段
			$zdbeizhu = $row[ 'Comment' ]; //备注
			$NEW_zdbeizhu=colbeizhu($zdbeizhu,$zd_en_name);
			//0【字段中文名称】,1【显示宽度】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】
			if (getN( $Tablecol_list, $zd_en_name ) >= 0){//如果查得到该字段时
			   $zd_cn_name=textN( $NEW_zdbeizhu, 0, ',' );                                                        //中文字段名
			   $zd_xianshi_input_id = textN( $NEW_zdbeizhu, 4, ',' );                                             //显示类型
			   $zd_xianshi_is = textN( $NEW_zdbeizhu, 8, ',' );                                                   //8允许修改的 
			   if($zd_xianshi_is==1){
			       $getN_XTZD = getN( $xt_m_ziduan, strtolower( $zd_en_name ) );                                  //当>=0为系统字段时
                   if ( $getN_XTZD >= 0 ) {
		               $zd_cn_name = textN( $xt_m_ziduan_Name, $getN_XTZD, ',');                                  //显示字段系统名称					
	               };
			       $zd_cn_name=SysChangeName($zd_cn_name,$databiao);                                              //变更系统设定名
			       $Htmlcache.='    $'.$zd_en_name.'=$_POST["'.$zd_en_name.'"];       //'.$zd_cn_name."\n";
			     
				   $Htmlcache_sql.='`'.$zd_en_name.'`=\''.'$'.$zd_en_name.'\',';
			    }
			}
		}
		$Htmlcache_sql=trim($Htmlcache_sql,',');
			//echo $Htmlcache_sql;
	    $Htmlcache=$Htmlcache."\n".$Htmlcache_sql;
		$Htmlcache.=' where `id`=\'$strmk_id\'";'."\n";
        $Htmlcache.='    mysqli_query( $'.$IsConn.',$sql );'."\n";
		mysqli_free_result( $rs ); //释放内存
        $Htmlcache.='}'. "\n";	
        $Htmlcache.='mysqli_close( $'.$IsConn.' ); //关闭数据库'."\n\n";	
        $Htmlcache.='?>';
	
	}
	
	$current_file=str_replace("_chache.php","",basename(__FILE__));       //得到当前文件 除”_chache.php“的文件名称
	write_cache('1',$Htmlcache,$current_file);                 //生成模版
}


mysqli_close($Conn);//关闭数据库
//http://localhost/MachineV1.0/B_moban_edit_data_chache.php?act=list&page=1&zu=0&keyword=&re_id=321&zd=0&px_name=id&pxv=Desc&pok=1&bh=9001&hy=9007&scroll_left=0
?>