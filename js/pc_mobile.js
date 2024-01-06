//【ok】======================================================================================================选取层级部位
function DIVHtmlID(ToHtmlID, nowbody) { //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    // console.log(ToHtmlID, nowbody)
    var ToHtmlID=ToHtmlID.replace(/^Top_*/g,"");//去除以Top_字符串开头
    if (!nowbody || nowbody == '') {
        NowToHtmlID = $('#' + ToHtmlID);
    } else {
        NowToHtmlID = $('#' + ToHtmlID + ' #' + ToHtmlID + '_' + nowbody);
    }
    return NowToHtmlID;
}
//【ok】======================================================================================================选中菜单
function SelectMenu(partdiv, ths) {
    partdiv.find(".selectTag").removeClass("selectTag");
    $(ths).addClass("selectTag");
    //alert('切换成功');
}
//=============================================================================//【文件编号】
function Wenjianbiaohao(ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    //alert(NowToHtmlID);
    var re_id = parseInt(ToHtmlID.replace(/[^0-9]/ig, ""));
    //alert(re_id);
    $.post('../../MachineV1.0/B_moban_wjbh.php', {
        act: 'wjbh',
        re_id: re_id,
        ToHtmlID: ToHtmlID
    }, function (data) {
        NowToHtmlID.find('#header').find('.eleft').html(data);
    }); //这里将后面一个锁定列设定为非选中
    //alert(re_id);

}
//=============================================================================//【去前后符号】
function Move_SE_Fh(str, fh) { //(act//这里加载用户菜单
    var first_chr = str[0]; //首字
    var last_chr = str[str.length - 1]; //尾字
    if (first_chr == fh) {
        //alert('首字有字符');
        var str = str.substring(1);
    }
    if (last_chr == fh) {
        var str = str.substring(0, str.length - 1); //去掉末尾符号
        //alert('末字有字符');
    }
    return str;
}
//=============================================================================//【签名】
function sign(ths) {
    //alert('00');
    nowyvalue = $(ths).parent().find(":input").attr('y-value');

    //if(confirm("确定签名吗？")){
    //alert('提交成功');
    $.get('../../MachineV1.0/B_moban_get.php', {
        act: 'sign'
    }, function (data) {
        $(ths).parent().find(":input").val(data + nowyvalue);
    });
    //}else{
    //alert('未提交');
    //$(ths).parent().find(":input").val(nowyvalue);//改变为原记录
    //}
}
//=============================================================================//【审核签名】
function SignSH(ths) {
    //alert('00');
    nowyvalue = $(ths).parent().find(":input").attr('y-value');

    //if(confirm("确定通过审核吗？")){
    //alert('提交成功');
    $.get('../../MachineV1.0/B_moban_get.php', {
        act: 'sign'
    }, function (data) {
        $(ths).parent().find(":input").val('已审核 ' + data + nowyvalue);
    });
    //}else{
    //alert('未提交');
    //$(ths).parent().find(":input").val(nowyvalue);//改变为原记录
    //}
}
//=============================================================================//【批准签名】
function SignPZ(ths) {
    //alert('00');
    nowyvalue = $(ths).parent().find(":input").attr('y-value');

    //if(confirm("确定批准吗？")){
    //alert('提交成功');
    $.get('../../MachineV1.0/B_moban_get.php', {
        act: 'sign'
    }, function (data) {
        $(ths).parent().find(":input").val('已批准 ' + data + nowyvalue);
    });
    //}else{
    //alert('未提交');
    //$(ths).parent().find(":input").val(nowyvalue);//改变为原记录

    //}
}
//=============================================================================//控件赋值
function Inputdate(ziduan, lexin, htmltext, ToHtmlID, nowaddbox) {
    //alert(ziduan+','+lexin+','+htmltext+','+ToHtmlID);

    if (!lexin) {
        lexin = '1';
    }
    if (!htmltext) {
        htmltext = '';
    }
    htmltext = Move_SE_Fh(htmltext, '"'); //去除首尾符号

    if (!ToHtmlID) {
        ToHtmlID = 'index';
    }
    lexin = Number(lexin);
    if (!nowaddbox || nowaddbox == '') {
        nowaddbox = 'content_foot';
    }
    var NowToHtmlID = DIVHtmlID(ToHtmlID, nowaddbox); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var nowziduan = '#' + ziduan;
    if (ziduan == 'sys_id_zu') {
        lexin = 15;
    }
    //alert(nowziduan);

    switch (lexin) {
        case 1:
        case 2:
        case 20:
        case 21: //input文本框//textarea
            {
                NowToHtmlID.find(nowziduan).val(htmltext);
                break;
            }
        case 3:
        case 11:
        case 13:
        case 16:
        case 17:
        case 18:
        case 19:
        case 26: //单选
            {
                //alert('3');

                NowToHtmlID.find("input[name='" + ziduan + "'][value='" + htmltext + "']").attr("checked", "checked");
                break;
            }
        case 4:
            {
                NowToHtmlID.find(nowziduan).val(htmltext);
                break;
            }
        case 5:
            {
                NowToHtmlID.find(nowziduan).val(htmltext);
                break;
            }
        case 6:
            {
                NowToHtmlID.find(nowziduan).val(htmltext);
                break;
            }
        case 7:
            {
                NowToHtmlID.find(nowziduan).val(htmltext);
                break;
            }
        case 8:
            {
                NowToHtmlID.find(nowziduan).val(htmltext);
                break;
            }
        case 9:
            {
                NowToHtmlID.find(nowziduan).val(htmltext);
                break;
            }
        case 10:
            {
                NowToHtmlID.find(nowziduan).val(htmltext);
                break;
            }
        case 13: 
            {
                NowToHtmlID.find(nowziduan).val(htmltext);
                break;
            }
        case 14: //删除到回收站
            {

                var textarr = htmltext.split(',');
                for (var i in textarr) {
                    //alert(textarr[i]);
                    NowToHtmlID.find("input[name='" + ziduan + "'][value='" + textarr[i] + "']").attr("checked", "checked");
                }
                break;
            }

        case 15:
        case 27: //多选框改变value值 为多值
            {
                var textarr = htmltext.split(',');
                for (var i in textarr) {
                    //alert(textarr[i]);
                    if (nowaddbox == 'addbox') {
                        $("#addbox input[name='" + ziduan + "'][valid='" + textarr[i] + "']").attr("checked", "checked");
                    } else if (nowaddbox == '.mains_right_menu') {
                        $(".mains_right_menu input[name='" + ziduan + "'][valid='" + textarr[i] + "']").attr("checked", "checked");
                    } else {
                        NowToHtmlID.find("input[name='" + ziduan + "'][valid='" + textarr[i] + "']").attr("checked", "checked");
                    }

                }
                break;
            }
        default:
            {
                NowToHtmlID.find(nowziduan).val(htmltext); //文本框
            }
    }

}

//===============================================================================以下为关闭关系菜单拷到题头上
function guanximenucopy(ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'content_foot'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    //alert(NowToHtmlID);
    var nowlength = NowToHtmlID.find('.htmlleirong .moban_set_menu').size(); //这里查看是否有菜单可用
    if (nowlength > 0) {
        NowToHtmlID.find('.headleft').html(''); //这里清空题头
        var menuclone = NowToHtmlID.find('.moban_set_menu').html();
        //alert(menuclone);
        NowToHtmlID.find('.headleft').html(menuclone);
        NowToHtmlID.find('.htmlleirong .moban_set_menu').remove();
    }
}
//===============================================================================以下为[手机版]关闭关系菜单拷到题头上
function guanximenucopy_mobile(ToHtmlID) {
    var NowToHtmlID = $('#'+ToHtmlID);
    //alert('moban_set_menu');
    //var NowToHtmlID = DIVHtmlID(ToHtmlID, 'content_foot'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    //alert(ToHtmlID);
    var nowlength = NowToHtmlID.find(' .moban_set_menu').size(); //这里查看是否有菜单可用
    if (nowlength > 0) {
        var menuclone = NowToHtmlID.find('.moban_set_menu').html();
        //alert(menuclone);
        NowToHtmlID.find('.moban_set_menu').remove();
        NowToHtmlID.find('#addbox .headleft').html(menuclone);
    }
}

