{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Game Settings</span> - Planet Settings</h4>
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
							<li><a href="admin.php?page=planetset">Game Settings</a></li>
							<li class="active">Planet Settings</li>
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
												Settings of the planets
												<a class="control-arrow" data-toggle="collapse" data-target="#Frame5">
													<i class="icon-circle-down2"></i>
												</a>
											</legend>
 
											<div class="collapse in" id="Frame5">
												<div class="form-group">
													<label class="col-lg-3 control-label">Start - Metal:</label>
													<div class="col-lg-9">
														<input type="text" name="metal_start" value="{$metal_start}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Start - Crystal:</label>
													<div class="col-lg-9">
														<input type="text" name="crystal_start" value="{$crystal_start}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Start - Deuterium:</label>
													<div class="col-lg-9">
														<input type="text" name="deuterium_start" value="{$deuterium_start}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Start - Dark Matter:</label>
													<div class="col-lg-9">
														<input type="text" name="darkmatter_start" value="{$darkmatter_start}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Initial Fields:</label>
													<div class="col-lg-9">
														<input type="text" name="initial_fields" value="{$initial_fields}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Production of Metal Basic:</label>
													<div class="col-lg-9">
														<input type="text" name="metal_basic_income" value="{$metal_basic_income}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Production of Crystal Basic:</label>
													<div class="col-lg-9">
														<input type="text" name="crystal_basic_income" value="{$crystal_basic_income}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Production of Deuterium Basic:</label>
													<div class="col-lg-9">
														<input type="text" name="deuterium_basic_income" value="{$deuterium_basic_income}" class="form-control">
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