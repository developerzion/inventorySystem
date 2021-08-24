<?php

include("includes/gen_function.php");

if(!isset($_SESSION['GLOBALID'])){
header("location: index.php");
}

$receiptid = $_GET['receiptNo'];
if(!isset($receiptid)){
    header("location:dashboard.php");
}
$querytable = mysqli_query($con,"SELECT * FROM tbl_sales WHERE receiptNO='$receiptid'");
$count_row = mysqli_num_rows($querytable);
if($count_row < 1) header("location:dashboard.php");




?>
<?php include("includes/links.php"); ?> 
<style type="text/css">
    *{
        font-size: 14px
    }
    .receiptIns{
        font-size: 11px;
    }
    .subtotal{
        font-size: 12px
    }
</style>
<!-- ================================PRINT SECTION STARTS================================== -->

    <div class="col-lg-3">  
        <div class="well well-small" style="height: 400px auto;background:white;">

                    <p style="font-weight: bold;padding: 5px;text-align: center;font-size: 16px; border-top: 2px dotted black;border-bottom: 2px dotted black">RECEIPT
                    </p>
                    <p class="receiptIns"><?php echo siteDetails("site_address"); ?></p>
                    <p class="receiptIns">Receipt#: <?php echo $receiptid; ?></p>
                    <p class="receiptIns">Date: <?php echo date("d/m/y h:i:s a") ?></p>
                    <p class="receiptIns">Cashier: <?php echo $getdata['fullname']; ?></p>

            <table border="0" width="100%">
                    <tr style="border-bottom: 1px dotted black;border-top: 1px dotted black;font-weight: bold;font-size: 14px">
                        <td>Items</td>
                        <td>Qty</td>
                        <td>&#8358;Price</td>
                        <td>&#8358;Total</td>
                    </tr>
                    <tbody>
                        <?php 
                            $sum = 0;
                            while ($getRow = mysqli_fetch_array($querytable)) {
                            $sum += $getRow['total'];
                        ?>
                        <tr style="font-size: 14px">
                            <td><?php echo $getRow['prod_Name']; ?></td>
                            <td><?php echo $getRow['Qty']; ?></td>
                            <td><?php echo $getRow['priZe']; ?></td>
                            <td><?php echo $getRow['total']; ?></td>                                        
                        </tr>
                        <?php } ?>
                    </tbody>                            
            </table>
                <br>
                    <p style="border-top: 1px dotted black;"></p>
                    <p style="float: right;font-weight: bolder;font-size: 14px">Subtotal: &#8358;<?php echo $sum; ?></p>
                    <p style="font-weight: bold;font-size: 12px">Tax: 0</p>
                    <p style="font-weight: bold;padding: 5px;text-align: center;font-size: 10px; border-top: 2px dotted black;border-bottom: 2px dotted black">THANK YOU
                    </p>
                    <p style="text-align: center;"><i class="glyphicon glyphicon-barcode"></i></p>
                    <p><a href="" onclick="window.print()">Print</a></p>
        </div>

    </div>
   <!--  ==================================PRINT SECTION ENDS================================== -->





