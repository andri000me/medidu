<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>Medidu - Media Edukasi Online</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url(); ?>assets/template/joli/css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->                                    
    </head>
    <?php 
      if (!empty($query)) {
        foreach ($query->result_array() as $data) {
          $id           = $data['id'];
          $nama_depan   = $data['nama_depan'];
          $nama_belakang= $data['nama_belakang'];
          $username     = $data['username'];
        }
      }else{
          $id           = "";
          $nama_depan   = "";
          $nama_belakang= "";
          $username     = "";
      }

      if (!empty($query_pengaturan)) {
        if ($query_pengaturan->num_rows()>0) {
          foreach ($query_pengaturan->result_array() as $data) {
            if (!empty($data['poto_profil'])) {
              $foto = "thumbs_".$data['poto_profil'];
            }else{
              $foto = "default-p.png";            
            }
          }
        }else{
          $foto = "default-p.png";            
        }
      }else{
        $foto = "default-p.png";
      }
    ?>
    <body>        
        <div class="login-container">        
            <div class="login-box animated fadeInDown">
                <div class="panel-body profile">
                    <div class="profile-image">
                        <img src="<?php echo base_url(); ?>file/images/users/<?php echo $foto; ?>" alt="<?php echo $nama_depan; ?>"/>
                    </div>
                    <div class="profile-data">
                        <div class="profile-data-name"><?php echo strtoupper(substr($nama_depan, 0, 1)).strtolower(substr($nama_depan, 1)); ?></div>
                        <div class="profile-data-title"><?php echo strtoupper(substr($nama_belakang, 0, 1)).strtolower(substr($nama_belakang, 1)); ?></div>
                    </div>
                </div>   
                <div class="login-body">
                    <form action="javascript:;" id="validate" class="form-horizontal" method="post">
                    <input type="hidden" id="id" nama"id" value="<?php echo $id; ?>"/>
                    <input type="hidden" id="username" name"username" value="<?php echo $username; ?>"/>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password"/>
                        </div>
                    </div>
                    <div class="form-group">
                          <div class="col-md-12 pull-left">
                              <a href="#" class="btn btn-link">Forgot your password?</a>
                          </div>
                          <div class="col-md-12 pull-left">
                              <a href="#" class="btn btn-link">Not have account?</a>
                          </div>
                          <div class="col-md-12 pull-left">
                              <a href="javascript::;" id="btn_different" class="btn btn-link">Login different account?</a>
                          </div>
                          <div class="divider"></div>
                        <div class="col-md-12">
                            <button class="btn btn-info btn-block" id="button_login">Log In</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; 2016 Medidu - Media Edukasi Online
                    </div>
                </div>
            </div>            
        </div>        
    </body>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/jquery-ui-1.12.0.custom/external/jquery/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/jquery-ui-1.12.0.custom/jquery-ui.js"></script>
    
    <script type="text/javascript"> 
        $("#btn_different").click(function(){
          var url = "index.php/Control_authentifikasi/differentAccount";
          $.ajax({
                  type     : "POST",
                  url      : url,
                  data     : "table=tbl_user&key=id&value="+$("#id").val(),
                  dataType : 'json',
                  success  : function(html)
                  {     
                    if (html == true) {
                      location.reload();
                    }else{

                    }
                  } 
                });
        });

      $("#button_login").click(function(){ 
        var url         = "index.php/Control_authentifikasi/checkLogin";
        var dataString  = $("#validate").serialize()+"&table=tbl_user&field=username&username="+$("#username").val();
          $.ajax({
            type     : "POST",
            url      : url,
            data     : dataString,
            dataType : 'json',
            success  : function(html)
            {     
              if (html == true) {
                location.reload();
              }else{

              }
            } 
          });
      });
    </script>
</html>






