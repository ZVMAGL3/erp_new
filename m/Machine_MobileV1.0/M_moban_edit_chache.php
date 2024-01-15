<?php
header( 'Content-type: text/html; charset=utf8' ); //设定本页编码
include_once '../../session.php'; //session记录
include_once 'M_quanxian.php'; //接收职位权限信息
include_once '../../inc/Function_All.php'; //
include_once '../../inc/B_Config.php'; //执行接收参数及配置
include_once '../../inc/B_conn.php'; //
include_once '../../inc/B_connadmin.php'; //
include_once '../../inc/cache_write.php'; /*自动缓存*/
error_reporting(E_ALL);
ini_set('display_errors', '1');
$databiao = Find_tablename( $re_id );
if(!$databiao){
    echo '没有该表,联系管理员处理!';
    exit();
}
$Conn2 = $Conn; //选择数据库
$Conn = ChangeConn( $databiao ); //选择数据库
//echo $databiao;

//接收参数开始


//$strmkzd=htmlspecialchars(trim(_REQUEST['strmkzd']));//更新动态接收
//$strmk=htmlspecialchars(trim(_REQUEST['strmk']));//更新动态接收


if ( $act == 'list' ) {
    lists();
};

function lists() {
    $Htmlcache = $Htmlcache2 = '';
    global $hy,$Conn, $Conn2, $databiao, $strmk_id, $bitian_Arry, $sys_q_xiug, $re_id, $sys_q_cak, $xt_m_ziduan, $xt_m_ziduan_Name, $ToHtmlID; //得到全局变量
    $IsConn = IsConn( $databiao ); //查出所属表的数据库
    $zu_all_list = zu_all_list( $re_id ); //查询到分组清单
    //==================================================查询到表的版式start
    $sql = 'select sys_banshi From Sys_jlmb where id=' . $re_id;
    $rs = mysqli_query( $Conn2, $sql );
    $sys_banshi = '';
    if($row = mysqli_fetch_array( $rs )){
        $sys_banshi = $row[ 'sys_banshi' ]; //1数据表，2文件自动化 3其它
    }
    mysqli_free_result( $rs ); //释放内存
    //==================================================得到分页数据

    $Htmlcache .= '<?php
	    header( "Content-type: text/html; charset=utf-8" ); //设定本页编码
	    include_once "{$_SERVER[\'PATH_TRANSLATED\']}/session.php";
	    include_once \'M_quanxian.php\';
	    include_once "{$_SERVER[\'PATH_TRANSLATED\']}/inc/B_' . $IsConn . '.php";
		if ( isset( $_REQUEST[ \'sys_guanxibiao_id\' ] ) ){$sys_guanxibiao_id = intval( $_REQUEST[ \'sys_guanxibiao_id\' ] );}else{$sys_guanxibiao_id = \'\';};         //关系表id
	    if ( isset( $_REQUEST[ \'GuanXi_id\' ] ) ){$GuanXi_id = intval( $_REQUEST[ \'GuanXi_id\' ] );}else{$GuanXi_id = "";};   //关系列id
	    if ( isset( $_REQUEST[ \'ToHtmlID\' ] ) ){$ToHtmlID = $_REQUEST[ \'ToHtmlID\' ];};                                                                              //显示页面
	    if ( isset( $_REQUEST[ \'huis\' ] ) ){$huis = intval( $_REQUEST[ \'huis\' ] );}else{$huis = 0;};                                                                //1回收站0为不回收
	    //if ( $huis == 1){$ToHtmlID=\'HUIS_\'.$ToHtmlID;};                                                                                                               //是否为回收站0为不回收
	   
	    global $strmk_id,$' . $IsConn . ',$sys_q_xiug;
	    $zu_all_list="' . $zu_all_list . '";
	    $sql = \'select * From `' . $databiao . '` where `id`=\'.$strmk_id;
	    $rs = mysqli_query(  $' . $IsConn . ' , $sql );
	    $row = mysqli_fetch_array( $rs );
	    mysqli_free_result( $rs ); //释放内存
	' . "\n";

    $rs = $sql = $row = $firstinputname = $nowUboundarry = $qx_wuchongfu = $TianJia_POST_Arry = $Wuchongfu_Arry = $zd_Default = $wuchongfu_html = $bitian_Arry = '';
    $Tablecol_list = Tablecol_list( $databiao ); //得到表的字段清单
    //echo $Tablecol_list;
    //==================================================================================================================【锁定列】
    $sql = "SHOW FULL COLUMNS FROM `$databiao` ";
    $rs = mysqli_query( $Conn, $sql );
    $countcords = mysqli_num_rows( $rs );

    if ( '1' . $databiao == '1' ) {
        $Htmlcache = "<ul style='padding-left:20px;padding-top:25px;color:red;'>对不起，还没有设定数据库表呢！请先设定。</ul>";
    } elseif ( $countcords == 0 ) {
            $Htmlcache = "<ul style='padding-left:20px;padding-top:25px;color:red;'>还没有设定允许修改字段，请联系上级设定好再来。</ul>";
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


                if ( getN( $Tablecol_list, $zd_en_name ) >= 0 ) { //如果查得到该字段时
                    if ( $i == 1 ) {
                        $firstinputname = $zd_en_name;
                    }; //输出第一个文本框字段
                    $zd_cn_name = textN( $NEW_zdbeizhu, 0, ',' ); //中文字段名
                    //$zd_xianshi_width = textN( $NEW_zdbeizhu, 1, ',' );      //字段显示宽度
                    $zd_xianshi_input_id = textN( $NEW_zdbeizhu, 4, ',' ); //显示类型
                    $zd_xianshi_is = textN( $NEW_zdbeizhu, 8, ',' ); //修改
                    $zd_shuoding_is = textN( $NEW_zdbeizhu, 6, ',' ); //6为锁定列
                    $zd_xianshi_height = textN( $NEW_zdbeizhu, 10, ',' ); //10为控件显示高度

                    if ( $zd_xianshi_is == 1 and $zd_shuoding_is == 1 and $zd_en_name != 'id' ) {

                        //$Htmlcache_data.='$'.$zd_en_name.'=$row["'.$zd_en_name.'"]'.";\n";
                        $zd_Default = move_zkh( $row[ 'Default' ], "N',[,],'" ); //默认值
                        $now_zd_Default = htmlspecialchars( $row[ 'Default' ] ); //默认值

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

                        $sys_value = '$row[' . $zd_en_name . ']'; //得到当前值
                        if ( $qx_wuchongfu == 1 ) { //当为无重复时
                            $zd_cn_name = "<font color='red'>[验重]</font>&nbsp;" . $zd_cn_name;
                        };

                        if ( $qx_bitian == 1 ) { //当为必填字段时
                            $zd_cn_name = "<font color='red' class='s_bt'>*</font>&nbsp;" . $zd_cn_name;
                            $bitian_Arry .= $zd_en_name . ',';
                        };

                        //$nowvalue=$sys_value;
                        //$nowvalue=str_replace("\n","<br>",$sys_value);//($sys_value);
                        //$data[$zd_en_name] = $sys_value;
                        //$Htmlcache_data.="\"$zd_en_name\":\"$nowvalue\",";//这里得到数据

                        $zd_xianshi_input = Get_out_InputTypes_cols( $zd_xianshi_input_id, $zd_en_name, $zd_en_name, $sys_class, $sys_value, '100%', $zd_xianshi_height, $re_id ); //这里为输出input样式


                        //========================输出显示表格<div id='YanZhenChongFu_Div' class='YanZhenChongFu_Div'>00</div>
                        if ( $qx_wuchongfu == 0 ) {
                            $qx_wuchongfu = '';
                        } else {
                            $Wuchongfu_Arry = $Wuchongfu_Arry . ',' . $zd_en_name; //无重复字段
                        }; //无重复

                        $TianJia_POST_Arry = $TianJia_POST_Arry . ',' . $zd_en_name;
                        //$Htmlcache=$Htmlcache_data.$Htmlcache."\n";
                        $Htmlcache2 .= 'echo"';
                        $Htmlcache2 .= "
                            <ul><li class='cols01'>" . $zd_cn_name . ":</li>
                            <li class='cols02 reset_list'>$zd_xianshi_input
                            <div class='cols03 font_red yanzheng' id='" . $zd_en_name . "_bitian'>$wuchongfu_html</div>
                            </li>
                            </ul>
                        ";
                        $Htmlcache2 .= '";' . "\n";
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
        //==================================================================================================================【显示列】
    $sql = "SHOW FULL COLUMNS FROM `$databiao` ";
    $rs = mysqli_query( $Conn, $sql );
    $countcords = mysqli_num_rows( $rs );

    if ( '1' . $databiao == '1' ) {
        //$Htmlcache= "<ul style='padding-left:20px;padding-top:25px;color:red;'>对不起，还没有设定数据库表呢！请先设定。</ul>" ;
    } elseif ( $countcords == 0 ) {
        //$Htmlcache= "<ul style='padding-left:20px;padding-top:25px;color:red;'>还没有设定允许修改字段，请联系上级设定好再来。</ul>" ;
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
            $NEW_zdbeizhu = colbeizhu( $zdbeizhu, $zd_en_name );
            //0【字段中文名称】,1【显示宽度】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】


            if ( getN( $Tablecol_list, $zd_en_name ) >= 0 ) { //如果查得到该字段时
                if ( $i == 1 ) {
                    $firstinputname = $zd_en_name;
                }; //输出第一个文本框字段
                $zd_cn_name = textN( $NEW_zdbeizhu, 0, ',' ); //中文字段名
                //$zd_xianshi_width = textN( $NEW_zdbeizhu, 1, ',' );          //字段显示宽度
                $zd_xianshi_input_id = textN( $NEW_zdbeizhu, 4, ',' ); //显示类型
                $zd_xianshi_is = textN( $NEW_zdbeizhu, 8, ',' ); //修改
                $zd_shuoding_is = textN( $NEW_zdbeizhu, 6, ',' ); //6为锁定列
                $zd_xianshi_height = textN( $NEW_zdbeizhu, 10, ',' ); //10为控件显示高度
                if ( $zd_xianshi_is == 1 and $zd_shuoding_is != 1 and $zd_en_name != 'id' ) {

                    //$Htmlcache_data.='$'.$zd_en_name.'=$row["'.$zd_en_name.'"]'.";\n";
                    $zd_Default = move_zkh( $row[ 'Default' ], "N',[,],'" ); //默认值
                    $now_zd_Default = htmlspecialchars( $row[ 'Default' ] ); //默认值

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

                    $sys_value = '$row[' . $zd_en_name . ']'; //得到当前值
                    if ( $qx_wuchongfu == 1 ) { //当为无重复时
                        $zd_cn_name = "<font color='red'>[验重]</font>&nbsp;" . $zd_cn_name;
                    };

                    if ( $qx_bitian == 1 ) { //当为必填字段时
                        $zd_cn_name = "<font color='red' class='s_bt'>*</font>&nbsp;" . $zd_cn_name;
                        $bitian_Arry .= $zd_en_name . ',';
                    };

                    //$nowvalue=$sys_value;
                    //$nowvalue=str_replace("\n","<br>",$sys_value);//($sys_value);
                    //$data[$zd_en_name] = $sys_value;
                    //$Htmlcache_data.="\"$zd_en_name\":\"$nowvalue\",";//这里得到数据

                    $zd_xianshi_input = Get_out_InputTypes_cols( $zd_xianshi_input_id, $zd_en_name, $zd_en_name, $sys_class, $sys_value, '100%', $zd_xianshi_height, $re_id ); //这里为输出input样式


                    //========================输出显示表格<div id='YanZhenChongFu_Div' class='YanZhenChongFu_Div'>00</div>
                    if ( $qx_wuchongfu == 0 ) {
                        $qx_wuchongfu = '';
                    } else {
                        $Wuchongfu_Arry .= $zd_en_name . ','; //无重复字段
                    }; //无重复

                    $TianJia_POST_Arry .= $zd_en_name . ',';
                    //$Htmlcache=$Htmlcache_data.$Htmlcache."\n";
                    $Htmlcache2 .= 'echo"';
                    $Htmlcache2 .= "<ul><li class='cols01'>" . $zd_cn_name . ":</li>
               <li class='cols02 reset_list'>$zd_xianshi_input
			   <div class='cols03 font_red yanzheng' id='" . $zd_en_name . "_bitian'>$wuchongfu_html</div>
			   </li>
			   </ul>";
                    $Htmlcache2 .= '";' . "\n";
                }
            };
        };
        mysqli_free_result( $rs ); //释放内存

        $bitian_Arry = trim( $bitian_Arry, ',' ); //必填
        //echo($bitian_Arry);
        //$firstinputname = trim( $firstinputname, ',' ); //得到第一个输入框
        $TianJia_POST_Arry = trim( $TianJia_POST_Arry, ',' ); //允许添加字段
        $Wuchongfu_Arry = trim( $Wuchongfu_Arry, ',' ); //无重复字段
        //================================================================================================js代码
        $Htmlcache .= "echo( \"<script>guanximenucopy_mobile('$ToHtmlID');YanZhen_ChongFu_ZuLoad_mobile(" . '$strmk_id' . ",'$Wuchongfu_Arry','$databiao','$ToHtmlID','#addbox');$('#$ToHtmlID #addbox #post_form').attr({'tit':'$bitian_Arry','strmk_id':'" . '$strmk_id' . "'});form_weikong('#post_form','$ToHtmlID');ListLoadEND_Mobile('$ToHtmlID');</script>\" );" . "\n";

        //================================================================================================内容代码
        $Htmlcache .= 'echo"';
        $Htmlcache .= '<p></p><form id=\'post_form\' autocomplete=\'off\' SYS_Company_id=\'$SYS_Company_id\' strmk_id=\'$strmk_id\' zu_all_list=\'$zu_all_list\'><div id=\'mobanaddbox\' class=\'NowULTable nocopytext\'>";' . "\n";
        $Htmlcache .= $Htmlcache2;
        $Htmlcache .= 'echo"';
        $Htmlcache .= "<ul style='height:15px'><li style='width:98%'></li></ul>" . '";' . "\n"; //间隔空白处
        $Htmlcache .= 'echo"';
        $Htmlcache .= "<ul><li class='cols01'>";
        if ( $sys_q_xiug >= 0 ) { //没有修改权限时
            $Htmlcache .= "<i class='fa fa-sitting-ziduan' title='设定显示与锁定。' onClick=Table_Set_XianShi('$ToHtmlID',this) title='设定修改字段。'></i>";
        };
        $Htmlcache .= "&nbsp;</li><li  class='cols02'><input type='hidden' id='sys_postzd_list' name='sys_postzd_list' value='" . $TianJia_POST_Arry . "'/>\";\n";


        //$Htmlcache.= "<input type='reset' value='重置' tabindex=-1 class='button button_reset'  style='width:10%' onclick=inputfocusfirst('#addbox .htmlleirong','$firstinputname')>" ; //重置按钮
        $Htmlcache .= 'if ( $sys_q_xiug >= 0 ) { //有修改权限时' . "\n";
        $Htmlcache .= "    echo\"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'$ToHtmlID','.sett'," . '$strmk_id' . "); />\";\n"; //复制按钮
        $Htmlcache .= "    echo\"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='" . '$SYS_Company_id' . "'  firstinputname='$firstinputname' bitian_Arry='$bitian_Arry'  Wuchongfu_Arry='$Wuchongfu_Arry'  onclick=data_edit_arrys(this,'#post_form','$ToHtmlID')  style='width:85%'  />\";\n"; //确定按钮

        $Htmlcache .= '}else{' . "\n";

        $Htmlcache .= "    echo\"<input value='复制添加' tabindex=-1 title='&nbsp;复制该条修改后快速添加&nbsp;' type='button' class='button button_reset' style='width:15%;border-right:0px solid #333' onclick=loodfoot(1,'$ToHtmlID','.sett'," . '$strmk_id' . "); />\";\n"; //复制按钮
        $Htmlcache .= "    echo\"<input id='SYS_submit' value='确定修改' title='&nbsp;Ctrl+Enter提交&nbsp;' type='button' class='button button_ADD'  SYS_Company_id='" . '$SYS_Company_id' . "'  firstinputname='$firstinputname' bitian_Arry='$bitian_Arry'  Wuchongfu_Arry='$Wuchongfu_Arry'  onclick=alert('您无修改权限')  style='width:85%'  />\";\n"; //确定按钮

        $Htmlcache .= '};' . "\n";
        $Htmlcache .= "echo\"<input type='hidden' name='re_id' value='{$re_id}' />\";\n"; //re_id值
        $Htmlcache .= "echo\"<input type='hidden' name='strmk_id' value=" . '\'$strmk_id\'' . "/>\";\n"; //$strmk_id	
        //$Htmlcache.= "echo\"<input type='hidden' name='bitian_Arry' value=".$bitian_Arry."/>\";\n" ;    //必填
        //$Htmlcache.= "echo\"<input type='hidden' name='Wuchongfu_Arry' value=".$Wuchongfu_Arry."/>\";\n" ;    //无重复


        $Htmlcache .= "echo\"<font id='editsuccess' class='font_red'></font></li></ul></br></br></div></form>\";" . "\n";

        //========================================================================================以下为菜单显示
        //$Htmlcache .= "echo\"<script>guanximenucopy_mobile('$ToHtmlID');YanZhen_ChongFu_ZuLoad(" . '$strmk_id' . ",'$Wuchongfu_Arry','$databiao','$ToHtmlID','#addbox');$('#$ToHtmlID #addbox #post_form').attr({'tit':'$bitian_Arry','strmk_id':'" . '$strmk_id' . "'});</script>\n\n";
        $Htmlcache .= "echo\"" . "\n";
        $Htmlcache_menu = $Htmlcache_edit_text = '';

        if ( $sys_banshi == 2 ) { //1数据表，2文件自动化 3其它

            $Htmlcache_menu .= "<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent',this,'$ToHtmlID')>参数设定</A>\n";
            $Htmlcache_menu .= "<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent2',this,'$ToHtmlID','368'," . '$strmk_id' . ")>模版</A>\n";
            $Htmlcache_menu .= "<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent2',this,'$ToHtmlID','368'," . '$strmk_id' . ")>文件</A>\n";
        } else {
            $Htmlcache_menu .= "<A class='selectTag' onClick=SelectTag_Menu_mobile('tagContent',this,'$ToHtmlID')>编辑</A>\n";
        }
        $nowtagcont2 = 'DeskMenuDiv' . $re_id . '_MenuDiv_368'; //这里得到tabID
        $Htmlcache_edit_text = "<A title='修改记录'  onClick=SelectTag_Menu_mobile('$nowtagcont2',this,'$ToHtmlID','368'," . '$strmk_id' . ")>E+</A>\n";
        //========================================================================================以下为显示对应的关系表。


        //========================================================================================以下为显示对应的关系表。
        $nowtagcont = $NowdatabiaoYY = $NowdatabiaoYYName = "";
        $sql2 = "select * From Sys_GuanXiBiao where sys_re_id='$re_id' and sys_huis=0";
        $rs2 = mysqli_query( $Conn2, $sql2 );
        $nowrscount = mysqli_num_rows( $rs2 ); //统计数量
        //$rs2 = mysqli_fetch_array($rs);
        if ( $nowrscount ) {
            $Htmlcache .= "<div class='moban_set_menu'>\n";
            //===================================以下为TAB菜单输出
            $Htmlcache .= $Htmlcache_menu; //加入菜单
            //$Htmlcache.= "<UL class='tabs nocopytext'>\n" ;

            //$Htmlcache .= "<A class='selectTag' onClick=SelectTag_Menu('tagContent',this,'$ToHtmlID')>编辑</A>\n";
            while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
                $nowtagid = $row2[ 'id' ]; //这里得到tabID

                $NowdatabiaoYY = Find_tablename( $row2[ 'sys_re_id_02' ] ); // 查询到表名

                $Tablename_Find_re_id = Tablename_Find_re_id( $NowdatabiaoYY ); //查到表的id值
                $NowdatabiaoYYName = Find_table_CNname( $NowdatabiaoYY );
                if ( $NowdatabiaoYYName == '' ) {
                    $NowdatabiaoYYName = $NowdatabiaoYY;
                }
                $nowtagcont = 'DeskMenuDiv' . $re_id . '_MenuDiv_' . $Tablename_Find_re_id; //这里得到tabID
                $Htmlcache .= "<A  onClick=SelectTag_Menu('$nowtagcont',this,'$ToHtmlID','$nowtagid'," . '$strmk_id' . ")>$NowdatabiaoYYName</A>\n";
            }; //while end

            $Htmlcache .= $Htmlcache_edit_text; //修改记录菜单
            $Htmlcache .= "<A onClick=GuanXi(this,'$ToHtmlID')>+</A>\n";
            //$Htmlcache.= "</UL>\n" ;
            //===================================以下为TAB菜单对应内容DiV输出
            //$Htmlcache.= "<DIV id='tagContent' class='tagContent'></DIV>" ;
            $Htmlcache .= "</div>\n";
        } else {
            $Htmlcache .= "<div class='moban_set_menu'>\n";
            //===================================以下为TAB菜单输出
            $Htmlcache .= $Htmlcache_menu; //加入菜单
            $Htmlcache .= $Htmlcache_edit_text; //修改记录菜单
            $Htmlcache .= "</div>\n\n\n"; //为空判断form_fenye('#post_form','".'$ToHtmlID'."');

            //$Htmlcache .= "<DIV id='FieldType' class='FieldType'>&nbsp;&nbsp;&nbsp;&nbsp;<font color='#F2F2F2'>没有关系表</font></DIV>"; //没有关系表
        };
        mysqli_free_result( $rs2 ); //释放内存
        //echo $Htmlcache;
        $Htmlcache .= '";' . "\n";

        $Htmlcache .= 'mysqli_close( $' . $IsConn . ' ); //关闭数据库' . "\n\n";
        //$Htmlcache.='echo("<script>edit_data_get(\'$strmk_id\', \'$ToHtmlID\',\'$hy\')</script>");'."\n";		
        $Htmlcache .= '?>';

    }

    $current_file = str_replace( "_chache.php", "", basename( __FILE__ ) ); //得到当前文件 除”_chache.php“的文件名称
    write_cache( '1', $Htmlcache, $current_file ); //生成模版
}


mysqli_close( $Conn ); //关闭数据库
//http://localhost/m/Machine_MobileV1.0/M_moban_edit_chache.php?re_id=321
?>