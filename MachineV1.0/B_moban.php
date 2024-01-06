<?php
header('Content-type: text/html; charset=utf-8');//设定本页编码
include_once '../session.php' ;
include_once 'B_quanxian.php';
include_once '../inc/Function_All.php';
include_once '../inc/B_Config.php';//执行接收参数及配置
include_once '../inc/B_conn.php';
if ( isset( $_SESSION[ 'reg_name' ] ) ) { //公司名称
	$reg_name = $_SESSION[ 'reg_name' ];
	if ( isset( $_REQUEST[ 'reg_name' ] ) ) { //REQUEST优先
		if ( $_REQUEST[ 'reg_name' ] . '1' != '1' )$reg_name = $_REQUEST[ 'reg_name' ];
	}
}

$nowloginxinxi="&nbsp;&nbsp;&nbsp;&nbsp;用户：{$reg_name}> {$const_bumenname}({$const_id_bumen}) >{$const_q_zu}({$SYS_QuanXian})>{$SYS_UserName}({$bh})";
//$SYS_QuanXian="";

if ($SYS_QuanXian.'1'=='1'){
    //echo "<font color='red'><center><br><br><br>权限提示！<br> 对不起，您未被授权！<br> 请与您上级管理员联系，以取得权限后操作！</center></font>";
     //exit;
};
  $rs=$sql=$Menu_Id_List=$Menu_checd_Id='';
  $sql='select Menu_Id_List,Menu_checd_Id From sys_top_menu where sys_yfzuid='.$hy.' and sys_id_login='.$bh;
  //echo $sql;
  $rs=mysqli_query( $Conn , $sql );
  if ($row = mysqli_fetch_array($rs)){
	 $Menu_Id_List=$row['Menu_Id_List'];     //查询到需显示的菜单清单
     $Menu_checd_Id=$row['Menu_checd_Id'];   //当前活动的菜单
  }else{
	 $Menu_Id_List='';
     $Menu_checd_Id=0;
  };
  mysqli_free_result($rs);//释放内存
 //echo $Menu_checd_Id;
  if('1'.$Menu_checd_Id=='1') $Menu_checd_Id=0;//判定选中菜单为NULL或空时显示到桌面
   
?>

<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<title></title>
	<?php 
	echo("<script>var Menu_checd_Id='$Menu_checd_Id';var nowloginxinxi='$nowloginxinxi';</script>");
	?>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<link href='../style/style.css' rel='stylesheet' type='text/css' />
<link href='../style/menuimage.css' rel='stylesheet' type='text/css' />

<script type="text/javascript" src='../js/jquery-1.8.3.min.js'  charset='utf-8'></script>
<script type="text/javascript" src='../js/jq.host.js'  charset='utf-8'></script>
<script type="text/javascript" src='../js/jq.seidfoot.js'  charset='utf-8'></script>
<script type="text/javascript" src='../js/jq.seidfootedit.js'  charset='utf-8'></script>
<script type="text/javascript" src="../js/pc_mobile.js" charset='utf-8'></script>
<script type="text/javascript" src='../js/jq.menu.js' charset='utf-8'></script>
	<script type="text/javascript" src='../js/jq.dragsort.js' charset='utf-8'></script>
<script type="text/javascript" src='../js/laydate-v5.3.1/laydate.js' charset='utf-8'></script>
<script type="text/javascript" src='../js/hztopy-min.js' charset='utf-8'></script>
    
<script type="text/javascript" src='../uploadhtml5e/js/hcfile.config-0.3.js?8'  charset='utf-8'></script>
<script type="text/javascript" src='../uploadhtml5e/js/hcfile-0.3-min.js?16'  charset='utf-8'></script>
<script type="text/javascript" src='../uploadhtml5e/js/DragDrop3.js?99'  charset='utf-8'></script>
<link rel="stylesheet" href='../uploadhtml5e/js/hcfile03.css'/>
<script type="text/javascript" src='../uploadhtml5e/js/function.js?99'  charset='utf-8'></script>
<!--

<script type="text/javascript" src='../js/jquery.hotkeys.js' charset='utf-8'></script>
!-->
<script>
var conf_jiaohu={uploadurl:"../uploadhtml5e/include/php/ajax_jiaohu.php",downurl:"../uploadhtml5e/include/php/down.php"};//上传接口
var conf={uploadurl:"../uploadhtml5e/include/php/ajax.php",downurl:"../uploadhtml5e/include/php/down.php"};//上传接口
</script>
</head>
<body bgcolor="#292929">

<script type='text/JavaScript'>
var nowloginxinxi=nowloginxinxi;//右下角用户信息
var Use_SyS_Div='DeskMenuDiv'+Menu_checd_Id;//使用哪层DIV
var WdatePicker_JS_OK=0;//日历JS
var seidfoot_edit_JS_OK=0;//添加修改JS
var hotkeys_JS_OK=0;//热键JS
var seidfoot_JS_OK=0;//footJS
var hztopy_JS_OK=0;//拼音JS
var menu_JS_OK=0;//菜单JS
var keyword_All=0;
var xiala_All=0;
$(document).ready(function(){
	//alert(Use_SyS_Div);
   DeskMenu('body',Use_SyS_Div);//生成桌面的div文件
});

