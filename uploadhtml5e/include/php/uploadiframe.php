<?php
	if(!session_id()) session_start();	//初始化会话数据
	error_reporting(E_ALL & ~ E_NOTICE);
    include_once '../../../session.php';
	include("config.php");
	include("hcupload.class.php");
	$myupload=new hcupload($config);
	$cengci=$config["g_cengci"];
	date_default_timezone_set('PRC');//设成北京时间
	$gourl=CurUrl("");
	$w1=200;//小图宽度
	$quan=$_GET['quan'];
	$folder=$_GET['folder'];
	$bttext=$_GET['bttext'];
	$inputid=$_GET['inputid'];
	$quan=$_GET['quan'];
	$bgsrc=$_GET['bgsrc'];
	$bgsrc1=$_GET['bgsrc1'];
	$func=$_GET['func'];
	$inputmoreid=$_GET['inputmoreid'];
	$qzimg=$_GET['qzimg'];
	$textalign=$_GET['textalign'];
	$classname=$_GET['classname'];
	$btwidth=$_GET['btwidth'];
	$btfontsize=$_GET['btfontsize'];
	$btclassname=$_GET['btclassname'];
	$isduoxuan=$_GET['isduoxuan'];
	$inputtitleid=$_GET['inputtitleid'];
	$filename=trim($_GET['filename']);
	$small_hz_name=trim($_GET['small_hz_name']);
	$isnewsmall=trim($_GET['issmall']);
	if($isnewsmall==""){
		$isnewsmall=trim($_GET['isnewsmall']);
	}
	$isnewmid=trim($_GET['ismid']);
	if($isnewmid==""){
		$isnewmid=trim($_GET['isnewmid']);
	}
	$isnewsmall=intval($isnewsmall);
	$isnewmid=intval($isnewmid);
 
	//echo $small_hz_name;
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="target-densitydpi=medium-dpi,  initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<title>上传</title>
<script>

var folder="<?php echo $folder;?>";
var inputid="<?php echo $inputid;?>";
var quan="<?php echo $quan;?>";
var bgsrc="<?php echo $bgsrc;?>";
var bgsrc1="<?php echo $bgsrc1;?>";
var func="<?php echo $func;?>";
var inputmoreid="<?php echo $inputmoreid;?>";
var return1="<?php echo $return;?>";
var input=window.parent.document.getElementById(inputid);
var qzimg="<?php echo trim($_GET["qzimg"]);?>";
var textalign="<?php echo $textalign;?>";
var classname="<?php echo $classname;?>";
var bttext="<?php echo $bttext;?>";
var btwidth="<?php echo $btwidth;?>";
var btfontsize="<?php echo $btfontsize;?>";
var btclassname="<?php echo $btclassname;?>";
var isduoxuan="<?php echo $isduoxuan;?>";
var inputtitleid="<?php echo $inputtitleid;?>";
var isnewsmall="<?php echo $isnewsmall;?>";
var width="<?php echo trim($_GET["width"]);?>";
var height="<?php echo trim($_GET["height"]);?>";
var inputtitle=null;
var inputmore=null;
if(inputid!=""){input=window.parent.document.getElementById(inputid);}
if(inputmoreid!=""){inputmore=window.parent.document.getElementById(inputmoreid);}
if(inputtitleid!=""){inputtitle=window.parent.document.getElementById(inputtitleid);}
var isfirst=true;
function showImage(opt){ //返回值
	isfirst=opt.isfirst;
	if(func!=""){
		window.parent[func](opt);
	}else{
	   if(input!=null){
	     input.value=opt.small;
	   }
	   showOne(opt);   
	}

}
function showOne(opt){
	if(input!=null){
		var arr=inputid.split("_");
		var div1=window.parent.document.getElementById(inputid+"_div");
		if(div1!=null&&opt.path!=""){
			div1.innerHTML="<a href='"+qzimg+opt.small+"' target='_blank'><img src='"+qzimg+opt.small+"' style='height:30px;'/></a>";
		}
	}
}
function init(){
	if(input!=null){
		 if(func==""){
		        showImage({small:input.value,inputid:input.id,qzimg:qzimg});
		 }
     }
}
function Upload(){
	 var mysubmit=document.getElementById("mysubmit");
	 if(mysubmit.click){
		 mysubmit.click(); 
	 }
	 if(mysubmit.submit){
		 mysubmit.submit(); 
	 }
	 document.getElementById("upform1").submit(); 
}
function UpfileClick(){
	 document.getElementById("upfile").click(); 
}

