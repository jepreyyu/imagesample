<?php
	include_once 'includes/db_connect.php';
	session_start();

	
$sn = $_SESSION['snum'];
$enum = $_SESSION['empnum'];
$usn = $_SESSION['usern'];
$mod = $_SESSION['mdl']; 
$desc = $_SESSION['dcp'];
$ic = $_SESSION['itmcde'];
?>


<!DOCTYPE html>
<html>
<link rel="stylesheet" href="css/style.css" />
    <head>
        <meta charset="UTF-8" http-equiv="x-ua-compatible" content="IE=edge">
        <title>Registration successful</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
	
    <body>
	<div class="header"><img src="images/banner2.png" width="100%">
		<div class="login-card">	
		<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
	
		<table>
			<th colspan="2"><div class="error">
			<?php
				//for user
				//$username = $_SESSION["uname"];
				
				$sq1l = "SELECT EMPLOYEE_ID,SECNAME FROM [sample].[dbo].[ITASSET_USERS] WHERE SECNAME='".$sn."'";
				$result = odbc_exec($hris, $sq1l);
				if (!$result){
					exit("Error in SQL");
				} else {
					while ($row = odbc_fetch_array($result)){
						$id = odbc_result($result,1);
						$username = odbc_result($result,2);
					}
				}				
				
				$from = "edwinsumadsad.mis@hondaph.com";
				//$from = "brennpasuot.itd@hondaph.com";
				$link = "https://hpisystem.hondaph.com/portal/confirm.php?id=".$id;
				//$msg = "Your username is " . $username . ". Click or copy and paste this link to activate your account. " . $link;
				$msg ="{Associate name: ".$usn."}{}{Model: ".$mod."}{}{Description: ".$desc." }{}{Item Code: ".$ic."}"; 
				$subj = "TestingII ";
				//$to = $_SESSION["email"];
				$to = "jrr.jamille@outlook.com";
				
				$arg = $from . " " . $to . " " . '"'.$subj.'"' . " " . '"'.$msg.'"';
				
				exec("C:\wamp64\www\Security\Pass2EmailMultiline.exe $arg");
				//echo "C:\delphiprograms\pass2email.exe " . $arg;
				
				//echo "Your username has been sent to " . $to;
				//echo "<br>Please open you email to confirm your registration." ;
				//echo "<br><a href='index.php'>Click here to Login</a>";   
				
				//for admin
				/*$msg_admin = "Pending user activation. Login to http://localhost/hpi_portal/index.php";
				$subj_admin = "[HPI Information Systems Portal] Pending account activation";
				$to_admin = "ctadiarca@hondaph.com";
				
				$arg_admin = $from . " " . $to_admin . " " . '"'.$subj_admin.'"' . " " . '"'.$msg_admin.'"';
				exec("C:\delphiprograms\pass2email.exe $arg_admin");*/
				
				odbc_close($hris);
			?>
			</div></th>
			
			
		</table>
        
		
		
    </body>
</html>