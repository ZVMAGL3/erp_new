<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Standard_Set.php'; //连上参数设定

//================================================================以下为处理数据

if ( isset( $_POST[ 'act' ] ) )$act = $_POST[ 'act' ]; //act
if ( isset( $_REQUEST[ 'id' ] ) )$id = $_REQUEST[ 'id' ]; //id
//echo($_POST[ 'data' ]);

if ( $act == 'edit_mobile' ) { //当接收到处理指令时
    //----------------------------------查询是否有重复值
    //echo $hy;
    if ( isset( $_POST[ 'name' ] ) )$name = $_POST[ 'name' ]; //标准名称
    if ( isset( $_POST[ 'number' ] ) )$number = $_POST[ 'number' ]; //标准号
    if ( isset( $_POST[ 'sys_beizhu' ] ) )$sys_beizhu = $_POST[ 'sys_beizhu' ]; //标准说明
    if ( isset( $_POST[ 'sys_zt' ] ) )$sys_zt = $_POST[ 'sys_zt' ]; //字头
    
    if ( $name . '1' == '1' ) {
        echo "$textsname名称，不能为空！";
    } else {
        $sql = $rs = $record_count = '';
        $sql = "select id,number,$colsname,sys_beizhu From `$tablename` where ($colsname='$name' or number='$number') and id<>'$id' order by id Asc";
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
            $sql = "UPDATE  `$tablename`  set `$colsname` ='$name',`number`='$number',`sys_beizhu`='$sys_beizhu',`sys_zt`='$sys_zt',`sys_adddate_g`='$nowdate' WHERE id='$id' ";
            //--------------------------------------以下为执行修改
            mysqli_query( $Connadmin, $sql ); //执行修改
            echo "修改成功！"; /*这里只能禁止修改*/
        }
        mysqli_free_result( $rs ); //释放内存
        mysqli_close( $Connadmin ); //关闭数据库 
    }
    //echo $name;
} else {
    //查询到相关值

    $sql = $rs = $row = '';
    if ( $id > 0 ) {
        $sql = "select id,number,$colsname,sys_beizhu,sys_zt,sys_adddate,sys_adddate_g From `$tablename` where id='$id' and sys_yfzuid='$hy' order by id Asc";
        //echo $sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        //$record_count = mysqli_num_rows( $rs ); //统计总记录数
        $row = mysqli_fetch_array( $rs );
        $name = $row[ $colsname ]; //标准名称
        $number = $row[ 'number' ]; //标准号
        $sys_beizhu = $row[ 'sys_beizhu' ]; //标准说明
        $sys_zt = $row[ 'sys_zt' ]; //字头
        $sys_adddate = $row[ 'sys_adddate' ]; //添加时间
        $sys_adddate_g = $row[ 'sys_adddate_g' ]; //更新时间
        mysqli_free_result( $rs ); //释放内存
    }
    mysqli_close( $Connadmin ); //关闭数据库 
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
             <!--   !-->
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font>标准号:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='number' id='number' placeholder="统一社会信用代码" class='addboxinput inputfocus'  value='<?php echo $number ?>'/>
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font><?php echo $textsname ?>名称:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='name' id='name' class='addboxinput inputfocus'  value='<?php echo $name ?>'/>
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            
           <!--   !-->
            <ul>
                <li class='cols01'>说明:</li>
                <li class='cols02'>
                    <textarea name="sys_beizhu" class='addboxinput inputfocus'><?php echo $sys_beizhu ?></textarea>
                    
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font>记录字头:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='sys_zt' id='sys_zt' class='addboxinput inputfocus'  value='<?php echo $sys_zt ?>'/>
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
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
            <?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
            <ul>
                <li class='cols01'> &nbsp;</li>
                <li class='cols02'>
                    <input id='SYS_submit' value='提 交' type='button' title='Ctrl+Enter提交' class='button button_ADD' onclick="add_edit_mobile(this,'<?php echo $phpstart ?>_edit.php','edit_mobile','<?php echo $phpstart ?>_terms.php?id=<?php echo $id ?>')"    />
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
<?php
}
?>
