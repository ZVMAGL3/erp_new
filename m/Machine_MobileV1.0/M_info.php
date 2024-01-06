<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
// include_once( 'M_quanxian.php' ); //接收职位权限信息

//------------------------------------------------------------------以下为查询到相关信息
$sql = $rs = $row = '';
$sql = "select * From `msc_user_reg` where id='$user_id' "; //用户登录表
// echo $sql;
$rs = mysqli_query( $Connadmin, $sql );
$row = mysqli_fetch_array( $rs );
//$countrows = mysqli_num_rows( $rs ); //得到数量
// echo $P_M;
$SYS_UserName = $row[ 'SYS_UserName' ]; //姓名
$SYS_XingBie = $row[ 'SYS_XingBie' ]; //性别
$DiZhi = $row[ 'SYS_DiZhi' ]; //地址
$SYS_ShouJi = $row[ 'SYS_ShouJi' ]; //手机
$SYS_Email = $row[ 'SYS_Email' ]; //邮件
$SYS_qianmin = $row[ 'SYS_qianmin' ]; //签名
$touxiagn = file_exists("../../images/user_touxiang/".$user_id.".png")?1:0 ;
$variables = array(
    'user_id',
    'SYS_UserName',
    'SYS_XingBie',
    'DiZhi',
    'SYS_ShouJi',
    'SYS_Email',
    'SYS_qianmin'
);

$setCount = 0; // 初始化设置的计数器

foreach ($variables as $variable) {
    if (isset($$variable) && $$variable != '') {
        $setCount++;
    }else{
        echo $variable;
    }
}

$setCount = $setCount + $touxiagn;

mysqli_free_result( $rs ); //释放内存

mysqli_close( $Connadmin ); //关闭数据库
?>
<!DOCTYPE HTML>
<html>
<head>
<!-- <base href="../m/Machine_MobileV1.0/"> -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width,user-scalable=0,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="format-detection" content="telephone=no"/>
<title>SQP Certificate Mobile</title>
<link href="theme/style.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
<div id="wrapper"> 
    <div id="header">
        <?php   
            if($P_M){
        ?>
        <a href="M_set.php" class="home"></a> 
        <?php
            }
        ?>        
        <em class="eleft">个人资料</em> <a href="M_right_menu.php" class="siteMap"></a> </div>
    <div class="headpadd"></div>
    <div id="index"> 
        
        <!--!-->
        <div id="catalog">
            <ul>
                <li>
                    <a href="M_info_basic.php"  style="display: flex;">
                        基本资料<font color="#CCC"> . My Basic data</font>
                        <div class="logo_box" style="flex: 1;text-align: right;">
                            <i id='jbzl_logo'></i>
                            <span id="jbzl_text"></span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="M_UserRenZheng.php" style="display: flex;">
                        实名认证<font color="#CCC"> . My Real name cert</font>
                    </a>
                </li>
                <li>
                    <a href="M_PaymentMethod.php" style="display: flex;">
                        收款方式<font color="#CCC"> . Pay style</font>
                    </a>
                </li>
                
            </ul>
        </div>
    </div>
    <?php include_once( 'M_foot.php' );?>
    <?php include_once( 'M_bottom.php' );?>
</div>
</body>
</html>
<script type="text/javascript" src="../../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../../js/B_code.js"></script>
<script type="text/javascript" src="../../js/B_login_fnction.js"></script>
<script>

    if(<?php echo $setCount ?> === 8){
        $('#jbzl_logo').toggleClass('fas fa-check-circle green-icon')
        $('#jbzl_text').text('填写完毕')
    }else{
        $('#jbzl_logo').toggleClass('fas fa-times green-icon').css('color','red')
        $('#jbzl_text').text(`完成 <?php echo $setCount ?>/8`)
    }

    window.onload = function() {
      var refreshNeeded = localStorage.getItem('refreshNeeded');
      if (refreshNeeded) {
        // 移除标志，以免下次重复刷新
        localStorage.removeItem('refreshNeeded');
        
        // 执行刷新操作
        location.reload();
      }
    };
</script>