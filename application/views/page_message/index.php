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
<style type="text/css">
  .content-frame-right, .content-frame-left, .content-frame-body{
    height: 100%;
    min-height: 100%;
  }

  #list_recent{
    height: 100%;
    min-height: 100%;
  }
</style>
  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>"> <?php echo $xml->label->home; ?></a></li>                    
    <li class="active"><?php echo $xml->page; ?> <?php echo $xml->button->message; ?></li>
  </ul>
  <!-- END BREADCRUMB -->                
                 
  <!-- PAGE CONTENT WRAPPER -->
  <div class="content-frame">                                    
    <!-- START CONTENT FRAME TOP -->
    <div class="content-frame-top">                        
        <div class="page-title">                    
          <h2><span class="fa fa-envelope"></span> <?php echo $xml->page; ?> <?php echo $xml->button->message; ?></h2>
        </div>                          
    </div>
    <div class="content-frame-left">
        <div class="block">
            <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><span class="fa fa-search"></span></span>
                  <input type="text" class="form-control">                                            
                </div>
            </div>
            <div class="form-group">
              <h4><?php echo $xml->user." ".$xml->label->online; ?></h4>
            </div>  

            <div id="list_online">
              <i class='fa fa-circle-o-notch fa-spin fa-fw'></i></center>
            </div>
        </div>
    </div>
    <!-- END CONTENT FRAME LEFT -->
                    
    <!-- START CONTENT FRAME BODY -->
    <div class="content-frame-body"> 
        <div id="loadPage" align="center" style="display:none;"><span class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></span></div>
        <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><span class="fa fa-search"></span></span>
              <input type="text" class="form-control">                                            
            </div>
        </div>
        <div class="form-group">
          <h4><?php echo $xml->label->recent." ".$xml->button->message; ?></h4>
        </div>  
        <div id="list_recent"></div>
        <!-- <div id="content_message">
          <div class="tasks" id="tasks_completed">
            <div class="task-drop" disabled>
              <span class="fa fa-envelope"></span>
              Start your message
            </div>                                    
          </div>
        </div> -->
        <!-- END TIMELINE -->        
    </div>
    <!-- END CONTENT FRAME BODY -->
</div>

<!-- SlimScroll -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/slimScroll/jquery.slimscroll.js"></script>
<?php $this->load->view('template/plugin/iCheck'); ?>
<?php $this->load->view('template/plugin/noty'); ?>
<?php $this->load->view('template/plugin/AutoPlugin'); ?>

<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/message.js'></script>
<script type="text/javascript"> 
  $('#list_recent').slimScroll({
    color: '#7A7A7A',
    size: '10px',
    height: 'auto',
    alwaysVisible: true
  });

  $('.content-frame-right, .content-frame-left, #list_recent, .content-frame-body').css({ height: $(window).innerHeight() });

  $(window).resize(function(){
    $('.content-frame-right, .content-frame-left, #list_recent, .content-frame-body').css({ height: $(window).innerHeight() });
  });

  loadRecent();

    function loadRecent(){      
        var id_user = <?php echo $this->session->userdata("id"); ?>;

        var url = "<?php echo site_url('Control_message/data_recent/'); ?>";
        $.post(url, { id:id_user, table:"tbl_head_message" },function(result){
          if (result) {
            $('#list_recent').html(result);  
          }
        });
    }
</script>