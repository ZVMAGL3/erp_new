<?php 
  if(!session_id()) session_start();	//初始化会话数据

  header("Access-Control-Allow-Origin:*");

  include_once '../../../session.php';
  include("../../../inc/config.php");
 
  error_reporting(E_ALL & ~ E_NOTICE);	//屏蔽没有必要的错误提示，如变量未定义
  date_default_timezone_set('PRC');//设成北京时间
  define("DB_QZ",$dbconfig["tableqz"]);//表前缀
  define("DB_IP",$dbconfig["ip"]); //数据库ip
  define("DB_ROOT",$dbconfig["username"]);      //数据库登录名
  define("DB_PASSWORD",$dbconfig["password"]);  //数据库登录密码
  define("DB_NAME", $dbconfig["dbname"]); //数据库名
  define("DB_CONNECT_ERROR",'连接数据库出错!');
  define("DB_DATABASE_ERROR",'选择数据库不存在!');
  include("config.php");
  include("hcupload.class.php");
  include("db.php");

ob_clean();

$act=$_REQUEST["act"];


//if(IsMyWeb()==0){
//	echo "非法提交"; //不是通过本网站提交
//	exit();
//}
/*删除图片*/
$myupload=new hcupload($config);

$cengci=$config["g_cengci"];

$index="";
if(isset($_POST["index"])){
	$index=intval($_POST["index"]);
}else if(isset($_POST["chunk"])){
	$index=intval($_POST["chunk"])+1; 
}
if($index==1){
    $myupload->delfolder($cengci."tmp/",24*60*60*4);//删除过期垃圾文件,超过4天的
}
if($act=="dirconfig"){
	$res["g_dirtou"]=$config["g_dirtou"];
	$res["g_dir1"]=$config["g_dir1"];
	$res["g_dir2"]=$config["g_dir2"];
	$res["g_dir3"]=$config["g_dir3"];
	$res["g_dir4"]=$config["g_dir3"];
	$res["g_dir_other"]=$config["g_dir_other"];
	$res["g_dir_mp4"]=$config["g_dir_mp4"];
	$res["g_dir_mp3"]=$config["g_dir_mp3"];
	$res["g_dir_video"]=$config["g_dir_video"];
	$res["g_dir_swf"]=$config["g_dir_swf"];
	$res["newdir"]=date("Ym");
	echo json_encode($res);
	exit();
}
$tablename="msc_renzhengmoban_files";

if($act=="del"){
   $mydb=new db(DB_IP,DB_NAME,DB_ROOT,DB_PASSWORD,DB_QZ);
   $idno=$mydb->checksql(trim($_POST["idno"]));
   if($idno!=""){
        $info=$mydb->selectone("select * from ".$tablename." where idno='".$idno."'");
		if($info){
		    $path=$info["src"];
			$mydb->query("delete from ".$tablename."  where id=".$info["id"]);
		}
   }else{
      $path=trim($_POST["src"]); 
   }

   $res=$myupload->del($cengci,$path);
   echo json_encode($res);
}
if($act=="up"){
   $res=$myupload->up($cengci);
  if($res["status"]=="success"){
         $tidno=trim($_POST["tidno"]);
		 $mydb=new db(DB_IP,DB_NAME,DB_ROOT,DB_PASSWORD,DB_QZ);
		 $img_data=$res["row"];
		 $img_data["src"]=$res["row"]["src"];
		 $img_data["title"]=$res["row"]["name"];
	  	 $img_data["sort"]=0;
		 $img_data["tidno"]=$mydb->checksql($_POST["tidno"]);
		 $res["row"]["tidno"]=$img_data["tidno"];
		 $sys_Id_MenuBigClass=$mydb->checksql(trim($_POST["sys_Id_MenuBigClass"]));
		 if($sys_Id_MenuBigClass!=""){
			 $img_data["sys_Id_MenuBigClass"]=$sys_Id_MenuBigClass;
		 }
		 $images_id=$mydb->add($tablename,$img_data);//录入一条记录
		 $res["row"]["id"]=$images_id;
  }
	echo json_encode($res);
}
if($act=="sort"){
	 $mydb=new db(DB_IP,DB_NAME,DB_ROOT,DB_PASSWORD,DB_QZ);
   $num=intval($_POST["num"]);
   $res["status"]="1";
   $successnum=0;
   for($i=0;$i<$num;$i++){
	    $idno=$mydb->checksql(trim($_POST["idno_".$i]));
		$data=array();
		$data["sort"]=intval($_POST["sort_".$i]);
		$mydb->update("`".$tablename."`",$data," where idno='".$idno."' "); 
		$successnum++;
   }
	$res["msg"]="已更新".$successnum."条";
	$res["num"]=$successnum;
   echo json_encode($res);
   exit();
}
if($act=="list"){
	$res=array();
	$mydb=new db(DB_IP,DB_NAME,DB_ROOT,DB_PASSWORD,DB_QZ);
	$tidno=$mydb->checksql($_REQUEST["tidno"]);
	$data=$mydb->selectall("select size,ext,filetype,id,idno,tidno,src,title as name from ".$tablename." where tidno='".$tidno."' order by sort asc,id desc");
	$res["data"]=$data;
	echo json_encode($res);
	exit();
	  
}
 

