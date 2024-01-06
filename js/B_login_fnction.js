function StandardPost (url,args) //链接转成post
    {
        var form = $("<form method='post'></form>");
        form.attr({"action":url});
        for (arg in args)
        {
            var input = $("<input type='hidden'>");
            input.attr({"name":arg});
            input.val(args[arg]);
            form.append(input);
        }
        form.submit();
    }
function RegExpression_s(obj,i){//正则表达式
 switch (i){
   case 1 :{regs=/[\*\^\|\~\!\#\$\%\&amp;\(\)\{\}\[\]\?\&lt;\&gt;\.\,\'\;\\\/\=\ ]+/;break;};   //不允许输入各种符号
   case 2 :{regs=/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/;break;} // email
   case 3 :{regs=/^[01]?[- .]?(\([2-9]\d{2}\)|[2-9]\d{2})[- .]?\d{3}[- .]?\d{4}$/;break;}; //phoneNumberUS
   case 4 :{regs=/[\x80-\xff_a-zA-Z0-9]+/;break;}; //phoneNumberUS
   case 5 :{regs=/^http:\/\/[a-zA-Z0-9]+\.[a-zA-Z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/;break;}; //网址
   case 6 :{regs=/^1\d{11}$/;break;}; //手机号
   case 7 :{regs=/^[a-zA-Z]+$/;break;}; //只能输入字母
   case 8 :{regs=/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;break;}; //邮箱地址
   case 9 :{regs=/^(\d{3,4}\-)?[1-9]\d{6,7}$/;break;}; //电话号码
   case 10 :{regs =/(^\s*)|(\s*$)/g;break;}; //不为空格
   case 11 :{regs =/^[a-zA-Z\u0391-\uFFE5].{15}$/;break;}; //不为以数字开头
   case 12 :{regs =/[^\d]/;break;}; //只能输入数(
   default:{regs=/[\*\^\|\~\!\#\$\%\&amp;\(\)\{\}\[\]\?\&lt;\&gt;\.\,\'\;\\\/\=\ ]+/;};   //不允许输入各种符号
  }
   
   obj.value=obj.value.replace(regs,'');
}
//correctPNG();
//--------------------------------------------------------------------------------------//验证是否有填值
function passthis(ths){
		if($(ths).val() != "" && $(ths).val() != "Mobile"){
			 $(ths).parent().next("div").html('<img src="../images/Fugue_1905.png" width="16" height="16" alt="pass"/>');
			 $(ths).parent().next("div").attr("tit",$(ths).val());
			}else{
			 $(ths).parent().next("div").html('<img src="../images/Fugue_874.png" width="16" height="16" alt="No Pass"/>');
			 $(ths).parent().next("div").attr("tit","");
			}
		//alert($(ths).val());
}


//--------------------------------------------------------------------------------------//修改指定值
function M_edit_Post(id,Tablename,zdname,TitleName,InputType,thisvale=''){

	    if (thisvale==''|| !thisvale){var thisvale=$('#'+zdname).val();};
         //alert(thisvale);
	    //alert('id：'+id+';  Tablename：'+Tablename+';  zdname：'+zdname+';  TitleName：'+TitleName+';  InputType：'+InputType+';  thisvale：'+thisvale);
		$.post('M_edit_data.php', {act:'edit_Connadmin',id: id,Tablename: Tablename,zdname:zdname,TitleName:TitleName,InputType:InputType,thisvale:thisvale}, function (data) {
		//alert(data);
		window.location.href=document.referrer;//返回上页
	    });
}
//--------------------------------------------------------------------------------------//根据职位id生成php动态权限
function php_Post(zwid,nowtype){
        if(nowtype=='pc'){ //电脑端
			$.post('MachineV1.0/B_quanxian_chache.php', {act:'list',zwid: zwid}, function (data) {
				$.post('m/Machine_MobileV1.0/M_quanxian_chache.php', {act:'list',zwid: zwid},function(data){
					$.post('MachineV1.0/B_menu_desk_chache.php', {act:'list',zwid: zwid},function(data){
						$.post('m/Machine_MobileV1.0/M_menu_desk_chache.php', {act:'list',zwid: zwid},function(data){
							window.location.href='MachineV1.0/B_main.php';
						});
					});
				});
	            
	        });
		}else{
			$.post('../m/Machine_MobileV1.0/M_quanxian_chache.php', {act:'list',zwid: zwid}, function (data) {
				$.post('../MachineV1.0/B_quanxian_chache.php', {act:'list',zwid: zwid},function(data){
					$.post('../m/Machine_MobileV1.0/M_menu_desk_chache.php', {act:'list',zwid: zwid},function(data){
						$.post('../MachineV1.0/B_menu_desk_chache.php', {act:'list',zwid: zwid},function(data){
							window.location.href='m/Machine_MobileV1.0/M_desk.php';	 
						});
					});
				});
	        });
		}    
}
//--------------------------------------------------------------------------------------//修改指定值
function M_edit_password(){

	    var Y_password=$('#Y_password').val();           //原密码
	    var new_password=$('#new_password').val();       //新密码
	    var new_password2=$('#new_password2').val();     //新密码2
        
	    alert( Y_password+new_password+new_password2);
		$.post('M_edit_data.php', {act:'password',Y_password: Y_password,new_password: new_password,new_password2:new_password2}, function (data) {
		//alert(data);
	    
		//window.location.href=document.referrer;//返回上页
	    });
}
//--------------------------------------------------------------------------------------//打开指定页
function OpenBox(DIVid){//OpenBox('#form1_reg')
     $("#form1_reg,#form1_reg2,#form1_reg3").hide(1);
	 $(DIVid).show(500);
}
//--------------------------------------------------------------------------------------//验证重复的手机号
function YanZengChongFu_mobile(ths,form){
	//alert('00');
	var username=$(form+' #username').val();
	//alert(username);
	var nowlen=username.length;//长度
	//alert(nowlen);
	if(nowlen<11){
		alert('对不起，手机号位数不对。');
		$('#username').focus();
		return false;
	}
	if ('1'+username == '1'||username=='Mobile'){
		alert("对不起手机号不能为空，请输入");
		$('#username').focus();
	}else{
		
		$.post('M_reg_yanzheng.php', {act: "username",username: username}, function (data) {
			//alert(data);
			var nowdata=data.trim()*1;
			if (nowdata > 0){
				
				$(ths).parent().next("div").html('<img src="../images/Fugue_874.png" width="16" height="16" alt="No Pass"/>');
				alert('该用户已被注册，请用其它手机号注册');
				$(form+" #Submit01").attr("disabled", true); 
			}else{
				//alert('可以注册');
				$(ths).parent().next("div").html('<img src="../images/Fugue_1905.png" width="16" height="16" alt="pass"/>');
				$(form+" #Submit01").attr("disabled", false); 
				
			}
	    });
	}

}
//--------------------------------------------------------------------------------------//下一页
function mobilenext(form){
	//alert('00');
	var username=$('#username').val();
	var nowlen=username.length;//长度
	//alert(nowlen);
	if(nowlen<11){
		alert('对不起，手机号位数不对。');
		$('#username').focus();
		return false;
	}
	if ('1'+username == '1'||username=='Mobile'){
		alert("对不起手机号不能为空，请输入");
		$('#username').focus();
	}else{
		
		$.post('reg_yanzheng.php', {act: "username",username: username}, function (data) {
			//alert(data);
			var nowdata=data.trim()*1;
			if (nowdata > 0){
				alert('该用户已被注册，请用其它手机号注册');
			}else{
				//alert('可以注册');
				
				OpenBox('#form1_reg2');
			}
	    });
	}

}
//--------------------------------------------------------------------------------------//验证重复的手机号
function YanZengChongFu_email(form){
	//alert('00');
	var SYS_Email=$('#SYS_Email').val();
	//alert(SYS_Email);

	if ('1'+SYS_Email == '1'){
		alert("对不起邮箱不能为空，请输入");
		$('#SYS_Email').focus();
		return false;
	}else{
		
		$.post('reg_yanzheng.php', {act: "SYS_Email",SYS_Email: SYS_Email}, function (data) {
			//alert(data);
			var nowdata=data.trim()*1;
			if (nowdata > 0){
				alert('该用户已被注册，请用其它手机号注册');
			}else{
				//alert('可以注册');
				OpenBox('#form1_reg3');
			}
	    });
	}

}
//--------------------------------------------------------------------------------------//注册提交
function ZhuCheUser(){
	//alert('00');
	var hy=9007;
	var SYS_ShouJi=$('#username').val();
	var SYS_UserName=$('#SYS_UserName').val();
	var SYS_Email=$('#SYS_Email').val();
	var SYS_PassWord=$('#SYS_PassWord').val();
	var SYS_PassWord2=$('#SYS_PassWord2').val();
	//alert(SYS_Email);
    if ('1'+SYS_ShouJi == '1'){
		alert("手机号不能为空，请重新输入");
		OpenBox('#form1_reg');
		$('#username').focus();
		return false;
	}
	if ('1'+SYS_UserName == '1'){
		alert("姓名不能为空，请重新输入");
		OpenBox('#form1_reg2');
		$('#SYS_UserName').focus();
		return false;
	}
	if ('1'+SYS_Email == '1'){
		alert("邮箱不能为空，请重新输入");
		OpenBox('#form1_reg2');
		$('#SYS_Email').focus();
		return false;
	}
	if ('1'+SYS_PassWord == '1'){
		alert("密码1不能为空，请重新输入");
		OpenBox('#form1_reg3');
		$('#SYS_PassWord').focus();
		return false;
	}
	if ('1'+SYS_PassWord2 == '1'){
		alert("密码2不能为空，请重新输入");
		OpenBox('#form1_reg3');
		$('#SYS_PassWord2').focus();
		return false;
	}
	if (SYS_PassWord != SYS_PassWord2){
		alert("两次密码不一致，请重新输入");
		OpenBox('#form1_reg3');
		$('#SYS_PassWord').focus();
		return false;
	}
	
	//alert('username:'+username+'_SYS_Email:'+SYS_Email+'_SYS_PassWord:'+SYS_PassWord);
	
		
	$.post('M_reg_yanzheng.php', {act: "useradd",SYS_ShouJi,SYS_UserName,SYS_Email,SYS_PassWord}, function (data) {
		//$('#form1_reg3').append(data);
		if(data === '200'){
			alert('注册成功，将返回登录页面进行登录。');
			window.location.href = "index.php";
		}else{
			alert(data)
		}
	});
	
}


//alert('B_login_function.js');测试该js加载成功