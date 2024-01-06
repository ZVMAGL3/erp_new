<?php 
if(!session_id()) session_start();	//初始化会话数据
//include("../../../function/db_config.php");
 //header("Access-Control-Allow-Methods:OPTIONS,POST,GET");
 header("Access-Control-Allow-Origin:*");

 include("config.php");
 include("db_config.php");
 include("db.php");
$mydb=new db(DB_IP,DB_NAME,DB_ROOT,DB_PASSWORD,DB_QZ);
?>
<?php include("hcupload.class.php");?>
<?php 
ob_clean();

$act=$_REQUEST["act"];


//if(IsMyWeb()==0){
//	echo "非法提交"; //不是通过本网站提交
//	exit();
//}
/*删除图片*/
 
$cengci=$config["g_cengci"];

$myupload=new hcupload($config);

$index="";
if(trim($_POST["index"])!=""){
	  $index=intval($_POST["index"]);
}else if(trim($_POST["chunk"])!=""){
	  $index=intval($_POST["chunk"])+1; 
}
if($index==1){
      $myupload->delfolder($cengci."tmp/",24*60*4);//删除过期垃圾文件,超过4天的
}



if($act=="del"){
   $idno=$mydb->req_post("idno");
   $path="";
   $info=$mydb->getrow("select * from ".DB_QZ."files where idno='".$idno."'");//也可以用selectone
 
   if($info){
	   $path=$info["src"];  
	 
	   $mydb->query("delete from  `".DB_QZ."files` where id='".$info["id"]."'"); 
   }
 
   $res=$myupload->del($cengci,$path);
   
   echo json_encode($res);
   exit();
}
if($act=="status"){
   $idno=$mydb->checksql($_REQUEST["idno"]);
   $path="";
   $info=$mydb->getrow("select id,idno from ".DB_QZ."files where idno='".$idno."'");
   $res["status"]="0";
   $res["msg"]="错误";
   if($info){
       $data["status"]=$mydb->req_post("status");;
	   $mydb->update("`".DB_QZ."files`",$data," where id='".$info["id"]."'"); 
	   $res["msg"]="已更新";
	   $res["status"]="1";
   }
   echo json_encode($res);
   exit();
}
if($act=="sort"){
   $num=intval($_POST["num"]);
   $res["status"]="1";
   $successnum=0;
   for($i=0;$i<$num;$i++){
		$idno=$mydb->req_post("idno_".$i);
		$data=array();
		$data["sort"]=intval($mydb->req_post("sort_".$i));
		$mydb->update("`".DB_QZ."files`",$data," where idno='".$idno."' "); 
		$successnum++;
   }
	$res["msg"]="已更新".$successnum."条";
	$res["num"]=$successnum;
   echo json_encode($res);
   exit();
}

 if($act=="update"){
   $idno=$mydb->checksql($_POST["data-idno"]);
   $title=$mydb->checksql($_POST["title"]);
   $path="";
   $info=$mydb->getrow("select id,idno from ".DB_QZ."files where idno='".$idno."'");
   $res["status"]="0";
   $res["msg"]="错误";
   if($info){
	   $data["title"]=$title;
	   $mydb->update("`".DB_QZ."files`",$data," where id='".$info["id"]."'"); 
	   $res["msg"]="已更新";
	   $res["status"]="1";
   }
   echo json_encode($res);
   exit();
}
if($act=="list"){

      $tidno=$mydb->checksql($_REQUEST["tidno"]);
	  $type=intval($mydb->checksql($_REQUEST["type"]));
	   $addsql="";
	  $addsql.=" and a.tidno='".$tidno."'";
	  if(trim($_REQUEST["type"])!=""){
	    $addsql.=" and a.type='".$type."'";
	  }
      $data=$mydb->selectall("select a.*,title as name from ".DB_QZ."files as a where 1=1 ".$addsql." order by a.sort asc,a.id");
	  $res["data"]=$data;
	  echo json_encode($res);
	  exit();
	  
}
if($act=="up"){	
 
  $res=$myupload->up($cengci);
  if($res["status"]=="success"){
     $img_data=$res["row"];
	 $img_data["tidno"]=$mydb->checksql($_POST["tidno"]);
 	 $img_data["type"]=intval($mydb->checksql($_POST["type"]));
	 
	 $res["row"]["tidno"]=$img_data["tidno"];
	 $res["row"]["type"]=$img_data["type"];
	 
	 $images_id=$mydb->add(DB_QZ."files",$img_data);//录入一条记录
	 $res["row"]["id"]=$images_id;
  }
  echo json_encode($res);
}
if($act=="autosave"){
   $res=$myupload->autosave($cengci);
	echo json_encode($res);
};

if($act=="fileinfo"){
  $res=$myupload->fileinfo($cengci,$_REQUEST["path"]);
	echo json_encode($res);
};

if($act=="getsave"){
   $res=$myupload->getsave($cengci);
	echo json_encode($res);
}
if($act=="save_base64"){
   $res=$myupload->save_base64($cengci);
	echo json_encode($res);
}
if($act=="up_one"){
    $res=$myupload->up_one($cengci);
	echo json_encode($res);
}
 


//http://blog.chinaunix.net/uid-15223977-id-2774358.html
?>

