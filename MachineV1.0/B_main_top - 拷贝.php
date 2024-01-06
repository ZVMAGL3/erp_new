<?php
include_once '../session.php';
include_once 'B_quanxian.php';
include_once '../inc/Function_All.php';
include_once '../inc/B_Config.php'; //执行接收参数及配置
include_once '../inc/B_conn.php';
//$nowre_id=321;
//$colname="GongSiMingChen";
//$newcolname="GongSiMingChen22";
//echo change_colname_guanxibiao($nowre_id,$colname,$newcolname);

$rs = $sql = $Menu_Id_List = $Menu_checd_Id = '';
$sql = "select * From sys_top_menu where sys_yfzuid='$hy' and sys_id_login='$bh' ";
//echo $sql;
$rs = mysqli_query( $Conn, $sql );
//$row = mysqli_fetch_array($rs);
if ( !$row = mysqli_fetch_array( $rs ) ) {
    $Menu_Id_List = ''; //查询到需显示的菜单清单
    $Menu_checd_Id = 0; //当前活动的菜单
} else {
    $Menu_Id_List = $row[ 'Menu_Id_List' ]; //查询到需显示的菜单清单
    //echo $Menu_Id_List;
    $Menu_checd_Id = $row[ 'Menu_checd_Id' ]; //当前活动的菜单
};
/*
$Menu_Id_List='321_顾客档案表,275_共享管理,223_供方名录,220_物资采购订货单,215_销售合同/订单,385_产品清单,217_顾客满意度调查表,461_OA-办公中心目录,204_员工档案';
$Menu_checd_Id=321;
//echo $Menu_Id_List;*/

if ( isset( $_SESSION[ 'reg_name' ] ) ) { //公司名称
    $reg_name = $_SESSION[ 'reg_name' ];
    if ( isset( $_REQUEST[ 'reg_name' ] ) ) { //REQUEST优先
        if ( $_REQUEST[ 'reg_name' ] . '1' != '1' )$reg_name = $_REQUEST[ 'reg_name' ];
    }
}

$cache_file = "cache/$SYS_Company_id/B_menu_desk/B_menu_desk_$SYS_QuanXian.php";
if ( file_exists( $cache_file ) ) { //文件存在时
    include_once( $cache_file );
} else {
    //echo '<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script><script type="text/javascript" src="../js/B_login_fnction.js"></script>';
    echo "<script>UpdatePhp_Zw($SYS_QuanXian);</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<title>SQP阳光质造管理系统[<?php echo $reg_name ?>]</title>
<link href='../style/style.css' rel='stylesheet' type='text/css' />
<link href='../style/menuimage.css' rel='stylesheet' type='text/css' />
<link href='style/moban_top.css' rel='stylesheet' type='text/css'/>
<script language='JavaScript' src='../js/jquery-1.8.3.min.js' type='text/javascript' charset='utf-8'></script> 
<script language='JavaScript' src='../js/jq-top.js' type='text/javascript' charset='utf-8'></script>
</head>

<style>
.deskdiv {
    background: url("images/desk_img/003.jpg");
    -webkit-filter: blur(1px);
    -moz-filter: blur(1px);
    -o-filter: blur(1px);
    -ms-filter: blur(1px);
    filter: blur(0px);
    /* 背景图垂直、水平均居中 */
    background-position: center center;
    /* 背景图不平铺 */
    background-repeat: no-repeat;
    /* 当内容高度大于图片高度时，背景图像的位置相对于viewport固定 */
    background-attachment: fixed;
    /* 让背景图基于容器大小伸缩 */
    background-size: cover;
    
   
    position: fixed;
	left:0px;
    right: 0px;
	height:100%;
    width: auto;
	bottom:8px;
	top:44px;
	overflow:hidden;
	padding:0;
	margin:0;
    border:0;
	border-top:0px solid #333;
	z-index: -1;
}
    body{
      background: #333;  

    }
</style>

<body>
 <div class='deskdiv'>000</div>
<div class='topall_bg'></div>
<div class='topall'>
    <ul id='headindextop' class='nocopytext'><li  id='DeskMenuDiv0' class='overli'>首页</li></ul>
</div>
<?php
$Htmlcache = '';
$Htmlcache .= "<script>AddTopMenu('$Menu_Id_List');";
if ( '1' . $Menu_checd_Id == "1"
    or $Menu_checd_Id == 'undefined'
    or $Menu_checd_Id == 0 ) {
    $Htmlcache .= "Top_SelectTag('DeskMenuDiv0');";
} else {
    $Htmlcache .= "Top_SelectTag('DeskMenuDiv$Menu_checd_Id');";
};

$Htmlcache .= "</script>";
echo $Htmlcache;
//$Htmlcacheall='<?php echo"'.$Htmlcache.' ";? >';
//echo $Htmlcache;
//find_cache('3',$Htmlcacheall);
mysqli_free_result( $rs ); //释放内存
?>
</body>
</html>