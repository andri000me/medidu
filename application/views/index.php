<!DOCTYPE html>
<html lang="en">
  <head>
    <?php echo $_include_meta; ?>

    <title>Medidu | Media Edukasi Online</title>

    <?php echo $_include_head; ?>
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
  </head>
  <script type="text/javascript">
    var c=0;
    var time;

      function loadList(){ 
          var id_user = <?php echo $this->session->userdata("id"); ?>;
          list_read_message(id_user);
          list_data_online();
          c=c+1;
          t=setTimeout("loadList()",10000);
      };

      function list_data_online(){        
          var url = "<?php echo base_url(); ?>Control_message/data_online/";
          $.post(url, { table:"tbl_user", key:"logged", value:"1" },
            function(result){
            if (result) {
              $('#list_online').html(result);  
            }
          });
      }

      function list_read_message(id){        
          var url = "<?php echo base_url(); ?>Control_default/count_read_message/";
          $.post(url, { table:"tbl_head_message", key:"status", value:"0", id:id },
            function(result){
            if (result) {
              $('#countMessage').html(result);  
              $('#countMessageAlert').html(result); 
              $('#content_list_message').html("<br><i class='fa fa-spinner fa-spin  fa-fw'></i>"); 

              url = "<?php echo base_url(); ?>Control_default/read_message_come/";
              $.post(url, { table:"tbl_head_message", key:"status", value:"0", id:id },
                function(result){
                if (result) {
                  $('#content_list_message').html(result); 
                }
              });
            }
          });
      }
  </script>
  <body class="sidebar_main_open" onload="loadList();">
    <!-- / navigation Side Bar -->  
    <!-- START PAGE CONTAINER -->
    <div class="page-container">
            
      <!-- START PAGE SIDEBAR -->
      <?php echo $_navbar_side; ?>
      <!-- END PAGE SIDEBAR -->
            
      <!-- PAGE CONTENT -->
      <div class="page-content">
        <!-- START X-NAVIGATION VERTICAL -->
        <!-- top navigation -->
        <?php echo $_navbar_header; ?>
        <!-- /top navigation -->
        <!-- END X-NAVIGATION VERTICAL -->                     
                
            <div id="content_inti">
              <!-- START BREADCRUMB -->
              <?php echo $_content; ?>
              <!-- END PAGE CONTENT WRAPPER -->                
            </div> 
      <!-- END PAGE CONTENT -->
      </div>
    </div>
    <!-- END PAGE CONTAINER -->

        <!-- MODALS -->        
        <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
            <div class="modal-dialog" id="modal-width">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="defModalHead">Basic Modal</h4>
                    </div>
                    <div class="modal-body">
                        Some content in modal example
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $xml->button->close; ?></button>
                        <button type="submit" id="button_save" class="btn btn-primary" style="display:none;"><?php echo $xml->button->save; ?></button>
                        <button type="submit" id="button_reset" class="btn btn-primary" style="display:none;"><?php echo $xml->button->reset; ?></button>
                        <button type="submit" id="button_login" class="btn btn-primary" style="display:none;"><?php echo $xml->button->login; ?></button>
                        <button type="submit" id="button_update" class="btn btn-success" style="display:none;"><?php echo $xml->button->update; ?></button>
                        <button type="submit" id="button_delete" class="btn btn-danger" style="display:none;"><?php echo $xml->button->delete; ?></button>
                    </div>
                </div>
            </div>
        </div>

    <?php //echo $_navbar_footer; ?>
    <!-- footer content -->
    <!-- /footer content -->
    <script type="text/javascript">    
      function hideAll(){
          document.getElementById("button_save").style.display    = "none";
          document.getElementById("button_reset").style.display   = "none";
          document.getElementById("button_login").style.display   = "none";
          document.getElementById("button_update").style.display  = "none";
          document.getElementById("button_delete").style.display  = "none";
      }
    </script>
    <?php $this->load->view('template/plugin/nprogress'); ?>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/bootstrap_2/bootstrap-datepicker.js"></script>    <?php $this->load->view('template/plugin/StartPlugin'); ?>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/slimScroll/jquery.slimscroll.js"></script>
    <?php $this->load->view('template/plugin/StartTemplate'); ?>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/aplikasi.js"></script>
  </body>
</html>