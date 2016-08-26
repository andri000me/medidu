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
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/joli/js/plugins/blueimp-master/css/blueimp-gallery.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/joli/js/plugins/blueimp-master/css/blueimp-gallery-indicator.css">
<input type="hidden" value="<?php echo $id_user; ?>" name="id_user" id="id_user">

<!-- START CONTENT FRAME -->
<div class="content-frame">                       
    <!-- START CONTENT FRAME TOP -->
    <div class="content-frame-top">                        
        <div class="page-title">                    
            <h2><span class="fa fa-image"></span> <?php echo $xml->button->my_gallery; ?></h2>
        </div>                              
    </div>
                    
    <!-- START CONTENT FRAME RIGHT -->
    <?php if (!empty($this->session->userdata("id")) && $this->session->userdata("id")==$id_user): ?>                       
    <div class="content-frame-right">    
        <form action="javascript:;" enctype="multipart/form-data" class="form-horizontal">                                        
            <div class="form-group">
                <div class="col-md-12">
                    <input type="file" multiple name="myPhoto" id="file-simple" />
                </div>
            </div>             
        <button class="btn btn-primary btn-block" id="btn_upload"><span class="fa fa-upload"></span> Upload</button>
        </form>        
    </div>
    <?php endif; ?>         
    <div class="content-frame-body content-frame-body-left">
        <div class="gallery" id="links">  
        <?php 
        if (!empty($query_gambar)):
            foreach ($query_gambar->result_array() as $data):
                if (($data['type'] == "image/jpeg") || ($data['type'] == "image/jpg")):
                    $ini_filename = base_url()."file/images/users/".$data['file'];
                    $im = imagecreatefromjpeg($ini_filename);

                    $ini_x_size = getimagesize($ini_filename)[0];
                    $ini_y_size = getimagesize($ini_filename)[1];
                    $crop_measure = min($ini_x_size, $ini_y_size);

                    $to_crop_array = array('x' => 0 , 'y' => 0, 'width' => $crop_measure, 'height'=> $crop_measure);
                    $thumb_im = imagecrop($im, $to_crop_array);

                    imagejpeg($thumb_im, "file/images/users/thumbs_".$data['file'], 100);
                else:
                    $ini_filename = base_url()."file/images/users/".$data['file'];
                    $im = imagecreatefrompng($ini_filename);

                    $ini_x_size = getimagesize($ini_filename)[0];
                    $ini_y_size = getimagesize($ini_filename)[1];
                    $crop_measure = min($ini_x_size, $ini_y_size);

                    $to_crop_array = array('x' => 0 , 'y' => 0, 'width' => $crop_measure, 'height'=> $crop_measure);
                    $thumb_im = imagecrop($im, $to_crop_array);

                    imagepng($thumb_im, "file/images/users/thumbs_".$data['file']);
                endif;
        ?>                           
            <a class="gallery-item" href="<?php echo base_url(); ?>file/images/users/<?php echo $data['file']; ?>" data-gallery>
                <div class="image">                              
                    <img src="<?php echo base_url(); ?>file/images/users/thumbs_<?php echo $data['file']; ?>" alt="<?php echo $data['file']; ?>" width="150" height="150"/>                                        
                    <?php 
                    if ($id_user == $this->session->userdata("id")):
                    ?>
                    <ul class="gallery-item-controls">
                        <li onclick="setPhotoProfil('<?php echo $data['file']; ?>');" data-toggle="tooltip" data-placement="bottom" title="Set photo profile"><span class="fa fa-user"></span></li>
                        <li onclick="setCover('<?php echo $data['file']; ?>');" data-toggle="tooltip" data-placement="bottom" title="Set cover profile"><span class="fa fa-picture-o"></span></li>
                        <li data-toggle="tooltip" data-placement="bottom" title="Set private image"><span class="fa fa-lock"></span></li>
                        <li><span class="gallery-item-remove"><i class="fa fa-times"></i></span></li>
                    </ul>                                                                    
                    <?php 
                    endif;
                    ?>
                </div>                               
            </a>
        <?php 
            endforeach;
        endif;
        ?>                         
            <div class="gallery" id="links">                  
                <a class="gallery-item" href="<?php echo base_url(); ?>file/images/users/default-p.png" data-gallery>
                    <div class="image">                              
                        <img src="<?php echo base_url(); ?>file/images/users/default-p.png" width="150" height="150"/> 
                        <?php 
                        if ($id_user == $this->session->userdata("id")):
                        ?>                                       
                        <ul class="gallery-item-controls">
                            <li onclick="setPhotoProfil('default-p.png');" data-toggle="tooltip" data-placement="bottom" title="Set photo profile"><span class="fa fa-user"></span></li>
                            <li><span class="gallery-item-remove"><i class="fa fa-times"></i></span></li>
                        </ul>                                                                   
                        <?php 
                        endif;
                        ?>                                                                  
                    </div>                               
                </a>               
                <a class="gallery-item" href="<?php echo base_url(); ?>file/images/users/default-s.jpg" data-gallery>
                    <div class="image">                              
                        <img src="<?php echo base_url(); ?>file/images/users/default-s.jpg" width="150" height="150"/>  
                        <?php 
                        if ($id_user == $this->session->userdata("id")):
                        ?>                                          
                        <ul class="gallery-item-controls">
                            <li onclick="setCover('default-s.jpg');" data-toggle="tooltip" data-placement="bottom" title="Set cover profile"><span class="fa fa-picture-o"></span></li>
                            <li><span class="gallery-item-remove"><i class="fa fa-times"></i></span></li>
                        </ul>                                                                 
                        <?php 
                        endif;
                        ?>                                                                      
                    </div>                               
                </a>
            </div>   
        </div>
    </div> 
