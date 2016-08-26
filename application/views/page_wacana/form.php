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
    $("#formWacana").submit();
  });
</script>
<?php 
  if ($operasi == "create") {
    $wacana = "";    
  }
  if (!empty($query)) {
    foreach ($query->result_array() as $data) {
      $wacana   = $data['wacana'];
    }
  }else{
    $wacana = "";
  }
?>
<form id="formWacana" role="form" class="form-horizontal" action="javascript:$('#formWacana').submit();">
  <input type="hidden" value="<?php echo $this->session->userdata('id'); ?>" id="id_user" name="id_user">
  <input type="hidden" value="wacana" id="type" name="type">
  <input type="hidden" value="<?php echo $operasi; ?>" id="operasi" name="operasi">
  <input type="hidden" value="<?php echo $id; ?>" id="id" name="id">
  <?php if ($operasi!="delete"): ?>
  <textarea class="summernote" id="wacana" name="wacana"><?php echo $wacana; ?></textarea>
  <?php else: ?>
    Anda yakin untuk menghapus wacana ?
  <?php endif; ?>
</form>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/summernote/summernote.js"></script>
<?php $this->load->view("template/plugin/noty"); ?>
<?php $this->load->view("template/plugin/validationEngine"); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/wacana.js"></script>
<script type="text/javascript">  
  $("#formWacana").submit(function(e) {
      if ($("#operasi").val() == "create") {
        wacana.setDataUrl("index.php/Control_wacana/insert/");
        wacana.setDataString($("#formWacana").serialize()+"&table=tbl_wacana");
        wacana.setID($("#id_user").val());
        wacana.setDataAlert(", data saved");
        wacana.proses("POST", "link");
      }else if($("#operasi").val() == "update"){
        wacana.setDataUrl("index.php/Control_wacana/update/");
        wacana.setDataString($("#formWacana").serialize()+"&table=tbl_wacana&key=id&id="+$("#id").val());
        wacana.setID($("#id_user").val());
        wacana.setDataAlert(", data updated");
        wacana.proses("POST", "link");
      }else if($("#operasi").val() == "delete"){
        wacana.setDataUrl("index.php/Control_wacana/delete/");
        wacana.setDataString("table=tbl_wacana&key=id&id="+$("#id").val());
        wacana.setID($("#id_user").val());
        wacana.setDataAlert(", data deleted");
        wacana.proses("POST", "link");
      }
  });
</script>