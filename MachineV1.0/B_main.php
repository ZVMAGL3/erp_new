<?php
//header( 'Content-type: text/html; charset=utf-8' ); //设定本页编码
include_once '../session.php';
include_once './B_quanxian.php';
include_once '../inc/Function_All.php';
include_once '../inc/B_Config.php'; //执行接收参数及配置
include_once '../inc/B_conn.php';
include_once '../inc/B_connadmin.php';
if($_SESSION['logged_in']){
echo "<script>var arrProxy = [];</script>";
// $query = "
// SELECT table_name
// FROM information_schema.columns
// WHERE column_name = 'sys_yfzuid' AND table_schema = 'botelerp';
// ";
// $queryResult = $db_vip->query($query);
// while ($table_name = mysqli_fetch_assoc($queryResult['result'])['table_name'])
// {
// 	$query = "
// 		UPDATE $table_name
// 		SET sys_yfzuid = '51'
// 		WHERE sys_yfzuid = 9007;
// 	";
// 	$res = $db_vip->query($query);
// }

if ( isset( $_SESSION[ 'reg_name' ] ) ) { //公司名称
    $reg_name = $_SESSION[ 'reg_name' ];
    if ( isset( $_REQUEST[ 'reg_name' ] ) ) { //REQUEST优先
        if ( $_REQUEST[ 'reg_name' ] . '1' != '1' )$reg_name = $_REQUEST[ 'reg_name' ];
    }
}
$nowloginxinxi = "&nbsp;&nbsp;&nbsp;&nbsp;用户：{$reg_name}> {$const_bumenname}({$const_id_bumen}) >{$const_q_zu}({$SYS_QuanXian})>{$SYS_UserName}({$bh})";
//$SYS_QuanXian="";

if ( $SYS_QuanXian . '1' == '1' ) {
    //echo "<font color='red'><center><br><br><br>权限提示！<br> 对不起，您未被授权！<br> 请与您上级管理员联系，以取得权限后操作！</center></font>";
    //exit;
};
$Menu_Id_List = $Menu_checd_Id = '';

$query =  "select Menu_Id_List,Menu_checd_Id From sys_top_menu where sys_yfzuid= ? and sys_id_login= ?";
// echo $query.$hy.$bh;
$params = array($hy,$bh);
$queryResult = $db_vip->query($query, $params);
if ($queryResult['error'] == null) {
	$result = mysqli_fetch_assoc($queryResult['result']);
    $Menu_Id_List = $result[ 'Menu_Id_List' ]; //查询到需显示的菜单清单
    $Menu_checd_Id = $result[ 'Menu_checd_Id' ]; //当前活动的菜单
	
} else {
	echo $queryResult['error'];
    $Menu_Id_List = '';
    $Menu_checd_Id = 0;
};
//echo $Menu_checd_Id;
if ( '1' . $Menu_checd_Id == '1' )$Menu_checd_Id = 0; //判定选中菜单为NULL或空时显示到桌面
//echo $Menu_checd_Id;
$Use_SyS_Div = 'DeskMenuDiv' . $Menu_checd_Id; //使用哪层DIV
//echo $Use_SyS_Div;
?>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<link href='style/moban_top.css' rel='stylesheet' type='text/css'/>
<link href='../style/menuimage.css' rel='stylesheet' type='text/css' />
<link href='../style/style.css' rel='stylesheet' type='text/css' />
<script language='JavaScript' src='../js/jquery-1.8.3.min.js' type='text/javascript' charset='utf-8'></script> 
<script language='JavaScript' src='../js/jq-top.js' type='text/javascript' charset='utf-8'></script>

<script language='JavaScript' src='../js/jq.host.js' type='text/javascript' charset='utf-8'></script>

<script type="text/javascript" src="../js/pc_mobile.js" charset='utf-8'></script>
<script type="text/javascript" src='../js/jq.dragsort.js' charset='utf-8'></script>
<script language='JavaScript' src='../js/jq.seidfoot.js' type='text/javascript' charset='utf-8'></script>
<script language='JavaScript' src='../js/jq.menu.js' type='text/javascript' charset='utf-8'></script>
<script type="text/javascript" src='../js/jq.seidfootedit.js'  charset='utf-8'></script>


<script type="text/javascript" src='../js/laydate-v5.3.1/laydate.js' charset='utf-8'></script>
<script type="text/javascript" src='../js/hztopy-min.js' charset='utf-8'></script>
<script type="text/javascript" src='../uploadhtml5e/js/hcfile.config-0.3.js?8'  charset='utf-8'></script>
<script type="text/javascript" src='../uploadhtml5e/js/hcfile-0.3-min.js?16'  charset='utf-8'></script>
<script type="text/javascript" src='../uploadhtml5e/js/DragDrop3.js?99'  charset='utf-8'></script>

</head>
<body onLoad="callmenuDesk('list2',1);">

<!--头部菜单-->
<div class='topall'>
    <ul class='STYLE_fbname'>
        <img src='images/logo_white.png' alt=''/>
    </ul>
</div>
<div id='headindextop' class='nocopytext'>
    <ul onClick="PostAddTopMenu(0,'<?php echo $bh?>');Top_SelectTag($(this).attr('id'));DeskMenu('body',$(this).attr('id'));" id="Top_DeskMenuDiv0">
        <li class='overli'>桌面</li>
	</ul>
<?php

	$Htmlcache00 = '';
	$Htmlcache00 .= "<script>AddTopMenu('$Menu_Id_List');";
	if (
		'1' . $Menu_checd_Id == "1"
		or $Menu_checd_Id == 'undefined'
		or $Menu_checd_Id == 0 
	) 
	{
		$Htmlcache00 .= "Top_SelectTag('Top_DeskMenuDiv0');";
	} else {
		$Htmlcache00 .= "Top_SelectTag('Top_DeskMenuDiv$Menu_checd_Id');";
	};

	$Htmlcache00 .= "</script>";
	echo $Htmlcache00;
	//$Htmlcacheall='<?php echo"'.$Htmlcache.' ";? >';
	//echo $Htmlcache;
	//find_cache('3',$Htmlcacheall);
	?>
</div>
    
    
<div id='main_left_div'>
    <h1><img src='images/logo.png' alt=''/></h1>
    <h2>S.Q.P</h2>
    <ul class='menu'>
        <li onClick="JavaScript:ZhuoMian()"><i class="fa fa-jigou"></i>桌面</li>
        <li onClick="JavaScript:Gongsi_Edit(this)"><i class="fa fa-jigou"></i>SQPAMS</li>
        <li onClick="JavaScript:Gongsi_Edit(this)"><i class="fa fa-jigou"></i>平台系统</li>
        <!-- 
        <li onClick="JavaScript:Gongsi_Edit(this)"><i class="fa fa-jigou"></i>我的</li>
        <li onClick="JavaScript:BuMen_Edit(this)"><i class="fa fa-jigou"></i>部门</li>
        <li onClick="JavaScript:ZhiLeng_Edit(this)"><i class="fa fa-sitting-ziduan"></i>职能分配</li>
        <li onClick="JavaScript:password_Edit(this)"><i class="fa fa-8-3"></i>密码</li>
        !-->
        <li onClick="JavaScript:ZhiZheQuanXian(this)"><i class="fa fa-lock-02"></i>职权</li>
        <li onClick="JavaScript:TongXunLu_on('云账户')"><i class="fa fa-mixcloud"></i>通讯录</li>
        <li onClick="JavaScript:setparent()"><i class="fa fa-11-4"></i>设置</li>
        <li onClick="JavaScript:studyParent()"><i class="fa fa-11-4"></i>教程</li>
        <a href="../exit.php" target="_self">
        <a href="http://www.sqp-cert.com" target="_blank">
        <li><i class="fa fa-11-4"></i>官网</li>
        </a>     
        
        <li onClick="javascript:window.location.href = '../'"><i class="fa fa-poweroffclass bigi"></i>退出</li>
        </a>
    </ul>
    <ul class='menubottom'>
        <li onClick="JavaScript:Gongsi_Edit(this)" class="message"><img src='../images/msg.png' alt=''/></i></li>
        <li onClick="JavaScript:user_Edit(this)" class="userimg"><img src='../images/user_img/usertile18.gif' alt=''/></li>
    </ul>
</div>
<div id='DeskMenuDiv0' class='main_right_div ConTentATO'>
	<div class="search_box">
		<div class="search">
			<div class="search_input_box">
				<input class="search_input" placeholder="关键字"/>
				<div class="search_del"></div>
			</div>
			<div class="search_button">
			</div>
		</div>
	</div>
	<div class="main_right_div_box"></div>
</div>
<div class='set_UP'></div>
<div class='study'></div>
<div class='TongXunLu'>
	<div class='TongXunLu_Top'>
		<i class='fa fa-20-4'></i>
		<div class='TongXunLu_Name'>
			通讯录
		</div>
		<div class='TongXunLu_searchbox'>
			<!-- search -->
		</div>
		<div class="TongXunLu_search_button TongXunLu_search_button1"></div>
		<div class='TongXunLu_del_box'>
			<i class='fa fa-del-mini'></i>
		</div>
		<div class='TongXunLu_mark'></div>
		<div class="TongXunLu_search">
			<div class="TongXunLu_search_input_box">
				<input class="TongXunLu_search_input" placeholder="关键字"/>
				<div class="TongXunLu_search_del"></div>
			</div>
			<div class="TongXunLu_search_button TongXunLu_search_button2">
			</div>
		</div>
	</div>
	<div class='TongXunLu_Box'>

	</div>
</div>
</body>
<?php

	echo 
	"
		<script type='text/JavaScript'>
			$(document).ready(function(){
				//alert('$Use_SyS_Div');
				DeskMenu('body','$Use_SyS_Div');//生成桌面的div文件
			});
		</script>
	";

?>
<script type='text/JavaScript'>
	//var Use_SyS_Div=Use_SyS_Div;//使用哪层DIV
	var WdatePicker_JS_OK=0;//日历JS
	var seidfoot_edit_JS_OK=0;//添加修改JS
	var hotkeys_JS_OK=0;//热键JS
	var seidfoot_JS_OK=0;//footJS
	var hztopy_JS_OK=0;//拼音JS
	var menu_JS_OK=0;//菜单JS
	var keyword_All=0;
	var xiala_All=0;

	//=====================================================================以下为本页使用
	function DeskMenu(PartHtmlID,ToHtmlID,ShaiXuanSql){/*显示指定层*/
		// console.log(PartHtmlID,ToHtmlID,ShaiXuanSql)
		var ToHtmlID=ToHtmlID.replace(/^Top_*/g,"");//去除以Top_字符串开头
		//alert(ToHtmlID);
		//alert(ShaiXuanSql);
		var NowToHtmlID='#'+ToHtmlID;
		// alert(NowToHtmlID);
		if(ToHtmlID=='DeskMenuDiv0'){//当为桌面时不执行以下的活动
			// callmenuDesk('menuA');
		}else{
			if ($(NowToHtmlID).length<=0 && ToHtmlID!='DeskMenuDiv0'){//没有时、不是桌面时添加再加载
				$(PartHtmlID).append("<div id="+ToHtmlID+" class='ConTentATO'>loading...</div>");//在本页中插入当前内容
				DeskHtml(PartHtmlID,ToHtmlID,ShaiXuanSql);//生成头部和底部 
			}
		}
		$(PartHtmlID+" .ConTentATO").hide();//所有内容全部隐藏
		$(PartHtmlID+" #"+ToHtmlID).show();//内容页显示层//window.parent.right.
		$(PartHtmlID+" #addbox").hide();//隐藏最下边上滑菜单
		hiddenbox(0,ToHtmlID);//隐藏最下边上滑菜单
		$(NowToHtmlID).find('#footseid16,#footseid17').hide();//
	}
		
	//=====================================================================以下为本页使用
	function DeskHtml(PartHtmlID,ToHtmlID,ShaiXuanSql,huis){
		var ToHtmlID=ToHtmlID.replace(/^Top_*/g,"");//去除以Top_字符串开头
		//alert(ToHtmlID);
		if(!ShaiXuanSql){ ShaiXuanSql=''; };
		if(!huis){ huis='0'; };
		var NowToHtmlID="#"+ToHtmlID;
		//alert(NowToHtmlID);
		//-----------------------------------------------------------------//添加head头部元素
		var str=ToHtmlID.toString();
		var onlyre_id=str.substring(str.length- 5).replace(/[^0-9]/ig,"");//只得到数字re_id
		// console.log(onlyre_id)
		//var fanall_ID=str.replace(/[^0-9]/ig,"");                         //得到数字上下级re_id之合
		//alert(onlyre_id);
		//var onlyre_id=ToHtmlID.toString().substring(0,7);
		//if ($(NowToHtmlID).length<=0 && ToHtmlID!='DeskMenuDiv0'){//没有时、不是桌面时添加再加载
		var nowHtml="";
		nowHtml+="<cc class='fanall' id='"+ToHtmlID+"_fanall'>";
		nowHtml+="<div class='mask_lood' id='"+ToHtmlID+"_mask_lood'> <font class='mask_lood_center'><i class='fa fa-loading'></i><br/><br/>Data Loading...<br/><br/></font></div>";//loading层
		//-----------------------------------------------------------------head
		nowHtml+="<div class='head' id='"+ToHtmlID+"_head'>"
				+"<li>"
					+'<input type="hidden" id="sys_const_company_id" value="'+<?php echo $hy ?>+'"/>'     //公司id   51
					+'<input type="hidden" id="sys_const_id_bumen" value="0"/>'                                       //公司部门 id
					+'<input type="hidden" id="sys_const_hy" value="'+<?php echo $hy ?>+'"/>'                         //公司     9007
					+'<input type="hidden" id="sys_const_bh" value=""/>'                                              //编制人     id
					+'<input type="hidden" id="sys_const_shenpi" value=""/>'                                          //审核人     id
					+'<input type="hidden" id="sys_const_shenpi_all" value=""/>'                                      //批准人     id
					+'<input type="hidden" id="sys_const_chaosong" value=""/>'                                        //经办人     id
					+'<input type="hidden" id="sys_const_adddate" value=""/>'                                         //添加更新时间筛选
					+'<input type="hidden" id="sys_const_qx" value="1"/>'                                             //权限
					+'<input type="hidden" id="sys_const_pagetype" value="listpage"/>'                                //页面样式
					+'<input type="hidden" id="sys_const_page" value="1"/>'                                           //页码
					+'<input type="hidden" id="sys_const_re_id" value="'+onlyre_id+'"/>'                              //页面id
					+'<input type="hidden" id="sys_const_big_id" value="0"/>'                                         //大类id
					+'<input type="hidden" id="sys_const_huis" value="'+huis+'"/>'                                    //回收id
					+'<input type="hidden" id="sys_const_px_name" value="id"/>'                                       //排序字段
					+'<input type="hidden" id="sys_const_pxv" value="Desc"/>'                                         //排序规则
					+'<input type="hidden" id="sys_const_pok" value="0"/>'                                            //是否排序
					+'<input type="hidden" id="sys_const_tuodongok" value="0"/>'                                      //是否在拖动 1为拖动 0为没拖
					+'<input type="hidden" id="sys_const_s_h" value="0"/>'                                            //
					+'<input type="hidden" id="sys_const_q_h" value="0"/>'                                            //
					+'<input type="hidden" id="sys_const_c_ok" value="0"/>'                                           //
					+'<input type="hidden" id="sys_const_b_ok" value="0"/>'                                           //序
					+'<input type="hidden" id="sys_const_C_xu_now" value="0"/>'                                       //在锁定列上
					+'<input type="hidden" id="sys_const_Start_Suoding" value="0"/>'                                  //开始是否锁定列 0为非锁定列  1为在锁定列开始
					+'<input type="hidden" id="sys_const_End_Suoding" value="0"/>'                                    //结整是否锁定列 1为进入锁定列  0为退出锁定列
					+'<input type="hidden" id="sys_const_prev_zd" value=""/>'                                         //前一个字段
					+'<input type="hidden" id="sys_const_ChangePrev_zd" value=""/>'                                   //改变后前一个字段
					+'<input type="hidden" id="sys_const_ChangeNext_zd" value=""/>'                                   //改变后前一个字段
					+'<input type="hidden" id="sys_const_this_zd" value=""/>'                                         //当前字段名
					+'<input type="hidden" id="zu" value="0"/>'                                                       //分类
					+'<input type="hidden" id="zd" value="0"/>'                                                       //字段
					+'<input type="hidden" id="ShaiXuanSql" value="'+ShaiXuanSql+'"/>'                                //筛选
					+'<input type="hidden" id="ShaiXuanSql_other" value=""/>'                                         //其它筛选
					+'<input type="hidden" id="sys_const_biaoqian_id" value=""/>'                                     //使用标签id
				+"</li>"                                                                                              //
				+"<li id='wjbh' class='headwjbh'></li>"                                                               //文件编号
				//-----------------------------------------------------------------删除 添加按钮
				+"<li>"
					//----------------搜索框
					+"<div class='h_right  nocopytext'><ul id='searchbox' class='searchbox nocopytext'>"
					+"   <input id='keyword' type='text' onkeyup=\"keyths(this,'"+ToHtmlID+"',event)\" onfocus=\"xialaload(this,'"+ToHtmlID+"')\"  nothis='nothis' placeholder='关键词' autocomplete='on' /><div class='button_img overli' onclick=\"searchnow(this,'"+ToHtmlID+"')\"><i class='fa fa-search'></i></div><div onclick="+"xialashow(this,\'"+ToHtmlID+"\')"+" class='TONGJI_search overli'><i class=\"fa fa-25-02\"></i>筛选<font color=\"red\" style=\"padding-left:3px;padding-right:3px;\"><strong>(0)</strong></font></div>"
					+"</ul>"
				
					//----------------书签
					//+"  <ul><i class=\"fa fa-line\"></i></ul>"
					+"  <ul class='ShuQianMenu'><li id='0' class='overli selectTag'  onClick=\"clearsearch(this,'"+ToHtmlID+"');shuqianmenu_TOTO(this,'"+ToHtmlID+"')\" >全部</li><li class='overli'  onClick="+"shuqianmenu_TOTO(this,'"+ToHtmlID+"')"+">&nbsp;✰&nbsp;</li></ul>"
					//+"  <ul><i class=\"fa fa-line\"></i></ul>"
					//----------------添加 | 删除按钮
					+"  <ul><li onclick="+"add_data(this,'',\'"+ToHtmlID+"\')"+" class='overli'  id='footseid13'><i class='fa fa-add'></i>ADD</li>"
					+"  <li onClick="+"DelToHuishou('"+ToHtmlID+"')"+"  class='overli' id='footseid14'><i class='fa fa-del'></i>Del</li>"
					+"  <li onclick="+"Del_Really(this,\'"+ToHtmlID+"\')"+"  class='overli' id='footseid16'><i class='fa fa-del-mini'></i>销毁</li>"
					+"  <li onClick="+"Del_huisou(this,\'"+ToHtmlID+"\')"+"  class='overli' id='footseid17'><i class='fa fa-fanhui-02'></i>恢复</li>"
					+"</ul></div>"
				+"</li>"
			+"</div>";

		//-----------------------------------------------------------------添加banner数据元素
		nowHtml+="<div id='"+ToHtmlID+"_banner' class='banner nocopytext'></div>"                                                                                     //banner
				+ "<div id='"+ToHtmlID+"_banner_left'  class='banner_left nocopytext'><li style='width:6000px;border-right:1px solid #FFF'>&nbsp;loading...</li></div>" //banner_left
				+ "<div id='"+ToHtmlID+"_banner_right' class='banner_right  nocopytext' onmouseover=\"dootstart('r','"+ToHtmlID+"');\" onmouseout=\"dootstop()\"><li  class='overli'><input id='chkall' name='chkall' type='checkbox' onclick=\"selectGroup(this,'"+ToHtmlID+"')\" value='select' accesskey='ctrl+a' disabled='disabled'/></li><li>&nbsp;</li></div>";                                                                                                              //banner_right
		//-----------------------------------------------------------------添加content中间数据元素
		nowHtml+="<div id='"+ToHtmlID+"_content_ALL' class='content_ALL'  >"
				+ "    <div id='"+ToHtmlID+"_content' class='mains' onscroll=\"moveheng('"+ToHtmlID+"')\"></div>"                //content
				+ "    <div id='"+ToHtmlID+"_content_left' class='mains_left' tabindex=-1></div>"                                //content_left
				+ "    <div id='"+ToHtmlID+"_content_right' class='mains_right' tabindex=-1 onclick=\"selectit('ID')\"></div>"   //content_right
				+ "    <div id='"+ToHtmlID+"_content_right_menu' class='mains_right_menu' tabindex=-1>下拉内容</div>";            //content_right

		
		//-----------------------------------------------------------------//添加foot元素
		nowHtml+="<div id='"+ToHtmlID+"_foot' class='bottom nocopytext'><ul><li style='width:6px;'></li>"
				+ "<li id='footseid17' onclick=\""+"Del_huisou(this,'"+ToHtmlID+"');"+"\" class='overli'><i class='fa fa-fanhui-02' title='恢复数据'></i>恢复 </li>"//回收
				+ "<li id='footseid16' onclick=\""+"Del_Really(this,'"+ToHtmlID+"');"+"\" class='overli'><i class='fa fa-del-mini' title='彻底删除'></i>销毁 </li>"//彻底删除
				+ "<li id='footseid14' onclick=\""+"DelToHuishou('"+ToHtmlID+"');"+"\" class='overli' style='width:40px;font-size:11px;'><i class='fa fa-del'></i>Del</li>"//删除
				+ "<li id='footseid13' onclick="+"add_data(this,'',\'"+ToHtmlID+"\')"+" class='overli' style='width:40px;font-size:11px;'><i class='fa fa-add'></i>ADD</li>"//添加
				+ "<li><i class='fa fa-line'></i></li>"//line
		//       + "<li id='footseid18' class='footseid18' onclick=\""+"edit_Text(this,'"+ToHtmlID+"');"+"\"><img src='/images/Fugue_482.png' alt='记事本'/></li>"
				+ "<li id='footseid15' onclick=\""+"gounxiang(this,'"+ToHtmlID+"');"+"\" title='共享数据' class='overli'><i class='fa fa-mixcloud'></i></li>"
				+ "<li id='footseid12' onclick=\""+"moveto(this,'"+ToHtmlID+"');"+"\" title='批量修改数据' class='overli'><i class='fa fa-edit'></i></li>"
		//       + "<li id='footseid11' onclick=\""+"loodfoot(4,'"+ToHtmlID+"');"+"\"><img src='/images/share.gif' alt='内Q'/></li>"
				+ "<li><i class='fa fa-line'></i></li>"//line
		//       + "<li id='footseid10' onclick=\""+"loodfoot(5,'"+ToHtmlID+"');"+"\"><img src='/images/Fugue_1557.png' alt='帮助'/></li>"
				+ "<li id='footseid9'  onclick=\""+"moban_set_edit(this,'"+ToHtmlID+"');"+"\" title='设定' class='overli'><i class='fa fa-sitting'></i></li>"
				+ "<li id='footseid8' onclick=\""+"loodfoot(7,'"+ToHtmlID+"');"+"\" title='锁定' class='overli'><i class='fa fa-lock'></i></li>"
				+ "<li id='footseid7' onclick=\""+"loodfoot(8,'"+ToHtmlID+"');"+"\" title='统计数据' class='overli'><i class='fa fa-tongji'></i></li>"
				+ "<li><i class='fa fa-line'></i></li>"//line
				+ "<li id='footseid5' onclick=\""+"loodfoot(10,'"+ToHtmlID+"');"+"\" title='导出为EXCEL' class='overli'><i class='fa fa-excel'></i></li>"
				+ "<li id='footseid4' onclick=\""+"loodfoot(11,'"+ToHtmlID+"');"+"\" title='导出为PDF' class='overli'><i class='fa fa-pdf'></i></li>"
				+ "<li id='footseid3' onclick=\""+"HuiSouZhan_MENU('HUIS_"+ToHtmlID+"',this,'"+ToHtmlID+"');"+"\" title='回收' class='overli'><i class='fa fa-trash'></i></li>"
				+ "<li id='footseid2' onclick=\""+"loodfoot(13,'"+ToHtmlID+"');"+"\" title='打印' class='overli'><i class='fa fa-print'></i></li>"
				+ "<li id='footseid1' title='刷新' class='overli' onclick=\""+"LoodingDiv('"+ToHtmlID+"');"+"ListGet('"+ToHtmlID+"');"+"\"><i class='fa fa-shuaxin'></i></li>"
				+ "<li class='xian'><i class='fa fa-line'></i></li>"//line
				+ "<li id='pagenaxt8' style='display:none;' title='Last' onclick=\""+"FpageRO(this,'#page_c',0,'"+ToHtmlID+"')"+"\" class='overli'><i class='fa fa-last'></i></li>"//
				+ "<li id='pagenaxt7' class='font_hui' title='Last'><i class='fa fa-last-h'></i></li>"                                                                             //灰

				+ "<li id='pagenaxt6' style='display:none;' title='Next' onclick=\""+"FpageRO(this,'#page_v',1,'"+ToHtmlID+"');"+"\" class='overli '><i class='fa fa-next'></i></li>"
				+ "<li id='pagenaxt5' title='Next' class='font_hui'><i class='fa fa-next-h'></i></li>"

				+ "<li id='pagenaxt4' title='prev' class='font_hui'><i class='fa fa-prev-h'></i></li>"                                                                            //灰
				+ "<li id='pagenaxt3' style='display:none;' title='prev' onclick=\""+"FpageRO(this,'#page_v',-1,'"+ToHtmlID+"');"+"\" class='overli '><i class='fa fa-prev'></i></li>"

				+ "<li id='pagenaxt2' title='First' class='font_hui'><i class='fa fa-first-h'></i></li>"
				+ "<li id='pagenaxt1' style='display:none;' title='First' onclick=\""+"Fpage(1,0,'"+ToHtmlID+"');"+"\" class='overli '><i class='fa fa-first'></i></li>"
				+ "<li><i class='fa fa-line'></i></li>"                                                                                                                           //line

				+ "<li id='page_count'>0</li>"                                                                                                                                    //这里为页码区
				+ "<li>page&nbsp;<input tabindex='-1' id='page_v' name='page_v' cs='' pgc='' title='回车键执行' type='text'  class='gopagesoubox inputfocus' value='0' onfocus=\""+"$(this).attr('cs',$(this).val())"+"\" onKeyUp=\""+"duibi($(this).attr('cs'),$(this).attr('pgc'),this);looddata(9,'"+ToHtmlID+"')"+"\"  onafterpaste=\""+"this.value=this.value.replace(/\D/g,'');"+"\">of&nbsp;<input tabindex='-1' type='hidden' id='page_c' value='1'></li>"
				+ "<li>&nbsp;<i class='fa fa-line'></i>&nbsp;</li>"
				+ "<li id='record_count'>Σ:0</li>"                                                                                                                                //页码结束

				+ "<li id='moban_foot'><img src='images/055.gif'/></li><li>&nbsp;</li>"
				+ "</ul>"
				+ "<font id='tongji'>Data Loading times:-.--- s</font><font id='loginxinxi'></font>";
		nowHtml+="</div>";
		nowHtml+="</div>";
		nowHtml+="</cc>";
		//
		
		//-----------------------------------------------------------------//添加content_foot元素
		nowHtml+="<div id='"+ToHtmlID+"_content_foot' class='content_footbox'><ul class='heeaad nocopytext' ondblclick=Hidden_ConTent_Box(0,'"+ToHtmlID+"','#"+ToHtmlID+"_content_foot')><a class='headleft'>编辑</a><a class='overli headright'   onclick=Hidden_ConTent_Box(0,'"+ToHtmlID+"','#"+ToHtmlID+"_content_foot')><i class='fa fa-del-mini'></i></a></ul><dd class='htmlleirong'><ul id='tagContent' class='tagContent' ></ul></dd></div>";
		//-----------------------------------------------------------------//添加content_foot元素
		nowHtml+="<div  id='"+ToHtmlID+"_content_foot_02' class='content_footbox'><ul class='heeaad nocopytext' ondblclick=Hidden_ConTent_Box(0,'"+ToHtmlID+"','#"+ToHtmlID+"_content_foot_02')><div class='headleft'>编辑</div><div class='overli headright'   onclick=Hidden_ConTent_Box(0,'"+ToHtmlID+"','#"+ToHtmlID+"_content_foot_02')><i class='fa fa-del-mini'></i></div></ul><dd class='htmlleirong'><ul id='tagContent' class='tagContent' ></ul></dd></div>";

		$(PartHtmlID+" "+NowToHtmlID).html(nowHtml);

		// console.log(ToHtmlID);
		//-----------------------------------------------------------------//添加foot元素
		$.post('B_moban_xiala.php', {
			re_id: onlyre_id,
			act: "BiaoQian_loading"
		}, function (data) {
			// console.log(data)
			var nowstart=data.indexOf('$_=nZζPξz=_$');//查询字符串位置
			//alert(nowstart);
			if(nowstart>=0){
				var NowToHtmlID=DIVHtmlID(ToHtmlID,'head');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
				// console.log(NowToHtmlID);
				// var NowToHtmlID=''+re_id;
				var nowdata=data;
				if(nowdata.trim()!=''){
				var arr=data.split('$_=nZζPξz=_$');
				$.each(arr,function(index,j){
					nowval=arr[index]; //
					//alert(nowval);
					var arr2=nowval.split('====');
					nowzd=arr2[0];
					nowzdvalue=arr2[1];
					NowToHtmlID.find('#'+nowzd).val(nowzdvalue);
					//alert(nowzd+nowzdvalue);
				});
				}
			}
			
			List_Head_Get(ToHtmlID);      	//加载表头
			TONGJI_search(ToHtmlID); 		//搜索统计    
			//LoodingDiv(ToHtmlID);       	//Loading
			ListGet(ToHtmlID);            	//中间数据
			List_Page_Get(ToHtmlID);      	//分页数据
		});	
			
	}
</script>


<link rel="stylesheet" href='../uploadhtml5e/js/hcfile03.css'/>
<script type="text/javascript" src='../uploadhtml5e/js/function.js?99'  charset='utf-8'></script> 
<script charset="utf-8" src="../../js/kindeditor-master/kindeditor-all.js"></script>
<script charset="utf-8" src="../../js/kindeditor-master/lang/zh-CN.js"></script>
<!--
<script type="text/javascript" src='../js/jquery.hotkeys.js' charset='utf-8'></script>
!--> 
<script>
	var conf_jiaohu={uploadurl:"../uploadhtml5e/include/php/ajax_jiaohu.php",downurl:"../uploadhtml5e/include/php/down.php"};//上传接口
	var conf={uploadurl:"../uploadhtml5e/include/php/ajax.php",downurl:"../uploadhtml5e/include/php/down.php"};//上传接口
	window.addEventListener('load', function() {
		// 在 DOM 渲染完成后执行以下代码
		var script = document.createElement('script');
		script.src = 'https://code.iconify.design/1/1.0.7/iconify.min.js'; // Iconify 库的路径
		document.head.appendChild(script);
		TongXunLu_data('')
		$('.search_button').on('click',function(){
			tagSearch()
		})
		$('.search_input').on('keydown',function(){
			if (event.which === 13) {
				tagSearch()
    		}
		})
		$('.search_del').on('click',function(){
			$('.search_input').val('')
			tagSearch()
		})
		$('.TongXunLu_del_box').on('click',function(){
			$('.TongXunLu').hide(100)

			// tagSearch()
		})
		$('.TongXunLu_search_input').on('keydown',function(){
			if (event.which === 13) {
				// tagSearch()
    		}
		})
		$('.TongXunLu_search_del').on('click',function(){
			$('.TongXunLu_search_input').val('')
			// tagSearch()
		})
		$('.TongXunLu_search_button1').on('click',function(){
			$('.TongXunLu_search').css({
				'right':'2%'
			})
			$('.TongXunLu_mark').css({
				'display':'block'
			})
		})
		$('.TongXunLu_search_input').on('change',()=>{
			TongXunLu_data($('.TongXunLu_search_input').val())
		})
		$('.TongXunLu_search_button2').on('click',function(){
			TongXunLu_data($('.TongXunLu_search_input').val())
		})
		$('.TongXunLu_mark').on('click',function(){
			$('.TongXunLu_search').css({
				'right':'-65%'		
			})
			$('.TongXunLu_mark').css({
				'display':'none'
			})
		})

	});
	function tagSearch(){
		callmenuDesk('list2',1,$('.search_input').val(),function(){
			childNavbarBackground(arrProxy)
			$('.childNavbar').on('click',function(){
				childNavbarClick($(this))
			})
		})
	}
	let set_UP = false
	function setparent(){
		// console.log(12)
		if(set_UP){
			$('.set_UP').show()
		}else{
			set_UP = true
			$.post('../m/Machine_MobileV1.0/set_UP.php',{},function(responseHtml){
				$('.set_UP').replaceWith(responseHtml)
			})
		}
	}

	// let study = false
	function studyParent(){
		window.location.href = 'study.php'
	}
	//修改已添加选项的背景色
	var arr = '<?php echo $Menu_Id_List ?>'.split(',');
	var arrProxy = new Proxy([], {
		// 拦截数组元素的 push 操作
		set: function(target, property, value) {
			// 在数组元素被赋值时触发的处理函数
			if(property == 'length'){
				childNavbarBackground(arrProxy)
			}
			// console.log(target, property, value)

			target[property] = value; // 更新数组元素的值
			
			return true;
		}
	});
	setTimeout(() => {
		if(arr[0]){
			$.each(arr, function (key, val) {
				arrProxy.push( val.split('_')[1]);
			})
		}

		$('.childNavbar').on('click',function(){
			childNavbarClick($(this))
		})
	},200)	
	function ZhuoMian(){
		$('.TongXunLu').hide(100)
	}
	function childNavbarClick(ths){
		var val = ths.text()
		if(!arrProxy.includes(val)){
			arrProxy.push(val)
		}
	}
	function childNavbarBackground(arrayx){
		$('.childNavbar').each(function() {
			// 检查文本值是否存在于数组 arr 中
			if (arrayx.includes($(this).text())) {
				// 如果存在，改变背景色为红色（或者你想要的颜色）
				$(this).css({
					'background-color':'#60d0ff',
					'color':'#fff'
				});
			}else{
				$(this).css({
					'background-color':'#fff',
					'color':'#000'
				});
			}
		});
	}

	function TongXunLu_data(keyword = ''){
		$.post('../m/Machine_MobileV1.0/M_addressBook.php',{act:'list',keyword},function(data){
			// console.log(data)
			// console.log($(data).get())
			$('.TongXunLu_box').html(data)
		})
	}
	
	function TongXunLu_on(){

		$('.TongXunLu').show(100).css({
			'display':'flex'
		})

	}

	function chatOn(id){
		$.post('../m/Machine_MobileV1.0/M_addressBook.php',{act:'list2',id},function(data){
			console.log(data)
			// console.log($(data).get())
			// $('.TongXunLu_box').html(data)
		})
	}


</script> 
<style>
</style>

</html>
<?php
}else{
	header( "Location:/index.php" ); //这里打开后台界面	
}
?>