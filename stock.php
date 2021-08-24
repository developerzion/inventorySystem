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
    <h1><i class="glyphicon glyphicon-shopping-cart"></i> <?php echo siteDetails("sitename"); ?> Store</h1>
</div>
    
       <?php if(isset($_SESSION['ADMIN_ID'])) {
        if($getdata['password'] == sha1("admin")){
    ?>

     <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <b>Notice:</b> You are still using the default password, kindly <a href="control_panel.php">click here</a> to change your password
    </div> 

    <?php } } ?>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                   
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Product Name</th>
                                            <th>Product Category</th>
                                            <th>Product Prize</th>
                                            <th>Total Quantity</th>                                            
                                            <th>Shelve Number</th>
                                            <th>Date Stored</th>                                         
                                        </tr>
                                    </thead>
                                       
                                    <tbody>
                                        <?php 

                                    $row = mysqli_query($con, "SELECT * FROM tbl_totalproduct");
                                    $count = 1;
                                    while($getRow = mysqli_fetch_array($row)){ ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $getRow['productname']; ?></td>
                                            <td><?php echo $getRow['productcat']; ?></td>
                                            <td><?php echo $getRow['prize']; ?></td>
                                            <td><?php echo $getRow['qty']; ?></td>
                                            <td><?php echo $getRow['shelve']; ?></td>
                                            <td><?php echo $getRow['datetime']; ?></td>                                            
                                        </tr>

                                    <?php } ?>
                                  
                                         
                                    </tbody>
                                </table>


                            </div>
                           
                        </div>
                    </div>
                </div>

                 
      
        </div>

       

</div>
<?php include "dash_footer.php"; ?>

</body>



