<?php
include_once( '../../session.php' ); //接收session信息
include_once '../../inc/B_connadmin.php'; //连上注册数据库
include_once( 'M_quanxian.php' ); //接收职位权限信息
include_once 'M_Department_Set.php'; //连上参数设定
include_once '../../inc/Function_All.php'; //连上参数设定

//================================================================以下为处理数据
if ( isset( $_POST[ 'act' ] ) )$act = $_POST[ 'act' ]; //act
//echo($_POST[ 'data' ]);
if ( $act == 'add_mobile' ) { //当接收到处理指令时
    //----------------------------------查询是否有重复值
    //echo $hy;
    if ( isset( $_POST[ 'name' ] ) )$name = $_POST[ 'name' ]; //name
    if ( isset( $_POST[ 'bumen' ] ) )$bumen = $_POST[ 'bumen' ]; //name

    if ( !isset($name) ) {
        echo "名称，不能为空";
    } if ( !$bumen || !in_array($bumen, $SonBumenIdxList)) {
        echo "需要选择从属的父级部门！";
    } else {
        $idx = array_search($bumen, $SonBumenIdxList);
        $parent = $SonBumenList[$idx]['id'];
        $error = null;
        while(true){
            $index = array_search($parent, $SonBumenIdxList);
            if($SonBumenList[$index]['bumenname'] == $name){
                echo "上级部门已有\"" . $name . "\",禁止添加。";
                $error = true;
                break;
            }else{
                $parent = $SonBumenList[$index]['parent'];
                if(!$parent){
                    break;
                }
            }
        }
        if(!$error){
            $sql = "SELECT id From `$tablename` where $colsname='$name' and parent = $bumen and sys_yfzuid='$hy'";
            // echo $sql.'_'; 
            $rs = mysqli_query( $Connadmin, $sql );
            $record_count = mysqli_num_rows( $rs ); //统计总记录数
            mysqli_free_result( $rs ); //释放内存
    
            if ( $record_count > 0 ) { //有重复值时
                echo "所选部门已有\"" . $name . "\",禁止添加。";
            } else { //允许添加
                $sql = "
                    START TRANSACTION;
                        INSERT INTO msc_bumenlist (bumenname, sys_yfzuid, parent) VALUES ( '$name' , $hy, $bumen );
                        SET @bumen_id = LAST_INSERT_ID();
                        INSERT INTO msc_zhiwei (sys_yfzuid, zu, bumen, FuZeRen) VALUES ($hy, '". $name ."主任', @bumen_id,1);
                        SET @authority_id = LAST_INSERT_ID();
                    COMMIT;
                ";
                if (mysqli_multi_query($Connadmin, $sql)) {
                    do {
                        // 处理和释放前一个查询的结果集
                        if ($result = mysqli_store_result($Connadmin)) {
                            mysqli_free_result($result);
                        }
                    } while (mysqli_more_results($Connadmin) && mysqli_next_result($Connadmin));
                
                    // 事务成功提交，可以继续执行其他操作
                } else {
                    echo "执行事务失败: " . mysqli_error($Connadmin);
                }  
                echo mysqli_error($Connadmin);

                selectdata($SYS_QuanXian_list);
                echo "添加成功！"; /*这里只能禁止修改*/
                // echo mysqli_error($Connadmin);\
            }
            
        }
    }
    //echo $name;
} else {

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
    <div id="header"> <a href="<?php echo $phpstart ?>.php" class="home"></a> <em class="eleft"><?php echo $textsname ?> 添加</em> <a href="#" class="siteMap"></a> </div>
    <form autocomplete='off' onsubmit='return false' onkeydown="if(event.keyCode==13){return false;}">
        <div id='mobanaddbox' class='NowULTable nocopytext'>
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;<font color='red'>[重]</font>&nbsp;<?php echo $textsname ?>名称:</li>
                <li class='cols02'>
                    <input type='text' typeid='1' name='name' id='name' class='addboxinput inputfocus'  value='' onkeydown="if(event.keyCode == 13){return false;}" />
                    <div class='cols03 font_red yanzheng' id='name_bitian'></div>
                </li>
            </ul>
            <ul>
                <li class='cols01'><font color='red' class='s_bt'>*</font>&nbsp;部门:</li>
                <li class='cols02'>
                    <select name='bumen' id='bumenbox' class='addboxinput inputfocus'>
                        <option  value='0'>未选择</option>
                    </select>
                </li>
            </ul>
            <ul>
                <li class='cols01'> &nbsp;</li>
                <li class='cols02'>
                    <input id='reset_add' type='reset' value='重填' tabindex=-1 class='button button_reset' onclick="inputfocusfirst('#mobanaddbox','name')">
                    <input id='SYS_submit' value='提交' type='button' title='Ctrl+Enter提交' class='button button_ADD' onclick="add_edit_mobile(this,'<?php echo $phpstart ?>_add.php','add_mobile','<?php echo $phpstart ?>.php?act=list')"    />
                    <label>&nbsp;&nbsp;&nbsp;<input name='SYS_lianxu' id='SYS_lianxu'  type='checkbox'  class='button' />&nbsp;<font  color='#999'>连续添加</font></label>
                </li>
            </ul>
            <ul>
                <li class='cols01'> &nbsp;</li>
                <li class='cols02'> <font id='editsuccess' class='font_red'></font></li>
            </ul>
            <input type='hidden' name='act' id='act' value='add_mobile' />
        </div>
    </form>
    <?php include_once( 'M_foot.php' );?>
    <?php include_once( 'M_bottom.php' );?>
</div>
</body>
</html>
<script type="text/javascript" src="../../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../../js/jq.host_mobile.js"></script>

<script>
    $(document).ready(function() {
        let SonBumenList = <?php echo json_encode($_SESSION['SonBumenList']) ?>;   
        // console.log(<?php echo json_encode($_SESSION['SonBumenList']) ?>) 
        SonBumenList.forEach((item) => {
            var div = $("<option>")
            div.val(item.id).text('-- '.repeat(item.prefix)+item.bumenname)
            $('#bumenbox').append(div)
        })
    })
</script>
<?php
}
mysqli_close( $Connadmin ); //关闭数据库 
?>