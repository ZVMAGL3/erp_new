﻿<?php
header( 'Content-type: text/html; charset=utf8' ); //设定本页编码
include_once '../session.php';
include_once 'B_quanxian.php';
include_once '../inc/Function_All.php';
include_once '../inc/B_Config.php'; //执行接收参数及配置
include_once '../inc/B_conn.php';
include_once '../inc/B_connadmin.php';
include_once '../inc/cache_write.php'; /*自动缓存*/
$databiao = Find_tablename( $re_id ); //得到表名
if(!$databiao){
    echo '没有该表,联系管理员处理!';
    exit();
}
$Conn = ChangeConn( $databiao ); //选择数据库
error_reporting(E_ALL);
ini_set('display_errors', '1');
//接收参数开始
if ( $act == 'list' ) {
    lists();
}

function lists() {
    $Htmlcache = $Htmlcache_post = '';
    global $Conn, $databiao, $strmk_id, $bitian_Arry, $const_q_tianj, $re_id, $const_q_cak, $xt_m_ziduan, $xt_m_ziduan_Name, $ToHtmlID; //得到全局变量
    $IsConn = IsConn( $databiao ); //查出所属表的数据库


    $rs = $sql = $row = $firstinputname = $nowUboundarry = $qx_wuchongfu = $TianJia_POST_Arry = $Wuchongfu_Arry = $zd_Default = $wuchongfu_html = $bitian_Arry = $sys_countarry = '';
    $Tablecol_list = Tablecol_list( $databiao ); //得到表的字段清单
    //echo $Tablecol_list;
    $sql = "SHOW FULL COLUMNS FROM `$databiao` ";
    //echo $sql;
    $rs = mysqli_query( $Conn, $sql );
    $countcords = mysqli_num_rows( $rs );
    //echo $countcords;
    //exit();

    $Htmlcache .= '<?php
header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
include_once "{$_SERVER[\'PATH_TRANSLATED\']}/session.php";
include_once "{$_SERVER[\'PATH_TRANSLATED\']}/inc/Function_All.php";
include_once "{$_SERVER[\'PATH_TRANSLATED\']}/inc/Sub_All.php";
        //--------------------------------------文件存在读取，不存在时生成
		$cache_file="../B_quanxian/B_quanxian_$SYS_QuanXian.php";
		if( file_exists( $cache_file ) ){//文件存在时
		    include_once ($cache_file);
		}else{
		    echo "<script>UpdatePhp_Zw($SYS_QuanXian);</script>";
		}
		include_once "{$_SERVER[\'PATH_TRANSLATED\']}/inc/B_' . $IsConn . '.php";
        global $strmk_id,$' . $IsConn . ',$const_q_tianj;
		if ( $const_q_tianj >= 0 ) { //有修改权限时
		
		//--------------------------------------以下为查询到表的信息
	    $sql = "select sys_zt,sys_zt_bianhao From `sys_jlmb` where sys_yfzuid=\'$hy\' and mdb_name_SYS=\'' . $databiao . '\' ";
	    //echo $sql;
	    $rs = mysqli_query(  $Conn , $sql );
	    $row = mysqli_fetch_array( $rs );
	    $r_zt = $row[ \'sys_zt\' ];                             //设定的字头
	    //if($r_zt.\'1\'==\'1\'){ $r_zt=0 };
        $r_zt_bianhao = $row[ \'sys_zt_bianhao\' ];             //设定的字头编号
	    if($r_zt_bianhao.\'1\'==\'1\'){ $r_zt_bianhao=0; }; 
	    //echo $r_zt;
	    mysqli_free_result( $rs );                          //释放内存
	
	    //--------------------------------------以下为查询到自动编号
	    $sql = "select MAX(sys_bh) AS sys_bh From `' . $databiao . '` where sys_yfzuid=\'$hy\' and sys_zt=\'$r_zt\' and sys_zt_bianhao=\'$r_zt_bianhao\' ";
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
	    ' . "\n";

    if ( '1' . $databiao == '1' ) {
        $Htmlcache = "echo '未设定表';\n";
    } elseif ( $countcords == 0 ) {
        $Htmlcache = "还没有设定允许修改字段，请联系上级设定好。";
    } else {
        //echo ($re_id);

        //==============================================以下为获取显示区域

        $i = 0;
        //$data = array();
        $sys_postzd_list = '';
        $sys_postvalue_list = '';
        $where = '';
        while ( $row = mysqli_fetch_array( $rs ) ) {
            //echo $row['id'];
            $i++;
            $zd_en_name = $row[ 'Field' ]; //字段
            $zdbeizhu = $row[ 'Comment' ]; //备注
            $NEW_zdbeizhu = colbeizhu( $zdbeizhu, $zd_en_name );
            //0【字段中文名称】,1【显示宽度】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】
            if ( getN( $Tablecol_list, $zd_en_name ) >= 0 ) { //如果查得到该字段时
                $zd_cn_name = textN( $NEW_zdbeizhu, 0, ',' ); //中文字段名
                $zd_xianshi_input_id = textN( $NEW_zdbeizhu, 4, ',' ); //显示类型
                $zd_xianshi_is = textN( $NEW_zdbeizhu, 7, ',' ); //7允许修改的 
                $getN_XTZD = getN( $xt_m_ziduan, strtolower( $zd_en_name ) ); //当>=0为系统字段时
                if ( $getN_XTZD >= 0 ) {
                    $zd_cn_name = textN( $xt_m_ziduan_Name, $getN_XTZD, ',' ); //显示字段系统名称					
                };
                if ( $zd_xianshi_is == 1 || SYS_is( $zd_en_name, 'sys_gx_id_' ) == '1' ) {

                    $zd_cn_name = SysChangeName( $zd_cn_name, $databiao ); //变更系统设定名
                    //$Htmlcache.='        if ( isset( $_POST["'.$zd_en_name.'"] ) ) { '."\n";
                    $Htmlcache .= '            if( isset($_POST["' . $zd_en_name . '"]) ){$' . $zd_en_name . '=$_POST["' . $zd_en_name . '"];}else{$' . $zd_en_name . '=\'\';};       //' . $zd_cn_name . "\n";

                    if ( SYS_is( $zd_en_name, 'sys_gx_id_' ) == 1 ) {
                        $parentre_id = preg_replace( '/[^\d]*/', '', $zd_en_name ); //只取末位数字
                        $Tongji = Tongji_table_rows( 'sys_guanxibiao', "sys_re_id=$parentre_id and sys_re_id_02=$re_id and sys_huis=0" ); //统计数量
                        if ( $Tongji == 0 ) {
                            $sys_postzd_list = $sys_postzd_list; //字段名称
                            $sys_postvalue_list = $sys_postvalue_list; //接收的名字
                            $where = $where;
                        } else {
                            $sys_postzd_list .= $zd_en_name . ','; //字段名称
                            $sys_postvalue_list .= '\'$' . $zd_en_name . '\','; //接收的名字
                            $where .= ' ' . $zd_en_name . '=\'$' . $zd_en_name . '\' and';
                        }
                        //--------------------------------------------------父关系统计数据js
                        //if(SYS_is( $zd_en_name,'sys_gx_id_')=='1'){
                        $parentre_id = preg_replace( '/[^\d]*/', '', $zd_en_name ); //只取末位数字
                        $sys_countarry .= 'sys_count(\'' . $parentre_id . '\',\'' . $re_id . '\',\'$' . $zd_en_name . '\');';
                        //}
                    } else {
                        $sys_postzd_list .= $zd_en_name . ','; //字段名称
                        $sys_postvalue_list .= '\'$' . $zd_en_name . '\','; //接收的名字
                        $where .= ' ' . $zd_en_name . '=\'$' . $zd_en_name . '\' and';
                    }

                }
            }
        }

        $sys_postzd_list = trim( $sys_postzd_list, ',' ) . ',sys_nowbh,sys_bh,sys_zt,sys_zt_bianhao,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate';
        $sys_postvalue_list = trim( $sys_postvalue_list, ',' ) . ',\'$nowbh\',\'$bh_y\',\'$r_zt\',\'$r_zt_bianhao\',\'0\',\'$bh\',\'$SYS_UserName\',\'$hy\',\'$const_id_fz\',\'$const_id_bumen\',\'$nowdata\'';
        //echo $Htmlcache_sql;
        $where = trim( $where, 'and' );
        $Htmlcache .= '
		$nowdata = date( \'Y-m-d H:i:s\' );       //当前时间
		
		//--------------------------------------以下为得交数据
		$sql = "insert into  `' . $databiao . '`  (' . $sys_postzd_list . ') values (' . $sys_postvalue_list . ')";
		mysqli_query( $' . $IsConn . ',$sql );
		echo "<script>' . $sys_countarry . '</script>";
        $nowid = mysqli_insert_id($' . $IsConn . ')';
        $Htmlcache .= '
        //--------------------------------------以下为操作记录提交
        $sys_editcontent=\'首次建档;\';
        if($sys_editcontent!=\'\'){
            $sys_postzd_list = "sys_re_id,sys_edit_id,sys_editcontent";
	        $sys_postvalue_list = "\'' . $re_id . '\',\'$nowid\',\'$sys_editcontent\'";		
	        Jilu_add_Modular( \'sys_xiuguaijilu\', $sys_postzd_list, $sys_postvalue_list); //添加数据 并生成添加的id
	        LiYi_Add(' . $re_id . ',$nowid,534,\'+\');       //利益函数 这里奖励货币
        }' . "\n";
        $Htmlcache .= '
		echo "$nowid";
		}
		mysqli_close( $' . $IsConn . ' ); //关闭数据库
		' . "\n";

        mysqli_free_result( $rs ); //释放内存

        // $Htmlcache.=''."\n\n";

        $Htmlcache .= '?>';

    }
    $current_file = str_replace( "_chache.php", "", basename( __FILE__ ) ); //得到当前文件 除”_chache.php“的文件名称
    write_cache( '1', $Htmlcache, $current_file ); //生成模版
}


mysqli_close( $Conn ); //关闭数据库
//http://localhost/MachineV1.0/B_moban_edit_data_chache.php?act=list&page=1&zu=0&keyword=&re_id=321&zd=0&px_name=id&pxv=Desc&pok=1&bh=9001&hy=9007&scroll_left=0
?>