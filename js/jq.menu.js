/*
function callmenuser(act){//(act）//这里加载用户菜单
  $("#menu_html").html("<h1><span> Loading...</span></h1>");
  $.get('B_menu_desk_user.php',{act:act},function(data){$('#menu_html').html(data);});
}
*/
function postall(ths,connname){
  //if(!connname) posturl='conn';
  alert('已提交，请等待处理完成。');
  $(ths).hide(1000); 
  $.post('B_moban_SYS_data.php',{
	  act:'Conn_sys',
	  connname:connname
  },function(data){
	  alert(data+'数据库校正完成！');
  });
}
function deldir(act){
  //if(!connname) posturl='conn';
  alert('已提交，请等待处理完成。');
  //$(ths).hide(1000); 
  $.post('B_moban_SYS_data.php',{
	  act:'deldir'
  },function(data){
	  alert(data+'删除成功！');
  });
}
function menuoverclickstyle(divname,overstylename,cheeckstyle){//这里为切换 over click 切换效果
	$(divname).on('mouseover',function(){if(!$(this).hasClass(cheeckstyle)){$(this).addClass(overstylename);}})
	.on('mouseout',function() {$(this).removeClass(overstylename);})
	.on('click',function() {$(this).removeClass(overstylename);$(divname).removeClass(cheeckstyle);$(this).addClass(cheeckstyle);});
}
function changeon(ths){//这里为切换 over click 切换效果
	
	thisclass=$(ths).attr('class');
	thisid=$(ths).attr('changeid');
	if($(ths).hasClass('fa-28-3') ){//关
		if(confirm("确定“禁止”登录么？")==false){return false;};
		$(ths).removeClass('fa-28-3').addClass('fa-27-3');
		nowvale=0;
	}else{
		if(confirm("确定“允许”登录么？")==false){return false;};
		$(ths).removeClass('fa-27-3').addClass('fa-28-3');
		nowvale=1;
	}
	
	$.post('moban_set_data.php',{act:'JL_updata_changdata',tablename:'msc_user_reg',id:thisid,ziduan:'sys_web_shenpi',newvale:nowvale},function(data){
		  // alert(data);JL_updata_changdata(this,'JL_updata_changdata','msc_user_reg',$id,this.name)
	});
}
function callmenu(act,menutitle,MenuArry,re_id,ChongfuId,Menu_Name){//(act,表名，字段名，是否开启二级菜单0不开启1开启，标题名，大类允许编辑，callsub）
	if(!re_id) re_id='0';
  $("h1,h2").remove();//这里删除所有h1
  $("#menu_html").before("<div id='ssarry'></div><h2 Xssarry='' huisarry=''>"+menutitle+"</h2>");
  $("#menu_html").html("</br></br><span style='padding-top:30px;padding-left:8px'>Loading...</span>");
  //alert(MenuArry);
  //alert("http://localhost/MachineV1.0/B_menu_set.php?act="+act+"&MenuArry="+MenuArry);
  $.get('B_menu_set.php',{act:act,MenuArry:MenuArry,re_id:re_id,ChongfuId:ChongfuId},function(data){
	  $('#menu_html').html(data);
	  $('#menu_html .DFtables ul.head').eq(0).click();
  });
}
function ZhiZheQuanXian_GET($zwid){//职位
  
  $("#menu_html #ZQright").html("</br></br><span style='padding-top:30px;padding-left:8px'>Loading...</span>");
  //alert(MenuArry);
  //alert("http://localhost/MachineV1.0/B_menu_set.php?act="+act+"&MenuArry="+MenuArry);
  $.get('B_menu_set.php',{act:"ZhiZheQuanXian_GET",zwid:$zwid},function(data){
	  $('#menu_html #ZQright').html(data);
	  $('#ZhiZheQuanXian ul.E_zw').removeClass('headbgloadcheck');
	  $('#ZhiZheQuanXian ul#E_zw_'+$zwid).addClass('headbgloadcheck');
  });
}
function ZhiZheQuanXian_GET_date(ths){//职能数据加载二级菜单数据
    var id=$(ths).attr("qxid"); //alert(id);$(ths).next("ul div.tables2").length <= 0 &&
	var zwid=$(ths).attr("zwid"); //alert(Sys_Menu_id);这里得到新加的loading...
	
	if ($(ths).next("div.tables2").length <= 0){//判定是否已有加载...
	  //$(ths).after("<ul class='twomenu' id="+Sys_Menu_id+"> loading...</ul>");
	  $.get("B_menu_set.php",{act:'ZhiZheQuanXian_GET_date',id:id,zwid:zwid},function(data){
		  $(ths).after(data);
		  //$("#"+Sys_Menu_id).remove();
		  $(ths).addClass('headbgloadcheck');
	  });
	   //alert($("#"+Sys_Menu_id).length);
	};
}
//--------------------------------------------------------------------------------------------------我的公司
function callmenu_gongsi(){//(act,表名）
	//alert('0');
  $("h1,h2").remove();//这里删除所有h1
  $("#menu_html").before("<div id='ssarry'></div><h2 Xssarry='' huisarry=''><i class=\"fa fa-edit-ul\"></i>Set</h2>");
  //$("#menu_html").html("</br></br><span style='padding-top:30px;padding-left:8px'>Loading...</span>");
  $("#menu_html").html("<iframe border='0' style='width:100%;height:98%;border:0' src='../m/Machine_MobileV1.0/M_set.php?act=list'></iframe>");
 
}
  //---------------------------------------------------------------------------切换及生成TOP菜单
