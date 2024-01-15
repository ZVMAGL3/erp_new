<?php

use PhpMyAdmin\Di\Item;

header( 'Content-type: text/html; charset=utf-8' ); //设定本页编码
include_once '../session.php';
include_once 'B_quanxian.php';
include_once '../inc/Function_All.php';
include_once '../inc/B_Config.php'; //执行接收参数及配置
include_once '../inc/B_conn.php';
include_once '../inc/B_Connadmin.php';
include_once '../inc/Sub_All.php';
//接收参数开始
$r_cow_height = 27;
if ( $r_cow_height > 40 ) {
    $r_cow_height = 40;
} else {
    $r_cow_height = 27;
}; //当值大于40时使用40
$dbb = $strmkzd = $strmk = $mdb_name = $nowziduan = '';
$databiao = Find_tablename( $re_id );
//echo $databiao;
if ( isset( $_REQUEST[ 'dbb' ] ) )$dbb = htmlspecialchars( $_REQUEST[ 'dbb' ] ); //
if ( isset( $_REQUEST[ 'strmkzd' ] ) )$strmkzd = htmlspecialchars( trim( $_REQUEST[ 'strmkzd' ] ) ); //更新动态接收
if ( isset( $_REQUEST[ 'strmk' ] ) )$strmk = htmlspecialchars( trim( $_REQUEST[ 'strmk' ] ) ); //更新动态接收
if ( isset( $_REQUEST[ 'mdb_name' ] ) )$mdb_name = htmlspecialchars( trim( $_REQUEST[ 'mdb_name' ] ) ); //修改备注字段名称
if ( isset( $_REQUEST[ 'zd' ] ) )$nowziduan = htmlspecialchars( trim( $_REQUEST[ 'zd' ] ) ); //字段接收

if ( isset( $_REQUEST[ 'sys_guanxibiao_id' ] ) ) {
    $sys_guanxibiao_id = intval( $_REQUEST[ 'sys_guanxibiao_id' ] );
} else {
    $sys_guanxibiao_id = '';
}; //关系表re_id
if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ) {
    $GuanXi_id = intval( $_REQUEST[ 'GuanXi_id' ] );
} else {
    $GuanXi_id = "";
}; //关系列id
if ( isset( $_REQUEST[ 'ToHtmlID' ] ) ) {
    $ToHtmlID = $_REQUEST[ 'ToHtmlID' ];
}; //j显示页面
switch ( $act ) {
    case 'jbsd': //基本设定
        jbsd();
        break;
    case 'moban_set_liucheng': //流程
        moban_set_liucheng();
        break;
    case 'liucheng_save':
        liucheng_save();
        break;
    case 'liucheng_del':
        liucheng_del();
        break;
    case 'moban_set_quanxian': //职责权限
        listdata();
        // moban_set_quanxian();
        break;
    case 'moban_set_Liyi': //利益
        moban_set_Liyi();
        break;
    case 'list': //所有字段
        ZiDuanList();
        break;
    case 'xianshiquanxian': //显示权限设定
        xianshiquanxian();
        break;
    case 'moban_check': //模版选择
        moban_check();
        break;
    case 'xianshifenye': //显示分页
        xianshifenye();
        break;
    case 'GuanXi': //关系
        GuanXi();
        break;
    case 'GuanXiadd': //关系添加
        GuanXiadd();
        break;
    case 'GuanXi_Del': //关系解除
        GuanXi_Del();
        break;
    case 'GuanXi_ZiDuanChange': //关系字段获取
        GuanXi_ZiDuanChange();
        break;
    case 'GuanXi_ZiDuanChange_POST': //关系id对应字段添加与修改
        GuanXi_ZiDuanChange_POST();
        break;
    case 'GuanXi_ZiDuanChange_Hengxiang_POST': //关系id对应字段添加与修改横向
        GuanXi_ZiDuanChange_Hengxiang_POST();
        break;
    case 'GuanXi_TableNameChange_POST': //关系表添加与修改
        GuanXi_TableNameChange_POST();
        break;
    case 'GuanXiaddHeng': //关系表对应字段添加与修改
        GuanXiaddHeng();
        break;

    case 'bigmenu': //大类菜单
        bigmenu();
        break;

    case 'GuanXi_Back': //显示页面的前端关系控制返回
        GuanXi_Back();
        break;
    case 'GetPage_Back': //获得id及关系对应值返回
        GetPage_Back();
        break;
    case 'picget': //图片库加载
        picget();
        break;
    default:
        echo NoZhiLing();
};
mysqli_close( $Conn ); //关闭数据库
//mysqli_close( $Connadmin ); //关闭云数据库
//[ok]======================================================================================================基本设定
function jbsd() {
    global $Conn, $reg_name, $reg_database, $reg_banben, $regid, $hy, $bh, $re_id, $ToHtmlID, $big_id, $sys_jlbhzt, $maxrecord, $nowlockd, $nowgsbh, $sys_zcxh, $nowzzzt, $userjib, $SYS_UserName, $nowbianhao, $sys_id_fz, $SYS_QuanXian, $bumen_id, $sys_q_tianj, $sys_q_xiug, $sys_q_shanc, $sys_q_cak, $sys_q_dayin, $sys_q_huis, $sys_q_seid, $sys_q_dian, $sys_q_shenghe, $sys_q_pizhun, $sys_q_zu, $All_XT_ZiDuan, $sys_q_disabled, $sys_id_login; //全局变量

    if ( $sys_id_login != 1 ) { //无权限时
        echo "<script>$('#{$ToHtmlID}_content_foot input,#{$ToHtmlID}_content_foot select').attr('disabled',true);</script>";
    }
    if ( $re_id <> 0 ) {

        $nowcard = $nowstartdate = $nowzt = $nowbh = $nowbeizhu = $nowok = $nowidzu = $fenlei_K_G = $databiao_SYS_nows = '';
        $sql = 'select sys_card,startdate,sys_zt,sys_zt_bianhao,sys_bh,beizhu,ul_row_height,ok,sys_id_zu,fenlei_K_G,sys_banshi,mdb_name,mdb_name_SYS,Mtiaoshu From Sys_jlmb where id=' . $re_id;
        $rs = mysqli_query( $Conn, $sql );
        $row = mysqli_fetch_array( $rs );
        if ( $row ) {
            $nowcard = $row[ 'sys_card' ];
            $nowstartdate = $row[ 'startdate' ];
            $nowzt = $row[ 'sys_zt' ];
            $nowbh = $row[ 'sys_zt_bianhao' ]; //字头编号
            $nowbeizhu = $row[ 'beizhu' ];
            $nowrow_height = $row[ 'ul_row_height' ];
            $nowok = $row[ 'ok' ];
            $nowidzu = $row[ 'sys_id_zu' ];
            $fenlei_K_G = $row[ 'fenlei_K_G' ]; //开启关闭0为开启分类，1分关闭分类
            $sys_banshi = $row[ 'sys_banshi' ]; //1数据表，2文件自动化
            $databiao_SYS_nows = htmlspecialchars( trim( $row[ 'mdb_name_SYS' ] ) ); //原数据表名
            $Nowmaxrecord = intval( $row[ 'Mtiaoshu' ] ); //页显示数
            //echo $databiao_SYS_nows.'_'.$re_id;

        } else {
            echo( '对不起，没找到表Sys_jlmb相关记录。' );
        };
        mysqli_free_result( $rs ); //释放内存
        $now_change = "Pinyin_Table(this,'$ToHtmlID')";

        echo( "<div id='bbsTabntq' class='NowULTable' style='text-align:right;width:600px;padding-top:16px;' tit='" . $All_XT_ZiDuan . "'>" );
        echo( "<ul><li class='w20'>表名:</li><li class='w80'><input type='text' name='sys_card' id='sys_card' class='addboxinput inputfocus' value='" . $nowcard . "' tit='" . $nowcard . "' Y_ziduan='" . $databiao_SYS_nows . "' onchange=" . $now_change . " $sys_q_disabled /> </li></ul>" );
        $now_change = '"' . "edit_table_col_js(this,this.type,'Sys_jlmb','id','" . $re_id . "',this.name,'','addbox','$ToHtmlID','pc')" . '"';
        echo( "<ul><li class='w20'>条款:</li><li class='w80'><input type='text' name='startdate' id='startdate' class='addboxinput inputfocus' value='$nowstartdate' tit='$nowstartdate' onkeyup=$now_change onchange=" . "List_Head_Get('$ToHtmlID')" . " $sys_q_disabled/> </li></ul>" );

        echo( "<ul><li class='w20'>字头:</li><li class='w80'><input type='text' name='sys_zt' id='sys_zt' class='addboxinput inputfocus' value='" . $nowzt . "' tit='" . $nowzt . "' onkeyup=" . $now_change . " onchange=" . "List_Head_Get('$ToHtmlID')" . " $sys_q_disabled/> </li></ul>" );

        echo( "<ul><li class='w20'>起始编号:</li><li class='w80'><input type='text' name='sys_zt_bianhao' id='sys_zt_bianhao' class='addboxinput inputfocus' value='" . $nowbh . "' tit='" . $nowbh . "' onkeyup=" . $now_change . " onchange=" . "List_Head_Get('$ToHtmlID')" . " $sys_q_disabled/> </li></ul>" );

        echo( "<ul><li class='w20'>行高:</li><li class='w80'><input type='text' name='ul_row_height' id='ul_row_height' class='addboxinput inputfocus' value='" . $nowrow_height . "' tit='" . $nowzt . "' onchange=" . $now_change . " $sys_q_disabled/> </li></ul>" );

        echo( "<ul><li class='w20'>开启分类:</li><li><label><input name='fenlei_K_G' type='radio' id='fenlei_K_G_0' value='0' onclick=" . $now_change . " checked='checked' $sys_q_disabled/>&nbsp;开启&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><label><input name='fenlei_K_G' type='radio' id='fenlei_K_G_1' onclick=" . $now_change . "  value='1' $sys_q_disabled/>&nbsp;关闭</label><script>radiochecek('fenlei_K_G','$fenlei_K_G','$ToHtmlID')</script> </li></ul>" );
        echo( "<ul><li class='w20'>使用数据表:</li>" );
        echo( "<li>" );

        if ( '1' . $databiao_SYS_nows != '1' ) { //当没有初始化时
            //echo( " $sys_q_disabled>&nbsp;原表未初始化，&nbsp;点此[ 初始化 ]" );
            //} else {
            echo( "$sys_q_disabled>&nbsp;表&nbsp;[ $databiao_SYS_nows ]" );
        };

        echo( '</li></ul>' );


        //echo ("<ul><li class='w20'>页显示数:</li><li><input type='text' name='Mtiaoshu' id='Mtiaoshu' class='addboxinput inputfocus' value='".$Nowmaxrecord."' tit='".$Nowmaxrecord."' onkeyup=".$now_change." onchange=""List_Head_Get('$ToHtmlID')""/> </li></ul>");

        echo( "<ul><li class='w20'>每页显示数:</li><li><select name='Mtiaoshu'  onchange=" . $now_change . " class='addboxinput inputfocus' style='width:120px;' $sys_q_disabled>" ); //ListGet('".$ToHtmlID."');
        echo( "<option  value='10' " );
        if ( $Nowmaxrecord == 10 )echo( 'selected' );
        echo( '>10条</option>' );
        echo( "<option  value='20' " );
        if ( $Nowmaxrecord == 20 )echo( 'selected' );
        echo( '>20条</option>' );
        echo( "<option  value='30' " );
        if ( $Nowmaxrecord == 30 )echo( 'selected' );
        echo( '>30条</option>' );
        echo( "<option  value='40' " );
        if ( $Nowmaxrecord == 40 )echo( 'selected' );
        echo( '>40条</option>' );
        echo( "<option  value='50' " );
        if ( $Nowmaxrecord == 50 )echo( 'selected' );
        echo( '>50条</option>' );
        echo( "<option  value='60' " );
        if ( $Nowmaxrecord == 60 )echo( 'selected' );
        echo( '>60条</option>' );
        echo( "<option  value='80' " );
        if ( $Nowmaxrecord == 80 )echo( 'selected' );
        echo( '>80条</option>' );
        echo( "<option  value='100' " );
        if ( $Nowmaxrecord == 100 )echo( 'selected' );
        echo( '>100条</option>' );
        echo( "<option  value='200' " );
        if ( $Nowmaxrecord == 200 )echo( 'selected' );
        echo( '>200条</option>' );

        echo( '</select></li></ul>' );

        echo( "<ul><li class='w20'>版式选择:</li><li><select name='sys_banshi'  onchange=" . $now_change . " class='addboxinput inputfocus' style='width:120px;' $sys_q_disabled>" ); //ListGet('".$ToHtmlID."');
        echo( "<option  value='1' " );
        if ( $sys_banshi == 1 )echo( 'selected' );
        echo( '>01 数据表格</option>' );
        echo( "<option  value='2' " );
        if ( $sys_banshi == 2 )echo( 'selected' );
        echo( '>02 文件自动化</option>' );
        echo( "<option  value='3' " );
        if ( $sys_banshi == 3 )echo( 'selected' );
        echo( '>03 其它</option>' );


        echo( '</select></li></ul>' );

        //echo( "<ul><li class='w20'>版式选择:</li><li>数据表格</li></ul>" );

        echo( "<ul><li class='w20'>修复模板:</li><li><input id=\"SYS_submit$ToHtmlID\" value=\"修复\" type=\"button\" class=\"button\" style=\"width:120px;margin-left:2px\" onclick=\"UpdatePhp_one_page($re_id)\"></li></ul>" );
        echo( "</div></br></br><script>inputfocusfirst('#addbox .htmlleirong','sys_card');</script>" );
        //setTimeout(function(){$('#bbsTabntq').height($('#addbox').height()*1-30);},500);
    };
};
//[ok]======================================================================================================流程

// function moban_set_liucheng() {
//     global $Conn, $reg_name, $reg_database, $reg_banben, $regid, $hy, $bh, $re_id, $ToHtmlID, $big_id, $sys_jlbhzt, $maxrecord, $nowlockd, $nowgsbh, $sys_zcxh, $nowzzzt, $userjib, $SYS_UserName, $nowbianhao, $sys_id_fz, $SYS_QuanXian, $bumen_id, $sys_q_tianj, $sys_q_xiug, $sys_q_shanc, $sys_q_cak, $sys_q_dayin, $sys_q_huis, $sys_q_seid, $sys_q_dian, $sys_q_shenghe, $sys_q_pizhun, $sys_q_zu, $All_XT_ZiDuan, $sys_q_disabled, $sys_id_login; //全局变量

//     if ( $sys_id_login != 1 ) { //无权限时
//         echo "<script>$('#{$ToHtmlID}_content_foot input,#{$ToHtmlID}_content_foot select').attr('disabled',true);</script>";
//     }
//     if ( $re_id <> 0 ) {

//         $nowcard = $nowstartdate = $nowzt = $nowbh = $nowbeizhu = $nowok = $nowidzu = $fenlei_K_G = $databiao_SYS_nows = '';
//         $sql = 'select sys_card,startdate,sys_zt,sys_zt_bianhao,sys_bh,beizhu,ul_row_height,ok,sys_id_zu,fenlei_K_G,mdb_name,mdb_name_SYS,Mtiaoshu From Sys_jlmb where id=' . $re_id;
//         // echo $sql;
//         $rs = mysqli_query( $Conn, $sql );
//         $row = mysqli_fetch_array( $rs );
//         if ( $row ) {
//             $nowcard = $row[ 'sys_card' ];
//             $nowstartdate = $row[ 'startdate' ];
//             $nowzt = $row[ 'sys_zt' ];
//             $nowbh = $row[ 'sys_zt_bianhao' ]; //字头编号
//             $nowbeizhu = $row[ 'beizhu' ];
//             $nowrow_height = $row[ 'ul_row_height' ];
//             $nowok = $row[ 'ok' ];
//             $databiao_SYS_nows = htmlspecialchars( trim( $row[ 'mdb_name_SYS' ] ) ); //原数据表名
//             $Nowmaxrecord = intval( $row[ 'Mtiaoshu' ] ); //页显示数
//         } else {
//             echo( '对不起，没找到表Sys_jlmb相关记录。' );
//         };
//         mysqli_free_result( $rs ); //释放内存


//         echo( "<div id='bbsTabntq' class='NowULTable_LiuCheng' tit='" . $All_XT_ZiDuan . "'>" );
//         echo "<ul>";
//         $sql = "select * From `Sys_GuanXiBiao` where sys_re_id_02='$re_id' and sys_huis=0 order by id asc";
//         $rs = mysqli_query( $Conn, $sql );
//         $nowrscount = mysqli_num_rows( $rs ); //统计数量
//         if ( $nowrscount > 0 ) { //有时输出
//             while ( $row = mysqli_fetch_array( $rs ) ) {
//                 $id = $row[ 'id' ];
//                 $sys_re_id01 = $row[ 'sys_re_id' ];
//                 $databiaoCNname01 = Find_table_CNname_fromre_id( $sys_re_id01 ); //表的中文名称
//                 echo "<li>$databiaoCNname01</li>";
//             }
//         } else {
//             echo "<li style='border:1px solid #333;background-color:#CCC;color:#333;'>未设定上级关系表</li>";
//         }
//         mysqli_free_result( $rs ); //释放内存


//         echo "</ul>";

//         echo "<ul style='width:35px;clear:right;text-align:center;border:0;'>";
//         echo "<a><i class='fa fa-zhuanyi'></i></a>";
//         echo "</ul>";

//         echo "<ul>";
//         echo "<li style='background-color:#666;'> {$nowcard}</li>";
//         echo "</ul>";

//         echo "<ul style='width:35px;clear:right;text-align:center;border:0;'>";
//         echo "<a><i class='fa fa-zhuanyi'></i></a>";
//         echo "</ul>";

