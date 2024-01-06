<?php
include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
include_once 'B_quanxian.php';
echo"<div class='menudesk  nocopytext'>

<ul><li class='menudeskhead ellipsis1'><font class='deskbh'>01&nbsp;</font>  M1 组织环境</li>
<li cus='SQP_ZongGuoChengQingDan'   onclick='changeright(this,0,190,\"总过程清单\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='总过程清单'>总过程清单</div></li>

<li cus='SQP_XiangGuanFangDeXuQiuHeQiWangShiBieBiao'   onclick='changeright(this,0,269,\"相关方的需求和期望识别表\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='相关方的需求和期望识别表'>相关方的需求和期望识别表</div></li>
</ul>

<ul><li class='menudeskhead ellipsis1'><font class='deskbh'>02&nbsp;</font>  S4 人力资源</li>
<li cus='SQP_ChuChaShiJianHuiZong'   onclick='changeright(this,0,505,\"出差时间汇总\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='出差时间汇总'>出差时间汇总</div></li>

<li cus='SQP_JiaBanDiaoXiuShiJianHuiZong'   onclick='changeright(this,0,507,\"加班调休时间汇总\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='加班调休时间汇总'>加班调休时间汇总</div></li>

<li cus='sys_yuangongdanganbiao'   onclick='changeright(this,0,204,\"员工档案\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='员工档案'>员工档案</div></li>

<li cus='sys_GongZiBiao'   onclick='changeright(this,0,506,\"工资汇总表\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='工资汇总表'>工资汇总表</div></li>

<li cus='SQP_KuaiDiShouFaDengJi'   onclick='changeright(this,0,509,\"快递收发登记\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='快递收发登记'>快递收发登记</div></li>

<li cus='SQP_MeiRiGongZuoHuiBaoBiao'   onclick='changeright(this,0,497,\"每日工作汇报表\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='每日工作汇报表'>每日工作汇报表</div></li>

<li cus='SQP_JianLiZhongXin'   onclick='changeright(this,0,315,\"简历中心\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='简历中心'>简历中心</div></li>

<li cus='SQP_JieChuLaoDongHeTongZhengMingShu'   onclick='changeright(this,0,503,\"解除劳动合同证明书\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='解除劳动合同证明书'>解除劳动合同证明书</div></li>

<li cus='SQP_QingJiaShiJianHuiZong'   onclick='changeright(this,0,508,\"请假时间汇总\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='请假时间汇总'>请假时间汇总</div></li>

<li cus='SQP_QingJiaDiaoXiuJiaBanWaiChuDan'   onclick='changeright(this,0,494,\"请假调休加班外出单\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='请假调休加班外出单'>请假调休加班外出单</div></li>

<li cus='SQP_GongXianZhi'   onclick='changeright(this,0,504,\"贡献值\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='贡献值'>贡献值</div></li>
</ul>

<ul><li class='menudeskhead ellipsis1'><font class='deskbh'>03&nbsp;</font>  C4 售后服务</li>
<li cus='SQP_HeTongXiangMuGenZongJiLu'   onclick='changeright(this,0,499,\"合同项目跟踪记录\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='合同项目跟踪记录'>合同项目跟踪记录</div></li>

<li cus='SQP_KeHuZhengShuGuanLi'   onclick='changeright(this,0,510,\"客户证书管理\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='客户证书管理'>客户证书管理</div></li>

<li cus='SQP_GuKeBaoYuanTouSuQingDan'   onclick='changeright(this,0,319,\"顾客抱怨投诉清单\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='顾客抱怨投诉清单'>顾客抱怨投诉清单</div></li>

<li cus='SQP_GuKeManYiDuDiaoChaFenXiBiao'   onclick='changeright(this,0,307,\"顾客满意度调查分析表\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='顾客满意度调查分析表'>顾客满意度调查分析表</div></li>

