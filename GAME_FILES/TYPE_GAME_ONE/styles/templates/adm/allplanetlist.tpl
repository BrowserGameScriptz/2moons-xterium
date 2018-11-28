{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">INGAME INFORMATION</span> - {$titlePage}</h4>
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
							<li><a href="admin.php?page={$pageactiveshow}">INGAME INFORMATION</a></li>
							<li>{$titlePage}</li>
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
												{$titlePage}
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
									<th>Owner</th>
									<th>Last activity</th>
									<th>Galaxy</th>
									<th>System</th>
									<th>Planet</th>
									<th>Have moon ?</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
									
							{foreach $OnlineList as $planetID => $planetRow} 
								<tr>
									<td>{$planetID}</td>
									<td>{$planetRow.name}</td>
									<td>{$planetRow.userName} (ID: {$planetRow.userID})</td>
									<td>{$planetRow.lastact}</td>
									<td>{$planetRow.galaxy}</td>
									<td>{$planetRow.system}</td>
									<td>{$planetRow.planet}</td>
									<td>{if $planetRow.id_luna == 0}<span class="label label-danger">No</span>{else}<span class="label label-success">Yes</span>{/if}</td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-pencil5"></i> Edit Planet</a></li>
													<li><a href="?page={$pageactiveshow}&amp;delete=planet&amp;planet={$planetID}" onclick="return confirm('{$LNG.se_confirm_planet} - {$planetRow.name}');"><i class="glyphicon glyphicon-remove"></i> Delete Planet</a></li>
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