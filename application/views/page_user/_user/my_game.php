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

<?php 
        if (!empty($query_game)):
            if ($query_game->num_rows() > 0):
            $width = $query_game->num_rows();
            if ($width == 1 ) {
                $totalWidth = 12;
            }elseif ($width == 2) {
                $totalWidth = 6;
            }elseif ($width == 3 ) {
                $totalWidth = 4;
            }else{
                $totalWidth = 4;
            }
            foreach ($query_game->result_array() as $data):
                $totalskor  = $data['totalskor']/$data['countskor'];
                $persentasi = $totalskor/100*100;
    ?>
        <div class="col-md-<?php echo $totalWidth; ?> animated fadeInDown">
            <a href="javascript:;" onClick="javascript:loadPageDetail('detail_game','<?php echo $data['id']; ?>');">
                <div class="widget widget-info widget-padding-sm">                            
                    <div class="widget-item-left">
                        <input class="knob" data-width="100" data-height="100" data-min="0" data-max="100" data-displayInput=false data-bgColor="#d6f4ff" data-fgColor="#FFF" value="<?php echo $persentasi; ?>%" data-readOnly="true" data-thickness=".2"/>
                    </div>
                    <div class="widget-data">
                        <div class="widget-big-int"><?php echo ceil($persentasi); ?> %</div>
                        <div class="widget-title"><?php echo $data['game']; ?></div>                            
                    </div>                                                      
                </div> 
            </a>
        </div>
    <?php 
            endforeach;
        else:?>        
        <div class="col-md-12">
            <div class="widget widget-danger widget-padding-sm"> 
                <div class="widget-data">
                    <div class="widget-big-int">Tidak memiliki game</div>
                    <div class="widget-title">yang pernah dimainkan</div>                            
                </div>                             
            </div> 
        </div>
    <?php
        endif;
    endif;
    ?>
    
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/knob/jquery.knob.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/owl/owl.carousel.min.js"></script>        
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
<?php $this->load->view('template/plugin/iCheck'); ?>
<?php $this->load->view('template/plugin/AutoPlugin'); ?> 
<script type="text/javascript" src='<?php echo base_url(); ?>assets/js/user.js'></script>   
<script type="text/javascript">
    function loadPageDetail(page, id_game){ 
        var id_user = $("#id_user").val();
        document.getElementById("loadPage").style.display = "";
        $('#content_profil').hide();  
        $.ajax({
            type     : "POST",
            url      : "<?php echo site_url('Control_user/getDetailData/"+page+"'); ?>",
            data     : "id_user="+id_user+"&id_game="+id_game,
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
