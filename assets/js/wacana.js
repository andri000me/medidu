function Wacana(){
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
    	alertinfo  = data;
    }

    this.setRowData 	= function (index, data) {
    	rowData[index] 	= data;
    }

    this.getRowData 	= function (index) {
    	return rowData[index];
    }

	this.setID 	= function (data) {
		id 		= data;
	}

	this.setIndex 		= function (data) {
		index 			= data;
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
		$.post(url, { id:this.id, table:this.table, field:this.field, page:this.page, operasi:this.operasi, table_foreign:this.table_foreign } ,
			function(data) {
				$(".modal-body").html(data);
		});
    }

    this.proses = function(method, type){   
		$.ajax({
			type    : method,
			url     : getUrl(),
			data    : getDataString(), // serializes the form's elements.
			dataType: 'json',
				success : function(html)
				{					
					if (html == true) { 
						getAlert("success");

						if (type == "link") {
							this.url = "index.php/Control_user/detail/"+id;
							$.post(this.url, {} ,function(data) {
								$('#content_inti').html(data);
							});
						}
					}else{
						getAlert("failed");
					}
				},
				error   : function(XMLHttpRequest, textStatus, errorThrown) {
					if (method == "GET") {
						this.url = "index.php/Control_main/error_505";
						$.post(this.url, {} ,function(data) {
							$('#content_inti').html(data);
						});
					}else{
						getAlert("danger");
					}
				} 
		});
		if (type != "deleteRow") { this.stop(); }
    }
}
var wacana = new Wacana();