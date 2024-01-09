//---------------------------------------------------------------------------------------------------------------------选取层级部位
function DIVHtmlID(ToHtmlID, nowbody) { //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    // console.log(ToHtmlID, nowbody)
    var ToHtmlID = ToHtmlID.replace(/^Top_*/g, ""); //去除以Top_字符串开头
    //alert(ToHtmlID);
    if (!nowbody || nowbody == '') {
        NowToHtmlID = $('#' + ToHtmlID);
    } else {
        NowToHtmlID = $('#' + ToHtmlID + ' #' + ToHtmlID + '_' + nowbody);
    }
    return NowToHtmlID;
}

function callmenuDesk(act, nowdb, nowkeyword = '',fun = () => {}) { //(act//这里加载用户菜单
    if ($('#DeskMenuDiv0.main_right_div .menudesk').length > 0 && nowdb != 1) {
        //return false;
    } else {
        //$("#DeskMenuDiv0").html("<span></br>Loading...</span><div class='logodesk'>图标</div>");
        $('.main_right_div_box').html("<div style='margin-top:18px;margin-left:25px;height:45px;'>Loading...</div>");
        $.get('B_menu_desk_list.php', {
            act,nowkeyword
        }, function (data) {
            // console.log(data)
            $('.main_right_div_box').html(data);
            fun()
        });
    } //当没有桌面时便加载
}

function contenthovermore(ToHtmlID) { //表格hover 特效 多个表

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'content_ALL'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    //alert(NowToHtmlID);
    NowToHtmlID.find(".tables ul").not(".thead").on("mouseover", function () { //光标进入
        NowToHtmlID.find("ul." + $(this).attr('overid')).addClass("hovers");
    }).on("mouseout", function () { //光标移出
        NowToHtmlID.find("ul." + $(this).attr('overid')).removeClass("hovers");
    }).on("dblclick", function () { //双击执行
        //alert('0');
        NowToHtmlID.find("ul.hoversONDBLCLICK").removeClass("hoversONDBLCLICK");
        NowToHtmlID.find("ul." + $(this).attr('overid')).addClass("hoversONDBLCLICK");
    });
}

function tableshover(divid) { //表格hover 特效 单个表
    //alert("001");
    $(divid).find(".hoverthis").on("mouseover", function () {
        $(this).addClass("hovers");
    }).on("mouseout", function () {
        $(this).removeClass("hovers");
    });
    $(divid).find(".hoverthis2").on("mouseover", function () {
        $(this).addClass("hovers2");
    }).on("mouseout", function () {
        $(this).removeClass("hovers2");
    });
}

function stylehover(selectul, css_id) { //表格hover 特效 单个表根据样式
    //alert("001");
    $(selectul).hover(function () {
        // $("#orderedlist li:last").hover(function() {
        $(this).addClass(css_id);
    }, function () {
        $(this).removeClass(css_id);
    });
}

//===============================================================================加载ajax函数
function AjaxLoad(datapage, act, datahtml, callback, types, ToHtmlID, donghua, ed_id) { //ed_id编辑id
    if (!types || types == '') {
        types = 'post';
    }
    if (!ToHtmlID) {
        ToHtmlID = '';
    }
    if (!ed_id) {
        ed_id = 0;
    }

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    //alert(NowToHtmlID);
    var hy = NowToHtmlID.find('#sys_const_hy').val(); //hy

    if (!hy) {
        hy = "";
    }
    var bh = NowToHtmlID.find('#sys_const_bh').val(); //bh编制人
    if (!bh) {
        bh = '';
    };
    var sys_shenpi = NowToHtmlID.find('#sys_const_shenpi').val(); //审核人
    var sys_shenpi_all = NowToHtmlID.find('#sys_const_shenpi_all').val(); //批准人
    var sys_chaosong = NowToHtmlID.find('#sys_const_chaosong').val(); //经办人

    var sys_const_pagetype = NowToHtmlID.find('#sys_const_pagetype').val(); //这里得到页面类型，listpage,delpage,huispage
    var page = NowToHtmlID.find('#sys_const_page').val(); //页码
    if (!page) {
        page = 1;
    }
    var re_id = NowToHtmlID.find('#sys_const_re_id').val() * 1; //re_id
    var keyword = NowToHtmlID.find('#keyword').val(); //关键词
    var zu = NowToHtmlID.find('#zu').val(); //分类id
    if (zu == '') {
        zu = 0;
    };
    var sys_id_bumen = NowToHtmlID.find("#sys_const_id_bumen").val(); //部门id
    var sys_const_adddate = NowToHtmlID.find('#sys_const_adddate').val(); //添加时间
    var sys_const_qx = NowToHtmlID.find('#sys_const_qx').val(); //
    if (NowToHtmlID.find('#zd').length > 0 && keyword != "") { //字段
        var zd = NowToHtmlID.find('#zd').val();
    } else {
        zd = "0";
    }
    //alert(datapage);
    //alert(hy);
    var huis = NowToHtmlID.find("#sys_const_huis").val(); //回收
    var px_name = NowToHtmlID.find("#sys_const_px_name").val(); //排序字段
    var pxv = NowToHtmlID.find("#sys_const_pxv").val(); //desc acs
    var pok = NowToHtmlID.find("#sys_const_pok").val(); //是否排序
    var scroll_left = NowToHtmlID.find("#" + ToHtmlID + "_content").scrollLeft();
    var sys_guanxibiao_id = NowToHtmlID.attr('sys_guanxibiao_id'); //得到关系表里的re_id
    var GuanXi_id = NowToHtmlID.attr('guanxi_id'); //得到对应关系id
    var ShaiXuanSql = NowToHtmlID.find('#ShaiXuanSql').val(); //得到筛选SQL
    var ShaiXuanSql_other = NowToHtmlID.find('#ShaiXuanSql_other').val(); //得到筛选SQL
    var sys_const_tuodongok = NowToHtmlID.find('#sys_const_tuodongok').val(); //拖动开始
    var sys_const_s_h = NowToHtmlID.find('#sys_const_s_h').val(); //
    var sys_const_q_h = NowToHtmlID.find('#sys_const_q_h').val(); //
    var sys_const_c_ok = NowToHtmlID.find('#sys_const_c_ok').val(); //
    var sys_const_b_ok = NowToHtmlID.find('#sys_const_b_ok').val(); //
    var sys_const_C_xu_now = NowToHtmlID.find('#sys_const_C_xu_now').val(); //
    var sys_const_Start_Suoding = NowToHtmlID.find('#sys_const_Start_Suoding').val(); //
    var sys_const_End_Suoding = NowToHtmlID.find('#sys_const_End_Suoding').val(); //
    var sys_const_prev_zd = NowToHtmlID.find('#sys_const_prev_zd').val(); //
    var sys_const_ChangePrev_zd = NowToHtmlID.find('#sys_const_ChangePrev_zd').val(); //
    var sys_const_ChangeNext_zd = NowToHtmlID.find('#sys_const_ChangeNext_zd').val(); //
    var sys_const_this_zd = NowToHtmlID.find('#sys_const_this_zd').val(); //
    var sys_const_biaoqian_id = NowToHtmlID.find('#sys_const_biaoqian_id').val(); //
    //alert(datapage);
    $.ajax({
        type: types,
        async: true,
        contentType: "application/x-www-form-urlencoded; charset=utf-8",
        url: datapage,
        data: {
            act: act,
            page: page,
            zu: zu,
            sys_id_bumen: sys_id_bumen,
            sys_adddate: sys_const_adddate,
            sys_const_qx: sys_const_qx,
            keyword: keyword,
            re_id: re_id,
            huis: huis,
            zd: zd,
            px_name: px_name,
            pxv: pxv,
            pok: pok,
            hy: hy,
            bh: bh,
            sys_shenpi: sys_shenpi,
            sys_shenpi_all: sys_shenpi_all,
            sys_chaosong: sys_chaosong,
            scroll_left: scroll_left,
            sys_const_pagetype: sys_const_pagetype,
            ShaiXuanSql: ShaiXuanSql,
            ShaiXuanSql_other: ShaiXuanSql_other,
            sys_guanxibiao_id: sys_guanxibiao_id,
            sys_const_tuodongok: sys_const_tuodongok,
            GuanXi_id: GuanXi_id,
            ToHtmlID: ToHtmlID,
            ed_id: ed_id,
            sys_const_s_h: sys_const_s_h,
            sys_const_q_h: sys_const_q_h,
            sys_const_c_ok: sys_const_c_ok,
            sys_const_b_ok: sys_const_b_ok,
            sys_const_C_xu_now: sys_const_C_xu_now,
            sys_const_Start_Suoding: sys_const_Start_Suoding,
            sys_const_End_Suoding: sys_const_End_Suoding,
            sys_const_prev_zd: sys_const_prev_zd,
            sys_const_ChangePrev_zd: sys_const_ChangePrev_zd,
            sys_const_ChangeNext_zd: sys_const_ChangeNext_zd,
            sys_const_this_zd: sys_const_this_zd,
            sys_const_biaoqian_id: sys_const_biaoqian_id
        },
        success: function (data) {
            console.log(datapage,act)
            console.log(data);
            // alert(datapage)

            if (callback == 'data') {
                // alert(data);
            }
            //var NowToHtmlID=DIVHtmlID(ToHtmlID,'fanall');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
            if (datahtml != '') {
                if (donghua == 'donghua') {
                    NowToHtmlID.find(datahtml).html(data);
                    NowToHtmlID.find(datahtml).hide().show();
                } else {
                    NowToHtmlID.find(datahtml).html(data);
                    // console.log(datahtml)
                };
                if (callback != '') {
                    callback;
                };
            }
        },
        error: function (data) {
            alert('页面：' + datapage + '?' + act);
            alert(data);
        }
    });
}
//---------------------------------------------------------------------------------------------------------------------删除数据到回收站
function DelToHuishou(ToHtmlID) { //删除数据到回收站

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
    //alert(re_id);
    sys_js_chestr("#" + ToHtmlID + "_content_right", "ID", ToHtmlID);
    //alert(sys_js_arrychestr);
    if (sys_js_arrychestr == "") {
        alert("您没选数据！");
        return false;
    } else {

        if (confirm("是否删除？") == false) {
            return false;
        };
        //alert(sys_js_arrychestr);
        LoodingDiv(ToHtmlID); //Loading...
        $.post('B_moban_del.php', {
            id: sys_js_arrychestr,
            act: "Del_To_Huis",
            ToHtmlID: ToHtmlID,
            re_id: re_id
        }, function (data) {
            //alert(data);
            NowToHtmlID.find("#chkall").attr("checked", false);
            ListGet(ToHtmlID); //中间数据
            List_Page_Get(ToHtmlID); //分页数据
            // shuqianmenu_user_update(ths, ToHtmlID); //更新记忆功能
        });
    }

}

//---------------------------------------------------------------------------------------------------------------------读取层——显示
function LoodingDiv(ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'mask_lood'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    NowToHtmlID.show();

}
//---------------------------------------------------------------------------------------------------------------------读取层_关闭
function LoodingClosed(ToHtmlID) {

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    //alert(NowToHtmlID);

    NowToHtmlID.find("#" + ToHtmlID + "_mask_lood").hide();

}
//---------------------------------------------------------------------------------------------------------------------数据页加载
function ListGet(ToHtmlID) {
    AjaxLoad("B_moban_list.php", 'list', "#" + ToHtmlID + "_content", '', 'GET', ToHtmlID);
}
//---------------------------------------------------------------------------------------------------------------------数据页表头加载【含文件编号 + 书签】
function List_Head_Get(ToHtmlID) {
    AjaxLoad("B_moban_list_top.php", 'list', "#" + ToHtmlID + "_banner", '', 'GET', ToHtmlID);
}
//---------------------------------------------------------------------------------------------------------------------分页统计数据
function List_Page_Get(ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    //alert(NowToHtmlID);
    NowToHtmlID.find('#moban_foot').html('<img src="/images/055.gif"/>');
    AjaxLoad('B_moban_foot.php', 'list', '#moban_foot', '', 'GET', ToHtmlID);

}
//---------------------------------------------------------------------------------------------------------------------加载下边上拉工具栏参数
function loodfoot(id, ToHtmlID, SeAot, strmk_id) { //loodfoot(20,'"&ToHtmlID&"','.SeAtxiugai','"&strmk_id&"');
    var nowtext = '';
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID, 'content_foot');
    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
    if (NowToHtmlID.find("#zu").length > 0) {
        var zu = NowToHtmlID.find("#zu").val();
    } else {
        zu = 0;
    };

    switch (id) {

        case 4:
            {
                addbox(0.75, AjaxLoad('moban_set.php', 'jbsd', '.htmlleirong #tagContent'), 'open', '', ToHtmlID);
                addboxbg('#footseid11', ToHtmlID);
                NowToHtmlID_content_foot.find('.headleft').html('<ul><li class="h_hou" id="main_top_1"><i class="fa fa-xiaoxi"></i> 内部QQ</li></ul>'); //maxcontheight(ToHtmlID);
            };
            break; //QQ

        case 7:
            {
                tihuanxinhao('#' + ToHtmlID + '_content td');tihuanxinhao('#' + ToHtmlID + '_content_left td');
            };
            break; //锁定maxcontheight(ToHtmlID);

        case 13:
            {
                alert('老子还没时间做！')
            };
            break; //打印

        case 15:
            {
                if (NowToHtmlID_content_foot.find("#bbsTabntq").length <= 0) {
                    NowToHtmlID_content_foot.find('#rightdiv').html('loading...');
                    AjaxLoad('moban_set.php', 'dataallbiao_data', '#rightdiv', '', 'GET', ToHtmlID);
                }
            };
            break; //加载链接数据表

        default:
            {
                alert('loodfoot(未选择命令！)')
            };
    };
}
//==================================================================================底部设定上面的菜单   
function main_top_menu(checkid, ToHtmlID) { //('main_top_1',ToHtmlID)
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'content_foot'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var nowhtml = "<a  class='selectTag' onclick=\"" + "moban_set_edit(this,'" + ToHtmlID + "');\"" + ">设定</a>"
        + "<a onclick=\"" + "Table_Set('" + ToHtmlID + "',this);\"" + ">字段</a>"
        + "<a onclick=\"" + "Table_Set_XianShi('" + ToHtmlID + "',this);\"" + " >显示</a>"
        + "<a onclick=\"" + "Table_Set_FenYe('" + ToHtmlID + "',this);\"" + " >分页</a>"
        + "<a onclick=\"" + "GuanXi(this,'" + ToHtmlID + "');\"" + " >关系</a>"
        + "<a onclick=\"" + "moban_set_liucheng(this,'" + ToHtmlID + "');\"" + " >流程</a>"
        + "<a onclick=\"" + "moban_set_quanxian(this,'" + ToHtmlID + "');\"" + " >权限</a>"
        + "<a onclick=\"" + "moban_set_Liyi(this,'" + ToHtmlID + "');\"" + " >利益</a>";

    NowToHtmlID.find('.headleft').html(nowhtml);
}
//==================================================================================改变字段显示列宽   
function chang_cols_width(ths, zhiduan, kd, ToHtmlID) { //改变列宽

    //alert(zhiduan);
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var re_id = NowToHtmlID.find('#sys_const_re_id').val() * 1;
    if (kd * 1 < 28) {
        kd = 28;
        $(ths).val(28);
    };
    $.post("moban_set_data.php", {
        act: "e_kd",
        kd: kd,
        zhiduan: zhiduan,
        ToHtmlID: ToHtmlID,
        re_id: re_id
    }, function (data) {
        UpdatePhp_Pc(re_id, 'B_moban_list'); //这里更新所有php生成文件并刷新 表头，loading 数据页
    }); //得到宽度值可录入数据库

    NowToHtmlID.find("#sys_const_q_h").val('0');
    NowToHtmlID.find(".tables ul").each(function () {
        $(this).find("li[name='" + zhiduan + "']").css({
            "width": kd + "px"
        });
    });
    NowToHtmlID.find("div.banner_left").css({
        "width": ""
    });
    NowToHtmlID.find("div.banner_left div.tables").css({
        "width": ""
    });
    NowToHtmlID.find("#" + ToHtmlID + "_content_left").css({
        "width": ""
    });
    NowToHtmlID.find("#" + ToHtmlID + "_content_left div.tables").css({
        "width": ""
    });
    //List_Head_Get(ToHtmlID)//加载表头
    //
}

