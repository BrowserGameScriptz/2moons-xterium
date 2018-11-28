{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">

					<!-- Header content -->
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Account Information</span> - Profile</h4>

							<ul class="breadcrumb position-right">
								<li><a href="admin.php">Home</a></li>
								<li><a href="admin.php?page=accountdata">Account Information</a></li>
								<li class="active">Profile</li>
							</ul>
						</div>

						<div class="heading-elements">
							<div class="heading-btn-group">
								<a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
								<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
								<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
							</div>
						</div>
					</div>
					<!-- /header content -->


					<!-- Toolbar -->
					<div class="navbar navbar-default navbar-xs">
						<ul class="nav navbar-nav visible-xs-block">
							<li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
						</ul>

						<div class="navbar-collapse collapse" id="navbar-filter">
							<ul class="nav navbar-nav element-active-slate-400">
								<li class="active"><a href="#profil" data-toggle="tab"><i class="icon-menu7 position-left"></i> Profil information</a></li>
								<li><a href="#logs" data-toggle="tab"><i class="icon-calendar3 position-left"></i> Player logs</a></li>
								<li><a href="#antimatter" data-toggle="tab"><i class="icon-calendar3 position-left"></i> Antimatter logs</a></li>
								<li><a href="#pagesvisits" data-toggle="tab"><i class="icon-file-eye position-left"></i> Pages visited</a></li>
								<li><a href="#notes" data-toggle="tab"><i class="icon-stack-text position-left"></i> Notes</a></li>
								<li><a href="#friends" data-toggle="tab"><i class="icon-collaboration position-left"></i> Friends</a></li>
							</ul>

	
						</div>
					</div>
					<!-- /toolbar -->

				</div>
				<!-- /page header -->


				<!-- Content area -->
				<div class="content">

					<!-- User profile -->
					<div class="row">
						<div class="col-lg-9">
							<div class="tabbable">
								<div class="tab-content">
									<div class="tab-pane fade in active" id="profil">

										<!-- Timeline -->
										<div class="timeline timeline-left content-group">
											<div class="timeline-container">

												
												<!-- Account details -->
												<div class="timeline-row">
													<div class="timeline-icon">
														<div class="bg-warning-400">
															<i class="icon-cash3"></i>
														</div>
													</div>
													<div class="panel panel-flat panel-collapsed">
														<div class="panel-heading">
															<h5 class="panel-title">{$ac_account_data}</h5>
															<div class="heading-elements">
																<ul class="icons-list">
																	<li><a data-action="collapse"></a></li>
																</ul>
															</div>
														</div>

														<div class="panel-body">
															<div class="table-responsive">
																<table class="table table-bordered table-framed">
																	<tbody>
																		<tr><td height="22px">{$input_id}</td><td>{$id}</td></tr>
																		<tr><td height="22px">{$ac_name}</td><td>{$nombre}</td></tr>
																		<tr><td height="22px">{$ac_mail}</td><td>{$email_1}</td></tr>
																		<tr><td height="22px">{$ac_perm_mail}</td><td>{$email_2}</td></tr>
																		<tr><td height="22px">{$ac_auth_level}</td><td>{$nivel}</td></tr>
																		<tr><td height="22px">{$ac_on_vacation}</td><td>{$vacas}</td></tr>
																		<tr><td height="22px">{$ac_banned}</td><td>{$suspen} {$mas}</td></tr>
																		<tr><td height="22px">{$ac_alliance}</td><td>{$alianza}{$id_ali}</td></tr>
																		<tr><td height="22px">{$ac_reg_ip}</td><td>{$ip}</td></tr>
																		<tr><td height="22px">{$ac_last_ip}</td><td>{$ip2}</td></tr>
																		<tr><td height="22px">{$ac_checkip_title}</td><td>{$ipcheck}</td></tr>
																		<tr><td height="22px">{$ac_register_time}</td><td>{$reg_time}</td></tr>
																		<tr><td height="22px">{$ac_act_time}</td><td>{$onlinetime}</td></tr>
																		<tr><td height="22px">{$ac_home_planet_id}</td><td>{$id_p}</td></tr>
																		<tr><td height="22px">{$ac_home_planet_coord}</td><td>[{$g}:{$s}:{$p}]</td></tr>
																		{if $info}<tr><td height="22px">{$ac_user_system}</td><td>{$info}</td></tr>{/if}
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
												<!-- /Account details -->
												{if $alianzid != 0}
												<!-- Alliance -->
												<div class="timeline-row">
													<div class="timeline-icon">
														<div class="bg-warning-400">
															<i class="icon-cash3"></i>
														</div>
													</div>
													<div class="panel panel-flat panel-collapsed">
														<div class="panel-heading">
															<h5 class="panel-title">{$AllianceHave}</h5>
															<div class="heading-elements">
																<ul class="icons-list">
																	<li><a data-action="collapse"></a></li>
																</ul>
															</div>
														</div>

														<div class="panel-body">
															<div class="table-responsive">
																<table class="table table-bordered table-framed">
																	<tbody>
																		<tr><th colspan="2">{$ac_info_ally}</th></tr>
																			<tr><td width="25%" align="center" >{$input_id}</td><td>{$id_aliz}</td></tr>
																			<tr><td>{$ac_leader}</td><td>{$ali_lider}</td></tr>
																			<tr><td>{$ac_tag}</td><td>{$tag}</td></tr>
																			<tr><td>{$ac_name_ali}</td><td>{$ali_nom}</td></tr>
																			<tr><td>{$ac_ext_text}</td><td>{$ali_ext}</td></tr>
																			<tr><td>{$ac_int_text}</td><td>{$ali_int}</td></tr>
																			<tr><td>{$ac_sol_text}</td><td>{$ali_sol}</td></tr>
																			<tr><td>{$ac_image}</td><td>{$ali_logo}</td></tr>
																			<tr><td>{$ac_ally_web}</td><td>{$ali_web}</td></tr>
																			<tr><td>{$ac_register_ally_time}</td><td>{$ally_register_time}</td></tr>
																			<tr><td>{$ac_total_members}</td><td>{$ali_cant}</td></tr>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
												<!-- /Alliance -->
												{/if}
												<!-- ID, name and Coordinates -->
												<div class="timeline-row">
													<div class="timeline-icon">
														<div class="bg-warning-400">
															<i class="icon-cash3"></i>
														</div>
													</div>
													<div class="panel panel-flat panel-collapsed">
														<div class="panel-heading">
															<h5 class="panel-title">{$ac_id_names_coords}</h5>
															<div class="heading-elements">
																<ul class="icons-list">
																	<li><a data-action="collapse"></a></li>
																</ul>
															</div>
														</div>

														<div class="panel-body">
															<div class="table-responsive">
																<table class="table table-bordered table-framed">
																	<thead>
																		<tr>
																			<th>{$ac_name}</th>
																			<th>{$input_id}</th>
																			<th>{$ac_diameter}</th>
																			<th>{$ac_fields}</th>
																			<th>{$ac_temperature}</th>
																		</tr>
																	</thead>
																	<tbody>
																		{$planets_moons}
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
												<!-- /ID, name and Coordinates -->
												
												<!-- Resources -->
												<div class="timeline-row">
													<div class="timeline-icon">
														<div class="bg-warning-400">
															<i class="icon-cash3"></i>
														</div>
													</div>
													<div class="panel panel-flat panel-collapsed">
														<div class="panel-heading">
															<h5 class="panel-title">{$resources_title}</h5>
															<div class="heading-elements">
																<ul class="icons-list">
																	<li><a data-action="collapse"></a></li>
																</ul>
															</div>
														</div>

														<div class="panel-body">
															<div class="table-responsive">
																<table class="table table-bordered table-framed">
																	<thead>
																		<tr>
																			<th>{$ac_name}</th>
																			<th>{$Metal}</th>
																			<th>{$Crystal}</th>
																			<th>{$Deuterium}</th>
																			<th>{$Energy}</th>
																		</tr>
																	</thead>
																	<tbody>
																		{$resources}
																		<tr>
																			<td colspan="5" height="30px">{$Darkmatter}: &nbsp;&nbsp;{$mo}</td>
																		</tr>
																		<tr>
																			<td colspan="5" height="30px">{$Antimatter}: &nbsp;&nbsp;{$md}</td>
																		</tr>
																		<tr>
																			<td colspan="5" height="30px">{$antimatter_bought}: &nbsp;&nbsp;{$mdd}</td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
												<!-- /Resources -->
												
												<!-- Buildings -->
												<div class="timeline-row">
													<div class="timeline-icon">
														<div class="bg-warning-400">
															<i class="icon-cash3"></i>
														</div>
													</div>
													<div class="panel panel-flat panel-collapsed">
														<div class="panel-heading">
															<h5 class="panel-title">{$buildings_title}</h5>
															<div class="heading-elements">
																<ul class="icons-list">
																	<li><a data-action="collapse"></a></li>
																</ul>
															</div>
														</div>

														<div class="panel-body">
															<div class="table-responsive">
																<table class="table table-bordered table-framed">
																	<thead>
																		{$names}
																	</thead>
																	<tbody>
																		{$build}
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
												<!-- /Buildings -->
												
												<!-- Research -->
												<div class="timeline-row">
													<div class="timeline-icon">
														<div class="bg-warning-400">
															<i class="icon-cash3"></i>
														</div>
													</div>
													<div class="panel panel-flat panel-collapsed">
														<div class="panel-heading">
															<h5 class="panel-title">{$ac_officier_research}</h5>
															<div class="heading-elements">
																<ul class="icons-list">
																	<li><a data-action="collapse"></a></li>
																</ul>
															</div>
														</div>

														<div class="panel-body">
															<div class="table-responsive">
																<table class="table table-bordered table-framed">
																	<thead>
																		<tr>
																		<th width="50%">{$researchs_title}</th>
																		<th width="50%">{$officiers_title}</th>
																		</tr>
																	</thead>
																	<tbody>
																		{$techoffi}
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
												<!-- /Research -->
												
												<!-- Ships -->
												<div class="timeline-row">
													<div class="timeline-icon">
														<div class="bg-warning-400">
															<i class="icon-cash3"></i>
														</div>
													</div>
													<div class="panel panel-flat panel-collapsed">
														<div class="panel-heading">
															<h5 class="panel-title">{$ships_title}</h5>
															<div class="heading-elements">
																<ul class="icons-list">
																	<li><a data-action="collapse"></a></li>
																</ul>
															</div>
														</div>

														<div class="panel-body">
															<div class="table-responsive">
																<table class="table table-bordered table-framed">
																	<thead>
																		{$names}
																	</thead>
																	<tbody>
																		{$fleet}
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
												<!-- /Ships -->
												
												<!-- Defences -->
												<div class="timeline-row">
													<div class="timeline-icon">
														<div class="bg-warning-400">
															<i class="icon-cash3"></i>
														</div>
													</div>
													<div class="panel panel-flat panel-collapsed">
														<div class="panel-heading">
															<h5 class="panel-title">{$defenses_title}</h5>
															<div class="heading-elements">
																<ul class="icons-list">
																	<li><a data-action="collapse"></a></li>
																</ul>
															</div>
														</div>

														<div class="panel-body">
															<div class="table-responsive">
																<table class="table table-bordered table-framed">
																	<thead>
																		<tr>
																			{$names}
																		</tr>
																	</thead>
																	<tbody>
																		{$defense}
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
												<!-- /Defences -->
																								
												<!-- Planets destroyed recently -->
												<div class="timeline-row">
													<div class="timeline-icon">
														<div class="bg-warning-400">
															<i class="icon-cash3"></i>
														</div>
													</div>
													<div class="panel panel-flat panel-collapsed">
														<div class="panel-heading">
															<h5 class="panel-title">Planets destroyed recently (Does not exist any planet destroyed recently)</h5>
															<div class="heading-elements">
																<ul class="icons-list">
																	<li><a data-action="collapse"></a></li>
																</ul>
															</div>
														</div>

														<div class="panel-body">
															<div class="table-responsive">
																<table class="table table-bordered table-framed">
																	<thead>
																		<tr>
																			<th>{$ac_name}</th>
																			<th>{$input_id}</th>
																			<th>{$ac_coords}</th>
																			<th>{$ac_time_destruyed}</th>
																		</tr>
																	</thead>
																	<tbody>
																		{$destroyed}
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
												<!-- /Planets destroyed recently -->

											</div>
									    </div>
									    <!-- /timeline -->

									</div>


									<div class="tab-pane fade" id="logs">
										<!-- Advanced legend -->
											<div class="panel panel-flat">


												<div class="panel-body">
													
													<fieldset>
														<legend class="text-semibold">
															<i class="icon-file-text2 position-left"></i>
															Player Logs
															<a class="control-arrow" data-toggle="collapse" data-target="#Frame8">
																<i class="icon-circle-down2"></i>
															</a>
														</legend>
			 
														<div class="collapse in" id="Frame8">
															<table class="table table-bordered table-hover datatable-highlight">
																<thead>
																	<tr>
																		<th>{$log_id}</th>
																		<th>Player</th>
																		<th>Page Action</th>
																		<th>{$log_time}</th>
																		<th class="text-center">{$log_log}</th>
																	</tr>
																</thead>
																<tbody>
																		
																{foreach item=LogInfo from=$LogArray}
																	<tr>
																		<td>{$LogInfo.trackId}</td>
																		<td>{$LogInfo.admin}</td>
																		<td>{$LogInfo.pageVisited}</td>
																		<td>{$LogInfo.time}</td>
																		<td class="text-center"><a href="#" data-toggle="modal" data-target="#modal_full{$LogInfo.trackId}">{$log_view}</a></td>
																	</tr>
																	 
																{/foreach}	
																	
																</tbody>
															</table>
														</div>
														{foreach item=LogInfo from=$LogArray}
														<!-- Full width modal -->
																		<div id="modal_full{$LogInfo.trackId}" class="modal fade">
																			<div class="modal-dialog modal-full">
																				<div class="modal-content">
																					<div class="modal-header">
																						<button type="button" class="close" data-dismiss="modal">&times;</button>
																						<h5 class="modal-title">Log #{$LogInfo.trackId}</h5>
																					</div>

																					<div class="modal-body">
																						
																								<table class="table table-bordered table-framed">
																								<thead>
																									<tr>
																										<th colspan=2>{$log_info}</th>
																									</tr>
																								</thead>
																								<tbody>
																									<tr>
																										<td>Player:</td>
																										<td>{$LogInfo.admin}</td>
																									</tr>
																									<tr>
																										<td>Page Visited:</td>
																										<td>{$LogInfo.pageVisited}</td>
																									</tr>
																									<tr>
																										<td>{$log_time}:</td>
																										<td>{$LogInfo.time}</td>
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
																								{foreach item=LogInfo1 from=$LogInfo.LogArray1}
																									<tr>
																										<td>{$LogInfo1.Element}</td>
																										<td>{$LogInfo1.old}</td>
																										<td>{$LogInfo1.new}</td>
																									</tr>
																								{/foreach}
																								</tbody>
																							</table>
																							
																							
																					</div>

																					<div class="modal-footer">
																						<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
																					</div>
																				</div>
																			</div>
																		</div>
																		<!-- /full width modal -->
																		{/foreach}
													</fieldset>
													
												</div>
											</div>
										<!-- /a legend -->
									</div>

									<div class="tab-pane fade" id="antimatter">
										<!-- Basic responsive table -->
										<div class="panel panel-flat">


											<div class="table-responsive">
												<table class="table">
													<thead>
														<tr>
															<th>Track Id</th>
															<th>Temporary Antimatter</th>
															<th>New Antimatter</th>
															<th>Difference</th>
															<th>Date</th>
														</tr>
													</thead>
													<tbody>
														{foreach item=LogInfo2 from=$LogArray2}
															<tr>
																<td>{$LogInfo2.trackId}</td>
																<td>{$LogInfo2.tmpAntimatter|number}</td>
																<td>{$LogInfo2.newAntimatter|number}</td>
																<td>{$LogInfo2.trackDifference|number}</td>
																<td>{$LogInfo2.time}</td>
															</tr>
														{/foreach}
													</tbody>
												</table>
											</div>
										</div>
										<!-- /basic responsive table -->
									</div>
									
									
									<div class="tab-pane fade" id="pagesvisits">
										<!-- Scrollable table -->
											<div class="panel panel-flat">
												
												<div class="panel-body">
													You can view here all the pages the player visited in the last 72h.
												</div>

												<div class="table-responsive pre-scrollable">
													<table class="table">
														<thead>
															<tr>
																<th>#</th>
																<th>Time</th>
																<th>Page Visited</th>
															</tr>
														</thead>
														<tbody>
														{foreach $visitList as $trackId => $listRow}
															<tr>
																<td>{$trackId}</td>
																<td>{$listRow.time}</td>
																<td>{$listRow.pageVisited}</td>
															</tr>
														{/foreach}
														</tbody>
													</table>
												</div>
											</div>
											<!-- /scrollable table -->
									</div>
									
									<div class="tab-pane fade" id="notes">
	
									</div>
									
									<div class="tab-pane fade" id="friends">
	
									</div>
								</div>
							</div>
							
							
						</div>

						<div class="col-lg-3">

							<!-- User thumbnail -->
							<div class="thumbnail">
								
						    	<div class="caption text-center">
						    		<h6 class="text-semibold no-margin">{$nombre} <small class="display-block">{$nivel}</small></h6>
					    			<ul class="icons-list mt-15">
				                    	<li><a href="mailto:{$email_1}" data-popup="tooltip" title="Send Email"><i class="icon-mail5"></i></a></li>
			                    	</ul>
						    	</div>
					    	</div>
					    	<!-- /user thumbnail -->


							<!-- Share your thoughts -->
							<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Share your thoughts</h6>
									<div class="heading-elements">
										<ul class="icons-list">
					                		<li><a data-action="close"></a></li>
					                	</ul>
				                	</div>
								</div>

								<div class="panel-body">
									<form action="#">
										<div class="form-group">
											<textarea name="enter-message" class="form-control mb-15" rows="3" cols="1" placeholder="Share your thougs about this player..">{$usertext}</textarea>
										</div>

										<div class="row">
				                    		<div class="col-sm-6">

				                    		</div>

				                    		<div class="col-sm-6 text-right">
					                            <button type="button" class="btn btn-primary btn-labeled btn-labeled-right">Edit comment <b><i class="icon-circle-right2"></i></b></button>
				                    		</div>
				                    	</div>
			                    	</form>
		                    	</div>
							</div>
							<!-- /share your thoughts -->

							<!-- Connections -->
					    	<div class="panel panel-flat">
								<div class="panel-heading">
									<h6 class="panel-title">Latest connections</h6>

								</div>

								<ul class="media-list media-list-linked pb-5">
									{foreach $connexionList as $suspectId => $listRow}														
									<li class="media">
										<span class="media-link">
											<div class="media-left"><img src="assets/images/Xterium.jpg" class="img-circle" alt=""></div>
											<div class="media-body">
												<span class="media-heading text-semibold">{$listRow.ipadress}</span>
												<span class="media-annotation">{$listRow.time}</span>
											</div>
											<div class="media-right media-middle">
												<span class="status-mark bg-{if empty($listRow.isValid)}success{else}danger{/if}"></span>
											</div>
										</span>
									</li>
									{/foreach}
								</ul>
							</div>
							<!-- /connections -->

						</div>
					</div>
					<!-- /user profile -->
{include file="overall_footer.tpl"}