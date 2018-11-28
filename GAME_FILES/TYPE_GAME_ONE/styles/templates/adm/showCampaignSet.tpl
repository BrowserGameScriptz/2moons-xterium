{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Campaing Settings</span> - Create Campaign</h4>
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
							<li><a href="admin.php?page=createcampaign">Campaing Settings</a></li>
							<li class="active">Create Campaign</li>
						</ul>

						<ul class="breadcrumb-elements">
							<li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
							
						</ul>
					</div>
				</div>
				<!-- /page header -->



				<!-- Content area -->
				<div class="content">

					<!-- Basic setup -->
		            <div class="panel panel-white">
						<div class="panel-heading">
							<h6 class="panel-title">Create Campaing</h6>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                	</ul>
		                	</div>
						</div>
						{if !empty($showMsg)}
						<div class="alert alert-danger alert-styled-left alert-bordered">
							{$showMsg}
						</div>
						{/if}
	                	<form class="form-basic" method="post">
							<fieldset class="step" id="step1">
								<h6 class="form-wizard-title text-semibold">
									<span class="form-wizard-count">1</span>
									Purchase Settings
									<small class="display-block">Fill in the sales you want to start on each purchase</small>
								</h6>

								

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Extra antimatter bonus:</label>
											<input type="text" name="donation_bonus" class="form-control" placeholder="value in % on each purchase of antimatter. Example 30 for 30%">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Extra purchase status:</label>
											<select name="special_donation_status" data-placeholder="Do you want to activate the second bonus option ?" class="select">
														<option></option>
														<option value="1">Activated</option>
														<option value="0">Disabled</option>
													</select>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Extra premium time:</label>
											<input type="text" name="special_donation_premium" class="form-control" placeholder="Value in % to offer extra premium time on each activation. Example 30 for 30%">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Extra purchase amount:</label>
											<input type="text" name="special_donation_amount" class="form-control" placeholder="Minimum value of antimatter purchase to activate the secod bonus. Example 200000">
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Red bonus button:</label>
											<input type="text" name="red_button" class="form-control" placeholder="Factor for the red bonus button: Example 5 for x5">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Extra purchase percent:</label>
											<input type="text" name="special_donation_percent" class="form-control" placeholder="Value in % to offer as second bonus if min. purchase is met. Example 30 for 30%">
										</div>
									</div>
								</div>
								
							</fieldset>

							<fieldset class="step" id="step2">
								<h6 class="form-wizard-title text-semibold">
									<span class="form-wizard-count">2</span>
									Optional Settings
									<small class="display-block">You can activate optional settings that will run in this event.</small>
								</h6>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Acadedmy points reduction:</label>
			                                <input type="text" name="special_donation_academy" placeholder="Value in % to decrease the cost of 1 academy points. Example 30 for 30%" class="form-control">
		                                </div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Stellar ore reduction:</label>
			                                <input type="text" name="special_donation_stardust" placeholder="Value in % to decrease the cost of 1 stellar ore. Example 30 for 30%" class="form-control">
		                                </div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Darkmatter cost reduction:</label>
			                                <input type="text" name="darkmatter_reduc" placeholder="Value in % to decrease the cost of 1 darkmatter construction [fleet, defense, build, research]. Example 30 for 30%" class="form-control">
		                                </div>

										<div class="form-group">
											<label>Collider promotion reduction:</label>
			                                <input type="text" name="collider_promo" placeholder="Value in % to decrease the cost of the collider price. Example 30 for 30%" class="form-control">
		                                </div>
									</div>

									<div class="col-md-6">

										<div class="form-group">
											<label>Prime buildings:</label>
			                                <select name="primebuild" data-placeholder="Do you want to activate the prime ships and defense [M7,M19, M32, SLIM, IRON, HEAVY MEGADOR] ?" class="select">
												<option></option>
												<option value="1">Activated</option>
												<option value="0">Disabled</option>
											</select>
		                                </div>
										
										<div class="form-group">
											<label>Acitave the suprema event:</label>
			                                <select name="auctionExpe" data-placeholder="Do you want to activate the suprema event to find auction items in the galaxy ?" class="select">
												<option></option>
												<option value="1">Yes</option>
												<option value="0">No</option>
											</select>
		                                </div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Peacefull experience:</label>
											<input type="text" name="peacefullExp" class="form-control" placeholder="Factor for the peacefull experience bar: Example 5 for x5">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Combat experience:</label>
											<input type="text" name="combatExp" class="form-control" placeholder="Factor for the combat experience bar: Example 5 for x5">
										</div>
									</div>
								</div>
							</fieldset>


							<fieldset class="step" id="step3">
								<h6 class="form-wizard-title text-semibold">
									<span class="form-wizard-count">3</span>
									Additional info
									<small class="display-block">Fill in the data. all inputs are required.</small>
								</h6>
								
								<div class="row">
									<div class="col-md-6">
										<label>Start Date: <span class="text-danger">*</span></label>
										<div class="row">
											
											<div class="col-md-4">
												<div class="form-group">
													<select name="start-day" data-placeholder="Start Day" class="select">
														<option></option>
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
														<option value="6">6</option>
														<option value="7">7</option>
														<option value="8">8</option>
														<option value="9">9</option>
														<option value="10">10</option>
														<option value="11">11</option>
														<option value="12">12</option>
														<option value="13">13</option>
														<option value="14">14</option>
														<option value="15">15</option>
														<option value="16">16</option>
														<option value="17">17</option>
														<option value="18">18</option>
														<option value="19">19</option>
														<option value="20">20</option>
														<option value="21">21</option>
														<option value="22">22</option>
														<option value="23">23</option>
														<option value="24">24</option>
														<option value="25">25</option>
														<option value="26">26</option>
														<option value="27">27</option>
														<option value="28">28</option>
														<option value="29">29</option>
														<option value="30">30</option>
														<option value="31">31</option>
													</select>
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<select name="start-month" data-placeholder="Start Month" class="select">
														<option></option>
														<option value="1">January</option>
														<option value="2">February</option>
														<option value="3">March</option>
														<option value="4">April</option>
														<option value="5">May</option>
														<option value="6">June</option>
														<option value="7">July</option>
														<option value="8">August</option>
														<option value="9">September</option>
														<option value="10">October</option>
														<option value="11">November</option>
														<option value="12">December</option>
													</select>
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<select name="start-year" data-placeholder="Start Year" class="select">
														<option></option>
														<option value="2016">2016</option>
														<option value="2017">2017</option>
														<option value="2018">2018</option>
													</select>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
									<div class="col-md-6">
										<label>End Date: <span class="text-danger">*</span></label>
										<div class="row">
											
											<div class="col-md-4">
												<div class="form-group">
													<select name="end-day" data-placeholder="End Day" class="select">
														<option></option>
														<option></option>
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
														<option value="6">6</option>
														<option value="7">7</option>
														<option value="8">8</option>
														<option value="9">9</option>
														<option value="10">10</option>
														<option value="11">11</option>
														<option value="12">12</option>
														<option value="13">13</option>
														<option value="14">14</option>
														<option value="15">15</option>
														<option value="16">16</option>
														<option value="17">17</option>
														<option value="18">18</option>
														<option value="19">19</option>
														<option value="20">20</option>
														<option value="21">21</option>
														<option value="22">22</option>
														<option value="23">23</option>
														<option value="24">24</option>
														<option value="25">25</option>
														<option value="26">26</option>
														<option value="27">27</option>
														<option value="28">28</option>
														<option value="29">29</option>
														<option value="30">30</option>
														<option value="31">31</option>
													</select>
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<select name="end-month" data-placeholder="End Month" class="select">
														<option></option>
														<option value="1">January</option>
														<option value="2">February</option>
														<option value="3">March</option>
														<option value="4">April</option>
														<option value="5">May</option>
														<option value="6">June</option>
														<option value="7">July</option>
														<option value="8">August</option>
														<option value="9">September</option>
														<option value="10">October</option>
														<option value="11">November</option>
														<option value="12">December</option>
													</select>
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<select name="end-year" data-placeholder="End Year" class="select">
														<option></option>
														<option value="2016">2016</option>
														<option value="2017">2017</option>
														<option value="2018">2018</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="row">
									

									<div class="col-md-12">
										<div class="form-group">
											<label>Overview news:</label>
		                                    <textarea name="NewsText" rows="5" cols="5" placeholder="If you want to add any info, do it here." class="form-control"></textarea>
	                                    </div>
									</div>
								</div>
							</fieldset>

							<div class="form-wizard-actions">
								<input class="btn btn-default" id="basic-back" value="Back" type="reset">
								<input class="btn btn-info" id="basic-next" value="Next" type="submit">
							</div>
						</form>
		            </div>
		            <!-- /basic setup -->
						
{include file="overall_footer.tpl"}