function OpenSelectAct(SeAot) {
    if (SeAot != 'undefined') {
        $(".SeAtxianshi,.SeAtshuoding,.SeAttianjia,.SeAtxiugai,.SeAtjiami,.SeAtsousuo,.SeAtbitian,.SeAtWuchongfu").hide();
        $(SeAot).show();
        $('#addbox .headleft').html("<ul><li class='h_hou'  id='main_top_1'><i class='fa fa-lock-02'></i> 表单权限</li></ul>");
    };
}
//=============================================================================//设定
function Table_Set(ToHtmlID, ths) { //表单设计
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID, 'content_foot');
    var re_id = NowToHtmlID.find("#sys_const_re_id").val();
    var sys_guanxibiao_id = $("#" + ToHtmlID).attr('sys_guanxibiao_id'); //得到关系表里的id
    var GuanXi_id = $("#" + ToHtmlID).attr('GuanXi_id'); //得到对应关系re_id
    //Foot_Height(0.8, ToHtmlID);     //打开编辑的页面
    //main_top_menu('',ToHtmlID);//头部菜单生成
    SelectMenu($(ths).parent(), ths); //这里切换菜单样式
    NowToHtmlID_content_foot.find('.htmlleirong').html("<ul class='tagContent' style='padding-left:15px'><br><br>&nbsp;加载中...</ul>");
    $.get('moban_set.php', {
        act: "list",
        sys_guanxibiao_id: sys_guanxibiao_id,
        GuanXi_id: GuanXi_id,
        ToHtmlID: ToHtmlID,
        re_id: re_id
    }, function (data) {
        NowToHtmlID_content_foot.find('.htmlleirong').html("<ul id='tagContent' class='tagContent' style='overflow-y:auto'>" + data + "</ul>");
    }); //这里打开模版
    addboxbg('#footseid9', ToHtmlID);

    NowToHtmlID_content_foot.find('.htmlleirong').css("overflow-y", "auto"); //自动出现滚动条
}
//=============================================================================//设定  显示
function Table_Set_XianShi(ToHtmlID, ths) { //表单设计

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID, 'content_foot');
    var re_id = NowToHtmlID.find("#sys_const_re_id").val();
    var sys_guanxibiao_id = $("#" + ToHtmlID).attr('sys_guanxibiao_id'); //得到关系表里的id
    var GuanXi_id = $("#" + ToHtmlID).attr('GuanXi_id'); //得到对应关系re_id
    //Foot_Height(0.8, ToHtmlID);     //打开编辑的页面
    SelectMenu($(ths).parent(), ths); //这里切换菜单样式
    NowToHtmlID_content_foot.find('.htmlleirong').html("<ul class='tagContent' style='padding-left:15px'><br><br>&nbsp;加载中...</ul>");
    $.get('moban_set.php', {
        act: "xianshiquanxian",
        sys_guanxibiao_id: sys_guanxibiao_id,
        GuanXi_id: GuanXi_id,
        ToHtmlID: ToHtmlID,
        re_id: re_id
    }, function (data) {
        NowToHtmlID_content_foot.find('.htmlleirong').html("<ul id='tagContent' class='tagContent' style='overflow-y:auto'>" + data + "</ul>");
    }); //这里打开模版
    //addboxbg('#footseid9', ToHtmlID);
    NowToHtmlID_content_foot.find('.htmlleirong').css("overflow-y", "auto"); //自动出现滚动条
}
//=============================================================================//设定 分页
function Table_Set_FenYe(ToHtmlID, ths) { //分页
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID, 'content_foot');
    var re_id = NowToHtmlID.find("#sys_const_re_id").val();
    var sys_guanxibiao_id = $("#" + ToHtmlID).attr('sys_guanxibiao_id'); //得到关系表里的id
    var GuanXi_id = $("#" + ToHtmlID).attr('GuanXi_id'); //得到对应关系re_id
    //Foot_Height(0.8, ToHtmlID);     //打开编辑的页面
    if (ths) {
        SelectMenu($(ths).parent(), ths); //这里切换菜单样式
    }
    NowToHtmlID_content_foot.find('.htmlleirong').html("<ul class='tagContent' style='padding-left:15px'><br><br>&nbsp;加载中...</ul>");
    $.get('moban_set.php', {
        act: "xianshifenye",
        sys_guanxibiao_id: sys_guanxibiao_id,
        GuanXi_id: GuanXi_id,
        ToHtmlID: ToHtmlID,
        re_id: re_id
    }, function (data) {
        NowToHtmlID_content_foot.find('.htmlleirong').html("<ul id='tagContent' class='tagContent' style='overflow-y:auto'>" + data + "</ul>");
    }); //这里打开模版
    //addboxbg('#footseid9', ToHtmlID);
    NowToHtmlID_content_foot.find('.htmlleirong').css("overflow-y", "auto"); //自动出现滚动条

}
//=============================================================================//设定 分页
function Table_Set_FenYe_dragsort(ToHtmlID) { //分页
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID, 'content_foot');
    //var re_id = NowToHtmlID.find("#sys_const_re_id").val();
    //var sys_guanxibiao_id=$("#" + ToHtmlID).attr('sys_guanxibiao_id');                     //得到关系表里的id
    //var GuanXi_id=$("#" + ToHtmlID).attr('GuanXi_id');                 //得到对应关系re_id
    //Foot_Height(0.8, ToHtmlID);     //打开编辑的页面
    //alert(ToHtmlID);

    NowToHtmlID_content_foot.find('.ziduan_fenye ul.tr').dragsort({
        dragSelector: "li.conent", //改变的选中元素
        dragBetween: true,
        dragEnd: Table_Set_FenYe_dragsort_saveOrder, //拖动后执行函数
        //ToHtmlID:ToHtmlID,
        placeHolderTemplate: "<li class='conent conent_new'>...</li>", //拖动时显示的虚框
        scrollSpeed: 5 //滚动条速度
    });
    NowToHtmlID_content_foot.find('.ziduan_fenye ul li.head .yema').on("click", function () {
        $(this).parent().find('.del').show(500); //删除按钮出现
    });
    NowToHtmlID_content_foot.find('.ziduan_fenye ul li.head .del').on("click", function () {
        //alert('确定要删除么？');
        if (confirm("确定要删除么?")) {
            //alert('删除了');
            $(this).parents('ul.tr').remove(); //删除该页
            Table_Set_FenYe_ajax(ToHtmlID); //保存数据
            Table_Set_FenYe(ToHtmlID); //重新加载
            alert('删除成功！');
        } else {
            //alert('没删除');
        }
        $(this).parent().find('.del').hide(500); //删除按钮出现
    });
}
//=============================================================================//设定 分页保存
function Table_Set_FenYe_dragsort_saveOrder(ToHtmlID) { //分页
    //alert($(".tr li").length);
    //var data = $("#list1 li").map(function(){
    //return;
    //$(this).children().html();
    //}).get();
    //$("input[name=list1SortOrder]").val(data.join("|"));
    var ToHtmlID = $(this).parents('div.ziduan_fenye').attr('ToHtmlID');
    //alert(ToHtmlID);
    Table_Set_FenYe_ajax(ToHtmlID);
}
//=============================================================================//添加 分页
function Table_Set_FenYe_dragsort_ADD(ToHtmlID, ths) {
    alert(ToHtmlID);
    var nowlength = $(ths).parent('div').find('ul').length; //统计数据
    $(ths).before("<ul class='tr hoverthis'><li class='head'><div class='yema'>" + nowlength + "</div><div class='del'>×</div><input type='text' onchange='Table_Set_FenYe_ajax(" + ToHtmlID + ")' value='第" + nowlength + "页' /></li></ul>");
    //$(ths).parent('div').find('li.conent').unbind();//解绑所有事件
    //Table_Set_FenYe_dragsort(ToHtmlID);
    Table_Set_FenYe_ajax(ToHtmlID); //更新组信息
    Table_Set_FenYe(ToHtmlID);
}
//=============================================================================//处理 分页
function Table_Set_FenYe_ajax(ToHtmlID) {
    //alert(ToHtmlID);
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var re_id = NowToHtmlID.find("#sys_const_re_id").val();
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID, 'content_foot');
    var nowdiv = NowToHtmlID_content_foot.find('div.ziduan_fenye'); //找到主div  li.head input
    var sys_fenye = '';
    nowdiv.find('ul.tr').each(function (i) {
        var nowli = '';
        if (i > 0) {
            $(this).find('li.conent').each(function () {
                nowli += $(this).attr('title') + ',';
            });
        }
        sys_fenye += $(this).find('li.head input').val() + ':' + nowli + ';';
    });
    // alert(sys_fenye);
    $.post('moban_set_data.php', {
        act: "fenye_update",
        sys_fenye: sys_fenye,
        ToHtmlID: ToHtmlID,
        re_id: re_id
    }, function (data) {
        console.log(data);
        UpdatePhp_Pc(re_id); //更新生成页面动态文件
    }); //这里打开模版
}
//=============================================================================// 分页删除
function Table_Set_FenYe_dragsort_del(ToHtmlID, ths) { //分页

    var ToHtmlID = $(ths).parents('div.ziduan_fenye').attr('ToHtmlID');
    //alert(ToHtmlID);
    Table_Set_FenYe_ajax(ToHtmlID);
}
//==================================================================================底部设定上面的菜单   
function GuanXi(ths, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID, 'content_foot');
    var re_id = NowToHtmlID.find("#sys_const_re_id").val();
    var sys_guanxibiao_id = $("#" + ToHtmlID).attr('sys_guanxibiao_id'); //得到关系表里的id
    var GuanXi_id = $("#" + ToHtmlID).attr('GuanXi_id'); //得到对应关系re_id

    //Foot_Height(0.8, ToHtmlID);     //打开编辑的页面
    SelectMenu($(ths).parent(), ths); //这里切换菜单样式
    NowToHtmlID_content_foot.find('.htmlleirong').html("<ul class='tagContent' style='padding-left:15px'><br><br>&nbsp;加载中...</ul>");
    $.get('moban_set.php', {
        act: "GuanXi",
        sys_guanxibiao_id: sys_guanxibiao_id,
        GuanXi_id: GuanXi_id,
        ToHtmlID: ToHtmlID,
        re_id: re_id
    }, function (data) {
        NowToHtmlID.find('#tagContent').parent().css("overflow-y", "auto");
        NowToHtmlID_content_foot.find('.htmlleirong').html("<ul id='tagContent' class='tagContent'>" + data + "</ul>");

        $i = 0;
        NowToHtmlID_content_foot.find('.htmlleirong').find('.GuanXiTable').not('.GuanXiTable.adddiv').each(function () {
            $i++;
            if ($i < 10) {
                $i = '0' + $i;
            }
            $(this).find('li:first-child').text($i);
        });
    }); //这里打开模版
    //addboxbg('#footseid9', ToHtmlID);

    NowToHtmlID_content_foot.find('.htmlleirong').css("overflow-y", "auto"); //自动出现滚动条

}
//=============================================================================//设定
function moban_set_edit(ths, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID, 'content_foot'); //底部
    var re_id = NowToHtmlID.find("#sys_const_re_id").val();
    var sys_guanxibiao_id = $("#" + ToHtmlID).attr('sys_guanxibiao_id'); //得到关系表里的id
    var GuanXi_id = $("#" + ToHtmlID).attr('GuanXi_id'); //得到对应关系re_id
    SelectMenu($(ths).parent(), ths);
    NowToHtmlID_content_foot.find('.htmlleirong').html("<ul class='tagContent' style='padding-left:15px'><br><br>&nbsp;加载中...</ul>");
    Foot_Height(0.8, ToHtmlID); //打开编辑的页面
    main_top_menu('', ToHtmlID); //头部菜单生成
    $.get('moban_set.php', {
        act: "jbsd",
        re_id: re_id,
        ToHtmlID: ToHtmlID,
        sys_guanxibiao_id: sys_guanxibiao_id,
        GuanXi_id: GuanXi_id
    }, function (data) {
        NowToHtmlID_content_foot.find('.htmlleirong').html("<ul id='tagContent' class='tagContent' >" + data + "</ul>");
    }); //这里打开模版
    //addboxbg('#footseid9', ToHtmlID);
}
//=============================================================================//权限
function moban_set_quanxian(ths, ToHtmlID){
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID, 'content_foot'); //底部
    var re_id = NowToHtmlID.find("#sys_const_re_id").val();
    var sys_guanxibiao_id = $("#" + ToHtmlID).attr('sys_guanxibiao_id'); //得到关系表里的id
    var GuanXi_id = $("#" + ToHtmlID).attr('GuanXi_id'); //得到对应关系re_id
    SelectMenu($(ths).parent(), ths);
    //Foot_Height(0.8, ToHtmlID);     //打开编辑的页面

    $.get('moban_set.php', {
        act: "moban_set_quanxian",
        re_id: re_id,
        ToHtmlID: ToHtmlID,
        sys_guanxibiao_id: sys_guanxibiao_id,
        GuanXi_id: GuanXi_id
    }, function (data) {
        console.log(JSON.parse(data))
        data = JSON.parse(data)
        if(data.error){
            alert(data.error)
        }else{
            let divDom = $('<div>').addClass('quanxianList')
            createTemplateHeaderName(divDom)
            var contentBox = $('<div>').addClass('contentBox')
            var i = 0
            data.data.forEach((item) => {

                // console.log(item)
                var contentDiv = $('<div>').addClass('zhiweicontentBox')
                contentDiv.append($('<div>').addClass('zhiweicontentName').append($('<div>').text(item.zu + ':')))

                createTemplateFanweiSelect(item.sys_q_fanwei,contentDiv,data.modRoles,item,() => {
                    moban_set_quanxian(ths, ToHtmlID)
                })
                createTemplateQuanXianCheckbox(item,contentDiv,data.modRoles,() => {
                    moban_set_quanxian(ths, ToHtmlID)
                })
                if(i%2){
                    contentDiv.addClass('zhiweicontentBoxOdd')
                }else{
                    contentDiv.addClass('zhiweicontentBoxEven')
                }
                i++
                contentBox.append(contentDiv)

            })
            divDom.append(contentBox)

            NowToHtmlID_content_foot.find('.htmlleirong').html($("<ul id='tagContent' class='tagContent' ></ul>").append(divDom).append($('<div>').addClass('Placeholder')));
        }
    }); //这里打开模版
    //addboxbg('#footseid9', ToHtmlID);
}
function createTemplateHeaderName(divDom) {
    var headerName = ['职位  ','管辖范围','查看','编制人','修订人','审核人','批准人','经办人','删除','回收','打印','销毁','设置','全选']

    var headerBox = $('<div>').addClass('zhiweiHeader')
    headerName.forEach((item,index) => {
        var headerDiv = $('<div>').addClass('zhiweiHeaderName').text(item)
        switch (index) {
            case 0:
                headerDiv.addClass('zhiweiName')
                break;
            case 1:
                headerDiv.addClass('fanweiName')
                break;
            case 13:
                headerDiv.addClass('selectAll')
                break;
            default:
                headerDiv.addClass('zhiquanRow')
                break;
        }
        headerBox.append(headerDiv)
    })
    divDom.append(headerBox)
}
function createTemplateFanweiSelect(selectedIndex,contentDiv,modRoles,data,fun) {
    const fanweiName = ['个人', '部门', '公司', '集团'];

    if(modRoles.includes(data.id)){
        const options = fanweiName.map((item, index) => {
            if((data.permissionControl && data.permissionControl.fanwei >= index) || !index){
                return `<option value="${index}" ${index == selectedIndex ? 'selected' : ''}>${item}</option>`;
            }else{
                return ''
            }
        });
    
        var fanweiNameBox = $('<select>').html(options.join('')).on('change ',function(){
            $.post('moban_set_data.php',{
                act:'Edit_ZWquanxian_Update_new',
                data:{
                    checked:$(this).val(),
                    id:data.id,
                    checkName:'sys_q_fanwei'
                }
            },function(data){
                // console.log(JSON.parse(data))
                // console.log(data)
                fun()
            })
        });
    } else {
        const options = fanweiName.map((item, index) => {
            return `<option value="${index}" ${index == selectedIndex ? 'selected' : ''}>${item}</option>`;
        });
    
        var fanweiNameBox = $('<select>').html(options.join('')).addClass('Disable');

        fanweiNameBox.on('mousedown',function(event){
            event.preventDefault();
            event.stopPropagation();
        })
    }

    contentDiv.append($('<div>').addClass('fanweiSelect').append(fanweiNameBox))
}
function createTemplateQuanXianCheckbox(data, contentDiv, modRoles,fun) {
    const fields_to_check = [
        'sys_q_cak', 'sys_q_tianj',
        'sys_q_xiug', 'sys_q_shenghe', 'sys_q_pizhun',
        'sys_q_zhixing', 'sys_q_shanc', 'sys_q_huis',
        'sys_q_dayin', 'sys_q_xiaohui', 'sys_q_seid'
    ];
    var i = 0
    var j = 0
    const checkboxes = fields_to_check.map((item) => {
        const isChecked = data[item];
        var Dom =  $('<div>').addClass('QuanXianCheckbox').append($('<input />', {
            class: `QuanXianCheck zhiquanRow Disable ${item}`,
            type: 'checkbox',
            checked: isChecked
        }))
        if(data.permissionControl && modRoles.includes(data.id) && data.permissionControl.quanxian.includes(item)){
            i++
            if(Dom.find('.QuanXianCheck').prop('checked')){
                j++
            }
            Dom.find('.QuanXianCheck').removeClass('Disable').on('click',function(){
                var checkbox = $(this).prop('checked') //因为点击会改变元素
                var div = $(this).parent().parent().find('div')
                if(checkbox){
                    // data.permissionControl.quanxian.forEach((item) => {
                    //     console.log($(this).parent().parent().find('div').find(`.${item}`).prop('checked'))
                    // })
                    div.find('.zhiquanRowAll').attr('checked',div.find(`${"." + data.permissionControl.quanxian.join(",.")}`).toArray().every(function(checkbox) {
                        return $(checkbox).prop('checked');
                    }))
                }else{
                    // data.permissionControl.quanxian.forEach((item) => {
                    //     console.log($(this).parent().parent().find('div').find(`.${item}`).prop('checked'))
                    // })
                    $(this).parent().parent().find('div').find('.zhiquanRowAll').attr('checked',checkbox)
                }
                $.post('moban_set_data.php',{
                    act:'Edit_ZWquanxian_Update_new',
                    data:{
                        checked:$(this).prop('checked'),
                        id:data.id,
                        checkName:item
                    }
                },function(data){
                    // console.log(data)
                    // console.log(JSON.parse(data))
                    fun()
                })
            })
        }else{
            Dom.find('.QuanXianCheck').on('click',function(event){
                event.preventDefault();
                event.stopPropagation();
            })
        }

        return Dom;  
    });

    // 创建并追加最后一个复选框，并设置其选中状态
    const selectAllCheckbox = $('<div>').addClass('QuanXianCheckbox').append($('<input />', {
        class: 'QuanXianCheck zhiquanRowAll Disable',
        type: 'checkbox',
        // checked: checkboxes.every(checkbox => checkbox.find('.QuanXianCheck').prop('checked'))
        checked: data.permissionControl && j == data.permissionControl.quanxian.length
    }))
    if(i){
        selectAllCheckbox.find('.zhiquanRowAll').removeClass('Disable').on('click',function(){
            var checkbox = $(this).prop('checked') //因为点击会改变元素
            $(this).parent().parent().find('div').find(`${"." + data.permissionControl.quanxian.join(",.")}`).attr('checked',checkbox)

            //将所有有权限的权限修改
            $.post('moban_set_data.php',{
                act:'Edit_ZWquanxian_Update_new',
                data:{
                    checked:$(this).prop('checked'),
                    id:data.id,
                    checkName:'sys_q_all'
                }
            },function(data){
                // console.log(data)
                // console.log(JSON.parse(data))
                fun()
            })
        })
    }else{
        selectAllCheckbox.find('.zhiquanRowAll').on('click',function(event){
            event.preventDefault();
            event.stopPropagation();
        })
    }

    contentDiv.append(checkboxes).append(selectAllCheckbox);
}
//=============================================================================//流程   
function moban_set_liucheng(ths, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID, 'content_foot'); //底部
    $(ths).parent().find('.selectTag').removeClass('selectTag')
    $(ths).addClass('selectTag')
    var re_id = NowToHtmlID.find("#sys_const_re_id").val();
    NowToHtmlID_content_foot.find('.htmlleirong').html(`
        <ul id='tagContent' class='tagContent' >
            <div class="LiuCheng_box">
                <div class="LiuCheng_top">
                    <div class="LiuCheng_button">新建流程</div>
                </div>
                <div class="LiuCheng_content">
                    <br>&nbsp;加载中...
                </div>   
                <div class='LiuCheng_search'>
                    <div class="search_box">
                        <div class="search">
                            <div class="search_input_box">
                                <input class="search_input" placeholder="关键字"/>
                                <div class="search_del"></div>
                            </div>
                            <div class="search_button">
                            </div>
                        </div>
                    </div>
                    <div class="main_right_div_box"></div>
                </div> 
            </div>
        </ul>
    `);
    
    var htmlLeirong = NowToHtmlID_content_foot.find('.htmlleirong');
    var searchButton = NowToHtmlID_content_foot.find('.search_button');
    var searchInput = NowToHtmlID_content_foot.find('.search_input');
    
    LiuCheng_search(htmlLeirong);
    
    searchButton.on('click', function() {
        LiuCheng_search(htmlLeirong, searchInput.val());
    });
    
    searchInput.on('keydown', function(event) {
        if (event.which === 13) {
            LiuCheng_search(htmlLeirong, searchInput.val());
        }
    });
    $.get('moban_set.php', {
        act: "moban_set_liucheng",
        re_id: re_id,
    }, function (data) {
        data=JSON.parse(data)
        // console.log(data)
        // var data = 
        // {
        //     re_id:256,
        //     sys_card:'SYS云帐户',
        //     data:false
        //     // [
        //     //     {
        //     //         LiuChengName:'流程1',
        //     //         re_id:0,
        //     //         LiuCheng:
        //     //         [
        //     //             {
        //     //                 re_id:190,
        //     //                 sys_card:'总过程清单'
        //     //             },
        //     //             {
        //     //                 re_id:192,
        //     //                 sys_card:'员工满意度调查计划'
        //     //             },
        //     //             {
        //     //                 re_id:256,
        //     //                 sys_card:'SYS云帐户'
        //     //             },
        //     //             {
        //     //                 re_id:258,
        //     //                 sys_card:'SYS云职责权限帐户'
        //     //             }
        //     //         ]
        //     //     },
        //     //     {
        //     //         LiuChengName:'流程2',
        //     //         re_id:1,
        //     //         LiuCheng:
        //     //         [
        //     //             {
        //     //                 re_id:190,
        //     //                 sys_card:'总过程清单'
        //     //             },
        //     //             {
        //     //                 re_id:192,
        //     //                 sys_card:'员工满意度调查计划'
        //     //             },
        //     //             {
        //     //                 re_id:256,
        //     //                 sys_card:'SYS云帐户'
        //     //             },
        //     //             {
        //     //                 re_id:258,
        //     //                 sys_card:'SYS云职责权限帐户'
        //     //             }
        //     //         ]
        //     //     }
        //     // ]
        // }
        NowToHtmlID_content_foot.find('.LiuCheng_content').html(liucheng_generate(data.data,re_id));
        NowToHtmlID_content_foot.find('.LiuCheng_button').on('click',function(){
            if(NowToHtmlID_content_foot.find('.LiuCheng_undone').length == 0){
                newProcess($(this),data,re_id)
                $('.LiuCheng_hint').remove()
            }
        });
    }); //这里打开模版
}
function LiuCheng_search(ths,nowkeyword=''){
    $.get('B_menu_desk_list.php', {
        act: "list3",
        nowkeyword
    }, function (data) {
        $(ths).find('.main_right_div_box').html(data)
    })
}
function liucheng_generate(data,my_re_id){
    if(!data.length){
        return `
            <div class="LiuCheng_hint">请添加相关的流程!</div>
        `
    }else{
        return data.map(item => {
            var LiuChengName = item.LiuChengName
            var div = item.LiuCheng.map(ele => {
                return `<div class="LiuCheng_unit" name="${ele.re_id}">${ele.sys_card}</div>`
            }).join(`<div class="LiuCheng_sign"><i class="fa fa-zhuanyi"></i></div>`)
            return LiuCheng_unit_div(item.re_id,LiuChengName,div,{name:'编辑',onclick:`LiuCheng_unit_edit(this,${my_re_id})`},true)
        }).join('')
    }
}
function ADDLiuCheng(idx,name = 0){
    list = [`<div class="LiuCheng_unit" name='${name}' callback="${idx}">添加流程</div>`,`<div class="LiuCheng_sign"><i class="fa fa-jiahao"></i></div>`]
    return list[idx]+list[(idx+1)%2]
}
function ADDLiuCheng_dom(idx,re_id){
    var item = $(ADDLiuCheng(idx,re_id))
    item.filter('.LiuCheng_unit').off().on('click', function(){
        ADDLiuCheng_course($(this),re_id)
    })
    item.filter('.LiuCheng_sign').on('click',function(){
        LiuCheng_sign_aftermath($(this))
    })
    return item
}
function ADDLiuCheng_plan(ths,re_id){
    var dom = $(ths).parent()
    var idx = $(ths).attr('callback')
    var div = ADDLiuCheng_dom(idx*1,re_id)
    if(idx == 1){
        dom.append(div)
    }else{
        dom.prepend(div)
    }
    $(ths)
}
function ADDLiuCheng_course(ths,re_id){
    $(ths).addClass('LiuCheng_choose')
    // console.log()
    $('.LiuCheng_search').show() 
}
function newProcess(ths,data,re_id){
    var div = `<div class="LiuCheng_unit" name='${data.re_id}'>${data.sys_card}</div>`
    var dom = $(LiuCheng_unit_div(0,"",div,{name:'确定',onclick:`LiuCheng_save_edits(this,${re_id})`})).get(0)
    $(ths).parent().parent().find('.LiuCheng_content').append(dom)
    LiuCheng_unit_edit($(dom).find('.LiuCheng_unit_edit'),data.re_id)
}
function LiuCheng_save_edits(ths,re_id){
    var LiuCheng_unit_box = $(ths).closest('.LiuCheng_unit_box')
    if(LiuCheng_unit_box.find('.LiuCheng_unit_name').val().trim() === ''){
        alert('流程名称不能为空!!!')
        return ;
    }
    $(ths).text('编辑').off().on('click',function(){
        LiuCheng_unit_edit($(ths),re_id)
    })
    $(ths).prev().remove()
    LiuCheng_unit_box.find('.LiuCheng_unit_name').attr('readonly',true)
    LiuCheng_unit_box.find('.LiuCheng_unit_del').remove()
    LiuCheng_unit_box.find('.LiuCheng_sign').html('<i class="fa fa-zhuanyi">').off()
    LiuCheng_unit_box.removeClass('LiuCheng_undone')
    LiuCheng_unit_box.find('.LiuCheng_unit[name="0"]').each(function(index, element) {
        if(index){
            $(this).prev().remove();
        }else{
            $(this).next().remove();
        }
        $(this).remove()  
    });
    FlowLink = LiuCheng_unit_box.find('.LiuCheng_unit').off().draggable('destroy').droppable('destroy').map(function(){
        return $(this).attr('name')
    }).get()
    data={
        LiuChengName:LiuCheng_unit_box.find('.LiuCheng_unit_name').val(),
        FlowLink   
    }
    $.get('moban_set.php', {
        act: "liucheng_save",
        re_id:LiuCheng_unit_box.attr('re_id'),
        data
    }, function (data) {
        data = JSON.parse(data)
        if(data.error){
            alert(data.error)
        }else{
            if(LiuCheng_unit_box.attr('re_id') == 0){
                LiuCheng_unit_box.attr('re_id',data.LiuCheng_id)
            }else{

            }
        }
    })
}
function LiuCheng_unit_div(re_id,LiuChengName,div,button,editable=false){
    return `
        <div re_id="${re_id}" class="LiuCheng_unit_box ${editable?'':'LiuCheng_undone'}">
            <div class="LiuCheng_unit_top">
                <input class="LiuCheng_unit_name" ${editable?'readonly':''} placeholder="流程名称" value="${LiuChengName}" />
                <div class="LiuCheng_unit_edit_box">
                    <div class="LiuCheng_unit_edit" onclick="${button.onclick}">${button.name}</div>
                </div>
            </div>
            <div class="LiuCheng_unit_hr_box"><div class="LiuCheng_unit_hr"></div></div>
            <div class="LiuCheng_unit_box_inside">${div}</div>
        </div>
    `
}
function LiuCheng_unit_edit(ths,re_id){
    $(ths).text('确定').attr('onclick','').off().on('click',function(){
        LiuCheng_save_edits(ths,re_id)
    })
    LiuCheng_addDelBut_box($(ths))
    var dom = $(ths).closest('.LiuCheng_unit_box')
    dom.find('.LiuCheng_unit').each(function() {

        var name = $(this).attr('name')
        if(name != re_id){
            $(this).off().on('click', function(){
                ADDLiuCheng_course($(this),re_id)
            })
            LiuCheng_addDelBut_nuit($(this))
        }
        LiuChengTuoDong($(this))
    });

    dom.find('.LiuCheng_unit_name').attr('readonly',false)
    dom.find('.LiuCheng_sign').html('<i class="fa fa-jiahao">').on('click',function(){
        LiuCheng_sign_aftermath($(this))
    })
    var div = dom.find('.LiuCheng_unit_box_inside')
    div.append(ADDLiuCheng_dom(1,0))
    div.prepend(ADDLiuCheng_dom(0,0))
}
function LiuChengTuoDong(ths){
    ths.draggable({
        cursor: 'move',
        revert: 'invalid',  // 如果拖动未放置在有效的目标上，则还原到初始位置
        helper: 'clone',    // 创建拖动时的克隆元素
        start: function(event, ui) {
            // 在拖动开始时执行的逻辑
            // 这里可以添加一些代码，例如记录初始位置等
            // ths.hide()
        },
        stop: function(event, ui) {
            // 在拖动结束时执行的逻辑
            // 显示原本的标签
            // ths.show();
            const droppedElement = ui.helper;  // 获取拖动时的克隆元素
            ths.attr('name',droppedElement.attr('name'))
            ths.html(droppedElement.html())
        }
    }).droppable({
        accept: '.LiuCheng_unit',  // 指定可接受的元素
        drop: function(event, ui) {
            // 在元素放置时执行的逻辑
            // 这里可以添加一些代码，例如处理交换位置的逻辑
            const droppedElement = ui.helper;  // 获取拖动时的克隆元素

            // 在这里添加检查是否有可交换元素的逻辑
            // 示例：如果有可交换元素，则输出目标元素的信息
            if(droppedElement.closest('.LiuCheng_unit_box').attr('re_id') == ths.closest('.LiuCheng_unit_box').attr('re_id')){
                var re_id1 = droppedElement.attr('name')
                var html1 = droppedElement.html()
                droppedElement.attr('name',ths.attr('name'))
                droppedElement.html(ths.html())
                ths.attr('name',re_id1)
                ths.html(html1)
            }else{
                // console.log('不在一个区域')
            }
        }
    })
}
function LiuCheng_sign_aftermath(ths){
    var item = ADDLiuCheng_dom(1,-1)
    $(ths).before(item)
    item.filter('.LiuCheng_unit').click()
    // item.filter('.LiuCheng_sign').on('click',function(){
    //     LiuCheng_sign_aftermath($(this))
    // })
}
function LiuCheng_addDelBut_nuit(ths){
    var del = $('<div class="LiuCheng_unit_del">X</div>')
    del.on('click',function(){
        $(this).parent().next().remove()
        $(this).parent().remove()
    })
    $(ths).append(del)
}
function LiuCheng_addDelBut_box(ths){
    var del = $('<div class="LiuCheng_unit_box_del">删除</div>')
    del.on('click',function(){
        if(confirm('你确定要删除么?')){
            var dom = $(this).closest('.LiuCheng_content')
            var re_id = $(this).closest('.LiuCheng_unit_box').attr('re_id')
            if(re_id != 0 ){
                console.log(re_id)
                $.get('moban_set.php', {
                    act: "liucheng_del",
                    re_id
                },function(data)
                {
                    console.log(data)
                })
            }
            $(this).closest('.LiuCheng_unit_box').remove()
            LiuCheng_del_examine(dom)
        }
    })
    $(ths).before(del)
}
function LiuCheng_del_examine(ths){
    if(ths.find('.LiuCheng_unit_box').length === 0){
        ths.append($('<div class="LiuCheng_hint">请添加相关的流程!</div>'))
    }
}
function LiuCheng_choose(newRe_id,sys_card){
    let dom = $('.LiuCheng_choose')
    LiuChengTuoDong(dom)
    if(dom.attr('name') == 0){
        ADDLiuCheng_plan(dom,0)
    }
    dom.text(sys_card).removeClass('LiuCheng_choose').attr('name',newRe_id)
    LiuCheng_addDelBut_nuit(dom)
    $('.LiuCheng_search').hide()
    //在数据库修改数据
    // const dom2 = dom.parent().find('.LiuCheng_unit')     
}
//=============================================================================//利益
function moban_set_Liyi(ths, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID, 'content_foot'); //底部
    var re_id = NowToHtmlID.find("#sys_const_re_id").val();

    var sys_guanxibiao_id = $("#" + ToHtmlID).attr('sys_guanxibiao_id'); //得到关系表里的id
    var GuanXi_id = $("#" + ToHtmlID).attr('GuanXi_id'); //得到对应关系re_id
    SelectMenu($(ths).parent(), ths);
    //Foot_Height(0.8, ToHtmlID);     //打开编辑的页面
    NowToHtmlID_content_foot.find('.htmlleirong').html("<ul class='tagContent' style='padding-left:15px'><br><br>&nbsp;加载中...</ul>");
    $.get('moban_set.php', {
        act: "moban_set_Liyi",
        re_id: re_id,
        ToHtmlID: ToHtmlID,
        sys_guanxibiao_id: sys_guanxibiao_id,
        GuanXi_id: GuanXi_id
    }, function (data) {

        NowToHtmlID_content_foot.find('.htmlleirong').html("<ul id='tagContent' class='tagContent' >" + data + "</ul>");
    }); //这里打开模版
    //addboxbg('#footseid9', ToHtmlID);
}
//=============================================================================//利益更新
function JiangFaUpdate(ths, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID, 'content_foot'); //底部
    var re_id = NowToHtmlID.find("#sys_const_re_id").val();
    //var sys_guanxibiao_id=$("#" + ToHtmlID).attr('sys_guanxibiao_id');          //得到关系表里的id
    //var GuanXi_id=$("#" + ToHtmlID).attr('GuanXi_id');                          //得到对应关系re_id
    var sys_jiangli_rmb = '';
    $(ths).parents('div.NowULTable').find('ul input[name="sys_jiangli_rmb"]').each(function () {
        $thisval = $(this).val();
        if ($thisval == '') {
            $thisval = 0;
        };
        sys_jiangli_rmb += $thisval + ',';
    });

    var sys_jiangli_jifen = '';
    $(ths).parents('div.NowULTable').find('ul input[name="sys_jiangli_jifen"]').each(function () {
        $thisval = $(this).val();
        if ($thisval == '') {
            $thisval = 0;
        };
        sys_jiangli_jifen += $thisval + ',';
    });

    var sys_chufa_rmb = '';
    $(ths).parents('div.NowULTable').find('ul input[name="sys_chufa_rmb"]').each(function () {
        $thisval = $(this).val();
        if ($thisval == '') {
            $thisval = 0;
        };
        sys_chufa_rmb += $thisval + ',';
    });

    var sys_chufa_jifen = '';
    $(ths).parents('div.NowULTable').find('ul input[name="sys_chufa_jifen"]').each(function () {
        $thisval = $(this).val();
        if ($thisval == '') {
            $thisval = 0;
        };
        sys_chufa_jifen += $thisval + ',';
    });
    //alert(sys_jiangli_rmb);alert(sys_jiangli_jifen);alert(sys_chufa_rmb);alert(sys_chufa_jifen);

    $.post('moban_set_data.php', {
        act: "JiangFaUpdate",
        re_id: re_id,
        sys_jiangli_rmb: sys_jiangli_rmb,
        sys_jiangli_jifen: sys_jiangli_jifen,
        sys_chufa_rmb: sys_chufa_rmb,
        sys_chufa_jifen: sys_chufa_jifen,
        ToHtmlID: ToHtmlID
    }, function (data) {
        //alert(data);
    }); //这里打开模版
    //addboxbg('#footseid9', ToHtmlID);
}
//=============================================================================//记事本加载我的工作
function edit_Text(ths, ToHtmlID) {
    //$("<link>").attr({rel: "stylesheet",type: "text/css",href: "../style/menuedit.css"}).appendTo("head");
    addboxbg('.footseid18', ToHtmlID);
    addbox(0.9, AjaxLoad('Note_moban_set.php', "edit_Text", '#addbox .htmlleirong #tagContent', '', 'GET', ToHtmlID), 'open', $(document).width() * 0.38, ToHtmlID);
    $("#addbox").css({
        "right": 0,
        "left": "auto",
        "bottom": "0px",
        "z-index": "1000"
    });
    $('#addbox .headleft').html('<ul><li class="h_333" id="main_top_5">&nbsp;&nbsp;&nbsp;工作计划</li></ul>');

}
function chatmsg(ToHtmlID, postform) //调整对话框高度
{
    //alert(ToHtmlID);
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID, 'content_foot');
    var postformheight = NowToHtmlID_content_foot.height() - 120;
    //alert(postformheight);
    NowToHtmlID_content_foot.find('#' + postform + ' .chatmsg').height(postformheight);
    NowToHtmlID_content_foot.find('#' + postform + ' .chatmsg').scrollTop($('#' + postform + ' .chatmsg')[0].scrollHeight);
    NowToHtmlID_content_foot.find('#' + postform + ' .inputmsg').focus();
}
//=========================================================================================================分页
function FpageRO(ths, pageID, JJ, ToHtmlID) {
    //alert(page+"_"+xt+"_"+TSdivID);
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'foot'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var pages = NowToHtmlID.find(pageID).val() * 1 + JJ; //页码数
    //alert(pages);
    Fpage(pages, 0, ToHtmlID); //这里执行分页；
}
//=========================================================================================================分页
function Fpage(page, xt, ToHtmlID) //分页函数蓝1368(|< < > >|)  灰2457(有页数)
{
    //alert(page+"_"+xt+"_"+TSdivID);
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var maxpage = NowToHtmlID.find("#page_v").attr("pgc") * 1;
    NowToHtmlID.find(".head #sys_const_page").val(page); //头部页码同步
    NowToHtmlID.find("#page_v").val(page);
    //alert(maxpage);
    NowToHtmlID.find("#pagenaxt1,#pagenaxt2,#pagenaxt3,#pagenaxt4,#pagenaxt5,#pagenaxt6,#pagenaxt7,#pagenaxt8").hide();
    if (page <= 0) {
        NowToHtmlID.find("#pagenaxt2,#pagenaxt4,#pagenaxt5,#pagenaxt7").show();
    } else if (page == 1 && maxpage == 1) {
        NowToHtmlID.find("#pagenaxt2,#pagenaxt4,#pagenaxt5,#pagenaxt7").show();
    } else if (page == 1 && maxpage > 1) {
        NowToHtmlID.find("#pagenaxt2,#pagenaxt4,#pagenaxt6,#pagenaxt8").show();
    } else if (page > 1 && page < maxpage) {
        NowToHtmlID.find("#pagenaxt1,#pagenaxt3,#pagenaxt6,#pagenaxt8").show();
    } else if (page > 1 && page >= maxpage) {
        NowToHtmlID.find("#pagenaxt1,#pagenaxt3,#pagenaxt5,#pagenaxt7").show();
    } else {
        NowToHtmlID.find("#pagenaxt2,#pagenaxt4,#pagenaxt5,#pagenaxt7").show();
    }
    if (xt != "ok") {
        LoodingDiv(ToHtmlID); //
        ListGet(ToHtmlID); //加载数据
    };

    shuqianmenu_user_update(this, ToHtmlID); //更新记忆功能
}
//===============================================================================输入跳转页限制
function duibi(thstitle, a, ths) {

    var bvlue = $(ths).val();
    $(ths).val($(ths).val().replace(/\D/g, '')); //只允许输入数字
    if ($(ths).val() * 1 <= 0) {
        $(ths).val('1');
    }; //$("#page_v").select();
    if ($(ths).val() * 1 > a * 1) {
        alert("不得超过最大页“" + a + "”！请重输。");
        $(ths).attr({
            "cs": thstitle,
            "pgc": a,
            "value": thstitle
        });
    } //$("#page_v").select();
}
//===============================================================================选中取消整个div等中选复选框
function selectGroup(ths, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    NowToHtmlID.find('input[name="ID"]').prop('checked', $(ths).prop('checked'));
    //$("#" + ToHtmlID + " " + obj).prop('checked', $(ths).prop('checked'));
}
//===============================================================================搜索
function searchnow(ths, ToHtmlID) {
    //alert(ToHtmlID);

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    //$(ths).parents('.head').find('#'+ToHtmlID+'_content_right_menu').hide();
    $(ths).parents('.head').find('#searchbox').removeClass("searchboxover"); //这里将搜索框去特效边框
    NowToHtmlID.find("#page_v").val('1');
    shuqianmenu_user_update(ths, ToHtmlID); //更新记忆功能
    //alert(ToHtmlID);
    LoodingDiv(ToHtmlID);
    ListGet(ToHtmlID); //加载数据
    List_Page_Get(ToHtmlID); //分页
    //looddata(10,ToHtmlID);
}
//===============================================================================输入框内绑定enter键
function keyths(ths, ToHtmlID, event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == 13) {
        $(ths).parents('.head').eq(0).find('.button_img').click();
    };
    $(ths).parents('.head').eq(0).find('#searchbox').removeClass("searchboxover").addClass("searchboxover"); //这里将搜索框去特效边框

}
//===============================================================================下拉加载 放入输入框时执行
function xialaload(ths, ToHtmlID) {
    //alert(ToHtmlID);
    $(ths).parents('.head').find("#searchbox").addClass("searchboxover");
    keyword_All = 1;
}
//===============================================================================下拉打开关闭
function xialashow(ths, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    if (NowToHtmlID.find('#' + ToHtmlID + '_content_right_menu').css('display') == 'none') {
        NowToHtmlID.find('#' + ToHtmlID + '_content_right_menu').show(100);
    } else {
        NowToHtmlID.find('#' + ToHtmlID + '_content_right_menu').hide(50);
    } 

    AjaxLoad('B_moban_xiala.php', 'content_right_menu', '#' + ToHtmlID + '_content_right_menu', '', 'GET', ToHtmlID);
    //$(ths).parents('.head').find('#'+ToHtmlID+'_content_right_menu').show();
}

