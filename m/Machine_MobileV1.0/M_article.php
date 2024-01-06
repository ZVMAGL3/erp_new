<?php
include_once( '../data/conn.php' );
include_once( '../include/function.php' );
$nowid = $page = $parent_id = 0;

if ( isset( $_REQUEST[ 'id' ] ) ) {
    $nowid = intval( $_REQUEST[ 'id' ] );
};
if ( isset( $_REQUEST[ 'parent_id' ] ) ) {
    $parent_id = intval( $_REQUEST[ 'parent_id' ] );
};
// Page分页函数
if ( isset( $_REQUEST[ 'page' ] ) ) {
    $page = intval( $_REQUEST[ 'page' ] );
};
include 'M_top.php';
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
<title>Article List</title>
<meta name="keywords" content=""/>
<meta name="description" content=""/>
<meta name="generator" content="SQP V1.0"/>
<link href="theme/style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="theme/default/images/jquery.min.js"></script> 
<script type="text/javascript" src="theme/default/images/global.js"></script>
</head>

<body>
<div id="wrapper">
    <div id="header"> <a href="javascript:history.go(-1)" class="home"></a> <em class="eleft">Article List</em> <a href="M_catalog.php" class="siteMap"></a> </div>
    <div class="headpadd"></div>
    <div class="urHere">当前位置：<a href=index.php>首页</a><b>></b><a href=M_article.php>文章清单</a></div>
    <div class="treeBox">
        <?php
        $sql = "select * From `cms_article_category` where sys_huis=0 and parent_id='5' order by sort Asc";
        $rs = mysqli_query( $Conn, $sql );
        while ( $row = mysqli_fetch_array( $rs ) ) {
            $big_cat_id = $row[ "cat_id" ]; //大类id
            $nowparent_id = $row[ "parent_id" ]; //大类id
            $big_cat_name = $row[ "cat_name" ]; //大类名称
            if ( $big_cat_id == $nowid ) {
                echo "<a href='article.php?id=" . $big_cat_id . "&page=1' class='cur'>" . $big_cat_name . "</a>";
            } else {
                echo "<a href='article.php?id=" . $big_cat_id . "&page=1'>" . $big_cat_name . "</a>";
            }

        };
        mysqli_free_result( $rs ); //释放内存
        ?>
    </div>
    <div class="articleList">
        <?php

        //分页数据
        if ( $nowid > 0 ) {
            $sql3 = "select * From `cms_article` where cat_id='" . $nowid . "' ";
        } else {
            $sql3 = "select * From `cms_article` where cat_id in(1,2)";
        };
        $rs3 = mysqli_query( $Conn, $sql3 );
        $record_count3 = mysqli_num_rows( $rs3 ); //统计总记录数
        Page_Mobile( $record_count3, 8 ); //设定分页数量
        mysqli_free_result( $rs3 ); //释放内存


        //分页数据
        if ( $nowid > 0 ) {
            $sql2 = "select * From `cms_article` where cat_id='" . $nowid . "' order by add_time Desc limit " . $select_from . "," . $select_limit;
        } else {
            $sql2 = "select * From `cms_article` where cat_id in(1,2) order by add_time Desc limit " . $select_from . "," . $select_limit;
        };


        $rs2 = mysqli_query( $Conn, $sql2 );
        while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
            $nowid2 = $row2[ "id" ];
            $cat_id2 = $row2[ "cat_id" ]; //大类id
            $title = $row2[ "title" ]; //标题
            $image = $row2[ "image" ]; //图片
            if ( '1' . $image == '1' ) {
                $image = 'uploads/150131/1-1501312316464b.jpg';
            };
            $content = substr( DeleteHtml( $row2[ "content" ] ), 0, 250 ); //内容
            //$content=htmlspecialchars($content);
            $click = $row2[ "click" ]; //点击次数
            $keywords = $row2[ "keywords" ]; //关键词
            $description = $row2[ "description" ]; //描述
            $add_time = ToData( $row2[ "add_time" ] ); //添加时间

            echo "<dl>";
            echo "<dt><a href='article_show.php?parent_id=" . $nowid . "&id=" . $nowid2 . "'>" . $title . "</a></dt>";
            echo "<dd><em>发布时间：" . $add_time . "</em><em>点击数：" . $click . "</em></dd>";
            echo "</dl>";

        };
        mysqli_free_result( $rs2 ); //释放内存
        ?>
        <div class="pager">
            <?php
            echo $pagenav;
            ?>
        </div>
    </div>
    <?php include_once( 'M_foot.php' );?>
    <?php include_once( 'M_bottom.php' );?>
</div>
</body>
</html>