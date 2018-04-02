<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="img/favicon.ico"/>
</head>
<title>Admin - Home</title>
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
elseif($log=='Yes' && $typ!='Admin')
{
     echo "<script>alert('User is not Login!');</script>";
          $_SESSION['log'] = ''; 
  include_once 'conn/mainpage.php';
}
else
{
     if(!empty($_POST['Back']))
     {
          session_start();
          $_SESSION['log'] = ''; 
          header('location: frontpage.php');
     }
     if(!empty($_POST['newuser']))
     {
          header('location: AddNewAssociate.php');
     }
     if(!empty($_POST['list']))
     {
          header('location: ViewUserlist.php');
     }
     if(!empty($_POST['all']))
     {
          header('location: AdminNewViewRequest.php');
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

<body style='background-image: url("img/new/main4.png"); background-color: white; background-repeat: no-repeat;' onload="noBack();" onpageshow="if (event.persisted) noBack();">
  <form action='' method='post'>

      <div style=' margin-bottom: 10px; border-radius: 5px;margin-top: 5px;text-align: left; color: black; width: 500px; height: 50px; padding-top: 7px;'>
        <!--<label style='font-size:20px; font-family: Courier New;'>&nbsp;<?php //echo '<b>Name : </b>'.$name; ?></label><br>
        <label style='font-size:20px; font-family: Courier New;'>&nbsp;<?php //echo '<b>Dept : </b>'.$dep; ?></label> -->
      </div>

  <div style='margin-top: 54px;border-color: rgba(123,210,219,0.5);; background-color:rgba(255,255,255,0.5);border-style: none; height: 400px; width: 630px; border-radius: 5px; margin-left: 650px; '>
    <div style='margin-top: 50px; '>
      <div style='margin-top: 130px;'>
      <input type='Submit' name='newuser' value='Add New User' style='background-image: url("img/new/ad1.png"); border-radius: 10px; border-color: skyblue;text-align: center; margin-top: 30px; margin-left: 30px; color: white; cursor: pointer; font-family: gEORGIA; font-size: 28px; height: 96px; width: 262px;'>
      <input type='Submit' name='list' value='User Accounts' style='background-image: url("img/new/ad1.png"); border-radius: 10px; border-color: skyblue;text-align: center; margin-left: 20px; color: white; font-family: gEORGIA; cursor: pointer; font-size: 28px; height: 96px; width: 262px;'>
      <br><br>
      <input type='Submit' name='all' value='Request Form' style='background-image: url("img/new/ad1.png"); border-radius: 10px; border-color: skyblue;text-align: center; margin-left: 30px; color: white; font-family: gEORGIA; cursor: pointer; font-size: 28px; height: 96px; width: 262px;'><br><br>
    </div>
      <input type='Submit' name='Back' value='.' style='background-image: url("img/new/lo1.png"); border-radius: 10px; margin-top: 100px;margin-left: 430px; border-color:skyblue;text-align: right; color: skyblue; font-family: Courier New; cursor: pointer; font-size: 22px; height: 54px; width: 262px;'>
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