//===============================================================================下拉打开关闭
function xialaclose(ths, ToHtmlID) {
    var parentdiv = $(ths).parents("#" + ToHtmlID + "_content_right_menu"); //父框架
    $(parentdiv).attr('biaoqian_xiugai',null)
    //$(ths).css("overflow","visible");
    $(ths).parents('#' + ToHtmlID + '_content_right_menu').hide(300);
}


//===============================================================================清除筛选
function clearsearch(ths, ToHtmlID) {

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02

    NowToHtmlID.find('.head #zu').val(0); //分类
    NowToHtmlID.find('.head #sys_const_id_bumen').val(0); //部门
    NowToHtmlID.find(".head #sys_const_page").val('1'); //页码
    NowToHtmlID.find(".head #sys_const_adddate").val(''); //时间
    NowToHtmlID.find(".head #sys_const_pok").val('0'); //排序
    NowToHtmlID.find(".head #ShaiXuanSql_other").val(''); //SQL
    NowToHtmlID.find(".head #sys_const_bh").val(''); //编制人 9001
    NowToHtmlID.find(".head #sys_const_shenpi").val(''); //审核人
    NowToHtmlID.find(".head #sys_const_shenpi_all").val(''); //批准人
    NowToHtmlID.find(".head #sys_const_chaosong").val(''); //经办人
    NowToHtmlID.find(".head #keyword").val(''); //关键词
    NowToHtmlID.find(".head #sys_const_biaoqian_id").val('0'); //选择的标签ID
    NowToHtmlID.find(".head .TONGJI_search").html('<i class="fa fa-25-02"></i>筛选<font color="red" style="padding-left:3px;padding-right:3px;"><strong>(0)</strong></font>'); //筛选重置
    //alert(ToHtmlID);
    LoodingDiv(ToHtmlID);
    ListGet(ToHtmlID); //加载数据
    List_Page_Get(ToHtmlID); //分页
    shuqianmenu_user_update(ths, ToHtmlID); //更新记忆功能
    //-------------------------------------------------清除选中状态
    $(ths).parents("#" + ToHtmlID + "_content_right_menu").find('i.fa-25-02').parent().html('<i class="fa fa-21-1"></i>'); //清除左侧选中标识
    $(ths).parents("#" + ToHtmlID + "_content_right_menu").find('i.fa-gou').remove(); //清除右侧选中标识
    $(ths).parents("#" + ToHtmlID + "_content_right_menu").find('.menucheckded').removeClass('menucheckded'); //去除选中样式
    //-------------------------------------------------默认选中

    $(ths).parents("#" + ToHtmlID + "_content_right_menu").find('.right #sys_other li:first-child').addClass('menucheckded').append("<i class='fa fa-gou fa_margrin_right'></i>"); //去除选中样式sys_other
    $(ths).parents("#" + ToHtmlID + "_content_right_menu").find('.right #sys_other input[type="checkbox"]').attr("checked", false); //去除选中样式sys_other
    NowToHtmlID.find('.head .ShuQianMenu li').removeClass('selectTag'); //清除标签选择
    NowToHtmlID.find('.head .ShuQianMenu li#0').addClass('selectTag'); //选择“全部”标签
}

