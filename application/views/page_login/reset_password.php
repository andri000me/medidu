<script type="text/javascript">
  $("#button_reset").click(function(){
    $("#myForm").submit();
  });

  function resetPassword(){
    
  };
</script>
<form id="myForm" action="resetPassword()" class="form-horizontal form-label-left input_mask" >
  <div class="panel-body">
    Cara mendapatkan password anda : 
    <ul>
      <li>
        Untuk mendapatkan password anda kami membutuhkan email yang berhubungan dengan anda, password akan dikirim melalui email 
        , hal ini dilakukan agar akun anda tetap aman.
      </li>
      <li>
        Selain melalui email anda juga dapat memverifikasi password anda melalui notifikasi pesan SMS
      </li>
      <li>
        Anda dapat mendapatkan password apabila anda telah terdaftar sebagai pengguna disitus kami 
      </li>
    </ul>

    <div class="col-md-12">
      <input type="text" class="form-control" id="email" name="email" placeholder="Kirim melalui Email">
      <!--
      <div class="input-group">
        <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Kirim melalui Telepon">
        <span class="input-group-btn">
          <button type="button" id="btnTelepon" class="btn btn-default"><i class="fa fa-phone"></i></button>
        </span>
      </div>-->
    </div> 
  </div> 
</form>

<script type='text/javascript' src='<?php echo base_url(); ?>assets/template/joli/js/plugins/jquery-validation/jquery.validate.js'></script>   

<script type="text/javascript">
  var jvalidate = $("#myForm").validate({
    ignore: [],
      rules: {                                            
        email: {
          required: true,
        }
      }                                        
  });                                    
 </script>
