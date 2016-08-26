<?php 
  if (!empty($this->session->userdata("id"))) {
    if ($this->session->userdata('language') == "id") {
      $language = "indonesia";
    }else{
      $language = "english";
    }    
    $xml = simplexml_load_file("file/language/".$language.".xml") or die("Error: Cannot create object"); 
  }else{   
    $xml = simplexml_load_file("file/language/indonesia.xml") or die("Error: Cannot create object");
  }
?>
  <form id="validate" role="form" class="form-horizontal" action="javascript:$('#validate').submit();"> 
    <div class="panel-body">
      <div class="form-group">
        <div class="col-md-12">         
            <input type="text" class="form-control" name="username" id="txtUsername" 
            placeholder="<?php echo $xml->username; ?> <?php echo $xml->label->or; ?> Email"/>
          </div>           
      </div>        

      <div class="form-group">
        <div class="col-md-12">            
            <input type="password" class="form-control" name="password" id="txtPassword" 
            placeholder="<?php echo strtoupper(substr($xml->password, 0, 1)).''.substr($xml->password, 1); ?>"/>
          </div>          
      </div>

      <div class="form-group">
        <label class="col-md-9 pull-left control-label"><?php echo $xml->show; ?> <?php echo $xml->password; ?></label>
        <div class="col-md-3 pull-right">
          <label class="switch switch-small">
            <input type="checkbox" id="showPassword" />
            <span></span>
          </label>  
        </div>
      </div>
      <hr>
      <a href="javascript::;" id="btn_forget">
        <?php 
        if ($this->session->userdata('language') == "id") {
          if ($language == "indonesia") {
            echo strtoupper(substr($xml->label->forget, 0, 1))."".substr($xml->label->forget, 1)." ".$xml->password." ?";
          }else{
            echo strtoupper(substr($xml->label->forget, 0, 1))."".substr($xml->label->forget, 1)." the ".$xml->password." ?";
          }
        }else{
          echo strtoupper(substr($xml->label->forget, 0, 1))."".substr($xml->label->forget, 1)." ".$xml->password." ?";
        }
        ?>
      </a>
      <br>
      <a href="<?php echo site_url('Control_main/openPage/registrasi'); ?>" class="ajax" id="btn_forget">
        <?php 
        if ($this->session->userdata('language') == "id") {
          if ($language == "indonesia") {
            echo strtoupper(substr($xml->label->if, 0, 1))."".substr($xml->label->if, 1)." ".$xml->label->not_yet." ".$xml->registered." ?";
          }else{
            echo strtoupper(substr($xml->label->if, 0, 1))."".substr($xml->label->if, 1)." ".$xml->label->not_yet." ".$xml->registered." ?";
          }
        }else{
          echo strtoupper(substr($xml->label->if, 0, 1))."".substr($xml->label->if, 1)." ".$xml->label->not_yet." ".$xml->registered." ?";
        }
        ?>
      </a>
    </div>
  </form>
              
<script type='text/javascript' src='<?php echo base_url(); ?>assets/template/joli/js/plugins/noty/jquery.noty.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/template/joli/js/plugins/noty/layouts/topCenter.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/template/joli/js/plugins/noty/layouts/topLeft.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/template/joli/js/plugins/noty/layouts/topRight.js'></script>            
<script type='text/javascript' src='<?php echo base_url(); ?>assets/template/joli/js/plugins/noty/themes/default.js'></script>
           
<script type="text/javascript" src='<?php echo base_url(); ?>assets/template/joli/js/plugins/jquery-validation/jquery.validate.js'></script>   
<script type="text/javascript">
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
</script>
<script type="text/javascript">  
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
</script>
