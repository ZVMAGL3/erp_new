<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
$bumenList = array();
$sql = "SELECT bumen FROM msc_zhiwei WHERE id in(?)";
$params = array(implode(",", $SYS_QuanXian_list));
$queryResult = $db->query($sql, $params);
if ($queryResult['error'] == null) {
    if ($db->numRows($queryResult['result']) > 0) {
        while($row = mysqli_fetch_assoc($queryResult['result'])){
            $bumenList []= $row['bumen'];
        }
        echo json_encode($params, JSON_UNESCAPED_UNICODE);

    }else{
        // $sql = "SELECT zhiwei_id FROM msc_user_reg WHERE uid = ?";

    }
}else{
    echo ("<script>alert('数据库异常，请重试')</script>");
}
?>