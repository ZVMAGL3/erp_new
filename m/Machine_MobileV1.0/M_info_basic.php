<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息

//------------------------------------------------------------------以下为查询到相关信息
$sql = $rs = $row = '';
$sql = "select * From `msc_user_reg` where id='$const_id_login' "; //用户登录表
//echo '<br><br><br><br><br>'.$sql;
$rs = mysqli_query( $Connadmin, $sql );
$row = mysqli_fetch_array( $rs );
//$countrows = mysqli_num_rows( $rs ); //得到数量
//离职时执行
//$web_shenpi = $row[ "sys_web_shenpi" ];                         //云端访问权限 0 为禁止 1为允许访问
//$nowzzzt = intval( $row[ 'sys_zzzt' ] );                        //在职状态0为在职，1为离职
//$userjib = $row[ 'jib' ];                                       //级别工种
$SYS_UserName = $row[ 'SYS_UserName' ]; //姓名
//$nowreg_num=$row[ "reg_num" ];                                  //公司注册号
//$const_id_fz = intval( $row[ 'sys_id_fz' ] );                   //分支

//if ( '1' . $const_id_fz == '1' ){$const_id_fz = 0;};
//$SYS_QuanXian = $row[ 'SYS_QuanXian' ];                         //权限         
//$const_id_bumen = $row[ 'sys_id_bumen' ];                       //部门
$SYS_photo = $row[ 'SYS_photo' ]; //头像
$SYS_XingBie = $row[ 'SYS_XingBie' ]; //性别
$DiZhi = $row[ 'SYS_DiZhi' ]; //地址
$SYS_ShouJi = $row[ 'SYS_ShouJi' ]; //手机
$SYS_Email = $row[ 'SYS_Email' ]; //邮件
$SYS_qianmin = $row[ 'SYS_qianmin' ]; //签名
$touxiang = file_exists("../../images/user_touxiang/".$user_id.".png")?1:0 ;

//$mor_qh = $row[ 'mor_qh' ];                                 //区号
//echo $const_id_bumen;
//exit();
//echo "const_id_login:$const_id_login";//这里测试
mysqli_free_result( $rs ); //释放内存

mysqli_close( $Connadmin ); //关闭数据库
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
    <!--
		<div  id="header" class="footermenu" style="height: 55px;line-height: 55px;">
       		<div class='widd'><a href="M_desk.php" class="menu site1">桌 面</a></div>
			<div class='widd'><a href="M_work.php" class="menu site2">工 作</a></div>
			<div class='widd'><a href="M_find.php" class="menu site3">发 现</a></div>
			<div class='widd'><a href="M_set.php" class="menu site4">我</a></div>
		</div>
        !-->
    <div id="header"> <a href="M_info.php" class="home"></a> <em class="eleft">基本资料</em> <a href="M_right_menu.php" class="siteMap"></a> </div>
    <div class="headpadd"></div>
    <div id="index">
        <div id="catalog">
            <ul>
                <li class="touxiang">
                    <a style="display:flex" href="">头像<font color="#CCC"> . My img</font></a>
                    <div id="uploadDiv" class='overlay'></div>
                    <input id="fileInput" type='file' multiple="false" accept=".png, .jpg" style="display: none"/>
                    <div class='touxiang_img'>
                        <img id='previewImage' src="" alt="">                                              
                    </div>
                </li>
                <li><a href="M_edit.php?Tablename=msc_user_reg&zdname=SYS_UserName&TitleName=名字&InputType=input&thisvale=<?php echo $SYS_UserName  ?>">名字<font color="#CCC"> . my name</font><em class="hui"><?php echo $SYS_UserName  ?></em></a></li>
                <li><a href="#">注册号<font color="#CCC"> . Org</font><em><?php echo $user_id  ?></em></a></li>
                <li class="sex" >
                    <a href="" style="pointer-events:none">性别<font color="#CCC"> . Gender</font><em id='sex_text'><?php echo $SYS_XingBie  ?></em></a>
                </li>
                <li><a href="M_edit.php?id=<?php echo $const_id_login ?>&Tablename=msc_user_reg&zdname=SYS_DiZhi&TitleName=联络地址&InputType=input&thisvale=<?php echo $DiZhi ?>">联络地址<font color="#CCC"> . C.add </font><em><?php echo $DiZhi  ?></em></a></li>
                <li><a href="M_edit.php?id=<?php echo $const_id_login ?>&Tablename=msc_user_reg&zdname=SYS_ShouJi&TitleName=手机&InputType=input&thisvale=<?php echo $SYS_ShouJi ?>">手机<font color="#CCC"> . Mob</font><em><?php echo $SYS_ShouJi  ?></em></a></li>
                <li><a href="M_edit.php?id=<?php echo $const_id_login ?>&Tablename=msc_user_reg&zdname=SYS_Email&TitleName=邮箱&InputType=input&thisvale=<?php echo $SYS_Email ?>">邮箱<font color="#CCC"> . E_mail</font><em><?php echo $SYS_Email  ?></em></a></li>
                <li><a href="M_edit.php?id=<?php echo $const_id_login ?>&Tablename=msc_user_reg&zdname=SYS_qianmin&TitleName=个性签名&InputType=input&thisvale=<?php echo $SYS_qianmin ?>">工作格言<font color="#CCC"> . Wrok Motto</font><em><?php echo $SYS_qianmin  ?></em></a></li>
            </ul>
        </div>
    </div>
    <?php include_once( 'M_foot.php' );?>
    <?php include_once( 'M_bottom.php' );?>
