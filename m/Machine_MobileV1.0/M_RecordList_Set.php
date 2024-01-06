<?php
//================================================================以下为参数设定
$tablename = 'msc_standard'; //这里是表名
$colsname = 'name'; //这里是字段名
$textsname = '选择标准'; //表单名
$phpstart = 'M_RecordList'; //文件头


if ( $const_id_login != 1 ) { //无权限时
    echo "<script>$('#{$ToHtmlID}_content_foot input,#{$ToHtmlID}_content_foot select').attr('disabled',true);</script>";
    echo "<br><br><font style='color:red;padding-left:30px;font-size:12px;'>您无{$textsname}管理权限!</font>";
    exit();
}
?>