function PostAddTopMenu(nowre_id,fieldsname){
  //if (fieldsname!=''||fieldsname!='undefined'){
	// alert(nowre_id+"_"+fieldsname);
	$.post("moban_set_data.php",{act:'TopsMenu',re_id:nowre_id,fieldsname:fieldsname},function(data){
		console.log(data);
		//$.post('B_moban_top.php', {act: "list",re_id: 0});//更新缓存
	});
	//};
  
}
//==================================================================================【更新单个记录】  
function JL_updata_changdata(ths,act,tablename,id,ziduan){
	//alert(act);
	var nowvale=$(ths).val();
    $.post('moban_set_data.php',{act:act,tablename:tablename,id:id,ziduan:ziduan,newvale:nowvale},function(data){
		  // alert(data);
	});
}
//==================================================================================【删除到回收站单个记录】  
function delul_user(ths){
	//alert(act);
	var nowside=$(ths).parents('ul').find('.fa-27-3').length;//只有当为禁止登录时才能删除
	//alert(nowside);
	var nowvale=1;//删除值
	var tablename=$(ths).attr('sys_tablename');
	var id=$(ths).attr('sys_id');
	var ziduan=$(ths).attr('sys_zd');
	if(nowside==1){//当为禁止登录时执行
		if(confirm('确定删除此用户么？')==false){return false;};//当提示点确定时执行，如点取消时取消
		$.post('moban_set_data.php',{act:'JL_updata_changdata',tablename:tablename,id:id,ziduan:ziduan,newvale:nowvale},function(data){
		   //alert(data);
		   $(ths).parents('ul').remove();
	    });
	}else{
		alert('允许登录时,是禁止删除滴！');
	}
    
}
//==================================================================================【管理菜单切换页面】  
function changeright(ths,adid,re_id,CName,ShaiXuanSql,beforere_id){                                 
    // alert(CName);
	// PostAddTopMenu(re_id,CName);                                                     //记录头部菜单
	if($('#Top_DeskMenuDiv'+re_id).length*1>0){                                      //查找是否已加载该框   有时
	     Top_SelectTag('Top_DeskMenuDiv'+re_id);                                     //头部标签选中同步
	     DeskMenu('body','DeskMenuDiv'+re_id,ShaiXuanSql);                           //添加显示层。
		 
	     //return false;
	}else{                                                                           //没有这个标签时添加并提交数据库
	     var nowarr=re_id+"_"+CName;
	     AddTopMenu(nowarr);
	     $('#Top_DeskMenuDiv'+re_id).click();
	    //  PostAddTopMenu(re_id,CName);                                              //打开top菜单|向数据库提交
	}
	// console.log(ShaiXuanSql)
	if(ShaiXuanSql+'1' != '1' && beforere_id>=0){
		//var ToHtmlID='#DeskMenuDiv'+re_id;
		selectbefore('Top_DeskMenuDiv'+beforere_id);                            //头部标签选中为之前状态
		$('#DeskMenuDiv'+re_id+' .fanall #ShaiXuanSql').val(ShaiXuanSql);       //显示对应的内容。
		$('#DeskMenuDiv'+re_id+' .fanall .button_img').click();                 //显示对应的内容。
	}
}

function Mima_XG(ths) //密码修改
{
	//var thispartdiv=$(ths).parent('.ULTable');
	var ymima = $(".ULTable #ymima").val().Trim(); //alert(thisname);
	var Xmima = $(".ULTable #Xmima").val().Trim();
	var Xmima2 = $(".ULTable #Xmima2").val().Trim();
	//alert(ymima+','+Xmima+","+Xmima2);
	if (ymima == "") {
		alert('原密码不能为空！');
		$("#bbsTabntq #ymima").focus();
	} else if (Xmima == "") {
		alert('新密码不能为空');
		$("#bbsTabntq #Xmima").focus();
	} else if (Xmima2 == "") {
		alert('确认密码未输入');
		$("#bbsTabntq #Xmima2").focus();
	} else if (Xmima != Xmima2) {
		alert('两次输入的新密码不一致')
	} else if (ymima == Xmima) {
		alert('新密码和旧密码相同了')
	} else { //alert('提交成功');
		$.post("moban_set_data.php", {
			act: "MimaXG",
			ymima: ymima,
			Xmima: Xmima,
			Xmima2: Xmima2
		}, function (data) {
			$("#post_jg").html(data);
		}); //提交参数  
		$(".ULTable #ymima").val('');
		$(".ULTable #Xmima").val('');
		$(".ULTable #Xmima2").val('');
	}
}

