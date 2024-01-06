

//===============================================================================加载ajax函数
function AjaxLoad_mobile(datapage, act, datahtml, callback, types, ToHtmlID, donghua) {
   //alert('0');
    if (!types) {
        types = "post";
    }
    if (!ToHtmlID) {
        ToHtmlID = "";
    }
    if (!donghua) {
        donghua = "";
    }
    var NowToHtmlID = $('#'+ToHtmlID); //AjaxLoad('moban_set_data.php',act,nowclassdiv,'','post',ToHtmlID);
    var hy = NowToHtmlID.find("#sys_const_hy").val();
    if (hy == "undefined") {
        hy = "";
    }
    //alert(datahtml);
    var bh = NowToHtmlID.find("#sys_const_bh").val();
    if (bh == "undefined") {
        bh = "";
    }
    var sys_const_pagetype = $("#sys_const_pagetype").val(); //这里得到页面类型，listpage,delpage,huispage
    if (sys_const_pagetype == "undefined") {
        sys_const_pagetype = "listpage";
    }

    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
    var keyword = NowToHtmlID.find("#keyword").val(); //进行中文编码转译
    //alert(keyword);
    if (NowToHtmlID.find("#zu").length > 0) {
        var zu = NowToHtmlID.find("#zu").val();
    } else {
        zu = 0;
    }

    if (NowToHtmlID.find("#zd").length > 0 && keyword != "") {
        var zd = NowToHtmlID.find("#zd").val();
    } else {
        zd = "0";
    }
    var ShaiXuanSql = NowToHtmlID.find("#ShaiXuanSql").val(); //得到筛选SQL
    var px_name = NowToHtmlID.find("#sys_const_px_name").val();
    if (px_name == 'sys_nowbh') {
        px_name == 'sys_bh';
    }
    var pxv = NowToHtmlID.find("#sys_const_pxv").val();
    var pok = 1; //$("#sys_const_pok").val();

    if (NowToHtmlID.find("#page_v").length > 0) {
        var page = NowToHtmlID.find("#page_v").val() * 1;
    } else {
        page = 1;
    }
    //datastrmk="act="+act+"&page="+page+"&zu="+zu+"&keyword="+keyword+"&re_id="+re_id+"&zd="+zd+"&px_name="+px_name+"&pxv="+pxv+"&pok="+pok+"&bh="+bh+"&hy="+hy+"&ShaiXuanSql="+ShaiXuanSql;
    //alert(datastrmk);
    //alert('http://localhost/m/Machine_MobileV1.0/'+datapage+"?"+datastrmk);//测试地址生成
    $.ajax({
        type: types,
        async: true,
        contentType: "application/x-www-form-urlencoded; charset=utf-8",
        url: datapage,
        data: {
            act: act,
            page: page,
            zu: zu,
            keyword: keyword,
            re_id: re_id,
            zd: zd,
            px_name: px_name,
            pxv: pxv,
            pok: pok,
            bh: bh,
            hy: hy,
            sys_const_pagetype: sys_const_pagetype,
            ShaiXuanSql: ShaiXuanSql
        },
        success: function (data) {
            // alert(123)
            // alert(data);
            if (datahtml != '') {
                if (donghua == 'donghua') {
                    $(datahtml).html(data);
                    $(datahtml).hide(0).show(600);
                } else {
                    $(datahtml).html(data);
                }

                if (callback != '') {
                    callback;
                } //加载函数
                LoodingClosed(ToHtmlID);
            }
            //alert(data);
        },
        error: function (data) {
            alert('页面：' + datapage + '?' + act);
            //alert(data);
        }
    })
}
//---------------------------------------------------------------------------------------------------------------------删除数据到回收站
function Del_To_Huishou_mobile(ToHtmlID) { //删除数据到回收站

    //alert(NowToHtmlID);
    var NowToHtmlID = $('#'+ToHtmlID); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;

    sys_js_chestr("#index", "ID", ToHtmlID);
    if (sys_js_arrychestr == "") {
        alert("您没选数据！");
        return false;
    } else {

        if (confirm("是否删除？") == false) {
            return false;
        }
        //alert(sys_js_arrychestr);
        LoodingDiv(ToHtmlID); //Loading...
        $.post('M_moban_del.php', {
            id: sys_js_arrychestr,
            act: "Del_To_Huis",
            ToHtmlID: ToHtmlID,
            re_id: re_id
        }, function (data) {
            //NowToHtmlID.find("#chkall").attr("checked", false);
            //ListGet_mobile(ToHtmlID);//加载数据
            // DeskMenu(ToHtmlID); //这里加载数据

        });
    }
}
//---------------------------------------------------------------------------------------------------------------------切到指定底部菜单
function search_on(addmenu, ToHtmlID) { //search_on('#addmenu01')
    var NowToHtmlID = $('#'+ToHtmlID);
    NowToHtmlID.find('.addmenu').animate({
        height: '0'
    });
    $(addmenu).animate({
        height: '50px'
    });
    if (addmenu == '#addmenu03') {
        NowToHtmlID.find('.nowcolfirst').show();
        NowToHtmlID.find('#sys_const_pagetype').val('delpage'); //这里切换到删除、编辑页面
        NowToHtmlID.find('#catalog li').each(function () {
            //alert($(this).attr('onclick'));
            var nowonclick = $(this).attr('onclick');
            $(this).attr('tit', nowonclick);
            $(this).attr('onclick', '');
        })
    } else {
        NowToHtmlID.find('.nowcolfirst').hide();
        NowToHtmlID.find('#sys_const_pagetype').val('listpage'); //这里切换到数据页面
        NowToHtmlID.find('#catalog li').each(function () {
            //alert($(this).attr('onclick'));
            var nowtit = $(this).attr('tit');
            if (nowtit != '') {
                $(this).attr('onclick', nowtit);
            }

        })
    }
    if (addmenu == '#addmenu02') { //这里搜索到

    }
    NowToHtmlID.find("#addbox").hide(100); //这里关闭添加窗口

}


//---------------------------------------------------------------------------------------------------------------------读取层——显示
function LoodingDiv(ToHtmlID) {
    var NowToHtmlID = $('#'+ToHtmlID);
    //alert(NowToHtmlID);
    NowToHtmlID.find('.mask_lood').show(1);
    NowToHtmlID.find('.mask_lood').animate({
        height: '100%',
        width: '100%'
    }, 30);
}
//---------------------------------------------------------------------------------------------------------------------读取层_关闭
function LoodingClosed(ToHtmlID) {
    var NowToHtmlID = $('#'+ToHtmlID);
    alert(NowToHtmlID);
    NowToHtmlID.find(".mask_lood").hide(1);
    NowToHtmlID.find('.mask_lood').animate({
        height: '0',
        width: '0'
    }, 600);
}