//=============================================================================//加载数据完成时执行
function ListLoadEND_Mobile(ToHtmlID, FormattingXianShi_idlist, zu_all_list) {
    console.log(1233)
    //alert(ToHtmlID);
    //form_weikong('#post_form',ToHtmlID);//检查为空值
    //guanximenucopy_mobile(ToHtmlID);//关系菜单
    
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    //Copy_Content(ToHtmlID);
    //contenthovermore(ToHtmlID);
    //moveheng(ToHtmlID);
    if (NowToHtmlID.find("#page_v").length > 0) {
        NowToHtmlID.find("#page_v").attr("cs", NowToHtmlID.find("#page_v").val());
    };

    var arr = FormattingXianShi_idlist.split(',');
    $.each(arr, function (index, j) {
        //alert(j);
        FormattingXianShi(j, ToHtmlID, zu_all_list, '', '');
    });
}
//---------------------------------------------------------------------------------------------------------------------删除数据
function Del_Really(ths, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
    sys_js_chestr('#' + ToHtmlID + '_content_right', 'ID', ToHtmlID);
    //alert('id:'+sys_js_arrychestr+'re_id:'+re_id);
    if (sys_js_arrychestr == "") {
        alert("请先选择需彻底删除的数据！");
    } else {
        if (confirm('确认删除?将无法恢复，请慎重！')) {
            $.post('B_moban_del.php', {
                id: sys_js_arrychestr,
                act: "dels_true",
                ToHtmlID: ToHtmlID,
                re_id: re_id
            }, function (data) {
                //alert(data);
                NowToHtmlID.find('#chkall:first-child').prop('checked', false);
                LoodingDiv(ToHtmlID);
                ListGet(ToHtmlID); //加载数据
                List_Page_Get(ToHtmlID); //分页
            });
        }
    }
}
//---------------------------------------------------------------------------------------------------------------------恢复数据
function Del_huisou(ths, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
    sys_js_chestr('#' + ToHtmlID + '_content_right', 'ID', ToHtmlID);
    //alert('id:'+sys_js_arrychestr+'re_id:'+re_id);
    var PartToHtmlID = ToHtmlID.replace("HUIS_", "");
    if (sys_js_arrychestr == "") {
        alert("请先选择需回复的数据！");
    } else {
        if (confirm('确要恢复该数据么？')) {
            $.post('B_moban_del.php', {
                id: sys_js_arrychestr,
                act: "dels_huis",
                ToHtmlID: ToHtmlID,
                re_id: re_id
            }, function (data) {
                //alert(data);
                NowToHtmlID.find('#chkall:first-child').prop('checked', false);
                //-------------------------------------回收站刷新
                LoodingDiv(ToHtmlID);
                ListGet(ToHtmlID); //加载数据
                List_Page_Get(ToHtmlID); //分页
                //-------------------------------------父级刷新
                LoodingDiv(PartToHtmlID);
                ListGet(PartToHtmlID); //加载数据
                List_Page_Get(PartToHtmlID); //分页
            });
        }
    }
}
//---------------------------------------------------------------------------------------------------------------------加载参数
function looddata(id, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID, 'content_foot');
    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
    //alert(re_id);
    if (NowToHtmlID.find("#zu").length > 0) {
        zu = NowToHtmlID.find("#zu").val();
    } else {
        zu = 0;
    }
    switch (id) {
        case 9:
            {
                if (this.value * 1 <= 0) {
                    this.value = 1;
                }
                if (event.keyCode == 13 && event.srcElement.type == 'text' && event.srcElement.id == 'page_v') {
                    Fpage(NowToHtmlID.find("#page_v").val(), "", ToHtmlID);
                    NowToHtmlID.find("#page_v").focus();
                }
            }
            break; //转页
        case 12:
            {
                NowToHtmlID.find("#page_v").val('1');
                ListGet(ToHtmlID); //加载数据
                List_Page_Get(ToHtmlID); //分页
            }
            break; //页面重新加载无蒙板
        case 13:
            {
                //alert('0');
                var changeid_zu = NowToHtmlID_content_foot.find("#changeid_zu option:selected").val() * 1;
                //alert(changeid_zu);
                if (changeid_zu == '' || changeid_zu == 0) {
                    alert("请选择“分类”后再操作！");
                    return false;
                } else {

                    sys_js_chestr("#" + ToHtmlID + "_content_right", "ID", ToHtmlID);
                    if (sys_js_arrychestr == "" || sys_js_arrychestr == "null") {
                        alert("您没选数据！");
                        return false;
                    }
                }

                $.post("B_moban_del.php", {
                    act: "changeid_zu",
                    id: sys_js_arrychestr,
                    ToHtmlID: ToHtmlID,
                    re_id: re_id,
                    changeid_zu: changeid_zu
                }, function () {
                    NowToHtmlID.find("#chkall").attr("checked", false);
                    LoodingDiv(ToHtmlID);
                    ListGet(ToHtmlID); //加载数据
                });
                //alert(sys_js_arrychestr+","+changeid_zu+","+NowToHtmlID+","+re_id);
                hiddenbox(0, ToHtmlID); //关闭foot
            }
            break; //批量修改类别
        case 14:
            {
                var changeid_login = NowToHtmlID_content_foot.find("#changeid_login option:selected").val() * 1;
                var changeid_loginame = NowToHtmlID_content_foot.find("#changeid_login option:selected").text();
                //alert(changeid_zu);
                if (changeid_login == "" || changeid_login == 0) {
                    alert("请选择“员工”后再操作！");
                    return false;
                }
                sys_js_chestr("#" + ToHtmlID + "_content_right", "ID", ToHtmlID);
                if (sys_js_arrychestr == "" || sys_js_arrychestr == "null") {
                    alert("您没选数据！");
                    return false;
                }
                //alert(sys_js_arrychestr);
                $.post("B_moban_del.php", {
                    act: "changeid_login",
                    id: sys_js_arrychestr,
                    ToHtmlID: ToHtmlID,
                    re_id: re_id,
                    changeid_login: changeid_login,
                    changeid_loginame: changeid_loginame
                }, function (data) {
                    //alert(data);
                    alert(data);
                    NowToHtmlID.find("#chkall").attr("checked", false);
                    LoodingDiv(ToHtmlID);
                    ListGet(ToHtmlID); //加载数据
                });
                //alert(sys_js_arrychestr+","+changeid_login+","+NowToHtmlID+","+re_id+","+changeid_loginame);
                //hiddenbox(0, ToHtmlID); //关闭foot
            };
            break; //批量转移所属人
        case 15:
            {

            };
            break; //彻底删除
        case 16:
            {
                if (NowToHtmlID.find("#zd").val() != '0') {
                    NowToHtmlID.find('td[name=' + NowToHtmlID.find("#zd").val() + ']').addClass('category_zdcols');
                } else {
                    NowToHtmlID.find('.category').removeClass('category_zdcols')
                };
            };
            break; //清除表头样式

        default:
            {
                alert('looddata(没有命令可执行！)');
            }
    };
}

//=============================================================================//【百度搜索】
function baidu_url(ths) {
    var $prev_vale = $(ths).prev().find("input,textarea,select").val();
    var location = 'https://www.baidu.com/s?ie=utf-8&f=8&rsv_bp=1&rsv_idx=1&tn=baidu&wd=' + $prev_vale;
    window.open(location, '_blank');

    //alert('百度搜索'+$prevale);
}

function add_Msg(ths, ToHtmlID) { // 操作标签///*这里自适应宽度的TAB选项框*/
    //alert(re_id);
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID, 'content_foot');
    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
    var formid = "#post_form_" + re_id; //得到修改的form id
    //alert(formid);
    var hy = $(ths).attr('hy');
    var bh = $(ths).attr('bh');
    var login = $(ths).attr('login');
    //alert(hy);
    var id_huiyuan_id = parseInt(NowToHtmlID_content_foot.find(formid + " input[name='id_huiyuan_id']").val()); //得到修改的id
    //alert(postform);//post_form
    //alert('re_id='+re_id+';hy:'+hy+';bh:'+bh+';login:'+login+';id_huiyuan_id:'+id_huiyuan_id);

    var nowinput = NowToHtmlID_content_foot.find(formid).find("textarea");
    var nowvalue = nowinput.val(); //得到当前值
    var nowname = nowinput.attr('name'); //字段名称
    var noweditid = NowToHtmlID_content_foot.find(formid).find('input[name="strmk_id"]').val(); //字段id
    var nodataulsize = NowToHtmlID_content_foot.find('.chatmsg ul.nodatas').size();

    var sys_guanxibiao_id = NowToHtmlID_content_foot.find(formid).attr('sys_guanxibiao_id'); //关系字段清单
    var sys_postzd_list = NowToHtmlID_content_foot.find(formid).attr('sys_postzd_list'); //这里得到字段清单
    var databiaoYY = NowToHtmlID_content_foot.find(formid).attr('sys_databiao'); //得到表的名字
    //alert('nowvalue='+nowvalue+';nowname:'+nowname+';noweditid:'+noweditid+';sys_guanxibiao_id:'+sys_guanxibiao_id+';sys_postzd_list:'+sys_postzd_list+';databiaoYY:'+databiaoYY);
    if (nowvalue != '') {
        if (noweditid != '') { //修改id有时
            edit_biao_col(databiaoYY, 'id', noweditid, nowname, nowvalue); //编辑数据；
            NowToHtmlID_content_foot.find(formid + ' .chatmsg ul[id=' + noweditid + ']').find('.edit').parent().find('.text').html(nowvalue); //修改
            if (NowToHtmlID_content_foot.find(formid + ' input[name="strmk_id"]').val() != '') {
                NowToHtmlID_content_foot.find(formid + ' .addmenu .inputmsg').val('');
                NowToHtmlID_content_foot.find(formid + ' .addmenu').find('input[name="strmk_id"]').val('');
                NowToHtmlID_content_foot.find(formid + ' .chatmsg ul').removeClass("uledit");
            };

        } else { //添加数据时
            //重置编辑页
            NowToHtmlID_content_foot.find(formid + ' .chatmsg .xu').show();
            NowToHtmlID_content_foot.find(formid + ' .chatmsg .del').hide();
            NowToHtmlID_content_foot.find(formid + ' .chatmsg .edit').hide();
            NowToHtmlID_content_foot.find(formid + ' .chatmsg .edit_h').hide();
            NowToHtmlID_content_foot.find(formid + ' .chatmsg ul').removeClass("uledit");
            //重置编辑页
            NowToHtmlID_content_foot.find(formid + ' .chatmsg ul.nodatas').remove(); //删除没有数据
            var $nowulsize = $('.chatmsg ul').size() + 1;
            var $date = new Date();
            $date = $date.toLocaleString();
            var $nowhtmlul = "<ul class='msglist'><li class='xu'> " + $nowulsize + " </li><li class='del'><i class='fa fa-del-mini'></i></li> <li class='edit'><i class='fa fa-edit-mini'></i></li> <li> " + login + "-" + bh + "</li><li>" + $date + "</li><div class='clear'></div><li class='text' style='padding-left:39px;'> " + nowvalue + "</li><div class='clear'></div></ul>";

            if (nodataulsize == 1) {
                NowToHtmlID_content_foot.find(formid + ' .chatmsg').html($nowhtmlul);
            } else {
                NowToHtmlID_content_foot.find(formid + ' .chatmsg ul:last').after($nowhtmlul);
            };
            $(ths).attr({
                "disabled": "disabled"
            }); //添加disabled属性


            NowToHtmlID_content_foot.find(formid + ' .chatmsg').scrollTop(NowToHtmlID_content_foot.find(formid + ' .chatmsg')[0].scrollHeight);

            var xserializeArray = NowToHtmlID_content_foot.find(formid).serializeArray();
            console.log(xserializeArray)
            $.ajax({
                type: "post",
                async: true,
                url: "../../MachineV1.0/moban_guanxi.php",
                data: xserializeArray,
                success: function (data) {
                    console.log(data);
                    var nowid = data.trim();
                    NowToHtmlID_content_foot.find(formid + ' .chatmsg ul:last').attr({
                        id: nowid,
                        title: nowid
                    }); //绑定添加的id值
                    $(ths).removeAttr('disabled');
                    NowToHtmlID_content_foot.find(formid).find('.inputmsg').val('').focus(); //清空输入框
                },
                error: function () {
                    alert('修改时出现错误,未保存成功！');
                    $('#addbox #editsuccess').text('');
                }
            });

        }

    }
} ///*这里自适应宽度的TAB选项框end*
//=============================================================================//【生成指定页PHP模版】
function UpdatePhp_one_page(re_id) {
    //alert('已提交，请等待处理完成。');
    //$(ths).hide(1000); 
    $.post('B_moban_SYS_data.php', {
        act: 'deldir_onepage',
        re_id: re_id
    }, function (data) {
        //alert('已提交，请等待处理完成。');
        UpdatePhp_Pc(re_id); //这里更新指定页面
    });
    alert('修复成功');
}
//=============================================================================//【生成PHP模版 电脑版】
function UpdatePhp_Pc(re_id, page) {
    // console.log(re_id);
    if (!re_id) { //当为空时
        return false; //停止往下执行
    }
    $.post('B_quanxian_chache.php', {
        act: 'list',
        re_id: re_id
    }, function (data) { //先执行权限
        console.log(data)
        var nowdiv = 'DeskMenuDiv' + re_id;
        $.post('B_moban_list_chache.php', {
            act: 'list',
            re_id: re_id
        }, function (data) {console.log(data)});
        $.post('B_moban_add_chache.php', {
            act: 'list',
            re_id: re_id
        }, function (data) {console.log(data)});
        $.post('B_moban_add_data_chache.php', {
            act: 'list',
            re_id: re_id
        }, function (data) {console.log(data)});

        $.post('B_moban_edit_chache.php', {
            act: 'list',
            re_id: re_id
        }, function (data) {console.log(data)});
        $.post('B_moban_edit_data_chache.php', {
            act: 'list',
            re_id: re_id
        }, function (data) {console.log(data)});

        $.post('../m/Machine_MobileV1.0/M_moban_list_chache.php', {
            act: 'list',
            re_id: re_id
        }, function (data) {console.log(data)});
        $.post('../m/Machine_MobileV1.0/M_moban_add_chache.php', {
            act: 'list',
            re_id: re_id
        }, function (data) {console.log(data)});
        $.post('../m/Machine_MobileV1.0/M_moban_edit_chache.php', {
            act: 'list',
            re_id: re_id
        }, function (data) {console.log(data)})

    //     if (page == 'B_moban_list') {
    //         LoodingDiv(nowdiv); //Loading
    //         List_Head_Get(nowdiv); //加载表头
    //         ListGet(nowdiv); //这里进行排序更新

    //     } else if (page == 'B_moban_add') {
    //         loodfoot(1, nowdiv, '.set', '0');
    //     } else if (page == 'B_moban_edit') {
    //         window.location.reload();
    //     } else if (page == 'head_list') {
    //         List_Head_Get(nowdiv); //加载表头
    //         ListGet(nowdiv);

    //     } else if (!page || page == '') {

    //     }

    });

}

