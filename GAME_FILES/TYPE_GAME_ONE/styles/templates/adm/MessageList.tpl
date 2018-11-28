{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">INGAME INFORMATION</span> - Message List</h4>
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
							<li><a href="admin.php?page=messagelist">INGAME INFORMATION</a></li>
							<li class="active">Message List</li>
						</ul>

						<ul class="breadcrumb-elements">
							<li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-gear position-left"></i>
									Settings
									<span class="caret"></span>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">


					<!-- Individual column searching (text inputs) -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Message List</h5>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                	</ul>
		                	</div>
						</div>


						<table class="table datatable-column-search-inputs">
							<thead>
								<tr>
					                <th>{$LNG.ml_type}</th>
									<th>{$LNG.ml_subject}</th>
					                <th>{$LNG.ml_date}</th>
					                <th>{$LNG.ml_sender}</th>
					                <th>{$LNG.ml_receiver}</th>
					                <th>{$LNG.ml_id}</th>
					            </tr>
							</thead>
							<tbody>
							
							{foreach $messageList as $messageID => $messageRow}
								<tr data-messageID="{$messageID}">
					                <td>{$LNG.mg_type[$messageRow.type]}</td>
					                <td>{$messageRow.subject}</td>
					                <td>{$messageRow.time}</td>
					                <td>{$messageRow.sender}</td>
					                <td>{$messageRow.receiver}</td>
									<td><a href="#" data-toggle="modal" data-target="#modal_theme_success{$messageID}">{$messageID}</a></td>
					            </tr>
								 <!-- Success modal -->
								<div id="modal_theme_success{$messageID}" class="modal fade">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header bg-success">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h6 class="modal-title">{$messageRow.subject}</h6>
											</div>

											<div class="modal-body">
												<p>{$messageRow.text}</p>
												<hr>

												
											</div>

											<div class="modal-footer">
												<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
								<!-- /success modal -->
								
					        {/foreach} 
							</tbody>
							<tfoot>
								<tr>
					                <td>Type</td>
					                <td>Subject</td>
					                <td>Start Date</td>
					                <td>Sender</td>
					                <td>Receiver</td>
					                <td></td>
					            </tr>
							</tfoot>
						</table>
					</div>
					<!-- /individual column searching (text inputs) -->

					
{include file="overall_footer.tpl"}