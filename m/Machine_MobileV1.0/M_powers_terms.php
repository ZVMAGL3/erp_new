<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_powers_terms_Set.php'; //连上参数设定
//================================================================以下为参数设定
//echo "<br><br>".$phpstart;
//echo "<br><br><br><br>".$id ;
//---------------------------------------------------------------------得到职位名称
$sql = $rs = $listdata = '';
$sql = "select id,zu From `msc_zhiwei` where id='$parent_id'  order by id Asc";
$rs = mysqli_query( $Connadmin, $sql );
$row = mysqli_fetch_array( $rs );
$zu = $row[ 'zu' ]; //标准名称
mysqli_free_result( $rs ); //释放内存
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
    <div id="header"> <a href="M_powers.php?id=<?php echo $parent_id ?>" class="home"></a> <em class="eleft">职权 -> <?php echo $zu ?> </em> <a href="#" onclick="$('#wrapper .rightmenu').toggle(300)" class="siteMap"></a><a href="#" onClick="SearchToggle(this)" class="search"></a> </div>
    <div class="topsearchmenu">
        <tm class='left'  onClick="SearchToggle(this)"><i class='fa fa-19-3'></i></tm>
        <input type='text'  name='keyword' id='keyword'  placeholder="<?php echo $textsname ?>" class='addboxinput inputfocus'  value='<?php echo $nowkeyword ?>'    onkeydown="if(event.keyCode == 13){return false;}" />
        <tm class='right' onclick='SearchGet("list","0","<?php echo $phpstart ?>","<?php echo $id ?>","<?php echo $parent_id ?>")'><i class='fa fa-search2'></i></tm>
    </div>
    <!--  编辑菜单头部  
    <div class="topedit_menu">
        <ul>
            <li><a href="#">
                <tm class='left'  onClick="#">全选</tm>
                <tm class='right' onclick="#">退出编辑</tm>
                </a></li>
        </ul>
    </div>
    ！--> 
    <!--  右边设定菜单 头部  ！-->
    <div class="rightmenu">
        <ul>
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
    <?php include_once( 'M_foot.php' );?>
    <?php include_once( 'M_bottom.php' );?>
</div>
</body>
</html>
<script type="text/javascript" src="../../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../../js/jq.host_mobile.js"></script>
<script type='text/JavaScript'>
    $(document).ready(function(){
        SearchGet('list','0','<?php echo $phpstart ?>','<?php echo $id ?>','<?php echo $parent_id ?>');
    });
</script>