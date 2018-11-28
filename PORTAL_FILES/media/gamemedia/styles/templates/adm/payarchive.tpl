{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Purchases</span> - Archive</h4>
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
							<li><a href="admin.php?page=payarchive">Purchases</a></li>
							<li class="active">Archive</li>
						</ul>

						<ul class="breadcrumb-elements">
							<li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Invoice archive -->
					<div class="panel panel-white">
						<div class="panel-heading">
							<h6 class="panel-title">Purchase archive</h6>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="reload"></a></li>
			                	</ul>
		                	</div>
						</div>

						<table class="table table-lg invoice-archive">
							<thead>
								<tr>
									<th>#</th>
									<th>Period</th>
					                <th>Issued to</th>
					                <th>Status</th>
					                <th>Issue date</th>
					                <th>Last update</th>
					                <th>Amount</th>
					                <th class="text-center">Actions</th>
					            </tr>
							</thead>
							<tbody>
								{foreach $PurchaseList as $payId => $payRow}
								<tr>
									<td>#{$payId}</td>
									<td>{$payRow.period}</td>
					                <td>
					                	<h6 class="no-margin">
					                		{$payRow.username}
					                		<small class="display-block text-muted">Payment method: {$payRow.pinType}</small>
				                		</h6>
				                	</td>
					                <td>
					                	<select name="status" class="select" data-placeholder="Select status" disabled="disabled">
					                		<option value="canceled_reversal"{if $payRow.paystatus == "canceled_reversal"} selected="selected"{/if}>Canceled Reversal</option>
					                		<option value="completed"{if $payRow.paystatus == "completed"} selected="selected"{/if}>Completed</option>
					                		<option value="created"{if $payRow.paystatus == "created"} selected="selected"{/if}>Created</option>
					                		<option value="denied"{if $payRow.paystatus == "denied"} selected="selected"{/if}>Denied</option>
					                		<option value="expired"{if $payRow.paystatus == "expired"} selected="selected"{/if}>Expired</option>
					                		<option value="failed"{if $payRow.paystatus == "failed"} selected="selected"{/if}>Failed</option>
					                		<option value="pending"{if $payRow.paystatus == "pending"} selected="selected"{/if}>Pending</option>
					                		<option value="refunded"{if $payRow.paystatus == "refunded"} selected="selected"{/if}>Refunded</option>
					                		<option value="reversed"{if $payRow.paystatus == "reversed"} selected="selected"{/if}>Reversed</option>
					                		<option value="processed"{if $payRow.paystatus == "processed"} selected="selected"{/if}>Processed</option>
					                		<option value="voided"{if $payRow.paystatus == "voided"} selected="selected"{/if}>Voided</option>
					                	</select>
				                	</td>
					                <td>
					                	{$payRow.time}
				                	</td>
					                <td>
					                	{if $payRow.paystatus == "canceled_reversal"} <span class="label bg-brown">Reversal canceled on {$payRow.payupdate}</span>
										{elseif $payRow.paystatus == "completed"}<span class="label label-success">Paid on {$payRow.payupdate}</span>
										{elseif $payRow.paystatus == "created"} <span class="label label-info">Created on {$payRow.payupdate}</span>
										{elseif $payRow.paystatus == "denied"} <span class="label label-danger">Denied on {$payRow.payupdate}</span>
										{elseif $payRow.paystatus == "expired"} <span class="label bg-teal">Expired on {$payRow.payupdate}</span>
										{elseif $payRow.paystatus == "failed"} <span class="label bg-indigo">Failed on {$payRow.payupdate}</span>
										{elseif $payRow.paystatus == "pending"} <span class="label label-warning">Pending {$payRow.payupdate}</span>
										{elseif $payRow.paystatus == "refunded"} <span class="label bg-purple">Refunded on {$payRow.payupdate}</span>
										{elseif $payRow.paystatus == "reversed"} <span class="label label-success">Reversed on {$payRow.payupdate}</span>
										{elseif $payRow.paystatus == "processed"} <span class="label label-success">Processed on {$payRow.payupdate}</span>
										{elseif $payRow.paystatus == "voided"} <span class="label label-success">Voided on {$payRow.payupdate}</span>
										{/if}
				                	</td>
					                <td>
					                	<h6 class="no-margin text-bold">€{$payRow.pinPrice} <small class="display-block text-muted text-size-small">{$payRow.pinCredits} antimatter</small></h6>
					                </td>
									<td class="text-center">
										<ul class="icons-list">
											<li><a href="#" data-toggle="modal" data-target="#invoice-{$payId}"><i class="icon-file-eye"></i></a></li>
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-file-text2"></i> <span class="caret"></span></a>
												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-file-download"></i> Download</a></li>
													<li><a href="#"><i class="icon-printer"></i> Print</a></li>
													<li class="divider"></li>
												</ul>
											</li>
										</ul>
									</td>
					            </tr>
								
								{/foreach}

				            </tbody>
			            </table>
					</div> 
					{foreach $PurchaseList as $payId => $payRow}
					<!-- Modal with invoice -->
					<div id="invoice-{$payId}" class="modal fade">
						<div class="modal-dialog modal-full">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h5 class="modal-title">Invoice #{$payId}</h5>
								</div>

								<div class="panel-body no-padding-bottom">
									<div class="row">
										<div class="col-md-6 content-group">
											<img src="http://www.2moons.net/images/logo_small.png" class="content-group mt-10" alt="" style="width: 120px;">
				 							<ul class="list-condensed list-unstyled">
												<li>114 Avenue du roi</li>
												<li>Forest, Belgique</li>
												<li>(+32) 0495/68.73.95</li>
											</ul>
										</div>

										<div class="col-md-6 content-group">
											<div class="invoice-details">
												<h5 class="text-uppercase text-semibold">Invoice #{$payId}</h5>
												<ul class="list-condensed list-unstyled">
													<li>Date: <span class="text-semibold">{$payRow.invoiceda}</span></li>
												</ul>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6 col-lg-9 content-group">
											<span class="text-muted">Invoice To:</span>
				 							<ul class="list-condensed list-unstyled">
												<li><h5>{$payRow.username}</h5></li>
												<li><a href="#">{$payRow.email}</a></li>
											</ul>
										</div>

										<div class="col-md-6 col-lg-3 content-group">
											<span class="text-muted">Payment Details:</span>
											<ul class="list-condensed list-unstyled invoice-payment-details">
												<li><h5>Total Due: <span class="text-right text-semibold">€{$payRow.pinPrice}</span></h5></li>
												<li>Country: <span>Belgium</span></li>
												<li>City: <span>Forest 1190</span></li>
											</ul>
										</div>
									</div>
								</div>

								<div class="table-responsive">
								    <table class="table table-lg">
								        <thead>
								            <tr>
								                <th>Description</th>
								                <th class="col-sm-1">Rate</th>
								                <th class="col-sm-1">Amount</th>
								                <th class="col-sm-1">Total</th>
								            </tr>
								        </thead>
								        <tbody>
								            <tr>
								                <td>
								                	<h6 class="no-margin">Antimatter</h6>
								                	<span class="text-muted">Purchase of antimatter on universe {$payRow.game_name} for the account {$payRow.username}.</span>
							                	</td>
								                <td>0001010/1</td>
								                <td>{$payRow.pinCredits}</td>
								                <td><span class="text-semibold">€{$payRow.pinPrice}</span></td>
								            </tr>
								        </tbody>
								    </table>
								</div>

								<div class="panel-body">
									<div class="row invoice-payment">
										<div class="col-sm-7">
											<div class="content-group">
												<h6>Authorized person</h6>
												<div class="mb-15 mt-15">
												</div>

												<ul class="list-condensed list-unstyled text-muted">
													<li>Jeremy Baukens</li>
													<li>114 Avenue du roi</li>
													<li>Forest, Belgique</li>
													<li>(+32) 0495/68.73.95</li>
												</ul>
											</div>
										</div>

										<div class="col-sm-5">
											<div class="content-group">
												<h6>Total due</h6>
												<div class="table-responsive no-border">
													<table class="table">
														<tbody>
															
															<tr>
																<th>Total:</th>
																<td class="text-right text-primary"><h5 class="text-semibold">€{$payRow.pinPrice}</h5></td>
															</tr>
														</tbody>
													</table>
												</div>

												<div class="text-right">
													<button type="button" class="btn btn-primary btn-labeled"><b><i class="icon-printer"></i></b> Print invoice</button>
												</div>
											</div>
										</div>
									</div>

									<h6>Other information</h6>
									<p class="text-muted">Thank you for using {$payRow.game_name}. This invoice is already paid with {$payRow.pinType} <br>Do you have a problem with your purchase ? then contact the billing team at billing@2moons.net. We will respond you in a delay of 24 hours.</p>
								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<!-- /modal with invoice -->
					{/foreach}
					
					
					<!-- /invoice archive -->


		            
						
{include file="overall_footer.tpl"}