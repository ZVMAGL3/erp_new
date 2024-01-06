<?php
if (!session_id())session_start(); //初始化会话数据
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once '../../inc/Function_All.php'; //连上注册数据库
if(isset($_POST['hy']) && isset($_POST['user_id'])){
    $hy = $_POST['hy'];
    $user_id = $_POST['user_id'];
    $_SESSION['hy'] = $_POST['hy'];
    $_SESSION['sys_yfzuid'] = $_POST['hy'];
    // echo '1';
    if(!selectQuanXian($hy,$user_id,$db)){
        $sql = "UPDATE msc_user_reg SET sys_yfzuid = $hy WHERE id = $user_id"; //修改
        // echo $sql;
        $rs = mysqli_query( $Connadmin, $sql );
        
        // 检查查询是否成功执行
        if ($rs !== false) {
            // 如果查询成功，关闭数据库连接
            // mysqli_free_result( $rs ); //释放内存
            mysqli_close($Connadmin);
            echo 1;
        } else {
            // 如果查询失败，可以打印出错误信息以获取更多信息
            echo "查询失败，错误信息：" . mysqli_error($Connadmin) . "<br>";
        }
    }else{
        echo '更改权限失败！';
    }
}else{
    echo 0;
}
?>