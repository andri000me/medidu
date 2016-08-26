function Akses(){
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
		$.ajax({
			type    : method,
			url     : getUrl(),
			data    : getDataString(), // serializes the form's elements.
			dataType: 'json',
				success : function(html)
				{					
					if (html == true) { 
						getAlert("success");

						this.url = "index.php/Control_main/openPage/akses";
						$.post(this.url, {} ,function(data) {
							$('#content_inti').html(data);
						});
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
	var akses = new Akses();

	$('#example').DataTable();
    var table 	= $('#example').DataTable();

    $('#example tbody').on('click','tr', function () {
        $(this).toggleClass('selected');
        if (table.rows('.selected').data().length == 0) {
        	$('#deleteRow').attr('disabled',true);
        	akses.setIndex(0);
        }else{
        	$('#deleteRow').attr('disabled',false);  
        	akses.setRowData(akses.getIndex(), $(this).closest('tr').attr('id'));
        	akses.setIndex(akses.getIndex()+1);
        }
    });

     $('#deleteRow').click(function(){
	    hideAll();
		akses.setMaxLoad(100/table.rows('.selected').data().length);
	    akses.getPage("Loading", "md");
	    akses.setDataUrl("index.php/Control_akses/delete/");
	    akses.setDataAlert("deleted");
    	for (var i = 0; i < akses.getIndex(); i++) {
	    	akses.setDataString("id="+akses.getRowData(i)+"&table=tbl_akses&key=id");
	    	akses.proses("POST", "deleteRow");
    	}
    });
	
	$('.ajax').click(function(e){
		e.preventDefault();
		akses.setDataUrl($(this).attr('href'));
		akses.proses("GET", "NO");
	});	
 
	function openDetailakses(id)
	{
	    hideAll();
	    akses.setDataUrl("index.php/Control_main/openDetail/");
	    akses.setDataLink(id, "tbl_akses", "id", "akses", "", "");
	    akses.getPage("Detail", "md");
	}

	function openFormakses(operasi, id)
	{	
		hideAll();
		akses.setDataUrl("index.php/Control_main/openFormulir/");
		akses.setDataLink(id, "tbl_akses", "id", "akses", operasi, "");
		akses.getPage("Form", "md");
	}

	var jvalidate = $("#validate").validate({
		ignore: [],
		rules: {                                            
			akses: {
				required: true
			},
			keterangan: {
				required: true
			}
		}                                    
	}); 

	$("#validate").submit(function(e) {
		if ($('#validate').valid()){
			e.preventDefault();

			if($("#operasi").val() == "create"){
				akses.setDataUrl("index.php/Control_akses/insert");      
				akses.setDataString($("#validate").serialize()+"&table=tbl_akses");    
				akses.setDataAlert(" saved data");    
			}else if($("#operasi").val() == "update"){      
				akses.setDataUrl("index.php/Control_akses/update");      
				akses.setDataString($("#validate").serialize()+"&table=tbl_akses&key=id");
				akses.setDataAlert(" update data");    
			}else if($("#operasi").val() == "delete"){
				akses.setDataUrl("index.php/Control_akses/delete");      
				akses.setDataString($("#validate").serialize()+"&table=tbl_akses&key=id");    
				akses.setDataAlert(" deleted data");    
			}
			akses.proses("POST", "NO_delete");   
		}
	});    