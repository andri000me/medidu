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
		<caption><?php echo $xml->option->detail; ?> data <?php echo $xml->field->game; ?> <?php echo $row['game']; ?></caption>
			<tbody>
				<tr>
					<th><?php echo $xml->field->game; ?></th>
					<td><?php echo $row['game']; ?></td>
				</tr>
				<tr>
					<th><?php echo $xml->field->description; ?></th>
					<td><?php echo $row['deskripsi']; ?></td>
				</tr>
				<tr>
					<th><?php echo $xml->field->viewers; ?></th>
					<td><?php echo $row['viewers']; ?></td>
				</tr>
				<tr>
					<th><?php echo $xml->field->likes; ?></th>
					<td><?php echo $row['likes']; ?></td>
				</tr>
				<tr>
					<th><?php echo $xml->field->download; ?></th>
					<td><?php echo $row['download']; ?></td>
				</tr>
				<tr>
					<th><?php echo $xml->field->condition; ?></th>
					<td>
					<?php
						if ($row['enabled'] == 1) {
							echo strtoupper(substr($xml->label->not, 0, 1))."".substr($xml->label->not, 1)." ".$xml->label->enabled;
						}else{
							echo $xml->label->enabled;
						}
					?>
					</td>
				</tr>
			</tbody>
	</table>
<?php	endforeach;
	endif;
?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/demo_tables.js"></script> 