<?php
    include_once("config.php");
    include_once('conn.php');
    $db = new Database($dbconfig);

    $Connadmin=mysqli_connect($dbconfig["host"], $dbconfig["username"], $dbconfig["password"],$dbconfig["database"]); 
    if(!$Connadmin){//这里是错误时提示错误
        die("DB连接失败: " . mysqli_connect_error());
    }else{
        $Connadmin->set_charset("utf8");//数据库编码
    };
?>
