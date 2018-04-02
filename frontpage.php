<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="img/favicon.ico"/>
</head>
<title>Asset Verification and Monitoring System</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php
     include_once 'conn/connect.php';
     
     date_default_timezone_set('Asia/Manila');
     $dt = date('Y-m-d');
     $d  = date('M. d, Y / D');
     $h  = date('H:i:s');
     $po = date('mdy-His');
     
     $uname = $pword = $invalid = $emperr = $attempt = ""; 

if(!empty($_POST['LoginNow']))
{
     $username = $_POST['username'];
     $Password = $_POST['Password'];

     if(empty($_POST['username']))
     {
          $uname ='!';
          $invalid='( ✘ ) Empty Username Field !';
          $error=true;
     }
     else
     {
          $error=false;
     }
     if(empty($_POST['Password']))
     {
          $pword ='!';
          $invalid='( ✘ ) Empty Password Field !';
          $error=true;
     }
     else
     {
         $error=false;
     }
     if(empty($_POST['Password']) && empty($_POST['username']))
     {
          $invalid='( ✘ ) Empty Username and Password !';
          $error=true;
     }
     else
     {
          $error=false;
     }

     if(!empty($_POST['username']) && !empty($_POST['Password']))
     {
          $sql_anno = "SELECT UserID, EMPLOYEE_ID, STATUS, EXPIRATION, PASSWORD, USERLEVEL from [dbo].[ITASSET_USERS] where EMPLOYEE_ID = '".$username."' and PASSWORD = '".$Password. "'";

          $res_anno = odbc_exec($hris, $sql_anno);

          if (!$res_anno) 
          {
              exit();
          }
          else if(odbc_num_rows($res_anno) > 0)
          {
               while ($row = odbc_fetch_array($res_anno))
               {
                    $useri = odbc_result($res_anno,1);    
                    $empid = odbc_result($res_anno,2);      
                    $statu = odbc_result($res_anno,3);
                    $expir = odbc_result($res_anno,4);      
                    $passw = odbc_result($res_anno,5);   
                    $userl = odbc_result($res_anno,6);

                    $log = '';
                    session_start();
                    $_SESSION['uid'] = $useri;
                    $_SESSION['eid'] = $empid;

                    if($statu=='Active')
                    {
                         if($userl=='Administrator')
                         {
                              include_once 'conn/connecthris.php';
                              $empinfo = odbc_exec($hris2, "SELECT a.Employee_LastName, a.Employee_FirstName, a.Employee_MiddleName, b.DEPNME FROM VIEW_HRIS_EmployeeName as a inner join VIEW_HRIS_EmploymentInfo as b on a.Employee_ID = b.Employee_ID where a.Employee_ID = '".$_POST['username']."'");

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
                                        
                                        $log = 'Yes';
                                        session_start();
                                        $_SESSION['asn'] = $ln.", ".$fn." ".$mn;
                                        $_SESSION['dep'] = $dm;
                                        $_SESSION['log'] = $log;
                                        $_SESSION['typ'] = 'Admin';
                
                                        header('location:AdminHome.php');
                                   }
                              }
                         }
                         elseif($userl=='Associate')
                         {
                              include_once 'conn/connecthris.php';
                              $empinfo = odbc_exec($hris2, "SELECT a.Employee_LastName, a.Employee_FirstName, a.Employee_MiddleName, b.DEPNME FROM VIEW_HRIS_EmployeeName as a inner join VIEW_HRIS_EmploymentInfo as b on a.Employee_ID = b.Employee_ID where a.Employee_ID = '".$_POST['username']."'");

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
                                        
                                        $log = 'Yes';
                                        session_start();
                                        $_SESSION['asn'] = $ln.", ".$fn." ".$mn;
                                        $_SESSION['dep'] = $dm;
                                        $_SESSION['log'] = $log;
                                        $_SESSION['typ'] = 'Associate';
     
                                        header('location:NewViewRequestForm.php');
                                   }
                              }
                         }
                         elseif($userl=='IssuedApprover')
                         {
                              include_once 'conn/connecthris.php';
                              $empinfo = odbc_exec($hris2, "SELECT a.Employee_LastName, a.Employee_FirstName, a.Employee_MiddleName, b.DEPNME FROM VIEW_HRIS_EmployeeName as a inner join VIEW_HRIS_EmploymentInfo as b on a.Employee_ID = b.Employee_ID where a.Employee_ID = '".$_POST['username']."'");

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
                                        
                                        $log = 'Yes';
                                        session_start();
                                        $_SESSION['asn'] = $ln.", ".$fn." ".$mn;
                                        $_SESSION['dep'] = $dm;
                                        $_SESSION['log'] = $log;
                                        $_SESSION['typ'] = 'IssuedApprover';
     
                                        header('location:IssuedApproverHome.php');
                                   }
                              }
                         }
                         elseif($userl=='BorrowApprover')
                         {
                              include_once 'conn/connecthris.php';
                              $empinfo = odbc_exec($hris2, "SELECT a.Employee_LastName, a.Employee_FirstName, a.Employee_MiddleName, b.DEPNME FROM VIEW_HRIS_EmployeeName as a inner join VIEW_HRIS_EmploymentInfo as b on a.Employee_ID = b.Employee_ID where a.Employee_ID = '".$_POST['username']."'");

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
                                        
                                        $log = 'Yes';
                                        session_start();
                                        $_SESSION['asn'] = $ln.", ".$fn." ".$mn;
                                        $_SESSION['dep'] = $dm;
                                        $_SESSION['log'] = $log;
                                        $_SESSION['typ'] = 'BorrowApprover';
     
                                        header('location:BorrowApproverHome.php');
                                   }
                              }
                         }
                         elseif($userl=='Security Guard')
                         {
                              include_once 'includes/connect.php';
                              $empinfo = odbc_exec($hris, "SELECT SECNAME,SECFLAG FROM [sample].[dbo].[ITASSET_USERS] WHERE Employee_ID = '".$_POST['username']."'");

                              if (!$empinfo) 
                              {
                                  exit();
                              }
                              else if(odbc_num_rows($empinfo) > 0)
                              {
                                   while ($row = odbc_fetch_array($empinfo))
                                   {
                                        $sn = odbc_result($empinfo,1);
                                        $sf = odbc_result($empinfo,2);
                                        
                                        $log = 'Yes';
                                        session_start();
                                        $_SESSION['asn'] = $sn;
                                        $_SESSION['dep'] = 'Security Department';
                                        $_SESSION['log'] = $log;
                                                  
                                        if ($sf == 'I')
                                        {
                                             $_SESSION['typ'] = 'Security Guard IN';
                                             header('location:frontin.php');
                                        }
                                        else
                                        {
                                             $_SESSION['typ'] = 'Security Guard OUT';
                                             header('location:frontout.php');
                                        }
                                   }
                              }
                         }
                    }
                    elseif($statu=='Inactive')
                    {
                         echo "<script>alert('Your Account was Deactivated.');</script>";
                    }
               }
          }
          else
          {
               
               //$invalid='( ✘ ) Incorrect Username or Password';

               $log = '';
               session_start();
               $_SESSION['log'] = $log;
               /*$try1 = '0';

               if($try1=='0'){
                    $_SESSION['try'] = '1';
               }
               elseif($try1=='1'){
                    $_SESSION['try'] = '2';
               }
               elseif($try1=='2'){
                    $_SESSION['try'] = '3';
               }elseif($try1=='3'){
                    odbc_exec($hris, "UPDATE ITASSET_USERS set Status='Inactive' where Employee_ID ='".$_POST['username']."'");
               }*/


               //odbc_exec($hris, "UPDATE ITASSET_USERS set Status='Inactive' where Employee_ID ='".$_POST['username']."'");
          }
     }
}
     if(!empty($_POST['LoginNow']))
     {
          if(!empty($_POST['username']) && !empty($_POST['Password']))
          {
               $usrme = odbc_exec($hris, "SELECT employee_id, password FROM [sample].[dbo].[ITASSET_USERS] WHERE Employee_ID = '".$_POST['username']."'");
               if(odbc_num_rows($usrme) > 0)
               {
                    while ($row = odbc_fetch_array($usrme))
                    {
                         $nam = odbc_result($usrme,1);
                         $wor = odbc_result($usrme,2);

                         if($_POST['Password']!=$wor)
                         {
                              $pword ='!';
                              $invalid='( ✘ ) Incorrect Password !';
                         }
                    }
               }
               else
               {
                    $passwd = odbc_exec($hris, "SELECT employee_id, password FROM [sample].[dbo].[ITASSET_USERS] WHERE Password = '".$_POST['Password']."'");
                    if(odbc_num_rows($passwd) > 0)
                    {
                         while ($row = odbc_fetch_array($passwd))
                         {
                              $uname ='!';
                              $invalid='( ✘ ) Incorrect Username !';
                         }
                    }
                    else
                    {
                         $uname ='!';
                         $pword ='!';
                         $invalid='( ✘ ) Incorrect Username and Password !';
                    }
               }
          }
     }

     if(!empty($_POST['next']))
     {
          if(empty($_POST['empid']))
          {
               $emperr='!';
               $error=true;
          }
          else
          {
               $error=false;
          }
          if(!empty($_POST['empid']))
          {
               $sql_anno = "SELECT Name, Department, EmailAddress, EmployeeIDNo, RecoveryQuestion, RecoveryAnswer, Username, Password from [dbo].[ITASSET_Account_Sample1] where EmployeeIDNo='".$_POST['empid']."'";

            $res_anno = odbc_exec($hris, $sql_anno);

            if (!$res_anno) 
            {
                exit();
            }
            else if(odbc_num_rows($res_anno) > 0)
            {
                while ($row = odbc_fetch_array($res_anno))
                {
                    $nam = odbc_result($res_anno,1);
                    $dep = odbc_result($res_anno,2);
                    $ema = odbc_result($res_anno,3);
                    $eid = odbc_result($res_anno,4);
                    $req = odbc_result($res_anno,5);
                    $rea = odbc_result($res_anno,6);
                    $usr = odbc_result($res_anno,7);
                    $pas = odbc_result($res_anno,8);

                    session_start();
                    $_SESSION['nme'] =  $nam;
                    $_SESSION['depart'] =  $dep;
                    $_SESSION['emailad'] =  $ema;
                    $_SESSION['employid'] =  $eid;
                    $_SESSION['recquestion'] =  $req;
                    $_SESSION['recanswer'] =  $rea;
                    $_SESSION['uname'] =  $usr;
                    $_SESSION['pword'] =  $pas;

                    if($req=='None')
                    {
                         $msg='Hi, '.$nam.'\nYou DONT Have a Recovery Option.\nPlease Consult the Admin for Your Account.';
                         echo "<script>alert('".$msg."');</script>";
                    }
                    else
                    {
                         header('location:ForgotPassword.php');
                    }
                }
            }
            else
            {
               $msg='The Employee ID not found!\nPlease Try Again.';
               echo "<script>alert('".$msg."');</script>";
            }
          }
    }
