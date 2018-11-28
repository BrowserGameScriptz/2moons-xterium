{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">INGAME INFORMATION</span> - Players List</h4>
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
							<li><a href="admin.php?page=playerlist">INGAME INFORMATION</a></li>
							<li>Players List</li>
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
								<div class="panel panel-flat">


									<div class="panel-body">
										
										<fieldset>
											<legend class="text-semibold">
												<i class="icon-file-text2 position-left"></i>
												Players list
												<a class="control-arrow" data-toggle="collapse" data-target="#Frame8">
													<i class="icon-circle-down2"></i>
												</a>
											</legend>
 
											<div class="collapse in" id="Frame8">
												<table class="table table-bordered table-hover datatable-highlight">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>E-mail</th>
									<th>Last activity</th>
									<th>Registration date</th>
									<th>Ultimate IP</th>
									<th>Authority</th>
									<th>Suspended?</th>
									<th>Holidays?</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
									
							{foreach $OnlineList as $userID => $onlineRow} 
								<tr>
									<td>{$userID}</td>
									<td>{$onlineRow.username}</td>
									<td>{$onlineRow.email_2}</td>
									<td>{$onlineRow.onlinetime}</td>
									<td>{$onlineRow.register_time}</td>
									<td>{$onlineRow.user_lastip}</td>
									<td>{$onlineRow.authlevel}</td>
									<td>{if $onlineRow.bana == 0}<span class="label label-success">Not banned</span>{else}<span class="label label-danger">Players banned</span>{/if}</td>
									<td>{if $onlineRow.urlaubs_modus == 0}<span class="label label-success">Not in vacation</span>{else}<span class="label label-danger">In hollidays</span>{/if}</td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-pencil5"></i> Edit Account</a></li>
													<li><a href="?page=search&amp;delete=user&amp;user={$userID}" onclick="return confirm('{$LNG.ul_sure_you_want_dlte} - {$onlineRow.username}');"><i class="glyphicon glyphicon-remove"></i> Delete Account</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
							{/foreach}	
								
							</tbody>
						</table>
											</div>
										</fieldset>
										
									</div>
								</div>
							<!-- /a legend -->
						
{include file="overall_footer.tpl"}