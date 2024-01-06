<?php
$cache_file="cache/$hy/B_quanxian/B_quanxian_$SYS_QuanXian.php";
// echo $cache_file;
if(file_exists($cache_file)){//文件存在时
    include_once($cache_file);
}else{
	//echo '职位丢失了';
	//echo '<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script><script type="text/javascript" src="../js/B_login_fnction.js"></script>';
	echo "<script>UpdatePhp_Zw('$SYS_QuanXian');</script>";
}
?>