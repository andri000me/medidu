<script type="text/javascript">
  function btnNotif(id){
    var url     = "<?php echo site_url('Controller_history/insertRead'); ?>";
    var id      = id;
    var id_user = $("#user").val();

    $('#myModal').fadeIn(400).modal('show');
    $(".modal-title").html("<i class='fa fa-archive'></i> Read Notifikasi");
    //alert(id+" "+id_user);
    $(".modal-body").html("<div align='center'><i class='fa fa-spinner fa-spin fa-lg'></i></div>");
    $.ajax({
           type   : "POST",
           url    : url,
           dataType : 'json',
           data   : "id_history="+id+"&id_user="+id_user,
           success: function(res)
           {
            $(".modal-body").html(res.nama+" "+res.keterangan);
           }
    });
  };
</script>

<ul class="menu">
  <?php 
  if (!empty($query)) {
    $x = 0;
    foreach ($query as $row):
      if ($row['type']=="departemen") { $icon = "fa-building"; }
      if ($row['type']=="level") { $icon = "fa-sort-amount-asc"; }
      if ($row['type']=="klasifikasi") { $icon = "fa-th"; }
      if ($row['type']=="barang") { $icon = "fa-cubes"; }
      if ($row['type']=="satuan") { $icon = "fa-archive"; }
      if ($row['type']=="proyek") { $icon = "fa-file"; }

      $warna = "text-aqua";
      /*
      if ($x<$count) {
        $warna = "text-aqua";
      }else{
        $warna = "text-black";
      }
      */
      if ($x<5) {
  ?>
        <li>
          <a href="javascript::;" onclick="btnNotif(<?php echo $row['id']; ?>);">
            <i class="fa <?php echo $icon; ?> <?php echo $warna; ?>"></i> <?php echo $row['keterangan'];?>
          </a>
        </li>
  <?php 
      }
    $x++;
    endforeach;
  } ?>
</ul>