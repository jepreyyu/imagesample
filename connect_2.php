<?php
	/*$host  = "localhost";
	$uname = "root";
	$pword = "";
	$dbase = "user";

	$conn = new mysqli($host, $uname, $pword, $dbase) or die("NOT CONNECTED.");*/
?>

<?php
	/*include_once 'psl-config.php';   // As functions.php is not included
	$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);*/
	
	/*$connection_string = 'DRIVER={SQL Server};SERVER=10.249.120\HPIWEBDBSQL;DATABASE=HPIDOS';
	$user = 'sa';
	$pass = '';
	$connection = odbc_connect( $connection_string, $user, $pass, SQL_CURSOR_FORWARD_ONLY  );
	//$connection = odbc_connect( $connection_string, $user, $pass, SQL_CUR_USE_ODBC );*/
	
	$hris_string = 'DRIVER={SQL Server Native Client 11.0};SERVER=10.249.120.99;DATABASE=HuManEDGECLIENT';
//	$hris_string = 'DRIVER={SQL Server};SERVER=HPIDPC716\SQLEXPRESS;DATABASE=sample';
	//$hris_string = 'DRIVER={SQL Server};SERVER=HPIDPC716\SQLEXPRESS;DATABASE=misInv';
	$hris_user = 'sa';
	$hris_pass = 'pa$sHRIS';
	$hris2 = odbc_connect( $hris_string, $hris_user, $hris_pass );
?>