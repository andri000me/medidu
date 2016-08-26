<?php 
    if (!empty($this->session->userdata('id')) && !empty($id_user)):
    ?>
<input type="hidden" value="<?php echo $this->session->userdata('id'); ?>" id="my_id" name="my_id">
<input type="hidden" value="<?php echo $id_user; ?>" id="id_user" name="id_user">
    <?php
    endif;
?>

<div class="row">
    <div class="col-md-12">
        <!-- START TIMELINE -->
        <div class="timeline fade in">                                
            <!-- START TIMELINE ITEM -->
            <div class="timeline-item timeline-main">
                <a href="javascript:;" id="btn_form"><div class="timeline-date">Timeline</div></a>
            </div>
            <!-- END TIMELINE ITEM -->

            <!-- START TIMELINE ITEM -->
            <?php 
            if (!empty($query_wacana)):
                $x = 0;
                $data = 1;
                foreach ($query_wacana->result_array() as $data):
                        if ($x%2 == 0) {
                            $posisi = "timeline-item-right";
                        }else{
                            $posisi = "";                    
                        }

                        if (strlen($data['poto_profil'])>0) {
                            $gambar = "thumbs_".$data['poto_profil'];
                        }else{
                            $gambar = "default-p.png";
                        }
            ?>
            <div class="timeline-item <?php echo $posisi; ?>">
                <div class="timeline-item-info"><?php echo date_format(date_create($data['tanggal']), 'd F Y'); ?></div>
                <div class="timeline-item-icon"><span class="fa fa-globe"></span></div>
                <div class="timeline-item-content">
                    <div class="timeline-heading">
                        <img src="<?php echo base_url(); ?>file/images/users/<?php echo $gambar; ?>"/> <a href="javascript:;"><?php echo $data['nama_depan']; ?></a>, 
                        <?php 
                        if (strtolower($data['type']) == "wacana") {
                            echo "added article";
                        }
                        ?>

                        <?php 
                        if ($this->session->userdata("id") == $data['id']):
                        ?>                               
                        <ul class="panel-controls">
                            <li><a href="javascript:;" onClick="updateWacana(<?php echo $data['id_wacana'] ?>);" class="panel-collapse"><span class="fa fa-pencil"></span></a></li>
                            <li><a href="javascript:;" onClick="deleteWacana(<?php echo $data['id_wacana'] ?>);" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>  
                        <?php 
                        endif;
                        ?>                           
                    </div>
                    <div class="timeline-body">
                        <?php echo $data['wacana']; ?>                                         
                    </div>
                    <div class="timeline-body comments">
                        <?php
                        if (!empty($query_komentar)):
                            foreach ($query_komentar->result_array() as $result):
                                if($result['id_wacana'] == $data['id_wacana']):

                                if (strlen($result['poto_profil'])>0) {
                                    $gambar = "thumbs_".$result['poto_profil'];
                                }else{
                                    $gambar = "default-p.png";
                                }
                        ?>
                                <div class="comment-item">
                                    <img src="<?php echo base_url(); ?>file/images/users/<?php echo $gambar; ?>"/>
                                    <p class="comment-head"> 
                                        <span>
                                        <!-- <div class="pull-right"> -->
                                            <?php 
                                            if (($result['id_user'] == $this->session->userdata("id")) || ($result['id_user'] == $this->session->userdata("id"))):
                                            ?>                                
                                                <div class="btn-group btn-group-xs pull-right">
                                                    <button class="btn btn-default"><i class="fa fa-pencil"></i></button>
                                                    <button class="btn btn-default"><i class="fa fa-times"></i></button>                                            
                                                </div> 
                                            <?php 
                                            endif;
                                            ?>
                                            <!-- </div>   -->
                                        </span>
                                        <a href="<?php echo site_url('Control_user/detail/'.$result['id_user']); ?>" id="<?php echo $this->session->userdata("id"); ?>" class="ajax"><?php echo $result['nama_depan']; ?></a> <span class="text-muted">@<?php echo $result['username']; ?> 
                                    </p>
                                    <p><?php echo $result['komentar']; ?></p>
                                    <small class="text-muted"><?php echo $result['tanggal']; ?></small>
                                </div>                                            
                        <?php
                                endif;
                            endforeach;
                        endif;
                        if (!empty($this->session->userdata("id"))):
                        ?>
                            <div class="comment-write">                                                
                                <textarea class="form-control" id="komentar_<?php echo $data['id_wacana']; ?>" placeholder="Write a comment" rows="2"></textarea>                                                
                            </div>
                        <?php endif; ?>
                    </div>            
                    <?php if (!empty($this->session->userdata("id"))): ?>        
                    <div class="timeline-body">                           
                        <ul class="panel-controls">
                            <li><a href="javascript:;" onclick="insertKomentar('<?php echo $data['id_wacana']; ?>');" class="panel-collapse"><span class="fa fa-comment"></span></a></li>
                        </ul>                                    
                    </div>
                    <?php endif; ?>
                </div>
            </div>     
            <?php 
                    if ($x < $data) {
                        //break;
                    }
                $x++;
                endforeach;
            endif;
            ?>  
            <!-- END TIMELINE ITEM -->

            <!-- START TIMELINE ITEM -->
            <div class="timeline-item timeline-main">
                <a href="javascript:;" id="btn_tambah"><div class="timeline-date"><span class="fa fa-ellipsis-h"></span></div></a>
            </div>                                
            <!-- END TIMELINE ITEM -->
        </div>
    </div>
</div>
<?php $this->load->view('template/plugin/dataTables'); ?>
<?php $this->load->view('template/plugin/noty'); ?>
<?php $this->load->view('template/plugin/AutoPlugin'); ?> 
<script type="text/javascript" src='<?php echo base_url(); ?>assets/js/wacana.js'></script>   
<script type="text/javascript" src='<?php echo base_url(); ?>assets/js/user.js'></script>   
<script type="text/javascript">
    $("#btn_form").click(function(){
        hideAll();
        wacana.setDataUrl("<?php echo site_url('Control_wacana/openFormulir'); ?>");
        wacana.setDataLink(0, "tbl_wacana", "id", "wacana", "create", "");
        wacana.getPage("Formulir wacana", "md");
    });

    function updateWacana(id){
        hideAll();
        wacana.setDataUrl("<?php echo site_url('Control_wacana/openFormulir'); ?>");
        wacana.setDataLink(id, "tbl_wacana", "id", "wacana", "update", "");
        wacana.getPage("Formulir wacana", "md");
    };

    function deleteWacana(id){
        hideAll();
        wacana.setDataUrl("<?php echo site_url('Control_wacana/openFormulir'); ?>");
        wacana.setDataLink(id, "tbl_wacana", "id", "wacana", "delete", "");
        wacana.getPage("Formulir wacana", "md");
    };

    function insertKomentar(id_wacana){
        console.log("from="+$("#my_id").val()+" to "+$("#id_user").val()+" komentar "+$("#komentar_"+id_wacana).val());
        wacana.setDataUrl("<?php echo site_url('Control_wacana/insert'); ?>");
        wacana.setDataString("table=tbl_komentar"+"&komentar=<p>"+$("#komentar_"+id_wacana).val()+"</p>&id_wacana="+id_wacana+"&id_user="+$("#my_id").val());
        wacana.setID($("#id_user").val());
        wacana.proses("POST", "link");
    }

    $('.ajax').click(function(e){
        NProgress.start();
        e.preventDefault();
        user.setDataUrl($(this).attr('href'));
        user.setDataString("id="+$(this).attr('id')); 
        user.proses("GET", "link");
    }); 
</script>