<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_RecordList_terms_Set.php'; //连上参数设定


//-------------------------------------自动条款 排序处理
//$val='1.2.1.';
//$sys_bh=substr_count( $val, '.');
//for ( $i = 0; $i < $sys_bh; $i++ ) {
//          $sys.=',' ;
//        };
//echo "<br><br><br>".$sys; //查找字符串首次出现的位置

if ( $act == 'edit_mobile' ) { //当接收到处理指令时
    //----------------------------------查询是否有重复值
    //echo $hy;
    if ( isset( $_POST[ 'sys_GuoChengMingChen' ] ) )$sys_GuoChengMingChen = $_POST[ 'sys_GuoChengMingChen' ]; //标准名称
    if ( isset( $_POST[ 'parent_id' ] ) )$parent_id = $_POST[ 'parent_id' ]; //标准号
    if ( isset( $_POST[ 'sys_id_standard' ] ) )$sys_id_standard = $_POST[ 'sys_id_standard' ]; //所属标准
    if ( isset( $_POST[ 'sys_beizhu' ] ) )$sys_beizhu = $_POST[ 'sys_beizhu' ]; //标准内容

    if ( $sys_GuoChengMingChen . '1' == '1' ) {
        echo "$textsname名称，不能为空！";
    } else {
        $sql = $rs = $record_count = '';
        $sql = "select id,$colsname From `$tablename` where ($colsname='$sys_GuoChengMingChen') and id<>'$id' order by id Asc";
        //echo $sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        $record_count = mysqli_num_rows( $rs ); //统计总记录数
        mysqli_free_result( $rs ); //释放内存

        if ( $record_count > 1000 ) { //有重复值时
            echo "已有重复值\"" . $sys_GuoChengMingChen . "\",禁止修改。";
        } else { //允许修改
            //echo"可以修改";
            $sql = $rs = '';
            $nowdata = date( 'Y-m-d H:i:s' );

            

            $sql = "UPDATE  `$tablename`  set `$colsname` ='$sys_GuoChengMingChen',`sys_id_standard`='$sys_id_standard',`sys_adddate_g`='$nowdate' WHERE id='$id' ";
            //--------------------------------------以下为执行修改
            //echo $sql;
            mysqli_query( $Connadmin, $sql ); //执行修改
            echo "修改成功！"; /*这里只能禁止修改*/
        }
        mysqli_free_result( $rs ); //释放内存
        
        
        mysqli_close( $Connadmin ); //关闭数据库 
    }
    //echo $sys_GuoChengMingChen;
} else {
    //查询到相关值

    $sql = $rs = $row = '';
    if ( $id > 0 ) {
        $sql = "select id,$colsname,sys_id_standard,sys_adddate,sys_bh,sys_adddate_g From `$tablename` where id='$id' and sys_yfzuid='$hy' order by id Asc";
        //echo $sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        $row = mysqli_fetch_array( $rs );
        $sys_GuoChengMingChen = $row[ $colsname ]; //标准名称
        $sys_id_standard = $row[ 'sys_id_standard' ]; //所属标准ID
        $sys_adddate = $row[ 'sys_adddate' ]; //添加时间
        $sys_adddate_g = $row[ 'sys_adddate_g' ]; //更新时间
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
    <div id="header"> <a href="<?php echo $phpstart ?>_show.php?parent_id=<?php echo $parent_id ?>&id=<?php echo $id ?>" class="home"></a> <em class="eleft">条款修改</em> <a href="M_right_menu.php" class="siteMap"></a> </div>
    <form autocomplete='off' οnsubmit='return false' οnkeydοwn="if(event.keyCode==13){return false;}">
        <div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;margin-top:95px;margin-bottom: 90px;'> 
            <!--   !-->

            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font>过程名称:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='sys_GuoChengMingChen' id='sys_GuoChengMingChen' class='addboxinput inputfocus'  value='<?php echo $sys_GuoChengMingChen ?>'  style='width:90%' />
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>

            <ul>
                <li class='cols01'>所属标准:</li>
                <li class='cols02'>
                <?php
                    $sql2 = "select * from `msc_standard` where sys_yfzuid='$hy' and sys_huis=0 ";
                    $rs2 = mysqli_query( $Connadmin, $sql2 );
                    echo( "<select name='sys_id_standard'  class='addboxinput inputfocus' style='width:93%;'>" );
                    //echo( "<option  value='0'>未选择</option>" );
                    while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
                        $rowdid = $row2[ "id" ];
                        $number = $row2[ "number" ]; //标准编号
                        $name = $row2[ "name" ]; //部标准名称
                        echo( "<option  value='$rowdid' " );
                        if ( $sys_id_standard == $rowdid ) {
                            echo( 'selected' );
                        }
                        echo( ">{$number}&nbsp;{$name}</option>" );
                    }
                    echo( '</select>' );
                    mysqli_free_result( $rs2 ); //释放内存
                    
                    ?>
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
            <ul style='height:15px;width:100%;'>
                <li style='width:98%'></li>
            </ul>
            <?php if ( $sys_q_tianj >= 0 ) { //有添加权限时 ?>
            <ul>
                <li class='cols01'> &nbsp;</li>
                <li class='cols02'>
                    <input type='hidden' typeid='1' name='parent_id' id='parent_id' class='addboxinput inputfocus'  value='<?php echo $parent_id ?>'  style='width:90%' />
                    
                    <input id='SYS_submit' value='提 交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:100px'   onclick="add_edit_mobile(this,'<?php echo $phpstart ?>_edit.php','edit_mobile','<?php echo $phpstart ?>_show.php?parent_id=<?php echo $parent_id ?>&id=<?php echo $id ?>')"    />
                    
                </li>
            </ul>
            <ul>
                <li class='cols01'> &nbsp;</li>
                <li class='cols02'> <font id='editsuccess' class='font_red' style="width: 120px"></font></li>
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
