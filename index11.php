<?php 
include_once("config.php");
require_once BASE_DIR .'/userloginverfiy.php';
require_once BASE_DIR .'/modals/DashboardModal.php';
$DashboardModal = new DashboardModal();
$userid = $_SESSION['user_id'];
require_once BASE_DIR.'/include/header.php';
?>

<link href="<?=ASSETS?>css/c3/c3.css" rel="stylesheet" />

				<!-- Top bar starts -->
				<div class="top-bar clearfix">
					<!-- Container fluid starts -->
					<div class="container-fluid">
						<!-- Row starts -->
						<div class="row gutter">
							<div class="col-md-9 col-sm-6 col-xs-12">
								<h3 class="page-title">Dashboard</h3>
							</div>
							<div class="col-md-3 col-sm-6 col-xs-12 ">
								<ul class="tasks pull-right clearfix">									
									<li>
										<a href="#">
											<div class="task-num"><?=$DashboardModal->statusCount('Paid',$userid)?></div>
											<p class="task-type">Paid</p>
										</a>
									</li>
									<li>
										<a href="#">
											<div class="task-num"><?=$DashboardModal->statusCount('Due',$userid)?></div>
											<p class="task-type">Due</p>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<!-- Row ends -->
					</div>
					<!-- Container fluid ends -->
				</div>
				<!-- Top bar ends -->

				<!-- Main container starts -->
				<div class="main-container">

					<!-- Row starts -->
					<div class="row gutter">
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="mini-widget">
								<div class="mini-widget-heading clearfix">
								<div class="pull-left">Today Frieght Due</div>
								<!-- <div class="pull-right"><i class="fa fa-angle-up"></i> 12.2<sup>%</sup></div> -->
								</div>
								<div class="mini-widget-body clearfix">
								<div class="pull-left">
								<i class="fa fa-inr"></i>
								</div>
								<div class="pull-right number"><?php
                                  echo $DashboardModal->todayFrieght('Due',$userid)
								?></div>
								</div>
							</div>
							<div class="mini-widget">
								<div class="mini-widget-heading clearfix">
								<div class="pull-left">Last Week Frieght</div>
								<!-- <div class="pull-right"><i class="fa fa-angle-up"></i> 18.3<sup>%</sup></div> -->
								</div>
								<div class="mini-widget-body clearfix">
								<div class="pull-left">
								<i class="fa fa-inr"></i>
								</div>
								<div class="pull-right number"><?php
                                  echo $DashboardModal->lastWeekFright($userid)
								?></div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="mini-widget">
                <div class="mini-widget-heading clearfix">
                  <div class="pull-left">Today Frieght Paid</div>
                  <!-- <div class="pull-right"><i class="fa fa-angle-down"></i> 21.9<sup>%</sup></div> -->
                </div>
                <div class="mini-widget-body clearfix">
                  <div class="pull-left">
                    <i class="fa fa-inr"></i>
                  </div>
                  <div class="pull-right number">
                  	<?php
                        echo $DashboardModal->todayFrieght('Paid',$userid)
					?></div>
                </div>
              </div>
              <div class="mini-widget mini-widget-grey">
                <div class="mini-widget-heading clearfix">
                  <div class="pull-left">Area</div>
                  <!-- <div class="pull-right"><i class="fa fa-angle-up"></i> 67.1<sup>%</sup></div> -->
                </div>
                <div class="mini-widget-body clearfix">
                  <div class="pull-left">
                   
                    <i class="fa fa-building-o"></i>
                  </div>
                  <div class="pull-right number">                  	
                  	<?php
                        echo $DashboardModal->totalArea($userid)
					?>
                  </div>
                </div>
              </div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
							
						</div>
					</div>
					<!-- Row ends -->

					
					

					
				</div>
				<!-- Main container ends -->

<?php
require_once BASE_DIR.'/include/footer.php';
?>

<!-- Flot Charts -->
		<script src="<?=ASSETS?>js/flot/jquery.flot.min.js"></script>
		<script src="<?=ASSETS?>js/flot/jquery.flot.tooltip.min.js"></script>
		<script src="<?=ASSETS?>js/flot/jquery.flot.time.min.js"></script>
		<script src="<?=ASSETS?>js/flot/jquery.flot.resize.min.js"></script>
		<script src="<?=ASSETS?>js/flot/custom/multi-bar-chart.js"></script>
		<script src="<?=ASSETS?>js/flot/custom/profile-area.js"></script>

		<!-- JVector Map -->
		<script src="<?=ASSETS?>js/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
		<script src="<?=ASSETS?>js/jvectormap/gdp-data.js"></script>
		<script src="<?=ASSETS?>js/jvectormap/usa.js"></script>
		<script src="<?=ASSETS?>js/jvectormap/custom/usa-profile.js"></script>

		<!-- D3 JS -->
		<script src="<?=ASSETS?>js/d3.min.js"></script>

		<!-- C3 Graphs -->
		<script src="<?=ASSETS?>js/c3/c3.min.js"></script>
		<script src="<?=ASSETS?>js/c3/custom-pie-four.js"></script>
		<script src="<?=ASSETS?>js/c3/custom-bar-one.js"></script>


	