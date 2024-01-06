<?php
include_once '../session.php';
include_once 'B_quanxian.php';
include_once '../inc/Function_All.php';
include_once '../inc/B_Config.php';//执行接收参数及配置
include_once '../inc/B_conn.php';
//$nowre_id=321;
//$colname="GongSiMingChen";
//$newcolname="GongSiMingChen22";
 //echo change_colname_guanxibiao($nowre_id,$colname,$newcolname);

 $rs = $sql = $Menu_Id_List = $Menu_checd_Id = '';
 $sql = "select * From sys_top_menu where sys_yfzuid='$hy' and sys_id_login='$bh' ";
 //echo $sql;
 $rs = mysqli_query(  $Conn , $sql );
 //$row = mysqli_fetch_array($rs);
 if ( !$row = mysqli_fetch_array( $rs ) ) {
 	$Menu_Id_List = ''; //查询到需显示的菜单清单
 	$Menu_checd_Id = 0; //当前活动的菜单
 } else {
 	$Menu_Id_List = $row[ 'Menu_Id_List' ]; //查询到需显示的菜单清单
 	//echo $Menu_Id_List;
 	$Menu_checd_Id = $row[ 'Menu_checd_Id' ]; //当前活动的菜单
 };
 /*
 $Menu_Id_List='321_顾客档案表,275_共享管理,223_供方名录,220_物资采购订货单,215_销售合同/订单,385_产品清单,217_顾客满意度调查表,461_OA-办公中心目录,204_员工档案';
 $Menu_checd_Id=321;
 //echo $Menu_Id_List;*/
?>



	<div class='topall'>
		<ul class='STYLE_fbname'>
			<img src='images/logo_white.png' alt=''/>
		</ul>
	</div>

	<DIV id='headindextop' class='nocopytext'>
		<UL onDblClick="callmenuDesk('menuA',1);" onClick="Top_SelectTag($(this).attr('id'));DeskMenu('body',$(this).attr('id'));PostAddTopMenu(0,'<?php echo $bh?>');" id="DeskMenuDiv0">
			<li class='overli'>桌面</li>
		</UL>
        <!--
		<UL id='top_loading'>
			<li class='overli selectTagdesk'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Menu loading...&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
		</UL>
        -->
	</DIV>
	


<?php
 $Htmlcache ='';
 $Htmlcache .="<script>AddTopMenu('$Menu_Id_List');";
 if ( '1'.$Menu_checd_Id == "1" or $Menu_checd_Id == 'undefined' or $Menu_checd_Id == 0 ) {
	  $Htmlcache .="Top_SelectTag('DeskMenuDiv0');";
 } else {
	  $Htmlcache .="Top_SelectTag('DeskMenuDiv$Menu_checd_Id');";
 };

	$Htmlcache .="</script>";
    echo $Htmlcache;
	//$Htmlcacheall='<?php echo"'.$Htmlcache.' ";? >';
    //echo $Htmlcache;
	//find_cache('3',$Htmlcacheall);
 mysqli_free_result( $rs ); //释放内存
?>

