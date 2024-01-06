<?php
include_once '../session.php';

$cache_file="cache/$SYS_Company_id/B_menu_desk/B_menu_desk_$SYS_QuanXian.php";
if( file_exists( $cache_file ) ){//文件存在时
    include_once ($cache_file);
}else{
	//echo '<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script><script type="text/javascript" src="../js/B_login_fnction.js"></script>';
	echo "<script>UpdatePhp_Zw($SYS_QuanXian);</script>";
}

?>