//==================================================================================【以下为管理级别JS】   
function Edit_daohangmenu(act,ths,postasp,fieldsTable,newfieldsnameZD,ToHtmlID,ChongfuId,use_conn){//一级导航修改。
	                   //(act,ths,postasp,表名,字段,ToHtmlID,重复0为全局禁止重1只为同级不重复)
	//alert(ToHtmlID);
	if(fieldsTable=="Sys_Jlmb"){
		replacefh(ths);//去除符号
    }
	
	if (!use_conn){
		use_conn='conn';
	}
	
	var NowToHtmlID="#"+ToHtmlID;
	if (fieldsTable=="Sys_Jlmb"){act="Table_Edit_Jlmb";};
	var All_XT_ZiDuan=$('.DFtables').attr('tit').toLowerCase();//得到所有系统字符串
    var thisvalue=$(ths).val().Trim();
	var thisvaluePY='SQP_'+ToPinYing(thisvalue);//得到拼音
	var thistitle=$(ths).attr("tit").Trim();
	var thistitlePY='SQP_'+ToPinYing(thistitle);//得到拼音
        thisvalue_qk=thisvalue.replace(/[ ]/g,"");//去空格
		thistitle_qk=thistitle.replace(/[ ]/g,"");//去空格
	var Tsid=$(ths).parents('ul').attr('Tsid');//查询当前记录ID值
	var Tszd=$(ths).parents('ul').attr('Tszd');//查询当前字段名（ID）
	var bigid=$(ths).parents('ul').attr('bigid');
	var bigZD=$(ths).parents('ul').attr('bigZD');
	var GXzd=$(ths).parents('ul').attr('GXzd');//上级id
	var re_id=$(NowToHtmlID+" #sys_const_re_id").val()*1;
	var thisvalue_qk_toLowerCase=thisvalue_qk.toLowerCase();
	var thisvalue_toLowerCase=thisvalue.toLowerCase();
	//alert(re_id);
	var inputid=0;//验重
	//alert(bigid+";"+bigZD);
	if(ChongfuId=='0'){//0 当全局禁止重复
		$(".DFtables input[name="+ths.name+"]").not($(ths)).each(function (){
		   var nowval=$(this).val();
           if ((nowval == thisvalue||nowval == thisvalue_qk||nowval ==thisvalue_qk_toLowerCase||nowval==thisvalue_toLowerCase) && '1'+nowval != '1'){
			 inputid=1;
		   };
        });
	}else if(ChongfuId=='1') {//1 当前级别禁止重复
		$(ths).parents('div').find("input[name="+ths.name+"]").not($(ths)).each(function (){
		   var nowval=$(this).val();
           if ((nowval == thisvalue||nowval == thisvalue_qk||nowval ==thisvalue_qk_toLowerCase||nowval==thisvalue_toLowerCase) && '1'+nowval != '1'){
			 inputid=1;
		   };
        });
	}else{//当为其它时便不执行检查重复
		inputid=0;
	};
	
	
	//alert(thisvalue);
    if (inputid > 0 ){
		alert("已有该名称，请重命名！");
		ths.value=$(ths).attr("tit");
		ths.focus();//验证当前列不能重名。
	}else if(thisvalue==''){
	    alert("值为空，或有特殊字符，请重输！");
	    ths.value=$(ths).attr("tit");
	    ths.focus();
    }else if(All_XT_ZiDuan.indexOf(','+thisvalue_qk+',') >= 0){//禁止添加系统字段名
	    alert("对不起，系统禁止添加该名称！");
	    ths.value=$(ths).attr("tit");
	    ths.focus();
	}else{
		if(fieldsTable=="Sys_Jlmb"){
			$(ths).parents('ul').find("li.headbh").html("<i class='fa fa-25-1'></i>");//这里变成原先的表图
			$(ths).parents('ul').find("li.headbh").unbind();
			    
		}
		//alert(act);
	//alert("http://localhost/MachineV1.0/"+postasp+"?act="+act+"&fieldsname="+thistitle+"&newfieldsname="+thisvalue+"&fieldsTable="+fieldsTable+"&newfieldsnameZD="+newfieldsnameZD+"&bigid="+bigid+"&bigZD="+bigZD+"&Tsid="+Tsid+"&Tszd="+Tszd+"&GXzd="+GXzd+"&fieldsnamePY="+thistitlePY+"&newfieldsnamePY="+thisvaluePY);
        
        $.post(postasp,{act:act,
						fieldsname:thistitle,
						newfieldsname:thisvalue,
						fieldsTable:fieldsTable,
						newfieldsnameZD:newfieldsnameZD,
						bigid:bigid,
						bigZD:bigZD,
						Tsid:Tsid,
						Tszd:Tszd,
						GXzd:GXzd,
						fieldsnamePY:thistitlePY,
						newfieldsnamePY:thisvaluePY,
						re_id:re_id,
						use_conn:use_conn
		},function(data){
            alert(act);
			alert(data);

			$('#'+ToHtmlID+'_content_right_menu').html('');//这里删除下拉内容
			//alert(data);
			//var data=data*1;
	        if (Tsid=='' && data>0){
			   $(ths).attr({"tit":thisvalue});
		       $("#list_count").text($("#list_count").text()*1+1);//总计数增加一个。
			   var thisul=$(ths).parents('ul');
			   //var thisdata=trim(data);
				//alert(data);
		       thisul.attr({"Tsid":data,"id":data});
			   thisul.click();//点击大类

		    }//这里将id值返回来$(ths).attr({"Tsid":data,"disabled":false})
		    //alert(data);//当添加时便执行，当修改时不执行。
		    if (fieldsTable=="Sys_Jlmb"){
			       parent.right.UpdatePhp_Pc(Tsid);   //这里更新php生成文件
			}
			
	    });//提交参数
	}
}


function table_ul_xu(talbleid,ulcss,liid)//排序。table_ul_xu('$(.DFtables)','ul.head','li:first')
  {
	if (talbleid.find(ulcss).not(".huis,.huisz").length*1>=0){//当有记录时
	talbleid.find(ulcss).not(".huis,.huisz").each(function (i){
		var ii=0;
		if (i<9){ii="0"+(i*1+1)}else{ii=i*1+1};//编号
		$(this).find(liid).text(ii);
         });
	}
  }
