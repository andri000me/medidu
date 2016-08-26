<script type="text/javascript">
  function btnNotif(id_detail){
    var url     	= "<?php echo site_url('Controller_pesan/pesanRead'); ?>";
    //var id      	= id;
    var id_detail	= id_detail;
    var id_user 	= $("#user").val();

    $('#myModal').fadeIn(400).modal('show');
    $(".modal-title").html("<i class='fa fa-envelope'></i> Read Message");
    //alert(" "+id_detail);
    $(".modal-body").html("<div align='center'><i class='fa fa-spinner fa-spin fa-lg'></i></div>");
    $.ajax({
           type   : "POST",
           url    : url,
           dataType : 'json',
           data   : "value=R&id_detail="+id_detail,
           success: function(res)
           {
            $(".modal-body").html(res.pesan);
           }
    });
  };
</script>

<ul class="menu">
  <?php if (!empty($query)): ?>
    <?php foreach ($query as $row):?>
    	<?php if ($row['pengirim']!=$this->session->userdata('id_user')): ?>
	    <li><!-- start message -->
	      <a href="javascript::;" onclick="btnNotif('<?php echo $row['id']; ?>');">
	        <div class="pull-left">
	          <?php 
	            if (!empty($row['photo'])) {
	          ?>
	          <img src="<?php echo base_url(); ?>file/images/<?php echo $row['photo']; ?>" class="img-circle" alt="User Image" />
	          <?php }else{?>
	          <img src="<?php echo base_url(); ?>file/images/default-photo.png" class="img-circle" alt="User Image" />
	          <?php }?>
	        </div>
	        <h4>
	        <?php echo $row['nama']; ?>
	        <small><i class="fa fa-clock-o"></i> <?php echo $row['tanggal']." - ".$row['waktu']; ?></small>
	        </h4>
	          <p><?php echo substr($row['pesan'], 0, 25) ?> ...</p>
	        </a>
	    </li><!-- end message -->
  	<?php endif; ?>
  <?php endforeach; ?>
  <?php endif; ?>
</ul>