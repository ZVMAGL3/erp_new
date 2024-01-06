<?php
include_once( '../data/conn.php' );
include_once( '../include/function.php' );
$nowid = $page = $parent_id = 0;

if ( isset( $_REQUEST[ 'id' ] ) ) {
    $nowid = intval( $_REQUEST[ 'id' ] );
};
$nowid = 13;
if ( isset( $_REQUEST[ 'parent_id' ] ) ) {
    $parent_id = intval( $_REQUEST[ 'parent_id' ] );
};
// Page分页函数
if ( isset( $_REQUEST[ 'page' ] ) ) {
    $page = intval( $_REQUEST[ 'page' ] );
};
$s = $svalue = '';
if ( isset( $_REQUEST[ 's' ] ) ) {
    $s = trim( $_REQUEST[ 's' ] );
};

if ( '1' . $s != '1' ) {
    $svalue = $s;
} else {
    $svalue = '输入证书信息';
};
if ( $s == '输入证书信息' ) {
    $s = '';
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
<title>SQP Certificate Mobile Search System</title>
<meta name="keywords" content=""/>
<meta name="description" content=""/>
<meta name="generator" content="SQP V1.0"/>
<link href="theme/style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="theme/default/images/jquery.min.js"></script> 
<script type="text/javascript" src="theme/default/images/global.js"></script>
</head>

<body>
<div id="wrapper">
    <div id="header"> <a href="javascript:history.go(-1)" class="home"></a> <em class="eleft">SQP Certificate Mobile Search System</em> <a href="M_right_menu.php" class="siteMap"></a> </div>
    <div class="headpadd"></div>
    <div class="urHere">当前位置：<a href=index.php>首页</a><b>></b><a href=M_search.php>证书查询系统</a></div>
    <div class="topSearch_mobbile"> <br>
        <br>
        请填入SQP ID / 组织名称 / 证书号查询 <br>
        Fill SQP-ID/Organization-Name/Certificate-NO <br>
        <br>
        <div class="searchBox">
            <form name="search" method="get" action="M_search.php" style="border: 0;padding: 0;margin: 0">
                <input name="s" type="text" class="keyword" autocomplete="off" maxlength="128" value="<?php echo $svalue ?>" onclick="formClick(this,'输入证书信息')">
                <input type="submit" class="btnSearch" value="提交">
            </form>
        </div>
    </div>
    <?php
    if ( $s > "" ) {
        ?>
    <div class="articleList">
        <?php

        //分页数据
        //if ( $nowid > 0 ) {
        $sql3 = "select * From `cms_article` where cat_id='" . $nowid . "' and (reg_id='" . $s . "' or title like '%" . $s . "%') ";
        //} else {
        //$sql3 = "select * From `cms_article` where cat_id in(1,2)";
        //};
        $rs3 = mysqli_query( $Conn, $sql3 );
        $record_count3 = mysqli_num_rows( $rs3 ); //统计总记录数
        Page_Mobile( $record_count3, 8 ); //设定分页数量
        mysqli_free_result( $rs3 ); //释放内存

        if ( $record_count3 < 1 and $s > "" ) {
            echo "<dl class='h3search'>对不起，没有查询到您要的证书，有以下2种可能:<br>&nbsp;1）证书号输入错误；<br>&nbsp;2）该证书不是合法的证书</dl>";
        } else {
            //分页数据
            //if ( $nowid > 0 ) {
            $sql2 = "select * From `cms_article` where cat_id='" . $nowid . "' and (reg_id='" . $s . "' or title like '%" . $s . "%') order by add_time Desc limit " . $select_from . "," . $select_limit;
            //} else {
            //$sql2 = "select * From `cms_article` where cat_id in(1,2) order by add_time Desc limit " . $select_from . "," . $select_limit;
            //};


            $rs2 = mysqli_query( $Conn, $sql2 );
            $i = 0;
            while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
                $i = $i + 1;
                $nowid2 = $row2[ "id" ];
                $reg_id2 = $row2[ "reg_id" ];
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
                echo "<dt>" . $i . ") &nbsp;<a href='search_show.php?reg_id=" . $reg_id2 . "'>" . $title . "</a></dt>";
                echo "<dd><em>发证时间：" . $add_time . "</em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>查询次数：" . $click . "</em></dd>";
                echo "</dl>";

            };

            mysqli_free_result( $rs2 ); //释放内存
        }
        ?>
        <div class="pager">
            <?php
            echo $pagenav;
            ?>
        </div>
    </div>
    <?php
    }
    ?>
    <?php include_once( 'M_foot.php' );?>
    <?php include_once( 'M_bottom.php' );?>
</div>
</body>
</html>