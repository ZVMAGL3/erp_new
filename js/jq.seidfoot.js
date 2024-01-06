/*以下为定位到文本框内容最后位置，兼容所有浏览器*/
$.fn.setCursorPosition = function (position) {
	if (this.lengh == 0) return this;
	return $(this).setSelection(position, position);
}
$.fn.setSelection = function (selectionStart, selectionEnd) {
	if (this.lengh == 0) return this;
	input = this[0];
	if (input.createTextRange) {
		var range = input.createTextRange();
		range.collapse(true);
		range.moveEnd('character', selectionEnd);
		range.moveStart('character', selectionStart);
		range.select();
	} else if (input.setSelectionRange) {
		input.focus();
		input.setSelectionRange(selectionStart, selectionEnd);
	};
	return this;
}
$.fn.focusEnd = function () {
	var nowval=$(this).val();
	//alert(nowval);
	/*
	if (nowval){
		var nowlength=nowval.length;
	}else{
		nowlength=0;
	}
	

	if (nowval || nowlength != 0 || nowval!=''){
		//nowval='0';
		this.setCursorPosition(nowlength);//定位到文本框内容最后位置 end
    }
	*/
};

function selectTag(showContent,ths,tabsclass,ToHtmlID,sys_guanxibiao_id,GuanXi_id ){

	var NowToHtmlID=DIVHtmlID(ToHtmlID,'head');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
	var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID,'content_foot'); 
	
	var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
	var $divtab = $(ths).parents("." + tabsclass); //包含TAB及其内容的div
	var $datahtml = '#' + showContent;
	$(ths).parents(".tabs").find("LI").removeClass("selectTag"); //这里TAB框切换

	$(ths).parents("LI").addClass("selectTag"); //tabsboxFK
	if ($divtab.find("#" + showContent).size() == 0) {
		$divtab.find("#tagContent").append("<DIV class='tagCochange' id='" + showContent + "'></DIV>");
	}
	$divtab.find(".tagCochange").removeClass("selectTag"); //这里TAB内容切换
	$divtab.find("#" + showContent).addClass("selectTag");
	$divtab.css({
		'height': '90%'
	}); //这里设定内容高度
	//alert($datahtml);

	if (showContent != 'tagContent0' && NowToHtmlID_content_foot.find($datahtml).text() == "") {
		NowToHtmlID_content_foot.find($datahtml).html('loading...');
		//AjaxLoad("moban_set_data.php",act,$datahtml,'','post',ToHtmlID);//这里加载内容
		$.post('moban_set_data.php', {
			act: "XianJieBiao",
			sys_guanxibiao_id: sys_guanxibiao_id,
			GuanXi_id: GuanXi_id,
			ToHtmlID:ToHtmlID,
			re_id: re_id
		}, function (data) {
			//alert(data);
			NowToHtmlID_content_foot.find($datahtml).html(data);
		});
	}
} ///*这里自适应宽度的TAB选项框end

//【ok】======================================================================================================下方的头部菜单
function SelectTag_Menu(showContent, ths, ToHtmlID, sys_guanxibiao_id, GuanXi_id) { // 操作标签///*这里自适应宽度的TAB选项框*
	// console.log(234)
	var NowToHtmlID=DIVHtmlID(ToHtmlID,'head');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID,'content_foot'); 
	var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
	SelectMenu($(ths).parent(),ths);  //【这里TAB框切换】
    
    var now_re_id=showContent.substring(showContent.length-5).replace(/[^0-9]/ig,"");
		//alert(now_re_id);
	var htmlleirong=NowToHtmlID_content_foot.find('.htmlleirong');
	    NowToHtmlID_content_foot.find('.htmlleirong .tagContent').not('#tagContent').remove();
	
	//---------------------------------------------------【如果有时显示层】	

    if (NowToHtmlID_content_foot.find('#'+showContent).length > 0) {
		//NowToHtmlID_content_foot.find('.tagContent').hide();//这里隐藏所有层
		NowToHtmlID_content_foot.find('#'+showContent).show();
	//---------------------------------------------------【如果没有添加层】
	}else{
		NowToHtmlID_content_foot.find('.tagContent').hide();//这里隐藏所有层
		htmlleirong.append("<ul class='ConTentATO tagContent'  id='" + showContent + "' sys_guanxibiao_id='" + re_id + "' GuanXi_id='" + GuanXi_id + "'>loading...</ul>");
		//--------------------------------------------------------------- 编辑页面
		if(showContent == 'tagContent'){
		    NowToHtmlID_content_foot.css('background','#F2F2F2');
		    htmlleirong.css("overflow-y","auto");
			NowToHtmlID_content_foot.find('#'+showContent).css("overflow-y","auto");
		//--------------------------------------------------------------- 聊天记录
		}else if(showContent != 'tagContent' && now_re_id == '264') {
		    var editname=$("#"+ToHtmlID).attr("editdata_cn");
		    $.post('moban_guanxi.php', {
			    act: "XianJieBiao",
			    sys_guanxibiao_id: sys_guanxibiao_id,
			    GuanXi_id: GuanXi_id,
			    editname:editname,
			    ToHtmlID:ToHtmlID,
			    re_id: re_id
		    }, function (data) {
			    //alert(data);
			    NowToHtmlID_content_foot.find('#'+showContent).html(data);
		    });
		        //alert(ToHtmlID);
			    //alert(showContent);
		    NowToHtmlID_content_foot.find('#'+showContent).parent().css("overflow-y","auto");
		//--------------------------------------------------------------- 关系表
	    }else if(showContent != 'tagContent' && now_re_id == '368') {
		    var editname=$("#"+ToHtmlID).attr("editdata_cn");
		    $.post('moban_guanxi.php', {
			    act: "xiuguaijilu",
			    sys_guanxibiao_id: re_id,
			    GuanXi_id: GuanXi_id,
			    editname:editname,
			    ToHtmlID:ToHtmlID,
			    re_id: re_id
		    }, function (data) {
			    //alert(data);
			    NowToHtmlID_content_foot.find('#'+showContent).html(data);
		    });
		        //alert(ToHtmlID);
			    //alert(showContent);
		    NowToHtmlID_content_foot.find('#'+showContent).parent().css("overflow-y","auto");
        //--------------------------------------------------------------- 模版
	    }else if(showContent == 'tagContent1') {
		    var editname=$("#"+ToHtmlID).attr("editdata_cn");
		    $.post('moban_guanxi.php', {
			    act: "mobanedit",
			    sys_guanxibiao_id: re_id,
			    GuanXi_id: GuanXi_id,
			    editname:editname,
			    ToHtmlID:ToHtmlID,
			    re_id: re_id
		    }, function (data) {
			    //alert(data);
			    NowToHtmlID_content_foot.find('#'+showContent).html(data);
		    });
		        //alert(ToHtmlID);
			    //alert(showContent);
		    NowToHtmlID_content_foot.find('#'+showContent).parent().css("overflow-y","auto");
        //--------------------------------------------------------------- 文件
        }else if(showContent == 'tagContent2') {
		    var editname=$("#"+ToHtmlID).attr("editdata_cn");
		    $.post('moban_guanxi.php', {
			    act: "mobanedit",
			    sys_guanxibiao_id: re_id,
			    GuanXi_id: GuanXi_id,
			    editname:editname,
			    ToHtmlID:ToHtmlID,
			    re_id: re_id
		    }, function (data) {
			    //alert(data);
			    NowToHtmlID_content_foot.find('#'+showContent).html(data);
		    });
		        //alert(ToHtmlID);
			    //alert(showContent);
		    NowToHtmlID_content_foot.find('#'+showContent).parent().css("overflow-y","auto");
		//--------------------------------------------------------------- 其它
	    }else{
		    var PartHtmlID="#"+ToHtmlID+'_content_foot .htmlleirong';
		    var ShaiXuanSql='sys_gx_id_'+re_id+'=\''+GuanXi_id+"\'";//得到筛选SQL语句
			//alert(ShaiXuanSql);
		    DeskHtml(PartHtmlID,showContent,ShaiXuanSql,'0');
			
			//NowToHtmlID_content_foot.find('#'+showContent).parent().css("overflow","hidden");  //
			htmlleirong.css("overflow-y","hidden");
	    }
		NowToHtmlID_content_foot.find('#'+showContent).show();                             //这里显示层
	}
	NowToHtmlID_content_foot.css('background','#E8E8E8');                              //背景灰度
	NowToHtmlID_content_foot.find('#footseid16,#footseid17').remove();                 //删除回收和销毁按钮

} ///*这里自适应宽度的TAB选项框end*/
//=============================================================================//设定  显示
function moban_check(showContent , ths , ToHtmlID ) { //表单设计
    var NowToHtmlID = DIVHtmlID(ToHtmlID, 'fanall'); //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
    var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID, 'content_foot');
    var re_id = NowToHtmlID.find("#sys_const_re_id").val();
    var sys_guanxibiao_id = $("#" + ToHtmlID).attr('sys_guanxibiao_id'); //得到关系表里的id
    var GuanXi_id = $("#" + ToHtmlID).attr('GuanXi_id'); //得到对应关系re_id
    //Foot_Height(0.8, ToHtmlID);     //打开编辑的页面
    NowToHtmlID_content_foot.find('.tagContent').hide(); //这里隐藏所有层
    SelectMenu($(ths).parent(), ths); //这里切换菜单样式
    if (NowToHtmlID_content_foot.find('#'+showContent).length > 0) {
        //NowToHtmlID_content_foot.find('.tagContent').hide();//这里隐藏所有层
        NowToHtmlID_content_foot.find('#'+showContent).show();
        //---------------------------------------------------【如果没有添加层】
    } else {
        NowToHtmlID_content_foot.find('.htmlleirong').append("<ul  id='"+showContent+"' class='tagContent' style='padding-left:15px;overflow-y:auto'><br><br>&nbsp;加载中...</ul>");
        $.get('moban_set.php', {
            act: "moban_check",
            sys_guanxibiao_id: sys_guanxibiao_id,
            GuanXi_id: GuanXi_id,
            ToHtmlID: ToHtmlID,
            re_id: re_id
        }, function (data) {
            NowToHtmlID_content_foot.find('#'+showContent).html(data);
        }); //这里打开模版
    }

    //addboxbg('#footseid9', ToHtmlID);
    NowToHtmlID_content_foot.find('.htmlleirong').css("overflow-y", "auto"); //自动出现滚动条
}
//【ok】======================================================================================================二级选项卡菜单
function SelectTag_Menu_Two(showContent,ths,ToHtmlID) { // 操作标签///*这里自适应宽度的TAB选项框*
	//alert(ToHtmlID);
	// var NowToHtmlID_content_foot = DIVHtmlID(ToHtmlID,'content_foot'); 
	//var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
    $(ths).parents('#post_form').find('.ContentTwo').hide();                             //这里显示层
	//var newshowContent = showContent.replace(/[\d+\.\#]/g,"");  //去掉数字开头部份
	//alert(showContent);
	SelectMenu($(ths).parent(),ths);  //【这里TAB框切换】
	//NowToHtmlID_content_foot.find('[class="'+newshowContent+'"]').remove();                             //这里显示层
	
	$(ths).parents('#post_form').find(showContent).show();                             //这里显示层
	
}


