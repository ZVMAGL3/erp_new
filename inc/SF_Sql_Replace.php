<?php
header('Content-type: text/html; charset=utf-8');//设定本页编码
//===========================ok

//=======================================================================以下为参数设定
$xt_m_ziduan=$xt_m_ziduan_Name=$xt_m_ziduan_hidden=$SF_str_start=$SF_str_end=$SF_SQL=$Sqlarr=$All_XT_ZiDuan='';

  $xt_m_ziduan='id,sys_zt,sys_zt_bianhao,sys_nowbh,sys_id_zu,sys_huis,sys_yfzuid,sys_id_fz,bumen_id,sys_id_login,sys_login,sys_shenpi,sys_web_shenpi,sys_shenpi_all,sys_adddate,sys_adddate_g,sys_leixin,hy,sys_bh,sys_chaosong';//公用部份关键词
  
  $xt_m_ziduan_Name='ID,[系统]字头,[系统]字头编号,记录编号,分类,回收,公司ID,分支,部门,编制人工号,编制人,审核人,批准人,Web审批,添加时间,更新时间,leixin,hy,[系统]自动编号,经办人';//公用部份关键词对应名称
  
  $SF_edit='id,gh';//禁止修改的字段
  $SF_str_start='$_PZζ_tξa_t$';//字符串传递前分隔符
  $SF_str_end='$_PZζ_E_ξn_D$';//字符串传递前分隔
  $SF_SQL='$_nZζPξz_$';//过滤字符串参数
  $Sqlarr='and,exec,insert,select,delete,update,count,chr,mid,master,truncate,char,declare,or,dbcc,alter,sp_rename,drop';
  $All_XT_ZiDuan=','.$xt_m_ziduan.','.$xt_m_ziduan_Name.','.$SF_str_start.','.$SF_str_end.','.$SF_SQL.','.$Sqlarr.',';
  
//=========================================================================返回字符串数组元素个数的函数function
function Uboundarryy($x,$fh){
   $Uboundarry=$arr='';
  if ('1'.$x=='1'){
    $Uboundarry=-1;
    exit;
  };
  $arr=explode($fh,$x);
  $Uboundarry=count($arr);
  return $Uboundarry;
}
//=========================================================================函数：不区分大小写替换SQL语句后面加接上
/*
function ReplaceAdd($str,$zf){//str字符串,zf字符
    $nowstr=$nowzf=$i=$k=$Uboundarry='';
   $ReplaceAdd=$str;
   $nowstr=strtolower($str);
   $nowzf=strtolower($zf);
   $Uboundarry=Uboundarryy($nowstr,$nowzf);
 if (strpos($nowstr,$nowzf).'1'!='1');//进行处理
   for($i=0;$i<$Uboundarry;$i++){
   $k=strpos($nowstr,$nowzf)+strlen($nowzf);
   $ReplaceAdd=substr(4str,0,$k).$SF_SQL.substr($str,$k);
   }
 }else{
   $ReplaceAdd=$str;//里面没有需过滤的字段便直接输出
 };
  return $ReplaceAdd;
};
*/


?>