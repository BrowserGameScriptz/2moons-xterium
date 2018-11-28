{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Server Settings</span> - Proxy Settings	</h4>
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
							<li><a href="admin.php?page=proxyset">Server Settings</a></li>
							<li class="active">Proxy Settings	</li>
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
												Proxy Settings	
												<a class="control-arrow" data-toggle="collapse" data-target="#Frame1">
													<i class="icon-circle-down2"></i>
												</a>
											</legend>
 
											<div class="collapse in" id="Frame1">
												<div class="form-group">
													<label class="col-lg-3 control-label"></label>
													<div class="col-lg-9">
													<div class="checkbox checkbox-switch">
													<label>
													<input type="checkbox" name="proxyConfig" {if $proxyConfig}checked="checked"{/if} data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch">
													Enable proxy verification
													</label>
													</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"></label>
													<div class="col-lg-9">
													<div class="checkbox checkbox-switch">
													<label>
													<input type="checkbox" name="proxyAlert" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch"{if $proxyAlert} checked="checked"{/if}>
													Alert the player that he use a proxy
													</label>
													</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"></label>
													<div class="col-lg-9">
													<div class="checkbox checkbox-switch">
													<label>
													<input type="checkbox" name="proxyBlock" data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch"{if $proxyBlock} checked="checked"{/if}>
													Block user actions automaticaly
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
							
							<!-- Basic responsive configuration -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Latest 100 Proxy Connexions</h5>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                	</ul>
		                	</div>
						</div>

						<div class="panel-body">
						
						</div>

						<table class="table datatable-responsive">
							<thead>
								<tr>
									<th>userId</th>
									<th>Username</th>
									<th>Ip Address</th>
									<th>Internet Service Provider</th>
									<th>Date</th>
									<th class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
								{foreach $ProxyList as $suspectId => $proxyRow}
								<tr>
									<td>{$proxyRow.userId}</td>
									<td>{$proxyRow.nickname}</td>
									<td><a href="https://myip.ms/info/whois/{$proxyRow.ipadress}" target="_BLANK">{$proxyRow.ipadress}</a></td>
									<td>{$proxyRow.opsystem}</td>
									<td><span class="label label-default">{$proxyRow.timestamp}</span></td>
									<td class="text-center">
										<ul class="icons-list">
											<li class="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													<i class="icon-menu9"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right">
													<li><a href="#"><i class="icon-file-pdf"></i> Block Player Action</a></li>
													<li><a href="#"><i class="icon-file-excel"></i> Ban Player</a></li>
												</ul>
											</li>
										</ul>
									</td>
								</tr>
								{/foreach}
							</tbody>
						</table>
					</div>
					<!-- /basic responsive configuration -->
						
{include file="overall_footer.tpl"}