function Game_list(){
    var url;
    var dataString;
    var alertinfo;
    var alertTitle;

    var id;
    var table;
    var field;
    var page;
    var operasi;
    var table_foreign;

 	var rowData = [];
 	var index	= 0;
 	var maxLoad	= 0;

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

	function getUrl(){
        return url; 
    }

	function getDataString() {
        return dataString; 
    }

	function getAlertInfo() {
        return alertinfo; 
    }

    //Privileged function
    this.setDataUrl = function (data) {
    	setUrl(data);
    }

    this.setDataString = function (data) {
    	setData(data);
    }

    this.setDataAlert 	= function (data) {
    	setAlertInfo(data);
    }

    this.setRowData 	= function (index, data) {
    	rowData[index] 	= data;
    }

    this.getRowData 	= function (index) {
    	return rowData[index];
    }

    this.setIndex 		= function (data) {
    	index 			= data;
    }

    this.setMaxLoad		= function (data) {
    	maxLoad			= data;
    }

    this.getIndex 		= function () {
    	return index;
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

		if (page == "Loading") {
			var totalLoad 	= 0;
			$(".modal-body").html(""+
			"<div class='progress'>"+
			"<div class='progress-bar' id='loadBar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: 0%;'>"+
			"<span id='loadStatus'>0%</span>"+
			"</div></div>");
	    	for (var i = 0; i < index; i++) {
				setTimeout(function() {
					$('#loadBar').css("width", totalLoad+"%"); 
					$('#loadStatus').html(totalLoad+"%");
				}, 1000+i*1500);
				totalLoad = totalLoad+maxLoad;
			}
		}else{
			$.post(url, { id:this.id, table:this.table, field:this.field, page:this.page, operasi:this.operasi, table_foreign:this.table_foreign } ,
				function(data) {
					$(".modal-body").html(data);
			});
		}
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
}
var game_list = new Game_list();

	$('.ajax').click(function(e){
		NProgress.start();
		e.preventDefault();
	    game_list.setDataUrl($(this).attr('href'));
		game_list.setDataString("id="+$(this).attr('id')); 
		game_list.proses("GET", "link");
	});	