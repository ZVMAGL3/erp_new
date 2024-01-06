


function createupload_jiaohu(opt){
	  
	    var NowToHtmlID=$("#"+opt.ToHtmlID);
	    var re_id = NowToHtmlID.find("#sys_const_re_id").val();         //得到re_id
	    var strmk_id = parseInt($("#DeskMenuDiv"+re_id+"_content_foot").find('#post_form').attr('strmk_id'));      //得到修改的id值
	    if (isNaN(strmk_id)) {
		    strmk_id = 0;
	    };
	    //alert(strmk_id);
	    
		var baseinfo=opt.baseinfo; //传参数给ajax_sql.asp  tidno 为关联表的唯一序号 classid为分类id
		 
		 var update_sort=function(childs){
			var data={};
			var idnos=[];
			var index=0;
				  for(var i=0;i<childs.length;i++){
						 var idno=childs[i].getAttribute("data-idno");
						 var id=childs[i].getAttribute("data-id");
						 if(typeof(idno)!="undefined"&&idno!=""){
						 data["id_"+index]=id;
							 data["idno_"+index]=idno;
							 data["sort_"+index]=i;
							 index++;
						 }
				  }
				  if(index>0){
						 data["num"]=index;
						 $.ajax({
						 url:opt.conf.uploadurl+"?act=sort",
						 type:"post",
						 data:data,
						 async:false,
						 dataType:"json",
						 success:function(res){
							 var data=res.data;
							 console.log(res);
							// myhcfile.myalert("排序已更新");
						 }
					 });
				  }
		};

        var myhcfile=new hcfile();
	    var mytimer=null;
		  myhcfile.Init({
				  url:opt.conf.uploadurl+"?act=up",
				  maxnum:50,//只能上传N张
				  type:"all",//yinpin:仅上传音频文件,shipin:仅上传视频文件,img:仅上传图片,不填或all表示全部
				  input_id:opt.inputid,//存多张图片路径的input的id
				  input_fengmian_id:'',//存封面的图片路径input对象id
				  weizhi_id:opt.inputid+"_weizhi_1",//选择按钮位置对像id
				  panel_id:opt.inputid+"_panel_1",//图片文件显示对象id
                  //exts:"jpg,jpeg,gif,bmp,png,bwep",//只允许的后缀
				  bgsrc:"",//按钮图片
				  //isnewsmall:1,//1为生成小图
				  inserttype:"append",
				  fdsize:1024*100,//每段图片的大小，不要超过空间上传文件大小限制
				  ischongxuan:0,//1显示重选按钮
				  fenge:";",
				  drop_to_id:"drop_div",//托入有效区域对象id,如填写成document则将整个网页做为有效区域
				  send_id:"send",//确定上传按钮位置对像id,不填写或填写auto则自动上传
				  item_class:"myitembar", //项样式类名 hcfile03.css里有内置的类名
				  select_num_id:"select_num", //可以不填写，显示当前要上传的文件个数的对象id
				  success_num_id:"success_num", //可以不填写，显示当前要已上传的文件总个数的对象id
				  max_num_id:"max_num", //可以不填写，显示允许上传的个数
				  down_url:opt.conf.downurl,//可以不填写，下载的
				  bt_del_text:"X",
			  	  //item_yifu_id:opt.inputid+"_weizhi_1",//项依附id,依附的上级元素必须跟项的上级元素同一个元素
			  	  //item_yifu_weizhi:"after",//依附元素位置  //before after
				  auto:1,//自动上传
				  conf:{big_hz:"_s100.",small_hz:"_s50."},
				  inserttype:"before",
				  wenzi:{baifenbi:"等待"},
				  newfiles:[{type:"file",name:"smallfile",yasuo:{type:"width",width:200,zhiliang:0.9},shuiyin:[{type:"text",x:-20,y:-20,fontsize:15,text:"小冲",align:"left",width:40,height:20,color:"#FFFFFF",opacity:0.4}]}],
				  first_show:{date:0,size:0,name:1,bar:0,baifenbi:0,del:1,bg:0,see:0},

				  init_show:{date:0,size:0,name:1,bar:1,baifenbi:1,del:0,bg:0},
				  upload_show:{date:0,size:0,name:1,bar:1,baifenbi:1,del:0,bg:1},//上传过程中要显示的元素,1:显示,0不显示 date(日期) size(大小) name(标题) bar(进度条) baifenbi(进度条) del(删除按钮)
				  success_show:{date:0,size:0,name:1,bar:1,baifenbi:1,del:1,bg:0,see:1},//上传完后要显示的元素,1:显示,0不
			  	 first_init:function(){
						var t=this;
					//	t.ResetInput();
						
				 },upload_start:function(op){//开始上传
				    var t=this;
				  },
				  upload_before:function(op){//分片上传之前回调事件
				       var t=this; //这里的this是指该实例类
					   //设置发送参数
				       //t.posts[op.myitem.id]["isnewmid"]=1;//生成小图
					   t.posts[op.myitem.id]["isnewsmall"]=1;//生成中图
					   for(var k in baseinfo){
				            t.posts[op.myitem.id][k]=baseinfo[k];
					   }
					   //t.posts[op.myitem.id]["desc"]="456";
					   console.log( t.posts[op.myitem.id]);
				  },
				  success_huidiao:function(op){//成功上传回调
				         var t=this;
                         //t.myalert("已上传");
						  var childs=t.getchilds();
					  	  window.clearTimeout(mytimer);

						  mytimer=window.setTimeout(function(){
							update_sort(childs);
						if(typeof(opt.success)!="undefined"){
								opt.success.call(t,{childs:childs});   
							}
							 t.ResetInput();
							//$("#SYS_submit").click();
							if(strmk_id>0){
								NowToHtmlID.find('#SYS_submit').click();
							};
	
						  },500);

				  },
				  delete_huidiao:function(op){//成功上传回调
				          var t=this;
					      var myitem=op.myitem;
					  if(confirm("删除？")){
						 $.ajax({
							 url:opt.conf.uploadurl+"?act=del",
							 type:"post",
							 data:{idno:myitem.getAttribute("data-idno")},
							 async:false,
							 dataType:"json",
							 success:function(res){
								   t.myalert(res.msg);
								   t.RemoveItem(myitem.id);//移除项
							 }
						 }); 

						window.setTimeout(function(){
							 t.ResetInput();
							//$("#SYS_submit").click();
							if(strmk_id>0){
								NowToHtmlID.find('#SYS_submit').click();
							}
						},500);
					  }
				  },
				  fengmian_huidiao:function(op){//点击封面回调事件
				          var t=this;
					      var myitem=op.myitem;
						 $.ajax({
							 url:opt.conf.uploadurl+"?act=setfengmian",
							 type:"get",
							 data:{idno:myitem.getAttribute("data-idno")},
							 async:false,
							 dataType:"json",
							 success:function(res){
								 t.myalert(res.msg);
							 }
						 });
					  
				  }
		 });
		 //加载初始化显示图片
		 if(opt.isfirstload==1){
		 myhcfile.ajax({
			 url:opt.conf.uploadurl+"?act=list",
			 type:"get",
			 data:baseinfo,
			 async:false,
			 dataType:"json",
			 success:function(res){
				 var data=res.data;
				 console.log(res);
				 for(var i=0;i<data.length;i++){
				     var row=data[i];
					//  console.log(row);
					 var myitem=myhcfile.NewItem({type:"first",row:row,inserttype:"append"});
				 };
				 myhcfile.ResetInput();
			 }
		 });
		 };

		var mydd=new DragDrop();//拖曳功能
		mydd.init({
			 listid:opt.inputid+"_panel_1" //项所在的父类元素id
			,itemclass:"myitema" //项的样式类名
			,success_huidiao:function(op){
			      var childs=myhcfile.getchilds();
				  window.setTimeout(function(){
				  	update_sort(childs);
				  },100);
				
				window.setTimeout(function(){
					 myhcfile.ResetInput();
					//$("#SYS_submit").click();
					if(strmk_id>0){
						NowToHtmlID.find('#SYS_submit').click();
					}
				},500);
			}
		});
		return this;
}
