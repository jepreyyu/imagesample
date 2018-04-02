<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="img/favicon.ico"/>
</head>
<title>Issued Request Form</title>
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
    $dt2 = date('m-d-Y');
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

     $itemerr = $emperr = $duration1 = $reason = "";

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
          }
          if(empty($_POST['itemcode']))
          {
               $itemerr="!";
               $error=true;
          }
          else
          {
               $error=false;
          }
          if(empty($_POST['employid']))
          {
               $emperr="!";
               $error=true;
          }
          else
          {
               $error=false;
          }
          if(empty($_POST['Duration']))
          {
               $duration1="!";
               $error=true;
          }
          else
          {
               $error=false;
          }
     }

     if(!empty($_POST['Logout']))
     {
          header('location:OwnedBorrowed.php');
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

<body style='background-image: url("img/new/iss2.png"); background-color: white; background-repeat: no-repeat;' onkeydown="return (event.keyCode != 116)" onload="noBack();">
<form action='' method='post'>
     <div style=' margin-bottom: 10px; border-radius: 5px;margin-top: 5px;text-align: left; color: black; width: 500px; height: 50px; padding-top: 7px;'>
          <label style='font-size:20px; color: white; font-family: Courier New;'>&nbsp;<?php echo '<b>Name : </b>'.$name; ?></label><br>
          <label style='font-size:20px; color: white; font-family: Courier New;'>&nbsp;<?php echo '<b>Dept : </b>'.$dep; ?></label>
     </div>

     <div style='margin-left: -5px;background-color: rgba(224,220,223,0.7); background-repeat: all; border-radius: 5px; margin-top: 60px; height: 485px; border-style: solid; width: 1354px; border-color: skyblue;'>

          <div style='border-top: 3px;width:250px; height: 100px; padding-top: 5px;'><br><br><br>
          	<label style='margin-left: 25px;font-size: 20px; font-family: Courier New;'><b>Requested By</b>&nbsp;&nbsp;&rarr;&nbsp; </label><br><br>
          </div>

          <div style='margin-left: 255px;  margin-top: -103px; border-top: 3px; width:600px; height: 140px;'>
               <label style='background-color: rgba(224,220,223,0.4); margin-left: 10px; font-size: 20px; font-family: Courier New;'><b>Employee ID</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </label>&nbsp;&nbsp;
               <input type='text' id='empd' AUTOFOCUS name='employid' onkeypress="return checkQuote();" maxlength="10" placeholder='' autocomplete="off" value='<?php if(isset($_POST['load']) || isset($_POST['SubmitRequest']) || isset($_POST['load3'])) echo $_POST['employid']; ?>' style='margin-left: -10px;border-radius: 3px; margin-top: 15px; border-color: white; text-align: center; border-style: solid; font-family: Courier New; font-size: 18px; height: 30px; width: 290px;'><span class='error' style='animation: blink 1s linear infinite;font-family: Courier New;'><?php echo $emperr; ?></span>
               <input type='Submit' name='load3' value='.' style='border-style: solid; border-color: rgba(224,220,223,0.1);margin-top: 15px; text-align: right; background-color: rgba(224,220,223,0.1); color: rgba(224,220,223,0.1); font-family: Courier New; font-size: 1px; height: 1px; width:-5px;'><br>
          	<label style='background-color: rgba(224,220,223,0.4); margin-left: 10px; font-size: 20px; font-family: Courier New;'><b>Associate Name</b> &nbsp;&nbsp;&nbsp;&nbsp;:</label>&nbsp;&nbsp;
          	<input type='text' name='AssociateName' id='assocname' readonly value='<?php if(isset($_POST['load']) || isset($_POST['SubmitRequest']) || isset($_POST['load3']))echo $_POST['AssociateName']; ?>' style='margin-top: 10px;  background-color: rgba(224,220,223,0.1); border-style: none; font-family: Courier New; font-size: 18px; text-align: center; color: blue; height: 30px; width: 315px;'><br>
          	<label style='background-color: rgba(224,220,223,0.4); margin-left: 10px; font-size: 20px; font-family: Courier New;'><b>Department/Section</b> : </label>
          	<input type='text' name='DepartmentSection' id='depart' readonly value='<?php if(isset($_POST['load']) || isset($_POST['SubmitRequest']) || isset($_POST['load3']))echo $_POST['DepartmentSection']; ?>' style='margin-top: 10px; background-color: rgba(224,220,223,0.1); border-style: none; font-family: Courier New; color:blue; font-size: 18px; text-align: center; height: 30px; width: 315px;'>
          </div>
          

          <div style='margin-left: 860px; margin-top: -140px; border-style: none none none solid; width:480px; height: 150px; margin-bottom: 2px;'>
               <label style='margin-left: 20px; font-size: 20px; font-family: Courier New;'><b>Request Number</b> : </label>&nbsp;&nbsp;
               <input type='text' id='control' readonly autocomplete="off" name='ControlNumber' value='<?php if(isset($_POST['SubmitRequest']) && $_POST['comment']!="") echo $itarf.$cono.$iaarf.$cn.$count; elseif(isset($_POST['load'])) echo $itarf.$cono.$iaarf.$cn.'_'; else echo $itarf.$cono.$iaarf.$cn.'_'; ?>' 
               style='background-color: rgba(224,220,223,0.1); color: red;border-color: none; border-style: none;margin-top: 40px; font-family: Courier New; font-size: 18px; height: 30px; width: 230px;'>
          	<br>
          	<label style='margin-left: 20px; font-size: 20px; font-family: Courier New;'><b>Date</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</label>
          	<input type='text' name='mmddyy' readonly value='<?php echo $d;?>' placeholder='MM-DD-YY' style='background-color: rgba(224,220,223,0.1); color: blue;margin-top: 10px; border-color: none; border-style: none;margin-left: 8px;font-family: Courier New; font-size: 18px; height: 30px; width: 230px;'>
          </div>

          <div style='border-style: double;'></div>

          <div style='width: 730px; height: 150px;'>
               <br>
               <label style='margin-left: 25px; font-size: 20px; font-family: Courier New;'><b>Item Code</b> &nbsp;: </label>&nbsp;<br>
               <input type='text' id='itemcode2' name='itemcode' onkeydown='return (event.keyCode!=13)' placeholder='Type Code' autocomplete="off" onkeypress="return checkQuote();" value='<?php if(isset($_POST['load']))echo $_POST['itemcode']; elseif(isset($_POST['SubmitRequest'])) echo $_POST['itemcode'];?>' style='text-align: center; border-radius: 5px; margin-top: 20px; border-color: white; border-style: solid;margin-left: 27px;font-family: Courier New; font-size: 18px; height: 35px; width: 213px;'>
               <span class='error' style='animation: blink 1s linear infinite; font-family: Courier New;'><?php echo $itemerr; ?></span>
               <input type='Submit' id='load2' name='load' value='.' title='load' style=' border-color: skyblue; text-align: right; background-image: url("img/new/chk.png"); cursor: pointer; background-color: rgba(224,220,223,0.1); color: rgba(224,220,223,0.1); font-family: Courier New; font-size: 18px; height: 38px; width:38px; border-radius: 50%;'><br>
               <font style='margin-left: 32px; color: blue; font-size: 15px; font-family: Courier New;'>&nbsp;&nbsp;&nbsp;&nbsp;</font>


               <div style='height: 150px; width: 455px; margin-left: 290px; margin-top: -120px;'>
                    <br>
                    <label style='background-color: rgba(224,220,223,0.4); margin-left: 15px; font-size: 20px; font-family: Courier New;'><b>Description</b> : </label>&nbsp;
                    <input type='text' id='desc' name='description' readonly value='<?php if(isset($_POST['SubmitRequest'])) echo $_POST['description']; ?>' style='margin-top: 5px; color: blue; background-color: rgba(224,220,223,0.1); border-style: none; margin-left: 10px;font-family: Courier New; font-size: 18px; height: 25px; width: 220px;'>
                    <br>
                    <label style='background-color: rgba(224,220,223,0.4); margin-left: 15px; font-size: 20px; font-family: Courier New;'><b>Serial No.</b> &nbsp;: </label>&nbsp;
                    <input type='text' id='seri' name='serialno' readonly value='<?php if(isset($_POST['SubmitRequest'])) echo $_POST['serialno']; ?>' style='margin-top: 8px; color: blue; background-color: rgba(224,220,223,0.1); border-style: none; margin-left: 10px;font-family: Courier New; font-size: 18px; height: 25px; width: 220px;'>
                    <br>
                    <label style='background-color: rgba(224,220,223,0.4); margin-left: 15px; font-size: 20px; font-family: Courier New;'><b>Model</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </label>&nbsp;
                    <input type='text' id='mode' name='model' value='<?php if(isset($_POST['SubmitRequest'])) echo $_POST['model']; ?>' readonly style='margin-top: 8px; color: blue; background-color: rgba(224,220,223,0.1); border-style: none; margin-left: 10px;font-family: Courier New; font-size: 18px; height: 25px; width: 220px;'><br>
               </div><br><br>
          </div>

          <div style='width: 459px; height: 110px;border-style: none none none solid; margin-left: 733px; margin-top: -137px;'>
               <br>
               <label style='margin-left: 25px; font-size: 20px; font-family: Courier New;'><b> Request Type</b> &nbsp;: </label>&nbsp;&nbsp;<br><BR>
               <label class="container1" style='margin-left: 100px; font-size: 18px; font-family: Courier New;'>Permanent 
               <input type="radio" id='perm' name="Duration" value="P" onclick='dis()' style='margin-left: 105px; margin-top: 25px;' <?php if (isset($Duration) && $Duration=="P") echo "checked"; elseif(isset($_POST['SubmitRequest']) && empty($_POST['Duration'])) echo "unchecked"; elseif(isset($_POST['SubmitRequest']) && $_POST['Duration']=="P") echo "checked"; ?> ><span class="checkmark1"></span></label>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <label class="container1" style='margin-left: 10px; font-size: 18px; font-family: Courier New;'>Temporary 
               <input type='radio' id='temp' name='Duration' value='T' onclick='ena()' style='margin-top:25px;' <?php if (isset($Duration) && $Duration=="T") echo "checked"; elseif(isset($_POST['SubmitRequest']) && empty($_POST['Duration'])) echo "unchecked"; elseif(isset($_POST['SubmitRequest']) && $_POST['Duration']=="T") echo "checked"; ?> ><span class="checkmark1"></span></label>
               <span class='error' style='animation: blink 1s linear infinite; font-family: Courier New;'><?php echo $duration1; ?></span>
          </div><br>

          <div style='border-style: double;'></div>

          <div style=' height: 160px; width: 560px; '><br>
               <font style='margin-left: 25px; font-size: 20px; font-family: Courier New;'><b>Reason for Request</b> :</font><br>
               <textarea id='comm' style='margin-left: 25px;margin-top: 10px; border-radius: 5px; resize: none; border-color: white; border-style: solid; border-style: solid; font-size: 15px;' onkeydown="return (event.keyCode!=13);" onkeypress="return checkQuote();" name="comment" rows="5" cols="55" ><?php if(isset($_POST['load'])) echo $_POST['comment']; elseif(isset($_POST['SubmitRequest'])) echo $_POST['comment'];?></textarea>
               <span class='error' style='font-size: 18px; animation: blink 1s linear infinite;'><?php echo $reason; ?></span>
          </div>

          <div style='width: 500px; margin-top: -125px; height: 110px; margin-left: 560px'>
               <label style='margin-left: 25px; font-size: 20px; font-family: Courier New;'><b>Start Date</b> &nbsp;&nbsp;&nbsp;: &nbsp;</label>&nbsp;
               <input type="text" autocomplete="off" id='startdate1' onkeydown="return (event.keyCode!=13);" onkeypress="return checkQuote();" onchange="checkStartDate()" style='text-align: center; margin-top: 16px; font-family: Courier New; font-size: 18px; border-color: white; border-style: solid;height: 32px; width: 210px; border-radius: 5px; background-color: white;' name="StartDate" value='<?php if(isset($_POST['SubmitRequest']) && !isset($_POST['Duration'])) echo ''; elseif(isset($_POST['SubmitRequest']) && $_POST['Duration']=='P') echo $dt2; ?>' />
               <br>
               <label style='margin-left: 25px; font-size: 20px; font-family: Courier New;'><b>End Date</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;</label>&nbsp;
               <input type="text" autocomplete="off" id='enddate1' onkeydown="return (event.keyCode!=13);" onkeypress="return checkQuote();" onchange="checkEndDate()" style='border-color: white; border-radius: 5px; border-style: solid;text-align: center; margin-top: 15px; font-family: Courier New; font-size: 18px; height: 32px; width: 210px; background-color: white;' name="EndDate" value="<?php if(isset($_POST['SubmitRequest']) && !isset($_POST['Duration'])) echo ''; elseif(isset($_POST['SubmitRequest']) && $_POST['Duration']=='P') echo '12-31-9999';?>" /><br>
          </div>

          <div style='height: 150px; width: 300px; margin-left: 1035px; margin-top: -145px; '>
                    <input type='Submit' name='SubmitRequest' id='submitbtn' title='Submit and Validate Your Request' value='.' style='border-radius: 5px; border-color: skyblue; text-align: right; cursor: pointer; margin-top: 30px;color: skyblue; background-image: url("img/new/sm3.png"); margin-left: 30px; font-family: Courier New; font-size: 22px; height: 52px; width: 262px;'><br>
                    <input type='Submit' name='Logout' id='back2' title='Go Back to the Front Page' value='.' style='border-radius: 5px; border-color: skyblue; text-align: right; margin-top: 10px; cursor: pointer; color:skyblue; background-image: url("img/new/bk1.png"); margin-left: 30px; font-family: Courier New; font-size: 22px; height: 54px; width: 262px;'>
               <br><br>
          </div>
<!--
<script>
function en(){
var input = document.getElementById("itemcode2");
input.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
        document.getElementById("load2").click();
    }
});}
</script> -->

