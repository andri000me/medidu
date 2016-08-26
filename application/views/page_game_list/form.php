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
    $("#validate").submit();
  });
</script>
<?php 
  if (!empty($query)){
    foreach ($query as $row){
      $id             = $row['id'];
      $genre          = $row['genre'];
      $keterangan     = $row['keterangan'];
    }
  }else{
    $id             = "";
    $genre          = "";
    $keterangan     = "";
  }
?>
<form id="validate" role="form" class="form-horizontal" action="javascript:$('#validate').submit();">
  <input type="hidden" value="<?php echo $operasi; ?>" id="operasi" name="operasi">
  <input type="hidden" value="<?php echo $id; ?>" id="id" name="id">
  <?php if ($operasi!="delete"): ?>
  <table class="table table-hover">
      <tbody>
        <tr>
          <th><?php echo $xml->field->genre; ?></th>
          <td><input type="text" class="form-control" required id="genre" name="genre" value="<?php echo $genre; ?>"></td>
        </tr>
        <tr>
          <th><?php echo $xml->field->information; ?></th>
          <td><textarea class="form-control" required id="keterangan" name="keterangan" ><?php echo $keterangan; ?></textarea></td>
        </tr>
      </tbody>
  </table>
  <?php else: ?>
    Anda yakin untuk menghapus data <b><?php echo $genre; ?></b> ?
  <?php endif; ?>
</form>
     
<script type='text/javascript' src='<?php echo base_url(); ?>assets/template/joli/js/plugins/noty/jquery.noty.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/template/joli/js/plugins/noty/layouts/topCenter.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/template/joli/js/plugins/noty/layouts/topLeft.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/template/joli/js/plugins/noty/layouts/topRight.js'></script>            
<script type='text/javascript' src='<?php echo base_url(); ?>assets/template/joli/js/plugins/noty/themes/default.js'></script>
           
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/bootstrap_2/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url(); ?>assets/template/joli/js/plugins/icheck/icheck.js"></script>
<script type="text/javascript" src='<?php echo base_url(); ?>assets/template/joli/js/plugins/jquery-validation/jquery.validate.js'></script>   
<script type="text/javascript" src='<?php echo base_url(); ?>assets/js/genre.js'></script>   