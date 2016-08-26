    var jvalidate = $("#validate").validate({
    ignore: [],
      rules: {                                            
        txtUsername: {
          required: true,
        },
        txtPassword: {
          required: true,
        }
      }                                        
  });

  $('.ajax').click(function(e){
    NProgress.start();
    e.preventDefault();
    $.ajax({
      type     : "GET",
      url      : $(this).attr('href'),
      success  : function(html)
      {    
        setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
        $('#content_inti').html(html);  
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) { 
        var url = "index.php/Control_main/error_404";
        $.post(url, {} ,function(data) {
          setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
          $('#content_inti').html(data).show(); 
        });
      } 
    });
  }); 

  $("#button_login").click(function(){
    $("#validate").submit();
  });

  $("#btn_forget").click(function(){
    var url = "<?php echo site_url('Control_main/page'); ?>";
    $('#modal-width').prop({class:"modal-dialog modal-md"});
    $('.modal-title').html("<?php echo strtoupper(substr($xml->label->reset, 0, 1))."".substr($xml->label->reset, 1).' '.$xml->password; ?> ");
    $(".modal-body").html("<center><i class='fa fa-circle-o-notch fa-spin fa-2x fa-fw'></i></center>");
    hideAll();

    $.post(url, { folder:"login", page:"reset_password" } ,function(data) {
      document.getElementById("button_reset").style.display = "";
      $(".modal-body").html(data);
    });
  });

  $("#showPassword").click(function(){
    if($('#showPassword').is(":checked")){
      $('#txtPassword').prop({type:"text"});
    }else{    
      $('#txtPassword').prop({type:"password"});
    }
  });

  $("#validate").submit(function(e) {
    var url         = "<?php echo site_url('Control_authentifikasi/cekAccount'); ?>";
    var dataString  = "table=tbl_user&key=email&value="+$("#txtUsername").val();  
    //alert(dataString);
    $.ajax({
      type    : "POST",
      url     : url,
      data    : dataString, // serializes the form's elements.
      dataType: 'json',
      success : function(html)
      {
        if (html == true) {
          url         = "<?php echo site_url('Control_authentifikasi/checkLogin'); ?>";
          dataString  = $("#validate").serialize()+"&table=tbl_user&field=email";
          $.ajax({
            type     : "POST",
            url      : url,
            dataType : 'json',
            data     : dataString,
            success  : function(html)
            {
              if (html == true) {   
                location.reload();         
              }else{
                noty({
                  text  : '<?php echo $xml->alert->error_login;  ?>', 
                  layout: 'topRight', 
                  type  : 'warning'
                }); 
              }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
              noty({
                text  : '<?php echo $xml->alert->error_connection;  ?>', 
                layout: 'topRight', 
                type  : 'danger'
              }); 
            } 
          });
        }else{
          url         = "<?php echo site_url('Control_authentifikasi/checkLogin'); ?>";
          dataString  = $("#validate").serialize()+"&table=tbl_user&field=username";
          $.ajax({
            type     : "POST",
            url      : url,
            dataType : 'json',
            data     : dataString,
            success  : function(html)
            {
              if (html == true) {   
                location.reload();         
              }else{
                noty({
                  text  : '<?php echo $xml->alert->error_login;  ?>', 
                  layout: 'topRight', 
                  type  : 'warning'
                }); 
              }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
              noty({
                text  : '<?php echo $xml->alert->error_connection;  ?>', 
                layout: 'topRight', 
                type  : 'danger'
              }); 
            } 
          });
        }
      },
      error   : function(XMLHttpRequest, textStatus, errorThrown) {
        noty({
          text  : '<?php echo $xml->alert->error_connection;  ?>', 
          layout: 'topRight', 
          type  : 'danger'
        }); 
      } 
    });
    e.preventDefault(); // avoid to execute the actual submit of the form.
    this.stop();
  });