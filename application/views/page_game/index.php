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
    <h2><span class="fa fa-gamepad"></span> <?php echo $xml->page; ?> <?php echo $xml->field->game; ?></h2>
  </div>                   
                
  <!-- PAGE CONTENT WRAPPER -->
  <div class="page-content-wrap">                
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Data</h3>

              <div class="btn-group pull-right">
                <button class="btn btn-primary" onclick="openFormGame('create', '0');"><i class="fa fa-plus"></i> <?php echo $xml->button->add; ?> Data</button>
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

            <div class="col-md-12">
          <div class="panel-body">
            <table id="example" class="display" width="100%">
              <thead>
                <tr>
                  <th>NO</th>
                  <th><?php echo $xml->field->game; ?></th>
                  <th><?php echo $xml->field->description; ?></th>
                  <th><?php echo $xml->field->viewers; ?></th>
                  <th><?php echo $xml->field->likes; ?></th>
                  <th><?php echo $xml->field->download; ?></th>
                  <th><?php echo $xml->field->condition; ?></th>
                  <th>Menu</th>
                </tr>
              </thead>

              <tfoot>
                <tr>
                  <th>NO</th>
                  <th><?php echo $xml->field->game; ?></th>
                  <th><?php echo $xml->field->description; ?></th>
                  <th><?php echo $xml->field->viewers; ?></th>
                  <th><?php echo $xml->field->likes; ?></th>
                  <th><?php echo $xml->field->download; ?></th>
                  <th><?php echo $xml->field->condition; ?></th>
                  <th>Menu</th>
                </tr>
              </tfoot>

              <tbody>
              <?php 
              if (!empty($query)):
                $x = 1;
                foreach ($query->result_array() as $row):
              ?>
                <tr>
                  <td><?php echo $x; ?></td>
                  <td><?php echo $row['game']; ?></td>
                  <td>
                  <?php 
                    if (strlen($row['deskripsi']) > 50) {
                      echo substr($row['deskripsi'], 0 ,50)." ...";
                    }else{
                      echo $row['deskripsi'];                      
                    }
                  ?></td>
                  <td><?php echo $row['viewers']; ?></td>
                  <td><?php echo $row['likes']; ?></td>
                  <td><?php echo $row['download']; ?></td>
                  <td>                  
                  <label class="switch switch-small">
                    <input type="checkbox" id="game_<?php echo $row['id']; ?>" onclick="updateEnabled('game', 'tbl_game', '<?php echo $row['id'] ?>')" <?php echo $row['enabled']==0?"checked='checked'":"" ?> />
                    <span></span>
                  </label>  
                  </td>
                  <td>                                                                                                                     
                    <div class="btn-group btn-group-sm">
                      <button class="btn btn-default" onclick="openDetailGame(<?php echo $row['id']; ?>)" data-toggle="tooltip" data-placement="bottom" title="<?php echo $xml->button->view; ?>"><i class="fa fa-eye"></i></button>
                      <button class="btn btn-default" onclick="openFormGame('update', '<?php echo $row['id']; ?>');" data-toggle="tooltip" data-placement="bottom" title="<?php echo $xml->button->update; ?>"><i class="fa fa-pencil"></i></button>                                                
                      <button class="btn btn-default" onclick="openFormGame('delete', '<?php echo $row['id']; ?>');" data-toggle="tooltip" data-placement="bottom" title="<?php echo $xml->button->delete; ?>"><i class="fa fa-trash-o"></i></button>                                        
                      <a id="<?php echo $row['id']; ?>" href="<?php echo site_url('Control_game/openPage/detail'); ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $xml->field->question; ?>" class="btn btn-default ajax"><i class="fa fa-wrench"></i></a>                                        
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

<?php $this->load->view('template/plugin/music_alert'); ?>
<?php $this->load->view('template/plugin/tableexport'); ?>
<?php $this->load->view('template/plugin/dataTables'); ?>
<?php $this->load->view('template/plugin/noty'); ?>
<?php $this->load->view('template/plugin/AutoPlugin'); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/game.js"></script>  
<script type="text/javascript">  
  function openFormGame(operasi, id)
  { 
      hideAll();
      game.setDataUrl("index.php/Control_main/openFormulir/");
      game.setDataLink(id, "tbl_game", "id", "game", operasi, "");
      game.getPage("Form", "md");
  };

  function openDetailGame(id)
  {
      hideAll();
      game.setDataUrl("index.php/Control_main/openDetail/");
      game.setDataLink(id, "tbl_game", "id", "game", "", "");
      game.getPage("Detail", "md");
  };
  
  function updateEnabled(getId, table, id){
    game.setDataUrl("index.php/Control_game/updateEnabled");
      if($('#'+getId+"_"+id).is(":checked")){
        game.setDataString("table="+table+"&key=id&id="+id+"&enabled=0");
        game.setDataAlert("enabled");
      }else{    
        game.setDataString("table="+table+"&key=id&id="+id+"&enabled=1");
        game.setDataAlert("disabled");
      }
      game.proses("POST", "condition");
  };

</script>