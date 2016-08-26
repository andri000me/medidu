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
      $id       = $row['id'];
      $message  = $row['message'];
    }
  }else{
    $id             = "";
    $message        = "";
  }
?>
<form id="validate" role="form" class="form-horizontal" action="javascript:$('#validate').submit();">
  <input type="hidden" value="<?php echo $operasi; ?>" id="operasi" name="operasi">
  <input type="hidden" value="<?php echo $penerima; ?>" id="penerima" name="penerima">
  <input type="hidden" value="<?php echo $pengirim; ?>" id="pengirim" name="pengirim">
  <?php if ($operasi!="delete"): ?>
  <textarea class="summernote" id="message" name="message"><?php echo $message; ?></textarea>
  <?php else: ?>
    Anda yakin untuk menghapus data ?
  <?php endif; ?>
</form>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/summernote/summernote.js"></script>
<?php $this->load->view("template/plugin/noty"); ?>
<?php $this->load->view("template/plugin/validationEngine"); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/message.js"></script>
<script type="text/javascript">  
  $("#validate").submit(function(e) {
      if ($("#operasi").val() == "create") {
        message.setDataUrl("<?php echo base_url(); ?>Control_message/insert/");
        message.setDataString($("#validate").serialize()+"&table=tbl_head_message");
        //message.setID(<?php echo $this->session->userdata("id"); ?>);
        message.setDataAlert(", data saved");
        message.proses("POST", "phase");

        message.setDataUrl("<?php echo base_url(); ?>Control_message/openMessage/<?php echo $id_head; ?>");
        message.setDataString("");
        message.proses("GET", "link");
      }else if($("#operasi").val() == "update"){
        message.setDataUrl("index.php/Control_message/update/");
        message.setDataString($("#formmessage").serialize()+"&table=tbl_head_message&key=id&id="+$("#id").val());
        //message.setID(<?php echo $this->session->userdata("id"); ?>);
        message.setDataAlert(", data updated");
        message.proses("POST", "link");
      }else if($("#operasi").val() == "delete"){
        message.setDataUrl("index.php/Control_message/delete/");
        message.setDataString("table=tbl_head_message&key=id&id="+$("#id").val());
        //message.setID(<?php echo $this->session->userdata("id"); ?>);
        message.setDataAlert(", data deleted");
        message.proses("POST", "link");
      }
  });
</script>