<?php
 include_once( '../../session.php' );                   //接收session信息
 include_once( 'M_quanxian.php' );                      //接收职位权限信息
//$sys_id="";
//$nrr='2';
//$sys_id .= '_'.$nrr;
//$str = 'hello_world_hello_world';
//$replace = ',';
//$search = '_';
//echo "<br><br><br><br>". str_ireplace($search, $replace, $str);
//echo "<br><br><br><br>".$sys_id;
?>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width,user-scalable=0,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
	<meta name="format-detection" content="telephone=no"/>
	<title>SQP Certificate Mobile</title>
	<link href="theme/style.css" rel="stylesheet" type="text/css"/>
    <link href='../../style/menuimage.css' rel='stylesheet' type='text/css' />
	<script type="text/javascript" src="../../js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="../../js/jq-top.js"></script>
</head>

<body>
	<div id="wrapper">
		<!--
		<div  id="header" class="footermenu" style="height: 55px;line-height: 55px;">
       	
			<div class='widd'><a href="M_find.php" class="menu site3">发 现</a></div>
			
		</div>
		!-->
		<div id="header">
            <!--
			<em class="logo"><img src="../../images/logo-sqp.png"></em>
            !-->
			<em class="eleft">&nbsp;&nbsp;♛ 桌面</em>
			<a href="M_right_menu.php" class="siteMap"></a>
		</div>
		<div class="headpadd"></div>
		<div id="index">
			
<!--
			<div id="mainNav" class="top_bottom_line">
				<ul>
            		<li><a href="product.php">我们的服务</a></li>
		

                 <li><a href='#'>000</a></li>
				</ul>
			</div>
       
  
      !-->   
            
			<div class="DeskBox">
				<!--
				<a href="M_work.php"><ul><h1><img src="theme/default/images/gongzhuo.png" class="logo"></h1><h2>*工作</h2></ul></a>
				<a href="#"><ul><h1><img src="theme/default/images/note.png" class="logo"></h1><h2>*记事本</h2></ul></a>
				<a href="M_info.php"><ul><h1><img src="theme/default/images/info.png" class="logo"></h1><h2>个人资料</h2></ul></a>
				<a href="M_Standard.php"><ul><h1><img src="theme/default/images/Rose_cube_icon.png" class="logo"></h1><h2>标准</h2></ul></a>
				<a href="M_Company.php"><ul><h1><img src="theme/default/images/Company.png" class="logo"></h1><h2>公司</h2></ul></a>
				<a href="M_work.php"><ul><h1><img src="theme/default/images/chat.png" class="logo"></h1><h2>*消息</h2></ul></a>
				<a href="M_work.php"><ul><h1><img src="theme/default/images/zhenshu.png" class="logo"></h1><h2>*证书</h2></ul></a>
				<a href="M_work.php"><ul><h1><img src="theme/default/images/buyuser.png" class="logo"></h1><h2>*买家</h2></ul></a>
				<a href="M_work.php"><ul><h1><img src="theme/default/images/saleuser.png" class="logo"></h1><h2>*卖家</h2></ul></a>
				<a href="M_work.php"><ul><h1><img src="theme/default/images/pingtai.png" class="logo"></h1><h2>*平台</h2></ul></a>
				<a href="M_work.php"><ul><h1><img src="theme/default/images/sqpems.png" class="logo"></h1><h2>*阳光质造</h2></ul></a>
				<a href="M_moban.php?re_id=321"><ul><h1><img src="theme/default/images/guke.png" class="logo"></h1><h2>客户</h2></ul></a>
				<a href="M_Personnel_list.php"><ul><h1><img src="theme/default/images/tongxunlu.png" class="logo"></h1><h2>通讯录</h2></ul></a>
				<a href="M_work.php"><ul><h1><img src="theme/default/images/wendang.png" class="logo"></h1><h2>*文档</h2></ul></a>
				<a href="M_set.php"><ul><h1><img src="theme/default/images/setting.png" class="logo"></h1><h2>我的</h2></ul></a>
                !-->
			
				<?php include_once( 'M_menu_desk.php' );?>
			</div>

			

			
		</div>
		
		<?php include_once( 'M_foot.php' );?>
		<?php include_once( 'M_bottom.php' );?>
	</div>
	
	
</body>

</html>


<script type="text/javascript">
	//$.get('M_menu_desk.php', {act:"menuA"}, function (data) {
		//alert(data);
	   // $('div.DeskBox').append(data);
		
		//edit_data_get(id, ToHtmlID,hy);//加载数据
	//});//这里打开模版

</script>


