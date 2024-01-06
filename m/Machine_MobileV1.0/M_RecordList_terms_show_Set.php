<?php
//================================================================以下为参数设定
$tablename = 'sys_jlmb'; //这里是表名
$colsname = 'sys_card'; //这里是字段名
$textsname = '记录清单'; //表单名
$phpstart = 'M_RecordList_terms_show'; //文件头


if ( $const_id_login != 1 ) { //无权限时
    echo "<script>$('#{$ToHtmlID}_content_foot input,#{$ToHtmlID}_content_foot select').attr('disabled',true);</script>";
    echo "<br><br><font style='color:red;padding-left:30px;font-size:12px;'>您无{$textsname}管理权限!</font>";
    exit();
}
?>
