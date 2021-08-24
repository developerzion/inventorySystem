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
    <h1><i class="glyphicon glyphicon-upload"></i> Upload/Download CSV File</h1>
</div>

<?php if(isset($_SESSION['ADMIN_ID'])) {
    if($getdata['password'] == sha1("admin")){
?>

 <div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <b>Notice:</b> You are still using the default password, kindly <a href="control_panel.php">click here</a> to change your password
</div> 

<?php } }?>

<!-- ========================UPLOAD CSV FILE STARTS=============================== -->

<?php
$csvresult = " ";
if (isset($_POST['insert_data'])) {
    $data = $_FILES['csvdata']['tmp_name'];

    if($_FILES['csvdata']['size'] > 0){

        $file = fopen($data, "r");

        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $result = mysqli_query($con, "UPDATE tbl_product SET Qty='$column[4]' WHERE prod_Name='$column[1]'");
        }
        fclose($file);
    }
    $csvresult = "<div class='alert alert-success alert-dismissable'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        The stock has been successfully updated.
    </div>";

    echo $csvresult;
    //header("Refresh: 1");

}
?>
    <div class="panel panel-default">
     
        <div class="panel-body">
            <div class="step-details">
                The batch transfer wizard allows you to transfer data records of one or all members of a group to a member of another group 
            </div>
            <div class="form-group">
                <br> 
                <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">            
                <div class="col-sm-6 col-md-4">
                      <input type="file" name="csvdata"  required=""  accepts="csv" class="form-control">
                </div>
                <div class="col-sm-4 col-md-2">
                    <button name="insert_data" class="btn btn-success">
                        <i class="glyphicon glyphicon-upload"></i> Upload CSV File
                    </button>                    
                </div>
                </form>
                <div class="col-sm-4 col-md-1"></div>
                <form method="post" action="uploaddata.php" class="form-horizontal">
                <div class="col-sm-4 col-md-5">
                 <button name="extract_data" onclick="return confirm('Click ok to download product file')" class="btn btn-success"><i class="glyphicon glyphicon-download"></i> Downalod CSV File</button>
            </div>
        </form>
        </div>
    </div>
    

<!-- ========================UPLOAD CSV FILE ENDS=============================== -->
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



