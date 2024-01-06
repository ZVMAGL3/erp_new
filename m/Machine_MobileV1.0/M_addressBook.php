<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Jurisdiction_Set.php'; //连上参数设定
include_once '../../inc/B_Config.php';
include_once '../../inc/Function_All.php';

if ( $act == 'list' ) { //当接收到处理指令时
    // echo $nowkeyword;
    echo listdata();
}else if($act == 'list2'){
    echo listdata2();
}
//[ok]=========================================================================【输出数据】

function listdata() {
    global $Connadmin, $hy, $nowkeyword, $huis, $phpstart, $user_id;
    $listdata = '';
    $sql = "
        select reg.id,reg.SYS_UserName,hy.SYS_GongHao,reg.SYS_XingBie,hy.zhiwei_id,hy.state,reg.SYS_ShouJi
        From msc_user_hy AS hy
        JOIN msc_user_reg AS reg ON reg.id = hy.user_id
        where 
            hy.state = 1
            and hy.sys_yfzuid = '$hy' 
            and ( reg.SYS_UserName like '%{$nowkeyword}%') 
            order by hy.state desc
    ";

    // echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数
    //echo record_count.'_'; 

    if ( $record_count == 0 ) {
        $listdata .= '<li><a href="#">sorry,<font color="#CCC"> . 没有数据，请添加</font></a></li>';
    } else {
        while ( $row = mysqli_fetch_array( $rs ) ) {
            $id = $row[ 'id' ]; 
            $SYS_UserName = $row[ 'SYS_UserName' ]; //姓名
            $SYS_ShouJi = $row[ 'SYS_ShouJi' ]; 
            $touxiang_address = "../../images/user_touxiang/".$user_id.".png";
            $touxiang = file_exists($touxiang_address)?1:0 ;
            if(!file_exists($touxiang))$touxiang = '../../images/user_touxiang/moren.png';
            $listdata .= "
                <div class='TongXunLu_list' onclick='chatOn($id)'>
                    <div class='TongXunLu_img_box'>
                        <img class='TongXunLu_img' src='$touxiang' />
                    </div>
                    <div class='TongXunLu_username_box'>
                        <div class='TongXunLu_username'>$SYS_UserName</div>
                        <div class='TongXunLu_userShouJi'>$SYS_ShouJi</div>
                    </div>
                </div>
            ";
        }
    }
    mysqli_free_result( $rs ); //释放内存
    mysqli_close( $Connadmin ); //关闭数据库
    return $listdata;
}

function listdata2() {
    global $Connadmin, $hy, $nowkeyword, $huis, $phpstart, $user_id;
    $listdata = '';
    $sql = "
        select reg.id,reg.SYS_UserName,hy.SYS_GongHao,reg.SYS_XingBie,hy.zhiwei_id,hy.state,reg.SYS_ShouJi
        From msc_user_hy AS hy
        JOIN msc_user_reg AS reg ON reg.id = hy.user_id
        where 
            hy.state = 1
            and hy.sys_yfzuid = '$hy' 
            and ( reg.SYS_UserName like '%{$nowkeyword}%') 
            order by hy.state desc
    ";

    // echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数
    //echo record_count.'_'; 

    if ( $record_count == 0 ) {
        $listdata .= '<li><a href="#">sorry,<font color="#CCC"> . 没有数据，请添加</font></a></li>';
    } else {
        while ( $row = mysqli_fetch_array( $rs ) ) {
            $id = $row[ 'id' ]; 
            $SYS_UserName = $row[ 'SYS_UserName' ]; //姓名
            $SYS_ShouJi = $row[ 'SYS_ShouJi' ]; 
            $touxiang_address = "../../images/user_touxiang/".$user_id.".png";
            $touxiang = file_exists($touxiang_address)?1:0 ;
            if(!file_exists($touxiang))$touxiang = '../../images/user_touxiang/moren.png';
            $listdata .= "
                <div class='TongXunLu_list' onclick='chatOn($id)'>
                    <div class='TongXunLu_img_box'>
                        <img class='TongXunLu_img' src='$touxiang' />
                    </div>
                    <div class='TongXunLu_username_box'>
                        <div class='TongXunLu_username'>$SYS_UserName</div>
                        <div class='TongXunLu_userShouJi'>$SYS_ShouJi</div>
                    </div>
                </div>
            ";
        }
    }
    mysqli_free_result( $rs ); //释放内存
    mysqli_close( $Connadmin ); //关闭数据库
    return $listdata;
}


?>
