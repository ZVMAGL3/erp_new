<?php
if(!isset($_SESSION[$P_M]) && $_SESSION['P_M']){
?>
<div  class="foot" style="height: 55px;line-height: 55px;">
    <li class='widd'><a href="M_desk.php" class="menu site1">桌面</a></li>
    <li class='widd'><a href="M_Work.php" class="menu site2">工作</a></li>
    <li class='widd'><a href="M_moban.php?re_id=321" class="menu site3">发现</a></li>
    <li class='widd'><a href="M_find.php" class="menu site3">绩效</a></li>
    <li class='widd'><a href="M_set.php" class="menu site4">我</a></li>
</div>
<?php
}
?>