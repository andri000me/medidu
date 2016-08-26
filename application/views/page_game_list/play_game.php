<div class="col-md-12">
	<embed style="min-height:400px; min-width:800px;" src="<?php echo base_url(); ?>file/games/<?php echo $file; ?>">
</div>
<p>
	<?php echo $deskripsi; ?>
</p>
<a href="<?php echo base_url(); ?>Control_game_list/downloadGame/<?php echo $file; ?>" class="ajax">Download .SWF</a>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/game_list.js"></script> 
<script type="text/javascript">
	function downloadGame(file){
		var url = "Control_game_list/downloadGame/";
		$.post(url, { file:file } ,function(data) {
		});
	}
</script>