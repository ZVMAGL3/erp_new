<?php
$uploadDir = '../images/user_img'; // 设置上传目录
if (!empty($_FILES['imgFile']['tmp_name'])) {
    $tempFile = $_FILES['imgFile']['tmp_name'];
    $targetFile = $uploadDir . $_FILES['imgFile']['name'];
    if (move_uploaded_file($tempFile, $targetFile)) {
        echo '{"error": 0, "url": "' . $targetFile . '"}';
    } else {
        echo '{"error": 1, "message": "上传失败"}';
    }
} else {
    echo '{"error": 1, "message": "无文件上传"}';
}
?>