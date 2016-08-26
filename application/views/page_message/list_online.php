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

<div class="list-group border-bottom">
<?php 
	if (!empty($query)):
		foreach ($query->result_array() as $data): 
			if ($data['id'] != $this->session->userdata("id")):
?>
				<a href="javascript:;" onclick="openFormMessage('create', '<?php echo $data['id']; ?>')" class="list-group-item"><span class="fa fa-circle text-success"></span> <?php echo $data['nama_depan']; ?></a>
<?php	
			endif;
		endforeach;
	endif;
?>
</div>

<?php $this->load->view('template/plugin/iCheck'); ?>
<?php $this->load->view('template/plugin/noty'); ?>
<?php $this->load->view('template/plugin/AutoPlugin'); ?>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/message.js'></script>
<script type="text/javascript">  
    function openFormMessage(operasi, id)
    { 
        hideAll();
        message.setDataUrl("Control_message/openFormulir/");
        message.setDataLink(id, "tbl_head_message", "id", "message", operasi, "");
        message.getPage("Form", "md");
    }
</script>