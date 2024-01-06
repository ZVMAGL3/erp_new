<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once '../../inc/B_Config.php';//执行接收参数及配置
if(isset($_POST['name']))$name=$_POST['name'];
if(isset($_POST['reason']))$reason=$_POST['reason'];
if($name){
    $sql="select state from msc_user_hy where user_id = $user_id and sys_yfzuid = $id";
    $rs = mysqli_query( $Connadmin, $sql );
    echo mysqli_error($Connadmin);

    $record_count = mysqli_num_rows( $rs ); //统计总记录数
    if($record_count){
        $row = mysqli_fetch_array( $rs );
        switch($row['state']){
            case 0:
                echo 88;
                break;
            case 1:
                echo 201;
                break;
            case 2:
                echo 116;
                break;
            case 3:
                echo 165;
                break;
            default:
                // echo "未知错误，请尝试重新登录！";
                echo 404;
        }
    }else{
        $sql="
            INSERT INTO msc_user_hy (user_id, sys_yfzuid, Remark)
            VALUES ($user_id,$id,'姓名:$name,备注:$reason')
        ";
        $rs = mysqli_query( $Connadmin, $sql );
        if($rs){
            echo 200;
        }else{
            echo mysqli_error($Connadmin);
        }
        $sql="
            INSERT INTO msc_user_reg (SYS_UserName)
            VALUES ($name)
        ";
        mysqli_query( $Connadmin, $sql );
    }
}else{
    echo 125;
}
?>