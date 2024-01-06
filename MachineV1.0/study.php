<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="study">
    <div id="JiaoCheng_box" class="navigationBar_box">
        <div class='SlideOutMenu'>
            <div class="item"></div>
            <div class="item"></div>
            <div class="item"></div>
        </div>

        <div class="middle_box">    
            
            <div class="mast"></div>
            <div class="leftNavigationBar"></div>
            <img class="imgBox" src="../../images/Sp-cert-bacc.png" alt="">
            <div class="control_box">
                <div class="control openEditing"></div>
                <div class="control openPrevious"></div>
                <div class="control openNext"></div>
            </div>
            <div class="study_title_box"><div class="study_title">SQP-源引力检测认证有限公司</div></div>
            <div class="text_box">
                <div class='text'>
                    <textarea class='standard_textarea'></textarea>
                </div>
            </div>
        </div>
        <div class="bottom_box">
            <span>
                SQP-源引力检测认证有限公司
            </span>
            <span style="font-size:14px">
                [让优秀的企业更优秀 * 让世界贸易成为享受]
            </span>
        </div>
    </div>
</div>
</body>

<script language='JavaScript' src='../js/jquery-1.8.3.min.js' type='text/javascript' charset='utf-8'></script> 
<script language='JavaScript' src='../js/jq-top.js' type='text/javascript' charset='utf-8'></script>
<script charset="utf-8" src="../js/kindeditor-master/kindeditor-all.js"></script>
<script charset="utf-8" src="../js/kindeditor-master/lang/zh-CN.js"></script>
<script>

var editor = null //编辑器容器
let index = 0 // 目录下标
let index_list = [] // 存储目录下标的容器
let text_list = [] // 存储标题的文本，下表和目录下标对应

// 编辑器初始化
KindEditor.ready(function(K) { //编辑器
    editor = K.create('.standard_textarea', {
        'width':'400px',
        'height' :'400px',
        uploadJson: 'path_to_upload_handler.php',
        'items': ['title', 'fontname', 'fontsize','|','textcolor', 'bgcolor', 'bold', 'italic', 'underline', 'strikethrough', 'removeformat', '|','justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript', 'superscript', '|', 'undo', 'redo', '|', 'preview','cut', 'copy', 'paste', 'plainpaste', '|', 'image', 'multiimage', 'table', 'hr', 'emoticons', 'pagebreak','source']
    });
    $('.openEditing').on('click',function(){
        $('.ke-toolbar').toggleClass('ke-toolbar-top')
    })

    // editor.edit.doc.onclick  = function(e) {
    //     if(text_click){
    //         e.preventDefault(); // 阻止默认右击菜单
    //        
    //         text_click = false
    //         clearTimeout(text_click_time);
    //     }else{
    //         text_click = true
    //         text_click_time = setTimeout(() => {
    //             text_click = false
    //         },500)
    //     }
    // };
});

// 初始化
$(document).ready(()=>{
    $('.navigationBar_box').hide()
    $('#JiaoCheng_box').show()
    $('.navigationBar_child').on('click',function(){
        $('.navigationBar_child').css({
            'background-color':'#888'
        })
        $(this).css({
            'background-color':'#000'
        })
        $('.navigationBar_box').hide()
        $(`#${$(this).attr('id')}_box`).show()
    })
    $('.SlideOutMenu').on('click',function(){
        $('.leftNavigationBar').css({
            'left':'0'
        })
        $('.leftNavigationBarSon').focus()
        $('.mast').show()
    })
    $('.mast').on('click',function(){
        mastHide()
    })
    $('.openPrevious').on('click',function(){
        if(index){
            index-=1
            retrieveData(index_list[index])   
        }
    })
    $('.openNext').on('click',function(){
        if(index_list[index+1]){
            index+=1
            retrieveData(index_list[index])
        }
    })
    $(document).on("keydown", function(event) {
        if (event.key === "ArrowUp" || event.key === "ArrowLeft") {
            if(index){
                index-=1
                retrieveData(index_list[index])   
            }
        } else if (event.key === "ArrowDown" || event.key === "ArrowRight") {
            if(index_list[index+1]){
                index+=1
                retrieveData(index_list[index])
            }
        }
    });
    $.post('../m/Machine_MobileV1.0/M_Standard_terms_ajax.php', { act: 'leftNavigationBar', id: '8' }, function(data) {
        data = JSON.parse(data)
        $('.leftNavigationBar').append(createNav(data,0).get(0))
    })

})

// 导航栏样式初始化
var background_color = ['#333','#3498db','#5dade2','#aed6f1']
var color = ['#fff','#fff','#fff','#666']
var height = ['30','40','40','40']

