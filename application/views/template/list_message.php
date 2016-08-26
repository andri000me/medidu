<script type="text/javascript">
	function updateRead(id_head){
		var url = "<?php echo base_url(); ?>Control_message/updateRead/";
        $.post(url, { id:id_head },
        function(result){
        });
	}
</script>
<div class="panel-body list-group list-group-contacts scroll" style="height: 200px;">
	<?php 
	if (!empty($query_head)):
		$x = 0;
		foreach ($query_head->result_array() as $data): 
			if ($x < 5): ?>
			<a href="<?php echo base_url(); ?>Control_message/openMessage/<?php echo $data['id_head']; ?>" onclick="updateRead('<?php echo $data['id_head']; ?>');" class="list-group-item ajaxMessage">
				<div class="list-group-status status-online"></div>
				<img src="<?php base_url(); ?>file/images/users/<?php echo $data['poto_profil']; ?>" class="pull-left" alt="<?php echo $data['nama_depan']; ?>"/>
				<span class="contacts-title"><?php echo $data['nama_depan']; ?></span>
				<p>
					<?php 
						if (strlen($data['pesan'])> 50) {
							echo substr($data['pesan'], 0, 50)." ..."; 
						}else{
							echo $data['pesan']; 
						}
					?>
				</p>
			</a>
	<?php
			$x++;
			endif;
		endforeach;
	endif;
	?>
</div> 
<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/message.js'></script>