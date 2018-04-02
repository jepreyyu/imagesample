<?php
include_once ('includes/db_connect.php');

session_start();
$mod = $desc = $sn = '';
$sn1 = $_SESSION['asn'];
$log1 = $_SESSION['log'];
$sn1 = $_SESSION['asn'];
$ic = $_SESSION['itmcde'];
$sn = $_SESSION['snum'];
$enum = $_SESSION['empnum'];
$usn = $_SESSION['usern'];
$mod = $_SESSION['mdl'];
$desc = $_SESSION['dcp'];
$allc = $_SESSION['llcd'];
$rqnm = $_SESSION['rqnum'];
$q = $_SESSION['eid'];
$qq = $_SESSION['pstion'];
$qqq = $_SESSION['deptn'];
$qqqq = $_SESSION['id'];
$nme1 = $_SESSION['ed'];
$sdrtn1 =$_SESSION['sdate'];
$edrtn1 =$_SESSION['edate'];
$typ1 = $_SESSION['typ'];

$fr = $_SESSION['fr']; 
$to = $_SESSION['to']; 
$path = $_SESSION['path']; 

date_default_timezone_set('Asia/Manila');
$dt = date('Y-m-d');
$cono = date('y');
$d  = date('M. d,Y/D');
$h  = date('H:i:s');
$po = date('mdy-His');
					
if ($log1== '')
{
	echo"<script> alert ('( ✘ ) User is not login') </script>";
          $_SESSION['log'] = ''; 
  include_once 'conn/mainpage.php';
}
elseif($log1=='Yes' && $typ1 !='Security Guard IN') 
{
	echo"<script> alert ('( ✘ ) User is not login') </script>";
          $_SESSION['log'] = ''; 
  include_once 'conn/mainpage.php';
}
else 
{			
	if (isset($_POST['btn1'])) //yes
	{
		if ($allc == 'P') 
		{
			
			header('location:in1.php');
		}
		elseif ($allc == 'T' && $edrtn1 >= $dt) 
		{
			header('location:in1.php');
		}
		elseif ($allc =='') 
		{
			header('location:denyin.php');
		}
		elseif ($allc == 'T' && $edrtn1 < $dt)
		{
			$indte = $dt;
			$intme = $h;
		
			$_SESSION['indte']= $indte;
			$_SESSION['intme']= $intme;
			
			include_once ('includes/db_connect.php'); 
			odbc_exec($hris, "INSERT INTO [dbo].[HistoryLog] (empnum, associatename, itemcode, indate, intime, status, securityguard, durationstart, durationend, empnumberfull, department, inputedempid, allowcode,problemflag,reviewcode,reviews) VALUES ('', '', '".$ic."', '".$indte."', '".$intme."','I','".$sn1."','".$sdrtn1."','".$edrtn1."','','','','','','','')");

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
           		$qqqq = odbc_result($dtn,4);
			}

        		$_SESSION['lgid']= $lgid;
		
        		$res = 'Item Duration has expired.';
		
        		$from = "$fr";
				$subj = "Asset Security Verification and Monitoring System";
				$msg ="{".$res."}{}{Log ID : ".$lgid."}{Associate name: ".$usn."}{Employee ID: ".$qqqq." }{Item Code: ".$_POST['txt1']."}{Model: ".$mod."}{Description: ".$desc." }"; 
				$to = "$to";
				
				$arg = $from . " " . $to . " " . '"'.$subj.'"' . " " . '"'.$msg.'"';
				
				exec($path."\Pass2EmailMultiline.exe $arg");
				odbc_close($hris);
	
				header ('location:denyinallow.php');
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="img/favicon.ico"/>
</head>
<title>IN - Asset Verification and Monitoring System</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<style>
	
.blink
{	
	background-color: ;
	text-align: center;
	height:123px;
	color:	red;
	font-family:Californian FB;
	font-size:80px;
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
	
<body style='background-image: url("img/nwin.png");background-repeat:no-repeat;background-color:' onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">

<div style="margin-top:18px;margin-left:2px;"><br><br>
<!--&nbsp;&nbsp;&nbsp;<label style='font-family: Courier New; font-size: 17px;color:black'><?php //echo '<b> NAME : </b> '.$sn1;?></b></label><br>
&nbsp;&nbsp;&nbsp;<label style='font-family: Courier New; font-size: 17px;color:white'> <b> DEPT : </b>Security Guard  </label>-->
</div>
<div class="clock" style="margin-top:2px">
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
			
<font style="font-family:Courier New;font-size:20px;color:black;margin-left:10px;"><b> ITEM CODE &nbsp;&nbsp;&nbsp;&nbsp;: </b></font>
<input type="text" name="txtc" autocomplete="off" value="<?php echo $ic ?>"  readonly placeholder="N/A" style="width:400px; text-align:center;color:black;border-color:skyblue;border-radius:5px;height:25px;margin-top:50px;font-family:Courier New;font-size:18px;"> <br>
<font style="font-family:Courier New;font-size:20px;color:black;margin-left:10px;"><b> SERIAL NUMBER : </b></font>
<input type="text" name="txtc" autocomplete="off" value="<?php echo $sn ?>"  readonly placeholder="N/A" style="width:400px; text-align:center;color:black;border-color:skyblue;border-radius:5px;height:25px;margin-top:10px;font-family:Courier New;font-size:18px;"> <br>
<font style="font-family:Courier New;font-size:20px;color:black;margin-left:10px;"><b> MODEL/DESC &nbsp;&nbsp;&nbsp;: </b></font>
<input type="text" name="txtc" autocomplete="off" value="<?php echo $mod.'/'.$desc ?>"  readonly placeholder="N/A" style="width:400px; text-align:center;color:black;border-color:skyblue;border-radius:5px;height:25px;margin-top:10px;font-family:Courier New;font-size:18px;"> <br>

<div style='border-style: solid; border-color:red; width: 1321px; height: 280px;margin-top:10px'><br>
     <div class="blink">
     	<span> <b>( ✘ ) This Item Was Not Registered <br>Upon Exit !</b><br></span>
     </div>
</div>
	 
<div style='border-style: ; border-color:; width: 340px; height: 65px;margin-top:-35px;margin-left:980px'>
	<input type="submit" name="btn1" value="Continue" style="background-color: red; width:150px; color: white; font-family: courier new; font-size: 24px; font-weight:bold; height:49px;text-align:center;margin-left:180px;margin-top:40px;border-radius:5px">
</div>
</form>

<?php
include_once('includes/footer.php');
?>
</body>
</html>
<?php
}
?>