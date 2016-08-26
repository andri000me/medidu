	$(document).ready(function(e) {	
		loadPage('timeline');
		$.mpb('destroy');
		NProgress.start();
		setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);

		$('.ajax').click(function(e){
			NProgress.start();
			e.preventDefault(); 
			$.ajax({
				type     : "GET",
				url      : $(this).attr('href'),
				success  : function(html)
				{    
					setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
					$('#content_inti').html(html).fadeIn("slow");
					stopLoopList();
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) { 
      				var url = "index.php/Control_main/error_page/error_404";
			        $.post(url, {} ,function(data) {
						setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
						$('#content_inti').html(data).fadeIn("slow");	
			        });
				} 
            });
			this.stop();
		});	

		$('#content_timeline').slimScroll({
			color: '#7A7A7A',
			size: '5px',
			height: 'auto',
			alwaysVisible: true
		});


		function loadPage(page){ 
			//document.getElementById("loadPageEfek").style.display = "";
			//$('#content_timeline').hide();  
			//alert(page);
			$.ajax({
				type     : "POST",
				url      : "index.php/Control_default/getDetailData/"+page+"",
				data     : "id_user="+0,
					success  : function(html)
					{    
						document.getElementById("loadPageEfek").style.display = "none";
						$('#content_timeline').html(html).fadeIn("slow");  
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						document.getElementById("loadPageEfek").style.display = "none";
						var url = "<?php echo site_url('Control_main/error_page/error_505'); ?>";
						$.post(url, {} ,function(data) {
							$('#content_inti').html(data);   
						});
					} 
			});
		};

		$("#btnLogout").click(function(){
			var url = "index.php/Control_authentifikasi/sessionDestroy";
			//alert(url);
			//
			$.ajax({
			type     : "POST",
			url      : url,
			dataType : 'json',
			success  : function(html)
			{     
				if (html == true) {
					location.reload();
				}else{
					swal({   
						title   : "Gagal Logout",   
						text    : "Periksa kembali koneksi anda", 
						type    : "warning",   
					});
				}
			} 
			});
		});

		$("#btnLogin").click(function(){
			hideAll();
			var url = "index.php/Control_main/openPage/login";
			$('#myModal').fadeIn("slow").modal("show");
			$('#modal-width').prop({class:"modal-dialog modal-sm"});
			$('.modal-title').html("Login");
			$(".modal-body").html("<center><i class='fa fa-circle-o-notch fa-spin fa-2x fa-fw'></i></center>");
				
			$.post(url, {} ,function(data) {
				document.getElementById("button_login").style.display = "";
				$(".modal-body").html(data);
			});
		});
				
		
		function stopLoopList(){
			clearTimeout(time);
		}
	});