//=========================================================================================回收站加载
function huisget(ths,tablename,tszd,gxzd,iiiii){
    //alert(act);
	//这里得到新加的loading...
	
	var Sys_Menu_id="huisget_Sys_Menu_id";
	//alert(iiiii);
	if ($(ths).parents("ul").next(".huis").length <= 0 && $(ths).parents("ul").next("div.DFtables #"+Sys_Menu_id).length <= 0){
	  $(ths).parents("ul").after("<ul id="+Sys_Menu_id+" class='twomenu'>  loading...</ul>");
	  //alert("act:"+act+",bigid:"+Tsid+",arryi:"+i+",arryUboundi:"+Uboundi+",MenuArry:"+MenuArry);
	  $.get("B_menu_set.php",{act:"huisget",tablename:tablename,tszd:tszd,gxzd:gxzd,nowtableiiiii:iiiii},function(data){
		  $(ths).parents("ul").after(data);
		  $("#"+Sys_Menu_id).remove();$(ths).addClass('headbgloadcheck');
		  });
	}
	MenuChangeClose();//这里为关闭转移菜单
    }
//=========================================================================================回收数据
function huispost(ths){
    //alert(act);
	//这里得到新加的loading...
	//var Sys_Menu_id="huisget_Sys_Menu_id";
	var $thisul=$(ths).parents("ul.huis");
	var nowTsid=$thisul.attr("Tsid");
	var nowbigid=$thisul.attr("bigid");//上级对应ID
	var nowTstable=$thisul.attr("Tstable");
	var nowvalue=$thisul.attr("nowvalue");//这里得到显示大类名称
	var nowtableiiiii=$thisul.attr("nowtableiiiii")*1;//为0时证明只有一级菜单显示
	//alert(nowtableiiiii);
	//alert(nowTsid+","+nowTstable);
	  //alert("act:"+act+",bigid:"+Tsid+",arryi:"+i+",arryUboundi:"+Uboundi+",MenuArry:"+MenuArry)
	if(confirm('确定要恢复该数据么？')){
	  $.post("B_moban_del.php",{act:"dels_huis",id:nowTsid,DELtablename:nowTstable},function(data){
		  $thisul.remove();$("#list_count").text($("#list_count").text()*1+1);$("#huis_count").text($("#huis_count").text()*1-1);//回收站计数减少一个。
	 if(nowtableiiiii==0){
		    //添加大类
			var $nowaddmenu=$("div.DFtables ul.ADDmenus").not(".huis");
			var thisaddulbeforeclone=$nowaddmenu.next("ul").clone();//拷贝添加后面的一行。
			$nowaddmenu.before(thisaddulbeforeclone);
			var $newcloneul=$nowaddmenu.prev();//找到刚添加的那一行。
			//$("div.DFtables ul.ADDmenus").prev().hide(1800);
			$newcloneul.show().attr({'Tsid':nowTsid}).find("input").attr({'tit':nowvalue,'value':nowvalue,'TABINDEX':nowTsid});
			if($newcloneul.find("li:first").text()*1>=0){//判断序号是否为数字
			table_ul_xu('$(this).parents("div")','ul.head','li:first');//为自动编号
			}
			//$newcloneul.find("input").val(nowvalue).attr({Tsid:nowTsid});
			
	 }else{
			//var thisaddulbeforeclone=$("div.DFtables ul[Tsid="+nowbigid+"]").next("div.DFtables"+nowtableiiiii+" ul.ADDmenus").not(".huis").next("ul").clone();//拷贝添加后面的一行。
			var $nowaddmenu=$("div.DFtables ul[Tsid="+nowbigid+"]").next("div.DFtables"+nowtableiiiii).find("ul.ADDmenus").not(".huis");
			var thisaddulbeforeclone=$nowaddmenu.next("ul").clone();//拷贝添加后面的一行。
			$nowaddmenu.before(thisaddulbeforeclone);
			var $newcloneul=$nowaddmenu.prev();//找到刚添加的那一行。
			//$("div.DFtables ul.ADDmenus").prev().hide(1800);
			$newcloneul.show().attr({'Tsid':nowTsid}).find("input").attr({'tit':nowvalue,'value':nowvalue,'TABINDEX':nowTsid});
			if($newcloneul.find("li:first").text()*1>=0){//判断序号是否为数字
			  table_ul_xu('$(#tables_'+nowtableiiiii+'_'+nowbigid+')','ul.head','li:first');//为自动编号
			}
			
			//$("div.DFtables ul[Tsid="+nowbigid+"]").next("div.DFtables"+nowtableiiiii).remove();//这里删除相关的大类下表。
			 //这里得像上面一样修改
	 }
		  
		  });//回收数据并清除该列。
	}
	$('#'+ToHtmlID+'_content_right_menu').html('');//这里删除下拉内容
	MenuChangeClose();//这里为关闭转移菜单
    }
