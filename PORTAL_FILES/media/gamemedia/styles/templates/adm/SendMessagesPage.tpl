{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
	<!-- Theme JS files -->

<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Utilities</span> - Global Message</h4>
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
							<li><a href="admin.php?page=overview"><i class="icon-home2 position-left"></i> Home</a></li>
							<li><a href="admin.php?page=globalmessage">Utilities</a></li>
							<li class="active">Global Message</li>
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
							<form class="form-horizontal" action="admin.php?page=globalmessage&action=send" method="post">
								<div class="panel panel-flat">


									<div class="panel-body">
										<fieldset>
											<legend class="text-semibold">
												<i class="icon-file-text2 position-left"></i>
												Global Message
												<a class="control-arrow" data-toggle="collapse" data-target="#demo1">
													<i class="icon-circle-down2"></i>
												</a>
											</legend>
 
											<div class="collapse in" id="demo1">
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Language:</label>
													<div class="col-lg-9">
														<select name=lang data-placeholder="Select the desired option" class="select">
															<option value="0">All</option>
															<option value="1">English</option>
															<option value="2">French</option>
															<option value="3">Deutsch</option>
														</select>
													</div>
												</div> 
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Type:</label>
													<div class="col-lg-9">
														<select name=typemsg data-placeholder="Select the desired option" class="select">
															<option value="0">Message</option>
															<option value="1">Notification</option>
															<option value="2">Android Push Notifications</option>
														</select>
													</div>
												</div> 
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Subject:</label>
													<div class="col-lg-9">
														<input name="subject" type="text" class="form-control">
													</div>
												</div>

												<div class="form-group">
													<label class="col-lg-3 control-label">Message:</label>
													<div class="col-lg-9">
				                                    <textarea rows="5" cols="5" name="text" class="form-control"></textarea>
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