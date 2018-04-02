<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="img/favicon.ico"/>
</head>
<title>Edit Borrow Request</title>
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

     $no3 = $_SESSION['cont'];
     $dura = $_SESSION['dura'];
     $stda = $_SESSION['star'];
     $enda = $_SESSION['endd'];
     $reas = $_SESSION['reas'];
     $dasu = $_SESSION['date'];
     $borr = $_SESSION['borr'];

if($log=='')
{
  echo "<script>alert('( ✘ ) User is Not Login !');</script>";
          $_SESSION['log'] = ''; 
    include_once 'conn/mainpage.php';
}
elseif($log=='Yes' && $typ=='Security Guard IN' || $typ=='Security Guard OUT')
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
          header('location:AssociateViewRequest.php');
     }
?>

<style>
  
 @keyframes blink{
0%{opacity: 0;}
50%{opacity: .8;}
100%{opacity: 1;}
}
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
               <label style='background-color: rgba(224,220,223,0.4); margin-left: 10px; font-size: 20px; font-family: Courier New;'><b>Employee ID</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </label>&nbsp;&nbsp;
               <input type='text' id='empd' name='employid' onkeypress="return checkQuote();" maxlength="10" autocomplete="off" value='<?php echo $empid;?>' style='margin-left: -10px; color: blue; border-radius: 3px; margin-top: 15px; border-color: rgba(224,220,223,0.1); background-color: rgba(224,220,223,0.1); text-align: center; border-style: solid; font-family: Courier New; font-size: 18px; height: 30px; width: 290px;'><span class='error' style='font-family: Courier New;'><?php echo $emperr; ?></span>
               <input type='Submit' name='load3' value='.' style='border-style: solid; border-color: rgba(224,220,223,0.1);margin-top: 15px; text-align: right; background-color: rgba(224,220,223,0.1); color: rgba(224,220,223,0.1); font-family: Courier New; font-size: 1px; height: 1px; width:-5px;'><br>
            <label style='background-color: rgba(224,220,223,0.4);margin-left: 10px; font-size: 20px; font-family: Courier New;'><b>Associate Name</b> &nbsp;&nbsp;&nbsp;&nbsp;:</label>&nbsp;&nbsp;
            <input type='text' name='AssociateName' id='assocname' readonly value='<?php echo $name; ?>' style='margin-top: 10px;  background-color: rgba(224,220,223,0.1); border-style: none; font-family: Courier New; font-size: 18px; text-align: center; color: blue; height: 30px; width: 315px;'><br>
            <label style='background-color: rgba(224,220,223,0.4);margin-left: 10px; font-size: 20px; font-family: Courier New;'><b>Department/Section</b> : </label>
            <input type='text' name='DepartmentSection' id='depart' readonly value='<?php echo $dep; ?>' style='margin-top: 10px; background-color: rgba(224,220,223,0.1); border-style: none; font-family: Courier New; color:blue; font-size: 18px; text-align: center; height: 30px; width: 315px;'>
          </div>

          <div style='margin-left: 860px; margin-top: -140px; border-style: none none none solid; width:480px; height: 150px; margin-bottom: 2px;'>
               <label style='margin-left: 20px; font-size: 20px; font-family: Courier New;'><b>Request Number</b> : </label>&nbsp;&nbsp;
               <input type='text' id='control' readonly autocomplete="off" name='ControlNumber' value='<?php if(isset($_POST['SubmitRequest']) && $_POST['comment']!="") echo $no3; elseif(isset($_POST['load'])) echo $no3; else echo $no3; ?>' 
               style='background-color: rgba(224,220,223,0.1); color: red;border-color: none; border-style: none;margin-top: 40px; font-family: Courier New; font-size: 18px; height: 30px; width: 230px;'>
            <br>
            <label style='margin-left: 20px; font-size: 20px; font-family: Courier New;'><b>Date</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</label>
            <input type='text' name='mmddyy' readonly value='<?php echo $d;?>' placeholder='MM-DD-YY' style='background-color: rgba(224,220,223,0.1); color: blue;margin-top: 10px; border-color: none; border-style: none;margin-left: 8px;font-family: Courier New; font-size: 18px; height: 30px; width: 230px;'>
          </div>

          <div style='border-style: double;'></div>

          <div style='width: 730px; height: 190px;'><BR>
            <label style='margin-left: 25px; font-size: 20px; font-family: Courier New;'><b>Asset Type</b> : </label>&nbsp;&nbsp;
               <br><BR>

                  <label class="container1" style='margin-left: 25px; font-size: 18px; font-family: Courier New;'>Laptop 
               <input type="radio" id='lap' name="item" value="laptop" onclick='dis()' style='margin-left: 105px; margin-top: 25px;' <?php if($borr=='LAP') echo "checked"; elseif (isset($item) && $item=="laptop") echo "checked"; elseif(isset($_POST['SubmitRequest']) && empty($_POST['item'])) echo "unchecked"; elseif(isset($_POST['SubmitRequest']) && $_POST['item']=="laptop") echo "checked"; ?> ><span class="checkmark1"></span></label>

                  <label class="container1" style='margin-left: 100px; font-size: 18px; font-family: Courier New;'>Mouse 
               <input type="radio" id='mou' name="item" value="mouse" onclick='dis()' style='margin-left: 105px; margin-top: 25px;' <?php if($borr=='MOU') echo "checked"; elseif (isset($item) && $item=="mouse") echo "checked"; elseif(isset($_POST['SubmitRequest']) && empty($_POST['item'])) echo "unchecked"; elseif(isset($_POST['SubmitRequest']) && $_POST['item']=="mouse") echo "checked"; ?> ><span class="checkmark1"></span></label>

                  <label class="container1" style='margin-left: 131px; font-size: 18px; font-family: Courier New;'>Keyboard 
               <input type="radio" id='key' name="item" value="keyboard" onclick='dis()' style='margin-left: 105px; margin-top: 25px;' <?php if($borr=='KEY') echo "checked"; elseif (isset($item) && $item=="keyboard") echo "checked"; elseif(isset($_POST['SubmitRequest']) && empty($_POST['item'])) echo "unchecked"; elseif(isset($_POST['SubmitRequest']) && $_POST['item']=="keyboard") echo "checked"; ?> ><span class="checkmark1"></span></label><br>

                  <label class="container1" style='margin-left: 25px; font-size: 18px; font-family: Courier New;'>Tablet 
               <input type="radio" id='tab' name="item" value="tablet" onclick='dis()' style='margin-left: 105px; margin-top: 25px;' <?php if($borr=='TAB') echo "checked"; elseif (isset($item) && $item=="tablet") echo "checked"; elseif(isset($_POST['SubmitRequest']) && empty($_POST['item'])) echo "unchecked"; elseif(isset($_POST['SubmitRequest']) && $_POST['item']=="tablet") echo "checked"; ?> ><span class="checkmark1"></span></label>

                  <label class="container1" style='margin-left: 100px; font-size: 18px; font-family: Courier New;'>Monitor 
               <input type="radio" id='mon' name="item" value="monitor" onclick='dis()' style='margin-left: 105px; margin-top: 25px;' <?php if($borr=='MON') echo "checked"; elseif (isset($item) && $item=="monitor") echo "checked"; elseif(isset($_POST['SubmitRequest']) && empty($_POST['item'])) echo "unchecked"; elseif(isset($_POST['SubmitRequest']) && $_POST['item']=="monitor") echo "checked"; ?> ><span class="checkmark1"></span></label>

                  <label class="container1" style='margin-left: 108px; font-size: 18px; font-family: Courier New;'>DeskPC 
               <input type="radio" id='dpc' name="item" value="deskpc" onclick='dis()' style='margin-left: 105px; margin-top: 25px;' <?php if($borr=='DPC') echo "checked"; elseif (isset($item) && $item=="deskpc") echo "checked"; elseif(isset($_POST['SubmitRequest']) && empty($_POST['item'])) echo "unchecked"; elseif(isset($_POST['SubmitRequest']) && $_POST['item']=="deskpc") echo "checked"; ?> ><span class="checkmark1"></span></label><br>

                  <label class="container1" style='margin-left: 25px; font-size: 18px; font-family: Courier New;'>Scanner 
               <input type="radio" id='sca' name="item" value="scanner" onclick='dis()' style='margin-left: 105px; margin-top: 25px;' <?php if($borr=='SCA') echo "checked"; elseif (isset($item) && $item=="scanner") echo "checked"; elseif(isset($_POST['SubmitRequest']) && empty($_POST['item'])) echo "unchecked"; elseif(isset($_POST['SubmitRequest']) && $_POST['item']=="scanner") echo "checked"; ?> ><span class="checkmark1"></span></label>

                  <label class="container1" style='margin-left: 89px; font-size: 18px; font-family: Courier New;'>Printer 
               <input type="radio" id='prn' name="item" value="printer" onclick='dis()' style='margin-left: 105px; margin-top: 25px;' <?php if($borr=='PRN') echo "checked"; elseif (isset($item) && $item=="printer") echo "checked"; elseif(isset($_POST['SubmitRequest']) && empty($_POST['item'])) echo "unchecked"; elseif(isset($_POST['SubmitRequest']) && $_POST['item']=="printer") echo "checked"; ?> ><span class="checkmark1"></span></label>

                  <label class="container1" style='margin-left: 108px; font-size: 18px; font-family: Courier New;'>Multimedia 
               <input type="radio" id='mme' name="item" value="multimedia" onclick='dis()' style='margin-left: 105px; margin-top: 25px;' <?php if($borr=='MME') echo "checked"; elseif (isset($item) && $item=="multimedia") echo "checked"; elseif(isset($_POST['SubmitRequest']) && empty($_POST['item'])) echo "unchecked"; elseif(isset($_POST['SubmitRequest']) && $_POST['item']=="multimedia") echo "checked"; ?> ><span class="checkmark1"></span></label>

               <br>
          </div>

          <div style='width: 500px; height: 110px;border-style: none none none solid; margin-left: 733px; margin-top: -150px;'>
               
               <label style='margin-left: 25px; font-size: 18px; font-family: Courier New;'><b> Request Type</b> &nbsp;: </label>&nbsp;&nbsp;<br><BR><br>
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
               <textarea id='comm' onkeydown="return (event.keyCode!=13);" onkeypress="return checkQuote();" style='margin-left: 25px;margin-top: 10px;border-radius: 5px; resize: none; border-color: rgba(224,220,223,0.9); border-style: solid; border-style: solid; font-size: 15px;' name="comment" rows="4" cols="55"><?php if(isset($_POST['load'])) echo $_POST['comment']; elseif(isset($_POST['SubmitRequest'])) echo $_POST['comment']; else echo $reas;?></textarea>
               <span class='error' style='animation: blink 1s linear infinite; font-size: 18px;'><?php echo $reason; ?></span>
               
          </div>

          <div style='width: 500px; margin-top: -125px; height: 110px; margin-left: 560px'>
               <label style='margin-left: 25px; font-size: 20px; font-family: Courier New;'><b>Start Date</b> &nbsp;&nbsp;&nbsp;: &nbsp;</label>&nbsp;
               <input type="text" autocomplete="off" id='startdate1' onkeydown="return (event.keyCode!=13);" onkeypress="return checkQuote();" onchange="checkStartDate()" style='text-align: center; margin-top: 1px; font-family: Courier New; font-size: 18px; border-color: white; border-style: solid;height: 28px; width: 210px; border-radius: 5px; background-color: white;' name="StartDate" value="<?php echo $stda;?>" />
               <br>
               <label style='margin-left: 25px; font-size: 20px; font-family: Courier New;'><b>End Date</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;</label>&nbsp;
               <input type="text" autocomplete="off" id='enddate1' onkeydown="return (event.keyCode!=13);" onkeypress="return checkQuote();" onchange="checkEndDate()" style='border-color: white; border-radius: 5px; border-style: solid;text-align: center; margin-top: 15px; font-family: Courier New; font-size: 18px; height: 28px; width: 210px; background-color: white;' name="EndDate" value="<?php echo $enda;?>" /><br>
          </div>

          <div style='height: 150px; width: 300px; margin-left: 1035px; margin-top: -153px; '>
                    <input type='Submit' name='SubmitRequest' id='submitbtn' title='Submit and Validate Your Request' value='.' style='border-radius: 5px; border-color: skyblue; text-align: right; cursor: pointer; margin-top: 25px;color: skyblue; background-image: url("img/update.png"); margin-left: 30px; font-family: Courier New; font-size: 22px; height: 52px; width: 262px;'><br>
                    <input type='Submit' name='Logout' id='back2' title='Go Back to the Front Page' value='.' style='border-radius: 5px; border-color: skyblue; text-align: right; margin-top: 10px; cursor: pointer; color: skyblue; background-image: url("img/new/bk1.png"); margin-left: 30px; font-family: Courier New; font-size: 22px; height: 54px; width: 262px;'>
               <br><br>
          </div>


