<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="img/favicon.ico"/>
</head>
<title>Request Form</title>
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

     if(!empty($_POST['Back']))
     {
          if($typ=='Admin')
          {
             header('location: AdminNewViewRequest.php');
          }
          elseif($typ=='Associate')
          {
             header('location: NewViewRequestForm.php');
          }
          elseif($typ=='IssuedApprover')
          {
             header('location: IssuedApproverNewViewRequest.php');
          }
          elseif($typ=='BorrowApprover')
          {
             header('location: BorrowApproverNewViewRequest.php');
          }
     }
     if(!empty($_POST['Owned']))
     {
          header('location: RequestForm.php');
     }
     if(!empty($_POST['Borrowed']))
     {
          header('location: BorrowedForm.php');
     }

     if(!empty($_POST['View']))
     {
          /*$no = $_POST['View'];
     
          $no2 = 'ControlNumber'.$no;
          $no3 = $_POST[$no2];
     
          $no4 = 'AssetType'.$no;
          $no5 = $_POST[$no4];
     
          $no6 = 'Duration'.$no;
          $no7 = $_POST[$no6];
     
          $no8 = 'StartDate'.$no;
          $no9 = $_POST[$no8];
     
          $no10 = 'EndDate'.$no;
          $no11 = $_POST[$no10];
     
          $no12 = 'Reason'.$no;
          $no13 = $_POST[$no12];
     
          $no14 = 'DateSubmitted'.$no;
          $no15 = $_POST[$no14];
     
          $no16 = 'Editable'.$no;
          $no17 = $_POST[$no16];
     
          session_start();
          $_SESSION['cont']=$no3;
          $_SESSION['asse']=$no5;  
          $_SESSION['dura']=$no7;  
          $_SESSION['star']=$no9;  
          $_SESSION['endd']=$no11;  
          $_SESSION['reas']=$no13;  
          $_SESSION['date']=$no15;  


          header('location:EditableRequest.php');*/
     }
?>

<style>
th{
  background-color:rgb(99,240,20);
  font-family: courier new;
}
tr:hover{
  background-color: rgb(61, 211 ,241);
  cursor: pointer;
}
tr{
  background-color: white;
     transition : all .25s ease-in-out; 
}
table{
     color            : black;
     background-color : white;
     width            : 100%;
}
td{
  cursor: pointer;
  font-family: courier new;
     border     : 1px solid #ddd;
     padding    : 5px;
     text-align : center;
}
.Buttonhover:hover{
  text-decoration: underline;
  cursor: pointer;
  background-color:rgb(255,255,101);
}
.pointer:hover{
  text-decoration: underline;
  cursor: pointer;
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
        <label style='font-size:20px; color: white; font-family: Courier New;'>&nbsp;<?php echo '<b>Name : </b>'.$name; ?></label><br>
        <label style='font-size:20px; color: white; font-family: Courier New;'>&nbsp;<?php echo '<b>Dept : </b>'.$dep; ?></label>
      </div>

  <div style='margin-top: 54px;border-color: rgba(123,210,219,0.5);; background-color:rgba(255,255,255,0.5);border-style: none; height: 480px; width: 630px; border-radius: 5px; margin-left: 650px;'>
    <div style='margin-top: 50px;'>
      <input type='Submit' name='Owned' value='Issued' title='Request Form' style='background-image: url("img/new/main.png"); border-radius: 10px; border-color: skyblue;text-align: center; margin-top: 130px; cursor: pointer; margin-left: 150px; color: white; font-family: gEORGIA; font-size: 42px; height: 79px; width: 376px;'>
      <br><br>
      <input type='Submit' name='Borrowed' value='Borrow' title='Borrow Form' style='background-image: url("img/new/main.png"); border-radius: 10px; border-color:skyblue;text-align: center; margin-left: 150px; cursor: pointer; color: white; font-family: gEORGIA; font-size: 42px; height: 79px; width: 376px;'>
      <input type='Submit' name='Back' value='.' title='Go Back to the Request Form Module' style='background-image: url("img/new/bk2.png"); border-radius: 10px; margin-top: 130px;margin-left: 430px; cursor: pointer; border-color:skyblue;text-align: right; color: skyblue;font-family: Courier New; font-size: 22px; height: 54px; width: 262px;'>
    </div>
    <br>
</div><br>

</form>
<?php
include_once('conn/footer.php');
?>
</body>
<?php
}
?>
</html>