//【ok】======================================================================================================下方关系表横向新增
function GuanXiAddZiDuanMenu(ths,ToHtmlID,databiao,databiaoENname) {
	var NowToHtmlID=DIVHtmlID(ToHtmlID,'fanall');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
	var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
	var sys_guanxibiao_id=NowToHtmlID.attr('sys_guanxibiao_id');                     //得到关系表里的id
	var GuanXi_id=NowToHtmlID.attr('GuanXi_id');                 //得到对应关系re_id
	
	var GuanXiTable=$(ths).parents('.GuanXiTable');
	var parentid=GuanXiTable.attr("id");
	var previd=GuanXiTable.prev().attr("id");
	var prevcss=GuanXiTable.prev().attr("class");
	//alert(previd+'_'+prevcss);
	//alert(re_id);
	if(!previd && prevcss=='GuanXiTable'){
		return false;
	}
	$.post('moban_set.php', {
		act: 'GuanXiaddHeng',
		re_id:re_id,
		sys_guanxibiao_id: sys_guanxibiao_id,
        GuanXi_id: GuanXi_id,
		parentid:parentid,
		databiao:databiao,
		ToHtmlID:ToHtmlID,
		databiaoENname:databiaoENname
	}, function (data) {
		//alert(data);
		//$(ths).parents('.GuanXiTable').find('.ziduanTo').not(ths).html(data);
		$(ths).parents('li').before(data);
		GuanXi_ZiDuanChange_hidden(parentid,ToHtmlID);
	});
	
}
//【ok】======================================================================================================下方关系表新增
function guanxiaddmenu(ths,ToHtmlID) {
	var NowToHtmlID=DIVHtmlID(ToHtmlID,'fanall');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
	var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
	var sys_guanxibiao_id=NowToHtmlID.attr('sys_guanxibiao_id');                     //得到关系表里的id
	var GuanXi_id=NowToHtmlID.attr('GuanXi_id');                 //得到对应关系re_id
	// console.log(re_id+'_'+sys_guanxibiao_id,GuanXi_id);
	
	var previd=$(ths).parent().prev().attr("id");
	var prevcss=$(ths).parent().prev().attr("class");
	// console.log(previd+'_'+prevcss);
	if(!previd && prevcss=='GuanXiTable'){
		return false;
	}
	$.post('moban_set.php', {
		act: 'GuanXiadd',
		re_id:re_id,
		ToHtmlID:ToHtmlID,
		sys_guanxibiao_id: sys_guanxibiao_id,
        GuanXi_id: GuanXi_id
	}, function (data) {
		data = $(data)
		// console.log(data.get(0));
		//$(ths).parents('.GuanXiTable').find('.ziduanTo').not(ths).html(data);
		$(ths).parents('.GuanXiTable').before(data);
		$i=0;
	    $(ths).parents('.tagContent').find('.GuanXiTable').not($(ths).parents('.GuanXiTable')).each(function(){
		  $i++;
		  //alert($(ths).attr('id'));
		  if($i<10){
			$i='0'+$i;
		  }
		  $(this).find('li:first-child').text($i);
	    });
	    //$(ths).parent().parent().prev().attr("id",'').find('[type="select"]').val(0);
	});
	
}

