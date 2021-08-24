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

        <?php include "dash_includes.php"; ?>
</head>
<body>


<div class="container theme-spacelab theme-compact">

<!-- ============================================================== --> 
    <?php include("includes/admin_nav.php"); ?>
<!-- ================================================================= -->
<div style="margin-top: -50px"></div>

<div class="page-header">
    <h1><i class="glyphicon glyphicon-shopping-cart"></i> <?php echo siteDetails("sitename"); ?> Inventory System | Staff Records</h1>
</div>
    
    <?php if(isset($_SESSION['ADMIN_ID'])) {
        if($getdata['password'] == sha1("admin")){
    ?>

     <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <b>Notice:</b> You are still using the default password, kindly <a href="control_panel.php">click here</a> to change your password
    </div> 

    <?php } } 
        if (isset($_POST['update_staff_rec'])) {
        $array  = array($_POST['rand'],$_POST['fname'],$_POST['uname'],$_POST['pass'],$_POST['cpass']);
        update_staff_rec($con, $array);
        
    } ?>


            <?php
                if (isset($_POST['edit_staff'])) {
                    $rand =  $_POST['staffID'];
                    $fetchdata = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM tbl_staff WHERE rand ='$rand'"));
                }
            ?>



            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                   
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>staffID</th>
                                            <th>Fullname</th>
                                            <th>Username</th>
                                            <th>Position</th>
                                            <th>Time LoggedIn</th>                                            
                                            <th>Action</th>
                                         
                                        </tr>
                                    </thead>
                                       
                                    <tbody>
                                        <?php
                                            $qstaff = mysqli_query($con, "SELECT * FROM tbl_staff");
                                            while($row = mysqli_fetch_array($qstaff)){ ?>

                                                <tr>
                                                    <td><?php echo $row['rand']; ?></td>
                                                    <td><?php echo $row['fullname']; ?></td>
                                                    <td><?php echo $row['username']; ?></td>
                                                    <td><?php echo $row['pos']; ?></td>
                                                    <td><?php echo $row['lastlogged']; ?></td>
                                                    <td>
                                                    <form method="POST" action="">
                                                        <input type="hidden" value="<?php echo $row['rand']; ?>" name="staffID">
                                                        <button name="edit_staff" class="btn btn-success" ><i class="glyphicon glyphicon-edit"></i></button>
                                                        <button class="btn btn-danger" onclick="return confirm('Click ok to cofirm staff record deletion')"><i class="glyphicon glyphicon-trash"></i></button>
                                                    </form>
                                                    </td>
                                                </tr>

                                            <?php }
                                        ?>
                                         
                                    </tbody>
                                </table>


                            </div>
                           
                        </div>
                    </div>
                </div>

                 <div class="row">
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-body">  
                            <form method="POST" action="">                              
                                <input type="hidden" value="<?php if (isset($_POST['edit_staff'])) echo $fetchdata['rand']; ?>" name="rand">
                                 <div class="form-group">
                                    <label for="" class="col-sm-6 control-label">Fullname</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="fname" value="<?php if (isset($_POST['edit_staff'])) echo $fetchdata['fullname']; ?>"  required="" class="form-control">                                     
                                        </div>
                                </div>  
                                <div class="form-group">
                                    <label for="" class="col-sm-6 control-label">Username</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="uname" value="<?php if (isset($_POST['edit_staff'])) echo $fetchdata['username']; ?>"  required="" class="form-control">                                     
                                        </div>
                                </div>  
                                <div class="form-group">
                                    <label for="" class="col-sm-6 control-label">Position</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="pos" disabled="" value="<?php if (isset($_POST['edit_staff'])) echo $fetchdata['pos']; ?>"  required="" class="form-control">                                     
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-6 control-label">Change Password</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="pass" class="form-control">                                     
                                        </div>
                                </div> 
                                <div class="form-group">
                                    <label for="" class="col-sm-6 control-label">Confirm Password</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="cpass" class="form-control">                                     
                                        </div>
                                </div>  

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div style="margin-top: 10px"></div>
                                        <?php if (isset($_POST['edit_staff'])){ ?><button name="update_staff_rec" class="btn btn-success">Update Record</button> <?php } ?>
                                    </div>
                                </div>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
      
        </div>

       

</div>
<?php include "dash_footer.php"; ?>

</body>



