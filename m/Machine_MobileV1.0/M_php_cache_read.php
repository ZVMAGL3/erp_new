<?php
include_once "../../session.php";
$cache_file="cache/{$SYS_Company_id}/{$current_file}/{$current_file}_{$re_id}.php";       //文件地址
if(file_exists( $cache_file )){

	include_once ($cache_file);
}else{
	echo"初始化中...";
	echo "<script>UpdatePhp_mobile($re_id,'{$current_file}');</script>"; 
}

?>