//[ok]=========================================================================================【关系表添加、更新】
function GuanXi_TableNameChange(ths,ToHtmlID) {
	
	var NowToHtmlID=DIVHtmlID(ToHtmlID,'fanall');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
	var databiaoENname=$(ths).val();
	var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
	var re_id_02 = $(ths).find('option[value="'+databiaoENname+'"]').attr('title');     //得到 sys_jlmb id
	var sys_guanxibiao_id=NowToHtmlID.attr('sys_guanxibiao_id');                        //得到关系表里的id
	var GuanXi_id=NowToHtmlID.attr('GuanXi_id');                                        //得到对应关系re_id
	//alert(re_id_02);
	
	var id=$(ths).parents('.GuanXiTable').attr('id');
	
	//----------------------------添加与更新记录
	//alert(databiaoENname);
	$.post('moban_set.php', {
		act: 'GuanXi_TableNameChange_POST',
		re_id:re_id,
		re_id_02:re_id_02,
		sys_guanxibiao_id: sys_guanxibiao_id,
        GuanXi_id: GuanXi_id,
		id:id,
		databiaoENname:databiaoENname
	}, function (data) {
		console.log(data);

		if(id=='' || !id){
			$(ths).parents('.GuanXiTable').attr('id',data);
		}
		UpdatePhp_Pc(re_id);   //这里更新php生成文件
		UpdatePhp_Pc(re_id_02);   //这里更新php生成文件

		if(id>=1){
			//----------------------------获得标签
			$.post('moban_set.php', {
				act: 'GuanXi_Del',
				re_id:re_id,
				re_id_02:re_id_02,
				ToHtmlID:ToHtmlID,
				sys_guanxibiao_id: sys_guanxibiao_id,
				GuanXi_id: GuanXi_id,
				id:id,
				databiaoENname:databiaoENname
			}, function (data) {
				console.log(data);
			});	
		}
	
		//----------------------------获得标签
		$.post('moban_set.php', {
			act: 'GuanXi_ZiDuanChange',
			re_id:re_id,
			re_id_02:re_id_02,
			ToHtmlID:ToHtmlID,
			sys_guanxibiao_id: sys_guanxibiao_id,
			GuanXi_id: GuanXi_id,
			id:id,
			databiaoENname:databiaoENname
		}, function (data) {
			console.log(data);
			$(ths).parents('.GuanXiTable').find('.ziduanTo').not(ths).html(data);
			
		});
	});
	
	//alert(tableneme+','+search_zd+','+search_value+','+tochang_zd+','+tochang_value);
};
//[ok]=========================================================================================【关系id对应字段更新】
function GuanXi_ZiDuanChange(ths,ToHtmlID) {
	
	var NowToHtmlID=DIVHtmlID(ToHtmlID,'fanall');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
	var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
	var sys_guanxibiao_id=NowToHtmlID.attr('sys_guanxibiao_id');                     //得到关系表里的id
	var GuanXi_id=NowToHtmlID.attr('GuanXi_id');                 //得到对应关系re_id
	
	var databiaoENname=$(ths).val();
	var id=$(ths).parents('.GuanXiTable').attr('id');
	//alert(id);

	//----------------------------更新记录UpdatePhp_Pc(re_id);   //这里更新php生成文件
	$.post('moban_set.php', {
		act: 'GuanXi_ZiDuanChange_POST',
		ToHtmlID:ToHtmlID,
		re_id:re_id,
		id:id,
		databiaoENname:databiaoENname
	}, function (data) {
		//alert(data);
        GuanXi_ZiDuanChange_hidden(id,ToHtmlID);
		UpdatePhp_Pc(re_id);   //这里更新php生成文件
	});
	//alert(tableneme+','+search_zd+','+search_value+','+tochang_zd+','+tochang_value);
};
//[ok]=========================================================================================【关系删除】
function GuanXi_ZiDuan_Del(ths,ToHtmlID) {
	
	var NowToHtmlID=DIVHtmlID(ToHtmlID,'fanall');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
	var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
	var sys_guanxibiao_id=NowToHtmlID.attr('sys_guanxibiao_id');                     //得到关系表里的id
	var GuanXi_id=NowToHtmlID.attr('GuanXi_id');                 //得到对应关系re_id
	
	var parentli=$(ths).parents('li.ziduanheng');

	var id=$(ths).parents('.GuanXiTable').attr('id');
	//alert(id);
	
	var $nowval='';
    $(ths).parents('.GuanXiTable').find('li.ziduanheng').not(parentli).each(function(){
		  $nowval+=$(this).find('.ziduan').val()+'='+$(this).find('.ziduanTo').val()+',';
	})
	//alert($nowval);
	//----------------------------更新记录
	$.post('moban_set.php', {
		act: 'GuanXi_ZiDuanChange_Hengxiang_POST',
		re_id:re_id,
		sys_guanxibiao_id: sys_guanxibiao_id,
        GuanXi_id: GuanXi_id,
		id:id,
		ziduanarry:$nowval
	}, function (data) {
		//alert(data);
		parentli.remove();//删除该列对应关系
		GuanXi_ZiDuanChange_hidden(id,ToHtmlID);
		UpdatePhp_Pc(re_id);   //这里更新php生成文件
		
	});

};
//[ok]=========================================================================================【关系id对应字段更新】
function GuanXi_ZiDuanChange_Hengxiang(ths,ToHtmlID) {
	console.log(1237565)
	var NowToHtmlID=DIVHtmlID(ToHtmlID,'fanall');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
	var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
	var sys_guanxibiao_id=NowToHtmlID.attr('sys_guanxibiao_id');                     //得到关系表里的id
	var GuanXi_id=NowToHtmlID.attr('GuanXi_id');                 //得到对应关系re_id
	
	var id=$(ths).parents('.GuanXiTable').attr('id');
	//alert(id);
	var $nowval='';
    $(ths).parents('.GuanXiTable').find('li.ziduanheng').each(function(){
		  $nowval+=$(this).find('.ziduan').val()+'='+$(this).find('.ziduanTo').val()+',';
	})
	//alert($nowval);
	//----------------------------更新记录
	$.post('moban_set.php', {
		act: 'GuanXi_ZiDuanChange_Hengxiang_POST',
		ToHtmlID:ToHtmlID,
		re_id:re_id,
		sys_guanxibiao_id: sys_guanxibiao_id,
        GuanXi_id: GuanXi_id,
		id:id,
		ziduanarry:$nowval
	}, function (data) {
		//alert(data);
		GuanXi_ZiDuanChange_hidden(id,ToHtmlID);
		UpdatePhp_Pc(re_id);   //这里更新php生成文件
	});
	//
	//alert(tableneme+','+search_zd+','+search_value+','+tochang_zd+','+tochang_value);
};
//[ok]=========================================================================================【关系id对应字段更新】
function GuanXi_ZiDuanChange_hidden(id,ToHtmlID) {
	//alert('id:'+id+';ToHtmlID:'+ToHtmlID);
	var NowToHtmlID=DIVHtmlID(ToHtmlID,'fanall');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
	//-----------------------------------------------更新上面字段
	var arrData=[];
    NowToHtmlID.find('.GuanXiTable#'+id).find('li.ziduanheng .ziduan').each(function(){
		  arrData.push($(this).val());
		  //alert($nowval);
	})
	//alert(arrData);
	NowToHtmlID.find('.GuanXiTable#'+id).find('li.ziduanheng .ziduan').each(function(){
		  var thisziduan=$(this);
		  var nowval=thisziduan.val();
		  thisziduan.find('option').show();
		  $.each(arrData, function(index,value){
			  thisziduan.find('option[value="'+value+'"]').hide();
          });
	})
	//-----------------------------------------------更新下面字段
	var arrData2=[];
	var idvalue=NowToHtmlID.find('.GuanXiTable#'+id).find('li.cols3 .ziduanTo').val();
	arrData2.push(idvalue);
    NowToHtmlID.find('.GuanXiTable#'+id).find('li.ziduanheng .ziduanTo').each(function(){
		  arrData2.push($(this).val());
		  //alert($nowval);
	})
	
	NowToHtmlID.find('.GuanXiTable#'+id).find('li.ziduanheng .ziduanTo').each(function(){
		  var thisziduan=$(this);
		  var nowval=thisziduan.val();
		  thisziduan.find('option').show();
		  $.each(arrData2, function(index,value){
			  thisziduan.find('option[value="'+value+'"]').hide();
          });
	})
	
	//-----------------------------------------------更新cols3字段
	NowToHtmlID.find('.GuanXiTable#'+id).find('li.cols3 .ziduanTo').each(function(){
		  var thisziduan=$(this);
		  var nowval=thisziduan.val();
		  thisziduan.find('option').show();
		  $.each(arrData2, function(index,value){
			  thisziduan.find('option[value="'+value+'"]').hide();
          });
	})
};
//[ok]=========================================================================================【关系删除】
function GuanXi_Del(ths,ToHtmlID) {
	
	var NowToHtmlID=DIVHtmlID(ToHtmlID,'fanall');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
	var databiaoENname=$(ths).val();
	var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;
	var re_id_02 = $(ths).find('option[value="'+databiaoENname+'"]').attr('title');     //得到 sys_jlmb id
	var sys_guanxibiao_id=NowToHtmlID.attr('sys_guanxibiao_id');                        //得到关系表里的id
	var GuanXi_id=NowToHtmlID.attr('GuanXi_id');                                        //得到对应关系re_id
	//alert(NowToHtmlID);
	
	var id=$(ths).parents('.GuanXiTable').attr('id');
	//alert(id);
	//----------------------------获得标签
	$.post('moban_set.php', {
		act: 'GuanXi_Del',
		re_id:re_id,
		re_id_02:re_id_02,
		ToHtmlID:ToHtmlID,
		sys_guanxibiao_id: sys_guanxibiao_id,
        GuanXi_id: GuanXi_id,
		id:id,
		databiaoENname:databiaoENname
	}, function (data) {
		alert(data);
		
	});
	
};