//         echo "<ul>";
//         $sql = "select * From `Sys_GuanXiBiao` where sys_re_id='$re_id' and sys_huis=0 order by id asc";
//         $rs = mysqli_query( $Conn, $sql );
//         $nowrscount = mysqli_num_rows( $rs ); //统计数量
//         if ( $nowrscount > 0 ) { //有时输出
//             while ( $row = mysqli_fetch_array( $rs ) ) {
//                 $id = $row[ 'id' ];
//                 $sys_re_id01 = $row[ 'sys_re_id_02' ];
//                 $databiaoCNname01 = Find_table_CNname_fromre_id( $sys_re_id01 ); //表的中文名称
//                 echo "<li>$databiaoCNname01</li>";
//             }
//         } else {
//             echo "<li style='border:1px solid #333;background-color:#CCC;color:#333;'>未设定下级关系表</li>";
//         }
//         mysqli_free_result( $rs ); //释放内存

//         echo "</ul>";


//         echo "</div>";

//     };
// };
//[ok]======================================================================================================流程
function moban_set_liucheng()
{
    global $db_vip,$re_id; //全局变量
    
    $data = array(
        'result' => null,
        're_id' => $re_id,
        'sys_card' => null,
        'data' => array()
    );
    $query = "select DISTINCT sys_card From sys_jlmb where id = ?";
    $params = [$re_id];
    $queryResult = $db_vip->query($query, $params);
    if ($queryResult['error'] == null)
    {
        if ($db_vip->numRows($queryResult['result']) > 0) 
        {
            $result = mysqli_fetch_assoc($queryResult['result']);
            $data['sys_card'] = $result['sys_card'];
            liucheng_data($data,$re_id,$db_vip);
        }else{
            $data['result'] = array(
                'id' => 1,
                'resultText' => "该单元不在可操作的流程中!"
            );
        }
    }else{
        $data['result'] = array(
            'id' => 1,
            'resultText' => "数据库错误:" . $queryResult['error'] . "!"
        );
    }
   
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
};
function liucheng_data(&$data,$re_id,$db_vip)
{
    $query = "select DISTINCT liucheng_id From sys_liucehngfenzhi where my_id = ? AND sys_huis = 0";
    $params = [$re_id];
    $queryResult = $db_vip->query($query, $params);
    if ($queryResult['error'] == null) 
    {
        if ($db_vip->numRows($queryResult['result']) > 0) 
        {
            try 
            {
            //     $db_vip->beginTransaction();
                while($result = mysqli_fetch_assoc($queryResult['result']))
                {
                    liucheng_data_son($data,$result['liucheng_id'],$db_vip);
                }
                // $db_vip->commit();
            }
            catch (Exception $e) 
            {
                // $db_vip->rollback(); // 发生异常，回滚事务
                $data['result'] = array(
                    'id' => 1,
                    'resultText' => '异常错误:'.$e->getMessage()
                );
                exit();
            }
        }
        else
        {
            $data['result'] = array(
                'id' => 0,
                'resultText' => "该单元没有配置相关流程!"
            );
        }
    }
    else
    {
        $data['result'] = array(
            'id' => 1,
            'resultText' => "数据库错误:" . $queryResult['error'] . "!"
        );
    }
};
function liucheng_data_son(&$data,$re_id,$db_vip)
{
    global $hy;
    try 
    {
        $db_vip->beginTransaction();

        $liucheng = array(
            'LiuChengName' => null,
            'error' => null,
            're_id' => $re_id,
            'LiuCheng' => array()
        );
        $query = "select LiuChengName From sys_liuchengbiao where id = ? AND sys_yfzuid = ?;";
        $params = [$re_id,$hy];
        $queryResult = $db_vip->query($query, $params);
        if ($queryResult['error'] == null) 
        {
            if ($db_vip->numRows($queryResult['result']) > 0) 
            {
                $result =  mysqli_fetch_assoc($queryResult['result']);
                $liucheng['LiuChengName'] = $result['LiuChengName'];
                try 
                {
                    $db_vip->beginTransaction();
                    liucheng_fenzhi($liucheng,$re_id,$db_vip,0);
                    $data['data'][] = $liucheng;
                }
                catch (Exception $e) 
                {
                    $db_vip->rollback(); // 发生异常，回滚事务
                    $liucheng['result'] = '存在异常:'.$e->getMessage();
                }
            }
            else
            {
                $db_vip->rollback(); // 发生异常，回滚事务
                $liucheng['error'] = "流程'".$re_id."'不存在!";
                exit();
            }
        }
        else
        {
            $db_vip->rollback(); // 发生异常，回滚事务
            $liucheng['error'] = "数据库通讯错误:".$queryResult['error'];
            exit();
        }
        $db_vip->commit();
    }
    catch (Exception $e) 
    {
        $db_vip->rollback(); // 发生异常，回滚事务
        $data['error'] = array(
            'id' => 2,
            'resultText' => '存在异常:'.$e->getMessage()
        );
        exit();
    }
}
function liucheng_fenzhi(&$liucheng,$re_id,$db_vip,$previous_id)
{
    $query = "
        SELECT liu.id,liu.my_id,jlmb.sys_card
        FROM sys_liucehngfenzhi as liu
        JOIN sys_jlmb as jlmb ON liu.my_id = jlmb.id
        WHERE liucheng_id = ? AND previous_id = ? AND liu.sys_huis = 0;
    ";
    $params = [$re_id,$previous_id];
    $queryResult = $db_vip->query($query, $params);
    if ($queryResult['error'] == null) 
    {
        if ($db_vip->numRows($queryResult['result']) > 0) 
        {
            $result =  mysqli_fetch_assoc($queryResult['result']);
            $liucheng['LiuCheng'][]= array(
                're_id' => $result['my_id'],
                'sys_card' => $result['sys_card']
            );
            liucheng_fenzhi($liucheng,$re_id,$db_vip,$result['id']);
        }
        else
        {
            $db_vip->commit();
        }
    }
    else
    {
        $db_vip->rollback();
        $liucheng['error'] = '存在异常:'.$queryResult['error'];
    }
};
function liucheng_save()
{
    global $db_vip,$re_id,$hy;
    if ( isset( $_REQUEST[ 'data' ] ) )
    {
        $data = $_REQUEST[ 'data' ]; //更新动态接收
    }
    else
    {
        error_json('数据传输错误!');
    }
    $FlowLink = $data['FlowLink'];
    if($re_id == 0)
    {
        try 
        {
            $db_vip->beginTransaction();
            $query = "INSERT INTO sys_liuchengbiao (LiuChengName, sys_yfzuid) VALUES ( ? , ? );";
            $params = [$data['LiuChengName'],$hy];
            $queryResult = $db_vip->query($query, $params);
            if ($queryResult['error'] == null) 
            {
                $LiuCheng_id = $db_vip -> getLastInsertId();
                $previous_id = 0;
                foreach($FlowLink as $item ){
                    liucheng_fenzhi_add($LiuCheng_id,$previous_id,$item,$db_vip);
                }
            }
            else
            {
                error_json('数据库通讯错误:'.$queryResult['error'],$db_vip);
            }
            $db_vip->commit();

            //返回数据
            echo json_encode(array(
                'error' => null,
                'LiuCheng_id' => $LiuCheng_id
            ),JSON_UNESCAPED_UNICODE);
            exit();
        }
        catch (Exception $e) 
        {
            error_json('异常错误:'.$e->getMessage(),$db_vip);
        }
    }
    else
    {
        try 
        {
            $db_vip->beginTransaction();
            $LiuChengName = $data['LiuChengName'];
            $query = "
                UPDATE sys_liuchengbiao
                SET LiuChengName = ?
                WHERE id = ?;
            ;";
            $params = [$LiuChengName,$re_id];
            $queryResult = $db_vip->query($query, $params);
            if ($queryResult['error'] == null)
            {
                $index = array();
                $oldData = array();
                $previous_id = 0;
                liucheng_oldData($index,$oldData,$re_id,$db_vip);
                foreach($FlowLink as $item)
                {
                    $idx = array_search($item, $index);
                    if($idx !== false)
                    {
                        if($oldData[$idx]['previous_id'] != $previous_id)
                        {
                            $query = "
                                UPDATE sys_liucehngfenzhi
                                SET previous_id = ?,sys_huis = 0
                                WHERE id = ?;
                            ;";
                            $params = [$previous_id,$oldData[$idx]['id']];
                            $queryResult = $db_vip->query($query, $params);
                        }
                        $previous_id = $oldData[$idx]['id'];
                        $index[$idx] = null;
                    }
                    else
                    {
                        liucheng_fenzhi_add($re_id,$previous_id,$item,$db_vip);
                    }
                }
                foreach($index as $key => $item)
                {
                    if($item)
                    {
                        $query = "
                            UPDATE sys_liucehngfenzhi
                            SET sys_huis = 1
                            WHERE id = ?;
                        ;";
                        // echo $query;
                        $params = [$oldData[$key]['id']];
                        // echo json_encode($params,JSON_UNESCAPED_UNICODE);
                        $queryResult = $db_vip->query($query, $params);
                    }
                }
            }
            else
            {
                $db_vip->rollback(); // 发生异常，回滚事务
                echo json_encode(array(
                    'error' => '异常错误:'.$queryResult['error'].'.请刷新页面重试.'
                ),JSON_UNESCAPED_UNICODE);
                exit();
            }
            $db_vip->commit();

            //返回数据
            echo json_encode(array(
                'error' => null
            ),JSON_UNESCAPED_UNICODE);
            exit();
        }
        catch (Exception $e) 
        {
            $db_vip->rollback(); // 发生异常，回滚事务
            echo json_encode(array(
                'error' => '异常错误:'.$e->getMessage().'请重试'
            ),JSON_UNESCAPED_UNICODE);
            exit();
        }
    }
}
function liucheng_oldData(&$index,&$oldData,$re_id,$db_vip)
{
    $query = "
        SELECT id,previous_id,my_id
        FROM sys_liucehngfenzhi
        WHERE liucheng_id = ?;
    ;";
    $params = [$re_id];
    $queryResult = $db_vip->query($query, $params);
    if ($queryResult['error'] == null)
    {
        if($db_vip->numRows($queryResult['result']) > 0) 
        {
            while($result = mysqli_fetch_assoc($queryResult['result']))
            {
                $index[]=$result['my_id'];
                $oldData[]=array(
                    'id' => $result['id'],
                    'previous_id' => $result['previous_id']
                );
            }
        }
        else
        {
            error_json('异常错误,请刷新页面重试.',$db_vip);
        }
    }
    else
    {
        error_json('异常错误:'.$queryResult['error'].'.请刷新页面重试.',$db_vip);
    }
}
function liucheng_fenzhi_add($re_id,&$previous_id,$my_id,$db_vip)
{
    $query = "INSERT INTO sys_liucehngfenzhi (liucheng_id, previous_id, my_id) VALUES ( ? , ? , ? );";
    $params = [$re_id,$previous_id,$my_id];
    $queryResult = $db_vip->query($query, $params);
    if ($queryResult['error'] == null) 
    {
        $previous_id = $db_vip -> getLastInsertId();
    }
    else
    {
        error_json('数据库通讯错误:'.$queryResult['error'],$db_vip);
    }
}
function liucheng_del()
{
    global $re_id,$db_vip;

    $db_vip->beginTransaction();

    $query = "
        UPDATE sys_liuchengbiao
        SET sys_huis = 1
        WHERE id = ?;
    ";
    $params = [$re_id];
    $queryResult = $db_vip->query($query, $params);
    if ($queryResult['error'] == null) 
    {
        $query = "
            UPDATE sys_liucehngfenzhi
            SET sys_huis = 1
            WHERE liucheng_id = ?;
        ";
        $params = [$re_id];
        $queryResult = $db_vip->query($query, $params);
        if ($queryResult['error'] == null) 
        {
            $db_vip->commit();
            error_json(null);
        }
        else
        {
            error_json('数据库通讯错误:'.$queryResult['error'],$db_vip);
        }
    }
    else
    {
        error_json('数据库通讯错误:'.$queryResult['error'],$db_vip);
    }
}
function error_json($error,$db_vip = null)
{
    if($db_vip)
    {
        $db_vip->rollback(); // 发生异常，回滚事务
    }
    echo json_encode(array(
        'error' => $error
    ),JSON_UNESCAPED_UNICODE);
    exit();
}
//[ok]======================================================================================================权限管理
function moban_set_quanxian() {
    global $Conn, $Connadmin, $hy, $re_id, $ToHtmlID, $SYS_QuanXian, $sys_q_seid, $All_XT_ZiDuan,$sys_id_login; //全局变量

    if ( $sys_id_login != 1 or $sys_q_seid == -1 ) { //无权限时
        echo "<script>$('#{$ToHtmlID}_content_foot input,#{$ToHtmlID}_content_foot select').attr('disabled',true);</script>";
    }
    if ( $re_id <> 0 ) {
        //========================================================================================== 职位清单
        echo( "<div class='NowULTable touming' style='margin:25px;text-align:right;width:auto;padding-top:10px;border-bottom:1px solid #666;' tit='" . $All_XT_ZiDuan . "'>" );
        $listyle = " style='width:80px;background:#666;color:#FFF;margin-right:5px;border-radius: 5px 0px 5px 0px;border-left:0;border-right:0;text-align:center;' ";
        echo "<ul style='padding-left:0px;padding-right:1px;border-bottom:1px solid #333;border-top:0;border-left:2px solid #F2F2F2;border-right:2px solid #F2F2F2;height:29px;line-height:29px;background-color:#F2F2F2'>";
        echo( "<li style='width:120px;text-align:right;font-weight: bold;'>&nbsp;</li>" );
        echo( "<li  style='width:150px;background:#999;margin-right:5px;border-radius: 5px 0px 5px 0px;text-align:center;' >管辖范围</li>" );
        echo( "<li $listyle>查看</li>" );
        echo( "<li $listyle>编制人</li>" );
        echo( "<li $listyle>修订人</li>" );
        echo( "<li $listyle>审核人</li>" );
        echo( "<li $listyle>批准人</li>" );
        echo( "<li $listyle>经办人</li>" );
        echo( "<li $listyle>删除</li>" );
        echo( "<li $listyle>回收</li>" );
        echo( "<li $listyle>打印</li>" );
        echo( "<li $listyle>销毁</li>" );
        echo( "<li $listyle>设置</li>" );
        $listyle2 = " style='width:80px;background:#F2F2F2;color:#000;margin-right:5px;border-radius: 5px 0px 5px 0px;border-left:0;border-right:0;text-align:center;' ";
        echo( "<li $listyle2>全选</li>" );
        echo "</ul>";
        $sql = "select * From msc_ZhiWei where sys_yfzuid='$hy' and sys_huis=0 order by bumen Asc";
        $rs = mysqli_query( $Connadmin, $sql );
        while ( $row = mysqli_fetch_array( $rs ) ) {
            $id = $row[ 'id' ];
            $zu = $row[ 'zu' ];
            $sys_q_fanwei = $row[ 'sys_q_fanwei' ]; //权限范围
            $sys_q_cak = $row[ 'sys_q_cak' ]; //查看
            $sys_q_tianj = $row[ 'sys_q_tianj' ]; //编制
            $sys_q_xiug = $row[ 'sys_q_xiug' ]; //修订
            $sys_q_shenghe = $row[ 'sys_q_shenghe' ]; //审核
            $sys_q_pizhun = $row[ 'sys_q_pizhun' ]; //批准
            $sys_q_zhixing = $row[ 'sys_q_zhixing' ]; //经办
            $sys_q_shanc = $row[ 'sys_q_shanc' ]; //删除
            $sys_q_huis = $row[ 'sys_q_huis' ]; //回收
            $sys_q_dayin = $row[ 'sys_q_dayin' ]; //打印
            $sys_q_xiaohui = $row[ 'sys_q_xiaohui' ]; //销毁
            $sys_q_seid = $row[ 'sys_q_seid' ]; //设置
            if ( $id == $SYS_QuanXian ) {
                $backcolor = "background-color:#999;";
            } else {
                $backcolor = "";
            }
            echo "<ul style='{$backcolor}border-bottom:1px solid #999;border-top:0;border-left:2px solid #666;border-right:2px solid #666;height:29px;line-height:29px;'>";

            echo "<li style='width:120px;text-align:right;font-weight: bold;'>{$zu}:&nbsp;</li>";
            //------------------------------------------------------管辖范围
            echo "<li style='width:150px;text-align:center;font-weight: bold;margin-right:5px;'>";
            echo "<select name=\"sys_q_fanwei\" at=\"{$re_id}\" bumenid=\"{$id}\" id=\"sys_q_fanwei\" onchange=\"thistripnt('Edit_ZWquanxian_Update',this,'$hy')\" class=\"addboxinput inputfocus touming \" type=\"select\" style=\"width:100%;height:100%;border:0;margin:0;padding:0;\">";
            if ( getN( $sys_q_fanwei, $re_id . '_0', ',' ) >= 0 ) {
                $selected = " selected = 'selected' ";
            } else {
                $selected = "";
            };
            echo "<option value=\"0\" $selected>个人</option>";
            if ( getN( $sys_q_fanwei, $re_id . '_1', ',' ) >= 0 ) {
                $selected = " selected = 'selected' ";
            } else {
                $selected = "";
            };
            echo "<option value=\"1\" $selected>部门</option>";
            if ( getN( $sys_q_fanwei, $re_id . '_2', ',' ) >= 0 ) {
                $selected = " selected = 'selected' ";
            } else {
                $selected = "";
            };
            echo "<option value=\"2\" $selected>公司/分公司</option>";
            if ( getN( $sys_q_fanwei, $re_id . '_3', ',' ) >= 0 ) {
                $selected = " selected = 'selected' ";
            } else {
                $selected = "";
            };
            echo "<option value=\"3\" $selected>总公司/集团</option>";

            echo "</select>";
            echo "</li>";
            //------------------------------------------------------查看
            $listyle = "style='width:80px;text-align:center;margin-right:5px;'";
            $onchange = " thistripnt_zhiwei('Edit_ZWquanxian_Update',this,'$hy') ";
            if ( getN( $sys_q_cak, $re_id, ',' ) >= 0 ) {
                $checked = " checked = 'checked' ";
            } else {
                $checked = "";
            };
            echo "<li $listyle><label><input name=\"sys_q_cak\" onchange=\"$onchange\" type=\"checkbox\" $checked value=\"{$id}\" bumenid=\"{$id}\" at=\"{$re_id}\"></label></li>";
            //------------------------------------------------------添加
            if ( getN( $sys_q_tianj, $re_id, ',' ) >= 0 ) {
                $checked = " checked = 'checked' ";
            } else {
                $checked = "";
            };
            echo "<li $listyle><label><input name=\"sys_q_tianj\" onchange=\"$onchange\" type=\"checkbox\" $checked value=\"{$id}\" bumenid=\"{$id}\" at=\"{$re_id}\"></label></li>";
            //------------------------------------------------------修改
            if ( getN( $sys_q_xiug, $re_id, ',' ) >= 0 ) {
                $checked = " checked = 'checked' ";
            } else {
                $checked = "";
            };
            echo "<li $listyle><label><input name=\"sys_q_xiug\" onchange=\"$onchange\" type=\"checkbox\" $checked value=\"{$id}\" bumenid=\"{$id}\" at=\"{$re_id}\"></label></li>";
            //------------------------------------------------------查看
            if ( getN( $sys_q_shenghe, $re_id, ',' ) >= 0 ) {
                $checked = " checked = 'checked' ";
            } else {
                $checked = "";
            };
            echo "<li $listyle><label><input name=\"sys_q_shenghe\" onchange=\"$onchange\" type=\"checkbox\" $checked value=\"{$id}\" bumenid=\"{$id}\" at=\"{$re_id}\"></label></li>";
            //------------------------------------------------------查看
            if ( getN( $sys_q_pizhun, $re_id, ',' ) >= 0 ) {
                $checked = " checked = 'checked' ";
            } else {
                $checked = "";
            };
            echo "<li $listyle><label><input name=\"sys_q_pizhun\" onchange=\"$onchange\" type=\"checkbox\" $checked value=\"{$id}\" bumenid=\"{$id}\" at=\"{$re_id}\"></label></li>";
            //------------------------------------------------------查看
            if ( getN( $sys_q_zhixing, $re_id, ',' ) >= 0 ) {
                $checked = " checked = 'checked' ";
            } else {
                $checked = "";
            };
            echo "<li $listyle><label><input name=\"sys_q_zhixing\" onchange=\"$onchange\" type=\"checkbox\" $checked value=\"{$id}\" bumenid=\"{$id}\" at=\"{$re_id}\"></label></li>";
            //------------------------------------------------------查看
            if ( getN( $sys_q_shanc, $re_id, ',' ) >= 0 ) {
                $checked = " checked = 'checked' ";
            } else {
                $checked = "";
            };
            echo "<li $listyle><label><input name=\"sys_q_shanc\" onchange=\"$onchange\" type=\"checkbox\" $checked value=\"{$id}\" bumenid=\"{$id}\" at=\"{$re_id}\"></label></li>";
            //------------------------------------------------------查看
            if ( getN( $sys_q_huis, $re_id, ',' ) >= 0 ) {
                $checked = " checked = 'checked' ";
            } else {
                $checked = "";
            };
            echo "<li $listyle><label><input name=\"sys_q_huis\" onchange=\"$onchange\" type=\"checkbox\" $checked value=\"{$id}\" bumenid=\"{$id}\" at=\"{$re_id}\"></label></li>";
            //------------------------------------------------------查看
            if ( getN( $sys_q_dayin, $re_id, ',' ) >= 0 ) {
                $checked = " checked = 'checked' ";
            } else {
                $checked = "";
            };
            echo "<li $listyle><label><input name=\"sys_q_dayin\" onchange=\"$onchange\" type=\"checkbox\" $checked value=\"{$id}\" bumenid=\"{$id}\" at=\"{$re_id}\"></label></li>";
            //------------------------------------------------------查看
            if ( getN( $sys_q_xiaohui, $re_id, ',' ) >= 0 ) {
                $checked = " checked = 'checked' ";
            } else {
                $checked = "";
            };
            echo "<li $listyle><label><input name=\"sys_q_xiaohui\" onchange=\"$onchange\" type=\"checkbox\" $checked value=\"{$id}\" bumenid=\"{$id}\" at=\"{$re_id}\"></label></li>";
            //------------------------------------------------------查看
            if ( getN( $sys_q_seid, $re_id, ',' ) >= 0 ) {
                $checked = " checked = 'checked' ";
            } else {
                $checked = "";
            };
            echo "<li $listyle><label><input name=\"sys_q_seid\" onchange=\"$onchange\" type=\"checkbox\" $checked value=\"{$id}\" bumenid=\"{$id}\" at=\"{$re_id}\"></label></li>";
            if ( $sys_id_login == 1 ) {
                echo "<li $listyle  bumenid=\"{$id}\" re_id=\"{$re_id}\" onclick='thistripnt_hengxiang(this)'>横选</li>";
            } else {
                echo "<li $listyle  bumenid=\"{$id}\" re_id=\"{$re_id}\" ><font color='#CCC'>横选</font></li>";
            }
            echo "</ul>";
        };
        mysqli_free_result( $rs ); //释放内存
        echo( "</div>" );

    };
};
//[ok]======================================================================================================利益公司
function moban_set_Liyi() {
    global $Conn, $Connadmin, $re_id, $reg_name, $reg_database, $reg_banben, $regid, $hy, $bh, $re_id, $ToHtmlID, $big_id, $sys_jlbhzt, $maxrecord, $nowlockd, $nowgsbh, $sys_zcxh, $nowzzzt, $userjib, $SYS_UserName, $nowbianhao, $sys_id_fz, $SYS_QuanXian, $bumen_id, $sys_q_tianj, $sys_q_xiug, $sys_q_shanc, $sys_q_cak, $sys_q_dayin, $sys_q_huis, $sys_q_seid, $sys_q_dian, $sys_q_shenghe, $sys_q_pizhun, $sys_q_zu, $All_XT_ZiDuan, $sys_q_disabled, $sys_id_login; //全局变量
    //echo $re_id;
    if ( $sys_id_login != 1 or $sys_q_seid == -1 ) { //无权限时
        echo "<script>$('#{$ToHtmlID}_content_foot input,#{$ToHtmlID}_content_foot select').attr('disabled',true);</script>";
    }
    if ( $re_id > 0 ) {

        $nowcard = $nowstartdate = $nowzt = $nowbh = $nowbeizhu = $nowok = $nowidzu = $fenlei_K_G = $databiao_SYS_nows = '';
        $sql = 'select sys_card,startdate,sys_jiangli_rmb,sys_jiangli_jifen,sys_chufa_rmb,sys_chufa_jifen,sys_zt,sys_zt_bianhao,sys_bh,beizhu,ul_row_height,ok,sys_id_zu,fenlei_K_G,mdb_name,mdb_name_SYS,Mtiaoshu From Sys_jlmb where id=' . $re_id;
        //echo $sql;
        $rs = mysqli_query( $Conn, $sql );
        $row = mysqli_fetch_array( $rs );
        if ( $row ) {
            $nowcard = $row[ 'sys_card' ];
            $nowstartdate = $row[ 'startdate' ];
            $sys_jiangli_rmb = $row[ 'sys_jiangli_rmb' ]; //奖励现金
            $sys_jiangli_jifen = $row[ 'sys_jiangli_jifen' ]; //奖励积分
            $sys_chufa_rmb = $row[ 'sys_chufa_rmb' ]; //处罚现金
            $sys_chufa_jifen = $row[ 'sys_chufa_jifen' ]; //处罚积分
            $nowzt = $row[ 'sys_zt' ];
            $nowbh = $row[ 'sys_zt_bianhao' ]; //字头编号
            $nowbeizhu = $row[ 'beizhu' ];
            $nowrow_height = $row[ 'ul_row_height' ];
            $nowok = $row[ 'ok' ];
            $databiao_SYS_nows = htmlspecialchars( trim( $row[ 'mdb_name_SYS' ] ) ); //原数据表名
            $Nowmaxrecord = intval( $row[ 'Mtiaoshu' ] ); //页显示数
        } else {
            echo( '对不起，没找到表Sys_jlmb相关记录。' );
        };
        mysqli_free_result( $rs ); //释放内存
        $now_change = "Pinyin_Table(this,'$ToHtmlID')";

        //========================================================================================== 职位清单
        echo( "<div class='NowULTable touming' style='margin:25px;text-align:right;width:auto;padding-top:10px;border-bottom:1px solid #666;border-top:0' tit='" . $All_XT_ZiDuan . "'>" );
        $listyle = " style='width:100px;background:#333;color:#FFF;margin-right:5px;border-radius: 5px 0px 5px 0px;border-left:0;border-right:0;text-align:center;' ";
        echo "<ul style='padding-left:0px;padding-right:1px;border-bottom:0px solid #333;border-top:0;border-left:2px solid #F2F2F2;border-right:2px solid #F2F2F2;height:29px;line-height:29px;background-color:#F2F2F2'>";
        echo( "<li style='width:120px;text-align:right;font-weight: bold;'>&nbsp;</li>" );

        echo( "<li $listyle>查看</li>" );
        echo( "<li $listyle>编制</li>" );
        echo( "<li $listyle>修订</li>" );
        echo( "<li $listyle>审核</li>" );
        echo( "<li $listyle>批准</li>" );
        echo( "<li $listyle>经办</li>" );
        echo( "<li $listyle>删除</li>" );
        echo( "<li $listyle>回收</li>" );
        echo( "<li $listyle>打印</li>" );
        echo( "<li $listyle>销毁</li>" );
        echo( "<li $listyle>设置</li>" );
        //$listyle2=" style='width:100px;background:#F2F2F2;color:#000;margin-right:5px;border-radius: 5px 0px 5px 0px;border-left:0;border-right:0;text-align:center;' ";
        //echo( "<li $listyle2>全选</li>" );
        echo "</ul>";


        //=========================================================奖励
        echo "<ul style='background-color:#999;color:#000;border-bottom:1px solid #999;border-top:0;border-left:2px solid #666;border-right:2px solid #666;height:35px;line-height:35px;'>&nbsp;&nbsp;<strong>奖励：</strong></ul>";

        echo "<ul style='border-bottom:1px solid #999;border-top:0;border-left:2px solid #666;border-right:2px solid #666;height:35px;line-height:35px;'>";
        echo "<li style='width:120px;text-align:right;font-weight: bold;'>现金（元）：&nbsp;</li>";
        //------------------------------------------------------查看
        $listyle = "style='width:100px;text-align:center;margin-right:5px;'";
        $listyleinput = "style='width:98px;text-align:center;margin-right:5px;background:#CCC;border:1px solid #CCC;'";
        $listyleinputcheck = "style='width:98px;text-align:center;margin-right:5px;background:#666;border:1px solid #666;color:#FFF'";

        $onchange = " JiangFaUpdate(this,'$ToHtmlID') ";
        $nowval = textN( $sys_jiangli_rmb, 0, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_jiangli_rmb\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\" /></li>";
        //------------------------------------------------------添加
        $nowval = textN( $sys_jiangli_rmb, 1, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_jiangli_rmb\" onchange=\"$onchange\" $listyleinputcheck type=\"text\" value=\"{$nowval}\" /></li>";
        //------------------------------------------------------修改
        $nowval = textN( $sys_jiangli_rmb, 2, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_jiangli_rmb\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\" /></li>";
        //------------------------------------------------------审核
        $nowval = textN( $sys_jiangli_rmb, 3, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_jiangli_rmb\" onchange=\"$onchange\" $listyleinputcheck type=\"text\" value=\"{$nowval}\" /></li>";
        //------------------------------------------------------批准
        $nowval = textN( $sys_jiangli_rmb, 4, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_jiangli_rmb\" onchange=\"$onchange\" $listyleinputcheck type=\"text\" value=\"{$nowval}\" /></li>";
        //------------------------------------------------------执行
        $nowval = textN( $sys_jiangli_rmb, 5, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_jiangli_rmb\" onchange=\"$onchange\" $listyleinputcheck type=\"text\" value=\"{$nowval}\" /></li>";
        //------------------------------------------------------删除
        $nowval = textN( $sys_jiangli_rmb, 6, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_jiangli_rmb\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\" /></li>";
        //------------------------------------------------------回收
        $nowval = textN( $sys_jiangli_rmb, 7, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_jiangli_rmb\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\" /></li>";
        //------------------------------------------------------打印
        $nowval = textN( $sys_jiangli_rmb, 8, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_jiangli_rmb\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\" /></li>";
        //------------------------------------------------------销毁
        $nowval = textN( $sys_jiangli_rmb, 9, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_jiangli_rmb\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\" /></li>";
        //------------------------------------------------------设置
        $nowval = textN( $sys_jiangli_rmb, 10, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_jiangli_rmb\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\" /></li>";

        echo "</ul>";
        //=========================================================处罚
        echo "<ul style='border-bottom:1px solid #999;border-top:0;border-left:2px solid #666;border-right:2px solid #666;height:35px;line-height:35px;'>";
        echo "<li style='width:120px;text-align:right;font-weight: bold;'>积分（分）：&nbsp;</li>";
        //------------------------------------------------------查看
        $nowval = textN( $sys_jiangli_jifen, 0, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_jiangli_jifen\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------添加
        $nowval = textN( $sys_jiangli_jifen, 1, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_jiangli_jifen\" onchange=\"$onchange\" $listyleinputcheck type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------修改
        $nowval = textN( $sys_jiangli_jifen, 2, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_jiangli_jifen\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------审核
        $nowval = textN( $sys_jiangli_jifen, 3, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_jiangli_jifen\" onchange=\"$onchange\" $listyleinputcheck type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------批准
        $nowval = textN( $sys_jiangli_jifen, 4, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_jiangli_jifen\" onchange=\"$onchange\" $listyleinputcheck type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------执行
        $nowval = textN( $sys_jiangli_jifen, 5, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_jiangli_jifen\" onchange=\"$onchange\" $listyleinputcheck type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------删除
        $nowval = textN( $sys_jiangli_jifen, 6, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_jiangli_jifen\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------回收
        $nowval = textN( $sys_jiangli_jifen, 7, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_jiangli_jifen\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------打印
        $nowval = textN( $sys_jiangli_jifen, 8, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_jiangli_jifen\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------销毁
        $nowval = textN( $sys_jiangli_jifen, 9, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_jiangli_jifen\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------设置
        $nowval = textN( $sys_jiangli_jifen, 10, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_jiangli_jifen\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\"></li>";
        echo "</ul>";
        echo "<ul style='border-bottom:1px solid #999;border-top:0;border-left:2px solid #666;border-right:2px solid #666;height:2px;line-height:2px;background-color:#FFF;'>&nbsp;&nbsp;</ul>";

        echo "<ul style='background-color:#999;color:#000;border-bottom:1px solid #999;border-top:0;border-left:2px solid #666;border-right:2px solid #666;height:35px;line-height:35px;'>&nbsp;&nbsp;<strong>处罚：</strong></ul>";
        //=========================================================处罚现金
        echo "<ul style='border-bottom:1px solid #999;border-top:0;border-left:2px solid #666;border-right:2px solid #666;height:35px;line-height:35px;'>";
        echo "<li style='width:120px;text-align:right;font-weight: bold;'>现金（元）：&nbsp;</li>";
        //------------------------------------------------------查看
        $nowval = textN( $sys_chufa_rmb, 0, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_chufa_rmb\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------添加
        $nowval = textN( $sys_chufa_rmb, 1, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_chufa_rmb\" onchange=\"$onchange\" $listyleinputcheck type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------修改
        $nowval = textN( $sys_chufa_rmb, 2, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_chufa_rmb\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------审核
        $nowval = textN( $sys_chufa_rmb, 3, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_chufa_rmb\" onchange=\"$onchange\" $listyleinputcheck type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------批准
        $nowval = textN( $sys_chufa_rmb, 4, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_chufa_rmb\" onchange=\"$onchange\" $listyleinputcheck type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------执行
        $nowval = textN( $sys_chufa_rmb, 5, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_chufa_rmb\" onchange=\"$onchange\" $listyleinputcheck type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------删除
        $nowval = textN( $sys_chufa_rmb, 6, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_chufa_rmb\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------回收
        $nowval = textN( $sys_chufa_rmb, 7, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_chufa_rmb\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------打印
        $nowval = textN( $sys_chufa_rmb, 8, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_chufa_rmb\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------销毁
        $nowval = textN( $sys_chufa_rmb, 9, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_chufa_rmb\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------设置
        $nowval = textN( $sys_chufa_rmb, 10, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_chufa_rmb\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\"></li>";
        echo "</ul>";
        //=========================================================处罚
        echo "<ul style='border-bottom:1px solid #999;border-top:0;border-left:2px solid #666;border-right:2px solid #666;height:35px;line-height:35px;'>";
        echo "<li style='width:120px;text-align:right;font-weight: bold;'>积分（分）：&nbsp;</li>";
        //------------------------------------------------------查看
        $nowval = textN( $sys_chufa_jifen, 0, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_chufa_jifen\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------添加
        $nowval = textN( $sys_chufa_jifen, 1, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_chufa_jifen\" onchange=\"$onchange\" $listyleinputcheck type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------修改
        $nowval = textN( $sys_chufa_jifen, 2, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_chufa_jifen\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------审核
        $nowval = textN( $sys_chufa_jifen, 3, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_chufa_jifen\" onchange=\"$onchange\" $listyleinputcheck type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------批准
        $nowval = textN( $sys_chufa_jifen, 4, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_chufa_jifen\" onchange=\"$onchange\" $listyleinputcheck type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------执行
        $nowval = textN( $sys_chufa_jifen, 5, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_chufa_jifen\" onchange=\"$onchange\" $listyleinputcheck type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------删除
        $nowval = textN( $sys_chufa_jifen, 6, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_chufa_jifen\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------回收
        $nowval = textN( $sys_chufa_jifen, 7, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_chufa_jifen\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------打印
        $nowval = textN( $sys_chufa_jifen, 8, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_chufa_jifen\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------销毁
        $nowval = textN( $sys_chufa_jifen, 9, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_chufa_jifen\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\"></li>";
        //------------------------------------------------------设置
        $nowval = textN( $sys_chufa_jifen, 10, ',' );
        if ( $nowval == '' ) {
            $nowval = 0;
        };
        echo "<li $listyle><input name=\"sys_chufa_jifen\" onchange=\"$onchange\" $listyleinput type=\"text\" value=\"{$nowval}\"></li>";
        echo "</ul>";
        echo( "</div>" );

    }
}
//【ok】======================================================================================================表单设计字段
function ZiDuanList() {
    global $Conn, $Connadmin, $hy, $ToHtmlID, $databiao, $sys_id_login, $All_XT_ZiDuan, $Axt_m_ziduan_hidden, $xt_m_ziduan, $xt_m_ziduan_Name, $r_cow_height, $re_id, $sys_q_disabled, $sys_q_seid; //得到全局变量
    //echo "</br><br>".$databiao;
    //echo $re_id;
    $sheet = ChangeConn( $databiao ); //依据表自动选择数据库
    if ( $sys_id_login != 1 ) { //无权限时
        echo "<script>$('#{$ToHtmlID}_content_foot input,#{$ToHtmlID}_content_foot select').attr('disabled',true);</script>";
    }

    $SeAot = '';
    if ( isset( $_REQUEST[ 'SeAot' ] ) )$SeAot = $_REQUEST[ 'SeAot' ]; //得到附加命令
    $nowSeAt = $SeAot;

    //-----------------------------------end
    echo( "<div class='tables  heeaadmenu2'>" );
    echo( "<ul class='thead' style='border-bottom:1px solid #999;'>" );
    echo( "<li style='border-top:0px;width:25px;'>&nbsp;</li>" );
    echo( "<li style='width:220px;'>字段名称</li>" );
    //echo( "<li style='width:120px;'>字段名称en</li>" );
    echo( "<li class='center' style='width:70px;' >显示宽度</li>" );
    echo( "<li class='center' style='width:70px;' >必填</li>" );
    echo( "<li class='center' style='width:70px;' >无重复</li>" );
    echo( "<li class='center' style='width:130px;' >显示样式</li>" );
    echo( "<li class='center' style='width:170px;' >默认值</li>" );
    echo( "<li class='center' style='width:100px;' >显示高度(px)</li>" );
    echo( "<li class='center' style='width:50px;' >删</li>" );
    //-------------------------------------------------------------查询到表的版式start
    $sql = 'select sys_banshi From Sys_jlmb where id=' . $re_id;
    $rs = mysqli_query( $Conn, $sql );
    $row = mysqli_fetch_array( $rs );
    $sys_banshi = $row[ 'sys_banshi' ]; //1数据表，2文件自动化
    mysqli_free_result( $rs ); //释放内存
        //-------------------------------------------------------------查询到表的版式end if
    if ( $sys_banshi == 2 ) {
        echo( "<li class='center' style='width:250px;' >对应自动替换变量</li>" );
    }

    echo( '</ul>' );
    echo( '</div>' );
    //echo $databiao;
    if ( '1' . $databiao == '1' ) {
        echo( "<div id='bbsTabntq' class='tables'  style='margin:0;margin-top:23px;'><table width='100%' height='100%' border='0' cellspacing='0' cellpadding='0'><tr><td><center><font color='red'  style='cursor:hand;' onclick=" . "moban_set_edit(this,'" . $ToHtmlID . "');" . "  style='cursor:hand;'><i class='fa fa-nodata'></i>&nbsp;" );
        echo( '未选择数据库表！请先选择后操作。' );
        echo( '</font></center></br></br></br></br></br></br></br></br></td></tr></table></div>' );
    } else {
        echo( "<div id='bbsTabntq' tit='" . $All_XT_ZiDuan . "' tablename='{$databiao}' class='tables'  style='margin:0;'>" ); //以下为得到表的所有字段清单
        echo( "<ul style='height:25px; line-height:25px;'></ul>" ); //增加顶部距离的
        //b.name AS leixin,;
        $sql = "SHOW FULL COLUMNS FROM `$databiao` "; //检查所有字段
        //echo $sql;
        //echo $colname;
        $rs = mysqli_query( $sheet, $sql );
        //$nowrscount=mysqli_num_rows($rs);//统计数量

        if ( $rs ) { //当有记录时
            while ( $row = mysqli_fetch_array( $rs ) ) {
                $zd_en_name = $row[ 'Field' ]; //字段名
                $zdbeizhu = $row[ 'Comment' ]; //备注
                $NEW_zdbeizhu = colbeizhu( $zdbeizhu, $zd_en_name );
                //---------------------------------------------------------------【将得到备注进行分解】
                //0【字段中文名称】,1【显示宽】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】
                $zd_cn_name = textN( $NEW_zdbeizhu, 0, ',' ); //字段中文名称
                $XSwidth = textN( $NEW_zdbeizhu, 1, ',' ); //显示宽
                $XSbitian = textN( $NEW_zdbeizhu, 2, ',' ); //必填1    0不必填
                $WuChongFu = textN( $NEW_zdbeizhu, 3, ',' ); //无重复1  0可重复
                $XStype = textN( $NEW_zdbeizhu, 4, ',' ); //样式id  0\1文本框
                $zd_xianshi_height = textN( $NEW_zdbeizhu, 10, ',' ); //显示高度
                $zd_xianshi_height_is = zd_xianshi_height_is( $XStype ); //是否允许调整高度 1允许
                $getN_XTZD = getN( $xt_m_ziduan, strtolower( $zd_en_name ) ); //判断系统字段

                if ( $getN_XTZD >= 0 ) { //为系统字段时
                    $zd_cn_name = textN( $xt_m_ziduan_Name, $getN_XTZD, ',' );
                    $sys_q_disabled = " disabled ";
                } else {
                    $sys_q_disabled = "";
                }
                if ( $zd_xianshi_height_is == 1 ) { //允许修改高度时
                    $displayer = " style='display:block;' ";
                } else { //
                    $displayer = " style='display:none;' ";
                }

                $zd_cn_name = SysChangeName( $zd_cn_name, $databiao ); //变更系统设定名
                //echo $zd_cn_name;
                if ( $zd_cn_name . '1' == '1' ) {
                    $zd_cn_name = $zd_en_name;
                }

                if ( '1' . $zdbeizhu == '1' )$zdbeizhu = $zd_en_name;


                $zhujian = htmlspecialchars( $row[ 'Key' ] ); //主键
                if ( $zhujian ) {
                    $zhujian = "<i class='fa fa-yaoshi' title='主键'></i>";
                    $WuChongFu = 1;
                    $XSbitian = 1;
                } else {
                    $zhujian = "<i class='fa fa-25-1'></i>";
                }
                $zd_Type = htmlspecialchars( $row[ 'Type' ] ); //类型
                $zd_long = zd_type_to_long( $zd_Type ); //允许输入的最大字数
                $zd_Extra = htmlspecialchars( $row[ 'Extra' ] ); //自动增量 为auto_increment
                $zd_Collation = htmlspecialchars( $row[ 'Collation' ] ); //字符集
                $zd_weikong = htmlspecialchars( $row[ 'Null' ] ); //为空
                $zd_Default = move_zkh( $row[ 'Default' ], "N',[,],'" ); //默认值
                $now_zd_Default = htmlspecialchars( $row[ 'Default' ] ); //默认值
                $moveul = '';
                if ( $zd_en_name <> 'id' ) {
                    $moveul = "moveul";
                }
                if ( SYS_is( $zd_en_name, 'sys_gx_id_' ) == 1 || SYS_is( $zd_en_name, 'sys_count_' ) == 1 ) {
                    $sys_q_disabled = " disabled ";
                }
                if ( getN( $Axt_m_ziduan_hidden, strtolower( $zd_en_name ) ) < 0 ) { //隐藏系统字段

                    //$wheretext = " mdb_name='" . $Table_Name . "' and zd_en_name='" . $zd_en_name . "'"; //这里是筛选条件
                    echo( "<ul class='ulbg hoverthis $moveul'>" ); //添加处
                    echo( "<li class='cols1 nocopytext' style='width:25px;vertical-align: middle;' title='$zd_en_name'>$zhujian</li>" );

                    //-------------------------------------------------------------------【字段名称】
                    echo( "<li style='width:220px;'><input name='zd_cn_name' type='text' style='width:97%'onchange=\"Pinyin_ziduan(this,'$ToHtmlID')\" nothis='nothis'  value='$zd_cn_name' tit='$zd_cn_name' Y_ziduan='$zd_en_name' class='pu' $sys_q_disabled ></li>" );
                    //echo( "<li style='width:120px;'>{$zd_en_name}</li>" );
                    //-------------------------------------------------------------------【显示宽度】
                    $now_change = "\"ziduan_beizhu_edit(this,'$databiao','$zd_en_name','$ToHtmlID')\"";

                    echo( "<li style='width:70px;' class='hui5'><input name='zd_xianshi_width' maxlength='3'  nothis='nothis' type='text' value='$XSwidth' Y_ziduan='$zd_en_name'  onchange=$now_change></li>" );
                    //-------------------------------------------------------------------【必填】
                    if ( $XSbitian == '1' ) {
                        $nowchecked = " checked ";
                    } else {
                        $nowchecked = '';
                    };
                    if ( SYS_is( $zd_en_name, 'sys_gx_id_' ) == 1 ) {
                        echo( "<li style='width:70px;'  class='center'><input name='qx_bitian' nothis='nothis' type='checkbox'  value='" . $XSbitian . "' Y_ziduan='$zd_en_name'  onclick=" . $now_change . " " . $nowchecked . " ></li>" );
                    } else {
                        echo( "<li style='width:70px;'  class='center'><input name='qx_bitian' nothis='nothis' type='checkbox'  value='" . $XSbitian . "' Y_ziduan='$zd_en_name'  onclick=" . $now_change . " " . $nowchecked . " $sys_q_disabled></li>" );
                    }


                    //-------------------------------------------------------------------【无重复】
                    if ( $WuChongFu == '1' ) {
                        $nowchecked = " checked ";
                    } else {
                        $nowchecked = '';
                    }
                    echo( "<li style='width:70px;'  class='center hui5'><input name='qx_wuchongfu' nothis='nothis' type='checkbox'  value='" . $WuChongFu . "' Y_ziduan='$zd_en_name'  onclick=" . $now_change . " " . $nowchecked . " $sys_q_disabled></li>" );

                    //-------------------------------------------------------------------【显示样式】
                    if ( $XStype == ''
                        or $XStype == '0' )$XStype = 1; //选中时执行
                    echo( "<li style='width:130px;' ><select name='XStype' type='select' Y_ziduan='$zd_en_name'  onchange={$now_change} $sys_q_disabled>" ); //ListGet('".$ToHtmlID."');
                    //echo( ">" );
                    $sql2 = "select * From  `msc_inputtype` where shengpi='1' order by id asc"; //查询到对应记录
                    $rs2 = mysqli_query( $Connadmin, $sql2 );
                    while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
                        $msc_id = $row2[ 'id' ]; //得到id
                        $msc_moren = $row2[ 'Moren' ]; //得到默认值
                        $msc_xsname = $row2[ 'xsname' ]; //得到xsname
                        $now_zd_xianshi_height_is = $row2[ 'zd_xianshi_height' ]; //得到zd_xianshi_height_is
                        echo( "<option title='id:$msc_id'  value='$msc_id' moren='$msc_moren' zd_xianshi_height_is='$now_zd_xianshi_height_is' " );
                        if ( $msc_id == $XStype )echo( 'selected' );
                        echo( ">$msc_xsname</option>" );
                    };
                    mysqli_free_result( $rs2 ); //释放内存
                    echo( "</select></li>" );
                    //-------------------------------------------------------------------【默认值】
                    echo( "<li style='width:170px;'  class='center hui5'><input name='zd_Default' nothis='nothis' type='text' value='$zd_Default' Y_ziduan='$zd_en_name' onchange=" . $now_change . " $sys_q_disabled></li>" );


                    //-------------------------------------------------------------------【显示高度】
                    echo( "<li style='width:100px;' class='center'><input name='zd_xianshi_height' maxlength='4' oninput = \"value=value.replace(/[^\d]/g,'')\"  nothis='nothis' type='text' value='$zd_xianshi_height' Y_ziduan='$zd_en_name'  onchange=$now_change  $displayer></li>" );
                    //-------------------------------------------------------------------【删除按钮】

                    if ( $sys_q_seid >= 0 and $getN_XTZD >= 0 or $sys_id_login != 1 or SYS_is( $zd_en_name, 'sys_gx_id_' ) == 1 or SYS_is( $zd_en_name, 'sys_count_' ) == 1 ) {

                        echo "<li class='center hui5 SeAttianjia SeAtxiugai del' style='width:50px;'  title='不能删除'><i class='fa fa-del-mini_h'></i></li>";
                    } else {
                        echo "<li class='center hui5 SeAttianjia SeAtxiugai del' style='width:50px;' onClick='delul(this,\"$ToHtmlID\")' title='删除'><i class='fa fa-del-mini'></i></li>";

                    };
                    //-------------------------------------------------------------------【备注原始】
                    if ( $sys_banshi == 2 ) { //2为文件自动化版式
                        echo( "<li style='width:250px;' class='bianliang'>$zd_en_name</li>" );
                    }

                    echo "</ul>";
                }
            }
        };
        mysqli_free_result( $rs ); //释放内存
        if ( $sys_id_login == 1 ) {
            echo( "<ul class='ulbg hoverthis nocopytext'><li class='cols1' style='width:25px;vertical-align: middle;'>*</li><li style='width:220px;' onclick='addquxianul(this)'><i class='fa fa-add'></i>添加</li></ul>" ); //添加处
        };

    } //else end
    echo "</div>";
    echo( "<ul style='height:200px'></br></ul>" ); //底下空白处
    //echo( "<script type=\"text/javascript\" src='../js/drag-arrange.js' charset='utf-8'></script>" );
    //echo( "<script>$('ul.thead li').not('li:first-child').arrangeable();</script>" );
    //echo( "<script>$('ul.moveul').not('ul:first-child').arrangeable();</script>" );
    //echo( "<script> $( '#bbsTabntq' ).DDSort({target: 'ul.movethis',floatStyle: {'border': '1px solid #ccc','background-color': '#fff'},up:function(){ZiDuanPaiXuJS('#bbsTabntq','" . $ToHtmlID . "')} });</script>" );

}
//===================================================================================【显示权限】
function xianshiquanxian() { //表单权限
    global $Conn, $Connadmin, $hy, $ToHtmlID, $sys_id_login, $databiao, $Axt_m_ziduan_hidden, $All_XT_ZiDuan, $xt_m_ziduan, $xt_m_ziduan_Name, $r_cow_height, $re_id, $sys_q_disabled; //得到全局变量
    //echo "</br><br>";
    $Conn = ChangeConn( $databiao ); //依据表自动选择数据库
    if ( $sys_id_login != 1 ) { //无权限时
        echo "<script>$('#{$ToHtmlID}_content_foot input,#{$ToHtmlID}_content_foot select').attr('disabled',true);</script>";
    }
    $SeAot = '';
    if ( isset( $_REQUEST[ 'SeAot' ] ) )$SeAot = $_REQUEST[ 'SeAot' ]; //得到附加命令
    $nowSeAt = $SeAot;

    //-----------------------------------end
    echo( "<div class='tables  heeaadmenu2' style='margin:0;border-right:0;margin-top:0px;'>" );
    echo( "<ul  class='thead' style='border-bottom:1px solid #999;padding:0;margin:0'>" );
    echo( "<li style='width:25px;'>&nbsp;</li>" );
    echo( "<li style='width:220px;'>字段名称</li>" );
    echo( "<li class='center' style='width:90px;' >显示列(PC端)</li>" );
    echo( "<li class='center' style='width:90px;' >冻结列(PC端)</li>" );
    echo( "<li class='center' style='width:90px;' >添加列</li>" );
    echo( "<li class='center' style='width:90px;' >修改列</li>" );
    echo( "<li class='center' style='width:90px;' >百度搜索</li>" );
    echo( "<li class='center' style='width:180px;' >&nbsp;</li>" );
    echo( "<li class='center' style='width:120px;' >显示列(mobile端)</li>" );
    echo( "<li class='center' style='width:120px;' >锁定列(mobile右端)</li>" );
    echo( '</ul>' );
    echo( '</div>' );

    if ( '1' . $databiao == '1' ) {
        echo( "<div id='bbsTabntq' class='tables'  style='margin:0;'><table width='100%' height='100%' border='0' cellspacing='0' cellpadding='0'><tr><td><center><font color='red'  style='cursor:hand;' onclick=" . "moban_set_edit(this,'$ToHtmlID');" . "  style='cursor:hand;'><i class='fa fa-nodata'></i>&nbsp;" );
        echo( '未选择数据库表！请先选择后操作。' );
        echo( '</font></center></br></br></br></br></br></br></br></br></td></tr></table></div>' );
    } else {

        echo( "<div id='bbsTabntq' tit='" . $All_XT_ZiDuan . "' tablename='{$databiao}' class='tables'  style='margin:0;'>" ); //以下为得到表的所有字段清单
        echo( "<ul style='height:25px; line-height:25px;'></ul>" ); //增加顶部距离的
        //b.name AS leixin,;

        $sql = "SHOW FULL COLUMNS FROM `$databiao` "; //检查所有字段

        //echo $sql;
        //echo $colname;
        $rs = mysqli_query( $Conn, $sql );
        //$nowrscount=mysqli_num_rows($rs);//统计数量

        if ( $rs ) { //当有记录时
            while ( $row = mysqli_fetch_array( $rs ) ) {
                $zd_en_name = $row[ 'Field' ]; //字段名
                $zdbeizhu = $row[ 'Comment' ]; //备注
                $NEW_zdbeizhu = colbeizhu( $zdbeizhu, $zd_en_name );
                //---------------------------------------------------------------【将得到备注进行分解】
                //0【字段中文名称】,1【显示宽】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度】,10【】,11【m显示】,12【m锁定】,13【】,14【】
                $zd_cn_name = textN( $NEW_zdbeizhu, 0, ',' ); //字段中文名称

                $now_xianshi = textN( $NEW_zdbeizhu, 5, ',' ); //显示  1
                $now_shuoding = textN( $NEW_zdbeizhu, 6, ',' ); //锁定  1
                $now_tianjia = textN( $NEW_zdbeizhu, 7, ',' ); //添加  1
                $now_xiugai = textN( $NEW_zdbeizhu, 8, ',' ); //修改  1
                $now_baidu = textN( $NEW_zdbeizhu, 9, ',' ); //百度  1
                //echo $now_baidu;
                $now_xianshi_mobile = textN( $NEW_zdbeizhu, 11, ',' ); //m显示 1
                $now_shuoding_mobile = textN( $NEW_zdbeizhu, 12, ',' ); //m锁定 1


                $getN_XTZD = getN( $xt_m_ziduan, strtolower( $zd_en_name ) ); //判断系统字段

                if ( $getN_XTZD >= 0 ) { //为系统字段时
                    $zd_cn_name = textN( $xt_m_ziduan_Name, $getN_XTZD, ',' );
                    $sys_q_disabled = " disabled ";
                } else {
                    $sys_q_disabled = "";
                }

                $zd_cn_name = SysChangeName( $zd_cn_name, $databiao ); //变更系统设定名
                //echo $zd_cn_name;
                if ( $zd_cn_name . '1' == '1' ) {
                    $zd_cn_name = $zd_en_name;
                }

                if ( '1' . $zdbeizhu == '1' )$zdbeizhu = $zd_en_name;


                $zhujian = htmlspecialchars( $row[ 'Key' ] ); //主键

                if ( $zhujian ) {
                    $zhujian = "<i class='fa fa-yaoshi' title='主键'></i>";
                    $WuChongFu = 1;
                    $XSbitian = 1;
                } else {
                    $zhujian = "<i class='fa fa-25-1'></i>";
                }
                $zd_Type = htmlspecialchars( $row[ 'Type' ] ); //类型
                $zd_long = zd_type_to_long( $zd_Type ); //允许输入的最大字数
                $zd_Extra = htmlspecialchars( $row[ 'Extra' ] ); //自动增量 为auto_increment
                $zd_Collation = htmlspecialchars( $row[ 'Collation' ] ); //字符集
                $zd_weikong = htmlspecialchars( $row[ 'Null' ] ); //为空
                $zd_Default = move_zkh( $row[ 'Default' ], "N',[,],'" ); //默认值
                $now_zd_Default = htmlspecialchars( $row[ 'Default' ] ); //默认值


                if ( getN( $Axt_m_ziduan_hidden, strtolower( $zd_en_name ) ) < 0 ) { //隐藏系统字段

                    //$wheretext = " mdb_name='" . $Table_Name . "' and zd_en_name='" . $zd_en_name . "'"; //这里是筛选条件
                    echo( "<ul class='ulbg hoverthis'>" ); //添加处
                    echo( "<li class='cols1' style='width:25px;vertical-align: middle;'  title='$zd_en_name'>$zhujian</li>" );

                    //-------------------------------------------------------------------【字段名称】
                    if ( $getN_XTZD >= 0 ) {
                        echo( "<li style='width:220px;'><input name='zd_cn_name' type='text'  nothis='nothis'  value='$zd_cn_name' tit='$zd_cn_name' Y_ziduan='$zd_en_name' class='pu'  readonly='readonly' $sys_q_disabled style='width:97%:'></li>" );
                    } else {
                        echo( "<li style='width:220px;color:#666;'>&nbsp;{$zd_cn_name}</li>" );
                    }
                    //echo( "<li style='width:120px;'>{$zd_en_name}</li>" );

                    $now_change = "\"ziduan_beizhu_edit(this,'$databiao','$zd_en_name','$ToHtmlID')\"";

                    //-------------------------------------------------------------------【显示】

                    if ( $now_xianshi == '1' ) {
                        $nowchecked = " checked ";
                    } else {
                        $nowchecked = '';
                    };

                    echo( "<li style='width:90px;' class='center hui'><input name='qx_xianshi' nothis='nothis' type='checkbox'  value='" . $now_xianshi . "'  onclick=" . $now_change . " " . $nowchecked . "></li>" );

                    //-------------------------------------------------------------------【锁定】
                    if ( $now_shuoding == '1' ) {
                        $nowchecked = " checked ";
                    } else {
                        $nowchecked = '';
                    };

                    echo( "<li style='width:90px;' class='center'><input name='qx_shuoding' ziduan='$zd_en_name' nothis='nothis' type='checkbox'  value='" . $now_shuoding . "'  onclick=\"ziduan_beizhu_edit(this,'$databiao','$zd_en_name','$ToHtmlID');\"" . $nowchecked . "></li>" );

                    //-------------------------------------------------------------------【添加】
                    if ( $now_tianjia == '1' ) {
                        $nowchecked = " checked ";
                    } else {
                        $nowchecked = '';
                    };

                    if ( getN( 'sys_id_zu,sys_chaosong,sys_shenpi,sys_shenpi_all,sys_login,sys_paixu', $zd_en_name ) >= 0 ) {
                        echo( "<li style='width:90px;' class='center hui'><input name='qx_tianjia' nothis='nothis' type='checkbox'  value='$now_tianjia'  onclick=" . $now_change . " " . $nowchecked . "></li>" );
                    } else if ( SYS_is( $zd_en_name, 'sys_gx_id_' ) == 1 or SYS_is( $zd_en_name, 'sys_count_' ) == 1 ) {

                        echo( "<li style='width:90px;' class='center hui'><input name='qx_tianjia' nothis='nothis' type='checkbox'  value='$now_tianjia'  onclick=" . $now_change . " " . $nowchecked . " ></li>" );
                    } else {

                        echo( "<li style='width:90px;' class='center hui'><input name='qx_tianjia' nothis='nothis' type='checkbox'  value='$now_tianjia'  onclick=" . $now_change . " " . $nowchecked . "$sys_q_disabled></li>" );
                    }

                    //-------------------------------------------------------------------【修改】
                    if ( $now_xiugai == '1' ) {
                        $nowchecked = " checked ";
                    } else {
                        $nowchecked = '';
                    }
                    if ( getN( 'sys_id_zu,sys_chaosong,sys_shenpi,sys_shenpi_all,sys_login,sys_paixu', $zd_en_name ) >= 0 ) {
                        echo( "<li style='width:90px;' class='center'><input name='now_xiugai' nothis='nothis' type='checkbox'  value='$now_xiugai'  onclick=" . $now_change . " " . $nowchecked . "></li>" );
                    } else if ( SYS_is( $zd_en_name, 'sys_gx_id_' ) == 1 or SYS_is( $zd_en_name, 'sys_count_' ) == 1 ) {
                        echo( "<li style='width:90px;' class='center'><input name='now_xiugai' nothis='nothis' type='checkbox'  value='$now_xiugai'  onclick=" . $now_change . " " . $nowchecked . " disabled></li>" );
                    } else {
                        echo( "<li style='width:90px;' class='center'><input name='now_xiugai' nothis='nothis' type='checkbox'  value='$now_xiugai'  onclick=" . $now_change . " " . $nowchecked . "$sys_q_disabled></li>" );
                    }

                    //-------------------------------------------------------------------【百度列】
                    if ( $now_baidu == '1' ) {
                        $nowchecked = " checked ";
                    } else {
                        $nowchecked = '';
                    }
                    if ( getN( 'sys_id_zu,sys_chaosong,sys_shenpi,sys_shenpi_all,sys_login,sys_paixu', $zd_en_name ) >= 0 ) {
                        echo( "<li style='width:90px;' class='center hui'><input name='now_baidu' nothis='nothis' type='checkbox'  value='$now_baidu'  onclick=" . $now_change . " " . $nowchecked . "></li>" );
                    } else if ( SYS_is( $zd_en_name, 'sys_gx_id_' ) == 1 or SYS_is( $zd_en_name, 'sys_count_' ) == 1 ) {
                        echo( "<li style='width:90px;' class='center hui'><input name='now_baidu' nothis='nothis' type='checkbox'  value='$now_baidu'  onclick=" . $now_change . " " . $nowchecked . " disabled></li>" );
                    } else {
                        echo( "<li style='width:90px;' class='center hui'><input name='now_baidu' nothis='nothis' type='checkbox'  value='$now_baidu'  onclick=" . $now_change . " " . $nowchecked . "$sys_q_disabled></li>" );
                    }
                    //-------------------------------------------------------------------【空白列】
                    echo( "<li style='width:180px;' >" );


                    echo( "</li>" );
                    //-------------------------------------------------------------------【显示M】
                    if ( $now_xianshi_mobile == '1' ) {
                        $nowchecked_xianshi_mobile = " checked ";
                    } else {
                        $nowchecked_xianshi_mobile = '';
                    }; //选中时执行class='SeAtxianshi'
                    echo "<li style='width:120px;' class='center hui2'><input name='qx_xianshi_mobile' nothis='nothis' type='checkbox'  value='" . $now_xianshi_mobile . "'  onclick=" . $now_change . " " . $nowchecked_xianshi_mobile . "></li>";
                    //-------------------------------------------------------------------【锁定M】
                    if ( $now_shuoding_mobile == '1' ) {
                        $nowchecked_mobile = " checked ";
                    } else {
                        $nowchecked_mobile = '';
                    }; //选中时执行class='SeAtxianshi'
                    //$now_change_danxuan = "\"ziduan_beizhu_edit(this,'$databiao','$zd_en_name','$ToHtmlID','danxuan')\"";
                    echo "<li style='width:120px;' class='center hui3'><input name='qx_shuoding_mobile' nothis='nothis' type='checkbox'  value='" . $now_shuoding_mobile . "'  onclick=" . $now_change . " " . $nowchecked_mobile . "></li>";
                    //-------------------------------------------------------------------【备注原始】
                    //echo( "<li style='width:270px;' >$NEW_zdbeizhu</li>" );
                    echo "</ul>";
                }
            }
        };
        mysqli_free_result( $rs ); //释放内存


    } //else end
    echo "</div>";
    echo( "<ul style='height:200px'></br></ul>" ); //底下空白处

}; //function end
//===================================================================================【模版选择】
function moban_check() { //模版选择

    global $Conn, $Connadmin, $hy, $ToHtmlID, $sys_id_login, $databiao, $Axt_m_ziduan_hidden, $All_XT_ZiDuan, $xt_m_ziduan, $xt_m_ziduan_Name, $r_cow_height, $re_id, $sys_q_disabled; //得到全局变量
    //echo "</br><br>";
    $databiao = 'msc_renzhengmoban';
    $Conn = ChangeConn( $databiao ); //依据表自动选择数据库
    if ( $sys_id_login != 1 ) { //无权限时
        echo "<script>$('#{$ToHtmlID}_content_foot input,#{$ToHtmlID}_content_foot select').attr('disabled',true);</script>";
    }
    $SeAot = '';
    if ( isset( $_REQUEST[ 'SeAot' ] ) )$SeAot = $_REQUEST[ 'SeAot' ]; //得到附加命令
    $nowSeAt = $SeAot;

    //-----------------------------------end
    echo( "<div class='tables  heeaadmenu2' style='margin:0;border-right:0;margin-top:0px;'>" );
    echo( "<ul  class='thead' style='border-bottom:1px solid #999;padding:0;margin:0'>" );
    echo( "<li style='width:35px;'>&nbsp;</li>" );
    echo( "<li style='width:30px; '>ID</li>" );
    echo( "<li style='width:180px;'>模版名称</li>" );
    echo( "<li class='center' style='width:180px;' >适用企业</li>" );
    echo( "<li class='center' style='width:280px;' >说明</li>" );
   
    echo( '</ul>' );
    echo( '</div>' );

    if ( '1' . $databiao == '1' ) {
        echo( "<div id='bbsTabntq' class='tables'  style='margin:0;'><table width='100%' height='100%' border='0' cellspacing='0' cellpadding='0'><tr><td><center><font color='red'  style='cursor:hand;' onclick=" . "moban_set_edit(this,'$ToHtmlID');" . "  style='cursor:hand;'><i class='fa fa-nodata'></i>&nbsp;" );
        echo( '未选择数据库表！请先选择后操作。' );
        echo( '</font></center></br></br></br></br></br></br></br></br></td></tr></table></div>' );
    } else {

        echo( "<div id='bbsTabntq' tit='" . $All_XT_ZiDuan . "' tablename='{$databiao}' class='tables'  style='margin:0;overflow:hidden;'>" ); //以下为得到表的所有字段清单
        echo( "<ul style='height:25px; line-height:25px;'></ul>" ); //增加顶部距离的
        //b.name AS leixin,;

        $sql = $rs = '';
        $sql_stand = "select id,number,name,sys_zt,sys_adddate From `msc_standard` where sys_huis='0'  order by id Asc";
        //echo "<br><br>".$sql_stand;
        $rs_stand = mysqli_query( $Connadmin, $sql_stand );
        while ( $row_stand = mysqli_fetch_array( $rs_stand ) ) {

            $id_stand = $row_stand[ 'id' ]; //标准id
            $number_stand = $row_stand[ 'number' ]; //标准名称
            $name_stand = $row_stand[ 'name' ]; //标准名称
            echo'<ul class="headtitle" style="color:green">&nbsp;::::&nbsp;<strong>' . $number_stand . '&nbsp;' . $name_stand . '</strong></ul>';

            $sql = "select id,sys_beizhu,sys_title,sys_hangye,sys_zt,sys_adddate From `$databiao` where sys_Id_MenuBigClass='$id_stand' and sys_huis='0'  order by id Asc";
            //echo "<br><br><br>".$sql.'_'; 
            $rs = mysqli_query( $Connadmin, $sql );
            //echo record_count.'_'; 

            $i = 0;


            if ( $rs ) { //当有记录时
                while ( $row = mysqli_fetch_array( $rs ) ) {
                    $id = $row[ 'id' ]; //id
                    $name = $row[ 'sys_title' ]; //标准名称
                    $sys_hangye = $row[ 'sys_hangye' ]; //标准
                    $sys_beizhu = $row[ 'sys_beizhu' ]; //标准编号

                    echo( "<ul class='ulbg hoverthis'>" ); //添加处
                    //echo( "<li class='cols1' style='width:25px;vertical-align: middle;'  title='$zd_en_name'>$zhujian</li>" );

                    echo( "<li style='width:35px;vertical-align: middle;' class='center cols1'><input name='qx_xianshi' nothis='nothis' type='checkbox'></li>" ); // value='" . $now_xianshi . "'  onclick=" . $now_change . " " . $nowchecked . "

                    //-------------------------------------------------------------------【空白列】
                    echo( "<li style='width:30px;text-align: center' >$id</li>" );
                    echo( "<li style='width:180px;' >$name</li>" );
                    echo( "<li style='width:180px;' >$sys_hangye</li>" );
                    echo( "<li style='width:280px;' >$sys_beizhu</li>" );
                    echo( "<li style='width:280px;' >+</li>" );


                    //-------------------------------------------------------------------【备注原始】
                    //echo( "<li style='width:270px;' >$NEW_zdbeizhu</li>" );
                    echo "</ul>";

                }
            };


        } //else end

        mysqli_free_result( $rs ); //释放内存
    }
    mysqli_free_result( $rs_stand ); //释放内存
    echo "</div>";
    echo( "<ul style='height:200px'></br></ul>" ); //底下空白处

}; //function end
//===================================================================================【显示分页】
function xianshifenye() {
    global $Conn, $Connadmin, $hy, $ToHtmlID, $user_id, $databiao, $Axt_m_ziduan_hidden, $All_XT_ZiDuan, $xt_m_ziduan, $xt_m_ziduan_Name, $r_cow_height, $re_id, $sys_q_disabled; //得到全局变量
    //echo "</br><br>";
    $sheet = ChangeConn( $databiao ); //依据表自动选择数据库
    if ( $user_id != 1 ) { //无权限时
        echo "<script>$('#{$ToHtmlID}_content_foot input,#{$ToHtmlID}_content_foot select').attr('disabled',true);</script>";
    }
    $SeAot = '';
    if ( isset( $_REQUEST[ 'SeAot' ] ) )$SeAot = $_REQUEST[ 'SeAot' ]; //得到附加命令
    $nowSeAt = $SeAot;

    if ( '1' . $databiao == '1' ) {
        echo( "<div id='bbsTabntq' class='tables'  style='margin:0;'><table width='100%' height='100%' border='0' cellspacing='0' cellpadding='0'><tr><td><center><font color='red'  style='cursor:hand;' onclick=" . "moban_set_edit(this,'$ToHtmlID');" . "  style='cursor:hand;'><i class='fa fa-nodata'></i>&nbsp;" );
        echo( '未选择数据库表！请先选择后操作。' );
        echo( '</font></center></br></br></br></br></br></br></br></br></td></tr></table></div>' );
    } else {

        echo( "<div id='bbsTabntq' tit='" . $All_XT_ZiDuan . "' tablename='{$databiao}' class='ziduan_fenye' ToHtmlID='$ToHtmlID'>" ); //以下为得到表的所有字段清单
        //echo( "<ul style='height:25px; line-height:25px;'></ul>" ); //增加顶部距离的
        $sql = 'select id,sys_fenye From sys_fenye where sys_yfzuid=' . $hy . ' and sys_re_id=' . $re_id . ' and sys_huis <> 1 order by id Asc';
        $rs = mysqli_query( $Conn, $sql );
        $sys_fenye = '';
        if($recordcount = mysqli_num_rows( $rs )){
            $row = mysqli_fetch_array( $rs );
            $sys_fenye = $row[ 'sys_fenye' ];
        } //得到总数
        mysqli_free_result( $rs ); //释放内存
        //echo $sys_fenye;//得到总分页数据
        //==================================================得到分页除首页的字段清单
        $nowtextvalue3 = '';
        $Arr_ziduan3 = explode( ';', $sys_fenye ); //得到分页数据列出
        for ( $ii3 = 0; $ii3 < count( $Arr_ziduan3 ) - 1; $ii3++ ) {
            $nowval3 = $Arr_ziduan3[ $ii3 ];
            $Arr_ziduan4 = explode( ':', $nowval3 ); //得到分页数据列出
            $nowtextvalue3 .= $Arr_ziduan4[ 1 ] . ','; //得到页显示的字段清单
        }
        //echo $nowtextvalue3;//============================这里得到首页不出现的字段；end
        if ( $recordcount == 0 ) { //当没有查询到分页数据时，默认显示一列
            $sys_fenye = '第1页:;';
        }
        $Arr_ziduan = explode( ';', $sys_fenye ); //得到分页数据列出

        for ( $ii = 0; $ii < count( $Arr_ziduan ) - 1; $ii++ ) {
            $nowval2 = $Arr_ziduan[ $ii ];

            //echo($nowval2)."<br>";
            $Arr_ziduan2 = explode( ':', $nowval2 ); //得到分页数据列出
            $nowtext = $Arr_ziduan2[ 0 ]; //得到页名
            $nowtextvalue = $Arr_ziduan2[ 1 ]; //得到页显示的字段清单
            $iii = $ii + 1;
            echo( "<ul class='tr hoverthis'>" ); //添加处
            echo "<li class='head'><div class='yema'>$iii</div><div class='del'>×</div><input type='text' onchange=Table_Set_FenYe_ajax('" . $ToHtmlID . "')  value='$nowtext' /></li>";
            //b.name AS leixin,;
            $sql = "SHOW FULL COLUMNS FROM `$databiao` "; //检查所有字段
            //echo $sql;
            //echo $colname;
            $rs = mysqli_query( $sheet, $sql );
            //$nowrscount=mysqli_num_rows($rs);//统计数量

            if ( $rs ) { //当有记录时
                while ( $row = mysqli_fetch_array( $rs ) ) {
                    $zd_en_name = $row[ 'Field' ]; //字段名
                    $zdbeizhu = $row[ 'Comment' ]; //备注
                    $NEW_zdbeizhu = colbeizhu( $zdbeizhu, $zd_en_name );
                    //---------------------------------------------------------------【将得到备注进行分解】
                    //0【字段中文名称】,1【显示宽】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度】,10【】,11【m显示】,12【m锁定】,13【】,14【】
                    $zd_cn_name = textN( $NEW_zdbeizhu, 0, ',' ); //字段中文名称
                    $zd_cn_name = SysChangeName( $zd_cn_name, $databiao ); //变更系统设定名
                    //echo $zd_cn_name;
                    if ( $zd_cn_name . '1' == '1' ) {
                        $zd_cn_name = $zd_en_name;
                    }

                    if ( '1' . $zdbeizhu == '1' )$zdbeizhu = $zd_en_name;

                    $zhujian = htmlspecialchars( $row[ 'Key' ] ); //主键

                    if ( $zhujian ) {
                        $zhujian = "<i class='fa fa-yaoshi' title='主键'></i>";
                        $WuChongFu = 1;
                        $XSbitian = 1;
                    } else {
                        $zhujian = "<i class='fa fa-25-1'></i>";
                    }
                    $zd_Type = htmlspecialchars( $row[ 'Type' ] ); //类型
                    $zd_long = zd_type_to_long( $zd_Type ); //允许输入的最大字数
                    $zd_Extra = htmlspecialchars( $row[ 'Extra' ] ); //自动增量 为auto_increment
                    $zd_Collation = htmlspecialchars( $row[ 'Collation' ] ); //字符集
                    $zd_weikong = htmlspecialchars( $row[ 'Null' ] ); //为空
                    $zd_Default = move_zkh( $row[ 'Default' ], "N',[,],'" ); //默认值
                    $now_zd_Default = htmlspecialchars( $row[ 'Default' ] ); //默认值

                    if ( getN( $Axt_m_ziduan_hidden, strtolower( $zd_en_name ) ) < 0 ) { //隐藏系统字段
                        //$wheretext = " mdb_name='" . $Table_Name . "' and zd_en_name='" . $zd_en_name . "'"; //这里是筛选条件
                        $nowlihtml = "<li class='conent' title='$zd_en_name'><a class='cols1'  title='$zd_en_name'>$zhujian</a>$zd_cn_name</li>";

                        if ( $iii == 1 && getN( $nowtextvalue3, $zd_en_name ) == -1 ) { //当为首页时并且没有允许显示的字段时
                            echo $nowlihtml;
                        } elseif ( $iii > 1 && getN( $nowtextvalue, $zd_en_name ) > -1 ) {
                            echo $nowlihtml;
                        }


                    }
                }
            };
            mysqli_free_result( $rs ); //释放内存
            echo "</ul>";
        };

        echo( "<ul class='add' onclick=\"Table_Set_FenYe_dragsort_ADD('$ToHtmlID',this)\">" ); //添加按钮
        echo "+";
        echo "</ul>";
        echo "</div>";

    } //else end


    echo( "<ul style='height:200px'></br></ul>" ); //底下空白处
    echo "<script>Table_Set_FenYe_dragsort('{$ToHtmlID}')</script>";

}; //function end
//===================================================================================【关系添加】
function GuanXiadd() {
    global $Conn, $Connadmin, $hy, $ToHtmlID, $databiao, $sys_id_login, $Axt_m_ziduan_hidden, $All_XT_ZiDuan, $xt_m_ziduan, $xt_m_ziduan_Name, $r_cow_height, $re_id, $sys_q_disabled; //得到全局变量
    //$Conn=ChangeConn($databiao);    //依据表自动选择数据库
    //echo "</br><br>";
    if ( $sys_id_login != 1 ) { //无权限时
        echo "<script>$('#{$ToHtmlID}_content_foot input,#{$ToHtmlID}_content_foot select').attr('disabled',true);</script>";
    }
    $sql = "select * From `sys_jlmb` where id='$re_id'  and sys_huis=0";
    //echo $sql;
    $rs = mysqli_query( $Conn, $sql );
    $row = mysqli_fetch_array( $rs );
    $databiaoCNname = $row[ 'sys_card' ]; //
    $databiaoENname = $row[ 'mdb_name_SYS' ];
    // echo $databiaoCNname.$databiaoENname;
    mysqli_free_result( $rs ); //释放内存

    //---------------------------------------------------------------【输出内容】
    echo( "<div class='GuanXiTable' id=''>" );
    echo( "<ul>" );
    echo( "<li>0</li>" );
    echo( "<li class='cols1'> <a>当前表 》</a>  <span>&nbsp;</span> <a>关系表 》</a> </li>" );
    //中文名称
    echo "<li class='cols2'> <a>{$databiaoCNname}</a>  <h2>&nbsp;</h2><span>&nbsp;</span> <a>";

    echo "<select name='tableanname'  type='select' onchange=\"GuanXi_TableNameChange(this,'" . $ToHtmlID . "');\" >";
    echo "<option value='0'  selected>未选择数据表</option>";
    //echo"<option value='1'>00</option>";
    //---------------------------------------------------------------【过程名称】
    $sql = "select id,sys_GuoChengMingChen From sys_menubigclass where sys_yfzuid='$hy' and sys_huis=0 order by sys_GuoChengMingChen Asc";
    $rs = mysqli_query( $Conn, $sql );
    while ( $row = mysqli_fetch_array( $rs ) ) {
        $NOW_menubigclass_id = $row[ 'id' ];
        $NOW_menubigclass = $row[ 'sys_GuoChengMingChen' ];

        echo "<option value='' title='$NOW_menubigclass_id' disabled='disabled'>$NOW_menubigclass</option>"; //过程名

        $sql2 = "select * From Sys_jlmb where sys_yfzuid='$hy' and Id_MenuBigClass='$NOW_menubigclass_id' and sys_huis=0  order by sys_card Asc";
        $rs2 = mysqli_query( $Conn, $sql2 );
        while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
            $id = $row2[ 'id' ];
            $sys_card = $row2[ 'sys_card' ];
            $mdb_name_SYS = strtolower( $row2[ 'mdb_name_SYS' ] );
            //------------------------------------------------ 【查询到关系表】
            $sql3 = "sys_yfzuid='$hy' and  sys_re_id_02='$re_id'  and sys_huis=0 ";
            $colsarry3 = Tablecol_list_ToStrArry( 'sys_guanxibiao', 'sys_re_id', $sql3 );
            $nowgetN3 = getN( $colsarry3, $id, ',' );
            //------------------------------------------------ 【查询到关系表end】
            $disabled = $selected = "";
            if ( $mdb_name_SYS == strtolower( $databiaoENname ) ) {
                $selected = "selected";
            }
            if ( $id == $re_id or $nowgetN3 > -1 ) {
                $disabled = 'disabled';
                $selected = "";
            }

            echo "<option value='$mdb_name_SYS' title='$id' {$selected}  {$disabled}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[{$id}]-{$sys_card}</option>";
        }
        mysqli_free_result( $rs2 ); //释放内存

    };
    mysqli_free_result( $rs ); //释放内存

    echo "</select>";
    echo " </a> </li>";

    //------------------------------------------------------【必选字段】

    echo "<li class='cols3'><a>id</a>  <h3>&nbsp;</h3><span>&nbsp;</span>";
    echo " <a>";
    echo "<select name='zhiduanname'  type='select'  disabled=\"disabled\"  onchange=\"GuanXi_ZiDuanChange(this,'" . $ToHtmlID . "');\"  class='ziduanTo'>";
    echo GuanXi_ZiDuanChange( $databiaoENname );
    echo "</select>";
    echo " </a> ";
    echo "</li>";

    //------------------------------------------------------【其它字段】
    echo "<li class='add'> <a class='addinput'  onclick=\"GuanXiAddZiDuanMenu(this,'" . $ToHtmlID . "','$$databiao')\">+</a>  <span>&nbsp;</span>	</li>";
    echo( "<li class='rightmenu'><a>&nbsp;</a><a class='deldiv' onclick='GuanXi_ZiDuanChange_Del(this,\"" . $ToHtmlID . "\");'>✖</a></li>" );
    echo( '</ul>' );
    echo( '</div>' );

}; //function end
//===================================================================================【关系】
function GuanXi() {
    global $Conn, $Connadmin, $hy, $ToHtmlID, $databiao, $sys_id_login, $Axt_m_ziduan_hidden, $All_XT_ZiDuan, $xt_m_ziduan, $xt_m_ziduan_Name, $r_cow_height, $re_id, $sys_q_disabled, $data_use; //得到全局变量
    //$Conn=ChangeConn($databiao);    //依据表自动选择数据库
    //echo "</br><br>";
    if ( $sys_id_login != 1 ) { //无权限时
        echo "<script>$('#{$ToHtmlID}_content_foot input,#{$ToHtmlID}_content_foot select').attr('disabled',true);</script>";
    }


    $sql = "select * From `sys_jlmb` where id='$re_id' ";
    //echo $sql;
    $rs = mysqli_query( $Conn, $sql );
    $row = mysqli_fetch_array( $rs );
    $databiaoCNname = $row[ 'sys_card' ]; //
    //echo $databiaoCNname;
    mysqli_free_result( $rs ); //释放内存

    echo "<br>";
    $sql = "select * From `Sys_GuanXiBiao` where sys_re_id_02='$re_id' and sys_huis=0 order by id asc";
    // echo $sql;
    $rs = mysqli_query( $Conn, $sql );
    $nowrscount = mysqli_num_rows( $rs ); //统计数量
    if ( $nowrscount > 0 ) { //有时输出
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;关联关系：";
        $i = 0;
        while ( $row = mysqli_fetch_array( $rs ) ) {
            $id = $row[ 'id' ];
            $sys_re_id01 = $row[ 'sys_re_id' ];
            $databiaoENname01 = Find_tablename( $sys_re_id01 ); //表的英文名称
            //echo $databiaoENname01;
            $databiaoCNname01 = Find_table_CNname_fromre_id( $sys_re_id01 ); //表的中文名称
            $sys_re_id02 = $row[ 'sys_re_id_02' ];
            $databiaoENname02 = Find_tablename( $sys_re_id02 );

            $nowid_guanxi_col = $row[ 'sys_nowid_guanxi_col' ];
            $sys_GuanXiZDList = $row[ 'sys_GuanXiZDList' ]; //关系字段清单
            $i++;
            if ( $i < 10 ) {
                $i = '0' . $i;
            }

            //-------------------------------------------查询到对应表end
            echo( "<div class='GuanXiTable' id='$id'>" );
            echo( "<ul class='ul_hui'>" );
            echo( "<li title='$id'>$i</li>" );
            echo( "<li class='cols1'> <a>当前表 》</a>  <span>&nbsp;</span> <a>关系表 》</a> </li>" );
            //中文名称
            echo "<li class='cols2'> <a>{$databiaoCNname01}</a>  <h2>&nbsp;</h2><span>&nbsp;</span> <a>";
            echo "[{$sys_re_id02}]-{$databiaoCNname}";
            echo " </a> </li>";

            //------------------------------------------------------【必选字段】

            echo "<li class='cols3' style='display:none'>  <a>id</a>  <h3>&nbsp;</h3><span>&nbsp;</span>";
            echo " <a>";
            //echo "<select name='zhiduanname'  type='select'  disabled=\"disabled\"  class='ziduanTo'>";

            //echo GuanXi_ZiDuanChange($databiaoENname02,$nowid_guanxi_col);
            //echo "</select>";
            echo " </a> ";
            echo "</li>";
            //------------------------------------------------------【其它字段】GuanXiAddZiDuanMenu(ths,ToHtmlID,databiao,databiaoENname)
            $continstr = continstr( $sys_GuanXiZDList, ',' ); //统计数组个数
            // echo $sys_GuanXiZDList;
            $fharry = explode( ',', $sys_GuanXiZDList );
            for ( $i = 0; $i < $continstr; $i++ ) {
                $nowguanxi = $fharry[ $i ];
                $nowziduan = textN( $nowguanxi, 0, '=' ); //字段1
                $nowziduan_02 = textN( $nowguanxi, 1, '=' ); //字段2
                $nowbeizhu = findzdbeizhu( $databiaoENname01, $nowziduan ); //备注1
                $nowbeizhu_02 = findzdbeizhu( $databiaoENname02, $nowziduan_02 ); //备注2
                echo '<li class="ziduanheng">  <a>' . textN( $nowbeizhu, 0 ) . '</a> <h4>&nbsp;</h4><span>&nbsp;</span> <a>' . textN( $nowbeizhu_02, 0 ) . '</a> </li>';
            }
            //-------------------------------------------------------------【横向添加按钮】
            echo "<li class='add'> <a class='addinput'>+</a><span>&nbsp;</span></li>";
            echo( '</ul>' );
            echo( '</div>' );
        }
    }
    mysqli_free_result( $rs ); //释放内存


    $sql = "select * From `Sys_GuanXiBiao` where sys_re_id='$re_id' and sys_huis=0 order by id asc";
    $rs = mysqli_query( $Conn, $sql );
    $nowrscount = mysqli_num_rows( $rs ); //统计数量


    if ( $nowrscount > 0 ) { //有时输出
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;新建关系：";
        $i = 0;
        while ( $row = mysqli_fetch_array( $rs ) ) {
            $id = $row[ 'id' ];
            $databiaoENname = Find_tablename( $row[ 'sys_re_id_02' ] );
            $nowid_guanxi_col = $row[ 'sys_nowid_guanxi_col' ];
            $sys_GuanXiZDList = $row[ 'sys_GuanXiZDList' ]; //关系字段清单
            $i++;
            if ( $i < 10 ) {
                $i = '0' . $i;
            }
            echo( "<div class='GuanXiTable' id='$id'>" );
            echo( "<ul>" );
            echo( "<li title='$id'>$i</li>" );
            echo( "<li class='cols1'> <a>当前表 》</a>  <span>&nbsp;</span> <a>关系表 》</a> </li>" );
            //中文名称
            echo "<li class='cols2'> <a>{$databiaoCNname}</a>  <h2>&nbsp;</h2><span>&nbsp;</span> <a>";

            echo "<select name='tableanname'  type='select' onchange=\"GuanXi_TableNameChange(this,'" . $ToHtmlID . "');\" >";
            echo "<option value='0'>未选择数据表</option>";
            //echo"<option value='1'>00</option>";
            //---------------------------------------------------------------【过程名称】
            $sql3 = "select id,sys_GuoChengMingChen From sys_menubigclass where sys_yfzuid='$hy' and sys_huis=0 order by sys_GuoChengMingChen Asc";
            $rs3 = mysqli_query( $Conn, $sql3 );
            while ( $row3 = mysqli_fetch_array( $rs3 ) ) {
                $NOW_menubigclass_id = $row3[ 'id' ];
                $NOW_menubigclass = $row3[ 'sys_GuoChengMingChen' ];


                echo "<option value='' title='$NOW_menubigclass_id' disabled='disabled'>$NOW_menubigclass</option>"; //过程名

                $sql2 = "select * From Sys_jlmb where sys_yfzuid='$hy' and Id_MenuBigClass='$NOW_menubigclass_id' and sys_huis=0  order by sys_card Asc";
                // echo $sql2;
                $rs2 = mysqli_query( $Conn, $sql2 );
                while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
                    $id2 = $row2[ 'id' ];
                    $sys_card = $row2[ 'sys_card' ];
                    $mdb_name_SYS = strtolower( $row2[ 'mdb_name_SYS' ] );
                    //------------------------------------------------ 【查询到关系表】
                    $sql4 = "sys_yfzuid='$hy' and  sys_re_id_02='$re_id'  and sys_huis=0 ";
                    $colsarry4 = Tablecol_list_ToStrArry( 'sys_guanxibiao', 'sys_re_id', $sql4 );
                    $nowgetN4 = getN( $colsarry4, $id2, ',' );
                    //------------------------------------------------ 【查询到关系表end】
                    $selected = $disabled = "";
                    if ( $id2 == $re_id or $nowgetN4 > -1 ) {
                        $disabled = 'disabled';
                    }
                    if ( $mdb_name_SYS == strtolower( $databiaoENname ) ) {
                        $selected = "selected";
                    }
                    echo "<option value='$mdb_name_SYS' title='$id2' {$selected}  {$disabled}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[{$id2}]-{$sys_card}</option>";


                }
                mysqli_free_result( $rs2 ); //释放内存

            };
            mysqli_free_result( $rs3 ); //释放内存


            echo "</select>";
            echo " </a> </li>";

            //------------------------------------------------------【必选字段】

            echo "<li class='cols3' style='display:none'>  <a>id</a>  <h3>&nbsp;</h3><span>&nbsp;</span>";
            echo " <a>";
            echo "<select name='zhiduanname'  type='select'  disabled=\"disabled\"  onchange=\"GuanXi_ZiDuanChange(this,'" . $ToHtmlID . "');\" class='ziduanTo'>";

            echo GuanXi_ZiDuanChange( $databiaoENname, $nowid_guanxi_col );
            echo "</select>";
            echo " </a> ";
            echo "</li>";
            //------------------------------------------------------【其它字段】GuanXiAddZiDuanMenu(ths,ToHtmlID,databiao,databiaoENname)
            $continstr = continstr( $sys_GuanXiZDList, ',' ); //统计数组个数
            $fharry = explode( ',', $sys_GuanXiZDList );
            for ( $i = 0; $i < $continstr; $i++ ) {
                echo GuanXiaddHeng( $databiao, $databiaoENname, $fharry[ $i ] );
            }
            //}

            echo "<li class='add'> <a class='addinput'  onclick=\"GuanXiAddZiDuanMenu(this,'" . $ToHtmlID . "','$databiao','$databiaoENname')\">+</a>  <span>&nbsp;</span>	</li>";
            echo( "<li class='rightmenu'><a>&nbsp;</a><a class='deldiv' onclick='GuanXi_ZiDuanChange_Del(this,\"" . $ToHtmlID . "\");'>✖</a></li>" );

            echo( '</ul>' );
            echo( '</div>' );
            echo "<script>GuanXi_ZiDuanChange_hidden('$id','$ToHtmlID');</script>";
        }
    } else {


    }
    mysqli_free_result( $rs ); //释放内存
    //---------------------------------------------------------------------【竖向添加按钮】
    if ( $sys_id_login == 1 ) {
        echo( "<div class='GuanXiTable adddiv' style='width:300px'>" );
        echo( "<ul class='addboxmenu' onclick=\"guanxiaddmenu(this,'" . $ToHtmlID . "')\">" );
        echo( "<li class='col1'>✚</li>" );
        echo( "<li class='col2'>添加关系</li>" );
        //echo( "<li class='col3'>删除</li>" );
        echo( "</ul>" );
        echo( "</div>" );
    }


}; //function end
//===================================================================================【横向添加】
function GuanXiaddHeng( $databiao = '', $databiaoENname = '', $sys_GuanXiZDList = '' ) { //原表名，链接表名
    global $Conn, $ToHtmlID;
    //------------------------------------------------------【其它字段】

    if ( isset( $_POST[ 'databiao' ] ) ) {
        $databiao = htmlspecialchars( $_POST[ 'databiao' ] );
    } //


    if ( isset( $_POST[ 'databiaoENname' ] ) ) {
        $databiaoENname = htmlspecialchars( $_POST[ 'databiaoENname' ] ); //databiaoENname新表名
    }

    if ( isset( $_POST[ 'parentid' ] ) ) {
        $sql = "select * From Sys_GuanXiBiao where id='" . $_POST[ 'parentid' ] . " '";
        $rs = mysqli_query( $Conn, $sql );
        $row = mysqli_fetch_array( $rs );
        $databiaoENname = Find_tablename( $row[ 'sys_re_id_02' ] );
        //$sys_GuanXiZDList=$row['sys_GuanXiZDList'];
        mysqli_free_result( $rs ); //释放内存
    } //
    if ( isset( $_POST[ 're_id' ] ) ) {
        global $databiao;
        // $databiao = $databiao;
    }

    //echo $databiao.','.$databiaoENname;

    echo "<li class='ziduanheng' onmouseover='$(this).find(\"h1\").show()' onmouseout='$(this).find(\"h1\").hide()'>  <a>";
    //echo $sys_GuanXiZDList;
    echo "<select name='zhiduanname'  type='select' class='ziduan' onchange='GuanXi_ZiDuanChange_Hengxiang(this,\"" . $ToHtmlID . "\")'>";

    if ( $databiao ) {
        echo GuanXi_ZiDuan_Heng( $databiao, $sys_GuanXiZDList, 'ziduan' );
    }
    echo "</select>";

    echo "</a>  <h1 class='delli' onclick='GuanXi_ZiDuan_Del(this,\"" . $ToHtmlID . "\")' style='display:none'>✖</h1><h4>&nbsp;</h4><span>&nbsp;</span>";

    echo " <a>";
    echo "<select name='zhiduanname2'  type='select' class='ziduanTo' onchange='GuanXi_ZiDuanChange_Hengxiang(this,\"" . $ToHtmlID . "\")'>";
    if ( $databiaoENname ) {
        echo GuanXi_ZiDuan_Heng( $databiaoENname, $sys_GuanXiZDList, 'ziduanTo' );
    }

    echo "</select>";
    echo " </a> ";

    echo "</li>";

}
//===================================================================================【关系】
function GuanXi_ZiDuan_Heng( $databiao, $sys_GuanXiZDList = '', $ziduanTo = 'ziduan' ) {
    //echo $databiao;//$Arr2getN_ID=Arr2getN_ID($sys_GuanXiZDList,$databiaoENname,0,'=');
    global $xt_m_ziduan;
    $Conn = ChangeConn( $databiao ); //依据表自动选择数据库

    $sql = "SHOW FULL COLUMNS FROM `$databiao`";
    //echo $sql;
    $rs = mysqli_query( $Conn, $sql );
    echo "<option value='' title='$sys_GuanXiZDList'>&nbsp;</option>";

    while ( $row = mysqli_fetch_array( $rs ) ) {
        $zd_en_name = $row[ 'Field' ]; //字段
        $zdbeizhu = $row[ 'Comment' ]; //备注
        $NEW_zdbeizhu = colbeizhu( $zdbeizhu, $zd_en_name );
        //0【字段中文名称】,1【显示宽度】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】
        $zdCNname = textN( $NEW_zdbeizhu, 0, ',' ); //中文字段名找值0  1
        $getN_XTZD = getN( $xt_m_ziduan, strtolower( $zd_en_name ) ); //判断系统字段

        if ( $ziduanTo == 'ziduan' ) {
            $textN = textN( $sys_GuanXiZDList, 0, '=' );
        } else {
            $textN = textN( $sys_GuanXiZDList, 1, '=' );
        }

        if ( $getN_XTZD == -1 && SYS_is( $zd_en_name, 'sys_gx_id_' ) == 0 ) {
            if ( $textN == $zd_en_name ) {
                echo "<option value='$zd_en_name' title='$zd_en_name' selected>$zdCNname</option>";
            } else {
                echo "<option value='$zd_en_name' title='$zd_en_name'>$zdCNname</option>";
            }

        }

    }
    mysqli_free_result( $rs );

}; //function end
//===================================================================================【关系解除】
function GuanXi_Del() {
    //global $Conn,$Connadmin, $hy, $ToHtmlID, $sys_id_login, $re_id; //得到全局变量

    if ( isset( $_POST[ 'id' ] ) ) {
        $id = $_POST[ 'id' ];
    } //
    if ( isset( $_POST[ 're_id' ] ) ) {
        $re_id = $_POST[ 're_id' ];
    } //

    $dynamic = ChangeConn( 'sys_guanxibiao' ); //依据表自动选择数据库
    //echo $id;
    //----------------------------------------------------判断当为切换时执行
    if ( $id >= 1 ) { //当有这个值，判断为切换
        //--------------------------------------查询到原先数据表
        $sql = "select * From sys_guanxibiao where id='$id' and sys_re_id = $re_id ";
        // echo $sql;
        $rs = mysqli_query( $dynamic, $sql );
        if($row = mysqli_fetch_array( $rs )){
            $sys_re_id = $row[ 'sys_re_id' ]; //得到关系的表 
            //echo $sys_re_id;
            $sys_re_id_02 = $row[ 'sys_re_id_02' ]; //得到关系的表321
            //--------------------------------------将原先数据表关系字段解除
            $Table_Name = Find_tablename( $sys_re_id ); //根据re_id查询到表名495
            $Table_Name02 = Find_tablename( $sys_re_id_02 ); //根据re_id_02查询到表名321
            // echo $Table_Name.'_'.$Table_Name02;
            $nowtablelist = Tablecol_list( $Table_Name, $dynamic ); //得到表所有字段
            if ( getN_FH( $nowtablelist, "sys_count_$sys_re_id_02", ',' ) > -1 ) {
                $nowcont01 = Tongji_table_rows( $Table_Name, "sys_count_$sys_re_id_02 <> ''" ); //当前表统计关系字段为空时>0
            } else {
                $nowcont01 = 0;
            };

            $nowtablelist02 = Tablecol_list( $Table_Name02, $dynamic ); //得到表所有字段
            if ( getN_FH( $nowtablelist02, "sys_gx_id_$sys_re_id", ',' ) > -1 ) {
                $nowcont02 = Tongji_table_rows( $Table_Name02, "sys_gx_id_$sys_re_id <> ''" ); //关系表统计关系字段为空时>0
            } else {
                $nowcont02 = 0;
            };

            if ( $nowcont01 + $nowcont02 < 1 ) {
                //echo "关系表无使用关链，已删除。\n";
                echo 1;
                ziduan_del_Modular_all( $Table_Name, "sys_count_$sys_re_id_02" ); //sys_count_删除字段
                ziduan_del_Modular_all( $Table_Name02, "sys_gx_id_$sys_re_id" ); //sys_gx_id_删除字段
            } else {
                echo "关系字段存在数据,直接删除会出现故障，请对以下表字段清空后再删除！\n";
                if ( $nowcont01 > 0 ) { //统计数量
                    echo $Table_Name . '的字段：sys_count_' . $sys_re_id_02 . '共有' . $nowcont01 . "条关系记录。\n";
                }
                if ( $nowcont02 > 0 ) { //统计数量
                    echo $Table_Name02 . '的字段：sys_gx_id_' . $sys_re_id . '共有' . $nowcont02 . "条关系记录。\n";
                }
            }
        }else{

        }
        mysqli_free_result( $rs ); //释放内存

    } else {

    }

    //echo $id;

}; //function end
//===================================================================================【关系】
function GuanXi_ZiDuanChange( $databiaoENname = '', $nowid_guanxi_col = '' ) {
    //global $Conn,$Connadmin, $hy, $ToHtmlID, $sys_id_login, $re_id; //得到全局变量
    global $xt_m_ziduan;
    if ( isset( $_POST[ 'nowid_guanxi_col' ] ) ) {
        $nowid_guanxi_col = $_POST[ 'nowid_guanxi_col' ];
    } //
    if ( isset( $_POST[ 're_id' ] ) ) {
        $re_id = $_POST[ 're_id' ];
    } //
    $re_id_02='';
    if ( isset( $_POST[ 're_id_02' ] ) ) {
        $re_id_02 = $_POST[ 're_id_02' ];
    } //
    // echo $nowid_guanxi_col."_".$re_id."_".$re_id_02;
    if ( isset( $_POST[ 'databiaoENname' ] ) ) {
        $databiao = $_POST[ 'databiaoENname' ]; //databiaoENname新表名
    } else {
        $databiao = $databiaoENname;
    }
    // echo 123;
    $Conn = ChangeConn( $databiao ); //依据表自动选择数据库
    // echo $re_id.'_'.$re_id_02;
    //----------------------------------------------------创建关系字段及统计数据
    GuanXiziduan_add( $re_id, $re_id_02 ); //关系字段更新
    // echo 123;
    //----------------------------------------------------更新相应显示的字段
    //echo "<select name='zhiduanname'  type='select' >";
    echo "<option value='0'>&nbsp;</option>";
    // echo 123;
    //echo"<option value='1'>00</option>";
    $sql = "SHOW FULL COLUMNS FROM `$databiao`";
    // echo $sql;
    $rs = mysqli_query( $Conn, $sql );
    while ( $row = mysqli_fetch_array( $rs ) ) {
        // echo 123;
        $zd_en_name = $row[ 'Field' ]; //字段
        $zdbeizhu = $row[ 'Comment' ]; //备注
        $getN_XTZD = getN( $xt_m_ziduan, strtolower( $zd_en_name ) ); //判断系统字段
        $NEW_zdbeizhu = colbeizhu( $zdbeizhu, $zd_en_name );
        //0【字段中文名称】,1【显示宽度】,2【必填】,3【无重复】,4【显示类型】,5【显示】,6【锁定】,7【添加】,8【修改】,9【百度搜索】,10【显示高度】,11【m显示】,12【m锁定】,13【】,14【】
        $zdCNname = textN( $NEW_zdbeizhu, 0, ',' ); //中文字段名找值0  1
        if ( $getN_XTZD == -1 && SYS_is( $zd_en_name, 'sys_gx_id_' ) == 0 ) {
            if ( $nowid_guanxi_col == $zd_en_name ) {
                echo "<option value='$zd_en_name' title='$zd_en_name' selected>$zdCNname</option>";
            } else {
                echo "<option value='$zd_en_name' title='$zd_en_name'>$zdCNname</option>";
            }
        }

    }
    mysqli_free_result( $rs );
    //echo "</select>";
    //echo $id;

}; //function end
//===================================================================================【关系表添加与修改】
function GuanXi_TableNameChange_POST() {
    global $Conn, $Connadmin, $hy, $ToHtmlID, $sys_id_login, $Axt_m_ziduan_hidden, $All_XT_ZiDuan, $xt_m_ziduan, $xt_m_ziduan_Name, $r_cow_height, $re_id, $sys_q_disabled; //得到全局变量
    //echo "</br><br>";
    $id = $databiao = '';

    if ( isset( $_POST[ 'id' ] ) ) {
        $id = htmlspecialchars( $_POST[ 'id' ] );
    } //
    if ( isset( $_POST[ 're_id' ] ) ) {
        $re_id = htmlspecialchars( $_POST[ 're_id' ] );
    } //
    $re_id_02='';
    if ( isset( $_POST[ 're_id_02' ] ) ) {
        $re_id_02 = htmlspecialchars( $_POST[ 're_id_02' ] );
    } //

    if ( isset( $_POST[ 'databiaoENname' ] ) ) {
        $databiao = htmlspecialchars( $_POST[ 'databiaoENname' ] ); //databiaoENname新表名
    }


    if ( $id >= 1 ) { //$id不为空时修改
        //echo "更新记录";

        //--------------------------------------更新为改变后的关系
        UpdataJilu( 'sys_guanxibiao', $id, 'sys_re_id_02', $re_id_02 ); //更新一条记录
        //echo $id;
    } else if ( $id == '' ) { //$id为空添加
        //echo "新增了";
        global $re_id, $hy, $bh, $sys_id_login, $SYS_UserName, $sys_id_fz, $bumen_id, $Conn;
        $sys_nowid_guanxi_col = 'sys_gx_id_' . $re_id;

        //--------------------------------------执行添加
        $sys_postzd_list = "`sys_re_id_02`,`sys_nowid_guanxi_col`,`sys_re_id`,`sys_huis`,`sys_id_login`,`sys_login`,`sys_yfzuid`,`sys_id_fz`,`bumen_id`";
        $sys_postvalue_list = "'$re_id_02','$sys_nowid_guanxi_col','$re_id','0','$sys_id_login','$SYS_UserName','$hy','$sys_id_fz','$bumen_id'";
        // echo $sys_postvalue_list;
        $now_add_id = ADD_Col_id( 'sys_guanxibiao', $sys_postzd_list, $sys_postvalue_list ); //查询添加的id
        if ( $now_add_id == '' ) {
            $sqlADD = "insert into `sys_guanxibiao` ($sys_postzd_list) values ($sys_postvalue_list)";
            //echo $sqlADD;
            //echo"<script>alert($sqlADD)</script>";
            mysqli_query( $Conn, $sqlADD ); //执行添加
            //这里执行检查是否有同步的列
            $now_add_id2 = ADD_Col_id( 'sys_guanxibiao', $sys_postzd_list, $sys_postvalue_list ); //查询添加的id
            //==========================================================查询到添加的id值
            echo( $now_add_id2 );
        } else {
            echo( $now_add_id );
        }
    }
    //-------------------------------------------------------------检查关系字段
    //GuanXiziduan_add($re_id,$re_id_02);   //关系字段更新

}; //function end
//===================================================================================【关系表添加与修改】
function GuanXi_ZiDuanChange_POST() {
    global $Conn, $Connadmin, $hy, $ToHtmlID, $sys_id_login, $re_id; //得到全局变量
    $id = $databiao = '';
    if ( isset( $_POST[ 'id' ] ) ) {
        $id = htmlspecialchars( $_POST[ 'id' ] );
    }
    if ( isset( $_POST[ 'databiaoENname' ] ) ) {
        $databiao = htmlspecialchars( $_POST[ 'databiaoENname' ] ); //databiaoENname新表名
    }
    $sys_re_id_02 = Tablename_Find_re_id( $databiao );
    if ( $id >= 1 ) { //$id不为空时修改
        UpdataJilu( 'sys_guanxibiao', $id, 'sys_re_id_02', $sys_re_id_02 ); //更新一条记录 
        //echo $id;
    }
}; //function end
//===================================================================================【关系表添加与修改】横向
function GuanXi_ZiDuanChange_Hengxiang_POST() {
    global $Conn, $hy, $ToHtmlID, $sys_id_login, $re_id; //得到全局变量
    $id = $databiao = '';
    if ( isset( $_POST[ 'id' ] ) ) {
        $id = htmlspecialchars( $_POST[ 'id' ] );
    }

    if ( isset( $_POST[ 'ziduanarry' ] ) ) {
        $ziduanarry = htmlspecialchars( $_POST[ 'ziduanarry' ] );
    }

    if ( $id >= 1 ) { //$id不为空时修改
        $ziduanarry = move_arrynull( $ziduanarry );
        //echo($ziduanarry);
        UpdataJilu( 'sys_guanxibiao', $id, 'sys_GuanXiZDList', $ziduanarry ); //更新一条记录
        //echo $id;
    }
}; //function end
//【ok】======================================================================================================顶级清单、分类
function bigmenu() {
    global $hy, $ToHtmlID, $databiao, $sys_id_login, $All_XT_ZiDuan, $Axt_m_ziduan_hidden, $xt_m_ziduan, $xt_m_ziduan_Name, $r_cow_height, $re_id, $sys_q_disabled, $sys_q_seid; //得到全局变量
    //echo "</br><br>";
    if ( $sys_id_login != 1 ) { //无权限时
        echo "<script>$('#{$ToHtmlID}_content_foot input,#{$ToHtmlID}_content_foot select').attr('disabled',true);</script>";
    }
    $Conn = ChangeConn( $databiao ); //依据表自动选择数据库
    echo "可能无用，已隐藏";
};
//======================================================================================================版式  
//function banshi(){//版式
//echo ("<div class='mains_top'><ul style='padding:10px'><li class='h_hou'><img src='../images/img.png' hspace='5' vspace='5'/></li><li class='h_hou' onclick=""""><img src='../images/img.png' hspace='5' vspace='5'/></li><li class='h_hou' onclick=""""><img src='../images/img.png' hspace='5' vspace='5'/></li><li class='h_hou' onclick=""""><img src='../images/img.png' hspace='5' vspace='5'/></li><li class='h_hou' onclick=""""><img src='../images/img.png' hspace='5' vspace='5'/></li><li class='h_hou' onclick=""""><img src='../images/img.png' hspace='5' vspace='5'/></li><li class='h_hou' onclick=""""><img src='../images/img.png' hspace='5' vspace='5'/></li><li class='h_hou' onclick=""""><img src='../images/img.png' hspace='5' vspace='5'/></li></ul></div>");
//};
//======================================================================================================//图片库加载
function picget() {
    global $databiao,$sys_q_cak,$Conn;
    if ( '1' . $databiao == '1' ) {
        echo( '没有数据表' );
    } elseif ( $sys_q_cak < 0 ) {
        echo( '没有权限' );
    } else {
        $rs = $sql = $nowrscount = $nowleixin = $nowphoto_name = $nowphotosrc = '';

        $sql = 'select id,photo_name,photo_src,photo_leixin From Sys_Pic where sys_huis=0';
        $rs = mysqli_query( $Conn, $sql );
        $nowrscount = mysqli_num_rows( $rs ); //统计数量
        $row = mysqli_fetch_array( $rs );
        mysqli_free_result( $rs ); //释放内存
        $nowrscount = $nowrscount;
        echo( "<div id='bbsTabntq' class='NowULTable'>" );
        for ( $i = 1; $i < $nowrscount; $i++ ) {
            $nowleixin = $row[ 'photo_leixin' ]; //得到类型
            $nowphoto_name = $row[ 'photo_name' ];
            $nowphotosrc = '../upload_swf/upload/' . $row[ 'photo_src' ];
            //$nowphotosrc=iconv("GB2312","UTF-8",$nowphotosrc);
            if ( getN( 'jeg,png,gif,bmp,jpeg,tiff', $nowleixin ) > -1 ) { //查找到当前是否属于图片格式。
                echo( "<ul style='border-bottom:1px solid #CCC;width:100%;'><li style='text-align:right;width:20%;height:55px;'><img src='" . $nowphotosrc . "' width='55' height='55'/></li><li style='width:70%;height:55px;'>" . $nowphoto_name . "</li></ul>" );
            } else {
                echo( "<ul><li style='text-align:right;width:20%;height:55px;border-bottom:1px solid #CCC;'>" . $nowphoto_name . "</li><li style='width:70%;height:55px;'>" . $nowphoto_name . "</li></ul>" );
            };
            //$rs.movenext;
        };
        echo( '</div>' );
    };
}
//======================================================================================================//显示页面的前端关系控制返回
function GuanXi_Back() {
    global $Conn, $hy, $ToHtmlID, $sys_id_login, $re_id; //得到全局变量

    //----------------------------------------------------------接收参数

    if ( isset( $_REQUEST[ 'sys_gx_re_id' ] ) ) {
        $sys_gx_re_id = $_REQUEST[ 'sys_gx_re_id' ];
    }
    if ( isset( $_REQUEST[ 'Table_name' ] ) ) {
        $Table_name = $_REQUEST[ 'Table_name' ];
    }
    $sys_re_id_02 = Tablename_Find_re_id( $Table_name );

    //----------------------------------------------------------开始查询数
    $sql = "select sys_GuanXiZDList From `sys_guanxibiao` where sys_re_id_02='$sys_re_id_02' and sys_nowid_guanxi_col='$sys_gx_re_id' and sys_huis='0'";
    // echo $sql;
    $rs = mysqli_query( $Conn, $sql );
    //$nowrscount = mysqli_num_rows( $rs ); //统计数量
    if($row = mysqli_fetch_array( $rs )){
        $sys_GuanXiZDList = $row[ 'sys_GuanXiZDList' ];
        echo trim( 'id=' . $sys_gx_re_id . ',' . $sys_GuanXiZDList, ',' );
    }
    mysqli_free_result( $rs ); //释放内存
}
//======================================================================================================//关系id对应的值 返回前端
function GetPage_Back() {
    global $Conn, $hy, $ToHtmlID, $sys_id_login, $re_id; //得到全局变量

    //----------------------------------------------------------接收参数关系id
    if ( isset( $_REQUEST[ 'GuanXi_id' ] ) ) {
        $GuanXi_id = $_REQUEST[ 'GuanXi_id' ];
    }
    if ( isset( $_REQUEST[ 'now_id' ] ) ) {
        $now_id = $_REQUEST[ 'now_id' ];
    }

    //----------------------------------------------------------开始查询数
    $sql = "select * From `sys_guanxibiao` where id='$GuanXi_id'";
    //echo $sql;
    $rs = mysqli_query( $Conn, $sql );
    //$nowrscount = mysqli_num_rows( $rs ); //统计数量
    $row = mysqli_fetch_array( $rs );
    $sys_GuanXiZDList = $row[ 'sys_GuanXiZDList' ]; //关系对应列表
    $sys_re_id = $row[ 'sys_re_id' ]; //父关系表re_id
    $Table_name_parent = Find_tablename( $sys_re_id ); //父关系表名
    $sys_re_id_02 = $row[ 'sys_re_id_02' ]; //关系表re_id

    $sql2 = "select * From `$Table_name_parent` where id='$now_id'";
    //echo $sql2;
    $rs2 = mysqli_query( $Conn, $sql2 );
    //$nowrscount = mysqli_num_rows( $rs ); //统计数量
    $row2 = mysqli_fetch_array( $rs2 );
    $GetPage = 'sys_gx_id_' . $sys_re_id . ':' . $now_id . ',';
    $Arr = explode( ',', $sys_GuanXiZDList );
    $countArry = count( $Arr );
    for ( $i = 0; $i < $countArry; $i++ ) {
        $Arr2 = explode( '=', $Arr[ $i ] );
        $sys_GuanXiZDList2 = $Arr2[ 0 ];
        $GetPage .= $Arr2[ 1 ] . ':' . $row2[ $sys_GuanXiZDList2 ] . ',';
    };
    $GetPage = trim( $GetPage, ',' );

    echo $GetPage;
    mysqli_free_result( $rs2 ); //释放内存
    //echo $sys_GuanXiZDList;
    mysqli_free_result( $rs ); //释放内存
}
function listdata() {
    global $Connadmin, $re_id, $SYS_QuanXian_list, $topBumenIdxList;
    
    $SYS_QuanXian_str = implode(',',$SYS_QuanXian_list);
    $topBumenIdxStr = implode(',',$topBumenIdxList);
    $listdata = array(
        'error' => null,
        'data' => array(),
        'modRoles' => array(),
        're_id' => $re_id
    );
    // echo $SYS_QuanXian_str;
    $sql = "
        SELECT id,bumen
        FROM msc_zhiwei
        WHERE bumen in($topBumenIdxStr)
            and FuZeRen = 1
            and id in($SYS_QuanXian_str)
    ";
    // echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数
    if ( $record_count == 0 ) {
        $listdata['error']= 'Sorry, No Data!';
    } else {
        $bumenList = array();
        $topidx = array();
        while ( $row = mysqli_fetch_array( $rs ) ) {
            $bumenList []= $row['bumen'];
            $topidx []= $row['id'];
        }
        $i = 0;
        $bumenStr = implode(',',$bumenList);
        $zhiweiList = array();
        returnListData($bumenStr,$i,$listdata['data'],0,'id',$zhiweiList);
        $listdata['modRoles'] = $_SESSION[ 'modRoles' ] = array_values(array_diff($zhiweiList, $topidx)); // 得到可以修改权限的对象

        $last_zhiwei = array_diff($SYS_QuanXian_list, $zhiweiList);
        if($last_zhiwei){
            $last_zhiwei_str = implode(',',$last_zhiwei);
            $sql2 = "
                SELECT id,bumen
                FROM msc_zhiwei
                WHERE id in($last_zhiwei_str)
            ";
            // echo $sql2;
            $rs2 = mysqli_query( $Connadmin, $sql2 );
            $bumenList = array();
            while ( $row = mysqli_fetch_array( $rs2 ) ) {
                if(!in_array($row['bumen'],$bumenList)){
                    $bumenList []= $row['bumen'];
                }
                $topidx []= $row['id'];
            }
            mysqli_free_result( $rs2 ); //释放内存
            $bumenStr = implode(',',$bumenList);
            last_returnListData($bumenStr,$i,$listdata['data'],0,$last_zhiwei_str);
        }

        mysqli_close( $Connadmin ); //关闭数据库 

        if ( $i == 0 ) {
            $listdata['error']= 'Sorry, No Data!';
        }
    }
    mysqli_free_result( $rs ); //释放内存
    $_SESSION['modRoles_pc'] = $listdata;
    echo json_encode($listdata,JSON_UNESCAPED_UNICODE);
}
//[ok]=========================================================================【得到部门】
function returnListData($id,&$i,&$listdata,$j,$str,&$zhiweiList) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    global $Connadmin, $hy, $re_id, $fields_to_check, $SYS_QuanXian_list;
    $sql = "SELECT id,bumenname,sys_adddate From msc_bumenlist where sys_yfzuid = '$hy' and $str in($id) order by id Asc";
    // echo $sql;
    $rs = mysqli_query( $Connadmin, $sql );

    while ( $row = mysqli_fetch_array( $rs ) ) {
        $id = $row[ 'id' ]; //id

        $sql2 = "select * From msc_zhiwei where sys_huis='0' and bumen = $id order by FuZeRen DESC";
        $rs2 = mysqli_query( $Connadmin, $sql2 );
        
        while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
            $id2 = $row2[ 'id' ]; //id
            $zhiweiList []= $id2;
            // if(!in_array($id2, $topidx)){
            $listdata[$i]['id'] = $id2;
            $listdata[$i]['zu'] = $row2['zu'];
            $listdata[$i]['FuZeRen'] = $row2['FuZeRen'];
            $listdata[$i]['Hierarchy'] = $j;
            $listdata[$i]['permissionControl'] = permissionAssignment($id2);

            foreach($fields_to_check as $item){
                if(getN( $row2[$item], $re_id, ',' ) == -1){
                    $listdata[$i][$item] = false;
                }else if(($listdata[$i]['permissionControl'] && in_array($item,$listdata[$i]['permissionControl']['quanxian'])) || in_array($id2,$SYS_QuanXian_list)){
                    $listdata[$i][$item] = true;
                }else{
                    $listdata[$i][$item] = false;
                    $nowrstext = movetext( $row2[$item], $re_id );
                    $nowrstext = move_arrynull( QuChong( $nowrstext ));
                    $sql4 = "
                        UPDATE msc_zhiwei
                        SET $item = '$nowrstext'
                        WHERE sys_yfzuid= $hy and id = $id2
                    ";
                    mysqli_query( $Connadmin, $sql4 );
                }
            }

            preg_match("/{$re_id}_(\d+)/", $row2['sys_q_fanwei'], $matches);
            if (!empty($matches) && $matches) {
                if(($listdata[$i]['permissionControl'] && $listdata[$i]['permissionControl']['fanwei'] >= $matches[1]) || (in_array($id2,$SYS_QuanXian_list) && !$listdata[$i]['permissionControl'])){
                    $listdata[$i]['sys_q_fanwei'] = $matches[1];
                }else if ($listdata[$i]['permissionControl']){
                    $fanweiQuanxian = $listdata[$i]['permissionControl']['fanwei'];
                    $removearry = $re_id.'_'.$matches[1]; //需去除的所有权限
                    $nowrstext = TwoArryQuChong( $row2['sys_q_fanwei'], $removearry, ',' ); 
                    $nowrstext = $nowrstext.','.$re_id.'_'.$fanweiQuanxian; 
                    $nowrstext = move_arrynull( QuChong( $nowrstext ));
                    $sql3 = "
                        UPDATE msc_zhiwei
                        SET sys_q_fanwei = '$nowrstext'
                        WHERE sys_yfzuid= $hy and id = $id2
                    ";
                    mysqli_query( $Connadmin, $sql3 );
                    $listdata[$i]['sys_q_fanwei'] = $fanweiQuanxian;
                }
            } else {
                $listdata[$i]['sys_q_fanwei'] = 0;
            }

            $i++;
        }
        mysqli_free_result( $rs2 ); //释放内存

        returnListData($id,$i,$listdata,$j+1,'parent',$zhiweiList);
    }
    
    mysqli_free_result( $rs ); //释放内存
    return $listdata;
}
function last_returnListData($id,&$i,&$listdata,$j,$last_zhiwei_str) {
    global $Connadmin, $hy, $re_id,$fields_to_check,$SYS_QuanXian_list;
    $sql = "SELECT id,bumenname,sys_adddate From msc_bumenlist where sys_yfzuid = '$hy' and id in($id) order by id Asc";
    $rs = mysqli_query( $Connadmin, $sql );

    while ( $row = mysqli_fetch_array( $rs ) ) {
        $id = $row[ 'id' ]; //id

        $sql2 = "select * From msc_zhiwei where sys_huis='0' and bumen = $id and id in('$last_zhiwei_str') order by FuZeRen DESC";
        // echo $sql2;
        $rs2 = mysqli_query( $Connadmin, $sql2 );
        
        while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
            $id2 = $row2[ 'id' ]; //id
            $zhiweiList []= $id2;
            // if(!in_array($id2, $topidx)){
            $listdata[$i]['id'] = $id2;
            $listdata[$i]['zu'] = $row2['zu'];
            $listdata[$i]['FuZeRen'] = $row2['FuZeRen'];
            $listdata[$i]['Hierarchy'] = $j;
            $listdata[$i]['permissionControl'] = permissionAssignment($id2);

            foreach($fields_to_check as $item){
                if(getN( $row2[$item], $re_id, ',' ) == -1){
                    $listdata[$i][$item] = false;
                }else if(($listdata[$i]['permissionControl'] && in_array($item,$listdata[$i]['permissionControl']['quanxian'])) || in_array($id2,$SYS_QuanXian_list)){
                    $listdata[$i][$item] = true;
                }else{
                    $listdata[$i][$item] = false;
                    $nowrstext = movetext( $row2[$item], $re_id );
                    $nowrstext = move_arrynull( QuChong( $nowrstext ));
                    $sql4 = "
                        UPDATE msc_zhiwei
                        SET $item = '$nowrstext'
                        WHERE sys_yfzuid= $hy and id = $id2
                    ";
                    mysqli_query( $Connadmin, $sql4 );
                }
            }

            preg_match("/{$re_id}_(\d+)/", $row2['sys_q_fanwei'], $matches);
            if (!empty($matches) && $matches) {
                if(($listdata[$i]['permissionControl'] && $listdata[$i]['permissionControl']['fanwei'] >= $matches[1]) || (in_array($id2,$SYS_QuanXian_list) && !$listdata[$i]['permissionControl'])){
                    $listdata[$i]['sys_q_fanwei'] = $matches[1];
                }else if ($listdata[$i]['permissionControl']){
                    $fanweiQuanxian = $listdata[$i]['permissionControl']['fanwei'];
                    $removearry = $re_id.'_'.$matches[1]; //需去除的所有权限
                    $nowrstext = TwoArryQuChong( $row2['sys_q_fanwei'], $removearry, ',' ); 
                    $nowrstext = $nowrstext.','.$re_id.'_'.$fanweiQuanxian; 
                    $nowrstext = move_arrynull( QuChong( $nowrstext ));
                    $sql3 = "
                        UPDATE msc_zhiwei
                        SET sys_q_fanwei = '$nowrstext'
                        WHERE sys_yfzuid= $hy and id = $id2
                    ";
                    mysqli_query( $Connadmin, $sql3 );
                    $listdata[$i]['sys_q_fanwei'] = $fanweiQuanxian;
                }
            } else {
                $listdata[$i]['sys_q_fanwei'] = 0;
            }

            $i++;
        }
        mysqli_free_result( $rs2 ); //释放内存
    }
    mysqli_free_result( $rs ); //释放内存
    return $listdata;
}
function permissionAssignment($zhiwei_id) {
    global $Connadmin,$re_id,$fields_to_check;
    // echo $parent_id;
    $father_id = 0;
    $sql = "
        SELECT z2.id,z2.bumen
        FROM `msc_zhiwei` z1 
        JOIN `msc_zhiwei` z2 ON z1.bumen = z2.bumen 
        WHERE z1.id = '$zhiwei_id' and z2.FuZeRen = 1
    ";
    // echo $sql;
    $rs = mysqli_query( $Connadmin, $sql );
    $row = mysqli_fetch_array( $rs );
    mysqli_free_result( $rs ); //释放内存
    if($zhiwei_id == $row[ 'id' ]){
        $bumen = $row[ 'bumen' ]; //标准名称
        $sql = "
            SELECT z.id
            FROM `msc_zhiwei` z
            JOIN `msc_bumenlist` b ON b.parent = z.bumen 
            WHERE z.FuZeRen = 1 and b.id = $bumen
        ";
        // echo $sql;
        $rs = mysqli_query( $Connadmin, $sql );
        if($row2 = mysqli_fetch_array( $rs )){
            $father_id = $row2[ 'id' ];
        }
        mysqli_free_result( $rs ); //释放内存
    }else{
        $father_id = $row[ 'id' ];
    }

    //---------------------------------------------------------------------职位权限查询

    $father_sql = "select * From `msc_ZhiWei` where id='$father_id' ";
    $father_rs = mysqli_query( $Connadmin, $father_sql );
    if($father_row = mysqli_fetch_array( $father_rs )){
        $quanxian = array();
        $i = 0;
        foreach($fields_to_check as $item){
            $check = $father_row[$item];
            if(getN( $check, $re_id ,',') >= 0){
                $i++;
                $quanxian []= $item;
            }
        }
        preg_match("/{$re_id}_(\d+)/", $father_row['sys_q_fanwei'], $matches);
        if($i){
            return array(
                'quanxian' => $quanxian,
                'fanwei' => isset($matches[1]) ? $matches[1] : 0 
            );        
        }else{
            return false;
        }
    }
    mysqli_free_result( $father_rs ); //释放内存
}
?>