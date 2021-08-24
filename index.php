<?php include("includes/gen_function.php"); 

	if (isset($_SESSION['GLOBALID'])) {
		header("location:dashboard.php");
	}

?>
<!DOCTYPE html>
	<head>
		<meta charset="">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="">

		<title><?php echo siteDetails('sitename'); ?></title>
		<?php include("includes/links.php"); ?>	
	</head>
<body>
<div class="container theme-spacelab theme-compact">

	<!-- ============================================================== -->	
		<?php include("includes/gen_navigation.php"); ?>
	<!-- ================================================================= -->

	<div style="height: 70px;" class=""></div>
	<div class="page-header" style="text-align: center;" ><h1><i class="glyphicon glyphicon-shopping-cart"></i> <?php echo siteDetails('sitename'); ?> Inventory System</h1></div>
	<div class="row">
		<div class="col-sm-4 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
<?php  
        if(isset($_POST['login_admin'])){
            $userid = $_POST['userid'];
            $password = $_POST['password'];
            $position = $_POST['position'];
            loginAdmin($userid, $password, $position);
          } 
        ?>
    </div>

		<div class="col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
		<div class="panel panel-success">

			<div class="panel-heading">
				<h1 class="panel-title"><strong>sign in here</strong></h1>			
				<div class="clearfix"></div>
			</div>

			<div class="panel-body">
				<form method="post" action="">
					
					<div class="form-group">
						<label class="control-label" for="username">username</label>
						<input class="form-control" name="userid" type="text" placeholder="username" required="">
					</div>
					<div class="form-group">
						<label class="control-label" for="password">password</label>
						<input class="form-control" name="password" type="password" placeholder="Password" required="">
					</div>
					<div class="form-group">
						<label class="control-label" for="post">Administrator position</label>
						<select required="" name="position" class="form-control">
							<option value="">--Select position--</option>
							<option value="cashier">Cahier</option>
							<option value="administrator">Admin</option>

							
						</select>
					</div>
		

					<div class="row">
						<div class="col-sm-offset-3 col-sm-6">
							<button name="login_admin" type="submit" class="btn btn-primary btn-lg btn-block">sign in</button>
						</div>
					</div>
				</form>
			</div>

		</div>
	</div>
</div>

</div>

</body>



