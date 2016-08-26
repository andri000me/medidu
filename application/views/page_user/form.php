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
<style type="text/css">
  #tanggal_lahir
  {
    z-index: 1051;  
  }
</style>
<script type="text/javascript">
  $("#button_update, #button_save, #button_delete").click(function(){
    $("#validate").submit();
  });
</script>
<?php 
  if (!empty($query)){
    foreach ($query as $row){
      $id             = $row['id'];
      $nama_depan     = $row['nama_depan'];
      $nama_belakang  = $row['nama_belakang'];
      $kelamin        = $row['kelamin'];
      $telepon        = $row['telepon'];
      $tgl_lahir      = $row['tgl_lahir'];
      $alamat         = $row['alamat'];
      $email          = $row['email'];
      $id_akses       = $row['id_akses'];
    }
  }else{
    $id             = "";
    $nama_depan     = "";
    $nama_belakang  = "";
    $kelamin        = "";
    $telepon        = "";
    $tgl_lahir      = "";
    $alamat         = "";
    $email          = "";
    $id_akses       = "";
  }
?>
<form id="validate" role="form" class="form-horizontal" action="javascript:$('#validate').submit();">
  <input type="hidden" value="<?php echo $operasi; ?>" id="operasi" name="operasi">
  <input type="hidden" value="<?php echo $id; ?>" id="id" name="id">
  <?php if ($operasi!="delete"): ?>
  <table class="table table-hover">
      <tbody>
        <tr>
          <th>
          <?php
            if (!empty($this->session->userdata("id"))) {
              if ($this->session->userdata('language') == "id") {
                echo $xml->name." ".$xml->first;
              }else{
                echo $xml->first." ".$xml->name;
              }
            }else{
              echo $xml->name." ".$xml->first;
            }
          ?>
          </th>
          <td><input type="text" class="form-control" required id="nama_depan" name="nama_depan" value="<?php echo $nama_depan; ?>"></td>
        </tr>
        <tr>
          <th>
          <?php
            if (!empty($this->session->userdata("id"))) {
              if ($this->session->userdata('language') == "id") {
                echo $xml->name." ".$xml->last;
              }else{
                echo $xml->last." ".$xml->name;
              }
            }else{
              echo $xml->name." ".$xml->last;
            }
          ?>
          </th>
          <td><input type="text" class="form-control" required id="nama_belakang" name="nama_belakang" value="<?php echo $nama_belakang; ?>"></td>
        </tr>
        <tr>
          <th><?php echo $xml->gender->title; ?></th>
          <td>
          <label class="check"><input type="radio" <?php echo strtolower($kelamin)=="l"?"checked='true'":""; ?> <?php echo strtolower($kelamin)==""?"checked='true'":""; ?> class="iradio" name="gender" value="L"/> <?php echo $xml->gender->male; ?></label><br>
          <label class="check"><input type="radio" <?php echo strtolower($kelamin)=="p"?"checked='true'":""; ?> class="iradio" name="gender" value="P"/> <?php echo $xml->gender->female; ?></label><br>
          </td>
        </tr>
        <tr>
          <th><?php echo $xml->phone; ?></th>
          <td><input type="number" class="form-control" required id="telepon" name="telepon" value="<?php echo $telepon; ?>"></td>
        </tr>
        <tr>
          <th><?php echo $xml->field->birthday; ?></th>
          <td><input type="text" class="form-control datepicker" name="tanggal_lahir" id="tanggal_lahir" required value="<?php echo $tgl_lahir; ?>"></td>
        </tr>
        <tr>
          <th><?php echo $xml->field->address; ?></th>
          <td>
          <textarea class="form-control" required id="alamat" name="alamat" ><?php echo $alamat; ?></textarea>
          </td>
        </tr>
        <tr>
          <th>Email</th>
          <td><input type="email" class="form-control" required name="email" id="email" value="<?php echo $email; ?>"></td>
        </tr>
        <tr>
          <th>akses</th>
          <td>
          <select name="akses" class="form-control">
            <?php 
              if (!empty($query_foreign)):
                foreach ($query_foreign->result_array() as $result):
                ?>
                <option value="<?php echo $result['id']; ?>" <?php echo $result['id']==$id_akses?"selected='selected'":""; ?>><?php echo $result['akses']; ?></option>
                <?php
                endforeach;
              endif;
            ?>
          </select>
          </td>
        </tr>
      </tbody>
  </table>
  <?php else: ?>
    Anda yakin untuk menghapus data <b><?php echo $nama_depan." ".$nama_belakang; ?></b> ?
  <?php endif; ?>
</form>
     
<?php $this->load->view('template/plugin/iCheck'); ?>
<?php $this->load->view('template/plugin/noty'); ?>
<?php $this->load->view('template/plugin/validationEngine'); ?>  
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins.js"></script>  
<script type="text/javascript" src='<?php echo base_url(); ?>assets/js/user.js'></script>   
<script type="text/javascript">  
  $("#validate").validate({
    ignore: [],
      rules: {
      nama_depan: {
        required: true
      },
      nama_belakang: {
        required: true
      },
      telepon: {
        required: true
      },
      tanggal_lahir: {
        required: true
      },
      alamat: {
        required: true
      },
      email: {
        required: true
      }
    }                                    
  });   

  $('.iradio').iCheck({
    checkboxClass: 'icheckbox_flat-red',
    radioClass: 'iradio_flat-red'
  }); 

  $("#validate").submit(function(e) {
    var user = new User();
    if ($('#validate').valid()){
      e.preventDefault();

      if($("#operasi").val() == "create"){
        user.setDataUrl("index.php/Control_user/insert");      
        user.setDataString($("#validate").serialize()+"&table=tbl_user");    
        user.setDataAlert(" saved data");    
      }else if($("#operasi").val() == "update"){      
        user.setDataUrl("index.php/Control_user/update");      
        user.setDataString($("#validate").serialize()+"&table=tbl_user&key=id");
        user.setDataAlert(" update data");    
      }else if($("#operasi").val() == "delete"){
        user.setDataUrl("index.php/Control_user/delete");      
        user.setDataString($("#validate").serialize()+"&table=tbl_user&key=id");    
        user.setDataAlert(" deleted data");    
      }
      user.proses("POST", "proses");   
    }
  });   
</script>