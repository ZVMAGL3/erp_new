<?php
include_once './extend/PHPWord/PHPWord.php';
include_once './extend/PHPWord/PHPWord/IOFactory.php';
$dir = dirname(__FILE__);
echo $dir;
$PHPWord = new PHPWord();
//$template = 'test';                                        //新建的文件夹名称    
$nowdir=$dir.'/test.docx';
$loadtemplate = $PHPWord->loadTemplate($nowdir);             //加载word文件
$loadtemplate->setValue('测试', 'test');                      //替换account内容为123
$loadtemplate->save($nowdir);                                //保存后的地址
echo "替换成功。";
?>