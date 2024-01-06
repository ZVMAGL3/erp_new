<?php
    include_once 'session.php';
    include_once 'inc/B_Config.php';//执行接收参数及配置
    include_once 'inc/B_conn.php';
    $query = "SELECT CONCAT('ALTER TABLE `', TABLE_NAME, '` ENGINE = InnoDB;') AS sql_statement
    FROM information_schema.tables
    WHERE table_schema = 'botelerp' AND table_type = 'BASE TABLE';";
    $queryResult = $db_vip->query($query);
    while($result = mysqli_fetch_assoc($queryResult['result']))
    {
        echo $result['sql_statement'];
    }
?>