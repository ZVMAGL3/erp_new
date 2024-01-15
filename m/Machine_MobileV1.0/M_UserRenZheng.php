<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息

//------------------------------------------------------------------以下为查询到相关信息
$sql = $rs = $row = '';
$sql = "select * From `msc_user_reg` where id='$sys_id_login' "; //用户登录表
// echo $sql;
$rs = mysqli_query( $Connadmin, $sql );
$row = mysqli_fetch_array( $rs );
//$countrows = mysqli_num_rows( $rs ); //得到数量
$SYS_UserName = $row[ 'SYS_UserName' ]; //姓名
$SYS_ShenFenZheng = $row[ 'SYS_ShenFenZheng' ];         //身份证

$isVerified = $row[ 'sys_isVerified' ]; //是否认证
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
    <div id="header"> <a href="M_info.php" class="home"></a> <em class="eleft">实名认证</em> <a href="M_right_menu.php" class="siteMap"></a> </div>
    <div class='smrz_baccmark'>
        <div class="smrz_title">实名认证</div>
        <div class='smrz_inputBigBox'>
            <div class="smrz_inputBox">
                <div class="smrz_text">姓名</div>
                <input id='sfrz_input_xingming' class="smrz_input" style="user-select: none" type="text" value='<?php echo $SYS_UserName ?>' />
            </div>
            <div class="smrz_inputBox">
                <div class="smrz_text">身份证号</div>
                <input id='sfrz_input_sfz' class="smrz_input" type="text">
            </div>
            <div class="smrz_inputBox" id="button_box">
                <button id="quxiao">取消</button>
                <button id="queding">确定</button>
            </div>
        </div>
        <div id="bommon_mark" style="display: none;"></div>
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="../../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../../js/B_login_fnction.js"></script>
<script>
    
    function validateIDCard(idCard) {
        // 身份证号正则表达式
        var idCardPattern = /^[1-9]\d{5}(18|19|20)\d{2}(0[1-9]|1[0-2])(0[1-9]|[12]\d|3[01])\d{3}([0-9Xx])$/;

        // 验证身份证号码格式
        if (idCardPattern.test(idCard)) {
            // 检查最后一位校验码是否正确
            var weights = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
            var checkCodes = "10X98765432";
            var sum = 0;

            for (var i = 0; i < 17; i++) {
                sum += parseInt(idCard.charAt(i)) * weights[i];
            }

            var checkCodeIndex = sum % 11;
            var calculatedCheckCode = checkCodes.charAt(checkCodeIndex);

            var lastChar = idCard.charAt(17);
            if (lastChar === calculatedCheckCode) {
                return true; // 身份证号码合法
            } else {
                return false; // 校验码不匹配
            }
        } else {
            return false; // 身份证号码格式不合法
        }
    }

    $(document).ready(function() {
        $('#quxiao').on('click',function(){
            window.location.href=document.referrer;
        })
        $('#sfrz_input_sfz,#sfrz_input_xingming').on('input', function() {
            var sfzValue = $('#sfrz_input_sfz').val(); // 获取输入框的值
            var xingmingValue = $('#sfrz_input_xingming').val(); // 获取输入框的值
            if(validateIDCard(sfzValue) && !(xingmingValue === '')){
                $('#queding').on('click',function(event){

                    var userName = '<?php echo $SYS_UserName ?>';
                    var userSFZ = $('#sfrz_input_sfz').val()

                    $.post('M_IDVerification.php', {userName,userSFZ},function(data){
                        var responseObject = JSON.parse(data);
                        if(responseObject.isValidIDCard){
                            alert('认证成功！')
                            $.post('M_edit_data.php', {act:'edit_Connadmin',id:<?php echo $user_id ?>,Tablename:'msc_user_reg',zdname:'sys_isVerified',thisvale:1});
                            $.post('M_edit_data.php', {act:'edit_Connadmin',id:<?php echo $user_id ?>,Tablename:'msc_user_reg',zdname:'SYS_ShenFenZheng',thisvale:userSFZ});
                            window.location.href=document.referrer;
                        }else{
                            alert(responseObject.error)
                        }
                    });
                }).css({
                    'background-color':'#19B4EA',
                    'color':'#000'
                })
            }else{
                $('#queding').off('click').css({
                    'background-color':'#eee',
                    'color':'#ccc'
                })
            }
        });
    });
    if(<?php echo $isVerified ?>){
        $('#button_box').remove();
        $('#sfrz_input_sfz').val('<?php echo $SYS_ShenFenZheng ?>');
        $('.smrz_title').text("已认证");
        $('#bommon_mark').css({
            'display':"block",
            'height':'200px'
        });
        $('.smrz_baccmark').css({
            'user-select':'none', /* 防止文本选中 */
            'pointer-events':'none', /* 禁用鼠标事件 */
        })
    }
</script>