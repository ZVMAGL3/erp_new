<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Setting_Set.php'; //连上参数设定

//================================================================以下为处理数据

if ( isset( $_POST[ 'act' ] ) )$act = $_POST[ 'act' ]; //act
if ( isset( $_REQUEST[ 'id' ] ) )$id = $_REQUEST[ 'id' ]; //id
//echo($_POST[ 'data' ]);

if ( $act == 'edit_mobile' ) { //当接收到处理指令时
    //----------------------------------查询是否有重复值
    //echo $hy;
    if ( isset( $_POST[ 'gsbh' ] ) )$gsbh = $_POST[ 'gsbh' ]; //统一社会信用代码
    if ( isset( $_POST[ 'maxrecord' ] ) )$maxrecord = $_POST[ 'maxrecord' ]; //单页显示数
    if ( isset( $_POST[ 'OKAr' ] ) )$OKAr = $_POST[ 'OKAr' ]; //上传格式
    if ( isset( $_POST[ 'OkSize' ] ) )$OkSize = $_POST[ 'OkSize' ]; //上传尺寸
    if ( isset( $_POST[ 'USE_banben' ] ) )$USE_banben = $_POST[ 'USE_banben' ]; //系统版本

    if ( $gsbh . '1' == '1' ) {
        echo "公司代码，不能为空！";
    } else {
        $sql = $rs = $record_count = '';
        $sql = "select id,$colsname From `$tablename` where (gsbh='$gsbh')  and id<>'$id' order by id Asc";
        //echo $sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        $record_count = mysqli_num_rows( $rs ); //统计总记录数
        mysqli_free_result( $rs ); //释放内存

        if ( $record_count > 0 ) { //有重复值时
            echo "已有重复值\"" . $gsbh . "\",禁止修改。";
        } else { //允许修改
            //echo"可以修改";
            $sql = $rs = '';
            $nowdata = date( 'Y-m-d H:i:s' );
            $sql = "UPDATE  `$tablename`  set `gsbh`='$gsbh',`maxrecord`='$maxrecord',`OKAr`='$OKAr',`OkSize`='$OkSize',`USE_banben`='$USE_banben' WHERE id='$id' ";
            //--------------------------------------以下为执行修改
            mysqli_query( $Connadmin, $sql ); //执行修改
            echo "修改成功！"; /*这里只能禁止修改*/
        }
        mysqli_free_result( $rs ); //释放内存
        mysqli_close( $Connadmin ); //关闭数据库 
    }
    
} else {
    //查询到相关值

    $sql = $rs = $row = '';
    if ( $id > 0 ) {
        $sql = "select id,$colsname,gsbh,maxrecord,OKAr,OkSize,USE_banben,email,sys_org_img,sys_adddate,sys_adddate_g From `$tablename` where id='$id' and sys_yfzuid='$hy' order by id Asc";
        //echo $sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        //$record_count = mysqli_num_rows( $rs ); //统计总记录数
        $row = mysqli_fetch_array( $rs );
        $name = $row[ $colsname ]; //公司名称
        $gsbh = $row[ 'gsbh' ]; //公司编号
        $maxrecord = $row[ 'maxrecord' ]; //单页显示数
        $OKAr = $row[ 'OKAr' ]; //上传格式
        $OkSize = $row[ 'OkSize' ]; //上传大小
        $USE_banben = $row[ 'USE_banben' ]; //版本
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
        <div id='mobanaddbox' class='NowULTable nocopytext' >
            <ul>
                <li class='cols01'>公司名称:</li>
                <li class='cols02'><?php echo $name ?></li>
            </ul>
            
            <!--   !-->
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font>公司代码:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='gsbh' id='gsbh' placeholder="公司代码" class='addboxinput inputfocus'  value='<?php echo $gsbh ?>' />
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            
            <!--   !-->
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>单页显示数:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='maxrecord' id='maxrecord' class='addboxinput inputfocus'  value='<?php echo $maxrecord ?>'  />
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            
            <!--   !-->
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>允许上传格式:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='OKAr' id='OKAr' class='addboxinput inputfocus'  value='<?php echo $OKAr ?>'  />
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            
            <!--   !-->
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>上传大小(M):</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='OkSize' id='OkSize' class='addboxinput inputfocus'  value='<?php echo $OkSize ?>'   />
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            
            <!--   !-->
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>系统版本:</li>
                <li class='cols02'>
                    <?php
                    echo " <select name='USE_banben'  class='addboxinput inputfocus'";
                    if ( $USE_banben = 'V1.0' )echo( 'selected' );
                    echo ">V1.0&nbsp;&nbsp;</option></select>";
                    ?>
                    
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            
            <!--   !-->
            <ul>
                <li class='cols01' >较正字段:</li>
                <li class='cols02'>
                    <input id='SYS_submit' value='【用户】数据较正' type='button' class='button button_hui' onclick="postall_mobile(this,'Conn')" />
                    <input id='SYS_submit1' value='【云端】数据较正' type='button' class='button button_hui' onclick="postall_mobile(this,'Connadmin')" />
                </li>
            </ul>
            

            <!--   !-->
            <ul>
                <li class='cols01'>清除缓存:</li>
                <li class='cols02'>
                   <input id='SYS_submit2' value='清除缓存' type='button' class='button button_hui' onclick="deldir_mobile('deldir')" /> 
                </li>
            </ul>
            <?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
            <ul>
                <li class='cols01'> &nbsp;</li>
                <li class='cols02'>
                    <input id='SYS_submit' value='提 交' type='button' title='Ctrl+Enter提交' class='button button_ADD' onclick="add_edit_mobile(this,'<?php echo $phpstart ?>_edit.php','edit_mobile','<?php echo $phpstart ?>.php?act=list')"    />
                </li>
            </ul>
            <ul>
                <li class='cols01'> &nbsp;</li>
                <li class='cols02'> <font id='editsuccess' class='font_red' ></font></li>
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
