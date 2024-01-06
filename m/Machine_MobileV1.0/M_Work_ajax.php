<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Work_Set.php'; //连上参数设定

if ( $act == 'list' ) { //当接收到处理指令时
    //echo $nowkeyword;
    echo listdata();
}
//[ok]=========================================================================【输出数据】


function listdata() {
    global $Connadmin, $hy, $nowkeyword, $huis, $tablename, $colsname, $textsname, $phpstart;

    $sql2 = $rs2 = $listdata = '';
    if ( $nowkeyword . '1' != '1' ) { //不为空时
        $sql2 = "select id,$colsname,bumen From `$tablename` where sys_huis='$huis' and $colsname like '%$nowkeyword%' and sys_yfzuid='$hy' order by bumen Asc";
    } else {
        $sql2 = "select id,$colsname,bumen From `$tablename` where sys_huis='$huis' and sys_yfzuid='$hy'  order by bumen Asc";
    }

    //echo $sql.'_'; 
    $rs2 = mysqli_query( $Connadmin, $sql2 );
    $record_count2 = mysqli_num_rows( $rs2 ); //统计总记录数
    //echo record_count2.'_'; 

    $i = 0;
    if ( $record_count2 == 0 ) {
        $listdata .= '<li><a href="#"><font color="red"> Sorry, No Data！</font></a></li>';
    } else {
        while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
            $i++;
            $id2 = $row2[ 'id' ]; //id
            $bumen = $row2[ 'bumen' ]; //部门id
            $name2 = $row2[ $colsname ]; //字段名称
            //$adddate2 = $row2[ 'sys_adddate' ];   //时间
            $bumen_name = listdata2( $bumen ); //得到部门名称
            if ( $huis == 1 ) {
                $edithref = "#";
                $nowhuishtml = "<dd><p onclick=DelToHuishou_mobile_one('dels_huis','$id2','$tablename','$huis','$phpstart')><i class='fa fa-fanhui-02'></i>恢复</p></dd>";
                //$nowhuishtml = "<dd><p onclick=alert('回收')><i class='fa fa-fanhui-02'></i>回收</p><p onclick=alert('彻删')><i class='fa fa-del'></i>彻删</p></dd>";
            } else {
                $edithref = $phpstart . "_edit.php?id=" . $id2;
                $nowhuishtml = "<dd class='hui'> $bumen_name  </dd>";
            }
            $listdata .= '<li><a href="' . $edithref . '"><label>&nbsp;<input type="checkbox" class="idd" name="ID" value="' . $id2 . '" onchange="checkedGroup_mobile(this)">&nbsp;<i class="fa fa-peple"></i>&nbsp;&nbsp;' . $name2 . '</label>' . $nowhuishtml . '</a></li>';
        }
    }
    return $listdata;
    mysqli_free_result( $rs2 ); //释放内存
    mysqli_close( $Connadmin ); //关闭数据库 
}

function listdata2( $bumen ) {
    global $Connadmin, $hy, $huis;

    $sql = $rs = $listdata2 = '';
    $sql = "select id,bumenname From `msc_bumenlist` where sys_huis='$huis' and sys_yfzuid='$hy' and id='$bumen' order by id Asc";
    //echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数
    //echo record_count.'_'; 
    $i = 0;
    if ( $record_count == 0 ) {
        $listdata2 = '--';
    } else {
        while ( $row = mysqli_fetch_array( $rs ) ) {
            $i++;
            $bumenname = $row[ 'bumenname' ]; //字段名称
            $listdata2 = '<font color="#CCC">[' . $bumenname . ']&nbsp;</font>';
        }
    }
    mysqli_free_result( $rs ); //释放内存
    return $listdata2;
}
?>
