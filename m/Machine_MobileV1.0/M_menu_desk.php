<?php
include_once( '../../session.php' );                   //接收session信息
$current_file=trim(basename(__FILE__),'.php');       //得到当前文件 除”.php“的文件名称
$cache_file="cache/{$SYS_Company_id}/{$current_file}/{$current_file}_1.php";       //文件地址
echo $cache_file;
if(file_exists( $cache_file )){
	include_once ($cache_file);
}else{
	echo"初始化中...";
	echo "<script>UpdatePhp_mobile($re_id,'{$current_file}');</script>"; 
}
?>