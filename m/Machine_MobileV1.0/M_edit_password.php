<?php
header( 'Content-type: text/html; charset=utf-8' ); //设定本页编码
include_once( '../../session.php' );
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息

$TitleName = $InputType = $thisvale = $zdname = $Tablename = '';
if ( isset( $_REQUEST[ "id" ] ) ) {
    $id = $_REQUEST[ "id" ]; //id
}
if ( isset( $_REQUEST[ "TitleName" ] ) ) {
    $TitleName = $_REQUEST[ "TitleName" ]; //titlename接收
}
if ( isset( $_REQUEST[ "InputType" ] ) ) {
    $InputType = $_REQUEST[ "InputType" ]; //InputType接收
}
if ( isset( $_REQUEST[ "thisvale" ] ) ) {
    $thisvale = $_REQUEST[ "thisvale" ]; //thisvale接收
}
if ( isset( $_REQUEST[ "Tablename" ] ) ) {
    $Tablename = $_REQUEST[ "Tablename" ]; //tablename
}
if ( isset( $_REQUEST[ "zdname" ] ) ) {
    $zdname = $_REQUEST[ "zdname" ]; //zdname
}

//echo 'id：'.$id.'<br>Tablename：'.$Tablename.'<br>TitleName：'.$TitleName.'<br>InputType：'.$InputType.'<br>thisvale：'.$thisvale.'<br>zdname：'.$zdname;

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width,user-scalable=0,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="format-detection" content="telephone=no"/>
<title>SQP Certificate Mobile</title>
<link href="theme/style.css" rel="stylesheet" type="text/css"/>
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
        </a> 
        <!--
			<em class="logo"><img src="../../images/logo-sqp.png"></em>
            !--> 
        <em  class="eleft">修改密码</em> <a href="M_catalog.php" class="siteMap"></a> </div>
    <div class="headpadd"></div>
    <div id="index">
        
        <!--      !-->
        
        <div  class="incBox_login">
            <div class="LoginBox">
                <ul class="boxshadow" onmouseover="this.style.backgroundColor='#FFF';this.style.color='#000';" onmouseout="this.style.backgroundColor='#FFF';" >
                    <li class="lione">原密码：</li>
                    <li class="lioneright">
                        <input name="Y_password"  type="password"  tabindex="1" id="Y_password" value=""/>
                    </li>
                </ul>
                <ul class="boxshadow" onmouseover="this.style.backgroundColor='#FFF';this.style.color='#000';" onmouseout="this.style.backgroundColor='#FFF';" >
                    <li class="lione">新密码：</li>
                    <li class="lioneright">
                        <input name="new_password"  type="password"  tabindex="2" id="new_password" value=""/>
                    </li>
                </ul>
                <ul class="boxshadow" onmouseover="this.style.backgroundColor='#FFF';this.style.color='#000';" onmouseout="this.style.backgroundColor='#FFF';" >
                    <li class="lione">确认密码：</li>
                    <li class="lioneright">
                        <input name="new_password2"  type="password"  tabindex="3" id="new_password2" value=""/>
                    </li>
                </ul>
                <ul class="ullogin" >
                    <input name="Submit" type="submit" class="boxshadow" tabindex="5" title="可按Enter键提交！"   onmouseover="this.style.backgroundColor='#FFF';this.style.color='#000';" onmouseout="this.style.backgroundColor='#999';" onclick="<?php echo "M_edit_password();" ?>" src="images/f_bg_h.gif"  value="Enter" alt="ENTER"/>
                </ul>
            </div>
        </div>
    </div>
    <?php include_once( 'M_foot.php' );?>
    <?php include_once( 'M_bottom.php' );?>
    
<script type="text/javascript" src="../../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../../js/B_login_fnction.js"></script>
</div>
</body>
</html>