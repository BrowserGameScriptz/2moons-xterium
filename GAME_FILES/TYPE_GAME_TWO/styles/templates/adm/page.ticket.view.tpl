{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
<!-- Secondary sidebar -->
			<div class="sidebar sidebar-secondary sidebar-default">
				<div class="sidebar-content">

					<!-- Search messages -->
					<div class="sidebar-category">
						<div class="category-title">
							<span>Search messages</span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>

						<div class="category-content">
							<form action="#">
								<div class="has-feedback has-feedback-left">
									<input type="search" class="form-control" placeholder="Type and hit Enter">
									<div class="form-control-feedback">
										<i class="icon-search4 text-size-base text-muted"></i>
									</div>
								</div>
							</form>
						</div>
					</div>
					<!-- /search messages -->


					<!-- Actions -->
					<div class="sidebar-category">
						<div class="category-title">
							<span>Actions</span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>

						<div class="category-content">
							{if $ticket_status == 2}<a href="admin.php?page=support&mode=changestatus&ticketid={$ticketID}&action=open" class="btn bg-success-400 btn-rounded btn-block btn-xs">Re-open ticket</a>{else}<a href="admin.php?page=support&mode=changestatus&ticketid={$ticketID}&action=close" class="btn bg-pink-400 btn-rounded btn-block btn-xs">Close ticket</a>{/if}
							<a href="#" class="btn bg-teal-400 btn-rounded btn-block btn-xs">Merge ticket</a>
						</div>
					</div>
					<!-- /actions -->


					<!-- Sub navigation -->
					<div class="sidebar-category">
						<div class="category-title">
							<span>Navigation</span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>

						<div class="category-content no-padding">
							<ul class="navigation navigation-alt navigation-accordion">
								
								<li><a href="admin.php?page=support"><i class="icon-files-empty"></i> All tickets <span class="badge badge-danger">{$TotalCounts}</span></a></li>
								<li><a href="admin.php?page=support&type=active"><i class="icon-file-plus"></i> Active tickets <span class="badge badge-default">{$activeCounts}</span></a></li>
								<li><a href="admin.php?page=support&type=closed"><i class="icon-file-locked"></i> Closed tickets</a></li>
								
							</ul>
						</div>
					</div>
					<!-- /sub navigation -->


					<!-- Latest updates -->
					<div class="sidebar-category">
						<div class="category-title">
							<span>Latest updates</span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>

						<div class="category-content">
							<ul class="media-list">
								<li class="media">
									<div class="media-left"><a href="#" class="btn border-success text-success btn-flat btn-icon btn-sm btn-rounded"><i class="icon-checkmark3"></i></a></div>
									<div class="media-body">
										<a href="#">Richard Vango</a> has been registered
										<div class="media-annotation">4 minutes ago</div>
									</div>
								</li>

								<li class="media">
									<div class="media-left"><a href="#" class="btn border-slate text-slate btn-flat btn-icon btn-sm btn-rounded"><i class="icon-infinite"></i></a></div>
									<div class="media-body">
										Server went offline for monthly maintenance
										<div class="media-annotation">36 minutes ago</div>
									</div>
								</li>

								<li class="media">
									<div class="media-left"><a href="#" class="btn border-success text-success btn-flat btn-icon btn-sm btn-rounded"><i class="icon-checkmark3"></i></a></div>
									<div class="media-body">
										<a href="#">Chris Arney</a> has been registered
										<div class="media-annotation">2 hours ago</div>
									</div>
								</li>

								<li class="media">
									<div class="media-left"><a href="#" class="btn border-danger text-danger btn-flat btn-icon btn-sm btn-rounded"><i class="icon-cross2"></i></a></div>
									<div class="media-body">
										<a href="#">Chris Arney</a> left main conversation
										<div class="media-annotation">Dec 18, 18:36</div>
									</div>
								</li>

								<li class="media">
									<div class="media-left"><a href="#" class="btn border-primary text-primary btn-flat btn-icon btn-sm btn-rounded"><i class="icon-plus3"></i></a></div>
									<div class="media-body">
										<a href="#">Beatrix Diaz</a> just joined conversation
										<div class="media-annotation">Dec 12, 05:46</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<!-- /latest updates -->
				</div>
			</div>
			<!-- /secondary sidebar -->
<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Support Tickets</span> - [#{$ticketID}] {$ticket_subject}</h4>
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
							<li><a href="admin.html"><i class="icon-home2 position-left"></i> Home</a></li>
							<li><a href="admin.php?page=support">Support Tickets</a></li>
							<li class="active">[#{$ticketID}] {$ticket_subject}</li>
						</ul>

						<ul class="breadcrumb-elements">
							<li><a href="#"><i class="icon-comment-discussion position-left"></i> Support Tickets</a></li>
							
						</ul>
					</div>
				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- Basic layout -->
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">[#{$ticketID}] {$ticket_subject}</h6>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="reload"></a></li>
			                	</ul>
		                	</div>
						</div>

						<div class="panel-body">
							<ul class="media-list chat-list content-group">
								
								{foreach $answerList as $answerID => $answerRow}
								<li class="media{if $answerRow.isAdmin > 0} reversed{/if}">
								{if $answerRow.isAdmin > 0}
									<div class="media-body">
										<div class="media-content">{$answerRow.message}</div>
										<span class="media-annotation display-block mt-10">{$answerRow.time} ago <a href="#"><i class="icon-pin-alt position-right text-muted"></i> {$answerRow.ownerName}</a></span>
									</div>

									<div class="media-right">
										<a href="assets/images/admin_ava.jpg">
											<img src="assets/images/admin_ava.jpg" class="img-circle" alt="">
										</a>
									</div>

								{else}
									<div class="media-left">
										<a href="assets/images/Xterium.jpg">
											<img src="assets/images/Xterium.jpg" class="img-circle" alt="">
										</a>
									</div>

									<div class="media-body">
										<div class="media-content">{$answerRow.message}</div>
										<span class="media-annotation display-block mt-10">{$answerRow.time} ago <a href="#"><i class="icon-pin-alt position-right text-muted"></i> {$answerRow.ownerName}</a></span>
									</div>
								{/if}
								</li>
								{/foreach}
								
					
								
							</ul>
							{if $ticket_status != 2}<form action="admin.php?page=support&mode=send" method="post" id="form">
							<input type="hidden" name="id" value="{$ticketID}">
	                    	<textarea name="enter-message" class="form-control content-group" name="message" rows="3" cols="1" placeholder="Enter your message..."></textarea>{/if}

	                    	<div class="row">
	                    		<div class="col-xs-6">
		                        	{*<ul class="icons-list icons-list-extended mt-10">
		                                <li><a href="#" data-popup="tooltip" title="Send photo" data-container="body"><i class="icon-file-picture"></i></a></li>
		                            	<li><a href="#" data-popup="tooltip" title="Send video" data-container="body"><i class="icon-file-video"></i></a></li>
		                                <li><a href="#" data-popup="tooltip" title="Send file" data-container="body"><i class="icon-file-plus"></i></a></li>
		                            </ul>*}
	                    		</div>
								
	                    		<div class="col-xs-6 text-right">
		                            {if $ticket_status != 2}<button type="button" onclick="location.href='admin.php?page=support&mode=changestatus&ticketid={$ticketID}&action=close';" class="btn bg-danger-400 btn-labeled btn-labeled-right"><b><i class="icon-cross2"></i></b> Close</button>
									{else}
									<button type="button" onclick="location.href='admin.php?page=support&mode=changestatus&ticketid={$ticketID}&action=open';" class="btn bg-success-400 btn-labeled btn-labeled-right"><b><i class="icon-checkmark3"></i></b> Re-open</button>
									{/if}
		                            {if $ticket_status != 2}<button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-circle-right2"></i></b> Send</button>{/if}
	                    		</div>
	                    	</div>
							{if $ticket_status != 2}</form>{/if}
						</div>
					</div>
					<!-- /basic layout -->


					

				
						
{include file="overall_footer.tpl"}