//=========================================================================================大类菜单添加UL
function addulDHCD(ths){
 var $prevuuulll=$(ths).parent().prevAll("ul.head:first");
 var $cloneul=$(ths).parent().next("ul");
 var $nodataul=$(ths).parent().prevAll("ul.nodataul");//这里误别是否有无数据提示语。
 var $nodataullength=$nodataul.size();//这里误别是否有无数据提示语。
   // alert($nodataullength);
	if ($nodataullength>0){$nodataul.animate({height:"0"},500);setTimeout(function(){$nodataul.remove();},600);}//当添加数据时删除提示。
 if ($prevuuulll.find("input").val()!=''){
	$copyul=$cloneul.clone();//这里拷一个头部过来
	$(ths).parent().before($copyul);//在这个元素前插入
	$prevul=$(ths).parent().prevAll("ul.head:first");
	$prevulsum=$(ths).parent().prevAll("ul.head").size();//得到前面同类菜单个数
	//if ($nodataullength>1){prevulsum=1};
	var Ynowthisid=$prevul.find("li:first").text();
	//if ($nodataullength>1){Ynowthisid=1};
	  var nowthisid=$prevulsum*1;//得到序号+1
	  
	  if (nowthisid<10){nowthisid='0'+nowthisid};//当小于10时自动在前面加上0
	  if (Ynowthisid>""){
	    $prevul.find("li:first").text(nowthisid);//序号给值
	  }
	$prevul.attr({'Tsid':''}).show().find("input").removeAttr("disabled").removeAttr("readonly").attr({'tit':'','value':'','TABINDEX':nowthisid});//设定输入框属性。
	
  }
	//$('.menu').scrollTop( $('.menu')[0].scrollHeight );//滚动至最下方
	MenuChangeClose();//这里为关闭转移菜单
	}

//=========================================================================================//菜单删除
function MenurightDel(ths,posthtm,act,fieldsTable,newfieldsnameZD,alerttext){
	//alert("删除成+1");
	//var $huis_count=$("#huis_count").text()*1;//这里得到回收站数量统计。
	var $thisul=$(ths).parents("ul");//这里得到当前ul行
	
	//$thisul.remove();
	var nodataul=$(ths).parents('ul.head').parents('div').find("ul").not(".ADDmenus").size();
	//alert(nodataul)
	if(nodataul==1){$(ths).parents('ul.head').nextAll('ul.ADDmenus').before("<ul class='nodataul'><i class='fa fa-nodata'></i> sorry,没有数据，请先添加。</ul>");}//在前面插入无数据提示
	var fieldsname=$thisul.attr("Tsid");//得到大类ID值
	var TSulii=$thisul.attr("TSulii")*1;//得到当前级别数
	var TSulUbii=$thisul.attr("TSulUbii")*1;//得到级别数
	var nowTSulii=TSulii+1;
	var nowtwomenuid="#tables_"+nowTSulii+"_"+fieldsname;//得到下级div ID
	//alert(nowtwomenuid);
    if(fieldsname!=''){
	  if(alerttext==''|| alerttext=='undefined' || alerttext==null){alerttext='确认删除该类别到回收站？'}
      if(confirm(alerttext)){
	  if(TSulUbii>TSulii){$(nowtwomenuid).remove();}//当有下级时便删除下级
	  //alert(posthtm+"?act="+act+"&fieldsname="+fieldsname+"&fieldsTable="+fieldsTable+"&newfieldsnameZD="+newfieldsnameZD);
	  //$.post(posthtm,{act:act,fieldsname:fieldsname,fieldsTable:fieldsTable,newfieldsnameZD:newfieldsnameZD});
	  //alert("删除成+1");
	  edit_biao_col(fieldsTable,newfieldsnameZD,fieldsname,'huis','1');//更新单条记录
	  $('#'+ToHtmlID+'_content_right_menu').html('');//这里删除下拉内容
	  $("#huis_count").text($("#huis_count").text()*1+1);//回收站计数增加一个。
	  $("#huis_count").parents('ul').nextAll().remove();//这里关闭所有回收站数据
	  $("#list_count").text($("#list_count").text()*1-1);//总计数减少一个。
	  var $thisulxu=$(ths).parents('ul').find("li:first").text()*1;//这里得到当前是否为编号
	  $thisul.next('div').remove();//这里删除添加按钮
	  $thisul.remove();
	  //$(nowtwomenuid).remove();//删除下级div
		//$('[bigid='+fieldsname+']').remove;
		  
	  //$thisul.remove();
	  var nowhead="ul.head_"+TSulii+"_";//这里选中同辈UL
	  //alert(nowhead);
	  if($thisulxu>=0){//判断序号是否为数字
		table_ul_xu('$(this).parents("'+nowhead+'")',nowhead,'li:first');//为自动编号
	  }
	  
      }
	}else{
	  $thisul.remove();//当为空时直接删除
	};
	
	MenuChangeClose();//这里为关闭转移菜单
  }
