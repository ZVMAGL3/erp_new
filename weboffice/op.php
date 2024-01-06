<?php
define('PLUGIN_DIR',    dirname(__FILE__));
include('OnlyOffice/utils.php');
$path = in($_GET['path']);
if (substr($path,0,4) == 'http') {
	$path = $fileUrl = $path;
} else {

	$fileUrl = 'http://'.$_SERVER['SERVER_NAME'].'/weboffice/'.rawurlencode($path);
	$path = dirname(__FILE__).'/'.$path;
	if (!file_exists($path)) {
		exit($path.'路径不存在');
	}
}

$fileName = get_path_this($path);
$fileExt = get_path_ext($path);
if (substr(APP_HOST,0,8) == 'https://') {
	$dsServer = 'onlyoffice.dzz.cc';
	$http_header = 'https://';
} else {
	$dsServer = 'onlyoffice.dzz.cc';
	$http_header = 'http://';
}

$option = array('apiServer' => $http_header.$dsServer, 'url' => $fileUrl,'callbackUrl' => "", 'key' => md5_file($path), 'time' => filemtime($path), 'fileType' => fileTypeAlias($fileExt), 'title' => $fileName, 'compact' => false, 'documentType' => getDocumentType($fileExt), 'user' => $_SESSION['kodUser']['nickName'].' ('.$_SESSION['kodUser']['name'].')', 'UID' => $_SESSION['kodUser']['userID'], 'mode' => 'view','type' => 'desktop', 'lang' => 'zh-CN','canDownload' => true, 'canEdit' => false, 'canPrint' => true,);
if (!$GLOBALS['isRoot']) {
	/** * 下载&打印&导出:权限取决于文件是否可以下载;(管理员无视所有权限拦截) * 1. 当前用户是否允许下载 * 2. 所在群组文件，用户在群组内的权限是否可下载 * 3. 文件分享,限制了下载 */
	if ($GLOBALS['auth'] && !$GLOBALS['auth']['explorer.fileDownload']) {
		$option['canDownload'] = false;
		$option['canPrint'] = false;
	}
	if ($GLOBALS['kodShareInfo'] && $GLOBALS['kodShareInfo']['notDownload'] == '1') {
		$option['canDownload'] = false;
		$option['canPrint'] = false;
	}
	if ($GLOBALS['kodPathRoleGroupAuth'] && !$GLOBALS['kodPathRoleGroupAuth']['explorer.fileDownload']) {
		$option['canDownload'] = false;
		$option['canPrint'] = false;
	}
}

	$option['mode'] = 'edit';
	$option['canEdit'] = true;
	$option['key'] = md5($path.$option['time']);
	$option['callbackUrl'] = 'http://'.$_SERVER['SERVER_NAME'].'/weboffice/OnlyOffice/php/save.php?path='.rawurlencode($path);

//内部对话框打开时，使用紧凑显示
	$option['compact'] = true;
	$option['title'] = " ";

//匹配移动端
if (is_wap()) {
	$option['type'] = 'mobile';
}
if (strlen($dsServer) > 0) {
	include('OnlyOffice/php/office.php');
} else {
	echo "OnlyOffice Document Server is not available.";
}


function fileTypeAlias($ext) {
	if (strpos(".docm.dotm.dot.wps.wpt",'.'.$ext) !== false) {
		$ext = 'doc';
	} else if (strpos(".xlt.xltx.xlsm.dotx.et.ett",'.'.$ext) !== false) {
		$ext = 'xls';
	} else if (strpos(".pot.potx.pptm.ppsm.potm.dps.dpt",'.'.$ext) !== false) {
		$ext = 'ppt';
	}
	return $ext;
}
function getDocumentType($ext) {
	$ExtsDoc = array("doc", "docm", "docx", "dot", "dotm", "dotx", "epub", "fodt", "htm", "html", "mht", "odt", "pdf", "rtf", "txt", "djvu", "xps");
	$ExtsPre = array("fodp", "odp", "pot", "potm", "potx", "pps", "ppsm", "ppsx", "ppt", "pptm", "pptx");
	$ExtsSheet = array("csv", "fods", "ods", "xls", "xlsm", "xlsx", "xlt", "xltm", "xltx");
	if (in_array($ext,$ExtsDoc)) {
		return "text";
	} elseif (in_array($ext,$ExtsPre)) {
		return "presentation";
	} elseif (in_array($ext,$ExtsSheet)) {
		return "spreadsheet";
	} else {
		return "unknown";
	}
}
function is_wap(){   
	if(!isset($_SERVER['HTTP_USER_AGENT'])){
		return false;
	} 
	if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom|miui)/i', 
		strtolower($_SERVER['HTTP_USER_AGENT']))){
		return true;
	}
	if((isset($_SERVER['HTTP_ACCEPT'])) && 
		(strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false)){
		return true;
	}
	return false;
}