</div>

<div id="blueimp-gallery" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
<script src="<?php echo base_url(); ?>assets/template/joli/js/plugins/blueimp-master/js/blueimp-helper.js"></script>
<script src="<?php echo base_url(); ?>assets/template/joli/js/plugins/blueimp-master/js/blueimp-gallery.js"></script>
<script src="<?php echo base_url(); ?>assets/template/joli/js/plugins/blueimp-master/js/blueimp-gallery-fullscreen.js"></script>
<script src="<?php echo base_url(); ?>assets/template/joli/js/plugins/blueimp-master/js/blueimp-gallery-indicator.js"></script>
<script src="<?php echo base_url(); ?>assets/template/joli/js/plugins/blueimp-master/js/jquery.blueimp-gallery.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/fileinput/fileinput.min.js"></script>

<?php $this->load->view('template/plugin/dataTables'); ?>
<?php $this->load->view('template/plugin/noty'); ?>
<?php $this->load->view('template/plugin/AutoPlugin'); ?> 
<script type="text/javascript" src='<?php echo base_url(); ?>assets/js/user.js'></script>   
<script type="text/javascript">    
    $("#file-simple").fileinput({
        showUpload: false,
        showCaption: false,
        browseClass: "btn btn-danger",
        fileType: "any"
    });   

    function setCover(value){
        var user = new User();
        user.setDataUrl("<?php echo base_url(); ?>Control_user/updateSetting");
        user.setDataString("table=tbl_pengaturan&key=id&field=poto_sampul&value="+value+"&id="+$("#id_user").val());
        user.setID($("#id_user").val());
        user.proses("POST", "phase");
    };

    function setPhotoProfil(value){
        var user = new User();
        user.setDataUrl("<?php echo base_url(); ?>Control_user/updateSetting");
        user.setDataString("table=tbl_pengaturan&key=id&field=poto_profil&value="+value+"&id="+$("#id_user").val());
        user.setID($("#id_user").val());
        user.proses("POST", "phase");
        
    };

    $("#set_photo_profil").click(function(){
        var user = new User();
        user.setDataUrl("<?php echo base_url(); ?>Control_user/insertFile/update");
        user.setDataString("table=tbl_file&id_foreign="+$("#id_user").val()+"&coloumn=id_user&kondisi=p&field=coloumn");
        user.proses("POST", "condition");
        user.setDataAlert(" please reload your page");
    });  

    $("#btn_upload").click(function(){
        var user = new User();
        var file = $("input[name=myPhoto]");
        user.setDataUrl("<?php echo base_url(); ?>Control_user/uploadFile");
        user.setDataString("table=tbl_file&id_foreign="+$("#id_user").val()+"&coloumn=id_user&kondisi=0");
        user.setFile(file);
        user.setID($("#id_user").val());
        user.upload("POST");
    });    

    document.getElementById('links').onclick = function (event) {
        event = event || window.event;
        var target = event.target || event.srcElement;
        var link = target.src ? target.parentNode : target;
        var options = {index: link, event: event,onclosed: function(){
                setTimeout(function(){
                    $("body").css("overflow","");
                },200);                        
            }};
        var links = this.getElementsByTagName('a');
        blueimp.Gallery(links, options);
    };
</script>