//[ok]=========================================================================================【关系表删除】
function GuanXi_ZiDuanChange_Del(ths,ToHtmlID) {
	//var NowToHtmlID = '#' + ToHtmlID;
	//alert(NowToHtmlID);

	var re_id = $('#' + ToHtmlID).find("#sys_const_re_id").val() * 1;
	//alert(re_id);
	
	var id=$(ths).parents('.GuanXiTable').attr('id');
	var re_id02=$(ths).parents('.GuanXiTable').find('select[name="tableanname"] option:selected').attr('title');
	//alert(re_id02);
	//return false;
	var DELtablename='sys_guanxibiao';
	
	if (id == "" || !id) {
		$(ths).parents('.GuanXiTable').remove();
		return false;
	}else{
		
		if(confirm("是否删除？")==false){return false;};
		//alert(sys_js_arrychestr);
		console.log([re_id,ToHtmlID,id])
		//----------------------------获得标签
	    $.post('moban_set.php', {
		    act: 'GuanXi_Del',
		    re_id:re_id,
		    ToHtmlID:ToHtmlID,
		    id:id,
		   
	    }, function (data) {
		    console.log(data);
			if(data==1){
				console.log(444)
		        $.post('B_moban_del.php', {
		            id: id,
		            act: "Del_To_Huis",
		            DELtablename:DELtablename,
			        ToHtmlID:ToHtmlID,
		            re_id: re_id
		        }, function (data) {
			        console.log(data);
			       $(ths).parents('.GuanXiTable').remove();
					//alert(re_id02);
			       UpdatePhp_Pc(re_id02);   //这里更新php生成文件
		        });
			}
			
	    });/**/
      
	}
	
	
	//alert(tableneme+','+search_zd+','+search_value+','+tochang_zd+','+tochang_value);
};

