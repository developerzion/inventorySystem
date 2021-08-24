<?php
include("db_get_connection.php"); 
session_start();
$connect = new dbconnection();
$con = $connect->connect();

date_default_timezone_set("Africa/Lagos");


if(isset($_SESSION['ID'])){
	$staff_id = $_SESSION['ID'];
	$getdata = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM tbl_staff WHERE rand ='$staff_id'"));
}
if(isset($_SESSION['ADMIN_ID'])){
	$admin_id = $_SESSION['ADMIN_ID'];
	$getdata = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM tbl_admin WHERE id ='$admin_id'"));
}






// ===============================FUNCTION DOMAIN=======================================//
function insertRecord($prod_name, $prod_cat, $prize, $quantity, $shelve){
	$connect = new dbconnection();	
	$con = $connect->connect();	

	$prodN = cleanString($prod_name);
	$prodC = cleanString($prod_cat);
	$prZ = cleanString($prize);
	$qTY = cleanString($quantity);
	$slV = cleanString($shelve);

	$qline = mysqli_query($con,"SELECT * FROM tbl_product WHERE prod_Name='$prodN'");


		if(mysqli_num_rows($qline) > 0){
			echo "<div class='alert alert-danger'><b>This record has been added before</b></div>";
		}
		else{
			if(empty($prodN) || empty($prodC) || empty($prZ) || empty($qTY) || empty($slV)){
				echo "<div class='alert alert-danger'><b>All fields are required</b></div>";
			}
			else{
				mysqli_query($con,"INSERT INTO tbl_product (`prod_Name`,`prod_cat`,`priZe`,`Qty`,`shelVe`)
					VALUES ('$prodN','$prodC','$prZ','$qTY','$slV')");
				mysqli_query($con,"INSERT INTO `tbl_totalproduct`(`productname`, `productcat`, `prize`, `qty`, `shelve`) VALUES ('$prodN','$prodC','$prZ','$qTY','$slV')");
				echo "<div class='alert alert-success'><b>Record successfully added</b></div>";
			}
		}
		
}

function create_category($con, $cat){
	$category = cleanString($cat);
	$check = mysqli_num_rows(mysqli_query($con, "SELECT * FROM tbl_categories WHERE categories ='$category'"));
	if($check > 0){
		return "<div class='alert alert-danger'><b>Category found</b></div>";
	}
	else{
		mysqli_query($con, "INSERT INTO tbl_categories (`categories`) VALUES ('$category')") or die(mysqli_error($con));
		return "<div class='alert alert-success'><b>Category successfully created</b></div>";
	}
}

function update_staff_rec($con, $array){

	$id = cleanString($array[0]);
	$fname = cleanString($array[1]);
	$uname = cleanString($array[2]);
	$pass = cleanString($array[3]);
	$cpass = cleanString($array[4]);

	$res = false;

	$message = "";

	$hash = sha1($pass);

	if ($pass != "") {
		if($pass != $cpass){
			echo "<div class='alert alert-danger'><b>Password is not updated: Passwords do not match</b></div>";
		}
		elseif(strlen($pass) < 7){
			echo "<div class='alert alert-danger'><b>Password is not updated: Password Length must exceed 7 character</b></div>";
		}
		else{
			mysqli_query($con, "UPDATE tbl_staff SET password='$hash' WHERE rand='$id'");
			$result = true;
		}
	}


	$fact = mysqli_query($con, "UPDATE tbl_staff SET fullname='$fname',username='$uname' WHERE rand='$id'");
	if ($fact) {
		$result = true;
	}
	if ($result == true) {
		echo "<div class='alert alert-success'><b>Record successfully updated</b></div>";	
	}
}

function deleteCat($con, $cat){
	mysqli_query($con, "DELETE FROM tbl_categories WHERE id='$cat'");
	echo "<div class='alert alert-success'><b>Category successfully deleted</b></div>";	

}

function update_site_details($con, $array){

	$storename = cleanString($array[0]);
	$storeaddress = cleanString($array[1]);

	mysqli_query($con, "UPDATE tbl_site_details SET sitename='$storename', site_address='$storeaddress'");
	echo "<div class='alert alert-success'><b>Store record successfully updated</b></div>";

}
function change_password($con, $array, $id){

	$password = cleanString($array[0]);
	$confirm_pass = cleanString($array[1]);

	$hash = sha1($password);

	if($password != $confirm_pass){
		echo "<div class='alert alert-danger'><b>!!!Passwords do not match</b></div>";
	}
	elseif(strlen($password) < 7){
		echo "<div class='alert alert-danger'><b>!!!Password Length must exceed 7 character</b></div>";
	}
	else{ //d033e22ae348aeb5660fc2140aec35850c4da997
		mysqli_query($con, "UPDATE tbl_admin SET password='$hash' WHERE id='$id'");
		echo "<div class='alert alert-success'><b>Password successfully changed</b></div>";
	}

}
function register_staff($con, $array){

	$fullname = cleanString($array[0]);
	$username = cleanString($array[1]);
	$pass = cleanString($array[2]);
	$cpass = cleanString($array[3]);
	$pos = cleanString($array[4]);


	$hash = sha1($pass);

	if($pass != $cpass){
		echo "<div class='alert alert-danger'><b>!!!Passwords do not match</b></div>";
	}
	elseif(strlen($pass) < 7){
		echo "<div class='alert alert-danger'><b>!!!Password Length must exceed 7 character</b></div>";
	}
	else{
		$rand = mt_rand();
		mysqli_query($con, "INSERT INTO tbl_staff (`rand`,`fullname`,`username`,`password`,`pos`) VALUES ('$rand','$fullname','$username','$hash','$pos')");
		echo "<div class='alert alert-success'><b>Staff record successfully created</b></div>";
	}

}
function siteDetails( $field ){
		
	$connect = new dbconnection();	
	$con = $connect->connect();	

		$qline = "SELECT `$field` FROM tbl_site_details";
		$runquery = @mysqli_query($con, $qline);
		$row = @mysqli_fetch_array($runquery);
		return $row[$field];
}
function cleanString( $val ){
	$connect = new dbconnection();	
	$con = $connect->connect();
	
	$clean = mysqli_real_escape_string($con, $val);
	return $clean;
}
function loginAdmin($adminId, $adminPass, $pos){
	$connect = new dbconnection();	
	$con = $connect->connect();

		$userid = cleanString($adminId);
		$pass = cleanString($adminPass);
		$position = cleanString($pos);
		$convertp = sha1(cleanString($adminPass));


		if(empty($userid) || empty($pass)){
		 	echo "<div class='alert alert-danger'><b>Authorization..... All fields are required</b></div>";
		 }
		else{
			 
			if($position === 'cashier'){
			 	$checklogin = mysqli_query($con, "SELECT * FROM tbl_staff WHERE username='$userid' AND password='$convertp' AND pos='$position'") or die(mysqli_error($con));
				 	if(mysqli_num_rows($checklogin) > 0){
						$row = mysqli_fetch_array($checklogin);
						session_start();
						$_SESSION['ID'] = $row['rand'];
						$_SESSION['GLOBALID'] = "e23f95de76725740b8144e2023574a3799a4e4bb";
						header("location:dashboard.php");
					}
					else{
						echo "<div class='alert alert-danger'><b>Authorization failed: Cannot authorize user details</b></div>";
					}
			 }
			elseif ($position === 'administrator') {
			 	$checklogin = mysqli_query($con, "SELECT * FROM tbl_admin WHERE username='$userid' AND password='$convertp' AND admin_post='head_admin'");
				 	if(mysqli_num_rows($checklogin) > 0){
						$row = mysqli_fetch_array($checklogin);
						session_start();
						$_SESSION['ADMIN_ID'] = $row['id'];
						$_SESSION['GLOBALID'] = "e23f95de76725740b8144e2023574a3799a4e4bb";
						header("location:dashboard.php");
					}
					else{
						echo "<div class='alert alert-danger'><b>Authorization failed: Cannot authorize user details</b></div>";
					}
			}
		 
		 	
		}	
}



?>
