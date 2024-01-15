<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once '../../inc/B_conn.php'; //连上数据库
include_once '../../inc/Function_All.php';
include_once '../../inc/Sub_All.php';
include_once '../../inc/B_Config.php';//执行接收参数及配置
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_RecordList_terms_show_Set.php'; //连上参数设定

if ( isset( $_REQUEST[ 'parent_id2' ] ) )$parent_id2 = $_REQUEST[ 'parent_id2' ]; //id

if ( $act == 'edit_mobile' ) { //当接收到处理指令时
    //----------------------------------查询是否有重复值
    //echo $hy;
    if ( isset( $_POST[ 'sys_card' ] ) )$sys_card = $_POST[ 'sys_card' ]; //记录名称
    if ( isset( $_POST[ 'mdb_name_SYS' ] ) )$mdb_name_SYS = $_POST[ 'mdb_name_SYS' ]; //数据库名称
    if ( isset( $_POST[ 'parent_id' ] ) )$parent_id = $_POST[ 'parent_id' ]; //标准号
    if ( isset( $_POST[ 'Id_MenuBigClass' ] ) )$Id_MenuBigClass = $_POST[ 'Id_MenuBigClass' ]; //所属标准
    if ( isset( $_POST[ 'banben' ] ) )$banben = $_POST[ 'banben' ]; //所属标准
    if ( isset( $_POST[ 'xiugaicishu' ] ) )$xiugaicishu = $_POST[ 'xiugaicishu' ]; //修改次数
    if ( isset( $_POST[ 'sys_beizhu' ] ) )$sys_beizhu = $_POST[ 'sys_beizhu' ]; //标准内容

    if ( $sys_card . '1' == '1' ) {
        echo "$textsname名称，不能为空！";
    } else {
        $sql = $rs = $record_count = '';
        $sql = "select id,$colsname From `$tablename` where ($colsname='$sys_card') and id<>'$id' order by id Asc";
        //echo $sql.'_'; 
        $rs = mysqli_query( $Conn, $sql );
        $record_count = mysqli_num_rows( $rs ); //统计总记录数
        mysqli_free_result( $rs ); //释放内存
        if ( $record_count > 0 ) { //有重复值时
            echo "已有重复值\"" . $sys_card . "\",禁止修改。";
        } else { //允许修改
            //--------------------------------------以下为数据表修改，添加修改记录
            //echo "mdb_name_SYS:$mdb_name_SYS ,sys_card:$sys_card, Id_MenuBigClass:$Id_MenuBigClass , id:$id";
            Jilu_update_Modular( 'Sys_jlmb', " `id`='$id' ", 'banben', $banben, $Conn ); //更新版本
            Jilu_update_Modular( 'Sys_jlmb', " `id`='$id' ", 'xiugaicishu', $xiugaicishu, $Conn ); //更新版本
            table_add_Modular( $mdb_name_SYS, $sys_card, $Id_MenuBigClass , $id);
            echo "修改成功！"; /*这里只能禁止修改*/
        }
        mysqli_free_result( $rs ); //释放内存
    }
    //echo $sys_card;
} else {
    //查询到相关值
    $sql = $rs = $row = '';
    if ( $id > 0 ) {
        $sql = "select id,$colsname,mdb_name_SYS,Id_MenuBigClass,banben,xiugaicishu,sys_adddate,sys_bh,sys_adddate_g From `$tablename` where id='$id' and sys_yfzuid='$hy' order by id Asc";
        //echo $sql.'_'; 
        $rs = mysqli_query( $Conn, $sql );
        $row = mysqli_fetch_array( $rs );
        $sys_card = $row[ $colsname ]; //标准名称
        $mdb_name_SYS = $row[ 'mdb_name_SYS' ]; //数据库名称
        $Id_MenuBigClass = $row[ 'Id_MenuBigClass' ]; //所属过程
        $banben = $row[ 'banben' ]; //版本
        if($banben.'1'=='1')$banben='A';
        $xiugaicishu = $row[ 'xiugaicishu' ]; //修改次数
        if($xiugaicishu.'1'=='1')$xiugaicishu='0';
        $sys_adddate = $row[ 'sys_adddate' ]; //添加时间
        $sys_adddate_g = $row[ 'sys_adddate_g' ]; //更新时间
        mysqli_free_result( $rs ); //释放内存
    }
    $readonly = '';
    if($sys_id_login != '1'){//当不为开发者时
        $readonly=" readonly='readonly'";
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
    <div id="header"> <a href="<?php echo $phpstart ?>.php?parent_id=<?php echo $parent_id ?>&id=<?php echo $parent_id2 ?>" class="home"></a> <em class="eleft">条款修改</em> <a href="M_right_menu.php" class="siteMap"></a> </div>
    <form autocomplete='off' οnsubmit='return false' οnkeydοwn="if(event.keyCode==13){return false;}">
        <div id='mobanaddbox' class='NowULTable nocopytext'> 
            <!--   !-->
            
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font>记录名称:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='sys_card' id='sys_card' class='addboxinput inputfocus'  value='<?php echo $sys_card ?>'  onkeyup='table_pinyin_mobile(this)'/>
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            <ul>
                <li class='cols01'>数据表名称:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='mdb_name_SYS' id='mdb_name_SYS' class='addboxinput inputfocus'   value='<?php echo $mdb_name_SYS ?>' <?php echo $readonly ?> />
                    <div class='cols03 font_red yanzheng' id='mdb_name_SYS_bitian'></div>
                </li>
            </ul>
            <ul>
                <li class='cols01'>过程:</li>
                <li class='cols02'>
                    <?php
                    $sql2 = "select * from `msc_menubigclass` where sys_yfzuid='$hy' and sys_huis=0 ";
                    $rs2 = mysqli_query( $Connadmin, $sql2 );
                    echo( "<select name='Id_MenuBigClass'  class='addboxinput inputfocus'>" );
                    //echo( "<option  value='0'>未选择</option>" );
                    while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
                        $rowdid = $row2[ "id" ];
                        $sys_GuoChengMingChen = $row2[ "sys_GuoChengMingChen" ]; //部标准名称
                        echo( "<option  value='$rowdid' " );
                        if ( $Id_MenuBigClass == $rowdid ) {
                            echo( 'selected' );
                        }
                        echo( ">{$sys_GuoChengMingChen}</option>" );
                    }
                    echo( '</select>' );
                    mysqli_free_result( $rs2 ); //释放内存

                    ?>
                    <div class='cols03 font_red yanzheng' id='Id_MenuBigClass_bitian'></div>
                </li>
            </ul>
            <ul>
                <li class='cols01'>所属标准:</li>
                <li class='cols02'>
                    <?php
                    $sql2 = "select * from `msc_standard` where sys_yfzuid='$hy' and sys_huis=0 ";
                    $rs2 = mysqli_query( $Connadmin, $sql2 );
                    echo( "<select name='sys_id_standard'  class='addboxinput inputfocus'>" );
                    //echo( "<option  value='0'>未选择</option>" );
                    while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
                        $rowdid = $row2[ "id" ];
                        $number = $row2[ "number" ]; //标准编号
                        $name = $row2[ "name" ]; //部标准名称
                        echo( "<option  value='$rowdid' " );
                        if ( $parent_id == $rowdid ) {
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
                <li class='cols01'>版本:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='banben' id='banben' class='addboxinput inputfocus'   value='<?php echo $banben ?>'/>
                    <div class='cols03 font_red yanzheng' id='banben_bitian'></div>
                </li>
            </ul>
            <ul>
                <li class='cols01'>修改次数:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='xiugaicishu' id='xiugaicishu' class='addboxinput inputfocus'   value='<?php echo $xiugaicishu ?>'/>
                    <div class='cols03 font_red yanzheng' id='xiugaicishu_bitian'></div>
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
                    <input type='hidden' typeid='1' name='parent_id' id='parent_id' class='addboxinput inputfocus'  value='<?php echo $parent_id ?>' />
                    <input id='SYS_submit' value='提 交' type='button' title='Ctrl+Enter提交' class='button button_ADD'  onclick="add_edit_mobile(this,'<?php echo $phpstart ?>_edit.php','edit_mobile','<?php echo $phpstart ?>.php?parent_id=<?php echo $parent_id ?>&id=<?php echo $parent_id2 ?>')"    />
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
mysqli_close( $Connadmin ); //关闭数据库 
mysqli_close( $Conn ); //关闭数据库 
?>