</div>
<div id='imageContainer_mask' style="display:none;">
    <img id='imageContainer' src="" alt="">
</div>
<div class='XingBie_mask' id='XingBie_mask'>
</div>
<div class='XingBie'>
    <div class='XingBie_bac'>
        <div class='XingBie_box'>
            <div class='XingBie_label'><span>保密</span></div>
            <div class='XingBie_label XingBie_label_center'><span>男</span></div>
            <div class='XingBie_label'><span>女</span></div>
        </div>
    </div>
</div>

</body>
</html>
<script type="text/javascript" src="../../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../../js/B_login_fnction.js"></script>
<script>
    // 获取需要操作的元素
    var uploadDiv = document.getElementById("uploadDiv");
    var fileInput = document.getElementById("fileInput");
    var previewImage = document.getElementById("previewImage");
    var imageContainer = document.getElementById("imageContainer_mask");
    // 当点击div时，触发文件输入框的点击事件
    uploadDiv.addEventListener("click", function() {
        fileInput.click();
    });

    previewImage.addEventListener("click", function() {
        imageContainer.style.display = "block";
    });

    imageContainer.addEventListener("click", function() {
        imageContainer.style.display = "none";
    });

    // 当文件输入框内容改变时，执行相应操作（例如上传文件）
    fileInput.addEventListener("change", function() {
        var selectedFile = fileInput.files[0];
  
        if (selectedFile) {
            previewImage.src = URL.createObjectURL(selectedFile);
            imageContainer.src = URL.createObjectURL(selectedFile);
            console.log("选择了文件:", selectedFile.name); 

            var formData = new FormData();
            formData.append("avatar", selectedFile);
            formData.append("name", <?php echo $user_id ?>); // 替换为你想传递的名字

            var xhr = new XMLHttpRequest();
            xhr.open("POST",'M_Upload.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText); // 输出来自服务器的响应
                    } else {
                        console.error("文件上传失败！");
                    }
                }
            };
            xhr.send(formData);
        } else {
            console.log("取消选择文件");
        }
    });
</script>

<script>
    $('.sex').on('click', function(event) {
            $('.XingBie_mask').css('display','block');
            $('.XingBie').css('display','block')
            setTimeout(function(){
                $('.XingBie_bac').css({
                    'top': '0%',
                    'transition':'top 0.5s'
                })
            },10)
    });
    $('.XingBie_mask,.XingBie_label').on('click', function(event) {
        $('.XingBie_mask').css('display','none');
        $('.XingBie_bac').css({
            'top': '100%',
            'transition':'top 0.2s'
        })
        setTimeout(function(){
            $('.XingBie').css('display','none')
        },200)
    });
    $('.XingBie_label').on('click', function(event) {
        // event.stopPropagation(); // 阻止事件冒泡
        var labelText = $(this).find('span').text();
        $('#sex_text').text(labelText)
        $.post('M_edit_data.php',{
            act:'edit_Connadmin',
            id:<?php echo $user_id ?>,
            Tablename:'msc_user_reg',
            zdname:'SYS_XingBie',
            TitleName:'性别',InputType:'input',thisvale:labelText
        },function(data){
            console.log(data)
        });
    });
</script>

<script>
    if(<?php echo $touxiang ?>){
        $('#previewImage,#imageContainer').attr('src',"../../images/user_touxiang/<?php echo $user_id ?>.png")
    }else{
        $('#previewImage,#imageContainer').attr('src','../../images/user_touxiang/moren.png')
    }
</script>
