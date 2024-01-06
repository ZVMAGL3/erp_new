<?php
error_reporting(E_ALL & ~ E_NOTICE);
date_default_timezone_set('Asia/Shanghai');
function DelImg($cengci,$src,$no){
	  @unlink($cengci.$src);
	  return $cengci.$src;
}
 
function DelFile($fullpath){
	  @unlink($fullpath);
}
function SaveBase64($fullpath,$base64){
	  $img = base64_decode($base64);
	  file_put_contents($fullpath, $img);
}
 
function CheckSql($str){
	$str=trim($str);
	//$str = preg_replace("/[\r\n]+/", '<br/>', $str);
	//$str = str_ireplace("\n\r","[rn]",$str);
	$str = str_ireplace("[script]","script",$str);
	$str = str_ireplace("script","[script]",$str);
	$str = str_ireplace("and","&#97;nd",$str);
	$str = str_ireplace("execute","&#101;xecute",$str);
	$str = str_ireplace("update","&#117;pdate",$str);
	$str = str_ireplace("count","&#99;ount",$str);
	$str = str_ireplace("mid","&#109;id",$str);
	$str = str_ireplace("master","&#109;aster",$str);
	$str = str_ireplace("truncate","&#116;runcate",$str);
	$str = str_ireplace("char","&#99;har",$str);
	$str = str_ireplace("create","&#99;reate",$str);
	$str = str_ireplace("delete","&#100;elete",$str);
	$str = str_ireplace("insert","&#105;nsert",$str);
	$str = str_ireplace("or","&#111;r",$str);
	$str = str_ireplace("'","&#39;",$str);
	$str = str_ireplace("\"","&#34;",$str);
	//$str = str_ireplace("%20","",$str);
	//$str = str_ireplace(" ","",$str);
	$str = str_ireplace("(","&#40;",$str);
	$str = str_ireplace(")","&#41;",$str);
	$str = str_ireplace("*","&#42;",$str);
	//$str = str_ireplace("+","&#43;",$str);
	$str = str_ireplace(",","&#44;",$str);
	//$str = str_ireplace("-","&#45;",$str);
	//$str = str_ireplace("<","&#60;",$str);
	//$str = str_ireplace("=","&#61;",$str);
	//$str = str_ireplace(">","&#62;",$str);
	//$str = str_ireplace("&quot","",$str);
	$str = str_ireplace("#yu#","&",$str);
	$str = str_ireplace("#cxc#","&",$str);
	$str = str_ireplace("#jia#","+",$str);
	$str = str_ireplace("`","&#96;",$str);
	return $str;
}

function IsMyWeb(){
$youUrl=strtolower($_SERVER['HTTP_REFERER']);
$myUrl=strtolower("http://".$_SERVER['HTTP_HOST']."/");
 if(substr($youUrl,0,strlen($myUrl))==$myUrl){
	 return 1;
 }else{
	 return 0;
 }
}

