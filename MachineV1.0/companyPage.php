<?php
	include_once '../session.php';
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--     
        <link href='style/moban_top.css' rel='stylesheet' type='text/css'/>
        <link href='../style/menuimage.css' rel='stylesheet' type='text/css' />
        <link href='../style/style.css' rel='stylesheet' type='text/css' />
     -->
    <title>创建/加入 公司</title>
</head>
<body>
    <div class="company_shell">
        <div class="companyPage_box">
            <div class="stuff-top"></div>
            <div class="companyPage_box_title">找不到你的企业，可以选择以下方式使用</div>
            <div class="bootArea">
                <div class="button_box">
                    <div class="ico" id="create_ico">
                        <img src="../images/house.png" alt="">
                    </div>
                    <div class="bootArea_title">创建企业</div>
                    <div class="bootArea_span"><span>与同事一起使用，高效沟通、连接微信，丰富的办公OA应用，助力企业提升办公效率与管理</span></div>
                </div>
                <div class="button_box">
                    <div class="ico" id="join_ico">
                        <img src="../images/jing.png" alt="">
                    </div>
                    <div class="bootArea_title">加入企业</div>
                    <div class="bootArea_span"><span>与同事一起使用，高效沟通、连接微信，丰富的办公OA应用，助力企业提升办公效率与管理</span></div>
                </div>
            </div>
            <div class="stuff-bottom"></div>
        </div>
    </div>
</body>
<style>

    body{
        margin:0;
        cursor:default; /* 鼠标样式默认不变 */
        user-select: none; /* 文字不可选中 */
    }

    .company_shell{
        width: 100vw;
        height: 100vh;
        background-color: #fff;
        display: flex;
        align-items:center;
        justify-content: center;
    }

    .companyPage_box{
        width: calc(20vw + 240px);
        min-width: calc(300px - 4vw);
        height: calc(500px - 4vw);
        padding: 2vw;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items:center;
        background-color: #fafafa;
        border:1px solid #ccc;
    }

    .companyPage_box_title{
        height: 100px;
        line-height: 16px;
        font-size: 16px;
        display: flex;
        justify-items: center;
        align-items:center;
    }

    .bootArea{
        height: 300px;
        display: flex;
        justify-content:space-evenly;
        
        align-items:center;
    }

    .button_box{
        width: calc(45% - 40px);
        height: 300px;
        display: flex;
        flex-direction: column;
        align-items:center;
        text-align: center;
        background-color: #fff;
        padding: 0 20px;
        border: 1px solid #eee;
    }

    .button_box:hover{
        box-shadow: 1px 2px 5px 0px rgba(0, 0, 0, 0.5);
    }

    .ico{
        margin-top:60px;
        height: 40px;
        width: 40px;
        border-radius: 20px;
        background-color: #0082ef ;
        display: flex;
        justify-content: center;
        align-items:center;
    }
    
    #create_ico{
        background-color: #0082ef ;
    }

    #join_ico{
        background-color: #e2b879 ;
    }

    .ico>img{
        height: 20px;
        width:20px;
    }

    .bootArea_title{
        margin-top: 20px;
        font-size: 14px;
        
    }

    .bootArea_span{
        margin-top: 20px;
        font-size: 12px;
        color: #888;
        padding: 0 2vw;
    }

    .stuff-top{
        flex:0.5;
    }

    .stuff-bottom{
        flex:1;
    }

</style>
<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('.button_box').eq(0).on("click",() => {
            window.location.href = '../m/Machine_MobileV1.0/M_Org_add.php?act=add_mobile_new'
        })
        $('.button_box').eq(1).on("click",() => {
            window.location.href = '../m/Machine_MobileV1.0/joinEnterprise.php'
        })
    })
</script>
</html>