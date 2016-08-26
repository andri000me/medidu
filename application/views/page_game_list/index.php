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
    #content_inti{
      height: 100%;
      min-height: 100%;
    }
  </style>
  <script type="text/javascript">    
    $('#content_inti').css({ height: $(window).innerHeight() });

    $(window).resize(function(){
      $('#content_inti').css({ height: $(window).innerHeight() });
  });
  </script>
  
  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>"> <?php echo $xml->label->home; ?></a></li>                    
    <li class="active"><?php echo $xml->page; ?> <?php echo $xml->field->game; ?></li>
  </ul>
  <!-- END BREADCRUMB -->                
                
  <div class="page-title">                    
    <h2><span class="fa fa-tags"></span> <?php echo $xml->page; ?> <?php echo $xml->field->game; ?></h2>
  </div>                   
                
  <!-- PAGE CONTENT WRAPPER -->
<?php 
    if (!empty($query)):
      if ($query->num_rows() > 0):
        $width = $query->num_rows();
          if ($width == 1 ) {
            $totalWidth = 12;
          }elseif ($width == 2) {
            $totalWidth = 6;
          }elseif ($width == 3 ) {
            $totalWidth = 4;
          }else{
            $totalWidth = 4;
          }
          foreach ($query->result_array() as $data):
            if ($data['enabled'] == 0):
    ?>
            <div class="col-md-<?php echo $totalWidth; ?>"> 
                <a href="<?php echo site_url('Control_game_list/openPage/view'); ?>" id="<?php echo $data['id']; ?>" class="tile tile-primary tile-valign ajax"><?php echo $data['game']; ?>
                  <div class="informer informer-default dir-bl"><span class="fa fa-eye"></span> Read more</div>
                </a>
            </div>
    <?php 
          endif;
          endforeach;
      endif; 
    endif; 
    ?>
    
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/knob/jquery.knob.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/owl/owl.carousel.min.js"></script>        
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/template/joli/js/plugins/icheck/icheck.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/game_list.js"></script> 