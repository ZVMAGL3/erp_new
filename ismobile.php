<?php
header('Content-type: text/html; charset=utf-8');//设定本页编码
// ok ======================================================================================以下为识别手机访问
function isMobile(){
    $userAgent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    $userAgentCommentsBlock = preg_match('|\(.*?\)|', $userAgent, $matches) > 0 ? $matches[0] : '';
    function CheckSubStr($subStr, $text)
    {
        foreach ($subStr as $item)
        {
            if (FALSE !== strpos($text, $item)){return TRUE;};
        }
        return FALSE;
    }

    $mobile_os_list = array ('Google Wireless Transcoder', 'Windows CE', 'WindowsCE', 'Symbian', 'Android', 'armv6l', 'armv5', 'Mobile', 'CentOS', 'mowser', 'AvantGo', 'Opera Mobi', 'J2ME/MIDP', 'Smartphone', 'Go.Web', 'Palm', 'iPAQ');

    $mobile_token_list = array ('Profile/MIDP', 'Configuration/CLDC-', '160×160', '176×220', '240×240', '240×320', '320×240', 'UP.Browser', 'UP.Link', 'SymbianOS', 'PalmOS', 'PocketPC', 'SonyEricsson', 'Nokia', 'BlackBerry', 'Vodafone', 'BenQ', 'Novarra-Vision', 'Iris', 'NetFront', 'HTC_', 'Xda_', 'SAMSUNG-SGH', 'Wapaka', 'DoCoMo', 'iPhone', 'iPod');

    $found_mobile = CheckSubStr($mobile_os_list, $userAgentCommentsBlock) || CheckSubStr($mobile_token_list, $userAgent);

    if ($found_mobile) {return TRUE;}else{return FALSE;};
}

if (isMobile()){
    
	header("Location: m/index.php");
	//echo"手机";

}


?>