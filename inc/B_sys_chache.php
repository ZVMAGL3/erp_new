<?php
//=========================================================================权限
if ( '1' . $zwid != '1' ) {
    //========================================================================= 【职位】
    $sys_q_zu = $bumen_id = $sys_id_fz = $sys_q_fanwei = $sys_q_cak = $sys_q_tianj = $sys_q_xiug = $sys_q_shenghe = $sys_q_pizhun = $sys_q_zhixing = $sys_q_shanc = $sys_q_dayin = $sys_q_huis = $sys_q_xiaohui = $sys_q_seid = $sys_q_dian = '';
    $str = explode( '_', $zwid ); //字符串转为数组
    $countArry = count( $str );
    for ( $i = 0; $i < $countArry; $i++ ) {
        $sql =  "select * From `msc_zhiwei` where `id`= ? ";
        $params = array($str[$i]);
        $rs = $db->query($sql, $params);
    	$row = mysqli_fetch_assoc($rs['result']);
        $sys_q_zu .= "," . $row[ 'zu' ]; //职位名称
        $bumen_id .= "," . $row[ 'bumen' ]; //部门
        $sys_id_fz .= "," . $row[ 'sys_id_fz' ]; //分支
        $sys_q_fanwei .= "," . $row[ 'sys_q_fanwei' ]; //权限范围
        $sys_q_cak .= "," . $row[ 'sys_q_cak' ]; //查看
        $sys_q_tianj .= "," . $row[ 'sys_q_tianj' ]; //添加           
        $sys_q_xiug .= "," . $row[ 'sys_q_xiug' ]; //修改
        $sys_q_shenghe .= "," . $row[ 'sys_q_shenghe' ]; //审核
        $sys_q_pizhun .= "," . $row[ 'sys_q_pizhun' ]; //批准
        $sys_q_zhixing .= "," . $row[ 'sys_q_zhixing' ]; //执行
        $sys_q_shanc .= "," . $row[ 'sys_q_shanc' ]; //删除
        $sys_q_dayin .= "," . $row[ 'sys_q_dayin' ]; //打印
        $sys_q_huis .= "," . $row[ 'sys_q_huis' ]; //回收
        $sys_q_xiaohui .= "," . $row[ 'sys_q_xiaohui' ]; //销毁
        $sys_q_seid .= "," . $row[ 'sys_q_seid' ]; //设定
        $sys_q_dian .= "," . $row[ 'sys_q_dian' ]; //店
    }
    
    $sys_q_zu = move_arrynull( QuChong( $sys_q_zu ), "," ); //职位名称
    $bumen_id = move_arrynull( QuChong( $bumen_id ), "," ); //部门
    $sys_id_fz = move_arrynull( QuChong( $sys_id_fz ), "," ); //分支
    $sys_q_fanwei = move_arrynull( QuChong( $sys_q_fanwei ), "," ); //权限范围
    $sys_q_cak = move_arrynull( QuChong( $sys_q_cak ), "," ); //查看
    $sys_q_tianj = move_arrynull( QuChong( $sys_q_tianj ), "," ); //添加           
    $sys_q_xiug = move_arrynull( QuChong( $sys_q_xiug ), "," ); //修改
    $sys_q_shenghe = move_arrynull( QuChong( $sys_q_shenghe ), "," ); //审核
    $sys_q_pizhun = move_arrynull( QuChong( $sys_q_pizhun ), "," ); //批准
    $sys_q_zhixing = move_arrynull( QuChong( $sys_q_zhixing ), "," ); //执行
    $sys_q_shanc = move_arrynull( QuChong( $sys_q_shanc ), "," ); //删除
    $sys_q_dayin = move_arrynull( QuChong( $sys_q_dayin ), "," ); //打印
    $sys_q_huis = move_arrynull( QuChong( $sys_q_huis ), "," ); //回收
    $sys_q_xiaohui = move_arrynull( QuChong( $sys_q_xiaohui ), "," ); //销毁
    $sys_q_seid = move_arrynull( QuChong( $sys_q_seid ), "," ); //设定
    $sys_q_dian = move_arrynull( QuChong( $sys_q_dian ), "," ); //店
    //========================================================================= 【部门】
    $str = explode( '_', $bumen_id ); //字符串转为数组
    $countArry = count( $str );
    $bumen_name = '';
    for ( $i = 0; $i < $countArry; $i++ ) {
                
        $sql =  "select `bumenname` From `msc_bumenlist` where `id`= ? ";
        $params = array($str[$i]);
        $rs = $db->query($sql, $params);
    	$row = mysqli_fetch_assoc($rs['result']);

        $bumen_name .= "," . $row[ 'bumenname' ]; //部门名称
    }
    $bumen_name = move_arrynull( QuChong( $bumen_name ), "," ); //部门名称
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
$sys_jlbhzt = $row[ 'jlbhzt' ]; //记录编号字头
$maxrecord = $row[ 'maxrecord' ]; //每页显示数
if ( $maxrecord == '' )$maxrecord = 30;
$nowlockd = $row[ 'lockd' ]; //公司锁定
$usermoban = $row[ 'usermoban' ]; //公司使用模板
$nowgsbh = $row[ 'gsbh' ]; //公司编号
?>