//=============================================================================//【生成PHP模版 手机】
function UpdatePhp_mobile(re_id, page) {
    //alert('00');
    //alert('00');
    console.log(123)
    var nowdiv = 'DeskMenuDiv' + re_id;
    $.post('M_moban_list_chache.php', {
        act: 'list',
        re_id: re_id
    }, function (data) {});
    $.post('M_moban_add_chache.php', {
        act: 'list',
        re_id: re_id
    }, function (data) {});
    $.post('M_moban_edit_chache.php', {
        act: 'list',
        re_id: re_id
    })
    //$.post('M_moban_add_data_chache.php', {act:'list',re_id: re_id});
    //$.post('M_moban_edit_data_chache.php', {act:'list',re_id: re_id});

    $.post('../../MachineV1.0/B_moban_list_chache.php', {
        act: 'list',
        re_id: re_id
    });
    $.post('../../MachineV1.0/B_moban_add_chache.php', {
        act: 'list',
        re_id: re_id
    });
    $.post('../../MachineV1.0/B_moban_add_data_chache.php', {
        act: 'list',
        re_id: re_id
    });
    $.post('../../MachineV1.0/B_moban_edit_chache.php', {
        act: 'list',
        re_id: re_id
    });
    $.post('../../MachineV1.0/B_moban_edit_data_chache.php', {
        act: 'list',
        re_id: re_id
    });

    if (page == 'M_moban_list') {
        window.location.reload();
        //LoodingDiv(nowdiv);                                         //Loading
        //List_Head_Get(nowdiv);                                      //加载表头
        //ListGet(nowdiv);                                            //这里进行排序更新

    } else if (page == 'M_moban_add') {
        window.location.reload();
        //loodfoot(1,nowdiv,'.set','0');
    } else if (page == 'M_moban_edit') {
        window.location.reload();
    } else if (page == 'head_list') {
        window.location.reload();
        //List_Head_Get(nowdiv);                                      //加载表头
        //ListGet(nowdiv);  
    } else if (!page || page == '') {

    }


}

//=============================================================================//【生成PHP模版 电脑版】
function UpdatePhp_Zw(ZhiWei_id) {
    act = 'list';
    $.post('B_quanxian_chache.php', {
        act: act,
        zwid: ZhiWei_id
    }, function (data) {
        $.post('../m/Machine_MobileV1.0/M_quanxian_chache.php', {
            act: act,
            zwid: ZhiWei_id
        }, function (data) {
            $.post('B_menu_desk_chache.php', {
                act: act,
                zwid: ZhiWei_id
            }, function (data) {
                $.post('../m/Machine_MobileV1.0/M_menu_desk_chache.php', {
                    act: act,
                    zwid: ZhiWei_id
                }, function (data) {
                    parent.location.reload();
                });
            });
        });
    });
}


//===============================================================================统一编辑数据

//窗口设定更新模块待删除
function edit_table_col_js(ths, type, tableneme, search_zd, search_value, tochang_zd, tochang_value, parentdiv, ToHtmlID, sys_table_colzd, pm) {
    //edit_table_col_js(this,this.type,'sys_zuall','id',this.id,this.name,'','addbox','DeskMenuDiv321','pc')
    if (pm == 'mobile') {
        $post_to_url = '../../MachineV1.0/moban_set_data.php';
    } else {
        $post_to_url = 'moban_set_data.php';
    }
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var onlyone = 0; //当为0时多选。为1时单选
    if (type == '') { //当样式为空时
        var type = $(ths).attr('type');
    };
    if (sys_table_colzd == '') { //得到字段名称
        var sys_table_colzd = $(ths).attr('Y_ziduan');
    };
    //alert(search_value);
    //alert('0');
    var re_id = NowToHtmlID.find("#sys_const_re_id").val();
    switch (type) {
        case "text":
            {
                zdvalue = $(ths).val();
            };
            break;
        case "radio":
            {
                zdvalue = 1; //得到当前值
                onlyone = 1; //设定为单选
            };
            break;
        case "textgroup":
            {
                var zdvalue = $('#' + parentdiv + " [name='" + ths.name + "']:checked").map(function () {
                    return this.value;
                }).get().join(',');
            };
            break;
        case "checkbox":
            {
                if ($(ths).is(":checked")) {
                    zdvalue = '1'
                } else {
                    zdvalue = '0'
                };
            };
            break;
        case "checkboxgroup":
            {
                sys_js_chestr('#' + parentdiv, ths.name, ToHtmlID);
                zdvalue = sys_js_arrychestr;
            };
            break;
        case "select":
            {
                zdvalue = $(ths).val();
            };
            break;
        default:
            {
                zdvalue = $(ths).val();
            }
    };
    //alert(zdvalue);
    //alert('onlyone:'+onlyone);

    if (tochang_value) {
        zdvalue = tochang_value
    }; //当有指定改变后的值时使用指定

    /*以下为权限表修改时执行*/
    if (tochang_zd == 'qx_xianshi' && zdvalue == '0' && $(ths).parents('li').next().find('input').is(":checked")) {
        $(ths).parents('li').next().find('input').attr("checked", false); //改变前台状态

        $.post($post_to_url, {
            act: 'edit_biao_col',
            tableneme: tableneme,
            search_zd: search_zd,
            search_value: search_value,
            tochang_zd: 'qx_shuoding',
            tochang_value: '0',
            sys_table_colzd: sys_table_colzd,
            onlyone: onlyone,
            ToHtmlID: ToHtmlID,
            re_id: re_id
        }, function (data) {
            //alert(data);//测试返回
            UpdatePhp_Pc(re_id); //这里更新php生成文件
            //LoodingDiv(ToHtmlID);//Loading
            List_Head_Get(ToHtmlID); //加载表头
            ListGet(ToHtmlID); //中间数据
        }); //这里将后面一个锁定列设定为非选中
        //alert('qx_xianshi'+zdvalue);
    } else if (tochang_zd == 'qx_shuoding' && zdvalue == '1' && !$(ths).parents('li').prev().find('input').is(":checked")) {
        $(ths).parents('li').prev().find('input').attr("checked", true); //改变前台状态
        $.post($post_to_url, {
            act: 'edit_biao_col',
            tableneme: tableneme,
            search_zd: search_zd,
            search_value: search_value,
            tochang_zd: 'qx_xianshi',
            tochang_value: '1',
            sys_table_colzd: sys_table_colzd,
            onlyone: onlyone,
            ToHtmlID: ToHtmlID,
            re_id: re_id
        }, function (data) {
            //alert(data);//测试返回
            UpdatePhp_Pc(re_id); //这里更新php生成文件
            //LoodingDiv(ToHtmlID);//Loading
            List_Head_Get(ToHtmlID); //加载表头
            ListGet(ToHtmlID); //中间数据
        }); //这里将前面一个显示列设定为选中
        //alert('qx_shuoding'+zdvalue);
    } else {
        $.post($post_to_url, {
            act: 'edit_biao_col',
            tableneme: tableneme,
            search_zd: search_zd,
            search_value: search_value,
            tochang_zd: tochang_zd,
            tochang_value: zdvalue,
            sys_table_colzd: sys_table_colzd,
            onlyone: onlyone,
            ToHtmlID: ToHtmlID,
            re_id: re_id
        }, function (data) {
            //alert(data);//测试返回
            UpdatePhp_Pc(re_id); //这里更新php生成文件
            //LoodingDiv(ToHtmlID);//Loading
            List_Head_Get(ToHtmlID); //加载表头
            ListGet(ToHtmlID); //中间数据
        })
        //alert('other'+zdvalue);
    }


    /*权限表修改时执行 end*/
    //strmks="act=edit_biao_col&tableneme="+tableneme+"&search_zd="+search_zd+"&search_value="+search_value+"&tochang_zd="+tochang_zd+"&tochang_value="+zdvalue+"&re_id="+re_id;
    //alert($post_to_url+"?"+strmks);
}
//===============================================================================修改备注
function ziduan_beizhu_edit(ths, tableneme, zd_en_name, ToHtmlID, danxuan) {

    $post_to_url = 'moban_set_data.php';

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var onlyone = 0; //当为0时多选。为1时单选
    var type = $(ths).attr('type'); //当样式为空时
    var ziduanname = $(ths).attr('name');
    var moren = $(ths).find("option:selected").attr('moren'); //标签的默认值
    var zd_xianshi_height_is = $(ths).find("option:selected").attr('zd_xianshi_height_is'); //标签是否允许修改高度 1为允许调整高度
    //alert(zd_xianshi_height_is);
    var re_id = NowToHtmlID.find("#sys_const_re_id").val();
    // console.log(type)
    switch (type) {
        case "text":
            {
                zdvalue = $(ths).val();
            };
            break;
        case "select":
            {
                zdvalue = $(ths).val();
                if ($(ths).attr('name') == 'XStype') { //当为下接选择样式时执行
                    //alert(moren);
                    $(ths).parent().parent().find('input[name="zd_Default"]').val(moren);
                    //$(ths).parent().parent().find('input[name="zd_Default"]').trigger("change");
                }
                if (zd_xianshi_height_is == '1') { //当允许设定高度时
                    $(ths).parent().parent().find('input[name="zd_xianshi_height"]').show();
                } else {
                    $(ths).parent().parent().find('input[name="zd_xianshi_height"]').hide();
                }
            };
            break;
        case "radio":
            {
                zdvalue = 1; //得到当前值
                onlyone = 1; //设定为单选
            };
            break;
        case "textgroup":
            {
                var zdvalue = $('#' + parentdiv + " [name='" + ths.name + "']:checked").map(function () {
                    return this.value;
                }).get().join(',');
            };
            break;
        case "checkbox":
            {
                if ($(ths).is(":checked")) {
                    zdvalue = '1';
                } else {
                    zdvalue = '0';
                };
            };
            break;
        case "checkboxgroup":
            {
                sys_js_chestr('#' + parentdiv, ths.name, ToHtmlID);
                zdvalue = sys_js_arrychestr;
            };
            break;
        default:
            {
                zdvalue = $(ths).val();
            }
    };
    // console.log(zdvalue);
    //alert('onlyone:'+onlyone);
    //if(danxuan=='danxuan'){//手机列只能锁定一列
    //alert('danxuan');
    //$(ths).parent().parent().parent().find("input[name='" + ths.name + "']:checked").not(ths).removeAttr("checked");
    //}
    //alert(moren);
    //return false;
    $.post($post_to_url, {
        act: 'ziduan_beizhu_edit',
        tableneme: tableneme,
        zd_en_name: zd_en_name,
        ziduanname: ziduanname,
        thisvalue: zdvalue,
        danxuan: danxuan,
        ToHtmlID: ToHtmlID,
        moren: moren,
        re_id: re_id
    }, function (data) {

        if (ziduanname == 'zd_xianshi_width' || ziduanname == 'XStype' || ziduanname == 'qx_xianshi' || ziduanname == 'qx_shuoding') {
            UpdatePhp_Pc(re_id, 'B_moban_list'); //这里更新php生成文件
        } else {
            UpdatePhp_Pc(re_id); //这里更新php生成文件
        }

        //if(danxuan=='danxuan'){//手机列只能锁定一列
        //alert('danxuan');
        //$(ths).parent().parent().parent().find("input[name='" + ths.name + "']:checked").not(ths).removeAttr("checked");
        //}
    })
    //alert('other'+zdvalue);


    /*权限表修改时执行 end*/
    //strmks="act=edit_biao_col&tableneme="+tableneme+"&search_zd="+search_zd+"&search_value="+search_value+"&tochang_zd="+tochang_zd+"&tochang_value="+zdvalue+"&re_id="+re_id;
    //alert($post_to_url+"?"+strmks);
}


