{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Verification</span> - Live Checker</h4>
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
							<li><a href="admin.php?page=livechecker">Verification</a></li>
							<li class="active">Live Checker</li>
						</ul>

						<ul class="breadcrumb-elements">
							<li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
							
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">
					
					
							<!-- Custom row colors -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="reload"></a></li>
			                	</ul>
		                	</div>
						</div>

						<div class="panel-body">
							<div class="alert alert-danger alert-styled-left alert-bordered">
										<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
										<span class="text-semibold">Oh snap!</span> The game is not fully configured to go online. <a href="#" class="alert-link">try submitting again</a>. (you can contact your support team if you have trouble getting your game online.)
								    </div>
						</div>

						<div class="table-responsive">
							<table class="table">
			                    <thead>
			                        <tr>
			                            <th>#</th>
			                            <th>Object</th>
			                            <th>Solution</th>
			                        </tr>
			                    </thead>
			                    <tbody>
			                        <tr class="bg-{$errorsTitleColor}">
			                            <td>1</td>
			                            <td>Meta Title</td>
			                            <td>{$errorsTitleMessage}</td>
			                        </tr>
									<tr class="bg-{$errorsDescripColor}">
			                            <td>2</td>
			                            <td>Meta Description</td>
			                            <td>{$errorsDescripMessage}</td>
			                        </tr>
									<tr class="bg-success">
			                            <td>3</td>
			                            <td>Admin Name</td>
			                            <td>You have succesfully provided an administrator name. [success]	</td>
			                        </tr>
									<tr class="bg-success">
			                            <td>4</td>
			                            <td>Admin Email</td>
			                            <td>You have succesfully provided an administrator email. [success]	</td>
			                        </tr>
									<tr class="bg-danger">
			                            <td>5</td>
			                            <td>Statistics Configuration</td>
			                            <td>You have to configure the statistics options for your game. [you can do this by clicking here.]	</td>
			                        </tr>
			                    </tbody>
			                </table>
						</div>
					</div>
					<!-- /custom row colors -->
						
{include file="overall_footer.tpl"}