//[ok]=========================================================================================更新记录
function edit_biao_col(tableneme,search_zd,search_value,tochang_zd,tochang_value){
	$.post('moban_set_data.php',{act:'edit_biao_col',tableneme:tableneme,search_zd:search_zd,search_value:search_value,tochang_zd:tochang_zd,tochang_value:tochang_value},function(data){
		//alert(data);
	});
	//alert(tableneme+','+search_zd+','+search_value+','+tochang_zd+','+tochang_value);
}
//=========================================================================================//菜单转移同级 展表菜单
function MenuChangeTo(ths,posthtm,act,alerttext){
	//$(".menuchangeto").remove()//删除些菜单
	var f_bigid=$(ths).parents('ul.head').attr("bigid").Trim();//得到大类ID值
	var f_bigTablename=$(ths).parents('ul.head').attr("bigTablename").Trim();//得到父级表名
	var f_bigZD=$(ths).parents('ul.head').attr("BigXsZd").Trim();//得到大类显示字段
	var f_GXzd=$(ths).parents('ul.head').attr("GXzd").Trim();//得到关系字段
	var f_Tsid=$(ths).parents('ul.head').attr("Tsid").Trim();//得到当前ID
	var f_TsZD=$(ths).parents('ul.head').attr("TsZD").Trim();//得到当前对应的关系字段
	var f_Tstable=$(ths).parents('ul.head').attr("Tstable").Trim();//得到当前对应的表
	var $thisul=$(ths).parents('ul.head');
	var $thisval=$thisul.find("input").val().Trim();
	if ($thisval+"2"=="2"){alert("对不起! 本菜单值为空，不能转移。");return false;}
	//alert($thisul.find("input").val());
    //if(fieldsname!=''){
	  //if(alerttext==''|| alerttext=='undefined' || alerttext==null){alerttext='确认删除该类别到回收站？'}
      //if(confirm(alerttext)){
	  //alert("act="+act+"&fieldsname="+fieldsname+"&fieldsTable="+fieldsTable+"&newfieldsnameZD="+newfieldsnameZD);
	if ($("div.DFtables .menuchangeto").length <= 0){//当没有时执行
	  $(ths).parents('ul.head').after("<div class='menuchangeto'> loading...</div>");
	  //alert("act:"+act+",f_bigid:"+f_bigid+",f_GXzd:"+f_GXzd+",f_bigTablename:"+f_bigTablename+",f_bigZD:"+f_bigZD+",f_Tsid:"+f_Tsid+",f_TsZD:"+f_TsZD+",f_Tstable:"+f_Tstable)
	  $.get(posthtm,{act:act,f_bigid:f_bigid,f_GXzd:f_GXzd,f_bigTablename:f_bigTablename,f_bigZD:f_bigZD,f_Tsid:f_Tsid,f_TsZD:f_TsZD,f_Tstable:f_Tstable},function(data){
		  $('.menuchangeto').html(data);
		  //$(".changeli").show();
		  //$("#V_"+f_bigid).hide();
		  UpdataZhiWei('list',ZhiWei_id);  //职位权限及桌面对应php生成
	  });
	}else{//当有时便剪到此处来执行
	  $(".menuchangeto").show();
	  //$(".menuchangeto .changeli").show();
	  var $nowclone=$(".menuchangeto").clone();//这里复制备份。
	  $(".menuchangeto").remove();//这里删除源文件
	  $(ths).parents('ul').after($nowclone);
	  //$(".changeli").show();
	  //$("#V_"+f_bigid).hide();
	  $(".menuchangeto input").removeAttr("checked");//这里去除选中。
	}

	  //$(ths).parents('ul').remove();
	  //以下为自动编号
	  //table_ul_xu('$(this).parents("div")','ul.head','li:first');
      //}
	//}else{
	  //$(ths).parents('ul').remove();//当为空时直接删除
	//};
  }
function MenuChangeClose(){
	$(".menuchangeto").hide();
	}


