<?php
include_once '../session.php';
include_once 'B_quanxian.php';
include_once '../inc/Function_All.php';
include_once '../inc/B_Config.php'; //执行接收参数及配置
include_once '../inc/B_conn.php';
include_once '../inc/B_connadmin.php';
include_once '../inc/cache_write.php'; /*自动缓存*/
error_reporting(E_ALL);
ini_set('display_errors', '1');

$tianjia_ZD_Arry = $bitian_Arry = $Wuchongfu_Arry = '';
//=========================================================================得到记录模版设定信息
if ( $re_id <> 0 ) {

    //
    $sql = 'select sys_zt,sys_zt_bianhao,mdb_name_SYS From Sys_jlmb where id=' . $re_id;
    $rs = mysqli_query( $Conn, $sql );
    $row = mysqli_fetch_array( $rs );
    if($row[ 'mdb_name_SYS' ]){
        mysqli_free_result( $rs ); //释放内存
        $r_zt = $row[ 'sys_zt' ]; //系统字头
        $r_zt_bianhao = $row[ 'sys_zt_bianhao' ]; //系统字头编号
        $databiao = htmlspecialchars( trim( $row[ 'mdb_name_SYS' ] ) ); //原数据表名    
    }else{
        echo '没有该表,联系管理员处理!';
		exit();
    }
};
$Conn2 = $Conn; //查询关系表的数据库
$Conn = ChangeConn( $databiao ); //选择数据库
////======================================接收参数开始
$strmkzd = $strmk = '';

if ( isset( $_REQUEST[ 'strmkzd' ] ) ) {
    $strmkzd = trim( $_REQUEST[ 'strmkzd' ] ); //更新动态接收
};
if ( isset( $_REQUEST[ 'strmk' ] ) ) {
    $strmk = trim( $_REQUEST[ 'strmk' ] ); //更新动态接收
};

if ( isset( $_REQUEST[ 'zu' ] ) ) {
    $zu_id = $_REQUEST[ 'zu' ]; //得到分类id
} else {
    $zu_id = 0;
};

//echo ('<br>'.$zu_id);
//$strmk_id=33;
if ( $act == 'list' ) {
    lists();
} elseif ( $act == 'add' ) {
    add();
};

