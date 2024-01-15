<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once 'M_Org_Set.php'; //连上参数设定
if ( $act == 'list3' ) { //当接收到处理指令时
    //echo $nowkeyword;
    echo listdata3();
}
if ( $act == 'list2' ) { //当接收到处理指令时
    //echo $nowkeyword;
    echo listdata2();
}
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
                $nowhuishtml = "<dd class='hui'>$adddate </dd>";
            }
            $listdata .= '<li class="company_click" value="'.$hy.'"><a href="#"><label><i class=\'fa fa-24-04\'></i>&nbsp;&nbsp;' . $hy . '&nbsp;&nbsp;' . $name . '</label>' . $nowhuishtml . '</a></li>';
        }
    }
    mysqli_free_result( $rs ); //释放内存
    mysqli_close( $Connadmin ); //关闭数据库 
    
    return $listdata;  
}
function listdata2() {
    global $Connadmin,$hy, $keyword, $huis, $tablename, $colsname, $phpstart;
    // echo $hy;
    $sql = $rs = $listdata = '';
    if ( $keyword . '1' != '1' ) { //不为空时
        $sql = "select id,$colsname,sys_adddate From $tablename where sys_huis='$huis'and parent = '$hy' and $colsname like '%$keyword%'";
    } else {
        $sql = "select id,$colsname,sys_adddate From $tablename where sys_huis='$huis' and parent = '$hy'";
    }
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
            $Subsidiaries = $row[ 'id' ]; //id
            $name = $row[ $colsname ]; //字段名称
            $adddate = $row[ 'sys_adddate' ]; //时间
            if ( $huis == 1 ) {
                $edithref = "#";
                $nowhuishtml = "<dd><p onclick=DelToHuishou_mobile_one('dels_huis','$Subsidiaries','$tablename','$huis','$phpstart')><i class='fa fa-fanhui-02'></i>恢复</p></dd>";
                //$nowhuishtml = "<dd><p onclick=alert('回收')><i class='fa fa-fanhui-02'></i>回收</p><p onclick=alert('彻删')><i class='fa fa-del'></i>彻删</p></dd>";
            } else {
                $nowhuishtml = "<dd class='hui'>$adddate </dd>";
            }
            $listdata .= '<li class="company_click" value="'.$Subsidiaries.'"><a href="#"><label><i class=\'fa fa-24-04\'></i>&nbsp;&nbsp;' . $Subsidiaries . '&nbsp;&nbsp;' . $name . '</label>' . $nowhuishtml . '</a></li>';
        }
    }
    mysqli_free_result( $rs ); //释放内存
    mysqli_close( $Connadmin ); //关闭数据库 
    
    return $listdata;  
}
function listdata3() {
    global $Connadmin, $user_id, $keyword, $tablename, $colsname;
    $sql = $rs = $listdata = '';
    $sql = "select id,$colsname From $tablename where sys_huis='0' and $colsname like '%$keyword%'";
    // echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    // echo $record_count.'_'; 

    $i = 0;
    while ( $row = mysqli_fetch_array( $rs ) ) {
        $hy = $row[ 'id' ]; //字段名称
        $company_name = $row[ $colsname ]; //字段名称
        $sql = "select state From msc_user_hy where user_id = $user_id and sys_yfzuid = $hy";
        // echo $sql;
        $rsl = mysqli_query( $Connadmin, $sql );
        $record_count = mysqli_num_rows( $rsl ); //统计总记录数
        $row = mysqli_fetch_array( $rsl );

        if ( $record_count == 0 || $row['state'] == 3 ) {
            $i++;
            $listdata .= '
                <li class="companyInfo_bacc">
                    <div class="companyInfo_box">
                        <label  class="company_info">
                            <i class=\'fa fa-24-04\'></i>
                            &nbsp;&nbsp;&nbsp;&nbsp;' . $company_name . '
                        </label>
                        <div class="join_button" onclick="join_company( ' .$hy .',\''. $company_name . '\')">
                            加入
                        </div>
                        
                    </div>
                    <div class="Wire"><div>
                </li>
            ';
        }
    }
    if($i == 0){
        $listdata .= '
            <div style="margin-top: 40px;text-align: center;">
                <span>没有可加入的公司！</span>
            </div>
        ';
    }
    mysqli_free_result( $rs ); //释放内存
    mysqli_close( $Connadmin ); //关闭数据库 
    
    return $listdata;  
}
?>
