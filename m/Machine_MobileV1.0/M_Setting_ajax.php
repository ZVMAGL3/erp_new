<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Setting_Set.php'; //连上参数设定

if ( $act == 'list' ) { //当接收到处理指令时
    //echo $nowkeyword;
    echo listdata();
}
//[ok]=========================================================================【输出数据】
function listdata() {
    global $Connadmin, $user_id, $keyword, $huis, $tablename, $colsname, $phpstart;
    $sql = $rs = $listdata = ''
    ;
    $sql = "
        SELECT reg.id,reg.$colsname,reg.sys_adddate 
        FROM msc_user_hy hy
        JOIN msc_huiyuan_reg reg ON hy.sys_yfzuid = reg.id
        WHERE reg.$colsname LIKE '%$keyword%' 
            AND hy.user_id='$user_id'
    ";

    // echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数
    //echo record_count.'_'; 

    $i = 0;
    if ( $record_count == 0 ) {
        $listdata .= '<li><a href="#"><font color="red"> Sorry, No Data!</font></a></li>';
    } else {
        while ( $row = mysqli_fetch_array( $rs ) ) {
            $i++;
            $hy = $row[ 'id' ]; //id
            $name = $row[ $colsname ]; //字段名称
            $adddate = $row[ 'sys_adddate' ]; //时间
            if ( $huis == 1 ) {
                $nowhuishtml = "<dd><p onclick=DelToHuishou_mobile_one('dels_huis','$hy','$tablename','$huis','$phpstart')><i class='fa fa-fanhui-02'></i>恢复</p></dd>";
            } else {
                $edithref = "M_Org_add.php?id=$hy&act=check_mobile";
                $nowhuishtml = "<dd class='hui'>$adddate </dd>";
            }
            $listdata .= '<li class="company_click" value="'.$hy.'"><a href="'.$edithref.'"><label><i class=\'fa fa-24-04\'></i>&nbsp;&nbsp;' . $hy . '&nbsp;&nbsp;' . $name . '</label>' . $nowhuishtml . '</a></li>';
        }
    }
    mysqli_free_result( $rs ); //释放内存
    mysqli_close( $Connadmin ); //关闭数据库 
    
    return $listdata;  
}
?>
