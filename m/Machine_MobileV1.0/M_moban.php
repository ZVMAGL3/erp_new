<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once '../../inc/Function_All.php'; //
include_once '../../inc/B_Config.php'; //执行接收参数及配置
include_once '../../inc/B_conn.php'; //注册数据库
//include_once '../../inc/B_connadmin.php';       //连上注册数据库
//include_once 'M_cache_read.php';                       //自动缓存
//------------------------------------------------------------------------//文件编号获取
$wjbh = '';
//echo $re_id;
global $hy, $re_id, $nowgsbh, $const_jlbhzt, $Conn;
$nowjlbhzt = $const_jlbhzt; //公司编号字头
if ( $nowjlbhzt <> '' )$nowjlbhzt = $nowjlbhzt . '-';
if ( $nowgsbh <> '' )$nowgsbh2 = $nowgsbh . '.';
$sql = "select id,sys_card,startdate,beizhu,banben,xiugaicishu From `sys_jlmb` where `id`='$re_id'";
$rs = mysqli_query( $Conn, $sql );
if ( $row = mysqli_fetch_array( $rs ) ) {
    $r_banben = $row[ 'banben' ];
    if ( '1' . $r_banben == '1' )$r_banben = 'A';
    $r_xiugaicishu = $row[ 'xiugaicishu' ];
    if ( '1' . $r_xiugaicishu == '1' )$r_xiugaicishu = 0;
    if ( $r_banben <> '' )$r_banben = '-' . $r_banben;
    $r_card = $row[ 'sys_card' ];
    $r_startdate = $row[ 'startdate' ];
    //$r_beizhu=$row['beizhu'];
};
$wjbh = "" . $nowgsbh2 . $nowjlbhzt . $re_id . $r_banben . "/" . $r_xiugaicishu . "&nbsp;<font>" . $r_card . "&nbsp;" . $r_startdate . "</font>";
//echo ("<i class='fa fa-arrow-circle-right fa-fw'>&nbsp;</i>");
//return($wjbh);
//echo( $wjbh );
mysqli_free_result( $rs ); //释放内存
mysqli_close( $Conn ); //关闭数据库
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width,user-scalable=0,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="format-detection" content="telephone=no"/>
<title>SQP Certificate Mobile</title>
<link href="theme/style.css" rel="stylesheet" type="text/css"/>
<link href='../../style/menuimage.css' rel='stylesheet' type='text/css' />
</head>