function createNav(data,idx) {
    // 创建一个容器 div 元素
    let container = $('<div>');
    // 创建一个用于显示名称的 div 元素
    let nameDiv = $('<div>');
    let text = `${' '.repeat((idx + 1)*2)}${data.number}、${data.name}`

    if(data.id){
        nameDiv.text(text);

        index_list.push(data.id)
        var index_current = index_list.length - 1
        text_list.push(text)

        if(data.id == index_list[index]){
            retrieveData(data.id)
        }
        nameDiv.on('click',function(){
            if(index != index_current){
                index = index_current
                retrieveData(data.id)
            }
        })
        nameDiv.addClass('NavigationBarSpan')
        nameDiv.attr('id',`NavigationBar_${ data.id }`)
    }else{
        nameDiv.addClass('topText')
        var toPage = $('<div>',{
            class: 'toPage',
            click: mastHide
        });
        var topText = $('<div>',{text})
        nameDiv.append(toPage);
        nameDiv.append(topText);
    }

    //不同级用不同的背景色
    var sameCss = {
        'background-color':background_color[idx],
        'color':color[idx],
        'height':`${height[idx]}px`,
        'line-height':`${height[idx]}px`,
    }
    var hoverCss = {
        "background-color":"#6bb9e0",
        "color":"#fff"
    }
    nameDiv.css(sameCss).hover(function() {
        $(this).css(hoverCss)
    }, function() {
        // 鼠标移出时恢复原始样式
        $(this).css(sameCss)
    });
    // if(idx == 1){
    //     nameDiv.addClass('SecondTitle')
    // }
    container.append(nameDiv);

    // 如果有子项目，递归创建子导航
    if (data.data) {
        let son = $('<div>');
        data.data.forEach((item) => {
            // 递归创建子导航并将其附加到容器中
            let subNav = createNav(item,idx+1);
            son.append(subNav);
        });
        son.attr('class','NavigationBarList')
        // if(idx == 1){
        //     son.css({
        //         'border-bottom':'1px solid rgb(0,0,0,0.2)',
        //         'margin-bottom':'5px'
        //     })
        // }
        if(idx == 0){
            console.log(123)
            son.addClass('leftNavigationBarSon')
        }
        container.append(son);
    }
    container.addClass('NavigationBarBox')

    return container;
}

// 关闭导航栏
function mastHide(){
    $('.mast').hide()
    $('.leftNavigationBar').css({
        'left':'-320px'
    })
}

// 打开目标页面
let retrieveData_time = null
function retrieveData(idx){
    $.post('./study_data.php',{id:idx},function(data){
        editor.html(data)
        $('.NavigationBarSpan').removeClass('currentTab')
        $(`#NavigationBar_${ idx }`).addClass('currentTab')

        $('.study_title').text(text_list[index]);

        clearTimeout(retrieveData_time);

        $('.text').css({
            'display':'none',
            'transition':'none',
            'margin-left':'500px',
            'height':'80%'
        })
        $(".text").css({
            'display':'block',
        })
        retrieveData_time = setTimeout(()=>{
            $('.text').css({
                'transition':'all 1s ease',
                'margin-left':'0px',
                'height':'calc(100% - 20px)'
            })
        },50)
        // console.log(data)
    })
}

