<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Standard_terms_Set.php'; //连上参数设定
if ( isset( $_GET[ 'router' ] ) ){
    if($_GET[ 'router'] == 1){
        $router = 'JiaoCheng'; //标准名称
    }else{
        $router = 'JiaoChengShiPin'; //标准名称

    }
}else{
    $router = 'XiuGaiTiaoKuan';
}
if ( $act == 'edit_mobile' ) { //当接收到处理指令时
    //----------------------------------查询是否有重复值
    //echo $hy;
    if ( isset( $_POST[ 'sys_card' ] ) )$sys_card = $_POST[ 'sys_card' ]; //标准名称
    if ( isset( $_POST[ 'tiaok' ] ) )$tiaok = $_POST[ 'tiaok' ]; //标准号
    if ( isset( $_POST[ 'parent_id' ] ) )$parent_id = $_POST[ 'parent_id' ]; //标准号
    if ( isset( $_POST[ 'Id_MenuBigClass' ] ) )$Id_MenuBigClass = $_POST[ 'Id_MenuBigClass' ]; //所属标准
    if ( isset( $_POST[ 'sys_beizhu' ] ) )$sys_beizhu = $_POST[ 'sys_beizhu' ]; //标准内容

    if ( $sys_card . '1' == '1' ) {
        echo "$textsname名称，不能为空！";
    } else {
        $sql = $rs = $record_count = '';
        $sql = "select id,tiaok,$colsname From `$tablename` where ($colsname='$sys_card' or tiaok='$tiaok') and id<>'$id' order by id Asc";
        //echo $sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        $record_count = mysqli_num_rows( $rs ); //统计总记录数
        mysqli_free_result( $rs ); //释放内存

        if ( $record_count > 1000 ) { //有重复值时
            echo "已有重复值\"" . $sys_card . "\",禁止修改。";
        } else { //允许修改
            //echo"可以修改";
            $sql = $rs = '';
            $nowdata = date( 'Y-m-d H:i:s' );
            //-------------------------------------自动条款 排序处理
            /**/
            $sys_bh_val = '';
            $sys_bh_weizhi = strpos( $tiaok . '.', "." ); //查找字符串首次出现的位置
            for ( $i = 0; $i < $sys_bh_weizhi; $i++ ) {
                $sys_bh_val .= '0';
            };
            $sys_bh = preg_replace( '/[^0123456789]/s', '', $tiaok ) . '0000000000';
            $sys_bh = substr( $sys_bh, 0, 6 ) .$sys_bh_val; //排序编号
            $sys_bh = preg_replace( '/^0*/', '', $sys_bh ) ;//去掉以零开头的数字
            

            $sql = "UPDATE  `$tablename`  set `$colsname` ='$sys_card',`tiaok`='$tiaok',`sys_bh`='$sys_bh',`Id_MenuBigClass`='$Id_MenuBigClass',`sys_beizhu`='$sys_beizhu',`sys_adddate_g`='$nowdate' WHERE id='$id' ";
            //--------------------------------------以下为执行修改
            //echo $sql;
            mysqli_query( $Connadmin, $sql ); //执行修改
            echo "修改成功！"; /*这里只能禁止修改*/
        }
        mysqli_free_result( $rs ); //释放内存
        
        //-------------------------------------自动条款 排序处理
        $sql = "select id,tiaok From `$tablename` where `Id_MenuBigClass`='$parent_id' and sys_yfzuid='$hy' order by id Asc";
        //echo $sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        $record_count = mysqli_num_rows( $rs ); //统计总记录数
        $tiaok='';
        while ( $row = mysqli_fetch_array( $rs ) ) {
            //$i++;
            $id2 = $row[ 'id' ]; //id
            $tiaok = $row[ 'tiaok' ];   // 标准条款
            //$sys_bh = $row[ 'sys_bh' ]; // 标准编号
            
            $sys_bh_val =$sys_bh= '';
            $sys_bh_weizhi = strpos( $tiaok . '.', "." ); //查找字符串首次出现的位置
            for ( $i = 0; $i < $sys_bh_weizhi; $i++ ) {
                $sys_bh_val .= '0';
            };
            $sys_bh = preg_replace( '/[^0123456789]/s', '', $tiaok ) . '0000000000';
            $sys_bh = substr( $sys_bh, 0, 6 ) .$sys_bh_val; //排序编号*/
            //$sys_bh = preg_replace( '/^0*/', '', $sys_bh ) ;//去掉以零开头的数字
            
            //-------------------------------------执行更新
            $sql2 = "update `$tablename` set `sys_bh` = '$sys_bh' where `id`={$id2}" ;
            //echo $sql2;
            mysqli_query( $Connadmin, $sql2 ); //执行添加与更新
        }
        mysqli_free_result( $rs ); //释放内存
        //-------------------------------------自动条款 排序处理 end if
        
        
        
        mysqli_close( $Connadmin ); //关闭数据库 
    }
    //echo $sys_card;
} else {
    //查询到相关值

    $sql = $rs = $row = '';
    if ( $id > 0 ) {
        $sql = "select id,tiaok,$colsname,Id_MenuBigClass,sys_adddate,sys_beizhu,sys_bh,sys_adddate_g From `$tablename` where id='$id' and sys_yfzuid='$hy' order by id Asc";
        //echo $sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        //$record_count = mysqli_num_rows( $rs ); //统计总记录数
        $row = mysqli_fetch_array( $rs );
        $sys_card = $row[ $colsname ]; //标准名称
        $tiaok = $row[ 'tiaok' ]; //标准号
        $sys_bh = $row[ 'sys_bh' ]; //标准号
        $Id_MenuBigClass = $row[ 'Id_MenuBigClass' ]; //所属标准ID
        $sys_beizhu = $row[ 'sys_beizhu' ]; //内容
        $sys_adddate = $row[ 'sys_adddate' ]; //添加时间
        $sys_adddate_g = $row[ 'sys_adddate_g' ]; //更新时间
        mysqli_free_result( $rs ); //释放内存
    }
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
<style>
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
        width: 100%;
        position: absolute;
        height: calc(100vh - 94px);
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
        top: 10px;
        left: 10px;
        width: 40px;
        height: 18px;
        padding: 6px 0px;
        z-index: 5;
        background-color: #ddd;
    }
    .SlideOutMenu:hover{
        background-color: #bbb;
    }
    .SlideOutMenu:active{
        background-color: #777  ;
    }
    .item{
        width: 80%;
        height: 20%;
        background-color: #fff;
    }
    .middle_box{
        flex:1;
        position: relative;
        display: flex;
    }
    .leftNavigationBar{
        height: 100%;
        width: 250px;
        position: absolute;
        left: -250px;
        z-index: 6;
        background-color: rgb(224,224,224,1);
        overflow: auto;
        transition: all 1s ease;
    }
    .mast{
        display: none;
        height: 100%;
        width: 100%;
        position: absolute; 
        background-color: rgb(20,20,20,0.1);
    }
    .imgBox{
        position: absolute; 
        width: 80px;
        top: 10px;
        right: 20px;
        z-index: 6;
        background-color: #22E;
    }
    .text_box{
        flex:1;
        height: 100%;
        background-color: #fff;
        display: flex;
        align-items:center;
        justify-content: center;
    }
    .text{
        width: 70%;
        height: 90%;
        padding: 10px;
        margin-right: 20px;
        background-color: #f7f7f7;
    }
    .bottom_box{
        flex:0;
        display: flex;
        justify-content: space-between;
        background-color: #22E;
        color: #fff;
        padding: 0px 50px;
        height: 40px;
        font-size: 16px;
        line-height: 40px;
    }
    .NavigationBarList{
        display:flex;
        flex-direction:column;
        white-space:pre;
    }
    .NavigationBarSpan:hover{
        background-color: #444;
        color: #fff;
    }
    .NavigationBarBox{
        display:flex;
        flex-direction:column;
        white-space:pre;
    }
    .leftNavigationBar::-webkit-scrollbar{
        width:3px;
        background-color:#F5F5F5;
    }
    /* .leftNavigationBar::-webkit-scrollbar-track {
        border: 1px solid #888; 设置轨道的边框
    } */
    .leftNavigationBar::-webkit-scrollbar-thumb {
        border-radius: 10px; /* 设置圆角的半径 */
    }
    .leftNavigationBar::-webkit-scrollbar-thumb:hover {
        background-color: #555; /* 鼠标悬停时的颜色 */
    }
    .leftNavigationBar::-webkit-scrollbar-thumb {
        background-color: #888; /* 设置滚动条拖动手柄的背景颜色 */
    }
    .leftNavigationBar::-webkit-scrollbar-track {
        background-color: #ddd; /* 设置滚动条轨道的背景颜色 */
    }