//【ok】============================================================================【下方#addbox的聊天记录中js】
function edit_ul_msg(ths, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'content_foot'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var $xu = $(ths).find(".xu");
    var $del = $(ths).find(".del");
    var $edit = $(ths).find(".edit");
    var $edit_h = $(ths).find(".edit_h");
    //var $tableneme = $(ths).parent().attr('databiaoYY');
    //alert($tableneme);
    if ($xu.is(":hidden")) { //切换为正常序号的形式
        $xu.show(500);
        $edit.hide(500);
        $edit_h.hide(500);
        $del.hide(500);
        if (NowToHtmlID.find('.addmenu').find('input[name="strmk_id"]').val() != '') {
            NowToHtmlID.find('.addmenu .inputmsg').attr({
                value: ''
            });
            NowToHtmlID.find('.addmenu').find('input[name="strmk_id"]').val('');
            NowToHtmlID.find('.chatmsg ul').removeClass("uledit");
        };

    } else { //切换到编辑模式
        $xu.hide(500);
        $del.show(500);
        $edit.show(500);
        $edit_h.show(500);
    };


    $(ths).find(".del").on("click", function () { //删除
        var $nowid = $(this).parent().attr('id');
        //alert($tableneme);
        if (confirm("确定删除此跟踪记录吗？")) {
            //alert("把确定的事件写到这里吧！");
            edit_biao_col('sys_msn', 'id', $nowid, 'sys_huis', '1'); //删除到回收站；
            $(this).parent().hide(1000).remove();
            if (NowToHtmlID.find('.chatmsg').find('ul').size() == 0) {
                NowToHtmlID.find('.chatmsg').html('<ul class="msglist nodatas">&nbsp;还没有记录。</ul>');
            };
            if (NowToHtmlID.find('.addmenu').find('input[name="strmk_id"]').val() != '') {
                NowToHtmlID.find('.addmenu .inputmsg').attr({
                    value: ''
                });
                NowToHtmlID.find('.addmenu').find('input[name="strmk_id"]').val($nowid);
                NowToHtmlID.find('.chatmsg ul').removeClass("uledit");
            };
        } else {
            //alert("如果取消，就写一个返回事件吧！");
        };


    });

    $(ths).find(".edit").on("click", function () { //编辑
        var $nowid = $(this).parent().attr('id'); //得到修改id

        var $ThisNextUl = $(this).next();
        //var $zdname=$ThisNextUl.attr('zdname');
        var $thistext = $ThisNextUl.parent().find('.text').text(); //得到修改的内容
        var $editinput = NowToHtmlID.find('.addmenu .inputmsg');
        //var $nowname=$editinput.attr('name');//得到字段名称
        //var $nowtablename=$editinput.attr('tablename');//得到字段名称
        $(this).parent().parent().find('ul.uledit').removeClass("uledit");
        $(this).parent().addClass("uledit"); //添加编辑样式
        $editinput.attr({
            value: $thistext
        });
        NowToHtmlID.find('.addmenu').find('input[name="strmk_id"]').val($nowid);
        //alert($(this).parent().attr('id'));


    });

}; ///*这里自适应宽度的TAB选项框end*
//【ok】============================================================================【修改sys_jlmb表中名字并自动修改数据库中的表名】PC
function Pinyin_Table(ths, ToHtmlID) {
    //alert(ths.type);
    //replacefh(ths);//这里执行首字数字检查
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var All_XT_ZiDuan = $('#bbsTabntq').attr('tit').toLowerCase(); //得到所有系统字符串
    ths.value = ths.value.replace(/[^\u4E00-\u9FA5a-zA-Z]/g, ''); //去除数字
    var thisvalue = $(ths).val().trim();
    //alert(All_XT_ZiDuan);
    thisvaluelow = thisvalue.toLowerCase();
    thispinyin = 'SQP_' + ToPinYing(thisvalue);
    thispinyinlow = thispinyin.toLowerCase();
    var fieldsnamey = $(ths).attr("Y_ziduan").trim(); //原名称en
    var fieldsnameycn = $(ths).attr("tit").trim(); //原名称cn
    var bigid = $(ths).attr("bigid").trim(); //大类id
    fieldsname = fieldsnamey.toLowerCase();
    //alert(thispinyinlow);
    var chestrinput_title = 0; //等于0时,没有,等于1时有
    var chestrinput_ziduan = 0; //等于0时,没有,等于1时有
    //if($(ths).val()==''){$(this).val($(this).attr('tit'))};//当为空时初始上一次的命名
    //alert($(ths).attr('tit'));
    $('#bbsTabntq input[name="' + ths.name + '"]').not(ths).each(function () {
        if ($(this).attr('tit') != '' || $(this).attr('tit') != null || $(this).attr('tit') != 'undefined') {
            if ($(this).attr('tit').toLowerCase() == thisvaluelow) {
                chestrinput_title = 1;
            };
        }; //在tit中查询,如果有将chestrinput_title设置为1
        if ($(this).attr("Y_ziduan") != '' || $(this).attr("Y_ziduan") != null || $(this).attr("Y_ziduan") != 'undefined') {
            if ($(this).attr("Y_ziduan").toLowerCase() == thispinyinlow) {
                chestrinput_ziduan = 1;
            };
        }; //在Y_ziduan中查询,如果有将chestrinput_ziduan设置为1

    });
    //alert(chestrinput_title+'_'+chestrinput_ziduan);
    if (chestrinput_title == 1 || $(ths).val() == '') {
        alert("已有该名称或留空，请重命名！");
        ths.value = $(ths).attr("tit");
        ths.focus(); //验证当前列不能重名。
    } else if (All_XT_ZiDuan.indexOf(',' + thisvaluelow.replace(/[ ]/g, "") + ',') >= 0 || All_XT_ZiDuan.indexOf(',' + thispinyinlow.replace(/[ ]/g, "") + ',') >= 0) {
        alert("对不起，系统禁止添加该名称！");
        ths.value = $(ths).attr("tit");
        ths.focus(); //验证当前禁止添加系统字段名
    } else { //当不重名和不是系统字段时。
        if (chestrinput_ziduan == 1) {
            newziduanval = thispinyin + sjm();
        } else {
            newziduanval = thispinyin;
        }; //随机生成底层字段名
        //alert('000');
        $(ths).attr({
            "tit": thisvalue,
            "Y_ziduan": newziduanval
        });
        $(ths).parent().parent().find("input:checkbox").removeAttr("disabled").val(thispinyin); //启用右边复选框值及样式。
        //$(ths).parent().parent().find("input:checkbox")//启用右边值。
        //alert(chestrinput_title+","+chestrinput_ziduan);
        var re_id = NowToHtmlID.find("#sys_const_re_id").val();

        //alert("Tsid:"+re_id+";fieldsname:"+fieldsnameycn+";fieldsnamePY:"+fieldsnamey+";newfieldsname:"+thisvalue+"newfieldsnamePY:"+newziduanval+"bigid:"+bigid);
        $.post("moban_set_data.php", {
            act: "Table_Edit_Jlmb",
            Tsid: re_id, //记录清单id
            fieldsname: fieldsnameycn, //原名称cn
            fieldsnamePY: fieldsnamey, //原名称拼英en  00
            newfieldsname: thisvalue, //新名称cn
            newfieldsnamePY: newziduanval, //新名称拼音en
            //bigid:bigid,                              //上级大类
            ToHtmlID: ToHtmlID,
            re_id: re_id
        }, function (data) {
            //alert(data);
            UpdatePhp_Pc(re_id); //这里更新php生成文件
            NowToHtmlID.find("div.tables ul.thead li[name='" + fieldsnamey + "']").attr("name", newziduanval).text(thisvalue); //这里提交成功后更新表头
            List_Head_Get(ToHtmlID); //加载表头//
            window.parent.topFrame.$("#" + ToHtmlID).find('li').text(thisvalue); //处理头部菜单

            $.get('B_menu_desk_user.php', {
                act: 'menuA',
                ToHtmlID: ToHtmlID
            }, function (data) { //重新加载桌面
                $('#DeskMenuDiv0').html(data);
            })
        }); //提交参数	//alert(fieldsnamey);alert(newziduanval);alert(thisvalue);

    } /**/
}

