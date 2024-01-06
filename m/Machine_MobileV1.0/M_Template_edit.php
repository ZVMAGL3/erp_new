<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Template_Set.php'; //连上参数设定

//================================================================以下为处理数据

if ( isset( $_POST[ 'act' ] ) )$act = $_POST[ 'act' ]; //act
if ( isset( $_REQUEST[ 'id' ] ) )$id = $_REQUEST[ 'id' ]; //id
//echo($_POST[ 'data' ]);

if ( $act == 'edit_mobile' ) { //当接收到处理指令时
    //----------------------------------查询是否有重复值
    //echo $hy;
    //echo '00';

    if ( isset( $_POST[ 'sys_title' ] ) )$sys_title = $_POST[ 'sys_title' ]; 
    if ( isset( $_POST[ 'sys_hangye' ] ) )$sys_hangye = $_POST[ 'sys_hangye' ]; 
    if ( isset( $_POST[ 'sys_beizhu' ] ) )$sys_beizhu = $_POST[ 'sys_beizhu' ]; 
    if ( isset( $_POST[ 'sys_Id_MenuBigClass' ] ) )$sys_Id_MenuBigClass = $_POST[ 'sys_Id_MenuBigClass' ]; 
   
    
    if ( $sys_title . '1' == '1' ) {
        echo "$textsname名称，不能为空！";
    } else {
       
        $sql = $rs = $record_count = '';
        $sql = "select id,$colsname,sys_beizhu,sys_hangye From `$tablename` where (sys_title='$sys_title') and id<>'$id' order by id Asc";
        //echo $sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        $record_count = mysqli_num_rows( $rs ); //统计总记录数
        mysqli_free_result( $rs ); //释放内存

        if ( $record_count > 0 ) { //有重复值时
            echo "已有重复值\"" . $sys_title . "\",禁止修改。";
        } else { //允许修改
            //echo"可以修改";
            $sql = $rs = '';
            $nowdata = date( 'Y-m-d H:i:s' );
            $sql = "UPDATE  `$tablename`  set `$colsname` ='$sys_title',`sys_hangye`='$sys_hangye',`sys_beizhu`='$sys_beizhu',`sys_Id_MenuBigClass`='$sys_Id_MenuBigClass',`sys_adddate_g`='$nowdate' WHERE id='$id' ";
            //--------------------------------------以下为执行修改
            //echo $sql;
            mysqli_query( $Connadmin, $sql ); //执行修改
            echo "修改成功！"; /*这里只能禁止修改*/
        }
        mysqli_free_result( $rs );  //释放内存
        mysqli_close( $Connadmin ); //关闭数据库
    }
    //echo $sys_title;
} else {
    //查询到相关值

    $sql = $rs = $row = '';
    if ( $id > 0 ) {
        $sql = "select id,$colsname,sys_name,sys_hangye,sys_beizhu,sys_file,sys_Id_MenuBigClass,sys_adddate,sys_adddate_g From `$tablename` where id='$id' and sys_yfzuid='$hy' order by id Asc";
        //echo '<br><br><br><br>'.$sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        //$record_count = mysqli_num_rows( $rs ); //统计总记录数
        $row = mysqli_fetch_array( $rs );
        $sys_name = $row[ 'sys_name' ]; 
        $sys_title = $row[ 'sys_title' ]; 
        $sys_Id_MenuBigClass = $row[ 'sys_Id_MenuBigClass' ];//分类
        $sys_hangye = $row[ 'sys_hangye' ]; 
        $sys_beizhu = $row[ 'sys_beizhu' ]; 
        $sys_file = $row[ 'sys_file' ]; 
        $sys_adddate = $row[ 'sys_adddate' ]; 
        $sys_adddate_g = $row[ 'sys_adddate_g' ]; 
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
    <div id="header"> <a href="<?php echo $phpstart ?>_terms.php?id=<?php echo $id ?>" class="home"></a> <em class="eleft"><?php echo $textsname ?> 修改</em> <a href="M_right_menu.php" class="siteMap"></a> </div>
    <form autocomplete='off' οnsubmit='return false' οnkeydοwn="if(event.keyCode==13){return false;}">
        <div id='mobanaddbox' class='NowULTable nocopytext'>
             <!--   !-->
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font>模版名称:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='sys_title' id='sys_title' placeholder="" class='addboxinput inputfocus'  value='<?php echo $sys_title ?>'/>
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            <ul>
                <li class='cols01'>适用行业:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='sys_hangye' id='sys_hangye' placeholder="" class='addboxinput inputfocus'  value='<?php echo $sys_hangye ?>' />
                    <div class='cols03 font_red yanzheng' id='sys_hangye_bitian'></div>
                </li>
            </ul>
            <!--   !-->
            <ul>
                <li class='cols01'>说明:</li>
                <li class='cols02'>
                    <textarea name="sys_beizhu" class='addboxinput inputfocus'><?php echo $sys_beizhu ?></textarea>
                    
                    <div class='cols03 font_red yanzheng' id='sys_beizhu_bitian'></div>
                </li>
            </ul>
            <ul>
                <li class='cols01'>所属标准:</li>
                <li class='cols02'>
                    <?php
                    $sql2 = "select * from `msc_standard` where sys_yfzuid='$hy' and sys_huis=0 ";
   
                    $rs2 = mysqli_query( $Connadmin, $sql2 );
                    echo( "<select name='sys_Id_MenuBigClass' id='sys_Id_MenuBigClass'  class='addboxinput inputfocus'>" );
                    //echo( "<option  value='0'>未选择</option>" );
                    while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
                        $rowdid = $row2[ "id" ];
                        $number = $row2[ "number" ]; //标准编号
                        $name = $row2[ "name" ]; //部标准名称
                        echo( "<option  value='$rowdid' " );
                        if ( $sys_Id_MenuBigClass == $rowdid ) {
                            echo( 'selected' );
                        }
                        echo( ">{$number}&nbsp;{$name}</option>" );
                    }
                    echo( '</select>' );
                    mysqli_free_result( $rs2 ); //释放内存

                    ?>
                    <div class='cols03 font_red yanzheng' id='sys_Id_MenuBigClass_bitian'></div>
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
mysqli_close( $Connadmin ); //关闭数据库 
?>
