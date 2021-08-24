<?php
error_reporting(0);
session_start();

$sum = 0;


  if(isset($_POST['item_name']))
  {
    
    $_SESSION['name'][]=$_POST['item_name'];
    $_SESSION['qty'][]=$_POST['item_qty'];
    $_SESSION['price'][]=$_POST['item_price'];
  }

  if(isset($_POST['showcart']))
  {
    for($i=0;$i<count($_SESSION['name']);$i++)
    { 
      $name = $_SESSION['name'][$i];
      $qty = $_SESSION['qty'][$i];
      $price =  $_SESSION['price'][$i];
      $total = $qty * $price;
      $sum +=  $total; 
      $_SESSION['sum'] = $sum;
      ?>
      <tr>
        <td><?php echo $name; ?></td>
        <td><?php echo $qty; ?></td>
        <td><?php echo $price; ?></td>
        <td><?php echo $total; ?></td>
      </tr>
   <?php }
    exit();	
  }
?>
