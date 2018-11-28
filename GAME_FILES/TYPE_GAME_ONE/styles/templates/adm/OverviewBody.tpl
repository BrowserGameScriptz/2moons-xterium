{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4>
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
							<li class="active">Dashboard</li>
						</ul>

						<ul class="breadcrumb-elements">
							<li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
							
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Dashboard content -->
					<div class="row">
						<div class="col-lg-8">
				
							<!-- Marketing campaigns -->
							<div class="panel panel-flat">
							

								<div class="table-responsive">
									<table class="table text-nowrap">
										<thead>
											<tr>
												<th>Campaign</th>
												<th class="col-md-2">Currency</th>
												<th class="col-md-2">Changes</th>
												<th class="col-md-2">Sales</th>
												<th class="col-md-2">Status</th>
											</tr>
										</thead>
										<tbody>
											<tr class="active border-double">
												<td colspan="4">Today</td>
												<td class="text-right">
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-plus-circle2"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="admin.php?page=createcampaign"><i class="icon-file-stats"></i> Create Campaign</a></li>
																<li><a href="admin.php?page=log&type=campaign"><i class="icon-file-text2"></i> Campaing log</a></li>
																
																<li class="divider"></li>
																
															</ul>
														</li>
													</ul>
												</td>
											</tr>
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="#"><img src="assets/images/paypal.jpg" class="img-circle img-xs" alt=""></a>
													</div>
													<div class="media-left">
														<div class=""><span class="text-default text-semibold">Paypal</span></div>
														<div class="text-muted text-size-small">
															<span class="status-mark border-success position-left"></span>
															{$todayDate}
														</div>
													</div>
												</td>
												<td><span class="text-muted">EUR</span></td>
												<td><span class="text-{if $totalPaypalP < 0}danger{else}success{/if}-600"><i class="icon-stats-{if $totalPaypalP < 0}decline2{else}growth2{/if} position-left"></i> {if $totalPaypalP == 100 && $totalPaypal == 0}0{else}{$totalPaypalP}{/if}%</span></td>
												<td><h6 class="text-semibold">€{$totalPaypal}</h6></td>
												<td><span class="label bg-success-400">Enabled</span></td>
												
											</tr>
											
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="#"><img src="assets/images/xsolla.jpg" class="img-circle img-xs" alt=""></a>
													</div>
													<div class="media-left">
														<div class=""><span class="text-default text-semibold">Xsolla</span></div>
														<div class="text-muted text-size-small">
															<span class="status-mark border-danger position-left"></span>
															{$todayDate}
														</div>
													</div>
												</td>
												<td><span class="text-muted">EUR</span></td>
												<td><span class="text-{if $totalXsollaP < 0}danger{else}success{/if}"><i class="icon-stats-{if $totalXsollaP < 0}decline2{else}growth2{/if} position-left"></i> {if $totalXsollaP == 100 && $totalXsolla == 0}0{else}{$totalXsollaP}{/if}%</span></td>
												<td><h6 class="text-semibold">€{$totalXsolla}</h6></td>
												<td><span class="label bg-success-400">Enabled</span></td>
												
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="#"><img src="assets/images/paysafecard.jpg" class="img-circle img-xs" alt=""></a>
													</div>
													<div class="media-left">
														<div class=""><span class="text-default text-semibold">Paysafe Cards</span></div>
														<div class="text-muted text-size-small">
															<span class="status-mark border-blue position-left"></span>
															{$todayDate}
														</div>
													</div>
												</td>
												<td><span class="text-muted">EUR</span></td>
												<td><span class="text-{if $totalPaysafeP < 0}danger{else}success{/if}-600"><i class="icon-stats-{if $totalPaysafeP < 0}decline2{else}growth2{/if} position-left"></i> {if $totalPaysafeP == 100 && $totalPaysafe == 0}0{else}{$totalPaysafeP}{/if}%</span></td>
												<td><h6 class="text-semibold">€{$totalPaysafe}</h6></td>
												<td><span class="label bg-success-400">Enabled</span></td>
												
											</tr>

											{*<tr class="active border-double">
												<td colspan="4">Yesterday</td>
												<td class="text-right">
													<span class="progress-meter" id="yesterday-progress" data-progress="65"></span>
												</td>
											</tr>
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="#"><img src="assets/images/paypal.jpg" class="img-circle img-xs" alt=""></a>
													</div>
													<div class="media-left">
														<div class=""><span class="text-default text-semibold">Paypal</span></div>
														<div class="text-muted text-size-small">
															<span class="status-mark border-success position-left"></span>
															{$yesterdayDate}
														</div>
													</div>
												</td>
												<td><span class="text-muted">EUR</span></td>
												<td><span class="text-{if $totalPaypalPo < 0}danger{else}success{/if}"><i class="icon-stats-{if $totalPaypalPo < 0}decline2{else}growth2{/if} position-left"></i> {if $totalPaypalPo == 100 && $totalPaypalO == 0}0{else}{$totalPaypalPo}{/if}%</span></td>
												<td><h6 class="text-semibold">€{$totalPaypalO}</h6></td>
												<td><span class="label bg-success-400">Enabled</span></td>
												
											</tr>
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="#"><img src="assets/images/xsolla.jpg" class="img-circle img-xs" alt=""></a>
													</div>
													<div class="media-left">
														<div class=""><span class="text-default text-semibold">Xsolla</span></div>
														<div class="text-muted text-size-small">
															<span class="status-mark border-danger position-left"></span>
															{$yesterdayDate}
														</div>
													</div>
												</td>
												<td><span class="text-muted">EUR</span></td>
												<td><span class="text-{if $totalXsollaPo < 0}danger{else}success{/if}-600"><i class="icon-stats-{if $totalXsollaPo < 0}decline2{else}growth2{/if} position-left"></i> {if $totalXsollaPo == 100 && $totalXsollaO == 0}0{else}{$totalXsollaPo}{/if}%</span></td>
												<td><h6 class="text-semibold">€{$totalXsollaO}</h6></td>
												<td><span class="label bg-success-400">Enabled</span></td>
												
											</tr>
											<tr>
												<td>
													<div class="media-left media-middle">
														<a href="#"><img src="assets/images/paysafecard.jpg" class="img-circle img-xs" alt=""></a>
													</div>
													<div class="media-left">
														<div class=""><span class="text-default text-semibold">Paysafe Cards</span></div>
														<div class="text-muted text-size-small">
															<span class="status-mark border-blue position-left"></span>
															{$yesterdayDate}
														</div>
													</div>
												</td>
												<td><span class="text-muted">EUR</span></td>
												<td><span class="text-{if $totalPaysafePo < 0}danger{else}success{/if}"><i class="icon-stats-{if $totalPaysafePo < 0}decline2{else}growth2{/if} position-left"></i> {if $totalPaysafePo == 100 && $totalPaysafeO == 0}0{else}{$totalPaysafePo}{/if}%</span></td>
												<td><h6 class="text-semibold">€{$totalPaysafeO}</h6></td>
												<td><span class="label bg-success-400">Enabled</span></td>
												
											</tr>*}
										</tbody>
									</table>
								</div>
							</div>
							<!-- /marketing campaigns -->

							

							<!-- Quick stats boxes -->
							<div class="row">
								<div class="col-lg-4">

									<!-- Members online -->
									<div class="panel bg-teal-400">
										<div class="panel-body">
											<div class="heading-elements">
												<span class="heading-text badge bg-teal-800">+53,6%</span>
											</div>

											<h3 class="no-margin">{$amountonline}</h3>
											Members online
										</div>

										<div class="container-fluid">
											<div id="members-online"></div>
										</div>
									</div>
									<!-- /members online -->

								</div>

								<div class="col-lg-4">

									<!-- Current server load -->
									<div class="panel bg-pink-400">
										<div class="panel-body">
											

											<h3 class="no-margin">{$memory_usage}%</h3>
											Current server load
										</div>

										<div id="server-load"></div>
									</div>
									<!-- /current server load -->

								</div>

								<div class="col-lg-4">

									<!-- Today's revenue -->
									<div class="panel bg-blue-400">
										<div class="panel-body">
											<div class="heading-elements">
												<ul class="icons-list">
							                		<li></li>
							                	</ul>
						                	</div>

											<h3 class="no-margin">€{$totalRevenue} <sup>{$totalRevenue1} antimatter</sup></h3>
											Total revenue
										</div>

										<div id="today-revenue"></div>
									</div>
									<!-- /today's revenue -->

								</div>
							</div>
							<!-- /quick stats boxes -->
									{if $showCommentAlert == 1}<div class="alert alert-danger alert-styled-left alert-bordered">
										<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
										<span class="text-semibold">Attention!</span> There are new hof comments to moderate. <a href="admin.php?page=commentlist" class="alert-link">Click here to access the moderation page</a>.
								    </div>{/if}
									
									<div class="alert alert-danger alert-styled-left alert-bordered">
										<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
										<span class="text-semibold">Attention!</span> Two non-authorized players tried to reach the administration page ! <a href="admin.php?page=commentlist" class="alert-link">Click here to access the moderation page</a>.
								    </div>
									{if $TotalPaysafe >= 1}
									<div class="alert alert-danger alert-styled-left alert-bordered">
										<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
										<span class="text-semibold">Validation!</span> There are {$TotalPaysafe} paysafe cards to approuve be an admin ! <a href="admin.php?page=addam" class="alert-link">Click here to access the moderation page</a>.
								    </div>
									{/if}
									{if $totalBlockedCron != 0}
									<div class="alert alert-danger alert-styled-left alert-bordered">
										<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
										<span class="text-semibold">Attention!</span> There is atleast one cronjob locked that shouldn't be locked for a correct game play ! <a href="admin.php?page=cronjob" class="alert-link">Click here to access the moderation page</a>.
								    </div>
									{/if}
									{if $totalEmailsProc != 0}
									<div class="alert alert-danger alert-styled-left alert-bordered">
										<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
										<span class="text-semibold">Attention!</span> There are currently {$totalEmailsProc} emails being send to players, this can affect a little bit the server performance !
								    </div>
									{/if}
									{if $totalBlocked != 0}
									<div class="alert alert-danger alert-styled-left alert-bordered">
										<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
										<span class="text-semibold">Attention!</span> There are {$totalBlocked} blocked fleets that need to be unlocked to unbug the game ! <a href="admin.php?page=fleets" class="alert-link">Click here to access the moderation page</a>.
								    </div>
									{/if}
						</div>

						<div class="col-lg-4">

							<!-- Daily sales -->
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Daily sales stats</h6>
									<div class="heading-elements">
										<span class="heading-text">Balance: <span class="text-bold text-danger-600 position-right">€{$totalToday}</span></span>
										<ul class="icons-list">
					                		<li class="dropdown text-muted">
					                			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i> <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="admin.php?page=payarchive"><i class="icon-list-unordered"></i> Detailed log</a></li>
													<li><a href="admin.php?page=paystatistic"><i class="icon-pie5"></i> Statistics</a></li>
													<li class="divider"></li>
												</ul>
					                		</li>
					                	</ul>
									</div>
								</div>

								<div class="panel-body">
									<div id="sales-heatmap"></div>
								</div>

								<div class="table-responsive">
									<table class="table text-nowrap">
										<thead>
											<tr>
												<th>Tranaction Id</th>
												<th>Time</th>
												<th>Price</th>
											</tr>
										</thead>
										<tbody>
										{foreach $purchaseList as $payID => $payInfo}
											<tr>
												<td>
													<div class="media-left media-middle">
														<span class="btn bg-{if $payInfo.pinType == "paypal"}success{elseif $payInfo.pinType == "xsolla"}danger{else}blue{/if}-400 btn-rounded btn-icon btn-xs">
															<span class="letter-icon"></span>
														</span>
													</div>

													<div class="media-body">
														<div class="media-heading">
															<a href="#" class="letter-icon-title">{$payInfo.pinCode}</a>
														</div>

														<div class="text-muted text-size-small"><i class="icon-checkmark3 text-size-mini position-left"></i>{if !empty($payInfo.realDonator)}{$payInfo.realDonator} -> {/if} {$payInfo.userID} - {pretty_number($payInfo.pinCredits)} antimatter</div>
													</div>
												</td>
												<td>
													<span class="text-muted text-size-small">{$payInfo.time}</span>
												</td>
												<td>
													<h6 class="text-semibold no-margin">€{$payInfo.pinPrice}</h6>
												</td>
											</tr>
										{/foreach}
										
										</tbody>
									</table>
								</div>
							</div>
							
							<!-- /daily sales -->
							
							<!-- latest logins -->
							<div class="panel panel-flat">

								<div class="table-responsive">
									<table class="table text-nowrap">
										<thead>
											<tr>
												<th>Latest logins</th>
												<th>Time</th>
												<th>State</th>
											</tr>
										</thead>
										<tbody>
										{foreach $loggedList as $adminLog => $loggedInfo}
											<tr>
												<td>
													<div class="media-left media-middle">
														<span class="btn bg-{if $loggedInfo.status == 0}success{elseif $loggedInfo.status == 1}danger{/if}-400 btn-rounded btn-icon btn-xs">
															<span class="letter-icon"></span>
														</span>
													</div>

													<div class="media-body">
														<div class="text-muted text-size-small"><i class="icon-{if $loggedInfo.status == 0}checkmark3{elseif $loggedInfo.status == 1}cross2{/if} text-size-mini position-left"></i> {$loggedInfo.username}</div>
													</div>
												</td>
												<td>
													<span class="text-muted text-size-small">{$loggedInfo.time}</span>
												</td>
												<td>
													<h6 class="text-semibold no-margin">{if $loggedInfo.state == 0}Valid{else}Failed{/if}</h6>
												</td>
											</tr>
										{/foreach}
										
										</tbody>
									</table>
								</div>
							</div>
							
							<!-- /latest logins -->

							<!-- My Message Here -->

							<!-- Daily financials -->
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Financials statistics</h6>
									
								</div>

								<div class="panel-body">
									<div class="content-group-xs" id="bullets"></div>

									<ul class="media-list">
										<li class="media">
											<div class="media-left">
												<a href="#" class="btn border-pink text-pink btn-flat btn-rounded btn-icon btn-xs"><i class="icon-statistics"></i></a>
											</div>
											
											<div class="media-body">
												Stats for July, 6: 1938 orders, $4220 revenue
												<div class="media-annotation">2 hours ago</div>
											</div>

											<div class="media-right media-middle">
												<ul class="icons-list">
													<li>
								                    	<a href="#"><i class="icon-arrow-right13"></i></a>
							                    	</li>
						                    	</ul>
											</div>
										</li>

										<li class="media">
											<div class="media-left">
												<a href="#" class="btn border-success text-success btn-flat btn-rounded btn-icon btn-xs"><i class="icon-checkmark3"></i></a>
											</div>
											
											<div class="media-body">
												Invoices <a href="#">#4732</a> and <a href="#">#4734</a> have been paid
												<div class="media-annotation">Dec 18, 18:36</div>
											</div>

											<div class="media-right media-middle">
												<ul class="icons-list">
													<li>
								                    	<a href="#"><i class="icon-arrow-right13"></i></a>
							                    	</li>
						                    	</ul>
											</div>
										</li>

										<li class="media">
											<div class="media-left">
												<a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-xs"><i class="icon-alignment-unalign"></i></a>
											</div>
											
											<div class="media-body">
												Affiliate commission for June has been paid
												<div class="media-annotation">36 minutes ago</div>
											</div>

											<div class="media-right media-middle">
												<ul class="icons-list">
													<li>
								                    	<a href="#"><i class="icon-arrow-right13"></i></a>
							                    	</li>
						                    	</ul>
											</div>
										</li>

										<li class="media">
											<div class="media-left">
												<a href="#" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs"><i class="icon-spinner11"></i></a>
											</div>

											<div class="media-body">
												Order <a href="#">#37745</a> from July, 1st has been refunded
												<div class="media-annotation">4 minutes ago</div>
											</div>

											<div class="media-right media-middle">
												<ul class="icons-list">
													<li>
								                    	<a href="#"><i class="icon-arrow-right13"></i></a>
							                    	</li>
						                    	</ul>
											</div>
										</li>

										<li class="media">
											<div class="media-left">
												<a href="#" class="btn border-teal-400 text-teal btn-flat btn-rounded btn-icon btn-xs"><i class="icon-redo2"></i></a>
											</div>
											
											<div class="media-body">
												Invoice <a href="#">#4769</a> has been sent to <a href="#">Robert Smith</a>
												<div class="media-annotation">Dec 12, 05:46</div>
											</div>

											<div class="media-right media-middle">
												<ul class="icons-list">
													<li>
								                    	<a href="#"><i class="icon-arrow-right13"></i></a>
							                    	</li>
						                    	</ul>
											</div>
										</li>
									</ul>
								</div>
							</div>
							<!-- /daily financials -->

						</div>
					</div>
					<!-- /dashboard content -->

{include file="overall_footer.tpl"}