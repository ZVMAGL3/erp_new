<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once '../../inc/B_conn.php'; //连上注册数据库
include_once '../../inc/B_Config.php'; //执行接收参数及配置
include_once( 'M_quanxian.php' ); //接收职位权限信息

if ( $act == 'list' ) { //当接收到处理指令时
    //echo $nowkeyword;
    echo listdata( $id ); //标准条款清单
}

//[ok]=========================================================================【记录清单  输出数据】
function listdata( $id ) {
    global $Connadmin, $Conn, $re_id, $hy, $parent_id,$topZhiWeiIdxList,$modRoles;
    $father_id = 0;
    if(in_array($parent_id,$modRoles)){
        $sql = "
            SELECT z2.id,z2.bumen
            FROM `msc_zhiwei` z1 
            JOIN `msc_zhiwei` z2 ON z1.bumen = z2.bumen 
            WHERE z1.id = '$parent_id' and z2.FuZeRen = 1
        ";
        // echo $sql;
        $rs = mysqli_query( $Connadmin, $sql );
        $row = mysqli_fetch_array( $rs );
        mysqli_free_result( $rs ); //释放内存
        if($parent_id == $row[ 'id' ]){
            $bumen = $row[ 'bumen' ]; //标准名称
            $sql = "
                SELECT z.id
                FROM `msc_zhiwei` z
                JOIN `msc_bumenlist` b ON b.parent = z.bumen 
                WHERE z.FuZeRen = 1 and b.id = $bumen
            ";
            // echo $sql;
            $rs = mysqli_query( $Connadmin, $sql );
            $row = mysqli_fetch_array( $rs );
            mysqli_free_result( $rs ); //释放内存
        }
        $father_id = $row[ 'id' ];
    }else{
        // echo '不可修改';
    }
    //---------------------------------------------------------------------职位权限查询
    $sql = "select * From `msc_ZhiWei` where  id='$parent_id' ";
    $rs = mysqli_query( $Connadmin, $sql );
    $row = mysqli_fetch_array( $rs );
    mysqli_free_result( $rs ); //释放内存

    $father_sql = "select * From `msc_ZhiWei` where  id='$father_id' ";
    $father_rs = mysqli_query( $Connadmin, $father_sql );
    $father_row = mysqli_fetch_array( $father_rs );
    mysqli_free_result( $father_rs ); //释放内存
    
    //---------------------------------------------------------------------记录清单
    $sql = "select * From `sys_jlmb` where  id='$id' ";
    $rs = mysqli_query( $Conn, $sql );
    $row2 = mysqli_fetch_array( $rs );
    $id2 = $row2[ 'id' ]; //id

    $alertStr = "alert('你无权修改该职位的权限!')";
    if(!in_array($parent_id,$topZhiWeiIdxList)){
        $onclick = 'thistripnt_mobile("Edit_ZWquanxian_Update",this,"' . $hy . '")';
        $onchange = "thistripnt_zhiwei_mobile('Edit_ZWquanxian_Update',this,'$hy')";
        $str = 'thistripnt_hengxiang_mobile(this)';
    }else{
        $onclick = $alertStr ;
        $onchange = $alertStr ;
        $str = $alertStr;
    }

    $listdata = "
    <div class='quanxiandiv_parent'>

    <ul class='content_top'><li class='h2'><dl>
    ";

    $listdata .= "<dt class='title'>管辖范围:</dt>";

    $sys_q_fanwei = $row[ 'sys_q_fanwei' ]; //sys_q_fanwei 权限范围
    $father_sys_q_fanwei = $father_row?$father_row[ 'sys_q_fanwei' ]:0; //sys_q_fanwei 权限范围
    $options = ["个人", "部门", "公司", "集团"];
    $listdata2 = '';
    foreach($options as $key => $item){
        if( getN( $sys_q_fanwei, $id.'_'.$key ,',') >= 0){ $check="check"; }else{$check=""; };
        $listdata2 .= "<dt value='$key'  name='sys_q_fanwei' at='{$id2}' bumenid='{$parent_id}' id='sys_q_fanwei' class='$check' onclick=$onclick>$item</dt>";
        if( getN( $father_sys_q_fanwei, $id.'_'.$key ,',') >= 0 || getN( $sys_q_fanwei, $id.'_'.$key ,',') >= 0 || !$key){
            $listdata .= $listdata2;
            $listdata2 = '';
        }        
    }

    $listdata .= "</dl></li></ul>

    <ul class='content'>";

    $index = array('sys_q_tianj','sys_q_shenghe','sys_q_pizhun','sys_q_cak','sys_q_xiug','sys_q_shanc','sys_q_huis','sys_q_dayin','sys_q_xiaohui','sys_q_zhixing','sys_q_seid');
    $index_str_list = array('编制','审核','批准','查看','修订','删除','回收','打印','销毁','分配','设置');
    foreach($index as $key => $item){
        if( getN( $row[ $item ], $id ,',') >= 0 || ($father_row && getN( $father_row[ $item ], $id ,',') >= 0) ){        
            if( getN( $row[ $item ], $id ,',') >= 0){ $show='28'; }else{$show='27'; };
            $index_str = $index_str_list[$key];
            $listdata .= "<li onclick=$onchange name='$item'  value='{$parent_id}' bumenid='{$parent_id}' at='{$id2}'>$index_str<dd class='hui'><i class='fa fa-{$show}-3'></i></dd></li>";
        }
    }

    $listdata .= "<li class='close quanxuan'  bumenid=\"{$parent_id}\" re_id=\"{$id2}\" onclick=$str>全选<dd class='hui'><i class='fa fa-21-1'></i></dd></li>
    <li class='close' onclick=\"quanxiandiv_mobile('this')\">关闭<dd class='hui'><i class='fa fa-del-mini'></i></dd></li>
    </ul>

    </div>
    <script>changequxiao_quanxuan_mobile('.quanxiandiv_parent .quanxuan')</script>
    ";
    mysqli_free_result( $rs ); //释放内存
    echo $listdata;
}
mysqli_close( $Connadmin ); //关闭数据库 
mysqli_close( $Conn ); //关闭数据库 
?>
