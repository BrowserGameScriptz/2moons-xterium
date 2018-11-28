{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Server Settings</span> - Queue Settings</h4>
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
							<li><a href="admin.php"><i class="icon-home2 position-left"></i> Home</a></li>
							<li><a href="admin.php?page=queuset">Server Settings</a></li>
							<li class="active">Queue Settings</li>
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
												Queue List
												<a class="control-arrow" data-toggle="collapse" data-target="#Frame2">
													<i class="icon-circle-down2"></i>
												</a>
											</legend>
 
											<div class="collapse in" id="Frame2">
												<div class="form-group">
													<label class="col-lg-3 control-label">Max. Construction Buildings:</label>
													<div class="col-lg-9">
														<input type="text" name="max_elements_build" value="{$max_elements_build}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Max. Construction - Research:</label>
													<div class="col-lg-9">
														<input type="text" name="max_elements_tech" value="{$max_elements_tech}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Max. Construction - Hangar:</label>
													<div class="col-lg-9">
														<input type="text" name="max_elements_ships" value="{$max_elements_ships}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Max. Fleets Orders:</label>
													<div class="col-lg-9">
														<input type="text" name="max_fleet_per_build" value="{$max_fleet_per_build}" class="form-control">
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