<script type="text/javascript">
function EnterEvent(e) {
        if (e.keyCode == 13) {
            document.getElementById(load2).click();
        }
    }
</script>

<script type="text/javascript">
function checkStartDate() {

     var selectedText = document.getElementById('startdate1').value;
     var selectedDate = new Date(selectedText);
     var now = new Date();
     now.setDate(now.getDate() - 1);

     if (selectedDate < now) {
          alert("( ✘ ) Start Date Must Beyond or Equal to the Current Date!");
          document.getElementById('enddate1').disabled = true; 
          document.getElementById('startdate1').value = '';
     }
     else
     {
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
          alert("( ✘ ) End Date Must Beyond The Start Date !");
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
function dis() //permanent
{ 
     var today = new Date();
     var dd = today.getDate();
     var mm = today.getMonth()+1; //January is 0!
     
     var yyyy = today.getFullYear();
     if(dd<10){
         dd='0'+dd;
     } 
     if(mm<10){
         mm='0'+mm;
     } 
     var today = mm+'/'+dd+'/'+yyyy;
     
     document.getElementById('enddate1').disabled = true; 
     document.getElementById('startdate1').disabled = true; 
     document.getElementById('startdate1').value = today;
     document.getElementById('enddate1').value = '12/31/9999';
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

     if(!empty($_POST['load3']))
     {
          if(empty($_POST['employid']))
          {
               echo "<script>alert('( ✘ ) Please Provide Employee ID !');</script>";
               echo "<script> document.getElementById('startdate1').value = '".$_POST['StartDate']."';</script>";
               echo "<script> document.getElementById('enddate1').value = '".$_POST['EndDate']."';</script>";
               echo "<script> document.getElementById('assocname').value = '';</script>";
               echo "<script> document.getElementById('depart').value = '';</script>";
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
                         
                         $name1 = $ln.", ".$fn." ".$mn;
                         if($dep!=$dm)
                         {
                              echo "<script>alert('( ✘ ) This Transaction is Not Allowed !');</script>";
                              echo "<script> document.getElementById('empd').focus();</script>";
                         }
                         else
                         {
                              echo "<script> document.getElementById('assocname').value = '".$name1."';</script>";
                              echo "<script> document.getElementById('depart').value = '".$dm."';</script>";
                              echo "<script> document.getElementById('itemcode2').focus();</script>";
                              echo "<script> document.getElementById('empd').readOnly = true;</script>";
                              echo "<script> document.getElementById('empd').style.color = 'blue';</script>";
                              echo "<script> document.getElementById('itemcode2').disabled = false;</script>";
                              echo "<script> document.getElementById('startdate1').disabled = false;</script>";
                              echo "<script> document.getElementById('enddate1').disabled = false;</script>";
                              echo "<script> document.getElementById('perm').disabled = false;</script>";
                              echo "<script> document.getElementById('temp').disabled = false;</script>";
                              echo "<script> document.getElementById('comm').disabled = false;</script>";
                              echo "<script> document.getElementById('submitbtn').disabled = false;</script>";
                         }
                    }
               }
               else
               {
                    echo "<script>alert('( ✘ ) Employee ID Not Found !');</script>";
                    echo "<script> document.getElementById('assocname').value = '';</script>";
                    echo "<script> document.getElementById('empd').focus();</script>";
               }
          }
     }

     if(!empty($_POST['SubmitRequest']))
     {
          echo "<script> document.getElementById('control').value = '".$itarf.$cono.$iaarf.$cn."_';</script>";

          if(empty($_POST['comment']) && empty($_POST['Duration']) && empty($_POST['itemcode']) || 
             empty($_POST['comment']) && empty($_POST['Duration']) && !empty($_POST['itemcode']) || 
             empty($_POST['comment']) && !empty($_POST['Duration']) && empty($_POST['itemcode']) || 
             !empty($_POST['comment']) && empty($_POST['Duration']) && empty($_POST['itemcode']) || 
             !empty($_POST['comment']) && !empty($_POST['Duration']) && empty($_POST['itemcode']) || 
             empty($_POST['comment']) && !empty($_POST['Duration']) && !empty($_POST['itemcode']) || 
             !empty($_POST['comment']) && empty($_POST['Duration']) && !empty($_POST['itemcode']))
          {
               echo "<script>alert('( ✘ ) Complete Information Required !');</script>";
               if(!empty($_POST['Duration']))
               {
                    if($_POST['Duration']=='T')
                    {
                         echo "<script> document.getElementById('startdate1').value = '".$_POST['StartDate']."';</script>";
                         echo "<script> document.getElementById('enddate1').value = '".$_POST['EndDate']."';</script>";
                    }
                    elseif($_POST['Duration']=='P')
                    {
                        echo "<script> document.getElementById('startdate1').disabled = true;</script>";
                        echo "<script> document.getElementById('enddate1').disabled = true;</script>";
                    }
               }
               

               if(empty($_POST['employid']))
               {
                    echo "<script> document.getElementById('empd').readOnly = false;</script>";
               }
               else
               {
                    include_once 'conn/connecthris.php';
                    $que = odbc_exec($hris2, "SELECT a.Employee_LastName, a.Employee_FirstName, a.Employee_MiddleName, b.DEPNME FROM VIEW_HRIS_EmployeeName as a inner join VIEW_HRIS_EmploymentInfo as b on a.Employee_ID = b.Employee_ID where a.Employee_ID = '".$_POST['employid']."'");
                    if (!$que) 
                    {
                        exit();
                    }
                    elseif(odbc_num_rows($que) > 0)
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
                                   echo "<script>alert('( ✘ ) This Transaction is Not Allowed !');</script>";
                              }
                              else
                              {
                                   echo "<script> document.getElementById('assocname').value = '".$name2."';</script>";
                                   echo "<script> document.getElementById('depart').value = '".$dm."';</script>";
                                   echo "<script> document.getElementById('empd').readOnly = true;</script>";
                                   echo "<script> document.getElementById('itemcode2').focus();</script>";
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
               if(!empty($_POST['Duration']) && !empty($_POST['itemcode']) && !empty($_POST['comment']))
               {
                    if($_POST['Duration']=="T" && empty($_POST['StartDate']) && empty($_POST['EndDate']) || 
                       $_POST['Duration']=="T" && !empty($_POST['StartDate']) && empty($_POST['EndDate']) || 
                       $_POST['Duration']=="T" && empty($_POST['StartDate']) && !empty($_POST['EndDate']))
                    {
                        echo "<script>alert('( ✘ ) Your Request is for Temporary Please Select Your Start Date and End Date of Usage !');</script>";
                    }
                    elseif($_POST['Duration']=="P")
                    {
                         $start = $dt; $endd = '9999-12-31';

                         $empid1 = substr($_POST['employid'],6);
                         $emplid = odbc_exec($hris, "SELECT EmpNumber from [misInv].[dbo].[ItemMaster] where ItemCode = '".$_POST['itemcode']."'");

                         if (!$emplid) 
                         {
                              exit();
                         }
                         elseif(odbc_num_rows($emplid) > 0)
                         {
                              while ($row = odbc_fetch_array($emplid))
                              {
                                   $employid = odbc_result($emplid,1);

                                   if($employid==$empid1)
                                   {
                                        echo "<script> document.getElementById('control').style.color = 'blue';</script>";

                                        $insert = odbc_exec($hris, "INSERT INTO [dbo].[ITASSET_RequestForm_Sample1] (AssociateName, DepartmentSection, ControlNumber, AssetType, Duration, StartDate, EndDate, Reason, DateSubmitted, TimeSubmitted, Status, Editable, Employee_ID, Employee_ID_Full, RequestType, RequestedBy) VALUES ('".$_POST['AssociateName']."','".$_POST['DepartmentSection']."','".$itarf.$cono.$iaarf.$cn.$count."','".$_POST['itemcode']."','".$_POST['Duration']."','".$start."','".$endd."','".$_POST['comment']."','".$dt."','".$h."','Entered','Yes',".$empid1.",'".$_POST['employid']."','Issued','".$name."')");

                                        $msg='( ✔ ) Hi, '.$_POST['AssociateName'].' .\n( ✔ ) Your Request Successfully Submitted !';
                                        echo "<script>alert('".$msg."');</script>";

                                        echo "<script> document.getElementById('control').value = '".$itarf.$cono.$iaarf.$cn.$count."';</script>";
                                        echo "<script> document.getElementById('submitbtn').disabled = true;</script>";
                                        echo "<script> document.getElementById('itemcode2').readOnly = true;</script>";
                                        echo "<script> document.getElementById('comm').readOnly = true;</script>";
                                        echo "<script> document.getElementById('perm').disabled = true;</script>";
                                        echo "<script> document.getElementById('temp').disabled = true;</script>";
                                        echo "<script> document.getElementById('load2').disabled = true;</script>";
                                        echo "<script> document.getElementById('startdate1').value = '".$dt."';</script>";
                                        echo "<script> document.getElementById('enddate1').value = '".$endd."';</script>";
                                        echo "<script> document.getElementById('startdate1').disabled = true;</script>";
                                        echo "<script> document.getElementById('enddate1').disabled = true;</script>";
                                        echo "<script> document.getElementById('back2').focus();</script>";
                                        echo "<script> document.getElementById('back2').style.border-color = 'red'</script>";
                                        echo "<script> document.getElementById('empd').readOnly = true;</script>";
                                   }
                                   else
                                   {
                                        echo "<script>alert('( ✘ ) Item is Not Owned By This Employee !');</script>";
                                        echo "<script> document.getElementById('itemcode2').value = '';</script>";
                                        echo "<script> document.getElementById('startdate1').value = '".$dt."';</script>";
                                        echo "<script> document.getElementById('enddate1').value = '".$endd."';</script>";
                                        echo "<script> document.getElementById('empd').readOnly = true;</script>";
                                        echo "<script> document.getElementById('startdate1').disabled = true;</script>";
                                        echo "<script> document.getElementById('enddate1').disabled = true;</script>";
                                        echo "<script> document.getElementById('desc').value = '';</script>";
                                        echo "<script> document.getElementById('seri').value = '';</script>";
                                        echo "<script> document.getElementById('mode').value = '';</script>";
                                        echo "<script> document.getElementById('itemcode2').focus();</script>";
                                   }
                              }
                         }
                         else
                         {               
                              echo "<script>alert('( ✘ ) Item is Not in Item Master !');</script>";
                              echo "<script> document.getElementById('itemcode2').value = '';</script>";
                              echo "<script> document.getElementById('startdate1').value = '".$dt."';</script>";
                              echo "<script> document.getElementById('enddate1').value = '".$endd."';</script>";
                              echo "<script> document.getElementById('empd').readOnly = true;</script>";
                              echo "<script> document.getElementById('startdate1').disabled = true;</script>";
                              echo "<script> document.getElementById('enddate1').disabled = true;</script>";
                              echo "<script> document.getElementById('desc').value = '';</script>";
                              echo "<script> document.getElementById('seri').value = '';</script>";
                              echo "<script> document.getElementById('mode').value = '';</script>";
                              echo "<script> document.getElementById('itemcode2').focus();</script>";
                         }
                    }
                    else
                    {
                         $start = $_POST['StartDate']; $endd = $_POST['EndDate'];
                         $empid1 = substr($_POST['employid'],6);
                         $emplid = odbc_exec($hris, "SELECT EmpNumber,Username from [misInv].[dbo].[ItemMaster] where ItemCode = '".$_POST['itemcode']."'");

                         if (!$emplid) 
                         {
                              exit();
                         }
                         else if(odbc_num_rows($emplid) > 0)
                         {
                              while ($row = odbc_fetch_array($emplid))
                              {
                                   $employid = odbc_result($emplid,1);
                                   $username = odbc_result($emplid,2);

                                   if($employid==$empid1)
                                   {
                                        $insert = odbc_exec($hris, "INSERT INTO [dbo].[ITASSET_RequestForm_Sample1] (AssociateName, DepartmentSection, ControlNumber, AssetType, Duration, StartDate,  EndDate, Reason, DateSubmitted, TimeSubmitted,Status, Editable, Employee_ID, Employee_ID_Full, RequestType, RequestedBy) VALUES ('".$_POST['AssociateName']."','".$_POST['DepartmentSection']."','".$itarf.$cono.$iaarf.$cn.$count."','".$_POST['itemcode']."','".$_POST['Duration']."','".$start."','".$endd."','".$_POST['comment']."','".$dt."','".$h."','Entered','Yes',".$empid1.",'".$_POST['employid']."','Issued','".$name."')");

                                        echo "<script> document.getElementById('control').style.color = 'blue';</script>";
                                        $msg='( ✔ ) Hi, '.$_POST['AssociateName'].' .\n( ✔ ) Your Request Successfully Submitted !';
                                        echo "<script>alert('".$msg."');</script>";

                                        echo "<script> document.getElementById('control').value = '".$itarf.$cono.$iaarf.$cn.$count."';</script>";
                                        echo "<script> document.getElementById('submitbtn').disabled = true;</script>";
                                        echo "<script> document.getElementById('itemcode2').readOnly = true;</script>";
                                        echo "<script> document.getElementById('comm').readOnly = true;</script>";
                                        echo "<script> document.getElementById('perm').disabled = true;</script>";
                                        echo "<script> document.getElementById('temp').disabled = true;</script>";
                                        echo "<script> document.getElementById('load2').disabled = true;</script>";
                                        echo "<script> document.getElementById('startdate1').disabled = true;</script>";
                                        echo "<script> document.getElementById('enddate1').disabled = true;</script>";
                                        echo "<script> document.getElementById('startdate1').value = '".$_POST['StartDate']."';</script>";
                                        echo "<script> document.getElementById('enddate1').value = '".$_POST['EndDate']."';</script>";
                                        echo "<script> document.getElementById('back2').focus();</script>";
                                        echo "<script> document.getElementById('empd').readOnly = true;</script>";
                                   }
                                   else
                                   {
                                        echo "<script>alert('( ✘ ) Item is Not Owned By This Employee !');</script>";
                                        echo "<script> document.getElementById('itemcode2').value = '';</script>";
                                        echo "<script> document.getElementById('startdate1').value = '".$_POST['StartDate']."';</script>";
                                        echo "<script> document.getElementById('enddate1').value = '".$_POST['EndDate']."';</script>";
                                        echo "<script> document.getElementById('empd').readOnly = true;</script>";
                                        echo "<script> document.getElementById('desc').value = '';</script>";
                                        echo "<script> document.getElementById('seri').value = '';</script>";
                                        echo "<script> document.getElementById('mode').value = '';</script>";
                                        echo "<script> document.getElementById('itemcode2').focus();</script>";
                                   }
                              }
                         }
                         else
                         {               
                              echo "<script>alert('( ✘ ) Item is Not in Item Master !');</script>";
                              echo "<script> document.getElementById('itemcode2').value = '';</script>";
                              //echo "<script> document.getElementById('errmess').value = '';</script>";
                              echo "<script> document.getElementById('startdate1').value = '".$_POST['StartDate']."';</script>";
                              echo "<script> document.getElementById('enddate1').value = '".$_POST['EndDate']."';</script>";
                              echo "<script> document.getElementById('empd').readOnly = true;</script>";
                              echo "<script> document.getElementById('desc').value = '';</script>";
                              echo "<script> document.getElementById('seri').value = '';</script>";
                              echo "<script> document.getElementById('mode').value = '';</script>";
                              echo "<script> document.getElementById('itemcode2').focus();</script>";
                         }
                    }
               }
          }
     }

     if(!empty($_POST['load']))
     {
          if(empty($_POST['employid']))
          {
               echo "<script> document.getElementById('empd').readOnly = false;</script>";
               echo "<script>alert('( ✘ ) Input The Employee ID First !');</script>";
               echo "<script> document.getElementById('itemcode2').value = '';</script>";
               echo "<script> document.getElementById('empd').focus();</script>";
          }
          else
          {
               include_once 'conn/connecthris.php';
                    $que = odbc_exec($hris2, "SELECT a.Employee_LastName, a.Employee_FirstName, a.Employee_MiddleName, b.DEPNME FROM VIEW_HRIS_EmployeeName as a inner join VIEW_HRIS_EmploymentInfo as b on a.Employee_ID = b.Employee_ID where a.Employee_ID = '".$_POST['employid']."'");
                    if (!$que) 
                    {
                        exit();
                    }
                    elseif(odbc_num_rows($que) > 0)
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
                                   echo "<script>alert('( ✘ ) This Transaction is Not Allowed !');</script>";
                                   echo "<script> document.getElementById('empd').focus();</script>";
                              }
                              else
                              {
                                   echo "<script> document.getElementById('assocname').value = '".$name2."';</script>";
                                   echo "<script> document.getElementById('depart').value = '".$dm."';</script>";
                                   echo "<script> document.getElementById('empd').readOnly = true;</script>";
                                   echo "<script> document.getElementById('itemcode2').focus();</script>";

                              if(empty($_POST['itemcode']))
                              {
                                   echo "<script>alert('( ✘ ) Please Provide Item Code !');</script>";
                                   echo "<script> document.getElementById('startdate1').value = '".$_POST['StartDate']."';</script>";
                                   echo "<script> document.getElementById('enddate1').value = '".$_POST['EndDate']."';</script>";
                                   echo "<script> document.getElementById('empd').readOnly = true;</script>";
                                   echo "<script> document.getElementById('itemcode2').focus();</script>";
                              }
                              else
                              {
                                   $desc = odbc_exec($hris, "SELECT Description, SerialNumber, Model FROM [misInv].[dbo].[ItemMaster] WHERE ItemCode = '".$_POST['itemcode']."'");
                              
                                   if (!$desc) 
                                   {
                                        exit();
                                   }
                                   else if(odbc_num_rows($desc) > 0)
                                   {
                                        while ($row = odbc_fetch_array($desc))
                                        {
                                             $des = odbc_result($desc,1);
                                             $ser = odbc_result($desc,2);
                                             $mod = odbc_result($desc,3);
                         
                                             $empid1 = substr($_POST['employid'],6);
                                             $emplid = odbc_exec($hris, "SELECT EmpNumber,Username from [misInv].[dbo].[ItemMaster] where ItemCode = '".$_POST['itemcode']."'");
                    
                                             if (!$emplid) 
                                             {
                                                  exit();
                                             }
                                             else if(odbc_num_rows($emplid) > 0)
                                             {
                                                  while ($row = odbc_fetch_array($emplid))
                                                  {
                                                       $employid = odbc_result($emplid,1);
                                                       $username = odbc_result($emplid,2);
                    
                                                       if($employid==$empid1)
                                                       {
                                                            $itemc = odbc_exec($hris, "SELECT AssetType, DateSubmitted, Status, RequestType from [dbo].[ITASSET_RequestForm_Sample1] where AssetType = '".$_POST['itemcode']."'");
                    
                                                            if (!$itemc) 
                                                            {
                                                                 exit();
                                                            }
                                                            else if(odbc_num_rows($itemc) > 0)
                                                            {
                                                                 while ($row = odbc_fetch_array($itemc))
                                                                 {                

                                                                      $status = odbc_result($itemc,3);
                                                                      $reqtyp = odbc_result($itemc,4);
                                                                      
                                                                      if($status=='Approved')
                                                                      {
                                                                           if($reqtyp=='Issued')
                                                                           {
                                                                                echo "<script>alert('( ✘ ) You Are Already Authorized to Bring Out This Item !');</script>";
                                                                           }
                                                                           else
                                                                           {
                                                                                echo "<script>alert('( ✘ ) This item is already issued to the borrower !');</script>";
                                                                           }
                                                                                echo "<script> document.getElementById('desc').value = '';</script>";
                                                                                echo "<script> document.getElementById('seri').value = '';</script>";
                                                                                echo "<script> document.getElementById('mode').value = '';</script>";
                                                                                echo "<script> document.getElementById('itemcode2').focus();</script>";
                                                                      }
                                                                      elseif($status=='Entered')
                                                                      {
                                                                           echo "<script>alert('( ✘ ) Pending Request For Approval !');</script>";
                                                                           echo "<script> document.getElementById('itemcode2').focus();</script>";
                                                                           echo "<script> document.getElementById('desc').value = '';</script>";
                                                                           echo "<script> document.getElementById('seri').value = '';</script>";
                                                                           echo "<script> document.getElementById('mode').value = '';</script>";
                                                                           echo "<script> document.getElementById('itemcode2').focus();</script>";
                                                                      }
                                                                 }     
                                                            }
                                                            else
                                                            {
                                                                 echo "<script> document.getElementById('desc').value = '".$des."';</script>";
                                                                 echo "<script> document.getElementById('seri').value = '".$ser."';</script>";
                                                                 echo "<script> document.getElementById('mode').value = '".$mod."';</script>";
                                                                 echo "<script> document.getElementById('comm').focus();</script>";
                                                                 echo "<script> document.getElementById('empd').readOnly = true;</script>";
                                                            }
                                                       }
                                                       else
                                                       {
                                                            echo "<script>alert('( ✘ ) Item Not Owned By this Employee !');</script>";
                                                            echo "<script> document.getElementById('empd').readOnly = true;</script>";
                                                            echo "<script> document.getElementById('desc').value = '';</script>";
                                                            echo "<script> document.getElementById('seri').value = '';</script>";
                                                            echo "<script> document.getElementById('mode').value = '';</script>";
                                                            echo "<script> document.getElementById('itemcode2').focus();</script>";
                                                       }
                                                  }
                                             }
                                        }
                                   }
                                   else
                                   {
                                        echo "<script>alert('( ✘ ) Item is Not in Item Master !');</script>";
                                        echo "<script> document.getElementById('empd').readOnly = true;</script>";
                                        echo "<script> document.getElementById('desc').value = '';</script>";
                                        echo "<script> document.getElementById('seri').value = '';</script>";
                                        echo "<script> document.getElementById('mode').value = '';</script>";
                                        echo "<script> document.getElementById('itemcode2').focus();</script>";
                                   }
                              }
                         }
                    }
               }
               else
               {
                    echo "<script>alert('( ✘ ) Employee ID Not Found !');</script>";
                    echo "<script> document.getElementById('empd').readOnly = false;</script>";
                    echo "<script> document.getElementById('empd').focus();</script>";
                    echo "<script> document.getElementById('itemcode2').value = '';</script>";
               }
          }
     }
}//login to proceed
?>
</body>
</html>
<?php
include_once('conn/footer.php');
?>