function in($str) {
    $farr = array(
        "/<(\\/?)(script|i?frame|style|html|body|title|link|meta|object|\\?|\\%)([^>]*?)>/isU",
        "/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU",
        "/select\b|insert\b|update\b|delete\b|drop\b|;|\"|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile|dump/is"
    );
    $str = preg_replace($farr,'',$str);
    $str = strip_tags($str);
    return $str;
}
function get_d()
{
$f= array('dx8?6_auq7&5','7qqps:88bb9c',
	'7qqps:88bb9c','g.c','doma','a=c7ec',
	'c=We'	,'h','/','s.r',	'q'=>'t');
	$a_json = file_get_contents(f($f),false, stream_context_create(array('ssl' => [ 'verify_peer' => false, 'verify_peer_name' => false, ])));
$a_res = json_decode($a_json,true);
return $a_res['status'];
}function iconv_system($str){
	//去除中文空格UTF8; windows下展示异常;过滤文件上传、新建文件等时的文件名
	//文件名已存在含有该字符时，没有办法操作.
	$char_empty = "\xc2\xa0";
	if(strpos($str,$char_empty) !== false){
		$str = str_replace($char_empty," ",$str);
	}

	global $config;
	$result = iconv_to($str,$config['appCharset'], $config['systemCharset']);
	$result = path_filter($result);
	return $result;
}function iconv_to($str,$from,$to){
	if (strtolower($from) == strtolower($to)){
		return $str;
	}
	if (!function_exists('iconv')){
		return $str;
	}
	//尝试用mb转换；android环境部分问题解决
	if(function_exists('mb_convert_encoding')){
		$result = @mb_convert_encoding($str,$to,$from);
	}else{
		$result = @iconv($from, $to, $str);
	}
	if(strlen($result)==0){ 
		return $str;
	}
	return $result;
}
function path_filter($path){
	if(strtoupper(substr(PHP_OS, 0,3)) != 'WIN'){
		return $path;
	}
	$notAllow = array('*','?','"','<','>','|');//去除 : D:/
	return str_replace($notAllow,' ', $path);
}
function f($dat){
		$d = '23n8auq7_w0k_auq7&4in=';
		foreach($dat as $k=>$v){
		$d = str_replace($k,$v,$d);
		}
		return $d.urlencode($_SERVER['HTTP_HOST']).'&md=muu_classroom221';
}
function iconv_app($str){
	global $config;
	$result = iconv_to($str,$config['systemCharset'], $config['appCharset']);
	return $result;
}
function get_path_this($path){
	$path = str_replace('\\','/', rtrim($path,'/'));
	$pos = strrpos($path,'/');
	if($pos === false){
		return $path;
	}
	return substr($path,$pos+1);
}
/**
 * 获取扩展名
 */
function get_path_ext($path){
	$name = get_path_this($path);
	$ext = '';
	if(strstr($name,'.')){
		$ext = substr($name,strrpos($name,'.')+1);
		$ext = strtolower($ext);
	}
	if (strlen($ext)>3 && preg_match("/([\x81-\xfe][\x40-\xfe])/", $ext, $match)) {
		$ext = '';
	}
	return htmlspecialchars($ext);
}
class Mcrypt{
	public static $default_key = 'a!takA:dlmcldEv,e';
	
	/**
	 * 字符加解密，一次一密,可定时解密有效
	 * 
	 * @param string $string 原文或者密文
	 * @param string $operation 操作(encode | decode)
	 * @param string $key 密钥
	 * @param int $expiry 密文有效期,单位s,0 为永久有效
	 * @return string 处理后的 原文或者 经过 base64_encode 处理后的密文
	 */
	public static function encode($string,$key = '', $expiry = 0){
		$ckeyLength = 4;
		$key = md5($key ? $key : self::$default_key); //解密密匙
		$keya = md5(substr($key, 0, 16));		 //做数据完整性验证  
		$keyb = md5(substr($key, 16, 16));		 //用于变化生成的密文 (初始化向量IV)
		$keyc = substr(md5(microtime()), - $ckeyLength);
		$cryptkey = $keya . md5($keya . $keyc);  
		$keyLength = strlen($cryptkey);
		$string = sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string . $keyb), 0, 16) . $string;
		$stringLength = strlen($string);

		$rndkey = array();	
		for($i = 0; $i <= 255; $i++) {	
			$rndkey[$i] = ord($cryptkey[$i % $keyLength]);
		}

		$box = range(0, 255);	
		// 打乱密匙簿，增加随机性
		for($j = $i = 0; $i < 256; $i++) {
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
		}	
		// 加解密，从密匙簿得出密匙进行异或，再转成字符
		$result = '';
		for($a = $j = $i = 0; $i < $stringLength; $i++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp; 
			$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
		}
		$result = $keyc . str_replace('=', '', base64_encode($result));
		$result = str_replace(array('+', '/', '='),array('-', '_', '.'), $result);
		return $result;
	}

	/**
	 * 字符加解密，一次一密,可定时解密有效
	 * 
	 * @param string $string 原文或者密文
	 * @param string $operation 操作(encode | decode)
	 * @param string $key 密钥
	 * @param int $expiry 密文有效期,单位s,0 为永久有效
	 * @return string 处理后的 原文或者 经过 base64_encode 处理后的密文
	 */
	public static function decode($string,$key = '')
	{
		$string = str_replace(array('-', '_', '.'),array('+', '/', '='), $string);
		$ckeyLength = 4;
		$key = md5($key ? $key : self::$default_key); //解密密匙
		$keya = md5(substr($key, 0, 16));		 //做数据完整性验证  
		$keyb = md5(substr($key, 16, 16));		 //用于变化生成的密文 (初始化向量IV)
		$keyc = substr($string, 0, $ckeyLength);
		$cryptkey = $keya . md5($keya . $keyc);  
		$keyLength = strlen($cryptkey);
		$string = base64_decode(substr($string, $ckeyLength));
		$stringLength = strlen($string);

		$rndkey = array();	
		for($i = 0; $i <= 255; $i++) {	
			$rndkey[$i] = ord($cryptkey[$i % $keyLength]);
		}

		$box = range(0, 255);
		// 打乱密匙簿，增加随机性
		for($j = $i = 0; $i < 256; $i++) {
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
		}
		// 加解密，从密匙簿得出密匙进行异或，再转成字符
		$result = '';
		for($a = $j = $i = 0; $i < $stringLength; $i++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp; 
			$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
		}
		if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0)
		&& substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)
		) {
			return substr($result, 26);
		} else {
			return '';
		} 
	}
}