{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Server Settings</span> - Statistics Settings</h4>
						</div>

						<div class="heading-elements">
							<div class="heading-btn-group">
								<a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
								<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
								<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
							</div>
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="index.php"><i class="icon-home2 position-left"></i> Home</a></li>
							<li><a href="statistics_settings.php">Server Settings</a></li>
							<li class="active">Statistics Settings</li>
						</ul>

						<ul class="breadcrumb-elements">
							<li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
							
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">



							<!-- Advanced legend -->
							<form class="form-horizontal" action="" method="post">
								<div class="panel panel-flat">


									<div class="panel-body">
										
										<fieldset>
											<legend class="text-semibold">
												<i class="icon-file-text2 position-left"></i>
												Statistics Settings
												<a class="control-arrow" data-toggle="collapse" data-target="#demo2">
													<i class="icon-circle-down2"></i>
												</a>
											</legend>
											<div class="collapse in" id="demo2">

											<div class="form-group">
													<label class="col-lg-3 control-label">Value of 1 statistic point (resources):</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="stat_settings" value="{$stat_settings}">
													</div>
												</div>
											<div class="form-group">
													<label class="col-lg-3 control-label">Points to "0" (will not appear in points statistics):</label>
													<div class="col-lg-9">
													{html_options data-placeholder="Select the desired option" class="select" name=stat options=$Selector selected=$stat}
													
												</div>
												</div>	
											<div class="form-group">
													<label class="col-lg-3 control-label">Access level:</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" name="stat_level" value="{$stat_level}">
													</div>
												</div>	
				                			</div>
										</fieldset>

										<div class="text-right">
											<button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
										</div>
									</div>
								</div>
							</form>
							<!-- /a legend -->
						
{include file="overall_footer.tpl"}