function pageName() {
    var a = location.href;
    var b = a.split("/");
    var c = b.slice(b.length - 1, b.length).toString(String).split(".");
    var e = c.slice(0, 1).toString().toUpperCase();
    //alert(e);
    var f = e.substring(0, 2); //得到M_
    //alert(f);
    return f;
}

//=================================================================form数据添加
function data_add_arrys(ths, formid, ToHtmlID) {

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID, 'content_foot');

    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
    var hy = parseInt(NowToHtmlID.find("#sys_const_company_id").val()); //得到修改的hy值
    //alert(re_id);
    //return false;
    if (pageName() == 'M_') { //手机版
        var url = "../../MachineV1.0/cache/" + hy + "/B_moban_add_data/B_moban_add_data_" + re_id + ".php"; //得到文件路径
    } else {
        var url = "cache/" + hy + "/B_moban_add_data/B_moban_add_data_" + re_id + ".php"; //得到文件路径
    }

    form_weikong(formid, ToHtmlID); //判断是否有必填字段是执行
    //var formid=NowToHtmlID+' '+formid;
    //alert(url);
    if (NowToHtmlID_content_foot.find(formid + ' .bitiantishi').length > 0 || NowToHtmlID_content_foot.find(formid + ' .chongfuzhi').length > 0) {
        return false;
    };
    $(ths).attr({
        "disabled": "disabled"
    }); //添加disabled属性
    //alert(url);
    var xserializeArray = NowToHtmlID_content_foot.find(formid).serializeArray();
    //alert(xserializeArray);
    $.ajax({
        type: "post",
        async: true,
        url: url,
        data: xserializeArray,
        success: function (data) {
            console.log(data);
            NowToHtmlID_content_foot.find('.htmlleirong').html("<ul id='tagContent' class='tagContent' >" + data + "</ul>");
            $.get('B_moban_add.php', {
                act: "list",
                strmk_id: '',
                re_id: re_id,
                ToHtmlID: ToHtmlID
            }, function (data) {
                NowToHtmlID_content_foot.find('.htmlleirong').html("<ul id='tagContent' class='tagContent' >" + data + "</ul>");
            }); //这里打开模版
            //========================================以下为复制新添加页
            /*
            var copydiv = NowToHtmlID_content_foot.find(formid+" #mobanaddbox2").clone(); //拷副本
            NowToHtmlID_content_foot.find(formid+" #mobanaddbox").remove();
            NowToHtmlID_content_foot.find(formid).html(copydiv);
            NowToHtmlID_content_foot.find(formid+" #mobanaddbox2").attr("id", "mobanaddbox").show(500);
            Wuchongfu_Arry=NowToHtmlID_content_foot.find(formid+"  #SYS_submit").attr("Wuchongfu_Arry");//得到无得复
            databiao=NowToHtmlID_content_foot.find(formid+" #SYS_submit").attr("databiao");//得到无得复
            if (Wuchongfu_Arry!='' && databiao!=''){
            	YanZhen_ChongFu_ZuLoad(0,Wuchongfu_Arry,databiao,ToHtmlID);//无重复
            }
            */
            //========================================end if
            //Input_clear_all(formid+" li.reset_list") //清空表单为空
            if (pageName() == 'M_') { //手机版
                ListGet_mobile('catalog ul'); //重新加载搜索数据;
                List_Page_Get_mobile('catalog ul'); //分页数据
            } else {
                ListGet(ToHtmlID); //中间数据
                List_Page_Get(ToHtmlID); //分页数据
            }


            $(ths).removeAttr('disabled');
            //setTimeout(function () {
            //NowToHtmlID_content_foot.find(formid+' #editsuccess').text('');
            //}, 1000);
        },
        error: function () {
            alert('修改时出现错误,未保存成功！');
            NowToHtmlID_content_foot.find(formid + ' #editsuccess').text('');
        }
    });

    //NowToHtmlID_content_foot.find(formid+" input[type=reset]").trigger("click");//触发reset按钮
}

//【ok】======================================================================================================关系表赋值
function sys_count(parentre_id, re_id, parentdataid) {
    // console.log(1235435)
    //alert(parentre_id+';'+re_id+';'+parentdataid);
    $.post("moban_set_data.php", {
        act: "sys_count",
        parentre_id: parentre_id, //父级re_id
        re_id: re_id, //关系re_id
        parentdataid: parentdataid //父级数据id
    }, function (data) {
        //alert(data);
    }); //提交
}
//【ok】======================================================================================================复制指定值
function copyText(ths, text) {
    //alert(text);
    //text.select(); // 选中文本
    //document.execCommand("copy"); // 执行浏览器复制命令
    $(ths).append('<textarea cols="20" rows="10" id="copyText" style="width:0;height:0;">' + text + '</textarea>'); //添加个临时储存对象
    $(ths).parent().find('#copyText').val(text);
    var Url2 = $(ths).parent().find('#copyText'); // 找到对象
    Url2.select(); // 选择对象
    document.execCommand("Copy"); // 执行浏览器复制命令
    $(ths).parent().find('#copyText').remove(); // 删除临时储存对象

    $(ths).append('<div class="ti_shi">复制 <font color=\'#666\'>' + text + '</font> 成功</div>'); //添加个临时储存对象

    setTimeout(function () {
        $(ths).parent().find('.ti_shi').hide().remove(); // 删除临时储存对象
    }, 1000);
    //alert("复制成功");
}

//=================================================================form数据修改
function data_edit_arrys(ths, formid, ToHtmlID) {
    //var act = 'edit';

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID, 'content_foot');

    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
    var hy = parseInt(NowToHtmlID.find("#sys_const_company_id").val()); //得到修改的hy值

    if (pageName() == 'M_') {
        var url = "../../MachineV1.0/cache/" + hy + "/B_moban_edit_data/B_moban_edit_data_" + re_id + ".php"; //得到文件路径
    } else {
        var url = "cache/" + hy + "/B_moban_edit_data/B_moban_edit_data_" + re_id + ".php"; //得到文件路径
    }

    var strmk_id = parseInt(NowToHtmlID_content_foot.find('input[name="strmk_id"]').val()); //得到修改的id值
    // console.log(strmk_id)
    if (isNaN(strmk_id)) {
        strmk_id = 0;
    };

    form_weikong(formid, ToHtmlID); //判断是否有必填字段是执行

    //var formid=NowToHtmlID+' '+formid;
    if (NowToHtmlID_content_foot.find(formid + ' .bitiantishi').length > 0 || NowToHtmlID_content_foot.find(formid + ' .chongfuzhi').length > 0) {
        return false;
    };
    $(ths).attr({
        "disabled": "disabled"
    }); //添加disabled属性
    //alert(NowToHtmlID_content_foot);
    var xserializeArray = NowToHtmlID_content_foot.find('#post_form').serializeArray();

    //$.each(xserializeArray, function(i, field){
    //alert(field.name + ":" + field.value + "; ");
    //});
    //alert('re_id:'+re_id+';hy:'+hy+';strmk_id:'+strmk_id+'url:'+url+'ToHtmlID:'+ToHtmlID);
    console.log(url)
    $.ajax({
        type: "post",
        async: true,
        url: url,
        data: xserializeArray,
        success: function (data) {
            $('body').append($(data))
            // console.log('data:',data)
            // eval(data)
            // console.log(1232233)
            console.log(data)
            // var zu_all_list = NowToHtmlID_content_foot.find(formid).attr('zu_all_list'); //得到类型id
            var nowtypeidlist = '';
            $.each(xserializeArray, function (i, field) {
                var field_name = field.name;
                var field_value = field.value;
                var tdclass = "ET_" + field_name + strmk_id;
                var field_typeid = NowToHtmlID_content_foot.find(formid + ' #' + field_name).attr('typeid'); //得到类型id

                var field_value2 = '';
                var valstr = [];
                //alert(field_typeid);
                nowtypeidlist += field_typeid + ',';
                if (field_name == 'sys_id_zu') {
                    NowToHtmlID_content_foot.find(formid + " input[name='sys_id_zu']:checked").each(function () {
                        valstr.push($(this).attr('cnval'));
                    });
                    field_value2 = valstr.join(',');
                    edit_table_tdtext(tdclass, field_value2, ToHtmlID);
                } else {
                    //alert(field_value);
                    edit_table_tdtext(tdclass, field_value, ToHtmlID);
                }
            });
            if (strmk_id > 0) { //修改
                NowToHtmlID_content_foot.find(formid + ' #editsuccess').html('<br>修改成功！'); //alert(strmk_id);
            }
            $(ths).removeAttr('disabled');
            setTimeout(function () {
                NowToHtmlID_content_foot.find(formid + ' #editsuccess').text('');
            }, 1000);
            //alert(data);
        },
        error: function (e) {
            alert('修改时出现错误,未保存成功！');
            alert(e);
            NowToHtmlID_content_foot.find(formid + ' #editsuccess').text('');
        }
    });

}


