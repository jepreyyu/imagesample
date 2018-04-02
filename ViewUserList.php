<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="img/favicon.ico"/>
</head>
<title>Admin - User's Account</title>
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

    $searchby = $ugh = "";

    if(!empty($_POST['Back'])){
      header('location: AdminHome.php');
    }
?>

<style>
.error {
  color:red;
}
th{
  background-color: rgba(107, 78, 232, 0.9);
  color: white;
  font-family: courier new;
}
tr:hover{
  background-color: rgb(61, 211 ,241);
  cursor          : pointer;
}tr{
  background-color: white;
  transition      : all .25s ease-in-out; 
}
table{
  color            : black;
   background-color: white;
   width           : 100%;
}
td{
  cursor: pointer;
  font-family: courier new;
  border     : 1px solid #ddd;
  padding    : 5px;
  text-align : center;
}
.Buttonhover:hover{
  text-decoration : underline;
  cursor          : pointer;
  background-color:rgb(255,255,101);
}
.pointer:hover{
  text-decoration: underline;
  cursor         : pointer;
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
  <div style='margin-top: 54px;border-color: skyblue; background-color:rgba(123,210,219,0.5);border-style: solid; height: 490px; width: 1355px; border-radius: 5px; margin-left: -5px'>
  
    <div style='margin-top: 25px; height: 60px;'>
      <input type='text' name='search' id='sid' autocomplete='off' autofocus placeholder='Enter Employee ID' title='Type Text to Search' value='<?php if(isset($_POST['Search'])) echo $_POST['search'];?>' style='margin-left: 55px; border-radius: 5px; border-color: skyblue; text-align: center; font-family: Courier New; font-size: 18px; height: 35px; width: 270px;'>
      <input type='Submit' name='Search' id='search2' title='Search Records' value='.' style='cursor: pointer; border-radius: 5px;  margin-left: -2px; text-align: center; color: white; background-image: url("img/new/s1.png"); font-family: Courier New; font-size: 18px; border-color: skyblue; height: 43px; width: 174px;'>
      <input type='Submit' name='ViewAll' title='View All User List Accounts and Information' value='.' style='cursor: pointer; margin-left: 294px; border-color: skyblue; border-radius: 5px; text-align: right; background-image: url("img/NEW/VA.png"); font-family: Courier New; font-size: 1px; height: 54px; width: 262px;'>
      <input type='Submit' name='Back' value='.' title='Go Back to the New/View Request Form' style='cursor: pointer; background-image: url("img/new/bk2.png"); border-radius: 5px; margin-left: 10px; border-color: skyblue; color: skyblue; text-align: right; font-family: Courier New; font-size: 1px; height: 54px; width: 262px;'>
    </div><br>
<?php
if(!empty($_POST['ViewAll']))
{
?>
  <div style='border-radius:5px;overflow-y: scroll; height: 385px;background-image: url("img/wp29.png");'>


    <table id="table" border="1" style="width: 100%;">
  <thead>
    <tr><b>
      <th>&nbsp;No&nbsp;</th>
      <th>Employee<br>ID</th>
      <th>Status</th>
      <th>Expiration</th>
      <th>Password</th>
      <th>User Type</th>
      <th>Full Name</th>
    </b></tr>
  </thead>
  <tbody>
      <?php
        $result = odbc_exec($hris, "SELECT UserID, EMPLOYEE_ID, STATUS, EXPIRATION, PASSWORD, USERLEVEL, SECNAME from [dbo].[ITASSET_USERS]");
        
        for($i=1; $row = odbc_fetch_array($result); $i++)
        {
      ?>
      <tr>
      <?php echo "<td><input type='text' name='userid".$i."' readonly style='font-family: Courier New;text-align:center; width: 30px; border-style: none;' value ='".$row['UserID']."'</td>"; ?>
      <?php echo "<td><input type='text' name='employee_id".$i."' readonly style='font-family: Courier New;text-align:center; width: 100px; border-style: none;' value ='".$row['EMPLOYEE_ID']."'</td>"; ?>
      <?php echo "<td><input type='text' name='status".$i."' readonly style='font-family: Courier New;text-align:center; width: 80px; border-style: none;' value ='".$row['STATUS']."'</td>"; ?>
      <?php echo "<td><input type='text' name='expiration".$i."' readonly style='font-family: Courier New;text-align:center; width: 100px; border-style: none;' value ='".$row['EXPIRATION']."'</td>"; ?>
      <?php echo "<td><input type='text' name='password".$i."' readonly style='font-family: Courier New;text-align:center; width: 100px; border-style: none;' value ='".$row['PASSWORD']."'</td>"; ?>
      <?php echo "<td><input type='text' name='userlevel".$i."' readonly style='font-family: Courier New;text-align:center; width: 150px; border-style: none;' value ='".$row['USERLEVEL']."'</td>"; ?>
      <?php echo "<td><input type='text' name='secname".$i."' readonly style='font-family: Courier New;text-align:center; width: 180px; border-style: none;' value ='".$row['SECNAME']."'</td>"; ?>
      </tr>
      <?php
        }
      ?>
  </tbody>
</table>

</div> <!-- table division -->
<?php
}
?>

<?php
if(!empty($_POST['Search']))
{
  $search = trim($_POST['search']); $error=false;

  if(empty($search))
  {
    $error=true;
  }
  else
  {
    $error=false;
  }
  if(!empty($search))
  {

  ?>
  <div style='border-radius:5px;overflow-y: scroll; height: 385px;background-image: url("img/wp29.png");'>


    <table id="table" border="1" style="width: 100%;">
  <thead>
    <tr><b>
      <th>&nbsp;No&nbsp;</th>
      <th>Employee<br>ID</th>
      <th>Status</th>
      <th>Expiration</th>
      <th>Password</th>
      <th>User Type</th>
      <th>Full Name</th>
    </b></tr>
  </thead>
  <tbody>
      <?php
        $result = odbc_exec($hris, "SELECT UserID, EMPLOYEE_ID, STATUS, EXPIRATION, PASSWORD, USERLEVEL, SECNAME from [dbo].[ITASSET_USERS] where Employee_ID LIKE '".'%'.$_POST['search'].'%'."'");
        
        for($i=1; $row = odbc_fetch_array($result); $i++)
        {
      ?>
      <tr>
      <?php echo "<td><input type='text' name='userid".$i."' readonly style='font-family: Courier New;text-align:center; width: 30px; border-style: none;' value ='".$row['UserID']."'</td>"; ?>
      <?php echo "<td><input type='text' name='employee_id".$i."' readonly style='font-family: Courier New;text-align:center; width: 100px; border-style: none;' value ='".$row['EMPLOYEE_ID']."'</td>"; ?>
      <?php echo "<td><input type='text' name='status".$i."' readonly style='font-family: Courier New;text-align:center; width: 80px; border-style: none;' value ='".$row['STATUS']."'</td>"; ?>
      <?php echo "<td><input type='text' name='expiration".$i."' readonly style='font-family: Courier New;text-align:center; width: 100px; border-style: none;' value ='".$row['EXPIRATION']."'</td>"; ?>
      <?php echo "<td><input type='text' name='password".$i."' readonly style='font-family: Courier New;text-align:center; width: 100px; border-style: none;' value ='".$row['PASSWORD']."'</td>"; ?>
      <?php echo "<td><input type='text' name='userlevel".$i."' readonly style='font-family: Courier New;text-align:center; width: 150px; border-style: none;' value ='".$row['USERLEVEL']."'</td>"; ?>
      <?php echo "<td><input type='text' name='secname".$i."' readonly style='font-family: Courier New;text-align:center; width: 180px; border-style: none;' value ='".$row['SECNAME']."'</td>"; ?>
      </tr>
      <?php
        }
      ?>
  </tbody>
</table>

</div> <!-- table division -->
<?php
 }
}
?>
</div>

<script>
var input = document.getElementById("sid");
input.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
        document.getElementById("search2").click();
    }
});
</script>

</form>
<?php
include_once('conn/footer.php');
}//login proceed
?>
</body>
</html>