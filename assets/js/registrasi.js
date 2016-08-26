//$(document).ready(function(e) {	
	var statusUsername 	= false;	
	var statusEmail 	= false;
	var lengthAgree 	= false;	

	$(".message_close").click(function(){
		$("#message-box-warning").fadeOut();
	});

	$("#showPass").click(function(){
		if($('#showPass').is(":checked")){
			$('#password').prop({type:"text"});
			$('#repassword').prop({type:"text"});
		}else{    
			$('#password').prop({type:"password"});
			$('#repassword').prop({type:"password"});
		}
	});

	$("#email, #username").keyup(function(){
	var attribut = $(this).attr("name");

		if (attribut == "username") {
			$("#messageErrorUsername").html("<i class='fa fa-spinner fa-spin fa-fw'></i>");
			cekUsername($("#username").val(), "");
			key   = attribut;
			value = $("#username").val();
		}
		else if (attribut == "email") {
			$("#messageErrorEmail").html("<i class='fa fa-spinner fa-spin fa-fw'></i>");

			key   = attribut;
			value = $("#email").val();
		}

        var url         = "index.php/Control_authentifikasi/cekAccount";
        var dataString  = "table=tbl_user&key="+key+"&value="+value;
        $.ajax({
			type     : "POST",
			url      : url,
			dataType : 'json',
			data     : dataString,
			success  : function(html)
			{       
				if (attribut == "username") { cekUsername($("#username").val(), html); }
				else if(attribut == "email") { cekEmail(isValidEmailAddress($("#email").val()), html); }
			}
        });
  	});

	function cekForm(){
		if($('#agree').is(":checked")){
			lengthAgree = true;
		}else{
			lengthAgree = false;        
		}

		if (statusUsername == false || statusEmail == false) { 
			document.getElementById("error_available").style.display 	= "";
			document.getElementById("error_agree").style.display 		= "none";
			$("#message-box-warning").fadeIn("slow");
		}else if(lengthAgree == false){
			document.getElementById("error_available").style.display 	= "none";
			document.getElementById("error_agree").style.display 		= "";
			$("#message-box-warning").fadeIn("slow");
		}else{
			var url         = "index.php/Control_user/insert";
	        var dataString  = $("#wizard-validation").serialize()+"&table=tbl_user&key=id&akses=2";
	        $.ajax({
				type     : "POST",
				url      : url,
				dataType : 'json',
				data     : dataString,
				success  : function(html)
				{       
					if (html == true) {
						noty({
							text 	: 'Done Save', 
							layout 	: 'topCenter', 
							type 	: 'success'
						}); 

						NProgress.start();
						url	= "index.php/Control_main/openPage/registrasi";
						$.post(url, {} ,function(data) {
							setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
							$('#content_inti').html(data);	
						});
						this.stop();
					}else{
						noty({
							text 	: 'Save Failed', 
							layout 	: 'topCenter', 
							type 	: 'warning'
						}); 
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) { 
					url = "index.php/Control_main/error_page/error_505";
					$.post(url, {} ,function(data) {
						$('#content_inti').html(data);
					});
				} 
	        });
		}
	};

	function isValidEmailAddress(emailAddress) {
		var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
		return pattern.test(emailAddress);
	};

	function cekUsername(cek, status){
		if (cek.length == 0) {
			$("#messageErrorUsername").html("<i class='fa fa-user'></i>");  statusUsername = false;  			
		}else if (cek.length>=6 && status == true) {
			$("#messageErrorUsername").html("<i class='glyphicon glyphicon-remove'></i> Sudah digunakan");  statusUsername = false;      
		}else if (cek.length>=6 && status == false) {
			$("#messageErrorUsername").html("<i class='glyphicon glyphicon-ok'></i> Belum digunakan");  statusUsername = true;      
		}else{
			$("#messageErrorUsername").html("<i class='fa fa-spinner fa-spin fa-fw'></i>"); statusUsername = false;
		}
	}

	function cekEmail(cek, status){
		if (cek == true && status == true) {
			$("#messageErrorEmail").html("<i class='glyphicon glyphicon-remove'></i> Sudah digunakan"); statusEmail = false;       
		}else if (cek == true && status == false) {
			$("#messageErrorEmail").html("<i class='glyphicon glyphicon-ok'></i> Belum digunakan"); statusEmail = true;    
		}else{
			$("#messageErrorEmail").html("<i class='fa fa-spinner fa-spin fa-fw'></i>"); statusEmail = false;
		}
	}
//});