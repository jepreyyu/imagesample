<?php
include_once ('includes/db_connect.php');
session_start();

$id1='';
?>
<?php
 
$sn1 = $_SESSION['asn'];
$log1 = $_SESSION['log'];
$ic = $_SESSION['itmcde'];
$sn = $_SESSION['snum'];
$mod = $_SESSION['mdl']; 
$enum= $_SESSION['empnum'];
$usn = $_SESSION['usern'];
$qqq  = $_SESSION['deptn'];
$qqqq =	 $_SESSION['id'];
$typ1 = $_SESSION['typ'];
$desc = $_SESSION['dcp'];
$sdrtn1 = '9999-12-31';
$edrtn1 = '9999-12-31'; 
$emp = '';

$fr = $_SESSION['fr'];
$to = $_SESSION['to'];
$lgid = $_SESSION['lgid'];
$mes = $_SESSION['mes'];

date_default_timezone_set('Asia/Manila');
    $dt = date('Y-m-d');
    $cono = date('y');
    $d  = date('M. d,Y/D');
    $h  = date('H:i:s');
    $po = date('mdy-His');
	?>
	
	<?php
if ($log1== ''){
	echo"<script> alert ('(  ✘ ) User is not Login') </script>";
          $_SESSION['log'] = ''; 
  include_once 'conn/mainpage.php';
}
elseif($log1=='Yes' && $typ1 !='Security Guard OUT') 
{
	echo"<script> alert ('(  ✘ ) User is not login') </script>";
          $_SESSION['log'] = ''; 
  include_once 'conn/mainpage.php';
}
else 
{	
	

	if (isset($_POST['deny']))
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
				odbc_exec($hris, "UPDATE [dbo].[HistoryLog] set inputedempid='".$_POST['txtid']."' where logid='".$lgid."'");
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
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script>


	<style>
	
h5{
	font-family:Californian FB;
	font-size:18px;
	color:black;
}

.blink{	
	margin-top: 50px;
	   background-color: ;
		text-align: center;
		height:123px;
		color:	red;
		font-family:Californian FB;
		font-size:90px;
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
	
<form action="" method="post">

				<font style="font-family:Courier New;font-size:20px;color:black;margin-left:10px;"><b> ITEM CODE &nbsp;&nbsp;&nbsp;&nbsp;: </b></font><input type="text" name="txtc" autocomplete="off" value="<?php echo $ic ?>"  readonly placeholder="N/A" style="width:400px; text-align:center;color:black;border-color:skyblue;border-radius:5px;height:25px;margin-top:65px;font-family:Courier New;font-size:18px;"> <br>
				<font style="font-family:Courier New;font-size:20px;color:black;margin-left:10px;"><b> SERIAL NUMBER : </b></font><input type="text" name="txtc" autocomplete="off" value="<?php echo $sn ?>"  readonly placeholder="N/A" style="width:400px; text-align:center;color:black;border-color:skyblue;border-radius:5px;height:25px;margin-top:10px;font-family:Courier New;font-size:18px;"> <br>
				<font style="font-family:Courier New;font-size:20px;color:black;margin-left:10px;"><b> MODEL/DESC &nbsp;&nbsp;&nbsp;: </b></font><input type="text" name="txtc" autocomplete="off" value="<?php echo $mod.'/'.$desc ?>"  readonly placeholder="N/A" style="width:400px; text-align:center;color:black;border-color:skyblue;border-radius:5px;height:25px;margin-top:10px;font-family:Courier New;font-size:18px;"> <br>
				
          <div style='border-style: solid; border-color:red; width: 1321px; height: 190px;margin-top:10px'>
           <div class="blink"><span> <b> <?php echo $mes; ?> </b> </span>
          </div>
     </div>
	 
	  
	 <div style='border-style: ; border-color: black; width: 1100px; height: 60px; '>
          
		  
		  <font style='font-family:Courier New;font-size:24px;color:red;margin-left: 280px;'><b>EMPLOYEE ID NO:</b></font> 
	   		<input type="text" name="txtid" id='txt' onkeydown='return (event.keyCode!=13)' value="<?php if(isset($_POST['loadpic']) || isset($_POST['deny'])) echo $_POST['txtid'];?>" maxlength="10" autocomplete="off" autofocus onkeydown="return (event.keycode !=13)" style="width:240px;height:25px;text-align:center;border-radius:5px; margin-top:25px; font-family:Courier New; font-size:18px; border-color:red; ">
     </div>
     <div style='border: ; margin-top: -15px; height: 50px; width: 200px; margin-top: 5px; margin-left: 535px;'>
     <input type="submit" name="deny" id='den' value="DENY PASS" style="visibility: hidden; font-weight: bold;background-color: red; color: white; width:188px; height:45px; text-align:center; border-radius:5px; font-size: 24px; font-family:Courier New;"> 
		  </div>
		   <div style='border: ; margin-top: -15px; height: 50px; width: 200px; margin-top: -50px; margin-left: 535px;'>
     <input type="submit" name="loadpic" ID='lo'  value="OK" style="background-color: red; width:188px; font-weight: bold; color:white; font-family: Courier new;  height:45px; text-align:center; border-radius:5px; font-size: 24px; ">
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
				<div class="a" style="height:120px;border: solid; border-radius:5px;width:120px;margin-left:780px;margin-top:-110px;">
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
				<div style='border: ; margin-left: 930px; margin-top: -120px;'>
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
</body>
<?php
include_once('includes/footer.php');
if (isset($_POST['deny']))
	{
		$id = $_POST['txtid'];
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
				while ($row = odbc_fetch_array($dtn))
				{

				}
			}
			else
			{
				echo "<script> alert ('( ! ) Employee ID Not Found !') </script>";
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
</html>
<?php

}
?>