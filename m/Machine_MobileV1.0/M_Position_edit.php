<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Position_Set.php'; //连上参数设定


//echo($_POST[ 'data' ]);

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
        mysqli_free_result( $rs ); //释放内存
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
        $bumen = $row[ 'bumen' ]; //更新时间
        mysqli_free_result( $rs ); //释放内存
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
    <div id="header"> <a href="<?php echo $phpstart ?>.php?id=<?php echo $id ?>" class="home"></a> <em class="eleft"><?php echo $textsname ?> 修改</em> <a href="M_right_menu.php" class="siteMap"></a> </div>
    <form autocomplete='off' οnsubmit='return false' οnkeydοwn="if(event.keyCode==13){return false;}">
        <div id='mobanaddbox' class='NowULTable nocopytext'>
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font>&nbsp;<?php echo $textsname ?>名称:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='name' id='name' class='addboxinput inputfocus'  value='<?php echo $name ?>' onkeydown="if(event.keyCode == 13){return false;}" />
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;部门:</li>
                <li class='cols02'>
                    <select name='bumen' id='bumenbox' class='addboxinput inputfocus'>
                        <option  value='0'>未选择</option>
                    </select>
                </li>
            </ul>
            <ul>
                <li class='cols01'>添加时间:</li>
                <li class='cols02'>&nbsp;<?php echo $sys_adddate ?></li>
            </ul>
            <ul>
                <li class='cols01'>更新时间:</li>
                <li class='cols02'>&nbsp;<?php echo $sys_adddate_g ?></li>
            </ul>
            <?php if ( $sys_q_tianj >= 0 ) { //有添加权限时 ?>
            <ul>
                <li class='cols01'> &nbsp;</li>
                <li class='cols02'>
                    <input id='SYS_submit' value='提 交' type='button' title='Ctrl+Enter提交' class='button button_ADD' onclick="add_edit_mobile(this,'<?php echo $phpstart ?>_edit.php','edit_mobile','<?php echo $phpstart ?>.php?act=list')"    />
                </li>
            </ul>
            <ul>
                <li class='cols01'> &nbsp;</li>
                <li class='cols02'> <font id='editsuccess' class='font_red'></font></li>
            </ul>
            <?php
            }
            ?>
            <input type='hidden' name='id' id='id' value='<?php echo $id ?>' />
            <input type='hidden' name='act' id='act' value='edit_mobile' />
        </div>
    </form>
    <?php include_once( 'M_foot.php' );?>
    <?php include_once( 'M_bottom.php' );?>
</div>
</body>
</html>
<script type="text/javascript" src="../../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../../js/jq.host_mobile.js"></script>
<script>
    $(document).ready(function() {
        let SonBumenList = <?php echo json_encode($_SESSION['SonBumenList']) ?>;   
        console.log(<?php echo json_encode($_SESSION['SonBumenList']) ?>) 
        SonBumenList.forEach((item) => {
            var div = $("<option>")
            div.val(item.id).text('-- '.repeat(item.prefix)+item.bumenname)
            $('#bumenbox').append(div)
        })
        $('#bumenbox').val(<?php echo $bumen ?>)
    })
</script>
<?php
}
?>
