{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
	
<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Ingame Information</span> - Support Tickets</h4>
						</div>
					</div>

					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="admin.php"><i class="icon-home2 position-left"></i> Home</a></li>
							<li><a href="admin.php?page=support">Information</a></li>
							<li class="active">Support Tickets</li>
						</ul>

						<ul class="breadcrumb-elements">
							<li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
						</ul>
					</div>
				</div>
				<!-- /page header -->
				

				<!-- Content area -->
				<div class="content">
					
					<!-- Task manager table -->
					<div class="panel panel-white">
						<div class="panel-heading">
							<h6 class="panel-title">Support Tickets</h6>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="reload"></a></li>
			                		<li><a data-action="close"></a></li>
			                	</ul>
		                	</div>
						</div>

						<table class="table tasks-list table-lg">
							<thead>
								<tr>
									<th>#</th>
									<th>Period</th>
					                <th>Ticket Description</th>
					                <th>Priority</th>
					                <th>Latest update</th>
					                <th>Status</th>
					                <th>User</th>
									<th class="text-center text-muted" style="width: 30px;"><i class="icon-checkmark3"></i></th>
					            </tr>
							</thead>
							<tbody>
								{foreach $ticketList as $TicketID => $TicketInfo}	
								{if $TicketInfo.status < 2}
								<tr>
									<td>#{$TicketID}</td>
									<td>{$TicketInfo.time}</td>
					                <td>
					                	<div class="text-semibold"><a href="admin.php?page=support&amp;mode=view&amp;id={$TicketID}">{$TicketInfo.subject}</a></div>
					                	<div class="text-muted">{$TicketInfo.LastMessage}</div>
					                </td>
					                <td>
					                	<div class="btn-group">
											<a href="#" class="label label-danger dropdown-toggle" data-toggle="dropdown">Highest</a>
											
										</div>
				                	</td>
					                <td>
					                	<div class="input-group input-group-transparent">
					                		<div class="input-group-addon"><i class="icon-calendar2 position-left"></i></div>
					                		{$TicketInfo.time}
					                	</div>
				                	</td>
					                <td>
					                	<select name="status" class="select" data-placeholder="Select status" disabled="disabled">
					                		<option value="open"{if $TicketInfo.status == 0} selected="selected"{/if}>Open</option>
					                		<option value="hold"{if $TicketInfo.status == 1} selected="selected"{/if}>On hold</option>
					                		<option value="resolved"{if $TicketInfo.status == 99} selected="selected"{/if}>Resolved</option>
					                		<option value="dublicate"{if $TicketInfo.status == 100} selected="selected"{/if}>Dublicate</option>
					                		<option value="closed"{if $TicketInfo.status == 2} selected="selected"{/if}>Closed</option>
					                	</select>
					                </td>
					                <td>
					                	{$TicketInfo.username}
					                </td>
									<td class="text-center">
										<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="admin.php?page=support&amp;mode=view&amp;id={$TicketID}"><i class="icon-history"></i> Full history</a></li>
																<li class="divider"></li>
																<li><a href="#"><i class="icon-checkmark3 text-success"></i> Resolve issue</a></li>
																<li><a href="#"><i class="icon-cross2 text-danger"></i> Close issue</a></li>
															</ul>
														</li>
													</ul>
									</td>
					            </tr>
								{/if}
								{/foreach}
							</tbody>
						</table>
					</div>
					<!-- /task manager table -->
						
{include file="overall_footer.tpl"}