<?php
include("rcg.cn.php");
function saveImg() {
    header('Content-type: application/json; charset="utf-8"');
    global $file;
    $fi = fopen("php://input", "rb");
    $p = JSON_decode(fread($fi, 2000));
    $fo = fopen(DATA_PATH.$_GET['path'],"wb");
    while ($buf = fread($fi,50000)) {
        fwrite($fo,$buf);
    }
    fclose($fi);
    fclose($fo);
    echo '{"message": "Saved!"}';
}
function fileStream() {
	global $file;
    if (!file_exists($file)) {
        header('HTTP/1.1 404 NOT FOUND');
        echo "File ".$file." NOT Found";
    } else {
        //以只读和二进制模式打开文件
        $stream = fopen ($file, "rb");
        //告诉浏览器这是一个文件流格式的文件
        header("Content-type: application/octet-stream");
        //请求范围的度量单位
        header("Accept-Ranges: bytes");
        //Content-Length是指定包含于请求或响应中数据的字节长度
        header("Accept-Length: ".filesize($file));
        //用来告诉浏览器，文件是可以当做附件被下载，下载后的文件名称为$file_name该变量的值。
        header("Content-Disposition: attachment; filename=".pathinfo($file,PATHINFO_BASENAME));
        //读取文件内容并直接输出到浏览器
        $wdx=fread($stream, filesize($file));
        echo $wdx;
        fclose($stream);
        exit();
    }
}