//---------------------------------------------------------------------------------------------------------------------搜索提交
function searchenter_mobile(ToHtmlID) { //search_enter_mobile(ToHtmlID)
    var NowToHtmlID = $('#'+ToHtmlID);
    //alert('00');
    NowToHtmlID.find("#page_v").val('1');
    ListGet_mobile(ToHtmlID); //数据页
    List_Page_Get_mobile(ToHtmlID); //分页
}

//---------------------------------------------------------------------------------------------------------------------下拉分类菜单框架
function xiala_menu_Get_mobile(ToHtmlID) {
    var NowToHtmlID = $('#'+ToHtmlID);
    //alert(NowToHtmlID);
    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;

    if (NowToHtmlID.find(".shadowdiv").size() == 0) {
        //alert(re_id);
        NowToHtmlID.find('#' + ToHtmlID + '_content_right_menu').html('<img src="/images/055.gif" hspace="0" vspace="0"/>');
        $.post("M_moban_xiala.php", {
            act: "sousuoxiala",
            ToHtmlID: ToHtmlID,
            re_id: re_id,
        }, function (data) {
            NowToHtmlID.find('#sousuoxiala').html(data).show(300);
            //alert(data);
        });
        //AjaxLoad_mobile('M_moban_xiala.php', 'sousuoxiala', '#sousuoxiala', '', 'GET', ToHtmlID);
    }
    NowToHtmlID.find(".sousuoxiala").toggle(); //关闭与打开切换
}
//---------------------------------------------------------------------------------------------------------------------下拉分类选中时
function xiala_menu_checked_mobile(ths,id,ToHtmlID) {
    var NowToHtmlID = $('#'+ToHtmlID);
    //alert(id);
    $(ths).parent().find('li').removeClass('changebeijin');
    $(ths).addClass('changebeijin');
    NowToHtmlID.find('#zu').val(id);
    NowToHtmlID.find('.xialatext').html($(ths).attr('tit'));
    NowToHtmlID.find(".sousuoxiala").hide();
    ListGet_mobile(ToHtmlID); //重新加载搜索数据；
    List_Page_Get_mobile(ToHtmlID); //分页
}

//---------------------------------------------------------------------------------------------------------------------提交触发
function keyup_mobile(enterid) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == 13) {
        $(enterid).click(); //这里触发指定键
    };
}
//---------------------------------------------------------------------------------------------------------------------数据页加载
function ListGet_mobile(ToHtmlID) {
    LoodingDiv(ToHtmlID); //Loading...
    var NowToHtmlID = '#' + ToHtmlID+' #catalog ul';
    AjaxLoad_mobile("M_moban_list.php", 'list', NowToHtmlID, "LoodingClosed("+ToHtmlID+")", 'GET', ToHtmlID );
}
//---------------------------------------------------------------------------------------------------------------------数据页结束后执行的代码
function list_data_end_mobile(pagetype,ToHtmlID) { 
    var NowToHtmlID = $('#'+ToHtmlID);
    if (pagetype == 'listpage') { //listpage数据页面 delpage删除页面 huispage回收页面
        NowToHtmlID.find('.nowcolfirst').hide(); //隐藏选择框
    } else if (pagetype == 'delpage') {
        NowToHtmlID.find('.nowcolfirst').show(); //打开选择框
    } else if (pagetype == 'huispage') {
        //$('.nowcolfirst').show();    //打开选择框
    }
    if (NowToHtmlID.find('#page_v').length > 0) {
        document.all.page_v.cs = document.all.page_v.value
    };
}
//---------------------------------------------------------------------------------------------------------------------数据页表头加载
function List_Head_Get(ToHtmlID) {
    var NowToHtmlID = "#" + ToHtmlID + "_banner";
    AjaxLoad_mobile('M_moban_list_top.php', 'list', NowToHtmlID, '', 'GET', ToHtmlID);
}
//---------------------------------------------------------------------------------------------------------------------分页统计数据
function List_Page_Get_mobile(ToHtmlID) {
    var NowToHtmlID = '#' + ToHtmlID+ ' #moban_foot';
    //alert(NowToHtmlID);
    //NowToHtmlID.find('#moban_foot').html('<img src="/images/055.gif"/>');
    AjaxLoad_mobile('M_moban_foot.php', 'list', NowToHtmlID, '', 'GET', ToHtmlID);

}
//---------------------------------------------------------------------------------------------------------------------下拉分类选中时
function search_enter_mobile(ths,ToHtmlID) {
    var NowToHtmlID = $('#'+ToHtmlID);
    NowToHtmlID.find('#zu').val(id);
    NowToHtmlID.find('.xialatext').html($(ths).attr('tit'));
    NowToHtmlID.find("#xiala,.sousuoxiala").hide();
    ListGet_mobile(ToHtmlID); //重新加载搜索数据；
    List_Page_Get_mobile(ToHtmlID); //加载页码
}


//==================================================================================分页  


function FpageRO(ths, pageID, JJ, ToHtmlID) //分页
{
    //alert(page+"_"+xt+"_"+TSdivID);
    
    var pages = $(pageID).val() * 1 + JJ; //得到控件的值
    Fpage(pages, 0, ToHtmlID); //这里执行分页；
}

function chatmsg(ToHtmlID, postform) //调整对话框高度
{
    //alert(ToHtmlID);
    var NowToHtmlID = $('#'+ToHtmlID);
    var postformheight = NowToHtmlID.find('#addbox').height() - 120;
    //alert(postformheight);
    NowToHtmlID.find('#' + postform + ' .chatmsg').height(postformheight);
    NowToHtmlID.find('#' + postform + ' .chatmsg').scrollTop($('#' + postform + ' .chatmsg')[0].scrollHeight);
    NowToHtmlID.find('#' + postform + ' .inputmsg').focus();
}


function Fpage(page, xt, ToHtmlID) //分页函数蓝1368(|< < > >|)  灰2457(有页数)
{
    //alert(page+"_"+xt+"_"+TSdivID);
    var NowToHtmlID = $('#'+ToHtmlID);
    var maxpage = NowToHtmlID.find("#page_v").attr("pgc") * 1;
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
        //LoodingDiv(ToHtmlID);
        ListGet_mobile(ToHtmlID); //加载数据
    };
}
//===============================================================================输入跳转页限制
function duibi_mobile(thstitle, a, ths,ToHtmlID) {
    var NowToHtmlID = $('#'+ToHtmlID);
    var bvlue = $(ths).val();
    //alert(thstitle);
    $(ths).val($(ths).val().replace(/\D/g, '')); //只允许输入数字
    //if ($(ths).val() * 1 <= 0) {
    //$(ths).val('1');
    //}; //$("#page_v").select();
    if ($(ths).val() * 1 > a * 1) {
        alert("不得超过最大页“" + a + "”！请重输。");
        $(ths).attr({
            "cs": thstitle,
            "pgc": a
        });
        NowToHtmlID.find("#page_v").val(thstitle);
    } //$("#page_v").select();
}


