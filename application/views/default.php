<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Medidu - Media Edukasi</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/template/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/template/gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
     
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/template/dashgumfree/assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/template/dashgumfree/assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/template/dashgumfree/assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/template/dashgumfree/assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/template/dashgumfree/assets/css/style-responsive.css" rel="stylesheet">

    <script src="<?php echo base_url(); ?>assets/template/dashgumfree/assets/js/chart-master/Chart.js"></script>
    <style type="text/css">
  .input-field div.error{
    position: relative;
    top: -1rem;
    left: 0rem;
    font-size: 0.8rem;
    color:#FF4081;
    -webkit-transform: translateY(0%);
    -ms-transform: translateY(0%);
    -o-transform: translateY(0%);
    transform: translateY(0%);
  }
  .input-field label.active{
      width:100%;
  }
  .left-alert input[type=text] + label:after, 
  .left-alert input[type=password] + label:after, 
  .left-alert input[type=email] + label:after, 
  .left-alert input[type=url] + label:after, 
  .left-alert input[type=time] + label:after,
  .left-alert input[type=date] + label:after, 
  .left-alert input[type=datetime-local] + label:after, 
  .left-alert input[type=tel] + label:after, 
  .left-alert input[type=number] + label:after, 
  .left-alert input[type=search] + label:after, 
  .left-alert textarea.materialize-textarea + label:after{
      left:0px;
  }
  .right-alert input[type=text] + label:after, 
  .right-alert input[type=password] + label:after, 
  .right-alert input[type=email] + label:after, 
  .right-alert input[type=url] + label:after, 
  .right-alert input[type=time] + label:after,
  .right-alert input[type=date] + label:after, 
  .right-alert input[type=datetime-local] + label:after, 
  .right-alert input[type=tel] + label:after, 
  .right-alert input[type=number] + label:after, 
  .right-alert input[type=search] + label:after, 
  .right-alert textarea.materialize-textarea + label:after{
      right:70px;
  }
  </style>
  </head>
  <script type="text/javascript">
    function clicker(){
      alert($("#myForm").serialize());
    };
  </script>
  <body>
  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
            <!--logo start-->
            <a href="index.html" class="logo"><b>Medidu</b></a>
            <!--logo end-->
            <div class="nav top-menu pull-right top-menu">
              <form class="form-inline" role="form" style="margin-top:12px;" action="javascript::;">
                <div class="form-group">
                  <label class="sr-only" for="exampleInputEmail2">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label class="sr-only" for="exampleInputPassword2">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-theme btn-sm">Sign In</button>
              </form>
            </div>
        </header>
      <!--header end-->
      
     <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-9 main-chart">
                  
                  	<div class="row mtbox">
                  		<div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                  			<div class="box1">
					  			<span class="li_heart"></span>
					  			<h3>933</h3>
                  			</div>
					  			<p>933 People liked your page the last 24hs. Whoohoo!</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_cloud"></span>
					  			<h3>+48</h3>
                  			</div>
					  			<p>48 New files were added in your cloud storage.</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_stack"></span>
					  			<h3>23</h3>
                  			</div>
					  			<p>You have 23 unread messages in your inbox.</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_news"></span>
					  			<h3>+10</h3>
                  			</div>
					  			<p>More than 10 news were added in your reader.</p>
                  		</div>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_data"></span>
					  			<h3>OK!</h3>
                  			</div>
					  			<p>Your server is working perfectly. Relax  enjoy.</p>
                  		</div>
                  	
                  	</div><!-- /row mt -->	
                  
                      
                      <div class="row mt">
                      <!-- SERVER STATUS PANELS -->
                      	<div class="col-md-4 col-sm-4 mb">
                      		<div class="white-panel pn donut-chart">
                      			<div class="white-header">
						  			<h5>SERVER LOAD</h5>
                      			</div>
								<div class="row">
									<div class="col-sm-6 col-xs-6 goleft">
										<p><i class="fa fa-database"></i> 70%</p>
									</div>
	                      		</div>
								<canvas id="serverstatus01" height="120" width="120"></canvas>
								<script>
									var doughnutData = [
											{
												value: 70,
												color:"#68dff0"
											},
											{
												value : 30,
												color : "#fdfdfd"
											}
										];
										var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
								</script>
	                      	</div><!--/grey-panel -->
                      	</div><!-- /col-md-4-->
                      	

                      	<div class="col-md-4 col-sm-4 mb">
                      		<div class="white-panel pn">
                      			<div class="white-header">
						  			<h5>TOP PRODUCT</h5>
                      			</div>
								<div class="row">
									<div class="col-sm-6 col-xs-6 goleft">
										<p><i class="fa fa-heart"></i> 122</p>
									</div>
									<div class="col-sm-6 col-xs-6"></div>
	                      		</div>
	                      		<div class="centered">
										<img src="assets/img/product.png" width="120">
	                      		</div>
                      		</div>
                      	</div><!-- /col-md-4 -->
                      	
						<div class="col-md-4 mb">
							<!-- WHITE PANEL - TOP USER -->
							<div class="white-panel pn">
								<div class="white-header">
									<h5>TOP USER</h5>
								</div>
								<p><img src="assets/img/ui-zac.jpg" class="img-circle" width="80"></p>
								<p><b>Zac Snider</b></p>
								<div class="row">
									<div class="col-md-6">
										<p class="small mt">MEMBER SINCE</p>
										<p>2012</p>
									</div>
									<div class="col-md-6">
										<p class="small mt">TOTAL SPEND</p>
										<p>$ 47,60</p>
									</div>
								</div>
							</div>
						</div><!-- /col-md-4 -->
                      	

                    </div><!-- /row -->
                    
                    				
					<div class="row">
						<!-- TWITTER PANEL -->
						<div class="col-md-4 mb">
                      		<div class="darkblue-panel pn">
                      			<div class="darkblue-header">
						  			<h5>DROPBOX STATICS</h5>
                      			</div>
								<canvas id="serverstatus02" height="120" width="120"></canvas>
								<script>
									var doughnutData = [
											{
												value: 60,
												color:"#68dff0"
											},
											{
												value : 40,
												color : "#444c57"
											}
										];
										var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(doughnutData);
								</script>
								<p>April 17, 2014</p>
								<footer>
									<div class="pull-left">
										<h5><i class="fa fa-hdd-o"></i> 17 GB</h5>
									</div>
									<div class="pull-right">
										<h5>60% Used</h5>
									</div>
								</footer>
                      		</div><!-- /darkblue panel -->
						</div><!-- /col-md-4 -->
						
						
						<div class="col-md-4 mb">
							<!-- INSTAGRAM PANEL -->
							<div class="instagram-panel pn">
								<i class="fa fa-instagram fa-4x"></i>
								<p>@THISISYOU<br/>
									5 min. ago
								</p>
								<p><i class="fa fa-comment"></i> 18 | <i class="fa fa-heart"></i> 49</p>
							</div>
						</div><!-- /col-md-4 -->
						
						<div class="col-md-4 col-sm-4 mb">
							<!-- REVENUE PANEL -->
							<div class="darkblue-panel pn">
								<div class="darkblue-header">
									<h5>REVENUE</h5>
								</div>
								<div class="chart mt">
									<div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,464,655]"></div>
								</div>
								<p class="mt"><b>$ 17,980</b><br/>Month Income</p>
							</div>
						</div><!-- /col-md-4 -->
						
					</div><!-- /row -->
					
					<div class="row mt">
                  <div class="form-panel">
                      <h4 class="mb"><i class="fa fa-angle-right"></i> Formulir Registrasi</h4>
                      <form class="form-horizontal style-form" method="post" id="myForm" name="myForm">
                          <div class="form-group">
                              <label class="col-sm-3 col-sm-3 control-label">Nama Lengkap *</label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" data-error=".errorTxt1" name="nama" id="nama">
                                  <div class="errorTxt1"></div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 col-sm-3 control-label">Alamat *</label>
                              <div class="col-sm-9">
                                  <textarea class="form-control" id="alamat" name="alamat"></textarea>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 col-sm-3 control-label">No Telepon *</label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control round-form" name="telepon" id="telepon">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 col-sm-3 control-label">Email *</label>
                              <div class="col-sm-9">
                                  <input class="form-control" id="email" name="email" type="email" placeholder="Email@example.com">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 col-sm-3 control-label">Username *</label>
                              <div class="col-sm-9">
                                  <input type="text"  class="form-control" id="username" name="username">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 col-sm-3 control-label">Password *</label>
                              <div class="col-sm-9">
                                  <input type="password"  class="form-control" id="password" name="password">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 col-sm-3 control-label">Konfirmasi Password *</label>
                              <div class="col-sm-9">
                                  <input type="password"  class="form-control" id="k_password" name="k_password">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-lg-3 col-sm-3 control-label">Privacy Police</label>
                              <div class="col-sm-9">
                                Anda mensetujui setiap persyaratan dan ketentuan yang telah ditentukan oleh pihak developer dengan perlindungan 
                                hak cipta di bawah undang-undang Negara Indonesia. <hr>
                                  <div class="switch switch-square"
                                       data-on-label="<i class=' fa fa-check'></i>"
                                       data-off-label="<i class='fa fa-times'></i>">
                                      <input type="checkbox" />
                                  </div>
                              </div>
                          </div>
                          <button type="button" class="btn btn-primary"  onclick="clicker();">Simpan</button>
                      </form>
                  </div> 
					</div><!-- /row -->	
					
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  
                
              </div><!--/row -->
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2016 - Template by Alvarez.is - Deveploment Medidu
              <a href="<?php echo base_url(); ?>#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/java/jquery-ui/external/jquery/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/template/dashgumfree/assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo base_url(); ?>assets/template/dashgumfree/assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo base_url(); ?>assets/template/dashgumfree/assets/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/template/dashgumfree/assets/js/jquery.nicescroll.js" type="text/javascript"></script>

    <!--common script for all pages-->
    <script src="<?php echo base_url(); ?>assets/template/dashgumfree/assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/dashgumfree/assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/template/dashgumfree/assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="<?php echo base_url(); ?>assets/template/dashgumfree/assets/js/sparkline-chart.js"></script>    
    <script src="<?php echo base_url(); ?>assets/template/dashgumfree/assets/js/zabuto_calendar.js"></script>	  
    <script src="<?php echo base_url(); ?>assets/template/dashgumfree/assets/js/bootstrap-switch.js"></script>

    <!-- chartist -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/java/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/java/jquery-validation/additional-methods.min.js"></script>
  </body>
  <script type="text/javascript">
    $("#formValidate").validate({
        rules: {
            nama: {
                required: true,
                minlength: 5
            },
            cemail: {
                required: true,
                email:true
            },
            password: {
        required: true,
        minlength: 5
      },
      cpassword: {
        required: true,
        minlength: 5,
        equalTo: "#password"
      },
      curl: {
                required: true,
                url:true
            },
            crole:"required",
            ccomment: {
        required: true,
        minlength: 15
            },
            cgender:"required",
      cagree:"required",
        },
        //For custom messages
        messages: {
            uname:{
                required: "Enter a username",
                minlength: "Enter at least 5 characters"
            },
            curl: "Enter your website",
        },
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
     });
    </script>
</html>
