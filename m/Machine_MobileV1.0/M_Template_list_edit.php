<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Template_list_Set.php'; //连上参数设定

//================================================================以下为处理数据

if ( isset( $_POST[ 'act' ] ) )$act = $_POST[ 'act' ]; //act
if ( isset( $_REQUEST[ 'id' ] ) )$id = $_REQUEST[ 'id' ]; //id
//echo($_POST[ 'data' ]);

if ( $act == 'edit_mobile' ) { //当接收到处理指令时
    //----------------------------------查询是否有重复值
    //echo $hy;
    //echo '00';

    if ( isset( $_POST[ 'sys_keyword_cn' ] ) )$sys_keyword_cn = $_POST[ 'sys_keyword_cn' ]; 
    if ( isset( $_POST[ 'sys_keyword_en' ] ) )$sys_keyword_en = $_POST[ 'sys_keyword_en' ]; 
   
    
    
    if ( $sys_keyword_cn . '1' == '1' ) {
        echo "$textsname名称，不能为空！";
    } else {
       
        $sql = $rs = $record_count = '';
        $sql = "select id,$colsname,sys_keyword_en From `$tablename` where (sys_keyword_cn='$sys_keyword_cn' and sys_Id_MenuBigClass='$parent_id') and id<>'$id' order by id Asc";
        //echo $sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        $record_count = mysqli_num_rows( $rs ); //统计总记录数
        mysqli_free_result( $rs ); //释放内存

        if ( $record_count > 0 ) { //有重复值时
            echo "已有重复值\"" . $sys_keyword_cn . "\",禁止修改。";
        } else { //允许修改
            //echo"可以修改";
            $sql = $rs = '';
            $nowdata = date( 'Y-m-d H:i:s' );
            $sql = "UPDATE  `$tablename`  set `$colsname` ='$sys_keyword_cn',`sys_keyword_en`='$sys_keyword_en',`sys_adddate_g`='$nowdate' WHERE id='$id' ";
            //--------------------------------------以下为执行修改
            //echo $sql;
            mysqli_query( $Connadmin, $sql ); //执行修改
            echo "修改成功！"; /*这里只能禁止修改*/
        }
        mysqli_free_result( $rs );  //释放内存
        mysqli_close( $Connadmin ); //关闭数据库
    }
    //echo $sys_keyword_cn;
} else {
    //查询到相关值

    $sql = $rs = $row = '';
    if ( $id > 0 ) {
        $sql = "select id,$colsname,sys_keyword_en,sys_adddate,sys_adddate_g From `$tablename` where id='$id' order by id Asc";
        //echo '<br><br><br><br>'.$sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        //$record_count = mysqli_num_rows( $rs ); //统计总记录数
        $row = mysqli_fetch_array( $rs );
        $sys_keyword_cn = $row[ 'sys_keyword_cn' ]; 
        $sys_keyword_en = $row[ 'sys_keyword_en' ]; 
        $sys_adddate = $row[ 'sys_adddate' ]; 
        $sys_adddate_g = $row[ 'sys_adddate_g' ]; 
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
    <div id="header"> <a href="<?php echo $phpstart ?>.php?parent_id=<?php echo $parent_id ?>" class="home"></a> <em class="eleft"><?php echo $textsname ?> 修改</em> <a href="M_right_menu.php" class="siteMap"></a> </div>
    <form autocomplete='off' οnsubmit='return false' οnkeydοwn="if(event.keyCode==13){return false;}">
        <div id='mobanaddbox' class='NowULTable nocopytext'>
             <!--   !-->
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font>参数中文名:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='sys_keyword_cn' id='sys_keyword_cn' placeholder="" class='addboxinput inputfocus'  value='<?php echo $sys_keyword_cn ?>'  onkeyup='chanshu_pinyin_mobile(this,"<?php echo $parent_id ?>")'/>
                    <div class='cols03 font_red yanzheng' id='sys_keyword_cn_bitian'></div>
                </li>
            </ul>
            <!--   sys_keyword_en!-->
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font>参数英文名:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='sys_keyword_en' id='sys_keyword_en' placeholder="" class='addboxinput inputfocus'  value='<?php echo $sys_keyword_en ?>' readonly />
                    <div class='cols03 font_red yanzheng' id='sys_keyword_en_bitian'></div>
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
                    <input id='SYS_submit' value='提 交' type='button' title='Ctrl+Enter提交' class='button button_ADD' onclick="add_edit_mobile(this,'<?php echo $phpstart ?>_edit.php','edit_mobile','<?php echo $phpstart ?>.php?parent_id=<?php echo $parent_id ?>')"    />
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
<script type="text/javascript" src="../../js/hztopy-min.js"></script>
<script type="text/javascript" src="../../js/jq.host_mobile.js"></script>
<script type="text/javascript" src="../../js/pc_mobile.js"></script>
<?php
}
?>
