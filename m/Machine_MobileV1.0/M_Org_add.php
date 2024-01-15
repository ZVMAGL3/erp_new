<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once 'M_Org_Set.php'; //连上参数设定
$previewImage = '../../images/user-gongsizhizhao/fileSelect.png';
echo "<script> let parent = '0' </script>";
// echo "<script>console.log(". $hy .")</script>";'
if ($act == 'subsidiaries') {
    echo "<script> parent = '$hy' </script>";
    $textsname = '分支';
}
$name = $yyzzhao = $faren = $address = $tel = $webhttp = $email = '';
if ($act == 'check_mobile' ) { //当接收到处理指令时
    $sql = "select * From `$tablename` where id='$user_id'";
    $rs = mysqli_query( $Connadmin, $sql );
    $row = mysqli_fetch_array( $rs );
    $name = $row[ $colsname ]; //公司名称
    $yyzzhao = $row[ 'yyzzhao' ]; //统一信用代码
    $faren = $row[ 'faren' ]; //法人
    $address = $row[ 'address' ]; //注册地址
    $tel = $row[ 'tel' ]; //电话
    $webhttp = $row[ 'webhttp' ]; //网址
    $email = $row[ 'email' ]; //邮件
    $sys_adddate = $row[ 'sys_adddate' ]; //添加时间
    $sys_adddate_g = $row[ 'sys_adddate_g' ]; //更新时间
    // echo "<script> parent =". $row[ 'parent' ] ."</script>";
    mysqli_free_result( $rs ); //释放内存
}

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
<link href='../../style/menuimage.css' rel='stylesheet' type='text/css' />
</head>

<style>

    #mobanaddbox{
        max-height: calc(100vh - 120px);
        margin-top: 120px;
        line-height: 40px;
    }

    #mobanaddbox>ul{
        height: 40px;
        margin-bottom: 10px;
        display: flex;
    }

    #mobanaddbox>ul>.cols01{
        min-width: 100px;
        flex:0.4;
        text-align: right;
    }

    #mobanaddbox>ul>.cols02{
        flex:1;
        height: 40px;
    }

    .inputfocus{
        height: 35px;
        width: 200px;
        padding-left: 10px;
        margin-left: 10px;

        background-color:rgb(0,0,0,0);
        border:rgb(0,0,0,0);
        box-shadow:0px 0px 0px rgba(0, 0, 0, 0);
        user-select:none; /* 防止文本选中 */
        pointer-events:none; /* 禁用鼠标事件 */
    }

    .inputfocus_click{
        background-color: rgb(255,255,255,1); /* 将背景色重置为透明 */
        border: 1px solid rgb(196,196,196,1); /* 将边框重置为默认值 */
        box-shadow: 0px 2px 3px 1px rgba(0, 0, 0, 0.1); /* 将阴影重置为默认值 */
        user-select: auto; /* 恢复文本选中 */
        pointer-events: auto; /* 恢复鼠标事件 */
    }
    

    #previewImage{
        width: 50px;
        height: 50px;
        margin-left: 20px;
        border: 1px dashed;
    }

    .input_time{
        margin-left: 20px;
        background-color: rgb(0, 0, 0, 0);
        border: 0px solid rgb(0, 0, 0, 0);
        user-select:none; /* 防止文本选中 */
        pointer-events:none; /* 禁用鼠标事件 */
    }

    #previewImage:hover{
        background-color: #fff;
    }

    #previewImage:active {
        background-color: #888;
    }

    #SYS_lianxuBox{
        width: 72px;
        display: flex;
        align-items: center;
    }

    #SYS_lianxuBox>input{
        cursor: pointer;
        margin-left: 10px;
        margin-right: 2px;
        width: 12px;
        height: 12px;
    }
    
    #SYS_submit{
        width:100px;
        height: 80%;
        margin-left: 15px;
        background-color: #000;
        color:#fff;
    }

    #SYS_submit:hover{
        background-color: #444;
    }

    #SYS_submit:active{
        background-color: #888;
    }    

    #reset_add{
        height: 80%;
        width: 50px;
        margin-left: 10px;
        background-color: #888;
    }

    #reset_add:hover{
        background-color: #aaa;  
    }

    #reset_add:active{
        background-color: #ccc;  
    }

    #yyzzMask{
        display: none;
        width: 100%;
        height: calc(100% - 44px);
        position: absolute;
        top: 44px;
        left: 0;
        background-color: rgb(32, 32, 32,0.1);
    }

    #yyzzImage{
        width: 500px;
        height: 500px;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-50%);
        background-color: rgb(32, 32, 32,0.2);
    }

