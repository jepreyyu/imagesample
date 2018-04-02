<?php

	/* IF MAIN SERVER ANG GAMIT
	$hris_string = 'DRIVER={SQL Server};SERVER=HPIDPC716\SQLEXPRESS;DATABASE=sample';
	$hris = odbc_connect( $hris_string, NULL, NULL );*/
	
	$hris_string = 'DRIVER={SQL Server};SERVER=192.168.6.52\SQLEXPRESS;DATABASE=SAMPLE';
	$hris_user 	 = 'sa';
	$hris_pass   = 'H0ndaphil123';
	$hris 		 =  odbc_connect( $hris_string, $hris_user, $hris_pass );
?>