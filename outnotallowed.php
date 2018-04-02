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

$fr = $_SESSION['fr'];
$to = $_SESSION['to'];
$lgid = $_SESSION['lgid'];

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
		header('location:frontout.php');
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
		margin-top:50px;
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
	
<form action="" method="post">

				<font style="font-family:Courier New;font-size:20px;color:black;margin-left:10px;"><b> ITEM CODE &nbsp;&nbsp;&nbsp;&nbsp;: </b></font><input type="text" name="txtc" autocomplete="off" value="<?php echo $ic ?>"  readonly placeholder="N/A" style="width:400px; text-align:center;color:black;border-color:skyblue;border-radius:5px;height:25px;margin-top:65px;font-family:Courier New;font-size:18px;"> <br>
				<font style="font-family:Courier New;font-size:20px;color:black;margin-left:10px;"><b> SERIAL NUMBER : </b></font><input type="text" name="txtc" autocomplete="off" value="<?php echo $sn ?>"  readonly placeholder="N/A" style="width:400px; text-align:center;color:black;border-color:skyblue;border-radius:5px;height:25px;margin-top:10px;font-family:Courier New;font-size:18px;"> <br>
				<font style="font-family:Courier New;font-size:20px;color:black;margin-left:10px;"><b> MODEL/DESC &nbsp;&nbsp;&nbsp;: <b></font><input type="text" name="txtc" autocomplete="off" value="<?php echo $mod.'/'.$desc ?>"  readonly placeholder="N/A" style="width:400px; text-align:center;color:black;border-color:skyblue;border-radius:5px;height:25px;margin-top:10px;font-family:Courier New;font-size:18px;"> <br>

				
          <div style='border-style: solid; border-color:red; width: 1321px; height: 280px;margin-top:10px; padding-top:5px;'>
           <div class="blink"><span><b>( ✘ ) NOT ALLOWED !</b> </span>		  
          </div>
     </div><br>	  
	 
	 <div style="border-style: ; border-color:; width: 250px; height: 65px;margin-top:5px;margin-left:1100px">
	   <input type="submit" name="deny" value="Back" style="background-color: rgb(77, 136, 255); font-size: 32px; font-family: Courier new; color: white; font-weight: bold; width:188px; height:49px; text-align:center; border-radius:5px"> 
          </div>
		  
     </form>
</body>
</html>
<?php
}
?>