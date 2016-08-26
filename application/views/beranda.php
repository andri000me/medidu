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
    #content_timeline{
        height: 100%;
        min-height: 100%;
    }
    .content-frame-body{
        height: 100%;
        min-height: 100%;
    }
</style>
<script type="text/javascript">    
    /*$('#content_timeline, .content-frame-body').css({ height: $(window).innerHeight() });
      
    $(window).resize(function(){
        $('#content_timeline, .content-frame-body').css({ height: $(window).innerHeight() });
    });*/
</script>
<script type="text/javascript">
   
</script>
<!-- START BREADCRUMB -->
          <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><?php echo $xml->label->home; ?></a></li>
          </ul>
          <!-- END BREADCRUMB -->                
                
          <div class="page-title">                    
            <h2><span class="glyphicon glyphicon-home"></span> <?php echo $xml->page." ".$xml->label->home; ?></h2>
          </div>                   
                
          <!-- PAGE CONTENT WRAPPER -->
          <div class="page-content-wrap">                
            <div class="row">
              <div class="col-md-8">
                <div class="content-frame-body" style="min-height:500px; height:500px;"> 
                    <div id="loadPageEfek" align="center" style="display:none;"><span class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></span></div>
                    <div id="content_timeline" style="min-height:500px; height:500px;"></div>
                    <!-- END TIMELINE -->        
                </div>
              </div>
              <div class="col-md-4">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="panel-title-box">
                      <h3><?php echo $xml->label->rank; ?></h3>
                      <span>
                        <?php 
                          if (!empty($this->session->userdata("id"))) {
                            if ($this->session->userdata('language') == "id") {
                              echo "5 ".$xml->label->player." ".$xml->label->best;
                            }else{
                              echo "5 ".$xml->label->best." ".$xml->label->player;
                            } 
                          }else{
                            echo "5 ".$xml->label->player." ".$xml->label->best;
                          }
                        ?>
                      </span>
                    </div>                                    
                    <ul class="panel-controls" style="margin-top: 2px;">
                      <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                      <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>                                   
                    </ul>
                    </div>
                    <div class="panel-body panel-body-table">
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th width="10%">No</th>
                            <th width="60%"><?php echo $xml->field->name; ?></th>
                            <th width="30%"><?php echo $xml->field->score; ?></th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (!empty($query_rank)):
                          $x = 0;
                          foreach ($query_rank->result_array() as $data):
                            if ($x<5):
                        ?>
                            <tr>
                              <td><?php echo $x+1; ?></td>
                              <td><strong><?php echo $data['nama_depan']." ".$data['nama_belakang']; ?></strong></td>
                              <td><?php echo $data['total_skor']; ?></td>
                            </tr>
                        <?php
                            $x++;
                            endif;
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

<script type="text/javascript">  
        /*$('#content_timeline').slimScroll({
            color: '#7A7A7A',
            size: '5px',
            height: 'auto',
            alwaysVisible: true
        });*/
</script>