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

  if (!empty($query_h_message)){
    foreach ($query_h_message->result_array() as $data){
      if ($data['pengirim'] == $this->session->userdata("id")) {
        $id_user = $data['penerima'];
      }else{
        $id_user = $data['pengirim']; 
      }
    }
  }else{
    $id_user  = "";
  }

  if (!empty($query_user)){
    foreach ($query_user->result_array() as $data){
      if ($id_user == $data['id']) {
        $nama_user = $data['nama_depan'];
      }
    }
  }else{
    $nama_user = ""; 
  }

  if (!empty($query_pengaturan)){
    foreach ($query_pengaturan->result_array() as $data){
      if ($id_user == $data['id']) {
        $pic_user  = $data['poto_profil'];
      }
    }
  }else{
    $pic_user  = "";
  }
?>

<style type="text/css">
    .content_timeline{
        height: 100%;
        min-height: 100%;
    }
    .summernote{
        height: 150px;
        min-height: 150px;
    }
</style>

<script type="text/javascript">    
    $('#content_timeline').css({ height: $(window).innerHeight() });
      
    $(window).resize(function(){
        $('#content_timeline').css({ height: $(window).innerHeight() });
    });
</script>

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
    <!-- <div class="col-md-12">
        <div class="messages messages-img"> -->

      <!-- Direct Chat -->
          <div class="col-md-12">
              <!-- START TIMELINE -->
              <div id="content_timeline">
              <div class="timeline">
          <?php 
            if (!empty($query_d_message)):
              foreach ($query_d_message->result_array() as $data):
                if ($data['pengirim'] == $this->session->userdata("id")) {
                  $nama_pengirim = $this->session->userdata("nama_depan");
                  $pic_pengirim  = $this->session->userdata("photo");
                }else{
                  $nama_pengirim = $nama_user;
                  $pic_pengirim  = $pic_user;
                }
          ?>
          <?php 
            if (!empty($pic_pengirim)) {
              if ($pic_pengirim != "default-p.png") {
                $photo = "thumbs_".$pic_pengirim;
              }else{
                $photo = $pic_pengirim;
              }
            }else{
              $photo = "default-p.png";
            }
          ?>
                <!-- START TIMELINE ITEM -->
                <div class="timeline-item <?php echo $data['pengirim']==$this->session->userdata("id")?'':'timeline-item-right'; ?>">
                  <div class="timeline-item-info"><?php echo $data['tanggal']; ?></div>
                  <div class="timeline-item-icon"><span class="fa fa-envelope"></span></div>
                  <div class="timeline-item-content">
                    <div class="timeline-heading">
                      <img src="<?php echo base_url(); ?>file/images/users/<?php echo $photo; ?>"/> <a href="#"><?php echo $nama_pengirim; ?></a>
                    </div>
                    <div class="timeline-body">
                      <?php echo $data['pesan']; ?>                                 
                    </div>      
                  </div>
                </div>       
                <!-- END TIMELINE ITEM -->                    
          <?php
              endforeach;
            endif;
          ?>

          <!-- START TIMELINE ITEM -->
          <div class="timeline-item timeline-main">
            <a href="javascript:;" onclick="openFormMessage('create', '<?php echo $id_user; ?>')"><div class="timeline-date"><span class="fa fa-envelope"></span></div></a>
          </div>
        </div>

    
        </div>
        </div>
      </div>

<!-- SlimScroll -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/slimScroll/jquery.slimscroll.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/summernote/summernote.js"></script>
<?php $this->load->view("template/plugin/validationEngine"); ?>
<?php $this->load->view('template/plugin/AutoPlugin'); ?> 
<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/message.js'></script>
<script type="text/javascript">    
    $('#content_timeline').slimScroll({
        color: '#7A7A7A',
        size: '5px',
        height: '500px',
        alwaysVisible: true
    });
    
    function openFormMessage(operasi, id)
    { 
        hideAll();
        message.setDataUrl("Control_message/openFormulir/");
        message.setDataLink(id, "tbl_head_message", "id", "message", operasi, "");
        message.getPage("Form", "md");
    }
</script>