//---------------------------------------------------------------------------------------------------------------------显示界面格式化样式
function FormattingXianShi(id, ToHtmlID) {
    /*有问题*/
    var NowToHtmlID = $('#'+ToHtmlID);
    switch (id) { //0为普通文本模式
        case '1':
            { //货币
                //if (texts==''||texts==null||texts=='undefined'){texts='¥'};//判定为空时默认为人民币/样式/¥ 100.00
                NowToHtmlID.find('.F_M_XS_1').each(function (i) {
                    $(this).html('¥ ' + formatCurrency($(this).text()))
                });
            };
            break;
        case '2':
            { //日期YYYY-DD-HH
                //if (texts==''||texts==null||texts=='undefined'){texts='¥'};//判定为空时默认为人民币
                //$('.F_M_XS_1').each(function(i){$(this).html($(this).text().toString().replace(/[^(^(\d{4}|\d{2})(\-|\/|\.)\d{1,2}\3\d{1,2}$)|(^\d{4}年\d{1,2}月\d{1,2}日$)$]/ig,""))});//.substr(0,10)取0-10个字符
            };
            break; //加载表头左右
        case '3':
            {};
            break;
        case '4':
            { //文件附件
                NowToHtmlID.find('.F_M_XS_4').each(function (i) {
                    var thistext = $(this).text().trim();
                    if (thistext == '' || thistext == null || thistext == 'undefined') {
                        $(this).html(" ");
                    } else {
                        $(this).html("<a href=" + thistext + " title=" + thistext + " target='_blank'><img src='../images/201011111733401978.png' border='0' height=" + ($(this).height() - 4) + " /></a>")
                    }
                });
            };
            break;
        case '5':
            { //图像加载原图
                NowToHtmlID.find('.F_M_XS_5').each(function (i) {
                    $(this).html("<img src=" + $(this).text() + " height=" + ($(this).height() - 4) + " />");
                });
            };
            break;
        case '6':
            { //图像不加载原图
                NowToHtmlID.find(".F_M_XS_6").each(function (i) {
                    $(this).html("<a href=" + $(this).text() + " target='_blank'><img src='../images/img.png' border='0' height=" + ($(this).height() - 4) + " /></a>")
                })
            }
            break;
        default:
            {
                alert('FormattingXianShi(没有可执行的格式化参数！)');
            }
    }
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
    var NowToHtmlID = $('#'+ToHtmlID);
    index_eq = $(ths).parent().parent().index(); //得到当前列全局行位置。
    if (!NowToHtmlID.find("#" + divFieldType)) return;
    NowToHtmlID.find("#" + divFieldType).css({
        'position': 'absolute',
        'display': 'block',
        'top': $(ths).position().top + 10,
        'left': $(ths).position().left - 4,
        'overflow': 'no',
        width: wid,
        'z-index': 160
    });
    //$("#"+divFieldType+" li").css({width:wid}); 
    if (NowToHtmlID.find("#" + divFieldType).attr('kg') == 'ok') {
        return false;
    } else {
        NowToHtmlID.find("#" + divFieldType).attr('kg', 'ok');
    }; //查看已加载属性/只加载一次
    if (wid > 0) {
        NowToHtmlID.find("#" + divFieldType).show()
    };
    $(ths).addClass("linelihover");

    //$("#"+divFieldType).focus();
}