//=================================================================form 分页显示
/*
function form_fenye(formid,ToHtmlID) { //(formid)

	var NowToHtmlID=DIVHtmlID(ToHtmlID,'content_foot');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
	var Content_html =NowToHtmlID.find(formid).find('.ContentTwo1').html();   //得到首页的内容
	NowToHtmlID.find(formid).find('.ContentTwo').each(function () {
		var xszd=$(this).attr('xszd');                            //得到当前表格的xszd属性值
		var S_xszd_Arry = xszd.split(',');
		var nowhasclass=$(this).hasClass("ContentTwo1");
		if(nowhasclass==false){
			$(this).html(Content_html);                      //复制所有的表格
		}
		$(this).find('ul').each(function () {
			var nowattrzd=$(this).attr('zd'); //得到本行属性zd名称
			//alert(xszd);
			var nowinarray=$.inArray(nowattrzd,S_xszd_Arry)*1;
			if(nowhasclass==true){
				if (nowinarray>-1){
					$(this).remove();
				}
			}else{
				if (nowinarray == -1){
				    $(this).remove();
				}
			}
		});
    });
}*/
//=================================================================form判断是否有必填字段是执行
function form_weikong(formid, ToHtmlID) { //(formid)

    //------------------------------------------------//分页出现提示


    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'content_foot'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    if (pageName() == 'M_') { //手机版
        formid = '#addbox';
    }
    var $w_Kongimg = '<i class="fa fa-gantan bitiantishi tishi"  title="必填字段，不能为空。">'; //感叹号图片
    var $w_NO_Kongimg = '<i class="fa fa-gou tishi" title="pass"></i>'; //OK图片

    //alert (NowToHtmlID);
    var bitian_Arry = NowToHtmlID.find(formid).find('#SYS_submit').attr('bitian_Arry'); //得到必填字段Arry
    //以下为验证为空判断
    //alert(bitian_Arry);
    var S_bitian_Arry = bitian_Arry.split(",");
    var S_bitian_Arry_length = S_bitian_Arry.length * 1; //这里得到数组数量
    //alert(S_bitian_Arry_length);
    NowToHtmlID.find(formid + " .bitiantishi").not(".chongfuzhi").remove(); //删除提示

    for (var i = 0; i < S_bitian_Arry_length; i++) {
        var nowLeiXin = NowToHtmlID.find(formid + ' [name=' + S_bitian_Arry[i] + ']').attr("type"); //得到控件的类型
        //alert(nowLeiXin);
        //====================================================为TEXT\textarea时执行
        if (nowLeiXin == 'text' || nowLeiXin == 'textarea') {
            var nowzhi = NowToHtmlID.find(formid + ' [name=' + S_bitian_Arry[i] + ']').val(); //得到控件的值
            NowToHtmlID.find(formid + ' [name=' + S_bitian_Arry[i] + ']').bind("keyup", function () {
                if ($(this).val().length * 1 > 0) {
                    $('#' + $(this).attr('name') + '_bitian').html($w_NO_Kongimg);
                } else {
                    $('#' + $(this).attr("name") + '_bitian').html($w_Kongimg);
                };
                form_menutishi(formid, ToHtmlID); //分类菜单出现提示
            }); //绑定keyup事件
            if (nowzhi == "") {
                $('#' + S_bitian_Arry[i] + '_bitian').html($w_Kongimg);
            }; //当文本框为空时，在右边出现提示。
            //====================================================单选框、多选框、复选框
        } else if (nowLeiXin == 'radio' || nowLeiXin == 'checkbox') { //
            var nowzhi = NowToHtmlID.find(formid + ' [name=' + S_bitian_Arry[i] + ']:checked').val(); //得到控件的值
            NowToHtmlID.find(formid + ' [name=' + S_bitian_Arry[i] + ']').bind("click", function () {
                if (NowToHtmlID.find(formid + ' input[name=' + $(this).attr("name") + ']:checked').length * 1 > 0) {
                    $('#' + $(this).attr("name") + '_bitian').html($w_NO_Kongimg);
                } else {
                    $('#' + $(this).attr("name") + '_bitian').html($w_Kongimg);
                };
                form_menutishi(formid, ToHtmlID); //分类菜单出现提示
            }); //绑定keyup事件
            if (NowToHtmlID.find(formid + ' [name=' + S_bitian_Arry[i] + ']:checked').length * 1 == 0) {
                $('#' + S_bitian_Arry[i] + '_bitian').html($w_Kongimg);
            }; //当文本框为空时，在右边出现提示。
            //====================================================下拉框
        } else if (nowLeiXin == 'select') { //
            var nowzhi = NowToHtmlID.find(formid + ' [name=' + S_bitian_Arry[i] + ']').val(); //得到控件的值
            NowToHtmlID.find(formid + ' [name=' + S_bitian_Arry[i] + ']').bind("change", function () {
                if ($(this).val() != "") {
                    $('#' + $(this).attr("name") + '_bitian').html($w_NO_Kongimg);
                } else {
                    $('#' + $(this).attr("name") + '_bitian').html($w_Kongimg);
                };
                form_menutishi(formid, ToHtmlID); //分类菜单出现提示
            }); //绑定keyup事件
            if (nowzhi == "") {
                $('#' + S_bitian_Arry[i] + '_bitian').html($w_Kongimg);
            }; //当文本框为空时，在右边出现提示。
        } else {
            var nowzhi = NowToHtmlID.find(formid + ' [name=' + S_bitian_Arry[i] + ']').val(); //得到控件的值
            NowToHtmlID.find(formid + ' [name=' + S_bitian_Arry[i] + ']').bind("keyup", function () {
                if ($(this).val().length * 1 > 0) {
                    $('#' + $(this).attr("name") + '_bitian').html($w_NO_Kongimg);
                } else {
                    $('#' + $(this).attr("name") + '_bitian').html($w_Kongimg);
                };
                form_menutishi(formid, ToHtmlID); //分类菜单出现提示
            }); //绑定keyup事件
            if (nowzhi == "") {
                $('#' + S_bitian_Arry[i] + '_bitian').html($w_Kongimg);
            }; //当文本框为空时，在右边出现提示。
            //绑定onchange事件。
        };
        //alert(S_bitian_Arry[i]);//return false;
    }
    form_menutishi(formid, ToHtmlID); //分类菜单出现提示
    if (NowToHtmlID.find(formid + ' .bitiantishi').length > 0) {
        NowToHtmlID.find(formid + ' #editsuccess').text(' 对不起，有必填项或重复项！');
        setTimeout(function () {
            $(' #editsuccess').text('');
        }, 1000);
        return false;
    }

    //------------------------------------------------//删除提示
    //NowToHtmlID.find(formid+" .bitiantishi").remove(); 


}
//=================================================================form判断是否有必填字段是执行
function form_menutishi(formid, ToHtmlID) { //(formid)
    //alert(formid);
    var nowlength = 0;
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'content_foot'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    NowToHtmlID.find(formid + ' .ContentTwo').each(function () {
        var nowclass = parseInt($(this).attr('class').replace(/[^0-9]/ig, ""));
        //alert(nowclass);
        var nowbitiantishilength = $(this).find('.bitiantishi').length; //必填提示个数
        var nowchongfulength = $(this).find('.chongfuzhi').length; //验重提示个数
        var nowlength = nowbitiantishilength + nowchongfulength;
        if (nowlength == 0) {
            NowToHtmlID.find(formid + ' .two_menu ul').eq(nowclass).find('.bitian_wuchong_tongji').hide(600).html(nowlength);
        } else {
            NowToHtmlID.find(formid + ' .two_menu ul').eq(nowclass).find('.bitian_wuchong_tongji').show(600).html(nowlength);
        }

        //alert(nowlength);
        //alert($(this).attr('class'));
    });
    //var $w_Kongimg = '<i class="fa fa-gantan bitiantishi tishi"  title="必填字段，不能为空。">'; //感叹号图片
    //var $w_NO_Kongimg = '<i class="fa fa-gou tishi" title="pass"></i>'; //OK图片

    //alert (NowToHtmlID);


}
//=================================================================修改表tdtext值
function edit_table_tdtext(tdclass, thisval, ToHtmlID) {

    var thisval_length = thisval.length;
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'content_ALL'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02

    if (thisval_length == 0) {
        //alert(thisval_length);
        NowToHtmlID.find("." + tdclass).html('').attr({
            'title': ''
        });
    } else {
        NowToHtmlID.find("." + tdclass).html(thisval).attr({
            'title': thisval
        });
    }
    //下面为图片时执行
    //alert(thisval);
    var xstypeid = NowToHtmlID.find("." + tdclass).attr('xstypeid'); //得到显示样式id
    //alert(tdclass);
    //----------------------------------以下进行显示样式加载
    FormattingXianShi(xstypeid, ToHtmlID, '', tdclass, thisval);
}
//===============================================================================复选框多选
function checkbox_morechecked(ths) {
    var name = $(ths).attr('name'); //得到当前name
    var parentdiv = $(ths).parent().parent();

    var chestr = []; //得到id 集合
    var valstr = []; //得到中文value集合

    $(ths).parent().parent().find("input[name='" + name + "']:checked").each(function () {
        chestr.push($(this).attr('valid'));
        //valstr.push($(this).attr('cnval'));
    });
    now_chestr = chestr.join(',');
    //now_valstr = valstr.join(',');
    //alert(now_val);
    $(ths).parent().parent().find("input[name='" + name + "']").attr({
        "value": now_chestr
    });
}

