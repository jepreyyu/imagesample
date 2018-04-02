<?php
include_once ('includes/db_connect.php');
session_start();

$id1='';
?>
<?php

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

$fr = $_SESSION['fr'];
$to = $_SESSION['to'];
$lgid = $_SESSION['lgid'];

$path = $_SESSION['path'];

 $emp = 0;
 if ($enum <1000)
 {
	 $emp = '0'.$enum;
 }
 elseif ($enum <100)
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
	?>
	
	<?php
if ($log1== ''){
	echo"<script> alert ('( ✘ ) User is not Login') </script>";
          $_SESSION['log'] = ''; 
  include_once 'conn/mainpage.php';
}
elseif($log1=='Yes' && $typ1 !='Security Guard OUT') 
{
	echo"<script> alert ('( ✘ ) User is not login') </script>";
          $_SESSION['log'] = ''; 
  include_once 'conn/mainpage.php';
}
else 
{	
	if (isset($_POST['back']))
	{
		$id = $_POST['txtid'];
		if(empty($_POST['txtid']))
     	{
     		//echo "<script> alert ('( ! ) PLEASE ENTER A VALID EMPLOYEE ID.') </script>";
     	}
		else 
		{
  			include_once 'includes/connect_2.php';
			$dtn = odbc_exec($hris2, "SELECT Employee_ID FROM [HuManEDGECLIENT].[dbo].[VIEW_HRIS_EmploymentInfo] where Employee_ID = '".$_POST['txtid']."'");

			if(odbc_num_rows($dtn) > 0)
          	{
				odbc_exec($hris, "UPDATE [dbo].[HistoryLog] set inputedempid='".$_POST['txtid']."', problemflag='1', reviewcode='NSO', reviews='Not same as owner' where logid='".$lgid."'");

        		$res = 'Not same as owner.';
		
        		$from = "$fr";
				$subj = "Asset Security Verification and Monitoring System";
				$msg ="{".$res."}{Inputted ID : ".$_POST['txtid']."}{}{Log ID : ".$lgid."}{Associate name: ".$usn."}{Employee ID: ".$qqqq." }{Item Code: ".$_POST['txtid']."}{Model: ".$mod."}{Description: ".$desc." }"; 
				$to = "$to";
				
				$arg = $from . " " . $to . " " . '"'.$subj.'"' . " " . '"'.$msg.'"';
				
				exec($path."\Pass2EmailMultiline.exe $arg");
				odbc_close($hris);

				header ('location:frontout.php');
			}
			else
			{

			}
		}
	}

?>
		 

<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="img/favicon.ico"/>
</head>
<title>OUT - Asset Verification and Monitoring System</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<style>
h5{
	font-family:Californian FB;
	font-size:18px;
	color:black;
}

.blink{	
		margin-top:20px;
	   background-color: ;
		text-align: center;
		height:123px;
		color:	red;
		font-family:Californian FB;
		font-size:120px;
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
	
<body style="background-image: url('img/nwout.png'); background-repeat:no-repeat;background-color:">

<div style="margin-left:2px;">
&nbsp;&nbsp;&nbsp;<label style='font-family: Courier New; font-size: 17px;color:white'><b><?php echo ' NAME :  '.$sn1;?></b></label><br><br>
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
		  
		   <div style='border-style: double;width:1354px;margin-left:-5px'></div>
		   
          <div style='border-style:; width: 600px; height: 200px;margin-top: px; '>
			<div class="a" style="height:180px;border:; border-radius:5px;width:350px;margin-left:150px;margin-top:5px">
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
		   
		       <div style='border-style: double;width:1354px;margin-left:-5px;margin-top:-20px'></div>
			   
 
		  <div style='border-style: solid; border-color: red; width: 640px; height: 145px; margin-top: 2px; text-align: center; '>
          <SPAN><font style='font-family:Californian FB;font-size:70px;color:red'><b>( ✘ ) Not Allowed !</b></font><br></SPAN>
		  </div>
		  
		  <div style='border-style: ; border-color: ; width: 500px; height: 145px; margin-top: -150px;margin-left:645px'>
	   		<input type="text" name="txtid" id='txt' autocomplete='off' onkeydown='return (event.keyCode!=13)' value="<?php if(isset($_POST['loadpic']) || isset($_POST['back'])) echo $_POST['txtid'];?>" placeholder="Input Employee ID" style="font-size: 18px; font-family: Courier new; width:220px; height:30px; text-align:center; border-color: red; margin-left:10px; margin-top:15px; border-radius:5px;"><br>
	   		<input type="submit" name="loadpic" id='lo' value="OK" style="background-color: red; font-size: 25px; font-family: Courier new; color: white; font-weight: bold; width:225px; height:40px; text-align:center; margin-left:10px; margin-top:5px; border-radius:5px;"> <br>
	   		<input type="submit" name="back" id='den' value="Deny Pass" style="background-color: red; font-size: 25px; font-family: Courier new; color: white; font-weight: bold; width:225px; height:40px; visibility: hidden; text-align:center; margin-left:10px; margin-top:-100px; border-radius:5px;"><!--YES-->
            </div>
            <?php
	if (isset($_POST['loadpic']))
	{
		if(empty($_POST['txtid']))
     	{
     		//echo "<script> alert ('( ! ) PLEASE ENTER A VALID EMPLOYEE ID.') </script>";
     	}
		else 
		{
			include_once 'includes/connect_2.php';
			$dtn = odbc_exec($hris2, "SELECT Employee_ID FROM [HuManEDGECLIENT].[dbo].[VIEW_HRIS_EmploymentInfo] where Employee_ID = '".$_POST['txtid']."'");

			if(odbc_num_rows($dtn) > 0)
          	{
				$emp = substr($_POST['txtid'],6);
				$image = 'https://hpihris.hondaph.com/MediaFiles/EmployeeId/'.$emp.'.jpg';
				$imageData = base64_encode(file_get_contents($image));
				?>
				<div class="a" style="height:120px;border: solid; border-radius:5px;width:120px;margin-left:900px;margin-top:-130px;">
				<?php 	
						echo"<img src='data:image/jpeg;base64,".$imageData."' style='height:120px; width:120px;border:;border-radius:5px'>" ;
     					echo "<script> document.getElementById('den').style.visibility = 'visible';</script>";
     					echo "<script> document.getElementById('lo').style.visibility = 'hidden';</script>";
     					echo "<script> document.getElementById('txt').readOnly = 'true';</script>";
     			?>
				</div>
			<?php
				$dpe = odbc_exec($hris2, "SELECT a.Employee_LastName, a.Employee_FirstName, a.Employee_MiddleName, b.DEPNME, b.POSTIONNAME FROM VIEW_HRIS_EmployeeName as a inner join VIEW_HRIS_EmploymentInfo as b on a.Employee_ID = b.Employee_ID where a.Employee_ID = '".$_POST['txtid']."'");
				if(odbc_num_rows($dpe) > 0)
                {
                    while ($row = odbc_fetch_array($dpe))
                    {
                    	$ln = odbc_result($dpe,1);
                        $fn = odbc_result($dpe,2);
                        $mna = odbc_result($dpe,3);
                        $mn = substr($mna, 0, 1).'.';
                        $dm = odbc_result($dpe,4);
                        $po = odbc_result($dpe,5);
                    }
                }
				?>
				<div style='border: ; margin-left: 1050px; margin-top: -140px;'>
					<font style='font-size: 18px; font-family: Courier New;' ><b>Name : </b><?php echo $ln.", ".$fn." ".$mn;?></font><br>
					<font style='font-size: 18px; font-family: Courier New;' ><b>Department : </b><?php echo $dm;?></font><br>
					<font style='font-size: 18px; font-family: Courier New;' ><b>Position : </b><?php echo $po;?></font>
				</div>
			<?php
			}
			else
			{

			}
		}
	}
?>
     </form>
<?php
include_once('includes/footer.php');
if (isset($_POST['back']))
	{
		$id = $_POST['txtid'];
		if(empty($_POST['txtid']))
     	{
     		echo "<script> alert ('( ✘ ) Please Provide an Employee ID !') </script>";
     	}
		else 
		{
  			include_once 'includes/connect_2.php';
			$dtn = odbc_exec($hris2, "SELECT Employee_ID FROM [HuManEDGECLIENT].[dbo].[VIEW_HRIS_EmploymentInfo] where Employee_ID = '".$_POST['txtid']."'");
			if(odbc_num_rows($res_anno) > 0)
          	{
				while ($row = odbc_fetch_array($dtn))
				{

				}
			}
			else
			{
				echo "<script> alert ('( ✘ ) Employee ID Not Found !') </script>";
			}
		}
		
	}

	if (isset($_POST['loadpic']))
	{
		if(empty($_POST['txtid']))
     	{
     		echo "<script> alert ('( ! ) Please Provide an Employee ID !') </script>";
     	}
		else 
		{
			include_once 'includes/connect_2.php';
			$dtn = odbc_exec($hris2, "SELECT Employee_ID FROM [HuManEDGECLIENT].[dbo].[VIEW_HRIS_EmploymentInfo] where Employee_ID = '".$_POST['txtid']."'");

			if(odbc_num_rows($dtn) > 0)
          	{
          	}
          	else
          	{
          		echo "<script> alert ('( ! ) Employee ID Not Found !') </script>";
          	}
		}
	}
	?>
</body>
</html>
<?php
}
?>