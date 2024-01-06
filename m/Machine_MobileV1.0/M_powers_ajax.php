<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once '../../inc/B_conn.php'; //连上数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_powers_Set.php'; //连上参数设定
$zhiwei_id = $id;
if ( $act == 'list' ) { //当接收到处理指令时
    //echo $nowkeyword;
    echo listdata( $zhiwei_id ); //标准清单
}
//[ok]=========================================================================【标准分类 输出数据】
function listdata( $zhiwei_id ) {
    global $Connadmin, $nowkeyword, $huis, $tablename, $colsname, $textsname, $phpstart;

    $listdata = '';
    $sql = "
        select id,number,$colsname,sys_zt,sys_adddate
        From `$tablename`
        where
            sys_huis='$huis'
            and ($colsname like '%$nowkeyword%' or `number` like '%$nowkeyword%')
        order by id Asc
    ";

    // echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数
    // echo $record_count.'_'; 

    $i = 0;
    if ( $record_count == 0 ) {
        $listdata .= '<li><a href="#"><font color="red"> Sorry, No Data！</font></a></li>';
    } else {
        while ( $row = mysqli_fetch_array( $rs ) ) {
            $i++;
            $id = $row[ 'id' ]; //标准id
            $name = $row[ $colsname ]; //标准名称
            $number = $row[ 'number' ]; //标准编号
            $record_count2 = listdata2( $id );
            // if ( $huis == 1 ) {
            //     $edithref = "#";
            //     $nowhuishtml = "<dd><p onclick=DelToHuishou_mobile_one('dels_huis','$id','$tablename','$huis','$phpstart')><i class='fa fa-fanhui-02'></i>恢复</p></dd>";
            //     //$nowhuishtml = "<dd><p onclick=alert('回收')><i class='fa fa-fanhui-02'></i>回收</p><p onclick=alert('彻删')><i class='fa fa-del'></i>彻删</p></dd>";
            // } else {
                $edithref = $phpstart . "_terms.php?parent_id=$zhiwei_id&id=$id";
                // $nowhuishtml = "<dd class='hui'>$record_count2</dd>"; //$adddate
            // }
            $listdata .= '<li><a href="' . $edithref . '"><i class="fa fa-23-4"></i>&nbsp;&nbsp;' . $number . '&nbsp;' . $name . '</a></li>';
        }
    }
    mysqli_free_result( $rs ); //释放内存
    return $listdata;
}

//[ok]=========================================================================【标准分类 输出数据】
function listdata2( $id ) {
    global $Connadmin, $Conn, $hy, $zhiwei_id;

    //---------------------------------查询职权
    $sql = "select id,sys_q_cak From `msc_zhiwei` where sys_huis='0' and id='$zhiwei_id'  order by id Asc";
    // echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $row = mysqli_fetch_array( $rs );
    $sys_q_cak = $row[ 'sys_q_cak' ]; //sys_q_cak
    mysqli_free_result( $rs ); //释放内存

    $sql2 = "select id From `sys_jlmb` where sys_huis='0' and id in('$sys_q_cak') and sys_id_standard='$id' order by id Asc";
    // echo $sql2.'_'; 
    $rs2 = mysqli_query( $Conn, $sql2 );
    $record_count3 = mysqli_num_rows( $rs2 ); //统计总记录数
    //echo $record_count3.'_'; 

    mysqli_free_result( $rs2 ); //释放内存
    return $record_count3;
}
mysqli_close( $Connadmin ); //关闭数据库 
?>