//===============================================================================分类菜单
function zuchange_menu(ths, ToHtmlID) {
    //alert(ToHtmlID);
    //var NowToHtmlID =DIVHtmlID(ToHtmlID,'fanall');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var thiszdname = $(ths).attr("name"); //得到字段 name
    //alert(thiszdname);
    if (thiszdname != '') { //这里为分类选中时
        //$(ths).parents('#'+ToHtmlID+'_content_right_menu').find('.right ul').hide();
        $(ths).parents('#' + ToHtmlID + '_content_right_menu').find('.right ul#' + thiszdname).toggle();
        $(ths).parents('#zulist').find('li').removeClass('menucheckded');
        $(ths).addClass('menucheckded');
    }
}
//===============================================================================分类菜单
function shuqianmenu(ths, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    if (NowToHtmlID.find('#' + ToHtmlID + '_content_right_menu').css('display') == 'none') {
        NowToHtmlID.find('#' + ToHtmlID + '_content_right_menu').show(100);
    } else {
        NowToHtmlID.find('#' + ToHtmlID + '_content_right_menu').hide(50);
    }
    AjaxLoad('B_moban_xiala.php', 'shuqianmenu', '#' + ToHtmlID + '_content_right_menu', '', 'GET', ToHtmlID); //加载分类菜单

}
//===============================================================================书签数据加载
function shuqianmenu_TOTO(ths, ToHtmlID,re_id = '') {
    var parentdiv = $(ths).parents("#" + ToHtmlID + "_content_right_menu"); //父框架
    console.log(!$(parentdiv).attr('biaoqian_xiugai'))
    console.log($(parentdiv).attr('biaoqian_xiugai'))
    if($(parentdiv).attr('biaoqian_xiugai') != 'true'){
        // console.log($(ths),ToHtmlID,re_id)   
        var $id = $(ths).attr('id'); //id
        if ($id == 0) {
            clearsearch(ths, ToHtmlID); //全部数据
        } else {
            BiaoQian_change(ths, ToHtmlID, $id, re_id); //书签选中数据加载
        }
        shuqianmenu_checked(ths, ToHtmlID, $id); //选中书签
    }


}
//===============================================================================书签全局切换
function shuqianmenu_checked(ths, ToHtmlID, $id) {

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    if ($id == '' || !$id) {
        var $id = $(ths).attr('id'); //id
    }
    var $thisparent = $(ths).parent().attr('class');
    //alert($thisparent);
    if ($thisparent != 'ShuQianMenu') {
        NowToHtmlID.find('.head .ShuQianMenu li').removeClass('selectTag');
        NowToHtmlID.find('.head .ShuQianMenu #' + $id).addClass('selectTag');
    }
    SelectMenu($(ths).parent(), ths);
}

//===============================================================================书签加载
function BiaoQian_change(ths, ToHtmlID, $id , re_id = '') {
    //alert(ToHtmlID);

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    if (!$id) {
        var $id = $(ths).attr('id'); //得到id
    }
    if ($id > 0) {
        $.post('B_moban_xiala.php', {
            id: $id,
            act: "BiaoQian_change",
            ToHtmlID: ToHtmlID,
            re_id:re_id
        }, function (data) {
            // console.log(data)

            var arr = data.split('$_=nZζPξz=_$');
            $.each(arr, function (index, j) {
                nowval = arr[index]; //
                // alert(nowval);
                var arr2 = nowval.split('====');
                nowzd = arr2[0];
                nowzdvalue = arr2[1];
                // console.log(nowzd)
                NowToHtmlID.find('#' + nowzd).val(nowzdvalue); //
                //alert(nowzd+nowzdvalue);
            });
            //if(ns==size){

            LoodingDiv(ToHtmlID);
            ListGet(ToHtmlID); //加载数据
            List_Page_Get(ToHtmlID); //分页
            TONGJI_search(ToHtmlID); //搜索统计
            shuqianmenu_user_update(ths, ToHtmlID); //更新记忆功能  
            // }

        });
    } else {

    }

}

//===============================================================================书签添加
function shuqianmenu_add(ths, ToHtmlID) {

    var parentdiv = $(ths).parents("#" + ToHtmlID + "_content_right_menu"); //父框架
    parentdiv.find('a.exitedit').before("<a class='overli biaoqian' id='$id' onclick=shuqianmenu_TOTO(this,'" + ToHtmlID + "')><input name='sys_name' Table_Name='sys_biaoqian' tit='' value='' onchange=edit_ajax(this,'" + ToHtmlID + "') /><b><i class='fa fa-del-mini' onclick=shuqianmenu_del(this,'" + ToHtmlID + "')></i></b><b><i class='fa fa-edit-mini'></i></b><b><i class='fa fa-zhuanyi'></i></b></a>");
    parentdiv.find('a.beizhu').remove(); //清除无数据提示
    Edit_BiaoQian_Menu(ths, ToHtmlID);
}

