<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
$sql = "SELECT sys_yfzuid FROM msc_user_hy WHERE user_id = $user_id and state = 1";
$rs = mysqli_query( $Connadmin, $sql );
$record_count = mysqli_num_rows( $rs ); //统计总记录数
$logged=false;
if($record_count){
    $logged=true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>确认加入</title>
    <link href="theme/style.css" rel="stylesheet" type="text/css"/>
    <link href='../../style/menuimage.css' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="join_box">
        <div id="join">

            <div id="apply_top">
                <div id="join_top_title">邀请你加入</div>
                <a href="javascript:history.go(-1)" class="comeBack"></a>
            </div>

            <div class="join_card_box">
                <div class="join_card">
                    <div class="join_card_top">阳光制造有限公司</div>
                    <div class="join_card_top_vice">已加入阳光制造，开启快捷工作沟通协作</div>
                    <div class='Wire'></div>
                    <div class="join_input_box">
                        <div class="join_card_name">真实姓名</div>
                        <input id="input_name" type="text" placeholder="请输入真实姓名" value="<?php echo $SYS_UserName ?>">
                    </div>
                    <div class="join_input_box">
                        <div class="join_card_reason">申请理由（选填）</div>
                        <input id="input_reason"  type="text" placeholder="请输入申请理由">
                    </div>
                    <div class="apply_button">提交申请</div>
                </div>
            </div>

        </div>
    </div>
</body>
<script type="text/javascript" src="../../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../../js/jq.host_mobile.js"></script>
<script>
    $(document).ready(function(){
        $('.apply_button').on('click',function(){
            if($('#input_name').val()){
                let name = $('#input_name').val()
                // console.log(name)
                let reason = $('#input_reason').val()
                $.post('join_confirmation_add.php',{
                    name,
                    reason,
                    id:<?php echo $id ?>
                },function(data){
                    <?php if(!$logged){ ?>
                    switch(data){
                        case '404':
                            if(confirm('未知错误，请尝试重新登录！')){
                                window.location.href = '/index.php'
                            }
                            break
                        case '201':
                            alert("您已加入公司，请重新登录")
                            window.location.href = '/index.php'
                            break
                        case '200':
                            alert("申请成功，待公司管理员批准后即可进入系统！")
                            window.location.href = '/index.php'
                            break
                        case '165':
                            alert("申请已提交，待公司管理员批准后即可进入系统！")
                            window.location.href = '/index.php'
                            break
                        case '125':
                            alert('姓名不能为空！')
                            break
                        case '116':
                            alert("您已离职！")
                            window.location.href = '/index.php'
                            break
                        case '88':
                            alert('您已被该公司删除')
                            window.location.href = '/index.php'
                            break
                        default:
                            alert(data)
                    }
                    <?php }else{ ?>
                    switch(data){
                    case '404':
                        alert("未知错误!")
                        history.go(-1)
                        break
                    case '201':
                        alert("您已加入公司，请重新登录")
                        history.go(-1)
                        break
                    case '200':
                        alert("申请成功，待公司管理员批准后即可进入系统！")
                        history.go(-1)
                        break
                    case '165':
                        alert("申请已提交，待公司管理员批准后即可进入系统！")
                        history.go(-1)
                        break
                    case '125':
                        alert('姓名不能为空！')
                        break
                    case '116':
                        alert("您已离职！")
                        history.go(-1)
                        break
                    case '88':
                        alert('您已被该公司删除')
                        history.go(-1)
                        break
                    default:
                        alert(data)
                    }
                    <?php } ?>
                })
            }else{
                alert('请输入姓名')
            }
        })
    })
</script>
</html>