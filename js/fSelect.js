//---------------------------------------------------------------------------------------------------------------------处理select
function Fselect(thisclass, fh = ',') {
    $(thisclass).each(function (i) {
        var thisname = this.name; //表单名
        var thisid = this.id; //id名称
        var thisval = ""; //得到值
        var thistext = ""; //得到值
        var iic = 0;
        $(this).find("option").each(function (i) {
            if ($(this).attr('selected')) {
                thisval += $(this).val() + fh;
                thistext += $(this).text() + ',';
                iic++;
            }
        })
        thisval = thisval.replace(/(^_)|(_$)/g, ''); //去前后，
        thistext = thistext.replace(/(^,)|(,$)/g, ''); //去前后，

        var thishtml = "";
        thishtml += "<div class='addboxdiv_parent'><input id='" + thisid + "' name='" + thisname + "' value='" + thisval + "' type='hidden'  class='addboxiddiv' /><input id='" + thisid + "_name' name='" + thisname + "_name' value='" + thistext + "' type='text' class='addboxinput inputfocus addboxdiv'  onclick='select_menushow(this)' style='width:90%' />";

        thishtml += "<div class='top'><input value='' type='text' class='addboxinput inputfocus' onkeyup='select_menusearch(this)' style='width:80%' /><div class='seachimg'><i class=\"fa fa-search\"></i></div></div>"; //搜索

        thishtml += "<div class='addboxdiv_menu'>";
        $(this).find("optgroup").each(function (i) {
            var nowlabel = $(this).attr('label'); //得到大类名称
            thishtml += "<li class='h1'>" + nowlabel + "</li>";
            //----------------------------------------------得到小类
            $(this).find("option").each(function (i) {
                var nowval = $(this).val();
                var nowname = $(this).html();
                var nowselect = '';
                var nowi = '';

                if ($(this).attr('selected')) {
                    nowselect = 'xuanzhong';
                    nowi = '<i class=\"fa fa-21-2\"></i>';
                    i++;
                } else {
                    nowi = '<i class=\"fa fa-21-1\"></i>';
                }
                thishtml += "<li id='" + nowval + "'  onclick='select_menuchange(this,\"" + fh + "\")' class=" + nowselect + " >" + nowi + nowname + "</li>";
            })
            //----------------------------------------------得到小类end if
        })


        thishtml += "</div><div class='bottom' onclick='select_menuout(this)'><ld  class='tongji_input'>选中<font class='tongji' color='red'> " + iic + " </font>项</ld> <ld class='closeinput'>关闭</ld></div></div>";
        $(this).before(thishtml);
        $('.' + thisname).remove();
        //alert(thisname);
    });
}