if($act=="fileinfo"){
    $res=$myupload->fileinfo($cengci,$_REQUEST["path"]);
	echo json_encode($res);
};
 
if($act=="save_base64"){
    $res=$myupload->save_base64($cengci);
	echo json_encode($res);
}
if($act=="wxshareconfig"){
	 //require_once "wxshare.class.php";
	 //$jssdk = new JSSDK("yourAppID", "yourAppSecret");
	 //$myshare = new WxShare("wx178e36d14219ff7c", "87906a9dba484de5a851207ee963c630");
	 //$myshare = new WxShare("wx80a85edde01f10e3", "69418053a1ddbbbeb88deb86c02037c0");
	 $myshare = new WxShare("wxe2f47f7b772651e2", "8ceeb146bd8dbc6cf19a29b383c70d9b");
	//https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx1e9a89abda38241c&secret=16ac592f16cf007cece9eaea53177d24
	 $url=$_REQUEST["url"];
	 $signPackage = $myshare->getSignPackage($url);
	//$signPackage["wxticket"]=get_ticket(urlencode($url));
	 echo json_encode($signPackage);
}
if($act=="insert" &&$_POST){
	     
		 $mydb=new db(DB_IP,DB_NAME,DB_ROOT,DB_PASSWORD,DB_QZ);
		 $res=array();
		 $res["status"]="error";
		 $res["msg"]="失败";
		 $data=$_POST;
		 $title=$mydb->checksql($data["title"]);
		if($data&&$title!=""&&is_numeric($data["size"])){
			$time=time();
			$idno = md5($title.uniqid(rand()));
	
			$img_data=array();
			$img_data["title"]=$title;
			$img_data["path"]=$data["path"];
			$img_data["small_src"]=$data["small_src"];
			$img_data["size"]=$data["size"];
			$img_data["time"]=$time;
			$img_data["status"]=0;
			$img_data["md5"]=md5($title."".$size."".$ext.$data["filetype"]);
			$img_data["idno"]=$idno;
			$img_data["sys_adddate"]=date("Y-m-d H:i:s",$time);
			$img_data["ext"]=$data["ext"];
			$img_data["tidno"]=$data["tidno"];
			$img_data["lastModified"]=$data["lastModified"];
			$img_data["filetype"]=$data["filetype"];
			
	 
			 $images_id=$mydb->add($tablename,$img_data);//录入一条记录
 
			 $res["status"]="success";
			 $res["msg"]="添加成功";
			 $res["row"]["name"]=$title;
			 $res["row"]["ext"]=$img_data["ext"];
			 $res["row"]["id"]=$images_id;
			 $res["row"]["idno"]=$idno;
			 $res["row"]["src"]=$img_data["small_src"];
			 $res["row"]["tidno"]=$img_data["tidno"];
			
		 }
		echo json_encode($res);
 
}

?>