//===============================================================================书签修改
function edit_ajax(ths, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var Table_Name = $(ths).attr('Table_Name'); //表名
    var zdname = $(ths).attr('name'); //字段名
    var nowvalue = $(ths).val(); //
    if (nowvalue == '') {
        $(ths).val($(ths).attr('tit')); //
        nowvalue = $(ths).attr('tit'); //
    }
    var parentdiv = $(ths).parents('a.overli'); //
    var $id = parentdiv.attr('id'); //id
    ///alert(name);
    var re_id = NowToHtmlID.find('#sys_const_re_id').val(); //re_id
    $.post('moban_set_data.php', {
        id: $id,
        act: "edit_ajax",
        ToHtmlID: ToHtmlID,
        Table_Name: Table_Name,
        zdname: zdname,
        nowvalue: nowvalue,
        re_id: re_id
    }, function (data) {
        //alert(data);
        if (data > 0) {
            $(ths).parents('a.biaoqian').attr("id", data); //这里取得id值
        };
        List_Head_Get(ToHtmlID); //更新表头含书签
    });
}
//===============================================================================书签删除
function shuqianmenu_del(ths, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var parentdiv = $(ths).parents('a.overli');
    var $id = parentdiv.attr('id'); //id

    //---------------------删除书签
    if ($id > 0) {
        if (confirm("确定删除么？") == false) {
            return false;
        };
        $.post('B_moban_del.php', {
            id: $id,
            act: "Del_To_Huis",
            ToHtmlID: ToHtmlID,
            DELtablename: 'sys_biaoqian'
        }, function (data) {
            //alert(data);
            List_Head_Get(ToHtmlID); //更新表头含书签
        });
        var sys_const_biaoqian_id = NowToHtmlID.find(".head #sys_const_biaoqian_id").val(); //选择的标签ID
        if ($id == sys_const_biaoqian_id) {
            NowToHtmlID.find(".head #sys_const_biaoqian_id").val('0');
        }
    }
    parentdiv.hide(500);
    setTimeout(function () {
        parentdiv.remove()
    }, 600);


}
//===============================================================================书签编辑
function Edit_BiaoQian_Menu(ths, ToHtmlID) {
    var parentdiv = $(ths).parents("#" + ToHtmlID + "_content_right_menu"); //父框架
    $(parentdiv).attr('BiaoQian_xiugai','true')
    parentdiv.find('a.biaoqian').each(function () {
        $('.biaoqian_i').css({
            'right':'1%'
        })
        $(this).find("input").removeAttr("readonly");
        $(this).removeClass("selectTag");
    });
    $(ths).prop("onclick", null)
    $(ths).one("click", function(){
        closure_BiaoQian_Menu(ths, ToHtmlID)
    }); 
}
function closure_BiaoQian_Menu(ths, ToHtmlID){
    var parentdiv = $(ths).parents("#" + ToHtmlID + "_content_right_menu"); //父框架
    $(parentdiv).attr('BiaoQian_xiugai',null)
    parentdiv.find('a.biaoqian').each(function () {
        $('.biaoqian_i').css({
            'right':'-5%'
        })
        $(this).find("input").attr("readonly", "readonly");
    });
    $(ths).one("click", function(){Edit_BiaoQian_Menu(ths, ToHtmlID)}); //
}
//===============================================================================书签编辑[退出](弃用)
function Edit_BiaoQian_Menu_Exit(ths, ToHtmlID) {
    var parentdiv = $(ths).parents("#" + ToHtmlID + "_content_right_menu"); //父框架
    parentdiv.find('a.biaoqian').each(function () {
        $(this).attr("onclick", $(this).attr("click")); //
        $(this).attr("click", ""); //onclick为空
        $(this).find("b").hide(300);
        $(this).find("input").attr("readonly", "readonly");
    });
    $(ths).hide(300);
}
//===============================================================================分类改变
function zuchange(ths, ToHtmlID) {
    //alert(ToHtmlID);

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var thisvalue = $(ths).val(); //得到id
    var thiszd = $(ths).attr("id"); //得到字段名称
    var re_id = NowToHtmlID.find('#sys_const_re_id').val() * 1; //re_id
    var parentdiv = $(ths).parents('div.right'); //得到div
    //------------------------------------------------------------------//赋值
    if (thiszd == 'sys_id_zu' && thisvalue == -1) {
        changeright(ths, 0, 388, '分类设定', 'tableid=' + re_id, re_id);
        return false; //停止执行
    }
    NowToHtmlID.find('#zu').val(parentdiv.find('#sys_id_zu').val()); //分类id
    NowToHtmlID.find('#sys_const_bh').val(parentdiv.find('#sys_id_login').val()); //编制人
    NowToHtmlID.find('#sys_const_shenpi').val(parentdiv.find('#sys_shenpi').val()); //审核人
    NowToHtmlID.find('#sys_const_shenpi_all').val(parentdiv.find('#sys_shenpi_all').val()); //批准人
    NowToHtmlID.find('#sys_const_chaosong').val(parentdiv.find('#sys_chaosong').val()); //经办人

    NowToHtmlID.find('#sys_const_id_bumen').val(parentdiv.find('#sys_id_bumen').val()); //部门
    NowToHtmlID.find('#sys_const_adddate').val(parentdiv.find('#sys_adddate').val()); //时间
    if (thisvalue != 0) {
        $(ths).parent().find('.cols01').html('<i class="fa fa-25-02"></i>'); //
    } else {
        $(ths).parent().find('.cols01').html('<i class="fa fa-21-1"></i>'); //
    }
    //alert(thisvalue);
    NowToHtmlID.find("#page_v").val('1'); //页码
    ShaiXuanSql_other(ths, ToHtmlID); //其它字段 +提交修改
}
//===============================================================================筛选
function ShaiXuanSql_other(ths, ToHtmlID) {
    //alert(ToHtmlID);

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var parentdiv = $(ths).parents('div.right').find('ul#sys_other'); //得到sys_other

    var thiszd = parentdiv.attr('id'); //得到字段名称大类识别
    //var enzdname=$(ths).attr('enzdname');////得到字段名称
    var nowstr = '';
    var nowstr27 = '';
    //-----------------------------------------//赋值
    parentdiv.find('li').each(function (i) {
        var zd = $(this).attr('id'); //得到字段名
        var typeid = $(this).attr('typeid'); //得到字段类型
        if ($(this).find('input[name="xuanzhong"]').is(':checked')) {

            fh = $(this).find('select[name="fh"]').val();
            sqltype = $(this).find('select[name="fh"] option:selected').attr('sqltype');
            //alert(sqltype);
            if (!sqltype) {
                sqltype = 'and=';
            }
            var nowtype = $(this).find('.sqlval').attr('type'); //得到样式

            //---------------------
            if (nowtype == 'radio') { //为复选或单选框时
                fhvalue = $(this).find('.sqlval:checked').val(); //当前控件值
                //alert(fhvalue);
            } else if (nowtype == 'checkbox') { //为复选或单选框时
                var chestr = [];
                $(this).find('.sqlval:checked').each(function () {
                    chestr.push($(this).val());
                });
                fhvalue = chestr.join(',');
            } else { //===text/textarea/select
                fhvalue = $(this).find('.sqlval').val(); //当前控件值	
            };

            //alert(fhvalue);

            //----------------------------------------------------------------------//这里得到27复选框时
            if (typeid == 27) { //这里为多选框时
                var chestr = '';
                var i = 0;
                var valength = $(this).find('.sqlval:checked').length; //得到数量
                //alert(valength);
                $(this).find('.sqlval:checked').each(function () {
                    i++;
                    var nowval = $(this).attr('cnval'); //得到值
                    var nowname = $(this).attr('name'); //得到name
                    if (i == valength || valength == 1) { //最后一行时或者只有一行时
                        nowstr27 += " (" + nowname + ' like "' + nowval + ',%" ' + " or " + nowname + ' like "%,' + nowval + ',%" ' + " or " + nowname + ' like "%,' + nowval + '" ' + " or " + nowname + ' = "' + nowval + '")';
                    } else {
                        nowstr27 += " (" + nowname + ' like "' + nowval + ',%" ' + " or " + nowname + ' like "%,' + nowval + ',%" ' + " or " + nowname + ' like "%,' + nowval + '" ' + " or " + nowname + ' = "' + nowval + '") or ';
                    }

                });
                if (valength == 1) { //只有一行时
                    nowstr27 = " and " + nowstr27 + ' '; //这里组合成整体
                } else {
                    nowstr27 = " and (" + nowstr27 + ') '; //这里组合成整体
                }


                var chestr = [];
                $(this).find('.sqlval:checked').each(function () {
                    if (typeid == 27) { //这里为多选框时
                        chestr.push($(this).attr('cnval'));
                    } else {
                        chestr.push($(this).val());
                    }

                });
                fhvalue = chestr.join(',');
            }
            //alert(fhvalue);
            //---------------------
            //if(fhvalue && fhvalue!=''){
            if (sqltype == 'andlike' || sqltype == 'orlike') {
                if (typeid == 27) {
                    nowstr += nowstr27;
                } else {
                    nowstr += " " + fh + ' "%' + fhvalue + '%" ';
                }

            } else if (fhvalue == 'and<' || fhvalue == 'and>' || fhvalue == 'or<' || fhvalue == 'or>') {
                if (typeid == 27) {
                    nowstr += nowstr27;
                } else {
                    nowstr += " " + fh + fhvalue + " ";
                }

            } else if (sqltype == 'andnotlike') {
                if (typeid == 27) {
                    nowstr += nowstr27;
                } else {
                    nowstr += ' and (' + zd + ' not like "%' + fhvalue + '%" ' + ' or ' + zd + ' is null) ';
                }

            } else if (sqltype == 'and=' && fhvalue == '') { // 当值为空时
                if (typeid == 27) {
                    nowstr += nowstr27;
                } else {
                    nowstr += " and (" + zd + ' is null ' + ' or trim(' + zd + ') = "") ';
                }

            } else if (sqltype == 'and<>' && fhvalue == '') { // 当值不为空时
                if (typeid == 27) {
                    nowstr += nowstr27;
                } else {
                    nowstr += " and (" + ' trim(' + zd + ') != "") ';
                }

            } else {
                if (typeid == 27) {
                    nowstr += nowstr27;
                } else {
                    nowstr += " " + fh + ' "' + fhvalue + '" ';
                }

            }


            //}else{
            //nowstr=nowstr;
            //}
        }
    });

    NowToHtmlID.find('#ShaiXuanSql_other').val(nowstr);

    if (nowstr != '') {
        //alert(nowstr);
        $(ths).parents('div.right').find('li[name="sys_other"] .cols01').html('<i class="fa fa-25-02"></i>'); //
    } else {
        $(ths).parents('div.right').find('li[name="sys_other"] .cols01').html('<i class="fa fa-21-1"></i>'); //
    }

    //
    ShaiXuanSql_other_update(ths, ToHtmlID); //更新
    //if (thisvalue){
    LoodingDiv(ToHtmlID);
    ListGet(ToHtmlID); //加载数据
    List_Page_Get(ToHtmlID); //分页
    //};//重新加载搜索数据；

    BiaoQian_look(ths, ToHtmlID); //查询书签是否相同
    TONGJI_search(ths, ToHtmlID); //搜索统计
}

//===============================================================================筛选
function ShaiXuanSql_other3(ths, ToHtmlID) {
    //alert(ToHtmlID);

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var parentdiv = $(ths).parents('div.right').find('ul#sys_other'); //得到sys_other

    var thiszd = parentdiv.attr('id'); //得到字段名称大类识别
    //var enzdname=$(ths).attr('enzdname');////得到字段名称
    var nowstr = '',
        nowstr27 = '';
    //-----------------------------------------//赋值
    parentdiv.find('li').each(function (i) {
        var zd = $(this).attr('id'); //得到字段名
        var typeid = $(this).attr('typeid'); //得到字段类型

        if ($(this).find('input[name="xuanzhong"]').is(':checked')) {

            fh = $(this).find('select[name="fh"]').val();
            sqltype = $(this).find('select[name="fh"] option:selected').attr('sqltype');
            //alert(sqltype);
            if (!sqltype) {
                sqltype = 'and=';
            }
            var nowtype = $(this).find('.sqlval').attr('type'); //得到样式
            //alert(nowtype);
            //----------------------------------------------------------------------//这里得到27复选框时
            if (typeid == 27) { //这里为多选框时
                var chestr = '';
                var i = 0;
                var valength = $(this).find('.sqlval:checked').length; //得到数量
                alert(valength);
                $(this).find('.sqlval:checked').each(function () {
                    i++;
                    var nowval = $(this).attr('cnval'); //得到值
                    var nowname = $(this).attr('name'); //得到name
                    if (i == valength || valength == 1) { //最后一行时或者只有一行时
                        nowstr27 += " (" + nowname + ' like "' + nowval + ',%" ' + " or " + nowname + ' like "%,' + nowval + ',%" ' + " or " + nowname + ' like "%,' + nowval + '" ' + " or " + nowname + ' = "' + nowval + '")  ';
                    } else {
                        nowstr27 += " (" + nowname + ' like "' + nowval + ',%" ' + " or " + nowname + ' like "%,' + nowval + ',%" ' + " or " + nowname + ' like "%,' + nowval + '" ' + " or " + nowname + ' = "' + nowval + '") or ';
                    }

                });
                if (valength == 1) { //只有一行时
                    nowstr27 = " and " + nowstr27 + '" '; //这里组合成整体
                } else {
                    nowstr27 = " and (" + nowstr27 + '") '; //这里组合成整体
                }


                var chestr = [];
                $(this).find('.sqlval:checked').each(function () {
                    if (typeid == 27) { //这里为多选框时
                        chestr.push($(this).attr('cnval'));
                    } else {
                        chestr.push($(this).val());
                    }

                });
                fhvalue = chestr.join(',');
            } else {
                fhvalue = $(this).find('.sqlval').val(); //当前控件值
            }


            //-------------------endif
            //---------------------
            if (nowtype == 'radio') { //为复选或单选框时
                fhvalue = $(this).find('.sqlval:checked').val(); //当前控件值
                //alert(fhvalue);
            } else if (nowtype == 'checkbox') { //为复选或单选框时
                //alert(typeid);
                if (typeid == 27) { //这里为多选框时
                    var chestr = '';
                    var i = 0;
                    var valength = $(this).find('.sqlval:checked').length; //得到数量

                    $(this).find('.sqlval:checked').each(function () {
                        i++;
                        var nowval = $(this).attr('cnval'); //得到值
                        var nowname = $(this).attr('name'); //得到name
                        if (valength == 1) {
                            nowstr += " and (" + nowname + ' like "' + nowval + ',%" ' + " or " + nowname + ' like "%,' + nowval + ',%" ' + " or " + nowname + ' like "%,' + nowval + '" ' + " or " + nowname + ' = "' + nowval + '") ';
                        } else {
                            if (i == valength) {
                                nowstr += " (" + nowname + ' like "' + nowval + ',%" ' + " or " + nowname + ' like "%,' + nowval + ',%" ' + " or " + nowname + ' like "%,' + nowval + '" ' + " or " + nowname + ' = "' + nowval + '")  ';
                            } else {
                                nowstr += " (" + nowname + ' like "' + nowval + ',%" ' + " or " + nowname + ' like "%,' + nowval + ',%" ' + " or " + nowname + ' like "%,' + nowval + '" ' + " or " + nowname + ' = "' + nowval + '") or ';
                            }

                        }

                    });
                    var chestr = [];
                    $(this).find('.sqlval:checked').each(function () {
                        if (typeid == 27) { //这里为多选框时
                            chestr.push($(this).attr('cnval'));
                        } else {
                            chestr.push($(this).val());
                        }

                    });
                    fhvalue = chestr.join(',');
                }
                //}else{

                //if(fhvalue=='' && typeid==27){//这里为多选框时
                //var valname=$(this).find('.sqlval').attr('name');
                //nowstr+=" and "+valname+" ='' ";
                // }
                //alert(fhvalue);
            } else { //===text/textarea/select
                fhvalue = $(this).find('.sqlval').val(); //当前控件值	
            };

            if (typeid == 27) { //这里为多选框时
                if (valength == 1 || fhvalue == '') {
                    nowstr = nowstr;
                } else {
                    nowstr = "and (" + nowstr + ")";
                    alert(nowstr);
                }
            }
            //alert(fhvalue);
            //---------------------
            //if(fhvalue && fhvalue!=''){
            if (sqltype == 'andlike' || sqltype == 'orlike') {
                if (typeid == 27) { //这里为多选框时
                    nowstr = nowstr;
                } else {
                    nowstr += " " + fh + ' "%' + fhvalue + '%" ';
                }
            } else if (fhvalue == 'and<' || fhvalue == 'and>' || fhvalue == 'or<' || fhvalue == 'or>') {
                if (typeid == 27) { //这里为多选框时
                    nowstr = nowstr;
                } else {
                    nowstr += " " + fh + fhvalue + " ";
                }

            } else if (sqltype == 'andnotlike') {
                nowstr += ' and (' + zd + ' not like "%' + fhvalue + '%" ' + ' or ' + zd + ' is null) ';
            } else if (sqltype == 'and=' && fhvalue == '') { // 当值为空时
                //if(typeid==27){//这里为多选框时
                //nowstr=nowstr;
                //}else{
                nowstr += " and (" + zd + ' is null ' + ' or trim(' + zd + ') = "") ';
                //}

            } else if (sqltype == 'and<>' && fhvalue == '') { // 当值不为空时
                if (typeid == 27) { //这里为多选框时
                    nowstr = nowstr;
                } else {
                    nowstr += " and (" + ' trim(' + zd + ') != "") ';
                }

            } else {
                if (typeid == 27) {
                    nowstr = nowstr;
                } else {
                    nowstr += " " + fh + ' "' + fhvalue + '" ';
                }

            }

            //}else{
            //nowstr=nowstr;
            //}

        }
    });

    NowToHtmlID.find('#ShaiXuanSql_other').val(nowstr);

    if (nowstr != '') {
        //alert(nowstr);
        $(ths).parents('div.right').find('li[name="sys_other"] .cols01').html('<i class="fa fa-25-02"></i>'); //
    } else {
        $(ths).parents('div.right').find('li[name="sys_other"] .cols01').html('<i class="fa fa-21-1"></i>'); //
    }

    //
    ShaiXuanSql_other_update(ths, ToHtmlID); //更新
    //if (thisvalue){
    LoodingDiv(ToHtmlID);
    ListGet(ToHtmlID); //加载数据
    List_Page_Get(ToHtmlID); //分页
    //};//重新加载搜索数据；

    BiaoQian_look(ths, ToHtmlID); //查询书签是否相同
    TONGJI_search(ths, ToHtmlID); //搜索统计
}
//===============================================================================书签是否相同
function BiaoQian_look(ths, ToHtmlID) {
    //alert('0');

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02

    var sys_const_keyword = NowToHtmlID.find('#sys_const_keyword').val(); //关键词
    var sys_const_id_bumen = NowToHtmlID.find('#sys_const_id_bumen').val(); //部门
    var sys_const_bh = NowToHtmlID.find('#sys_const_bh').val(); //编制人
    var sys_const_shenpi = NowToHtmlID.find('#sys_const_shenpi').val(); //审核人
    var sys_const_shenpi_all = NowToHtmlID.find('#sys_const_shenpi_all').val(); //批准人
    var sys_const_chaosong = NowToHtmlID.find('#sys_const_chaosong').val(); //经办人

    var sys_const_adddate = NowToHtmlID.find('#sys_const_adddate').val(); //添加更新时间
    var sys_const_zu = NowToHtmlID.find('#zu').val(); //分类
    var sys_const_ShaiXuanSql_other = NowToHtmlID.find('#sys_const_ShaiXuanSql_other').val();
    var re_id = NowToHtmlID.find('#sys_const_re_id').val(); //re_id

    $.post('B_moban_xiala.php', {
        act: "BiaoQian_look",
        sys_const_keyword: sys_const_keyword,
        sys_const_id_bumen: sys_const_id_bumen,
        sys_const_bh: sys_const_bh,
        sys_const_shenpi: sys_const_shenpi,
        sys_const_shenpi_all: sys_const_shenpi_all,
        sys_const_chaosong: sys_const_chaosong,
        sys_const_adddate: sys_const_adddate,
        sys_const_zu: sys_const_zu,
        re_id: re_id,
        sys_const_ShaiXuanSql_other: sys_const_ShaiXuanSql_other,
        ToHtmlID: ToHtmlID
    }, function (data) {
        //alert(data);
        if (data == -1 || data == '') {
            NowToHtmlID.find('.head .ShuQianMenu li').removeClass('selectTag'); //清除标签选择
            NowToHtmlID.find('.head .ShuQianMenu li#0').addClass('selectTag'); //标签选择
        } else { //清空书签选择
            $id = data;
            shuqianmenu_checked(ths, ToHtmlID, $id); //切换书签
            NowToHtmlID.find('#sys_const_biaoqian_id').val($id);
            //alert($id);
            shuqianmenu_user_update(ths, ToHtmlID); //更新
        }
    });
}
//===============================================================================统计数据