</script>
<?php 
$upladurl='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
if($_SERVER['REQUEST_METHOD']=="POST"){
	$err_msg=array();
	foreach($_FILES as $key=>$val){
		$file=$_FILES[$key];
		if($file['size']>0){
			$res=$myupload->upload($file,1024*1024*200);
			if($res["status"]=="error"){
				$err_msg[]=$res["msg"];
			}else{
				 showImg($res);
			}
		}
	}
	if(count($err_msg)>0){
		$tishi=implode(",",$err_msg); 
		echo "<script>alert('".$tishi."');window.location='".$gourl."';</script>";
	}
}
function showImg($res){
	$res["isfirst"]=false;
	$res["inputid"]=$GLOBALS['inputid'];
	$res["qzimg"]=$GLOBALS['qzimg'];
	echo ("<script>showImage(".json_encode($res).");</script>");
}
function CurUrl($fen="") 
{
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") 
	{
		$pageURL .= "s";
	}
	$pageURL .= "://";
	$this_page = $_SERVER["REQUEST_URI"];
	if ($_SERVER["SERVER_PORT"] != "80"){
		$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $this_page;
	}else {
		$pageURL .= $_SERVER["SERVER_NAME"] . $this_page;
	}
	if($fen!=""){
		$arr=explode($fen,$pageURL);
		$pageURL=$arr[0];
	}
	return $pageURL;
}
?>
<style>
*{font-size:12px; cursor:pointer;}
html,body{ padding:0px;margin:0px; background-color:transparent; overflow:hidden;}
.bt_lable{
   border:0px;
		top:0px;height:23px; left:0px;
		position:absolute; z-index:5;
		background: #D0EEFF;
		border: 1px solid #99D3F5;
		border-radius: 4px;
		overflow: hidden;
		color: #1E88C7;
		text-decoration: none;
		line-height: 20px;
		height:100%;
		width:100%; 
		padding-top:4px;
		padding-bottom:4px;
		
	  
}
.bt_lable2{
		top:0px;height:23px; left:0px;
		position:absolute; z-index:5;
		background: #3399FF;
		border-radius: 0px;
		overflow: hidden;
		color: #ffffff;
		text-decoration: none;
		line-height: 20px;
		height:100%;
		width:100%; 
		padding-top:4px;
		padding-bottom:4px;
		 border:0px;
		 
}
.bt_lable2.hover{
	background:#33CCFF;
    color: #004974;
}
.bt_lable.hover{
	background: #AADFFD;
    color: #004974;
	border: 1px solid #99D3F5;
}
</style>
</head>
<body style="margin:0px; padding:0px; width:100%;overflow:hidden;" >
<div style=" position:relative;overflow:visible; width:100%;" id="mydiv">
<form  name="upform1" id="item1_upform1" enctype="multipart/form-data" method="post" action="<?php echo $gourl?>"  style="margin:0px; padding:0px; line-height:0px; border:0px;">
<input type="file" name="file1"  id="file1" accept="image/*" style="filter:alpha(Opacity=1);-moz-opacity:0.01;opacity:0.01; border:0px;left:0px; cursor:pointer; position:absolute; width:70px; height:60px; z-index:1000"/>
<input type="submit" name="btsend" id="btsend" value="&nbsp;" style=" left:0px; position:absolute; background-color:transparent; border:0px; z-index:20000; top:50px;"/>
<input type="hidden" name="gourl" value="<?php echo $gourl?>"/>
</form>
<input  type="button" id="bt_lable" value="提交"   style=" border:0px;top:0px; height:23px; left:0px; position:absolute; z-index:5;"/>
</div>
</body>
</html>
<script>
var ua = navigator.userAgent;
if(isfirst){
   init();
}
		var item1_upform1=document.getElementById("item1_upform1");
		
		var zindex=1000;
		var bt_lable=document.getElementById("bt_lable");
		if(bttext==""){
		bt_lable.value="点击上传";//『点击上传』的Unicode编码 http://tool.chinaz.com/tools/unicode.aspx
		}
		if(bttext=="1"){
		
		 bt_lable.value="\u4e0a\u4f20\u65b0\u7167\u7247";//上传新照片的Unicode编码 http://tool.chinaz.com/tools/unicode.aspx
		}
	    window.cheight=document.documentElement.clientHeight||document.body.clientHeight;//网页可见高度区
	    window.cwidth=document.documentElement.clientWidth||document.body.clientWidth;//网页可见宽度区
		
		
		
		if(window.cheight==0){
		  var timer=window.setInterval(function(){
			 window.cheight=document.documentElement.clientHeight||document.body.clientHeight;//网页可见高度区
			 window.cwidth=document.documentElement.clientWidth||document.body.clientWidth;//网页可见宽度区
			 
			 if(window.cheight>0){
			   window.clearInterval(timer);
			   tiaozheng();
			 }
		  },1000);
		}else{
		  tiaozheng();
        }
     if(window.attachEvent){
	  document.body.attachEvent('onscroll',function(){document.body.scrollTop=0;});
	}else{
	  document.body.addEventListener("scroll",function(){document.body.scrollTop=0;}, false );
	}
        function tiaozheng(){
				 var num=20;
				 var touch =("createTouch" in document);
				 var file1=document.getElementById("file1");
				 if(ua.indexOf("UCBrowser")!=-1&&touch){//手机uc浏览器
					 num=0;
					 file1.style.cssText="left:0px;cursor:pointer; position:absolute; width:"+(window.cwidth-4)+"px; height:"+(window.cheight-4)+"px; z-index:1000";
				 } 
				 
				 if(ua.indexOf("AppleWebKit")!=-1&&touch){//苹果
				   bt_lable.onclick=function(){
					    file1.click();
				    }
				    num=0;
				    file1.style.top="100px";  
				 }else if(ua.indexOf("MSIE 9")!=-1){

				     bt_lable.onclick=function(){
					    file1.click();
				    }
                 }
		 
				for(var i=0;i<num;i++){
								  var file=document.createElement("input");
								  zindex++;
								  file.type="file";
								  file.value="";
								  file.name="upfile_"+i;
								  file.id="upfile_"+i;
								  if(isduoxuan=="1"){
								   file.setAttribute("multiple","multiple");
								   }
								  file.setAttribute("accept","*");
								  var left=(-20)+(i%10)*30;
								  var top1=parseInt(i/10)*20;
								  file.style.cssText="filter:alpha(Opacity=1);-moz-opacity:0.01;opacity:0.01; border:0px; left:"+left+"px; cursor:pointer; position:absolute;top:"+top1+"px;width:100%; height:70px; z-index:"+zindex+";";
								  file.onchange=function(){ 
								    bt_lable.value="\u6b63\u5728\u4e0a\u4f20";//正在上传的Unicode编码 http://tool.chinaz.com/tools/unicode.aspx
								    document.forms[0].enctype="multipart/form-data";
								    document.getElementById("btsend").click();
									   // document.getElementById("item1_upform1").submit();
									};
								 item1_upform1.appendChild(file);
								// window.setTimeout(function(){alert(44);document.getElementById("item1_upform1").submit();},6000);
								 
				}
		
				 var btsend=document.getElementById("btsend");
				 var file1=document.getElementById("file1");
				 file1.onchange=function(){
						// bt_lable.value="正在上传请稍后";
						 bt_lable.value="\u6b63\u5728\u4e0a\u4f20";//正在上传的Unicode编码 http://tool.chinaz.com/tools/unicode.aspx
					   //document.forms[0].enctype="multipart/form-data";
					   document.getElementById("btsend").click();
					   file1.style.display="none";
					   
				 }
		
		
				var body=document.getElementsByTagName("body")[0];
				
				
		
				body.style.height=window.cheight+"px";
				body.style.width=window.cwidth+"px";
				bt_lable.style.width=window.cwidth+"px";
				bt_lable.style.height=window.cheight+"px";
				bt_lable.style.lineHeight=window.cheight-8+"px";
				if(btfontsize!=""){
					bt_lable.style.fontSize=btfontsize+"px";
				}
				bt_lable_class="bt_lable";
				if(btclassname!=""){
				  bt_lable_class=btclassname;
				  
				}
				
				if(bgsrc!=""){
					bt_lable.style.border="none";
					bt_lable.style.textIndent="-300px";
					bt_lable.style.overflow="hidden";
					bt_lable.style.background="url('"+bgsrc+"') center center no-repeat";
				}
				if(bgsrc!=""&&bgsrc1!=""){
					body.onmouseover=function(){
					   bt_lable.style.backgroundImage="url('"+bgsrc1+"')";	
					}
					body.onmouseout=function(){
						bt_lable.style.backgroundImage="url('"+bgsrc+"')";	
					}
				}else{
				  
		
					 bt_lable.className=bt_lable_class;
					body.onmouseover=function(){
						bt_lable.className=bt_lable_class+" hover";
					}
					body.onmouseout=function(){
						 bt_lable.className=bt_lable_class;
					}
		
				}
		}
</script>

