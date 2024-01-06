function sendfile:function(opt){//上传文件
 
			            var t=this,file=opt.file,reader=new FileReader(),stop_old = 0;
						var start = 0,stop = 0,cur_size=0,myitem=opt.myitem,ext="";
						var ajax_url=t.opt.url;
						var title=file.name;//文件名
						var type=file.type,cur_size=0,limit=1;
						var name = file.name,        //文件名
						size = file.size,        //总大小
						shardSize = t.conf.fdsize,//分片长度
						itemid=myitem.id;
						var shardCount=0;
					    //var tmpid=t.RndNum(8);//id标识
						var tmpid=itemid; 
		 
						if(t.conf.fdsize==0){
							shardCount=1; 
							shardSize=file.size;
						};
							var arr=file.name.split(".");
							if(typeof(opt.ext)=="undefined"){
								if(arr.length>1){
									 ext=arr[arr.length-1].toLowerCase();
								}
							}else{
								ext=opt.ext;
							};
						shardCount = Math.ceil(size / shardSize);  //总片数
						if(typeof(ajax_url)=="undefined"||ajax_url==""){
							 cur_size=file.size;
							 myitem.setAttribute("iscx",0);
							 myitem.setAttribute("mystatus","success");
							 myitem.setAttribute("myuploadsize",file.size);
							 t.update({t:t,myitem:myitem});
						     t.UploadProgress({myitem:myitem,ext:ext,success_size:file.size,file_size:file.size,file:file});
							 if(typeof(t.upload_progress)!="undefined"){
								   t.upload_progress({myitem:myitem,ext:ext,success_size:file.size,file_size:file.size,file:file});
							 };
							 return false;
						};
						var iscx=opt.myitem.getAttribute("iscx");
						var upload_id="";
						var upload_path="";
						var rel_img=t.GetObjByClass(myitem,"rel_img");
						var imga=myitem.getElementsByTagName("img");
						// alert("size:"+typeof(file.size));
						if(typeof(t.upload_start)!="undefined"){
							  var sta=t.upload_start({myitem:myitem});
							  if(typeof(sta)!="undefined"&&sta==false){
								   return false;
							  }
						};
						if(imga.length<1&&rel_img){
							
							  rel_img.innerHTML="<img src='"+t.GetExtSrc(g_exts,opt.ext)+"'  style='height:100%'/>"; 
						};
						

                        myitem.setAttribute("mystatus","upload");
						myitem.setAttribute("mysize",file.size);
						
						var keyname=(file.name);
						if(typeof(md5)!="undefined"){
							 keyname=md5(keyname+String(size));
						}else{
							 keyname=keyname.replace(/-/g,"");
							 keyname=keyname.replace(/=/g,"");
							 keyname=keyname.replace(/,/g,"");
							 keyname=keyname.replace(/./g,"");
							 keyname=keyname.replace(/:/g,"");
							 keyname=keyname.replace(/;/g,"");
							 keyname=keyname.replace(/；/g,"");
							 keyname=keyname.replace(/，/g,"");
							 keyname=keyname+String(size);
						};
						var oldtmpid="";
						var oldindex=-1;
						//alert(keyname);
						if(typeof(hc_cookie)!="undefined"&&typeof(t.opt.isduandianxuchuan)!="undefined"&&t.opt.isduandianxuchuan==1){
							       oldtmpid=tmpid;
						           var u=decodeURI(hc_cookie.Get(keyname));
								   if(u!=""){
									     var arr=String(u).split("||");
										 if(arr.length>1){
											   oldtmpid=arr[0];
											   oldindex=parseInt(arr[1]);
										 }else{
											   oldindex=parseInt(u);
										 }
								   };
						};

						var sendPost=function(op){
						
							// try{
									if(op.i >= shardCount){
										//alert(shardCount);
										return;
									};
									if(!document.getElementById(itemid)){
										return false;
									};

									//计算每一片的起始与结束位置
									var start = op.i * shardSize,end = Math.min(size, start + shardSize);
									myitem.setAttribute("myuploadsize",end);
								 
									
									//构造一个表单，FormData是HTML5新增的
									if(myitem.getAttribute("mystarttime")==null||typeof(myitem.getAttribute("mystarttime"))=="undefined"){
									  myitem.setAttribute("mystarttime",Date.parse(new Date()));
									};
									
									var index=op.i + 1;
									if(ajax_url.indexOf("act")==-1){
										 if(ajax_url.indexOf("?")==-1){
										    // ajax_url+="?act=up";
										 }else{
											// ajax_url+="&act=up";
										 }
									};
									var url1=ajax_url,urlarr=ajax_url.split("."),urlfilehz="",myform = new FormData(),contentType=false,processData=false,blob;
									
									var arr_shard=t.getshardfile(op.i,file,shardCount,shardSize);
									
									blob=arr_shard.file;
									
									filetype=file.type;
									if(filetype==""){
									 for(var k1 in g_exts){
                                            if(g_exts[k1].ext==ext){
                                            	filetype=g_exts[k1].contenttype;
                                            }
									  }
								     };
									// alert("lastModified:"+typeof(file.lastModified));
									
									if(typeof(t.posts[myitem.id])=="undefined"){
										t.posts[myitem.id]={};
									};	
								
									if(typeof(file.lastModified)!="undefined"){
									   	 t.posts[myitem.id]["lastModified"]=file.lastModified;//获取日期
									     t.posts[myitem.id]["lastModifiedDate"]=t.date_format(file.lastModified,"yyyy-MM-dd hh:mm:ss");//获取日期
									};
						 
									t.posts[myitem.id]["title"]=t.my_encodeURI(file.name);
									t.posts[myitem.id]["filetype"]=(file.type);
									t.posts[myitem.id]["size"]=file.size;
									t.posts[myitem.id]["ext"]=ext;
									t.posts[myitem.id]["tmpid"]=tmpid;
									//myform.append("title", t.my_encodeURI(file.name));
									//myform.append("filetype",(file.type));
									//myform.append("size",(file.size));
									//myform.append("ext", ext);
									
									 //  myform.append("tmpid", tmpid);
									
									if(oldtmpid!=""){
									t.posts[myitem.id]["oldtmpid"]=oldtmpid;
									};
									t.posts[myitem.id]["total"]=shardCount; //总片数
									t.posts[myitem.id]["index"]=index; //当前是第几片
									//t.posts[op.myitem.id]["limit"]=limit
									  if(upload_id!=""){
									    t.posts[myitem.id]["upload_id"]=upload_id;
									  };
									  if(upload_path!=""){
									     t.posts[myitem.id]["upload_path"]=upload_path;
									  };
									  
									 
									      
									//068986
									if(t.conf.isnewsmall!=0){
										   t.posts[myitem.id]["isnewsmall"]=t.conf.isnewsmall;
									};
									if(t.conf.isnewsmall==1&&typeof(opt.smallbase64)!="undefined"&&index==1){//&&(urlfilehz=="asp")
										t.posts[myitem.id]["smallbase64"]=opt.smallbase64;
									}else{
										t.posts[myitem.id]["smallbase64"]="";
									};
									if(typeof(hc_cookie)!="undefined"&&typeof(t.opt.isduandianxuchuan)!="undefined"&&t.opt.isduandianxuchuan==1){
										t.posts[myitem.id]["isduandianxuchuan"]=t.opt.isduandianxuchuan;
									};

	

									var post={};
									if(typeof(t.post)!="undefined"){
										post=t.post;
									};
									var row={};
								    for(var k in myitem.attributes){
									   var name=String(myitem.attributes[k].name);
									   if(name.indexOf("data-")!=-1){
										   var arr=name.split("data-");
										   if(arr.length>1){
												   row[arr[1]]=String(myitem.attributes[k].value);
										   }
									   }
								    };
									 t.posts[myitem.id]["row"]=JSON.stringify(row);//之前旧数据按json字符串原样发给服务器
									 
									if(typeof(post)!="undefined"){
										 for(var k in post){
												 t.posts[myitem.id][k]=post[k];
										 }
									};

									if(typeof(t.opt.isyuanming)!="undefined"){
										myform.append("isyuanming", t.opt.isyuanming);
									};
									
									if(typeof(t.opt.bitian)!="undefined"){
										for(var key in t.opt.bitian){
											 var ite=t.opt.bitian[key],obj=t.getobj({id:ite.id}),val="";
											 if(obj){
												  var val=t.get_obj_value({obj:obj});
												  t.posts[myitem.id][ite.id]=val;
											 }
										}
									};
									//console.log("op.i",t.posts_other);
								 
									t.posts[myitem.id]["file"] =blob;
									
										if(typeof(t.posts_other[myitem.id])!="undefined"){
											
											   for(var k1 in t.posts_other[myitem.id]){
												   if(k1.indexOf("base64")!=-1){
													   if(op.i==0){
														 t.posts[myitem.id][k1]=t.posts_other[myitem.id][k1];
													   }else{
														 t.posts[myitem.id][k1]="";    
													   }
												   }else if(k1.indexOf("file")!=-1&&k1.length>4){
													     var ofile=t.posts_other[myitem.id][k1];
														 var oshardsize=Math.round(ofile.size/shardCount);
														 //oshardsize+=(ofile.size%shardCount);
                                                         var arr_shard=t.getshardfile(op.i,ofile,shardCount,oshardsize); 
														 t.posts[myitem.id][k1]=arr_shard.file;  
												   }
												   
											   }
										};
									 

									var myposts={};
									

					 
								    if(typeof(t.upload_before)!="undefined"){
										t.upload_before({myitem:myitem,file:file});
									};
								    if(typeof(opt.data)!="undefined"){
									  for(var k1 in opt.data){
										    myform.append(k1,opt.data[k1]);
									  }
								    };

									cur_size=(op.i+1)*shardSize;
									if(cur_size>file.size){cur_size =file.size;};
									 //ajax提交
									t.ajax({
										url: url1,
										type: "POST",
										data: myform,
										async: true,        //异步
										dataType: "html",
										processData: processData,  //很重要，告诉jquery不要对form进行处理
										contentType: contentType,  //很重要，指定为false才能形成正确的Content-Type
										success: function(result){
											     var cur_i=op.i;
												  if(result.length==0) {
													   result="";
	
													};
                                                  if(typeof(t.upload_success_log)!="undefined"){
													   t.upload_success_log({i:op.i,result:result});  
												   };
												 var i=op.i+1;
												  
												   if(i>shardCount){
														 return false;
													};
													var isoss=false;
													if(typeof(t.opt.isoss)!="undefined"&&t.opt.isoss==1){
														isoss=true;
													};
													if(isoss){
														 t.UploadProgress({myitem:myitem,success_size:cur_size,file_size:file.size,file:file});
														 
														// sendPost({i:i});
														// alert((i+1));
														console.log(result);
														console.log(i+":"+shardCount);
														  if(typeof(myitem.getAttribute("oss-result"))!="undefined"){
															   result=myitem.getAttribute("oss-result")  ; 
														  };
														 if((i)==shardCount){
																	cur_size=file.size;
																	myitem.setAttribute("iscx",0);
																	myitem.setAttribute("mystatus","success");
																	myitem.setAttribute("myuploadsize",file.size);
																	t.update({t:t,myitem:myitem});
																	
																	t.UploadProgress({myitem:myitem,ext:ext,result:result,success_size:file.size,file_size:file.size,file:file});
																	t.UploadSuccess({myitem:myitem,ext:ext,result:result,size:file.size,keyname:keyname,file:file});

																	if(typeof(myitem.id)!="undefined"){t.removeFile(myitem.id);}
														 };
														 

														 return false;
													};
													if(!isoss){

														 var json1=eval("("+result+")");
														 
														 if(typeof(json1.upload_id)!="undefined"&&json1.upload_id!=""){
															upload_id=json1.upload_id;
														 };
														 if(typeof(json1.upload_path)!="undefined"&&json1.upload_path!=""){
															upload_path=json1.upload_path;
														 };
														 
														if (typeof(json1.status)!="undefined"){
														if (json1.status=="dengdai") {
															   var i2=i;
															   if(typeof(json1.index)!="undefined"&&(json1.index==json1.total||json1.index==json1.num)){
																     if(typeof(hc_cookie)!="undefined"){hc_cookie.Del(keyname);}
																	 i2=0;
																	 cur_size=0;
																	 t.UploadProgress({myitem:myitem,success_size:0,file_size:file.size,file:file});
															   }else{
																      if(typeof(hc_cookie)!="undefined"&&index>oldindex){
																	        hc_cookie.Add((keyname),t.my_encodeURI(oldtmpid+"||"+index));
																	  };
																	  i2=i;
															   };
															    cur_i=i2;
																t.UploadProgress({myitem:myitem,success_size:cur_size,file_size:file.size,file:file});
																sendPost({i:i2});
														}else if (json1.status=="success") {
															    cur_size=file.size;
													            myitem.setAttribute("iscx",0);
														        myitem.setAttribute("mystatus","success");
																myitem.setAttribute("myuploadsize",file.size);
																t.update({t:t,myitem:myitem});
															    t.UploadProgress({myitem:myitem,ext:ext,result:result,success_size:file.size,file_size:file.size,file:file});
															    t.UploadSuccess({myitem:myitem,ext:ext,result:result,size:file.size,keyname:keyname,file:file});
															    if(typeof(myitem.id)!="undefined"){t.removeFile(myitem.id);}

														}else if (json1.status=="error") {
																if(typeof(myitem.id)!="undefined"){t.removeFile(myitem.id);};
																 t.NewFileBar({myitem:myitem,success_size:100,file_size:100});
																var rel_bt=t.GetObjByClass(myitem,"rel_bt");
																 if(rel_bt){
																	 rel_bt.style.display="";
																	 rel_bt.setAttribute("isalert",0);
																	 rel_bt.click();
																 };
																  var rel_see=t.GetObjByClass(myitem,"rel_see");
																 if(rel_see){
																  rel_see.style.display="none";
																 }
																 t.error_tishi(myitem);
																 if(typeof(t.error_huidiao)!="undefined"){t.error_huidiao({myitem:myitem,item1:myitem,msg:msg,result:result});};//失败的回调
																 t.ShowYuanSu({myitem:myitem,conf:t.error_show});
																 t.myalert(json1.msg);
														} else {
																if(typeof(myitem.id)!="undefined"){t.removeFile(myitem.id);}
																if(typeof(hc_cookie)!="undefined"){cookie.Del(keyname);}
																//t.log("try Error:\n" + result);
																myitem.setAttribute("mystatus","error");
																//alert("文件块上传失败，请重新上传文件!");
																t.error_tishi(myitem);
																var msg="后端出错";
																myitem.setAttribute("mystatus","error");
															   var rel_baifenbi=t.GetObjByClass(myitem,"rel_baifenbi");
															   if(rel_baifenbi){rel_baifenbi.innerHTML="<span class='hc_error'>上传失败</span>";};
															   t.ShowYuanSu({myitem:myitem,conf:t.error_show});
															   if(typeof(t.error_huidiao)!="undefined"){t.error_huidiao({myitem:myitem,item1:myitem,msg:msg,result:result});};//失败的回调
															   if(typeof(t.error)!="undefined"){t.error({myitem:myitem,item1:myitem,msg:msg,result:result});};//失败的回调
															   };
															   var n1=t.getstatuscount("dengdai");
															   var n2=t.getstatuscount("upload");
															   if(n1+n2==0){
																 t.curgroupindex++;
															   }
														}
														if(typeof(t.upload_progress)!="undefined"){
															t.upload_progress({index:cur_i,total:shardCount,myitem:myitem,success_size:loaded,file_size:cur_size,file:file});
														}

													   
													}
													 
													  
										},error:function(xhr, status, responseText){
                                           //这里不能加这句if(typeof(hc_cookie)!="undefined"){hc_cookie.De(file.name);}，因为如你点浏览器上的刷新按钮，他会执行这句的，加的cookie里的值会被清掉
											      t.error_tishi(myitem);
												  var msg="网络不好";
												  myitem.setAttribute("mystatus","error");
                                                  if(typeof(t.upload_error_log)!="undefined"){
													   t.upload_error_log({xhr:xhr,status:status,responseText:responseText});  
												   };
											     t.ShowYuanSu({myitem:myitem,conf:t.error_show});
											     var rel_baifenbi=t.GetObjByClass(myitem,"rel_baifenbi");
												// if(rel_baifenbi){rel_baifenbi.innerHTML="<span class='hc_error'>上传失败</span>";};
											     if(typeof(t.error_huidiao)!="undefined"){t.error_huidiao({index:opt.i,total:shardCount,myitem:myitem,item1:myitem,msg:msg,xhr:xhr,xhr_status:status});};//失败的回调
											     if(typeof(t.error)!="undefined"){t.error({index:opt.i,total:shardCount,myitem:myitem,item1:myitem,msg:msg,xhr:xhr,xhr_status:status});};//失败的回调
												 if(typeof(t.upload_error)!="undefined"){t.upload_error({index:opt.i,total:shardCount,myitem:myitem,item1:myitem,msg:msg,xhr:xhr,xhr_status:status});};//失败的回调
										 },beforeSend: function(xhr) {
                                               // 发送ajax请求之前向http的head里面加入验证信息
                                               //xhr.setRequestHeader("token", "555555555555"); // 请求发起前在头部附加token
											   if(typeof(t.upload_beforeSend)!="undefined"){
												   t.upload_beforeSend(xhr);
											   }
                                         },progress:function(e){
											           // console.log(e);
											            if(t.conf.fdsize==0){
												               var total= e.total;
														       var loaded= e.loaded;
														       var bf = Math.round(e.loaded / e.total * 100);
															   t.UploadProgress({myitem:myitem,success_size:loaded,file_size:total,file:file});
															   if(typeof(t.upload_progress)!="undefined"){
																   t.upload_progress({myitem:myitem,success_size:loaded,file_size:total,file:file});
															   }
														}

										 },complete:function(xhr,status,responseText){
											 if(typeof(t.upload_complete)!="undefined"){
												 t.upload_complete({xhr:xhr,status:status,responseText:responseText,myitem:myitem,item1:myitem});
											 }
											 if(typeof(t.upload_complete_log)!="undefined"){
												  t.upload_complete_log({xhr:xhr,status:status,responseText:responseText,myitemid:myitem.id});
											 }
										 }
									});
								// }catch(err){
								  //alert(err.stack+","+err.message);
								//}
						};
						var myi=0;
						//cookie.Add(escape("中中"),55);
						//cookie.Clear();
						//if(typeof(cookie)!="undefined"){cookie.Del(escape(file.name));}
						 if(oldindex>-1){
							  myi=parseInt(oldindex)-1;
							  cur_size= parseInt(oldindex) * shardSize;  
							  myitem.setAttribute("success_size_init",cur_size);
						 };
						 t.ShowYuanSu({myitem:myitem,conf:t.upload_show});
					    myitem.setAttribute("mystatus","upload");
						if(t.conf.fdsize==0){
							sendPost({i:0});
						}else{
						    sendPost({i:myi});
						}
}