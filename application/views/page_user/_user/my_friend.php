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
  
<div class="content-frame">    
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap animated fadeInDown">
                    <div class="row">
                    <?php 
                    if (!empty($query)):
                        foreach ($query->result_array() as $data):
                            if (!empty($query_pengaturan) && $data['id']!=$this->session->userdata('id')):
                                foreach ($query_pengaturan->result_array() as $result):
                                    if ($data['id'] == $result['id']):

                                    if ((strtolower($result['poto_sampul']) != "") && (strtolower($result['poto_sampul']) != "default-s.jpg")) {
                                        $gambar_sampul = "thumbs_".$result['poto_sampul'];
                                    }else{
                                        $gambar_sampul  = "default-s.jpg";
                                    }

                                    if((strtolower($result['poto_profil']) != "") && (strtolower($result['poto_profil']) != "default-p.png")){
                                        $gambar_profil = "thumbs_".$result['poto_profil'];
                                    }else{
                                        $gambar_profil  = "default-p.png";
                                    }
                                    $display_email = $result['display_email'];
                                    $display_phone = $result['display_phone'];
                                    
                    ?>
                        <div class="col-md-3">
                            <!-- CONTACT ITEM -->
                            <div class="panel panel-default">
                                <div class="panel-body profile">
                                    <div class="profile-image">
                                        <img src="<?php echo base_url(); ?>file/images/users/<?php echo $gambar_profil; ?>" alt="<?php echo $data['nama_depan']; ?>"/>
                                    </div>
                                    <div class="profile-data">
                                        <div class="profile-data-name"><?php echo $data['nama_depan']; ?></div>
                                        <div class="profile-data-title"><?php echo $data['nama_belakang']; ?></div>
                                    </div>
                                    <div class="profile-controls">
                                        <a id="<?php echo $data['id']; ?>" href="<?php echo site_url("Control_user/detail/".$data['id']); ?>" class="profile-control-left ajax"><span class="fa fa-info"></span></a>
                                        <a href="#" class="profile-control-right"><span class="fa fa-phone"></span></a>
                                    </div>
                                </div>                                
                                <div class="panel-body">                                    
                                    <div class="contact-info">
                                        <?php if ($display_phone == 0): ?><p><small><?php echo $xml->phone; ?></small><br/><?php echo $data['telepon']; ?></p><?php endif; ?>
                                        <?php if ($display_email == 0): ?><p><small>Email</small><br/><?php echo $data['email']; ?></p><?php endif; ?>
                                        <p><small><?php echo $xml->address; ?></small><br/><?php echo $data['alamat']; ?></p>                                   
                                    </div>
                                </div>                                
                            </div>
                            <!-- END CONTACT ITEM -->
                        </div>
                    <?php 
                                    endif;
                                endforeach;
                            endif;
                        endforeach;
                    endif;
                    ?>
                    </div>
                </div>
</div>
<?php $this->load->view('template/plugin/iCheck'); ?>
<script type="text/javascript" src='<?php echo base_url(); ?>assets/js/user.js'></script>   