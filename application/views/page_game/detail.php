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
        foreach ($query->result_array() as $row) {
            $id_game        = $row['id'];
            $game           = $row['game'];
            $keterangan     = $row['deskripsi'];
            $viewers        = $row['viewers'];
            $likes          = $row['likes'];
            $downloaders    = $row['download'];
            $enabled        = $row['enabled'];
        }
    }else{
        $id_game        = "";
        $game           = "";
        $game           = "";
        $keterangan     = "";
        $likes          = "";
        $downloaders    = "";
        $enabled        = "";
    }
?>

<!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"> <?php echo $xml->label->home; ?></a></li>                    
        <li><a href="<?php echo site_url('Control_main/openPage/game'); ?>" class="ajax"><?php echo $xml->page; ?> <?php echo $xml->field->game; ?></a></li>                    
        <li class="active"><?php echo $xml->page; ?> <?php echo $xml->label->game_details; ?></li>
    </ul>
    <!-- END BREADCRUMB -->  

<div class="content-frame">     
<!-- START CONTENT FRAME TOP -->
    <div class="content-frame-top">                        
        <div class="page-title">                    
            <h2><span class="fa fa-arrow-circle-o-left"></span> <?php echo $game; ?></h2>
        </div>  

        <div class="pull-right">
            <button class="btn btn-default content-frame-left-toggle"><span class="fa fa-bars"></span></button>
        </div>                                
        <div class="pull-right" style="width: 100px; margin-right: 5px;">
            <div class="form-group">
                <label class="switch switch-medium">
                    <input type="checkbox" id="game_<?php echo $row['id']; ?>" onclick="updateEnabled('game','tbl_game', '<?php echo $row['id'] ?>')" <?php echo $enabled==0?"checked='checked'":"" ?> />
                    <span></span>
                </label>  
            </div>
        </div>
                                    
    </div>                    
    <div class="content-frame-left">

        <div class="panel panel-default">                            
            <div class="panel-body panel-body-image">
                <img src="<?php echo base_url(); ?>file/images/game/default.jpg" alt="default"/>
                <a href="#" class="panel-body-inform">
                    <span class="fa fa-gamepad"></span>
                </a>
            </div>
            <div class="panel-body">
                <h3><?php echo $xml->field->information; ?></h3>
                <p><?php echo $keterangan; ?></p>
            </div>
        </div>

        
        <!-- START TAGSINPUT -->

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <h4>Genre:</h4>

                    <div class="form-group">
                        <div class="input-group">
                            <input id="genre" name="genre" autofocus type="text" class="form-control" placeholder="Genre game ...">
                            <span class="input-group-btn">
                                <button onclick="tambah_genre('<?php echo $id_game; ?>');" class="btn btn-default" type="button"><?php echo $xml->button->add; ?></button>
                            </span>
                        </div> 
                    </div>
                    
                    <ul class="list-tags">
                    <?php 
                        if (!empty($query_genre)):
                            foreach ($query_genre->result_array() as $row): ?>
                        <li><a href="#"><span class="fa fa-tag"></span> <?php echo $row['genre']; ?></a></li>            
                    <?php   endforeach;
                        endif;
                    ?>
                    </ul>                            
                </div>
            </div>       
        </div>   
        <!-- END OF TAGSINPUT --> 
                             
        <div class="panel panel-default">
            <div class="panel-body">
                <h3><span class="fa fa-download"></span> Mini dropzone</h3>                                    
                <p>Add form with class <code>dropzone dropzone-mini</code> to get mini dropzone box</p>
                <form action="#" class="dropzone dropzone-mini"></form>
            </div>
        </div>       
    </div>   
    <!-- END CONTENT FRAME TOP --> 

    <div class="content-frame-body">                       
        <!-- START WIDGETS -->      
        <div class="row push-up-12">
            <div class="col-md-4">                                    
                <!-- START WIDGET MESSAGES -->
                <div class="widget widget-default widget-item-icon">
                    <div class="widget-item-left">
                        <span class="fa fa-eye"></span>
                    </div>  

                    <div class="widget-data">
                        <div class="widget-int num-count"><?php echo $viewers; ?></div>
                        <div class="widget-title"><?php echo $xml->field->viewers; ?></div>
                        <div class="widget-subtitle">
                            <?php echo $xml->field->information; ?> 
                            <?php echo $xml->label->about; ?> 
                            <?php echo $xml->field->viewers; ?> 
                            <?php echo $xml->field->game; ?> 
                            <?php echo $game; ?>
                        </div>
                    </div>      
                </div>                            
                <!-- END WIDGET MESSAGES -->                                    
            </div>

            <div class="col-md-4">                                    
                <!-- START WIDGET MESSAGES -->
                <div class="widget widget-default widget-item-icon">
                    <div class="widget-item-left">
                        <span class="glyphicon glyphicon-thumbs-up"></span>
                    </div>  

                    <div class="widget-data">
                        <div class="widget-int num-count"><?php echo $likes; ?></div>
                        <div class="widget-title"><?php echo $xml->field->likes; ?></div>
                        <div class="widget-subtitle">
                            <?php echo $xml->field->information; ?> 
                            <?php echo $xml->label->about; ?> 
                            <?php echo $xml->field->likes; ?> 
                            <?php echo $xml->field->game; ?> 
                            <?php echo $game; ?>
                        </div>
                    </div>      
                </div>                            
                <!-- END WIDGET MESSAGES -->                                   
            </div>

            <div class="col-md-4">                                    
                <!-- START WIDGET MESSAGES -->
                <div class="widget widget-default widget-item-icon">
                    <div class="widget-item-left">
                        <span class="fa fa-download"></span>
                    </div>  

                    <div class="widget-data">
                        <div class="widget-int num-count"><?php echo $downloaders; ?></div>
                        <div class="widget-title"><?php echo $xml->field->download; ?></div>
                        <div class="widget-subtitle">
                            <?php echo $xml->field->information; ?> 
                            <?php echo $xml->label->about; ?> 
                            <?php echo $xml->field->download; ?> 
                            <?php echo $xml->field->game; ?> 
                            <?php echo $game; ?>
                        </div>
                    </div>      
                </div>                            
                <!-- END WIDGET MESSAGES -->                                   
            </div>

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title-box">
                            <h3><?php echo $xml->field->question; ?></h3>
                            <span><?php echo $xml->option->detail." ".$xml->field->question." ".$xml->field->game." <i>".$game."</i>"; ?></span>
                        </div>    
                        <div class="btn-group pull-right">
                            <button class="btn btn-primary" onclick="openGame('form_soal', 'create', '<?php echo $id_game; ?>', 'tbl_soal');"><i class="fa fa-plus"></i> <?php echo $xml->button->add; ?> Data</button>
                            <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button> 
                            <ul class="dropdown-menu">
                                <li><a href="javascript::;" onClick ="$('#example').tableExport({type:'pdf',escape:'false'});"><img src='<?php echo base_url(); ?>file/images/icon/Adobe Acrobat Reader.png' width="24"/> XLS</a></li>
                                <li class="divider"></li>
                                <li><a href="javascript::;" onClick ="$('#example').tableExport({type:'excel',escape:'false'});"><img src='<?php echo base_url(); ?>file/images/icon/Excel alt 1.png' width="24"/> XLS</a></li>
                                <li><a href="javascript::;" onClick ="$('#example').tableExport({type:'doc',escape:'false'});"><img src='<?php echo base_url(); ?>file/images/icon/Word alt 1.png' width="24"/> Word</a></li>
                                <li class="divider"></li>
                            </ul>
                        </div>  
                    </div>
                    <div class="panel-body">                                    
                        <div class="row stacked">
                            <div class="col-md-12"> 
                                <table id="example" class="display" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">NO</th>
                                        <th>Exp</th>
                                        <th><?php echo $xml->field->question; ?></th>
                                        <th><?php echo $xml->field->answer; ?> A</th>
                                        <th><?php echo $xml->field->answer; ?> B</th>
                                        <th><?php echo $xml->field->answer; ?> C</th>
                                        <th><?php echo $xml->field->condition; ?></th>
                                        <th>Menu</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>NO</th>
                                        <th>Exp</th>
                                        <th><?php echo $xml->field->question; ?></th>
                                        <th><?php echo $xml->field->answer; ?> A</th>
                                        <th><?php echo $xml->field->answer; ?> B</th>
                                        <th><?php echo $xml->field->answer; ?> C</th>
                                        <th><?php echo $xml->field->condition; ?></th>
                                        <th>Menu</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php 
                                    if (!empty($query_soal)):
                                        $x = 1;
                                        foreach ($query_soal->result_array() as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $x; ?></td>
                                        <td><?php echo $row['exp']; ?></td>
                                        <td><?php echo $row['soal']; ?></td>
                                        <td><?php echo $row['jawaban_a']; ?></td>
                                        <td><?php echo $row['jawaban_b']; ?></td>
                                        <td><?php echo $row['jawaban_c']; ?></td>
                                        <td>
                                            <label class="switch switch-small">
                                                <input type="checkbox" id="soal_<?php echo $row['id']; ?>" onclick="updateEnabled('soal','tbl_soal', '<?php echo $row['id'] ?>')" <?php echo $row['enabled']==0?"checked='checked'":"" ?> />
                                                <span></span>
                                            </label>  
                                        </td>
                                        <td>                                                                                
                                            <div class="btn-group btn-group-sm">
                                                <button onclick="openGame('form_soal', 'update', '<?php echo $row['id']; ?>', 'tbl_soal');" class="btn btn-default"><i class="fa fa-pencil"></i></button>
                                                <button onclick="openGame('form_soal', 'delete', '<?php echo $row['id']; ?>', 'tbl_soal');" class="btn btn-default"><i class="fa fa-trash-o"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                        $x++;
                                        endforeach;
                                    endif;
                                    ?>
                                </tbody>
                                </table>
                            </div>
                        </div>                                    
                    </div>
                </div> 
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title-box">
                            <h3>Files</h3>
                            <span><?php echo "Files archive ".$xml->field->game." <i>".$game."</i>"; ?></span>
                        </div>    
                        <div class="btn-group pull-right">
                            <button class="btn btn-primary" onclick="openGame('form_file', 'create', '<?php echo $id_game; ?>', 'tbl_soal');"><i class="fa fa-plus"></i> <?php echo $xml->button->add; ?> Data</button>
                            <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button> 
                            <ul class="dropdown-menu">
                                <li><a href="javascript::;" onClick ="$('#example').tableExport({type:'pdf',escape:'false'});"><img src='<?php echo base_url(); ?>file/images/icon/Adobe Acrobat Reader.png' width="24"/> XLS</a></li>
                                <li class="divider"></li>
                                <li><a href="javascript::;" onClick ="$('#example').tableExport({type:'excel',escape:'false'});"><img src='<?php echo base_url(); ?>file/images/icon/Excel alt 1.png' width="24"/> XLS</a></li>
                                <li><a href="javascript::;" onClick ="$('#example').tableExport({type:'doc',escape:'false'});"><img src='<?php echo base_url(); ?>file/images/icon/Word alt 1.png' width="24"/> Word</a></li>
                                <li class="divider"></li>
                            </ul>
                        </div>  
                    </div>
                    <div class="panel-body">                                    
                        <div class="row stacked">
                            <div class="col-md-12"> 
                                <table id="dataFile" class="display" width="100%">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th><?php echo $xml->field->files; ?></th>
                                        <th><?php echo $xml->field->version; ?></th>
                                        <th><?php echo $xml->field->condition; ?></th>
                                        <th>Menu</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>NO</th>
                                        <th><?php echo $xml->field->question; ?></th>
                                        <th><?php echo $xml->field->version; ?></th>
                                        <th><?php echo $xml->field->condition; ?></th>
                                        <th>Menu</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php 
                                    if (!empty($query_file)):
                                        $x = 1;
                                        foreach ($query_file->result_array() as $row):
                                    ?>
                                    <tr>
                                        <td><?php echo $x; ?></td>
                                        <td><?php echo $row['file']; ?></td>
                                        <td><?php echo $row['versi']; ?></td>
                                        <td>
                                            <label class="switch switch-small">
                                                <input type="checkbox" id="file_<?php echo $row['id']; ?>" onclick="updateEnabled('file','tbl_file_game', '<?php echo $row['id'] ?>')" <?php echo $row['enabled']==0?"checked='checked'":"" ?> />
                                                <span></span>
                                            </label>  
                                        </td>
                                        <td>                                                                                
                                            <div class="btn-group btn-group-sm">
                                                <button onclick="openGame('form_file', 'update', '<?php echo $row['id']; ?>', 'tbl_file_game');" class="btn btn-default"><i class="fa fa-pencil"></i></button>
                                                <button onclick="openGame('form_file', 'delete', '<?php echo $row['id']; ?>', 'tbl_file_game');" class="btn btn-default"><i class="fa fa-trash-o"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                        $x++;
                                        endforeach;
                                    endif;
                                    ?>
                                </tbody>
                                </table>
                            </div>
                        </div>                                    
                    </div>
                </div>               
            </div> 
        </div>
</div>
<!-- START TEMPLATE -->  

<?php $this->load->view('template/plugin/dataTables'); ?>
<?php $this->load->view('template/plugin/AutoPlugin'); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/game.js"></script> 
<script type="text/javascript">
$('#dataFile').DataTable();
$("#genre").autocomplete({
        minChars: 1,        
        source:function(req, add){
            $.ajax({
                url       :"<?php echo site_url('Control_game/lookUp/genre'); ?>",
                dataType  :'json',
                type      :'POST',
                data      : req,
                success:function(data){
                    if (data.response == "true") 
                        {
                            add(data.message);
                    }
                },
            });
        },
});


function tambah_genre(id){
    var genre   = $("#genre").val();

    $.ajax({
        url       :"<?php echo site_url('Control_genre/insert_genre/'); ?>",
        dataType  :'json',
        type      :'POST',
        data      : "id="+id+"&genre="+genre,
        success:function(data){
            if (data == true) {
                NProgress.start(); 
                this.url = "<?php echo site_url('Control_game/openPage/detail'); ?>";
                $.get(this.url, { id:id } ,function(data) {
                    setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
                    $('#content_inti').html(data);
                });
            }
        },
    });
};   

function openGame(file, operasi, id, table)
{   
    hideAll();
    game.setDataUrl("Control_game/openPage/"+file);
    game.setDataLink(id, table, "id", "game", operasi, "");
    game.getPage("Form", "md");
};
</script>