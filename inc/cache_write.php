<?php

function write_cache( $file_name_type=1,$Htmlcontents = '', $PHPfileName='') { //read_cache( 样式1,id值,存放文件目录及文件名前缀)
	global $re_id, $bh, $SYS_Company_id,$CACHE_ROOT,$Conn,$zwid,$SYS_QuanXian;
	$file_name = '';
	if('1'.$CACHE_ROOT =='1')$CACHE_ROOT = 'cache'; //首层目录
	$CACHE_SUFFIX = '.php'; //缓存文件的扩展名，千万别用 .php .asp .jsp .pl 等等
	
	
	switch ( $file_name_type ) {
		case '1': //----------------------- //编辑+添加页模版 单页面缓存 cache/9007/B_moban_add/B_moban_add_321.php	[edit\add]
			$cache_dir = $CACHE_ROOT  . '/' . $SYS_Company_id. '/' . $PHPfileName; //缓存文件目录
			$file_name = $PHPfileName . '_' . $re_id . $CACHE_SUFFIX;
			break;
		case '2': //----------------------- //根据每职位   cache/51/B_quanxian/B_quanxian_1.php
			$cache_dir = $CACHE_ROOT  . '/' . $SYS_Company_id. '/' . $PHPfileName; //缓存文件目录
			$file_name = $PHPfileName . '_' . $zwid . $CACHE_SUFFIX;
			break;
		default:
			$cache_dir = $CACHE_ROOT  . '/' . $SYS_Company_id. '/' . $PHPfileName; //缓存文件目录
			$file_name = $PHPfileName . '_' . $re_id . $CACHE_SUFFIX;
	}
	$cache_file = $cache_dir . '/' . $file_name; //缓存文件详细地址
	// echo $cache_file; /* ??? */
	if( file_exists( $cache_file ) ){//文件存在时修改 = 
        update_cache( $Htmlcontents, $cache_file ); //这里更新文件
	}else{                            //文件不存在时生成
		echo"未初始化模板，请先初始化";
		// echo $Htmlcontents ;
		ADD_cache( $Htmlcontents, $cache_file, $CACHE_ROOT, $PHPfileName, $cache_dir ); //这里生成文件
	}
}
			
		

function ADD_cache( $contents, $cache_file, $CACHE_ROOT, $PHPfileName, $cache_dir ) {
	global $file_name_type, $re_id;
	if ( '1' . $contents == '1' ) {
		return false;
	}

	if ( !file_exists( $cache_dir ) ) { //生成5+级目录开始 True代表允许生成我级目录
		mkdir( $cache_dir, 0777, true );
		chmod( $cache_dir, 0777 ); //生成目录结束
	}

	//echo "添加成功";
	if ( !file_exists( $cache_file ) ) {
		$fp = fopen( $cache_file, 'wb' );
		fwrite( $fp, $contents );
		fclose( $fp );
		chmod( $cache_file, 0777 ); //设定文件的权限
	}
	//生成新缓存的同时，自动删除所有的老缓存。以节约空间。
	//return $contents;
}

function update_cache( $contents, $cache_file ) { //更新文件
	$fp = fopen( $cache_file, 'w+' );
	fwrite( $fp, $contents );
	fclose( $fp );
	chmod( $cache_file, 0777 ); //设定文件的权限
}


?>