//==================================================================自动生成TAB选项卡
function loadmenu() {
    //$("#headindextop").append("<li class='overli' id='top_loading'>loading...</li>");
    $.get('B_moban_top.php', {
        act: "list",
        re_id: 0
    }, function (data) {
        $("#headindextop").append(data);
        $("#headindextop UL").not('#DeskMenuDiv0,#top_loading').hide(0).show(1000);
        $("#headindextop #top_loading").hide(2300);
        //$("#headindextop #top_loading").hide(2000);
    });
}

function AddTopMenu(nowarr) {
    var arr = nowarr.split(',');
    $.each(arr, function (key, val) {
        var arr1 = val.split('_');
        if (arr1[0] != "") {
            $("#headindextop").append("<UL id='Top_DeskMenuDiv" + arr1[0] + "'><li class='overli'>" + arr1[1] + "</li><UL>");
            $("#headindextop")
                .on('click', '#Top_DeskMenuDiv' + arr1[0], function () {
                    PostAddTopMenu(arr1[0], arr1[1]);
                    Top_SelectTag($(this).attr('id'));
                    $(this).find('li').removeClass('selectbefore'); //清除之前识别的菜单样式
                    DeskMenu('body', $(this).attr('id'));
                }).on('dblclick', '#Top_DeskMenuDiv' + arr1[0], function () {
                    //alert(arr1[0]+';'+arr1[1]);
                    DelTopMenu(this);
                    //DelTopMenu( arr1[ 0 ], prevre_id );
                }).on('mouseleave', '#Top_DeskMenuDiv' + arr1[0], function () {
                    $(this).find('.closetop').remove();
                });
        }
    }); //each end
}
//==================================================================删除TAB选项卡
function DelTopMenu(ths) {
    if(arrProxy){
        if(arrProxy.indexOf($(ths).text()) >= 0){
            arrProxy.splice(arrProxy.indexOf($(ths).text()), 1)
        }
    }
    // console.log($(ths).text())
    var nowre_id = $(ths).attr("id").toString().replace(/[^0-9]/ig, "") * 1; //只取数值部份
    //alert(nowre_id + "_" + prevre_id);
    $.post("moban_set_data.php", {
        act: 'Top_Menu_Del',
        re_id: nowre_id,
    },function(prevre_id){
        // console.log(prevre_id)
        $("#Top_DeskMenuDiv" + nowre_id).remove(); //菜单删除
        $(`#Top_DeskMenuDiv${prevre_id}`).click(); //菜单前面一个选中
        $("#DeskMenuDiv" + nowre_id).remove(); //内容删除
        $(`#DeskMenuDiv${prevre_id}`).click(); //内容前面一个选中
    });
    //alert("#DeskMenuDiv"+prevre_id);
}
//==================================================================TAB选项卡
function Top_SelectTag(thsid) {
    // 操作标签
    //alert(thsid);

    menuoverclickstyle('#headindextop li', 'overTag', 'selectTag');
    $("#headindextop li").removeClass("selectTag").removeClass("selectTagdesk");
    if (thsid == "Top_DeskMenuDiv0") {
        $("#" + thsid).find("li").addClass("selectTagdesk"); //
    } else {
        $("#" + thsid).find("li").addClass("selectTag"); //$(ths).attr('id')
    }
    //document.getElementById('attachucp').cols = '0,0,77,*';
}

//==================================================================TAB选项卡【之前菜单，还要编辑】
function selectbefore(thsid) {
    // 操作标签
    //alert(thsid);

    menuoverclickstyle('#headindextop li', 'overTag', 'selectbefore');
    $("#headindextop li").removeClass("selectTagdesk");
    if (thsid == "DeskMenuDiv0") {
        $("#" + thsid).find("li").addClass("selectTagdesk"); //
    } else {
        $("#" + thsid).find("li").addClass("selectbefore"); //$(ths).attr('id')
    }

}

function menuoverclickstyle(divname, overstylename, cheeckstyle) { //这里为切换 over click 切换效果
    //$(ths).parents("div").find(liname).removeClass('licheck');$(ths).addClass('licheck');
    $(divname).on('mouseover', function () {
            if (!$(this).hasClass(cheeckstyle)) {
                $(this).addClass(overstylename);
            }
        })
        .on('mouseout', function () {
            $(this).removeClass(overstylename);
        })
        .on('click', function () {
            $(this).removeClass(overstylename);
            $(divname).removeClass(cheeckstyle);
            $(this).addClass(cheeckstyle);
        });
}