function UpImg($file,$cengci,$dir1,$dir2,$dir3,$w1,$w2){
		$size=$file['size'];
		$filename=$file["tmp_name"];//文件名
		$newfilesize = $file['size'];//文件大小
		$exts=explode("/",$file['type']); 
		$fileext=$exts[1];
		$pinfo=pathinfo($file["name"]);//文件信息数组
		$fileTypes = array('jpg','jpeg','gif','png','bmp'); // File extensions	

		//$ext=$fileext=strtolower($pinfo["extension"]);//转为小写
		$infos= getimagesize($file['tmp_name']);//获取文件相关信息,可以获取图片宽高等，var_dump($infos)输出数组看看
		$arr=explode("/",end($infos));
		$ext=$fileext=strtolower($arr[1]);//获取真实的文件后缀
		 
		$oldwidth=$infos[0];
		$oldheight=$infos[1];
		$bilv=($oldwidth/$oldheight);
        $bilv=round($bilv, 6);
		

		$w1=$w1; //小图宽度
		$h1=$w1/$bilv;
		$w2=$w2;  //中图宽度
		$h2=$w2/$bilv;
		$pathstr="";
		if (in_array($fileext,$fileTypes)){
			$bilv=round($bilv, 6);
			$newname=date("YmdHis").$rannum;
			//$newname=str_ireplace(".".$ext,"",$filename);
			$bilv=round($bilv, 6);
			$newname=date("YmdHis").$rannum;
			//$newname=str_ireplace(".".$ext,"",$filename);
			$name=basename($file["tmp_name"]);
            //$newid=addimages($name,$src,$color);
			$newid=1;
			$newname=$newname."_".$newid."_".$bilv;        //名称格式：数字+images表id+图片宽高比率 例214111111_2_0.2.jpg

			
			//$filename=$file["name"];

			

			if($dir1==$dir2&&$dir2==$dir3){
				$small_src=$dir1.$newname.".".$ext;
				$mid_src=$dir2.$newname.".".$ext.".".$ext;
				$big_src=$dir3.$newname.".".$ext.".".$ext.".".$ext;
			}else{
				$small_src=$dir1.$newname.".".$ext;
				$mid_src=$dir2.$newname.".".$ext;
				$big_src=$dir3.$newname.".".$ext;
			}
			
			
			
			$small_fullpath=$cengci.$small_src; //小图路径
			$mid_fullpath=$cengci.$mid_src; //中图路径
			$big_fullpath=$cengci.$big_src; //大图路径

			if(move_uploaded_file($file['tmp_name'],$big_fullpath)){
                    $imginfo= getimagesize($big_fullpath); 
					//print_r($imginfo); 
					$arr=explode("/",end($imginfo));
					$shiji_ext=$arr[1];
				  if(trim($shiji_ext)=="png"){
					$thisim = imagecreatefrompng($big_fullpath);
				  }else if(trim($shiji_ext)=="gif"){
					$thisim = imagecreatefromgif($big_fullpath);
				  }else if(trim($shiji_ext)=="bmp"){
					$thisim =imagecreatefromwbmp($big_fullpath); 
				  }else if(trim($shiji_ext)=="jpg"){
					$thisim =imagecreatefromjpeg($big_fullpath); 
				  }else{
					$thisim = imagecreatefromjpeg($big_fullpath);	
				  }	
				  $oldwidth= imagesx($thisim);
				  $oldheight=imagesy($thisim);
				   if($GLOBALS["is_small"]==1){
				     $maxwidth=$_width=$w1;
				     $maxheight=$h1;
				     $_height=$_width/$bilv;
				     SavePhoto($thisim,$maxwidth,$maxheight,$_width,$_height,0,0,$small_fullpath);//小图
				   }
				   if($GLOBALS["is_mid"]==1){
					 $maxwidth=$_width=$w2;
					 $maxheight=$h2;
					 $_height=$_width/$bilv;
					 SavePhoto($thisim,$maxwidth,$maxheight,$_width,$_height,0,0,$mid_fullpath);//中图
				   }
				  $input_type=trim($_REQUEST["input_type"]);
				  $pathstr=$big_src;

				  if($input_type=="小图"){
					  $pathstr=$small_src;
				  }
				  if($input_type=="中图"){
					  $pathstr=$mid_src;
				  }
				  $color = imagecolorat($thisim,1,1);
				  $color=dechex($color);//转为16进制
                  $src=$pathstr;
				  //updateimages($src,$color,$newid);
				  //echo $pathstr;
			}
		}
		return $pathstr;
}

function img_add_shuiyin($cengci,$oldpath,$newpath,$opt,$fontpath="../../../../include/font/msyh.ttf"){
		$dst_path = $oldpath;
		//创建图片的实例
		$x=0;
		$y=0;
		if(is_numeric($opt["x"])){$x=$opt["x"];}
		if(is_numeric($opt["y"])){$y=$opt["y"];}
		
		if($opt["type"]=="text"&&$opt["text"]!=""){
			 $dst = imagecreatefromstring(file_get_contents($dst_path));
			//打上文字
			 $font = $fontpath;//字体
			 $fontsize=12;
			 $rgb=hex2rgb("#666666");
			 if(isset($opt["color"])&&trim($opt["color"])!=""){
			   $rgb=hex2rgb($opt["color"]);
			 }
			 if(is_numeric($opt["size"])){$fontsize=$opt["size"];}
			// var_dump($rgb);
			 $imagecolor = imagecolorallocate($dst, $rgb["r"], $rgb["g"], $rgb["b"]);//字体颜色
			 imagefttext($dst, $fontsize, 0, $x, $y+$fontsize, $imagecolor, $font, $opt["text"]);
			 imagejpeg($dst, $newpath, 95); //输出到目标文件
			 imagedestroy($dst); //销毁内存数据流

		}
		if($opt["type"]=="img"&&$opt["src"]!=""&&is_file($cengci.$opt["src"])){
						$src_path = $cengci.$opt["src"];
						//创建图片的实例
						$dst = imagecreatefromstring(file_get_contents($dst_path));
						$src = imagecreatefromstring(file_get_contents($src_path));
						//获取水印图片的宽高
						list($src_w, $src_h) = getimagesize($src_path);
						//将水印图片复制到目标图片上，最后个参数50是设置透明度，这里实现半透明效果
						//imagecopymerge($dst, $src, 10, 10, 0, 0, $src_w, $src_h, 50);
						//如果水印图片本身带透明色，则使用imagecopy方法
						
						imagecopy($dst, $src, $x, $y, 0, 0, $src_w, $src_h);
						imagejpeg($dst, $newpath, 95); //输出到目标文
						imagedestroy($dst); //销毁内存数据流
						imagedestroy($src); //销毁内存数据流
						
		}
}
function pdf_add_shuiyin($cengci,$oldpath,$newpath,$opt){

					   $x=0;
					   $y=0;
					   $w=0;
					   $h=0;
					   $fontsize=12;
					   $text=date('Y-m-d');
					    $link="";
						$type="text";
						$src="";
                      // var_dump($pdfconf);
						if(is_numeric($opt["size"])){$fontsize=$opt["size"];}
						if(is_numeric($opt["x"])){$x=$opt["x"];}
						if(is_numeric($opt["y"])){$y=$opt["y"];}
						if(trim($opt["text"])!=""){$text=$opt["text"];}
						if(trim($opt["link"])!=""){$link=$opt["link"];}
						if(trim($opt["type"])!=""){$type=$opt["type"];}
						if(trim($opt["src"])!=""){$src=$opt["src"];}
						if($type=="text"&&$text==""){
						 return false;
						}
						if($type=="img"){
							 if($src==""){
							   return false;
							 }else if(!is_file($cengci.$src)){
							   return false;
							 }
						}
						//echo "../../../../".$src;
						//exit();
						require_once($cengci.'include/pdf/fpdf/fpdf.php');
						require_once($cengci.'include/pdf/fpdi/fpdi.php');
						
						//word_watermark
						$pdf = new FPDI();
						// get the page count
			
						$pageCount = $pdf->setSourceFile($oldpath);
						// iterate through all pages
						for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++)
						{
							// import a page
							$templateId = $pdf->importPage($pageNo);
						 
							// get the size of the imported page
							$size = $pdf->getTemplateSize($templateId);
						 
							// create a page (landscape or portrait depending on the imported page size)
							if ($size['w'] > $size['h']) $pdf->AddPage('L', array($size['w'], $size['h']));
							else $pdf->AddPage('P', array($size['w'], $size['h']));
							// use the imported page
							
							$pdf->useTemplate($templateId);
							 if($type=="img"){
							      $img_info = getimagesize($cengci.$src);
								  $w=$img_info[0];
								  $h=$img_info[1];
								  
								  $pdf->image($cengci.$src, $x, $y, $w,$h,"",$link);
		
							 }else{
								  $pdf->SetFont('Arial','B',$fontsize);
							// sign with current date
								  $pdf->SetXY($x, $y); // you should keep testing untill you find out correct x,y values
								  $pdf->Write(7, $text);
							 }
							 //
						 
						}
						$pdf->Output($newpath);
}
/**
 * 十六进制 转 RGB
 */