<body id='<?php echo $ToHtmlID ?>'>
<div id="wrapper" >
    <div id="header"> <a href="javascript:history.go(-1)" class="home"></a> <em class="eleft"><?php echo $wjbh ?></em> <a href="M_right_menu.php" class="siteMap"></a> </div>
    <div id="index" class='indexlist'>
        <input type="hidden" id="sys_const_company_id" value="<?php echo $SYS_Company_id ?>"/>
        <input type="hidden" id="sys_const_hy" value="<?php echo $hy ?>"/>
        <input type="hidden" id="sys_const_bh" value="<?php echo $bh ?>"/>
        <input type="hidden" id="const_now_login" value="<?php echo $SYS_UserName ?>"/>
        <input type="hidden" id="sys_const_pagetype" value="listpage"/>
        <input type="hidden" id="sys_const_qx" value="1"/>
        <input type="hidden" id="sys_const_re_id" value="<?php echo $re_id ?>"/>
        <input type="hidden" id="sys_const_big_id" value="0"/>
        <input type="hidden" id="sys_const_px_name" value="id"/>
        <input type="hidden" id="sys_const_pxv" value="Desc"/>
        <input type="hidden" id="sys_const_pok" value="0"/>
        <input type="hidden" id="sys_const_s_h" value="0"/>
        <input type="hidden" id="sys_const_q_h" value="0"/>
        <input type="hidden" id="sys_const_c_ok" value="0"/>
        <input type="hidden" id="sys_const_b_ok" value="0"/>
        <input type="hidden" id="sys_const_C_xu_now" value="0"/>
        <input type="hidden" id="zu" value="0"/>
        <input type="hidden" id="zd" value="0"/>
        <div id="catalog">
            <ul>
            </ul>
        </div>
        <div class='mask_lood'>
            <div class='mask_lood_center'><i class='fa fa-loading'></i><br/>
                <br/>
                Data Loading...<br/>
                <br/>
            </div>
        </div>
        <div class='fenyeimenu'>
            <dd id='loadingtimes' style='width:50px;text-align: left;padding-left: 12px;float:left'>0.00ms</dd>
            <dd id='page_count' style='width:50px;text-align: left;padding: 0px;float:right'>0</dd>
            <dd style='width:20px;text-align: center;padding: 0px;float:right'>of</dd>
            <dd style=width:58px;float:right>
                <input tabindex='-1' id='page_v' name='page_v' cs='' pgc='' type='text'  class='gopagesoubox inputfocus' value='0' onfocus="$(this).attr('cs',$(this).val())" onKeyUp="duibi_mobile($(this).attr('cs'),$(this).attr('pgc'),this,'<?php echo $ToHtmlID ?>');looddata(9,'<?php echo $ToHtmlID ?>')"  onafterpaste="this.value=this.value.replace(/\D/g,'');" />
                <input tabindex='-1' type='hidden' id='page_c' value='1'>
            </dd>
            <dd style='width:40px;text-align: center;padding: 0px;float:right'>page</dd>
            <dd id='record_count' style='width:100px;text-align: right;padding-right: 5px;float:right'>Σ:0</dd>
            <dd id='moban_foot' style='width:0px;float:right'><img src='../../images/055.gif'/></dd>
        </div>
        
        <!-- 添加层|编辑层 -->
        <div id='addbox' class="addmenu addmenu_menu" style="z-index:399;">
            <ul class='head nocopytext' onDblClick="Closebox_mobile(this,'#addbox','<?php echo $ToHtmlID ?>')">
                <div class="headleft"></div>
                <a id='closeaddbox' class='headright font_hui' onClick="Closebox_mobile(this,'#addbox','<?php echo $ToHtmlID ?>')">&nbsp;<i class='fa fa-del-mini'></i>&nbsp;</a>
            </ul>
            <dd class="htmlleirong">
                <ul id="tagContent" class="tagContent" >
                </ul>
            </dd>
        </div>
        <div id='moban_set'> 
            <!-- 其它菜单 【导稿条】-->
            <div class="addmenu addmenu_menu" id='addmenu03'>
                
                <a href="#" class="floatleft" style="width:12%;left:25px;height: 50px;line-height: 50px">
                <dd style="width:35px;padding-left: 15px; padding-right:15px; height: 50px;line-height: 50px" onClick="search_on('#addmenu01','<?php echo $ToHtmlID ?>')"><i class='fa fa-fanhui-02'></i></dd>
                </a>
                
                <a  style="width: 100%;">
                <dd id='set' style="width: 60px" class='font_hui' onClick="Set_Mobile('<?php echo $ToHtmlID ?>')"><i class='fa fa-sitting-chilun'></i>Set</dd>
                <dd id='del01' style="width: 60px" class='font_hui' onClick="Del_To_Huishou_mobile('<?php echo $ToHtmlID ?>')"><i class='fa fa-del-mini'></i>删除</dd>
                <dd id='zhuanyi01' style="width: 60px" class='font_hui'><i class='fa fa-edit'></i>转移</dd>
                <dd id='xuanzhe' style="width: 60px" class='font_hui'>
                    <label><i class='fa fa-21-1'></i>
                        <input id='chkall' name='chkall' type='checkbox' value='select' accesskey='ctrl+a' style='display: none'  onClick="selectGroup_mobile(this);"/>
                        选择</label>
                </dd>
                </a> </div>
            <!-- 搜索【导稿条】 -->
            <div class="addmenu addmenu_menu" id='addmenu02'> <a href="#" class="floatleft">
                <dd style="width:100%"  onClick="search_on('#addmenu01','<?php echo $ToHtmlID ?>')"><i class='fa fa-fanhui-02'></i></dd>
                </a> <a style="width: 83%;">
                <div id='searchbox' class='searchbox nocopytext'>
                    
                    <input id='keyword' type='text'  nothis='nothis' onfocus='$(this).next().show()'  onKeyUp="keyup_mobile('.button_img') " />
                    <div class='button_img overli' onClick="searchenter_mobile('<?php echo $ToHtmlID ?>')"><i class='fa fa-search'></i></div>
                    <div id='xiala'>
                        <ul class='xialatext' onClick="xiala_menu_Get_mobile('<?php echo $ToHtmlID ?>')">
                            所有分类
                        </ul>
                        <div id='sousuoxiala' class='sousuoxiala menu_div'>下拉内容</div>
                    </div>
                </div>
                </a> </div>
            <!-- 主菜单【导稿条】 -->
            <div class="addmenu addmenu_menu" id='addmenu01'> <a  class="floatleft"  onClick="add_data_mobile('<?php echo $ToHtmlID ?>')">
                <dd><i class='fa fa-add'></i></dd>
                </a> <a   class="list">
                <dd id='search02' style="width: 40px" title='搜索' class='font_hui' onClick="search_on('#addmenu02','<?php echo $ToHtmlID ?>')"><i class='fa fa-search2'></i></dd>
                <dd id='line2' style="width: 3px"  class='font_hui'>&nbsp;</dd>
                <dd id='pagenaxt8' style="width: 40px" title='Last' onclick="FpageRO(this,'#page_c',0,'<?php echo $ToHtmlID ?>')" class='overli font_liang'><i class='fa fa-last'></i></dd>
                <dd id='pagenaxt7' style='display:none;width: 40px' title='Last' class='font_hui'><i class='fa fa-last-h'></i></dd>
                <dd id='pagenaxt6' style='display:none;width: 40px' title='Next' onclick="FpageRO(this,'#page_v',1,'<?php echo $ToHtmlID ?>')" class='overli font_liang'><i class='fa fa-next'></i></dd>
                <dd id='pagenaxt5' style="width: 40px" title='Next' class='font_hui'><i class='fa fa-next-h'></i></dd>
                <dd id='pagenaxt4' style="width: 40px" title='prev' class='font_hui'><i class='fa fa-prev-h'></i></dd>
                <dd id='pagenaxt3' style='display:none;width: 40px' title='prev' onclick="FpageRO(this,'#page_v',-1,'<?php echo $ToHtmlID ?>');" class='overli font_liang'><i class='fa fa-prev'></i></dd>
                <dd id='pagenaxt2' style="width: 40px" title='First' class='font_hui'><i class='fa fa-first-h'></i></dd>
                <dd id='pagenaxt1' style='display:none;width: 40px' title='First' onclick="Fpage(1,0,'<?php echo $ToHtmlID ?>');" class='overli font_liang'><i class='fa fa-first'></i></dd>
                </a> <a  class="floatright"  onClick="search_on('#addmenu03','<?php echo $ToHtmlID ?>');">
                <dd id='more' title='more' class='font_hui'><i class='fa fa-7-4'></i></dd>
                </a> </div>
        </div>
    </div>
    <?php include_once( 'M_foot.php' );?>
    <?php include_once( 'M_bottom.php' );?>
</div>
</body>
</html>
<script type="text/javascript" src="../../js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="../../js/jq.host_mobile.js"></script>
<script type="text/javascript" src="../../js/pc_mobile.js"></script>
<script type='text/JavaScript'>
	var hztopy_JS_OK=0;//拼音JS
	$(document).ready(function(){
	     DeskMenu('<?php echo $ToHtmlID ?>');    //这里加载数据
	});
	
	//=====================================================================以下为本页使用
function DeskMenu(ToHtmlID){/*显示指定层*/
    //alert(ToHtmlID);
	  //alert(PartHtmlID);
    
      ListGet_mobile(ToHtmlID);                                        //中间数据
      List_Page_Get_mobile(ToHtmlID);                                  //分页数据
	
	}
     
</script>