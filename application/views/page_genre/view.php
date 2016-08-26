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
	if (!empty($query)):
		foreach ($query as $row): 
?>
	<table class="table table-hover">
		<caption><?php echo $xml->option->detail; ?> data <?php echo $xml->field->genre; ?> <?php echo $row['genre']; ?></caption>
			<tbody>
				<tr>
					<th><?php echo $xml->field->genre; ?></th>
					<td><?php echo $row['genre']; ?></td>
				</tr>
				<tr>
					<th><?php echo $xml->field->information; ?></th>
					<td><?php echo $row['keterangan']; ?></td>
				</tr>
			</tbody>
	</table>
<?php	endforeach;
	endif;
?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/demo_tables.js"></script> 