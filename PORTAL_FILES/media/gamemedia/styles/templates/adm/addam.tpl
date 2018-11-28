{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Purchases</span> - Paysafe Process</h4>
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
							<li><a href="admin.php?page=addam">Purchases</a></li>
							<li class="active">Paysafe Process</li>
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
							<h6 class="panel-title">Paysafe Process</h6>
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
								
									<td>#{$payId} - <a href="http://world2.xterium.space/media/files/paysafe/{$payRow.payimage}" target="_blank">(Verify)</a></td>
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
											<li><a href="admin.php?page=addam&action=process&payid={$payId}"><i class="icon-file-eye"></i></a></li>
										</ul>
									</td>
					            </tr>
								
								{/foreach}

				            </tbody>
			            </table>
					</div>  
{include file="overall_footer.tpl"}