<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once '../../inc/B_conn.php'; //连上注册数据库
include_once '../../inc/Function_All.php'; //
include_once '../../inc/B_Config.php'; //执行接收参数及配置
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_RecordList_terms_show_Set.php'; //连上参数设定

if ( isset( $_REQUEST[ 'parent_id2' ] ) )$parent_id2 = $_REQUEST[ 'parent_id2' ]; //接收parent_id2
if ( $act == 'list' ) { //当接收到处理指令时
    echo listdata( $id ); //标准条款清单
} elseif ( $act == 'table_pinyin_mobile' ) {
    echo table_pinyin_mobile(); //查询表是否有重复值
}

//[ok]=========================================================================【标准条款 输出数据】
function listdata( $id ) {
    global $Connadmin, $Conn, $hy, $nowkeyword, $huis, $textsname, $phpstart, $tablename, $colsname, $nowgsbh, $parent_id;

    //echo "<br><br><br><br>".$id ;
    $sql = $rs = $listdata = '';

    //---------------------------------------------------------------------得到大类菜单
    $sql = "select id,sys_id_standard,sys_GuoChengMingChen From `msc_menubigclass` where id='$id'  order by id Asc";
    $rs = mysqli_query( $Connadmin, $sql );
    $row = mysqli_fetch_array( $rs );
    $name = $row[ 'sys_GuoChengMingChen' ]; //标准名称
    $number = $row[ 'sys_id_standard' ]; //标准编号
    mysqli_free_result( $rs ); //释放内存

    //$listdata = '<li><a href="M_Standard_terms_edit.php?id='.$id.'">' . $sys_konggei . $tiaok . '&nbsp;' . $name  . $nowhuishtml . '</a></li>';
    $listdata = '<li style="margin-top:12px;margin-bottom:8px;"><a href="M_RecordList_terms_edit.php?parent_id=' . $parent_id . '&id=' . $id . '"><strong>' . $name . '</strong><dd class="hui"> &nbsp;</dd></a></li>';

    $sql = $rs = '';
    //---------------------------------------------------------------------记录清单
    if ( $nowkeyword . '1' != '1' ) { //不为空时
        $sql = "select id,$colsname,sys_bh,banben,xiugaicishu,sys_adddate From `$tablename` where sys_huis='$huis' and $colsname like '%$nowkeyword%' and Id_MenuBigClass='$id' order by sys_bh Asc";
    } else {
        $sql = "select id,$colsname,sys_bh,banben,xiugaicishu,sys_adddate From `$tablename` where sys_huis='$huis'  and Id_MenuBigClass='$id' order by sys_bh Asc";
    }

    //echo $sql.'_'; 
    $rs = mysqli_query( $Conn, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数
    //echo record_count.'_'; 

    $i = 0;
    if ( $record_count == 0 ) {
        $listdata .= '<li><a href="#"><font color="red"> Sorry, No Data！</font></a></li>';
    } else {
        while ( $row = mysqli_fetch_array( $rs ) ) {
            $i++;
            $sys_konggei = '';
            $id2 = $row[ 'id' ]; //id
            $sys_bh = $row[ 'sys_bh' ]; //编号
            $name = $row[ $colsname ]; //标准名称
            $adddate = $row[ 'sys_adddate' ]; //时间
            $banben = $row[ 'banben' ]; //版本
            $xiugaicishu = $row[ 'xiugaicishu' ]; //修改次数

            if ( $huis == 1 ) {
                $edithref = "#";
                $nowhuishtml = "<dd><p onclick=DelToHuishou_mobile_one('dels_huis','$id2','$tablename','$huis','$phpstart','$id')><i class='fa fa-fanhui-02'></i>恢复</p></dd>";
                //$nowhuishtml = "<dd><p onclick=alert('回收')><i class='fa fa-fanhui-02'></i>回收</p><p onclick=alert('彻删')><i class='fa fa-del'></i>彻删</p></dd>";
            } else {
                $edithref = $phpstart . "_edit.php?parent_id=$parent_id&parent_id2=$id&id=" . $id2;
                $sys_bh = $nowgsbh . '.QR-' . $id2 . '-' . $banben . '/' . $xiugaicishu;
                $nowhuishtml = "<dd class='hui'>$sys_bh </dd>";
            }
            $listdata .= '<li><a href="' . $edithref . '"><label><input type="checkbox" class="idd" name="ID" value="' . $id2 . '" onchange="checkedGroup_mobile(this)"><i class="fa fa-25-1"></i>&nbsp;' . $name . '</label>' . $nowhuishtml . '</a></li>';
        }
    }
    mysqli_free_result( $rs ); //释放内存
    return $listdata;
}
//[ok]=========================================================================【查询表是否有重复值】
function table_pinyin_mobile() {
    global $Connadmin, $Conn, $hy, $nowkeyword, $huis, $textsname, $phpstart, $tablename, $colsname, $nowgsbh, $parent_id, $id;
    if ( isset( $_REQUEST[ 'id' ] ) )$id = $_REQUEST[ 'id' ]; //接收id
    if ( isset( $_REQUEST[ 'tablename' ] ) )$tablename = $_REQUEST[ 'tablename' ]; //接收tablename
    if ( isset( $_REQUEST[ 'thisvalue' ] ) )$thisvalue = $_REQUEST[ 'thisvalue' ]; //thisvalue
    if ( isset( $_REQUEST[ 'thisvaluePY' ] ) )$thisvaluePY = $_REQUEST[ 'thisvaluePY' ]; //接收thisvaluePY
    //echo $id;
    $Table_Name_Old = Find_Col_Value( 'Sys_jlmb', "`id`='$id'", 'mdb_name_SYS' ); //查询到当前数据表
    if ( SYS_is( $Table_Name_Old, 'sys_' ) == 0 && SYS_is( $Table_Name_Old, 'msc_' ) == 0 ) {
        $mdb_name_SYS_conn = Conn_Table_In( $thisvaluePY ); //查询表是否存在于数据库
        if ( $mdb_name_SYS_conn == '-1' ) { //没有查到时
            $Table_Name = $thisvaluePY;
        } else {
            if ( strtolower( $Table_Name_Old ) <> strtolower( $thisvaluePY ) ) {
                $Table_Name = $thisvaluePY . GetRanNum(); //当新表也存在时加上随机码
            } else {
                $Table_Name = $thisvaluePY;
            }
        }
    } else { //系统数据表将不能修改
        $Table_Name = $Table_Name_Old;
    }
    return $Table_Name;
    //return '0';
}
mysqli_close( $Connadmin ); //关闭数据库 
mysqli_close( $Conn ); //关闭数据库 
?>
