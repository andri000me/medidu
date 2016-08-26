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
<?php 
    if (!empty($query)) {
        foreach ($query->result_array() as $data) {
            $id             = $data['id'];
            $nama_depan     = $data['nama_depan'];
            $nama_belakang  = $data['nama_belakang'];
            $kelamin        = $data['kelamin'];
            $telepon        = $data['telepon'];
            $tgl_lahir      = $data['tgl_lahir'];
            $alamat         = $data['alamat'];
            $email          = $data['email'];
        }
    }else{
        $id             = "";
        $nama_depan     = "";
        $nama_belakang  = "";
        $kelamin        = "";
        $telepon        = "";
        $tgl_lahir      = "";
        $alamat         = "";
        $email          = "";
    }

    if (!empty($query_setting)) {
        if ($query_setting->num_rows() > 0) {
            foreach ($query_setting->result_array() as $data) {
                if ((strtolower($data['poto_sampul']) != "") && (strtolower($data['poto_sampul']) != "default-s.jpg")) {
                    $gambar_sampul = "thumbs_".$data['poto_sampul'];
                    break;
                }else{
                    $gambar_sampul  = "default-s.jpg";
                }
            }

            foreach ($query_setting->result_array() as $data) {
                if((strtolower($data['poto_profil']) != "") && (strtolower($data['poto_profil']) != "default-p.png")){
                    $gambar_profil = "thumbs_".$data['poto_profil'];
                    break;
                }else{
                    $gambar_profil  = "default-p.png";
                }
            }
        }
    }else{
        $gambar_profil  = "default-p.png";
        $gambar_sampul  = "default-s.jpg";
    }
?>

<style type="text/css">
    #content_profil{
        height: 100%;
        min-height: 100%;
    }
    .content-frame-body{
        height: 100%;
        min-height: 100%;
    }
</style>
<script type="text/javascript">    
    $('#content_profil, .content-frame-body').css({ height: $(window).innerHeight() });
      
    $(window).resize(function(){
        $('#content_profil, .content-frame-body').css({ height: $(window).innerHeight() });
    });
</script>
<input type="hidden" value="<?php echo $id; ?>" id="id_user" name="id_user">
<script type="text/javascript">
    loadPage('timeline');

    $('.content-frame-left').css({ height: $(window).innerHeight() });
    
    $(window).resize(function(){
        $('.content-frame-left').css({ height: $(window).innerHeight() });
    });

    function loadPage(page){ 
        var id_user = $("#id_user").val();
        document.getElementById("loadPage").style.display = "";
        $('#content_profil').hide();  
        $.ajax({
            type     : "POST",
            url      : "<?php echo site_url('Control_user/getDetailData/"+page+"'); ?>",
            data     : "id_user="+id_user,
            success  : function(html)
            {    
                document.getElementById("loadPage").style.display = "none";
                $('#content_profil').html(html).fadeIn("slow");  
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                document.getElementById("loadPage").style.display = "none";
                var url = "<?php echo site_url('Control_main/error_page/error_505'); ?>";
                $.post(url, {} ,function(data) {
                    $('#content_inti').html(data);   
                });
            } 
        });
    };
</script>
  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>"> <?php echo $xml->label->home; ?></a></li>                    
    <li class="active"><?php echo $xml->page; ?> profil</li>
  </ul>
  <!-- END BREADCRUMB -->                   

<div class="content-frame">                                    
    <!-- START CONTENT FRAME TOP -->
    <div class="content-frame-top">                        
        <div class="page-title">                    
            <h2><span class="fa fa-user"></span> <?php echo $xml->page; ?> Profil</h2>
        </div>                          
    </div>
    <!-- END CONTENT FRAME TOP -->
                    
    <!-- START CONTENT FRAME LEFT -->
    <div class="content-frame-left">
        <div class="block">
            <div class="list-group border-bottom">
                <div class="panel panel-default">
                    <?php if ($this->session->userdata("id") != $id): ?>
                        <div class="panel-body profile" style="background:url('<?php echo base_url(); ?>file/images/users/<?php echo $gambar_sampul; ?>') center center no-repeat;">
                            <div class="profile-image">
                                <img src="<?php echo base_url(); ?>file/images/users/<?php echo $gambar_profil; ?>" alt="<?php echo $nama_depan; ?>"/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name"><?php echo $nama_depan; ?></div>
                                <div class="profile-data-title" style="color: #FFF;"><?php echo $nama_belakang; ?></div>
                            </div>
                            <div class="profile-controls">
                                <a href="#" class="profile-control-left"><span class="fa fa-google-plus"></span></a>
                                <a href="#" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                            </div>                                    
                        </div>      
                    <?php endif; ?>
                        <div class="panel-body list-group border-bottom">
                            <a href="javascript:;" onClick="javascript:loadPage('timeline');" class="list-group-item"><span class="fa fa-bar-chart-o"></span> Activity</a>
                            <a href="javascript:;" onClick="javascript:loadPage('none');" class="list-group-item"><span class="fa fa-coffee"></span> Groups</a>                                
                            <a href="javascript:;" onClick="javascript:loadPage('detail_profil');" class="list-group-item"><span class="fa fa-user"></span> <?php echo $xml->button->my_profil; ?></a>                                
                            <a href="javascript:;" onClick="javascript:loadPage('my_friend');" class="list-group-item"><span class="fa fa-users"></span> <?php echo $xml->button->my_friend; ?></a>
                            <a href="javascript:;" onClick="javascript:loadPage('my_game');" class="list-group-item"><span class="fa fa-folder"></span> <?php echo $xml->button->my_game; ?></a>
                            <a href="javascript:;" onClick="javascript:loadPage('my_gallery');" class="list-group-item"><span class="fa fa-image"></span> <?php echo $xml->button->my_gallery; ?></a>
                            <?php if ($this->session->userdata("id") == $id): ?>
                                <a href="javascript:;" onClick="loadPage('pengaturan');" class="list-group-item"><span class="fa fa-cog"></span> <?php echo $xml->button->setting; ?></a>
                            <?php endif; ?>
                        </div>
                </div>  
            </div>                        
        </div>
    </div>
    <!-- END CONTENT FRAME LEFT -->
                    
    <!-- START CONTENT FRAME BODY -->
    <div class="content-frame-body" style="min-height:500px; height:500px;"> 
        <div id="loadPage" align="center" style="display:none;"><span class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></span></div>
        <div id="content_profil" style="min-height:500px; height:500px;"></div>
        <!-- END TIMELINE -->        
    </div>
    <!-- END CONTENT FRAME BODY -->
</div>

<!-- SlimScroll -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/slimScroll/jquery.slimscroll.js"></script>
<script type="text/javascript">    
    $('#content_profil').slimScroll({
        color: '#7A7A7A',
        size: '5px',
        height: 'auto',
        alwaysVisible: true
    });
</script>