{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Server Settings</span> - Universe Settings</h4>
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
							<li><a href="admin.php?page=universeset">Server Settings</a></li>
							<li class="active">Universe Settings</li>
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
												Settings of the universe	
												<a class="control-arrow" data-toggle="collapse" data-target="#Frame1">
													<i class="icon-circle-down2"></i>
												</a>
											</legend>
 
											<div class="collapse in" id="Frame1">
												<div class="form-group">
													<label class="col-lg-3 control-label">Name of the Universe:</label>
													<div class="col-lg-9">
														<input type="text" name="uni_name" value="{$uni_name}" class="form-control" maxlength="60">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Game speed:</label>
													<div class="col-lg-9">
														<input type="text" name="game_speed" value="{$game_speed}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Fleet speed:</label>
													<div class="col-lg-9">
														<input type="text" name="fleet_speed" value="{$fleet_speed}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Speed of production of resources:</label>
													<div class="col-lg-9">
														<input type="text" name="resource_multiplier" value="{$resource_multiplier}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Expedition speed:</label>
													<div class="col-lg-9">
														<input type="text" name="halt_speed" value="{$halt_speed}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Energy Factor:</label>
													<div class="col-lg-9">
														<input type="text" name="energySpeed" value="{$energySpeed}" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"></label>
													<div class="col-lg-9">
													<div class="checkbox checkbox-switch">
													<label>
													<input type="checkbox" name="closed" {if $game_disable} checked="checked"{/if} data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch">
													Server Online
													</label>
													</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Closed server message:</label>
													<div class="col-lg-9">
														<textarea rows="5" cols="5" name="close_reason" class="form-control">{$close_reason}</textarea>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"></label>
													<div class="col-lg-9">
													<div class="checkbox checkbox-switch">
													<label>
													<input type="checkbox" name="reg_closed" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch"{if $reg_closed} checked="checked"{/if}>
													Close the registrations
													</label>
													</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"></label>
													<div class="col-lg-9">
													<div class="checkbox checkbox-switch">
													<label>
													<input type="checkbox" name="adm_attack" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch"{if $adm_attack} checked="checked"{/if}>
													Admin game protection
													</label>
													</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"></label>
													<div class="col-lg-9">
													<div class="checkbox checkbox-switch">
													<label>
													<input type="checkbox" name="user_valid" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch"{if $user_valid} checked="checked"{/if}>
													The system of checking email
													</label>
													</div>
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