//===============================================================================以下为以下关闭指定元素
function CloseDIV(div1, ToHtmlID) {
    var NowToHtmlID = $('#'+ToHtmlID);
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

//=============================================================================//数据添加
function add_data_mobile(ToHtmlID) {
    var NowToHtmlID = $('#'+ToHtmlID);
    //alert(ToHtmlID);
    var re_id = NowToHtmlID.find("#sys_const_re_id").val();
    //var url_this='cache/9007/M_moban_edit_Data/M_moban_edit_Data_'+re_id+'.php';
    //alert(re_id);
    NowToHtmlID.find('#addbox').show(1).animate({
        height: '70%',
        width: '100%'
    });
    //$('.moban_set_menu').remove();

    NowToHtmlID.find('#addbox' + ' .head .headleft').html("<a class='selectTag'>添加</a>");
    NowToHtmlID.find('#addbox' + ' .htmlleirong').html('<ul id="tagContent" class="tagContent" ></ul>');

    //act="list,strmk_id:"+id;
    //alert(ToHtmlID);
    //if (seidfoot_edit_JS_OK != 1) {
    //$.getScript('../../js/jquery.seidfootedit.js');
    //}; //没有时便加载js

    //Foot_Height(0.7,ToHtmlID);
    //if ($('#post_form').length>0){
    $.get('M_moban_add.php', {
        act: "list",
        re_id: re_id,
        ToHtmlID: ToHtmlID
    }, function (data) {
        NowToHtmlID.find('#addbox' + ' .htmlleirong ul').html(data);
        //$('#addbox .htmlleirong').hide(1).show(500);
    }); //这里打开模版	
    //}


}
//===============================================================================以下为关闭addbox
function Closebox_mobile(ths,box,ToHtmlID) {
    //alert(ToHtmlID);
    var NowToHtmlID = $('#'+ToHtmlID);
    NowToHtmlID.find(box).hide(0);
    NowToHtmlID.find(box).animate({
        width: 0,
        height: 0
    }, 50);
    
}


//【ok】======================================================================================================下方#addbox的头部菜单
function SelectTag_Menu_mobile(showContent, ths, ToHtmlID, sys_guanxibiao_id, GuanXi_id) { // 操作标签///*这里自适应宽度的TAB选项框*
    //SelectTag_Menu('tagContent1',this,'DeskMenuDiv321','1',32304)
    //alert(GuanXi_id);
    
    var NowToHtmlID = $('#'+ToHtmlID);
    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
    var $datahtml = "#" + ToHtmlID + ' #addbox #' + showContent;
    var $Noweditbox = "#" + ToHtmlID + ' #addbox';
    
    SelectMenu($(ths).parent(), ths); //【这里TAB框切换】
    $($Noweditbox + ' .tagContent').hide(1); //这里隐藏所有层
    //alert(re_id);
    //---------------------------------------------------【如果没有时添加显示层】
    if ($($datahtml).size() == 0) {
        NowToHtmlID.find("#addbox").find('.htmlleirong').append("<ul class='tagContent' id='" + showContent + "'></ul>");
    }

    if (showContent != 'tagContent' && showContent != 'tagContent0') {
        $($datahtml).html('&nbsp;&nbsp;&nbsp;&nbsp;loading...');
        //AjaxLoad("moban_set_data.php",act,$datahtml,'','post',ToHtmlID);//这里加载内容
        $.post('../../../MachineV1.0/moban_guanxi.php', {
            act: "XianJieBiao",
            sys_guanxibiao_id: sys_guanxibiao_id,
            GuanXi_id: GuanXi_id,
            ToHtmlID: ToHtmlID,
            re_id: re_id
        }, function (data) {
            //alert(data);
            $($datahtml).html(data);
        });
    } else if (showContent == 'tagContent0') {
        alert('这里设定关系表！');
    } else if (showContent == 'tagContent') {

    } else {
        $($datahtml).html('<div class="ConTentATO">&nbsp;&nbsp;&nbsp;&nbsp;loading...</div>');

        /**/
        //alert(GuanXi_id);
        $.post('M_moban_list.php', {
            act: "list",
            sys_guanxibiao_id: re_id,
            GuanXi_id: GuanXi_id,
            ToHtmlID: ToHtmlID,
            re_id: now_re_id
        }, function (data) {
            //alert(data);
            $($datahtml).find('.ConTentATO').html(data);
        });
    }
    //$('#tagContent').hide();
    NowToHtmlID.find("#" + showContent).show(1); //这里显示层

    //$("#" + showContent).show(1);//这里显示层

    //alert(showContent);
    //---------------------------------------------------【当为非层时关闭】
    //if(showContent=='tagContent'){
    //$('#tagContent').hide();
    //}
    /*
    $("#msg").css({
    	    position:'fixed',
    	    bottom:'-35px',
    	    top:auto,
    	    "z-index":'1000000',
    	    float: 'left',
    	    width: '90%'
    });
    */

} ///*这里自适应宽度的TAB选项框end*/


//=============================================================================//【设定】
function Set_Mobile(ToHtmlID) {
    var NowToHtmlID = $("#" + ToHtmlID);
    //alert(ToHtmlID);
    var re_id = NowToHtmlID.find("#sys_const_re_id").val();

    NowToHtmlID.find('#addbox').show(1).animate({
        height: '70%',
        width: '100%'
    });
    //$('.moban_set_menu').remove();

    NowToHtmlID.find('#addbox' + ' .head .headleft').html("<a class='selectTag' onclick='SelectTag_Menu(\"tagContent\",this,\"" + ToHtmlID + "\")'>设定</a> <a  onclick='SelectTag_Menu(\"tagContent1\",this,\"" + ToHtmlID + "\")'>字段</a> <a onclick='SelectTag_Menu(\"tagContent2\",this,\"" + ToHtmlID + "\")'>显示</a>");
    NowToHtmlID.find('#addbox' + ' .htmlleirong').html('<ul id="tagContent" class="tagContent" ></ul>');

    //act="list,strmk_id:"+id;
    //alert(ToHtmlID);


    $.get('moban_set.php', {
        act: "jbsd",
        re_id: re_id,
        ToHtmlID: ToHtmlID
    }, function (data) {
        NowToHtmlID.find('#addbox' + ' .htmlleirong ul').html(data);
        //$('#addbox .htmlleirong').hide(1).show(500);
    }); //这里打开模版	
    //alert(hztopy_JS_OK);
    if (hztopy_JS_OK == 0) {
        $.getScript('../../js/hztopy-min.js');
    }; //没有时便加载js


}


//=============================================================================//数据修改【模版页】

function edit_data(ths, id, ToHtmlID, hy) { //edit_data(this,'32304','DeskMenuDiv321','9007')
    if (!ths) {
        ths = "";
    };
    var NowToHtmlID = $("#" + ToHtmlID);
    
    var re_id = NowToHtmlID.find("#sys_const_re_id").val();
    //var url_this='cache/'+hy+'/M_moban_edit_Data/M_moban_edit_Data_'+re_id+'.php';
    //alert(url_this);
    //act="list,strmk_id:"+id;
    //NowToHtmlID.find("#addbox").hide(1);    //这里添加
    NowToHtmlID.find("#addbox .tagContent").hide(1); //这里隐藏//下方菜单
    NowToHtmlID.find('#addbox').show(0).animate({
        height: '70%',
        width: '100%'
    });
    NowToHtmlID.find('#addbox' + ' .head .headleft').html("<a class='selectTag'>编辑</a>");
    //alert(NowToHtmlID);
    $.get('M_moban_edit.php', {
        act: "list",
        strmk_id: id,
        re_id: re_id,
        ToHtmlID: ToHtmlID
    }, function (data) {
        //alert(data);
        //alert(id);
        
        NowToHtmlID.find('#addbox #tagContent').html(data);
        //alert(id+ToHtmlID+hy);
        //var data='';
        var nowhtml=$("#addbox .moban_set_menu").html();
        alert(nowhtml);
        NowToHtmlID.find('#addbox' + ' .head .headleft').html(nowhtml);
        edit_data_get(id, ToHtmlID, hy); //加载数据
        NowToHtmlID.find('#addbox .head .tabs').find("a").removeClass("selectTag");
        NowToHtmlID.find('#addbox .head .tabs a:first-child').addClass("selectTag");
    }); //这里打开模版


    if ($(ths).hasClass("rightli")) {
        var nowindex = $(ths).parent().index(); //得到最右边li当前的位置。
    } else {
        var nowindex = $(ths).index(); //得到ul当前的位置。	
    };

    NowToHtmlID.find("#addbox #tagContent").show(0); //这里显示层
    //NowToHtmlID.find("#"+ToHtmlID+"_content_left").find("ul").not(".thead").find("li:eq(0)").html("");
    //NowToHtmlID.find("#"+ToHtmlID+"_content_left").find("ul").not(".thead").eq(nowindex).find("li:eq(0)").html("✓");//✓▣☄<i class='fa fa-next-h' style='margin-left:-2px;'></i>
    //$(".htmlleirong").show(500);//这里显示层
    $(ths).parent().find("li").removeClass('selectTag');
    $(ths).addClass("selectTag");
    //var nowhtml=$(ths).html();
    var nowthishtml = $(ths).find('a').text(); //这里找到相关内容
    NowToHtmlID.attr("editdata_cn", nowthishtml); //这里记住修改的内容
}


//=============================================================================//数据加载【数据页】
function edit_data_get(id, ToHtmlID, hy) {
    var NowToHtmlID = $("#" + ToHtmlID);
    //alert(ToHtmlID);
    var re_id = NowToHtmlID.find("#sys_const_re_id").val();
    var url_this = 'cache/' + hy + '/M_moban_edit_Data/M_moban_edit_Data_' + re_id + '.php';
    $.get(url_this, {
        act: "list",
        strmk_id: id,
        re_id: re_id,
        ToHtmlID: ToHtmlID
    }, function (data) {
        alert(data);
        NowToHtmlID.find('#addbox #post_form').append(data);
    });
}

//=====================================================================================打开下方编辑加载窗口
function Edit_Box(heg, callback, o_clise, wid, ToHtmlID) { //o_clise当不为空时便只执行展开不执行关闭
    if (!callback) {
        callback = "";
    };
    if (!wid) {
        wid = "";
    };
    var NowToHtmlID = $("#" + ToHtmlID);
    //alert("0");
    NowToHtmlID.find("#addbox").css({ //首先最小化再设定高度
        display: "block",
        "bottom": "44px",
        "height": 0,
        "border-left": 0,
        "border-right": 0,
        "border-bottom": 0
    });

    NowToHtmlID.find("#addbox").animate({
        height: 0
    });
    //alert(wid);
    if (wid == '' || wid == null || wid == 'undefined') {
        NowToHtmlID.find("#addbox").css({
            "width": '100%',
            "margin": 0
        });
    } else {
        NowToHtmlID.find("#addbox").css({
            "width": wid,
            "margin-left": $(document).width() - wid - 3,
            "border": "2px solid #5A5A5A"
        });
    }
    ajaxboxload("#" + ToHtmlID + " .htmlleirong"); //读取中...

    //document.all.editbox.style.visibility = "visible";
    var heig = $(document).height() * heg * 1;
    NowToHtmlID.find("#addbox").animate({
        height: heig * 0.96
    }, 400).animate({
        height: heig
    }, 260, function () {
        callback;
    });
    NowToHtmlID.find("#addbox  ul.htmlleirong").animate({
        height: heig - 62
    }, 10);
    NowToHtmlID.find("#addbox  .heeaadmenu2").hide(); //清空题头
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
    Foot_Height(0.7, ToHtmlID);
    //alert(callback)
}


//==================================================================将所有选中复选框值得到成数组
var sys_js_arrychestr = [];

function sys_js_chestr(divid, inputname, ToHtmlID) { //sys_js_chestr('#addbox .htmlleirong','tianjia',ToHtmlID)
    var NowToHtmlID = $('#'+ToHtmlID); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var chestr = [];
    NowToHtmlID.find(divid + " input[name=" + inputname + "]:checked").each(function () {
        chestr.push($(this).val());
    });
    sys_js_arrychestr = chestr.join(',');
}


//=============================================================================//数据修改
function Edit_Post(id, ToHtmlID, DELtablename, act) {
    if (!DELtablename) {
        DELtablename = "";
    };
    if (!act) {
        act = "dels_huis";
    };

    var re_id = parseInt(ToHtmlID.replace(/[^0-9]/ig, ""));
    //alert(ToHtmlID);
    //var NowToHtmlID = "#" + ToHtmlID;
    //alert(re_id);

    $.post('M_moban_del.php', {
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


//=============================================================================//定位到最前面一个文本框
function inputfocusfirst(tableid, inpuname) {
    $(tableid + ' input[name="' + inpuname + '"]').focus();
    $(tableid + ' .htmlleirong').animate({
        'scrollTop': '0'
    }, 500); //有动画
}


//[ok]=========================================================================================更新记录
function edit_biao_col(tableneme, search_zd, search_value, tochang_zd, tochang_value) {

    $.post('../../../MachineV1.0/moban_set_data.php', {
        act: 'edit_biao_col',
        tableneme: tableneme,
        search_zd: search_zd,
        search_value: search_value,
        tochang_zd: tochang_zd,
        tochang_value: tochang_value
    }, function (data) {
        //alert(data);
    });
    //alert(tableneme+','+search_zd+','+search_value+','+tochang_zd+','+tochang_value);
};


//=================================================================清空元素中表单数据
function Input_clear_all(formclass) { //Input_clear_all("#addbox li.reset_list")//清空表单为空
    $(formclass).find(':input[type="text"]', ':textarea').val(''); //以下为清空所有表单
    $(formclass).find(':checkbox').attr("checked", false);
}


function EnterPress(e, ths, callback) { //
    e = e ? e : window.event; //var e = e || window.event; 
    var keyCode = e.which ? e.which : e.keyCode; //获取按键值
    if (e.keyCode == 13) {
        callback;
    } else if (e.keyCode == 38) {
        $(ths).parents("ul").prev().find("*").focus();
    };
}
//===============================================================================radio选中值
function radiochecek(radioname, checkvalue, ToHtmlID) {
    var NowToHtmlID = $("#" + ToHtmlID);
    if (checkvalue) {
        NowToHtmlID.find("input[name='" + radioname + "'][value='" + checkvalue + "']").attr("checked", "true");
    }
}
//=================================================================禁止右键菜单
// document.oncontextmenu=new Function('event.returnValue=false;');

//=====================================================================加载foot搜索条


//【new mobile】====================================================================================================================================【new mobile】


//[ok]=========================================================================================更新记录
function add_edit_mobile(ths, postpage, act, urlpage) {
    var formid = $(ths).parents('form');
    // form_weikong_mobile(formid);
    var nowbitiantishilength = $(formid).find('.bitiantishi').length; //必填提示个数
    var nowchongfulength = $(formid).find('.chongfuzhi').length; //验重提示个数
    var nowlength = nowbitiantishilength + nowchongfulength;
    // console.log($(formid))
    // alert(postpage);
    // alert(nowlength);
    if (nowlength > 0) {
        $(formid).find('#editsuccess').show().html('有必填项!').hide(2000);
    } else {
        var xserializeArray = formid.serializeArray();
        console.log(xserializeArray)
        
        xserializeArray = xserializeArray.map((item) => {
            if(item.name === 'sys_beizhu'){
                item.value = editor.html()
            }
            return item
        })
        // console.log(postpage)
        $.ajax({
            type: "post",
            act: act,
            async: true,
            url: postpage,
            data: xserializeArray,
            success: function (data) {
                // alert(data);
                var nowsss = $(ths).parent().find("#SYS_lianxu:checked").size(); //得到是否选中连续提交
                if (data == '添加成功！' || data == '修改成功！') {
                    // alert(urlpage);
                    if (nowsss == '1') { //当为连续提交时
                        //alert('连续提交');
                        $(ths).parent().find('#reset_add').click();
                        $(ths).parent().find("#SYS_lianxu").attr("checked", "true");
                    } else {
                        window.location.href = urlpage; //跳转到指定页面
                    }

                } else {
                    alert("有错误:" + data);
                }
            },
            error: function () {
                alert('修改时出现错误,未保存成功！');
                $('#addbox #editsuccess').text('');
            }
        });
    }
    //alert(tableneme+','+search_zd+','+search_value+','+tochang_zd+','+tochang_value);
};
//[ok]=========================================================================================删除记录
function del_mobile(act, id, tablename, urlpage, posturlpage) {

    if (id > 0 && tablename > '') {
        if (confirm("你确定要删除么?")) {
            $.post(posturlpage + '_del.php', {
                act: act,
                id: id,
                tablename: tablename
            }, function (data) {
                window.location.href = urlpage; //跳转到指定页面
                //alert(data);
            });
        } else {
            alert("已取消");
        }
    }
};
//=================================================================form判断是否有必填字段是执行
function form_weikong_mobile(formid) { //(formid)

    //------------------------------------------------//分页出现提示
    var $w_Kongimg = '<i class="fa fa-gantan bitiantishi tishi"  title="必填字段，不能为空。">'; //感叹号图片
    var $w_NO_Kongimg = '<i class="fa fa-gou tishi" title="pass"></i>'; //OK图片
    $(formid).find('ul').each(function () {
        var thisval = $(this).find('input').val();
        var thisbitian = $(this).find('.s_bt').length;
        //alert(thisval);
        var valname = $(this).find('input').attr("name"); //得到控件的name
        var nowLeiXin = $(this).find('input').attr("type"); //得到控件的类型
        //====================================================为TEXT\textarea时执行
        if (nowLeiXin == 'text' || nowLeiXin == 'textarea') {
            var nowzhi = $(this).find('input').val(); //得到控件的值
            //alert(nowzhi);
            $(this).find('input').bind("keyup", function () {
                if ($(this).val().length * 1 > 0) {
                    $('#' + $(this).attr('name') + '_bitian').html($w_NO_Kongimg);
                } else {
                    $('#' + $(this).attr("name") + '_bitian').html($w_Kongimg);
                };
                form_menutishi(formid); //分类菜单出现提示
            }); //绑定keyup事件
            if (thisval == "") {
                $('#' + valname + '_bitian').html($w_Kongimg);
            }; //当文本框为空时，在右边出现提示。
            //====================================================单选框、多选框、复选框
        } else if (nowLeiXin == 'radio' || nowLeiXin == 'checkbox') { //
            var nowzhi = $(this).find('input:checked').val(); //得到控件的值
            $(this).find('input').bind("click", function () {
                if ($(formid + ' input[name=' + $(this).attr("name") + ']:checked').length * 1 > 0) {
                    $('#' + $(this).attr("name") + '_bitian').html($w_NO_Kongimg);
                } else {
                    $('#' + $(this).attr("name") + '_bitian').html($w_Kongimg);
                };
                form_menutishi(formid); //分类菜单出现提示
            }); //绑定keyup事件
            if ($(formid + ' [name=' + valname + ']:checked').length * 1 == 0) {
                $('#' + valname + '_bitian').html($w_Kongimg);
            }; //当文本框为空时，在右边出现提示。
            //====================================================下拉框
        } else if (nowLeiXin == 'select') { //
            var nowzhi = $(this).find('input').val(); //得到控件的值
            $(this).find('input').bind("change", function () {
                if ($(this).val() != "") {
                    $('#' + $(this).attr("name") + '_bitian').html($w_NO_Kongimg);
                } else {
                    $('#' + $(this).attr("name") + '_bitian').html($w_Kongimg);
                };
                form_menutishi(formid); //分类菜单出现提示
            }); //绑定keyup事件
            if (nowzhi == "") {
                $('#' + valname + '_bitian').html($w_Kongimg);
            }; //当文本框为空时，在右边出现提示。
        } else {
            var nowzhi = $(this).find('input').val(); //得到控件的值
            $(this).find('input').bind("keyup", function () {
                if ($(this).val().length * 1 > 0) {
                    $('#' + $(this).attr("name") + '_bitian').html($w_NO_Kongimg);
                } else {
                    $('#' + $(this).attr("name") + '_bitian').html($w_Kongimg);
                };
                form_menutishi(formid); //分类菜单出现提示
            }); //绑定keyup事件
            if (nowzhi == "") {
                $('#' + valname + '_bitian').html($w_Kongimg);
            }; //当文本框为空时，在右边出现提示。
            //绑定onchange事件。
        };


    });


}
//=================================================================form判断是否有必填字段是执行
function form_menutishi_mobile(formid) { //(formid)
    //alert(formid);
    var nowlength = 0;

    $(formid + ' .ContentTwo').each(function () {
        var nowclass = parseInt($(this).attr('class').replace(/[^0-9]/ig, ""));
        //alert(nowclass);
        var nowbitiantishilength = $(this).find('.bitiantishi').length; //必填提示个数
        var nowchongfulength = $(this).find('.chongfuzhi').length; //验重提示个数
        var nowlength = nowbitiantishilength + nowchongfulength;
        if (nowlength == 0) {
            $(formid + ' .two_menu ul').eq(nowclass).find('.bitian_wuchong_tongji').hide(600).html(nowlength);
        } else {
            $(formid + ' .two_menu ul').eq(nowclass).find('.bitian_wuchong_tongji').show(600).html(nowlength);
        }
        //alert(nowlength);
        //alert($(this).attr('class'));
    });
    //var $w_Kongimg = '<i class="fa fa-gantan bitiantishi tishi"  title="必填字段，不能为空。">'; //感叹号图片
    //var $w_NO_Kongimg = '<i class="fa fa-gou tishi" title="pass"></i>'; //OK图片
}

//=================================================================SearchToggle
function SearchToggle(ths) { //(this)
    $('#wrapper .rightmenu').hide(300); //关闭右边菜单
    $('#wrapper .topsearchmenu').toggle(300); //打开关闭搜索菜单
}
//=================================================================Search
function SearchGet(act, huis, posturlpage, id, parent_id) { //(this)
    //alert(posturlpage);
    //alert(id);
    var keyword = $('#keyword').val();
    $.get(posturlpage + '_ajax.php', {
        act: act,
        id: id,
        parent_id: parent_id,
        huis: huis,
        keyword: keyword
    }, function (data) {
        $('#catalog ul').html(data);
        //window.location.href = urlpage; //跳转到指定页面
        // console.log(data);
        $(".topedit_menu_foot").hide();
    });

}

//=================================================================批量编辑
function editmore() { //(this)
    $('#index input[name="ID"]').removeProp('checked', ''); //清除所有选中
    $('#index ul li').each(function () {
        $(this).find("input").toggle(300);
    });
    $(".topedit_menu_foot").toggle(300);
    $('#wrapper .rightmenu').hide(300); //关闭右边菜单

}
//===============================================================================选中取消整个div等中选复选框
function selectGroup_mobile(ths) {
    var nowlength = $('#index input[name="ID"]').length; //总个数
    var nowcheckedlength = $('#index input[name="ID"]:checked').length; //选中个数
    //alert(nowlength);
    //alert(nowcheckedlength);
    if (nowlength == nowcheckedlength) { //当为取消全部时
        $('#index input[name="ID"]').removeProp('checked', $(ths).find('a').text('全选'));
    } else {
        $('#index input[name="ID"]').prop('checked', $(ths).find('a').text('取消全选'));
    }
}
//===============================================================================选中取消整个div等中选复选框
function checkedGroup_mobile(ths) {
    var nowlength = $('#index input[name="ID"]').length; //总个数
    var nowcheckedlength = $('#index input[name="ID"]:checked').length; //选中个数
    //alert(nowlength);
    //alert(nowcheckedlength);
    if (nowlength == nowcheckedlength) { //当为取消全部时
        $('.topedit_menu_foot .site1').text('取消全选');
    } else {
        $('.topedit_menu_foot .site1').text('全选');
    }
}
//---------------------------------------------------------------------------------------------------------------------批量删除数据或回收数据
function DelToHuishou_mobile(act, tablename, huis, posturlpage, id,parent_id) { //删除数据到回收站//id,是指大类菜单，并不指当前选中id
    var valarry = []; //定义一个数组
    $('#index input[name="ID"]:checked').each(function () {
        valarry.push($(this).val()); //将选中值加入到数据中
    });
    var nowvalarry = valarry.join(",");
    //alert(nowvalarry);
    if (nowvalarry == "") {
        alert("您没选数据！");
        return false;
    } else {
        var tixing = "";
        if (act == "Del_To_Huis") {
            tixing = "确定删除？";
        } else if (act == "dels_huis") {
            tixing = "确定恢复？";
        } else if (act == "dels_true") {
            tixing = "确定彻底删除？";
            alert('彻删权限未做好');
        }

        if (confirm(tixing) == false) {
            return false;
        };
        //alert(nowvalarry);
        $.post('M_del.php', {
            id: nowvalarry,
            act: act, //批量删除到回收站
            tablename: tablename
        }, function (data) {
            //alert(data);
            var keyword = $('#keyword').val();
            $.post(posturlpage + '_ajax.php', {
                act: 'list',
                id: id,
                huis: huis,
                parent_id:parent_id,
                keyword: keyword
            }, function (data) {
                $('#catalog ul').html(data);
                $("#index ul li input").show();
                $(".topedit_menu_foot").show();
            });
        });
    }
}

//---------------------------------------------------------------------------------------------------------------------恢复单条数据
function DelToHuishou_mobile_one(act, id, tablename, huis, posturlpage, parentid) {
    var tixing = "";
    if (act == "Del_To_Huis") {
        tixing = "确定删除？";
    } else if (act == "dels_huis") {
        tixing = "确定恢复？";
    } else if (act == "dels_true") {
        tixing = "确定彻底删除？";
    }

    if (confirm(tixing) == false) {
        return false;
    };

    $.post('M_del.php', {
        id: id,
        act: act,
        tablename: tablename
    }, function (data) {
        //alert(data);
        var keyword = $('#keyword').val();
        $.post(posturlpage + '_ajax.php', {
            act: 'list',
            id: parentid,
            parentid:parentid,
            huis: huis,
            keyword: keyword
        }, function (data) {
            $('#catalog ul').html(data);
            $("#index ul li input").show();
            $(".topedit_menu_foot").show();
        });
    });

}

//---------------------------------------------------------------------------------------------------------------------统计职位对应的任命人员数
function Tongji_Renming(act, huis, posturlpage, id) {
    var keyword = $('#keyword').val();
    $.get(posturlpage + '_ajax.php', {
        act: act,
        id: id,
        huis: huis,
        keyword: keyword
    }, function (data) {
        $('.nowmenu_foot').html(data);
    });
}
//---------------------------------------------------------------------------------------------------------------------获取对应人员的职位
function Get_Renming(act, ths, huis, posturlpage, id, zhiwei_id) {
    var keyword = $('#keyword').val();
    $(".Get_Renming").remove();
    $.get(posturlpage + '_ajax.php', {
        act: act,
        id: id,
        huis: huis,
        zhiwei_id: zhiwei_id,
        keyword: keyword
    }, function (data) {
        // console.log(data)
        $(ths).after(data);
    });
}
//---------------------------------------------------------------------------------------------------------------------卸任职位
function Add_Renming(act, ths, posturlpage, id, zhiwei_id) {
    //var keyword = $('#keyword').val();
    //$(".Get_Renming").remove();
    $.get(posturlpage + '_ajax.php', {
        act: act,
        id: id,
        zhiwei_id: zhiwei_id
    }, function (data) {
        //alert(data);
        Get_ZWqiandan_one('list_renmen_one', ths, posturlpage, id, zhiwei_id); //得到单个人的职位清单
        //$(ths).after(data);
    });
}
//---------------------------------------------------------------------------------------------------------------------卸任职位
function Del_Renming(act, ths, posturlpage, id, zhiwei_id) {
    //var keyword = $('#keyword').val();
    //$(".Get_Renming").remove();
    $.get(posturlpage + '_ajax.php', {
        act: act,
        id: id,
        zhiwei_id: zhiwei_id
    }, function (data) {
        Get_ZWqiandan_one('list_renmen_one', ths, posturlpage, id, zhiwei_id); //得到单个人的职位清单
        // console.log(data);
        //$(ths).after(data);
    });
}
//---------------------------------------------------------------------------------------------------------------------得到单个人的职位清单
function Get_ZWqiandan_one(act, ths, posturlpage, id, zhiwei_id) {
    //var keyword = $('#keyword').val();
    //$(".Get_Renming").remove();
    console.log(act,id,zhiwei_id)
    $.get(posturlpage + '_ajax.php', {
        act: act,
        id: id,
        zhiwei_id: zhiwei_id
    }, function (data) {
        console.log(data)
        $(ths).parent().prev().find('dd.hui').html(data);
        Tongji_Renming('Tongji_renmen', '0', posturlpage, zhiwei_id) //统计任命人员清单
        //$(ths).after(data);
    });
}
//=============================================================================//【生成PHP模版 手机版】
function UpdatePhp_Zw_mobile(act,zhiwei_id) {
    // console.log(zhiwei_id);
    $.post('../../MachineV1.0/B_quanxian_chache.php', {
        act: act,
        zwid: zhiwei_id
    }, function (data) {
        $.post('M_quanxian_chache.php', {
            act: act,
            zwid: zhiwei_id
        }, function (data) {
            $.post('../../MachineV1.0/B_menu_desk_chache.php', {
                act: act,
                zwid: zhiwei_id
            }, function (data) {
                $.post('M_menu_desk_chache.php', {
                    act: act,
                    zwid: zhiwei_id
                }, function (data) {
                    //parent.location.reload();
                });
            });
        });
    });
}
//=============================================================================//【校正数据库】
function postall_mobile(ths, connname) {
    //if(!connname) posturl='conn';
    alert('已提交，请等待处理完成。');
    $(ths).hide(1000);
    $.post('../../MachineV1.0/B_moban_SYS_data.php', {
        act: 'Conn_sys',
        connname: connname
    }, function (data) {
        alert(data + '数据库校正完成！');
    });
}
//=============================================================================//【清除缓存】
function deldir_mobile(act) {
    //if(!connname) posturl='conn';
    alert('已提交，请等待处理完成。');
    //$(ths).hide(1000); 
    $.post('../../MachineV1.0/B_moban_SYS_data.php', {
        act: 'deldir'
    }, function (data) {
        alert(data + '删除成功！');
    });
}
//=============================================================================//【权限设定】
function quanxian_mobile(ths, act, id, parent_id) {
    $.get('M_powers_quanxian_terms_ajax.php', {
        act: act,
        id: id,
        parent_id: parent_id
    }, function (data) {
        //alert(data);
        $('.quanxiandiv_parent').remove();
        $(ths).after(data);
        var thss = $(ths).find('.quanxiandiv_parent li');
        //$(ths).after(data);
    });
}

//=============================================================================//【隐藏】
function quanxiandiv_mobile(ths) {
    $('.quanxiandiv_parent').remove();
}
//=============================================================================//【更新职权范围】
function thistripnt_mobile(act, ths, hy) {
    var nowre_id = $(ths).attr('at'); //得到表单ID
    var nowinputname = $(ths).attr('name'); //得到inputname
    var nowchecked = "checked";
    var ZhiWei_id = $(ths).attr("bumenID"); //得到职位ID
    var checkvalue = $(ths).attr("value"); //得到选中值 
    //-----------------------------------------------按钮切换
    $(ths).parent().find("dt").removeClass('check');
    $(ths).addClass('check');
    //-----------------------------------------------数据提交
    //alert(checkvalue);
    //alert("http://localhost/MachineV1.0/moban_set_data.php?act="+act+"&colsre_id="+nowre_id+"&nowinputname="+nowinputname+"&nowchecked="+nowchecked+"&nowbumenid="+ZhiWei_id+"&checkvalue="+checkvalue+"&hy="+hy);
    //alert(act);
    $.post("../../MachineV1.0/moban_set_data.php", {
        act: act,
        colsre_id: nowre_id,
        nowinputname: nowinputname,
        nowchecked: nowchecked,
        nowbumenid: ZhiWei_id,
        checkvalue: checkvalue,
        hy: hy
    }, function (data) {
        // if(data){alert(data);}; //测试用
        changequxiao_quanxuan_mobile(ths);
        // UpdatePhp_Zw_mobile('list', ZhiWei_id); //职位权限及桌面对应php生成
    });
}
//=============================================================================//【更新职权】
function thistripnt_zhiwei_mobile(act, ths, hy) {
    var nowre_id = $(ths).attr('at'); //得到表单ID
    var nowinputname = $(ths).attr('name'); //得到inputname

    //var nowchecked=$(ths).attr("checked");
    var ZhiWei_id = $(ths).attr("bumenID"); //得到部门ID
    var checkvalue = $(ths).attr("value"); //得到选中值 
    var nowi = $(ths).find('i').hasClass('fa-28-3');
    if (nowi) {
        $(ths).find('i').removeClass('fa-28-3');
        $(ths).find('i').addClass('fa-27-3');
        nowchecked = '';
    } else {
        $(ths).find('i').removeClass('fa-27-3');
        $(ths).find('i').addClass('fa-28-3');
        nowchecked = 'checked';
    }
    changequxiao_quanxuan_mobile(ths);
    //alert("http://localhost/MachineV1.0/moban_set_data.php?act="+act+"&colsre_id="+nowre_id+"&nowinputname="+nowinputname+"&nowchecked="+nowchecked+"&nowbumenid="+ZhiWei_id+"&checkvalue="+checkvalue+"&hy="+hy);
    //alert(act);
    $.post("../../MachineV1.0/moban_set_data.php", {
        act: act,
        colsre_id: nowre_id,
        nowinputname: nowinputname,
        nowchecked: nowchecked,
        nowbumenid: ZhiWei_id,
        checkvalue: checkvalue,
        hy: hy
    }, function (data) {
        //if(data){alert(data);}; //测试用
        //alert(ZhiWei_id);
        // UpdatePhp_Zw_mobile('list', ZhiWei_id); //职位权限及桌面对应php生成
    });
}
//=============================================================================//【全选/取消全选状态改变 及统计 数据】
function changequxiao_quanxuan_mobile(ths) {

    var parentulchecksize_all = $(ths).parents('.quanxiandiv_parent').find('.content li').size() - 2; //父级下面的权限个数
    var parentulchecksize = $(ths).parents('.quanxiandiv_parent').find('.content li').find('.fa-28-3').size(); //选中框个数
    var qx_fanwei = $(ths).parents('.quanxiandiv_parent').find('.check').text();//权限范围
    if(qx_fanwei==''){qx_fanwei='未选';};
    //alert(parentulchecksize+'/'+parentulchecksize_all);
    if (parentulchecksize != parentulchecksize_all) { //未全选中或未选时
        $(ths).parent().find('.quanxuan').html('全选<dd class="hui"><i class="fa fa-21-1"></i></dd>');
    } else { //全选中时
        $(ths).parent().find('.quanxuan').html('取消全选<dd class="hui"><i class="fa fa-21-2"></i></dd>');
    }
    //alert(qx_fanwei);
    $(ths).parents('.quanxiandiv_parent').prev().find('dd.hui').html('['+parentulchecksize+'/'+parentulchecksize_all+']'+'&nbsp;['+qx_fanwei+']');

}
//=============================================================================//【全选/取消全选】
function thistripnt_hengxiang_mobile(ths) {
    var nowre_id = $(ths).attr('re_id'); //表单ID
    var ZhiWei_id = $(ths).attr("bumenID"); //职位ID
    var parentulchecksize_all = $(ths).parent().find('li').size() - 2; //父级下面的权限个数
    var parentulchecksize = $(ths).parent().find('.fa-28-3').size(); //选中框个数
    //alert(parentulchecksize+'/'+parentulchecksize_all);
    if (parentulchecksize != parentulchecksize_all) { //未全选中或未选时
        // alert('未全选');
        nowchecked = 1;
        $(ths).parent().find('.fa-27-3').addClass('fa-28-3').removeClass('fa-27-3');

        //$(ths).html('取消全选<dd class="hui"><i class="fa fa-21-2"></i></dd>');

    } else { //全选中时
        // alert('全选');
        nowchecked = 0;
        $(ths).parent().find('.fa-28-3').addClass('fa-27-3').removeClass('fa-28-3');
        //$(ths).html('全选<dd class="hui"><i class="fa fa-21-1"></i></dd>');
    }
    changequxiao_quanxuan_mobile(ths);
    //alert(nowchecked);
    $.post("../../MachineV1.0/moban_set_data.php", {
        act: 'Edit_ZWquanxian_Update_hengxiang',
        colsre_id: nowre_id,
        ZhiWei_id: ZhiWei_id,
        nowchecked: nowchecked
    }, function (data) {
        //if(data){alert(data);}; //测试用

        // UpdatePhp_Zw_mobile('list', ZhiWei_id); //职位权限及桌面对应php生成
    })
}
// =============================================================
function myFunction(value,act,tableName,id_name,id,fun){
    console.log({
        act,
        value,
        tableName,
        id_name,
        id
    })
    $.post("../../m/Machine_MobileV1.0/renew.php",{
        act,
        value,
        tableName,
        id_name,
        id
    }).then((data) => {
        fun(data)
        console.log(data)
    })
}