<?php

// =================================
// Connection to the database !!!
// Designed by priest
// Sponsored by Devparse
// =================================

class dbconnection
{
	//Development
	public $host = "localhost";
	public $user = "root";
	public $pass = "";
	public $dbase = "inventory";

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