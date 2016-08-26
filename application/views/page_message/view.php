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
		<caption><?php echo $xml->option->detail; ?> data <?php echo $xml->field->level; ?> <?php echo $row['level']; ?></caption>
			<tbody>
				<tr>
					<th width="50%"><?php echo $xml->field->level; ?></th>
					<td width="50%"><?php echo $row['level']; ?></td>
				</tr>
				<tr>
					<th>Experience</th>
					<td><?php echo $row['exp']; ?></td>
				</tr>
			</tbody>
	</table>
<?php	endforeach;
	endif;
?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/demo_tables.js"></script> 