?>

<style>
span{
animation: blink 1s linear infinite; 
  }
 @keyframes blink{

0%{opacity: 0;}
50%{opacity: .8;}
100%{opacity: 1;}
}
.loginButton:hover {
    background-color:rgb(250, 180 ,168); 
    color: black;
    cursor: pointer;
    text-decoration: underline;
}
.ul:hover{
    text-decoration: underline;
}
.error{
     color: red;
     font-family: courier new;
     font-size: 18px;
}
.block {
    display: block;
    width: 100%;
    border: none;
    background-color: rgb(0, 51, 153);
    color: white;
    padding: 12px 26px;
    font-size: 16px;
    cursor: pointer;
    text-align: center;
    border-color: white; 
}

.block:hover {
    background-color: royalblue;
    color: black;
}
</style>

<script type="text/javascript">
        window.history.forward();
        function noBack() {
            window.history.forward();
        }
</script>


<body style='background-image: url("img/nwp.png"); background-color: white; background-repeat: no-repeat;' onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload=""><br>
<!--<div style="color:rgb(250,130,30); background-color: rgb(250,130,30); border-style: solid; height: 20px; margin-top: -7px; margin-left: -8px; width: 1360px;"></div>-->
<form action='' method='post'>

          <div style='box-shadow: 5px 5px 50px skyblue; border-style: solid; border-color:rgb(0, 51, 153); margin-top: 150px;color: skyblue;margin-left: 765px;  border-radius: 5px; width: 500px; height: 380px;'>
            <div style='height: 10px; background-color: rgb(0, 51, 153);'></div>

               <div style='box-shadow: -1px 2px 10px silver; border-radius: 5px; border-style: none none solid none; color: rgb(0, 51, 153); text-align: center; background-color: rgba(171, 236, 257, 0.1);'><br>
                   <label class='ul' style='color: black; font-size: 35px; font-family: Stencil; '>LOG-IN<br>AUTHENTICATION</label>
                   <br><br>
               </div>

                <br><br>
                <div style='border-style: double;border-radius: 5px 40px 40px 5px; background-color: rgb(0, 51, 153); margin-left: 95px; height: 50px; width: 320px; box-shadow: 5px 5px 20px skyblue;'>
                <input type='text' readonly style='font-family: Courier New; font-size: 18px;border-radius: 5px; height: 34px; width: 41px; margin-left: 16px; background-image: url("img/user1.png"); border-style: double none double double; border-color: skyblue;'>
                <input type='text' name='username' autocomplete="off" autofocus onkeypress="return checkQuote();" placeholder='USERNAME' title='Type Username' value='<?php if(isset($_POST['LoginNow'])) echo $_POST['username'];?>' style='border-color: skyblue;  margin-left: -4px; border-style: double double double none; text-align: center; width: 233px; border-radius: 5px 20px 20px 5px; margin-top: 5px; font-size: 18px; font-family: Courier New; height: 34px;'>
                <span class='error' style='font-size: 27px; font-family: stencil; color:red;'><?php echo $uname; ?></span>
              </div>
                <br>
                <div style='border-style: double; border-radius: 5px 40px 40px 5px; background-color: rgb(0, 51, 153); margin-left: 95px;height: 50px; width: 320px; box-shadow: 5px 5px 20px skyblue;'>
                <input type='text' readonly style='font-family: Courier New;  font-size: 18px; border-radius: 5px;height: 34px; width: 41px; margin-left: 16px; background-image: url("img/pass1.png"); border-style: double none double double; border-color: skyblue;'>
                <input type='Password' name='Password' placeholder='PASSWORD' onkeypress="return checkQuote();" title='Type Password' value='<?php if(isset($_POST['LoginNow'])) echo $_POST['Password'];?>' style='border-color: skyblue; border-radius: 5px 20px 20px 5px; margin-top: 5px; border-style: double double double none; margin-left: -4px; text-align: center; width: 233px; font-size: 18px; font-family: Courier New; height: 34px;'>
                <span class='error' style='font-size: 27px; font-family: stencil; color: red; '><?php echo $pword; ?></span>
                <br></div><br>
             <center><span class='error' style='font-size: 24px; font-family: forte; color: red; '><?php echo $invalid; ?></span></center>
                <div style='border-radius: 5px; margin-top: -6px;color: skyblue;background-color: rgba(232, 236, 257, 0.3); height: 60px;'>
                    <input type='Submit' name='LoginNow' title='Login' class='block' value='&#8921; ' style='box-shadow: 1px -2px 10px silver; border-style: solid;text-align: right; color: white; visibility: hidden; font-weight: bold; font-family: Times New Roman; font-size: 35px; '>
               </div>
               
          </div> 
<div style='margin-top: -12px; height: 10px; background-color: rgb(0, 51, 153); width: 500px; margin-left: 768px; '></div>
<script type="text/javascript" language="javascript">
          function checkQuote() {
               if(event.keyCode == 39) {
                    event.keyCode = 0;
                    return false;
               }
          }
     </script>
</form>
<br>
<?php
include_once('conn/footer.php');
?>
</body>
</html>