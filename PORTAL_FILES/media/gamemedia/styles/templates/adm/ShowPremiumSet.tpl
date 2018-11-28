{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Server Settings</span> - Premium Settings</h4>
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
							<li><a href="admin.php?page=premium">Server Settings</a></li>
							<li class="active">Premium Settings</li>
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
												Premium Settings	
												<a class="control-arrow" data-toggle="collapse" data-target="#Frame1">
													<i class="icon-circle-down2"></i>
												</a>
											</legend>
 
											<div class="collapse in" id="Frame1">
												<div class="form-group">
													<label class="col-lg-3 control-label">The rate of resource extraction :</label>
													<div class="col-lg-9">
														<input type="text" name="prem_res" value="{$prem_res.promotion}" class="form-control" maxlength="60">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Storing capacity :</label>
													<div class="col-lg-9">
														<input type="text" name="prem_storage" value="{$prem_storage.promotion}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">The speed of construction and research :</label>
													<div class="col-lg-9">
														<input type="text" name="prem_s_build" value="{$prem_s_build.promotion}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Queue of construction and research :</label>
													<div class="col-lg-9">
														<input type="text" name="prem_o_build" value="{$prem_o_build.promotion}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">The "Bonus" :</label>
													<div class="col-lg-9">
														<input type="text" name="prem_button" value="{$prem_button.promotion}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">The emergence of the "Bonus" :</label>
													<div class="col-lg-9">
														<input type="text" name="prem_speed_button" value="{$prem_speed_button.promotion}" class="form-control"> 
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Bonus "Expeditions" :</label>
													<div class="col-lg-9">
														<input type="text" name="prem_expedition" value="{$prem_expedition.promotion}" class="form-control">
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-lg-3 control-label">The number of "Expeditions" :</label>
													<div class="col-lg-9">
														<input type="text" name="prem_count_expiditeon" value="{$prem_count_expiditeon.promotion}" class="form-control">
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Speed "Expeditions" :</label>
													<div class="col-lg-9">
														<input type="text" name="prem_speed_expiditeon" value="{$prem_speed_expiditeon.promotion}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Protection of the moon :</label>
													<div class="col-lg-9">
														<input type="text" name="prem_moon_dextruct" value="{$prem_moon_dextruct.promotion}" class="form-control">
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Getting peacefull experience :</label>
													<div class="col-lg-9">
														<input type="text" name="prem_leveling" value="{$prem_leveling.promotion}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Getting combat experience :</label>
													<div class="col-lg-9">
														<input type="text" name="prem_batle_leveling" value="{$prem_batle_leveling.promotion}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Alliance bank :</label>
													<div class="col-lg-9">
														<input type="text" name="prem_bank_ally" value="{$prem_bank_ally.promotion}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Power light conveyor :</label>
													<div class="col-lg-9">
														<input type="text" name="prem_conveyors_l" value="{$prem_conveyors_l.promotion}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Power medium conveyor :</label>
													<div class="col-lg-9">
														<input type="text" name="prem_conveyors_s" value="{$prem_conveyors_s.promotion}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Power heavy conveyor :</label>
													<div class="col-lg-9">
														<input type="text" name="prem_conveyors_t" value="{$prem_conveyors_t.promotion}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Generation collider :</label>
													<div class="col-lg-9">
														<input type="text" name="prem_prod_from_colly" value="{$prem_prod_from_colly.promotion}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Creating moon :</label>
													<div class="col-lg-9">
														<input type="text" name="prem_moon_creat" value="{$prem_moon_creat.promotion}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Fuel consumption :</label>
													<div class="col-lg-9">
														<input type="text" name="prem_fuel_consumption" value="{$prem_fuel_consumption.promotion}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Prime building:</label>
													<div class="col-lg-9">
														<input type="text" name="prem_prime_units" value="{$prem_prime_units.promotion}" class="form-control">
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