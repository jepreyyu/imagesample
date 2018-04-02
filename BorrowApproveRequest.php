<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="img/favicon.ico"/>
</head>
<title>Borrow Request Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php
     include_once 'conn/connect.php';
     session_start();
     $ul = $_SESSION['uid'];
     $name = $_SESSION['asn'];
     $dep = $_SESSION['dep'];
     $empid = $_SESSION['eid'];
     $log = $_SESSION['log'];
     $typ = $_SESSION['typ'];
     $cont = $_SESSION['cont'];

if($log=='')
{
  echo "<script>alert('( ✘ ) User is Not Login !');</script>";
          $_SESSION['log'] = ''; 
  include_once 'conn/mainpage.php';
}
elseif($log=='Yes' && $typ!='BorrowApprover')
{
     echo "<script>alert('User is not Login!');</script>";
          $_SESSION['log'] = ''; 
  include_once 'conn/mainpage.php';
}
else
{

    date_default_timezone_set('Asia/Manila');
    $dt = date('Y-m-d');
    $cono = date('y');
    $d  = date('M. d,Y/D');
    $h  = date('H:i:s');
    $po = date('mdy-His');

    $iaarf = "-IAARF";
    $itarf = "IT";

     $res = odbc_exec($hris, "select count(*)+1 from [dbo].[ITASSET_RequestForm_Sample1]");
          while ($row = odbc_fetch_array($res))
          {
               $count = odbc_result($res,1);
               $cn ="";
               if($count < 10)
               {
                    $cn = "000";
               }
               elseif($count > 9 && $count <100)
               {
                    $cn = "00";
               }
               elseif($count > 99 && $count <1000)
               {
                    $cn = "0";
               }
               else
               {
                    $cn = "";
               }
          }

     $info = odbc_exec($hris, "SELECT AssociateName, Departmentsection, Laptop, Mouse, Keyboard, Tablet, Monitor, Desktop, Scanner, MultimediaProjector, Printer, Reason, StartDate, EndDate, Employee_ID_Full, Status from [dbo].[ITASSET_RequestForm_Sample1] where ControlNumber='".$cont."' ");
          while ($row = odbc_fetch_array($info))
          {
               $anme = odbc_result($info,1);
               $dsec = odbc_result($info,2);
               $lapt = odbc_result($info,3);
               $mous = odbc_result($info,4);
               $keyb = odbc_result($info,5);
               $tabl = odbc_result($info,6);
               $moni = odbc_result($info,7);
               $desk = odbc_result($info,8);
               $scan = odbc_result($info,9);
               $mult = odbc_result($info,10);
               $prin = odbc_result($info,11);
               $rson = odbc_result($info,12);
               $stda = odbc_result($info,13);
               $enda = odbc_result($info,14);
               $emid = odbc_result($info,15);
               $stat = odbc_result($info,16);
          }

     $reason = $emperr = "";

     if(!empty($_POST['SubmitRequest']))
     {
          $error=false;

          if(empty($_POST['comment']))
          {
               $reason='!';
               $error=true;
          }
          else
          {
               $error=false;
          }if(empty($_POST['employid']))
          {
               $emperr="!";
               $error=true;
          }
          else
          {
               $error=false;
          }
     }

     if(!empty($_POST['Logout']))
     {
          header('location:ApproveCurrentRequest.php');
     }
?>

<style>

.ButtonHover:hover 
{
     text-decoration: underline;
     cursor: pointer;
     background-color: rgb(250,180,168);
}

.error 
{
     color: red;
}
/* The container */
.container {
    display: inline-block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
    background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}

/* The container */
.container1 {
    display: inline-block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default radio button */
.container1 input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom radio button */
.checkmark1 {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
    border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container1:hover input ~ .checkmark1 {
    background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container1 input:checked ~ .checkmark1 {
    background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark1:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the indicator (dot/circle) when checked */
.container1 input:checked ~ .checkmark1:after {
    display: block;
}

/* Style the indicator (dot/circle) */
.container1 .checkmark1:after {
  top: 9px;
  left: 9px;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: white;
}
</style>

<script type="text/javascript">
        window.history.forward();
        function noBack() {
            window.history.forward();
        }
</script>

<body style='background-image: url("img/new/bor3.png"); background-color: white; background-repeat: no-repeat;' onkeydown="return (event.keyCode != 116)" onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">
<form action='' method='post'>
      <div style=' margin-bottom: 10px; border-radius: 5px;margin-top: 5px;text-align: left; color: black; width: 500px; height: 50px; padding-top: 7px;'>
          <label style='font-size:20px; color: white; font-family: Courier New;'>&nbsp;<?php echo '<b>Name : </b>'.$name; ?></label><br>
          <label style='font-size:20px; color: white; font-family: Courier New;'>&nbsp;<?php echo '<b>Dept : </b>'.$dep; ?></label>
      </div>

     <div style='margin-left: -5px;background-color: rgba(224,220,223,0.7); background-repeat: all; border-radius: 5px; margin-top: 60px; height: 485px; border-style: solid; width: 1354px; border-color: skyblue;'>

          <div style='border-top: 3px;width:250px; height: 100px;'><br><br><br>
            <label style='margin-left: 25px;font-size: 20px; font-family: Courier New;'><b>Requested By</b>&nbsp;&nbsp;&nbsp;&rarr; </label><br><br>
          </div>

          <div style='margin-left: 255px;  margin-top: -98px; border-top: 3px; width:600px; height: 140px;'>
               <label style='background-color: rgba(224,220,223,0.4); margin-left: 10px; font-size: 20px; font-family: Courier New;'><b>Employee ID</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </label>
               <input type='text' id='empd' name='employid' readonly value='<?php echo $emid; ?>' style='margin-top: 20px;  background-color: rgba(224,220,223,0.1); border-style: none; font-family: Courier New; font-size: 18px; text-align: center; color: blue; height: 30px; width: 315px;'><br>
            <label style='background-color: rgba(224,220,223,0.4);margin-left: 10px; font-size: 20px; font-family: Courier New;'><b>Associate Name</b> &nbsp;&nbsp;&nbsp;&nbsp;:</label>&nbsp;&nbsp;
            <input type='text' name='AssociateName' id='assocname' readonly value='<?php echo $anme; ?>' style='margin-top: 10px;  background-color: rgba(224,220,223,0.1); border-style: none; font-family: Courier New; font-size: 18px; text-align: center; color: blue; height: 30px; width: 315px;'><br>
            <label style='background-color: rgba(224,220,223,0.4);margin-left: 10px; font-size: 20px; font-family: Courier New;'><b>Department/Section</b> : </label>
            <input type='text' name='DepartmentSection' id='depart' readonly value='<?php echo $dsec; ?>' style='margin-top: 10px; background-color: rgba(224,220,223,0.1); border-style: none; font-family: Courier New; color:blue; font-size: 18px; text-align: center; height: 30px; width: 315px;'>
          </div>

          <div style='margin-left: 860px; margin-top: -140px; border-style: none none none solid; width:480px; height: 150px; margin-bottom: 2px;'>
               <label style='margin-left: 20px; font-size: 20px; font-family: Courier New;'><b>Request Number</b> : </label>&nbsp;&nbsp;
               <input type='text' id='control' readonly autocomplete="off" name='ControlNumber' value='<?php echo $cont; ?>' 
               style='background-color: rgba(224,220,223,0.1); color: blue;border-color: none; border-style: none;margin-top: 40px; font-family: Courier New; font-size: 18px; height: 30px; width: 230px;'>
            <br>
            <label style='margin-left: 20px; font-size: 20px; font-family: Courier New;'><b>Date</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</label>
            <input type='text' name='mmddyy' readonly value='<?php echo $d;?>' placeholder='MM-DD-YY' style='background-color: rgba(224,220,223,0.1); color: blue;margin-top: 10px; border-color: none; border-style: none;margin-left: 8px;font-family: Courier New; font-size: 18px; height: 30px; width: 230px;'>
          </div>

          <div style='border-style: double;'></div>

          <div style='width: 800px; height: 190px;'><BR>
            <label style='margin-left: 25px; font-size: 20px; font-family: Courier New;'><b>Type Item Code</b> : </label>&nbsp;&nbsp;
               <br>

                  <label class="container1" style='margin-left: 25px; font-size: 18px; font-family: Courier New;'>Laptop 
               <input type="radio" id='lap' name="item" value="laptop" onclick='dis()' style='margin-left: 105px; margin-top: 25px;' <?php if (isset($item) && $item=="laptop") echo "checked"; elseif(isset($_POST['SubmitRequest']) && empty($_POST['item'])) echo "unchecked"; elseif(isset($_POST['SubmitRequest']) && $_POST['item']=="laptop") echo "checked"; ?> ><span class="checkmark1"></span></label>
               <input type='text' name='lap' id='lapno' autocomplete='off' value='<?php if(isset($_POST['SubmitRequest'])) echo $_POST['lap']; ?>' style='height: 20px; width: 90px; margin-left: 16px; border-radius: 5px; margin-top:5px;text-align:center; font-size: 16px; font-family: Courier New; border: solid; border-color: white; '>

                  <label class="container1" style='margin-left: 25px; font-size: 18px; font-family: Courier New;'>Mouse 
               <input type="radio" id='mou' name="item" value="mouse" onclick='dis()' style='margin-left: 105px; margin-top: 25px;' <?php if (isset($item) && $item=="mouse") echo "checked"; elseif(isset($_POST['SubmitRequest']) && empty($_POST['item'])) echo "unchecked"; elseif(isset($_POST['SubmitRequest']) && $_POST['item']=="mouse") echo "checked"; ?> ><span class="checkmark1"></span></label>
               <input type='text' name='mou' id='mouno' autocomplete='off' value='<?php if(isset($_POST['SubmitRequest'])) echo $_POST['mou']; ?>' style='height: 20px; width: 90px; margin-left: 27px; border-radius: 5px; margin-top:5px;text-align:center; font-size: 16px; font-family: Courier New; border: solid; border-color: white; '>

                  <label class="container1" style='margin-left: 30px; font-size: 18px; font-family: Courier New;'>Keyboard 
               <input type="radio" id='key' name="item" value="keyboard" onclick='dis()' style='margin-left: 105px; margin-top: 25px;' <?php if (isset($item) && $item=="keyboard") echo "checked"; elseif(isset($_POST['SubmitRequest']) && empty($_POST['item'])) echo "unchecked"; elseif(isset($_POST['SubmitRequest']) && $_POST['item']=="keyboard") echo "checked"; ?> ><span class="checkmark1"></span></label>
               <input type='text' name='key' id='keyno' autocomplete='off' value='<?php if(isset($_POST['SubmitRequest'])) echo $_POST['key']; ?>' style='height: 20px; width: 90px; margin-left: 22px; border-radius: 5px; margin-top:5px;text-align:center; font-size: 16px; font-family: Courier New; border: solid; border-color: white; '><br>

                  <label class="container1" style='margin-left: 25px; font-size: 18px; font-family: Courier New;'>Tablet 
               <input type="radio" id='tab' name="item" value="tablet" onclick='dis()' style='margin-left: 105px; margin-top: 25px;' <?php if (isset($item) && $item=="tablet") echo "checked"; elseif(isset($_POST['SubmitRequest']) && empty($_POST['item'])) echo "unchecked"; elseif(isset($_POST['SubmitRequest']) && $_POST['item']=="tablet") echo "checked"; ?> ><span class="checkmark1"></span></label>
               <input type='text' name='tab' id='tabno' autocomplete='off' value='<?php if(isset($_POST['SubmitRequest'])) echo $_POST['tab']; ?>' style='height: 20px; width: 90px; margin-left: 16px; border-radius: 5px; margin-top:5px;text-align:center; font-size: 16px; font-family: Courier New; border: solid; border-color: white; '>

                  <label class="container1" style='margin-left: 25px; font-size: 18px; font-family: Courier New;'>Monitor 
               <input type="radio" id='mon' name="item" value="monitor" onclick='dis()' style='margin-left: 105px; margin-top: 25px;' <?php if (isset($item) && $item=="monitor") echo "checked"; elseif(isset($_POST['SubmitRequest']) && empty($_POST['item'])) echo "unchecked"; elseif(isset($_POST['SubmitRequest']) && $_POST['item']=="monitor") echo "checked"; ?> ><span class="checkmark1"></span></label>
               <input type='text' name='mon' id='monno' autocomplete='off' value='<?php if(isset($_POST['SubmitRequest'])) echo $_POST['mon']; ?>' style='height: 20px; width: 90px; margin-left: 5px; border-radius: 5px; margin-top:5px;text-align:center; font-size: 16px; font-family: Courier New; border: solid; border-color: white; '>

                  <label class="container1" style='margin-left: 30px; font-size: 18px; font-family: Courier New;'>DeskPC 
               <input type="radio" id='dpc' name="item" value="deskpc" onclick='dis()' style='margin-left: 105px; margin-top: 25px;' <?php if (isset($item) && $item=="deskpc") echo "checked"; elseif(isset($_POST['SubmitRequest']) && empty($_POST['item'])) echo "unchecked"; elseif(isset($_POST['SubmitRequest']) && $_POST['item']=="deskpc") echo "checked"; ?> ><span class="checkmark1"></span></label>
               <input type='text' name='dpc' id='dpcno' autocomplete='off' value='<?php if(isset($_POST['SubmitRequest'])) echo $_POST['dpc']; ?>' style='height: 20px; width: 90px; margin-left: 44px; border-radius: 5px; margin-top:5px;text-align:center; font-size: 16px; font-family: Courier New; border: solid; border-color: white; '><br>

                  <label class="container1" style='margin-left: 25px; font-size: 18px; font-family: Courier New;'>Scanner 
               <input type="radio" id='sca' name="item" value="scanner" onclick='dis()' style='margin-left: 105px; margin-top: 25px;' <?php if (isset($item) && $item=="scanner") echo "checked"; elseif(isset($_POST['SubmitRequest']) && empty($_POST['item'])) echo "unchecked"; elseif(isset($_POST['SubmitRequest']) && $_POST['item']=="scanner") echo "checked"; ?> ><span class="checkmark1"></span></label>
               <input type='text' name='sca' id='scano' autocomplete='off' value='<?php if(isset($_POST['SubmitRequest'])) echo $_POST['sca']; ?>' style='height: 20px; width: 90px; margin-left: 5px; border-radius: 5px; margin-top:5px;text-align:center; font-size: 16px; font-family: Courier New; border: solid; border-color: white; '>

                  <label class="container1" style='margin-left: 25px; font-size: 18px; font-family: Courier New;'>Printer 
               <input type="radio" id='prn' name="item" value="printer" onclick='dis()' style='margin-left: 105px; margin-top: 25px;' <?php if (isset($item) && $item=="printer") echo "checked"; elseif(isset($_POST['SubmitRequest']) && empty($_POST['item'])) echo "unchecked"; elseif(isset($_POST['SubmitRequest']) && $_POST['item']=="printer") echo "checked"; ?> ><span class="checkmark1"></span></label>
               <input type='text' name='prn' id='prnno' autocomplete='off' value='<?php if(isset($_POST['SubmitRequest'])) echo $_POST['prn']; ?>' style='height: 20px; width: 90px; margin-left: 5px; border-radius: 5px; margin-top:5px;text-align:center; font-size: 16px; font-family: Courier New; border: solid; border-color: white; '>

                  <label class="container1" style='margin-left: 25px; font-size: 18px; font-family: Courier New;'>Multimedia 
               <input type="radio" id='mme' name="item" value="multimedia" onclick='dis()' style='margin-left: 105px; margin-top: 25px;' <?php if (isset($item) && $item=="multimedia") echo "checked"; elseif(isset($_POST['SubmitRequest']) && empty($_POST['item'])) echo "unchecked"; elseif(isset($_POST['SubmitRequest']) && $_POST['item']=="multimedia") echo "checked"; ?> ><span class="checkmark1"></span></label>
               <input type='text' name='mme' id='mmeno' autocomplete='off' value='<?php if(isset($_POST['SubmitRequest'])) echo $_POST['mme']; ?>' style='height: 20px; width: 90px; margin-left: 5px; border-radius: 5px; margin-top:5px;text-align:center; font-size: 16px; font-family: Courier New; border: solid; border-color: white; '>
               <br>
          </div>

          <div style='width: 500px; height: 110px;border-style: none none none solid; margin-left: 803px; margin-top: -150px;'>
               
               <label style='margin-left: 25px; font-size: 18px; font-family: Courier New;'><b> Allow Code</b> &nbsp;: </label>&nbsp;&nbsp;<br><BR><br>
               <label class="container1" style='margin-left: 130px; font-size: 18px; font-family: Courier New;'>Permanent <input type="radio" id='perm' name="Duration" disabled=true value="P" style='margin-left: 105px; margin-top: 50px;' >
  <span class="checkmark1"></span></label>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <label class="container1" style='margin-left: 30px; font-size: 18px; font-family: Courier New;'>Temporary <input type='radio' id='temp' name='Duration' value='T' onclick='ena()' <?php echo "checked"; ?> >
  <span class="checkmark1"></span></label>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </div><BR>

          <div style='border-style: double;'></div>

          <div style=' height: 160px; width: 560px; '><br>
            <font style='margin-left: 25px; font-size: 20px; font-family: Courier New;'><b>Reason for Request</b> :</font><br>
               <textarea id='comm' readonly style='margin-left: 25px;margin-top: 10px;border-radius: 5px; resize: none; border-color: rgba(224,220,223,0.9); border-style: solid; border-style: solid; font-size: 15px;' name="comment" rows="4" cols="55" ><?php echo $rson;?></textarea>
               <span class='error' style='font-size: 18px;'><?php echo $reason; ?></span>
               
          </div>

          <div style='width: 500px; margin-top: -125px; height: 110px; margin-left: 560px'>
               <label style='margin-left: 25px; font-size: 20px; font-family: Courier New;'><b>Start Date</b> &nbsp;&nbsp;&nbsp;: &nbsp;</label>&nbsp;
               <input type="text" autocomplete="off" id='startdate1' disabled=true style='text-align: center; margin-top: 1px; font-family: Courier New; font-size: 18px; border-color: white; border-style: solid;height: 28px; width: 210px; border-radius: 5px; background-color: white;' name="StartDate" value="<?php echo $stda; ?>" />
               <br>
               <label style='margin-left: 25px; font-size: 20px; font-family: Courier New;'><b>End Date</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;</label>&nbsp;
               <input type="text" autocomplete="off" id='enddate1' disabled=true style='border-color: white; border-radius: 5px; border-style: solid;text-align: center; margin-top: 15px; font-family: Courier New; font-size: 18px; height: 28px; width: 210px; background-color: white;' name="EndDate" value="<?php echo $enda; ?>" /><br>
          </div>

          <div style='height: 150px; width: 300px; margin-left: 1035px; margin-top: -153px; '>
                    <input type='Submit' name='SubmitRequest' id='submitbtn' title='Submit and Validate Your Request' value='.' style='border-radius: 5px; border-color: skyblue; text-align: right; cursor: pointer; margin-top: 25px;color: skyblue; background-image: url("img/new/app.png"); margin-left: 30px; font-family: Courier New; font-size: 22px; height: 52px; width: 262px;'><br>
                    <input type='Submit' name='Logout' id='back2' title='Go Back to the Front Page' value='.' style='border-radius: 5px; border-color: skyblue; text-align: right; margin-top: 10px; cursor: pointer; color: skyblue; background-image: url("img/new/bk1.png"); margin-left: 30px; font-family: Courier New; font-size: 22px; height: 54px; width: 262px;'>
               <br><br>
          </div>
     </div>
     </form>

<?php
$itemdata = '';

if(!empty($lapt))
{
     echo "<script> document.getElementById('lap').checked = true;</script>";
     echo "<script> document.getElementById('lapno').focus();</script>";
     $itemdata = 'Laptop';

     echo "<script> document.getElementById('mou').disabled = true;</script>";
     echo "<script> document.getElementById('key').disabled = true;</script>";
     echo "<script> document.getElementById('tab').disabled = true;</script>";
     echo "<script> document.getElementById('mon').disabled = true;</script>";
     echo "<script> document.getElementById('dpc').disabled = true;</script>";
     echo "<script> document.getElementById('sca').disabled = true;</script>";
     echo "<script> document.getElementById('mme').disabled = true;</script>";
     echo "<script> document.getElementById('prn').disabled = true;</script>";

     echo "<script> document.getElementById('mouno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('keyno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('tabno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('monno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('dpcno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('scano').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('mmeno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('prnno').style.visibility = 'hidden';</script>";
}
if(!empty($mous))
{
     echo "<script> document.getElementById('mou').checked = true;</script>";
     echo "<script> document.getElementById('mouno').focus();</script>";
     $itemdata = 'Mouse';

     echo "<script> document.getElementById('lap').disabled = true;</script>";
     echo "<script> document.getElementById('key').disabled = true;</script>";
     echo "<script> document.getElementById('tab').disabled = true;</script>";
     echo "<script> document.getElementById('mon').disabled = true;</script>";
     echo "<script> document.getElementById('dpc').disabled = true;</script>";
     echo "<script> document.getElementById('sca').disabled = true;</script>";
     echo "<script> document.getElementById('mme').disabled = true;</script>";
     echo "<script> document.getElementById('prn').disabled = true;</script>";

     echo "<script> document.getElementById('lapno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('keyno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('tabno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('monno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('dpcno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('scano').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('mmeno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('prnno').style.visibility = 'hidden';</script>";
}
if(!empty($keyb))
{
     echo "<script> document.getElementById('key').checked = true;</script>";
     echo "<script> document.getElementById('keyno').focus();</script>";
     $itemdata = 'Keyboard';

     echo "<script> document.getElementById('lap').disabled = true;</script>";
     echo "<script> document.getElementById('mou').disabled = true;</script>";
     echo "<script> document.getElementById('tab').disabled = true;</script>";
     echo "<script> document.getElementById('mon').disabled = true;</script>";
     echo "<script> document.getElementById('dpc').disabled = true;</script>";
     echo "<script> document.getElementById('sca').disabled = true;</script>";
     echo "<script> document.getElementById('mme').disabled = true;</script>";
     echo "<script> document.getElementById('prn').disabled = true;</script>";

     echo "<script> document.getElementById('lapno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('mouno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('tabno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('monno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('dpcno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('scano').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('mmeno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('prnno').style.visibility = 'hidden';</script>";
}
if(!empty($tabl))
{
     echo "<script> document.getElementById('tab').checked = true;</script>";
     echo "<script> document.getElementById('tabno').focus();</script>";
     $itemdata = 'Tablet';

     echo "<script> document.getElementById('lap').disabled = true;</script>";
     echo "<script> document.getElementById('mou').disabled = true;</script>";
     echo "<script> document.getElementById('key').disabled = true;</script>";
     echo "<script> document.getElementById('mon').disabled = true;</script>";
     echo "<script> document.getElementById('dpc').disabled = true;</script>";
     echo "<script> document.getElementById('sca').disabled = true;</script>";
     echo "<script> document.getElementById('mme').disabled = true;</script>";
     echo "<script> document.getElementById('prn').disabled = true;</script>";

     echo "<script> document.getElementById('lapno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('mouno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('keyno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('monno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('dpcno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('scano').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('mmeno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('prnno').style.visibility = 'hidden';</script>";
}
if(!empty($moni))
{
     echo "<script> document.getElementById('mon').checked = true;</script>";
     echo "<script> document.getElementById('monno').focus();</script>";
     $itemdata = 'Monitor';

     echo "<script> document.getElementById('lap').disabled = true;</script>";
     echo "<script> document.getElementById('mou').disabled = true;</script>";
     echo "<script> document.getElementById('key').disabled = true;</script>";
     echo "<script> document.getElementById('tab').disabled = true;</script>";
     echo "<script> document.getElementById('dpc').disabled = true;</script>";
     echo "<script> document.getElementById('sca').disabled = true;</script>";
     echo "<script> document.getElementById('mme').disabled = true;</script>";
     echo "<script> document.getElementById('prn').disabled = true;</script>";

     echo "<script> document.getElementById('lapno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('mouno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('keyno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('tabno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('dpcno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('scano').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('mmeno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('prnno').style.visibility = 'hidden';</script>";
}
if(!empty($desk))
{
     echo "<script> document.getElementById('dpc').checked = true;</script>";
     echo "<script> document.getElementById('dpcno').focus();</script>";
     $itemdata = 'DeskPC';

     echo "<script> document.getElementById('lap').disabled = true;</script>";
     echo "<script> document.getElementById('mou').disabled = true;</script>";
     echo "<script> document.getElementById('key').disabled = true;</script>";
     echo "<script> document.getElementById('tab').disabled = true;</script>";
     echo "<script> document.getElementById('mon').disabled = true;</script>";
     echo "<script> document.getElementById('sca').disabled = true;</script>";
     echo "<script> document.getElementById('mme').disabled = true;</script>";
     echo "<script> document.getElementById('prn').disabled = true;</script>";

     echo "<script> document.getElementById('lapno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('mouno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('keyno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('tabno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('monno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('scano').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('mmeno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('prnno').style.visibility = 'hidden';</script>";
}
if(!empty($scan))
{
     echo "<script> document.getElementById('sca').checked = true;</script>";
     echo "<script> document.getElementById('scano').focus();</script>";
     $itemdata = 'Scanner';

     echo "<script> document.getElementById('lap').disabled = true;</script>";
     echo "<script> document.getElementById('mou').disabled = true;</script>";
     echo "<script> document.getElementById('key').disabled = true;</script>";
     echo "<script> document.getElementById('tab').disabled = true;</script>";
     echo "<script> document.getElementById('mon').disabled = true;</script>";
     echo "<script> document.getElementById('dpc').disabled = true;</script>";
     echo "<script> document.getElementById('mme').disabled = true;</script>";
     echo "<script> document.getElementById('prn').disabled = true;</script>";

     echo "<script> document.getElementById('lapno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('mouno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('keyno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('tabno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('monno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('dpcno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('mmeno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('prnno').style.visibility = 'hidden';</script>";
}
if(!empty($mult))
{
     echo "<script> document.getElementById('mme').checked = true;</script>";
     echo "<script> document.getElementById('mmeno').focus();</script>";
     $itemdata = 'Multimedia';

     echo "<script> document.getElementById('lap').disabled = true;</script>";
     echo "<script> document.getElementById('mou').disabled = true;</script>";
     echo "<script> document.getElementById('key').disabled = true;</script>";
     echo "<script> document.getElementById('tab').disabled = true;</script>";
     echo "<script> document.getElementById('mon').disabled = true;</script>";
     echo "<script> document.getElementById('dpc').disabled = true;</script>";
     echo "<script> document.getElementById('sca').disabled = true;</script>";
     echo "<script> document.getElementById('prn').disabled = true;</script>";

     echo "<script> document.getElementById('lapno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('mouno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('keyno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('tabno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('monno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('dpcno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('scano').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('prnno').style.visibility = 'hidden';</script>";
}
if(!empty($prin))
{
     echo "<script> document.getElementById('prn').checked = true;</script>";
     echo "<script> document.getElementById('prnno').focus();</script>";
     $itemdata = 'Printer';

     echo "<script> document.getElementById('lap').disabled = true;</script>";
     echo "<script> document.getElementById('mou').disabled = true;</script>";
     echo "<script> document.getElementById('key').disabled = true;</script>";
     echo "<script> document.getElementById('tab').disabled = true;</script>";
     echo "<script> document.getElementById('mon').disabled = true;</script>";
     echo "<script> document.getElementById('dpc').disabled = true;</script>";
     echo "<script> document.getElementById('sca').disabled = true;</script>";
     echo "<script> document.getElementById('mme').disabled = true;</script>";

     echo "<script> document.getElementById('lapno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('mouno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('keyno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('tabno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('monno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('dpcno').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('scano').style.visibility = 'hidden';</script>";
     echo "<script> document.getElementById('mmeno').style.visibility = 'hidden';</script>";
}

if(isset($_POST['SubmitRequest']))
{

     if($itemdata=='Laptop')
     {
          if(!empty($_POST['lap']))
          {
               $itemexist = odbc_exec($hris,"SELECT ItemCode from [misInv].[dbo].[ItemMaster] where ItemCode='".$_POST['lap']."'");

               if(odbc_num_rows($itemexist) > 0)
               {
                    $itemexist2 = odbc_exec($hris,"SELECT AssetType from [dbo].[ITASSET_RequestForm_Sample1] where AssetType='".$_POST['lap']."'");
                    if(odbc_num_rows($itemexist2) > 0)
                    {
                         echo "<script>alert('( ✘ ) Item Code is Already Requested !');</script>";
                    }
                    else
                    {
                         odbc_exec($hris,"UPDATE [dbo].[ITASSET_RequestForm_Sample1] set AssetType='".$_POST['lap']."', Status='Approved', Editable='No' where ControlNumber = '".$cont."'");
                         echo "<script>alert('( ✔ ) Borrow Request Successfully Approved !');</script>";
                         echo "<script> document.getElementById('submitbtn').disabled = true;</script>";
                         echo "<script> document.getElementById('lapno').disabled = true;</script>";
                         echo "<script> document.getElementById('back2').focus();</script>";
                    }
               }
               else
               {
                    echo "<script>alert('( ✘ ) Item Code Not Found !');</script>";
               }
          }
          else
          {
               echo "<script>alert('( ✘ ) Please Provide Item Code !');</script>";
          }
     }
     elseif($itemdata=='Mouse')
     {
          if(!empty($_POST['mou']))
          {
               $itemexist = odbc_exec($hris,"SELECT ItemCode from [misInv].[dbo].[ItemMaster] where ItemCode='".$_POST['mou']."'");

               if(odbc_num_rows($itemexist) > 0)
               {
                    $itemexist2 = odbc_exec($hris,"SELECT AssetType from [dbo].[ITASSET_RequestForm_Sample1] where AssetType='".$_POST['mou']."'");
                    if(odbc_num_rows($itemexist2) > 0)
                    {
                         echo "<script>alert('( ✘ ) Item Code is Already Requested !');</script>";
                    }
                    else
                    {
                         odbc_exec($hris,"UPDATE [dbo].[ITASSET_RequestForm_Sample1] set AssetType='".$_POST['mou']."', Status='Approved', Editable='No' where ControlNumber = '".$cont."'");
                         echo "<script>alert('( ✔ ) Borrow Request Successfully Approved !');</script>";
                         echo "<script> document.getElementById('submitbtn').disabled = true;</script>";
                         echo "<script> document.getElementById('mouno').disabled = true;</script>";
                         echo "<script> document.getElementById('back2').focus();</script>";
                    }
               }
               else
               {
                    echo "<script>alert('( ✘ ) Item Code Not Found !');</script>";
               }
          }
          else
          {
               echo "<script>alert('( ✘ ) Please Provide Item Code !');</script>";
          }
     }
     elseif($itemdata=='Keyboard')
     {
          if(!empty($_POST['key']))
          {
               $itemexist = odbc_exec($hris,"SELECT ItemCode from [misInv].[dbo].[ItemMaster] where ItemCode='".$_POST['key']."'");

               if(odbc_num_rows($itemexist) > 0)
               {
                    $itemexist2 = odbc_exec($hris,"SELECT AssetType from [dbo].[ITASSET_RequestForm_Sample1] where AssetType='".$_POST['key']."'");
                    if(odbc_num_rows($itemexist2) > 0)
                    {
                         echo "<script>alert('( ✘ ) Item Code is Already Requested !');</script>";
                    }
                    else
                    {
                         odbc_exec($hris,"UPDATE [dbo].[ITASSET_RequestForm_Sample1] set AssetType='".$_POST['key']."', Status='Approved', Editable='No' where ControlNumber = '".$cont."'");
                         echo "<script>alert('( ✔ ) Borrow Request Successfully Approved !');</script>";
                         echo "<script> document.getElementById('submitbtn').disabled = true;</script>";
                         echo "<script> document.getElementById('keyno').disabled = true;</script>";
                         echo "<script> document.getElementById('back2').focus();</script>";
                    }
               }
               else
               {
                    echo "<script>alert('( ✘ ) Item Code Not Found !');</script>";
               }
          }
          else
          {
               echo "<script>alert('( ✘ ) Please Provide Item Code !');</script>";
          }
     }
     elseif($itemdata=='Tablet')
     {
          if(!empty($_POST['tab']))
          {
               $itemexist = odbc_exec($hris,"SELECT ItemCode from [misInv].[dbo].[ItemMaster] where ItemCode='".$_POST['tab']."'");

               if(odbc_num_rows($itemexist) > 0)
               {
                    $itemexist2 = odbc_exec($hris,"SELECT AssetType from [dbo].[ITASSET_RequestForm_Sample1] where AssetType='".$_POST['tab']."'");
                    if(odbc_num_rows($itemexist2) > 0)
                    {
                         echo "<script>alert('( ✘ ) Item Code is Already Requested !');</script>";
                    }
                    else
                    {
                         odbc_exec($hris,"UPDATE [dbo].[ITASSET_RequestForm_Sample1] set AssetType='".$_POST['tab']."', Status='Approved', Editable='No' where ControlNumber = '".$cont."'");
                         echo "<script>alert('( ✔ ) Borrow Request Successfully Approved !');</script>";
                         echo "<script> document.getElementById('submitbtn').disabled = true;</script>";
                         echo "<script> document.getElementById('tabno').disabled = true;</script>";
                         echo "<script> document.getElementById('back2').focus();</script>";
                    }
               }
               else
               {
                    echo "<script>alert('( ✘ ) Item Code Not Found !');</script>";
               }
          }
          else
          {
               echo "<script>alert('( ✘ ) Please Provide Item Code !');</script>";
          }
     }
     elseif($itemdata=='Monitor')
     {
          if(!empty($_POST['mon']))
          {
               $itemexist = odbc_exec($hris,"SELECT ItemCode from [misInv].[dbo].[ItemMaster] where ItemCode='".$_POST['mon']."'");

               if(odbc_num_rows($itemexist) > 0)
               {
                    $itemexist2 = odbc_exec($hris,"SELECT AssetType from [dbo].[ITASSET_RequestForm_Sample1] where AssetType='".$_POST['mon']."'");
                    if(odbc_num_rows($itemexist2) > 0)
                    {
                         echo "<script>alert('( ✘ ) Item Code is Already Requested !');</script>";
                    }
                    else
                    {
                         odbc_exec($hris,"UPDATE [dbo].[ITASSET_RequestForm_Sample1] set AssetType='".$_POST['mon']."', Status='Approved', Editable='No' where ControlNumber = '".$cont."'");
                         echo "<script>alert('( ✔ ) Borrow Request Successfully Approved !');</script>";
                         echo "<script> document.getElementById('submitbtn').disabled = true;</script>";
                         echo "<script> document.getElementById('monno').disabled = true;</script>";
                         echo "<script> document.getElementById('back2').focus();</script>";
                    }
               }
               else
               {
                    echo "<script>alert('( ✘ ) Item Code Not Found !');</script>";
               }
          }
          else
          {
               echo "<script>alert('( ✘ ) Please Provide Item Code !');</script>";
          }
     }
     elseif($itemdata=='DeskPC')
     {
          if(!empty($_POST['dpc']))
          {
               $itemexist = odbc_exec($hris,"SELECT ItemCode from [misInv].[dbo].[ItemMaster] where ItemCode='".$_POST['dpc']."'");

               if(odbc_num_rows($itemexist) > 0)
               {
                    $itemexist2 = odbc_exec($hris,"SELECT AssetType from [dbo].[ITASSET_RequestForm_Sample1] where AssetType='".$_POST['dpc']."'");
                    if(odbc_num_rows($itemexist2) > 0)
                    {
                         echo "<script>alert('( ✘ ) Item Code is Already Requested !');</script>";
                    }
                    else
                    {
                         odbc_exec($hris,"UPDATE [dbo].[ITASSET_RequestForm_Sample1] set AssetType='".$_POST['dpc']."', Status='Approved', Editable='No' where ControlNumber = '".$cont."'");
                         echo "<script>alert('( ✔ ) Borrow Request Successfully Approved !');</script>";
                         echo "<script> document.getElementById('submitbtn').disabled = true;</script>";
                         echo "<script> document.getElementById('dpcno').disabled = true;</script>";
                         echo "<script> document.getElementById('back2').focus();</script>";
                    }
               }
               else
               {
                    echo "<script>alert('( ✘ ) Item Code Not Found !');</script>";
               }
          }
          else
          {
               echo "<script>alert('( ✘ ) Please Provide Item Code !');</script>";
          }
     }
     elseif($itemdata=='Scanner')
     {
          if(!empty($_POST['sca']))
          {
               $itemexist = odbc_exec($hris,"SELECT ItemCode from [misInv].[dbo].[ItemMaster] where ItemCode='".$_POST['sca']."'");

               if(odbc_num_rows($itemexist) > 0)
               {
                    $itemexist2 = odbc_exec($hris,"SELECT AssetType from [dbo].[ITASSET_RequestForm_Sample1] where AssetType='".$_POST['sca']."'");
                    if(odbc_num_rows($itemexist2) > 0)
                    {
                         echo "<script>alert('( ✘ ) Item Code is Already Requested !');</script>";
                    }
                    else
                    {
                         odbc_exec($hris,"UPDATE [dbo].[ITASSET_RequestForm_Sample1] set AssetType='".$_POST['sca']."', Status='Approved', Editable='No' where ControlNumber = '".$cont."'");
                         echo "<script>alert('( ✔ ) Borrow Request Successfully Approved !');</script>";
                         echo "<script> document.getElementById('submitbtn').disabled = true;</script>";
                         echo "<script> document.getElementById('scano').disabled = true;</script>";
                         echo "<script> document.getElementById('back2').focus();</script>";
                    }
               }
               else
               {
                    echo "<script>alert('( ✘ ) Item Code Not Found !');</script>";
               }
          }
          else
          {
               echo "<script>alert('( ✘ ) Please Provide Item Code !');</script>";
          }
     }
     elseif($itemdata=='Printer')
     {
          if(!empty($_POST['prn']))
          {
               $itemexist = odbc_exec($hris,"SELECT ItemCode from [misInv].[dbo].[ItemMaster] where ItemCode='".$_POST['prn']."'");

               if(odbc_num_rows($itemexist) > 0)
               {
                    $itemexist2 = odbc_exec($hris,"SELECT AssetType from [dbo].[ITASSET_RequestForm_Sample1] where AssetType='".$_POST['prn']."'");
                    if(odbc_num_rows($itemexist2) > 0)
                    {
                         echo "<script>alert('( ✘ ) Item Code is Already Requested !');</script>";
                    }
                    else
                    {
                         odbc_exec($hris,"UPDATE [dbo].[ITASSET_RequestForm_Sample1] set AssetType='".$_POST['prn']."', Status='Approved', Editable='No' where ControlNumber = '".$cont."'");
                         echo "<script>alert('( ✔ ) Borrow Request Successfully Approved !');</script>";
                         echo "<script> document.getElementById('submitbtn').disabled = true;</script>";
                         echo "<script> document.getElementById('prnno').disabled = true;</script>";
                         echo "<script> document.getElementById('back2').focus();</script>";
                    }
               }
               else
               {
                    echo "<script>alert('( ✘ ) Item Code Not Found !');</script>";
               }
          }
          else
          {
               echo "<script>alert('( ✘ ) Please Provide Item Code !');</script>";
          }
     }
     elseif($itemdata=='Multimedia')
     {
          if(!empty($_POST['mme']))
          {
               $itemexist = odbc_exec($hris,"SELECT ItemCode from [misInv].[dbo].[ItemMaster] where ItemCode='".$_POST['mme']."'");

               if(odbc_num_rows($itemexist) > 0)
               {
                    $itemexist2 = odbc_exec($hris,"SELECT AssetType from [dbo].[ITASSET_RequestForm_Sample1] where AssetType='".$_POST['mme']."'");
                    if(odbc_num_rows($itemexist2) > 0)
                    {
                         echo "<script>alert('( ✘ ) Item Code is Already Requested !');</script>";
                    }
                    else
                    {
                         odbc_exec($hris,"UPDATE [dbo].[ITASSET_RequestForm_Sample1] set AssetType='".$_POST['mme']."', Status='Approved', Editable='No' where ControlNumber = '".$cont."'");
                         echo "<script>alert('( ✔ ) Borrow Request Successfully Approved !');</script>";
                         echo "<script> document.getElementById('submitbtn').disabled = true;</script>";
                         echo "<script> document.getElementById('mmeno').disabled = true;</script>";
                         echo "<script> document.getElementById('back2').focus();</script>";

                    }
               }
               else
               {
                    echo "<script>alert('( ✘ ) Item Code Not Found !');</script>";
               }
          }
          else
          {
               echo "<script>alert('( ✘ ) Please Provide Item Code !');</script>";
          }
     }

}


include_once 'conn/connect.php';
}//login to proceed
?>
</body>
</html>