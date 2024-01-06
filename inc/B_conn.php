<?php 
    include_once("B_database.php");
    include_once('conn.php');
    $db_vip = new Database($database);

    $Conn = mysqli_connect($database["host"], $database["username"], $database["password"],$database["database"]);
    if (!$Conn) {
        die("DB连接失败: " . mysqli_connect_error()); // 输出连接错误信息
    }else{
        $Conn->set_charset("utf8");//数据库编码
    };

?>