function findpage2(firstvalue, Endvalue, sys_gx_re_id, GuanXi_id, Table_name, ToHtmlID) {
    //HuiSouZhan_MENU('HUIS_DeskMenuDiv495',this,'DeskMenuDiv495');

    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot_02 = DIVHtmlID(ToHtmlID, 'content_foot_02');
    var re_id = parseInt(sys_gx_re_id.replace(/[^0-9]/ig, "")); //获取数字
    //alert(re_id);
    //alert('firstvalue:'+firstvalue+'Endvalue:'+Endvalue+';'+sys_gx_re_id+';'+GuanXi_id+';'+Table_name+';'+ToHtmlID+';'+re_id);
    //alert(re_id);
    var showContent = 'E_' + ToHtmlID + '_MenuDiv_' + re_id;
    //--------------------------------------------------------------打开数据窗口

    NowToHtmlID_content_foot_02.find('.headleft').html('<a class="selectTag">选择数据</a>');
    Foot_Height(0.75, ToHtmlID, '#' + ToHtmlID + '_content_foot_02'); //打开编辑的页面

    //alert(now_re_id);
    NowToHtmlID_content_foot_02.find('.content_footbox').css('background', '#E8E8E8');
    //---------------------------------------------------【如果没有时添加显示层】

    NowToHtmlID_content_foot_02.find('.htmlleirong').html("<ul class='ConTentATO tagContent'  id='" + showContent + "'>loading...</ul>");
    var PartHtmlID = "#" + ToHtmlID + '_content_foot_02 .htmlleirong';
    var ShaiXuanSql = '';
    //alert(showContent);
    DeskHtml(PartHtmlID, showContent, ShaiXuanSql, '0');
    NowToHtmlID_content_foot_02.find('#' + showContent).parent().css("overflow", "hidden");

    NowToHtmlID_content_foot_02.find('#footseid3,#footseid9,#footseid13,#footseid14').show();
    //$('#'+showContent).find('.h_right li').html('');
    NowToHtmlID_content_foot_02.find('#' + showContent).show(); //这里显示层
    NowToHtmlID_content_foot_02.find('#footseid16,#footseid17').remove(); //
}

//【ok】======================================================================================================底部回收
function HuiSouZhan_MENU(showContent, ths, ToHtmlID) { // 操作标签///*这里自适应宽度的TAB选项框*

    //alert(showContent);
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'head'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot_02 = DIVHtmlID(ToHtmlID, 'content_foot_02');

    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;

    NowToHtmlID_content_foot_02.find('.headleft').html('<a class="selectTag">回收站</a>');
    Foot_Height(0.8, ToHtmlID, '#' + ToHtmlID + '_content_foot_02'); //打开编辑的页面

    var now_re_id = showContent.substring(showContent.length - 5).replace(/[^0-9]/ig, "");
    //alert(now_re_id);
    NowToHtmlID_content_foot_02.css('background', '#E8E8E8');
    //---------------------------------------------------【如果没有时添加显示层】

    NowToHtmlID_content_foot_02.find('.htmlleirong').html("<ul class='ConTentATO tagContent'  id='" + showContent + "'>loading...</ul>");
    var PartHtmlID = '#' + ToHtmlID + '_content_foot_02 .htmlleirong';
    var ShaiXuanSql = '';
    DeskHtml(PartHtmlID, showContent, ShaiXuanSql, '1');
    NowToHtmlID_content_foot_02.find('#' + showContent).parent().css("overflow", "hidden");
    NowToHtmlID_content_foot_02.find('#' + showContent).find('#footseid3,#footseid9,#footseid13,#footseid14').remove();
    //$('#'+showContent).find('.h_right li').html('');
    NowToHtmlID_content_foot_02.find('#' + showContent).show(); //这里显示层
    NowToHtmlID_content_foot_02.find('#' + showContent).find('#footseid16,#footseid17').show(); //
} ///*这里自适应宽度的TAB选项框end*/
//【ok】======================================================================================================关系表赋值
function GuanXiFillInput(sys_gx_re_id, GuanXi_id, Table_name, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
    //NowToHtmlID.find('input[name="+sys_gx_re_id+"]').css();
    //alert(sys_gx_re_id);
    $.get('moban_set.php', {
        act: "GuanXi_Back",
        sys_gx_re_id: sys_gx_re_id,
        GuanXi_id: GuanXi_id,
        Table_name: Table_name,
        ToHtmlID: ToHtmlID,
        re_id: re_id
    }, function (data) {
        // console.log(data)
        if (data) {
            //alert(data);
            //var data='id='+sys_gx_re_id+','+data;
            //alert(data);
            var arrData = data.split(',');
            $.each(arrData, function (index, value) {
                var nowvalue = arrData[index];
                var arrData2 = nowvalue.split('=');
                var firstvalue = arrData2[0]; //源表字段
                var Endvalue = arrData2[1]; //当前表字段名
                //alert(arrData2[0]+'  -> '+arrData2[1]);
                //--------------------------------------------------------------控件改变.attr({"onclick":thisurl})
                var thisinput = $("#" + ToHtmlID).find('.content_footbox input[name="' + Endvalue + '"]');
                var thisurl = "findpage('" + firstvalue + "','" + Endvalue + "','" + sys_gx_re_id + "','" + GuanXi_id + "','" + ToHtmlID + "')";
                if (index == 0) {
                    $("#" + ToHtmlID).find('input[name=' + Endvalue + ']').attr({
                        "onclick": thisurl,
                        "readonly": "readonly"
                    });
                }

                //thisinput.parent().next().attr('id',Endvalue+'_bitian');
                if (thisinput.parent().find('a.jiaok').size() == 0) {
                    thisinput.addClass("findpage").after('<a class="jia jiaok" onclick=' + thisurl + '><i class="fa fa-add"></i></a>');
                }


            });
        }

        //NowToHtmlID.find('.htmlleirong .tagContent').html(data);
    });
    //alert(sys_gx_re_id+';'+GuanXi_id+';'+Table_name+';'+ToHtmlID);
}
//【ok】======================================================================================================关系表赋值
function findpage(firstvalue, Endvalue, sys_gx_re_id, GuanXi_id, ToHtmlID) {
    //findpage('ZD_JianChen','XiangMuJingLi','sys_gx_id_223','15','DeskMenuDiv321')
    var NowToHtmlID = DIVHtmlID(ToHtmlID, ''); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot_02 = DIVHtmlID(ToHtmlID, 'content_foot_02');

    var re_id = parseInt(sys_gx_re_id.replace(/[^0-9]/ig, "")); //获取数字
    //alert(re_id);
    //alert('firstvalue:'+firstvalue+'Endvalue:'+Endvalue+';'+sys_gx_re_id+';'+GuanXi_id+';'+Table_name+';'+ToHtmlID+';'+re_id);
    //alert(re_id);
    var showContent = 'E_' + ToHtmlID + '_MenuDiv_' + re_id;
    //--------------------------------------------------------------打开数据窗口

    NowToHtmlID_content_foot_02.find('.headleft').html('<a class="selectTag">选择数据</a>');
    Foot_Height(0.75, ToHtmlID, '#' + ToHtmlID + '_content_foot_02'); //打开编辑的页面

    //alert(now_re_id);
    NowToHtmlID_content_foot_02.css('background', '#E8E8E8');
    //---------------------------------------------------【如果没有时添加显示层】

    NowToHtmlID_content_foot_02.find('.htmlleirong').html("<ul class='ConTentATO tagContent' GuanXi_id='" + GuanXi_id + "'  id='" + showContent + "'>loading...</ul>");
    var PartHtmlID = '#' + ToHtmlID + '_content_foot_02 .htmlleirong';
    var ShaiXuanSql = '';
    //alert(showContent);
    DeskHtml(PartHtmlID, showContent, ShaiXuanSql, '0');
    NowToHtmlID_content_foot_02.find('#' + showContent).parent().css("overflow", "hidden");

    NowToHtmlID_content_foot_02.find('#' + showContent).find('#footseid3,#footseid9,#footseid13,#footseid14').show();
    //$('#'+showContent).find('.h_right li').html('');
    NowToHtmlID_content_foot_02.find('#' + showContent).show(); //这里显示层
    NowToHtmlID_content_foot_02.find('#' + showContent).find('#footseid16,#footseid17').remove(); //
}

