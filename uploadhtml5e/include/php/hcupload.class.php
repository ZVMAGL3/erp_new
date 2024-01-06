<?php
//'OSS:https://www.sypopo.com/post/MxrA3623ok/
class hcupload{

public $config=array();

public function __construct($config){

	 $this->setconfig($config);

}

public function setconfig($config){
		$this->config=$config;
}

public function save_base64($cengci){
	$base64=trim($_REQUEST["base64"]);
	$base64=str_ireplace("[jh]","+",$base64);
	$arr=explode(";base64,",$base64);
	if(count($arr)>1){
	  $base64=$arr[1];
	}
	$ext=trim($_REQUEST["ext"]);
	$is_upload=false;
	if($ext=="bmp" || $ext=="jpg" || $ext=="png" || $ext=="gif"|| $ext=="jpeg"){
	 $is_upload=true;
	}
	if($is_upload==false){
	   echo ("{status:\"error\",msg:\"后端不允许上传.".$ext."文件\"}");
	   exit();
	}
	
	$time=time();
	$newname ="img".date("YmdHis", $time)."sj".$this->$this->NewRand(4);
	if(isset($_POST["newname"])){
	$newname=trim($_POST["newname"]);
	}
	$bigsrc=$this->config["g_dir4"].$newname.".".$ext;
	$big_fullpath=$cengci.$bigsrc;
	if($base64!=""){
	  $this->SaveBase64($big_fullpath,$base64);
	  echo("{status:\"success\",path:\"".$bigsrc."\"}");
	}
	exit();
}
public function up($cengci){//上传文件
	$size = $_POST["size"];//总文件大小
	// $end = $_POST["end"];
	// $beg = $_POST["beg"];
	$title = isset($_POST["title"]) ? trim($_POST["title"]) : '';
	$isyuanming = isset($_POST["isyuanming"]) ? $_POST["isyuanming"] : '';
	$title = urldecode($title);
	$file = isset($_FILES["file"]) ? $_FILES["file"] : null;
	$tmpid = isset($_POST["tmpid"]) ? trim($_POST["tmpid"]) : '';
	$value = isset($_POST["value"]) ? trim($_POST["value"]) : '';
	$value = str_ireplace("[jh]", "+", $value);
	$index = isset($_POST["index"]) ? trim($_POST["index"]) : '';
	$ext = isset($_POST["ext"]) ? trim($_POST["ext"]) : '';
	// $num = isset($_POST["num"]) ? intval($_POST["num"]) : '';
	$newname = isset($_POST["newname"]) ? trim($_POST["newname"]) : '';
	$newpath = isset($_POST["newpath"]) ? trim($_POST["newpath"]) : '';
	$folder = isset($_POST["folder"]) ? trim($_POST["folder"]) : '';
	$oldtmpid = isset($_POST["oldtmpid"]) ? trim($_POST["oldtmpid"]) : '';
	$smallbase64 = isset($_POST["smallbase64"]) ? trim($_POST["smallbase64"]) : '';
	$isnewmid = isset($_POST["isnewmid"]) ? trim($_POST["isnewmid"]) : '';
	// $isduandianxuchuan = isset($_POST["isduandianxuchuan"]) ? trim($_POST["isduandianxuchuan"]) : '';
	$filetype = isset($_POST["filetype"]) ? trim($_POST["filetype"]) : '';
	$lastModified = isset($_POST["lastModified"]) ? trim($_POST["lastModified"]) : '';
	
	$newbigpath = isset($_POST["newbigpath"]) ? trim($_POST["newbigpath"]) : '';
	$newmidpath = isset($_POST["newmidpath"]) ? trim($_POST["newmidpath"]) : '';
	$newsmallpath = isset($_POST["newsmallpath"]) ? trim($_POST["newsmallpath"]) : '';
	$istmp = isset($_POST["istmp"]) ? trim($_POST["istmp"]) : '';
	$isnewbig = isset($_POST["isnewbig"]) ? intval(trim($_POST["isnewbig"])) : 0;
	
 
	if(isset($_POST["index"])){
		$index=intval($_POST["index"]);
		$total=intval($_POST["total"]);
	}else if(isset($_POST["chunk"])!=""){
		if(trim($_POST["chunk"])!=""){
			$index=intval($_POST["chunk"])+1;
			$total=intval($_POST["chunks"]);
		}else{
			$index=1;
			$total=1;
		}
	}else{
		$index=1;
		$total=1;
	}
	
	// $filename=trim($_REQUEST["filename"]);
	$not_extstr="php,asp,jsp,aspx,ashx,py,java,exe,js";//限制这类文件后缀上传
	$not_exts=explode(",",$not_extstr);
	$isupload=true;
	if(in_array(strtolower($ext),$not_exts)){
		$isupload=false;
	}
	if(!$isupload){
		return json_decode("{\"status\":\"error\",\"msg\":\"后端程序不允许上传.".$ext."文件\"}",true);
	}
	$isnewsmall=trim($_REQUEST["isnewsmall"]);
	if($title!=""){
	// $tmpid=md5($title.$size.$ext);
	};
	if($oldtmpid!=""){
		$tmpid=$oldtmpid;
	}  

		$ext1="";
		if($newbigpath!=""){
			$this->config["g_dir4"]=dirname($newbigpath)."/";
			$arr=explode("/",$newbigpath);
			$name_a=$arr[count($arr)-1];
			$arr1=explode(".",$name_a);
			if(count($arr1)>1){
				$ext1=$arr1[count($arr1)-1];
				$newname=str_replace(".".$ext,"",$name_a);
			}
			$this->config["g_dir_other"]=$this->config["g_dir3"]=$this->config["g_dir4"];
		};
		if($ext1!=""&&in_array(strtolower($ext1),$not_exts)){
		   return json_decode("{\"status\":\"error\",\"msg\":\"后端程序不允许上传.".$ext."文件\"}",true);
		}
		$ext2="";
		if($newsmallpath!=""){
			$dir1=dirname($newsmallpath)."/";
			$arr=explode("/",$newsmallpath);
			$name_a=$arr[count($arr)-1];
			$arr1=explode(".",$name_a);
			if(count($arr1)>1){
				$ext2=$arr1[count($arr1)-1];
			}
			$this->config["g_dir1"]=$dir1;
		};
		if($ext2!=""&&in_array(strtolower($ext2),$not_exts)){
		   return json_decode("{\"status\":\"error\",\"msg\":\"后端程序不允许上传.".$ext."文件\"}",true);
		}
		$ext3="";
		if($newmidpath!=""){
			$dir3=dirname($newmidpath)."/";
			$arr=explode("/",$newmidpath);
			$name_a=$arr[count($arr)-1];
			$arr1=explode(".",$name_a);
			if(count($arr1)>1){
				$ext3=$arr1[count($arr1)-1];
			}
			$this->config["g_dir3"]=$dir3;
		};
		
		if($ext3!=""&&in_array(strtolower($ext3),$not_exts)){
		   return json_decode("{\"status\":\"error\",\"msg\":\"后端程序不允许上传.".$ext."文件\"}",true);
		}		
	$tmpdir=$cengci."tmp/".$tmpid."/";
	$tmpid=str_ireplace("./","",$tmpid);//一定要过滤掉
	$tmpid=str_ireplace("../","",$tmpid);//一定要过滤掉
	$tmpid=str_ireplace("..//","",$tmpid);//一定要过滤掉
	
	$tmppath_index_mid = $tmpdir.$index."_mid.tmp"  ; 
	
	$tmpfullpath_mid=  $tmpdir. $tmpid."_mid.bao"  ;
	
	$tmppath_index_small=  $tmpdir. $index."_small.tmp"  ;
	
	$tmpfullpath_small= $tmpdir. $tmpid."_small.bao" ;  
	
	if(trim($tmpid)==""){
		return json_decode("{\"status\":\"error\",\"msg\":\"tmpid不能为空.\"}",true);
	}
	 $this->CreateDir($tmpdir); 
	//--------结束保存临时文件  
	$issmall=0;
	$ismid=0;
	if($isnewsmall==1){
		$issmall=1;
		$ismid=0;
	}
	$ismid=intval($isnewmid);
	$isbig=$isnewbig;

	$smallbase64path=$tmpdir."/".$tmpid.".small" ; //小图的base64编码
	if($index==1&&$smallbase64<>""&&$issmall==1){
	     $arr12=explode("base64,",$smallbase64);
		 if(count($arr12)==2){
			$smallbase64=$arr12[1];
		 } 
		$smallbase64 = str_ireplace("[jh]", "+", $smallbase64);
		$smallbase64 = str_ireplace(" ", "+",$smallbase64);
		file_put_contents($smallbase64path,$smallbase64);
	}
			
	$tmp_index_full =  $tmpdir.$index.".tmp";
	// $data=trim($_REQUEST["data"]);
	if (!empty($_FILES)) { //以文件形式发过来的
		$file=$_FILES["file"];
		if(!is_file($tmp_index_full)){
			move_uploaded_file($file["tmp_name"],$tmp_index_full);
		}else{
			if($index!=$total){
				return json_decode("{\"status\":\"dengdai\",\"index\":\"$index\",\"total\":\"$total\",\"msg\":\"已存在\"}",true);
			}
		}
	}else{       //以二进制流
		if (!$out = @fopen($tmp_index_full, "wb")) {
			return json_decode('{"status":"error","msg":"Cannot open file","error" : {"code": 102, "message": "Cannot open file"}}',true);
		}
		if (!$in = @fopen("php://input", "rb")) {
			return json_decode('{"status":"error","msg":"Failed to open input stream.","error" : {"code": 101, "message": "Failed to open input stream."}}',true);
		}
		while ($buff = fread($in, 4096)) {
			fwrite($out, $buff);
		}
		@fclose($out);
		@fclose($in);
	}


	if(filesize($tmp_index_full)==0){//没有提交文件
		return json_decode('{"status":"error","msg":"not stream.","error" : {"code": 103, "message": "not stream."}}',true);
	}
	
	$midfile=isset($_FILES["midfile"])?$_FILES["midfile"]:null;
	if($midfile){
		move_uploaded_file($midfile["tmp_name"],$tmppath_index_mid);
	}
	
	$smallfile=isset($_FILES["smallfile"])?$_FILES["smallfile"]:null;
	if($smallfile){
		move_uploaded_file($smallfile["tmp_name"],$tmppath_index_small);
		$smallbase64="";
	}


			
   
	   //exit();
	$istype=1;
	$uploadfile=$tmpdir.$tmpid.".bao";	
	if($istype==1){
		$uploadfile=$tmpdir.$tmpid.".bao";		
		if($index==1&&is_file($uploadfile)){
			@unlink($uploadfile);
		};
		$datastr="";
		$fo = fopen($uploadfile,"a");
		$datastr =file_get_contents($tmp_index_full);
		//file_put_contents("test.txt", "This is another something.", FILE_APPEND)
		fwrite($fo,$datastr);//写入文件中
		fclose($fo);
	};
	if($index!=$total){
		return json_decode("{\"status\":\"dengdai\",\"$tmpid\":\"$index\",\"index\":\"$index\",\"total\":\"$total\",\"msg\":\"$index"."分段上传成功\"}",true);
	}
	$isbool=1;
	for($i=1;$i<=$total;$i++){
		$tmp_path = $tmpdir.$i.".tmp";
		if (!file_exists($tmp_path)) {
		$isbool=0;
		}
	}
		
//		if($beg == 0){
//			$filename = tempnam("tmp", "FOO");//tempnam函数生成一个FOO开头的唯一的文件名
//			$_SESSION["filename"] = $filename;
//		}else{
//			$filename = $_SESSION["filename"];
//		}


	if($isbool==1&&$total>0){
		//unset($_SESSION["filename"]);
		//chmod($filename, 0755);
		if($istype==2){
			$uploadfile=$tmpdir.$tmpid.".bao";				
			if(is_file($uploadfile)){
				@unlink($uploadfile);
			}
			$uploadfile=$this->savetmpbao($total,$tmpdir,"",$uploadfile,$istype);
		}
		//tmpfullpath=$this->savetmpbao($total,$tmpdir,"",$tmpfullpath)
		
		
		if(isset($_FILES["smallfile"])){
			$tmpfullpath_small=$this->savetmpbao($total,$tmpdir,"_small",$tmpfullpath_small);
			$issmall=1;
		}
		
		if(isset($_FILES["midfile"])){
			$tmpfullpath_mid=$this->savetmpbao($total,$tmpdir,"_mid",$tmpfullpath_mid);
			$ismid=1;
		}
		
		$time=time();
		$date=date("Y-m-d H:i:s",$time);
		
		if($isyuanming==""){
			$isyuanming=$this->config["g_is_yuanming"];
		}
		if($newname==""){
			if($ext=="bmp" || $ext=="jpg" || $ext=="png" || $ext=="gif"|| $ext=="jpeg"){
			$newname ="".date("Ymd", $time)."sj".$this->NewRand(6);
			}else{
			$newname ="".date("Ymd", $time)."sj".$this->NewRand(6);
			}
		};
		if($isyuanming&&$newname==""){
			$newname=trim($title);
		};
		
		$newname = str_ireplace(" ","",$newname);//去掉空格
		$newname = str_ireplace(".".$ext,"",$newname);//去掉空格
		
		$this->config["g_dir1"].=date("Ymd",$time)."/";
		$this->config["g_dir2"].=date("Ymd",$time)."/";
		$this->config["g_dir3"].=date("Ymd",$time)."/";
		$this->config["g_dir4"].=date("Ymd",$time)."/";
		$this->config["g_dir_other"].=date("Ymd",$time)."/";
		$newdir=str_replace("../","",'');
		if($newdir!=""){
			$this->config["g_dir4"]=$newdir;
			$this->config["g_dir_other"]=$this->config["g_dir1"]=$this->config["g_dir2"]=$this->config["g_dir3"]=$this->config["g_dir4"];
		}
 
		if($newpath!=""){
			$this->config["g_dir4"]=dirname($newpath)."/";
			$arr=explode("/",$newpath);
			$name_a=$arr[count($arr)-1];
			$arr1=explode(".",$name_a);
			if(count($arr1)>1){
				$ext=$arr1[count($arr1)-1];
				$newname=str_replace(".".$ext,"",$name_a);
			}
			$this->config["g_dir_other"]=$this->config["g_dir1"]=$this->config["g_dir2"]=$this->config["g_dir3"]=$this->config["g_dir4"];
		};
			$folder=str_replace("./","",$folder);
			$folder=str_replace("../","",$folder);
			$folder=str_replace("~/","",$folder);
		if($folder!=""){

			$this->config["g_dir4"]=$this->config["g_dirtou"].$folder."/";
			$this->config["g_dir_other"]=$this->config["g_dir1"]=$this->config["g_dir2"]=$this->config["g_dir3"]=$this->config["g_dir4"];
		}
		$tmpdirname="tmp/tmp_".md5($time.$tmpid)."/";
		if($istmp==1){
			$this->config["g_dir1"]=$tmpdirname.$this->config["g_dir1"];
			$this->config["g_dir2"]=$tmpdirname.$this->config["g_dir2"];
			$this->config["g_dir3"]=$tmpdirname.$this->config["g_dir3"];
			$this->config["g_dir4"]=$tmpdirname.$this->config["g_dir4"];
			$this->config["g_dir_other"]=$tmpdirname.$this->config["g_dir_other"];
		}
 
		if(($ext=="bmp" || $ext=="jpg" || $ext=="png" || $ext=="gif"|| $ext=="jpeg")){
			
			if($issmall==1){
			    if($newsmallpath!=""){
						$small_src=$newsmallpath;
				}else{
					if($this->config["g_dir1"]==$this->config["g_dir2"]&&$this->config["g_dir2"]==$this->config["g_dir3"]){
						$small_src=$this->config["g_dir1"].$newname."_s50.".$ext;//大图/原图
					}else{
						$small_src=$this->config["g_dir1"].$newname.".".$ext;
					}
				}
			    if($newmidpath!=""){
						$mid_src=$newmidpath;
				}else{
					if($this->config["g_dir1"]==$this->config["g_dir2"]&&$this->config["g_dir2"]==$this->config["g_dir3"]){
						$mid_src=$this->config["g_dir2"].$newname."_s80.".$ext;//大图/原图
					}else{
						$mid_src=$this->config["g_dir2"].$newname.".".$ext;
					}
				}
			    if($newbigpath!=""){
						$big_src=$newbigpath;
				}else{
					if($this->config["g_dir1"]==$this->config["g_dir2"]&&$this->config["g_dir2"]==$this->config["g_dir3"]){
						$big_src=$this->config["g_dir3"].$newname."_s100.".$ext;//大图/原图
					}else{
						$big_src=$this->config["g_dir3"].$newname.".".$ext;
					}
				}
				$this->CreateDir($this->get_iconv("UTF-8","GB2312",$cengci.$this->config["g_dir1"]));
				$this->CreateDir($this->get_iconv("UTF-8","GB2312",$cengci.$this->config["g_dir2"]));
				$this->CreateDir($this->get_iconv("UTF-8","GB2312",$cengci.$this->config["g_dir3"]));
				if($issmall!=1){
					$small_src=$big_src;
				}
				if($ismid!=1){
					$mid_src=$big_src;
				}
				
				$small_fullpath=$cengci.$small_src;
				$mid_fullpath=$cengci.$mid_src;
				$big_fullpath=$cengci.$big_src;
				//if($isyuanming==1){
				$small_fullpath=$this->get_iconv("UTF-8","GB2312",$small_fullpath);
				$mid_fullpath=$this->get_iconv("UTF-8","GB2312",$mid_fullpath);
				$big_fullpath=$this->get_iconv("UTF-8","GB2312",$big_fullpath);
				//}
				//rename($filename, $big_fullpath);//保存
				
				@rename($uploadfile,$big_fullpath);

				if($issmall==1){
					if(is_file($smallbase64path)){
						$this->base64_image(file_get_contents($smallbase64path),$small_fullpath);
 
					}else{
						if(is_file($tmpfullpath_small)){
							@rename($tmpfullpath_small,$small_fullpath);
						}else if(filesize($big_fullpath)>1024*1024*5){
							copy("bigmr.png",$small_fullpath);
						}else{
							$this->NewSmall($big_fullpath,$small_fullpath,200,200,"height");
						}
					}
				};
				$g_w2='';
				$g_h2='';
				if($ismid==1){ 
					if(is_file($tmpfullpath_mid)){
						@rename($tmpfullpath_mid,$mid_fullpath);
					}else{
						$this->NewSmall($big_fullpath,$mid_fullpath,$g_w2,$g_h2,"height");
					}
				};
				if($isbig==1){
					 $imginfo=getimagesize($big_fullpath);
					 $size=@filesize($big_fullpath);
					 $this->NewSmall($big_fullpath,$big_fullpath,$imginfo[0],$imginfo[1],"height");//最好是php压一下，不然html5生成的图片体积变大。。。。
				}
			}else{
				$big_src=$this->config["g_dir4"].$newname.".".$ext;
				
				if($newbigpath!=""){
					$big_src=$newbigpath;
				}
				
				$this->CreateDir($this->get_iconv("UTF-8","GB2312",$cengci.$this->config["g_dir4"]));
				$big_fullpath=$cengci.$big_src;
				$small_src=$big_src;
				$mid_src=$big_src;
				$small_fullpath=$big_fullpath;
				
				$small_fullpath=$this->get_iconv("UTF-8","GB2312",$small_fullpath);
				$big_fullpath=$this->get_iconv("UTF-8","GB2312",$big_fullpath);

				@rename($uploadfile,$big_fullpath);
				if($isbig==1){
					 $imginfo=getimagesize($big_fullpath);
					 $size=@filesize($big_fullpath);
					 $this->NewSmall($big_fullpath,$big_fullpath,$imginfo[0],$imginfo[1],"height");//最好是php压一下，不然html5生成的图片体积变大。。。。
				}
			}
			$status="success";
		}else{
			$this->CreateDir($this->get_iconv("UTF-8","GB2312",$cengci.$this->config["g_dir_other"]));
			$big_src=$this->config["g_dir_other"].$newname.".".$ext;
			if($newbigpath!=""){
				$big_src=$newbigpath;
			}
			$big_fullpath=$cengci.$big_src;
			$small_src=$big_src;
			$small_fullpath=$big_fullpath;
			if($isyuanming==1){ 
				@rename($uploadfile, $this->get_iconv("UTF-8","GB2312",$big_fullpath));//保存
				$big_fullpath=$this->get_iconv("UTF-8","GB2312",$big_fullpath);
				//copy($uploadfile,$big_fullpath);
			}else{
				//copy($uploadfile,$big_fullpath);
				@rename($uploadfile, $this->get_iconv("UTF-8","GB2312",$big_fullpath));//保存
			}
			$status="success";
		}
		$img_data=array();
		if($status=="success"){
				$time=time();
				$idno = md5($title.uniqid(rand()));
				$img_data["name"]=$title;
				$img_data["title"]=$title;
				$img_data["path"]=$big_src;
				$img_data["src"]=$small_src;
				$img_data["size"]=$size;
				$img_data["time"]=$time;
				$img_data["status"]=0;
				$img_data["md5"]=md5($title."".$size."".$ext.$filetype);
				$img_data["idno"]=$idno;
				$img_data["sys_adddate"]=date("Y-m-d H:i:s",$time);
				$img_data["ext"]=$ext;
				$img_data["lastModified"]=$lastModified;
				$img_data["filetype"]=$filetype;
		}		
		for($i=1;$i<=$total;$i++){
			$tmp_path = $tmpdir.$i.".tmp";
			@unlink($tmp_path);
		}
		// @unlink($uploadfile);
		if(is_file($smallbase64path)){
			@unlink($smallbase64path);
		}
		$this->deletetmp($total,$tmpdir,"_small");
		$this->deletetmp($total,$tmpdir,"_mid");
		$this->deletetmp($total,$tmpdir,"_big");

		@rmdir($tmpdir);
		//$big_path 大图路径
		//$mid_src 中图路径
		//$small_src 小图路径
		$res["status"]=$status;
		$res["filepath"]=$small_src;
		$res["small_src"]=$small_src;
		$res["title"]=$title;
		$res["ext"]=$ext;
		$res["cengci"]=$cengci;
		$res["date"]=$date;
		$res["tmpid"]=$tmpid;
		$res["row"]=$img_data;
		return $res;
	}else{
		return json_decode("{\"status\":\"dengdai\",\"index\":\"$index\",\"total\":\"$total\"}",true);
	}
}

public function deletetmp($total,$tmpdir,$tmpnamehz){//返回路径
	for($i=1;$i<=$total;$i++){
		$tmp_path = $tmpdir.$i.$tmpnamehz.".tmp";
		//echo $tmp_path."\n\r";
		@unlink($tmp_path);
	};
}
public function savetmpbao($total,$tmpdir,$tmpnamehz,$tmpfullpath,$istype=0){//返回路径
	$datastr="";
	$fo = fopen($tmpfullpath,"a");
	for($i=1;$i<=$total;$i++){
		$tmp_path = $tmpdir.$i.$tmpnamehz.".tmp";
		//echo $tmp_path."\n\r";
		$datastr =file_get_contents($tmp_path);
		//file_put_contents("test.txt", "This is another something.", FILE_APPEND)
		fwrite($fo,$datastr);//写入文件中
	}
	fclose($fo);
	return $tmpfullpath;
}
public function upone($cengci){
	$size = $_POST["size"];
	$end = $_POST["end"];
	$beg = $_POST["beg"];
	$title=trim($_POST["title"]);
	$isyuanming= $_POST["isyuanming"];
	$title =urldecode($title);
	$file=$_FILES["file"];
	$tmpid=trim($_POST["tmpid"]);
	$value=trim($_POST["value"]);
	$value=str_ireplace("[jh]","+",$value);
	$index=trim($_POST["index"]);
	$ext=trim($_POST["ext"]);
	$num=intval($_POST["num"]);
	$newname=trim($_POST["newname"]);
	$newpath=trim($_POST["newpath"]);
	$folder=trim($_POST["folder"]);
	$oldtmpid=trim($_POST["oldtmpid"]);
	$istmp=trim($_POST["istmp"]);
	$file=$_FILES["file"];
	
	$filename=$file["name"];
	$arr=explode(".",$filename);
	$ext=end($arr);
	$not_extstr="php,asp,jsp,aspx,ashx,py,java,exe,js";//限制这类文件后缀上传
	$exts=explode(",",$not_extstr);
	$isupload=true;

	if(in_array(strtolower($ext),$exts)){
		$isupload=false;
	}
	if(!$isupload){
		return json_decode("{\"status\":\"error\",\"msg\":\"后端程序不允许上传.".$ext."文件\"}",true);
	}
	
	$time=time();
	$tmpid=$this->NewRand(4);
	$tmpdirname="tmp/tmp_".md5($time.$tmpid)."/";
	
	if($istmp==1){
		$this->config["g_dir1"]=$tmpdirname.$this->config["g_dir1"];
		$this->config["g_dir2"]=$tmpdirname.$this->config["g_dir2"];
		$this->config["g_dir3"]=$tmpdirname.$this->config["g_dir3"];
		$this->config["g_dir4"]=$tmpdirname.$this->config["g_dir4"];
		$this->config["g_dir_other"]=$tmpdirname.$this->config["g_dir_other"];
	}

	$tmpdir=$cengci."tmp/".$tmpid."/";
	$tmpid=str_ireplace("./","",$tmpid);//一定要过滤掉
	$tmpid=str_ireplace("../","",$tmpid);//一定要过滤掉
	$tmpid=str_ireplace("..//","",$tmpid);//一定要过滤掉
	
	
	// var_dump($file);
	
	$newname ="".date("Ymd", $time)."sj".$this->$this->NewRand(4);
	$big_src=$this->config["g_dir4"].$newname.".".$ext;
	$this->CreateDir($cengci.$this->config["g_dir4"]);
	$big_fullpath=$cengci.$big_src;
	$small_src=$big_src;
	$mid_src=$big_src;
	$small_fullpath=$big_fullpath;
	$res=array();
	if(move_uploaded_file($file["tmp_name"],$this->get_iconv("UTF-8","GB2312",$big_fullpath))){
		$res=json_decode("{\"status\":\"success\",\"filepath\":\"".$big_src."\",\"row\":{\"src\":\"{$big_src}\",\"name\":\"{$title}\",\"size\":\"".@filesize($big_fullpath)."\"}}",true);
	}else{
		$res=json_decode("{\"status\":\"error\"}");
	}
	return $res;
}
public function del($cengci,$path){
	$res=array();
	$res["status"]="error";
	$arr=explode("#",$path);
	$dellist=array();
	for($i=0;$i<count($arr);$i++){
		$filepath=$arr[$i];
		$m_num=5;//5分钟可删除
		$pos=strpos($filepath,$this->config["g_dirtou"]);
		if($filepath!=""&&$pos!==false&&($pos==0||$pos==1)){
			$arr=explode(".",$filepath);
			$ext=".".end($arr);
			$filepath=$this->get_iconv('UTF-8', 'GB2312',$filepath);
			if(file_exists($cengci.$filepath)){
				@unlink($cengci.$filepath);
				$dellist[]=$filepath;
			}
			if(strpos($filepath,"/s50/")!==false||strpos($filepath,"/s100/")!==false){
				$bigpath=str_replace("/s50/","/s100/",$filepath);
				$path=str_replace("/s100/","/s100/",$bigpath);
				$path=str_replace("//","/",$bigpath);
				if(file_exists($cengci.$path)&&$this->isdeletefileroot($cengci.$path,$m_num)){
					@unlink($cengci.$path);
					$dellist[]=$path;
				}
				$path=str_replace("/s100/","/s50/",$bigpath);
				$path=str_replace("//","/",$bigpath);
				if(file_exists($cengci.$path)){
					@unlink($cengci.$path);
					$dellist[]=$path;
				}
			
				$path=str_replace("/s100/","/s80/",$bigpath);
				$path=str_replace("//","/",$bigpath);
				if(file_exists($cengci.$path)){
					@unlink($cengci.$path);
					$dellist[]=$path;
				}
			}else if(strpos($filepath,"_s50")!==false||strpos($filepath,"_s100")!==false){
				$bigpath=str_replace("_s50","_s100",$filepath);
				$path=str_replace("_s100","_s100",$bigpath);
				$path=str_replace("//","/",$bigpath);
				if(file_exists($cengci.$path)&&$this->isdeletefileroot($cengci.$path,$m_num)){
					@unlink($cengci.$path);
					$dellist[]=$path;
				}
				$path=str_replace("_s100","_s50",$bigpath);
				$path=str_replace("//","/",$bigpath);
				if(file_exists($cengci.$path)&&$this->isdeletefileroot($cengci.$path,$m_num)){
					@unlink($cengci.$path);
					$dellist[]=$path;
				}
				$path=str_replace("_s100","_s80",$bigpath);
				$path=str_replace("//","/",$bigpath);
				if(file_exists($cengci.$path)&&$this->isdeletefileroot($cengci.$path,$m_num)){
					@unlink($cengci.$path);
					$dellist[]=$path;
				}
			}else{
				$path=str_replace($ext.$ext.$ext,$ext,$filepath);
				$path=str_replace("//","/",'');
				if(file_exists($cengci.$path)&&$this->isdeletefileroot($cengci.$path,$m_num)){
					@unlink($cengci.$path);
					$dellist[]=$path;
				}
				if(file_exists($cengci.$path.$ext)&&$this->isdeletefileroot($cengci.$path,$m_num)){
					@unlink($cengci.$path.$ext);
					$dellist[]=$path.$ext;
				}
				if(file_exists($cengci.$path.$ext.$ext)&&$this->isdeletefileroot($cengci.$path,$m_num)){
					@unlink($cengci.$path.$ext.$ext);
					$dellist[]=$path.$ext.$ext;
				}
			}
		}
	}
	if(count($dellist)>0){
	   $res["status"]="success";
	   $res["msg"]="删除成功";
	}else{
		$res["status"]="error";
		$res["msg"]="删除成功，文件不存在";
	}
	$res["data"]=$dellist;
	return $res;
}
public function fileinfo($cengci,$paths){
   $path=trim($_POST["path"]);
   if($path==""){
	   $path=trim($_POST["src"]);
   }
   $arr=explode("#",$paths);
   $data=array();
   for($i=0;$i<count($arr);$i++){
        $path=$arr[$i];
		if($path!=""){
			$pos=strpos($path,$this->config["g_dirtou"]);
			if($path!=""&&$pos!==false&&($pos==0||$pos==1)){
			    $one["filesize"]=filesize($cengci.$path);
			    $one["filectime"]=filectime($cengci.$path);
			    $one["filemtime"]=filemtime($cengci.$path);
			    $data[]=$one; 
			}
		}
	};
	return $data;
}
public function  autosave($cengci){
	$content="";
	$mykey="";  
	$key=trim($_POST["key"]);
	$content=trim($_POST["content"]);
	$mykey=trim($_POST["mykey"]);
	if($key!="" && $content!=""){
		$my_path = $cengci."tmp/key/".$key."/".$mykey.".txt";  //保存路径
		$this->CreateDir($cengci."tmp/key/".$key."/");
		$this->save_file($my_path,$content,"utf-8");
	}
	$res=array();
	$res["status"]="success";
	return $res;
}
public function getsave($cengci){
	$key="";
	$jsonstr="";
	$str = "";
	$index1=0;   
	$key=trim($_POST["key"]);
	$vals=array();
	if ($key!=""){
		// exit();
		$paths=$this->get_files($cengci."tmp/key/".$key."/");
		$jsonstr="";
		$index1=0;
		//echo(pathstr);
		for($i=0 ;$i<count($paths);$i++){
			if($paths[$i]!=""){
				$str =$this->read_file($paths[$i],"utf-8");
				if($str!=""){
					$vals[]=$str;
				}
			}
		}
	
	}
	return $vals;
}
public function get_files($c_path){
             $paths="";
			 $index=0;
			 $vals=array();
			if(is_dir($c_path)){
			// header("Content-type: text/html; charset=gb2312"); 
			    $handler = opendir($c_path);//当前目录中的文件夹下的文件
				while( ($filename = readdir($handler)) !== false ) {
					  if($filename != "." && $filename != ".."){
						  if(is_file($c_path.$filename)){
							  $vals[]=$c_path.$filename;
						  }
					  }
				};
		       closedir($handler);
		  }  
           return $vals;
}
public function up_one($cengci){//单个上传
	$file=$_FILES['file'];
	$tempfile = $file['tmp_name'];
	$size=$file['size'];//文件大小 
	$pinfo=pathinfo($file["name"]);//文件信息数组
	$fileTypes = array('jpg','jpeg','gif','png','bmp'); // File extensions	
	//$fileext=strtolower($pinfo["extension"]);//这样获取图片后缀太垃圾，万不可，转为小写
	$infos= getimagesize($file['tmp_name']);//获取文件相关信息,可以获取图片宽高等，var_dump($infos)输出数组看看
	$arr=explode("/",end($infos));
	$ext=strtolower($arr[1]);//获取真实的文件后缀
	$bl=0;
	if(in_array($ext,$fileTypes)){
		$image_size= getimagesize($file['tmp_name']);
		//$oldwidth=$image_size[0];
		//$oldheight=$image_size[1];
		//$bl=($oldwidth/$oldheight);
		//$bl=round($bl, 2);//图片长宽比率
	}
	$not_extstr="php,asp,jsp,aspx,ashx,py,java,exe,js,html,htm,xhtml";//限制这类文件后缀上传
	$exts=explode(",",$not_extstr);
	$isupload=true;
	if(in_array(strtolower($ext),$exts)){
		$isupload=false;
	}
	if(trim($ext)==""){
		$isupload=false;
	}
	if(!$isupload){
		return json_decode("{\"status\":\"error\",\"msg\":\"后端程序不允许上传.".$ext."文件\"}",true);
	}
	$maxsize=2;//m为单位
	$type1=$file['type'];
	$time=time();
	$this->config["g_dir3"].=date("Ymd",$time)."/";
	$this->config["g_dir1"].=date("Ymd",$time)."/";
	$this->config["g_dir_other"].=date("Ymd",$time)."/";
	//InsertImage1($images_id,$file['name'],$pathfile_n,$adminname,$color1);
	
	$oldname=basename($file["name"]);
	$isyuanming=$_REQUEST["isyuanming"];
	
	if($isyuanming==1){
		$newname=trim($oldname);
		$newname = str_ireplace(" ","",$newname);//去掉空格
		$newname = str_ireplace(".".$ext,"",$newname);//去掉空格
	}else{
		$newname =date("YmdHis", $time)."sj".$this->NewRand(4);
	}
	
	if($ext=="bmp" || $ext=="jpg" || $ext=="png" || $ext=="gif"|| $ext=="jpeg"){
		$this->CreateDir($cengci.$this->config["g_dir3"]); 
		$big_src=$this->config["g_dir3"].$newname.".".$ext;
		$big_fullpath=$cengci.$big_src;
		$small_src=$big_src;
		$small_fullpath=$cengci.$small_src;
		$isnewsmall=trim($_REQUEST["isnewsmall"]);
		if($isnewsmall==1){
			$small_src=$this->config["g_dir1"].$newname."_s50.".$ext;
		}
	}else{
		CreateDir($cengci.$this->config["g_dir_other"]); 
		$big_src=$this->config["g_dir_other"].$newname.".".$ext;
		$big_fullpath=$cengci.$big_src;
		$small_src=$big_src;
		$small_fullpath=$big_fullpath;
	}
	if($isyuanming==1){
		$small_fullpath=$this->get_iconv("UTF-8","GB2312",$small_fullpath);
		$big_fullpath=$this->get_iconv("UTF-8","GB2312",$big_fullpath);
	}
	$res["status"]=array();
	if(in_array($ext,$fileTypes)){
		if(move_uploaded_file($tempfile,$big_fullpath)){
			if($ext=="bmp" || $ext=="jpg" || $ext=="png" || $ext=="gif"|| $ext=="jpeg"){
				if($isnewsmall==1){
					$this->CreateDir($cengci.$this->config["g_dir1"]); 
					$this->NewSmall($big_fullpath,$small_fullpath,$this->config["g_w1"],$this->config["g_h1"],"height");
				}   
			}
			$res["status"]=="success";
			$res["small_src"]=$small_src;
			$res["big_src"]=$big_src;
			$res["msg"]=="上传成功";
		}else{
			$res["status"]=="error";
			$res["msg"]=="上传失败";
		}
	}else{
		$res["status"]=="error";
		$res["msg"]==$ext."不允许上传";
	}
	return $res;
		
}
public function upload($file,$maxsize){
	$g_cengci=$this->config["g_dir1"];
	$g_dirtou=$this->config["g_dir1"];
	$g_dir1=$this->config["g_dir1"];
	$g_dir2=$this->config["g_dir2"];
	$g_dir4=$this->config["g_dir4"];
	$g_dir3=$this->config["g_dir3"];
	$g_dir_other=$this->config["g_dir_other"];
	$g_w1=$this->config["g_w1"];
	$g_w2=$this->config["g_w2"];
	$g_h1=$this->config["g_h1"];
	$g_h2=$this->config["g_h2"];
	$cengci=$this->config["g_cengci"];
	$folder=trim($_REQUEST['folder']);
	$time=time();
	$g_dir1.=date("Ymd",$time)."/";
	$g_dir2.=date("Ymd",$time)."/";
	$g_dir3.=date("Ymd",$time)."/";
	$g_dir4.=date("Ymd",$time)."/";
	$g_dir_other.=date("Ymd",$time)."/";
	if($folder!=""){
		$folder=str_replace("./","",$folder);
		$folder=str_replace("../","",$folder);
		$folder=str_replace("~/","",$folder);
		$g_dir4=$g_dirtou.$folder.date("Ymd",$time)."/";
		$g_dir_other=$g_dir1=$g_dir2=$g_dir3=$g_dir4;
	}
	$this->CreateDir($g_cengci.$folder); 
	$tempfile = $file['tmp_name'];
	$size=$file['size'];//文件大小 
	// $tmp_name=$file["tmp_name"];//文件名
	// $pinfo=pathinfo($file["name"]);//文件信息数组
	$imgTypes=array('jpg','jpeg','gif','bmp','png');
	$notfileTypes = array('php','asp','jsp','exe','js',"ashx","aspx","vb"); // File extensions	
	//$fileext=strtolower($pinfo["extension"]);//这样获取图片后缀太垃圾，万不可，转为小写
	$infos= getimagesize($file['tmp_name']);//获取文件相关信息,可以获取图片宽高等，var_dump($infos)输出数组看看
	if(is_array($infos)){
		$arr=explode("/",end($infos));
		$ext=strtolower($arr[1]);//获取真实的文件后缀
	}
	$bl=0;
	if($ext==""){
	   $arr=explode(".",$file["name"]);
	   $ext=end($arr);
	}
	$isupload=true;
	if(in_array($ext,$notfileTypes)){
	  $isupload=false;
	}
	$isimg=0;
	if(in_array($ext,$imgTypes)){
		//$image_size= getimagesize($file['tmp_name']);
		//$oldwidth=$image_size[0];
		//$oldheight=$image_size[1];
		//$bl=($oldwidth/$oldheight);
		//$bl=round($bl, 2);//图片长宽比率
		$isimg=1;
	}
	$filename=str_replace("./","",'');
	$filename=str_replace("../","",$filename);
	$filename=str_replace("~/","",$filename);
	$filename=str_replace(";","",$filename);

	if(trim($filename)==""){
		$newname="".time().$this->NewRand(4);
	}else{
		$newname=$filename;
	}
	$res=array();
	if($isupload==false){
		$res["status"]="error";
		$res["msg"]="{$ext}类型不允许上传";
		return $res;
	}
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
	
	if($isimg==1){
		$newsmall_num=0;
		if($isnewsmall==1){
			$newsmall_num++;
		}
		if($isnewmid==1){
			$newsmall_num++;
		}
		if($newsmall_num>0){
			if($g_dir1==$g_dir2&&$g_dir2==$g_dir3){
				 $small_src=$g_dir1.$newname."_s50.".$ext;//小图
				 $mid_src=$g_dir2.$newname."_s80.".$ext;//中图
				 $big_src=$g_dir3.$newname."_s100.".$ext;//大图/原图
			}else{
				$small_src=$g_dir1.$newname.".".$ext;
				$mid_src=$g_dir2.$newname.".".$ext;
				$big_src=$g_dir3.$newname.".".$ext;
			}
			$this->CreateDir($cengci.$g_dir1);
			$this->CreateDir($cengci.$g_dir2);
			$this->CreateDir($cengci.$g_dir3);
			$small_fullpath=$cengci.$small_src;
			$mid_fullpath=$cengci.$mid_src;
			$big_fullpath=$cengci.$big_src;
			$small_fullpath=$this->get_iconv("UTF-8","GB2312",$small_fullpath);
			$mid_fullpath=$this->get_iconv("UTF-8","GB2312",$mid_fullpath);
			$big_fullpath=$this->get_iconv("UTF-8","GB2312",$big_fullpath);
		}else{
			$big_src=$g_dir4.$newname.".".$ext;
			$this->CreateDir($cengci.$g_dir4);
			$big_fullpath=$cengci.$big_src;
			$small_src=$big_src;
			$small_fullpath=$cengci.$big_fullpath;
			$big_fullpath=$this->get_iconv("UTF-8","GB2312",$big_fullpath);
		}
	}else{
		$this->CreateDir($cengci.$g_dir_other);
		$big_src=$g_dir_other.$newname.".".$ext;
		$big_fullpath=$cengci.$big_src;
		$small_src=$big_src;
		$small_fullpath=$cengci.$big_fullpath;
		$big_fullpath=get_iconv("UTF-8","GB2312",$big_fullpath);
	}
 
	$res["status"]="error";
	
	if($isupload){
		if($size){
			if($size<$maxsize){
				if(move_uploaded_file($tempfile,$big_fullpath)){
					if($isnewsmall==1){
						$small_width =$g_w1;
						$small_height=$g_h1;
						$small_type="height";
						$small_zhiliang=85;
						$ty1=$_REQUEST["smallfile_yasuo_type"];
						if(isset($ty1)&&($ty1=="width")){
							$small_type=$ty1;
							$w1=intval($_REQUEST["smallfile_yasuo_width"]);
							if($w1>0){
								$small_width=$w1;
							}
						}
						if(isset($ty1)&&($ty1=="height")){
							$small_type=$ty1;
							$h1=intval($_REQUEST["smallfile_yasuo_height"]);
							if($h1>0){
								$small_height=$h1;
							}
						}
						if(isset($_REQUEST["smallfile_yasuo_zhiliang"])&&floatval($_REQUEST["smallfile_yasuo_zhiliang"])<=1){
							$small_zhiliang=floatval($_REQUEST["smallfile_yasuo_zhiliang"])*100;
						}
						$this->NewSmall($big_fullpath,$small_fullpath,$small_width,$small_height,$small_type,$small_zhiliang);
					}
					if($isnewmid==1){
						$mid_width =$g_w2;
						$mid_height=$g_h2;
						$mid_type="height";
						$mid_zhiliang=85;
						$ty1=$_REQUEST["midfile_yasuo_type"];
						if(isset($ty1)&&($ty1=="width")){
							$mid_type=$ty1;
							$w1=intval($_REQUEST["midfile_yasuo_width"]);
							if($w1>0){
								$mid_width=$w1;
							}
						}
						if(isset($ty1)&&($ty1=="height")){
							$mid_type=$ty1;
							$h1=intval($_REQUEST["midfile_yasuo_height"]);
							if($h1>0){
								$mid_height=$h1;
							}
						}
						if(isset($_REQUEST["midfile_yasuo_zhiliang"])&&floatval($_REQUEST["midfile_yasuo_zhiliang"])<=1){
							$mid_zhiliang=floatval($_REQUEST["midfile_yasuo_zhiliang"])*100;
						}
						$this->NewSmall($big_fullpath,$mid_fullpath,$mid_width,$mid_height,$mid_type,$mid_zhiliang);
					}
					//$color1 = imagecolorat($this->thisim,1,1);
					//$color1=dechex($color1);//转为16进制颜色值
					$res["msg"]="上传成功";
					$res["status"]="success";
					$row=array();
					$row["name"]=$file["name"];
					$row["size"]=$file["size"];
					$row["ext"]=$ext;
					$row["src"]=$small_src;
					$res["src"]=$small_src;
					$res["path"]=$big_src;
					$res["title"]=$file["name"];
					$res["small_src"]=$small_src;
					$res["big_src"]=$big_src;
					$res["row"]=$row;
				}
			}else{
				$res["msg"]="图片不能超过".$maxsize."M";
			}
		}else{
			$tishi="请上传图片";
			$res["msg"]="请上传图片";
		}
	}else{
		$res["msg"]="不允许上传";
	}
	return $res;
}
public function read_file($path_full,$charset=""){//读取文件  $path_full：文件路径, $charset:编码
	  $str = "";
	  if(is_file($path_full)){
	     $str = file_get_contents($path_full);
	  }
	 return $str; 
}
public function save_file($path_full,$content, $charset){ //保存文件 $path_full：文件路径,$content:内容, $charset:编码
	$p =$path_full;
	$isbool=true;
	if(!$path_full||!$content){
		return false;
	}
	if(is_file($path_full)){ 
		@unlink($path_full); 
	}
	
	$this->CreateDir(dirname($path_full));
	if ($fp = fopen($path_full, "w")){
		if (@fwrite($fp, $content)){
			fclose($fp);
			$isbool=true;
		}else{
			fclose($fp);
			$isbool=false;
		} 
	} 
	return $isbool;
}
public function delfolder($c_path, $miao){ //删除超过几秒的文件夹
	$paths="";
	$folder_Names=""; 
	if(is_dir($this->get_iconv('UTF-8', 'GB2312',$c_path))){
		   $time1=(filemtime($this->get_iconv('UTF-8', 'GB2312',$c_path))+($miao));
		   $cz=time()-($time1);
		  if($cz<0){
			  return false;
		  }
	}
	$paths=array();
	if(is_dir($this->get_iconv('UTF-8', 'GB2312',$c_path))){
	// header("Content-type: text/html; charset=gb2312"); 
		$handler = opendir($this->get_iconv('UTF-8', 'GB2312',$c_path));//当前目录中的文件夹下的文件
		while(($filename = readdir($handler))!== false ) {
			$filename_gb=$this->get_iconv('UTF-8', 'GB2312',$filename);
			$filename_utf=$this->get_iconv('GB2312', 'UTF-8',$filename);
			if($filename != "." && $filename != ".."){
				$dir_path=$c_path.$filename_utf;
				if(is_dir($c_path.$filename)){
					// $dir_path=iconv('UTF-8', 'GB2312',$dir_path);
					$gqTime=(filemtime($c_path.$filename)+($miao));
					$time=time();
					$cz=$time-($gqTime);
					if($cz>0){
						$paths[]=$dir_path;
					}
				}else if(is_file($dir_path)){
					$gqTime=(filemtime($c_path.$filename)+($miao));
					$time=time();
					$cz=$time-($gqTime);
					if($cz<0){
						@unlink($c_path.$filename);
					}
				}
			}
		};
	   closedir($handler);
  }  
 
	for($i=0;$i<count($paths);$i++){
		if($paths[$i]!=""&&is_dir($paths[$i])){
				$this->removeDir($paths[$i]);
		}
	};
	return $paths;
}

// 说明： 删除非空目录的解决方案
// http://www.manongjc.com
//https://blog.csdn.net/wuxiaopeng_1986/article/details/52842770
public function removeDir($dirName){ //删除文件夹,连同里面的文件也删除
 
	if($dirName=="../.."||$dirName=="../../.."||$dirName=="../../../.."||$dirName==".."||$dirName=="../"||$dirName=="./"){ //防止把整个站给误删除
		return false;
	};
	if(strpos($dirName,'//')!==false){
		return false;
	};
	if(! is_dir($this->get_iconv('UTF-8', 'GB2312',$dirName))) { 
		return false; 
	} 
	$handle = @opendir($this->get_iconv('UTF-8', 'GB2312',$dirName)); 
	while(($filename = @readdir($handle)) !== false){ 
		if($filename != '.' && $filename != '..'){ 
			$filename_utf=$this->get_iconv('GB2312', 'UTF-8',$filename);
			$dir = $dirName . '/' . $filename_utf; 
			is_dir($this->get_iconv('UTF-8', 'GB2312',$dir)) ? $this->removeDir($dir) : @unlink($this->get_iconv('UTF-8', 'GB2312',$dir)); 
		} 
	} 
	closedir($handle); 
	return @rmdir($this->get_iconv('UTF-8', 'GB2312',$dirName));  //rmdir只能删除空文件夹
}

public function SavePhoto($thisim,$maxwidth,$maxheight,$_width,$_height,$x,$y,$newimagepath){
	$newim = imagecreatetruecolor($maxwidth, $maxheight);
	if(function_exists("imagecopyresampled")){
		$newim = imagecreatetruecolor($maxwidth, $maxheight);
		$red = imagecolorallocate($newim, 255, 255, 255);
		imagefill($newim, 0, 0, $red);
		imagecopyresampled($newim, $thisim, $x, $y, 0, 0, $_width,
		$_height, imagesx($thisim), imagesy($thisim));
	}else{
		$newim = imagecreate($maxwidth, $maxheight);
		imagecopyresized($newim, $thisim, $x, $y, 0, 0, $_width,
		$_height, imagesx($thisim), imagesy($thisim));
	}
	ImageJpeg($newim,$newimagepath,85);
}
public function gethttp(){//获取url协议头
	if ( !empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
		return "https";
	}elseif( isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
		return "https";
	}elseif( !empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
		return "https";
	}
	return "http";
}
public function DeleteDir($dir)//删除文件夹及文件夹下的文件
{
   if($dir=="../.."||$dir=="../../.."||$dir=="../../../.."||$dir==".."||$dir=="../"||$dir=="./"){ //防止把整个站给误删除
       return false;
   };
   if(strpos($dir,'//')!==false){
       return false;
   };
   if(substr($dir, -1)=="/"){
      $dir=substr($dir,0,strlen($dir)-1);
   }
   $dirgb=$this->get_iconv('UTF-8', 'GB2312',$dir);
    if(!is_dir($dirgb)){
	    return false;
	}
	
   $dh = opendir($dirgb);
   while ($file = readdir($dh))
   {
      if ($file != "." && $file != "..")
      {
	     $filen=$this->get_iconv('GB2312', 'UTF-8',$file);
	     $fullpath = $dir . "/" . $filen;
         $fullpathgb =$dirgb . "/" .$file;
         if (!is_dir($fullpathgb))
         {
            @unlink($fullpathgb);
         } else
         {
            $this->DeleteDir($fullpath);
         }
      }
   }
   closedir($dh);
   if (@rmdir($dirgb))
   {
      return true;
   } else
   {
      return false;
   }
}
public function NewRand($median_){
	$str_="";
	$minno="";
	$maxno="";
	if(is_numeric($median_)){
		for($i_=0;$i_<$median_;$i_++){
			$f=rand(0,9);
			if($f==0){$f=1;}
			$str_.=$f;
		}
	}
	return $str_;
}
public function NewSmall($big_fullpath,$new_fullpath,$w,$h,$ty,$zhiliang=85){//生成小图
	$imginfo= getimagesize($big_fullpath);
	
	$bilv=$imginfo[0]/$imginfo[1];//长高比
	$arr=explode("/",end($imginfo));
	$ext=$arr[1];
	$maxwidth=$_width=$w;
	$_height=$_width/$bilv;
	if($ty=="width"){
		 $maxwidth=$_width=$w;
		 $_height=$_width/$bilv;
		 $maxheight=$_height;
	}
	if($ty=="height"){
		$_height=$h;
		$_width=$h*$bilv;
		$maxwidth=$_width;
		$maxheight=$_height;
	}
	if($this->config["g_is_jiequ"]==1){
		$maxheight=$h;
	}else{
		$maxheight=$_height;
	}
	$mime=$imginfo["mime"];
	if($mime=="image/png"){
	  $thisim = imagecreatefrompng($big_fullpath);
	}else if($mime=="image/gif"){
	  $thisim = imagecreatefromgif($big_fullpath);
	}else if($mime=="image/bmp"){
	  $thisim =imagecreatefromwbmp($big_fullpath); 
	}else if($mime=="image/jpg"){
	  $thisim =imagecreatefromjpeg($big_fullpath);
	}else if($mime=="image/jpeg"){
	  $thisim =imagecreatefromjpeg($big_fullpath); 
	}else{
	  $thisim = imagecreatefromjpeg($big_fullpath);
	}
	$x=0;
	$y=0;
	if(function_exists("imagecopyresampled")){
		$newim = imagecreatetruecolor($maxwidth, $maxheight);
		$red = imagecolorallocate($newim, 255, 255, 255);
		imagefill($newim, 0, 0, $red);
		imagecopyresampled($newim, $thisim, $x, $y, 0, 0, $_width,
		$_height, imagesx($thisim), imagesy($thisim));
	}else{
		$newim = imagecreate($maxwidth, $maxheight);
		imagecopyresized($newim, $thisim, $x, $y, 0, 0, $_width,
		$_height, imagesx($thisim), imagesy($thisim));
	}
	ImageJpeg($newim,$new_fullpath,$zhiliang);	
	imagedestroy($newim);		
}
public function CreateDir($dir){//创建文件夹
	$arr=explode("/",$dir);
	$dir1="";
	for($j=0;$j<count($arr);$j++){
		if($arr[$j]!=""){
			$dir1.=$arr[$j]."/";
			$folder=$dir1;
			if(!is_dir($folder)&&$arr[$j]!="./"&&$arr[$j]!="../"&&$arr[$j]!="/"){
				mkdir($folder,0777);
			}
		}
	}  
}
public function GetIP(){//获取ip
	if(!empty($_SERVER["HTTP_CLIENT_IP"])){
	  $cip = $_SERVER["HTTP_CLIENT_IP"];
	}
	elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
	  $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	elseif(!empty($_SERVER["REMOTE_ADDR"])){
	  $cip = $_SERVER["REMOTE_ADDR"];
	}
	else{
	  $cip = "127.0.0.1";
	}
	if($cip=="::1"){
	  $cip = "127.0.0.1";
	}
	return $cip;
}
public function get_iconv($charset1,$charset2,$str){
	
	$str1=php_uname();
	$islinux=false;
	
	if(strpos($str1,"Linux")!==false){
		$islinux=true;
	}
	
	if($charset1=='GB2312'){
		if($islinux){//linux的系统文件的默认编码是utf-8的
			return $str;
		}else{
			return iconv('GBK', 'UTF-8',$str);
		}
	}
	
	if($charset1=='UTF-8'){
		if($islinux){
			return $str;
		}else{
			return iconv('UTF-8', 'GBK',$str);
		}
	}
	
}
public function NewSmallImage($pathfile_full,$newimagepath,$width,$height){
	$arr=explode(".",$pathfile_full);
	$ext=end($arr);
	if(trim($ext)=="png"){
		$thisim = imagecreatefrompng($pathfile_full);
	}else if(trim($ext)=="gif"){
		$thisim = imagecreatefromgif($pathfile_full);
	}else if(trim($ext)=="bmp"){
		$thisim =imagecreatefromwbmp($pathfile_full); 
	}else if(trim($ext)=="jpg"){
		$thisim =imagecreatefromjpeg($pathfile_full); 
	}else{
		$thisim = imagecreatefromjpeg($pathfile_full);
	}
	$oldwidth= imagesx($thisim);
	$oldheight=imagesy($thisim);
	$bilv=$oldwidth/$oldheight;
	$x=0;
	$y=0;
	$maxwidth=$width;
	$maxheight=$height;
	$_width=$width;
	$_height=$width/$bilv;
	$maxheight= $_height;
	//exit($bilv);
	// $newim = imagecreatetruecolor($maxwidth, $maxheight);
	// exit($maxwidth."=".$maxheight);
	if(function_exists("imagecopyresampled")){
		$newim = imagecreatetruecolor($maxwidth, $maxheight);
		$red = imagecolorallocate($newim, 255, 255, 255);
		imagefill($newim, 0, 0, $red);
		imagecopyresampled($newim, $thisim, $x, $y, 0, 0, $_width,
		$_height, imagesx($thisim), imagesy($thisim));
	}else{
		$newim = imagecreate($maxwidth, $maxheight);
		imagecopyresized($newim, $thisim, $x, $y, 0, 0, $_width,
		$_height, imagesx($thisim), imagesy($thisim));
	}
	ImageJpeg($newim,$newimagepath,85);
}
public function SaveBase64($fullpath,$base64){//按base64 保存
	$img = base64_decode($base64);
	file_put_contents($fullpath, $img);
}
// base64格式编码转换为图片并保存
public function base64_image($base64_content,$path){
     if(preg_match("/^(data:\s*image\/(\w+);base64,)/", $base64_content,$result)){
			 $type=$result[2];
			 $str=base64_decode(str_replace($result[1],'', $base64_content));
			 if(file_put_contents($path,$str)){
			        return true;
			 }else{
			       return false;
            }
	}else{
         if(file_put_contents($path,base64_decode($base64_content))){
            return true;
		 }else{
            return false;
		 }
	}
}
public function isdeletefileroot($fullpath,$m=5){ //文件路径，分钟；在过期内有删除权限，
		$isbool=false;
		 if(is_file($fullpath)){
			   $newtime=(filemtime($fullpath)+$m*60);
			   $curtime=time();
			   $cz=$curtime-($newtime);
			   if($cz>0){
				  $isbool=false;
			   }else{
				  $isbool=true;
			   }
		}
        return $isbool;
}

}

?>
