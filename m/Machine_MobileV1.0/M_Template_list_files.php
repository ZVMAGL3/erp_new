<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Template_list_files_Set.php'; //连上参数设定
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

<body>
<div id="wrapper">
    <div id="header"> <a href="M_Template_terms.php?id=<?php echo $parent_id ?>" class="home"></a> <em class="eleft"><?php echo $textsname ?></em> <a href="#" onclick="$('#wrapper .rightmenu').toggle(300)" class="siteMap"></a><a href="#" onClick="SearchToggle(this)" class="search"></a> <a class="add" onclick="$('#wrapper .upfiles').toggle(300)" ></a> </div>
    <div class="topsearchmenu">
        <tm class='left'  onClick="SearchToggle(this)"><i class='fa fa-19-3'></i></tm>
        <input type='text'  name='keyword' id='keyword'  placeholder="<?php echo $textsname ?>" class='addboxinput inputfocus'  value='<?php echo $nowkeyword ?>'    onkeydown="if(event.keyCode == 13){return false;}" />
        <tm class='right' onclick='SearchGet("list","0","<?php echo $phpstart ?>","","<?php echo $parent_id ?>")'><i class='fa fa-search2'></i></tm>
    </div>

    <!--  上传文件框 ！-->
    <div class="upfiles">
        <ul>
            <li> 
                
                <font class="upmenu"  id='add_moban_weizhi_1'>上传文件</font>
				
			</li>
 
            <li><div id="add_moban_panel_1"></div></li>
            <li onclick="$('#wrapper .upfiles').hide(300);"><a>
                <tm>&nbsp;</tm>
                关闭<font class="hui"> . close</font></a></li>
        </ul>
    </div>
    
    <!--  右边设定菜单 头部  ！-->
    <div class="rightmenu">
        <ul>
            <li><a href="#"  onClick="editmore()">
                <tm>01</tm>
                批量编辑<font class="hui"> . Batch Edit</font></a></li>
            <!-- 
            <li><a href="#">
                <tm>02</tm>
                表单设计<font class="hui"> . Table Design</font></a></li>
            !-->
            <li><a href="<?php echo $phpstart ?>_huis.php?parent_id=<?php echo $parent_id ?>">
                <tm>03</tm>
                回收站<font class="hui"> . Recycle Bin</font> </a></li>
            <li onclick="$('#wrapper .rightmenu').hide(300);"><a href="#">
                <tm>&nbsp;</tm>
                关闭<font class="hui"> . close</font></a></li>
        </ul>
    </div>
    <div id="index">
        <div id="catalog"  class='height100'> 
            <!--<ul class='topheight'> &nbsp; </ul>!-->
            <ul>
                loading...
            </ul>
        </div>
    </div>
    <!--  批量编辑菜单底部  ！-->
    <div  class="foot topedit_menu_foot" style="height: 55px;line-height: 55px;">
        <li class='widd' onclick='selectGroup_mobile(this)'><a href="#" class="menu site5">全选</a></li>
        <li class='widd' onclick='DelToHuishou_mobile("Del_To_Huis","<?php echo $tablename  ?>","0","<?php echo $phpstart ?>","","<?php echo $parent_id ?>")'><a class="menu site6">删除</a></li>
        <!--  批量编辑菜单底部  
        <li class='widd'><a href="#" class="menu site7">回收</a></li>！-->
        <li class='widd' onclick='editmore()'><a href="#" class="menu site7">退出</a></li>
    </div>
    <?php include_once( 'M_foot.php' );?>
    <?php include_once( 'M_bottom.php' );?>
</div>
</body>
</html>
<script type="text/javascript" src="../../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../../js/jq.host_mobile.js"></script>

<script type="text/javascript" src='../../uploadhtml5e/js/hcfile.config-0.3.js?8'  charset='utf-8'></script>
<script type="text/javascript" src='../../uploadhtml5e/js/hcfile-0.3.js?16'  charset='utf-8'></script>
<script type="text/javascript" src='../../uploadhtml5e/js/DragDrop3.js?99'  charset='utf-8'></script>
<link rel="stylesheet" href='../../uploadhtml5e/js/hcfile03.css'/>
<script type="text/javascript" src='../../uploadhtml5e/js/function_moban.js?103'  charset='utf-8'></script>
<!--

<script type="text/javascript" src='../js/jquery.hotkeys.js' charset='utf-8'></script>
!-->
<style>
.myitembar{ border-bottom:solid 1px #fff;margin-bottom:0px;}
.myitembar .rel_bar{background-color:#666;}
.myitembar.hcsuccess .rel_name{color:#fff;}
.myitembar.hcsuccess .rel_del{color:#ff0000;padding-right:5px;}
</style>
<input type="hidden" id="add_moban"/>
<?php $tidno="123456";?>
<script>


 
var conf_jiaohu={uploadurl:"../../uploadhtml5e/include/php/ajax_moban_files.php",downurl:"../../uploadhtml5e/include/php/down.php"};//上传与下载接口
var tidno="<?php echo $tidno?>";   //得到文本框tidno

var baseinfo={type:"0",tidno:tidno,classid:"12","sys_Id_MenuBigClass":"<?php echo $parent_id?>","folder":"file_<?php echo $parent_id ?>"}  
createupload_jiaohu({
	    conf:conf_jiaohu
		,isfirstload:0
		,"inputid":"add_moban"
		,baseinfo:baseinfo
		,success:function(op){
 
			 var total=op.childs.length;
 
			 var successnum=0;
			 for(var i=0;i<op.childs.length;i++){
				  var child=op.childs[i];
				  var mystatus=child.getAttribute("mystatus");
				  //console.log(mystatus);
				  if(mystatus=="upload"||mystatus=="init"){
					  
				  }else{
					 successnum++; 
				  }
			 }
			 //console.log("total:"+total+",successnum:"+successnum);
			 if(successnum==total){
				 //alert(55555);
				SearchGet('list','0','<?php echo $phpstart ?>','','<?php echo $parent_id ?>');//ajax加载数据	  
			 }
		}
	});
</script>

<script type='text/JavaScript'>
$(document).ready(function(){
SearchGet('list','0','<?php echo $phpstart ?>','','<?php echo $parent_id ?>');//ajax加载数据	
});
</script>