</style>
</head>

<body>
<div id="wrapper">
    <div id="header"> <a href="<?php echo $phpstart ?>.php?id=<?php echo $parent_id ?>" class="home"></a> <em class="eleft">条款修改</em> <a href="M_right_menu.php" class="siteMap"></a> </div>
    <div id="navigationBar">
        <div id="XiuGaiTiaoKuan" class="navigationBar_child">条款修改</div>
        <div id="JiaoCheng" class="navigationBar_child">教程</div>
        <div id="JiaoChengShiPin" class="navigationBar_child">教程视频</div>
    </div>
    <form id="XiuGaiTiaoKuan_box" class="navigationBar_box">
        <div id='mobanaddbox' class='NowULTable nocopytext'> 
            <!--   !-->
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font>条款号:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='tiaok' id='tiaok' class='addboxinput inputfocus'  value='<?php echo $tiaok ?>' />
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font>条款名称:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='sys_card' id='sys_card' class='addboxinput inputfocus'  value='<?php echo $sys_card ?>' />
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            <ul id="standard_textarea_box">
                <li class='cols01'>标准内容:</li>
                <li class='cols02'>
                    <textarea class='standard_textarea'><?php echo $sys_beizhu ?></textarea>
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            <ul>
                <li class='cols01'>所属标准:</li>
                <li class='cols02'>
                <?php
                    $sql2 = "select * from `msc_standard` where sys_yfzuid='$hy' and sys_huis=0 ";
                    $rs2 = mysqli_query( $Connadmin, $sql2 );
                    echo( "<select name='Id_MenuBigClass'  class='addboxinput inputfocus' " );
                    //echo( "<option  value='0'>未选择</option>" );
                    while ( $row2 = mysqli_fetch_array( $rs2 ) ) {
                        $rowdid = $row2[ "id" ];
                        $number = $row2[ "number" ]; //标准编号
                        $name = $row2[ "name" ]; //部标准名称
                        echo( "<option  value='$rowdid' " );
                        if ( $Id_MenuBigClass == $rowdid ) {
                            echo( 'selected' );
                        }
                        echo( ">{$number}&nbsp;{$name}</option>" );
                    }
                    echo( '</select>' );
                    mysqli_free_result( $rs2 ); //释放内存
                    
                    ?>
                </li>
            </ul>
            <ul>
                <li class='cols01'>教程:</li>
                <li class='cols02'>&nbsp;+</li>
            </ul>
            <ul>
                <li class='cols01'>添加时间:</li>
                <li class='cols02'>&nbsp;<?php echo $sys_adddate ?></li>
            </ul>
            <ul>
                <li class='cols01'>更新时间:</li>
                <li class='cols02'>&nbsp;<?php echo $sys_adddate_g ?></li>
            </ul>
            <?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
            <ul>
                <li class='cols01'> &nbsp;</li>
                <li class='cols02'>
                    <input type='hidden' typeid='1' name='parent_id' id='parent_id' class='addboxinput inputfocus'  value='<?php echo $parent_id ?>' />
                    
                    <input id='SYS_submit' value='提 交' type='button' title='Ctrl+Enter提交' class='button button_ADD' onclick="add_edit_mobile(this,'<?php echo $phpstart ?>_edit.php','edit_mobile','<?php echo $phpstart ?>.php?id=<?php echo $parent_id ?>')" />
                    
                </li>
            </ul>
            <ul>
                <li class='cols01'> &nbsp;</li>
                <li class='cols02'> <font id='editsuccess' class='font_red'></font></li>
            </ul>
            <?php
            }
            ?>
            <input type='hidden' name='id' id='id' value='<?php echo $id ?>' />
            <input type='hidden' name='act' id='act' value='edit_mobile' />
            <?php include_once( 'M_foot.php' );?>
            <?php include_once( 'M_bottom.php' );?>
        </div>
    </form>
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
            <div class="text_box">
                <div class='text'>
                    <textarea class='standard_textarea'><?php echo $sys_beizhu ?></textarea>
                </div>
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
    <div id="JiaoChengShiPin_box" class="navigationBar_box">
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="../../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../../js/jq.host_mobile.js"></script>
<script charset="utf-8" src="../../js/kindeditor-master/kindeditor-all.js"></script>
<script charset="utf-8" src="../../js/kindeditor-master/lang/zh-CN.js"></script>
<script>
var editor = null
KindEditor.ready(function(K) {
    editor = K.create('.standard_textarea', {
        'width':'800px',
        'height' :'400px',
        'items': ['source', '|', 'undo', 'redo', '|', 'preview', 'fullscreen', 'code', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript', 'superscript', '|', 'selectall', '-', 'title', 'fontname', 'fontsize', '|', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline', 'strikethrough', 'removeformat', '|', 'image', 'multiimage', 'flash', 'media', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak', 'anchor', 'link', 'unlink', '|', 'about']
    });
});
$(document).ready(()=>{
    $('.navigationBar_box').hide()
    console.log('#<?php echo $router ?>')
    $('#<?php echo $router ?>_box').show()
    $('#<?php echo $router ?>').css({
        'background-color':'#000'
    })
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
        $('.mast').show()
    })
    $('.mast').on('click',function(){
        $('.mast').hide()
        $('.leftNavigationBar').css({
            'left':'-250px'
        })
    })
})
// let leftNavigationBar = null

