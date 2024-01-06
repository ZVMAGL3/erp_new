<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Standard_terms_Set.php'; //连上参数设定

//================================================================以下为处理数据
if ( isset( $_POST[ 'act' ] ) )$act = $_POST[ 'act' ]; //act

//echo($_POST[ 'data' ]);

if ( $act == 'add_mobile' ) { //当接收到处理指令时
    //----------------------------------查询是否有重复值
    //echo $hy;
    if ( isset( $_POST[ 'sys_card' ] ) )$sys_card = $_POST[ 'sys_card' ]; //标准名称
    if ( isset( $_POST[ 'tiaok' ] ) )$tiaok = $_POST[ 'tiaok' ]; //标准号
    //if ( isset( $_POST[ 'parent_id' ] ) )$parent_id = $_POST[ 'parent_id' ]; //标准号
    if ( isset( $_POST[ 'Id_MenuBigClass' ] ) )$Id_MenuBigClass = $_POST[ 'Id_MenuBigClass' ]; //所属标准
    if ( isset( $_POST[ 'sys_beizhu' ] ) )$sys_beizhu = $_POST[ 'sys_beizhu' ]; //标准内容

    if ( $sys_card . '1' == '1' ) {
        echo "$textsname名称，不能为空！";
    } else {
        $sql = $rs = $record_count = '';
        $sql = "select id From `$tablename` where ($colsname='$sys_card' or yyzzhao='$yyzzhao') and sys_yfzuid='$hy' order by id Asc";
        //echo $sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        $record_count = mysqli_num_rows( $rs ); //统计总记录数
        mysqli_free_result( $rs ); //释放内存

        if ( $record_count > 0 ) { //有重复值时
            echo "已有\"" . $sys_card . "\",禁止添加。";
        } else { //允许添加
            //echo"可以添加";
            $sql = $rs = '';
            $nowdata = date( 'Y-m-d H:i:s' );

            $sys_postzd_list = "$colsname,tiaok,Id_MenuBigClass,sys_beizhu,sys_huis,sys_id_login,sys_login,sys_yfzuid,sys_id_fz,sys_id_bumen,sys_adddate"; //加上系统默认值
            $sys_postvalue_list = "'$sys_card','$tiaok','$Id_MenuBigClass','$sys_beizhu','0','$bh','$SYS_UserName','$hy','$const_id_fz','$const_id_bumen','$nowdata'";
            //echo $sys_postvalue_list;
            //--------------------------------------以下为执行添加
            $sql = "insert into `$tablename` ($sys_postzd_list) values ($sys_postvalue_list)";
            mysqli_query( $Connadmin, $sql ); //执行添加
            echo "添加成功！"; /*这里只能禁止修改*/
        }

        //-------------------------------------自动条款 排序处理
        $sql = "select id,tiaok From `$tablename` where `Id_MenuBigClass`='$Id_MenuBigClass' and sys_yfzuid='$hy' order by id Asc";
        //echo $sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        $record_count = mysqli_num_rows( $rs ); //统计总记录数
        $tiaok = '';
        while ( $row = mysqli_fetch_array( $rs ) ) {
            //$i++;
            $id2 = $row[ 'id' ]; //id
            $tiaok = $row[ 'tiaok' ]; // 标准条款
            //$sys_bh = $row[ 'sys_bh' ]; // 标准编号

            $sys_bh_val = $sys_bh = '';
            $sys_bh_weizhi = strpos( $tiaok . '.', "." ); //查找字符串首次出现的位置
            for ( $i = 0; $i < $sys_bh_weizhi; $i++ ) {
                $sys_bh_val .= '0';
            };
            $sys_bh = preg_replace( '/[^0123456789]/s', '', $tiaok ) . '0000000000';
            $sys_bh = substr( $sys_bh, 0, 6 ) . $sys_bh_val; //排序编号*/
            //$sys_bh = preg_replace( '/^0*/', '', $sys_bh ) ;//去掉以零开头的数字

            //-------------------------------------执行更新
            $sql2 = "update `$tablename` set `sys_bh` = '$sys_bh' where `id`={$id2}";
            //echo $sql2;
            mysqli_query( $Connadmin, $sql2 ); //执行添加与更新
        }
        mysqli_free_result( $rs ); //释放内存
        //-------------------------------------自动条款 排序处理 end if
    }

    //echo $sys_card;
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
    <div id="header"> <a href="<?php echo $phpstart ?>.php?id=<?php echo $id ?>" class="home"></a> <em class="eleft"><?php echo $textsname ?> 添加</em> <a href="#" class="siteMap"></a> </div>
    <form autocomplete='off' οnsubmit='return false' οnkeydοwn="if(event.keyCode==13){return false;}">
        <div id='mobanaddbox' class='NowULTable nocopytext' > 
            <!--   !-->
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font>条款号:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='tiaok' id='tiaok' class='addboxinput inputfocus'  value='<?php echo $tiaok ?>'  />
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font>条款名称:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='sys_card' id='sys_card' class='addboxinput inputfocus'  value='<?php echo $sys_card ?>'   />
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            <ul>
                <li class='cols01'>标准内容:</li>
                <li class='cols02'>
                    <textarea name="sys_beizhu" class='addboxinput inputfocus'><?php echo $sys_beizhu ?></textarea>
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            <ul>
                <li class='cols01'>所属标准:</li>
                <li class='cols02'>
                    <?php
                    $sql2 = "select * from `msc_standard` where sys_yfzuid='$hy' and sys_huis=0 ";
                    $rs2 = mysqli_query( $Connadmin, $sql2 );
                    echo( "<select name='Id_MenuBigClass'  class='addboxinput inputfocus'>");
                    //echo( "<option  value='0'>未选择</option>" );
                    while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
                        $rowdid = $row2[ "id" ];
                        $number = $row2[ "number" ]; //标准编号
                        $name = $row2[ "name" ]; //部标准名称
                        echo( "<option  value='$rowdid' " );
                        if ( $id == $rowdid ) {
                            echo( 'selected' );
                        }
                        echo( ">{$number}&nbsp;{$name}</option>" );
                    }
                    echo( '</select>' );
                    mysqli_free_result( $rs2 ); //释放内存

                    ?>
                </li>
            </ul>
            <?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
            <ul>
                <li class='cols01'> &nbsp;</li>
                <li class='cols02'>
                    <input id='reset_add' type='reset' value='重填' tabindex=-1 class='button button_reset' onclick=inputfocusfirst('#mobanaddbox','tiaok') />
                    <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD'  onclick="add_edit_mobile(this,'<?php echo $phpstart ?>_add.php','add_mobile','<?php echo $phpstart ?>.php?id=<?php echo $id ?>')"    />
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
<script type="text/javascript" src="../../js/jq.host_mobile.js"></script>
<?php
}
mysqli_close( $Connadmin ); //关闭数据库 
?>
