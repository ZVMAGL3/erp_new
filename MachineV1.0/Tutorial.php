<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='../style/style.css' rel='stylesheet' type='text/css' />
    <title>教程</title>
</head>
<style>
    .shell_x{
        width: 100vw;
        height: 100vh;
        background-color:#eee ;
        display: flex;
        flex-direction: column;
    }
    .middle_box{
        flex:1;
        display: flex;
    }
    .text_box{
        width: 90%;
        background-color: #fff;
    }
    .img_box{
        width: 10%;
        background-color: #fff;
    }
    .img_box>img{
        width: 100px;
        padding: 5px;
        margin-top: 5px;
        background-color: #22E;
    }
    .bottom_box{
        flex:0;
        display: flex;
        justify-content: space-between;
        background-color: #22E;
        color: #fff;
        padding: 0px 100px;
        height: 40px;
        font-size: 16px;
        line-height: 40px;
    }
</style>
<body>
    <div class='shell_x'>
        <div class="middle_box">
            <div class="text_box">

            </div>
            <div class="img_box">
                <img src="../images/Sp-cert-bacc.png" alt="">
            </div>
        </div>
        <div class="bottom_box">
            <span>
                SQP-源引力检测认证有限公司
            </span>
            <span>
                [让优秀的企业更优秀 * 让世界贸易成为享受]
            </span>
        </div>
    </div>
</body>
</html>