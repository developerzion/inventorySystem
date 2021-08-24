
<div style="height: 80px;"></div>


<!-- top navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="dashboard.php"><span class=""><i class="glyphicon glyphicon-cog"></i> Dashboard</span></a>
	</div>

	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<?php if(isset($_SESSION['ADMIN_ID'])) { ?>
		<ul class="nav navbar-nav">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="glyphicon glyphicon-globe"></i> Stocks<b class="caret"></b>
				</a>
					<ul class="dropdown-menu">
						<li>
							<a href="add_record.php">
								<i class="glyphicon menu-item-icon text-info glyphicon-plus"></i> 
								Add Record to stock
							</a>
						</li>
						<li>
							<a href="upload_download_csv.php">
								<i class="glyphicon menu-item-icon text-info glyphicon-upload"></i> 
								Upload/Download Csv Format
							</a>
						</li>
						<li>
							<a href="stock.php">
								<i class="glyphicon menu-item-icon text-info glyphicon-eye-open"></i> 
								View stock
							</a>
						</li>

					</ul>
			</li>
			
				
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="glyphicon glyphicon-cog"></i> Admin Settings <b class="caret"></b>
				</a>
					<ul class="dropdown-menu">

						<li>
							<a href="control_panel.php">
								<i class="glyphicon menu-item-icon text-info glyphicon-cog"></i> 
								Control Panel
							</a>
						</li>
						<li>
							<a href="staff_record.php">
								<i class="glyphicon menu-item-icon text-info glyphicon-cog"></i> 
								Staff Records
							</a>
						</li>
					
						
					</ul>
			</li>
		
		</ul>
		<?php } ?>
		<div class="navbar-right">
			<a href="logout.php" onclick="return confirm('Are you sure you want to signOut')" class="btn btn-warning navbar-btn">
				<i class="glyphicon glyphicon-log-out"></i> 
				Sign out
			</a>
		</div>
	</div>
</nav>
