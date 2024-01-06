<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Jurisdiction_Set.php'; //连上参数设定
include_once '../../inc/B_Config.php';
include_once '../../inc/Function_All.php';

if ( $act == 'list' ) { //当接收到处理指令时
    //echo $nowkeyword;
    echo listdata();
}
//[ok]=========================================================================【输出数据】


function listdata() {
    global $Connadmin, $hy, $nowkeyword, $huis, $phpstart, $id;

    $listdata = '';
    $sql = "
        select reg.id,reg.SYS_UserName,hy.SYS_GongHao,reg.SYS_XingBie,hy.zhiwei_id,hy.state,reg.SYS_ShouJi
        From msc_user_hy AS hy
        JOIN msc_user_reg AS reg ON reg.id = hy.user_id
        where 
            hy.state in(0,1,2)
            and hy.sys_yfzuid = '$hy' 
            and ( reg.SYS_UserName like '%{$nowkeyword}%' or hy.SYS_GongHao like '%{$nowkeyword}%') 
            order by hy.state desc
    ";

    // echo $sql.'_'; 
    $rs = mysqli_query( $Connadmin, $sql );
    $record_count = mysqli_num_rows( $rs ); //统计总记录数
    //echo record_count.'_'; 

    if ( $record_count == 0 ) {
        $listdata .= '<li><a href="#">sorry,<font color="#CCC"> . 没有数据，请添加</font></a></li>';
    } else {
        while ( $row = mysqli_fetch_array( $rs ) ) {
            $id3 = $row[ 'id' ]; //id
            $SYS_UserName = $row[ 'SYS_UserName' ]; //姓名
            $SYS_GongHao = $row[ 'SYS_GongHao' ]; //工号
            $SYS_XingBie = $row[ 'SYS_XingBie' ]; //性别
            $SYS_QuanXian = $row[ 'zhiwei_id' ]; //权限
            $SYS_ShouJi = $row[ 'SYS_ShouJi' ]; //权限
            $state = $row[ 'state' ]; //禁止登录
            
            $SYS_QuanXian = str_ireplace( "_", ",", $SYS_QuanXian ); //替换"_"这",";
            //echo $SYS_QuanXian;
            $listdata2 = '';
            
            //-----------------------------------------------------------------其次职位
            $fh = ",";
            $Arr_ziduan = explode( $fh, $SYS_QuanXian );
            sort( $Arr_ziduan );
            $countArry3 = count( $Arr_ziduan );

            for ( $i3 = 0; $i3 < $countArry3; $i3++ ) {
                if ( $id <> $Arr_ziduan[ $i3 ] ) {
                    $sql3 = "select zu From `msc_zhiwei` where  id ='{$Arr_ziduan[ $i3 ]}' ";
                    //echo $sql2.'_'; 
                    $rs3 = mysqli_query( $Connadmin, $sql3 );
                    $row3 = mysqli_fetch_array( $rs3 );
                    $zhiwei = $row3[ 'zu' ]; //职位
                    $listdata2 .= '<font color="#000">[' . $zhiwei . ']</font>';
                    mysqli_free_result( $rs3 ); //释放内存
                }
            }

            //-----------------------------------------------------------------男女图标
            if ( $SYS_XingBie == '男' ) {
                $tubiao_img = '&nbsp;<i class="fa  fa-15-3"></i>'; //男图标
            } else {
                $tubiao_img = '&nbsp;<i class="fa  fa-15-4"></i>'; //女图标
            }

            //-----------------------------------------------------------------数据显示
            if($state==0){
                $lock='lock';
                $lizhi='<font color="red"><strong>[申请]</strong></font>';
            }else if($state==1){
                $lock='';
                $lizhi='<font color="#39AF01"><strong>[在职]</strong></font>';
            }else if($state==2){
                $lock='';
                $lizhi='<font color="#39AF01"><strong>[离职]</strong></font>';
            }

            if ( $huis == 1 ) {
                $edithref = "#";
                $nowhuishtml = "<dd><p onclick=DelToHuishou_mobile_one('dels_huis','$id3','msc_user_reg','$huis','$phpstart')><i class='fa fa-fanhui-02'></i>恢复</p></dd>";
                //$nowhuishtml = "<dd><p onclick=alert('回收')><i class='fa fa-fanhui-02'></i>回收</p><p onclick=alert('彻删')><i class='fa fa-del'></i>彻删</p></dd>";
            } else {
                $edithref = $phpstart . "_edit.php?id=$id3";
                $nowhuishtml = "<dd class='hui'>$listdata2 $lizhi</dd>"; //职位
            }
            
            $listdata .= '<li class="'.$lock.'"><a href="'.$edithref.'"><label>' . $tubiao_img . '&nbsp;&nbsp;' . $SYS_UserName . '<font color="#999">-' . $SYS_ShouJi . '</font></label>' . $nowhuishtml . '</a></li>';
        }
    }
    mysqli_free_result( $rs ); //释放内存
    mysqli_close( $Connadmin ); //关闭数据库
    return $listdata;
}
?>
