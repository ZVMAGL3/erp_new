<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once '../../inc/B_conn.php';
include_once '../../inc/B_Config.php'; //执行接收参数及配置
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Jurisdiction_Set.php'; //连上参数设定
include_once '../../inc/Function_All.php';

//================================================================以下为处理数据

if ( isset( $_POST[ 'act' ] ) )$act = $_POST[ 'act' ]; //act
if ( isset( $_REQUEST[ 'id' ] ) )$id = $_REQUEST[ 'id' ]; //id
if ( $act == 'edit_mobile' ) { //当接收到处理指令时
    //----------------------------------查询是否有重复值
    //echo $hy;
    if ( isset( $_POST[ 'SYS_UserName' ] ) )$SYS_UserName = $_POST[ 'SYS_UserName' ]; //姓名
    if ( isset( $_POST[ 'SYS_GongHao' ] ) )$SYS_GongHao = $_POST[ 'SYS_GongHao' ]; //工号
    if ( isset( $_POST[ 'SYS_ShouJi' ] ) )$SYS_ShouJi = $_POST[ 'SYS_ShouJi' ]; //手机
    if ( isset( $_POST[ 'SYS_QuanXian' ] ) )$SYS_QuanXian = $_POST[ 'SYS_QuanXian' ]; //职位
    if ( isset( $_POST[ 'SYS_XingBie' ] ) )$SYS_XingBie = $_POST[ 'SYS_XingBie' ]; //性别
    if ( isset( $_POST[ 'sys_web_shenpi' ] ) )$state = $_POST[ 'sys_web_shenpi' ]; //是否允许登录

    if ( '1' . $SYS_UserName == '1' || '1' . $SYS_GongHao == '1' || '1' . $SYS_ShouJi == '1' ) {
        echo "数据不能为空！";
    } else {
        $sql = $rs = $record_count = '';
        $sql = "select id From msc_user_hy where (SYS_GongHao = $SYS_GongHao OR SYS_ShouJi = $SYS_ShouJi) and sys_yfzuid='$hy' and user_id <> $id";
        //echo $sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        $record_count = mysqli_num_rows( $rs ); //统计总记录数
        mysqli_free_result( $rs ); //释放内存

        if ( $record_count > 0 ) { //有重复值时
            echo "已有工号\手机号,禁止修改。";
            //都不能重复!!!
        } else { //允许修改
            //echo"可以修改";
            $sql = "select id,SYS_GongHao From msc_user_hy where sys_yfzuid='$hy' and user_id <> $id";
            $rs = mysqli_query( $Connadmin, $sql );
            $row = mysqli_fetch_array( $rs );
            $numNumber = mysqli_num_rows($rs);
            mysqli_free_result( $rs ); //释放内存
            $SYS_GongHao_old = $numNumber ? $row['SYS_GongHao'] : false;
            if($SYS_GongHao_old != $SYS_GongHao){
                if($SYS_GongHao_old){
                    $sql = "
                        UPDATE sys_top_menu 
                        SET 
                            sys_id_login = $SYS_GongHao
                        WHERE sys_id_login='$SYS_GongHao_old' and sys_yfzuid = $hy;
                    ";
                    // echo $sql;
                    //--------------------------------------以下为执行修改
                    mysqli_multi_query( $Conn, $sql ); //执行修改
                }else{
                    $sql = "
                        INSERT INTO sys_top_menu (sys_id_login, sys_yfzuid)
                        VALUES ($SYS_GongHao, $hy);
                    ";
                    // echo $sql;
                    //--------------------------------------以下为执行修改
                    mysqli_multi_query( $Conn, $sql ); //执行修改
                }
            }
            if($id > 0){
                $sql = "
                    UPDATE msc_user_hy 
                    SET 
                        state = $state,
                        SYS_GongHao = $SYS_GongHao,
                        zhiwei_id = '$SYS_QuanXian'
                    WHERE user_id='$id';

                    UPDATE msc_user_reg
                    SET 
                        SYS_UserName = '$SYS_UserName',
                        SYS_ShouJi = $SYS_ShouJi,
                        SYS_XingBie = '$SYS_XingBie'
                    WHERE id='$id';
                ";
                // echo $sql;
                //--------------------------------------以下为执行修改
                mysqli_multi_query( $Connadmin, $sql ); //执行修改
                // echo mysqli_error($Connadmin);
                echo "修改成功！"; /*这里只能禁止修改*/
            }else{
                $sql = "
                    INSERT INTO msc_user_reg (SYS_UserName, SYS_ShouJi, SYS_XingBie)
                    VALUES ('$SYS_UserName', $SYS_ShouJi, '$SYS_XingBie');
                
                    SET @last_user_reg_id = LAST_INSERT_ID();
                
                    INSERT INTO msc_user_hy (user_id, state, SYS_GongHao, zhiwei_id, sys_yfzuid)
                    VALUES (@last_user_reg_id, $state, $SYS_GongHao, '$SYS_QuanXian', $hy);
                ";
                //--------------------------------------以下为执行修改
                mysqli_multi_query( $Connadmin, $sql ); //执行修改
                // echo mysqli_error($Connadmin);
                echo "添加成功！"; /*这里只能禁止修改*/
            }
        }
    }
    //echo $SYS_ShouJi;
} else {
    //查询到相关值
    if ( $id > 0 ) {
        $sql = "
            select reg.SYS_UserName,reg.SYS_ShouJi,hy.SYS_GongHao,reg.SYS_XingBie,hy.zhiwei_id,hy.state,reg.SYS_a_logintime,reg.SYS_b_logintime,reg.SYS_ZD_DengLuCiShu,reg.sys_adddate
            From msc_user_hy AS hy
            JOIN msc_user_reg AS reg ON reg.id = hy.user_id
            where 
                hy.state in(0,1,2)
                and hy.sys_yfzuid = '$hy'
                and hy.user_id = $id
                order by hy.state desc
        ";
        //echo $sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        $row = mysqli_fetch_array( $rs );
        $SYS_UserName = $row[ 'SYS_UserName' ]; //姓名
        $SYS_GongHao = $row[ 'SYS_GongHao' ]; //工号
        $SYS_ShouJi = $row[ 'SYS_ShouJi' ]; //手机
        $SYS_QuanXian = $row[ 'zhiwei_id' ]; //职位
        $SYS_a_logintime = $row[ 'SYS_a_logintime' ]; //上一次登录时间
        $SYS_b_logintime = $row[ 'SYS_b_logintime' ]; //最近登录时间
        $SYS_ZD_DengLuCiShu = $row[ 'SYS_ZD_DengLuCiShu' ]; //登录次数
        $SYS_XingBie = $row[ 'SYS_XingBie' ]; //性别
        $sys_web_shenpi = $row[ 'state' ]; //是否允许登录
        $sys_adddate = $row[ 'sys_adddate' ]; //添加时间

        mysqli_free_result( $rs ); //释放内存
    }else{
        $SYS_UserName = $SYS_ShouJi = $SYS_QuanXian =  '';
        $sys_web_shenpi = $SYS_GongHao = 0;
    }
    if(!$SYS_GongHao){
        $sql="select max(SYS_GongHao) AS SYS_GongHao From msc_user_hy AS hy where sys_yfzuid = $hy";
        $rs = mysqli_query( $Connadmin, $sql );
        $row = mysqli_fetch_array( $rs );
        $SYS_GongHao = $row[ 'SYS_GongHao' ] + 1; //工号
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

    <?php echo $act; ?>
<div id="wrapper">
    <div id="header"> <a href="<?php echo $phpstart ?>.php?id=<?php echo $id ?>" class="home"></a> <em class="eleft"><?php echo $textsname ?> 修改</em> <a href="M_right_menu.php" class="siteMap"></a> </div>
    <form autocomplete='off' onsubmit='return false' onkeydown="if(event.keyCode==13){return false;}">
        <div id='mobanaddbox' class='NowULTable nocopytext' >
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font>&nbsp;工号:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='SYS_GongHao' id='SYS_GongHao' class='addboxinput inputfocus'  value='<?php echo $SYS_GongHao ?>' onkeydown="if(event.keyCode == 13){return false;}" />
                    <div class='cols03 font_red yanzheng' id='SYS_GongHao_bitian'></div>
                </li>
            </ul>
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;姓名:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='SYS_UserName' id='SYS_UserName' class='addboxinput inputfocus'  value='<?php echo $SYS_UserName ?>'   onkeydown="if(event.keyCode == 13){return false;}" />
                    <div class='cols03 font_red yanzheng' id='SYS_UserName_bitian'></div>
                </li>
            </ul>
            <ul>
                <li class='cols01'>性别:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='SYS_XingBie' id='SYS_XingBie' class='addboxinput inputfocus radio_xinbie'  value='<?php echo $SYS_XingBie ?>'   onkeydown="if(event.keyCode == 13){return false;}" />
                    <div class='cols03 font_red yanzheng' id='SYS_XingBie_bitian'></div>
                </li>
            </ul>
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font>&nbsp;手机号:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='SYS_ShouJi' id='SYS_ShouJi' class='addboxinput inputfocus'  value='<?php echo $SYS_ShouJi ?>'onkeydown="if(event.keyCode == 13){return false;}" />
                    <div class='cols03 font_red yanzheng' id='SYS_ShouJi_bitian'></div>
                </li>
            </ul>
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;职位:</li>
                <li class='cols02'>
                    <?php
                        echo( "<select id='SYS_QuanXian' class='select SYS_QuanXian'  name='SYS_QuanXian'>" );

                        $bumenlistStorage = array();
                        // $SYS_QuanXian_str = implode(',',$SYS_QuanXian_list);
                        allPosition(0,$bumenlistStorage,0,'parent',$SYS_QuanXian);

                        echo( '</select>' );

                        //mysqli_close( $Connadmin ); //关闭数据库 
                    ?>
                </li>
            </ul>
            <ul>
                <li class='cols01'>允许登录:</li>
                <li class='cols02'>
                    <input type="text"  class='addboxinput inputfocus radio' name="sys_web_shenpi" id="sys_web_shenpi_1" value='<?php echo $sys_web_shenpi ?>' >
                    <div class='cols03 font_red yanzheng' id='sys_web_shenpi_bitian'></div>
                </li>
            </ul>
            <?php
                if($id > 0){
            ?>
            <ul>
                <li class='cols01'>注册时间:</li>
                <li class='cols02'>&nbsp;<?php echo $sys_adddate ?></li>
            </ul>
            <ul>
                <li class='cols01'>上次登录时间:</li>
                <li class='cols02'>&nbsp;<?php echo $SYS_a_logintime ?></li>
            </ul>
            <ul>
                <li class='cols01'>最近登录时间:</li>
                <li class='cols02'>&nbsp;<?php echo $SYS_b_logintime ?></li>
            </ul>
            <ul>
                <li class='cols01'>登录次数:</li>
                <li class='cols02'>&nbsp;<?php echo $SYS_ZD_DengLuCiShu ?></li>
            </ul>

            <?php 
                }
                if ( getN( $sys_q_tianj, 256 ) >= 0 ) { //有添加权限时     
            ?>
            <ul>
                <li class='cols01'> &nbsp;</li>
                <li class='cols02'>
                    <input id='SYS_submit' value='提 交' type='button' title='Ctrl+Enter提交' class='button button_ADD' onclick="add_edit_mobile(this,'<?php echo $phpstart ?>_edit.php','edit_mobile','<?php echo $phpstart ?>.php?act=list')"/>
                </li>
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
<script type="text/javascript" src="../../js/fSelect.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	Fselect('.select','_');
    Fradio('.radio','_');
    Fradio_xinbie('.radio_xinbie');
});

</script>
<?php
}
?>
