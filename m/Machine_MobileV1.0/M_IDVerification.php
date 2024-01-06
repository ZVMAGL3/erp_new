<?php
$userName = htmlspecialchars( $_POST[ 'userName' ] );       
$userSFZ = htmlspecialchars( $_POST[ 'userSFZ' ] );  
// 云市场分配的密钥Id
$secretId = 'AKIDH7apJckwrbJr7yNJdOh4bQ4teaBerpsC9514';
// 云市场分配的密钥Key
$secretKey = 'cVL8BTY599I3hX08dWc0IanxPtZOyDF4RCcG5RZu';
$source = 'market';

// 签名
$datetime = gmdate('D, d M Y H:i:s T');
$signStr = sprintf("x-date: %s\nx-source: %s", $datetime, $source);
$sign = base64_encode(hash_hmac('sha1', $signStr, $secretKey, true));
$auth = sprintf('hmac id="%s", algorithm="hmac-sha1", headers="x-date x-source", signature="%s"', $secretId, $sign);

// 请求方法
$method = 'POST';
// 请求头
$headers = array(
    'X-Source' => $source,
    'X-Date' => $datetime,
    'Authorization' => $auth,
    
);
// 查询参数
$queryParams = array (

);
// body参数（POST方法下）
$bodyParams = array (
    'idcard' => $userSFZ,
    'name' => $userName,
);
// url参数拼接
$url = 'https://service-jo9yed8n-1308811306.sh.apigw.tencentcs.com/release/v2/id_name/verify';
if (count($queryParams) > 0) {
    $url .= '?' . http_build_query($queryParams);
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//ssl证书不验证
curl_setopt($ch, CURLOPT_HTTPHEADER, array_map(function ($v, $k) {
    return $k . ': ' . $v;
}, array_values($headers), array_keys($headers)));
if (in_array($method, array('POST', 'PUT', 'PATCH'), true)) {
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($bodyParams));
}

$data = json_decode(curl_exec($ch));

if (curl_errno($ch)) {
    echo "Error: " . curl_error($ch);
} else {
    if($data->msg){
        echo json_encode(array(
            'isValidIDCard' => false,
            'error' => $data->msg
        ), JSON_UNESCAPED_UNICODE);
    }else{
        switch($data->data->result){
            case 1:
                echo json_encode(array(
                    'isValidIDCard' => true,
                    'error' => ''
                ), JSON_UNESCAPED_UNICODE);
                break;
            case 2:
                echo json_encode(array(
                    'isValidIDCard' => false,
                    'error' => '姓名与身份证不匹配'
                ), JSON_UNESCAPED_UNICODE);
                break;
            case 3:
                echo json_encode(array(
                    'isValidIDCard' => false,
                    'error' => '库中无该身份证'
                ), JSON_UNESCAPED_UNICODE);
                break;
        }
    }
}
curl_close($ch);
?>