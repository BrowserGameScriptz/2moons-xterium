{include file="overall_header.tpl"}
{include file="overall_menu.tpl"}
	
<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">INGAME INFORMATION</span> - Flying Fleets</h4>
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
							<li><a href="admin.php?page=fleets">INGAME INFORMATION</a></li>
							<li>Flying Fleets</li>
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
												Flying Fleets
												<a class="control-arrow" data-toggle="collapse" data-target="#Frame8">
													<i class="icon-circle-down2"></i>
												</a>
											</legend>
 
											<div class="collapse in" id="Frame8">
												<table class="table table-bordered table-hover datatable-highlight">
							<thead>
								<tr>
									<th>{$LNG.ff_fleetid}</th>
									<th>{$LNG.ff_mission}</th>
									<th>{$LNG.ff_starttime}</th>
									<th>{$LNG.ff_ships}</th>
									<th>{$LNG.ff_startuser}</th>
									<th>{$LNG.ff_startplanet}</th>
									<th>{$LNG.ff_arrivaltime}</th>
									<th>{$LNG.ff_targetuser}</th>
									<th>{$LNG.ff_targetplanet}</th>
									<th>{$LNG.ff_endtime}</th>
									<th>{$LNG.ff_holdtime}</th>
									<th>{$LNG.ff_lock}</th>
								</tr>
							</thead>
							<tbody>
								{foreach $FleetList as $FleetRow}
								<tr>
									<td>{$FleetRow.fleetID}</td>
									<td>{$LNG.type_mission.{$FleetRow.missionID}}{if $FleetRow.acsID != 0}<br>{$FleetRow.acsID}<br>{$FleetRow.acsName}{/if}&nbsp;(R)</td>
									<td>{$FleetRow.starttime}</td>
									<td><a href="#" data-popup="tooltip" title="{foreach $FleetRow.ships as $shipID => $shipCount}
									{$LNG.tech.$shipID} : {$shipCount|number}           {/foreach}">{$FleetRow.count|number}&nbsp;(D)</a></td>
									<td>{$FleetRow.startUserName} (ID:&nbsp;{$FleetRow.startUserID})</td>
									<td>{$FleetRow.startPlanetName}&nbsp;[{$FleetRow.startPlanetGalaxy}:{$FleetRow.startPlanetSystem}:{$FleetRow.startPlanetPlanet}] (ID:&nbsp;{$FleetRow.startPlanetID})</td>
									<td>{if $FleetRow.state == 0}<span style="color:#558B2F;">{/if}{$FleetRow.arrivaltime}{if $FleetRow.state == 0}</span>{/if}</td>
									<td>{if $FleetRow.targetUserID != 0}{$FleetRow.targetUserName} (ID:&nbsp;{$FleetRow.targetUserID}){/if}</td>
									<td>{$FleetRow.targetPlanetName}&nbsp;[{$FleetRow.targetPlanetGalaxy}:{$FleetRow.targetPlanetSystem}:{$FleetRow.targetPlanetPlanet}]{if $FleetRow.targetPlanetID != 0} (ID:&nbsp;{$FleetRow.targetPlanetID}){/if}</td>
									<td>{if $FleetRow.state == 1}<span style="color:#558B2F;">{/if}{$FleetRow.endtime}{if $FleetRow.state == 0}</span>{/if}</td>
									<td class="text-center">{if $FleetRow.stayhour != 0}{if $FleetRow.state == 2}<span style="color:#558B2F;">{/if}{$FleetRow.staytime} ({$FleetRow.stayhour}&nbsp;h){if $FleetRow.state == 0}</span>{/if}{else}-{/if}</td>
									<td><a href="admin.php?page=fleets&amp;id={$FleetRow.fleetID}&amp;lock={if $FleetRow.lock}0" style="color:#558B2F">{$LNG.ff_unlock}{elseif $FleetRow.error}2" style="color:red">{$LNG.ff_del}{else}1" style="color:red">{$LNG.ff_lock}{/if}</a></td>

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