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
  if (!empty($this->session->userdata("id"))) {
    if ($this->session->userdata('language') == "id") {
      $label_tanggal_lahir = $xml->birthday->date." ".$xml->birthday->birth;
    }else{
      $label_tanggal_lahir = $xml->birthday->birth." ".$xml->birthday->date;
    }
  }else{
    $label_tanggal_lahir = $xml->birthday->date." ".$xml->birthday->birth;
  }
?>

  <style type="text/css">
    #content_inti{
      height: 100%;
      min-height: 100%;
    }
  </style>
  <script type="text/javascript">    
    $('#content_inti').css({ height: $(window).innerHeight() });

    $(window).resize(function(){
      $('#content_inti').css({ height: $(window).innerHeight() });
  });
  </script>
  
  <!-- START BREADCRUMB -->
  <ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>"> <?php echo $xml->label->home; ?></a></li>                    
    <li class="active"><?php echo $xml->page; ?> <?php echo $xml->user; ?></li>
  </ul>
  <!-- END BREADCRUMB -->                
                
  <div class="page-title">                    
    <h2><span class="fa fa-users"></span> <?php echo $xml->page; ?> <?php echo $xml->user; ?></h2>
  </div>                   
                
  <!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">                
  <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Data</h3>

              <div class="btn-group pull-right">
                <button class="btn btn-primary" onclick="openFormUser('create', '0');"><i class="fa fa-plus"></i> <?php echo $xml->button->add; ?> Data</button>
                <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button> 
                  <ul class="dropdown-menu">
                    <li><a href="javascript:;" onClick ="$('#example').tableExport({type:'pdf',escape:'false'});"><img src='<?php echo base_url(); ?>file/images/icon/Adobe Acrobat Reader.png' width="24"/> XLS</a></li>
                    <li class="divider"></li>
                    <li><a href="javascript:;" onClick ="$('#example').tableExport({type:'excel',escape:'false'});"><img src='<?php echo base_url(); ?>file/images/icon/Excel alt 1.png' width="24"/> XLS</a></li>
                    <li><a href="javascript:;" onClick ="$('#example').tableExport({type:'doc',escape:'false'});"><img src='<?php echo base_url(); ?>file/images/icon/Word alt 1.png' width="24"/> Word</a></li>
                    <li class="divider"></li>
                  </ul>
              </div>
          </div>

          <div class="panel-body">
            <div class="col-md-12">
            <table id="example" class="display" width="100%">
              <thead>
                <tr>
                  <th>NO</th>
                  <th><?php echo $xml->name; ?></th>
                  <th><?php echo $xml->gender->title; ?></th>
                  <th><?php echo $xml->phone; ?></th>
                  <th><?php echo $label_tanggal_lahir; ?></th>
                  <th><?php echo $xml->address; ?></th>
                  <th>Menu</th>
                </tr>
              </thead>

              <tfoot>
                <tr>
                  <th>NO</th>
                  <th><?php echo $xml->name; ?></th>
                  <th><?php echo $xml->gender->title; ?></th>
                  <th><?php echo $xml->phone; ?></th>
                  <th><?php echo $label_tanggal_lahir; ?></th>
                  <th><?php echo $xml->address; ?></th>
                  <th>Menu</th>
                </tr>
              </tfoot>

              <tbody>
              <?php 
              if (!empty($query)):
                $x = 1;
                foreach ($query->result_array() as $row):
              ?>
                <tr>
                  <td><?php echo $x; ?></td>
                  <td><?php echo $row['nama_depan']." ".$row['nama_belakang']; ?></td>
                  <td>
                  <?php 
                    if (strtolower($row['kelamin']) == "l") {
                      echo $xml->gender->male;
                    }else{
                      echo $xml->gender->female;                      
                    }
                  ?>
                  </td>
                  <td><?php echo $row['telepon']; ?></td>
                  <td><?php echo date_format(date_create($row['tgl_lahir']), 'd F Y'); ?></td>
                  <td>
                  <?php 
                    if (strlen($row['alamat']) > 30) {
                      echo substr($row['alamat'], 0, 30)." ...";
                    }else{
                      echo $row['alamat'];                      
                    }
                  ?>
                  </td>
                  <td>                                                                                                                     
                    <div class="btn-group btn-group-sm">
                      <button class="btn btn-default" onclick="openDetailUser(<?php echo $row['id']; ?>);" data-toggle="tooltip" data-placement="bottom" title="<?php echo $xml->button->view; ?>"><i class="fa fa-eye"></i></button>
                      <button class="btn btn-default" onclick="openFormUser('update', <?php echo $row['id']; ?>);" data-toggle="tooltip" data-placement="bottom" title="<?php echo $xml->button->update; ?>"><i class="fa fa-pencil"></i></button>                                                
                      <button class="btn btn-default" onclick="openFormUser('delete', <?php echo $row['id']; ?>);" data-toggle="tooltip" data-placement="bottom" title="<?php echo $xml->button->delete; ?>"><i class="fa fa-trash-o"></i></button>                                        
                    </div> 
                  </td>
                </tr>
              <?php 
                $x++;
                endforeach;
              endif;
              ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
     
<?php $this->load->view('template/plugin/iCheck'); ?>
<?php $this->load->view('template/plugin/tableexport'); ?>
<?php $this->load->view('template/plugin/dataTables'); ?>
<?php $this->load->view('template/plugin/noty'); ?>
<?php $this->load->view('template/plugin/AutoPlugin'); ?>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/user.js"></script>
<script type="text/javascript">  

  $("#tanggal_lahir").datepicker({
    inline: false
  });
  
  function openDetailUser(id)
  {
    var user = new User();
    hideAll();
    user.setDataUrl("Control_main/openDetail/");
    user.setDataLink(id, "tbl_user", "id", "user", "", "");
    user.getPage("Detail", "md");
  }
  
  function openFormUser(operasi, id)
  { 
    var user = new User();
    hideAll();
    user.setDataUrl("Control_main/openFormulir/");
    user.setDataLink(id, "tbl_user", "id", "user", operasi, "tbl_akses");
    user.getPage("Form", "md");
  }
</script>