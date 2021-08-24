
<?php 
include "includes/db_get_connection.php";

  if(!isset($_SESSION['GLOBALID'])){
    header("location: index.php");
  } 

$connect = new dbconnection();
$con = $connect->connect();
if (isset($_POST['extract_data'])) {
	header("Content-Type: text/csv; charset=utf-8");
	header("Content-Disposition: attachment; filename=product.csv");
	$output = fopen("php://output", "w");
	fputcsv($output, array('S/N','Product Name','Product Category','Prize','Total Quantity','Shelve','Date/Time'));
	$query = mysqli_query($con,"SELECT * FROM tbl_product order by id asc");
	while ($row = mysqli_fetch_assoc($query)) {
		fputcsv($output, $row);
	}
	fclose($output);
}

?>