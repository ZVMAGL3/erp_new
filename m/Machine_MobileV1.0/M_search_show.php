<?php
include_once( '../data/conn.php' );
include_once( '../include/function.php' );
$nowid = $page = $parent_id = $reg_id = 0;

//if ( isset( $_REQUEST[ 'id' ] ) ) {
//$nowid = intval( $_REQUEST[ 'id' ] );
//};
if ( isset( $_REQUEST[ 'parent_id' ] ) ) {
    $parent_id = intval( $_REQUEST[ 'parent_id' ] );
};
if ( isset( $_REQUEST[ 'reg_id' ] ) ) {
    $reg_id = $_REQUEST[ 'reg_id' ]; //注册证书号
};
//echo $reg_id;
// Page分页函数
if ( isset( $_REQUEST[ 'page' ] ) ) {
    $page = intval( $_REQUEST[ 'page' ] );
};
include 'M_top.php';
$sql = "select * From `cms_article` where `reg_id`='" . $reg_id . "'";
$rs = mysqli_query( $Conn, $sql );
$row = mysqli_fetch_array( $rs );

$parent_id = $row[ "id" ];
$cat_id = $row[ "cat_id" ]; //大类id
$title = $row[ "title" ]; //标题
$image = trim( $row[ "image" ] ); //图片
//if ( '1' . $image == '1' ) {
//$image = 'uploads/150131/1-1501312316464b.jpg';
//};
$image = "../" . $image;
$content = $row[ "content" ]; //内容
if ( '1' . trim( $row[ "image" ] ) != '1' ) {
    $content = "<img src='$image'  width='auto'  alt='$title' style='border:2px solid #CCC'>$content</br>";
};
$click = $row[ "click" ]; //点击次数
$keywords = $row[ "keywords" ]; //关键词
$description = $row[ "description" ]; //描述
$add_time = ToData( $row[ "add_time" ] ); //添加时间
mysqli_free_result( $rs ); //释放内存
mysqli_query( $Conn, "UPDATE  `cms_article`  set `click`=click+1  WHERE `id` =" . $parent_id ); //这里记录访问次数
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width,user-scalable=0,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="format-detection" content="telephone=no"/>
<link rel="apple-touch-icon-precomposed" href="data/logo-icon.png">
<title>SQP Certificate Mobile View <?php echo $title.$keywords ?></title>
<meta name="keywords" content="<?php echo $keywords ?>"/>
<meta name="description" content="<?php echo $description ?>"/>
<meta name="generator" content="SQP V1.0"/>
<link href="theme/style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="theme/default/images/jquery.min.js"></script> 
<script type="text/javascript" src="theme/default/images/global.js"></script>
</head>

<body>
<div id="wrapper">
    <div id="header"> <a href="javascript:history.go(-1)" class="home"></a> <em class="eleft">SQP Certificate Mobile View</em> <a href="M_right_menu.php" class="siteMap"></a> </div>
    <div class="headpadd"></div>
    <div class="urHere">当前位置：<a href=index.php>首页</a><b>></b><a href=M_search.php>证书查询系统</a><b>></b><a href='#'>查询结果</a></div>
    <!--
        <div class="treeBox">
        <a href="article.php?id=3" >关于我们</a>
        <a href="article.php?id=5" >新闻资讯</a>
        <a href="article.php?id=4" >联系我们</a>
        </div>
        !-->
    
    <div id="article">
        <h1> <?php echo $title ?> </h1>
        <div class="content"> <?php echo $content ?> </div>
        <div class="info">注册时间:<?php echo $add_time?> 查询次数:<?php echo $click ?></div>
    </div>
    <?php include_once( 'M_foot.php' );?>
    <?php include_once( 'M_bottom.php' );?>
</div>
</body>
</html>