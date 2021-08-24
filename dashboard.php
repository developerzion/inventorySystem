<?php

include("includes/gen_function.php");

  if(!isset($_SESSION['GLOBALID'])){
    header("location: index.php");
  }

  if (isset($_POST['addItem'])) {
      header("Refresh:0");
  }
  $randomdigit =  mt_rand();
  $errmsg  = "";
  $notifyErr = "";
  if (isset($_POST['clearReceipt'])) {

        unset($_SESSION['name']);
        unset($_SESSION['qty']);
        unset($_SESSION['price']);
        unset($_SESSION['sum']);

  }


if (isset($_POST['save_receipt'])) {

    if (!isset($_SESSION['name']) || !isset($_SESSION['qty']) || !isset($_SESSION['price']) || !isset($_SESSION['sum'])) {}
    else{
        for ($i=0; $i < @count($_SESSION['name']); $i++) { 
            
            $name = $_SESSION['name'][$i];
            $qty = $_SESSION['qty'][$i];
            $price =  $_SESSION['price'][$i];

            $total = $qty * $price;

            $getresult = mysqli_query($con,"SELECT * FROM tbl_product WHERE prod_Name='$name'");
            $rowget = mysqli_fetch_array($getresult);

            $getnewqty = $rowget['Qty'];
            $prodname =  $rowget['prod_Name'];

            if($getnewqty < $qty){
                $errmsg = "<div class='alert alert-danger'><b>Error:</b> The quantity order for <b>$prodname</b> is more than the quantity we have in stock. Kindly reduce the ordered quantity.</div>";
            }
            else{
                mysqli_query($con,"INSERT INTO tbl_sales (`prod_Name`,`priZe`,`Qty`,`total`,`receiptNo`,`cashier`) VALUES ('$name','$price','$qty','$total','$randomdigit','$getdata[fullname]')");

                $newqty = $getnewqty - $qty;
                mysqli_query($con,"UPDATE tbl_product SET Qty='$newqty' WHERE prod_Name='$name'");

                $notifyErr = "<div class='notify'>
                                <span class='notij'><i class='glyphicon glyphicon-plus'></i> Sold</span>
                            </div>";
            }
        }
        unset($_SESSION['name']);
        unset($_SESSION['qty']);
        unset($_SESSION['price']);
        unset($_SESSION['sum']); 
    }
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

    
    <?php echo $notifyErr; ?>

   <!--  <div class="print_record"><i class='glyphicon glyphicon-print'></i></div> -->

    <div class="printable">
        <div class="table-responsive">
       <table class="table table-striped table-hover">
        <?php
        $getprint = mysqli_query($con,"SELECT DISTINCT receiptNo FROM tbl_sales order by id desc") or die(mysqli_error($con));
        while($printrow = mysqli_fetch_array($getprint)){ ?>
            <tr>
                <td><a href="print_receipt.php?receiptNo=<?php echo $printrow['receiptNo']; ?>" target="_blank"> <?php echo $printrow['receiptNo']; ?></a></td>
            </tr>
        <?php } ?>
        </table>
    </div>
    </div>


<div class="container theme-spacelab theme-compact">

<!-- ============================================================== --> 
    <?php include("includes/admin_nav.php"); ?>
<!-- ================================================================= -->
<div style="margin-top: -50px"></div>

<div class="page-header">
    <h1><i class="glyphicon glyphicon-shopping-cart"></i> <?php echo siteDetails("sitename"); ?> Inventory System</h1>
</div>
    
    <?php if(isset($_SESSION['ADMIN_ID'])) {
        if($getdata['password'] == sha1("admin")){
    ?>

     <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <b>Notice:</b> You are still using the default password, kindly <a href="control_panel.php">click here</a> to change your password
    </div> 

    <?php } }?>

    <div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        The product that is running low will have a yellow row while an empty product will have a red row.
    </div> 

    <?php echo $errmsg; ?>

            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <!-- <div class="panel-heading">
                            <b>Key: </b>
                        </div> -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Categories</th>
                                            <th>Prize</th>
                                            <th>Order Qty</th>
                                            <th>Total Qty</th>                                            
                                            <th>Action</th>
                                         
                                        </tr>
                                    </thead>
                                       
                                    <tbody>
                                          <?php 

                                    $row = mysqli_query($con, "SELECT * FROM tbl_product");
                                    while($getRow = mysqli_fetch_array($row)){ $comb = 'item'.$getRow['id']; ?>

                                        <tr  
                                        <?php 
                                        if($getRow['Qty'] < 1) { echo "style='background-color:#E41B17;color:white;font-weight:bold'"; } 
                                        elseif ($getRow['Qty'] < 5) {
                                             { echo "style='background-color:orange;color:white;font-weight:bold'"; } 
                                        }
 
                                        ?> >
                                            <td><?php echo $getRow['prod_Name']; ?></td>
                                            <td><?php echo $getRow['prod_Cat']; ?></td>
                                            <td><?php echo $getRow['priZe']; ?></td>
                                            <td>
                                                <?php if($getRow['Qty'] < 1) { echo "<input type='number' disabled style='font-weight:bold;text-align:center;width:4em;border-radius: 5px;border: 1px solid skyblue;color: gray'>";  } 
                                                else{ ?>
                                                <input class="digitOnly" type='text' id="<?php echo $getRow['id']; ?>_qty" value='1' style='font-weight:bold;text-align:center;width:4em;border-radius: 5px;border: 1px solid skyblue;color: gray'>
                                           <?php }?>
                                            </td>
                                          <td><?php echo $getRow['Qty']; ?></td>
                                
                                            <td>

                                <input type="hidden" id="<?php echo $getRow['id']; ?>_name" value="<?php echo $getRow['prod_Name']; ?>">
                                <input type="hidden" id="<?php echo $getRow['id']; ?>_price" value="<?php echo $getRow['priZe'];  ?>">
                                <form method="post" action="">
                                    <button value="" <?php if($getRow['Qty'] < 1) { echo "disabled";} ?>
                                        onclick="cart(<?php echo $getRow['id']; ?>)" name="addItem" class="btn btn-default">
                                            <i class="glyphicon glyphicon-plus"></i>
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
                <!-- calccss spacelab -->
                <div class="col-lg-3">

                        <div class="calc">
                            <form>
                                <input class="display" disabled="" placeholder="0">
                            </form>
                            <table>
                                <tr>
                                    <td><input type="button" value="c" onclick="clearVal();"></td>
                                    <td><input type="button" value="/" onclick="insertVal('/');"></td>
                                    <td><input type="button" value="<" onclick="delVal();"></td>
                                    <td><input type="button" value="x" onclick="insertVal('*');"></td>
                                </tr> 
                                <tr>
                                    <td><input type="button" value="7" onclick="insertVal(7);"></td>
                                    <td><input type="button" value="8" onclick="insertVal(8);"></td>
                                    <td><input type="button" value="9" onclick="insertVal(9);"></td>
                                    <td><input type="button" value="-" onclick="insertVal('-');"></td>
                                </tr> 
                                <tr>
                                    <td><input type="button" value="4" onclick="insertVal(4);"></td>
                                    <td><input type="button" value="5" onclick="insertVal(5);"></td>
                                    <td><input type="button" value="6" onclick="insertVal(6);"></td>
                                    <td><input type="button" value="+" onclick="insertVal('+');"></td>
                                </tr> 
                                <tr>
                                    <td><input type="button" value="1" onclick="insertVal(1);"></td>
                                    <td><input type="button" value="2"  onclick="insertVal(2);"></td>
                                    <td><input type="button" value="3"  onclick="insertVal(3);"></td>
                                    <td rowspan="2"><input onclick="equateval()" style="height: 97px;background-color: orange" type="button" value="="></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><input style="width: 97px" type="button" value="0" onclick="insertVal(0);"></td>
                                    <td><input type="button" value="." onclick="insertVal('.');"></td>

                                </tr>

                            </table>
                        </div>
                </div>

            <div class="col-lg-3">
            <form action="" method="POST">
                <table>
                    <tr>
                        <td>
                            <button name="save_receipt" class="btn btn-warning"> 
                                <i class="glyphicon glyphicon-plus"></i> Sell
                            </button> &nbsp;
                        </td>
                        <td> 
                            <button name="clearReceipt" class="btn btn-default"> 
                                <i class="glyphicon glyphicon-edit"></i> Clear  
                            </button> &nbsp;
                        </td>
                        
                        <td> 
                            <span class="btn btn-default print_record"> 
                                <i class="glyphicon glyphicon-print"></i> Print 
                            </span> 
                        </td>
                       
                    </tr>
                </table>
            </form>
            <p></p>

            <!-- ================================PRINT SECTION STARTS================================== -->
                    <div class="well well-small" style="height: 400px auto;background:white;">

                                <p style="font-weight: bold;padding: 5px;text-align: center;font-size: 16px; border-top: 2px dotted black;border-bottom: 2px dotted black">RECEIPT
                                </p>
                                <p><?php echo siteDetails("site_address"); ?></p>
                                <p>Receipt#: <?php echo $randomdigit; ?></p>
                                <p>Date: <?php echo date("d/m/y h:i:s a") ?></p>
                                <p>Cashier: <?php echo $getdata['fullname']; ?></p>

                        <table border="0" width="100%">
                                <tr style="border-bottom: 1px dotted black;border-top: 1px dotted black;font-weight: bold;">
                                    <td>Items</td>
                                    <td>Qty</td>
                                    <td>&#8358;Price</td>
                                    <td>&#8358;Total</td>
                                </tr>
                                <tbody id="getTable"></tbody>                            
                        </table>
                            <br>
                                <p style="border-top: 1px dotted black;"></p>
                                <p style="float: right;font-weight: bolder;">Subtotal: &#8358;<?php if (isset($_SESSION['sum'])) {
                           echo $_SESSION['sum'];
                       }  ?></p>
                                <p style="font-weight: bold">Tax: 0</p>
                                <p style="font-weight: bold;padding: 5px;text-align: center;font-size: 16px; border-top: 2px dotted black;border-bottom: 2px dotted black">THANK YOU
                                </p>
                                <p style="text-align: center;"><i class="glyphicon glyphicon-barcode"></i></p>
                    </div>

                </div>
               <!--  ==================================PRINT SECTION ENDS================================== -->

        </div>

</div>
<?php include "dash_footer.php"; ?>

</body>



