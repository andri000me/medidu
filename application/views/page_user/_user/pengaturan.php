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
    if (!empty($operasi)) {
        $operasi = $operasi;
    }else{
        $operasi = "update";
    }
    if (!empty($query_user)){
        foreach ($query_user->result_array() as $row){
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

    if (!empty($query_setting)){
        foreach ($query_setting->result_array() as $row){
        $notifikasi     = $row['notifikasi'];
        $displayEmail   = $row['display_email'];
        $displayPhone   = $row['display_phone'];
        }
    }else{
        $notifikasi     = "";
        $displayEmail   = "";
        $displayPhone   = "";
    }
?> 
           
<div class="page-title">                    
  <h2><span class="fa fa-list-ol"></span> <?php echo $xml->page; ?> <?php echo $xml->field->level; ?></h2>
</div>
<input type="hidden" value="<?php echo $id; ?>" nama="id" id="id">
<div class="row">

<div class="col-md-8"> 
    <div class="panel panel-default">
        <div class="panel-heading">
        <h3 class="panel-title"><strong>Data</strong> <?php echo $xml->personal; ?></h3>                                   
        <div class="pull-right">                            
            <button class="btn btn-primary" id="btn_save"><span class="fa fa-save"></span> <?php echo $xml->button->save; ?></button>
        </div>
        </div>
          <div class="block">
            <form id="formProfil" role="form" class="form-horizontal" action="javascript:$('#formProfil').submit();">
              <input type="hidden" value="<?php echo $operasi; ?>" id="operasi" name="operasi">
              <input type="hidden" value="<?php echo $id; ?>" id="id" name="id">
              <?php if ($operasi!="delete"): ?>
              <div class="form-group">
                <label class="col-md-3 control-label">
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
                </label>
                <div class="col-md-8">
                  <input type="text" value="<?php echo $nama_depan; ?>" required id="nama_depan" name="nama_depan" class="form-control"/>
                  <span class="help-block">Required</span>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">
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
                </label>
                <div class="col-md-8">
                  <input type="text" class="form-control" required id="nama_belakang" name="nama_belakang" value="<?php echo $nama_belakang; ?>">
                  <span class="help-block">Required</span>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label"><?php echo $xml->gender->title; ?></label>
                <div class="col-md-8">                
                  <label class="check"><input type="radio" <?php echo strtolower($kelamin)=="l"?"checked='true'":""; ?> <?php echo strtolower($kelamin)==""?"checked='true'":""; ?> class="iradio" name="gender" value="L"/> <?php echo $xml->gender->male; ?></label><br>
                  <label class="check"><input type="radio" <?php echo strtolower($kelamin)=="p"?"checked='true'":""; ?> class="iradio" name="gender" value="P"/> <?php echo $xml->gender->female; ?></label><br>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label"><?php echo $xml->phone; ?></label>
                <div class="col-md-8">                
                  <input type="text" class="form-control" required id="telepon" name="telepon" value="<?php echo $telepon; ?>">
                  <span class="help-block">Required</span>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label"><?php echo $xml->field->birthday; ?></label>
                <div class="col-md-8">                
                  <input type="text" class="form-control datepicker" placeholder="YYYY - MM - DD" name="tanggal_lahir" id="tanggal_lahir" required value="<?php echo date_format(date_create($tgl_lahir), 'd F Y'); ?>">
                  <span class="help-block">Required</span>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label"><?php echo $xml->field->address; ?></label>
                <div class="col-md-8">                
                  <textarea class="form-control" required id="alamat" name="alamat" ><?php echo $alamat; ?></textarea>
                  <span class="help-block">Required</span>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label">Email</label>
                <div class="col-md-8">                
                  <input type="email" class="form-control" required name="email" id="email" value="<?php echo $email; ?>">
                  <span class="help-block">Required</span>
                </div>
              </div>
              <?php 
              if (!empty($query_akses) && (strtolower($this->session->userdata("akses")) == "admin")): ?>
              <div class="form-group">
                <label class="col-md-3 control-label"><?php echo $xml->field->access_rule; ?></label>
                <div class="col-md-8"> 
                <select name="akses" class="form-control">
                      <?php foreach ($query_akses->result_array() as $result):
                      ?>
                      <option value="<?php echo $result['id']; ?>" <?php echo $result['id']==$id_akses?"selected='selected'":""; ?>><?php echo $result['akses']; ?></option>
                      <?php
                      endforeach;
                      ?>
                </select>
                </div>
              </div>
              <?php endif; ?>
              <?php else: ?>
                Anda yakin untuk menghapus data <b><?php echo $nama_depan." ".$nama_belakang; ?></b> ?
              <?php endif; ?>
            </form>
          </div>
    </div>
</div>

    <div class="col-md-4">   
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-cogs"></span> <?php echo $xml->button->setting; ?></h3>                                      
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-md-4 control-label text-left"><?php echo $xml->label->notification; ?></label>
                    <div class="col-md-8">
                        <label class="switch switch-small pull-right">
                            <input type="checkbox" class="switch" value="<?php echo $notifikasi; ?>" id="checkNotifikasi" <?php echo $notifikasi==0?"checked='checked'":"" ?> />
                            <span></span>
                        </label>                                            
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-md-4 control-label text-left">Email</label>
                    <div class="col-md-8">
                        <label class="switch switch-small pull-right">
                            <input type="checkbox" class="switch" value="<?php echo $displayEmail; ?>" id="checkEmailDisplay" <?php echo $displayEmail==0?"checked='checked'":"" ?> />
                            <span></span>
                        </label>                                            
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-md-4 control-label text-left"><?php echo $xml->field->phone; ?></label>
                    <div class="col-md-8">
                        <label class="switch switch-small pull-right">
                            <input type="checkbox" class="switch" value="<?php echo $displayPhone; ?>" id="checkPhoneDisplay" <?php echo $displayPhone==0?"checked='checked'":"" ?> />
                            <span></span>
                        </label>                                            
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-md-4 control-label text-left"><?php echo $xml->language; ?></label>
                    <div class="col-md-8">
                        <select id="bahasa" nama="bahasa" class="form-control pull-right" onchange="updateLanguage(<?php echo $id; ?>);">
                            <option value="id" <?php echo $this->session->userdata("language")=="id"?"selected='selected'":"" ?>>Indonesia</option>
                            <option value="en" <?php echo $this->session->userdata("language")=="en"?"selected='selected'":"" ?>>Inggris</option>
                        </select> 
                    </div>
                </div> 
            </div>
        </div> 
    </div>

    <div class="col-md-4">   
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-cogs"></span> <?php echo $xml->button->update." ".$xml->username; ?></h3>                                      
            </div>
            <form id="formUsername" role="form" id="formUsername" class="form-horizontal">
            <?php 
                if (!empty($this->session->userdata("id"))) {
                    if ($this->session->userdata('language') == "id") {
                        $oldUsername = $xml->username.' '.$xml->label->old;
                        $newUsername = $xml->username.' '.$xml->label->new;
                    }else{
                        $oldUsername = $xml->label->old.' '.$xml->username;
                        $newUsername = $xml->label->new.' '.$xml->username;
                    }
                }else{
                    $oldUsername = $xml->username.' '.$xml->label->old;
                    $newUsername = $xml->username.' '.$xml->label->new;
                }
            ?>
              <div class="panel-body">
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="text" class="form-control" placeholder="<?php echo $oldUsername; ?>">                                          
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="text" disabled="true" class="form-control" placeholder="<?php echo $newUsername; ?>">                                          
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-12">
                    <input type="text" disabled="true" class="form-control" placeholder="<?php echo $xml->confirmation; ?>">                                          
                  </div>
                </div>  
              </div>
            </form>
        </div> 
    </div>

    <div class="col-md-4">   
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-cogs"></span> <?php echo $xml->button->update." ".$xml->password; ?></h3>                                      
            </div>
            <?php 
                if (!empty($this->session->userdata("id"))) {
                    if ($this->session->userdata('language') == "id") {
                        $oldPassword = $xml->password.' '.$xml->label->old;
                        $newPassword = $xml->password.' '.$xml->label->new;
                    }else{
                        $oldPassword = $xml->label->old.' '.$xml->password;
                        $newPassword = $xml->label->new.' '.$xml->password;
                    }
                }else{
                    $oldPassword = $xml->password.' '.$xml->label->old;
                    $newPassword = $xml->password.' '.$xml->label->new;
                }
            ?>
            <form role="form" id="formPassword" class="form-horizontal">
            <div class="panel-body">
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="password" class="form-control" placeholder="<?php echo $oldPassword; ?>">                                          
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="password" disabled="true" class="form-control" placeholder="<?php echo $newPassword; ?>">                                          
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="password" disabled="true" class="form-control" placeholder="<?php echo $xml->confirmation; ?>">                                          
                    </div>
                </div>  
            </div>
            </form>
        </div> 
    </div>
</div>
     
<?php $this->load->view('template/plugin/iCheck'); ?>
<?php $this->load->view('template/plugin/dataTables'); ?>
<?php $this->load->view('template/plugin/noty'); ?>
<?php $this->load->view('template/plugin/validationEngine'); ?>
<?php $this->load->view('template/plugin/datepicker'); ?>
<script type="text/javascript" src='<?php echo base_url(); ?>assets/js/user.js'></script>   
<script type="text/javascript">

  $("#btn_save").click(function(){
    $("#formProfil").submit();
  });

  $('.iradio').iCheck({
    checkboxClass: 'icheckbox_flat-red',
    radioClass: 'iradio_flat-red'
  }); 
  
  $("#checkNotifikasi").change(function(){
    var user = new User();
    var notifikasi;
    if($("#checkNotifikasi").is(":checked")){
      $("#checkNotifikasi").val("0");
      notifikasi = "enabled";
    }else{
      $("#checkNotifikasi").val("1");
      notifikasi = "disabled";
    }
    user.setDataUrl("index.php/Control_user/updateItem");   
    user.setDataString("table=tbl_pengaturan&key=id&id="+$("#id").val()+"&value="+$("#checkNotifikasi").val()+"&field=notifikasi");
    user.setDataAlert(" "+notifikasi);
    user.proses("POST", "condition");   
  });

  $("#checkEmailDisplay").change(function(){
    var notifikasi;
    var user = new User();
    if($("#checkEmailDisplay").is(":checked")){
      $("#checkEmailDisplay").val("0");
      notifikasi = "enabled";
    }else{
      $("#checkEmailDisplay").val("1");
      notifikasi = "disabled";
    }
    user.setDataUrl("index.php/Control_user/updateItem");   
    user.setDataString("table=tbl_pengaturan&key=id&id="+$("#id").val()+"&value="+$("#checkEmailDisplay").val()+"&field=display_email");
    user.setDataAlert(" "+notifikasi);
    user.proses("POST", "condition");   
  });

  $("#checkPhoneDisplay").change(function(){
    var notifikasi;
    var user = new User();
    if($("#checkPhoneDisplay").is(":checked")){
      $("#checkPhoneDisplay").val("0");
      notifikasi = "enabled";
    }else{
      $("#checkPhoneDisplay").val("1");
      notifikasi = "disabled";
    }
    user.setDataUrl("index.php/Control_user/updateItem");   
    user.setDataString("table=tbl_pengaturan&key=id&id="+$("#id").val()+"&value="+$("#checkPhoneDisplay").val()+"&field=display_phone");
    user.setDataAlert(" "+notifikasi);
    user.proses("POST", "condition");   
  });

  $("#formProfil").validate({
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

  $("#formProfil").submit(function(e) {
    var user = new User();
    if ($('#formProfil').valid()){
      e.preventDefault();   
      user.setDataUrl("index.php/Control_user/update");      
      user.setDataString($("#formProfil").serialize()+"&table=tbl_user&key=id&id="+$("#id").val());
      user.setDataAlert(" update data");    
      user.proses("POST", "condition");   
    }
  });   

  function updateLanguage(id){   
    var user = new User(); 
    user.setDataUrl("index.php/Control_user/updateSetting");      
    user.setDataString("table=tbl_pengaturan&key=id&id="+$("#id").val()+"&field=bahasa&value="+$("#bahasa").val());    
    user.setDataAlert(" update data, please reload your page for applied settings language"); 
    user.proses("POST", "condition");
  }
</script>