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
    $("#formFile").submit();
  });
</script>
<?php 

  if ($operasi == "create") {
    $id_game    = $id;
    $file       = "";
    $versi      = "";
    $deskripsi  = "";
    $enabled    = "";
  }elseif (!empty($query)){
    foreach ($query->result_array() as $row){
      $file       = $row['file'];
      $versi      = $row['versi'];
      $deskripsi  = $row['deskripsi'];
      $id_game    = $row['id_game'];
      $enabled    = $row['enabled'];
    }
  }else{
      $file       = "";
      $versi      = "";
      $deskripsi  = "";
      $enabled    = "";
  }
?>
<form id="formFile" role="form" class="form-horizontal" enctype="multipart/form-data" action="javascript:$('#formFile').submit();">
  <input type="hidden" value="<?php echo $operasi; ?>" id="operasi" name="operasi">
  <input type="hidden" value="<?php echo $id; ?>" id="id" name="id">
  <input type="hidden" value="<?php echo $id_game; ?>" id="id_game" name="id_game">
  <input type="hidden" value="<?php echo $enabled; ?>" id="enabledFile" name="enabled">
  <?php if ($operasi!="delete"): ?>
  <table class="table table-hover">
      <tbody>
        <?php if ($operasi!="update"): ?>
        <tr>
          <th><?php echo $xml->field->files; ?></th>
          <td><input type="file" class="form-control" name="fileGame" id="fileGame" required /></td>
        </tr>
        <?php endif; ?>
        <tr>
          <th><?php echo $xml->field->version; ?></th>
          <td><input value="<?php echo $versi; ?>" type="text" name="versi" id="versi" class="form-control" required /></td>
        </tr>
        <tr>
          <th><?php echo $xml->field->description; ?></th>
          <td><textarea class="summernote" name="deskripsi" id="deskripsi" required><?php echo $deskripsi; ?></textarea></td>
        </tr>
        <tr>
          <th><?php echo $xml->field->condition; ?></th>
          <td>           
            <label class="switch switch-small">
              <input type="checkbox" id="setEnabledFile" <?php echo $enabled==0?"checked='checked'":"" ?> />
              <span></span>
            </label> 
          </td>
        </tr>
      </tbody>
  </table>

  <div class="progress" style="display:none;">
      <div class="progress-bar" id="progressbar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">50%</div>
  </div>
  <?php else: ?>
    Anda yakin untuk menghapus data <b><?php echo $file." versi ".$versi; ?></b> ?
  <?php endif; ?>
</form>

           
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/fileinput/fileinput.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/summernote/summernote.js"></script>
<?php $this->load->view("template/plugin/noty"); ?>
<?php $this->load->view("template/plugin/validationEngine"); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins.js"></script>
<script type="text/javascript" src='<?php echo base_url(); ?>assets/js/game.js'></script>
<script type="text/javascript">  
  $('#setEnabledFile').click(function(){
    if($('#setEnabledFile').is(":checked")){
      $('#enabledFile').val("0");
    }else{    
      $('#enabledFile').val("1");
    }
  });   


/*  $("#formFile").validate({
    ignore: [],
    rules: {                                            
      file: {
        required: true
      },
      versi: {
        required: true
      }
    }                                    
  }); */     

  $("#formFile").submit(function(e) {
    if ($('#formFile').valid()){
      e.preventDefault();

      if($("#operasi").val() == "create"){
        var file = $("input[name=fileGame]");
        game.setDataUrl("index.php/Control_file/uploadFileSWF");
        game.setDataString($("#formFile").serialize()+"&table=tbl_file_game");
        game.setFile(file);
        game.setIdGame($("#id_game").val());
        game.upload("POST"); 
      }else if($("#operasi").val() == "update"){      
        game.setDataUrl("index.php/Control_game/update");      
        game.setDataString($("#formFile").serialize()+"&table=tbl_game&key=id");
        game.setDataAlert(" update data");    
      }else if($("#operasi").val() == "delete"){
        game.setDataUrl("index.php/Control_file/delete");      
        game.setDataString($("#formFile").serialize()+"&table=tbl_file_game&key=id");    
        game.setDataAlert(" deleted data");    
      }
      game.proses("POST", "proses");   
    }
  });      
</script>
