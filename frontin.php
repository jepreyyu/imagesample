<?php
include_once ('includes/db_connect.php');
	session_start(); 
	$sn1 = $_SESSION['asn'];
	$log1 = $_SESSION['log'];
	$typ1 = $_SESSION['typ'];
	$ic = "";
	$test1 ='';

	//$fr = "mbuhain@hondaph.com";
	//$to = "mbuhain@hondaph.com";
	$fr =  "jepreyyu@outlook.com";
	$to = "jepreyyu@outlook.com";

	$enum='';

	$_SESSION['fr'] = $fr; 
	$_SESSION['to'] = $to; 

	$path="D:\wamp\www\AuthorizationRequestForm";
	$_SESSION['path'] = $path; 

if ($log1== ''){
	echo"<script> alert ('( ✘ ) User is not Login !') </script>";
          $_SESSION['log'] = ''; 
  include_once 'conn/mainpage.php';
}
elseif($log1=='Yes' && $typ1 !='Security Guard IN') 
{
	echo"<script> alert ('( ✘ ) User is not login !') </script>";
          $_SESSION['log'] = ''; 
  include_once 'conn/mainpage.php';
}
else 
{		
	$emp = '';
if (isset($_POST['submit']))
{
	if(empty($_POST['txt1']))
    	{
    		$emp = '!';
    	}
}	

if (isset($_POST['back']))
{
	session_start();
   	$_SESSION['log'] = ''; 
	  
	header ('location:frontpage.php');
}
?>

 
<script>
function uniCharCode() {
    start = new Date().getTime();
}

function uniKeyCode(event) {
    var key = event.keyCode;
    //document.getElementById("demo2").innerHTML = "The Unicode KEY code is: " + key;
	if(key == 13){
		var elapsed = new Date().getTime() - start;
		if(elapsed > 25)
		{
			alert("( ✘ ) Keyboard input is not allowed !");
			document.getElementById('txtInput').value = '';
		}
	}
}
</script>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="img/favicon.ico"/>
</head>
<title>IN - Asset Verification and Monitoring System</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php
date_default_timezone_set('Asia/Manila');
    $dt = date('Y-m-d');
    $cono = date('y');
    $d  = date('M. d,Y/D');
    $h  = date('H:i:s');
    $po = date('mdy-His');
	?>

<style>
	
.blink
{	
}

span
{
	animation: blink 1s linear infinite;
}
	
 @keyframes blink{
0%{opacity: 0;}
50%{opacity: .8;}
100%{opacity: 1;}
}
</style>
	
	
<body style='background-image: url("img/nwp.png"); background-repeat:no-repeat;background-color:'onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">

<div style="margin-left:2px;">
&nbsp;&nbsp;&nbsp;<label style='font-family: Courier New; font-size: 17px;color:white'><b><?php echo ' NAME : '.$sn1;?></b></label><br><br>
</div>
<div class="clock" style="margin-top:2px;">
      <form name="clock">
	  <?php
   $date_array = getdate();
	
   $formated_date  = "";
   $formated_date .= $date_array['mon']. "/";
   $formated_date .= $date_array['mday']. "/";
   $formated_date .= $date_array['year'];
   
   print "<input type='text' name='date' value='".$formated_date."' readonly style='width:80px; background-color:transparent;font-family:Courier New; font-size:14px; border-style:none; color:white; text-align:center'>"; 
?>  <input style="width:115px; background-color:transparent; border-style:none;font-family:Courier New; font-size:14px; color:white" type="text" readonly class="trans" name="face" value="">
</form>
</div>


 <script language="javascript" type="text/javascript">
/* Visit http://www.yaldex.com/ for full source code
and get more free JavaScript, CSS and DHTML scripts! */
<!-- Begin
var timerID = null;
var timerRunning = false;
function stopclock (){
if(timerRunning)
clearTimeout(timerID);
timerRunning = false;
}
function showtime () {
var now = new Date();
var hours = now.getHours();
var minutes = now.getMinutes();
var seconds = now.getSeconds()
var timeValue = "" + ((hours >12) ? hours -12 :hours)
if (timeValue == "0") timeValue = 12;
timeValue += ((minutes < 10) ? ":0" : ":") + minutes
timeValue += ((seconds < 10) ? ":0" : ":") + seconds
timeValue += (hours >= 12) ? " P.M." : " A.M."
document.clock.face.value = timeValue;
timerID = setTimeout("showtime()",1000);
timerRunning = true;
}
function startclock() {
stopclock();
showtime();
}
window.onload=startclock;
// End -->
</script>
	
<script type="text/javascript">
        window.history.forward();
        function noBack() {
            window.history.forward();
        }
    </script>
	


<form action='' method='post'>

		<br><br><br><br>
	  <font style ="font-family:Times New Roman;font-size:120px;color:skyblue;margin-left:960px"><b> IN </b></font> <br><br>

	   <font style="font-family:Californian FB;font-size:20px;color:black;margin-left:800px;"><b>Item Code/Serial Number :</b> </font> <br><input type="text" name="txt1" id="txtInput" autocomplete="off" placeholder="Scan barcode here . . ." autofocus title="Scan Code" onkeypress="uniCharCode(event)" onkeydown="uniKeyCode(event)"  style="margin-top:5px; margin-left:800px;border-radius:5px;height:50px;width:450px;text-align:center;font-family:Californian FB;font-size:17px;border-color:skyblue">&nbsp;&nbsp;<span title='Empty Text Field !' style='font-size: 35px; font-family: stencil; color:red;'><?php echo $emp; ?></span>
		<input type="submit" name="submit" value="." style="height:1px; width:1px; border-style:none;background-color:white"> <br>
		
		<input type="submit" name="back" value="" style="background-image:url('img/new/Picture7.png'); width:200px; height:55px; border-color: skyblue; text-align:right; margin-left:1050px; margin-top:125px; ">

     </form>
		
<?php 
if (isset($_POST['submit']))
{
	$code = $_POST['txt1'];

		if(empty($_POST['txt1']))
     	{
          	//echo "<script> alert ('( ✘ ) Please fill item code !') </script>";
		  	$message = "";
     	}
		else 
		{

			$sql_anno = "SELECT a.ItemCode,a.SerialNumber,a.EmpNumber,a.UserName,a.Model,a.Description,a.AllowCode,a.RequestNumber,a.InOutFlag, b.StartDate, b.EndDate, b.Employee_ID FROM [misInv].[dbo].[ItemMaster] as a left join [sample].[dbo].[ITASSET_RequestForm_Sample1] as b on a.ItemCode = b.AssetType where ItemCode =  '".$code."' or SerialNumber = '".$code."'"; 

            	$res_anno = odbc_exec($hris, $sql_anno);
          		if (!$res_anno) 
          		{
            		exit();
            	}
            	else if(odbc_num_rows($res_anno) > 0)
            	{
            		while ($row = odbc_fetch_array($res_anno))
            		{
               		$ic = odbc_result($res_anno,1);
               		$sn = odbc_result($res_anno,2);
               		$enum = odbc_result($res_anno,3);
               		$usn = odbc_result($res_anno,4);
               		$mod = odbc_result($res_anno,5); 
               		$desc = odbc_result($res_anno,6); 
               		$allc = odbc_result($res_anno,7);
               		$rqnm = odbc_result($res_anno,8); 
			   		$iof = odbc_result($res_anno,9);
			   		$sdrtn1 = odbc_result($res_anno,10);
					$edrtn1 = odbc_result($res_anno,11);
			   		$nme1=odbc_result($res_anno,12);
			   
			    		$_SESSION['itmcde'] =  $ic;
			    		$_SESSION['snum'] =  $sn;
			    		$_SESSION['empnum'] =  $enum;
			    		$_SESSION['usern'] =  $usn;
			    		$_SESSION['mdl'] =  $mod;
			    		$_SESSION['dcp'] =  $desc;
			    		$_SESSION['llcd'] =  $allc;
			    		$_SESSION['rqnum'] =  $rqnm;	
			    		$_SESSION['inout'] =  $iof;	
			    		$_SESSION['sdate'] =  $sdrtn1;
			    		$_SESSION['edate'] =  $edrtn1;
						$_SESSION['ed'] =  $nme1;

						include_once 'includes/connect_2.php';
						$dtn = odbc_exec($hris2, "SELECT RIGHT(Employee_ID, 4) as EmployeeID,POSTIONNAME,DEPNME,Employee_ID FROM [HuManEDGECLIENT].[dbo].[VIEW_HRIS_EmploymentInfo] where Employee_ID   LIKE   '".'%'.$enum."'" );
      					while ($row = odbc_fetch_array($dtn))
        				{
							$q = odbc_result($dtn,1);
							$qq =odbc_result($dtn,2);
           					$qqq = odbc_result($dtn,3);
           					$qqqq = odbc_result($dtn,4);
		   	
			    			$_SESSION['eid'] =  $q;
			    			$_SESSION['pstion'] =  $qq;
			    			$_SESSION['deptn'] =  $qqq;
			    			$_SESSION['id'] =  $qqqq;
						}
				
						if($iof == 'O') //approve tas nkapagout na
						{
							$fn = "SELECT StartDate, EndDate,Status FROM [sample].[dbo].[ITASSET_RequestForm_Sample1]  where EndDate <= '".$formated_date."' and AssetType   = '".$ic."'";

      						$resfn = odbc_exec($hris, $fn);
          					if(odbc_num_rows($resfn) > 0) //pag expired na ang end date ng temporary
            				{
            					$indte = $dt;
								$intme = $h;
		
								$_SESSION['indte']= $indte;
								$_SESSION['intme']= $intme;
			
								include_once ('includes/db_connect.php'); 
								odbc_exec($hris, "INSERT INTO [dbo].[HistoryLog] (empnum, associatename, itemcode, indate, intime, status, securityguard, durationstart, durationend, empnumberfull, department, inputedempid, allowcode,problemflag,reviewcode,reviews) VALUES ('', '', '".$_POST['txt1']."', '".$indte."', '".$intme."','I','".$sn1."','".$sdrtn1."','".$edrtn1."','','','','".$allc."','','','')");

								$log = odbc_exec($hris, "SELECT LogID from [dbo].[HistoryLog] where indate='".$indte."' and intime='".$intme."'");
								while ($row = odbc_fetch_array($log))
        						{
        							$lgid = odbc_result($log,1);
        						}

        						include_once 'includes/connect_2.php';
								$dtn = odbc_exec($hris2, "SELECT RIGHT(Employee_ID, 4) as EmployeeID,POSTIONNAME,DEPNME,Employee_ID FROM [HuManEDGECLIENT].[dbo].[VIEW_HRIS_EmploymentInfo] where Employee_ID   LIKE   '".'%'.$enum."'" );
      							while ($row = odbc_fetch_array($dtn))
        						{
									$q = odbc_result($dtn,1);
									$qq =odbc_result($dtn,2);
           							$qqq = odbc_result($dtn,3);
           							$qqqq1 = odbc_result($dtn,4);
								}

        						$_SESSION['lgid']= $lgid;
		
        						$res = 'Item duration has expired.';
		
        						$from = "$fr";
								$subj = "Asset Security Verification and Monitoring System";
								$msg ="{".$res."}{}{Log ID : ".$lgid."}{Associate name: ".$usn."}{Employee ID: ".$qqqq1." }{Item Code: ".$_POST['txt1']."}{Model: ".$mod."}{Description: ".$desc." }"; 
								$to = "$to";
						
								$arg = $from . " " . $to . " " . '"'.$subj.'"' . " " . '"'.$msg.'"';
								
								exec($path."\Pass2EmailMultiline.exe $arg");
								odbc_close($hris);

								header('location:denyinallow.php');
							}
							elseif(odbc_num_rows($resfn) < 1) //pag hindi pa expired
            				{
								header('location:in1.php');
							}
						}
						else //either in na siya or hindi pa approved
						{
							if ($allc =='P')//approve na OR IN ang flag
							{
							$indte = $dt;
							$intme = $h;
							odbc_exec($hris, "INSERT INTO [dbo].[HistoryLog] (empnum, associatename, itemcode, indate, intime, status, securityguard, durationstart, durationend, empnumberfull, department, inputedempid, allowcode,problemflag,reviewcode,reviews) VALUES ('".$enum."', '".$usn."', '".$ic."', '".$indte."', '".$intme."','I','".$sn1."','".$sdrtn1."','".$edrtn1."','".$qqqq."','".$qqq."','','".$allc."','1','NEX','This Item Was Not Registered Upon Exit')");

							//email
							$log = odbc_exec($hris, "SELECT LogID from [dbo].[HistoryLog] where indate='".$indte."' and intime='".$intme."'");
							while ($row = odbc_fetch_array($log))
        					{
        						$lgid3 = odbc_result($log,1);
        					}

        					$res = 'This item was not registered upon exit.';
		
        					$from = "$fr";
							$subj = "Asset Security Verification and Monitoring System";
							$msg ="{".$res."}{}{Log ID : ".$lgid3."}{Associate name: ".$usn."}{Employee ID: ".$qqqq." }{Item Code: ".$_POST['txt1']."}{Model: ".$mod."}{Description: ".$desc." }"; 
							$to = "$to";
						
							$arg = $from . " " . $to . " " . '"'.$subj.'"' . " " . '"'.$msg.'"';
							
							exec($path."\Pass2EmailMultiline.exe $arg");
							odbc_close($hris);

					      	header('location:front1.php');
						}
						elseif ($allc =='' && $ic!='') //pag hindi pa approved
						{	
							$indte = $dt;
							$intme = $h;
		
							$_SESSION['indte']= $indte;
							$_SESSION['intme']= $intme;
							$_SESSION['mes']= 'ITEM IS NOT APPROVE';
		
							include_once ('includes/db_connect.php'); 
							odbc_exec($hris, "INSERT INTO [dbo].[HistoryLog] (empnum,associatename,itemcode,indate,intime,status,securityguard,durationstart,durationend,empnumberfull,department,inputedempid,allowcode,problemflag,reviewcode,reviews) VALUES ('', '', '".$_POST['txt1']."', '".$indte."', '".$intme."','I','".$sn1."','9999-12-31','9999-12-31','','','','','1','NAU','Item was Not Authorized')");

							$log = odbc_exec($hris, "SELECT LogID from [dbo].[HistoryLog] where indate='".$indte."' and intime='".$intme."'");
							while ($row = odbc_fetch_array($log))
        						{
        							$lgid = odbc_result($log,1);
        						}

        						include_once 'includes/connect_2.php';
							$dtn = odbc_exec($hris2, "SELECT RIGHT(Employee_ID, 4) as EmployeeID,POSTIONNAME,DEPNME,Employee_ID FROM [HuManEDGECLIENT].[dbo].[VIEW_HRIS_EmploymentInfo] where Employee_ID   LIKE   '".'%'.$enum."'" );
      						while ($row = odbc_fetch_array($dtn))
        						{
								$q = odbc_result($dtn,1);
								$qq =odbc_result($dtn,2);
           						$qqq = odbc_result($dtn,3);
           						$qqqq1 = odbc_result($dtn,4);
							}

        						$_SESSION['lgid']= $lgid;
		
        						$res = 'Item was Not Authorized.';
		
        						$from = "$fr";
								$subj = "Asset Security Verification and Monitoring System";
								$msg ="{".$res."}{}{Log ID : ".$lgid."}{Associate name: ".$usn."}{Employee ID: ".$qqqq1." }{Item Code: ".$_POST['txt1']."}{Model: ".$mod."}{Description: ".$desc." }"; 
								$to = "$to";
						
								$arg = $from . " " . $to . " " . '"'.$subj.'"' . " " . '"'.$msg.'"';
								
								exec($path."\Pass2EmailMultiline.exe $arg");
								odbc_close($hris);
			
								header('location:denyin.php');
						}
						elseif ($allc =='T') //approve na OR IN ang flag
						{
							//email
							$indte = $dt;
							$intme = $h;
							odbc_exec($hris, "INSERT INTO [dbo].[HistoryLog] (empnum, associatename, itemcode, indate, intime, status, securityguard, durationstart, durationend, empnumberfull, department, inputedempid, allowcode,problemflag,reviewcode,reviews) VALUES ('".$enum."', '".$usn."', '".$ic."', '".$indte."', '".$intme."','I','".$sn1."','".$sdrtn1."','".$edrtn1."','".$qqqq."','".$qqq."','','".$allc."','1','NEX','The Item Was Not Registered Upon Exit')");

							//email
							$log = odbc_exec($hris, "SELECT LogID from [dbo].[HistoryLog] where indate='".$indte."' and intime='".$intme."'");
							while ($row = odbc_fetch_array($log))
        					{
        						$lgid3 = odbc_result($log,1);
        					}

        					$res = 'This item was not registered upon exit.';
		
        					$from = "$fr";
							$subj = "Asset Security Verification and Monitoring System";
							$msg ="{".$res."}{}{Log ID : ".$lgid3."}{Associate name: ".$usn."}{Employee ID: ".$qqqq." }{Item Code: ".$_POST['txt1']."}{Model: ".$mod."}{Description: ".$desc." }"; 
							$to = "$to";
						
							$arg = $from . " " . $to . " " . '"'.$subj.'"' . " " . '"'.$msg.'"';
							
							exec($path."\Pass2EmailMultiline.exe $arg");
							odbc_close($hris);

							header('location:front1.php');
						}
					}//in or empty ang allow code
				}

	  			
	  	}
		elseif ($ic=='')
        {

        }

        	$sql_anno = "SELECT itemcode from [misInv].[dbo].[ItemMaster] where ItemCode =  '".$code."' or SerialNumber = '".$code."'";

          $res_anno = odbc_exec($hris, $sql_anno);

          if (!$res_anno) 
          {
              exit();
          }
          else if(odbc_num_rows($res_anno) > 0)
          {
               while ($row = odbc_fetch_array($res_anno))
               {
               	$itmcode = odbc_result($res_anno,1);

               	$res_anno1 = odbc_exec($hris, "SELECT assetype, status from [sample].[dbo].[ITASSET_RequestForm_Sample1] where AssetType =  '".$itmcode."'");
               	if(odbc_num_rows($res_anno1) > 0)
          		{
               		while ($row = odbc_fetch_array($res_anno1))
               		{
               			$status = odbc_result($res_anno,2);

               			if($status=='Entered')
               			{

               			}
               		}
               	}
               	else
               	{

               	}
               }
          }
          else //pag walang nahanap sa itemmaster
          {
          	//echo "<script> alert ('".$test1."') </script>";
          	
			   		$_SESSION['itmcde'] =  $_POST['txt1'];
			    	$_SESSION['mdl'] =  '';
			    	$_SESSION['snum'] =  '';
					$_SESSION['empnum'] =  '';
			    	$_SESSION['usern'] =  '';
			    	$_SESSION['deptn'] =  '';
			    	$_SESSION['id'] = '';
			    	$_SESSION['sdate'] = '';
			    	$_SESSION['edate'] = '';
					$_SESSION['his']= 'Yes';
					$_SESSION['mes']= 'ITEM IS NOT IN I.T ASSET';

					$indte = $dt;
					$intme = $h;

					$_SESSION['indte']= $indte;
					$_SESSION['intme']= $intme;

					include_once ('includes/db_connect.php'); 
					odbc_exec($hris, "INSERT INTO [dbo].[HistoryLog] (empnum,associatename,itemcode,indate,intime,status,securityguard,durationstart,durationend,empnumberfull,department,inputedempid,allowcode,problemflag,reviewcode,reviews) VALUES ('', '', '".$_POST['txt1']."', '".$indte."', '".$intme."','I','".$sn1."','9999-12-31','9999-12-31','','','','','','','')");

					$log = odbc_exec($hris, "SELECT LogID from [dbo].[HistoryLog] where indate='".$indte."' and intime='".$intme."'");
					while ($row = odbc_fetch_array($log))
        			{
        				$lgid = odbc_result($log,1);
        			}
        			$_SESSION['lgid']= $lgid;

        			$res = 'This item was not in item master.';

        			$from = "$fr";
					$subj = "Asset Security Verification and Monitoring System";
					$msg ="{".$res."}{}{Log ID : ".$lgid."}{Associate name: N/A}{Employee ID: N/A }{Item Code: ".$_POST['txt1']."}{Model: N/A }{Description: N/A }"; 
					$to = "$to";
					
					$arg = $from . " " . $to . " " . '"'.$subj.'"' . " " . '"'.$msg.'"';
					
					exec($path."\Pass2EmailMultiline.exe $arg");
					odbc_close($hris);

					header('location:denyin.php');
				

          }
	}
}
?>
	 
<?php
include_once('includes/footer.php');
?>
</body>
</html>
<?php
}
?>