<!-- Main navbar -->
	<div class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="admin.php?page=overview"><img src="assets/images/logo_light.png" alt=""></a>
			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>
		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-git-compare"></i>
						<span class="visible-xs-inline-block position-right">Git updates</span>
						<span class="badge bg-warning-400">9</span>
					</a>
					
					<div class="dropdown-menu dropdown-content">
						<div class="dropdown-content-heading">
							Administrator Messages
						</div>

						<ul class="media-list dropdown-content-body width-350">
							<li class="media">
								<div class="media-left">
									<a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
								</div>

								<div class="media-body">
									Drop the IE <a href="#">specific hacks</a> for temporal inputs
									<div class="media-annotation">4 minutes ago</div>
								</div>
							</li>

						</ul>

						<div class="dropdown-content-footer">
							<a href="admin.php?page=adminlogs" data-popup="tooltip" title="All Messages"><i class="icon-menu display-block"></i></a>
						</div>
					</div>
				</li>
				
			</ul>

			<p class="navbar-text"><span class="label bg-success-400">Online</span></p>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown language-switch">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="assets/images/flags/gb.png" class="position-left" alt="">
						English
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a class="deutsch"><img src="assets/images/flags/de.png" alt=""> Deutsch</a></li>
						<li><a class="ukrainian"><img src="assets/images/flags/ua.png" alt=""> Українська</a></li>
						<li><a class="english"><img src="assets/images/flags/gb.png" alt=""> English</a></li>
						<li><a class="espana"><img src="assets/images/flags/es.png" alt=""> España</a></li>
						<li><a class="russian"><img src="assets/images/flags/ru.png" alt=""> Русский</a></li>
					</ul>
				</li>
				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="assets/images/placeholder.jpg" alt="">
						<span><?php print($userRow['user_name']); ?></span>
						<i class="caret"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
						<li><a href="#"><i class="icon-coins"></i> My balance</a></li>
						<li><a href="#"><span class="badge bg-teal-400 pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>
						<li class="divider"></li>
						<li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
						<li><a href="javascript:top.location.href='game.php';"><i class="icon-switch2"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->
	<!-- Page container -->
	<div class="page-container">
		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<a href="#" class="media-left"><img src="assets/images/placeholder.jpg" class="img-circle img-sm" alt=""></a>
								<div class="media-body">
									<span class="media-heading text-semibold"><?php print($userRow['user_name']); ?></span>
									<div class="text-size-mini text-muted">
										<i class="icon-pin text-size-small"></i> https://warofgalaxyz.com
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->
					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">
								<!-- Main -->
								<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
								<li{if $pageactiveshow == "overview"} class="active"{/if}><a href="admin.php?page=overview"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
								<li>
									<a href="#"><i class="icon-pencil3"></i> <span>Server Settings</span></a>
									<ul>
										<li{if $pageactiveshow == "generalsett"} class="active"{/if}><a href="admin.php?page=generalsett">General</a></li>
										<li{if $pageactiveshow == "metaoption"} class="active"{/if}><a href="admin.php?page=metaoption">Site Meta</a></li>
										<li><a href="social_settings.php">Social Settings</a></li>
										<li><a href="social_logins.php">Social Login Settings</a></li>
									</ul>
								</li>
								<li>
									<a href="#"><i class="icon-puzzle2"></i> <span>Game Settings</span></a>
									<ul>
										<li>
											<a href="#">Ingame Settings</a>
											<ul>
												<li{if $pageactiveshow == "universeset"} class="active"{/if}><a href="admin.php?page=universeset">Universe Settings</a></li>
												<li{if $pageactiveshow == "queuset"} class="active"{/if}><a href="admin.php?page=queuset">Queue List</a></li>
												<li{if $pageactiveshow == "referalset"} class="active"{/if}><a href="admin.php?page=referalset">Referal Settings</a></li>
												<li{if $pageactiveshow == "colonyset"} class="active"{/if}><a href="admin.php?page=colonyset">Colonisation Settings</a></li>
												<li{if $pageactiveshow == "planetset"} class="active"{/if}><a href="admin.php?page=planetset">Planet Settings</a></li>
												<li{if $pageactiveshow == "debrisset"} class="active"{/if}><a href="admin.php?page=debrisset">Debris Settings</a></li>
												<li{if $pageactiveshow == "galaxyset"} class="active"{/if}><a href="admin.php?page=galaxyset">Galaxy Settings</a></li>
												<li{if $pageactiveshow == "expeditionset"} class="active"{/if}><a href="admin.php?page=expeditionset">Expedition Settings</a></li>
												<li{if $pageactiveshow == "noobset"} class="active"{/if}><a href="admin.php?page=noobset">Noob Settings</a></li>
												<li{if $pageactiveshow == "proxyset"} class="active"{/if}><a href="admin.php?page=proxyset">Proxy Settings</a></li>
												<li{if $pageactiveshow == "variousset"} class="active"{/if}><a href="admin.php?page=variousset">Various Settings</a></li>
											</ul>
										</li>
								
										<li{if $pageactiveshow == "module"} class="active"{/if}><a href="admin.php?page=module">Modules Settings</a></li>
										<li{if $pageactiveshow == "statsconf"} class="active"{/if}><a href="admin.php?page=statsconf">Statistics Settings</a></li>
										<li{if $pageactiveshow == "premium"} class="active"{/if}><a href="admin.php?page=premium">Premium Settings</a></li>
										<li{if $pageactiveshow == "cronjob"} class="active"{/if}><a href="admin.php?page=cronjob">CronJob Settings</a></li>
										<!--<li><a href="paiement_settings.php">Paiement Settings</a></li>-->
									</ul>
								</li>
								<!-- /main -->
								<!--Forms -->
								<li class="navigation-header"><span>Account Editor</span> <i class="icon-menu" title="Account Editor"></i></li>
								<li{if $pageactiveshow == "addam"} class="active"{/if}><a href="admin.php?page=addam"><i class="glyphicon glyphicon-plus"></i> <span>Paysafe Antimatter</span></a></li>
								<li{if $pageactiveshow == "adsense"} class="active"{/if}><a href="admin.php?page=adsense"><i class="glyphicon glyphicon-edit"></i> <span>Google Adsense</span></a></li>
								<li{if $pageactiveshow == "bans"} class="active"{/if}><a href="admin.php?page=bans"><i class="icon-user-block"></i> <span>Ban System</span></a></li>
								<li class="navigation-header"><span>Ingame Information</span> <i class="icon-menu" title="Ingame Information"></i></li>
								<li{if $pageactiveshow == "usersonline"} class="active"{/if}><a href="admin.php?page=usersonline"><i class="icon-users4"></i> <span>Users Online</span></a></li>
								<li{if $pageactiveshow == "support"} class="active"{/if}><a href="admin.php?page=support"><i class="icon-lifebuoy"></i> <span>Support Tickets</span></a></li>
								<li{if $pageactiveshow == "fleets"} class="active"{/if}><a href="admin.php?page=fleets"><i class="icon-airplane3"></i> <span>Flying Fleets</span></a></li>
								<li>
									<a href="#"><i class="glyphicon glyphicon-list"></i> <span>Various List</span></a>
									<ul>
										<li{if $pageactiveshow == "playerlist"} class="active"{/if}><a href="admin.php?page=playerlist"><span>Players List</span></a></li>
										<li{if $pageactiveshow == "planetlist"} class="active"{/if}><a href="admin.php?page=planetlist"><span>Planets List</span></a></li>
										<li{if $pageactiveshow == "planetalist"} class="active"{/if}><a href="admin.php?page=planetalist"><span>Planets List (active)</span></a></li>
										<li{if $pageactiveshow == "moonlist"} class="active"{/if}><a href="admin.php?page=moonlist"><span>Moons List</span></a></li>
										<li{if $pageactiveshow == "moonalist"} class="active"{/if}><a href="admin.php?page=moonalist"><span>Moons List (active)</span></a></li>
										<li{if $pageactiveshow == "messagelist"} class="active"{/if}><a href="admin.php?page=messagelist"><span>Messages List</span></a></li>
										
										<li{if $pageactiveshow == "maillist"} class="active"{/if}><a href="admin.php?page=maillist"><span>Mail List</span></a></li>
										<li{if $pageactiveshow == "commentlist"} class="active"{/if}><a href="admin.php?page=commentlist"><span>Hof Comments</span></a></li>
										
										<li{if $pageactiveshow == "multiips"} class="active"{/if}><a href="admin.php?page=multiips"><span>Multi-Detector List</span></a></li>
									</ul>
								</li>
								<li{if $pageactiveshow == "accountdata"} class="active"{/if}><a href="admin.php?page=accountdata"><i class="icon-info3"></i> <span>Account Informations</span></a></li>
								<li class="navigation-header"><span>Utilities</span> <i class="icon-menu" title="Utilities"></i></li>
								<li>
									<a href="#"><i class="icon-search4"></i> <span>Admin Log</span></a>
									<ul>
										<li{if $pageactiveshow == "Players_Logs"} class="active"{/if}><a href="admin.php?page=log&type=player"><span>Players Edited</span></a></li>
										<li{if $pageactiveshow == "Planets_Logs"} class="active"{/if}><a href="admin.php?page=log&type=planet"><span>Planets Edited</span></a></li>
										<li{if $pageactiveshow == "Settings_Logs"} class="active"{/if}><a href="admin.php?page=log&type=settings"><span>Options Edited</span></a></li>
									</ul>
								</li>
								<li{if $pageactiveshow == "globalmessage"} class="active"{/if}><a href="admin.php?page=globalmessage"><i class="glyphicon glyphicon-send"></i> <span>Global Message</span></a></li>
								<li{if $pageactiveshow == "statsupdate"} class="active"{/if}><a href="admin.php?page=statsupdate"><i class="icon-stats-bars2"></i> <span>Refresh Statistics</span></a></li>
								<li{if $pageactiveshow == "clearcache"} class="active"{/if}><a href="admin.php?page=clearcache"><i class="glyphicon glyphicon-refresh"></i> <span>Clear Cache</span></a></li>	</ul>
						</div>
					</div>
					<!-- /main navigation -->
				</div>
			</div>
			<!-- /main sidebar -->