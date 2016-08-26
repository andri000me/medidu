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
	if (!empty($query_h_message)):
		foreach ($query_h_message->result_array() as $data): 
      if (!empty($query_user)):
        foreach ($query_user->result_array() as $result):
          if ($data['pengirim'] != $this->session->userdata("id")) {
            $id_user = $data['pengirim'];
          }else{
            $id_user = $data['penerima'];
          }

          if ($id_user == $result['id']):
?>
            <a href="<?php echo base_url(); ?>Control_message/openMessage/<?php echo $data['id']; ?>" class="list-group-item ajaxMessage"><span class="fa fa-envelope"></span> <?php echo $result['nama_depan']; ?></a>
<?php 
          endif;
        endforeach;
      endif;
    endforeach;
	endif;
?>
</div>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/message.js'></script>