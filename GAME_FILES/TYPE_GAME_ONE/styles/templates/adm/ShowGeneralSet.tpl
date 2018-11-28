{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Server Settings</span> - General</h4>
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
							<li><a href="admin.php?page=generalsett">Server Settings</a></li>
							<li class="active">General</li>
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
							<form class="form-horizontal" method="post">
								<div class="panel panel-flat">


									<div class="panel-body">
										<fieldset>
											<legend class="text-semibold">
												<i class="icon-file-text2 position-left"></i>
												General Settings
												<a class="control-arrow" data-toggle="collapse" data-target="#demo1">
													<i class="icon-circle-down2"></i>
												</a>
											</legend>
 
											<div class="collapse in" id="demo1">
												<div class="form-group">
													<label class="col-lg-3 control-label">Title:</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" readonly value="Control Panel© - Create your own space war game">
													</div>
												</div>

												<div class="form-group">
													<label class="col-lg-3 control-label">Site URL:</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" readonly value="{$myurl}">
													</div>
												</div>

												<div class="form-group">
													<label class="col-lg-3 control-label">Admin Name:</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" placeholder="Admin Name" name="admin_name" value="{$admin_name}">
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Admin Email:</label>
													<div class="col-lg-9">
														<input type="email" class="form-control" placeholder="admin@admin.ltd" name="admin_email" value="{$admin_email}">
													</div>
												</div>
											</div>
										</fieldset>

										<fieldset>
											<legend class="text-semibold">
												<i class="icon-file-text2 position-left"></i>
												Time And Numbers Settings
												<a class="control-arrow" data-toggle="collapse" data-target="#demo2">
													<i class="icon-circle-down2"></i>
												</a>
											</legend>

											<div class="collapse in" id="demo2">
					                		<div class="form-group">
													<label class="col-lg-3 control-label">Timezone:</label>
													<div class="col-lg-9">
													<select data-placeholder="Select your timezone" class="select">
														<option></option>
														<optgroup label="Alaskan/Hawaiian Time Zone">
															<option value="AK">Alaska</option>
															<option value="HI">Hawaii</option>
														</optgroup>
														<optgroup label="Pacific Time Zone">
															<option value="CA">California</option>
															<option value="NV">Nevada</option>
															<option value="WA">Washington</option>
														</optgroup>
														<optgroup label="Mountain Time Zone">
															<option value="AZ">Arizona</option>
															<option value="CO">Colorado</option>
															<option value="WY">Wyoming</option>
														</optgroup>
														<optgroup label="Central Time Zone">
															<option value="AL">Alabama</option>
															<option value="AR">Arkansas</option>
															<option value="KY">Kentucky</option>
														</optgroup>
														<optgroup label="Eastern Time Zone">
															<option value="CT">Connecticut</option>
															<option value="DE">Delaware</option>
															<option value="FL">Florida</option>
														</optgroup>
													</select>
												</div>
												</div>
											<div class="form-group">
													<label class="col-lg-3 control-label">Date Format:</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" placeholder="m/d/Y">
													</div>
												</div>
											<div class="form-group">
													<label class="col-lg-3 control-label">Time Format:</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" placeholder="g:i a">
													</div>
												</div>
											<div class="form-group">
													<label class="col-lg-3 control-label">Shortly Numbers:</label>
													<div class="col-lg-9">
													<select data-placeholder="Select the desired option" class="select">
															<option value="0">Disabled</option>
															<option value="1">Enabled</option>
													</select>
												</div>
												</div>	
				                			</div>
										</fieldset>
										
										<fieldset>
											<legend class="text-semibold">
												<i class="icon-file-text2 position-left"></i>
												Template Settings
												<a class="control-arrow" data-toggle="collapse" data-target="#demo3">
													<i class="icon-circle-down2"></i>
												</a>
											</legend>

											<div class="collapse in" id="demo3">
					                		<div class="form-group">
													<label class="col-lg-3 control-label">Logo URL:</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" placeholder="Enter Logo URL here" name="game_logo" value="{$site_logo}">
													</div>
												</div>
											<div class="form-group">
													<label class="col-lg-3 control-label">Favicon URL:</label>
													<div class="col-lg-9">
														<input type="text" class="form-control" placeholder="Enter Fav Icon URL here" name="game_fav" value="{$site_favicon}">
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