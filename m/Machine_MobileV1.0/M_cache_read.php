<?php

function read_cache( $file_name_type=1,$id='',$PHPfileName='') { //read_cache( 样式1,id值,存放文件目录及文件名前缀)
	global $re_id, $bh, $hy,$CACHE_ROOT,$Conn,$ToHtmlID;
	$file_name = '';
	if('1'.$CACHE_ROOT =='1')$CACHE_ROOT = 'cache'; //首层目录
	$CACHE_SUFFIX = '.php'; //缓存文件的扩展名，千万别用 .php .asp .jsp .pl 等等
	switch ( $file_name_type ) {
		case '1': //----------------------- //编辑+添加页模版 单页面缓存 cache/9007/B_moban_add/B_moban_add_321.php	[edit\add]
			$cache_dir = $CACHE_ROOT  . '/' . $hy. '/' . $PHPfileName; //缓存文件目录
			$file_name = $PHPfileName . '_' . $re_id . $CACHE_SUFFIX;
			break;
			
		default:
			$cache_dir = $CACHE_ROOT . '/' . $hy. '/' . $PHPfileName ; //缓存文件目录
			$file_name = $PHPfileName . '_' . $re_id . '_' . $bh . $CACHE_SUFFIX; //缓存文件名 B_moban_add_321_9001.php
	};
	$cache_file = $cache_dir . '/' . $file_name; //缓存文件详细地址
	//echo $cache_file;
	if( file_exists( $cache_file ) ){//文件存在时
	    //echo"准备打开文件";
		//Open_cache($cache_file); //打开文件
		include_once ($cache_file);
	}else{
		echo $cache_file;
		//echo $nowPHPfileName.$re_id;
		echo"<div> 首次使用，正在自动初始化模板，请稍等...</div>";
		
		if ($PHPfileName=='M_moban_add'){     //添加页
			echo"<script>$.post('M_moban_add_chache.php',{act:'list',re_id:'".$re_id."',ToHtmlID:'".$ToHtmlID."'}, function(){add_data_mobile('".$ToHtmlID."');})</script>";
		}elseif($PHPfileName=='M_moban_edit'){//编辑页
		    echo"<script>$.post('M_moban_edit_chache.php',{act:'list',re_id:'".$re_id."',ToHtmlID:'".$ToHtmlID."'}, function(){edit_data(this,'$id','$ToHtmlID','$bh')})</script>";
		}elseif($PHPfileName=='M_moban_list'){//中间数据页
			//echo "数据页输出成功".$re_id;
		    echo"<script>$.post('M_moban_list_chache.php',{act:'list',re_id:'".$re_id."',ToHtmlID:'".$ToHtmlID."'}, function(){window.location.reload();})</script>";//生成动态页完成后加载
			//M_moban_list_chache.php?act=list&re_id=$re_id
		}else{
		    echo"对不起，没有相应的指令";
		};
		
	}
}



?>