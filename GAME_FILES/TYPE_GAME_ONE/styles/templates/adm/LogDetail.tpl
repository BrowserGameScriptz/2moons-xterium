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
							<li><a href="admin.php?page=log&type=player">Utilities</a></li>
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



							<!-- Bordered panel body table -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Detailled Log</h5>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="reload"></a></li>
			                		<li><a data-action="close"></a></li>
			                	</ul>
		                	</div>
						</div>

						<div class="panel-body">

							<div class="table-responsive">
								<table class="table table-bordered table-framed">
									<thead>
										<tr>
											<th colspan=2>{$log_info}</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>{$log_admin}:</td>
											<td>{$admin}</td>
										</tr>
										<tr>
											<td>{$log_target}:</td>
											<td>{$target}</td>
										</tr>
										<tr>
											<td>{$log_time}:</td>
											<td>{$time}</td>
										</tr>
									</tbody>
								</table>
								<table class="table table-bordered table-framed">
									<thead>
										<tr>
											<th>{$log_element}</th>
											<th>{$log_old}</th>
											<th>{$log_new}</th>
										</tr>
									</thead>
									<tbody>
									{foreach item=LogInfo from=$LogArray}
									{if ($LogInfo.old <> $LogInfo.new)}
										<tr>
											<td>{$LogInfo.Element}</td>
											<td>{$LogInfo.old}</td>
											<td>{$LogInfo.new}</td>
										</tr>
									{/if}
									{/foreach}
									</tbody>
								</table>
								
							</div>
						</div>
						<div class="text-left">
							<button type="button" onClick="history.go(-1); return false;" class="btn btn-primary"><i class="icon-arrow-left13 position-left"></i> Return</button>
						</div>
					</div>
					<!-- /bordered panel body table -->
						
{include file="overall_footer.tpl"}