<script type="text/javascript">
function checkStartDate() {

     var selectedText = document.getElementById('startdate1').value;
     var selectedDate = new Date(selectedText);
     var now = new Date();
     now.setDate(now.getDate() - 1);

     if (selectedDate < now) {
          alert("( ✘ ) Start Date Must Beyond or Equal to the Current Date !");
          document.getElementById('enddate1').disabled = true; 
          document.getElementById('startdate1').value = '';
     }
     else
     {
          document.getElementById('enddate1').value = '';
          document.getElementById('enddate1').disabled = false; 
     }
}
</script>

<script type="text/javascript">
function checkEndDate() 
{
     var selectedText = document.getElementById('enddate1').value;
     var emptystart = document.getElementById('startdate1').value;
     var selectedDate = new Date(selectedText);
     var selectedEnd = new Date(emptystart);
     var now = new Date();

     if (selectedDate < now || selectedDate < selectedEnd) 
     {
          alert("( ✘ ) End Date Must Beyond or Equal to the Start Date !");
          document.getElementById('enddate1').value = '';
     }
     else
     {
          if(emptystart=="")
          {
               alert("( ✘ ) Select Your Start Date First !");
               document.getElementById('enddate1').value = '';
          }
          else if(emptystart==selectedText)
          {
               alert("( ✘ ) End Date Must Beyond The Start Date !");
               document.getElementById('enddate1').value = '';
          }
          else
          {
               document.getElementById('startdate1').disabled = false; 
          }
     }
}
</script>

