{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">INGAME INFORMATION</span> - Hof Comments</h4>
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
							<li><a href="admin.php?page=commentlist">INGAME INFORMATION</a></li>
							<li class="active">Hof Comments</li>
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
							<h5 class="panel-title">Hof Comments</h5>
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
									<th>{$LNG.ml_date}</th>
					                <th>{$LNG.ml_sender}</th>
					                <th>Reference</th>
					                <th>Is Flagged</th>
					                <th>{$LNG.ml_id}</th>
					            </tr>
							</thead>
							<tbody>
							
							{foreach $messageList as $messageID => $messageRow}
								<tr data-messageID="{$messageID}">
					                <td>Hof comment</td>
					                <td>{$messageRow.time}</td>
					                <td>{$messageRow.sender}</td>
					                <td>{$messageRow.rid}</td>
					                <td>{$messageRow.flagged}<span id="approuved_{$messageID}">{$messageRow.isApprouved}</span></td>
									
									<td><a href="#" data-toggle="modal" data-target="#modal_theme_success{$messageID}">{$messageID}</a></td>
					            </tr>
								 <!-- Success modal -->
								<div id="modal_theme_success{$messageID}" class="modal fade">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header bg-success">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h6 class="modal-title">Hof Comment #{$messageID}</h6>
											</div>

											<div class="modal-body">
												<p>{$messageRow.text}</p>
												<hr>

												
											</div>

											<div class="modal-footer">
												{if $messageRow.flaggeds == 1}<button type="button" class="btn btn-link" data-dismiss="modal" onclick="Approuve({$messageID})">Aprouve</button>{/if}
												
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
					                <td>Date</td>
					                <td>Sender</td>
					                <td>Reference</td>
					                <td>Flagged</td>
					                <td></td>
					            </tr>
							</tfoot>
						</table>
					</div>
					<!-- /individual column searching (text inputs) -->
<script type="text/javascript">
function Approuve(commentId)
{
	$.ajax({
	  url: '?page=commentlist',
	  type: 'post',
	  data: { MsgID:commentId },
	  dataType: 'json',
	  success: function(data){
		var Approuve = data.Approuve;
		
	 },
	 error: function(data){
		$("#approuved_"+commentId).text(" - Approuved");
		$("#approuved_"+commentId).css("color","red");
	 }
	});
}
</script>					
{include file="overall_footer.tpl"}