function TONGJI_search(ToHtmlID) {

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02

    var nowzu = NowToHtmlID.find('.head #zu').val() * 1;
    if (nowzu > 0) {
        nowzu = 1;
    };
    var sys_const_id_bumen = NowToHtmlID.find('.head #sys_const_id_bumen').val() * 1;
    if (sys_const_id_bumen > 0) {
        sys_const_id_bumen = 1;
    } else {
        sys_const_id_bumen = 0;
    };
    var sys_const_bh = NowToHtmlID.find('.head #sys_const_bh').val() * 1; //编制人
    if (sys_const_bh > 0) {
        sys_const_bh = 1;
    } else {
        sys_const_bh = 0;
    };
    var sys_const_shenpi = NowToHtmlID.find('.head #sys_const_shenpi').val() * 1; //审核人
    if (sys_const_shenpi > 0) {
        sys_const_shenpi = 1;
    } else {
        sys_const_shenpi = 0;
    };
    var sys_const_shenpi_all = NowToHtmlID.find('.head #sys_const_shenpi_all').val() * 1; //批准人
    if (sys_const_shenpi_all > 0) {
        sys_const_shenpi_all = 1;
    } else {
        sys_const_shenpi_all = 0;
    };
    var sys_const_chaosong = NowToHtmlID.find('.head #sys_const_chaosong').val() * 1; //经办人
    if (sys_const_chaosong > 0) {
        sys_const_chaosong = 1;
    } else {
        sys_const_chaosong = 0;
    };

    var sys_const_adddate = NowToHtmlID.find('.head #sys_const_adddate').val().trim();
    if (sys_const_adddate == '' || sys_const_adddate == '0') {
        sys_const_adddate = 0;
    } else {
        sys_const_adddate = 1;
    };
    var ShaiXuanSql_other = NowToHtmlID.find('.head #ShaiXuanSql_other').val().trim();
    if (ShaiXuanSql_other == '' || ShaiXuanSql_other == '0') {
        ShaiXuanSql_other = 0;
    } else {
        ShaiXuanSql_other = 1;
    };
    //alert(sys_const_adddate);

    var bigsize = nowzu * 1 + sys_const_id_bumen * 1 + sys_const_bh * 1 + sys_const_shenpi * 1 + sys_const_shenpi_all * 1 + sys_const_chaosong * 1 + sys_const_adddate * 1 + ShaiXuanSql_other * 1;
    // alert(bigsize);
    NowToHtmlID.find('.head .TONGJI_search').html('<i class="fa fa-25-02"></i>筛选<font color="red" style="padding-left:3px;padding-right:3px;"><strong>(' + bigsize + ')</strong></font>');

}

//===============================================================================获取参数
function ShaiXuanSql_other_update(ths, ToHtmlID) {

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var parentdiv = $(ths).parents('div.right'); //得到div
    //alert(ed_id);
    var $id = parentdiv.attr("ed_id") * 1; //得到id
    NowToHtmlID.find(".head #sys_const_biaoqian_id").val($id); //选择的标签ID
    shuqianmenu_user_update(ths, ToHtmlID); //更新记忆功能
    //alert($id);
    AjaxLoad('B_moban_xiala.php', 'shuqianmenu_update', '', '', 'POST', ToHtmlID, '', $id); //加载分类菜单
}
//===============================================================================用户使用记忆功能
function shuqianmenu_user_update(ths, ToHtmlID) {

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    //alert(ed_id);
    AjaxLoad('B_moban_xiala.php', 'shuqianmenu_user_update', '', '', 'POST', ToHtmlID, ''); //加载分类菜单
}
/*
//===============================================================================删除
function ShaiXuanSql_other_del(ths,ToHtmlID) {
	
	var NowToHtmlID =DIVHtmlID(ToHtmlID,'fanall');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
	var thisvalue=$(ths).attr("id")*1;//得到id
	var thiszd=$(ths).parents('ul').attr("id");//得到字段名称

	var bigsize=$(ths).parents('#'+ToHtmlID+'_content_right_menu').find('#zulist li i.fa-25-02').size();
	var ShaiXuanSql_other=NowToHtmlID.find('.head #ShaiXuanSql_other').val();
	//alert(bigsize);
	if(bigsize > 0){
	    $(ths).parents('.bigmenu').find('textarea[name="daima"]').val(ShaiXuanSql_other);
	}else{
		alert('请先进行筛选再建书签！');
	}
}
*/
/*/===============================================================================身份证验证位数
function typeNum(obj,objTip){obj.onkeyup=obj.onfocus=function(){objTip.innerHTML=obj.value.length;}obj.onkeydown=obj.onfocus=function(){
objTip.innerHTML=obj.value.length;}}*/
function moveheng(ToHtmlID) {
    // console.log(ToHtmlID)
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    NowToHtmlID.find("#" + ToHtmlID + "_banner").scrollLeft(NowToHtmlID.find("#" + ToHtmlID + "_content").scrollLeft());
    NowToHtmlID.find("#" + ToHtmlID + "_content_left").scrollTop(NowToHtmlID.find("#" + ToHtmlID + "_content").scrollTop());
    NowToHtmlID.find("#" + ToHtmlID + "_content_right").scrollTop(NowToHtmlID.find("#" + ToHtmlID + "_content").scrollTop());
} //同时滚动特效
//=================================================================获取文件名格式
function getType(file) {
    var filename = file;
    var index1 = filename.lastIndexOf(".");
    var index2 = filename.length;
    var type = filename.substring(index1, index2);
    type = movefh('.', type).toLowerCase();
    return type;
}
//=================================================================获取字符串位置
function patch(fh, txt) { //fh为查找字符串，txt为字符串
    var n = (txt.split(fh)).length - 1;
    return n;
}
//=================================================================去除指定字符串
function movefh(fh, txt) { //fh为查找字符串，txt为字符串
    var txtarr = txt.split(fh);
    var ResultString = txtarr.join('');
    return ResultString;
}
//=================================================================给指定图片赋值
function nowtdhtml(nowtd, thisval) { //fh为查找字符串，txt为字符串
    var s_typelist = 'jpg,bmp,jpeg,gif,png'; //图片格式
    // console.log(thisval)
    // console.log(123)
    var arr = thisval.split(';');
    var arrlength = "<span class='tongji_img'> " + arr.length + " </span>"; //得到数组数量

    if (arrlength == 0) {
        firstimg = '';
    } else {
        firstimg = arr[0]; //第一个文件或图片
    }
    var imgsrc = '../' + firstimg;
    var filetype = getType(firstimg); //文件格式
    if (patch(filetype, s_typelist) == 0) {
        var imgsrc = '../uploadhtml5e/images/' + filetype + '.png';
        var style = 'margin-top:-3px;';
    } else {
        var style = 'border:1px solid #CCC;margin-top:-3px;';
    }
    //alert(imgsrc);
    if (thisval > '') {
        nowtd.html("<img src=" + imgsrc + " height='" + (nowtd.height() - 4) + "' width='" + (nowtd.height() - 4) + "' style='" + style + "' />" + arrlength);
    }
}
//---------------------------------------------------------------------------------------------------------------------显示界面格式化样式
function FormattingXianShi(id, ToHtmlID, nnvalues, tdid, tdvalue) { //id为样式 ToHtmlID,nnvalues为sys_id_zu的值,tdid需改变的指定td,tdvalue需改变的指定值

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'content_ALL'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    //var id=parseInt(id);//转为数字
    // console.log(id)
    switch (parseInt(id)) { //0为普通文本模式   
        case 1:
        case 2: //单行、多行文本
            {
                //$(this).html($(this).text());
            };
            break;
        case 3:
            { //先生、女士
                //$(this).html($(this).text());
                //alert('00');
                //if (texts==''||texts==null||texts=='undefined'){texts='¥'};//判定为空时默认为人民币/样式/¥ 100.00
                //NowToHtmlID.find('.F_M_XS_3').each(function (i) {
                //$(this).html('¥ ' + formatCurrency($(this).text()))
                //});
            };
            break;
        case 4:
            { //复选框
                //$(this).html($(this).text());
            };
            break;
        case 5:
            { //下拉框
                //$(this).html($(this).text());
            };
            break;
        case 6: //ok
            { //图片上传

                if (tdid != '') {
                    var tdclass = tdid; //这里得到需改变的单位td值
                    var nowtd = NowToHtmlID.find("." + tdclass); //得到操作td元素
                    nowtdhtml(nowtd, tdvalue); //给图片列赋值
                    // uploads/p/20211009/20211009sj182416_s50.jpg;uploads/other/20211009/20211009sj349315.pdf
                } else {
                    // console.log(123543)
                    NowToHtmlID.find('.F_M_XS_6').each(function (i) {
                        var nowtd = $(this); //得到操作td元素
                        var thisval = $(this).text(); //得到当前内容
                        // console.log(nowtd,thisval)
                        nowtdhtml(nowtd, thisval); //给图片列赋值
                    });
                }

            };
            break;
        case 7:
            { //文件上传
                //$(this).html($(this).text());
            };
            break;
        case 8: //日期
            {

                NowToHtmlID.find('.F_M_XS_8').each(function (i) {
                    $(this).html($(this).text().toString().replace(/[^(^(\d{4}|\d{2})(\-|\/|\.)\d{1,2}\3\d{1,2}$)|(^\d{4}年\d{1,2}月\d{1,2}日$)$]/ig, ""))
                }); //.substr(0,10)取0-10个字符
            };
            break;
        case 9:
            { //时间YYYY-DD-HH
                NowToHtmlID.find('.F_M_XS_9').each(function (i) {
                    $(this).html($(this).text().toString().replace(/[^(^(\d{4}|\d{2})(\-|\/|\.)\d{1,2}\3\d{1,2}$)|(^\d{4}年\d{1,2}月\d{1,2}日$)$]/ig, ""))
                }); //.substr(0,10)取0-10个字符
            };
            break; //加载表头左右
        case 10: //密码框
            {};
            break;
        case 11: //男女
            {
                $(this).html($(this).text());

            };
            break;
        case 12: //递增自动编号
            {

            };
            break;
        case 13: //开启关闭
            {
                /*//图像不加载原图
                NowToHtmlID.find('.F_M_XS_13').each(function (i) {
                	$(this).html("<a href=" + $(this).text() + " target='_blank'><img src='../images/img.png' border='0' height=" + ($(this).height() - 4) + " /></a>")
                });
                //图像框
                NowToHtmlID.find('.F_M_XS_13').each(function (i) {
                	var thistext = $(this).text().Trim();
                	if (thistext == '' || thistext == null || thistext == 'undefined') {
                		$(this).html(" ");
                	} else {
                		$(this).html("<a href=" + thistext + " title=" + thistext + " target='_blank'><img src='../images/201011111733401978.png' border='0' height=" + ($(this).height() - 4) + " /></a>")
                	}
                });
                */
            };
            break;
        case 14: //删除到回收站
            {
                $(this).html($(this).text());
            };
            break;
        case 15: //分类框
            {
                //alert(tdvalue);
                if (tdid != '') { //如果只修改指定值时

                    NowToHtmlID.find("." + tdclass).text(tdvalue); //这里只修改单个值

                } else {
                    NowToHtmlID.find('.F_M_XS_15').each(function (i) { //以下修改全部值
                        var nowtext = $(this).text(); //当前内容
                        //alert(nowtext);
                        var arr = nowtext.split(',');
                        var nowtexts = '';
                        if (nowtext == '') {
                            //$(this).html(nowtexts);
                        } else {
                            $.each(arr, function (index, j) {
                                nowval = arr[index]; //
                                var arr2 = nnvalues.split(',');
                                $.each(arr2, function (index2, i) {
                                    nowindex = arr2[index2];
                                    var arr3 = nowindex.split('=');
                                    if (arr3[0] == nowval && nowval) {
                                        nowtexts += arr3[1] + ', ';
                                    }
                                    //alert(arr3[1]);
                                });

                            });


                        }
                        nowtexts = nowtexts.substring(0, nowtexts.lastIndexOf(',')); //去最后一个逗号
                        //alert(nowtexts);
                        $(this).html(nowtexts);

                    });
                }

                //alert('有分类框');
            };
            break;
        case 16: //在离职框
            {};
            break;
        case 17: //是否框
            {};
            break;
        case 18: //✔ ✖
            {};
            break;
        case 19: //✔
            {};
            break;
        case 20: //审批框
            {};
            break;
        case 21: //审名框
            {};
            break;
        default:
            {
                //alert('FormattingXianShi(没有可执行的格式化参数！)');
            };
    };
}

function formatDate(num) {
    num = num.toString().replace(/[^0-9\.]/ig, "") //只能输入数字和小数点
}

function formatnum(num) {
    num = num.toString().replace(/[^0-9]/ig, "") //只能输入数字
}

/** 
 * 将数值四舍五入(保留2位小数)后格式化成金额形式 
 * @return 金额格式的字符串,如'1,234,567.45' 
 */

function formatCurrency(num) {
    now_n = 100 //10代表1位小数(有点问题)，100代表2位小数
    num = num.toString().replace(/[^0-9\.]/ig, "") //只能输入数字和小数点
    if (isNaN(num)) //当不为数字时默认为0 
        num = "0";
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num * now_n + 0.50000000001);
    cents = num % now_n;
    num = Math.floor(num / now_n).toString();
    if (cents < 10)
        cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
        num = num.substring(0, num.length - (4 * i + 3)) + ','
        + num.substring(num.length - (4 * i + 3));
    return (((sign) ? '' : '-') + num + '.' + cents);
}
//===============================================================================以下搜索条类别菜单
var index_eq = null;

function showDIV(ths, wid, divFieldType, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    index_eq = $(ths).parent().parent().index(); //得到当前列全局行位置。
    if (!NowToHtmlID.find("#" + divFieldType)) return;
    NowToHtmlID.find("#" + divFieldType).css({
        'position': 'absolute',
        'display': 'block',
        'top': $(ths).position().top + 10,
        'left': $(ths).position().left - 4,
        'overflow': 'no',
        'width': wid,
        'z-index': 160
    });
    //$("#"+divFieldType+" li").css({width:wid}); 
    if (NowToHtmlID.find("#" + divFieldType).attr('kg') == 'ok') {
        return false;
    } else {
        NowToHtmlID.find("#" + divFieldType).attr('kg', 'ok');
    }; //查看已加载属性/只加载一次
    if (wid > 0) {
        NowToHtmlID.find("#" + divFieldType).show();
    };
    $(ths).addClass("linelihover");

    //$("#"+divFieldType).focus();
}
//===============================================================================以下为按住shift键选中复选框。
//存储每次按住Shift键单击的对象在文档document中的all集合中的顺序 
var iIndex = new Array();
var j = 0;

function selectit(ID) {
    //obj.sourceIndex获取obj在源序中的依次位置， //即对象出现在 document 的 all 集合中的顺序 
    iIndex[j++] = event.srcElement.sourceIndex;
    var L = iIndex[j - 1] < iIndex[j - 2] ? 1 : 2; //比较数组中最后两个数的大小，以确定在循环时的先后 
    if (event.shiftKey) { //如果按下Shift键被按下，执行下面的代码 
        for (i = iIndex[j - L]; i < iIndex[j - 3 + L]; i++) //遍历介于两次按住Shift键单击中的对象间的所有对象        
            with(document.all[i]) { //为下面的语句设定默认对象document.all[i]//判断当前对象的标签是否为复选框，并且name为shift  
                if (tagName == "INPUT" && getAttribute("type") == "checkbox" && getAttribute("name") == ID) //设置当前对象的选中状态跟最后一次按住Shift键点击的对象选中状态一致 
                    checked = event.srcElement.checked;
            }
        event.srcElement.checked = true; //选中当前单击的复选框 
    }
}

//===============================================================================以下为表头排序js
function sortCol(ths, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    //alert('排序了');
    var parentable = NowToHtmlID.find('.tables .thead'); //头部包含的div
    var px_name = NowToHtmlID.find("#sys_const_px_name").val(); //排序字段名
    var pok = NowToHtmlID.find("#sys_const_pok").val(); //1时排序，0不排序
    var pxv = NowToHtmlID.find("#sys_const_pxv").val(); //排序值
    var thiszhiduan = $(ths).attr('name'); //排序字段数
    var tuodongok = NowToHtmlID.find("#sys_const_tuodongok").val(); //1时在拖动，0未拖动
    if (tuodongok != '1') {
        NowToHtmlID.find("#sys_const_pok").val('1'); //1为排序开启 0关闭
        $(parentable).find('li').removeClass("sort_down"); //清除所有样式
        $(parentable).find('li').removeClass("sort_up");

        if (px_name == thiszhiduan) { //当排序字段名不为新的时候
            NowToHtmlID.find("#sys_const_px_name").val(thiszhiduan); //排序字段赋值
            //alert('相同字段');
            if (NowToHtmlID.find("#sys_const_pxv").val() == 'Asc') {
                NowToHtmlID.find("#sys_const_pxv").val('Desc');
                $(ths).addClass("sort_up");
            } else {
                NowToHtmlID.find("#sys_const_pxv").val('Asc');
                $(ths).addClass("sort_down");
            }

            LoodingDiv(ToHtmlID); //Loading
            ListGet(ToHtmlID); //这里进行排序更新
            NowToHtmlID.find("#sys_const_pok").val('0'); //1为排序开启 0关闭
        } else {

            NowToHtmlID.find("#sys_const_px_name").val(thiszhiduan); //排序字段赋值
            NowToHtmlID.find("#sys_const_pxv").val('Asc');
            $(ths).addClass("sort_down");
            LoodingDiv(ToHtmlID); //Loading
            ListGet(ToHtmlID); //这里进行排序更新
            NowToHtmlID.find("#sys_const_pok").val('0'); //1为排序开启 0关闭
        }
        //shuqianmenu_user_update(ths,ToHtmlID);                       //更新记忆功能
    }
}
//===============================================================================以下为以下为元素替换
function CloseDIV(div1, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    NowToHtmlID.find("#" + div1).animate({
        width: 0
    }, 300);
}

