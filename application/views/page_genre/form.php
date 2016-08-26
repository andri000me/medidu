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
     
<?php $this->load->view('template/plugin/iCheck'); ?>
<?php $this->load->view('template/plugin/noty'); ?>
<?php $this->load->view('template/plugin/validationEngine'); ?>
<script type="text/javascript" src='<?php echo base_url(); ?>assets/js/genre.js'></script>   