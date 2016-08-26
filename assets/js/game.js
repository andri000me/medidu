function Game(){
    var url;
    var dataString;
    var alertinfo;
    var alertTitle;
    var id_game;

    var id;
    var table;
    var field;
    var page;
    var operasi;
    var table_foreign;

    var file;

    //Private function
    function setUrl(data) {
        url 		= data;
    }
    function setData(data) {
        dataString 	= data;
    }
    function setAlertInfo(data) {
        alertinfo 	= data;
    }
    function setDataFile(data) {
        file 		= data;
    }

	function getUrl(){
        return url; 
    }

	function getDataString() {
        return dataString; 
    }

	function getAlertInfo() {
        return alertinfo; 
    }
	function getDataFile() {
        return file; 
    }

    //Privileged function
    this.setDataUrl = function (data) {
    	setUrl(data);
    }


    this.setDataString = function (data) {
    	setData(data);
    }

    this.setDataAlert = function (data) {
    	setAlertInfo(data);
    }

    this.setIdGame = function (data) {
    	id_game = data;
    }

    this.setFile = function (data) {
    	setDataFile(data);
    }

    this.setDataLink = function (id, table, field, page, operasi, table_foreign) {
    	this.id 		= id;
    	this.table 		= table;
    	this.field 		= field;
    	this.page 		= page;
    	this.operasi	= operasi;
    	this.table_foreign	= table_foreign;
    }


    function getAlert(type){
    	if (type == "success") {
    		alertTitle = "Success "+alertinfo;
    	}else if (type == "failed") {
    		alertTitle = "Failed "+alertinfo;
    	}else{
    		alertTitle = "Connection error";
    	}

		noty({
			text  : alertTitle, 
			layout: 'topRight', 
			type  : type
		}); 
    }

    this.getPage = function(page, size){
      	$('#myModal').fadeIn("slow").modal("show");
      	$('#modal-width').prop({class:"modal-dialog modal-"+size});
      	$('.modal-title').html(page);
		$(".modal-body").html("<center><i class='fa fa-circle-o-notch fa-spin fa-2x fa-fw'></i></center>");
		if (this.operasi == "update") { 
			document.getElementById("button_update").style.display 	= "";
		}else if (this.operasi == "create") { 
			document.getElementById("button_save").style.display 	= "";
		}else if (this.operasi == "delete") {
			document.getElementById("button_delete").style.display 	= "";
		}
		$.post(url, { id:this.id, table:this.table, field:this.field, page:this.page, operasi:this.operasi, table_foreign:this.table_foreign } ,
			function(data) {
				$(".modal-body").html(data);
		});
    }

    this.proses = function(method, type){ 
    	var setJson;
    	if (method != "GET") {
    		setJson = "json";
    	}else{
    		setJson = "";
    	}

		$.ajax({
			type    : method,
			url     : getUrl(),
			data    : getDataString(), // serializes the form's elements.
			dataType: setJson,	
            success : function(html)
				{				
					if(method != "GET"){
						if (html == true) { 
							getAlert("success");
							if (type != "condition") { NProgress.start(); }
							if (type != "condition" && type != "formSoal") {
								this.url = "index.php/Control_main/openPage/game";
								$.post(this.url, {} ,function(data) {
									setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
									$('#content_inti').html(data);
								});
							}else if(type == "formSoal"){
								this.url = "index.php/Control_game/openPage/detail";
								$.get(this.url, { id:id_game } ,function(data) {
									setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
									$('#content_inti').html(data);
								});
							}
						}else{
							getAlert("failed");
						}
					}else{
						setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
						$('#content_inti').html(html);	
					}
				},
				error   : function(XMLHttpRequest, textStatus, errorThrown) {
					NProgress.start();
					this.url = "index.php/Control_main/error_page/error_505";
						$.post(this.url, {} ,function(data) {
							setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
							$('#content_inti').html(data);
						});
				} 
		});
		this.stop();
    }
    
    this.upload = function(method){ 
    	var fileToUpload = getDataFile()[0].files[0];
    	if (fileToUpload != "undefined") { 
    		var formData = new FormData();
    		formData.append("file", fileToUpload);

			$.ajax({
				type    : method,
				url     : getUrl(),
				data    : formData, // serializes the form's elements.
				dataType: 'json',
				processData: false,
				contentType: false,
					success : function(html)
					{			
						if (html.status == true) {
							setUrl("index.php/Control_file/insert/");
							$.ajax({
								type    : method,
								url     : getUrl(),
								data    : getDataString()+"&file="+html.name_file, // serializes the form's elements.
								dataType: 'json',
								success : function(html)
								{		
									NProgress.start();
									this.url = "index.php/Control_game/openPage/detail";
									$.get(this.url, { id:id_game } ,function(data) {
										setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
										$('#content_inti').html(data);
									});
								},
								error   : function(XMLHttpRequest, textStatus, errorThrown) {
									NProgress.start();
									this.url = "index.php/Control_main/error_page/error_505";
									$.post(this.url, {} ,function(data) {
										setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
										$('#content_inti').html(data);
									});
								} 
							});
						}else{
							noty({
								text  : html.error, 
								layout: "topRight", 
								type  : "warning"
							}); 
						}
					},
					xhr 	: function(){
						var progressBar = $("#progressbar");
						var xhr = new XMLHttpRequest();
						xhr.upload.addEventListener("progress", function(event){
							if (event.lengthComputable) {
								var percentComplete = Math.round((event.loaded / event.total)*100);
								//console.log(percenComplete);
								$(".progress").show();
								progressBar.css({width: percentComplete + "%"});
								progressBar.text(percentComplete + "%");
							}
						}, false);
						return xhr;
					},
					error   : function(XMLHttpRequest, textStatus, errorThrown) {						
						NProgress.start();
						this.url = "index.php/Control_main/error_page/error_505";
						$.post(this.url, {} ,function(data) {
							setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
							$('#content_inti').html(data);
						});
					} 
			});
		}
		this.stop();
    }
}

	$('#example, #dataFile').DataTable();

	var game = new Game();

	$('.ajax').click(function(e){
		NProgress.start();
		e.preventDefault();
	    game.setDataUrl($(this).attr('href'));
		game.setDataString("id="+$(this).attr('id')); 
		game.proses("GET", "link");
	});	