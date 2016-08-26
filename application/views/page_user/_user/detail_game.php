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

                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">                
                
                    <div class="row">
                        <div class="col-md-12">

                            <!-- DEFAULT LIST GROUP -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Grafik</h3>
                                </div>
                                <div class="panel-body">   
                                    <ul class="list-group border-bottom">

                                    <?php 
                                        if (!empty($query_grafik)):
                                            $x = 0;
                                            foreach ($query_grafik->result_array() as $data):
                                                if ($x<5):
                                                    $totalskor  = $data['total_skor']/$data['count_skor'];
                                                    $persentasi = $totalskor/100*100;
                                        ?>
                                                    <li class="list-group-item">
                                                    <p>Playing the game <?php echo $data['count_skor']; ?> at <?php echo date_format(date_create($data['tanggal']), 'd F Y'); ?> <code><?php echo $persentasi; ?>%</code></p>
                                                        <div class="progress progress-small">
                                                            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $persentasi/2; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $persentasi; ?>%;">
                                                            </div>
                                                        </div>
                                                    </li>
                                        <?php
                                                    $x++;
                                                endif;
                                            endforeach;
                                        endif;
                                    ?>
                                    </ul>                                          
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">

                            <!-- DEFAULT LIST GROUP -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Log Score</h3>
                                </div>
                                <div class="panel-body">
                                    <p><code>.History</code> score list</p>
                                    <table id="example" class="display" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th><?php echo $xml->field->score; ?></th>
                                                <th><?php echo $xml->birthday->date; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            if (!empty($query_skor)):
                                                $x = 1;
                                                foreach ($query_skor->result_array() as $data):
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $x; ?></td>
                                                        <td><?php echo $data['skor']; ?></td>
                                                        <td><?php echo date_format(date_create($data['tanggal']), 'd F Y'); ?></td>
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
<?php $this->load->view('template/plugin/dataTables'); ?>
<?php $this->load->view('template/plugin/noty'); ?>
<script type="text/javascript" src='<?php echo base_url(); ?>assets/js/user.js'></script>   