//[ok]=========================================================================================【更新记录】
function edit_biao_col(tableneme, search_zd, search_value, tochang_zd, tochang_value) {
	$.post('moban_set_data.php', {
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


function Edit_Note_xu(ToHtmlID) //Note序号ID。
{
	if ($('#addbox #Edit_NoteMenu ul.gongzhuo').length * 1 >= 0) { //当有记录时
		$("#addbox #Edit_NoteMenu ul.gongzhuo").each(function (i) {
			var ii = 0;
			if (i < 9) {
				ii = "0" + (i * 1 + 1)
			} else {
				ii = i * 1 + 1
			}; //编号
			$(this).find("input").attr({
				"TABINDEX": (i * 1 + 1)
			});
			$(this).find("li.span2").text(ii);
		});
	}
}
//======================================================================================================编辑我的工作
function Edit_Menu_Text(ths) {
	var Tsid=$(ths).attr("Tsid");
	$(ths).parent().parent().next().html("<ul id='menu'"+Tsid+" class='Edit_Menu_class' onDblclick='Back_Menu_Text(this)' style='width:auto;height:100px;padding:3px;display:none'><br>&nbsp;&nbsp;loading...<br><br></ul>");
	$(".Edit_Menu_class").show("slow");
	$(ths).parents('#Mywork_ceng1').hide("slow");
	$(ths).parents('#Mywork_ceng1').next().show("slow");
	//alert(postasp+","+act+","+thisvalue+","+fieldsTable+","+newfieldsnameZD+","+thisTsid);
	$.post('Note_moban_set.php', {
				act: "Edit_Menu_Text",
				//fieldsname: thistitle,
				//newfieldsname: thisvalue,
				//fieldsTable: fieldsTable,
				//newfieldsnameZD: newfieldsnameZD,
				Tsid: Tsid
			}, function (data) {
		       $('#Mywork_ceng2').removeClass("tables").removeClass("tablenoline-l-r").html(data);
				//alert(data);//测试用
	}); //提交参数
}
//======================================================================================================我的工作 历史记录
function Old_Menu_Text(ths) {
	var Tsid=$(ths).attr("Tsid");
	$(ths).parent().parent().next().html("<ul id='menu'"+Tsid+" class='Edit_Menu_class' onDblclick='Back_Menu_Text(this)' style='width:auto;height:100px;padding:3px;display:none'><br>&nbsp;&nbsp;loading...<br><br></ul>");
	$(".Edit_Menu_class").show("slow");
	$(ths).parents('#Mywork_ceng1').hide("slow");
	$(ths).parents('#Mywork_ceng1').next().show("slow");
	//alert(postasp+","+act+","+thisvalue+","+fieldsTable+","+newfieldsnameZD+","+thisTsid);
	$.post('Note_moban_set.php', {
				act: "oldlist_Text",
				//fieldsname: thistitle,
				//newfieldsname: thisvalue,
				//fieldsTable: fieldsTable,
				//newfieldsnameZD: newfieldsnameZD,
				Tsid: Tsid
			}, function (data) {
		       $('#Mywork_ceng2').addClass("tables").addClass("tablenoline-l-r").html(data);
				//alert(data);//测试用
	}); //提交参数
}
//======================================================================================================编辑我的工作
function Back_Menu_Text(ths) {
	//alert('0');
	$('#Mywork_ceng1').show("slow");
	$('#Mywork_ceng2').hide("slow");
}

function ADsNoteMenu(act, ths, postasp, fieldsTable, newfieldsnameZD) //Note修改。
{
	//if ($("#addbox #uss").size() > 0) {
		//$("#addbox #uss").remove()
	//}; //当有删除工具栏时添加
	//alert("00");
	var All_XT_ZiDuan = $('#addbox #Edit_NoteMenu').attr('tit').toLowerCase(); //得到所有系统字符串
	var thisTsid = $(ths).attr("Tsid"); //得到ID
	var thisvalue = $(ths).val();
	var thistitle = $(ths).attr("tit");
	thisvalue_qk = thisvalue.replace(/[ ]/g, ""); //去空格
	thistitle_qk = thistitle.replace(/[ ]/g, ""); //去空格
	//alert(thisvalue_qk);
	var inputid = 0; //验重
	$("#addbox #Edit_NoteMenu input[name=" + ths.name + "]").not($(ths)).each(function () {
		if (($(this).val() == thisvalue || $(this).val() == thisvalue_qk || $(this).val() == thisvalue_qk.toLowerCase() || $(this).val() == thisvalue.toLowerCase()) && $(this).val() != "") {
		  if($(ths).attr("name")=='notes'){
			inputid = 1;
			return false;
		  };
		}
	});
	//alert(inputid+"_"+thisvalue+"_"+thistitle+"_"+thisvalue_qk+"_"+thistitle_qk+"_"+ths.name);		//$('input[name='+ths.name+'][tit='+thisvalue_qk+']','input[name='+ths.name+'][tit='+thisvalue+']','input[name='+ths.name+'][tit='+thisvalue.toLowerCase()+']').not($(ths),'').size()
	if (inputid > 0) {
		alert("已有该记事了！");
		ths.value = $(ths).attr("tit");
		setTimeout(function () {
			$(ths).focus();
		}, 1000); //验证当前列不能重名。
	} else if (thisvalue == '') {
		alert("不能为空，请重输！");
		ths.value = $(ths).attr("tit");
		setTimeout(function () {
			$(ths).focus();
		}, 1000);
	} else if (All_XT_ZiDuan.indexOf(',' + thisvalue_qk + ',') >= 0) { //禁止添加系统字段名
		alert("对不起，系统禁止添加该名称！");
		ths.value = $(ths).attr("tit");
		setTimeout(function () {
			$(ths).focus();
		}, 1000);
	} else {
		//alert(bigid);alert(bigZD);
		//alert(postasp+","+act+","+thisvalue+","+fieldsTable+","+newfieldsnameZD+","+thisTsid);
		//$.get("moban_set.php",{re_id:re_id,act:"jbsd"},function(data){$('#addbox .htmlleirong').html(data);});   
		//var thisfirstspansize=$('#Edit_NoteMenu #tablebeizhu_None').length*1;//是否没有数据
		//alert(thisfirstspansize);

		if (thistitle == '' || thistitle == null || thistitle == 'undefined') {
			$(ths).val(''); //alert('提交成功');
			if ($('#addbox #Edit_NoteMenu #tablebeizhu_None').length * 1 > 0) { //当没有记录时
				$('#addbox #Edit_NoteMenu ul:first').find("input").attr({
					"value": thisvalue_qk,
					"tit": thisvalue_qk,
					"disabled": false,
					"id": "",
					"TABINDEX": 0
				});
				$('#addbox #Edit_NoteMenu ul:first').find(".span2").text('01');
			} else {
				//var nowhtml=""
				var nowclone = $('#addbox #Edit_NoteMenu ul.gongzhuo').eq(0).clone();
				$('#addbox #Edit_NoteMenu').append(nowclone);
				var thisID = $('#addbox #Edit_NoteMenu ul.gongzhuo').size() * 1;
				if (thisID < 10) {
					thisID = "0" + thisID
				};
				$('#addbox #Edit_NoteMenu ul:last').find("input").attr({
					"value": thisvalue_qk,
					"tit": thisvalue_qk,
					"disabled": true,
					"id": "",
					"TABINDEX": $('#Edit_NoteMenu ul').size() * 1
				});
				$('#addbox #Edit_NoteMenu ul:last').find(".span2").text(thisID);
				$('#addbox #Edit_NoteMenu ul:last').find(".thsvalue").text(thisvalue_qk);
				$('#addbox #Edit_NoteMenu ul:last').find(".fenshu").text('+20');
			};
			Edit_Note_xu(ToHtmlID);
			setTimeout(function () {
				$(ths).focus();
			}, 1000);
			//alert(postasp+","+act+","+thisvalue+","+fieldsTable+","+newfieldsnameZD+","+thisTsid);
			$.post(postasp, {
				act: act,
				fieldsname: thistitle,
				newfieldsname: thisvalue,
				fieldsTable: fieldsTable,
				newfieldsnameZD: newfieldsnameZD,
				ToHtmlID:ToHtmlID,
				thisTsid: thisTsid
			}, function (data) {
				//alert(data);
				if (data != "0") {
					$('#addbox #Edit_NoteMenu ul:last').attr({"Tsid": data});
				}; //这里将id值返回来
			}); //提交参数
		};
		

	}
}
function Edit_NoteMenu(act, ths, postasp, fieldsTable, newfieldsnameZD) //Note修改。
{

	var All_XT_ZiDuan = $('#addbox #Edit_NoteMenu').attr('tit').toLowerCase(); //得到所有系统字符串
	var thisTsid = $(ths).attr("Tsid"); //得到ID
	var thisvalue = $(ths).val();
	//alert(thisvalue);
	var thistitle = $(ths).attr("tit");
	thisvalue_qk = thisvalue.replace(/[ ]/g, ""); //去空格
	thistitle_qk = thistitle.replace(/[ ]/g, ""); //去空格
	var inputid = 0; //验重
	$("#addbox #Edit_NoteMenu li.thsvalue").not($(ths)).each(function () {
		$nowvaleths=$(this).val();
		if (($nowvaleths == thisvalue || $nowvaleths == thisvalue_qk || $nowvaleths == thisvalue_qk.toLowerCase() || $nowvaleths == thisvalue.toLowerCase()) && $nowvaleths != "") {
		  if($(ths).attr("name")=='notes'){
			inputid = 1;
			return false;
		  };
		}
	});
	//alert(inputid+"_"+thisvalue+"_"+thistitle+"_"+thisvalue_qk+"_"+thistitle_qk+"_"+ths.name);		//$('input[name='+ths.name+'][tit='+thisvalue_qk+']','input[name='+ths.name+'][tit='+thisvalue+']','input[name='+ths.name+'][tit='+thisvalue.toLowerCase()+']').not($(ths),'').size()
	if (inputid > 0) {
		alert("已有该记事了！");
		$(ths).val($(ths).attr("tit"));
		setTimeout(function () {
			$(ths).focus();
		}, 1000); //验证当前列不能重名。
	} else if (thisvalue == '') {
		alert("不能为空，请重输！");
		$(ths).val($(ths).attr("tit"));
		setTimeout(function () {
			$(ths).focus();
		}, 1000);
	} else if (All_XT_ZiDuan.indexOf(',' + thisvalue_qk + ',') >= 0) { //禁止添加系统字段名
		alert("对不起，系统禁止添加该名称！");
		$(ths).val($(ths).attr("tit"));
		setTimeout(function () {
			$(ths).focus();
		}, 1000);
	} else {
			
			$(ths).attr("tit", ths.value);
			//alert(postasp+","+act+","+thisvalue+","+fieldsTable+","+newfieldsnameZD+","+thisTsid);
			$.post(postasp, {
				act: act,
				fieldsname: thistitle,
				newfieldsname: thisvalue,
				fieldsTable: fieldsTable,
				newfieldsnameZD: newfieldsnameZD,
				ToHtmlID:ToHtmlID,
				thisTsid: thisTsid
			}, function (data) {
				//alert(data);//测试用
			}); //提交参数
			if($(ths).attr("name")=='notes'){
				$("#addbox #Edit_NoteMenu ul.gongzhuo[Tsid='"+thisTsid+"']").find(".thsvalue").text(thisvalue);
			};
			if($(ths).attr("name")=='jifen'){
				$("#addbox #Edit_NoteMenu ul.gongzhuo[Tsid='"+thisTsid+"']").find(".fenshu").text("+"+thisvalue);
			};
			
		//};
	}
}

//=========================================================================================//Note记事本大类菜出现
function MenurightEditNote(ths, posthtm, act, fieldsTable, newfieldsnameZD, alerttext) {
	if ($("#uss").size() > 0) {
		$("#uss").remove()
	}; //当有删除工具栏时添加
	$(ths).find('input').after('<span id="uss" class="uss" onClick=MenurightDelNote(this,"' + posthtm + '","' + act + '","' + fieldsTable + '","' + newfieldsnameZD + '","' + alerttext + '")><i class="fa fa-del"></i></span>');
	//correctPNG();
	$("#uss").css({
		"top": 3,
		"right": 0,
		"padding-right": "10px",
		"display": "block"
	});
	$("#uss2").remove(); //有时删除
}
//=========================================================================================//Note记事本大类菜删除
function MenurightDelNote(ths, posthtm, act, fieldsTable, newfieldsnameZD, alerttext,ToHtmlID) {
	if (!ToHtmlID || ToHtmlID==''){
		ToHtmlID='#addbox';
	}
	var Tsid = $(ths).parents('.level1').find('input').attr("Tsid"); //得到id值
	//var fieldsname=$(ths).parents('.level1').find('input').val();
	if (Tsid != '') {
		//if(alerttext==""|| alerttext=='undefined' || alerttext==null){alerttext='确认删除该类别到回收站？'}
		//if(confirm(alerttext)){
		//alert("http://localhost/MachineV1.0/"+posthtm+"?act="+act+"&Tsid="+Tsid+"&fieldsTable="+fieldsTable);
		$.post(posthtm, {
			act: act,
			Tsid: Tsid,
			ToHtmlID:ToHtmlID,
			fieldsTable: fieldsTable
		});
		$(ths).parents('li.level1').animate({
			height: '0px',
			opacity: '0.4'
		}, "slow", function () {
			$(this).remove();
			Edit_Note_xu(ToHtmlID);
		});
		//这里进行序号生排
		//}
	} else {
		$(ths).parents('li.level1').animate({
			height: '0px',
			opacity: '0.4'
		}, "slow", function () {
			$(this).remove();
			Edit_Note_xu(ToHtmlID);
		})
	};
	
}


function firstword(ths) //首字不能为小数或符号并且整个不能输入逗号
{
	var thisvalue = $(ths).val();
	var reg = /[,]/g; //这里将要禁止输入的特殊符号列入
	thisvalue = thisvalue.replace(reg, ''); //不允许输入特殊符号
	var thisvalue_new = thisvalue.match(/([\u0391-\uFFE5A-Za-z]{1,}.*)/g); //去掉数字开头部份
	$(ths).val(thisvalue_new); //给当前文本框赋值
}

function menutoclone(syscloneid, todivid,ToHtmlID) { //addbox下面菜单拷贝
	var NowToHtmlID=DIVHtmlID(ToHtmlID,'fanall');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
	//alert(syscloneid);
	NowToHtmlID.find(todivid).html(""); //清空题头
	var sysclone = NowToHtmlID.find(syscloneid).clone();
	NowToHtmlID.find(todivid).show().html(sysclone);
}

function Edit_shuju_one(ths, ToHtmlID) //使用原数据表
{
	var NowToHtmlID=DIVHtmlID(ToHtmlID,'fanall');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
	var re_id = NowToHtmlID.find("#sys_const_re_id").val(); //
	var sys_guanxibiao_id=NowToHtmlID.attr('sys_guanxibiao_id');                     //得到关系表里的id
	var GuanXi_id=NowToHtmlID.attr('GuanXi_id');                 //得到对应关系re_id
	mdb_name = $(ths).attr("Y_db");
	//alert(mdb_name);
	$.post("moban_set_data.php", {
		act: "JL_updata_one",
		mdb_name: mdb_name,
		ToHtmlID:ToHtmlID,
		re_id: re_id
	},function(data){
		UpdatePhp_Pc(re_id,'B_moban_list');   //这里更新所有php生成文件并刷新 表头，loading 数据页
	}); //提交参数   
}

function PicGet(ths, ToHtmlID) //加载图片库
{
	var NowToHtmlID=DIVHtmlID(ToHtmlID,'fanall');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
	if (NowToHtmlID.find("#mobanaddbox2").length <= 0) {
		NowToHtmlID.find("#mobanaddbox").after("<div id='mobanaddbox2' class='NowULTable' style='margin-top:0px;text-align:left;float:left;width:38%;border:1px #CCC dotted;'>loading...</div>")
		NowToHtmlID.find("#mobanaddbox2").height(NowToHtmlID.find("#mobanaddbox").height()); //设置高度
		//DeskMenu('#mobanaddbox2',ToHtmlID);
		AjaxLoad('moban_set.php', 'picget', '#mobanaddbox2', '', 'get', ToHtmlID);
	}
}

//以下为得到日期随机码js
var sys_js_indexsjm = "";

function sjm() //更新表描述tjid!=1时提交
{
	var mydate = new Date().getTime();
	return parseInt(mydate);
}

function delul(ths, ToHtmlID) //删除该行divid,thsindex第几行,tda该行第几个input
{
	var NowToHtmlID=DIVHtmlID(ToHtmlID,'fanall');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
	var thsSYS = $(ths).parent().hasClass("SYS"); //就否为系统字段
	//var ulindex=$('#bbsTabntq ul').size();
	var re_id = NowToHtmlID.find("#sys_const_re_id").val();
	//var thisvale=$(ths).parent().find("input").val();
	var fieldsname = $(ths).parent().find("input").attr("Y_ziduan"); //得到字段名称
	//alert(fieldsname+","+re_id);
	if (!fieldsname) {
		$(ths).parent().remove();
	} else {
		if (thsSYS) {
			alert('系统的字段，禁止删除！');
		} else {
			if (confirm('确认删除?将无法恢复！')) {
				$.post("moban_set_data.php", {
					act: "ziduan_del",
					fieldsname: fieldsname,
					ToHtmlID:ToHtmlID,
					re_id: re_id
				}, function (data) {
					//alert(data);//
					$(ths).parent().remove();
					UpdatePhp_Pc(re_id,'B_moban_list');   //这里更新所有php生成文件并刷新 表头，loading 数据页
				});
			};
		};

	};


	//if (thsindex==ulindex-1){alert("该条不能删除！");}else{
	//if(confirm('确认删除?将无法恢复！')){
	//var fieldsname=$('#'+divid+' ul').eq(thsindex).find('input').eq(0).val();
	//
	//$('#'+divid+' ul').eq(thsindex).remove();
	// hh_tr('#addbox #bbsTabntq ul');
	//}}
}

function addquxianul(ths) //添加该行
{ //alert("00");
	if ($(ths).parent().prev().find("input").val()) { //当前一个不为空时执行
		nowcopyul = $(ths).parent().prev().clone();
		$(ths).parent().before(nowcopyul);
		var prevul = $(ths).parent().prev(); //复制的行
		prevul.find("input[type='text']").eq(0).attr({
			id: '',
			value: '',
			tit: '',
			Y_ziduan: '',
			disabled: false
		});
		prevul.find("input[type='text']").attr({
			value: '',
			tit: '',
			Y_ziduan: '',
			disabled: false
		});
		prevul.find("input[name='zd_xianshi_width']").attr({
			value: '50',
			disabled: true
		}); //初始化默认值
		prevul.find("input[name='qx_bitian']").attr({
			checked: false
		}); //初始化默认值
		prevul.find("input[name='qx_wuchongfu']").attr({
			checked: false
		}); //初始化默认值
		prevul.find("input[name='zd_xianshi_input_id']").attr({
			value: '0'
		}); //初始化
		prevul.find("input[name='zd_Default']").attr({
			value: ''
		}); //初始化默认值
		prevul.find(".del").html("<i class='fa fa-del'></i>").on("click", function () {

		}); //出现删除按钮

		//$(ths).parent().prev().show("slow");
	}
}


function Pinyin_ziduan(ths, ToHtmlID) { //字段拼音
	//alert(ths.type);
	//replacefh(ths);//这里执行首字数字检查
	var NowToHtmlID=DIVHtmlID(ToHtmlID,'fanall');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
	var All_XT_ZiDuan = $('#bbsTabntq').attr('tit').toLowerCase(); //得到所有系统字符串
	//ths.value = ths.value.replace(/[^\u4E00-\u9FA5a-zA-Z]/g, ''); //去除数字
	var thisvalue = $(ths).val();
    var Tablename =$('#bbsTabntq').attr('tablename');//修改的表名
	var thisvaluelow = thisvalue.toLowerCase();
	thispinyin = 'ZD_'+ToPinYing(thisvalue);
	//alert(thispinyin);
	thispinyinlow = thispinyin.toLowerCase();
	var fieldsnamey = $(ths).attr("Y_ziduan"); //原字段名接收
	fieldsnamey = fieldsnamey.toLowerCase();
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
		
		//$(ths).parent().parent().find("input:checkbox")//启用右边值。
		//alert(chestrinput_title+","+chestrinput_ziduan);
		var re_id = NowToHtmlID.find("#sys_const_re_id").val();
		
		//alert("fieldsname:"+fieldsnamey+";newfieldsname:"+newziduanval+";thisvalue:"+thisvalue+";re_id:"+re_id);
		$.post("moban_set_data.php", {
			act: "ziduan_edit",
			fieldsname: fieldsnamey,
			newfieldsname: newziduanval,
			thisvalue: thisvalue,
			thistitle: thisvalue,
			ToHtmlID:ToHtmlID,
			re_id: re_id
		}, function (data) {
			console.log(data);
            //alert(newziduanval);
            $(ths).parent().parent().find(".bianliang").text(newziduanval);
            $(ths).attr({
				"tit": thisvalue,
				"Y_ziduan": newziduanval,
		    });
            
			NowToHtmlID.find("div.tables ul.thead li[name='" + fieldsnamey + "']").attr("name", newziduanval).text(thisvalue); //这里提交成功后更新表头
			if (fieldsnamey+'1'=='1'){//新创建时，应返回数据y_ziduan英文名  tit中文名
				$(ths).parent().parent().find("input").attr({
			          "tit": thisvalue,
			          "Y_ziduan": newziduanval,
		        }).removeAttr("disabled");
				$(ths).parent().parent().find("select").attr({
			          "tit": thisvalue,
			          "Y_ziduan": newziduanval
		        }).removeAttr("disabled");
				
				$(ths).parent().parent().find("li").eq(0).attr({
			          "title": newziduanval
		        });
				
		        $(ths).parent().parent().find("li:last-child").html("<i class='fa fa-del-mini'></i>").removeAttr("onclick").attr("onclick","delul(this,'"+ToHtmlID+"')");
				$(ths).parent().parent().find("input[type='checkbox']").removeAttr("onclick").attr("onclick","ziduan_beizhu_edit(this,'"+Tablename+"','"+newziduanval+"','"+ToHtmlID+"')");
				$(ths).parent().parent().find("select[name='XStype']").removeAttr("onchange").attr("onchange","ziduan_beizhu_edit(this,'"+Tablename+"','"+newziduanval+"','"+ToHtmlID+"')");
				$(ths).parent().parent().find("input").not('[name="zd_cn_name"]').removeAttr("onchange").attr("onchange","ziduan_beizhu_edit(this,'"+Tablename+"','"+newziduanval+"','"+ToHtmlID+"')");
				
				$(ths).parent().parent().find("select[name='XStype'] option").removeAttr('selected');
				$(ths).parent().parent().find("select option[value='1']").attr('selected','selected');
			}else{
				UpdatePhp_Pc(re_id,'B_moban_list');   //这里更新所有php生成文件并刷新 表头，loading 数据页
			}
			//List_Head_Get(ToHtmlID);//加载表头
            
		}); //提交参数	//alert(fieldsnamey);alert(newziduanval);alert(thisvalue);

	}; /**/
}

function add_loading(ths, titles) //检查记录模版是否有初始表
{
	$('#add_loading').remove(); //清除页面提示
	$("<div id='add_loading'><div id='add_loading_html'>" + titles + "</div></div>").insertBefore(ths); //在前面提示显示框
	//$(ths).append("<div id='add_loading'><div id='add_loading_html'>"+titles+"</div></div>")
	//alert($(ths).attr("name"));
}


function inputfocusfirst(tableid, inpuname) //定位到最前面一个文本框
{
	$(tableid + ' [name="' + inpuname + '"]').focusEnd();
}
//=============================================================================//字段修改
function edit_zd(ths, checkval, nocheckval, beizhucolid, updatecolname, ToHtmlID) {
	var NowToHtmlID=DIVHtmlID(ToHtmlID,'fanall');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
	var re_id = NowToHtmlID.find("#sys_const_re_id").val();
	var zd = $(ths).parent().parent().find('input').first().val(); //得到当前修改字段updatecolname为更新Sys_Jlmb列名
	if ($(ths).val() == checkval) {
		$(ths).val(nocheckval);
	} else {
		$(ths).val(checkval);
	}; //切换选中与否值
	var thisvalue = $(ths).val(); //得到当前的值
	$.post("moban_set_data.php", {
		act: "quanxian",
		zd: zd,
		thisvalue: thisvalue,
		beizhucolid: beizhucolid,
		updatecolname: updatecolname,
		ToHtmlID:ToHtmlID,
		re_id: re_id
	},function(data){
		UpdatePhp_Pc(re_id,'B_moban_list');   //这里更新所有php生成文件并刷新 表头，loading 数据页
	});

}


//=============================================================================//字段类型修改
function edit_zd_leixin(act, ths, ToHtmlID) {
	var NowToHtmlID=DIVHtmlID(ToHtmlID,'fanall');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
	var re_id = NowToHtmlID.find("#sys_const_re_id").val();
	var zd = $(ths).parent().parent().find('input[name="ziduan"]').val(); //得到当前修改字段updatecolname为更新Sys_Jlmb列名
	var zd_leixin = $(ths).parent().parent().find('input[name="leixin"]').val(); //得到当前修改字段
	var zd_moren = $(ths).parent().parent().find('input[name="moren"]').val(); //得到默认值
	var zd_XS_leixin = $(ths).parent().parent().find('input[name="XS_leixin"]').val(); //显示样式
	//if ($(ths).val()==checkval) {$(ths).val(nocheckval);} else {$(ths).val(checkval);};//切换选中与否值
	var thisvalue = $(ths).val(); //得到当前的值
	//alert(zd_XS_leixin);	
	$.post("moban_set_data.php", {
		act: act,
		zd: zd,
		thisvalue: thisvalue,
		beizhucolid: beizhucolid,
		updatecolname: updatecolname,
		ToHtmlID:ToHtmlID,
		re_id: re_id
	},function(data){
		UpdatePhp_Pc(re_id,'B_moban_list');   //这里更新所有php生成文件并刷新 表头，loading 数据页
	});
	//,function(){List_Head_Get(ToHtmlID);ListGet(ToHtmlID);}
}



//===============================================================================以下为以下一级菜单
var menuchangeinput_eq = null;

function showDIVType(ths, wid) {

	CloseDIVType('#divFieldType');
	menuchangeinput_eq = $(ths).parent().parent().index(); //得到当前列全局行位置。,'display':''
	$thisdivfield = $('#divFieldType');
	if (!$thisdivfield) return;
	$thisdivhight = $('#bbsTabntq').height() * 1 + 20;
	$thisdivfield.css({
		'top': 32,
		'left': $(ths).parent().position().left + $(ths).width() + 1,
		'width': wid,
		'z-index': 2,
		'height': $thisdivhight
	}).show();
	//$thisdivfield.animate({},'slow');
	//alert(menuchangeinput_eq);
	var thisleixin = $(ths).attr("leixin");
	var XS_leixin_id = $(ths).attr("XS_leixin_id"); //得到类型的ID值
	$thisdivfield.find('#SSYSS_zdlx').val(thisleixin);
	$thisdivfield.find('#SSYSS_xsys_id').val(XS_leixin_id);
	$thisdivfield.find('#SSYSS_zdname').val($(ths).parent().parent().find("input[name='zd_name']").attr('Y_ziduan'));
	$thisdivfield.find('#SSYSS_xsys').val(ths.value);
	$thisdivfield.find('#SSYSS_mrz,#Y_SSYSS_mrz').val($(ths).parent().parent().find("input[name='moren']").val());
	$thisdivfield.find('#SSYSS_cd').val($(ths).attr("changdu"));
	$thisdivfield.find('#SSYSS_xs').val($(ths).attr("xiaoshu"));
	if (thisleixin.indexOf("$sys_kd_s$") > 0) {
		$('#S_cd_kg').show()
	} else {
		$('#S_cd_kg').hide()
	};
	if (thisleixin.indexOf("$sys_xs_s$") > 0) {
		$('#S_xs_kg').show()
	} else {
		$('#S_xs_kg').hide()
	};
	//if ($(ths).attr("xiaoshu_kg")==1){$('#S_xs_kg').show()}else{$('#S_xs_kg').hide()};
	//$thisdivfield.focus();
	$('#editsuccess').text(''); //初始化成功状态提示
	//以下为找寻对应按钮
	var XS_leixin_id_li = $('#selFieldType #selFieldType_' + XS_leixin_id);
	var XS_leixin_id_zu = XS_leixin_id_li.attr('name'); //得到样式分类
	//alert(XS_leixin_id_zu);
	//$("#selField_zu ul li[tit='"+XS_leixin_id_zu+"'+"]").remove();
	$("#selField_zu ul li[tit='" + XS_leixin_id_zu + "']").click(); //选中类别
	$('#selFieldType ul li').removeClass('shadowhover');
	XS_leixin_id_li.addClass('shadowhover');
}
//===============================================================================以下为二级菜单
function checkd_toDIVType(ths, divFieldType) {
	if (!$("#" + divFieldType)) return;
	$(ths).siblings().removeClass("current"); /*所有同辈元素删除样式*/
	$(ths).addClass("current"); /*当前元素设置为选中样式*/
	$("#" + divFieldType + " ul li").hide();
	var thistext = $(ths).text();
	$("#" + divFieldType + " ul li[name='" + thistext + "']").show();
	//$("#"+divFieldType).focus();
}
//===============================================================================以下为以下为元素替换
function CloseDIVType(div1) { //CloseDIVType('#divFieldType,#selFieldType')
	$(div1).hide();
	//$(div1).animate({height:0,'z-index':0},{'speed':'slow','callback':$(div1).hide()});
	$(div1 + " div").removeClass("active_cat"); /*所有同辈元素*/
}
//===============================================================================以下将系统字段排序到后面
/*
function copypx(ulid){
	//var nowallcop=$("#bbsTabntq").clone();//拷贝整个
	//nowallcop2=$(nowallcop).find("p").remove();
	
	var nowcopy=$(ulid).clone();
	$(ulid).remove();
	$('#copyxitong').append(nowcopy);
	
   //alert(ulid);
}*/
function checkFieldType(ths, divths, sid, sdateleixin, sxsname, schangdu, sXiaoshu, smoren) {
	if (sXiaoshu == "") {
		sXiaoshu = 0
	};
	$thisdivfield = $('#divFieldType');
	//if(confirm('确认修改?将无法恢复！')){
	//$thisdivfield.find('#SSYSS_zdlx').val(sdateleixin);
	//$thisdivfield.find('#SSYSS_xsys_id').val(sid);
	//$thisdivfield.find('#SSYSS_xsys').val(sxsname);
	//$thisdivfield.find('#SSYSS_mrz').val(smoren);
	//$thisdivfield.find('#SSYSS_cd').val(schangdu);
	//$thisdivfield.find('#SSYSS_xs').val(sXiaoshu);

	//if(sdateleixin.indexOf("$sys_kd_s$") > 0 ){$('#S_cd_kg').show()}else{$('#S_cd_kg').hide()};
	//if(sdateleixin.indexOf("$sys_xs_s$") > 0 ){$('#S_xs_kg').show()}else{$('#S_xs_kg').hide()};
	//$(ths).siblings().removeClass("shadowhover");/*所有同辈元素删除样式*/
	//$(ths).addClass("shadowhover");/*当前元素设置为选中样式*/
	//if (sXiaoshu_kg==1){$('#S_xs_kg').show()}else{$('#S_xs_kg').hide()};
	//CloseDIVType('#selFieldType');//选定后关闭两框
	//};
	//$("#toxiaoguo").html($(ths).find("div").eq(0).html()).width("90%");//效果
	//$("#toxiaoguo").find("input").attr({"name":"$sys_name$"});
	//$(ths).find("div").eq(0).find("input").change(function(){  $("#SSYSS_mrz").val($(this).val());});
	//$("#toxiaoguo");
}

function EnterPress(e, ths, callback) { //
	e = e ? e : window.event; //var e = e || window.event; 
	var keyCode = e.which ? e.which : e.keyCode; //获取按键值
	if (e.keyCode == 13) {
		callback
	} else if (e.keyCode == 38) {
		$(ths).parents("ul").prev().find("*").focus()
	};
}


//=================================================================缓存数据修改更新
function edit_cache(strmk_id,re_id) { //(formid)
	$.post('B_moban_edit.php', {'act':'list','strmk_id':strmk_id,'re_id':re_id});
}


//=================================================================清空元素中表单数据
function Input_clear_all(formclass) { //Input_clear_all("#addbox li.reset_list")//清空表单为空
	$(formclass).find(':input[type="text"]', ':textarea').val(''); //以下为清空所有表单
	$(formclass).find(':checkbox').attr("checked", false);
}

//=================================================================form数据加载
function josndata(formid,datas) {
	if(formid+'1'=='1'){
	   formid="#addbox";
	   }
	//var formid="#addbox";
	josndata_two(formid,zd_en_name,sys_value);
}
//=================================================================form数据加载

function josndata_two(formid,zd_en_name,sys_value) {
	var nowselect=$(formid+" [name='" + zd_en_name + "']"); //当前控件
	var nowtype = nowselect.attr("type");                     //当前控制的样式
	if (nowtype == 'radio') {            //===radio
		$(formid+" input:radio[name='" + zd_en_name + "'][value='"+sys_value+"']").attr('checked','true');//选中
	}else if (nowtype == 'checkbox') { //===checkbox
		var sys_value_arry = sys_value.split(',');
		if(sys_value != '' || sys_value != '0' ){
			 $.each(sys_value_arry,function(name,value) {
                //alert(name);
                //alert(value);
				 $(formid+" input:checkbox[name='" + zd_en_name + "'][value='"+value+"']").attr('checked','true');//选中
             });
		};
	}else if (nowtype == 'textarea') {     //===textarea
		var reg=/<br>/g;
        var str=sys_value.replace(reg,'\n');
		//var str=sys_value.replace('<br>','\n');//替换<br>为\n
		nowselect.val(str); //当前控件值
		
	}else if (nowtype == 'select') {     //===select
		nowselect.val(sys_value);
	} else { //===text/textarea
		nowselect.val(sys_value); //当前控件值	
	};
}






//=================================================================字段排序
function ZiDuanPaiXuJS(formid, ToHtmlID) {
	var NowToHtmlID=DIVHtmlID(ToHtmlID,'fanall');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
	var re_id = NowToHtmlID.find("#sys_const_re_id").val() * 1;

	var chestr = [];
	NowToHtmlID.find(formid + " ul").each(function () {
		chestr.push($(this).find('input').eq(0).attr('Y_ziduan'));
	});
	ZDList = chestr.join(',');
	//strmk="act="+act+"&strmk_id="+strmk_id+"&re_id="+re_id+nowdatapos;
	//alert(ZDList);
	$.post('moban_set_data.php', {
		act: 'ZiDuanPaiXu',
		ToHtmlID:ToHtmlID,
		re_id: re_id,
		ZDList: ZDList
	}, function (data) {
		//alert(data);
		UpdatePhp_Pc(re_id);   //这里更新php生成文件
	});
	/*
    $.ajax({type:"post",
	async:true,url:"moban_set_data.php",
	data:strmk,
	success:function(data){
	    //alert(data);//调试用
   
		},
	error:function(){alert('修改时出现错误,未保存成功！');$('#addbox #editsuccess').text('');}});
	*/
	//NowToHtmlID.find(formid+" input[type=reset]").trigger("click");//触发reset按钮
}




//function edit_table_tdtitle(tdclass,thisval){$("."+tdclass).title(thisval);}
//-----------------------------------------------------------------form字段类型及参数设定
function ziduan_edit_arrys(formid, ToHtmlID) {
	var NowToHtmlID=DIVHtmlID(ToHtmlID,'fanall');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
	var re_id = NowToHtmlID.find("#sys_const_re_id").val();
	var thisleixin = $('#addbox #SSYSS_zdlx').val();
	if (thisleixin.indexOf("$sys_kd_s$") > 0) {
		var objcd = $('#addbox #divFieldType #SSYSS_cd');
		if (objcd.val() == '' || objcd.val() == 0) {
			alert('长度不能为空或0');
			objcd.focus();
			return false;
		}
	};
	if (thisleixin.indexOf("$sys_xs_s$") > 0) {
		var objxs = $('#addbox #divFieldType #SSYSS_xs');
		if (objxs.val() == '' || objxs.val() == 0) {
			alert('长度不能为空');
			objxs.focus();
			return false;
		}
	};
	//alert(re_id+","+thisleixin+",");
	if (confirm('确认修改?将无法恢复，请慎重！')) {
		NowToHtmlID.find(formid + ' #SYS_submit').attr({
			"disabled": "disabled"
		}); //添加disabled属性 
		strmk = NowToHtmlID.find(formid).serialize();
		strmk = "act=ziduan_lx_edit&re_id=" + re_id + "&" + strmk; //alert(strmk);
		$('#addbox #editsuccess').text('修改成功！'); //alert(strmk_id);
		$.ajax({
			type: "post",
			async: true,
			url: "moban_set_data.php",
			data: strmk,
			success: function (data) {
				var objthis = $("#bbsTabntq input[name='XS_leixin']");
				objthis.eq(menuchangeinput_eq).attr({
					'value': $('#addbox #SSYSS_xsys').val(),
					'XS_leixin_id': $('#addbox #SSYSS_xsys_id').val(),
					'xiaoshu': $('#addbox #SSYSS_xs').val(),
					'changdu': $('#SSYSS_cd').val(),
					'leixin': $('#addbox #SSYSS_zdlx').val()
				});
				$("#bbsTabntq input[name='moren']").eq(menuchangeinput_eq).val($('#addbox #SSYSS_mrz').val());
			},
			error: function () {
				alert('修改失败！');
				$('#addbox #editsuccess').text('');
			}
		});
		NowToHtmlID.find(formid + ' #SYS_submit').removeAttr('disabled');
		//NowToHtmlID.find(formid+" input[type=reset]").trigger("click");//触发reset按钮$('#ceshi').html(data);
		//$('#SSYSS_xsys').focus();
	}
}

//===============================================================================radio选中值
function radiochecek(radioname, checkvalue, ToHtmlID) {
	var NowToHtmlID=DIVHtmlID(ToHtmlID,'fanall');  //fanall、mask_lood、head、banner、banner_left、banner_right、content_ALL、content_foot、content_foot_02
	if(checkvalue){
		NowToHtmlID.find("input[name='" + radioname + "'][value='" + checkvalue + "']").attr("checked", "checked");
	}
}
//以下为选中行中所有的选项框
function selectCheckBoxes(domId, value) {
	var inputs = document.getElementById(domId).getElementsByTagName("input");
	for (var i = 0; i < inputs.length; i++) {
		if (inputs[i].type == 'checkbox') {
			inputs[i].checked = value;
		}
	}
}

var seidfoot_JS_OK = 1; //加载成功


//===============================================================================以下为系统管理员js
/*
function getinputType(thisdiv, inputid) { //取得input样式。
	//alert($(thisdiv).html());
	if ($("#moban_set .ZDmenu_div").index() < 0) {
		$.get("moban_set.php", {
			act: "inputType_list"
		}, function (data) {
			$(thisdiv).append(data);
			$("#moban_set .ZDmenu_div").css("height", "60%");
		})

	}
}
*/
