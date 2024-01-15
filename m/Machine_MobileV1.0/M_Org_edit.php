<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Org_Set.php'; //连上参数设定

//================================================================以下为处理数据

if ( isset( $_POST[ 'act' ] ) )$act = $_POST[ 'act' ]; //act
if ( isset( $_REQUEST[ 'id' ] ) )$id = $_REQUEST[ 'id' ]; //id
//echo($_POST[ 'data' ]);

if ( $act == 'edit_mobile' ) { //当接收到处理指令时
    //----------------------------------查询是否有重复值
    //echo $hy;
    if ( isset( $_POST[ 'name' ] ) )$name = $_POST[ 'name' ]; //name
    if ( isset( $_POST[ 'yyzzhao' ] ) )$yyzzhao = $_POST[ 'yyzzhao' ]; //统一社会信用代码
    if ( isset( $_POST[ 'faren' ] ) )$faren = $_POST[ 'faren' ]; //法人
    if ( isset( $_POST[ 'address' ] ) )$address = $_POST[ 'address' ]; //地址
    if ( isset( $_POST[ 'tel' ] ) )$tel = $_POST[ 'tel' ]; //电话、手机
    if ( isset( $_POST[ 'webhttp' ] ) )$webhttp = $_POST[ 'webhttp' ]; //网址
    if ( isset( $_POST[ 'email' ] ) )$email = $_POST[ 'email' ]; //邮件
    if ( isset( $_POST[ 'sys_org_img' ] ) )$sys_org_img = $_POST[ 'sys_org_img' ]; //公司证件
    if ( $name . '1' == '1' ) {
        echo "$textsname名称，不能为空！";
    } else {
        $sql = $rs = $record_count = '';
        $sql = "select id,$colsname From `$tablename` where ($colsname='$name' or yyzzhao='$yyzzhao') and sys_yfzuid='$hy' and id<>'$id' order by id Asc";
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
            $sql = "UPDATE  `$tablename`  set `$colsname` ='$name',`yyzzhao`='$yyzzhao',`faren`='$faren',`address`='$address',`tel`='$tel',`webhttp`='$webhttp',`email`='$email',`sys_org_img`='$sys_org_img',`sys_adddate_g`='$nowdate' WHERE id='$id' ";
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
        $sql = "select id,$colsname,yyzzhao,faren,address,tel,webhttp,email,sys_org_img,sys_adddate,sys_adddate_g From `$tablename` where id='$id' and sys_yfzuid='$hy' order by id Asc";
        //echo $sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        //$record_count = mysqli_num_rows( $rs ); //统计总记录数
        $row = mysqli_fetch_array( $rs );
        $name = $row[ $colsname ]; //公司名称
        $yyzzhao = $row[ 'yyzzhao' ]; //统一信用代码
        $faren = $row[ 'faren' ]; //法人
        $address = $row[ 'address' ]; //注册地址
        $tel = $row[ 'tel' ]; //电话
        $webhttp = $row[ 'webhttp' ]; //网址
        $email = $row[ 'email' ]; //邮件
        $sys_org_img = $row[ 'sys_org_img' ]; //证件照片
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
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font><?php echo $textsname ?>名称:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='name' id='name' class='addboxinput inputfocus'  value='<?php echo $name ?>'/>
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            
            <!--   !-->
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font>工商注册号:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='yyzzhao' id='yyzzhao' placeholder="统一社会信用代码" class='addboxinput inputfocus'  value='<?php echo $yyzzhao ?>'/>
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            
            <!--   !-->
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>法人:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='faren' id='faren' class='addboxinput inputfocus'  value='<?php echo $faren ?>'/>
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            
            <!--   !-->
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>注册地址:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='address' id='address' class='addboxinput inputfocus'  value='<?php echo $address ?>'/>
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            
            <!--   !-->
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>电话/手机:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='tel' id='tel' class='addboxinput inputfocus'  value='<?php echo $tel ?>'/>
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            
            <!--   !-->
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>网址:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='webhttp' id='webhttp' class='addboxinput inputfocus'  value='<?php echo $webhttp ?>'/>
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            
            <!--   !-->
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>邮件:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='email' id='email' class='addboxinput inputfocus'  value='<?php echo $email ?>'/>
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            
            <!--   !-->
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>执照上传:</li>
                <li class='cols02'>
                    <input type='hidden' typeid='1'  name='sys_org_img' id='sys_org_img' class='addboxinput inputfocus'  value='<?php echo $sys_org_img ?>'/>
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
<?php
}
?>
