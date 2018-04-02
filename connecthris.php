<?php
	$hris_string = 'DRIVER={SQL Server};SERVER=10.249.120.99;DATABASE=HuManEDGECLIENT';
	$hris_user 	 = 'sa';
	$hris_pass   = 'pa$sHRIS';
	$hris2 		 =  odbc_connect( $hris_string, $hris_user, $hris_pass );
?>