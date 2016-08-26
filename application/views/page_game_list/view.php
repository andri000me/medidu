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
	if (!empty($query_game)) {
		foreach ($query_game->result_array() as $row) {
			$id_game        = $row['id'];
			$game           = $row['game'];
			$keterangan     = $row['deskripsi'];
			$viewers        = $row['viewers'];
			$likes          = $row['likes'];
			$downloaders    = $row['download'];
			$enabled        = $row['enabled'];
		}
	}else{
			$id_game        = "";
			$game           = "";
			$game           = "";
			$keterangan     = "";
			$likes          = "";
			$downloaders    = "";
			$enabled        = "";
	}
?>

<!-- START BREADCRUMB -->
	<ul class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"> <?php echo $xml->label->home; ?></a></li>                    
		<li><a href="<?php echo site_url('Control_main/openPage/game_list'); ?>" class="ajax"><?php echo $xml->page; ?> <?php echo $xml->field->game; ?></a></li>                    
		<li class="active"><?php echo $xml->page; ?> <?php echo $xml->label->game_details; ?></li>
	</ul>
<!-- END BREADCRUMB -->  

<div class="content-frame">     
<!-- START CONTENT FRAME TOP -->
	<div class="content-frame-top">                        
		<div class="page-title">                    
			<h2><span class="fa fa-arrow-circle-o-left"></span> <?php echo $game; ?></h2>
		</div>  
			
		<div class="pull-right">
			<button class="btn btn-default content-frame-left-toggle"><span class="fa fa-bars"></span></button>
		</div>                      
	</div>                    
	<div class="content-frame-left">
		<div class="panel panel-default">
			<div class="panel-body panel-body-image">
				<img src="<?php echo base_url(); ?>file/images/game/default.jpg" alt="default"/>
				<a href="#" class="panel-body-inform">
					<span class="fa fa-gamepad"></span>
				</a>
			</div>
			<div class="panel-body">
				<h3><?php echo $xml->field->information; ?></h3>
				<p><?php echo $keterangan; ?></p>
			</div>
		</div>

		<!-- START TAGSINPUT -->
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="form-group">
						<h4>Genre:</h4> 
						<ul class="list-tags">
							<?php 
							if (!empty($query_genre)):
								foreach ($query_genre->result_array() as $row): ?>
									<li><a href="#"><span class="fa fa-tag"></span> <?php echo $row['genre']; ?></a></li>            
							<?php   
								endforeach;
							endif;
							?>
						</ul>
					</div>
				</div>
			</div>
		<!-- END OF TAGSINPUT -->     
	</div>   
	<!-- END CONTENT FRAME TOP --> 
		
	<div class="content-frame-body">
		<!-- START WIDGETS -->      
		<div class="row push-up-12">
			<div class="col-md-4">
				<!-- START WIDGET MESSAGES -->
				<div class="widget widget-default widget-item-icon">
					<div class="widget-item-left">
						<span class="fa fa-eye"></span>
					</div>  
							
					<div class="widget-data">
						<div class="widget-int num-count"><?php echo $viewers; ?></div>
						<div class="widget-title"><?php echo $xml->field->viewers; ?></div>
						<div class="widget-subtitle">
							<?php echo $xml->field->information; ?> 
							<?php echo $xml->label->about; ?> 
							<?php echo $xml->field->viewers; ?> 
							<?php echo $xml->field->game; ?> 
							<?php echo $game; ?>
						</div>
					</div>
				</div>
				<!-- END WIDGET MESSAGES -->
			</div>
			<div class="col-md-4">
				<!-- START WIDGET MESSAGES -->
				<div class="widget widget-default widget-item-icon">
					<div class="widget-item-left">
						<span class="fa fa-thumbs-o-up"></span>
					</div>  
							
					<div class="widget-data">
						<div class="widget-int num-count"><?php echo $likes; ?></div>
						<div class="widget-title"><?php echo $xml->field->likes; ?></div>
						<div class="widget-subtitle">
							<?php echo $xml->field->information; ?> 
							<?php echo $xml->label->about; ?> 
							<?php echo $xml->field->likes; ?> 
							<?php echo $xml->field->game; ?> 
							<?php echo $game; ?>
						</div>
					</div>
				</div>
				<!-- END WIDGET MESSAGES -->
			</div>
			<div class="col-md-4">
				<!-- START WIDGET MESSAGES -->
				<div class="widget widget-default widget-item-icon">
					<div class="widget-item-left">
						<span class="fa fa-download"></span>
					</div>  
							
					<div class="widget-data">
						<div class="widget-int num-count"><?php echo $downloaders; ?></div>
						<div class="widget-title"><?php echo $xml->field->download; ?></div>
						<div class="widget-subtitle">
							<?php echo $xml->field->information; ?> 
							<?php echo $xml->label->about; ?> 
							<?php echo $xml->field->download; ?> 
							<?php echo $xml->field->game; ?> 
							<?php echo $game; ?>
						</div>
					</div>
				</div>
				<!-- END WIDGET MESSAGES -->
			</div>

			<div class="col-md-12">
				<?php 
				if (!empty($query_file)):
					if ($query_file->num_rows() > 0): ?>
						<div id="accordion">
				<?php		foreach ($query_file->result_array() as $data):
								if ($data['enabled'] == 0):
				?>	
									<h3 id="head_<?php echo $data['id']; ?>" onclick="playGame('<?php echo $data['id']; ?>','<?php echo $data['file']; ?>')">Versi <?php echo $xml->field->game; ?> <b><?php echo $data['versi']; ?></b></h3>
									<div id="body_<?php echo $data['id']; ?>" style='min-width:800px; min-height:600px;'>
									</div>
				<?php 
								endif;
							endforeach; ?>
						</div>
				<?php
					else:
				?>	
						<div class="widget widget-danger widget-padding-sm">
							<div class="widget-big-int">Oops</div>
							<div class="widget-subtitle">Sorry file not found</div>
						</div>
				<?php
					endif;
				endif;
				?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/game_list.js"></script> 
<script type="text/javascript">
	$("#accordion").accordion();

	function playGame(id, file){
		var url = "Control_game_list/playGame/";
		$('#body_'+id).html("<center><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i></center>");
		$.post(url, { file:file } ,function(data) {
			$('#body_'+id).html(data);
		});
	}
</script>