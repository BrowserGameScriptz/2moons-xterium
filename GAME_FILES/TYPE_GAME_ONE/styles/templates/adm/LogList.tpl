{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">UTILITIES</span> - {$pageTitle}</h4>
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
							<li><a href="admin.php?page=log&type={$pageactiveshow1}">Utilities</a></li>
							<li>{$pageTitle}</li>
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
												{$pageTitle}
												<a class="control-arrow" data-toggle="collapse" data-target="#Frame8">
													<i class="icon-circle-down2"></i>
												</a>
											</legend>
 
											<div class="collapse in" id="Frame8">
												<table class="table table-bordered table-hover datatable-highlight">
							<thead>
								<tr>
									<th>{$log_id}</th>
									<th>{$log_admin}</th>
									<th>{$log_uni}</th>
									<th>{$log_target}</th>
									<th>{$log_time}</th>
									<th class="text-center">{$log_log}</th>
								</tr>
							</thead>
							<tbody>
									
							{foreach item=LogInfo from=$LogArray}
								<tr>
									<td>{$LogInfo.id}</td>
									<td>{$LogInfo.admin}</td>
									<td>{$LogInfo.target_uni}</td>
									<td>{$LogInfo.target}</td>
									<td>{$LogInfo.time}</td>
									<td class="text-center"><a href='?page=log&type=detail&id={$LogInfo.id}'>{$log_view}</a></td>
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