<li cus='SQP_GuKeManYiDuDiaoChaBiao'   onclick='changeright(this,0,218,\"顾客满意度调查表\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='顾客满意度调查表'>顾客满意度调查表</div></li>

<li cus='SQP_GuKeManYiDuDiaoChaJiHua'   onclick='changeright(this,0,217,\"顾客满意度调查计划\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='顾客满意度调查计划'>顾客满意度调查计划</div></li>
</ul>

<ul><li class='menudeskhead ellipsis1'><font class='deskbh'>04&nbsp;</font>  S6 外部提供</li>
<li cus='SQP_HeZuoHuoBan'   onclick='changeright(this,0,223,\"合作伙伴\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='合作伙伴'>合作伙伴</div></li>

<li cus='SQP_ZhaoPinGongYingShang'   onclick='changeright(this,0,314,\"招聘供应商\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='招聘供应商'>招聘供应商</div></li>
</ul>

<ul><li class='menudeskhead ellipsis1'><font class='deskbh'>05&nbsp;</font>  C1 产品要求</li>
<li cus='SQP_GuKeHeTong'   onclick='changeright(this,0,423,\"顾客合同\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='顾客合同'>顾客合同</div></li>
</ul>

<ul><li class='menudeskhead ellipsis1'><font class='deskbh'>06&nbsp;</font>  M6 改进</li>
<li cus='SQP_XiTongGaiJin'   onclick='changeright(this,0,502,\"系统改进\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='系统改进'>系统改进</div></li>
</ul>

<ul><li class='menudeskhead ellipsis1'><font class='deskbh'>07&nbsp;</font>  Z OA办公</li>
<li cus='SQP_GongZuoJiHua'   onclick='changeright(this,0,280,\"工作计划\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='工作计划'>工作计划</div></li>

<li cus='SQP_ChangYongWangZhi'   onclick='changeright(this,0,281,\"常用网址\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='常用网址'>常用网址</div></li>

<li cus='SQP_ZhengCeFaGui'   onclick='changeright(this,0,512,\"政策法规\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='政策法规'>政策法规</div></li>

<li cus='SQP_WenKongZhongXin'   onclick='changeright(this,0,404,\"文控中心\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='文控中心'>文控中心</div></li>
</ul>

<ul><li class='menudeskhead ellipsis1'><font class='deskbh'>08&nbsp;</font>  C0 销售相关</li>
<li cus='SQP_CCCFeiYongChaXun'   onclick='changeright(this,0,511,\"CCC费用查询\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='CCC费用查询'>CCC费用查询</div></li>

<li cus='SQP_ChanPinQingDan'   onclick='changeright(this,0,501,\"产品清单\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='产品清单'>产品清单</div></li>

<li cus='SQP_FuWuLiuChengDan'   onclick='changeright(this,0,495,\"服务流程单\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='服务流程单'>服务流程单</div></li>

<li cus='sys_gukedanganbiao'   onclick='changeright(this,0,321,\"顾客档案表\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='顾客档案表'>顾客档案表</div></li>

<li cus='SQP_GuKeCaiChanQingDan'   onclick='changeright(this,0,308,\"顾客财产清单\");' class='overli'><div class='head00'><img src=' images/menu/edge.png'  height='30' alt=''/></div><div class='head01 ellipsis1' title='顾客财产清单'>顾客财产清单</div></li>
</ul>
</div>
<div class='deskbottom'>&nbsp;&nbsp;{$reg_name} > {$const_bumenname}({$const_q_zu}) > {$SYS_UserName}({$bh})<a>软件名：SQPAMS V1.0&nbsp;▪&nbsp;开发商：源引力检测认证有限公司 &nbsp;▪&nbsp; SQP使命：让优秀的企业更优秀*让世界贸易成为享受！</a><marquee width='1px'></marquee></div>
</div>
<script>menuoverclickstyle('div.menudesk ul li.overli','overstyle','clickstyle');</script>";
?>