function RegExpression_s(obj, i) { //正则表达式
    switch (i) {
        case 1:
            {
                regs = /[\*\^\|\~\!\#\$\%\&\(\)\{\}\[\]\?\<\>\.\,\'\;\\\/\=\ ]+/;
                break;
            }; //不允许输入各种符号
        case 2:
            {
                regs = /^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/;
                break;
            } // email
        case 3:
            {
                regs = /^[01]?[- .]?(\([2-9]\d{2}\)|[2-9]\d{2})[- .]?\d{3}[- .]?\d{4}$/;
                break;
            }; //phoneNumberUS
        case 4:
            {
                regs = /[\x80-\xff_a-zA-Z0-9]+/;
                break;
            }; //phoneNumberUS
        case 5:
            {
                regs = /^http:\/\/[a-zA-Z0-9]+\.[a-zA-Z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/;
                break;
            }; //网址
        case 6:
            {
                regs = /^(\+\d{2,3}\-)?\d{11}$/;
                break;
            }; //手机号
        case 7:
            {
                regs = /^[a-zA-Z]+$/;
                break;
            }; //只能输入字母
        case 8:
            {
                regs = /^\w{3,}@\w+(\.\w+)+$/;
                break;
            }; //邮箱地址
        case 9:
            {
                regs = /^(\d{3,4}\-)?[1-9]\d{6,7}$/;
                break;
            }; //电话号码
        case 10:
            {
                regs = /(^\s*)|(\s*$)/g;
                break;
            }; //不为空格
        case 11:
            {
                regs = /^[a-zA-Z\u0391-\uFFE5].{15}$/;
                break;
            }; //不为以数字开头
        case 12:
            {
                regs = /[^\d]/;
                break;
            }; //只能输入数(
        default:
            {
                regs = /[\*\^\|\~\!\#\$\%\&\(\)\{\}\[\]\?\<\>\.\,\'\;\\\/\=\ ]+/;
            }; //不允许输入各种符号
    };
    obj.value = obj.value.replace(regs, '');
}
//===============================================================================拖动列宽js开始
var isMouseDown = false; // 用于跟踪鼠标是否按下的标志
var MouseDownDom = null
var DomWidth = 0
var oldMouseX = 0
function MouseDownToResize(dom, tdclassname, xy, ToHtmlID) {
    oldMouseX = event.clientX
    isMouseDown = true;
    MouseDownDom = dom.parentElement;
    DomWidth = parseInt(dom.parentNode.style.width);
    // 在鼠标按下时添加鼠标移动事件
    document.addEventListener("mousemove", moveCallback);
    // 在鼠标按下时添加鼠标离开事件
    document.addEventListener("mouseup", upCallback);

    // 阻止默认的拖动行为，如果有的话
    event.preventDefault();
}

// 鼠标移动时的方法

function moveCallback(event) {
    var newMouseX = event.clientX
    if (isMouseDown) {
        MouseDownDom.style.width = (DomWidth + newMouseX - oldMouseX) + 'px';
        console.log('拖动');
        console.log(MouseDownDom)
    }
}

// 鼠标抬起时的方法
function upCallback() {
    isMouseDown = false;
    console.log('离开');

    // 在鼠标松开时移除鼠标移动事件和鼠标离开事件
    document.removeEventListener("mousemove", moveCallback);
    document.removeEventListener("mouseup", upCallback);
}

// //鼠标移动时的方法
function MouseMoveToResize(obj, tdclassname, xy, ToHtmlID, ht) {
//     var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
//     var NowToHtmlID_content_ALL = DIVHtmlID(ToHtmlID, 'content_ALL');
//     // moveheng(ToHtmlID);
//     if (xy == 'x' && NowToHtmlID.find("#sys_const_q_h").val() == 1) {
//         if (!obj.mouseDownX) return false; //判断是否是否已经按下
//         console.log(obj.mouseDownX)
//         var newWidth = obj.pareneTdW * 1 + event.clientX * 1 - obj.mouseDownX;
//         if (newWidth < 28) {
//             newWidth = 28;
//         }
//         if (newWidth > 0 && NowToHtmlID.find("#sys_const_q_h").val() == 1) {
//             obj.parentElement.style.width = newWidth;
//         };
//         NowToHtmlID_content_ALL.find('.' + tdclassname).css({
//             'width': newWidth
//         });
//         //alert(NowToHtmlID);
//         NowToHtmlID_content_ALL.find("li[class^=" + tdclassname + "]").each(function (i) {
//             $(this).css('width', newWidth);
//         });
//         NowToHtmlID_content_ALL.find("li[et='" + tdclassname + "']").each(function (i) {
//             $(this).css('width', newWidth);
//         });
//     } else {
//         if (!obj.mouseDownY) return false; //判断是否是否已经按下
//         var newHeight = obj.pareneTdH * 1 + (event.clientY * 1 - obj.mouseDownY) / ht * 1;
//         if (newHeight > 0 && $("#sys_const_q_h").val() == 1) {
//             obj.parentElement.style.height = newHeight;
//         };
//         NowToHtmlID_content_ALL.find("[class^=" + tdclassname + "]").each(function (i) {
//             $(this).css('height', newHeight);
//         });
//         NowToHtmlID_content_ALL.find("." + tdclassname).each(function () {
//             $(this).css('height', newHeight);
//         });
//     }
}
// //鼠标抬起时的方法$("re_id").val(); 
function MouseUpToResize(objs, zhiduan, xy, ToHtmlID) {
//     var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall');
//     moveheng(ToHtmlID);
//     var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;

//     if (xy == 'x') {
//         objs.mouseDownX = 0;
//         kd = objs.parentElement.offsetWidth;
//         if (kd < 28) {
//             kd = 28
//         };
//         $.post("moban_set_data.php", {
//             act: "e_kd",
//             kd: kd,
//             zhiduan: zhiduan,
//             ToHtmlID: ToHtmlID,
//             re_id: re_id
//         }, function (data) {
//             UpdatePhp_Pc(re_id, 'head_list');
//         });
//     } else {
//         objs.mouseDownY = 0;
//         hd = objs.parentElement.offsetHeight;
//     }
//     NowToHtmlID.find("#sys_const_q_h").val('0');
}

function MouseoverToResize(objs, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02

    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
    NowToHtmlID.find("#sys_const_tuodongok").val(1); //这里设定为在拖动

}

function MouseoutToResize(objs, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
    NowToHtmlID.find("#sys_const_tuodongok").val(0); //这里设定为在拖动

}


//==================================================================================== 左右滚动代码
function dootstart(l_r, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); // fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var s_h = NowToHtmlID.find("#sys_const_s_h").val() * 1;
    if (s_h == 1) {
        if (l_r == 'r') {
            this.interval = window.setInterval(function () {
                NowToHtmlID.find("#" + ToHtmlID + "_content").scrollLeft(NowToHtmlID.find("#" + ToHtmlID + "_content").scrollLeft() + 50);
            }, 100);
        } else {
            this.interval = window.setInterval(function () {
                NowToHtmlID.find("#" + ToHtmlID + "_content").scrollLeft(NowToHtmlID.find("#" + ToHtmlID + "_content").scrollLeft() - 50);
            }, 100);
        }
    }
}

function dootstop() {
    window.clearInterval(this.interval)
}
//==================================================================================== 1表格列拖动位置代码
function copycol_down(ths, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    //if (window.event.button == 1) {
    //alert('按住了');

    NowToHtmlID.find("#sys_const_c_ok").val(ths.name);
    $(ths).addClass("category_thead");
    NowToHtmlID.find("#sys_const_s_h").val('1');
    NowToHtmlID.find("#sys_const_C_xu_now").val($(ths).attr("xu"));
    var ttthis = NowToHtmlID.find("#theObjTable .thead li[name='" + $(ths).attr("name") + "']");

    NowToHtmlID.find("#sys_const_prev_zd").val(ttthis.prev().attr("name")); //前一个字段名
    NowToHtmlID.find("#sys_const_this_zd").val($(ths).attr("name")); //当前字段名
    NowToHtmlID.find("#sys_const_ChangePrev_zd").val(''); //重置得到拖动后位置前一个字段名
    NowToHtmlID.find("#sys_const_ChangeNext_zd").val(''); //重置得到拖动后位置前一个字段名

    if ($(ths).parent().parent().attr('id') == 'theObjTable') {
        NowToHtmlID.find("#sys_const_Start_Suoding").val(0); //重置得到拖动后位置前一个字段名
    } else {
        NowToHtmlID.find("#sys_const_Start_Suoding").val(1);
    }
    //NowToHtmlID.find("#theObjTable .thead li[name='"+$(ths).attr("name")+"']");
    //}
}
//function copycol_down_body(){if(window.event.button==1)alert('按住了鼠标左键!');}
function copycol_up(ths, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    //NowToHtmlID.find("#sys_const_c_ok").val();
    //NowToHtmlID.find("#sys_const_b_ok").val();
    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
    var c_ok = NowToHtmlID.find("#sys_const_c_ok").val();
    var b_ok = NowToHtmlID.find("#sys_const_b_ok").val();
    var q_h = NowToHtmlID.find("#sys_const_q_h").val();
    //alert('c_ok:'+c_ok+'b_ok:'+b_ok+'q_h:'+q_h);

    var sys_const_Start_Suoding = NowToHtmlID.find("#sys_const_Start_Suoding").val();

    var sys_const_prev_zd = NowToHtmlID.find("#sys_const_prev_zd").val();

    var sys_const_this_zd = NowToHtmlID.find("#sys_const_this_zd").val();
    var ttthis = NowToHtmlID.find("#theObjTable .thead li[name='" + $(ths).attr("name") + "']");

    if (NowToHtmlID.find("#sys_const_this_zd").val() != ttthis.prev().attr("name")) { //有调整时

        if (NowToHtmlID.find("#sys_const_prev_zd").val() != ttthis.prev().attr("name")) {

            NowToHtmlID.find("#sys_const_ChangePrev_zd").val(ttthis.prev().attr("name")); //得到拖动后位置前一个字段名
            NowToHtmlID.find("#sys_const_ChangeNext_zd").val(ttthis.next().attr("name")); //得到拖动后位置前一个字段名 	
        }

    }
    if ($(ths).parent().parent().attr('id') == 'theObjTable') {
        NowToHtmlID.find("#sys_const_End_Suoding").val(0); //重置得到拖动后位置前一个字段名
    } else {
        NowToHtmlID.find("#sys_const_End_Suoding").val(1);
    }

    var sys_const_End_Suoding = NowToHtmlID.find("#sys_const_End_Suoding").val();
    //var hy = NowToHtmlID.find("#sys_const_hy").val();
    //var bh = NowToHtmlID.find("#sys_const_bh").val();
    var scroll_left = NowToHtmlID.find("#" + ToHtmlID + "_content").scrollLeft();
    //alert(b_ok);
    if (NowToHtmlID.find("#sys_const_ChangePrev_zd").val() != '' || NowToHtmlID.find("#sys_const_ChangeNext_zd").val() != '') { //&& (sys_const_ChangePrev_zd  != '' || sys_const_ChangeNext_zd != '') 
        $.post("moban_set_data.php", {
            act: "e_col",
            c_ok: c_ok,
            b_ok: b_ok,
            sys_const_Start_Suoding: sys_const_Start_Suoding,
            sys_const_End_Suoding: sys_const_End_Suoding,
            sys_const_prev_zd: sys_const_prev_zd,
            sys_const_ChangePrev_zd: NowToHtmlID.find("#sys_const_ChangePrev_zd").val(),
            sys_const_ChangeNext_zd: NowToHtmlID.find("#sys_const_ChangeNext_zd").val(),
            sys_const_this_zd: sys_const_this_zd,
            scroll_left: scroll_left,
            ToHtmlID: ToHtmlID,
            re_id: re_id
        }, function (data) {
            //alert(data);
            UpdatePhp_Pc(re_id, 'B_moban_list'); //这里更新所有php生成文件并刷新 表头，loading 数据页
            NowToHtmlID.find("#sys_const_c_ok").val('0');
            NowToHtmlID.find("#sys_const_b_ok").val('0');

            NowToHtmlID.find("ul.thead li").removeClass("category_thead");
            NowToHtmlID.find("ul.thead li").removeClass("category_thead_left");


            NowToHtmlID.find("#sys_const_s_h").val('0');
            NowToHtmlID.find("#sys_const_C_xu_now").val('0');

            NowToHtmlID.find("#sys_const_Start_Suoding").val(0);
            NowToHtmlID.find("#sys_const_End_Suoding").val(0);

            NowToHtmlID.find("#sys_const_prev_zd").val('');
            NowToHtmlID.find("#sys_const_ChangePrev_zd").val('');
            NowToHtmlID.find("#sys_const_ChangeNext_zd").val('');
            NowToHtmlID.find("#sys_const_this_zd").val('');

            //ListGet(ToHtmlID);//加载数据
            //List_Head_Get(ToHtmlID)//加载表头
        });
        shuqianmenu_user_update(ths, ToHtmlID); //更新记忆功能
    };
}

function copycol_over(ths, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var q_h = NowToHtmlID.find("#sys_const_q_h").val();
    var c_ok = NowToHtmlID.find("#sys_const_c_ok").val();
    var b_ok = NowToHtmlID.find("#sys_const_b_ok").val();
    if (NowToHtmlID.find("#sys_const_s_h").val() == 1) {
        $(ths).addClass("category_thead_left");
    }

    if (q_h == 0 && c_ok != 0) {
        NowToHtmlID.find("#sys_const_b_ok").val(ths.name);
        var C_xu_now = NowToHtmlID.find("#sys_const_C_xu_now").val() * 1
        var xu_now = $(ths).attr("xu") * 1
        if (xu_now != C_xu_now) {

        }
    }
    $(document).click(function (event) {
        NowToHtmlID.find("#sys_const_c_ok").val('0');
        NowToHtmlID.find("#sys_const_b_ok").val('0');
        $(ths).removeClass("category_thead");
        NowToHtmlID.find("#sys_const_s_h").val('0');
        NowToHtmlID.find("#sys_const_C_xu_now").val('0');
    }); //点空文档时的处理方法
}

function copycol_out(ths, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    NowToHtmlID.find("#sys_const_b_ok").val('0');
    $(ths).removeClass("category_thead");
    $(ths).removeClass("category_thead_left");
}

function hh_tr(tabletr, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02

    NowToHtmlID.find(tabletr).each(function (i) {
        this.style.backgroundColor = ['#ffffff', '#F5F5F5'][i % 2]
    }) //以下为隔行换色
    //$("input").each(function(){$(this).attr("hidefocus","true");})//复选框去虚线
}

//===============================================================================点UL行变色
function changeULcolor(ths, classname, moveyes) { //moveyes==1时添加变换
    $(ths).siblings().addClass('ulbg').removeClass(classname);
    $(ths).addClass('ulbg').removeClass(classname);
    if (moveyes == 1) {
        $(ths).removeClass('ulbg').addClass(classname);
    } //移除所有样式
}
//===============================================================================点UL行变色
function ulclassll(ths, parttable, thisclass) {
    $(parttable).addClass('ulbg').removeClass(thisclass); //原样式'highlight'
    $(ths).removeClass('ulbg').addClass(thisclass); //移除原样式
}

//=====================================================================================打开下方菜单设定窗口
function addbox(heg, callback, o_clise, wid, ToHtmlID) { //o_clise当不为空时便只执行展开不执行关闭$("#moban_set").ajaxSuccess(function(){})//排音加载
    //$('#addbox').hide(0);
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    NowToHtmlID.find('.content_footbox').hide();
    NowToHtmlID.css({
        display: "block",
        "bottom": "44px",
        "width": "100%",
        "height": 0,
        "border-left": 0,
        "border-right": 0,
        "border-bottom": 0
    }); //首先最小化再设定高度
    //$("#addbox").animate({height:0});

    //alert(wid);
    if (wid == '' || wid == null || wid == 'undefined') {
        NowToHtmlID.css({
            "width": '100%',
            "margin": 0
        });
    } else {
        NowToHtmlID.css({
            "width": wid,
            "margin-left": $(document).width() - wid - 3,
            "border": "2px solid #5A5A5A"
        });
    }
    ajaxboxload("#moban_set"); //读取中...
    document.all.addbox.style.visibility = "visible";
    var heig = $(document).height() * heg * 1;
    NowToHtmlID.css({
        height: heig,
        width: "100%"
    });
    //Foot_Height(0.8,ToHtmlID);//调整内容页高度与添加修改页高度

    NowToHtmlID.find("#" + ToHtmlID + "_content_left", "#" + ToHtmlID + "_content", "#" + ToHtmlID + "_content_right").css({
        "margin-bottom": heig
    });
    callback;
    NowToHtmlID.find("ul.htmlleirong").css({
        height: heig - 62
    });
    NowToHtmlID.find(".heeaadmenu2").hide(); //清空题头
    var nowts = $("#moban_set input[nothis!='nothis']");
    nowts.die("dblclick", function () {
        this.select();
    }).live("dblclick", function () {
        this.select();
    });
    $("input").die("keydown", function () {
        keydownchange(event, this);
    }).live("keydown", function () {
        keydownchange(event, this);
    });

    //alert(callback)
}

//--------------------------------------------------------------------------------关闭下方菜单设定窗口
function hiddenbox(heig, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    if (heig == 0) {
        $("#addbox").hide(0);
    } else {
        $("#addbox").animate({
            height: heig
        }, 1).animate({
            height: 0
        }, 1);
    };

    NowToHtmlID.find('#' + ToHtmlID + '_foot li').removeClass("footcheck");
    $("#addbox").css({

        "border-left": "0px",
        "border-right": "0px",
        "bottom": "0px",
        "left": "0px",
        "right": "0px"
    });
    maxcontheight(ToHtmlID); //最大化内容窗口
}
//--------------------------------------------------------------------------------关闭下方菜单设定窗口
function Hidden_ConTent_Box(heig, ToHtmlID, box) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    //alert(NowToHtmlID);

    if (heig == 0) {
        $(box).hide(0);
    } else {
        $(box).animate({
            height: heig
        }, 500).animate({
            height: 0
        }, 400);
    };

    NowToHtmlID.find('#' + ToHtmlID + '_foot li').removeClass("footcheck");
    $(box).css({
        "border-left": "0px",
        "border-right": "0px",
        "bottom": "0px",
        "left": "0px",
        "right": "0px"
    });
    //if(box='#content_foot'){
    maxcontheight(ToHtmlID); //最大化内容窗口
    //}

}
//--------------------------------------------------------------------------------关闭下方编辑设定窗口
function hidden_Edit_Box(heig, ToHtmlID) {

    if (heig == 0) {
        $("#addbox").hide(0);
    } else {
        $("#addbox").animate({
            height: heig
        }, 5).animate({
            height: 0
        }, 5);
    };

    $('#' + ToHtmlID + '_foot li').removeClass("footcheck");
    $("#addbox").css({

        "border-left": "0px",
        "border-right": "0px",
        "bottom": "0px",
        "left": "0px",
        "right": "0px"
    });
    maxcontheight(ToHtmlID); //最大化内容窗口
}

function addboxbg(ths, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    NowToHtmlID.find('#' + ToHtmlID + '_foot li').removeClass("footcheck");
    NowToHtmlID.find('#' + ToHtmlID + '_foot ' + ths).addClass("footcheck");
}

function ajaxboxload(datahtml, id) { //加载时提示
    switch (id) {
        case 1:
            {
                $(datahtml).html("&nbsp;&nbsp;Loading...");
            };
            break;
        default:
            {
                $(datahtml).html("<div style='padding:15px;' align='left'>&nbsp;&nbsp;Loading...</div>");
            };
    }
}

function tabchange(obj, p, c, q, h) {
    $(obj).parent().find("li").attr("class", "" + q + "");
    $(obj).parents("." + p + "").find("." + c + "").hide();
    $(obj).attr("class", "" + h + "");
    var j = $(obj).index();
    $(obj).parents("." + p + "").find("." + c + ":eq(" + j + ")").show();
} /**/

function tihuanxinhao(xdiv) {
    $(xdiv).each(function (i) {
        if ($(this).text().length > 1) {
            $(this).text($(this).text().substring(0, 1) + "***");
        }
    });
}

function maxcontheight(ToHtmlID) ////这里下方菜单关闭时，数据表格最大化显示
{
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var heig = $("#" + ToHtmlID).height() * 1 - 14;
    NowToHtmlID.find("#" + ToHtmlID + "_content_left", "#" + ToHtmlID + "_content", "#" + ToHtmlID + "_content_right").css({
        "margin-bottom": "0"
    });
}

function Foot_Height(heg, ToHtmlID, box) //这里下方菜单开启时，数据表格最缩小显示
{

    if (!box) {
        box = "#" + ToHtmlID + "_content_foot";
    }
    var NowToHtmlID = DIVHtmlID(ToHtmlID, ''); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02

    var heig = $("#" + ToHtmlID).parents('body').height() * heg * 1;
    //alert(heig);
    NowToHtmlID.find(box).css({
        "display": "block",
        "bottom": "0px",
        "height": heig
    });
    NowToHtmlID.find('.content_footbox').css("overflow-y", "auto");
    //var mainsheight=NowToHtmlID.find("#"+ToHtmlID+"_content").height()* 1 + 0;
    DIVHtmlID(ToHtmlID, 'fanall').find("#" + ToHtmlID + "_content_left", "#" + ToHtmlID + "_content", "#" + ToHtmlID + "_content_right").css({
        "margin-bottom": heig - 42
    });

};

//=============================================================================//数据添加

function add_data(ths, id, ToHtmlID) {

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID, 'content_foot');
    //var id=495;
    var re_id = NowToHtmlID.find("#sys_const_re_id").val();
    var hy = NowToHtmlID.find("#sys_const_hy").val();
    if (id == '') {
        var sys_guanxibiao_id = $("#" + ToHtmlID).attr('sys_guanxibiao_id'); //得到关系表里的id
        var GuanXi_id = $("#" + ToHtmlID).attr('GuanXi_id'); //得到对应关系re_id
    } else {
        var sys_guanxibiao_id = '';
        var GuanXi_id = '';
    }

    Foot_Height(0.8, ToHtmlID); //打开编辑的页面
    //alert(ToHtmlID);
    //NowToHtmlID.find("#"+ToHtmlID+"_content").scrollTop(nowscrolltop);     //滚动条位置记住
    //alert(sys_guanxibiao_id+'_'+GuanXi_id);
    $.get('B_moban_add.php', {
        act: "list",
        strmk_id: id,
        sys_guanxibiao_id: sys_guanxibiao_id,
        GuanXi_id: GuanXi_id,
        ToHtmlID: ToHtmlID,
        re_id: re_id
    }, function (data) {
        //alert(data);
        NowToHtmlID_content_foot.find('.htmlleirong').html("<ul id='tagContent' class='tagContent' >" + data + "</ul>");
    }); //这里打开模版
    if (id > 0) { //为复制时
        NowToHtmlID_content_foot.find('.headleft').html("<a class='selectTag'>复制添加</a>");
    } else { //为添加时
        NowToHtmlID_content_foot.find('.headleft').html("<a class='selectTag'>添加</a>");
    };
    addboxbg('#footseid13', ToHtmlID);

    //if(ToHtmlID.indexOf("_MenuDiv_") >= 0){
    //$("#"+ToHtmlID).find('#content_foot').hide();
    //}

}
//=============================================================================//数据修改
function edit_data(ths, id, ToHtmlID, hy) {
    // console.log(1332)
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID, 'content_foot');

    var re_id = NowToHtmlID.find("#sys_const_re_id").val();
    var huis = NowToHtmlID.find("#sys_const_huis").val();
    var nowscrolltop = NowToHtmlID.find("#" + ToHtmlID + "_content").scrollTop();
    var sys_guanxibiao_id = $("#" + ToHtmlID).attr('sys_guanxibiao_id'); //得到关系表里的id
    var GuanXi_id = $("#" + ToHtmlID).attr('GuanXi_id'); //得到对应关系re_id
    //Edit_Box(0.8,'','open','',ToHtmlID); //打开编辑的页面并ajax加载修改页面
    Foot_Height(0.8, ToHtmlID); //调整内容页高度与添加修改页高度

    //alert('id:'+id+';sys_guanxibiao_id:'+sys_guanxibiao_id+';GuanXi_id:'+GuanXi_id+';re_id:'+re_id+';ToHtmlID:'+ToHtmlID+';huis:'+huis);

    NowToHtmlID.find("#" + ToHtmlID + "_content").scrollTop(nowscrolltop); //滚动条位置记住
    $.get('B_moban_edit.php', {
        act: "list",
        strmk_id: id,
        sys_guanxibiao_id: sys_guanxibiao_id,
        GuanXi_id: GuanXi_id,
        re_id: re_id,
        ToHtmlID: ToHtmlID,
        huis: huis
    }, function (data) {
        // console.log(data);
        var html = $("<ul id='tagContent' class='tagContent' >" + data + "</ul>");
        NowToHtmlID_content_foot.find('.htmlleirong').html(html);
        // if ($("#ZD_TuPian").length > 0) {
        //     // createuploada({'inputid':'ZD_TuPian'});
        // }

    }); //这里打开模版
    // NowToHtmlID_content_foot.find('.headleft').html("<a class='selectTag'>编辑</a>");
    // //NowToHtmlID.find('.headleft').html('<ul><li class="h_333" id="main_top_5">&nbsp;&nbsp;&nbsp;</li></ul>');
    // $('#' + ToHtmlID + '_foot li').css({
    //     background: "",
    //     border: "0"
    // });
    // //Use_SyS_Div = ToHtmlID; //操作层面
    // //NowToHtmlID.find(".htmlleirong").css({"width":"55%"});
    // if ($(ths).hasClass("rightli")) {
    //     var nowindex = $(ths).parent().index(); //得到最右边li当前的位置。
    // } else {
    //     var nowindex = $(ths).index(); //得到ul当前的位置。
    // };

    // NowToHtmlID.find("#" + ToHtmlID + "_content_left").find("ul").not(".thead").find("li:eq(0)").html("");
    // NowToHtmlID.find("#" + ToHtmlID + "_content_left").find("ul").not(".thead").eq(nowindex).find("li:eq(0)").html("✓"); //✓▣☄<i class='fa fa-next-h' style='margin-left:-2px;'></i>

    // var nowthishtml_1 = NowToHtmlID.find("#" + ToHtmlID + "_content").find("ul").not(".thead").eq(nowindex).find("li").eq(1).text(); //这里找到相关内容
    // var nowthishtml_2 = NowToHtmlID.find("#" + ToHtmlID + "_content").find("ul").not(".thead").eq(nowindex).find("li").eq(2).text(); //这里找到相关内容
    // //var nowthishtml_3=NowToHtmlID.find("#"+ToHtmlID+"_content").find("ul").not(".thead").eq(nowindex).find("li").eq(3).text();//这里找到相关内容
    // var nowthishtml = nowthishtml_1 + '&nbsp;' + nowthishtml_2;
    // //alert(nowthishtml);
    // $('#' + ToHtmlID).attr("editdata_cn", nowthishtml); //这里记住修改的内容

}
//=============================================================================//数据加载
function edit_data_get(id, ToHtmlID, hy) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var re_id = NowToHtmlID.find("#sys_const_re_id").val();
    var url_this = 'cache/' + hy + '/B_moban_edit_Data/B_moban_edit_Data_' + re_id + '.php';
    NowToHtmlID.find('.htmlleirong #tagContent').show(500);
    //alert(id+ToHtmlID+hy);//var data;
    $.get(url_this, {
        act: "list",
        strmk_id: id,
        re_id: re_id,
        ToHtmlID: ToHtmlID
    }, function (data1) {
        //alert(url_this);		
        //alert(data1);
        NowToHtmlID.find('.htmlleirong #tagContent').append(data1);
    });

}
//=====================================================================================打开下方编辑加载窗口
function Edit_Box(heg, callback, o_clise, wid, ToHtmlID) { //o_clise当不为空时便只执行展开不执行关闭
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    ajaxboxload("#" + ToHtmlID + " .htmlleirong  #tagContent"); //读取中...
    //document.all.content_foot.style.visibility = "visible";
    //Foot_Height(heg,ToHtmlID);//调整内容页高度与添加修改页高度
    callback;
    var nowts = NowToHtmlID.find(".htmlleirong input[nothis!='nothis']");
    nowts.die("dblclick", function () {
        this.select();
    }).live("dblclick", function () {
        this.select();
    });
    $("input").die("keydown", function () {
        keydownchange(event, this);
    }).live("keydown", function () {
        keydownchange(event, this);
    });

    //alert(callback)
}
//=============================================================================//数据回收
function huis_data(id, ToHtmlID, DELtablename, act) {
    if (act + '1' == '1') {
        act = 'dels_huis';
    }
    var re_id = parseInt(ToHtmlID.replace(/[^0-9]/ig, ""));
    //alert(ToHtmlID);
    //alert(re_id);
    $.post('B_moban_del.php', {
        id: id,
        act: act,
        DELtablename: DELtablename,
        ToHtmlID: ToHtmlID,
        re_id: re_id
    }, function () {
        AjaxLoad('moban_huis.php', 'list', '#addbox .htmlleirong  #tagContent', '', 'GET', ToHtmlID);
    });
    //;
}
//==================================================================将所有选中复选框值得到成数组
var sys_js_arrychestr = [];

