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
		<caption><?php echo $xml->option->detail; ?> data <?php echo $row['nama_depan']." ".$row['nama_belakang']; ?></caption>
			<tbody>
				<tr>
					<th><?php echo $xml->username; ?></th>
					<td><?php echo $row['nama_depan']." ".$row['nama_belakang']; ?></td>
				</tr>
				<tr>
					<th><?php echo $xml->gender->title; ?></th>
					<td><?php 
						if (strtolower($row['kelamin']) == "l") {
							echo $xml->gender->male;
						}else{
							echo $xml->gender->female;							
						}
					?></td>
				</tr>
				<tr>
					<th><?php echo $xml->phone; ?></th>
					<td><?php echo $row['telepon']; ?></td>
				</tr>
				<tr>
					<th><?php echo $xml->field->birthday; ?></th>
					<td><?php echo date_format(date_create($row['tgl_lahir']), 'd F Y'); ?></td>
				</tr>
				<tr>
					<th><?php echo $xml->field->address; ?></th>
					<td><?php echo $row['alamat']; ?></td>
				</tr>
				<tr>
					<th>Email</th>
					<td><?php echo $row['email']; ?></td>
				</tr>
			</tbody>
	</table>
<?php	endforeach;
	endif;
?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/demo_tables.js"></script> 