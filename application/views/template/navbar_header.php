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

<script type="text/javascript">
    function loadPageUser(page){ 
        var id_user = <?php echo $this->session->userdata("id"); ?>;
        $('#content_inti').hide();  
        $.ajax({
            type     : "POST",
            url      : "<?php echo site_url('Control_user/getDetailData/"+page+"'); ?>",
            data     : "id_user="+id_user,
            success  : function(html)
            {    
                $('#content_inti').html(html).fadeIn("slow");  
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                var url = "<?php echo site_url('Control_main/error_page/error_505'); ?>";
                $.post(url, {} ,function(data) {
                    $('#content_inti').html(data);   
                });
            } 
        });
    };

</script>

<ul class="x-navigation x-navigation-horizontal x-navigation-panel">
    <!-- TOGGLE NAVIGATION -->
    <li class="xn-icon-button">
        <a href="javascript:;" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
    </li>
    <?php 
    if (empty($this->session->userdata("id"))):
    ?>
        <li class="xn-icon-button pull-right">
            <a href="javascript:;" id="btnLogin" class="mb-control" data-toggle="tooltip" data-placement="bottom" title="<?php echo $xml->button->login; ?>">
            <span class="fa fa-lock"></span>
            </a>                        
        </li> 
        <li class="xn-icon-button pull-right">
            <a href="<?php echo site_url('Control_main/openPage/registrasi'); ?>" class="mb-control ajax" data-toggle="tooltip" data-placement="bottom" title="<?php echo $xml->registrasi; ?>"><span class="fa fa-file"></span></a>                        
        </li> 
    <?php 
    else: ?> 
        <li class="xn-icon-button pull-right">
            <a href="#"><span class="fa fa-th-large"></span></a>
            <div class="panel panel-primary animated zoomIn xn-drop-left">
                <div class="panel-heading">
                    <h3 class="panel-title"><span class="fa fa-th-large"></span> 
                    <?php 
                        if (!empty($this->session->userdata("id"))) {
                            if ($this->session->userdata('language') == "id") {
                                echo "Menu ".$xml->label->shortcuts;
                            }else{                                
                                echo $xml->label->shortcuts." Menu";
                            }
                        }else{
                            echo "Menu ".$xml->label->shortcuts;
                        }
                    ?>
                    </h3>
                </div>

                <div class="panel-body list-group scroll" style="height:auto">
                    <a href="<?php echo site_url("Control_user/detail/".$this->session->userdata('id')); ?>" class="list-group-item ajax">
                        <span class="fa fa-user"></span> <?php echo $xml->button->my_profil; ?>
                    </a>     
                    <a href="javascript:;" class="list-group-item" onclick="loadPageUser('pengaturan');">
                        <span class="fa fa-wrench"></span> <?php echo $xml->button->setting; ?>
                    </a>     
                    <a href="javascript:;" id="btnLogout" class="list-group-item">
                        <span class="fa fa-sign-out"></span> <?php echo $xml->button->logout; ?>
                    </a>     
                </div>                               
            </div>
        </li>

                    <li class="xn-icon-button pull-right" style="z-index: 1051;">
                        <a href="#"><span class="fa fa-comments"></span></a>
                        <div class="informer informer-danger" id="countMessage">0</div>
                        <div class="panel panel-primary animated zoomIn xn-drop-left" >
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-comments"></span> Messages</h3>                                
                                <div class="pull-right">
                                    <span class="label label-danger"><span id="countMessageAlert">4</span> new</span>
                                </div>
                            </div>
                            <div id="content_list_message"></div>    
                            <div class="panel-footer text-center">
                                <a href="pages-messages.html">Show all messages</a>
                            </div>                            
                        </div>                        
                    </li>
    <?php 
    endif;
    ?>
    <!-- END TOGGLE NAVIGATION -->                    
</ul>