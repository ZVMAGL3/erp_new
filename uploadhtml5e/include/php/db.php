<?php
class db
{
	public $connStr="";
	public $updateStr="";
	public $db_host="";
	public $db_name="";
	public $db_user="";
	public $db_password="";
	public $qz="";//表前缀
	public $tabletou="";//表前缀
	public $config=array ();
	public $field_="*";
	public $table_="";
	public $where_="";
	public $order_="";
	public $isshowsql=false;
	function __construct($db_host="",$db_name="",$db_user="",$db_password="",$table_qz=""){
		$this->db_host=$db_host;
		$this->db_name=$db_name;
		$this->db_user=$db_user;
		$this->db_password=$db_password;
		$this->qz=$table_qz;
		$this->tabletou=$table_qz;
		//mysql_query("SET GLOBAL group_concat_max_len=102400;");
		if(PHP_VERSION>"7"){
		   $this->conn=@mysqli_connect($this->db_host,$this->db_user,$this->db_password);//连接数据库
		    mysqli_query($this->conn,"set names utf8");//有的空间不允许设编码
		  // mysqli_set_charset($this->conn,'UTF-8'); // 设置数据库字符集
		  //  mysqli_query("set names utf8");//有的空间不允许设编码
		}else{

		    $this->conn=@mysql_connect($this->db_host,$this->db_user,$this->db_password);//连接数据库
		     mysql_query("set names utf8");//有的空间不允许设编码
		    //mysql_set_charset($this->conn,'UTF-8'); // 设置数据库字符集
		}
		$this->myconnStr();
		
	}

