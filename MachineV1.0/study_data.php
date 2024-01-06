<?php
include_once( '../session.php' ); 
include_once '../inc/B_connadmin.php'; //连上注册数据库

$sql = "select sys_beizhu From msc_standard_terms where id = ?";
$params = array($id);
$queryResult = $db->query($sql, $params);
if ($db->numRows($queryResult['result']) > 0) {
    $result = mysqli_fetch_assoc($queryResult['result']);
    echo $result['sys_beizhu'];
}