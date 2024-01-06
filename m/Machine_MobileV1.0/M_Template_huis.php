<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Template_Set.php'; //连上参数设定

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
    <div id="header"> <a href="<?php echo $phpstart ?>.php" class="home"></a> <em class="eleft"><?php echo $textsname ?> [回收站]</em> <a href="#" onclick="$('#wrapper .rightmenu').toggle(300)" class="siteMap"></a><a href="#" onClick="SearchToggle(this)" class="search"></a> </div>
    <div class="topsearchmenu">
        <tm class='left'  onClick="SearchToggle(this)"><i class='fa fa-19-3'></i></tm>
        <input type='text'  name='keyword' id='keyword'  placeholder="<?php echo $textsname ?>" class='addboxinput inputfocus'  value='<?php echo $nowkeyword ?>'    onkeydown="if(event.keyCode == 13){return false;}" />
        <tm class='right' onclick='SearchGet("list","1","<?php echo $phpstart ?>")'><i class='fa fa-search2'></i></tm>
    </div>
    <div class="rightmenu">
        <ul>
            <li onClick="editmore()"><a href="#">
                <tm>01</tm>
                批量编辑<font class="hui"> . Batch Edit</font></a></li>
            <!-- 
            <li><a href="#">
                <tm>02</tm>
                表单设计<font class="hui"> . Table Design</font></a></li>
            !-->
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
        <li class='widd' onclick='DelToHuishou_mobile("dels_huis","<?php echo $tablename  ?>","1","<?php echo $phpstart ?>")'><a href="#" class="menu site8">恢复</a></li>
        <!--  批量编辑菜单底部  ！-->
        <li class='widd' onclick='DelToHuishou_mobile("dels_true","<?php echo $tablename  ?>","1","<?php echo $phpstart ?>)'><a href="#" class="menu site9">彻删</a></li>
        <li class='widd' onclick='editmore()'><a href="#" class="menu site7">退出</a></li>
    </div>
    <?php include_once( 'M_foot.php' );?>
    <?php include_once( 'M_bottom.php' );?>
</div>
</body>
</html>
<script type="text/javascript" src="../../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../../js/jq.host_mobile.js"></script>
<script type='text/JavaScript'>
    $(document).ready(function(){
	SearchGet('list','1','<?php echo $phpstart ?>');
});
</script>