function lists() {
    $Htmlcache = $Htmlcache_data = '';
    //exit;
    global $hy, $re_id,$Conn2, $Conn, $const_q_tianj, $maxrecord, $ToHtmlID, $strmk_id, $databiao, $xt_m_ziduan, $xt_m_ziduan_Name, $file_name, $SYS_Company_id;
    $rs = $sql = $row = $firstinputname = $nowUboundarry = $qx_wuchongfu = $TianJia_POST_Arry = $Wuchongfu_Arry = $zd_Default = $wuchongfu_html = $bitian_Arry = $zhiduanarryNull = $zhiduanarrydata = $sys_gx_id_rows = '';
    $IsConn = IsConn( $databiao ); //查出所属表的数据库
    $zu_all_list = zu_all_list( $re_id ); //查询到分组清单

    //==================================================查询到表的版式start
    $sql = 'select sys_banshi From Sys_jlmb where id=' . $re_id;
    $rs = mysqli_query( $Conn2, $sql );
    $row = mysqli_fetch_array( $rs );
    $sys_banshi = $row[ 'sys_banshi' ]; //1数据表，2文件自动化
    mysqli_free_result( $rs ); //释放内存
    //==================================================得到分页数据
    $sql = 'select id,sys_fenye From sys_fenye where sys_yfzuid=' . $hy . ' and sys_re_id=' . $re_id . ' and sys_huis <> 1 order by id Asc';
    $rs = mysqli_query( $Conn2, $sql );
    $sys_fenye = '';
    if(mysqli_num_rows( $rs )){
        $row = mysqli_fetch_array( $rs );
        $sys_fenye = $row[ 'sys_fenye' ];
    } //得到总数
    mysqli_free_result( $rs ); //释放内存
    //echo $sys_fenye;//得到总分页数据
    //=======分页数据end

    //==================================================================================================================【参数获得】
    $rs = $sql = $row = $firstinputname = $nowUboundarry = $qx_wuchongfu = $TianJia_POST_Arry = $Wuchongfu_Arry = $zd_Default = $wuchongfu_html = $bitian_Arry = $Htmlcache_shuoding_ul = $Htmlcache_xiugai_ul = $Htmlcache_ul = $zhiduanarryNull = $zhiduanarrydata = '';
    $Tablecol_list = Tablecol_list( $databiao ); //得到表的字段清单
    //echo $Tablecol_list;
    $sql = "SHOW FULL COLUMNS FROM `$databiao` ";
    $rs = mysqli_query( $Conn, $sql );
    $countcords = mysqli_num_rows( $rs );

    if ( '1' . $databiao == '1' ) {

    } elseif ( $countcords == 0 ) {

        } else {
            //echo ($re_id);

            $i = 0;
            //$data = array();
            while ( $row = mysqli_fetch_array( $rs ) ) {
                //echo $row['id'];
                $i++;
                $zd_en_name = $row[ 'Field' ]; //字段
                $zdbeizhu = $row[ 'Comment' ]; //备注
                $now_zd_Default = htmlspecialchars( $row[ 'Default' ] ); //默认值
                $NEW_zdbeizhu = colbeizhu( $zdbeizhu, $zd_en_name );
                //0【字段中文名称】,1【显示宽度】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】

                if ( getN( $Tablecol_list, $zd_en_name ) >= 0 ) { //如果查得到该字段时
                    if ( $i == 1 ) {
                        $firstinputname = $zd_en_name;
                    }; //输出第一个文本框字段
                    //$zd_xianshi_input_id = textN( $NEW_zdbeizhu, 4, ',' );         //显示类型
                    $zd_xianshi_is = textN( $NEW_zdbeizhu, 7, ',' ); //7 添加列
                    $zd_shuoding_is = textN( $NEW_zdbeizhu, 6, ',' ); //6 锁定列

                    if ( $zd_xianshi_is == 1 and $zd_en_name != 'id'
                        or SYS_is( $zd_en_name, 'sys_gx_id_' ) == 1 ) {

                        $qx_bitian = textN( $NEW_zdbeizhu, 2, ',' ); //字段必填
                        $qx_wuchongfu = textN( $NEW_zdbeizhu, 3, ',' ); //字段无重复
                        if ( $qx_bitian == 1 ) { //当为必填字段时
                            $bitian_Arry .= $zd_en_name . ',';
                        };
                        //========================输出显示表格<div id='YanZhenChongFu_Div' class='YanZhenChongFu_Div'>00</div>
                        if ( $qx_wuchongfu == 0 ) {
                            $qx_wuchongfu = '';
                            $wuchongfu_html = '';
                        } else {
                            $Wuchongfu_Arry = $Wuchongfu_Arry . ',' . $zd_en_name; //无重复字段
                            $wuchongfu_html = "<div id='{$zd_en_name}_YanZhenChongFu_Div' class='YanZhenChongFu_Div'>00</div>";
                        }; //无重复
                        $zhiduanarryNull .= '		$' . $zd_en_name . '="' . $now_zd_Default . '";' . "\n"; //显示为默认值
                        $zhiduanarrydata .= '		$' . $zd_en_name . '=$row["' . $zd_en_name . '"];' . "\n";
                        $TianJia_POST_Arry = $TianJia_POST_Arry . ',' . $zd_en_name;
                    }
                };
            };
            mysqli_free_result( $rs ); //释放内存

            $bitian_Arry = trim( $bitian_Arry, ',' ); //必填
            //echo($bitian_Arry);
            $firstinputname = trim( $firstinputname, ',' ); //得到第一个输入框
            $TianJia_POST_Arry = trim( $TianJia_POST_Arry, ',' ); //允许添加字段
            $Wuchongfu_Arry = trim( $Wuchongfu_Arry, ',' ); //无重复字段
        }
        //===========【锁定列end】 


    //==============================================================================================================【输出值】
    $Htmlcache .= '<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER[\'PATH_TRANSLATED\']}/session.php";
	    include_once \'B_quanxian.php\';
	    include_once "{$_SERVER[\'PATH_TRANSLATED\']}/inc/B_' . $IsConn . '.php";
	    global $strmk_id,$' . $IsConn . ',$const_q_tianj,$ToHtmlID;
		$Table_name="' . $databiao . '";
		$sys_re_id_02="' . $re_id . '";
		$getdate=getdate();
		
		if ( isset( $_REQUEST[ \'sys_guanxibiao_id\' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ \'sys_guanxibiao_id\' ] );}else{$sys_guanxibiao_id = \'\';};         //关系表re_id
	    if ( isset( $_REQUEST[ \'GuanXi_id\' ] ) ){$GuanXi_id = intval( $_REQUEST[ \'GuanXi_id\' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ \'ToHtmlID\' ] ) ){$ToHtmlID = $_REQUEST[ \'ToHtmlID\' ];};                                                                              //显示页面
		
	    //echo $sys_guanxibiao_id.\';\'.$GuanXi_id.\';\'.$Table_name;
	    ' . "\n";

    if ( $IsConn == 'Connadmin' ) {
        $Htmlcache .= '		$Conn=$Connadmin;' . "\n";
    }


    $Htmlcache .= '
		if ( $strmk_id > 0 ) { //复制添加时执行
		$sql = "select * From `' . $databiao . '` where `id`=\'$strmk_id\' ";
		$rs = mysqli_query(  $Conn , $sql );
		$row = mysqli_fetch_array( $rs );
		
	
	' . "\n";
    $Htmlcache .= $zhiduanarrydata . "\n"; //得到变量值，如有时
    $Htmlcache .= '
		
		mysqli_free_result( $rs ); //释放内存
	
	' . "\n";
    $Htmlcache .= "}else{\n";
    $Htmlcache .= $zhiduanarryNull . "\n"; //申明变量
    $Htmlcache .= "};\n";
    $Htmlcache .= '
		if($sys_guanxibiao_id!=\'\' && $GuanXi_id!=\'\' && $Table_name!=\'\'){
	        //--------------------------------查询关系表
	        $sys_nowid_guanxi_col=\'sys_gx_id_\'.$sys_guanxibiao_id;
	        $sql = "select sys_GuanXiZDList From `sys_guanxibiao` where `sys_re_id`=\'$sys_guanxibiao_id\' and sys_re_id_02=\'$sys_re_id_02\' and sys_nowid_guanxi_col=\'$sys_nowid_guanxi_col\' and sys_huis=0";
	        $rs = mysqli_query(  $Conn , $sql );
	        $row = mysqli_fetch_array( $rs );
	        $sys_GuanXiZDList=$row[\'sys_GuanXiZDList\'];
	        mysqli_free_result( $rs ); //释放内存
			$sys_GuanXiZDList=\'id=sys_gx_id_\'.$sys_guanxibiao_id.\',\'.$sys_GuanXiZDList;
	        //echo $sys_GuanXiZDList;
	        //--------------------------------jlmb表名
	        $sql = "select mdb_name_SYS From `sys_jlmb` where `id`=\'$sys_guanxibiao_id\' ";
	        $rs = mysqli_query(  $Conn , $sql );
	        $row = mysqli_fetch_array( $rs );
	        $mdb_name_SYS=$row[\'mdb_name_SYS\'];
	        mysqli_free_result( $rs ); //释放内存
	        //echo $mdb_name_SYS;
	        //--------------------------------查询到关系记录
	        $sql = "select * From `$mdb_name_SYS` where `id`=\'$GuanXi_id\' ";
	        $rs = mysqli_query(  $Conn , $sql );
	        $row = mysqli_fetch_array( $rs );
	        ' . $sys_gx_id_rows . '
	        //循环
            $fharry = explode( \',\', $sys_GuanXiZDList );
	        for ( $i = 0; $i < count( $fharry ); $i++ ) {
		        //$nowval = $fharry[ $i ];
				$fharry2 = explode( \'=\', $fharry[ $i ] );
				$nowval_A=$fharry2[0];
				$nowval_B=$fharry2[1];
				$$nowval_B=$row[$nowval_A];
				//echo $$nowval_B;
	        };
	        mysqli_free_result( $rs ); //释放内存

        }
		';


    $Htmlcache .= "echo\"<form id='post_form' autocomplete='off' tit='' SYS_Company_id='{$SYS_Company_id}'  style='padding-top:18px'>\n";

    //======================================================以下为分页按钮菜单
    $nowtextvalue = $nowtextvalue3 = $nowContentTwo = $countArr = $Arr_ziduan3 = $iiss2 = '';
    $Arr_ziduan3 = explode( ';', $sys_fenye ); //得到分页数据列出
    $countArr = count( $Arr_ziduan3 ); //得到数组数量
    if ( $countArr > 2 ) { //有进行分页时
        $Htmlcache .= '<div class=\'two_menu\'>' . "\n";
        $Htmlcache .= "<ul class='tr trhead' >&nbsp;  <span class='menutishi nocopytext'>Menu</span></ul>\n";
        for ( $ii3 = 0; $ii3 < $countArr - 1; $ii3++ ) {
            $nowpageziduan = '';
            $ii2 = $ii3 + 1;
            $nowval3 = $Arr_ziduan3[ $ii3 ];
            $Arr_ziduan4 = explode( ':', $nowval3 ); //得到分页数据列出
            $nowtextvalue3 = $Arr_ziduan4[ 0 ]; //得到页显示的分页名称
            $nowpageziduan = $Arr_ziduan4[ 1 ]; //每页显示的字段
            $nowtextvalue .= $nowpageziduan . ','; //得到分页除首页的字段清单

            if ( $ii2 == '1' ) {
                $selectTag = 'selectTag';
            } else {
                $selectTag = '';
                //$nowContentTwo.= '<div  xszd=\''.$nowpageziduan.'\' class=\'NowULTable nocopytext ContentTwo ContentTwo'.$ii2.'\' style=\'display:none\'>ContentTwo'.$ii2.'</div>'."\n" ;
            }
            //$nowzzname=substr($nowtextvalue3,4);
            if ( $ii2 < 10 ) {
                $iiss2 = '0' . $ii2;
            } else {
                $iiss2 = $ii2;
            }
            $Htmlcache .= "<ul class='tr $selectTag' title='$nowtextvalue3' onClick=SelectTag_Menu_Two('.ContentTwo" . $ii2 . "',this,'$ToHtmlID') >$iiss2  <span class='menutishi nocopytext'>$nowtextvalue3</span><span class='bitian_wuchong_tongji'>0</span></ul>\n";

        }
        //$Htmlcache.= '<ul class=\'tr\'  onClick=SelectTag_Menu_Two(\'.ContentTwo2\',this,\''.$ToHtmlID.'\')>2</ul>' ;	
        $Htmlcache .= "<ul class='tr trboom' onClick=SelectTag_Menu_Two('.ContentTwo',this,'$ToHtmlID') >&nbsp;  &nbsp;&nbsp;</ul>\n";
        $Htmlcache .= '</div>' . "\n";
        //$Htmlcache.= $nowContentTwo;//这里生成切换的内页div
    }
    //======分页按钮菜单结束
    $nowtextvalue = move_arrynull( $nowtextvalue ); //首页不需要显示的字段，去空字符


    $baidulihtml = "<li style='text-align:left;width:28px;margin-left:8px;border:0px solid #333;text-align: center;cursor:default;' class='font_red' onclick='baidu_url(this)'><i class='fa fa-18-4'></i></li>";
    //======================================================以下为分页对应内容
    $Htmlcache .= '<div id=\'mobanaddbox\' class=\'NowULTable nocopytext\'>";' . "\n";
    $Htmlcache .= 'echo"<span class=\'ContentTwo ContentTwo1\' style=\'display:block\'>";' . "\n";

    $nowtextvalue6 = $nowtextvalue8 = $countArr6 = $Arr_ziduan8 = $ii7 = '';
    $Arr_ziduan8 = explode( ';', $sys_fenye ); //得到分页数据列出
    $countArr6 = count( $Arr_ziduan8 ) - 1; //得到数组数量
    //$Htmlcache .= 'echo"'.$countArr6.'";' . "\n";//用于测试
    if ( $countArr6 == 0 ) {
        $countArr6 = 1; //至少显示一页
    }
    //if ( $countArr6 > 1 ) { //有进行分页时
    for ( $ii8 = 0; $ii8 < $countArr6; $ii8++ ) {
        $nowpageziduan = $Htmlcache_shuoding_ul = $Htmlcache_xiugai_ul = '';
        $ii7 = $ii8 + 1;
        $nowval8 = $Arr_ziduan8[ $ii8 ];
        $Arr_ziduan4 = explode( ':', $nowval8 ); //得到分页数据列出
        $nowpageziduan = isset($Arr_ziduan4[ 1 ])?$Arr_ziduan4[ 1 ]:''; //每页显示的字段

        if ( $ii7 == 1 ) { //为第一页时
            //$selectTag = 'selectTag';

            $nowpageziduan = TwoArryQuChong( $Tablecol_list, $nowtextvalue, ',' ); //首页去除其它所有选中字段外
        } else { //为第二页及其它页时
            //$selectTag = '';
            $Htmlcache .= 'echo"<span class=\'ContentTwo ContentTwo' . $ii7 . '\' style=\'display:none\'>";' . "\n";
        }
        //$Htmlcache .=$Htmlcache_a;
        //==================================================================================================================【锁定与显示列】

        $sql = "SHOW FULL COLUMNS FROM `$databiao` ";
        $rs = mysqli_query( $Conn, $sql );
        $countcords = mysqli_num_rows( $rs );

        if ( '1' . $databiao == '1' ) {
            $Htmlcache .= "<ul style='padding-left:20px;padding-top:25px;color:red;'>对不起，还没有设定数据库表呢！请先设定。</ul>";
        } elseif ( $countcords == 0 ) {
                $Htmlcache .= "<ul style='padding-left:20px;padding-top:25px;color:red;'>还没有设定允许修改字段，请联系上级设定好再来。</ul>";
            } else {
                //echo ($re_id);

                $i = 0;
                //$data = array();
                while ( $row = mysqli_fetch_array( $rs ) ) {
                    //echo $row['id'];
                    $i++;
                    $zd_en_name = $row[ 'Field' ]; //字段
                    $zdbeizhu = $row[ 'Comment' ]; //备注
                    $NEW_zdbeizhu = colbeizhu( $zdbeizhu, $zd_en_name );
                    //0【字段中文名称】,1【显示宽度】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】
                    $Tablecol_is = 0;
                    $Tablecol_list_02 = getN( $nowpageziduan, $zd_en_name ); //当查询到指定时


                    if ( $Tablecol_list_02 >= 0 ) { //如果查得到该字段时
                        $zd_cn_name = textN( $NEW_zdbeizhu, 0, ',' ); //中文字段名
                        //$zd_xianshi_width = textN( $NEW_zdbeizhu, 1, ',' );          //字段显示宽度
                        $zd_xianshi_input_id = textN( $NEW_zdbeizhu, 4, ',' ); //显示类型
                        $zd_xianshi_is = textN( $NEW_zdbeizhu, 7, ',' ); //7 添加列
                        $zd_baidu_is = textN( $NEW_zdbeizhu, 9, ',' ); //百度
                        $zd_shuoding_is = textN( $NEW_zdbeizhu, 6, ',' ); //6 锁定列
                        $zd_xianshi_height = textN( $NEW_zdbeizhu, 10, ',' ); //10为控件显示高度
                        if ( $zd_baidu_is == 1 ) {
                            $baiduli = $baidulihtml;
                        } else {
                            $baiduli = "";
                        }
                        if ( $zd_xianshi_is == 1 and $zd_en_name != 'id'
                            or SYS_is( $zd_en_name, 'sys_gx_id_' ) == 1 ) {

                            //$Htmlcache_data.='$'.$zd_en_name.'=$row["'.$zd_en_name.'"]'.";\n";
                            $zd_Default = move_zkh( $row[ 'Default' ], "N',[,],'" ); //默认值
                            $now_zd_Default = htmlspecialchars( $row[ 'Default' ] ); //默认值
                            $Htmlcache_parent2 = $Htmlcache;
                            $qx_bitian = textN( $NEW_zdbeizhu, 2, ',' ); //字段必填
                            $qx_wuchongfu = textN( $NEW_zdbeizhu, 3, ',' ); //字段无重复

                            $sys_class = 'addboxinput inputfocus';
                            //echo $zd_xianshi_input_id;

                            $getN_XTZD = getN( $xt_m_ziduan, strtolower( $zd_en_name ) ); //当>=0为系统字段时
                            if ( $getN_XTZD >= 0 ) {
                                $zd_cn_name = textN( $xt_m_ziduan_Name, $getN_XTZD, ',' ); //显示字段系统名称					
                            };
                            $zd_cn_name = SysChangeName( $zd_cn_name, $databiao ); //变更系统设定名

                            if ( $zd_xianshi_input_id == 10 ) { //当为密码时
                                $zd_cn_name = '[不修改请留空] ' . $zd_cn_name;
                            };

                            /*if ( $strmk_id > 0 ) { //复制添加时执行
				                          $sys_value = htmlspecialchars( $row[$zd_en_name] ); //得到当前值
			                         } else {
				                          $sys_value = $zd_Default;
			                         };
			                          */

                            $sys_value = '$' . $zd_en_name;


                            if ( $qx_wuchongfu == 1 ) { //当为无重复时
                                $zd_cn_name = "<font color='red'>[验重]</font>&nbsp;" . $zd_cn_name;
                            };

                            if ( $qx_bitian == 1 ) { //当为必填字段时
                                $zd_cn_name = "<font color='red' class='s_bt'>*</font>&nbsp;" . $zd_cn_name;
                            };

                            $zd_id = $zd_en_name;
                            if ( $zd_xianshi_input_id == 27 ) { //当为多选框时
                                $onchange=' onchange=\"checkbox_morechecked(this)\" ';
                            }else{
                                $onchange='';
                            }
                            $zd_xianshi_input = Get_out_InputTypes_cols( $zd_xianshi_input_id, $zd_en_name, $zd_id, $sys_class, $sys_value, '100%', $zd_xianshi_height, $re_id,'Daima_xianshi',''," checked='checked' ",$onchange); //这里为输出input样式
                            
                            //$zd_xianshi_input = Get_out_InputTypes_cols( $zd_xianshi_input_id, $zd_en_name, $zd_id, $sys_class, $sys_value, '100%', $zd_xianshi_height, $re_id ); //这里为输出input样式

                            $Htmlcache_ul = '';
                            //===============================================================数据输出
                            if ( $zd_en_name == 'sys_shenpi' ) { //当属于审核执行
                                $Htmlcache_ul .= 'if ( strpos($const_q_shenghe, "' . $re_id . '") !== false ) { //有审核权限时' . "\n";
                            } elseif ( $zd_en_name == 'sys_shenpi_all' ) { //当属于批准执行
                                $Htmlcache_ul .= 'if ( strpos($const_q_pizhun, "' . $re_id . '") !== false ) { //有批准权限时' . "\n";
                            }
                                //===============================================================版式选择时
                            if ( $sys_banshi == 2 ) { //1数据表，2文件自动化 3其它
                                $sys_banshi_html = "<li style='text-align:right;width:183px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'> {" . $zd_en_name . "} </li> <li style='text-align:left;width:67px'><i class='fa fa-17-3' onclick=copyText(this,'{".$zd_en_name."}') ></i> 替换为 </li>";
                            } else {
                                $sys_banshi_html = '';
                            }

                            $Htmlcache_ul .= 'echo"';
                            if ( SYS_is( $zd_en_name, 'sys_gx_id_' ) == '1' ) {
                                $sys_gx_id_rows = '$' . $zd_en_name . '=$row[\'id\'];' . "\n";
                                $sys_re_id = preg_replace( '/[^\d]*/', '', substr( $zd_en_name, -9 ) ); //只取末位数字
                                //$zd_cn_name=Find_table_CNname_fromre_id( $sys_re_id ).'ID';              //得到中文件名
                                //----------------------------------------------------------开始查询数
                                $sql2 = "select * From `sys_guanxibiao` where sys_re_id='$sys_re_id' and sys_re_id_02='$re_id' and sys_huis='0'";
                                // echo $sql2;
                                $rs2 = mysqli_query( $Conn2, $sql2 );
                                echo mysqli_error($Conn2);
                                //$nowrscount = mysqli_num_rows( $rs ); //统计数量
                                if($row2 = mysqli_fetch_array( $rs2 )){
                                    $GuanXi_id = $row2[ 'id' ]; //关系对应列表
                                    $GuanXiFillInput = "<script> GuanXiFillInput('$zd_en_name','$GuanXi_id','$databiao','$ToHtmlID');</script>";
                                }else {
                                    $GuanXiFillInput = "";
                                }
                                mysqli_free_result( $rs2 ); //释放内存
                            } else {
                                $GuanXiFillInput = "";
                            }

                            //----------------------------------------------------------输出显示UL
                            $Htmlcache_ul .= "
	                         <ul zd='$zd_en_name'>
		                        <li style='text-align:right;width:220px'>$zd_cn_name:</li>
                                $sys_banshi_html
		                        <li style='width:40%' class='reset_list'>$zd_xianshi_input</li>
								$baiduli
		                        <li style='text-align:left;width:30%' class='font_red yanzheng' id='" . $zd_en_name . "_bitian'>$wuchongfu_html</li>
                                $GuanXiFillInput
		                     </ul>
	                         " . "\n";

                            $Htmlcache_ul .= '";' . "\n";
                            if ( $zd_en_name == 'sys_shenpi' || $zd_en_name == 'sys_shenpi_all' ) { //当属于审核执行
                                $Htmlcache_ul .= '}' . "\n";
                            }
                            //=====数据输出end

                            //------------------------------------------------------查询到是否关系存在
                            if ( SYS_is( $zd_en_name, 'sys_gx_id_' ) == 1 ) {
                                $parentre_id = preg_replace( '/[^\d]*/', '', $zd_en_name ); //只取末位数字
                                $Tongji = Tongji_table_rows( 'sys_guanxibiao', "sys_re_id=$parentre_id and sys_re_id_02=$re_id and sys_huis=0" ); //统计数量
                                if ( $Tongji == 0 ) {
                                    $Htmlcache = $Htmlcache_parent2;
                                }
                            }

                            if ( $zd_shuoding_is == 1 ) { //当为锁定列时
                                $Htmlcache_shuoding_ul .= $Htmlcache_ul;
                            } else { //修改列
                                $Htmlcache_xiugai_ul .= $Htmlcache_ul;
                            }

                        }
                    };
                };
                mysqli_free_result( $rs ); //释放内存
            }
            //===========【锁定列end】
            //$Htmlcache=$Htmlcache; 
        $Htmlcache .= $Htmlcache_shuoding_ul . $Htmlcache_xiugai_ul; //先执行锁定列

        $Htmlcache .= 'echo"</span>";' . "\n"; //先执行锁定列
    }
    //}
    //$Htmlcache .= $Htmlcache_data; //这里得到数据
    //===============================================================版式选择时
    if ( $sys_banshi == 2 ) { //1数据表，2文件自动化 3其它
        $sys_banshi_html2 = "<li style='text-align:right;width:250px'>&nbsp; </li>";
    } else {
        $sys_banshi_html2 = '';
    }
    //===============================================================输出下方按钮
    $Htmlcache .= "echo\"<ul style='height:15px;'><li style='width:98%'></li></ul>\";\n"; //间隔空白处

    $Htmlcache .= 'if ( strpos($const_q_tianj, "' . $re_id . '") !== false  ) { //有添加权限时' . "\n";

    $Htmlcache .= "       echo\"<ul>$sys_banshi_html2
          <li style='text-align:right;width:220px'><i class='fa fa-sitting-ziduan'  title='设定添加字段。'/>&nbsp;</li>
          <li style='width:40%;text-align:left;padding-left:2px;'>
  
          <input id='reset_add' type='reset' value='重填' tabindex=-1 style='width:10%' class='button button_reset'><input type='hidden' id='formaddcount' value='0'/>
  
          <input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='" . $TianJia_POST_Arry . "'/>
  
          <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:90%'  SYS_Company_id='" . $SYS_Company_id . "' strmk_id='" . '' . "' firstinputname='$firstinputname' bitian_Arry='$bitian_Arry' databiao='$databiao' Wuchongfu_Arry='$Wuchongfu_Arry'  onclick=data_add_arrys(this,'#post_form','" . '$ToHtmlID' . "')   onkeydown='EnterPress(event,this,this.click)' />
  
          <font id='editsuccess' class='font_red'></font></li>
        </ul>\";\n";

    $Htmlcache .= "}
		echo\"<input type='hidden' name='re_id' id='re_id' value='$re_id' />
		
		</div>
		</form>
		<div id='clonecopy2'>&nbsp;</div>";

    $Htmlcache .= "<script>YanZhen_ChongFu_ZuLoad(0,'$Wuchongfu_Arry','$databiao','" . '$ToHtmlID' . "');form_add_copy('" . '$ToHtmlID' . "');inputfocusfirst('#\"." . '$ToHtmlID' . ".\"_content_foot .htmlleirong','$firstinputname');form_weikong('#post_form','" . $ToHtmlID . "');</script>\";\n\n"; //输出js
    $Htmlcache .= "?>" . "\n\n";
    //echo '"; ? >';
    //$cache->caching();


    //echo $Htmlcache;
    if ( $IsConn == 'Connadmin' ) {
        $Htmlcache .= '<?php ' . "\n" . 'mysqli_close( $Connadmin ); //关闭数据库' . "\n\n" . '?>';
    } else {
        $Htmlcache .= '<?php ' . "\n" . 'mysqli_close( $Conn ); //关闭数据库' . "\n\n" . '?>';
    }


    $current_file = str_replace( "_chache.php", "", basename( __FILE__ ) ); //得到当前文件 除”_chache.php“的文件名称
    write_cache( '1', $Htmlcache, $current_file ); //生成模版

}
//sleep(1);//暂停一秒
//find_cache('1');
if ( $strmk_id > 0 ) { //复制添加时执行
    //echo "这里要修改验重项";
};


mysqli_close( $Conn ); //关闭数据库
//mysqli_close($Connadmin);//关闭云数据库
//http://localhost/MachineV1.0/B_moban_add_chache.php?re_id=321&act=list

?>