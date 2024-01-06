<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息

//------------------------------------------------------------------以下为查询到相关信息
$sql = $rs = $row = '';
$sql = "select * From `msc_fukuanfangshi` where sys_id_zu='$const_id_login' "; //用户登录表
// echo $sql; 
$rs = mysqli_query( $Connadmin, $sql );
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
<div id="wrapper" style="overflow:hidden;display: flex;flex-direction: column;">
    <div id="header"> <a href="M_info.php" class="home"></a> <em class="eleft">收款方式</em> <a href="M_right_menu.php" class="siteMap"></a> </div>
    <div class='smrz_shell'>
        <div class='smrz_baccmark'>

        </div>
    </div>
    <div class="editingArea">

    </div>
</div>
</body>
</html>
<script type="text/javascript" src="../../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../../js/B_login_fnction.js"></script>

<script>    
    const div = `
        <div class='smrz_inputBigBox'>
            <div class='caozuoqu'>
                <div class="smrz_inputBox gongyong">
                    <div class="smrz_text">账户姓名<i style="color:red">*</i></div>
                    <input type="text" class="smrz_input accountName">
                    <div class="default_text"><div>默认</div></div>
                </div>
                <div class="smrz_inputBox gongyong">
                    <div class="smrz_text">付款方式<i style="color:red">*</i></div>
                    <select class="fkfs_select zhifuleixing">
                        <option value="zfb">支付宝</option>
                        <option value="yhk">银行卡</option>
                    </select>
                </div>
                <div class="smrz_inputBox zfb">
                    <div class="smrz_text">收款号码<i style="color:red">*</i></div>
                    <input type="text" class="smrz_input alipayAccount">
                </div>
                <div class="smrz_inputBox yhk">
                    <div class="smrz_text">开户行<i style="color:red">*</i></div>
                    <input type="text" class="smrz_input kaihuhang">
                </div>
                <div class="smrz_inputBox yhk">
                    <div class="smrz_text">银行账号<i style="color:red">*</i></div>
                    <input type="text" class="smrz_input bankAccount">
                </div>
                <div class="smrz_inputBox gongyong default_box">
                    <div>设为默认</div>
                    <input type="radio" class="default">
                    <button class="queding"></button>
                    <button class="quxiao"></button>
                </div>
            </div>
        </div>
    `
    const button = {edit_button:'<button class="edit_button">编辑</button>',add_button:'<button class="add_button">添加</button>'}

    let edit_button = $.parseHTML(button.edit_button);
    let add_button = $.parseHTML(button.add_button);
    let add_class = false;
    let editing = 0;
    let default_event = 0
    let default_event_old = 0

    $('.editingArea').append(edit_button)    
    $('.editingArea').append(add_button)
    let countrows  = <?php echo mysqli_num_rows( $rs ) ?>;

    //判断有没有数据
    if(countrows){
        <?php
        while ($row = mysqli_fetch_assoc($rs)) {
            echo "checkDiv(".json_encode($row).");";
        }
        ?>

    }else{
        addDiv()
        $('.editingArea').hide()
        $('.smrz_shell').css('height','calc(100% - 44px)')
    }
    addEditingArea()

    //设置默认选择
    function default_click(dom,row){
        let default_index = $(dom).find('.default').prop("checked");
        $('.default').prop("checked",false);
        $('.default_text div').hide()
        $(dom).find('.default').prop("checked",!default_index);
        if(!default_index){
            $(dom).find('.default_text div').show()
            default_event = row['id']
        }else{
            default_event = 0
        }
    }
    //查看付款方式
    function checkDiv(row){
        let dom = $.parseHTML(div);
        $('.smrz_baccmark').append(dom);
        fillingDiv(dom,row)
        zhifuleixingSwitch(dom)
    }
    //初始化&重置
    function fillingDiv(dom,row = false){
        if(row){
            // console.log(row)
            $(dom).find('.smrz_inputBox').show();
            $(dom).find(`.${row.sys_fukuanfangshi==='zfb'?"yhk":"zfb"}`).hide();
            $(dom).find('.zhifuleixing').val(row['sys_fukuanfangshi']);
            $(dom).find('.accountName').val(row['sys_zhanghuxingming']);
            $(dom).find('.alipayAccount').val(row['sys_shoukuanhaoma']);
            $(dom).find('.kaihuhang').val(row['sys_kaihuhang']);
            $(dom).find('.bankAccount').val(row['sys_yinhangzhanghao']);
            $(dom).find('.default').prop("checked", row['moren'] == 1);
            $(dom).find('.default_box div').off('click').on('click',() => default_click(dom,row))
            if(row['moren'] == 1){
                default_event = row['id']
                default_event_old = row['id']
            }
            $(dom).find('.default_box').hide()
        }
        if($(dom).find('.default').prop('checked')){
            $('.default_text div').hide();
            $('.default').prop("checked", false);
            $(dom).find('.default_text div').show();
            $(dom).find('.default').prop("checked", row['moren'] == 1);
        }else{
            $(dom).find('.default_text div').hide()
        }
        
        $(dom).find('.smrz_input,.zhifuleixing').css({
            'user-select': 'none', /* 防止文本选中 */
            'pointer-events': 'none', /* 禁用鼠标事件 */
        });
        $(dom).find('.quxiao').text('删除').css({
            'background-color':'#f00',
            'color':'#fff'
        }).off('click').on('click',() => {
            if(confirm('您确定要删除么？')){
                dataProcessing(dom,'delete',row)
                href_if()
            }
        })
        $(dom).find('.queding').text('修改').css({
            'background-color':'#19B4EA',
            'color':'#000'
        }).off('click').one('click',() => reviseDiv(dom,row))
        $(dom).find('.smrz_input').on('input',()=>queding_button_display(dom))
    }
    //切换支付方式
    function zhifuleixingSwitch(dom){
        $(dom).find('.zhifuleixing').on('change', function() {
            $(dom).find('.smrz_inputBox').css({
                'display':'none',
            })
            $(dom).find(`.${$(this).val()},.gongyong`).css({
                'display':'flex',
            })
            queding_button_display($(dom))
        });
    }
    //修改付款方式
    function reviseDiv(dom,row){
        editing += 1
        $(dom).find('.smrz_input,.zhifuleixing').css({
            'user-select': 'auto',
            'pointer-events': 'auto',
        });
        $(dom).find('.quxiao').text('取消').css({
            'background-color':'#19B4EA',
            'color':'#000'
        }).off('click').one('click',() => {
            fillingDiv(dom,row)
            editing -= 1
        })
        $(dom).find('.queding').text('确认').css({
            'background-color':'#eee',
            'color':'#ccc'
        }).on('click',() => {
            if(queding_class(dom)){
                dataProcessing(dom,'alter',row)
                editing -= 1
            }
        })
    }
    //添加付款方式
    function addDiv(){
        countrows += 1
        
        let dom = $.parseHTML(div);
        $('.smrz_baccmark').append(dom);

        $(dom).find('.yhk').hide();
        $(dom).find('.default_text div').hide()
        zhifuleixingSwitch(dom)
        $(dom).find('.quxiao').text('取消').on('click',function(){
            $(dom).remove();
            href_if()
            $('.editingArea').show()
            $('.smrz_shell').css('height','calc(94% - 44px)')
        });
        $(dom).find('.queding').text('确定').on('click',() => {
            if(queding_class(dom)){
                dataProcessing(dom,'add')
            }
        });
        $(dom).find('.smrz_input').on('input',()=>queding_button_display(dom))
        queding_button_display($(dom))
        $(dom).find('.default_box div').on('click',() => {
            let checkdate = $(dom).find('.default').prop('checked')
            $(dom).find('.default').prop('checked',!checkdate)
            $(dom).find('.default_text div').toggle()
        })
    }
    //设置确定按钮的样式
    function queding_button_display(dom){
        if(queding_class(dom)){
            $(dom).find('.queding').css({
                'background-color':'#19B4EA',
                'color':'#000'
            })
        }else{
            $(dom).find('.queding').css({
                'background-color':'#eee',
                'color':'#ccc'
            })
        }
    }
    //控制确定按钮的样式
    function queding_class(dom){
        const selectedValue = $(dom).find('.fkfs_select').val()
        const accountName = $(dom).find('.accountName').val();
        const alipayAccount = $(dom).find('.alipayAccount').val();
        const kaihuhang = $(dom).find('.kaihuhang').val();
        const bankAccount = $(dom).find('.bankAccount').val();

        const isAccountNameEmpty = accountName === '';
        const isAlipayInvalid = selectedValue === 'zfb' && !/^(\d{11})$/.test(alipayAccount);
        const isYhkInvalid = selectedValue === 'yhk' && (kaihuhang === '' || bankAccount === '');

        return !(isAccountNameEmpty || isAlipayInvalid || isYhkInvalid);
    }
    //删除修改方式
    function href_if(){
        countrows -= 1
        if(countrows === 0){
            window.location.href = 'M_info.php'
        }
    }
    //添加编辑区
    function addEditingArea(){
        $(add_button).on('click',function(){
            addDiv();
            $('.editingArea').hide();
            $('.smrz_shell').css('height','calc(100% - 44px)')
        })
        $(edit_button).one('click',() => edit_button_click())
    }
    //编辑完成点击事件
    function edit_button_click(){
        $('.default_box').show()
        $(add_button).hide()
        $(edit_button).text('完成').on('click',() => {
            if(editing){
                alert('请完成编辑区的编辑')
            }else{
                $(edit_button).text('编辑').off('click').one('click',() => edit_button_click())
                $('.default_box').hide()
                $(add_button).show()
                reviseDefault()
                default_event = -1
            }
        })
    }
    //默认付款方式
    function reviseDefault(){
        console.log(123)
        let sys_id_zu = <?php echo $user_id; ?>;
        console.log(default_event , default_event_old)
        if(default_event == default_event_old){
            // console.log('无需改动',default_event,default_event_old)
        }else if(default_event == 0){
            // console.log('取消默认值')
            let sql = `
                UPDATE msc_fukuanfangshi
                SET moren = 0
                WHERE sys_id_zu = ${sys_id_zu};
            `
            // console.log(sql)
            $.post('M_edit_data.php', {act:'mysqli_query_method',sql}).then((result) => {
                // console.log(result)
            });
            default_event_old = 0
        }else{
            // console.log('将',default_event,'改为默认值')
            let sql1 = `
                UPDATE msc_fukuanfangshi
                SET moren = 0
                WHERE sys_id_zu = ${sys_id_zu};
            `
            let sql2 = `
                UPDATE msc_fukuanfangshi
                SET moren = 1
                WHERE id = ${default_event};
            `
            // console.log(sql1)
            // console.log(sql2)

            $.post('M_edit_data.php', {act:'mysqli_query_method',sql:sql1}).then((result) => {
                // console.log(result)
                
                $.post('M_edit_data.php', {act:'mysqli_query_method',sql:sql2}).then((result) => {
                     // console.log(result)
                });
            });
            default_event_old = default_event

        }
    }
    //数据变动事件
    function dataProcessing(dom,event,row={}){
        let sql = '';
        switch(event){
            case 'delete':
                $(dom).remove();
                sql = `
                    DELETE FROM msc_fukuanfangshi
                    WHERE id = ${row['id']};
                `
                $.post('M_edit_data.php', {act:'mysqli_query_method',sql});
                break;
            case 'add':
                $(dom).remove();
                sql = `
                    INSERT INTO msc_fukuanfangshi (
                        sys_fukuanfangshi, 
                        sys_zhanghuxingming,
                        sys_shoukuanhaoma,
                        sys_kaihuhang,
                        sys_yinhangzhanghao,
                        sys_id_zu
                    )
                    VALUES (
                        '${$(dom).find('.zhifuleixing').val()}',
                        '${$(dom).find('.accountName').val()}',
                        '${$(dom).find('.alipayAccount').val()}',
                        '${$(dom).find('.kaihuhang').val()}',
                        '${$(dom).find('.bankAccount').val()}',
                        '<?php echo $const_id_login; ?>'
                    );
                `
                // console.log(sql)
                $.post('M_edit_data.php', {act:'mysqli_query_method',sql}).then((result) => {
                    result = JSON.parse(result)
                    if(!result.error){
                        alert('添加成功！');
                        // console.log(result)
                        if($(dom).find('.default').prop("checked")){
                            default_event = result.mysqli_insert_id;
                            // console.log(result.mysqli_insert_id)
                            reviseDefault()
                        }
                        sql = `select * From msc_fukuanfangshi where id = ${result.mysqli_insert_id} `
                        $.post('M_edit_data.php', {act:'mysqli_query_select',sql}).then((result) => {
                            result = JSON.parse(result)
                            checkDiv(result)
                        })
                    }else{
                        // console.log(result)
                    }
                });
                
                $('.editingArea').show();
                $('.smrz_shell').css('height','calc(94% - 44px)')
                break;
            case 'alter':
                fillingDiv(dom);
                sql = `
                    UPDATE msc_fukuanfangshi
                    SET 
                        sys_fukuanfangshi = '${$(dom).find('.zhifuleixing').val()}',
                        sys_zhanghuxingming = '${$(dom).find('.accountName').val()}',
                        sys_shoukuanhaoma = '${$(dom).find('.alipayAccount').val()}',
                        sys_kaihuhang = '${$(dom).find('.kaihuhang').val()}',
                        sys_yinhangzhanghao = '${$(dom).find('.bankAccount').val()}'
                    WHERE id = ${row['id']};
                `

                // console.log(sql)

                $.post('M_edit_data.php', {act:'mysqli_query_method',sql}).then((result) => {
                    // console.log(result)
                    // alert('修改成功！');
                });
                break;
            default:
                console.error('没有提供event');
                return;
        }
    }
</script>
