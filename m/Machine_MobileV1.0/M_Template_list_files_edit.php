<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_Config.php'; //执行接收参数及配置
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Template_list_files_Set.php'; //连上参数设定

//================================================================以下为处理数据

if ( isset( $_POST[ 'act' ] ) )$act = $_POST[ 'act' ]; //act
if ( isset( $_REQUEST[ 'id' ] ) )$id = $_REQUEST[ 'id' ]; //id
//echo($_POST[ 'data' ]);

if ( $act == 'edit_mobile' ) { //当接收到处理指令时
    //----------------------------------查询是否有重复值
    //echo $hy;
    //echo '00';

    if ( isset( $_POST[ 'title' ] ) )$title = $_POST[ 'title' ];
    if ( isset( $_POST[ 'path' ] ) )$path = $_POST[ 'path' ];
    if ( isset( $_POST[ 'size' ] ) )$size = $_POST[ 'size' ];


    if ( $title . '1' == '1' ) {
        echo "$textsname名称，不能为空！";
    } else {

        $sql = $rs = $record_count = '';
        $sql = "select id,$colsname,path From `$tablename` where (title='$title' and sys_Id_MenuBigClass='$parent_id') and id<>'$id' order by id Asc";
        //echo $sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        $record_count = mysqli_num_rows( $rs ); //统计总记录数
        mysqli_free_result( $rs ); //释放内存

        if ( $record_count > 0 ) { //有重复值时
            echo "已有重复值\"" . $title . "\",禁止修改。";
        } else { //允许修改
            //echo"可以修改";
            $sql = $rs = '';
            $nowdata = date( 'Y-m-d H:i:s' );
            $sql = "UPDATE  `$tablename`  set `$colsname` ='$title',`path`='$path',`size`='$size',`sys_adddate_g`='$nowdate' WHERE id='$id' ";
            //--------------------------------------以下为执行修改
            //echo $sql;
            mysqli_query( $Connadmin, $sql ); //执行修改
            echo "修改成功！"; /*这里只能禁止修改*/
        }
        mysqli_free_result( $rs ); //释放内存
        mysqli_close( $Connadmin ); //关闭数据库
    }
    //echo $title;
} else {
    //查询到相关值

    $sql = $rs = $row = '';
    if ( $id > 0 ) {
        $sql = "select id,$colsname,path,size,ext,sys_adddate,sys_adddate_g From `$tablename` where id='$id' order by id Asc";
        //echo '<br><br><br><br>'.$sql.'_'; 
        $rs = mysqli_query( $Connadmin, $sql );
        //$record_count = mysqli_num_rows( $rs ); //统计总记录数
        $row = mysqli_fetch_array( $rs );
        $title = $row[ 'title' ];
        $path = $row[ 'path' ];
        $size = $row[ 'size' ];
        $ext = $row[ 'ext' ];
        $sys_adddate = $row[ 'sys_adddate' ];
        $sys_adddate_g = $row[ 'sys_adddate_g' ];
        mysqli_free_result( $rs ); //释放内存
    }
    mysqli_close( $Connadmin ); //关闭数据库 
    ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width,user-scalable=0,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
<meta name="format-detection" content="telephone=no"/>
<title>SQP Certificate Mobile</title>
<link href="theme/style.css" rel="stylesheet" type="text/css"/>
<link href='../../style/menuimage.css' rel='stylesheet' type='text/css' />
</head>

<body>
<div id="wrapper">
    <div id="header"> <a href="<?php echo $phpstart ?>.php?parent_id=<?php echo $parent_id ?>" class="home"></a> <em class="eleft"><?php echo $textsname ?> 修改</em> <a href="M_right_menu.php" class="siteMap"></a> </div>
    <form autocomplete='off' οnsubmit='return false' οnkeydοwn="if(event.keyCode==13){return false;}">
        <div id='mobanaddbox' class='NowULTable nocopytext' style='text-align:right;width:100%;margin-top:75px;margin-bottom: 90px;'> 
            <!--   !-->
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font>文件名:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='title' id='title' placeholder="" class='addboxinput inputfocus'  value='<?php echo $title ?>'  onkeyup='chanshu_pinyin_mobile(this,"<?php echo $parent_id ?>")'  style='width:90%' />
                    <div class='cols03 font_red yanzheng' id='title_bitian'></div>
                </li>
            </ul>
            <!--   path!-->
            <ul>
                <li class='cols01'>文件地址:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='path' id='path' placeholder="" class='addboxinput inputfocus'  value='<?php echo $path ?>'  style='width:90%' readonly />
                    <div class='cols03 font_red yanzheng' id='path_bitian'></div>
                </li>
            </ul>
            <ul>
                <li class='cols01'>文件大小:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='size' id='size' placeholder="" class='addboxinput inputfocus'  value='<?php echo $size ?>'  style='width:90%' readonly />
                    <div class='cols03 font_red yanzheng' id='size_bitian'></div>
                </li>
            </ul>
            <?php
            $nowpath = '';
            $arr = 'jpg,png,gif,jpeg,tiff';
            $getNid = getN( $arr, $ext, ',' );
            //echo $getNid;
            if ( $getNid == -1 ) {//不为图片时
                $nowpath = "<img src='../../uploadhtml5e/images/" . $ext . ".png' width='80' style='margin:3px;padding: 2px;border:1px solid #999;margin-left: 3px;'>";
            } else {
                $nowpath = "<a  href='../../$path'  target='_blank'><img  src='../../$path' width='90%' style='margin:3px;padding: 2px;border:1px solid #999;margin-left: 3px;'></a>";
            }

            ?>
            <ul>
                <li class='cols01'>显示:</li>
                <li class='cols02'><?php echo $nowpath ?></li>
            </ul>
            <ul>
                <li class='cols01'>添加时间:</li>
                <li class='cols02'>&nbsp;<?php echo $sys_adddate ?></li>
            </ul>
            <ul>
                <li class='cols01'>更新时间:</li>
                <li class='cols02'>&nbsp;<?php echo $sys_adddate_g ?></li>
            </ul>
            <ul style='height:15px;width:100%;'>
                <li style='width:98%'></li>
            </ul>
            <?php if ( $const_q_tianj >= 0 ) { //有添加权限时 ?>
            <ul>
                <li class='cols01'> &nbsp;</li>
                <li class='cols02'>
                    <input id='SYS_submit' value='提 交' type='button' title='Ctrl+Enter提交' class='button button_ADD' style='width:100px'   onclick="add_edit_mobile(this,'<?php echo $phpstart ?>_edit.php','edit_mobile','<?php echo $phpstart ?>.php?parent_id=<?php echo $parent_id ?>')"    />
                </li>
            </ul>
            <ul>
                <li class='cols01'> &nbsp;</li>
                <li class='cols02'> <font id='editsuccess' class='font_red' style="width: 120px"></font></li>
            </ul>
            <?php
            }
            ?>
            <input type='hidden' name='id' id='id' value='<?php echo $id ?>' />
            <input type='hidden' name='act' id='act' value='edit_mobile' />
        </div>
    </form>
    <?php include_once( 'M_foot.php' );?>
    <?php include_once( 'M_bottom.php' );?>
</div>
</body>
</html>
<script type="text/javascript" src="../../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../../js/hztopy-min.js"></script>
<script type="text/javascript" src="../../js/jq.host_mobile.js"></script>
<script type="text/javascript" src="../../js/pc_mobile.js"></script>
<?php
}
?>
