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
	$count = $query->num_rows();
	$x = 0;
	foreach ($query->result_array() as $data):
		?>
			<input type="hidden" value="<?php echo $data['game']; ?>" id="game_<?php echo $x; ?>">
			<input type="hidden" value="<?php echo $data['viewers']; ?>" id="viewers_<?php echo $x; ?>">
			<input type="hidden" value="<?php echo $data['likes']; ?>" id="likes_<?php echo $x; ?>">
			<input type="hidden" value="<?php echo $data['download']; ?>" id="downloaders_<?php echo $x; ?>">
		<?php
		$x++;
	endforeach;
?>
  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>"> <?php echo $xml->label->home; ?></a></li>                    
    <li class="active"><?php echo $xml->page; ?> <?php echo $xml->label->chart." ".$xml->field->game; ?></li>
  </ul>
  <!-- END BREADCRUMB -->                
                
  <div class="page-title">                    
    <h2><span class="fa fa-chart-o"></span> <?php echo $xml->label->chart; ?> <?php echo $xml->field->game; ?></h2>
  </div> 

  	<div class="page-content-wrap">
		<div class="row">
			<div class="col-md-12">

				<!-- START BAR CHART -->
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Bar Chart</h3>                                
					</div>
					<div class="panel-body">
						<div id="morris-bar-example" style="height: auto;"></div>
					</div>
				</div>
				<!-- END BAR CHART -->

			</div>
		</div>
                    
	</div>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/morris/raphael-min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/morris/morris.min.js"></script>
<script type="text/javascript">
	var count = <?php echo $count; ?>;
	var morrisCharts = function() {

		var myData = new Array();
		for (var i=0; i < count; i++) {
			myData[i] = { label:$("#game_"+i).val(), viewers:$("#viewers_"+i).val(), likes:$("#likes_"+i).val(), downloaders:$("#downloaders_"+i).val(), };
		};
		Morris.Bar({
			element: 'morris-bar-example',
			data: myData,
			xkey: 'label',
			ykeys: ['viewers', 'likes', 'downloaders'],
			labels: ['Viewers', 'Likes', 'Downloaders'],
			barColors: ['#B64645', '#3D63A0', '#B5B645']
		});

	}();
</script>