<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Template_list_Set.php'; //连上参数设定

//================================================================以下为处理数据
if ( isset( $_POST[ 'act' ] ) )$act = $_POST[ 'act' ]; //act
//echo($_POST[ 'data' ]);

if ( $act == 'add_mobile' ) { //当接收到处理指令时
    //----------------------------------查询是否有重复值
    //echo $hy;
    if ( isset( $_POST[ 'sys_keyword_cn' ] ) )$sys_keyword_cn = $_POST[ 'sys_keyword_cn' ]; //名称
    if ( isset( $_POST[ 'sys_Id_MenuBigClass' ] ) )$sys_Id_MenuBigClass = $_POST[ 'sys_Id_MenuBigClass' ]; //参数
    if ( isset( $_POST[ 'sys_keyword_en' ] ) )$sys_keyword_en = $_POST[ 'sys_keyword_en' ]; //说明

    if ( $sys_keyword_cn . '1' == '1' ) {
        echo "$textsname名称，不能为空！";
    } else {
        $sql = $rs = $record_count = '';
        $sql = "select id,$colsname,sys_keyword_en From `$tablename` where ($colsname='$sys_keyword_cn' and sys_Id_MenuBigClass='$parent_id') and sys_yfzuid='$hy' order by id Asc";
        //echo $sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        $record_count = mysqli_num_rows( $rs ); //统计总记录数
        mysqli_free_result( $rs ); //释放内存

        if ( $record_count > 0 ) { //有重复值时
            echo "已有\"" . $sys_keyword_cn . "\",禁止添加。";
        } else { //允许添加
            //echo"可以添加";
            $sql = $rs = '';
            $nowdata = date( 'Y-m-d H:i:s' );

            $sys_postzd_list = "$colsname,sys_Id_MenuBigClass,sys_keyword_en,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate"; //加上系统默认值
            $sys_postvalue_list = "'$sys_keyword_cn','$sys_Id_MenuBigClass','$sys_keyword_en','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdata'";
            //echo $sys_postvalue_list;
            //--------------------------------------以下为执行添加
            $sql = "insert into `$tablename` ($sys_postzd_list) values ($sys_postvalue_list)";
            //echo $sql;
            mysqli_query( $Connadmin, $sql ); //执行添加
            echo "添加成功！"; /*这里只能禁止修改*/
        }
    }
    //echo $sys_keyword_cn;
} else {

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
    <div id="header"> <a href="<?php echo $phpstart ?>.php?parent_id=<?php echo $parent_id ?>" class="home"></a> <em class="eleft"><?php echo $textsname ?> 添加</em> <a href="#" class="siteMap"></a> </div>
    <form autocomplete='off' οnsubmit='return false' οnkeydοwn="if(event.keyCode==13){return false;}">
        <div id='mobanaddbox' class='NowULTable nocopytext'>
            <!--   !-->
            
            
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font>参数中文名:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='sys_keyword_cn' id='sys_keyword_cn' class='addboxinput inputfocus'  onkeyup='chanshu_pinyin_mobile(this,"<?php echo $parent_id ?>")' value='<?php echo $sys_keyword_cn ?>'/>
                    <div class='cols03 font_red yanzheng' id='sys_keyword_cn_bitian'></div>
                </li>
            </ul>
            
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font>参数英文名:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='sys_keyword_en' id='sys_keyword_en' class='addboxinput inputfocus'  value='<?php echo $sys_keyword_en ?>' readonly />
                    <div class='cols03 font_red yanzheng' id='sys_keyword_en_bitian'></div>
                </li>
            </ul>
            
            

            <!--   !-->
            <ul style="display: none">
                <li class='cols01'>大类id:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='sys_Id_MenuBigClass' id='sys_Id_MenuBigClass' class='addboxinput inputfocus'  value='<?php echo $parent_id ?>'/>
                    
                    <div class='cols03 font_red yanzheng' id='sys_Id_MenuBigClass_bitian'></div>
                </li>
            </ul>
            <?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
            <ul>
                <li class='cols01'> &nbsp;</li>
                <li class='cols02'>
                    <input id='reset_add' type='reset' value='重填' tabindex=-1 class='button button_reset' onclick="inputfocusfirst('#mobanaddbox','sys_keyword_cn')" >
                    <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' onclick="add_edit_mobile(this,'<?php echo $phpstart ?>_add.php','add_mobile','<?php echo $phpstart ?>.php?parent_id=<?php echo $parent_id ?>')"    />
                    <label>&nbsp;&nbsp;&nbsp;<input name='SYS_lianxu' id='SYS_lianxu'  type='checkbox'  class='button' />&nbsp;<font  color='#999'>连续添加</font></label>
                </li>
            </ul>
            <ul>
                <li class='cols01'> &nbsp;</li>
                <li class='cols02'> <font id='editsuccess' class='font_red'></font></li>
            </ul>
            <?php
            }
            ?>
            <input type='hidden' name='act' id='act' value='add_mobile' />
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
mysqli_close( $Connadmin ); //关闭数据库 
?>
