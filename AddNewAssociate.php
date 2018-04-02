<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="img/favicon.ico"/>
</head>
<title>Add New User</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php
    include_once 'conn/connect.php';
    session_start();
    $ul = $_SESSION['uid'];
    $name = $_SESSION['asn'];
    $dep = $_SESSION['dep'];
    $log = $_SESSION['log'];
     $typ = $_SESSION['typ'];

if($log=='')
{
  echo "<script>alert('( ✘ ) User is Not Login !');</script>";
          $_SESSION['log'] = ''; 
  include_once 'conn/mainpage.php';
}
elseif($log=='Yes' && $typ!='Admin')
{
     echo "<script>alert('User is not Login!');</script>";
          $_SESSION['log'] = ''; 
  include_once 'conn/mainpage.php';
}
else
{

     date_default_timezone_set('Asia/Manila');
     $dt = date('Y-m-d');
     $d  = date('M. d, Y/D');
     $h  = date('H:i:s');
     $po = date('mdy-His');

     $empiderr = $assnameerr = $deperr = $emailerr = "";

     if(!empty($_POST['Back']))
     {
          header('location: AdminHome.php');
     }

?>

<style>
.error {
  color: red;
  font-size: 18px;
  font-family: courier new;
}
</style>

<script type="text/javascript">
        window.history.forward();
        function noBack() {
            window.history.forward();
        }
</script>

<body style='background-image: url("img/new/main4.png"); background-color: white; background-repeat: no-repeat;' onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">
     <form action='' method='post'>
          <div style=' margin-bottom: 10px; border-radius: 5px;margin-top: 5px;text-align: left; color: black; width: 500px; height: 50px; padding-top: 7px;'>
                    <!--<label style='font-size:20px; font-family: Courier New;'>&nbsp;<?php //echo '<b>Name : </b>'.$name; ?></label><br>
                    <label style='font-size:20px; font-family: Courier New;'>&nbsp;<?php //echo '<b>Dept : </b>'.$dep; ?></label> -->
               </div>

          <div style='margin-top: 54px;border-color: skyblue; background-color:rgba(123,210,219,0.5);border-style: solid; height: 490px; width: 1355px; border-radius: 5px; margin-left: -5px'>
               <div style='margin-left:1000px; margin-top: 25px; height: 60px; width: 335px;'>
               <input type='Submit' name='Back' value='.' title='Back' style='background-image: url("img/new/bk2.png"); border-radius: 10px; margin-left: 70px; cursor: pointer; border-color:skyblue; color: skyblue; text-align: right; font-family: Courier New; font-size: 22px; height: 54px; width: 262px;'>
          </div>
<div style='background-image: url("img/wp22.png"); border-radius: 5px; height: 390px; margin-top: 10px;'><br>
<label style='margin-left: 5px;color: white;font-size: 20px; font-family: Courier New;'> <b> Note :</b> Please Provide Correct Information in Each Field.</label><br><br><br>
<label style='color: black;margin-left: 150px; font-size: 20px; font-family: Courier New;'>Employee ID No. &nbsp;&nbsp;&nbsp;:</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type='text' id='eid' maxlength="10" autocomplete='off' onkeydown='return (event.keyCode!=13)' onclick='load3()' placeholder='( 10 Characters )' autofocus name='empid' title='Type Employee ID Number' value='<?php if(isset($_POST['load'])) echo $_POST['empid']; elseif(isset($_POST['addsecurity'])) echo $_POST['empid']; ?>' style='border-style: solid; border-radius: 5px;border-color: silver;text-align: center;font-family: Courier New; font-size: 18px; height: 30px; width: 300px;'>
            <input type='Submit' id='load2' name='load' value='.' title='Load' style='border-color: blue; cursor: pointer; text-align: right; background-image: url("img/new/chk.png");background-color: rgba(224,220,223,0.1); color: rgba(224,220,223,0.1); font-family: Courier New; font-size: 18px; height: 38px; width:38px; border-radius: 50%;'><br>
            <span class='error'><?php echo $empiderr; ?></span>
            <!--<font style='margin-left: 10px; color: blue; font-size: 15px; font-family: Courier New;'>(&nbsp;&nbsp;Then Press Enter&nbsp;&nbsp;)</font>--><br><br>

<?php

include_once 'conn/connecthris.php';
if(!empty($_POST['load']))
{
    if((strlen($_POST['empid'])) < 10 )
    {
        if(empty($_POST['empid']))
        {
            echo "<script>alert('( ✘ ) Please Provide Employee ID !');</script>";
        }
        else
        {
            echo "<script>alert('( ✘ ) Employee ID Must be 10 Characters !');</script>";
        }
    }
    elseif((strlen($_POST['empid'])) == 10 )
    {
          $empid = trim($_POST['empid']); 
          if(empty($empid))
          {
              echo "<script>alert('( ✘ ) Please Fill The Employee ID No !');</script>";
          }
          else
          {
          $empinfo = odbc_exec($hris2, "SELECT a.Employee_LastName
           ,a.Employee_FirstName
           ,a.Employee_MiddleName
            ,b.DEPNME
            FROM VIEW_HRIS_EmployeeName as a inner join 
            VIEW_HRIS_EmploymentInfo as b on
            a.Employee_ID = b.Employee_ID where a.Employee_ID = '".$_POST['empid']."'");
     
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
                    $mn = odbc_result($empinfo,3);
                    $dm = odbc_result($empinfo,4);
?>
     <div style='height: 260px;'>
          <label style='color: black;margin-left: 150px; font-size: 20px; font-family: Courier New;'>Associate Name &nbsp;&nbsp;&nbsp;&nbsp;:</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type='text' readonly autocomplete='off' name='assname' title='Type Associate Name' value='<?php echo $ln.", ".$fn." ".$mn?>' style='border-color: silver; border-style: solid; text-align: center; margin-top: 10px; border-radius: 5px; font-family: Courier New; font-size: 16px; height: 30px; width: 300px;'>
            <br><br>
          <label style='color: black; margin-left: 150px; font-size: 20px; font-family: Courier New;'>Department &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type='text' readonly autocomplete='off' name='department' title='Type Associate Deaprtment' value='<?php echo $dm?>' style='border-color: silver;text-align: center; border-style: solid; margin-top: 10px; border-radius: 5px; font-family: Courier New; font-size: 16px; height: 30px; width: 300px;'>
            <br><br><br>          
          <input type='Submit' name='addassociate' id='saveemp' title='Save and Validate New Associate Records' value='Add Associate' style='border-color: skyblue; border-radius: 5px; text-align: center; margin-left: 455px; cursor: pointer; background-image: url("img/NEW/MAIN2.png"); font-family: Times New Roman; font-size: 25px; height: 60px; width: 257px; color: white;'>
     </div>
<?php     
                    echo "<script> document.getElementById('saveemp').focus();</script>";
               }
          }
          else
          {
               $control = odbc_exec($hris, "select Employee_ID from [dbo].[ITASSET_USERS] where Employee_ID='".$_POST['empid']."'");
     
               if(odbc_num_rows($control) > 0)
               {
                    echo "<script>alert('( ✘ ) The Security Employee ID No (".$_POST['empid'].") already Exist! Please Input a Unique ID No.');</script>";
               }
               else
               {
                    echo "<script>alert('( ✘ ) The Employee ID not exist. It will be Added as Security Guard');</script>";
               
               ?>
               <div style='height: 260px;'>
          <label style='color: black;margin-left: 150px; font-size: 20px; font-family: Courier New;'>Security Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type='text' onkeydown="return (event.keyCode!=13);" autocomplete='off' id='sname' name='securityname' title='Type Associate Name' value='' style='border-color: silver; border-style: solid; text-align: center; margin-top: 10px; font-family: Courier New; font-size: 16px; height: 30px; width: 300px;'>
            <span class='error'><?php echo $assnameerr; ?></span><br><br>
          <label style='color: black;margin-left: 150px; font-size: 20px; font-family: Courier New;'>Department &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type='text' readonly autocomplete='off' name='securitydepartment' title='Type Associate Deaprtment' value='Security Department' style='border-color: silver;text-align: center;margin-top: 10px; font-family: Courier New; font-size: 16px; height: 30px; width: 300px;'>
            <br><br><br>
          <input type='Submit' name='addsecurity' title='Save and Validate New Associate Records' value='Add Security Guard' style='border-color: skyblue;border-radius: 5px; text-align: center; margin-left: 455px; cursor: pointer; background-image: url("img/NEW/MAIN2.png"); font-family: Times New Roman; font-size: 25px; height: 60px; width: 257px; color: white;'>
     </div>
     <?php
               }
                    echo "<script> document.getElementById('sname').focus();</script>";
          }
          }
     }
}
?>
</div>
</div>
</form>
<?php
     if(!empty($_POST['addassociate']))
     {
      
          $control = odbc_exec($hris, "select Employee_ID from [dbo].[ITASSET_USERS] where Employee_ID='".$_POST['empid']."'");

          if(odbc_num_rows($control) > 0)
          {
               echo "<script>alert('( ✘ ) The Employee ID (".$_POST['empid'].") already Exist! Please Input a Unique Employee ID !');</script>";
          }
          else
          {
               odbc_exec($hris, "INSERT INTO [dbo].[ITASSET_USERS] (Employee_ID, Status, Expiration, Password, Userlevel) VALUES ('".$_POST['empid']."','Active','".$dt."','".$_POST['empid']."','Associate')");

               echo "<script>alert('( ✔ ) New Associate: ".$_POST['assname']." Successfully Added!');</script>";
          }
    }

    if(!empty($_POST['addsecurity']))
    {
          if(empty($_POST['securityname']))
          {
               echo "<script>alert('( ✘ ) Please Enter the Name of the Security Guard !');</script>";
               echo "<script>document.getElementById('load2').click();</script>";
          }
          else
          {
               odbc_exec($hris, "INSERT INTO [dbo].[ITASSET_USERS] (Employee_ID, Status, Expiration, Password, Userlevel, SECNAME) VALUES ('".$_POST['empid']." ','Active','".$dt."','".$_POST['empid']."','Security Guard','".$_POST['securityname']."')");

               echo "<script>alert('( ✔ ) New Security Guard: ".$_POST['securityname']." Successfully Added!');</script>";
          }
     }
include_once 'conn/footer.php';
}//login to proceed
?>
</body>
</html>