//---------------------------------------------------------------------------------------------------------------------文本框的进入时
function select_menushow(ths) {
    $(ths).parent().find('.addboxdiv_menu,.top,.bottom').toggle(300);
    //$(ths).parent().find('.addboxdiv_menu').width($(ths).parent().find('.addboxdiv').width()-12);
}
//---------------------------------------------------------------------------------------------------------------------下拉框失去焦点时
function select_menuout(ths) {
    //$(ths).parent().find('.addboxdiv_menu').toggle(300);
    $(ths).parent().find('.addboxdiv_menu,.top,.bottom').hide(500);
    $(ths).parent().parent().find('.top input').val('');
    $(ths).parent().parent().find('.addboxdiv_menu li').show();
}
//---------------------------------------------------------------------------------------------------------------------搜索
function select_menusearch(ths) {
    var nowval = $(ths).val();
    if (nowval + '1' == '1') {
        $(ths).parent().parent().find('.addboxdiv_menu li').show();
    } else {
        $(ths).parent().parent().find('.addboxdiv_menu li').not('.h1').hide(0);
        $(ths).parent().parent().find('.addboxdiv_menu li:contains("' + nowval + '")').show();
    }

}
//---------------------------------------------------------------------------------------------------------------------下拉框选中时
function select_menuchange(ths, fh) {
    if ($(ths).hasClass("xuanzhong")) {
        $(ths).removeClass("xuanzhong");
        $(ths).find('i').removeClass("fa-21-2").addClass("fa-21-1");
    } else {
        $(ths).addClass("xuanzhong");
        $(ths).find('i').removeClass("fa-21-1").addClass("fa-21-2");
    }
    //alert(fh);

    //alert($(ths).attr('id'));
    select_menuchange_to_val(ths, fh);
}
//---------------------------------------------------------------------------------------------------------------------下拉框选中时更新值
function select_menuchange_to_val(ths, fh) {
    var nowid = '';
    var nowval = '';
    var nowi = 0;
    $(ths).parent().find("li.xuanzhong").each(function (i) {

        nowid += $(this).attr("id") + fh;
        nowval += $(this).text() + ',';
        nowi++;
    });
    //alert(nowid);
    if (fh == '_') {
        nowid = nowid.replace(/(^_)|(_$)/g, ''); //去前后_
    } else {
        nowid = nowid.replace(/(^,)|(,$)/g, ''); //去前后，
    }

    nowval = nowval.replace(/(^,)|(,$)/g, '');
    $(ths).parents(".addboxdiv_parent").find(".addboxiddiv").val(nowid);
    $(ths).parents(".addboxdiv_parent").find(".addboxdiv").val(nowval);
    $(ths).parents(".addboxdiv_parent").find('.tongji').text(nowi);
}

//---------------------------------------------------------------------------------------------------------------------处理radio
function Fradio(thisclass) {
    var thishtml = '';
    $(thisclass).each(function (i) {
        
        var thisname = this.name; //表单名
        var thisid = this.id; //id名称
        var thisval = this.value; //得到值
        
        if (thisval == 0) {
            thishtml += "<i class='fa fa-27-3' style='height:25px;margin-top:2px' onclick='radio_change(this)'></i>"; //禁止登录时  0
        } else {
            thishtml += "<i class='fa fa-28-3' style='height:25px;margin-top:2px' onclick='radio_change(this)'></i>";
        }

        $(this).after(thishtml);
        $(this).hide();
        //$('.' + thisname).remove();
        //alert(thisname);
    });
}
//---------------------------------------------------------------------------------------------------------------------处理radio
function radio_change(ths) {
    if ($(ths).hasClass('fa-27-3')) {
        $(ths).removeClass('fa-27-3').addClass('fa-28-3');//为禁止状态，设定为允许登录
        $(ths).parent().find('input').val(1);
    } else {
        $(ths).removeClass('fa-28-3').addClass('fa-27-3');
        $(ths).parent().find('input').val(0);
    }
}
//---------------------------------------------------------------------------------------------------------------------处理radio性别
function Fradio_xinbie(thisclass) {
    var thishtml = '';
    $(thisclass).each(function (i) {
        
        var thisname = this.name; //表单名
        var thisid = this.id; //id名称
        var thisval = this.value; //得到值
        
        if (thisval == '男') {
            thishtml += "<i class='fa fa-30-1' style='margin-top:2px' onclick='radio_xinbie(this)'></i>"; //禁止登录时  0
        } else {
            thishtml += "<i class='fa fa-30-2' style='margin-top:2px' onclick='radio_xinbie(this)'></i>";
        }

        $(this).after(thishtml);
        $(this).hide();
        //$('.' + thisname).remove();
        //alert(thisname);
    });
}
//---------------------------------------------------------------------------------------------------------------------处理radio_xingbie
function radio_xinbie(ths) {
    if ($(ths).hasClass('fa-30-1')) {
        $(ths).removeClass('fa-30-1').addClass('fa-30-2');//为禁止状态，设定为允许登录
        $(ths).parent().find('input').val('女');
    } else {
        $(ths).removeClass('fa-30-2').addClass('fa-30-1');
        $(ths).parent().find('input').val('男');
    }
}
