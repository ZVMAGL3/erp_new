<?php
header('Content-type: text/html; charset=utf-8');  //设定本页编码
session_start();
session_destroy();                                 //删除所有的session
$urlindex="http://".$_SERVER['HTTP_HOST'].'/index.php';
//exit();
echo "<script language='javascript' type='text/javascript'>";
echo " window.location.href='$urlindex'; ";
echo "</script>";
?>