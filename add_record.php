<?php
include("includes/gen_function.php");
    if(!isset($_SESSION['GLOBALID'])){
    header("location: index.php");
  }
  if (isset($_POST['delitem'])) {
      $prod_id = $_POST['prod_id'];
      mysqli_query($con,"DELETE FROM tbl_product WHERE id='$prod_id'") or die(mysqli_error($con));
  }
  if (isset($_POST['edit_data_product'])) {

    $prod_id = $_POST['prod_id'];
    $querydata = mysqli_query($con, "SELECT * FROM tbl_product WHERE id ='$prod_id'");
    $getquery = mysqli_fetch_array($querydata);

    $productname = $getquery['prod_Name'];
    $categories = $getquery['prod_Cat'];
    $prize = $getquery['priZe'];
    $quantity = $getquery['Qty'];
    $shelve = $getquery['shelVe'];
      
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
    <h1><i class="glyphicon glyphicon-plus"></i> Add Record(s) to Store</h1>
</div>
   <?php if(isset($_SESSION['ADMIN_ID'])) {
        if($getdata['password'] == sha1("admin")){
    ?>

     <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <b>Notice:</b> You are still using the default password, kindly <a href="control_panel.php">click here</a> to change your password
    </div> 

    <?php } }?>
<div class="row">
    <div class="col-lg-5">
    <?php
        
        if (isset($_POST['insert_product'])) {

           $prod_name = $_POST['prod_name'];
           $prod_cat = $_POST['prod_cat'];
           $prize = $_POST['prize'];
           $quantity = $_POST['quantity'];
           $shelve = $_POST['shelve'];

           insertRecord($prod_name, $prod_cat, $prize, $quantity, $shelve);
           //@header("Refresh:3");

        }


    ?>
  
    <form method="POST" action="" enctype="multipart/form-data"  class="form-horizontal">
    
        <fieldset class="form-control">
            <legend>Add Records</legend>

        <div class="form-group">
            <label class="col-sm-4 col-md-4  control-label">Product Name</label>
                <div class="col-sm-8 col-md-9 col-lg-6">
                    <input type="text" name="prod_name" value="<?php if(isset($_POST['edit_data_product'])){ echo $productname; } ?>" required="" class="form-control">
                </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 col-md-4  control-label">Categories</label>
                <div class="col-sm-8 col-md-9 col-lg-6">
                    <select name="prod_cat" required="" class="form-control">
                        <?php if(isset($_POST['edit_data_product'])){ ?>
                            <option><?php echo $categories; ?></option>

                       <?php } ?>
                        <option value="">--Select Category--</option>
                        <?php 
                            $res = mysqli_query($con,"SELECT * FROM tbl_categories");
                            while($row = mysqli_fetch_array($res))
                            { ?>
                                <option><?php echo $row['categories']; ?></option>   
                        <?php } ?>
                    </select>
                </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 col-md-4  control-label">Prize</label>
                <div class="col-sm-8 col-md-9 col-lg-6">
                    <input type="number" name="prize"  required="" value="<?php if(isset($_POST['edit_data_product'])){ echo $prize; } ?>" class="form-control">
                    <span class="viewres"></span>
                </div>
        </div>     
        <div class="form-group">
            <label class="col-sm-4 col-md-4  control-label">Quantity</label>
                <div class="col-sm-8 col-md-9 col-lg-6">
                    <input type="number" name="quantity" value="<?php if(isset($_POST['edit_data_product'])){ echo $quantity; } ?>"  required="" class="form-control">
                    <span class="viewres"></span>
                </div>
        </div>  
        <div class="form-group">
            <label class="col-sm-4 col-md-4  control-label">Shelve / Row</label>
                <div class="col-sm-8 col-md-9 col-lg-6">
                    <input type="text" name="shelve" value="<?php if(isset($_POST['edit_data_product'])){ echo $shelve; } ?>"  required="" class="form-control">
                    <span class="viewres"></span>
                </div>
        </div>    

        <div class="form-group">
            <label class="col-sm-4 col-md-4  control-label"></label>
            <div class="col-sm-8 col-md-9 col-lg-6">
                <?php if(isset($_POST['edit_data_product'])){ ?>
                <button type="submit" name="update_product" value="" class="btn btn-success">
                    <i class="glyphicon glyphicon-upload"></i> Update Records
                </button>
            <?php } else{ ?>
                    <button type="submit" name="insert_product" value="" class="btn btn-primary">
                    <i class="glyphicon glyphicon-upload"></i> Insert Records
                </button>
                <!-- <button type="reset" class="btn btn-warning hspacer-md">
                    <i class="glyphicon glyphicon-remove"></i> Cancel
                </button> -->
            <?php } ?>
                
            </div>
        </div>

    </fieldset>
    <br>
    </form>
                    
    </div>

    <div class="col-lg-4">
        <?php 
              if (isset($_POST['create_cat'])) {
            $cat = $_POST['category'];
            echo create_category($con, $cat);
        }
        ?>
        <form method="POST" action="" class="form-horizontal">
        
            <fieldset class="form-control">
                <legend>Create new category</legend>

            <div class="form-group">
                <label class="col-sm-4 col-md-4  control-label">Category</label>
                    <div class="col-sm-8 col-md-9 col-lg-6">
                        <input type="text" name="category"  required="" class="form-control">
                    </div>
            </div>
            

            <div class="form-group">
                <label class="col-sm-4 col-md-3 col-lg-2 col-lg-offset-2 control-label"></label>
                <div class="col-sm-8 col-md-9 col-lg-6">                  
                    <button type="submit" name="create_cat" value="" class="btn btn-primary">
                        <i class="glyphicon glyphicon-upload"></i> Create new category
                    </button>
        
                </div>
            </div>

        </fieldset>
            <br>
        </form>
                    
    </div>

      <div class="col-lg-3">

        <?php 
            if (isset($_POST['delBtn'])) {
                deleteCat($con, $_POST['delCat']);
            }
        ?>

        <form method="POST" action="" class="form-horizontal">
        
            <fieldset class="form-control">
                <legend>Create new category</legend>

                <div style="width: 100%;height: 20em;overflow-y: scroll;">

                    <table class="table" width="100%" cellpadding="0" cellspacing="0" border="0"> 
                        <tr>
                            <td>S/N</td>
                            <td>Category</td>
                            <td>Action</td>
                        </tr>

                        <?php
                        $query = mysqli_query($con,"SELECT * FROM tbl_categories");
                        $count = 1;
                        while ($row = mysqli_fetch_array($query)) { ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $row['categories']; ?></td>
                                <td><form method="POST" action=""><input type="hidden" value="<?php echo $row['id']; ?>" name="delCat"></i><button class="btn btn-danger" onclick="return confirm('Click ok to delete category')" name="delBtn"><i class="glyphicon glyphicon-trash"></i></button></form></td>
                            </tr>
                        <?php  }
                        ?>
                    </table>
                    
                </div>
            


        </fieldset>
            <br>
        </form>
                    
    </div>


</div>  

<br>
    <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>                           
                                        <tr>
                                            <th>Product</th>
                                            <th>Categories</th>
                                            <th>Prize</th>
                                            <th>Total Quantity</th>
                                            <th>Shelve / Row</th>
                                            <th>Date Stocked</th>
                                            <th>Action</th>
                                         
                                        </tr>
                                    </thead>
                                    <tbody>
                                          <?php 

                                    $row = mysqli_query($con, "SELECT * FROM tbl_product");
                                    while($getRow = mysqli_fetch_array($row)){ ?>
                                        <tr>
                                            <td><?php echo $getRow['prod_Name']; ?></td>
                                            <td><?php echo $getRow['prod_Cat']; ?></td>
                                            <td><?php echo $getRow['priZe']; ?></td>
                                            <td><?php echo $getRow['Qty']; ?></td>
                                            <td><?php echo $getRow['shelVe']; ?></td>
                                            <td><?php echo $getRow['datetime']; ?></td>
                                            <td>
                                                <form action="" method="POST">
                                                <input type="hidden" value="<?php echo $getRow['id']; ?>" name="prod_id">
                                         
                                                    <button type="submit" name="edit_data_product" class="btn btn-primary">
                                                        <i class="glyphicon glyphicon-edit"></i>
                                                    </button>
                                                    <button onclick="return confirm('Click ok to delete record')" name="delitem" class="btn btn-danger">
                                                            <i class="glyphicon glyphicon-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
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

    <script src="tablejs/jquery-2.0.3.min.js"></script>
    <script src="tablejs/jquery.dataTables.js"></script>
    <script src="tablejs/dataTables.bootstrap.js"></script>
    
<script>
         $(document).ready(function () {
             $('#dataTables-example').dataTable();
         });
    </script>
</body>