</style> 

<body>
<div id="wrapper">
    <div id="header"> <a href="javascript:history.go(-1)" class="home"></a> <em class="eleft"><?php echo $textsname ?> 添加</em> <a href="#" class="siteMap"></a> </div>
    <div id='mobanaddbox' class='NowULTable nocopytext'>
        <ul>
            <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font><?php echo $textsname ?>名称:</li>
            <li class='cols02'>
                <input type='text' id='name' class='addboxinput inputfocus'  value='<?php echo $name ?>'/>
            </li>
        </ul>
        <ul>
            <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font>工商注册号:</li>
            <li class='cols02'>
                <input type='text' id='yyzzhao' placeholder="统一社会信用代码" class='addboxinput inputfocus'  value='<?php echo $yyzzhao ?>'/>
            </li>
        </ul>
        <ul>
            <li class='cols01'><font color='red' class='s_bt'>*</font>法人:</li>
            <li class='cols02'>
                <input type='text' id='faren' class='addboxinput inputfocus'  value='<?php echo $faren ?>'/>
            </li>
        </ul>
        <ul>
            <li class='cols01'><font color='red' class='s_bt'>*</font>注册地址:</li>
            <li class='cols02'>
                <input type='text' id='address' class='addboxinput inputfocus'  value='<?php echo $address ?>'/>
            </li>
        </ul>
        <ul>
            <li class='cols01'><font color='red' class='s_bt'>*</font>电话/手机:</li>
            <li class='cols02'>
                <input type='text' id='tel' class='addboxinput inputfocus' value='<?php echo $tel ?>'/>
            </li>
        </ul>
        <ul>
            <li class='cols01'><font color='red' class='s_bt'>*</font>网址:</li>
            <li class='cols02'>
                <input type='text' id='webhttp' class='addboxinput inputfocus' value='<?php echo $webhttp ?>'/>
            </li>
        </ul>
        <ul>
            <li class='cols01'><font color='red' class='s_bt'>*</font>邮件:</li>
            <li class='cols02'>
                <input type='text' id='email' class='addboxinput inputfocus' value='<?php echo $email ?>'/>

            </li>
        </ul>
        <ul style="height: 60px;line-height:50px;margin-top:10px">
            <li class='cols01'><font color='red' class='s_bt'>*</font>执照上传:</li>
            <li class='cols02' style="height: 50px;">
                <img id='previewImage' src="<?php echo $previewImage ?>" alt="">
                <input id="fileInput" type='file' multiple="false" accept="image/*" style="display: none;"/>
            </li>
        </ul>
        <ul class="input_timeBox"  style="display: none;">
            <li class='cols01'>添加时间:</li>
            <li class='cols02'>
                <div class='addboxinput input_time'><?php echo $sys_adddate ?></div>
            </li>
        </ul>
        <ul class="input_timeBox" style="display: none;">
            <li class='cols01'>更新时间:</li>
            <li class='cols02'>
                <div class='addboxinput input_time'><?php echo $sys_adddate_g ?></div>
            </li>
        </ul>
        <ul id='add_submitBox' >
            <li class='cols01'> &nbsp;</li>
            <li class='cols02' style="display: flex;align-items: center;">
                <input id='SYS_submit' value='' type='button'/>
                <input style="display: none;" id='reset_add' type='reset' value='' >
                <label style="display: none;" id='SYS_lianxuBox'><input id='SYS_lianxu' type='checkbox'/><span>连续添加</span></label>
            </li>
        </ul>

        <input type='hidden' name='act' id='act' value='add_mobile' />
    </div>
    <div id="yyzzMask">
        <img id="yyzzImage" src="" alt="">
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="../../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../../js/jq.host_mobile.js"></script>

