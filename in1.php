<?php
include_once ('includes/db_connect.php');
session_start();
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
$sdrtn1 = $_SESSION['sdate'];
$edrtn1 = $_SESSION['edate'];
$typ1 = $_SESSION['typ'];


 $emp = 0;
 if ($enum<1000)
 {
	 $emp = '0'.$enum;
 }
 elseif ($enum<100)
 {
	 $emp = '00'.$enum;
 }
 else 
 {
	 $emp = $enum;
 }
$image = 'https://hpihris.hondaph.com/MediaFiles/EmployeeId/'.$emp.'.jpg';
$imageData = base64_encode(file_get_contents($image));

date_default_timezone_set('Asia/Manila');
    $dt = date('Y-m-d');
    $cono = date('y');
    $d  = date('M. d,Y/D');
    $h  = date('H:i:s');
    $po = date('mdy-His');

if ($log1== '')
{
	echo"<script> alert ('(  ✘ ) User is not Login') </script>";
          $_SESSION['log'] = ''; 
  include_once 'conn/mainpage.php';
}
elseif($log1=='Yes' && $typ1 !='Security Guard IN') 
{
	echo"<script> alert ('(  ✘ ) User is not login') </script>";
          $_SESSION['log'] = ''; 
  include_once 'conn/mainpage.php';
}
else 
{			
	if (isset($_POST['btn1'])) //yes
	{
		$reason = $prob = '';
		if($allc=='P')
		{
			$reason='Item is Permanent';
		}
		elseif($allc=='T')
		{
			$reason='Item is Temporary';
		}

		odbc_exec($hris, "UPDATE [misInv].[dbo].[Itemmaster] set InOutFlag = 'I' where ItemCode = '".$ic."'");
		odbc_exec($hris, "INSERT INTO [dbo].[HistoryLog] (empnum, associatename, itemcode, indate, intime, status, securityguard, durationstart, durationend, empnumberfull, department, inputedempid, allowcode,problemflag,reviewcode,reviews) VALUES ('".$enum."', '".$usn."', '".$ic."', '".$dt."', '".$h."','I','".$sn1."','".$sdrtn1."','".$edrtn1."','".$qqqq."','".$qqq."','','".$allc."','O','','".$reason."')");

		header ('location:allowin.php');
	}

	if (isset($_POST['btn2'])) //no
	{
		$indte = $dt;
		$intme = $h;
		
		$_SESSION['indte']= $indte;
		$_SESSION['intme']= $intme;
		
		include_once ('includes/db_connect.php'); 
		odbc_exec($hris, "INSERT INTO [dbo].[HistoryLog] (empnum, associatename, itemcode, indate, intime, status, securityguard, durationstart, durationend, empnumberfull, department, inputedempid, allowcode,problemflag,reviewcode,reviews) VALUES ('', '', '".$ic."', '".$indte."', '".$intme."','I','".$sn1."','".$sdrtn1."','".$edrtn1."','','','','".$allc."','','','')");

		$log = odbc_exec($hris, "SELECT LogID from [dbo].[HistoryLog] where indate='".$indte."' and intime='".$intme."'");
		while ($row = odbc_fetch_array($log))
        {
        	$lgid = odbc_result($log,1);

        	$_SESSION['lgid']= $lgid;
        }
        
		header ('location:in2.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="img/favicon.ico"/>
</head>
<title>IN - Asset Verification and Monitoring System</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script>



	<style>
	

.blink{	
		margin-top:-15px;
	   background-color: ;
		text-align: center;
		height:123px;
		color:	green;
		font-family:Californian FB;
		font-size:120px;
		padding-top:px;
}
span{
		animation: blink 1s linear infinite;
	}
	
 @keyframes blink{
0%{opacity: 0;}
50%{opacity: .8;}
100%{opacity: 1;}
}
</style>
	
<body style='background-image: url("img/nwin.png"); background-repeat:no-repeat;background-color:'onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">

<div style="margin-top:18px;margin-left:2px;"><br><br>
<!--&nbsp;&nbsp;&nbsp;<label style='font-family: Courier New; font-size: 17px;color:black'><?php //echo '<b> NAME : </b> '.$sn1;?></b></label><br>
&nbsp;&nbsp;&nbsp;<label style='font-family: Courier New; font-size: 17px;color:white'> <b> DEPT : </b>Security Guard  </label>-->
</div>
<div class="clock" style=" margin-top:2px;">
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

				<div style='border-style:  ; width: 980px; height: 120px;margin-top:40px'>
				<font style="font-family:Courier New;font-size:18px;color:black;margin-left:10px;"><b> ITEM CODE &nbsp;&nbsp;&nbsp;&nbsp;: </b></font>
				<input type="text" name="txtc" autocomplete="off" value="<?php echo $ic ?>"  readonly placeholder="N/A" style="width:400px; text-align:center;color:black;border-color:skyblue;border-radius:5px;margin-left: 20px; height:25px;margin-top:10px;font-family:Courier New;font-size:18px;"> <br>
				
				<font style='font-family:Courier New;color:black;margin-left:10px;font-size:18px;'><b> MODEL/DESC &nbsp;&nbsp;&nbsp;: </b></font>
				<input type="text" name="txt5" readonly placeholder="N/A" value="<?php echo $mod.'/'.$desc ?>"  autocomplete="off"  style="width:400px;text-align:center;color:black;border-color:skyblue;border-radius:5px;height:25px;margin-left: 20px; margin-top:5px;font-family:Courier New;font-size:18px;"> <br>
				
				<font style='font-family:Courier New;color:black;margin-left:10px;font-size:18px;'><b> SERIAL NO &nbsp;&nbsp;&nbsp;&nbsp;: </b></font> 
				<input type="text" name="txt4" readonly placeholder="N/A" value="<?php echo $sn ?>"  autocomplete="off" style="width:400px; text-align:center;color:black;border-color:skyblue; margin-left: 20px; border-radius:5px;height:25px;font-family:Courier New;font-size:18px;margin-top:5px">
          </div>
		  
		     <div style='border-style: ; width: 341px; margin-top: -122px; height: 120px; margin-left: 980px;background-image:url("img/Picture10.png");background-repeat:no-repeat'>
			 </div>
		  
		   <div style='border-style: double;width:1350px;'></div>
		   
          <div style='border-style:; width: 600px; height: 200px;margin-top: px; '>
			<div class="a" style="height:200px;border:; border-radius:5px;width:350px;margin-left:150px;margin-top:5px">
			<?php echo"<img src='data:image/jpeg;base64,".$imageData."' style='height:200px; width:200px;margin-left:100px;border:solid;border-radius:10px'>" ?>
			</div>
          </div>
		  
          <div style='border-style: ; width: 675px; margin-top: -195px; height: 200px; margin-left: 645px'>
			<font style='font-family:Courier New; font-size:20px;color:black;margin-left:35px;'><b> EMPLOYEE ID&nbsp;&nbsp;&nbsp;:</b></font><input type="text" name="txt2" readonly placeholder="N/A"  value="<?php echo $enum ?>" style="width:400px; text-align:center;color:black;border-color:skyblue;border-radius:5px;height:20px;margin-top:5px;font-family:Courier New;font-size:18px;"><br>
			
			<font style='font-family:Courier New;font-size:20px;color:black;margin-left:35px;'><b> EMPLOYEE NAME :</b></font><input type="text" name="txt3" readonly placeholder="N/A"   value="<?php echo $usn ?>" style="width:400px; text-align:center;color:black;border-color:skyblue;border-radius:5px;height:20px;margin-top:10px;font-family:Courier New;font-size:18px;"><br>
			
			<font style='font-family:Courier New;font-size:20px;color:black;margin-left:35px;'><b> DEPARTMENT&nbsp;&nbsp;&nbsp;&nbsp;:</b></font><input type="text" name="txt8" readonly placeholder="N/A"  value="<?php echo $qqq ?>" style="width:400px; text-align:center;color:black;border-color:skyblue;border-radius:5px;height:20px;margin-top:10px;font-family:Courier New;font-size:18px;"><br>
			
			<font style='font-family:Courier New;font-size:20px;color:black;margin-left:35px;'><b> POSITION &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b></font><input type="text" name="txt9" readonly placeholder="N/A" value="<?php echo $qq ?>" style="width:400px;text-align:center;color:black;border-color:skyblue;font-size:14px;border-radius:5px;height:20px;margin-top:10px;font-family:Courier New;font-size:16px;"><br>
		
		<font style='font-family:Courier New;font-size:20px;color:black;margin-left:147px;'>&nbsp;&nbsp;
			<font style='font-family:Courier New;font-size:20px;color:black;margin-left:35px;'><b>Start Date:</b><font style="font-family:Courier New;font-size:20px;color:black;margin-left:80px;"><b>End Date:</b></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br>
			<font style='font-family:Courier New;font-size:20px;color:black;margin-left:33px;'><b>DURATION &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b><input type="text" readonly name="txt11" placeholder="N/A"  value="<?php echo $sdrtn1 ?>"   style="width:200px; text-align:center;color:black;border-color:skyblue;border-radius:5px;height:20px;margin-top:5px;font-family:Courier New; font-size:18px;"><input type="text" readonly name="txt11" placeholder="N/A"  value="<?php echo $edrtn1 ?>"   style="width:200px; text-align:center;color:black;border-color:skyblue;border-radius:5px;height:20px;margin-top:5px;font-family:Courier New;font-size:18px;">
          </div>
		   
		       <div style='border-style: double;margin-top:-20px;width:1350px;'></div>

		  <div style='border-style: solid; border-color: red; width: 750px; height: 100px; margin-top: 15px; text-align: center;'>
          <font style='font-family:Californian FB;font-size:80px;color:red'><b>SAME AS OWNER ?</b></font>

		  
		  <div style='border-style: ; border-color: ; width: 319px; height: 140px; margin-top: -124px;margin-left:999px'>
	   <input type="submit" name="btn1" value="" style="background-image:url('img/Picture14.png');width:135px;height:49px;text-align:right;margin-left:10px;margin-top:40px;border-radius:10px">
	   <input type="submit" name="btn2" value="" style="background-image:url('img/Picture15.png');width:135px;height:49px;text-align:right;margin-left:20px;border-radius:10px">
            </div>
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