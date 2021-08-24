<?php

// =================================
// Connection to the database !!!
// Designed by priest
// Sponsored by Devparse
// =================================

class dbconnection
{
	//Development
	// public $host = "localhost";
	// public $user = "root";
	// public $pass = "";
	// public $dbase = "inventory";

	//Production
	public $host = "us-cdbr-east-04.cleardb.com";
	public $user = "bfa50b2b9123ea";
	public $pass = "51ec6a98";
	public $dbase = "heroku_2b3cb1ad6973dfc";


	public $val;
	
	public function connect(){

		$val = @mysqli_connect($this->host,$this->user,$this->pass,$this->dbase);

		if(!$val){
			echo "Authentication..... Database connection failed";
		}
		else{
			return $val;
		}
	}	
}




?>