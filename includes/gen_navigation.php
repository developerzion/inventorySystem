
<nav class="navbar navbar-default navbar-fixed-top hidden-print" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
				
				<a class="navbar-brand" href="" style="font-weight:bolder;margin-top: -5px">
					<span><img src="./resources/images/logo.png" width="70" height="40"></span>
					<span style="margin-left: -22px"><?php echo sitedetails("sitename"); ?></span>
				</a>
			</div>
			<div class="collapse navbar-collapse">
	
				<ul class="nav navbar-nav navbar-right hidden-xs" style="min-width: 330px;">
					<a class="btn navbar-btn btn-success navbar-right" href="index.php?signIn=1"><i class="glyphicon glyphicon-log-out"></i> SignIn</a>
					<p class="navbar-text navbar-right">You are not signed in</p>
				</ul>

				<ul class="nav navbar-nav visible-xs">
					<a class="btn navbar-btn btn-success btn-lg visible-xs" href="index.php?signOut=1"><i class="glyphicon glyphicon-log-out"></i> SignIn</a>
					<p class="navbar-text text-center">You are not signed in</p>
				</ul>
					
			</div>

</nav>