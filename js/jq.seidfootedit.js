//---------------------------------------------------------------------------------------------------------------------修改与添加界面格式化样式
function FormattingXiuGai(id, ToHtmlID) {
	var NowToHtmlID = "#" + ToHtmlID;
	switch (id) { //0为普通文本模式
		case "1":
			{ //货币
				//if (texts==''||texts==null||texts=='undefined'){texts='¥'};//判定为空时默认为人民币/样式/¥ 100.00
				$(NowToHtmlID + ' .F_M_XG_1').each(function (i) {
					var $thisinput = $(this).find("input"); //得到当前的input
					var thisvalue = $thisinput.val(); //得到当前的文本框值
					var thisvaluetomoney = formatCurrency(thisvalue); //得到当前格式化货币数据
					$($thisinput).val(thisvaluetomoney).css({
						"color": "red",
						"text-indent": "18px"
					}).before("<div class='inputleft'>￥</div>");
					$($thisinput).change(function () {
						$(this).val(formatCurrency($(this).val()));
					});
					$(this).addClass("thisrelative");
				});
			}
			break;
		case "2":
			{ //日期YYYY-DD-HH
				$(NowToHtmlID + ' .F_M_XG_2').each(function (i) {
					var $thisinput = $(this).find("input"); //得到当前的input
					$($thisinput).focus(function () {
						WdatePicker();
					}).click(function () {
						WdatePicker();
					}).before("<div class='Dateinputright' onclick=" + "$(this).blur().parent().find('input').focus()" + "></div>");
					$(this).addClass("thisrelative");
					//$($thisinput).addClass("Wdate");
				});
			}
			break; //加载表头左右
		case "3":
			{};
			break;
		case "4":
			{ //文件附件
				$(NowToHtmlID + ' .F_M_XG_4').each(function (i) {
					var thistext = $(this).text().Trim();
					if (thistext == '' || thistext == null || thistext == 'undefined') {
						$(this).html("&nbsp;");
					} else {
						$(this).html("<a hidefocus href=" + thistext + " title=" + thistext + " target='_blank'><img src='../images/img.png' border='0' height=" + ($(this).height() - 4) + " /></a>")
					}
				});
			}
			break;
		case "5":
			{ //图像加载原图/多图
				$(NowToHtmlID + ' .F_M_XG_5').each(function (i) {
					var $thisinput = $(this).find("input"); //得到当前的input
					var thisvalue = $thisinput.val(); //得到当前的文本框值
					$thisinput.hide(); //这里是设置为hidden
					$(this).css({
						"height": "80px"
					}); //设定高度
					$(this).prev().css({
						"height": "80px"
					}); //设定高度
					$(this).addClass("thisrelative").html("<div class='divscroll'><a hidefocus class='inputleft'></a><img name='fod' src='../images/usertile18.gif' style='float:left;height:70px;padding:2px;margin:2px;border:1px solid #CCC;' alt='' /><a style='float:left;height:28px;padding:2px;margin:2px;border:1px solid #CCC;' class='noselect' onclick=" + "PicGet(this,'addbox')" + ">+</a></div>");

				})
			}
			break;
		case "6":
			{ //图像不加载原图
				$(NowToHtmlID + ' .F_M_XG_6').each(function (i) {
					$(this).html("<a href=" + $(this).text() + " target='_blank'><img src='../images/201011111733470797.png' border='0' height=" + ($(this).height() - 4) + " /></a>")
				});
			};
			break;
		default:
			{
				alert('FormattingXiuGai(没有可执行的格式化参数！)');
			}
	}
}


//alert(seidfoot_edit_JS_OK+'JS加载成功')-->
