{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">INGAME INFORMATION</span> - Account Information</h4>
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
							<li><a href="admin.php?page=overview"><i class="icon-home2 position-left"></i> Home</a></li>
							<li><a href="admin.php?page=accountdata">Ingame Information</a></li>
							<li>Account Information</li>
						</ul>

						<ul class="breadcrumb-elements">
							<li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
							
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">


					<form class="form-horizontal" method="post" name="users">
					<!-- Using API -->
					<div class="panel panel-flat">

						<table class="table" width="100%">
							<thead>
								<tr>
						            <td>
										<select name="id_u" size="20" style="width:100%;">
											{$Userlist}
										</select>
										<SCRIPT type="text/javascript">
											var UserList = new filterlist(document.users.id_u);
										</SCRIPT>
										<br><br>
										<div class="form-group has-feedback has-feedback-left">
											<input type="text" class="form-control input-lg" name="regexp" placeholder="Ente the username to filter the list" onKeyUp="UserList.set(this.value)">
											<div class="form-control-feedback">
												<i class="icon-search4"></i>
											</div>
										</div>
									</td>
						        </tr>
								
							</thead>
						</table>
						
					</div>
					<!-- /using API -->
					
					<div class="text-right">
							<button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
						</div>
					</form>
{include file="overall_footer.tpl"}