function islinux(){
	   $str=php_uname();
	  if(strpos($str,"Linux")!==false){
		 return true;
		 
	  }else{
		 return false;
	  }
}
function get_iconv($charset1,$charset2,$str){
	
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
function hex2rgb($hexColor) {
	$color = str_replace('#', '', $hexColor);
	if (strlen($color) > 3) {
		$rgb = array(
			'r' => hexdec(substr($color, 0, 2)),
			'g' => hexdec(substr($color, 2, 2)),
			'b' => hexdec(substr($color, 4, 2))
		);
	} else {
		$color = $hexColor;
		$r = substr($color, 0, 1) . substr($color, 0, 1);
		$g = substr($color, 1, 1) . substr($color, 1, 1);
		$b = substr($color, 2, 1) . substr($color, 2, 1);
		$rgb = array(
			'r' => hexdec($r),
			'g' => hexdec($g),
			'b' => hexdec($b)
		);
	}
	return $rgb;
}

function isdeletefileroot($fullpath,$m=5){ //文件路径，分钟；在过期内有删除权限，
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
	function writefile($fullpath,$str){//写入文件
	            if(!is_file($fullpath)){
		           $dirn=getpathdir($fullpath,1);
			       CreateDir($dirn);
		        }
				$fo = fopen(get_iconv("UTF-8","GB2312",$fullpath),"w");
				@fwrite($fo,$str);
				fclose($fo);

	 }
	 function read_file($fullpath,$charset="UTF-8"){
	   return file_get_contents(get_iconv("UTF-8","GB2312",$fullpath));
	 }
	function getpathdir($path,$cc=1){//获取文件所在的文件夹
	     $arr=explode("/",$path);

		 $dir="";
	     for($i=0;$i<(count($arr)-$cc);$i++){
		    $dir.=$arr[$i]."/";
		 }
		 return $dir;
	}
	function getpathname($path){//获取文件所在的文件夹
	     $arr=explode("/",$path);
		 return $arr[count($arr)-1];
	}
	function getpathext($path){//获取文件后缀
	     $arr=explode(".",$path);
		 return $arr[count($arr)-1];
	}
	function getpathinfo($fullpath){
	    $ext=".json";
		  if(is_file($fullpath.$ext)){
					  $info=json_decode(file_get_contents($fullpath.$ext),true);
		  }else{
					  $path=str_ireplace("../","",$fullpath);
					  $info["src"]=$path;
					  $info["title"]=getpathname($fullpath);
					  $info["size"]=0;
					  if(is_file($fullpath)){
					     $info["size"]=filesize($fullpath);
					  }
					  $info["ext"]=getpathext($fullpath);
					  $info["md5"]=md5($path);
		  }
	      return $info;
	}
// base64格式编码转换为图片并保存
function base64_image($base64_content,$path){
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
?>