//【ok】======================================================================================================关系表选择传回值
function GetPage(ths, now_id, ToHtmlID, parentToHtmlID) {
    //GetPage(this,'276','E_DeskMenuDiv321_MenuDiv_223','DeskMenuDiv321')
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
    //NowToHtmlID.find('input[name="+sys_gx_re_id+"]').css();
    //alert('00');
    GuanXi_id = $("#" + ToHtmlID).attr('guanxi_id');
    //alert(GuanXi_id);
    $.get('moban_set.php', {
        act: "GetPage_Back",
        now_id: now_id,
        GuanXi_id: GuanXi_id,
        ToHtmlID: ToHtmlID,
        re_id: re_id
    }, function (data) {
        if (data) {
            //alert(data);
            var arrData = data.split(',');
            $.each(arrData, function (index, value) {
                //var arr2=arrData[index];
                //alert(arr2);
                var arrData2 = arrData[index].split(':');
                var zdname = arrData2[0]; //源表字段
                var zdvalue = arrData2[1]; //当前表字段名
                //alert(zdname+'  -> '+zdvalue);
                //--------------------------------------------------------------控件改变
                $('#' + parentToHtmlID + '_content_foot').find('input[name=' + zdname + ']').val(zdvalue);
                //thisinput.attr({"onclick":thisurl}).addClass("findpage").after('<a class="jia" onclick='+thisurl+'><i class="fa fa-add"></i></a>');
                $('#' + parentToHtmlID + '_content_foot_02').hide(600);
            });
            /**/
        }

        //NowToHtmlID.find('.htmlleirong .tagContent').html(data);
    });
    //alert(sys_gx_re_id+';'+GuanXi_id+';'+Table_name+';'+ToHtmlID);

}
//==================================================================================底部设定上面的菜单   
function moveto(ths, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID, 'content_foot');
    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
    NowToHtmlID_content_foot.find('.headleft').html('<a class="selectTag">批量转移</a>');
    NowToHtmlID_content_foot.find('.htmlleirong').html("<ul class='ConTentATO tagContent'>loading...</ul>");
    Foot_Height(0.8, ToHtmlID); //打开编辑的页面
    $.post('moban_moveto.php', {
        act: "list",
        ToHtmlID: ToHtmlID,
        re_id: re_id
    }, function (data) {
        NowToHtmlID_content_foot.find('.htmlleirong .tagContent').html(data);
    });
}
//==================================================================================共享   
function gounxiang(ths, ToHtmlID) {
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID, 'content_foot');
    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
    NowToHtmlID_content_foot.find('.headleft').html('<a class="selectTag">批量转移</a>');
    NowToHtmlID_content_foot.find('.htmlleirong').html("<ul class='ConTentATO tagContent'>loading...</ul>");
    Foot_Height(0.8, ToHtmlID); //打开编辑的页面
    $.post('moban_gongxiang.php', {
        act: "list",
        ToHtmlID: ToHtmlID,
        re_id: re_id
    }, function (data) {
        NowToHtmlID_content_foot.find('.htmlleirong .tagContent').html(data);
    });
}
//=================================================================form数据添加
function form_add_copy(ToHtmlID) { //(formid)
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var copydiv = $("#" + ToHtmlID + " #post_form #mobanaddbox").clone();
    $("#" + ToHtmlID + " #clonecopy2").html(copydiv);
    $("#" + ToHtmlID + " #clonecopy2 #mobanaddbox").attr("id", "mobanaddbox2").hide(); //更改ID
}

//====================================================================验证输入内容是否重复
function YanZhen_ChongFu_ZuLoad(Zdid, ZdnameArry, BiaoName, ToHtmlID) { //(ID,字段名称，表名)
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    //alert(NowToHtmlID);
    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
    var S_ZdnameArry = ZdnameArry.split(',');
    var S_ZdnameArry_length = S_ZdnameArry.length * 1; //这里得到数组数量
    if (S_ZdnameArry_length < 0) {
        return false;
    };
    //if(Zdid==0){//添加页
    //fromid='#addbox';
    //}else{     //修改页执行
    fromid = "#" + ToHtmlID + ' .content_footbox';
    //}
    //alert(pageName());
    if (pageName() == 'M_') { //手机版
        url = "../../MachineV1.0/moban_set_data.php";
    } else {
        url = "moban_set_data.php";
    }
    //alert(url);
    //alert(fromid);
    //$('#SYS_submit').attr({"disabled": "disabled"}); //添加disabled属性
    for (var i = 0; i < S_ZdnameArry_length; i++) {
        var nowzdnamess = S_ZdnameArry[i].trim();
        if (nowzdnamess != "") {
            //alert(nowzdnamess);
            //$(fromid+' [name='+S_ZdnameArry[i]+']').remove(); //$(this).attr({"S_biao_Zdid":Zdid,"S_biao_BiaoName":BiaoName});
            $(fromid + ' [name=' + nowzdnamess + ']').on("change", function () {
                //if ($("#"+$(this).attr('name')+"_bitian").find(".YanZhenChongFu_Div").length<=0){
                var nowloadinggggggID = $(this).attr('name') + "_YanZhenChongFu_Div";
                $("#" + nowloadinggggggID).remove();
                if ($(this).val() != "") {
                    $("#" + $(this).attr('name') + "_bitian").append('<font id=' + nowloadinggggggID + ' class="YanZhenChongFu_Div"><i class="fa fa-nodata bitiantishi chongfuzhi tishi" style="width:1px;"></i>验证重复值...</font>');
                    //alert(nowloadinggggggID);
                };
                //$(fromid+'  .YanZhenChongFu_Div').remove();
                //if ($("#"+$(this).attr('name')+"_bitian").find(".YanZhenChongFu_Div").length<=0){}
                //var act="YanZhenChongFu,Zdid:"+Zdid+",Zdname:"+$(this).attr('name')+",BiaoName:"+BiaoName+",Zdvalue:"+$(this).val();
                var nowclassdiv = "#" + nowloadinggggggID;
                //alert(re_id);
                var Zdvalue = $(this).val();
                var Zdname = $(this).attr('name');
                if (Zdvalue != "") {
                    //AjaxLoad('moban_set_data.php',act,nowclassdiv,'','post',ToHtmlID);
                    $.get(url, {
                        act: 'YanZhenChongFu',
                        Zdid: Zdid,
                        Zdname: Zdname,
                        BiaoName: BiaoName,
                        Zdvalue: Zdvalue,
                        ToHtmlID: ToHtmlID,
                        re_id: re_id
                    }, function (data) {
                        $(nowclassdiv).html(data);
                    });
                };

            });
        };
    };
}

//====================================================================验证输入内容是否重复
function YanZhen_ChongFu_ZuLoad_mobile(Zdid, ZdnameArry, BiaoName, ToHtmlID) { //(ID,字段名称，表名)
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    //alert(NowToHtmlID);
    var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
    var S_ZdnameArry = ZdnameArry.split(',');
    var S_ZdnameArry_length = S_ZdnameArry.length * 1; //这里得到数组数量
    if (S_ZdnameArry_length < 0) {
        return false;
    };
    //if(Zdid==0){//添加页
    //fromid='#addbox';
    //}else{     //修改页执行
    fromid = "#" + ToHtmlID + ' .content_footbox';
    //}
    
    var url = "../../MachineV1.0/moban_set_data.php";

    //alert(url);
    //alert(fromid);
    //$('#SYS_submit').attr({"disabled": "disabled"}); //添加disabled属性
    for (var i = 0; i < S_ZdnameArry_length; i++) {
        var nowzdnamess = S_ZdnameArry[i].trim();
        if (nowzdnamess != "") {
            //alert(nowzdnamess);
            //$(fromid+' [name='+S_ZdnameArry[i]+']').remove(); //$(this).attr({"S_biao_Zdid":Zdid,"S_biao_BiaoName":BiaoName});
            $(fromid + ' [name=' + nowzdnamess + ']').on("change", function () {
                //if ($("#"+$(this).attr('name')+"_bitian").find(".YanZhenChongFu_Div").length<=0){
                var nowloadinggggggID = $(this).attr('name') + "_YanZhenChongFu_Div";
                $("#" + nowloadinggggggID).remove();
                if ($(this).val() != "") {
                    $("#" + $(this).attr('name') + "_bitian").append('<font id=' + nowloadinggggggID + ' class="YanZhenChongFu_Div"><i class="fa fa-nodata bitiantishi chongfuzhi tishi" style="width:1px;"></i>验证重复值...</font>');
                    //alert(nowloadinggggggID);
                };
                //$(fromid+'  .YanZhenChongFu_Div').remove();
                //if ($("#"+$(this).attr('name')+"_bitian").find(".YanZhenChongFu_Div").length<=0){}
                //var act="YanZhenChongFu,Zdid:"+Zdid+",Zdname:"+$(this).attr('name')+",BiaoName:"+BiaoName+",Zdvalue:"+$(this).val();
                var nowclassdiv = "#" + nowloadinggggggID;
                //alert(re_id);
                var Zdvalue = $(this).val();
                var Zdname = $(this).attr('name');
                if (Zdvalue != "") {
                    //AjaxLoad('moban_set_data.php',act,nowclassdiv,'','post',ToHtmlID);
                    $.get(url, {
                        act: 'YanZhenChongFu',
                        Zdid: Zdid,
                        Zdname: Zdname,
                        BiaoName: BiaoName,
                        Zdvalue: Zdvalue,
                        ToHtmlID: ToHtmlID,
                        re_id: re_id
                    }, function (data) {
                        $(nowclassdiv).html(data);
                    });
                };

            });
        };
    };
}
//=========================================================================================字不能为物殊符号
function replacefh(ths)
    {
	var thisvalue=$(ths).val();
	var reg=/[\,\',\_]/g;//这里将要禁止输入的特殊符号列入
    thisvalue=thisvalue.replace(reg,'');//不允许输入特殊符号
	//thisvalue=thisvalue.replace('请添加','');//不允许输入特殊符号
	var thisvalue=thisvalue.match(/^[\u4e00-\u9fa5a-zA-Z0-9]+$/g);//去掉数字开头部份
  	$(ths).val(thisvalue);//给当前文本框赋值
	}
//==================================================================================【以下表的处理】   
function table_pinyin_mobile(ths) { //一级导航修改。
    //replacefh(ths);//去除符号
    var id= $('#id').val();
    //alert(id);
    var thisvalue = $(ths).val().replace(/[ ]/g, "");
    var thisvaluePY = 'SQP_' + ToPinYing(thisvalue); //得到拼音
    var thisvalue_toLowerCase = thisvalue.toLowerCase();
    //alert(thisvalue);
    $.post("M_RecordList_terms_show_ajax.php", {
        act: "table_pinyin_mobile",
        tablename: "Sys_Jlmb",
        thisvalue: thisvalue,
        id:id,
        thisvaluePY: thisvaluePY
    }, function (data) {
        //alert(data);
        $('#mdb_name_SYS').val(data);
        //alert(data);
    }); //提交参数

}
//==================================================================================【以下表的处理】   
function chanshu_pinyin_mobile(ths,parent_id) { //一级导航修改。
    //replacefh(ths);//去除符号
    var id= $('#id').val();
    //alert(id);
    var thisvalue = $(ths).val().replace(/[ ]/g, "");
    var thisvaluePY = ToPinYing(thisvalue); //得到拼音
    var thisvalue_toLowerCase = thisvalue.toLowerCase();
    //alert(thisvalue);
    $.post("M_Template_list_edit_ajax.php", {
        act: "chanshu_pinyin_mobile",
        tablename: "msc_renzhengmoban_chanshu",
        thisvalue: thisvalue,
        id:id,
        parent_id:parent_id,
        thisvaluePY: thisvaluePY
    }, function (data) {
        //alert(data);
        $('#sys_keyword_en').val(data);
        //alert(data);
    }); //提交参数

}

