<?php
//=========================================================================权限
if ( '1' . $zwid != '1' ) {
    //========================================================================= 【职位】
    $const_q_zu = $const_id_bumen = $const_id_fz = $const_q_fanwei = $const_q_cak = $const_q_tianj = $const_q_xiug = $const_q_shenghe = $const_q_pizhun = $const_q_zhixing = $const_q_shanc = $const_q_dayin = $const_q_huis = $const_q_xiaohui = $const_q_seid = $const_q_dian = '';
    $str = explode( '_', $zwid ); //字符串转为数组
    $countArry = count( $str );
    for ( $i = 0; $i < $countArry; $i++ ) {
        $sql =  "select * From `msc_zhiwei` where `id`= ? ";
        $params = array($str[$i]);
        $rs = $db->query($sql, $params);
    	$row = mysqli_fetch_assoc($rs['result']);
        $const_q_zu .= "," . $row[ 'zu' ]; //职位名称
        $const_id_bumen .= "," . $row[ 'bumen' ]; //部门
        $const_id_fz .= "," . $row[ 'sys_id_fz' ]; //分支
        $const_q_fanwei .= "," . $row[ 'sys_q_fanwei' ]; //权限范围
        $const_q_cak .= "," . $row[ 'sys_q_cak' ]; //查看
        $const_q_tianj .= "," . $row[ 'sys_q_tianj' ]; //添加           
        $const_q_xiug .= "," . $row[ 'sys_q_xiug' ]; //修改
        $const_q_shenghe .= "," . $row[ 'sys_q_shenghe' ]; //审核
        $const_q_pizhun .= "," . $row[ 'sys_q_pizhun' ]; //批准
        $const_q_zhixing .= "," . $row[ 'sys_q_zhixing' ]; //执行
        $const_q_shanc .= "," . $row[ 'sys_q_shanc' ]; //删除
        $const_q_dayin .= "," . $row[ 'sys_q_dayin' ]; //打印
        $const_q_huis .= "," . $row[ 'sys_q_huis' ]; //回收
        $const_q_xiaohui .= "," . $row[ 'sys_q_xiaohui' ]; //销毁
        $const_q_seid .= "," . $row[ 'sys_q_seid' ]; //设定
        $const_q_dian .= "," . $row[ 'sys_q_dian' ]; //店
    }
    
    $const_q_zu = move_arrynull( QuChong( $const_q_zu ), "," ); //职位名称
    $const_id_bumen = move_arrynull( QuChong( $const_id_bumen ), "," ); //部门
    $const_id_fz = move_arrynull( QuChong( $const_id_fz ), "," ); //分支
    $const_q_fanwei = move_arrynull( QuChong( $const_q_fanwei ), "," ); //权限范围
    $const_q_cak = move_arrynull( QuChong( $const_q_cak ), "," ); //查看
    $const_q_tianj = move_arrynull( QuChong( $const_q_tianj ), "," ); //添加           
    $const_q_xiug = move_arrynull( QuChong( $const_q_xiug ), "," ); //修改
    $const_q_shenghe = move_arrynull( QuChong( $const_q_shenghe ), "," ); //审核
    $const_q_pizhun = move_arrynull( QuChong( $const_q_pizhun ), "," ); //批准
    $const_q_zhixing = move_arrynull( QuChong( $const_q_zhixing ), "," ); //执行
    $const_q_shanc = move_arrynull( QuChong( $const_q_shanc ), "," ); //删除
    $const_q_dayin = move_arrynull( QuChong( $const_q_dayin ), "," ); //打印
    $const_q_huis = move_arrynull( QuChong( $const_q_huis ), "," ); //回收
    $const_q_xiaohui = move_arrynull( QuChong( $const_q_xiaohui ), "," ); //销毁
    $const_q_seid = move_arrynull( QuChong( $const_q_seid ), "," ); //设定
    $const_q_dian = move_arrynull( QuChong( $const_q_dian ), "," ); //店
    //========================================================================= 【部门】
    $str = explode( '_', $const_id_bumen ); //字符串转为数组
    $countArry = count( $str );
    $const_bumenname = '';
    for ( $i = 0; $i < $countArry; $i++ ) {
                
        $sql =  "select `bumenname` From `msc_bumenlist` where `id`= ? ";
        $params = array($str[$i]);
        $rs = $db->query($sql, $params);
    	$row = mysqli_fetch_assoc($rs['result']);

        $const_bumenname .= "," . $row[ 'bumenname' ]; //部门名称
    }
    $const_bumenname = move_arrynull( QuChong( $const_bumenname ), "," ); //部门名称
}

//========================================================================= 公司信息
$sql = "select id,gongsimingceng,USE_banben,data_use,jlbhzt,maxrecord,lockd,usermoban,gsbh From MSC_Huiyuan_Reg where id= ?"; //用户登录表
// echo $sql;
$params = array($hy);
$rs = $db->query($sql, $params);
$row = mysqli_fetch_assoc($rs['result']);
$regid = $row[ "id" ]; //这里是公司注册时生成的id
$reg_name = $row[ "gongsimingceng" ]; //公司名称
$reg_banben = $row[ "USE_banben" ]; //程序版本
$data_use = $row[ "data_use" ]; //公司使用数据库
$const_jlbhzt = $row[ 'jlbhzt' ]; //记录编号字头
$maxrecord = $row[ 'maxrecord' ]; //每页显示数
if ( $maxrecord == '' )$maxrecord = 30;
$nowlockd = $row[ 'lockd' ]; //公司锁定
$usermoban = $row[ 'usermoban' ]; //公司使用模板
$nowgsbh = $row[ 'gsbh' ]; //公司编号
?>