</script>
<style>

    .study{
        height: 100vh;
        width: 100vw;
        background-color: #fff;

        position: absolute;
        left: 0;
        top: 0;
        z-index: 21;
    }

    #navigationBar{
        margin-top:44px;
        height: 50px;
        width: 400px;
        display: flex;
        justify-content: center;
    }
    #navigationBar>div{
        margin: 0 5px;
        height: 40px;
        line-height: 40px;
        padding:0 10px;
        color: #fff;
        background-color: #888;
        border-radius:0 0 10px 10px;
    }
    #mobanaddbox{
        margin:0;
    }
    #JiaoCheng_box{
        width: 100vw;
        height: 100vh;
        position: absolute;
        background-color:#eee ;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    .SlideOutMenu{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        position:absolute;
        top: 0px;
        left: 0px;
        width: 40px;
        height: 18px;
        padding: 6px 0px;
        z-index: 5;
        background-color: #666;
    }
    .SlideOutMenu:hover{
        background-color: #888;
    }
    .SlideOutMenu:active{
        background-color: #aaa;
    }
    .item{
        width: 80%;
        height: 20%;
        background-color: #ccc;
    }
    .middle_box{
        flex:1;
        position: relative;
        display: flex;
        flex-direction: column;
    }
    .leftNavigationBar{
        height: 100%;
        width: 280px;
        position: absolute;
        left: -320px;
        z-index: 6;
        background-color: #fff;
        overflow: hidden;
        transition: all 1s ease;
        font-size: 14px;
        color:rgb(0,0,0,0.65);
    }
    .leftNavigationBarSon{
        overflow: auto;
        height: calc(100% - 30px);
    }
    .mast{
        display: none;
        height: 100%;
        width: 100%;
        position: absolute; 
        z-index: 5;
        background-color: rgb(20,20,20,0.1);
    }
    .imgBox{
        position: absolute; 
        padding: 15px;
        width: 4vw;
        min-width: 50px;
        border-radius: 0px 0px 10px 10px;
        box-shadow: #333 0px 0px 10px 0px;
        top: 0vh;
        right: 3vw;
        z-index: 6;
        background-color: #22E;
    }
    .study_title_box{
        position: relative;

        width: 100%;
        height: 30px;
        display: flex;
        justify-content: center;
        box-shadow: 0px 5px 9px -4px #888888;
    }
    .study_title{
        width: calc(100% - 60px);
        height: 30px;
        line-height: 30px;
        padding-left: 60px;
        color:#fff;
        background-color: #333;
    }
    .text_box{
        flex:1;
        height: 100%;
        background-color: #fff;
        display: flex;
        justify-content: center;
        box-shadow: rgb(20,20,20,0.1) 0px 0px 10px 0px;
    }
    .text{
        width: 100%;
        height: calc(100% - 20px);
        padding: 10px;
        background-color: #f7f7f7;
    }
    .bottom_box{
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: space-between;
        background-color: #22E;
        color: #fff;
        padding: 0px 30px;
        height: 40px;
        font-size: 16px;
        line-height: 40px;
        box-shadow: 0px -5px 9px -4px #888888;
    }
    .NavigationBarList{
        /* padding: 5px 0px; */
        display:flex;
        flex-direction:column;
        white-space:pre;
    }
    .NavigationBarSpan{
        white-space:pre;
        border-bottom: 0.1px solid rgb(127,127,127,0.5);
    }
    /* .NavigationBarSpan:hover{
        background-color: #6bb9e0;
        color: #fff;
    } */
    .NavigationBarSpan::before {
        content: "";
        position: absolute;
        width: 4px;
        height: 30px;
        background: #fff;
        left: 0;
        top: 5px;
        transition: .3s;
        opacity: 0;
    }
    .NavigationBarSpan:hover::before{
        opacity: 1;
    }
    .NavigationBarBox{
        position: relative;
        height: 100%;
        display:flex;
        flex-direction:column;
        white-space:pre;
    }
    .currentTab {
        background-color:#207ab6 !important;
        color:#fff !important;
    }
    .currentTab::before {
        opacity: 1;
    }
    /* .SecondTitle::before{
        background: #333;
    } */
    .leftNavigationBarSon::-webkit-scrollbar{
        width:3px;
        background-color:#F5F5F5;
    }
    /* .leftNavigationBar::-webkit-scrollbar-track {
        border: 1px solid #888; 设置轨道的边框
    } */
    .leftNavigationBarSon::-webkit-scrollbar-thumb {
        border-radius: 10px; /* 设置圆角的半径 */
    }
    .leftNavigationBarSon::-webkit-scrollbar-thumb:hover {
        background-color: #555; /* 鼠标悬停时的颜色 */
    }
    .leftNavigationBarSon::-webkit-scrollbar-thumb {
        background-color: #888; /* 设置滚动条拖动手柄的背景颜色 */
    }
    .leftNavigationBarSon::-webkit-scrollbar-track {
        background-color: #ddd; /* 设置滚动条轨道的背景颜色 */
    }
    .text>.ke-container{
        width:100% !important;
        height:100% !important;
        position: relative;
    }
    .ke-edit{
        position: absolute;
        top:0;
        width:100% !important;
        height:100% !important;
    }
    .ke-toolbar{
        position: absolute;
        top:0px;
        left:50%;
        z-index: 2;
        transform: translate(-50% , -100%);
        transition: transform 0.5s ease;
    }
    .ke-statusbar{
        display: none;
    }
    .ke-edit-iframe{
        height:100% !important;
    }
    .ke-toolbar-top{
        transform: translate(-50% , 0);
    }
    .control_box{
        width: 130px;
        height: 40px;
        position: absolute;
        z-index: 4;
        background-color: rgb(224,224,224,0.5);
        bottom: 20px;
        right: 20px;
        display: flex;
        justify-content:space-evenly;
        align-items:center;
        flex-direction: row;
    }
    .control{
        height: 30px;
        width: 30px;
        background-color: #22E;
        cursor: pointer;
    }
    .openEditing{
        background:url(../images/MenuAll.png);
        background-position: -90px -774px;
    }
    .openPrevious{
        background:url(../images/prev01.png) -1px 35px;
        background-size: 33px 78px;
    }
    .openNext{
        background:url(../images/next01.png) -1px 72px;
        background-size: 33px 78px;
    }
    .topText{
        display: flex;
    }
    .toPage{
        width: 40px;
        height: 100%;
        background:url(../images/Enter-01.gif);
        background-size: 60%;
        background-repeat: no-repeat;
        background-position: center center;
    }
    .toPage:hover{
        background-color: #777;
    }
    .toPage:active{
        background-color: #555;
    }
</style>
</html>
