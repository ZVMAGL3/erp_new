<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once 'M_Org_Set.php'; //连上参数设定
// 定义需要处理的键的列表
$keysToProcess = array('act','name', 'yyzzhao', 'faren', 'address', 'tel', 'webhttp', 'email','user_hy','parent','xiugai');
// 创建一个关联数组，用于存储处理后的数据
// $postData = array();
// 遍历需要处理的键
foreach ($keysToProcess as $key) {
    if (isset($_POST[$key]) && $_POST[$key] != '') {
        $$key = $_POST[$key];
    }else{
        $act = 'error';
        echo $key;
    }
}
// echo $act.'_'.$hy;
$newimg = true;
// echo json_encode( $_FILES["avatar"] ,JSON_UNESCAPED_UNICODE);
if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == UPLOAD_ERR_OK) {
    $uploadedFile = $_FILES["avatar"]["tmp_name"];
}else{
    if($xiugai === false){
        $act = 'error';
    }else{
        $newimg = false;
    }
}

// 使用 extract() 函数将关联数组解压为独立变量
// extract($postData);

if($act == 'error'){
    echo 404;
}else{
    $sql = $rs = $record_count = '';
    
    $sql = "select sys_yfzuid,$colsname From `$tablename` where($colsname='$name' or yyzzhao='$yyzzhao') and id != $user_hy";
    // echo $sql;  
    $rs = mysqli_query( $Connadmin, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数

    if ( $record_count > 0 ) { //有重复值时
        echo 200;
    } else {
        $sql = '';
        if($act != 'check_mobile'){

            $sys_postzd_list = "$colsname,yyzzhao,faren,address,tel,webhttp,email,sys_login,user_id,parent"; //加上系统默认值
            $sys_postvalue_list = "'$name','$yyzzhao','$faren','$address','$tel','$webhttp','$email','$SYS_UserName','$user_id','$parent'";

            $sys_postvalue_list = '
                START TRANSACTION;
                INSERT INTO ' . $tablename . ' (' . $sys_postzd_list . ') VALUES (' . $sys_postvalue_list . ');
                SET @hy = LAST_INSERT_ID();
                INSERT INTO msc_bumenlist (bumenname, sys_yfzuid) VALUES ("总经办", @hy);
                SET @bumen_id = LAST_INSERT_ID();
                INSERT INTO msc_zhiwei (sys_yfzuid, zu, bumen) VALUES (@hy, "总经理", @bumen_id);
                SET @authority_id = LAST_INSERT_ID();
                INSERT INTO msc_user_hy (user_id, sys_yfzuid, SYS_GongHao, zhiwei_id, state) VALUES ("' . $user_id . '", @hy,1, @authority_id,1);
                UPDATE msc_user_reg SET sys_yfzuid = @hy WHERE id = ' . $user_id . ';
                COMMIT;     
            ';
            // echo $sys_postvalue_list;

            mysqli_begin_transaction($Connadmin); // 开始事务
            
            $rs = mysqli_multi_query($Connadmin, $sys_postvalue_list);
            echo mysqli_error($Connadmin);
            
            if ($rs) {
                mysqli_commit($Connadmin); // 提交事务
                echo 64;
            } else {
                mysqli_rollback($Connadmin); // 回滚事务
            }
        }else{
            $sys_postzd_list = "gongsimingceng = '$name', yyzzhao = '$yyzzhao', faren = '$faren', address = '$address', tel = '$tel', webhttp = '$webhttp', email = '$email', sys_login = '$SYS_UserName'";
            $sql = "UPDATE `$tablename` SET $sys_postzd_list WHERE sys_yfzuid = $user_hy";
            $rs = mysqli_query( $Connadmin, $sql ); //执行添加
        }

        if($newimg){
            $uploadDir = "../../images/user-gongsizhizhao/";
            $newFileName = $yyzzhao . ".png";
            $destination = $uploadDir . $newFileName;
            // echo $destination;
            move_uploaded_file($uploadedFile, $destination);
        }
    }
    mysqli_close( $Connadmin ); //关闭数据库 
}
?>