<script>
    let selectedFile = ''
    let xiugai = false
    let act = '<?php echo $act ?>'
    $(document).ready(function() {
        $('#yyzzMask').on('click',function(){
            $(this).hide()
        })

        if(act == 'check_mobile'){
            $('.input_timeBox').show() //显示时间
            $('#previewImage').attr('src','../../images/user-gongsizhizhao/<?php echo $yyzzhao ?>.png'); //显示营业执照的凭证照片
            $('#yyzzImage').attr('src','../../images/user-gongsizhizhao/<?php echo $yyzzhao ?>.png'); //显示营业执照的凭证照片
            xiugai = true;
            $('#previewImage').on("click", function() {
                $('#yyzzMask').show()
            });
            offAlter()
        }else{
            $('.input_timeBox').remove() //不显示时间

            $('.inputfocus').toggleClass('inputfocus_click')

            //上传图片
            $('#previewImage').on("click", function() {
                $('#fileInput').click();
            });

            //重写
            $('#reset_add').val('重写').show().on('click',function(){
                $('.inputfocus').val('');
                selectedFile = ''
                $('#fileInput').val('')
                $('#previewImage').attr('src','../../images/user-gongsizhizhao/fileSelect.png'); 
            })
            $('#SYS_submit').val('提交').on('click',upload)
            $('#SYS_lianxuBox').show();
        }
        let editing_area = $('#wrapper').html()

        $('#fileInput').on("change", function() {
            if (this.files[0]) {
                selectedFile = this.files[0]; // 获取用户选择的文件
                $('#previewImage').attr('src', URL.createObjectURL(selectedFile));
            } else {
                console.log("取消选择文件");
            }
        });

        function onAlter(){
            $(this).val('确认修改').on('click',upload)
            $('.inputfocus').toggleClass('inputfocus_click')
            $('.s_bt').show()
            $('#reset_add').show()
            $('#previewImage').off('click').on("click", function() {
                $('#fileInput').click();
            });
        }

        function offAlter(){
            $('#SYS_submit').val('修改').off('click').one('click',onAlter)
            $('.s_bt').hide()
            $('#previewImage').off('click').on("click", function() {
                $('#yyzzMask').show()
            });
            $('#reset_add').val('取消').on('click',function(){
                $('#wrapper').html(editing_area)
                $('#yyzzMask').on('click',function(){
                    $(this).hide()
                })
                offAlter()
            })
        }

        function upload(){
            var formData = new FormData();
            formData.append("act", act == "check_mobile"?'check_mobile':'add_mobile');
            formData.append("avatar", selectedFile);
            formData.append('user_hy','<?php echo $user_id ?>');
            formData.append('xiugai', xiugai);
            formData.append('parent', parent);
            // 遍历所有具有 inputfocus 类的输入框
            $('.inputfocus').each(function(index, element) {
                formData.append($(element).attr('id'), $(element).val());
            });
            var xhr = new XMLHttpRequest();
            xhr.open("POST",'M_Org_new.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // console.log(xhr.responseText)
                        if(xhr.responseText == 64){

                            if($('#SYS_lianxu').prop('checked')){
                                $('#reset_add').click()
                            }else{
                                if('<?php echo $act == "add_mobile_new" ?>'){
                                    alert('公司创建完毕')
                                    //选择标准，购买
                                    window.location.href =  "/MachineV1.0/purchasing.php" ; //这里打开后台界面
                                    if ( '<?php echo $P_M ?>' ) { //当为电脑端时
                                        window.location.href =  "/MachineV1.0/B_main.php" ; //这里打开后台界面
                                    }else{
                                        window.location.href = "/m/Machine_MobileV1.0/M_desk.php" ; //这里打开后台界面
                                    }
                                }else{
                                    history.go(-1)
                                }
                            }
                        }else{
                            if(xhr.responseText == 200){
                                alert('公司名称或公司工商注册号已被占用，如输入没有问题请联系客服处理。')
                            }else{
                                console.log(xhr.responseText)
                            }
                        }
                    }
                }
            };

            xhr.send(formData);
        };
    })
</script>