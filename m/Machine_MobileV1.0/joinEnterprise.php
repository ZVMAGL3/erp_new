<?php
include_once( '../../session.php' ); //接收session信息
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>加入企业</title>
    <link href="theme/style.css" rel="stylesheet" type="text/css"/>
    <link href='../../style/menuimage.css' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="join_box">
        <div id="join">

            <div id="join_top"> 

                <div id="join_label">
                    <div id="home_box">
                        <a href="javascript:history.go(-1)" id="home"></a>
                    </div>
                    <div id="join_title">加入公司</div>
                    <div id="placeholder1"></div>
                </div>

                <div id="join_search">
                    <div id="placeholder3"></div>
                    <input id="keyword" placeholder="请输入公司名称(至少三个字)" type="text">
                    <div class="join_button">搜索</div>
                </div>
                <div id="placeholder2"></div>

            </div>

            <div id="catalog">
                    <div class="hint">加入公司 高效工作</div>
                    <ul></ul>
            </div>

        </div>
    </div>
</body>
<script type="text/javascript" src="../../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../../js/jq.host_mobile.js"></script>
<script>

    $(document).ready(function(){
        //过度动画
        $('#keyword').on('focus',function(){
            $(this).css({
                'min-width':'calc(100% - 70px)'
            })
        })
        // $('#keyword').on('blur',function(){
        //     if(!$('#keyword').val()){
        //         $(this).css({
        //             'min-width':'calc(100% - 20px)'
        //         })
        //     }
        // })
        //搜索点击事件
        $('#join_search .join_button').on('click',function(){
            let text = $('#keyword').val()
            SearchGet('list3','0','M_Org',<?php echo $user_id ?>)
            $('.hint').remove()
        })

    })
    
    function join_company(id,name){
        window.location.href = `join_confirmation.php?id=${id}&name=${name}`
    }

</script>
</html>