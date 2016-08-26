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
<!-- main sidebar -->    
    <div class="page-sidebar">
        <!-- START X-NAVIGATION -->
        <ul class="x-navigation">
          <li class="xn-logo">
            <a href="<?php echo base_url(); ?>">Medidu</a>
            <a href="#" class="x-navigation-control"></a>
          </li>               
          <?php 
          if (empty($this->session->userdata("id"))):
          ?>                                   
          <li class="xn-title">Navigation</li>                   
          <li>
              <a href="<?php echo base_url(); ?>"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
          </li> 
          <li>
            <a href="<?php echo site_url('Control_main/openPage/game_list'); ?>" class="ajax">
              <span class="fa fa-gamepad"></span> <span class="xn-text"><?php echo $xml->field->game; ?></span>
            </a>
          </li> 
          <?php 
          else: ?>
          <?php 
            if (!empty($this->session->userdata("photo"))) {
              if ($this->session->userdata("photo") != "default-p.png") {
                $photo = "thumbs_".$this->session->userdata("photo");
              }else{
                $photo = $this->session->userdata("photo");
              }
            }else if(empty($this->session->userdata("photo"))){
              $photo = "default-p.png";
            }else{
              $photo = "default-p.png";
            }
          ?>
          <li class="xn-profile">
            <a href="javascript:;" class="profile-mini">
              <img src="<?php echo base_url(); ?>file/images/users/<?php echo $photo; ?>" alt="<?php echo $this->session->userdata("nama_depan"); ?>"/>
            </a>
              <div class="profile">
                  <div class="profile-image">  
                    <img src="<?php echo base_url(); ?>file/images/users/<?php echo $photo; ?>" alt="<?php echo $this->session->userdata("nama_depan"); ?>"/>
                  </div>
                  <div class="profile-data">
                      <div class="profile-data-name"><?php echo $this->session->userdata("nama_depan"); ?></div>
                      <div class="profile-data-title"><?php echo $this->session->userdata("akses"); ?></div>
                  </div>
                  <div class="profile-controls">
                      <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
                      <a href="<?php echo site_url('Control_main/openPage/message'); ?>" class="profile-control-right ajax"><span class="fa fa-envelope"></span></a>
                  </div>
              </div>                                                                        
          </li>                                    
          <li class="xn-title">Navigation</li>                   
          <li>
              <a href="<?php echo base_url(); ?>"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
          </li> 

            <?php if (strtolower($this->session->userdata("akses")) == "admin"): ?>
              <li class="xn-openable">
                  <a href="#"><span class="fa fa-bars"></span> <span class="xn-text">Data Master</span></a>
                  <ul>
                    <li>
                      <a href="<?php echo site_url('Control_main/openPage/user'); ?>" class="ajax">
                        <span class="fa fa-users"></span> <?php echo $xml->menu_side->manage_user; ?>
                      </a>
                    </li> 
                    <li>
                      <a href="<?php echo site_url('Control_main/openPage/game'); ?>" class="ajax">
                        <span class="fa fa-gamepad"></span> <?php echo $xml->menu_side->manage_game; ?>
                      </a>
                    </li> 
                    <li>
                      <a href="<?php echo site_url('Control_main/openPage/genre'); ?>" class="ajax">
                        <span class="fa fa-tags"></span> <?php echo $xml->menu_side->manage_genre; ?>
                      </a>
                    </li> 
                    <li>
                      <a href="<?php echo site_url('Control_main/openPage/akses'); ?>" class="ajax">
                        <span class="fa fa-unlock-alt"></span> <?php echo $xml->menu_side->manage_access; ?>
                      </a>
                    </li> 
                    <li>
                      <a href="<?php echo site_url('Control_main/openPage/level'); ?>" class="ajax">
                        <span class="fa fa-list-ol"></span> <?php echo $xml->menu_side->manage_level; ?>
                      </a>
                    </li> 
                  </ul>
              </li>
              <li>
                <a href="<?php echo site_url('Control_game/page/chart'); ?>" class="ajax">
                  <span class="fa fa-bar-chart-o"></span> <span class="xn-text"> Data <?php echo $xml->label->chart; ?></span>
                </a>
              </li> 
            <?php  else: ?>
            <li>
              <a href="<?php echo site_url('Control_main/openPage/game_list'); ?>" class="ajax">
                <span class="fa fa-gamepad"></span> <span class="xn-text"><?php echo $xml->field->game; ?></span>
              </a>
            </li> 
            <?php  endif; ?>
              <li>
                <a href="<?php echo site_url('Control_main/openPage/message'); ?>" class="ajax">
                  <span class="fa fa-envelope"></span> <span class="xn-text"><?php echo $xml->button->message; ?></span>
                </a>
              </li> 
              <li>
          <?php 
          endif;
          ?>                                       
        </ul>
        <!-- END X-NAVIGATION -->
    </div>
<!-- main sidebar end -->