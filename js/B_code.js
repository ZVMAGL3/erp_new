
$(function() {
	var code = 9999;
    function codes(){
     	var num1 = Math.floor(Math.random() * 10);  
        var num2 = Math.floor(Math.random() * 10);  
        code = num1 + num2;  
        $("#Y_codeinput").val(code);
        $("#code").html(num1 + "+" + num2 + "=?");  
        if ($("#code").hasClass("nocode")) {  
            $("#code").removeClass("nocode");  
            $("#code").addClass("code"); 
           
        }  
    }
    codes();
    $("#code").on('click',codes);
	
	
    $("#codeinput").keyup(function(){
	  //if($("#codeinput").val()!=''){
		if($("#codeinput").val() == code && code != 9999){
			 //alert("正确!");
			 $(this).next("div").html('<img src="images/Fugue_1905.png" width="16" height="16" alt="pass"/>');
			 $(this).next("div").attr("tit",$(this).val());
			}else{
			 $(this).next("div").html('<img src="images/Fugue_874.png" width="16" height="16" alt="No Pass"/>');
			 $(this).next("div").attr("tit","");
			};
	  //}
    }).blur(function(){
	  //if($("#codeinput").val()!=''){
		if($("#codeinput").val() == code && code != 9999){
			 //alert("正确!");
			 $(this).next("div").html('<img src="images/Fugue_1905.png" width="16" height="16" alt="pass"/>');
			 $(this).next("div").attr("tit",$(this).val());
			}else{
			 $(this).next("div").html('<img src="images/Fugue_874.png" width="16" height="16" alt="No Pass"/>');
			 $(this).next("div").attr("tit","");
			};
	  //}
    });
	
	 
   
	
});  
