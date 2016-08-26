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
<link href="<?php echo base_url(); ?>assets/template/joli/js/plugins/icheck/skins/flat/red.css" rel="stylesheet">
<script type="text/javascript">
  $("#button_update, #button_save, #button_delete").click(function(){
    $("#formSoal").submit();
  });
</script>
<?php 

  if ($operasi == "create") {
    $id_game    = $id;
    $soal       = "";
    $jawaban_a  = "";
    $jawaban_b  = "";
    $jawaban_c  = "";
    $enabled    = "";
    $exp        = "";
  }elseif (!empty($query)){
    foreach ($query->result_array() as $row){
      $soal       = $row['soal'];
      $jawaban_a  = $row['jawaban_a'];
      $jawaban_b  = $row['jawaban_b'];
      $jawaban_c  = $row['jawaban_c'];
      $id_game    = $row['id_game'];
      $enabled    = $row['enabled'];
      $exp        = $row['exp'];
    }
  }else{
      $soal       = "";
      $jawaban_a  = "";
      $jawaban_b  = "";
      $jawaban_c  = "";
      $enabled    = "";
      $exp        = "";
  }
?>
<form id="formSoal" role="form" class="form-horizontal" action="javascript:$('#formSoal').submit();">
  <input type="hidden" value="<?php echo $operasi; ?>" id="operasi" name="operasi">
  <input type="hidden" value="<?php echo $id; ?>" id="id" name="id">
  <input type="hidden" value="<?php echo $id_game; ?>" id="id_game" name="id_game">
  <input type="hidden" value="<?php echo $enabled; ?>" id="enabledSoal" name="enabled">
  <?php if ($operasi!="delete"): ?>
  <table class="table table-hover">
      <tbody>
        <tr>
          <th><?php echo $xml->field->question; ?></th>
          <td><textarea class="form-control" required id="soal" name="soal"><?php echo $soal; ?></textarea></td>
        </tr>
        <tr>
          <th><?php echo $xml->field->answer; ?> A</th>
          <td><textarea class="form-control" required id="jawaban_a" name="jawaban_a" ><?php echo $jawaban_a; ?></textarea></td>
        </tr>
        <tr>
          <th><?php echo $xml->field->answer; ?> B</th>
          <td><textarea class="form-control" required id="jawaban_b" name="jawaban_b" ><?php echo $jawaban_b; ?></textarea></td>
        </tr>
        <tr>
          <th><?php echo $xml->field->answer; ?> C</th>
          <td><textarea class="form-control" required id="jawaban_c" name="jawaban_c" ><?php echo $jawaban_c; ?></textarea></td>
        </tr>
        <tr>
          <th>Experience</th>
          <td><input type="number" class="form-control" required id="exp" name="exp" value="<?php echo intval($exp); ?>"></td>
        </tr>
        <tr>
          <th><?php echo $xml->field->condition; ?></th>
          <td>           
            <label class="switch switch-small">
              <input type="checkbox" id="setEnabledSoal" <?php echo $enabled==0?"checked='checked'":"" ?> />
              <span></span>
            </label> 
          </td>
        </tr>
      </tbody>
  </table>
  <?php else: ?>
    Anda yakin untuk menghapus data <b><?php echo $soal; ?></b> ?
  <?php endif; ?>
</form>
     
<script type='text/javascript' src='<?php echo base_url(); ?>assets/template/joli/js/plugins/noty/jquery.noty.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/template/joli/js/plugins/noty/layouts/topCenter.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/template/joli/js/plugins/noty/layouts/topLeft.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/template/joli/js/plugins/noty/layouts/topRight.js'></script>            
<script type='text/javascript' src='<?php echo base_url(); ?>assets/template/joli/js/plugins/noty/themes/default.js'></script>
           
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/bootstrap_2/bootstrap-datepicker.js"></script>

<script src="<?php echo base_url(); ?>assets/template/joli/js/plugins/icheck/icheck.js"></script>
<script type="text/javascript" src='<?php echo base_url(); ?>assets/template/joli/js/plugins/jquery-validation/jquery.validate.js'></script>   
<script type="text/javascript" src='<?php echo base_url(); ?>assets/js/game.js'></script> 
<script type="text/javascript">  
  $("#formSoal").validate({
    ignore: [],
    rules: { 
      soal: {
        required: true
      },
      jawaban_a: {
        required: true
      },
      jawaban_b: {
        required: true
      },
      jawaban_c: {
        required: true
      },
      jawaban_d: {
        required: true
      }
    }
  });

  $('#setEnabledSoal').click(function(){
    if($('#setEnabledSoal').is(":checked")){
      $('#enabledSoal').val("0");
    }else{    
      $('#enabledSoal').val("1");
    }
  }); 

  $("#formSoal").submit(function(e) {
    if ($('#formSoal').valid()){
      e.preventDefault();

      if($("#operasi").val() == "create"){
        game.setDataUrl("index.php/Control_soal/insert");      
        game.setDataString($("#formSoal").serialize()+"&table=tbl_soal");    
        game.setDataAlert(" saved data");    
      }else if($("#operasi").val() == "update"){      
        game.setDataUrl("index.php/Control_soal/update");      
        game.setDataString($("#formSoal").serialize()+"&table=tbl_soal&key=id");
        game.setDataAlert(" update data");    
      }else if($("#operasi").val() == "delete"){
        game.setDataUrl("index.php/Control_soal/delete");      
        game.setDataString($("#formSoal").serialize()+"&table=tbl_soal&key=id");    
        game.setDataAlert(" deleted data");    
      }
      game.setIdGame($("#id_game").val());
      game.proses("POST", "formSoal");   
    }
  });
</script>
