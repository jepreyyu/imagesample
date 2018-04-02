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
     $cont = $_SESSION['cont'];

if($log=='')
{
  echo "<script>alert('( ✘ ) User is Not Login !');</script>";
          $_SESSION['log'] = ''; 
    include_once 'conn/mainpage.php';
}
elseif($log=='Yes' && $typ!='IssuedApprover')
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

     $item = odbc_exec($hris, "SELECT Employee_ID_Full, AssociateName, DepartmentSection, AssetType, Duration, Reason, StartDate, EndDate, Status from [dbo].[ITASSET_REQUESTFORM_SAMPLE1] WHERE ControlNumber='".$cont."' ");

          while ($row = odbc_fetch_array($item))
          {
               $emid = odbc_result($item,1);
               $anme = odbc_result($item,2);
               $dsec = odbc_result($item,3);
               $itco = odbc_result($item,4);
               $dura = odbc_result($item,5);
               $rson = odbc_result($item,6);
               $stda = odbc_result($item,7);
               $enda = odbc_result($item,8);
               $stat = odbc_result($item,9);
          }

     $iteminfo = odbc_exec($hris, "SELECT Description, SerialNumber, Model from [misInv].[dbo].[ItemMaster] where ItemCode='".$itco."'");
     while ($row = odbc_fetch_array($iteminfo))
          {
               $des = odbc_result($iteminfo,1);
               $ser = odbc_result($iteminfo,2);
               $mod = odbc_result($iteminfo,3);
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
               <input type='text' id='empd' name='employid' readonly placeholder='' autocomplete="off" value='<?php echo $emid; ?>' style='margin-top: 20px;  background-color: rgba(224,220,223,0.1); border-style: none; font-family: Courier New; font-size: 18px; text-align: center; color: blue; height: 30px; width: 315px;'><br>
          	<label style='background-color: rgba(224,220,223,0.4); margin-left: 10px; font-size: 20px; font-family: Courier New;'><b>Associate Name</b> &nbsp;&nbsp;&nbsp;&nbsp;:</label>&nbsp;&nbsp;
          	<input type='text' name='AssociateName' id='assocname' readonly value='<?php echo $anme; ?>' style='margin-top: 10px;  background-color: rgba(224,220,223,0.1); border-style: none; font-family: Courier New; font-size: 18px; text-align: center; color: blue; height: 30px; width: 315px;'><br>
          	<label style='background-color: rgba(224,220,223,0.4); margin-left: 10px; font-size: 20px; font-family: Courier New;'><b>Department/Section</b> : </label>
          	<input type='text' name='DepartmentSection' id='depart' readonly value='<?php echo $dsec; ?>' style='margin-top: 10px; background-color: rgba(224,220,223,0.1); border-style: none; font-family: Courier New; color:blue; font-size: 18px; text-align: center; height: 30px; width: 315px;'>
          </div>
          

          <div style='margin-left: 860px; margin-top: -140px; border-style: none none none solid; width:480px; height: 150px; margin-bottom: 2px;'>
               <label style='margin-left: 20px; font-size: 20px; font-family: Courier New;'><b>Request Number</b> : </label>&nbsp;&nbsp;
               <input type='text' id='control' readonly autocomplete="off" name='ControlNumber' value='<?php echo $cont; ?>' 
               style='background-color: rgba(224,220,223,0.1); color: red;border-color: none; border-style: none;margin-top: 40px; font-family: Courier New; font-size: 18px; height: 30px; width: 230px;'>
          	<br>
          	<label style='margin-left: 20px; font-size: 20px; font-family: Courier New;'><b>Date</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</label>
          	<input type='text' name='mmddyy' readonly value='<?php echo $d;?>' placeholder='MM-DD-YY' style='background-color: rgba(224,220,223,0.1); color: blue;margin-top: 10px; border-color: none; border-style: none;margin-left: 8px;font-family: Courier New; font-size: 18px; height: 30px; width: 230px;'>
          </div>

          <div style='border-style: double;'></div>

          <div style='width: 730px; height: 150px;'>
               <br>
               <label style='margin-left: 25px; font-size: 20px; font-family: Courier New;'><b>Item Code</b> &nbsp;: </label>&nbsp;<br>
               <input type='text' id='itemcode2' name='itemcode' readonly placeholder='Type Code' autocomplete="off" value='<?php echo $itco; ?>' style='text-align: center; border-radius: 5px; margin-top: 20px; border-color: white; border-style: solid;margin-left: 27px;font-family: Courier New; font-size: 18px; height: 35px; width: 213px; '>
               <input type='Submit' id='load2' name='load' value='.' title='load' style='visibility: hidden; border-color: skyblue; text-align: right; background-image: url("img/new/chk.png"); cursor: pointer; background-color: rgba(224,220,223,0.1); color: rgba(224,220,223,0.1); font-family: Courier New; font-size: 18px; height: 38px; width:38px; border-radius: 50%;'><br>
               <font style='margin-left: 32px; color: blue; font-size: 15px; font-family: Courier New;'>&nbsp;&nbsp;&nbsp;&nbsp;</font>


               <div style='height: 150px; width: 455px; margin-left: 290px; margin-top: -120px;'>
                    <br>
                    <label style='background-color: rgba(224,220,223,0.4); margin-left: 15px; font-size: 20px; font-family: Courier New;'><b>Description</b> : </label>&nbsp;
                    <input type='text' id='desc' name='description' readonly value='<?php echo $des; ?>' style='margin-top: 5px; color: blue; background-color: rgba(224,220,223,0.1); border-style: none; margin-left: 10px;font-family: Courier New; font-size: 18px; height: 25px; width: 220px;'>
                    <br>
                    <label style='background-color: rgba(224,220,223,0.4); margin-left: 15px; font-size: 20px; font-family: Courier New;'><b>Serial No.</b> &nbsp;: </label>&nbsp;
                    <input type='text' id='seri' name='serialno' readonly value='<?php echo $ser; ?>' style='margin-top: 8px; color: blue; background-color: rgba(224,220,223,0.1); border-style: none; margin-left: 10px;font-family: Courier New; font-size: 18px; height: 25px; width: 220px;'>
                    <br>
                    <label style='background-color: rgba(224,220,223,0.4); margin-left: 15px; font-size: 20px; font-family: Courier New;'><b>Model</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </label>&nbsp;
                    <input type='text' id='mode' name='model' value='<?php echo $mod; ?>' readonly style='margin-top: 8px; color: blue; background-color: rgba(224,220,223,0.1); border-style: none; margin-left: 10px;font-family: Courier New; font-size: 18px; height: 25px; width: 220px;'><br>
               </div><br><br>
          </div>

          <div style='width: 459px; height: 110px;border-style: none none none solid; margin-left: 733px; margin-top: -137px;'>
               <br>
               <label style='margin-left: 25px; font-size: 20px; font-family: Courier New;'><b> Request Type</b> &nbsp;: </label>&nbsp;&nbsp;<br><BR>
               <label class="container1" style='margin-left: 100px; font-size: 18px; font-family: Courier New;'>Permanent 
               <input type="radio" id='perm' name="Duration" disabled=true value="P" style='margin-left: 105px; margin-top: 25px;' <?php if($dura=='P') echo "checked"; ?> ><span class="checkmark1"></span></label>
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <label class="container1" style='margin-left: 10px; font-size: 18px; font-family: Courier New;'>Temporary 
               <input type='radio' id='temp' name='Duration' disabled=true value='T' style='margin-top:25px;' <?php if($dura=='T') echo "checked"; ?> ><span class="checkmark1"></span></label>
          </div><br>

          <div style='border-style: double;'></div>

          <div style=' height: 160px; width: 560px; '><br>
               <font style='margin-left: 25px; font-size: 20px; font-family: Courier New;'><b>Reason for Request</b> :</font><br>
               <textarea id='comm' readonly style='margin-left: 25px;margin-top: 10px; border-radius: 5px; resize: none; border-color: white; border-style: solid; border-style: solid; font-size: 15px;' name="comment" rows="5" cols="55" ><?php echo $rson;?></textarea>
          </div>

          <div style='width: 500px; margin-top: -125px; height: 110px; margin-left: 560px'>
               <label style='margin-left: 25px; font-size: 20px; font-family: Courier New;'><b>Start Date</b> &nbsp;&nbsp;&nbsp;: &nbsp;</label>&nbsp;
               <input type="text" autocomplete="off" id='startdate1' disabled=true style='text-align: center; margin-top: 16px; font-family: Courier New; font-size: 18px; border-color: white; border-style: solid;height: 32px; width: 210px; border-radius: 5px; background-color: white;' name="StartDate" value='<?php echo $stda; ?>' />
               <br>
               <label style='margin-left: 25px; font-size: 20px; font-family: Courier New;'><b>End Date</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;</label>&nbsp;
               <input type="text" autocomplete="off" id='enddate1' disabled=true style='border-color: white; border-radius: 5px; border-style: solid;text-align: center; margin-top: 15px; font-family: Courier New; font-size: 18px; height: 32px; width: 210px; background-color: white;' name="EndDate" value="<?php echo $enda;?>" /><br>
          </div>

          <div style='height: 150px; width: 300px; margin-left: 1035px; margin-top: -145px; '>
                    <input type='Submit' name='SubmitRequest' id='submitbtn' title='Submit and Validate Your Request' value='.' style='border-radius: 5px; border-color: skyblue; text-align: right; cursor: pointer; margin-top: 30px;color: skyblue; background-image: url("img/new/app.png"); margin-left: 30px; font-family: Courier New; font-size: 22px; height: 52px; width: 262px;'><br>
                    <input type='Submit' name='Logout' id='back2' title='Go Back to the Front Page' value='.' style='border-radius: 5px; border-color: skyblue; text-align: right; margin-top: 10px; cursor: pointer; color:skyblue; background-image: url("img/new/bk1.png"); margin-left: 30px; font-family: Courier New; font-size: 22px; height: 54px; width: 262px;'>
               <br><br>
          </div>
     </div>
</form>

<?php
include_once 'conn/connect.php';

if(isset($_POST['SubmitRequest']))
{
     if($stat=='Approved')
     {
          echo "<script>alert('( ✘ ) Item Code Already Approve !');</script>";
     }
     else
     {
          odbc_exec($hris, "UPDATE [dbo].[ITASSET_RequestForm_Sample1] set Status = 'Approved', Editable = 'No' where ControlNumber='".$cont."'");
          odbc_exec($hris, "UPDATE [misInv].[dbo].[itemmaster] set AllowCode = '".$dura."', RequestNumber = '".$cont."', InOutFlag='' where ItemCode='".$itco."'");
          echo "<script>alert('( ✔ ) Issued Request Successfully Approved .');</script>";
          echo "<script> document.getElementById('submitbtn').disabled = true;</script>";
          echo "<script> document.getElementById('back2').focus();</script>";
     }
}

}//login to proceed
?>
</body>
</html>
<?php
include_once('conn/footer.php');
?>