//=====================================================================以下为本页使用
function DeskMenu(PartHtmlID,ToHtmlID,ShaiXuanSql){/*显示指定层*/
    
	//alert(ShaiXuanSql);
    var ToHtmlID=ToHtmlID.replace(/^Top_*/g,"");//去除以Top_字符串开头
    //alert(ToHtmlID);
    var NowToHtmlID='#'+ToHtmlID;
	//alert(NowToHtmlID);
	if(ToHtmlID=='DeskMenuDiv0'){//当为桌面时不执行以下的活动
		 callmenuDesk('menuA');
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
	if(!ShaiXuanSql){ ShaiXuanSql=''; };
	if(!huis){ huis='0'; };
    var NowToHtmlID="#"+ToHtmlID;
	//alert(NowToHtmlID);
    //-----------------------------------------------------------------//添加head头部元素
	var str=ToHtmlID.toString();
	var onlyre_id=str.substring(str.length- 5).replace(/[^0-9]/ig,"");//只得到数字re_id
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
			       +'<input type="hidden" id="sys_const_company_id" value="'+<?php echo $SYS_Company_id ?>+'"/>'     //公司id   51
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
		       + "<font id='tongji'>Data Loading times:-.--- s</font><font id='loginxinxi'>"+nowloginxinxi+"</font>";
	    nowHtml+="</div>";
	
	    nowHtml+="</div>";
	
		nowHtml+="</cc>";
	
	    //
	  
	    //-----------------------------------------------------------------//添加content_foot元素
		nowHtml+="<div id='"+ToHtmlID+"_content_foot' class='content_footbox'><ul class='heeaad nocopytext' ondblclick=Hidden_ConTent_Box(0,'"+ToHtmlID+"','#"+ToHtmlID+"_content_foot')><a class='headleft'>编辑</a><a class='overli headright'   onclick=Hidden_ConTent_Box(0,'"+ToHtmlID+"','#"+ToHtmlID+"_content_foot')><i class='fa fa-del-mini'></i></a></ul><dd class='htmlleirong'><ul id='tagContent' class='tagContent' ></ul></dd></div>";
        //-----------------------------------------------------------------//添加content_foot元素
		nowHtml+="<div  id='"+ToHtmlID+"_content_foot_02' class='content_footbox'><ul class='heeaad nocopytext' ondblclick=Hidden_ConTent_Box(0,'"+ToHtmlID+"','#"+ToHtmlID+"_content_foot_02')><div class='headleft'>编辑</div><div class='overli headright'   onclick=Hidden_ConTent_Box(0,'"+ToHtmlID+"','#"+ToHtmlID+"_content_foot_02')><i class='fa fa-del-mini'></i></div></ul><dd class='htmlleirong'><ul id='tagContent' class='tagContent' ></ul></dd></div>";
	
    	$(PartHtmlID+" "+NowToHtmlID).html(nowHtml);
	
        //alert(onlyre_id);
		//-----------------------------------------------------------------//添加foot元素
        $.post('B_moban_xiala.php', {
		    re_id: onlyre_id,
		    act: "BiaoQian_loading"
		    }, function (data) {
			var nowstart=data.indexOf('$_=nZζPξz=_$');//查询字符串位置
			//alert(nowstart);
			if(nowstart>=0){
				var NowToHtmlID=DIVHtmlID(ToHtmlID,'head');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
			    var nowdata=data;
			    if(nowdata.trim()!=''){
			       var arr=data.split('$_=nZζPξz=_$');
		           $.each(arr,function(index,j){
		               nowval=arr[index]; //
				       //alert(nowval);
				       var arr2=nowval.split('====');
				       nowzd=arr2[0];
				       nowzdvalue=arr2[1];
				       NowToHtmlID.find('#'+nowzd).val(nowzdvalue);                           //
				       //alert(nowzd+nowzdvalue);
	               });
			    }
			}
			
			
			List_Head_Get(ToHtmlID);      //加载表头
			TONGJI_search(this,ToHtmlID); //搜索统计    
			//LoodingDiv(ToHtmlID);       //Loading
            ListGet(ToHtmlID);            //中间数据
			List_Page_Get(ToHtmlID);      //分页数据
	    });	
	
}

</script>

<div id='DeskMenuDiv0' class='ConTentATO'><span></br>Loading...</span><div class="logodesk"><img src="../images/logo-sqp-mini.png" /></div></div>

  <!-- 添加层|编辑层 -->
<div id='addbox' class="menufootbox" style="z-index:399;width:100%;">
	<ul class='heeaad nocopytext' onDblClick="hiddenbox(30,Use_SyS_Div);maxcontheight(Use_SyS_Div);">
		<a class="headleft">编辑</a>
		<a class='headright' onClick="hiddenbox(30,Use_SyS_Div);maxcontheight(Use_SyS_Div);">&nbsp;<i class='fa fa-del-mini'></i>&nbsp;</a>
	</ul>
	<dd class="htmlleirong"><ul id="tagContent" class="tagContent" ></ul> </dd>
</div>


<script>

</script>
</body>
</html>