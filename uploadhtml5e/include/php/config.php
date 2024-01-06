<?php 
error_reporting(E_ALL & ~ E_NOTICE);	//屏蔽没有必要的错误提示，如变量未定义
date_default_timezone_set('PRC');//设成北京时间
header('Content-Type:text/html;charset=utf-8;');

$config=array();
$config["g_is_insert"]=0;
$config["g_is_small"]=1;//是否生成小图
$config["g_is_mid"]=0;//是否生成中图
$config["g_is_yuanming"]=0;//1为原标题
$config["g_is_jiequ"]=0;
$config["g_dirtou"]="uploads/"; //这个头文件夹要设一下
$config["g_dir1"]="uploads/p/";//小图文件夹
$config["g_dir2"]="uploads/p/";//中图文件夹
$config["g_dir3"]="uploads/p/";//大图文件夹
$config["g_dir4"]="uploads/img/";//图文件夹
$config["g_dir_mp3"]="uploads/mp3/";//mp3视频文件夹
$config["g_dir_mp4"]="uploads/mp4/";//mpw4视频文件夹
$config["g_dir_swf"]="uploads/swf/";//flash视频文件夹
$config["g_dir_video"]="uploads/video/"; //mov视频文件夹
$config["g_dir_other"]="uploads/other/"; //文件夹
$config["g_cengci"]="../../../"; //重点 文件夹保存层次 如../../../file/p/123.jpg则这里要填写成 ../../../
$config["g_w1"]=300; //小图宽
$config["g_w2"]=400; //中图宽
$config["g_h1"]=300; //小图高
$config["g_h2"]=400; //中图高
$config["g_fenge"]="#";


$config["g_h2"]=400; //中图高
$config["g_fenge"]="#";
?>