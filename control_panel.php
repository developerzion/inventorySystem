<?php
include("includes/gen_function.php");
    if(!isset($_SESSION['GLOBALID'])){
    header("location: index.php");
  } 
?>
<!DOCTYPE html>
<head>
    <meta charset="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo siteDetails('sitename'); ?></title>
    <?php include("includes/links.php"); ?>   

    <style type="text/css"> 
        legend{
            font-size:14px;
            font-weight:bold;
            margin-bottom: 0px; 
            width: auto; 
            border: 1px solid #ddd;
            border-radius: 4px; 
            padding: 5px 5px 5px 10px; 
            background-color: #ffffff;
            }       
    </style>
</head>
<body>
<div class="container theme-spacelab theme-compact">
        <!-- ============================================================== --> 
            <?php include("includes/admin_nav.php"); ?>
        <!-- ================================================================= -->

<div style="margin-top: -35px"></div>

<div class="page-header">
    <h1><i class="glyphicon glyphicon-plus"></i> Control Panel</h1>
</div>

<?php if (isset($_SESSION['HEAD_ADMIN']) && isset($_SESSION['ID'])) {
    if($getdata['password'] == sha1("admin")){
?>

 <div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <b>Notice:</b> You are still using the default password, kindly <a href="control_panel.php">click here</a> to change your password
</div> 

<?php } }?>

<div class="row">
    <div class="col-lg-12">
    <?php

    if(isset($_POST['update_site_details'])){
        $array = array($_POST['store_name'], $_POST['store_address']);
        update_site_details($con, $array);
    }
    if(isset($_POST['change_password'])){
        $array = array($_POST['newp'], $_POST['confirmp']);
        change_password($con, $array, $_SESSION['ADMIN_ID']);
    }
    if(isset($_POST['register_staff'])){
        $array = array($_POST['fullname'], $_POST['username'], $_POST['pass'], $_POST['cpass'], $_POST['pos'],);
        register_staff($con, $array);
    }
    
     
    ?>
    <form method="POST" action="" class="form-horizontal">
    
        <fieldset class="form-control">
            <legend>Site Details</legend>
        <div class="form-group">
            <label for="" class="col-sm-4 col-md-3 col-lg-2 col-lg-offset-2 control-label">Store Name</label>
            <div class="col-sm-8 col-md-9 col-lg-6">
                <input type="text" name="store_name" value="<?php echo siteDetails("sitename"); ?>" class="form-control" required="">                 
            </div>
        </div>  
        <div class="form-group"> 
            <label for="" class="col-sm-4 col-md-3 col-lg-2 col-lg-offset-2 control-label">Store Address</label>
            <div class="col-sm-8 col-md-9 col-lg-6">
                <textarea class="form-control" name="store_address"><?php echo siteDetails("site_address"); ?></textarea>           
            </div> 
        </div>


        <div class="form-group">
            <label class="col-sm-4 col-md-3 col-lg-2 col-lg-offset-2 control-label"></label>
            <div class="col-sm-8 col-md-9 col-lg-6">
               
                <button type="submit" name="update_site_details" class="btn btn-success">
                    <i class="glyphicon glyphicon-upload"></i> Update Records
                </button> 
 
                
            </div>
        </div>

    </fieldset>
    <br>
    </form>

    <form method="POST" action="" class="form-horizontal">
    
        <fieldset class="form-control">
            <legend>Change Password</legend>
        <div class="form-group">
            <label for="" class="col-sm-4 col-md-3 col-lg-2 col-lg-offset-2 control-label">New Password</label>
            <div class="col-sm-8 col-md-9 col-lg-6">
                <input type="password" name="newp" class="form-control" required="">                 
            </div>
        </div>  
        <div class="form-group"> 
            <label for="" class="col-sm-4 col-md-3 col-lg-2 col-lg-offset-2 control-label">Confirm New Password</label>
            <div class="col-sm-8 col-md-9 col-lg-6">
                <input type="password" name="confirmp" class="form-control" required="">     
                          
            </div> 
        </div>


        <div class="form-group">
            <label class="col-sm-4 col-md-3 col-lg-2 col-lg-offset-2 control-label"></label>
            <div class="col-sm-8 col-md-9 col-lg-6">
               
                <button type="submit" name="change_password" class="btn btn-success">
                    <i class="glyphicon glyphicon-lock"></i> Change Password
                </button> 
 
                
            </div>
        </div>

    </fieldset>
    <br>
    </form>

    <form method="POST" action="" class="form-horizontal">
    
        <fieldset class="form-control">
            <legend>Add new Staff</legend>
        <div class="form-group">
            <label for="" class="col-sm-4 col-md-3 col-lg-2 col-lg-offset-2 control-label">Fullname</label>
            <div class="col-sm-8 col-md-9 col-lg-6">
                <input type="text" name="fullname" class="form-control" required="">                 
            </div>
        </div>  
       <div class="form-group">
            <label for="" class="col-sm-4 col-md-3 col-lg-2 col-lg-offset-2 control-label">Username</label>
            <div class="col-sm-8 col-md-9 col-lg-6">
                <input type="text" name="username" class="form-control" required="">                 
            </div>
        </div> 
        <div class="form-group">
            <label for="" class="col-sm-4 col-md-3 col-lg-2 col-lg-offset-2 control-label">Password</label>
            <div class="col-sm-8 col-md-9 col-lg-6">
                <input type="password" name="pass" class="form-control" required="">                 
            </div>
        </div> 
        <div class="form-group">
            <label for="" class="col-sm-4 col-md-3 col-lg-2 col-lg-offset-2 control-label">Confirm Password</label>
            <div class="col-sm-8 col-md-9 col-lg-6">
                <input type="password" name="cpass" class="form-control" required="">                 
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-sm-4 col-md-3 col-lg-2 col-lg-offset-2 control-label">Position</label>
            <div class="col-sm-8 col-md-9 col-lg-6">
                <select name="pos" class="form-control" required="">
                    <option value="">--Select Position--</option>
                    <option>Cashier</option>
                </select>                
            </div>
        </div> 


        <div class="form-group">
            <label class="col-sm-4 col-md-3 col-lg-2 col-lg-offset-2 control-label"></label>
            <div class="col-sm-8 col-md-9 col-lg-6">
               
                <button type="submit" name="register_staff" class="btn btn-success">
                    <i class="glyphicon glyphicon-lock"></i> Register new staff
                </button> 
 
                
            </div>
        </div>

    </fieldset>
    <br>
    </form>
                    
    </div>
</div>  
</div>

    <script src="tablejs/jquery-2.0.3.min.js"></script>
    <script src="tablejs/jquery.dataTables.js"></script>
    <script src="tablejs/dataTables.bootstrap.js"></script>
    
<script>
         $(document).ready(function () {
             $('#dataTables-example').dataTable();
         });
    </script>
</body>



