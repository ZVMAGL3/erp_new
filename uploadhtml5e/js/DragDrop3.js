// JavaScript Document

/*
 //调用例子
		var mydd=new DragDrop();
		mydd.init({
			 listid:"mypanel"
			,itemclass:"item"
			,success_huidiao:function(op){
			   //console.log(op)
			}
		});
*/
function DragDrop(){
	 //整理来自：http://www.jq22.com/webqd2944
	 //http://www.vpsor.cn/product/vhost
           var DragDrop_={
			  init:function(opt){
				   var t=this;
				   var this_= this;
				 
				   this.aPosXY = []; //原始位置
				   this.aPosXYClone = [];
				   this.moveStatus = false; //移动状态
				   this.editAble = false; //编辑状态
				   this.dashedBox = null;
				   this.moveItem = null;
				   this.moveItemH = null;
				   this.mouseDownPos = [];				
				   this.aPosXY = []; //原始位置
				   this.opt=opt;
                   if(typeof(opt.success_huidiao)!="undefined"){
					    this_.success_huidiao=opt.success_huidiao;
				   };	

					  this.list=document.createElement("div");
					  if(typeof(opt.list)!="undefined"){
						  this.list=opt.list;
					  };
					  if(typeof(opt.listid)!="undefined"){
						  var o=document.getElementById(opt.listid);
						  if(o){
							 this.list=o;  
						  }
					  };
					if(typeof(this.list.style.cssText)!="undefined"){
					   this.list.setAttribute("old-style",this.list.style.cssText);
					};
				   this.input1=document.createElement("input");
				   this.input1.type="text";
			       if(typeof(this.list.id)=="undefined"){
					   this.list.id=this.newrand(7);
				   }
				   this.ismode=1;
				   this.isclearfloat=1;
				   if(typeof(opt.ismode)!="undefined"){
					    this.ismode=opt.ismode;
				   }
				   if(typeof(opt.isclearfloat)!="undefined"){
					    this.isclearfloat=opt.isclearfloat;
				   }
				   this.confbts=new Array();
				    this.omovefunc=function(event){
					   this_.mouseMove(event);
			       };
			       this.oupfunc=function(event){
					   this_.mouseUp(event);
			       };
			       this.childfunc=function(event){
					    clearTimeout(this_.timer);
			       };
	
	                var listmousedown=function(e){
							var e1 =e||window.event;
						    var obj= e1.srcElement || e1.target;
							// console.log(e1);
							 var myitem=null;
							   if(typeof(this_.opt.itemclass)!="undefined"){
									 while(obj!=this_.list&&obj){
										 
										if(t.hasClass(obj,this_.opt.itemclass)){
											myitem=obj;
											//console.log(myitem);
											break;
										}else{ 
											obj=obj.parentNode;
										}
									 };
							   }

								 if(myitem){
									// console.log(myitem);
									 this_.mouseDown(e1,myitem);
								 };
							 if(e&& e.preventDefault ){ 
							   e.preventDefault();  //支持DOM标准的浏览器
							  }else{ 
							   window.event.returnValue = false;  //IE
							 } ;
							 if(e&&e.stopPropagation){e.stopPropagation();}else{ window.event.cancelBubble = true;return false;}
					};
				   this_.addEvent(this.list,"mousedown",listmousedown);//注册事件
				   this_.addEvent(this.list,"touchstart",listmousedown);
				   this_.maxzindex=2000;
			  },setBts:function(obj){
				this.confbts.push(obj);  
			  },mouseDown:function(e,obj){
				       var this_ = this;
					    e=e||window.event;

 						//e.preventDefault();//阻止默认事件，取消文字选中 
//						//obj.setCapture&&obj.setCapture();//低版本IE阻止默认事件，取消文字选中  
						//this_.log("mouseDown:",touches);
							var touches=[];
							var pageX=0,pageY=0;
							if(typeof(e.touches)!="undefined"&&e.touches.length>0&&e.touches[0].pageX!=0){//jq的
								   touches=e.touches;
							}else if(e.originalEvent){
								   touches=e.originalEvent.changedTouches; 
							}else if(e.changedTouches){
								   touches=e.changedTouches; 
							};
							if(touches&&touches.length>0){
								   pageX=touches[0].pageX; 
								   pageY=touches[0].pageY; 
							}else if(e.pageX){
							  pageX=e.pageX; 
							  pageY=e.pageY;   
							}else if(e.x){
							   pageX=e.x; 
							   pageY=e.y; 
							};
					   this_.startxy={x:pageX,y:pageY};
					   this_.movexy={x:pageX,y:pageY};
					     this_.movecount=0;//移动次数
						 this_.moveItem = obj; //当前移动的元素 
						 var childs1=this_.moveItem.getElementsByTagName("*");
						 for(var i=0;i<childs1.length;i++){
							    this_.addEvent(childs1[i],"mouseup",this_.childfunc);
								this_.addEvent(childs1[i],"touchend",this_.childfunc);
						 }
						
					  clearTimeout(this_.timer);
                       this_.timer=setTimeout(function(){
													   
					   this_.log("mouseDown:");
                      if(this_.movecount==0&&this_.movexy.x==this_.startxy.x&&this_.movexy.y==this_.startxy.y){
						 
					  };
					   var lefttop=this_.offset(obj);
					   
					   console.log("lefttop",lefttop);
					   this_.oldxy={x:lefttop.left,y:lefttop.top};
					   this_.isonerow=true;
					   this_.curindex=null;
					   this_.thisIndex = obj.getAttribute('drop-index'); //获取当前序号，
					   

                       // this.log("offsetHeight",this.lis[i].offsetHeight);
		

					   this_.maxzindex++;
					   this_.dashedBox = document.createElement('div'); //创建新元素
					    
					   this_.dashedBox.className = 'dashed-box'; //为新元素增加类名
					   if(typeof(this_.opt.boxhtml)!="undefined"){
						this_.dashedBox.innerHTML= this_.opt.boxhtml;  
					   };
					   if(obj.className!=undefined){
						    this_.dashedBox.className= this_.dashedBox.className+" "+obj.className;
					   };
				       //console.log(  this_.dashedBox.className);
					   if(obj.style.cssText!=undefined){
						     this_.dashedBox.style.cssText=obj.style.cssText;
					   };
					   this_.dashedBox.style.opacity=0.9;
					   obj.parentNode.insertBefore(this_.dashedBox,obj);

						this_.objs=this_.getchilds();
                       for(var i=0;i<this_.objs.length;i++){
						     var child=this_.objs[i];
							 if(typeof(child.style.cssText)!="undefined"){
								 child.setAttribute("oldcssText",child.style.cssText);
							 }
					   };
					   this_.setCss(obj, {
						   'position': 'fixed',
						   'left': parseInt(this_.oldxy.x)+"px",
						   'top': parseInt(this_.oldxy.y)+"px",
						   'z-index':this_.maxzindex,
						    'left': "" 
					   });
					   
					   this_.moveStatus = true; //开启可移动状态


					  // this.removeClass(obj, 'edit-able');
					   this_.obj=obj;//当前对象
					   this_.isbool=true;
					   this_.obj.style.zIndex=30000;


                       if(this_.ismode==1){
						   this_.addEvent(window,"mousemove",this_.omovefunc);
						   this_.addEvent(window,"touchmove",this_.omovefunc);
						   this_.addEvent(window,"mouseup",this_.oupfunc);
						   this_.addEvent(window,"touchend",this_.oupfunc);
					   }
					},200);
						//onselectstart="return false;" style="-moz-user-select:none;"
					   //e.preventDefault();//阻止默认事件，取消文字选中  
			  },getStyleValue:function(obj,key){  //获取最终的样式值
					 if (obj.style[key]){
						 return obj.style[key];  
					 }else if(obj.currentStyle){ 
						  return obj.currentStyle[key]; 
					 }else{
						 //ff:它使用传统的"text-Align"风格的规则书写方式，而不是"textAlign" 
						 key = key.replace(/([A-Z])/g,"-$1"); 
                         key = key.toLowerCase(); 
						 return document.defaultView.getComputedStyle(obj,null)[key]; //
					  } 
			  },mouseMove:function(e){//鼠标按下
			          var this_=this;
					    e=e||window.event;
						  var this_=this;
							var touches=[];
							var pageX=0,pageY=0;
							if(typeof(e.touches)!="undefined"&&e.touches.length>0&&e.touches[0].pageX!=0){//jq的
								   touches=e.touches;
							}else if(e.originalEvent){
								   touches=e.originalEvent.changedTouches; 
							}else if(e.changedTouches){
								   touches=e.changedTouches; 
							}
							if(touches&&touches.length>0){
								   pageX=touches[0].pageX; 
								   pageY=touches[0].pageY; 
							}else if(e.pageX){
							  pageX=e.pageX; 
							  pageY=e.pageY;   
							}else if(e.x){
							   pageX=e.x; 
							   pageY=e.y; 
							};
						//this.log("length:"+this.lis.length);
					   this_.movexy={x:pageX,y:pageY};
					   this_.log("mouseMove:",e);
					  // this.input1.select();
					   if (!this_.moveStatus) {
                                 this_.Reset();
								return false;
					   };
                        var obj=this_.moveItem;
						
					    this_.log("this.movecount",this_.movecount);
						this_.log("startxy",this_.startxy);
						this_.log("movexy",this_.movexy);
						
					   this_.movecount++;
					  
					   this_.setCss(obj, {
						   'left': this_.movexy.x-(this_.startxy.x-this_.oldxy.x) + 'px',
						   'top': this_.movexy.y-(this_.startxy.y-this_.oldxy.y) + 'px'
					   });

					   var p=e.target;
					   this_.toObj=null;

                      var  toObjIndex=-1;
					  var dashedBoxIndex=-1;
					  for(var i=0;i<this_.objs.length;i++){
						      var lt=this_.offset(this_.objs[i]);
							  
							  var lt1={left:lt.left+this_.objs[i].offsetWidth,top:lt.top+this_.objs[i].offsetHeight};
						     this_.log("lt",lt);  
							 this_.log("lt1",lt1); 
							  if(this_.objs[i].id=="photos_panel1"){
		
								 //  alert(this_.objs[i].offsetHeight);
								   this_.log("movexy",this_.movexy);  
							  }
							  if(this_.movexy.x>lt.left&&this_.movexy.y>lt.top&&this_.movexy.x<lt1.left&&this_.movexy.y<lt1.top){
								  if(this_.objs[i]!=this_.dashedBox&&this_.objs[i]!=this_.moveItem){
									  if(toObjIndex==-1){
								         this_.toObj=this_.objs[i];
									     toObjIndex=i;
									  }
								  }
							  }
							  if(this_.objs[i]==this.dashedBox){
								  dashedBoxIndex=i;
							  }
					  };
					  this_.log("toObjIndex",toObjIndex);
					  this_.parentobjs=new Array();
					  if(typeof(this_.opt.parentid)!="undefined"){
						  var arr= this_.opt.parentid.split(",");
						  for(var i=0;i<arr.length;i++){
							      var obj=this_.getObjById(arr[i]);
								 if(obj){
									  this_.parentobjs.push(obj);
								 }
						  }
					  };
					  var toObjIndex1=-1;
					  if(toObjIndex==-1){
						  for(var i=0;i<this_.parentobjs.length;i++){
								  var lt=this_.offset(this_.parentobjs[i]);
								  this_.log("lt--",lt);
								  var lt1={left:lt.left+this_.parentobjs[i].offsetWidth,top:lt.top+this_.parentobjs[i].offsetHeight};
								  if(this_.movexy.x>lt.left&&this_.movexy.y>lt.top&&this_.movexy.x<lt1.left&&this_.movexy.y<lt1.top){
											 this_.toParentObj=this_.parentobjs[i];
											 toObjIndex1=i;
											//alert(toObjIndex1);
			
								  }
						  }; 
					  };
					//  this_.log("toObjIndex1",toObjIndex1);
					  if(this_.toObj&&dashedBoxIndex!=-1&&toObjIndex!=-1){
						   // this_.log(dashedBoxIndex+">"+toObjIndex);
							var ob=this_.objs[toObjIndex];
						     this_.objs[toObjIndex]=this_.dashedBox;
						     this_.objs[dashedBoxIndex]=this_.toObj;
							if(dashedBoxIndex>toObjIndex){
					             this_.toObj.parentNode.insertBefore(this_.dashedBox,this_.toObj);
							}else{
                                if(this_.dashedBox.parentNode!=this_.toObj.parentNode){
									this_.toObj.insertBefore(this_.dashedBox,this_.toObj);
								}else{
								   this_.dashedBox.parentNode.insertBefore(this_.toObj,this_.dashedBox);
								}
							}
					  };
					   this_.clearfloat1=null;
					  if(this_.toParentObj&&toObjIndex1!=-1){
						       this_.log("toObjIndex1",toObjIndex1);
							   var childs=new Array();
							   for(var i=0;i<this_.toParentObj.childNodes.length;i++){
								   if(typeof(this_.toParentObj.childNodes[i].tagName)!="undefined"){
									   childs.push(this_.toParentObj.childNodes[i]);   
								   }
							   }
							   var num=0;
						      for(var i=0;i<childs.length;i++){
								 console.log("tagName:",childs[i].tagName);
								 

								 if(this_.hasClass(childs[i],"clearfloat")){
									  this_.clearfloat1=childs[i];
								 }else{
									   if(typeof(this_.opt.itemclass)!="undefined"){
										   if(this_.hasClass(childs[i],this_.opt.itemclass)){
										      num++;
										   }
									   }
								 }

							 }
							 
							 this_.log("len",childs.length);
							 if(this_.clearfloat1&&num==0){
								 	this_.clearfloat1.parentNode.insertBefore(this_.dashedBox,this_.clearfloat1);
							 }else if(num==0){
								   this_.toParentObj.appendChild(this_.dashedBox);
							 }
							this_.log("toObjIndex1",this_.parentobjs.length);

					  }
//					   if(this.isbool==false){
//						   return false;
//					   };

					  // this_.log(leftv);
             },mouseUp:function(e,obj) {//鼠标弹起
					
					
					var this_=this;
					e=e||window.event;
					var touches=[];
					var pageX=0,pageY=0;
					
					if(typeof(e.touches)!="undefined"&&e.touches.length>0&&e.touches[0].pageX!=0){//jq的
						touches=e.touches;
					}else if(e.originalEvent){
						touches=e.originalEvent.changedTouches; 
					}else if(e.changedTouches){
						touches=e.changedTouches; 
					}
					
					if(touches&&touches.length>0){
						pageX=touches[0].pageX; 
						pageY=touches[0].pageY; 
					}else if(e.pageX){
						pageX=e.pageX; 
						pageY=e.pageY;   
					}else if(e.x){
						pageX=e.x; 
						pageY=e.y; 
					};
					
					var oldparent=this_.moveItem.parentNode;
					
					if(this_.dashedBox){
						this_.setCss(this_.moveItem, {
						'position': '',
						'left':"",
						'top':"",
						"z-index":""
						});
						this_.dashedBox.parentNode.insertBefore(this_.moveItem,this_.dashedBox);
					};
					for(var i=0;i<this_.objs.length;i++){
						var child=this_.objs[i];
						if(child.getAttribute("oldcssText")&&typeof(child.getAttribute("oldcssText")!="undefined")){
							child.style.cssText=child.getAttribute("oldcssText");
						}
					};
					this_.log("mouseUp:");
					//return false;
					//  e.preventDefault();//阻止默认事件，取消文字选中	  
					
					if(this_.ismode){
						this_.removeEvent(window,"mouseup",this_.oupfunc);
						this_.removeEvent(window,"touchend",this_.oupfunc);
						this_.removeEvent(window,"mousemove",this_.omovefunc);
						this_.removeEvent(window,"touchmove",this_.omovefunc);
					};
					this_.moveStatus=false;
					this_.upxy={x:pageX,y:pageY};
					if(this_.dashedBox){
						this_.dashedBox.parentNode.removeChild(this_.dashedBox);
					};
					this_.dashedBox=null;
					
					if(typeof(this_.success_huidiao)!="undefined"){
						this_.success_huidiao({item1:this_.moveItem,oldparent:oldparent,newparent:this_.moveItem.parentNode});
					};
					this_.Reset();
					this_.moveStatus=false;
					this_.moveItem = null;
				

			 },getObjById:function(id){
				 return document.getElementById(id);
		    },hasClass:function(obj,cla){//判断是否在存这个样式类名
			   var isbool=false;
			   if(obj&&typeof(obj.className)!="undefined"){
				 var old=obj.className,newval="";
				 var arr=old.split(" ");
				 for(var i=0;i<arr.length;i++){
					  if(String(arr[i])==String(cla)){isbool=true;}
				 }
			   };
			   return isbool;
			 },Reset:function(){
					var this_=this;
					this.moveStatus=false;
					var childs1=this_.moveItem.getElementsByTagName("*");
					for(var i=0;i<childs1.length;i++){
						this_.removeEvent(childs1[i],"mouseup",this_.childfunc);
						this_.removeEvent(childs1[i],"touchend",this_.childfunc);
					};
					
					if(this_.dashedBox){
						this_.dashedBox.parentNode.removeChild(this_.dashedBox);
					};
					
					this.moveItem = null;
					this_.dashedBox=null;
					   
			  },setCss:function(obj,cssList){//设置样式
					if(obj){
						for(var attr in cssList) {
							obj.style[attr] = cssList[attr];
						}
					}
			  },addClass:function(obj, _classname) { //增加类名
				   var classNames = obj.className; //获取当前按钮的class,返回的是字符串
				   var tf = classNames.search(_classname)>= 0 ? true : false; //查找匹配的类名位置，如果返回-1说明没有这个类名， classNames.search(_classname)>=0 == false
				   if(!tf) {
					    classNames = classNames + ' ' + _classname;
					    obj.className = classNames;
				   }
             },removeClass:function(obj, _classname) {//删除类名
			    if(typeof(obj.className)=="undefined"){
				 return false;
			    };
			    var classNames = obj.className.split(' ');
				var newclass="";
				for(var i=0;i<classNames.length;i++){
					if(classNames[i]!=_classname){
						if(newclass!=""){
							newclass+=" "+classNames[i];
						}else{
							newclass=classNames[i];
						}							
					}
				};
			    obj.className = newclass;

			 },getchilds:function(){//获取所有项
					 var this_=this;
					 var childs=new Array();
					if(typeof(this_.opt.itemclass)!="undefined"){
							var divs=document.getElementsByTagName("div");
							for(var i=0;i<divs.length;i++){
								 if(this_.hasClass(divs[i],this_.opt.itemclass)){
									   childs.push(divs[i]);
								 }
								 if(this_.hasClass(divs[i],"nulltishi")){
									   childs.push(divs[i]);
								 }
							}
							//this_.log(childs);
					}else if(typeof(this_.list)!="undefined"){
						 for(var j=0;j<this_.list.childNodes.length;j++){
							  if(this_.list.childNodes[j]&&this_.list.childNodes[j].getAttribute){
								var myparent=this_.list.childNodes[j].getAttribute("myparent");
								var dragdrop=this_.list.childNodes[j].getAttribute("dragdrop");
								if(typeof(myparent)!="undefined"&&myparent){
									 childs.push(this_.list.childNodes[j]); 
								}else if(typeof(dragdrop)!="undefined"&&dragdrop){
									 childs.push(this_.list.childNodes[j]); 
								}
								
							  }
						 };
					};
					 return childs;
	          },log:function(str,dat){
						var newstr="",str1="",str2="";
						var to_str_func=function(da){
									 var stra="";
									 if(typeof(da)=="object"){
										 for(var k in da){
											 if(typeof(da.length)!="undefined"){
												 stra+="\""+da[k]+"\",";  
											 }else{
											     stra+="\""+k+"\":\""+da[k]+"\",";  
											 }
										 }
										 stra=stra.substr(0,stra.length-1);
										 if(typeof(da.length)!="undefined"){
											stra="["+stra+"]";
										 }else{
											stra="{"+stra+"}";
										 } 
									 }else{
											stra=da; 
									 };
									 return stra;
						};
						var log_ie_func=function(str,dat){
								
								mylog2019=document.getElementById("mylog2019");
								if(!mylog2019){
									var body=document.getElementsByTagName("body")[0]; 
									mylog2019=document.createElement("div");
									mylog2019.style.cssText="position:fixed;bottom:0px;left:0px;max-width:400px;width:100%; height:100px;overflow:auto;background-color:#fff;border:solid 1px #666;font-size:12px;";
									mylog2019.id="mylog2019";
									body.appendChild(mylog2019);
								};
								mylog2019.scrollTop=Math.max(mylog2019.scrollHeight,mylog2019.clientHeight);
								var o=document.createElement("div");
								var typ1=typeof(str),typ2=typeof(dat);
								if(typ1!="undefined"){
									str1=to_str_func(str);;
								};
								if(typ2!="undefined"){
									str2=to_str_func(dat);
								};
								if(str2!=""){str2="<br/>"+str2;}
								newstr=str1+str2;
								o.style.cssText="background-color:#f5f5f5;margin-bottom:5px;white-space:normal;word-wrap:break-word;padding-left:5px;padding-right:5px;";
								o.innerHTML=newstr;
								mylog2019.appendChild(o);
						};
						var log_func=function(str,dat){
							if(typeof(dat)!="undefined"){
								 console.log(str,dat);
							}else{
								 console.log(str);
							}
						};
						var islog=false;//
						var isbool=false;//测试时要开始
						if(typeof(window["islog"])!="undefined"){//判断是不是有这个全局显示log开关变量
						  islog=window["islog"];
						};
						if(typeof(window.console)!="undefined"){
							  if(isbool){
								  if(islog==true){
									 log_ie_func(str,dat);
								  }else{
									 log_func(str,dat);
								  }
							  }
						}else{
							  if(isbool){
								 log_ie_func(str,dat);
							  }
						};
			  },offset:function(Node) {//获取当前元素的坐标
							var offset = {};
							offset.top = 0;
							offset.left = 0;
							var this_=this;
							var index=0,left1,top1;
							var ua = navigator.userAgent; //取得浏览器的userAgent字符串
							var myOffset=function(Node){
									if (Node==document) {//当该节点为document节点时，结束递归
									   return ;
									};
									var position = this_.getStyleValue(Node,'position');
									//console.log(position);
									if(position=="static"){
											 if((ua.indexOf("MSIE 6.0")!=-1||ua.indexOf("MSIE 7.0")!=-1||ua.indexOf("MSIE 8.0")!=-1)&&index==0){//兼容处理ie 7
											     var newobj=document.createElement("div");
											     newobj.style.cssText="position:relative;width:0px;height:0px;overflow:hidden;background-color:#000;";
											     Node.parentNode.insertBefore(newobj,Node);//该元素之前插入一个元素
											     offset.top += newobj.offsetTop;
											     offset.left += newobj.offsetLeft;
												 myOffset(newobj.offsetParent); 
												 newobj.parentNode.removeChild(newobj);//再移除改元素
												 return;
											 }else{
												left1=parseInt(Node.offsetLeft);
											    offset.top += Node.offsetTop;
											    offset.left += left1;
												console.log("offsetleft",left1,Node.className,position);
											}
									}else if(position=="fixed"){//ie 6不支持
											 if((ua.indexOf("MSIE 6.0")!=-1)){
												 left1=parseInt(Node.offsetLeft);
												 top1=parseInt(Node.offsetTop);
												 offset.top += top1;
												 offset.left +=left1;
												 console.log("left",left1,Node.className,position);
											 }else{
												 top1=parseInt(this_.getStyleValue(Node,'top'));
												 left1=parseInt(this_.getStyleValue(Node,'left'));
											     offset.top += top1;
											     offset.left += left1;
												 console.log("fixedleft",left1,Node.className,position);
												 return false;
											 }
									}else if(position=="absolute"){
											left1=parseInt(this_.getStyleValue(Node,'left'));
											offset.top += parseInt(this_.getStyleValue(Node,'top'));
											offset.left +=left1;
											console.log("left",Node.className,position);
									}else if(position=="relative"){
										    left1=Node.offsetLeft
											offset.top += Node.offsetTop;
											offset.left += left1;
											console.log("offsetLeft",left1,Node.className,position);
									};
									index++;
									if(Node.offsetParent){
									  myOffset(Node.offsetParent);//现在的浏览器都开始转为offsetParent的如用parentNode当遇到table会出bug，如table实际的offsetLeft为0但是获取到的则是有值的
									}else{
									  myOffset(Node.parentNode);//向上累加offset里的值
									}
							};
							myOffset(Node);
							return offset;
			  },getStyleValue:function(obj,key){
					if(obj.currentStyle) {
						return obj.currentStyle[key];//IE、Opera
					} else {
						return window.getComputedStyle(obj)[key];//FF、chrome、safari
					}
			  },addEvent:function(obj,type,fn) {//添加事件
					if (obj.addEventListener){
						obj.addEventListener(type,fn,false);
					}else if (obj.attachEvent) {
						obj["e"+type+fn] = fn;
						obj.attachEvent( "on"+type, function(e) {
						obj["e"+type+fn].call(obj,window.event);
						});
					}
			 },removeEvent:function( obj, type, fn ) {//移除事件
					if (obj.removeEventListener){
						obj.removeEventListener(type,fn,false);
					}else if (obj.detachEvent) {
						obj.detachEvent("on" +type, obj["e"+type+fn] );
						obj["e"+type+fn] = null;
					}
			},getStyleJson:function(obj){
					var t=this;
					var width=parseInt(obj.offsetWidth);
					var height=parseInt(obj.offsetHeight);
					var bilv=width/height;
					var margin={left:parseInt(t.getStyleValue(obj,"margin-left")),right:parseInt(t.getStyleValue(obj,"margin-right")),top:parseInt(t.getStyleValue(obj,"margin-top")),bottom:parseInt(t.getStyleValue(obj,"margin-bottom"))};
					var padding={left:parseInt(t.getStyleValue(obj,"padding-left")),right:parseInt(t.getStyleValue(obj,"padding-right")),top:parseInt(t.getStyleValue(obj,"padding-top")),bottom:parseInt(t.getStyleValue(obj,"padding-bottom"))};
					var border={left:parseInt(t.getStyleValue(obj,"border-left-width")),right:parseInt(t.getStyleValue(obj,"border-right-width")),top:parseInt(t.getStyleValue(obj,"border-top-width")),bottom:parseInt(t.getStyleValue(obj,"border-bottom-width"))};
					return {bilv:bilv,margin:margin,padding:padding,border:border,width:width,height:height};
			  
			 },getStyleValue:function(obj,key){  //获取最终的样式值
					if (obj.style[key]){
						return obj.style[key];  
					}else if(obj.currentStyle){ 
						return obj.currentStyle[key]; 
					}else{
						//ff:它使用传统的"text-Align"风格的规则书写方式，而不是"textAlign" 
						key = key.replace(/([A-Z])/g,"-$1"); 
						key = key.toLowerCase(); 
						return document.defaultView.getComputedStyle(obj,null)[key]; //
					} 
	        },newrand:function(n){//产生N位随机数
					var rnd="";
					for(var i=0;i<n;i++){
						rnd+=Math.floor(Math.random()*10);
					};
					return rnd;
			}
	  };
			if(typeof(opt)!="undefined"){
				DragDrop_.init();
			};
		   return DragDrop_;
 };