function sys_js_chestr(divid, inputname, ToHtmlID) { //sys_js_chestr('#addbox .htmlleirong  #tagContent','tianjia',ToHtmlID)
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var chestr = [];
    NowToHtmlID.find(divid + " input[name=" + inputname + "]:checked").each(function () {
        chestr.push($(this).val());
    });
    sys_js_arrychestr = chestr.join(',');
}

function keydownchange(e, ths) //==================================================回车换行
{
    e = e ? e : window.event; //var e = e || window.event; 
    var keyCode = e.which ? e.which : e.keyCode; //获取按键值
    if (e.keyCode == 13 || e.keyCode == 40) {
        e.keyCode = 9
    } else if (e.keyCode == 38) {
        $(ths).parents("ul").prev().find("*").focus()
    };
}


function showbox(controlMenu, num, prefix) {
    var content = prefix + num;
    $('#' + content).siblings().hide();
    $('#' + content).show();
    maxheights('#' + content, 250);
    controlMenu.eq(num).addClass("current").siblings().removeClass("current");
};

function idNumber(prefix) {
    var idNum = prefix;
    return idNum;
};
/* ==================================================================限制DIV最大高  */
function maxheights(divId, maxHeight) {
    var targetDiv = $(divId);
    targetDiv.css("height", "auto");
    if (targetDiv.height() > maxHeight) {
        targetDiv.css("height", maxHeight + "px");
        targetDiv.css("overflow-y", "scroll");
    };
};

function enterthis(ths, ToHtmlID) { //这里按确认件时触发事件
    $(ths).keyup(function (event) {
        if (event.keyCode == 13) {
            //alert(callbacks);
            //ListGet(ToHtmlID);//加载数据
            //List_Page_Get(ToHtmlID);//分页
            //hiddenbox(0, ToHtmlID); //关闭foot
            //callbacks;
        };
        return false;
    });
    //};
    //if(event.keyCode==13){alert("0")};
    return false;
};

//=============================================================================//数据修改
function Edit_Post(id, ToHtmlID, DELtablename, act) {
    if (act + '1' == '1') {
        act = 'dels_huis';
    }
    var re_id = parseInt(ToHtmlID.replace(/[^0-9]/ig, ""));

    $.post('B_moban_del.php', {
        id: id,
        act: act,
        DELtablename: DELtablename,
        ToHtmlID: ToHtmlID,
        re_id: re_id
    }, function () {

    });
    /**/
    //;
}
//=============================================================================//加载数据完成时执行
function ListLoadEND(ToHtmlID, FormattingXianShi_idlist, zu_all_list) {
    // console.log(123)
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    Copy_Content(ToHtmlID);
    contenthovermore(ToHtmlID);
    moveheng(ToHtmlID);
    if (NowToHtmlID.find("#page_v").length > 0) {
        NowToHtmlID.find("#page_v").attr("cs", NowToHtmlID.find("#page_v").val());
    };
    if(FormattingXianShi_idlist){
        var arr = FormattingXianShi_idlist.split(',');
        $.each(arr, function (index, j) {
            // console.log(j);
            // console.log(j, ToHtmlID, zu_all_list, '', '')
            FormattingXianShi(j, ToHtmlID, zu_all_list, '', '')
            // console.log(12366)
        });
    }
    LoodingClosed(ToHtmlID);
}
//=============================================================================//拷貝数据页面
function Copy_Content(ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'content_ALL'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、
    //----------------------------------------------#content_left
    NowToHtmlID.find('#' + ToHtmlID + '_content_left').show(); //显示容器
    $nowcopy = NowToHtmlID.find('#' + ToHtmlID + '_content #para').clone();
    NowToHtmlID.find('#' + ToHtmlID + '_content_left').html($nowcopy);
    NowToHtmlID.find('#' + ToHtmlID + '_content_left #para').attr({
        id: "",
        width: "",
        "min-width": ""
    });
    NowToHtmlID.find("#" + ToHtmlID + "_content_left ul li").not('.shuodingli').remove();
    NowToHtmlID.find("#" + ToHtmlID + "_content_left div").css({
        backgroundColor: "",
        width: "",
        "min-width": "",
        height: "",
        "border-bottom": "1px solid #CCC"
    });
    NowToHtmlID.find("#" + ToHtmlID + "_content_left div ul").css({
        backgroundColor: "",
        width: "",
        "min-width": ""
    });
    //----------------------------------------------#content_right
    NowToHtmlID.find('#' + ToHtmlID + '_content_right').show(); //显示容器
    $nowcopy = NowToHtmlID.find('#' + ToHtmlID + '_content #para').clone();
    NowToHtmlID.find('#' + ToHtmlID + '_content_right').html($nowcopy);
    NowToHtmlID.find("#" + ToHtmlID + "_content_right ul li").not('.rightli').remove();
    NowToHtmlID.find("#" + ToHtmlID + "_content ul li.rightli").remove();
    NowToHtmlID.find("#" + ToHtmlID + "_content_right").css({
        height: "",
        width: "53px",
        left: "auto",
        right: "17px"
    });
    //NowToHtmlID.find("#"+ToHtmlID+"_content_right div").css({backgroundColor: "","width": "95px","min-width": "","margin-bottom": "76px"	});
    //NowToHtmlID.find("#"+ToHtmlID+"_content_right div ul").css({"width": "90px","min-width": ""	});
    NowToHtmlID.find('#' + ToHtmlID + '_content_right #para').attr({
        id: "",
        width: "",
        "min-width": ""
    });
}
//============================================================================= 拷貝头部
function Copy_Head(tables, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'banner_left'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02

    NowToHtmlID.show(); //显示容器
    $nowcopy = $('#' + ToHtmlID + '_banner').find(tables).clone();
    NowToHtmlID.html($nowcopy);

    NowToHtmlID.find(tables).attr({
        id: "",
        width: "",
        "min-width": ""
    });
    NowToHtmlID.find("ul li").not('.shuodingli').remove(); //alert(nowwidth);
    NowToHtmlID.find("div").css({
        backgroundColor: "",
        width: "",
        "min-width": "",
        height: "",
        "border-bottom": "1px solid #CCC"
    });
    NowToHtmlID.find("div ul").css({
        'backgroundColor': "",
    });
    // var nowwidth = NowToHtmlID.find("div ul").width() * 1+1;
    // console.log(NowToHtmlID);
    // //var nowheight = NowToHtmlID.find("#"+ToHtmlID+"_content").height() * 1 - 196;
    NowToHtmlID.css({
        backgroundColor: "",
        width: "",
        "min-width": "",
        height: ""
    });
    NowToHtmlID.find("div").css({
        width: 'auto',
        "min-width": "",
        height: ""
    });
    NowToHtmlID.find("div ul").css({
        backgroundColor: "",
        width: 'auto',
        "min-width": ""
    });
    //$('#'+ToHtmlID+'_banner').css({width:auto});
    //-----------------------------------------------文件编号 和 书签
    wjbh_biaoqian_copy(ToHtmlID);
}
//============================================================================= 拷貝文件编号和书签
function wjbh_biaoqian_copy(ToHtmlID) {

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    //alert(ToHtmlID);
    //--------------------------------------------文件编号
    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
    if (NowToHtmlID.find('.wjbh').length > 0) {
        var nowhtml = NowToHtmlID.find('.wjbh').html();
        NowToHtmlID.find('.headwjbh').html(nowhtml);
        NowToHtmlID.find('.wjbh').remove();
    }
    //--------------------------------------------标签
    if (NowToHtmlID.find('#head_biaoqian_copy').length > 0) {
        var nowhtml = NowToHtmlID.find('#head_biaoqian_copy').html();
        NowToHtmlID.find('.ShuQianMenu').html(nowhtml);
        NowToHtmlID.find('#head_biaoqian_copy').remove();
    }
}
//=================================================================禁止右键菜单
// document.oncontextmenu=new Function('event.returnValue=false;');

//=====================================================================加载foot搜索条
