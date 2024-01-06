<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_GroupBranch_Set.php'; //连上参数设定

if ( $act == 'list' ) { //当接收到处理指令时
    //echo $nowkeyword;
    echo listdata();
}
//[ok]=========================================================================【输出数据】
function listdata() {
    global $Connadmin, $hy, $nowkeyword, $huis, $tablename, $colsname, $textsname, $phpstart;

    $sql = $rs = $xianshi_ZD_num = $listdata = '';
    if ( $nowkeyword . '1' != '1' ) { //不为空时
        $sql = "select id,$colsname,sys_adddate From `$tablename` where sys_huis='$huis' and $colsname like '%$nowkeyword%' and parent='$hy' order by id Asc";
    } else {
        $sql = "select id,$colsname,sys_adddate From `$tablename` where sys_huis='$huis' and parent='$hy' order by id Asc";
    }

    //echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数
    //echo record_count.'_'; 

    $i = 0;
    if ( $record_count == 0 ) {
        $listdata .= '<li><a href="#"><font color="#F66"> 没有子公司，点击‘+’添加</font></a></li>';
    } else {
        while ( $row = mysqli_fetch_array( $rs ) ) {
            $i++;
            $id = $row[ 'id' ]; //id
            $name = $row[ $colsname ]; //字段名称
            $adddate = $row[ 'sys_adddate' ]; //时间
            if ( $huis == 1 ) {
                $edithref = "#";
                $nowhuishtml = "<dd><p onclick=DelToHuishou_mobile_one('dels_huis','$id','$tablename','$huis','$phpstart')><i class='fa fa-fanhui-02'></i>恢复</p></dd>";
                //$nowhuishtml = "<dd><p onclick=alert('回收')><i class='fa fa-fanhui-02'></i>回收</p><p onclick=alert('彻删')><i class='fa fa-del'></i>彻删</p></dd>";
            } else {
                $edithref = $phpstart . "_edit.php?id=" . $id;
                $nowhuishtml = "<dd class='hui'>$adddate </dd>";
            }
            $listdata .= '<li><a href="' . $edithref . '"><label><input type="checkbox" class="idd" name="ID" value="' . $id . '" onchange="checkedGroup_mobile(this)"><i class=\'fa fa-jigou\'></i>&nbsp;&nbsp;' . $name . '</label>' . $nowhuishtml . '</a></li>';
        }
    }
    mysqli_free_result( $rs ); //释放内存
    mysqli_close( $Connadmin ); //关闭数据库 
    return $listdata;
}
?>