<script type="text/javascript" language="javascript">
          function checkQuote() {
               if(event.keyCode == 39) {
                    event.keyCode = 0;
                    return false;
               }
          }
</script>

<script> 
function ena()//temporary
{ 
     //document.getElementById('enddate1').disabled = false; 
     document.getElementById('startdate1').disabled = false; 
     document.getElementById('enddate1').value = '';
     document.getElementById('startdate1').value = '';
}
</script>

<link rel="stylesheet" href="conn/cal3.css">
<script src="conn/cal1.js"></script>
<script src="conn/cal2.js"></script>

<script>
      $(document).ready(function () {
    $("#startdate1").datepicker();
  });
  
  $(document).ready(function() {
    $("#enddate1").datepicker();
  });
</script>

     </div>
     </form>
     <?php
include_once('conn/footer.php');
?>

<?php

include_once 'conn/connect.php';

    date_default_timezone_set('Asia/Manila');
    $dt = date('Y-m-d');
    $cono = date('y');
    $d  = date('M. d, Y/D');
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

     if(!empty($_POST['SubmitRequest']))
     {

          if(empty($_POST['comment']) && empty($_POST['Duration']) || empty($_POST['comment']) && !empty($_POST['Duration']) || !empty($_POST['comment']) && empty($_POST['Duration']) || empty($_POST["item"]))
          {
               echo "<script>alert('( ✘ ) Complete Information Required !');</script>";
               echo "<script> document.getElementById('startdate1').value = '".$_POST['StartDate']."';</script>";
               echo "<script> document.getElementById('enddate1').value = '".$_POST['EndDate']."';</script>";

               if(empty($_POST['employid']))
               {
                    echo "<script> document.getElementById('empd').readOnly = false;</script>";
                    echo "<script> document.getElementById('empd').focus();</script>";
                    echo "<script> document.getElementById('startdate1').value = '".$_POST['StartDate']."';</script>";
                    echo "<script> document.getElementById('enddate1').value = '".$_POST['EndDate']."';</script>";
               }
               else
               {
                    include_once 'conn/connecthris.php';
                    $que = odbc_exec($hris2, "SELECT a.Employee_LastName, a.Employee_FirstName, a.Employee_MiddleName, b.DEPNME FROM VIEW_HRIS_EmployeeName as a inner join VIEW_HRIS_EmploymentInfo as b on a.Employee_ID = b.Employee_ID where a.Employee_ID = '".$_POST['employid']."'");
                    if (!$que) 
                    {
                        exit();
                    }
                    else if(odbc_num_rows($que) > 0)
                    {
                         while ($row = odbc_fetch_array($que))
                         {
                              $ln = odbc_result($que,1);
                              $fn = odbc_result($que,2);
                              $mna = odbc_result($que,3);
                              $mn = substr($mna, 0, 1).'.';
                              $dm = odbc_result($que,4);

                              $name2 = $ln.", ".$fn." ".$mn;
                              if($dep!=$dm)
                              {
                                   echo "<script>alert('( ✘ ) The Employee is Not Within Your section !');</script>";
                              }
                              else
                              {
                                echo "<script> document.getElementById('assocname').value = '".$name2."';</script>";
                                echo "<script> document.getElementById('depart').value = '".$dm."';</script>";
  
                                echo "<script> document.getElementById('empd').readOnly = true;</script>";
                              }
                         }
                    }
                    else
                    {
                         echo "<script> document.getElementById('empd').readOnly = false;</script>";
                         echo "<script> document.getElementById('empd').value = '';</script>";
                    }
               }
          }
          else
          {
               if(!empty($_POST['Duration']) && !empty($_POST['comment']))
               {
                    if($_POST['Duration']=="T" && empty($_POST['StartDate']) && empty($_POST['EndDate']) || 
                       $_POST['Duration']=="T" && !empty($_POST['StartDate']) && empty($_POST['EndDate']) || 
                       $_POST['Duration']=="T" && empty($_POST['StartDate']) && !empty($_POST['EndDate']))
                    {
                         echo "<script>alert('( ✘ ) Your Request is for Temporary Please Select Your Start Date and End Date of Usage !');</script>";
                    }
                    elseif($_POST['Duration']=="T" && !empty($_POST['StartDate']) && !empty($_POST['EndDate']))
                    {     
                      if(empty($_POST['employid']))
               {
                    echo "<script> document.getElementById('empd').readOnly = false;</script>";
               }
               else
               {
                      include_once 'conn/connecthris.php';
               $empinfo = odbc_exec($hris2, "SELECT a.Employee_LastName, a.Employee_FirstName, a.Employee_MiddleName, b.DEPNME FROM VIEW_HRIS_EmployeeName as a inner join VIEW_HRIS_EmploymentInfo as b on a.Employee_ID = b.Employee_ID where a.Employee_ID = '".$_POST['employid']."'");
          
               if (!$empinfo) 
               {
                    exit();
               }
               else if(odbc_num_rows($empinfo) > 0)
               {
                    while ($row = odbc_fetch_array($empinfo))
                    {
                         $ln = odbc_result($empinfo,1);
                         $fn = odbc_result($empinfo,2);
                         $mna = odbc_result($empinfo,3);
                         $mn = substr($mna, 0, 1).'.';
                         $dm = odbc_result($empinfo,4);
                         
                         $name = $ln.", ".$fn." ".$mn;
                         if($dep!=$dm)
                          {
                               echo "<script>alert('( ✘ ) The Employee is Not Within Your Section !');</script>";
                          }
                          else
                          {
                            echo "<script> document.getElementById('assocname').value = '".$name."';</script>";
                            echo "<script> document.getElementById('depart').value = '".$dm."';</script>";
                            echo "<script> document.getElementById('empd').readOnly = true;</script>";
                            echo "<script> document.getElementById('empd').style.color = 'blue';</script>";
                            echo "<script> document.getElementById('submitbtn').disabled = false;</script>";

                          $lap = $mou = $keb = $tab = $mon = $dpc = $mme = $sca = $pri = "";
                          
                          if($_POST["item"]=='laptop') 
                          { 
                            $top = odbc_exec($hris, "SELECT Prefix from [misInv].[dbo].[ItemTypePrefix] where ItemType = 'Laptop'");
                            if(odbc_num_rows($top) > 0)
                              {
                                   while ($row = odbc_fetch_array($top))
                                   {
                                      $lt = odbc_result($top,1);
                                   }
                              }
                            $lap = $lt;
                          }
                          if($_POST["item"]=='mouse') 
                          { 
                            $top = odbc_exec($hris, "SELECT Prefix from [misInv].[dbo].[ItemTypePrefix] where ItemType = 'mouse'");
                            if(odbc_num_rows($top) > 0)
                              {
                                   while ($row = odbc_fetch_array($top))
                                   {
                                      $mo = odbc_result($top,1);
                                   }
                              }
                            $mou = $mo;
                          }
                          if($_POST["item"]=='keyboard') 
                          { 
                            $top = odbc_exec($hris, "SELECT Prefix from [misInv].[dbo].[ItemTypePrefix] where ItemType = 'Keyboard'");
                            if(odbc_num_rows($top) > 0)
                              {
                                   while ($row = odbc_fetch_array($top))
                                   {
                                      $kb = odbc_result($top,1);
                                   }
                              }
                            $keb = $kb;
                          }
                          if($_POST["item"]=='tablet') 
                          { 
                            $top = odbc_exec($hris, "SELECT Prefix from [misInv].[dbo].[ItemTypePrefix] where ItemType = 'tablet'");
                            if(odbc_num_rows($top) > 0)
                              {
                                   while ($row = odbc_fetch_array($top))
                                   {
                                      $tl = odbc_result($top,1);
                                   }
                              }
                            $tab = $tl;
                          }
                          if($_POST["item"]=='monitor') 
                          { 
                            $top = odbc_exec($hris, "SELECT Prefix from [misInv].[dbo].[ItemTypePrefix] where ItemType = 'monitor'");
                            if(odbc_num_rows($top) > 0)
                              {
                                   while ($row = odbc_fetch_array($top))
                                   {
                                      $mt = odbc_result($top,1);
                                   }
                              }
                            $mon = $mt;
                          }
                          if($_POST["item"]=='deskpc') 
                          { 
                            $top = odbc_exec($hris, "SELECT Prefix from [misInv].[dbo].[ItemTypePrefix] where ItemType = 'DESKPC'");
                            if(odbc_num_rows($top) > 0)
                              {
                                   while ($row = odbc_fetch_array($top))
                                   {
                                      $dk = odbc_result($top,1);
                                   }
                              }
                            $dpc = $dk;
                          }
                          if($_POST["item"]=='scanner') 
                          { 
                            $top = odbc_exec($hris, "SELECT Prefix from [misInv].[dbo].[ItemTypePrefix] where ItemType = 'scanner'");
                            if(odbc_num_rows($top) > 0)
                              {
                                   while ($row = odbc_fetch_array($top))
                                   {
                                      $sc = odbc_result($top,1);
                                   }
                              }
                            $sca = $sc;
                          }
                          if($_POST["item"]=='printer') 
                          { 
                            $top = odbc_exec($hris, "SELECT Prefix from [misInv].[dbo].[ItemTypePrefix] where ItemType = 'Printer'");
                            if(odbc_num_rows($top) > 0)
                              {
                                   while ($row = odbc_fetch_array($top))
                                   {
                                      $pr = odbc_result($top,1);
                                   }
                              }
                            $pri = $pr;
                          }
                          if($_POST["item"]=='multimedia') 
                          { 
                            $top = odbc_exec($hris, "SELECT Prefix from [misInv].[dbo].[ItemTypePrefix] where ItemType = 'MULTIMEDIA'");
                            if(odbc_num_rows($top) > 0)
                              {
                                   while ($row = odbc_fetch_array($top))
                                   {
                                      $md = odbc_result($top,1);
                                   }
                              }
                            $mme = $md;
                          }

                          $start = $_POST['StartDate']; $endd = $_POST['EndDate'];
                          /*  update

                          
                          $empid1 = substr($_POST['employid'],6);
                          $insert = odbc_exec($hris, "INSERT INTO [dbo].[ITASSET_RequestForm_Sample1] (AssociateName, DepartmentSection, ControlNumber, Duration, StartDate,  EndDate, DateSubmitted, TimeSubmitted,Status, Editable, Employee_ID, Employee_ID_Full, Laptop, Mouse, Keyboard, Tablet, Monitor, Desktop, MultimediaProjector, Scanner, RequestType, Printer, RequestedBy, Reason) VALUES ('".$_POST['AssociateName']."','".$_POST['DepartmentSection']."','".$itarf.$cono.$iaarf.$cn.$count."','T','".$start."','".$endd."','".$dt."','".$h."','Entered','Yes',".$empid1.",'".$_POST['employid']."','".$lap."','".$mou."','".$keb."','".$tab."','".$mon."','".$dpc."','".$mme."','".$sca."','Borrowed','".$pri."','".$name."','".$_POST['comment']."')");*/

                          odbc_exec($hris, "UPDATE [dbo].[ITASSET_RequestForm_Sample1] set Laptop='".$lap."', Mouse='".$mou."', Keyboard='".$keb."', Tablet='".$tab."', Monitor='".$mon."', Desktop='".$dpc."', MultimediaProjector='".$mme."', Scanner='".$sca."', Printer='".$pri."', Reason='".$_POST['comment']."', StartDate='".$start."', EndDate='".$endd."' where ControlNumber='".$no3."'");

                          echo "<script> document.getElementById('control').style.color = 'blue';</script>";
                          echo "<script>alert('( ✔ ) Item to Borrowed Successfully Updated.');</script>";

                          echo "<script> document.getElementById('submitbtn').disabled = true;</script>";
                          echo "<script> document.getElementById('comm').readOnly = true;</script>";
                          echo "<script> document.getElementById('temp').disabled = true;</script>";
                          echo "<script> document.getElementById('startdate1').value = '".$_POST['StartDate']."';</script>";
                          echo "<script> document.getElementById('enddate1').value = '".$_POST['EndDate']."';</script>";
                          echo "<script> document.getElementById('startdate1').disabled = true;</script>";
                          echo "<script> document.getElementById('enddate1').disabled = true;</script>";
                          echo "<script> document.getElementById('back2').focus();</script>";
                          echo "<script> document.getElementById('empd').readOnly = true;</script>";
                          echo "<script> document.getElementById('lap').disabled = true;</script>";
                          echo "<script> document.getElementById('mou').disabled = true;</script>";
                          echo "<script> document.getElementById('tab').disabled = true;</script>";
                          echo "<script> document.getElementById('mon').disabled = true;</script>";
                          echo "<script> document.getElementById('dpc').disabled = true;</script>";
                          echo "<script> document.getElementById('sca').disabled = true;</script>";
                          echo "<script> document.getElementById('prn').disabled = true;</script>";
                          echo "<script> document.getElementById('key').disabled = true;</script>";

                    }
                    }
                    }
                    else
               {
                    echo "<script> document.getElementById('assocname').value = '';</script>";
                    echo "<script> document.getElementById('depart').value = '';</script>";
                    echo "<script> document.getElementById('empd').focus();</script>";
                    echo "<script> document.getElementById('startdate1').value = '".$_POST['StartDate']."';</script>";
                    echo "<script> document.getElementById('enddate1').value = '".$_POST['EndDate']."';</script>";
                    echo "<script>alert('( ✘ ) Employee ID Not Found !');</script>";
               }
               }
               }
               }
          }
     }
}//login to proceed
?>
</body>
</html>