<?php
include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
include_once 'M_quanxian.php';
echo"<div class='menudesk  nocopytext'>

<a class='line'>&nbsp;</a><a class='biaoti'><li class='menudeskhead ellipsis1'><font class='deskbh'>01&nbsp;</font>  S4 人力资源</li>
<a href='M_moban.php?re_id=505'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>出差时间汇总</h2></ul></a>
<a href='M_moban.php?re_id=507'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>加班调休时间汇总</h2></ul></a>
<a href='M_moban.php?re_id=506'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>工资汇总表</h2></ul></a>
<a href='M_moban.php?re_id=509'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>快递收发登记</h2></ul></a>
<a href='M_moban.php?re_id=497'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>每日工作汇报表</h2></ul></a>
<a href='M_moban.php?re_id=508'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>请假时间汇总</h2></ul></a>
<a href='M_moban.php?re_id=494'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>请假调休加班外出单</h2></ul></a>
<a href='M_moban.php?re_id=504'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>贡献值</h2></ul></a>
</a>

<a class='line'>&nbsp;</a><a class='biaoti'><li class='menudeskhead ellipsis1'><font class='deskbh'>02&nbsp;</font>  M6 改进</li>
<a href='M_moban.php?re_id=502'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>系统改进</h2></ul></a>
</a>

<a class='line'>&nbsp;</a><a class='biaoti'><li class='menudeskhead ellipsis1'><font class='deskbh'>03&nbsp;</font>  Z OA办公</li>
<a href='M_moban.php?re_id=280'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>工作计划</h2></ul></a>
<a href='M_moban.php?re_id=281'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>常用网址</h2></ul></a>
<a href='M_moban.php?re_id=512'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>政策法规</h2></ul></a>
<a href='M_moban.php?re_id=404'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>文控中心</h2></ul></a>
</a>

<a class='line'>&nbsp;</a><a class='biaoti'><li class='menudeskhead ellipsis1'><font class='deskbh'>04&nbsp;</font>  C0 销售相关</li>
<a href='M_moban.php?re_id=511'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>CCC费用查询</h2></ul></a>
<a href='M_moban.php?re_id=495'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>服务流程单</h2></ul></a>
</a>

</div>
<script>menuoverclickstyle('div.menudesk ul li.overli','overstyle','clickstyle');</script>";
?>