<?php
include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
include_once 'M_quanxian.php';
echo"<div class='menudesk  nocopytext'>

<a class='line'>欢迎使用...</a><a class='biaoti'><li class='menudeskhead ellipsis1'><font class='deskbh'>01&nbsp;</font>  S4 人力资源</li>
<a href='M_moban.php?re_id=204'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>员工档案</h2></ul></a>
<a href='M_moban.php?re_id=494'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>请假调休加班外出单</h2></ul></a>
</a>

<a class='line'>欢迎使用...</a><a class='biaoti'><li class='menudeskhead ellipsis1'><font class='deskbh'>02&nbsp;</font>  Z OA办公</li>
<a href='M_moban.php?re_id=280'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>工作计划</h2></ul></a>
</a>

</div>
<script>menuoverclickstyle('div.menudesk ul li.overli','overstyle','clickstyle');</script>";
?>