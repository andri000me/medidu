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
<link href="<?php echo base_url(); ?>assets/template/joli/js/plugins/icheck/skins/flat/red.css" rel="stylesheet">
<script type="text/javascript">
  $("#button_update, #button_save, #button_delete").click(function(){
    $("#formGame").submit();
  });
</script>
<?php 
  if (!empty($query)){
    foreach ($query as $row){
      $id             = $row['id'];
      $game           = $row['game'];
      $deskripsi      = $row['deskripsi'];
      $viewers        = $row['viewers'];
      $likes          = $row['likes'];
      $downloaders    = $row['download'];
      $enabled        = $row['enabled'];
    }
  }else{
    $id             = "";
    $game           = "";
    $deskripsi      = "";
    $viewers        = "";
    $likes          = "";
    $downloaders    = "";
    $enabled        = "";
  }
?>
<form id="formGame" role="form" class="form-horizontal" action="javascript:$('#formGame').submit();">
  <input type="hidden" value="<?php echo $operasi; ?>" id="operasi" name="operasi">
  <input type="hidden" value="<?php echo $id; ?>" id="id" name="id">
  <input type="hidden" value="<?php echo $enabled; ?>" id="enabled" name="enabled">
  <?php if ($operasi!="delete"): ?>
  <table class="table table-hover">
      <tbody>
        <tr>
          <th><?php echo $xml->field->game; ?></th>
          <td><input type="text" class="form-control" required id="game" name="game" value="<?php echo $game; ?>"></td>
        </tr>
        <tr>
          <th><?php echo $xml->field->description; ?></th>
          <td><textarea class="form-control" required id="deskripsi" name="deskripsi" ><?php echo $deskripsi; ?></textarea></td>
        </tr>
        <tr>
          <th><?php echo $xml->field->viewers; ?></th>
          <td><input type="number" class="form-control" required id="viewers" name="viewers" value="<?php echo intval($viewers); ?>"></td>
        </tr>
        <tr>
          <th><?php echo $xml->field->likes; ?></th>
          <td><input type="number" class="form-control" required id="likes" name="likes" value="<?php echo intval($likes); ?>"></td>
        </tr>
        <tr>
          <th><?php echo $xml->field->download; ?></th>
          <td><input type="number" class="form-control" required id="download" name="download" value="<?php echo intval($downloaders); ?>"></td>
        </tr>
        <tr>
          <th><?php echo $xml->field->condition; ?></th>
          <td>           
            <label class="switch switch-small">
              <input type="checkbox" id="setEnabled" <?php echo $enabled==0?"checked='checked'":"" ?> />
              <span></span>
            </label> 
          </td>
        </tr>
      </tbody>
  </table>
  <?php else: ?>
    Anda yakin untuk menghapus data <b><?php echo $game; ?></b> ?
  <?php endif; ?>
</form>
     
<?php $this->load->view('template/plugin/iCheck'); ?>
<?php $this->load->view('template/plugin/noty'); ?>
<?php $this->load->view('template/plugin/validationEngine'); ?>
<script type="text/javascript" src='<?php echo base_url(); ?>assets/js/game.js'></script> 
<script type="text/javascript">  
  $('#setEnabled').click(function(){
    if($('#setEnabled').is(":checked")){
      $('#enabled').val("0");
    }else{    
      $('#enabled').val("1");
    }
  });  

  $("#formGame").validate({
    ignore: [],
    rules: {
      game: {
        required: true
      },
      deskripsi: {
        required: true
      },
      viewers: {
        required: true
      },
      likes: {
        required: true
      }
    }
  });   

  $("#formGame").submit(function(e) {
    if ($('#formGame').valid()){
      e.preventDefault();

      if($("#operasi").val() == "create"){
        game.setDataUrl("index.php/Control_game/insert");      
        game.setDataString($("#formGame").serialize()+"&table=tbl_game");    
        game.setDataAlert(" saved data");    
      }else if($("#operasi").val() == "update"){      
        game.setDataUrl("index.php/Control_game/update");      
        game.setDataString($("#formGame").serialize()+"&table=tbl_game&key=id");
        game.setDataAlert(" update data");    
      }else if($("#operasi").val() == "delete"){
        game.setDataUrl("index.php/Control_game/delete");      
        game.setDataString($("#formGame").serialize()+"&table=tbl_game&key=id");    
        game.setDataAlert(" deleted data");    
      }
      game.proses("POST", "proses");   
    }
  });   
</script>
