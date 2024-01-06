<?php
  function req($key,$typ="text"){
            $v=checkvalues($_REQUEST[$key]);
			if($typ=="int"){
			  if(!is_numeric($v)||trim($v)==""){
			    $v=0;
			  }
			}
			return $v;
  }
  function req_post($key,$typ="text"){
            $v=checkvalues($_POST[$key]);
			if($typ=="int"){
			  if(!is_numeric($v)||trim($v)==""){
			    $v=0;
			  }
			}
			return $v;
  }
  function req_get($key,$typ="text"){
            $v=checkvalues($_GET[$key]);
			if($typ=="int"){
			  if(!is_numeric($v)||trim($v)==""){
			    $v=0;
			  }
			}
			return $v;
  }
  function checkvalues($arr){//遍历过滤数组
  if(is_array($arr)){
     foreach($arr as $k =>$v){
      if(is_array($v)){
       $arr[$k]=checkvalues($v);
      }else{
       $arr[$k]=checksql($v);
      }
     }
	 }else{
	   $arr=checksql($arr);
	 }
     return $arr;  
 }
   function posts(){
            $v=array();
            if($_POST){
            $v=checkvalues($_POST);
			}
			return $v;
  }
   function gets(){
            $v=checkvalues($_GET);
			return $v;
  }
?>
