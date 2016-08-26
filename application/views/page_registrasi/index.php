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
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
  <li><a href="<?php echo base_url(); ?>">Home</a></li>
  <li class="active"><a href="javascript::;"><?php echo $xml->registrasi; ?></a></li>
</ul>
<!-- END BREADCRUMB -->

<div class="row">
  <div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><strong><?php echo $xml->page; ?></strong> <?php echo $xml->registrasi; ?></h3>
      <ul class="panel-controls">
        <li><a href="javascript::;" class="panel-remove"><span class="fa fa-times"></span></a></li>
      </ul>
    </div>
  <div class="panel-body">                                
      <form action="javascript:cekForm();" role="form" class="form-horizontal" id="wizard-validation">
        <div class="wizard show-submit wizard-validation">
          <ul>
            <li>
              <a href="#step-1">
                <span class="stepNumber">1</span>
                <span class="stepDesc">Data<br /><small><?php echo strtoupper(substr($xml->user, 0, 1))."".substr($xml->user, 1); ?></small></span>
              </a>
            </li>
            <li>
              <a href="#step-2">
                <span class="stepNumber">2</span>
                <span class="stepDesc">Data<br /><small><?php echo strtoupper(substr($xml->personal, 0, 1))."".substr($xml->personal, 1); ?></small></span>
              </a>
            </li>     
            <li>
              <a href="#step-3">
                <span class="stepNumber">3</span>
                <span class="stepDesc">Data<br /><small>Verification</small></span>
              </a>
            </li>                                    
          </ul>
          <div id="step-1">   
            <div class="form-group">
              <label class="col-md-2 control-label"><?php echo $xml->username; ?></label>
              <div style="display:inline;" >
                <div class="col-md-8">
                  <input type="text" class="form-control" name="username" id="username" required minlength="6" />
                  <span class="help-block">Required, min char = 6</span>
                </div>
                <div class="col-md-1">
                  <span class="label label-danger label-form"><div id="messageErrorUsername"><i class='fa fa-user'></i></div></span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 control-label"><?php echo strtoupper(substr($xml->password, 0, 1))."".substr($xml->password, 1); ?></label>
              <div class="col-md-8">
                <input type="password" required minlength="8" class="form-control" name="password" placeholder="<?php echo strtoupper(substr($xml->password, 0, 1))."".substr($xml->password, 1); ?>" id="password"/>
              </div>
            </div>  

            <div class="form-group">
              <label class="col-md-2 control-label"><?php echo $xml->confirmation; ?> <?php echo $xml->password; ?></label>
              <div class="col-md-8">
                <input type="password" class="form-control" name="repassword" id="repassword" placeholder="<?php echo $xml->confirmation; ?> <?php echo $xml->password; ?>"/>
              </div>
            </div>  

            <div class="form-group">
              <label class="col-md-2 control-label"><?php echo $xml->show; ?> <?php echo $xml->password; ?></label>
              <div class="col-md-8">
                <label class="switch switch-medium">
                  <input type="checkbox" id="showPass" />
                  <span></span>
                </label>  
              </div>
            </div>
          </div>

          <div id="step-2">
            <div class="form-group">
              <label class="col-md-2 control-label"><?php echo $xml->name; ?> <?php echo $xml->first; ?></label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="nama_depan" id="nama_depan" required placeholder="<?php echo $xml->name; ?> <?php echo $xml->first; ?>"/>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label"><?php echo $xml->name; ?> <?php echo $xml->last; ?></label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="nama_belakang" id="nama_belakang" required placeholder="<?php echo $xml->name; ?> <?php echo $xml->last; ?>"/>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label"><?php echo $xml->gender->title; ?></label>
              <div class="col-md-8">
                <label class="check"><input type="radio" class="iradio" name="gender" value="L" checked="true" /> <?php echo $xml->gender->male; ?></label><br>
                <label class="check"><input type="radio" class="iradio" name="gender" value="P" /> <?php echo $xml->gender->female; ?></label>
              </div>
            </div>    

            <div class="form-group">
              <label class="col-md-2 control-label"><?php echo $xml->phone; ?></label>
              <div class="col-md-8">
                <input type="number" class="form-control" name="telepon" id="telepon" required />
              </div>
            </div>   

            <div class="form-group">
              <label class="col-md-2 control-label"><?php echo $xml->birthday->date; ?></label>
              <div class="col-md-8">
                <input type="text" class="form-control datepicker" name="tanggal_lahir" id="tanggal_lahir" placeholder="YYYY - MM - DD"  required/>
              </div>
            </div>   

            <div class="form-group">
              <label class="col-md-2 control-label">E-mail</label>
              <div style="display:inline;" >
                <div class="col-md-8">
                  <input type="email" class="form-control" required name="email" id="email" placeholder="E-mail"/>
                </div>
                <div class="col-md-1">
                  <span class="label label-danger label-form"><div id="messageErrorEmail"><i class='fa fa-envelope'></i></div></span>
                </div>
              </div>
            </div> 

            <div class="form-group">
              <label class="col-md-2 control-label"><?php echo $xml->address; ?></label>
              <div class="col-md-8">
                <textarea class="form-control" name="alamat" required id="alamat" placeholder="<?php echo $xml->address; ?>"></textarea>
              </div>                                        
            </div>    
          </div>     

          <div id="step-3">   
            <p>
              <?php echo $xml->privacy->line_1; ?>
            </p>
             <p>
              <?php echo $xml->privacy->line_2; ?>
            </p>

            <div class="form-group">
              <div class="col-md-8">
                <label class="check"><input type="checkbox" class="iradio" id="agree" /> <?php echo $xml->agree; ?></label><br>
              </div>
            </div>
          </div>                                                                                                       
        </div>                        
      </form>
      </div>
    </div> 
  </div>
</div>
                           
  <!-- warning -->
  <div class="message-box message-box-warning animated fadeIn" id="message-box-warning">
    <div class="mb-container">

      <div id="error_available" style="display:none;">
        <div class="mb-middle">
          <div class="mb-title"><span class="fa fa-warning"></span> 
            <?php echo $xml->alert->error_email_user; ?>
          </div>
          <div class="mb-content">
          <p>
            <?php echo $xml->alert->error_available; ?>
          </p>                  
          </div>
          <div class="mb-footer">
            <button class="btn btn-default btn-lg pull-right message_close">Close</button>
          </div>
        </div>
      </div>

      <div id="error_agree" style="display:none;">
        <div class="mb-middle">
          <div class="mb-title"><span class="fa fa-warning"></span> 
            <?php echo $xml->alert->error_agree; ?>
          </div>
          <div class="mb-content">
          <p>
            <?php echo $xml->privacy->line_2; ?>
          </p>                  
          </div>
          <div class="mb-footer">
            <button class="btn btn-default btn-lg pull-right message_close">Close</button>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- end danger -->   

<!-- THIS PAGE PLUGINS -->    

<?php $this->load->view('template/plugin/iCheck'); ?>
<?php $this->load->view('template/plugin/noty'); ?>
<?php $this->load->view('template/plugin/validationEngine'); ?> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/joli/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>
<?php $this->load->view('template/plugin/datepicker'); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/registrasi.js"></script>     
<script type="text/javascript">  
  $('.iradio').iCheck({
    checkboxClass: 'icheckbox_flat-red',
    radioClass: 'iradio_flat-red'
  }); 
</script>   