	function getvalue($sql_,$nulltext_=""){
		   if(stripos($sql_,"limit")===false){
			     $rs=$this->query($sql_." limit 0,1");
		   }else{
				  $rs=$this->query($sql_."");
		   }
			$str0_="";
			 if($rs){
				   if(PHP_VERSION>"7"){
					   while($row=mysqli_fetch_array($rs)){
								  $str0_="".$row[0]."";
					   }
				   }else{
				   
						while($row=mysql_fetch_array($rs)){
							$str0_="".$row[0]."";
						}
				   }
				}

			
			if($str0_==""){
			  $str0_=$nulltext_;
			}
			return $str0_;
	}
	function myconnStr()
	{
		//mysql_query("set names utf8");
		if(!$this->conn){
			   header("Content-Type: text/html; charset=UTF-8");
			   echo "数据库连接不上";
			   exit();
		}
		if(PHP_VERSION>"7"){
			$myDB=@mysqli_select_db($this->conn,$this->db_name);
			//mysqli_error();
			if(!$myDB)
			{
				 header("Content-Type: text/html; charset=UTF-8");
				echo "数据库选择错误：不存在".$this->db_name."数据库";
				exit();
			}
		}else{
			$myDB=@mysql_select_db($this->db_name,$this->conn);
			if(!$myDB)
			{
				 header("Content-Type: text/html; charset=UTF-8");
				 echo "数据库选择错误：不存在".$this->db_name."数据库";
				 exit();
			}
		}
		return $this->conn;
	}
	function getrowcount($sql){
	  if(PHP_VERSION>"7"){
		  $rs=mysqli_query($this->conn,$sql);
		   if($rs){
		   return mysqli_num_rows($rs);
		   }else{
		    return 0;
		   }
	  }else{
	       $rs=mysql_query($sql,$this->conn); 
		   if($rs){
		   return mysql_num_rows($rs);
		   }else{
		    return 0;
		   }
	  }
	}
	function query($sql)
	{
			$arr=explode("[query]",$sql);
			$len=sizeof($arr);
			if($this->isshowsql){
			   echo $sql;
			}
			for($i=0;$i<$len;$i++){
			$arr[$i]=trim($arr[$i]);
			// echo $arr[$i];
				if($arr[$i]!=""){
					 $rs=(PHP_VERSION>"7"?mysqli_query($this->conn,$arr[$i]):mysql_query($arr[$i],$this->conn));
	
					 if(!$rs)
					 {
						 header("Content-Type: text/html; charset=UTF-8");
						 if(PHP_VERSION>"7"){
							 
							mysqli_error();
						 }else{
							 mysql_error();
						 }
						 die("执行失败!".$arr[$i]);
					  //exit();
					}	
				}
			}
			$this->isshowsql=false;
			//echo "执行成功!"	.$sql;
			return $rs;
	}
	function getrow($sql_){
	        $this->sql=$sql_;
			$rs=$this->query($sql_);
			$row=(PHP_VERSION>"7"?mysqli_fetch_array($rs):mysql_fetch_array($rs));
			return $row;
	}
	function selectone($tablename,$where="",$field="*")
	{
	   global $Web,$W;
	   $wherestr="";
        //if(strpos($tablename,DB_QZ)===false){$tablename=$tablename;}
	   if(is_array($where)){
	     
				 foreach($where as $key=>$val){
					if($wherestr!=""){
					   $wherestr.=" and `$key`='".$val."'";
					}else{
					   $wherestr.=" where `$key`='".$val."'";
					}
				 }
				 $sql="select {$field} from ".$tablename." ".$wherestr." limit 0,1";
	   }else if($where!=""){
	      $wherestr=$where;
		  if(strpos($wherestr,"where")===false){
		    $wherestr=" where ".$wherestr;
		  }
		  $sql="select {$field} from ".$tablename." ".$wherestr." limit 0,1";
         //echo $sql;
	   }else{
	       $sql=$tablename;
		   if(strpos($sql," limit ")===false&&(strpos($sql,"SHOW ")===false)){
		        $sql.=" limit 0,1";
		   }
	   }
	   
	 
       $this->sql=$sql;


		
	   $rs=$this->query($sql);


	   $row=(PHP_VERSION>"7"?mysqli_fetch_assoc($rs):mysql_fetch_assoc($rs));
	   
	   $one=null;

	   if(is_array($row)){
			foreach($row as $key=>$val){
			      $one[$key]=$this->unchecksql($val);
			}
		}
		
	   $site=$Web["siteurl"];
	   if($Web["siteurl"]==""){
	   $site=$W["site"];
	   }
	   if(isset($row["content"])){
          $row["content"]= str_ireplace("src=\"file/","src=\"".$Web["siteurl"]."file/",$row["content"]);
	   }
	   return $one; 
	}
	function table($table){
	  $this->table_=$table;
	  return $this;
	}
	function where($whe=""){
	     $this->where_=$whe;
		  if(strpos($whe,"where")===false&&$whe!=""){
			 $this->where_=" where ".$whe;
		  }
		return $this;
	}
	function limit($limit){
	     $this->limit_=" limit ".$limit;
		 return $this;
	}
	function field($field){
	     $this->field_=$field;
		 return $this;
	}
	function order($order){
	     $this->order_=" order by ".$order;
		 return $this;
	}
	function delete($sql="",$where=""){
	   if(isset($sql)&&$sql!=""&&$where==""){
  
	          return $this->query($sql);
	   }else if($sql!=""&&$where!=""){
           $tablename=$sql;
		  if(strpos($where,"where")===false&&$where!=""){
			 $where=" where ".$where;
		  }
		 //if(strpos($tablename,DB_QZ)===false){$tablename=$tablename;}
	      $sql="delete  from `".$tablename."` ".$where;
		   return $this->query($sql);
	   }else{
		       $sql="delete  from `".$this->table_."` ".$this->where_;
			   $this->table_="";
			   $this->where_="";
			   $this->sql=$sql;
			   return $this->query($sql);
	   }
	}
	function select($table="",$where="",$field="*",$limit="")
	{
		   global $Web,$W;
		    $list=array();
		   if(isset($table)&&$table!=""){
		           $wherestr="";
				   if($where==""){
					    $sql=$table;   
				   }else{
				    
					   if(is_array($where)){
						 foreach($where as $key=>$val){
							if($wherestr!=""){
							   $wherestr.=" and `$key`='".$val."'";
							}else{
							   $wherestr.=" where `$key`='".$val."'";
							}
						 }
					   }else{
						  $wherestr=$where;
						  if(strpos($wherestr,"where")===false){
							$wherestr=" where ".$wherestr;
						  }
					   }
					   $sql="select {$field} from ".$table." ".$wherestr.$limit;
				   }
				   $this->sql=$sql;
				   $rs=$this->query($sql);
				    if($rs){
					   if(PHP_VERSION>"7"){
						   while($row=mysqli_fetch_assoc($rs)){
									   unset($one);
										foreach($row as $key=>$val){
												$one[$key]=$this->unchecksql($val);
										}
										$list[]=$one;
										
						   }
					   }else{
						   while($row=mysql_fetch_assoc($rs)){
									   unset($one);
										foreach($row as $key=>$val){
												$one[$key]=$this->unchecksql($val);
										}
										$list[]=$one;
										
						   }
					   }
				   }
		   }else{
		       $sql="select ".$this->field_." from `".$this->table_."` ".$this->where_.$this->order_.$this->limit_;
			   $this->field_="*";
			   $this->table_="";
			   $this->where_="";
			   $this->order_="";
			   $this->limit_="";
			   $this->sql=$sql;
			   $rs=$this->query($sql);
			    if($rs){
					   if(PHP_VERSION>"7"){
						   while($row=mysqli_fetch_assoc($rs)){
									   unset($one);
										foreach($row as $key=>$val){
												$one[$key]=$this->unchecksql($val);
										}
										$list[]=$one;
										
						   }
					   }else{
						   while($row=mysql_fetch_assoc($rs)){
									   unset($one);
										foreach($row as $key=>$val){
												$one[$key]=$this->unchecksql($val);
										}
										$list[]=$one;
										
						   }
					   }
			   }
		   };
		   return $list; 
	}
	function selectall($sql)
	{
		            global $Web,$W;
				   $this->sql=$sql;
				   $rs=$this->query($sql);
				   $list=array();
				    if(PHP_VERSION>"7"){
					       if($rs){
						   while($row=mysqli_fetch_assoc($rs)){
									   unset($one);
										foreach($row as $key=>$val){
												$one[$key]=$this->unchecksql($val);
										}
										$list[]=$one;
										
						   }
						   }
				   }else{
				          if($rs){
								   while($row=mysql_fetch_assoc($rs)){
											   unset($one);
												foreach($row as $key=>$val){
													$one[$key]=$this->unchecksql($val);
												}
												$list[]=$one;
												
								   }
						   }
				   }
		   
		   return $list; 
	}
	////////////////////////
	function editsql($myarr,$table){
					if(PHP_VERSION>"7"){
							$rs_table_desc=mysqli_query($this->conn,"DESCRIBE fs_product_class");
							 if($rs_table_desc){
							while($rs_table_desc_row=mysqli_fetch_assoc($rs_table_desc)){
								$myField[]=$rs_table_desc_row['Field'];
								$myType[]=$rs_table_desc_row['Type'];
								$myNull[]=$rs_table_desc_row['Null'];
								$myKey[]=$rs_table_desc_row['Key'];
								$myDefault[]=$rs_table_desc_row['Default'];
								$myExtra[]=$rs_table_desc_row['Extra'];	  
							};
							}
					}else{
						$rs_table_desc=mysql_query("DESCRIBE fs_product_class",$this->conn);
						while($rs_table_desc_row=mysql_fetch_assoc($rs_table_desc)){
							$myField[]=$rs_table_desc_row['Field'];
							$myType[]=$rs_table_desc_row['Type'];
							$myNull[]=$rs_table_desc_row['Null'];
							$myKey[]=$rs_table_desc_row['Key'];
							$myDefault[]=$rs_table_desc_row['Default'];
							$myExtra[]=$rs_table_desc_row['Extra'];	  
						};
					}
					$_updateStr="";
					$myi=1;
					foreach($myarr as $key1 => $val1){
						$isBool=0;
						for($i=0;$i<count($myField);$i++){
						if($myField[$i]==$key1){
							  $isBool=1;
							  $p='';
							  $typeName=explode("(",$myType[$i]);
							 if($typeName[0]=="int"||$typeName[0]=="smallint"||$typeName[0]=="mediumint"){
							 $p="";
							 }else if($typeName[0]=="bigint"||$typeName[0]=="float"||$typeName[0]=="double"||$typeName[0]
				
				=="decimal"){
							 $p="";
							 }else if($typeName[0]=="varchar"||$typeName[0]=="tinytext"||$typeName[0]=="tinyblob"||$typeName[0]
				
				=="blob"){
							 $p="'";
							 }else if($typeName[0]=="mediumtext"||$typeName[0]=="longtext"||$typeName[0]=="longblob"){
							 $p="'";
							 }else{
							 $p="";
							 }
							 if(count($myarr)==$myi){
							  $_updateStr=$_updateStr.' '.$key1.'='.$p.$val1.$p.' ';
							  }else{
							   $_updateStr=$_updateStr.' '.$key1.'='.$p.$val1.$p.', ';
							  }
							  $this->updateStr="updata fs_product_class set ".$_updateStr; 
							  break;
						  }
						}
						$myi=$myi+1;	
						if($isBool==0)
						{
						 echo "'".$table."'表不存在'".$key1."'字段!";
						 exit();
						}
						
					}	
}
   function ishavefield($table,$name){//判断是否存在该字段
                    $tablename=$table;
                    //if(strpos($table,DB_QZ)===false){
				       //$tablename=DB_QZ.$table;
				    //}
		            $sql_columns="SHOW COLUMNS FROM ".$tablename." ";
					$rs_columns=$this->query($sql_columns);
					$filedstr="";
					if(PHP_VERSION>"7"){
						while($row=mysqli_fetch_assoc($rs_columns)){
						  if($row['Field']==$name){
							return true;
						  }
						}
					}else{
						while($row=mysql_fetch_assoc($rs_columns)){
						  if($row['Field']==$name){
							return true;
						  }
						}
					}
					return false;
  }
   function add($table,$data){
	                
                    $tablename=$table;
                    //if(strpos($table,DB_QZ)===false){
				      //$tablename=DB_QZ.$table;
				    //}
		            $sql_columns="SHOW COLUMNS FROM ".$tablename." ";
					$rs_columns=$this->query($sql_columns);
					$filedstr="";
					if(PHP_VERSION>"7"){
						while($row=mysqli_fetch_assoc($rs_columns)){
						  $filedstr.="`".$row['Field']."`,";
						}
					}else{
						while($row=mysql_fetch_assoc($rs_columns)){
						   $filedstr.="`".$row['Field']."`,";
						}
					}
					$filednames = '';
					$filedvalues = '';
					foreach($data as $key=>$val){
						if(stripos($filedstr,"`".$key."`")===false){
						  unset($data[$key]);
						}else{
						      if($key!="id"&&trim($val)!=""){
								  if(stripos($data[$key],"src=\"")!==false){
									 $val= str_ireplace("src=\"".$Web["siteurl"]."file/","src=\"file/",$val);
								  }
								   $filednames.="`".$key."`,";
								   $filedvalues.="'".($val)."',";
							  }
						}
					}
					$filednames = substr($filednames,0,strlen($filednames)-1); 
					$filedvalues = substr($filedvalues,0,strlen($filedvalues)-1); 
	                global $hy,$bh,$SYS_UserName,$SYS_QuanXian;//得到全局变量
					$this->sql="insert into ".$tablename."(".$filednames.",sys_yfzuid,sys_id_login,sys_login,sys_id_bumen) values(".$filedvalues.",'$hy','$bh','$SYS_UserName','$SYS_QuanXian')";

					$this->query($this->sql);
					if(PHP_VERSION>"7"){
					    return mysqli_insert_id($this->conn);
					}else{
					    return mysql_insert_id($this->conn);
					}

   }
   function update($table,$data,$where){
                   global $Web;
                   $tablename=$table;
                   //if(strpos($table,DB_QZ)===false){
				      //$tablename=DB_QZ.$table;
				   //}
                   if(strpos($where,"where")===false){
				       $where=" where ".$where;
				   }
		            $sql_columns="SHOW COLUMNS FROM ".$tablename." ";
					$rs_columns=$this->query($sql_columns);
					$filedstr="";
					if(PHP_VERSION>"7"){
						while($row=mysqli_fetch_assoc($rs_columns)){
						  $filedstr.="`".$row['Field']."`,";
						}
					}else{
						while($row=mysql_fetch_assoc($rs_columns)){
						   $filedstr.="`".$row['Field']."`,";
						}
					}
					//echo $data["openid"];
					//exit($filedstr);
					foreach($data as $key=>$val){
						if(!is_array($data[$key])&&stripos($data[$key],"src=\"")!==false){
							  $val= str_ireplace("src=\"".$Web["siteurl"]."file/","src=\"file/",$val);
							 // echo($val);
						}
						if(stripos($filedstr,"`".$key."`")===false){
						       unset($data[$key]);
						}else{
						     if($key!="id"){
							   $setsql.="`".$key."`"."='".($val)."',";
							  }
						}
					}
					
					$filednames = substr($filednames,0,strlen($filednames)-1); 
					$setsql = substr($setsql,0,strlen($setsql)-1); 
					$this->sql="update ".$tablename." set ".$setsql."  ".$where;
  
					$this->query($this->sql);
   }
 function checksql($str){

		$str=trim($str);
        global $mgl_array;
	    if(is_array($mgl_array)){
		    if(in_array($str,$mgl_array)){
			  return $str;
			}
		}
		//$str = preg_replace("/[\r\n]+/", '<br/>', $str);
		//$str = str_ireplace("\n\r","[rn]",$str);
		$mgl_str="script,iframe,and,execute,update,count,mid,master,truncate,char,create,delete,insert,drop,eval(,base64_decode";//需要过滤的单词
		$mgl_array_a=explode(",",$mgl_str);
		if(in_array(strtolower($str),$mgl_array_a)){//如是单词的则不要过滤  如值直接等于delete则免过滤 
 			return $str;
		}
		for($i=0;$i<count($mgl_array_a);$i++){
			 $val=$mgl_array_a[$i];
			 $len=strlen($val);
			 $a1=substr($val,0,1);
			 $new_val="&#".ord($a1).";".substr($val,1,($len-1)); 
		     $str = str_ireplace($val,$new_val,$str); //意思就是把script替换成&#115;cript   其&#115;在html上则会直接显示出s来，就像&nbsp;是空格意思
			 
		}
		
		//$str = str_ireplace("or","&#111;r",$str);
		//$str = str_ireplace("'","&#39;",$str);
		//$str = str_ireplace("\"","&#34;",$str);
		//$str = str_ireplace("%20","",$str);
		//$str = str_ireplace(" ","",$str);
		//$str = str_ireplace("(","&#40;",$str);
		//$str = str_ireplace(")","&#41;",$str);
		//$str = str_ireplace("*","&#42;",$str);
		//$str = str_ireplace("+","&#43;",$str);
		//$str = str_ireplace(",","&#44;",$str);
		//$str = str_ireplace("-","&#45;",$str);
		//$str = str_ireplace("<","&#60;",$str);
		//$str = str_ireplace("=","&#61;",$str);
		//$str = str_ireplace(">","&#62;",$str);
		//$str = str_ireplace("&quot","",$str);
		//$str = str_ireplace("#yu#","&",$str);
		//$str = str_ireplace("#cxc#","&",$str);
		//$str = str_ireplace("+","#jia#",$str);
		$str = str_ireplace("`","&#96;",$str);
		//$str =get_str($str,"data-scayt_word=\"","\"");
		return $str;
 }
	function unchecksql($str){
			$str=trim($str);
			$str = str_ireplace("&#115;cript","script",$str);
			$str = str_ireplace("&#97;nd","and",$str);
			$str = str_ireplace("&#101;xecute","execute",$str);
			$str = str_ireplace("&#117;pdate","update",$str);
			$str = str_ireplace("&#99;ount","count",$str);
			$str = str_ireplace("&#109;id","mid",$str);
			$str = str_ireplace("&#109;aster","master",$str);
			$str = str_ireplace("&#116;runcate","truncate",$str);
			$str = str_ireplace("&#99;har","char",$str);
			$str = str_ireplace("&#99;reate","create",$str);
			$str = str_ireplace("&#100;elete","delete",$str);
			$str = str_ireplace("&#105;nsert","insert",$str);
			$str = str_ireplace("&#105;frame","iframe",$str);
			$str = str_ireplace("&#116;rop","drop",$str);
			$str = str_ireplace("&#111;","or",$str);
			$str = str_ireplace("&#39;","'",$str);
			$str = str_ireplace("&#34;","\"",$str);
			$str = str_ireplace("%20","",$str);
			//$str = str_ireplace(" ","",$str);
			$str = str_ireplace("&#40;","(",$str);
			$str = str_ireplace("&#41;",")",$str);
			$str = str_ireplace("&#42;","*",$str);
			$str = str_ireplace("&#43;","+",$str);
			$str = str_ireplace("&#44;",",",$str);
			
			$str = str_ireplace("&#60;","<",$str);
			$str = str_ireplace("&#61;","=",$str);
			$str = str_ireplace("&#62;",">",$str);
			//$str = str_ireplace("","&quot",$str);
			$str = str_ireplace("#yu#","&",$str);
			$str = str_ireplace("#cxc#","&",$str);
			$str = str_ireplace("&#96;","`",$str);
			$str = str_ireplace("#jia#","+",$str);
			$str = str_ireplace("&#96;","`",$str);
			$str = str_ireplace("&#45;","-",$str);
			
			//$str =$this->clearHtml($str);
			return $str;
	}  
 public function req($key="",$typ="text"){
 			if($key==""){
				$v=$this->checkvalues($_REQUEST);
			}else{
           	 $v=$this->checkvalues($_REQUEST[$key]);
			}
			if($typ=="int"){
			  if(!is_numeric($v)||trim($v)==""){
			    $v=0;
			  }
			}
			return $v;
  }
  public function req_post($key="",$typ="text"){
 			if($key==""){
				$v=$this->checkvalues($_POST);
			}else{
           	 	$v=$this->checkvalues($_POST[$key]);
			}
			if($typ=="int"){
			  if(!is_numeric($v)||trim($v)==""){
			    $v=0;
			  }
			}
			return $v;
  }
  public function req_get($key,$typ="text"){
 			if($key==""){
				$v=$this->checkvalues($_GET);
			}else{
           	 	$v=$this->checkvalues($_GET[$key]);
			}
			if($typ=="int"){
			  if(!is_numeric($v)||trim($v)==""){
			    $v=0;
			  }
			};
			return $v;
  }
  public function checkvalues($arr){//遍历过滤数组
  	if(is_array($arr)){
		 foreach($arr as $k =>$v){
			  if(is_array($v)){
			   $arr[$k]=$this->checkvalues($v);
			  }else{
			   $arr[$k]=$this->checksql($v);
			  }
		 }
	 }else{
	   	$arr=$this->checksql($arr);
	 };
     return $arr;  
 }

}
?>