$.post('M_Standard_terms_ajax.php', { act: 'leftNavigationBar', id: '8' }, function(data) {
    // console.log(JSON.parse(data))
    // console.log(createNav(JSON.parse(data),0).get(0));
    $('.leftNavigationBar').append(createNav(JSON.parse(data),0).get(0))
})

function createNav(data,index) {
    // 创建一个容器 div 元素
    let container = $('<div>');

    // 创建一个用于显示名称的 div 元素
    let nameDiv = $('<div>');
    nameDiv.text(`${' '.repeat(index*2)}${data.number} ${data.name}`);
    if(data.id){
        if(data.id == '<?php echo $id ?>'){
            nameDiv.css({
                'background-color':'#777',
                'color':'#fff'
            })
        }else{
            nameDiv.on('click',function(){
                let url = `M_Standard_terms_edit.php?parent_id=<?php echo $parent_id ?>&id=${data.id}&router=1`
                window.location.href = url
            }).attr('class','NavigationBarSpan')
        }
    }
    container.append(nameDiv);

    // 如果有子项目，递归创建子导航
    if (data.data) {
        let son = $('<div>');
        data.data.forEach((item) => {
            // 递归创建子导航并将其附加到容器中
            let subNav = createNav(item,index+1);
            son.append(subNav);
        });
        son.attr('class','NavigationBarList')
        container.append(son);
    }
    container.attr('class','NavigationBarBox')

    return container;
}
</script>
<?php
}
mysqli_close( $Connadmin ); //关闭数据库 
?>
