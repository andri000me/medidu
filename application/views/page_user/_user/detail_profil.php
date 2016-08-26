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
	if (!empty($query_pengaturan)){
		foreach ($query_pengaturan->result_array() as $data) {
			$display_email = $data['display_email'];
			$display_phone = $data['display_phone'];
		}
	}else{
		$display_email = "";
		$display_phone = "";
	}

	if (!empty($query_skor)){
		$exp = 0;
		foreach ($query_skor->result_array() as $data) {
			$exp 		= $exp + $data['exp'];
		}
	}else{
		$exp = 0;
	}

	if (!empty($query_level)){
		foreach ($query_level->result_array() as $data) {
			if ($exp <= $data['exp']) {
				$req_exp 	= $data['exp'];
				$level 		= $data['level'];
				break;
			}else{
				$level 		= 1;
			}
		}
	}else{
		$level = 1;
	}

	//$totalskor  = $exp/$req_exp;
	$persentasi 	= $exp/$req_exp*100;
	$req_exp_next  	= $req_exp-$exp;
	//echo $exp."<br>";
	//echo $req_exp."<br>";
	//echo $persentasi."<br>";
	//echo $level;
	if (!empty($query_profil)):
		foreach ($query_profil->result_array() as $row): 
?>

  <style type="text/css">
    #content_inti{
      height: 100%;
      min-height: 100%;
    }
  </style>
  <script type="text/javascript">    
    $('#content_inti').css({ height: $(window).innerHeight() });

    $(window).resize(function(){
      $('#content_inti').css({ height: $(window).innerHeight() });
  });
  </script>
  
<!-- START WIDGETS -->      
<div class="row push-up-12">
	<div class="col-md-3">
		<!-- START WIDGET MESSAGES -->
		<div class="widget widget-default widget-item-icon">
			<div class="widget-item-left">
				<span class="fa fa-star-half-full"></span>
			</div>  
						
			<div class="widget-data">
				<div class="widget-int num-count"><?php echo $exp; ?> <small>exp</small></div>
				<div class="widget-title">Experience</div>
				<div class="widget-subtitle">
				<?php 
					if (!empty($this->session->userdata("id"))) {
						if ($this->session->userdata('language') == "id") {
							echo $xml->field->information." experience ".$xml->label->your;
						}else{
							echo  $xml->field->information." ".$xml->label->your." experience ";
						}
					}else{
						echo $xml->field->information." experience ".$xml->label->your;
					}
				?>
				</div>
			</div>
		</div>
		<!-- END WIDGET MESSAGES -->
	</div>

	<div class="col-md-3">
		<!-- START WIDGET MESSAGES -->
		<div class="widget widget-default widget-item-icon">
			<div class="widget-item-left">
				<span class="fa fa-star"></span>
			</div>  
						
			<div class="widget-data">
				<div class="widget-int num-count"><?php echo $req_exp_next; ?> <small>exp</small></div>
				<div class="widget-title">Experience</div>
				<div class="widget-subtitle">
				<?php 
					if (!empty($this->session->userdata("id"))) {
						if ($this->session->userdata('language') == "id") {
							echo "Exp yang ".$xml->label->required." ".$xml->label->for." ".$xml->field->level." ".$xml->label->next;
						}else{
							echo $xml->label->required." exp ".$xml->label->for." ".$xml->label->next." ".$xml->field->level;
						}
					}else{
						echo "Experience ".$xml->label->for." ".$xml->field->level." ".$xml->label->next;
					}
				?>
				</div>
			</div>
		</div>
		<!-- END WIDGET MESSAGES -->
	</div>

	<div class="col-md-3">
		<!-- START WIDGET MESSAGES -->
		<div class="widget widget-default widget-item-icon">
			<div class="widget-item-left">
				<span class="fa fa-sort-amount-asc"></span>
			</div>  
						
			<div class="widget-data">
				<div class="widget-int num-count"><?php echo $level; ?></div>
				<div class="widget-title"><?php echo $xml->field->level; ?></div>
				<div class="widget-subtitle">
				<?php 
					if (!empty($this->session->userdata("id"))) {
						if ($this->session->userdata('language') == "id") {
							echo $xml->field->information." ".$xml->field->level." ".$xml->label->your;
						}else{
							echo $xml->field->information." ".$xml->label->your." ".$xml->field->level;
						}
					}else{
						echo $xml->field->information." ".$xml->field->level." ".$xml->label->your;
					}
				?>
				</div>
			</div>
		</div>
		<!-- END WIDGET MESSAGES -->
	</div>

	<div class="col-md-3">
		<!-- START WIDGET MESSAGES -->
		<div class="widget widget-default widget-item-icon">
			<div class="widget-item-left">
				<span class="fa fa-trophy"></span>
			</div>  
						
			<div class="widget-data">
				<div class="widget-int num-count"></div>
				<div class="widget-title"></div>
					<div class="widget-subtitle">
				</div>
			</div>
		</div>
		<!-- END WIDGET MESSAGES --> 
	</div>

	<div class="col-md-12">   
		<p>Experience <code><?php echo $persentasi; ?>%</code> 
				<?php 
					if (!empty($this->session->userdata("id"))) {
						if ($this->session->userdata('language') == "id") {
							echo $xml->label->get." experience ".$xml->label->for." ".$xml->field->level." ".($level+1)." = ".$req_exp;
						}else{
							echo $xml->label->get." experience ".$xml->label->for." ".$xml->field->level." ".($level+1)." = ".$req_exp;
						}
					}else{
						echo $xml->label->get." experience ".$xml->label->for." ".$xml->field->level." ".($level+1)." = ".$req_exp;
					}
				?>
		</p>
		<div class="progress progress-small">
			<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $persentasi/2; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persentasi; ?>%;">
			</div>
		</div>
	</div>

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
				<?php 
					if ($display_phone == 0):
				?>
					<tr>
						<th><?php echo $xml->phone; ?></th>
						<td><?php echo $row['telepon']; ?></td>
					</tr>
				<?php 
					endif;
				?>
				<tr>
					<th><?php echo $xml->field->birthday; ?></th>
					<td><?php echo date_format(date_create($row['tgl_lahir']), 'd F Y'); ?></td>
				</tr>
				<tr>
					<th><?php echo $xml->field->address; ?></th>
					<td><?php echo $row['alamat']; ?></td>
				</tr>
				<?php 
					if ($display_email == 0):
				?>
					<tr>
						<th>Email</th>
						<td><?php echo $row['email']; ?></td>
					</tr>
				<?php 
					endif;
				?>
			</tbody>
	</table>
<?php	endforeach;
	endif;
?>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/demo_tables.js"></script> 