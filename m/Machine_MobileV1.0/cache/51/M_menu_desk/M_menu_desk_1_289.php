<?php
include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
include_once 'M_quanxian.php';
echo"<div class='menudesk  nocopytext'>

<a class='line'>&nbsp;</a><a class='biaoti'><li class='menudeskhead ellipsis1'><font class='deskbh'>01&nbsp;</font>  S4 人力资源</li>
<a href='M_moban.php?re_id=505'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>出差时间汇总</h2></ul></a>
<a href='M_moban.php?re_id=507'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>加班调休时间汇总</h2></ul></a>
<a href='M_moban.php?re_id=204'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>员工档案</h2></ul></a>
<a href='M_moban.php?re_id=294'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>工资明细</h2></ul></a>
<a href='M_moban.php?re_id=506'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>工资汇总表</h2></ul></a>
<a href='M_moban.php?re_id=509'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>快递收发登记</h2></ul></a>
<a href='M_moban.php?re_id=497'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>每日工作汇报表</h2></ul></a>
<a href='M_moban.php?re_id=315'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>简历中心</h2></ul></a>
<a href='M_moban.php?re_id=503'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>解除劳动合同证明书</h2></ul></a>
<a href='M_moban.php?re_id=508'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>请假时间汇总</h2></ul></a>
<a href='M_moban.php?re_id=494'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>请假调休加班外出单</h2></ul></a>
<a href='M_moban.php?re_id=504'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>贡献值</h2></ul></a>
</a>

<a class='line'>&nbsp;</a><a class='biaoti'><li class='menudeskhead ellipsis1'><font class='deskbh'>02&nbsp;</font>  X20 财务管理</li>
<a href='M_moban.php?re_id=513'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>奖罚记录</h2></ul></a>
</a>

<a class='line'>&nbsp;</a><a class='biaoti'><li class='menudeskhead ellipsis1'><font class='deskbh'>03&nbsp;</font>  Y21 系统设定</li>
<a href='M_moban.php?re_id=256'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>SYS云帐户</h2></ul></a>
<a href='M_moban.php?re_id=257'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>[SYS] 职位管理</h2></ul></a>
<a href='M_moban.php?re_id=391'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>上传文件管理</h2></ul></a>
<a href='M_moban.php?re_id=264'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>交流记录</h2></ul></a>
<a href='M_moban.php?re_id=388'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>分类设定</h2></ul></a>
<a href='M_moban.php?re_id=463'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>用户登录记录</h2></ul></a>
<a href='M_moban.php?re_id=262'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>质量记录清单</h2></ul></a>
</a>

<a class='line'>&nbsp;</a><a class='biaoti'><li class='menudeskhead ellipsis1'><font class='deskbh'>04&nbsp;</font>  C4 售后服务</li>
<a href='M_moban.php?re_id=499'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>合同项目跟踪记录</h2></ul></a>
<a href='M_moban.php?re_id=510'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>客户证书管理</h2></ul></a>
</a>

<a class='line'>&nbsp;</a><a class='biaoti'><li class='menudeskhead ellipsis1'><font class='deskbh'>05&nbsp;</font>  S6 外部提供</li>
<a href='M_moban.php?re_id=223'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>合作伙伴</h2></ul></a>
<a href='M_moban.php?re_id=225'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>合格供方名录</h2></ul></a>
<a href='M_moban.php?re_id=314'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>招聘供应商</h2></ul></a>
</a>

<a class='line'>&nbsp;</a><a class='biaoti'><li class='menudeskhead ellipsis1'><font class='deskbh'>06&nbsp;</font>  C1 产品要求</li>
<a href='M_moban.php?re_id=471'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>合同评审记录表</h2></ul></a>
<a href='M_moban.php?re_id=438'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>质量协议</h2></ul></a>
<a href='M_moban.php?re_id=423'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>顾客合同</h2></ul></a>
<a href='M_moban.php?re_id=437'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>顾客特殊要求清单</h2></ul></a>
</a>

<a class='line'>&nbsp;</a><a class='biaoti'><li class='menudeskhead ellipsis1'><font class='deskbh'>07&nbsp;</font>  C2 设计开发</li>
<a href='M_moban.php?re_id=472'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>APQP</h2></ul></a>
</a>

<a class='line'>&nbsp;</a><a class='biaoti'><li class='menudeskhead ellipsis1'><font class='deskbh'>08&nbsp;</font>  M6 改进</li>
<a href='M_moban.php?re_id=502'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>系统改进</h2></ul></a>
</a>

<a class='line'>&nbsp;</a><a class='biaoti'><li class='menudeskhead ellipsis1'><font class='deskbh'>09&nbsp;</font>  Z OA办公</li>
<a href='M_moban.php?re_id=280'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>工作计划</h2></ul></a>
<a href='M_moban.php?re_id=281'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>常用网址</h2></ul></a>
<a href='M_moban.php?re_id=512'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>政策法规</h2></ul></a>
<a href='M_moban.php?re_id=461'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>文件自动化</h2></ul></a>
<a href='M_moban.php?re_id=404'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>文控中心</h2></ul></a>
</a>

<a class='line'>&nbsp;</a><a class='biaoti'><li class='menudeskhead ellipsis1'><font class='deskbh'>10&nbsp;</font>  C0 销售相关</li>
<a href='M_moban.php?re_id=511'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>CCC费用查询</h2></ul></a>
<a href='M_moban.php?re_id=501'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>产品清单</h2></ul></a>
<a href='M_moban.php?re_id=495'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>服务流程单</h2></ul></a>
<a href='M_moban.php?re_id=321'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>顾客档案表</h2></ul></a>
<a href='M_moban.php?re_id=308'><ul><h1><img src='theme/default/images/note.png' class='logo'></h1><h2>顾客财产清单</h2></ul></a>
</a>

</div>
<script>menuoverclickstyle('div.menudesk ul li.overli','overstyle','clickstyle');</script>";
?>