//=========================================================================================首字不能为小数或符号并且整个不能输入逗号
function firstword(ths)
    {
	var thisvalue=$(ths).val();
	var reg=/[\,\_,\0-9]/g;//这里将要禁止输入的特殊符号列入
    thisvalue=thisvalue.replace(reg,'');//不允许输入特殊符号
	//thisvalue=thisvalue.replace('请添加','');//不允许输入特殊符号
	var thisvalue=thisvalue.match(/^[\u4e00-\u9fa5a-zA-Z]+$/g);//去掉数字开头部份
  	$(ths).val(thisvalue);//给当前文本框赋值
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
function EditBigMenu(ths,alerttext,i,Uboundi) {//管理菜单初始绑定/
    //alert(ths+"_"+alerttext+"_"+i+"_"+Uboundi);
    var thsvalue=$(ths).find('input:first').val();
	//thistablename=$(ths).attr('Tstable');
	//alert($(ths).attr("bigid")+";"+$(ths).attr("bigZD"));
    //验证大类菜单为空时执行
	//alert($(ths).attr("TsEdit"));
	MenurightEditmenu(ths,alerttext);//加载右边工具栏
	  
	if(Uboundi>=i && thsvalue+"1"!="1"){
	  TwoMenu_Post(ths,"bigmenu",i,Uboundi)//
    }
}
function MenurightEditmenu(ths,alerttext){//大类菜单出现编辑工具条
	var fieldsTable=$(ths).attr('Tstable');
	var TsEdit=$(ths).attr("TsEdit");
	var TsTYPE=$(ths).attr("TsTYPE");//判断是否为回收行。
	//alert(TsEdit);
  if($(ths).find('.menus.mdel').is(":hidden"))//判断元素是否隐藏，当没显示时才执行显示
  {
	$(".menus.mdel").hide();//全部隐藏菜单
	$(ths).find('.menus.mdel').show('slow').html('<div class="mss" onClick=MenurightDel(this,"moban_set_data.php","edit_biao_col","'+fieldsTable+'","id","'+alerttext+'")><i class="fa fa-del" style="margin-top:4px;margin-left:-2px;"></i></div>');
	
	if(TsTYPE=="huis"){//当ul之TsTYPE属性为huis时显示回收菜单
	    $(ths).find('.menus.huis').show('slow').html('<div class="mss" onClick=MenuHuis(this,"B_menu_set.php","MenuChange","确定要回收此菜单？")><i class="fa fa-trash"></i></div>');
	}
  }
  if($(ths).find('.menus.mzuanyi').is(":hidden"))//判断元素是否隐藏，当没显示时才执行显示
  {
	$(".menus.mzuanyi").hide();//全部隐藏菜单
	
	$(ths).find('.menus.mzuanyi').show('slow').html('<div class="mss" onClick=MenuChangeTo(this,"B_menu_set.php","MenuChange","确定要移动此菜单？")><i class="fa fa-zhuanyi" style="margin-top:4px;margin-left:-2px;line-height:16px;"></i></div>');
  }
	
}
function TwoMenu_Post(ths,act,i,Uboundi){//职能数据加载二级菜单数据
    //alert(act);
	var MenuArry=$(ths).parents(".DFtables").attr("MenuArry");//alert(MenuArry);
    var Tsid=$(ths).attr("Tsid");
	//alert($(ths).attr("Tsid"));
	var Sys_Menu_id="Tsid"+Tsid;//alert(Sys_Menu_id);这里得到新加的loading...
	if ($(ths).next("div.DFtables"+i).length <= 0 && $(ths).next("div.DFtables #"+Sys_Menu_id).length <= 0){
	  $(ths).after("<div id="+Sys_Menu_id+" class='twomenu'> loading...</div>");
	  //alert("act:"+act+",bigid:"+Tsid+",arryi:"+i+",arryUboundi:"+Uboundi+",MenuArry:"+MenuArry)
	  $.get("B_menu_set.php",{act:act,bigid:Tsid,arryi:i,arryUboundi:Uboundi,MenuArry:MenuArry},function(data){$(ths).next('div').remove();$(ths).after(data);$(ths).addClass('headbgloadcheck');});
	}
}

function tableshover(divid){//表格hover 特效
    $(divid).find(".hoverthis").live("mouseover",function(){$(this).addClass("hovers");}).live("mouseout",function(){$(this).removeClass("hovers");});
	$(divid).find(".hoverthis2").live("mouseover",function(){$(this).addClass("hovers2");}).live("mouseout",function(){$(this).removeClass("hovers2");});
}

function Zhiquan_Edit_Date_Post(ths,act){//职责权限数据加载二级菜单数据
    var bumen_id=$(ths).attr("bmid"); //alert(bumen_id);
	var ZhiWei_id=$(ths).attr("zwid"); //alert(ZhiWei_id);
	var Sys_Menu_id="Sys_Menu_id"+$(ths).attr("Sys_Menu_id"); //alert(Sys_Menu_id);这里得到新加的loading...
	//alert(Sys_Menu_id);//当前 
	//alert($("#"+Sys_Menu_id).length);
	if ($(ths).next("div.tables2").length <= 0 && $(ths).next("#"+Sys_Menu_id).length <= 0){//判定是否已有加载...
	  //$(ths).after("<ul class='twomenu' id="+Sys_Menu_id+"> loading...</ul>");
	  //alert("http://localhost/MachineV1.0/B_menu_set.php?act="+act+"&bumen_id="+bumen_id+"&ZhiWei_id="+ZhiWei_id);
	  $.get("B_menu_set.php",{act:act,bumen_id:bumen_id,ZhiWei_id:ZhiWei_id},function(data){
		  $(ths).after(data);
		  //$("#"+Sys_Menu_id).remove();
		  $(ths).addClass('headbgloadcheck');});
	//alert($("#"+Sys_Menu_id).length);
	}
}

function ZhiLeng_Edit_Post(ths){//职能数据加载二级菜单数据
    var id=$(ths).attr("qxid"); //alert(id);$(ths).next("ul div.tables2").length <= 0 &&
	var Sys_Menu_id=$(ths).attr("Sys_Menu_id"); //alert(Sys_Menu_id);这里得到新加的loading...
	if ($(ths).next("div.tables2").length <= 0 && $(ths).next("#"+Sys_Menu_id).length <= 0){//判定是否已有加载...
	  //$(ths).after("<ul class='twomenu' id="+Sys_Menu_id+"> loading...</ul>");
	  $.get("B_menu_set.php",{act:'ZhiLeng_Edit_date',id:id},function(data){
		  $(ths).after(data);
		  //$("#"+Sys_Menu_id).remove();
		  $(ths).addClass('headbgloadcheck');
	  });
	   //alert($("#"+Sys_Menu_id).length);
	};
}

function thistripnt(act,ths,hy) {/*可删*/
    var nowre_id=$(ths).attr('at');//得到表单ID
	var nowinputname=$(ths).attr('name');//得到inputname
	
	var nowchecked=$(ths).attr("checked");
	var ZhiWei_id=$(ths).attr("bumenID");//得到职位ID
	var checkvalue=$(ths).attr("value");//得到选中值 
	//alert("http://localhost/MachineV1.0/moban_set_data.php?act="+act+"&colsre_id="+nowre_id+"&nowinputname="+nowinputname+"&nowchecked="+nowchecked+"&nowbumenid="+ZhiWei_id+"&checkvalue="+checkvalue+"&hy="+hy);
	//alert(act);
	$.post("moban_set_data.php",{act:act,colsre_id:nowre_id,nowinputname:nowinputname,nowchecked:nowchecked,nowbumenid:ZhiWei_id,checkvalue:checkvalue,hy:hy},function(data){
		//if(data){alert(data);}; //测试用
		UpdataZhiWei('list',ZhiWei_id);  //职位权限及桌面对应php生成
	});
}
function thistripnt_zhiwei(act,ths,hy) {
    var nowre_id=$(ths).attr('at');//得到表单ID
	var nowinputname=$(ths).attr('name');//得到inputname
	
	var nowchecked=$(ths).attr("checked");
	var ZhiWei_id=$(ths).attr("bumenID");//得到部门ID
	var checkvalue=$(ths).attr("value");//得到选中值 
	//alert("http://localhost/MachineV1.0/moban_set_data.php?act="+act+"&colsre_id="+nowre_id+"&nowinputname="+nowinputname+"&nowchecked="+nowchecked+"&nowbumenid="+nowbumenid+"&checkvalue="+checkvalue+"&hy="+hy);
	//alert(act);
	$.post("moban_set_data.php",{act:act,colsre_id:nowre_id,nowinputname:nowinputname,nowchecked:nowchecked,nowbumenid:ZhiWei_id,checkvalue:checkvalue,hy:hy},function(data){
		//if(data){alert(data);}; //测试用
		UpdataZhiWei('list',ZhiWei_id);  //职位权限及桌面对应php生成
	});
}
function thistripnt_hengxiang(ths) {
    var nowre_id=$(ths).attr('re_id');         //表单ID
	var ZhiWei_id=$(ths).attr("bumenID");     //职位ID
	var parentulchecksize_all=$(ths).parent().find('input[type="checkbox"]').size();                  //父级下面的选中框个数
	var parentulchecksize=$(ths).parent().find('input[type="checkbox"]:checked').size();              //父级下面的选中框个数
	//alert(parentulchecksize);
	if(parentulchecksize < parentulchecksize_all){     //未全选中或未选时
	  // alert('未全选');
	   nowchecked=1;
	   $(ths).parent().find('input[type="checkbox"]').attr({"checked":true});
	}else{                                             //全选中时
	  // alert('全选');
	   nowchecked=0;
	   $(ths).parent().find('input[type="checkbox"]').attr({"checked":false});
	}
	$.post("moban_set_data.php",{act:'Edit_ZWquanxian_Update_hengxiang',colsre_id:nowre_id,ZhiWei_id:ZhiWei_id,nowchecked:nowchecked},function(data){
		//if(data){alert(data);}; //测试用
		var parentulchecksize=$(ths).parent().parent().find('input[type="checkbox"][name="sys_q_cak"]:checked').size();          //选中数
		$(ths).parent().parent().prev().find('font[color="red"]').text(parentulchecksize);
		UpdataZhiWei('list',ZhiWei_id);  //职位权限及桌面对应php生成
	})
}
function thistripnt_QuanXuan(ths) {
    var nowre_id=0;         //表单ID
	var ZhiWei_id=0;        //职位ID
	var parentulchecksize_all=$(ths).parent().next().find('input[type="checkbox"]').size();              //总数
	var parentulchecksize=$(ths).parent().next().find('input[type="checkbox"]:checked').size();          //选中数
	var forsize=$(ths).parent().next().find('ul').not('.nodataul').size();                               //行数
	var tables2ok=$(ths).parent().next().attr('class');                                                  //查看后面是否加载过了
	//alert(tables2ok);
    if(tables2ok=='tables2'){                                                                                 //当后面有加载成功下级时再执行
	//alert(forsize);
	    if(parentulchecksize < parentulchecksize_all){     //未全选中或未选时
	      //alert('未全选中时');
	        nowchecked=1;
	        $(ths).parent().next().find('input[type="checkbox"]').attr({"checked":true});
		    $(ths).parent().find('font[color="red"]').text(forsize);
	    }else{                                             //全选中时
	       //alert('全选中时');
	       nowchecked=0;
	       $(ths).parent().next().find('input[type="checkbox"]').attr({"checked":false});
	       $(ths).parent().find('font[color="red"]').text(0);
	    }
		
	    if(forsize > 0){                                                                                     //下方有可选行时
		    $(ths).parent().next().find('ul').each(function(){
                var nowre_id=$(this).find('input[name="sys_q_cak"]').attr('at');                                 //本行的id
			    var ZhiWei_id=$(this).find('input[name="sys_q_cak"]').attr('bumenID');                           //职位id
			    //alert("nowre_id:"+nowre_id+"ZhiWei_id:"+ZhiWei_id);
			    $.post("moban_set_data.php",{act:'Edit_ZWquanxian_Update_hengxiang',colsre_id:nowre_id,ZhiWei_id:ZhiWei_id,nowchecked:nowchecked},function(data){
		         //if(data){alert(data);}; //测试用
				   UpdataZhiWei('list',ZhiWei_id);  //职位权限及桌面对应php生成
	            })
            });
	     }
     }
}
//===============================================================================[职位php生成；职位对应桌面php生成]PC
function UpdataZhiWei(act,ZhiWei_id){
	    $.post('B_quanxian_chache.php', {act:act,zwid:ZhiWei_id},function(data){
			 $.post('../m/Machine_MobileV1.0/M_quanxian_chache.php', {act:act,zwid:ZhiWei_id},function(data){
		           $.post('B_menu_desk_chache.php', {act:act,zwid:ZhiWei_id});
				   $.post('../m/Machine_MobileV1.0/M_menu_desk_chache.php', {act:act,zwid:ZhiWei_id});
	         })
	    })
	}

function jlqdarryy(act,postasp){
	//alert('12');
	$.get(postasp,{act:act},function(data){$("#ssarry").html(data);});
	}

function cheshi(ths){//测试
   var thisXssarry=$(ths).attr("Xssarry");
   var thishuisarry=$(ths).attr("huisarry");
	//alert(thisXssarry);
	}
function editthisvalue(ths,tablename,ZDname,ZDid){//测试
   var thistit=$(ths).attr("tit");
   var thisvalue=$(ths).val();
   //alert(thisvalue);
   $.post("moban_set_data.php",{act:'Edit_zd',tablename:tablename,zd:ZDname,ZDid:ZDid,ZDval:thisvalue});
	}
//document.oncontextmenu=new Function('event.returnValue=false;');//禁止右键菜单
//document.onselectstart=new Function('event.returnValue=false;');//禁止复制
var menu_JS_OK=1;//加载成功