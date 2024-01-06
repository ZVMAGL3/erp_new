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
    <div id="header"> <a href="javascript:history.go(-1)" class="home"></a> 
        <!--
			<em class="logo"><img src="../../images/logo-sqp.png"></em>
            !--> 
        <em  class="eleft">修改<?php echo $TitleName ?></em> <a href="M_catalog.php" class="siteMap"></a> </div>
    <div class="headpadd"></div>
    <div id="index"> 
        
        <!--      !-->
        
        <div  class="incBox_login">
            <div class="LoginBox">
                <?php
                if ( $InputType == 'input' ) {

                    ?>
                <ul class="boxshadow" onmouseover="this.style.backgroundColor='#FFF';this.style.color='#000';" onmouseout="this.style.backgroundColor='#FFF';" >
                    <li class="lioneright" style="width: 100%">
                        <input name="<?php echo $zdname ?>"  tabindex="1" id="<?php echo $zdname ?>" value="<?php echo $thisvale?>" />
                    </li>
                    <div class="rightdiv"></div>
                </ul>
                
                 <?php
                } else if($InputType == 'textarea') {
                    ?>
                <ul class="" style="width: 80%;margin: auto;padding: 10px;" onmouseover="this.style.backgroundColor='#FFF';this.style.color='#000';" onmouseout="this.style.backgroundColor='#FFF';" >
                    <li class="lioneright" style="width: 100%;height: 180px">
                        <textarea name='<?php echo $zdname ?>' id='<?php echo $zdname ?>' class='addboxinput inputfocus' style='width: 90%;height: 150px'><?php echo $thisvale?></textarea>
                    </li>
                    <div class="rightdiv"></div>
                </ul>
                <?php
                } else {
                    ?>
                <ul class="boxshadow" onmouseover="this.style.backgroundColor='#FFF';this.style.color='#000';" onmouseout="this.style.backgroundColor='#FFF';" >
                    <li class="lioneright" style="width: 100%">
                        <input name="<?php echo $zdname ?>"  tabindex="1" id="<?php echo $zdname ?>" value="<?php echo $thisvale?>" disabled />
                    </li>
                    <div class="rightdiv"></div>
                </ul>
                <?php
                }

                if ( $InputType == 'input' || $InputType == 'textarea') {
                    ?>
                <ul class="ullogin" >
                    <input name="Submit" type="submit" class="boxshadow" tabindex="5"    onmouseover="this.style.backgroundColor='#FFF';this.style.color='#000';" onmouseout="this.style.backgroundColor='#999';" onclick="<?php echo "M_edit_Post('$id','$Tablename','$zdname','$TitleName','$InputType');" ?>" src="images/f_bg_h.gif"  value="Enter" alt="ENTER"/>
                </ul>
                <?php
                } else {
                    if ( $zdname == 'SYS_ShouJi' ) { //当为手机字段时
                        echo '<ul class="ullogin" ><a href="tel:' . $thisvale . '" class="boxshadow"><input name="Submit" type="submit" class="boxshadow" tabindex="5"  onmouseover="this.style.backgroundColor=\'#FFF\';this.style.color=\'#000\';" onmouseout="this.style.backgroundColor=\'#999\';" onclick="#" src="images/f_bg_h.gif"  value="拨打电话"/></a></ul>';
                    } else {
                        echo '<ul class="ullogin" ><input name="Submit" type="submit" class="boxshadow" tabindex="5"   onmouseover="this.style.backgroundColor=\'#FFF\';this.style.color=\'#000\';" onmouseout="this.style.backgroundColor=\'#999\';" onclick="javascript:history.go(-1)" src="images/f_bg_h.gif"  value="返回" alt="back"/></ul>';
                    }

                }
                ?>
            </div>
        </div>
    </div>
    <?php include_once( 'M_foot.php' );?>
    <?php include_once( 'M_bottom.php' );?>
</div>
</body>
</html>
<script type="text/javascript" src="../../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../../js/B_login_fnction.js"></script>