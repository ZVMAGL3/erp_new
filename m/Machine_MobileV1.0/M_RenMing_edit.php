<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_RenMing_Set.php'; //连上参数设定

//================================================================以下为处理数据

if ( isset( $_POST[ 'act' ] ) )$act = $_POST[ 'act' ]; //act
if ( isset( $_REQUEST[ 'id' ] ) )$id = $_REQUEST[ 'id' ]; //id
//echo($_POST[ 'data' ]);
//echo "<br><br><br><br><br><br>".$sys_q_zu;
if ( $act == 'edit_mobile' ) { //当接收到处理指令时
    //----------------------------------查询是否有重复值
    //echo $hy;
    if ( isset( $_POST[ 'name' ] ) )$name = $_POST[ 'name' ]; //name
    if ( isset( $_POST[ 'bumen' ] ) )$bumen = $_POST[ 'bumen' ]; //bumen
    if ( $name . '1' == '1' ) {
        echo "$textsname名称，不能为空！";
    } else {
        $sql = $rs = $record_count = '';
        $sql = "select id,$colsname From `$tablename` where $colsname='$name' and sys_yfzuid='$hy' and id<>'$id' order by id Asc";
        //echo $sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        $record_count = mysqli_num_rows( $rs ); //统计总记录数
        mysqli_free_result( $rs ); //释放内存

        if ( $record_count > 0 ) { //有重复值时
            echo "已有重复值\"" . $name . "\",禁止修改。";
        } else { //允许修改
            //echo"可以修改";
            $sql = $rs = '';
            $nowdata = date( 'Y-m-d H:i:s' );
            $sql = "UPDATE  `$tablename`  set `$colsname` ='$name',`bumen` ='$bumen',`sys_adddate_g`='$nowdate' WHERE id='$id' ";
            //--------------------------------------以下为执行修改
            mysqli_query( $Connadmin, $sql ); //执行修改
            echo "修改成功！"; /*这里只能禁止修改*/
        }

    }
    //echo $name;
} else {
    //查询到相关值

    $sql = $rs = $row = '';
    if ( $id > 0 ) {
        $sql = "select id,$colsname,sys_adddate,bumen,sys_adddate_g From `$tablename` where id='$id' and sys_yfzuid='$hy' order by id Asc";
        //echo $sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        //$record_count = mysqli_num_rows( $rs );     //统计总记录数
        $row = mysqli_fetch_array( $rs );
        $name = $row[ $colsname ]; //设定的字头
        $sys_adddate = $row[ 'sys_adddate' ]; //添加时间
        $sys_adddate_g = $row[ 'sys_adddate_g' ]; //更新时间
        $bumen = $row[ 'bumen' ]; //部门
        mysqli_free_result( $rs ); //释放内存

        $sql2 = "select * from `msc_bumenlist` where sys_yfzuid='$hy' and id='$bumen' ";
        $rs2 = mysqli_query( $Connadmin, $sql2 );
        $row2 = mysqli_fetch_array( $rs2 );
        $rowzu = $row2[ "bumenname" ]; //部门名称
        $nowbumens = "<font color='#999'>任命：</font>{$name} <font color='#999'>-[{$rowzu}]</font>";
        mysqli_free_result( $rs2 ); //释放内存
    }


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
    <div id="header"> <a href="<?php echo $phpstart ?>.php?id=<?php echo $id ?>" class="home"></a> <em class="eleft"><?php echo $nowbumens ?></em> <a href="#" onclick="$('#wrapper .rightmenu').toggle(300)" class="siteMap"></a><a href="#" onClick="SearchToggle(this)" class="search"></a> </div>
    <div class="topsearchmenu">
        <tm class='left'  onClick="SearchToggle(this)"><i class='fa fa-19-3'></i></tm>
        <input type='text'  name='keyword' id='keyword'  placeholder="<?php echo $textsname ?>" class='addboxinput inputfocus'  value='<?php echo $nowkeyword ?>'    onkeydown="if(event.keyCode == 13){return false;}" />
        <tm class='right' onclick='SearchGet("list_renmen","0","<?php echo $phpstart ?>","<?php echo $id ?>")'><i class='fa fa-search2'></i></tm>
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
            
            <!--
            <li><a href="#"  onClick="editmore()">
                <tm>01</tm>
                批量编辑<font class="hui"> . Batch Edit</font></a></li> 
            <li><a href="#">
                <tm>02</tm>
                表单设计<font class="hui"> . Table Design</font></a></li>
            
            <li><a href="<?php echo $phpstart ?>_huis.php">
                <tm>03</tm>
                回收站<font class="hui"> . Recycle Bin</font> </a></li>
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
    <!--  批量编辑菜单底部！-->
    <div  class="foot nowmenu_foot">
        <ul class='top'>
            任命“总经理”担任人员:
        </ul>
        <ul class='left'>
            为空！
        </ul>
        <ul class='right'>
            0
        </ul>
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
	SearchGet('list_renmen','0','<?php echo $phpstart ?>','<?php echo $id ?>');
    Tongji_Renming('Tongji_renmen','0','<?php echo $phpstart ?>','<?php echo $id ?>');//得到职位任命人员
});
</script>
<?php
}
mysqli_close( $Connadmin ); //关闭数据库 
?>