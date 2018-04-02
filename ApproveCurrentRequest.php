<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="img/favicon.ico"/>
</head>
<title>Approve User's Request</title>
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

    date_default_timezone_set('Asia/Manila');
    $dt = date('Y-m-d');
    $cono = date('y');
    $d  = date('M. d,Y/D');
    $h  = date('H:i:s');
    $po = date('mdy-His');



if($log=='')
{
      echo "<script>alert('( ✘ ) User is Not Login !');</script>";
          $_SESSION['log'] = ''; 
  include_once 'conn/mainpage.php';
}
elseif($log=='Yes' && $typ=='Security Guard')
{
     echo "<script>alert('User is not Login!');</script>";
          $_SESSION['log'] = ''; 
  include_once 'conn/mainpage.php';
}
else
{

     if(!empty($_POST['Logout']))
     {
       if($typ=='Admin')
       {
          header('location: AdminHome.php');
       }
       elseif($typ=='Associate')
       {
          header('location: NewViewRequestForm.php');
        }
       elseif($typ=='IssuedApprover')
       {
          header('location: IssuedApproverHome.php');
        }
       elseif($typ=='BorrowApprover')
       {
          header('location: BorrowApproverHome.php');
        }

        
     }

     if(!empty($_POST['View']))
        {
            $no = $_POST['View'];
            $no2 = 'ControlNumber'.$no;
            $no3 = $_POST[$no2];

            $fnd = odbc_exec($hris, "SELECT Status, Editable, Duration, AssetType, EndDate, RequestType, ControlNumber from [dbo].[ITASSET_RequestForm_Sample1] where ControlNumber='".$no3."'");
            
            while ($row = odbc_fetch_array($fnd))
            {
                $stat = odbc_result($fnd,1);
                $edit = odbc_result($fnd,2);
                $dura = odbc_result($fnd,3);
                $asse = odbc_result($fnd,4);
                $endt = odbc_result($fnd,5);
                $reqt = odbc_result($fnd,6);
                $cont = odbc_result($fnd,7);
                if($endt < $dt)
                {
                    //echo "<script>alert('( ✘ ) The Request is Already on Due Date !');</script>";
                }
                else
                {
                    if($reqt=='Issued')
                    {
                        /*odbc_exec($hris, "UPDATE [dbo].[ITASSET_RequestForm_Sample1] set Status = 'Approved', Editable = 'No' where ControlNumber='".$no3."'");
                        odbc_exec($hris, "UPDATE [misInv].[dbo].[itemmaster] set AllowCode = '".$dura."', RequestNumber = '".$no3."', InOutFlag='' where ItemCode='".$asse."'");
                        echo "<script>alert('( ✔ ) Issued Request Successfully Approved .');</script>";*/
                        $_SESSION['cont'] = $cont;
                        header('location: IssuedApproveRequest.php');
                    }
                    elseif($reqt=='Borrowed')
                    {
                        
                        $_SESSION['cont'] = $cont;
                        //echo "<script>alert('".$cont."');</script>";
                        header('location: BorrowApproveRequest.php');

                    }
                }
            }
        }
?>

<style>
th{
	background-color: rgba(107, 78, 232, 0.9);
     color: white;
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

<div style='margin-top: 54px;border-color: skyblue; background-color:rgba(123,210,219,0.5);border-style: solid; height: 490px; width: 1355px; border-radius: 5px; margin-left: -5px'>

	<div style='margin-left:1000px; margin-top: 25px; height: 60px; width: 335px;'>
         <input type='Submit' name='Logout' value='.' title='Go Back to the New/View Request Form' style='background-image: url("img/new/bk2.png"); border-radius: 10px; margin-left: 70px; border-color:skyblue; color: skyblue; text-align: right; font-family: Courier New; font-size: 22px; height: 52px; width: 261px;'>
     </div><br>

	<div style='border-radius:5px;overflow-y: scroll; height: 385px;background-image: url("img/wp29.png");'>
<?php  $empid1 = substr($empid,6); 
      ?>
		<table id="table" border="1" style="width: 100%;">
  <thead>
    <tr><b>
      <th>Approve</th>
      <th>Request Type</th>
      <th>Request Number</th>
      <th>Associate Name</th>
      <th>Department /<br>Section</th>
      <th>Item Code</th>
      <th>Duration</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Reason</th>
      <th>LAP</th>
      <th>MOU</th>
      <th>KEY</th>
      <th>TAB</th>
      <th>MON</th>
      <th>DPC</th>
      <th>SCA</th>
      <th>MME</th>
      <th>PRN</th>
      <th>Date Submitted</th>
      <th>Time Submitted</th>
      <th>Requested By</th>
      <th>Status</th></b>
    </tr>
  </thead>
  <tbody>
      <?php

      $tabledata = '';
      if($typ=='IssuedApprover')
      {
         $tabledata = 'Issued';
      }
      elseif($typ=='BorrowApprover')
      {
         $tabledata = 'Borrowed';
      }

        $result = odbc_exec($hris, "SELECT AssociateName, DepartmentSection, ControlNumber, AssetType, Duration, StartDate, EndDate, Reason, DateSubmitted, TimeSubmitted, Laptop, Mouse, Keyboard, Tablet, Monitor, Desktop, Scanner, MultimediaProjector, Printer, Status, RequestType, RequestedBy
FROM [dbo].[ITASSET_REQUESTFORM_SAMPLE1] where Status = 'Entered' and RequestType='".$tabledata."'");
        for($i=1; $row = odbc_fetch_array($result); $i++)
        {
      ?>
      <tr>
      <?php echo "<td><input type='Submit' name='View' class='Buttonhover'style='border-radius:5px; width: 80px;border-color: blue;' title='Click To View' value='".$i."' </td>"; ?>
      <?php echo "<td><input type='text' name='RequestType".$i."' readonly style='font-family: Courier New;text-align:center; width: 100px; border-style: none;' value ='".$row['RequestType']."'</td>"; ?>
      <?php echo "<td><input type='text' name='ControlNumber".$i."' readonly style='font-family: Courier New;text-align:center; width: 150px; border-style: none;' value ='".$row['ControlNumber']."'</td>"; ?>
      <?php echo "<td><input type='text' name='AssociateName".$i."' readonly style='font-family: Courier New;text-align:center; width: 250px; border-style: none;' value ='".$row['AssociateName']."'</td>"; ?>
      <?php echo "<td><input type='text' name='DepartmentSection".$i."' readonly style='font-family: Courier New;text-align:center; border-style: none;' value ='".$row['DepartmentSection']."'</td>"; ?>
      <?php echo "<td><input type='text' name='AssetType".$i."' readonly style='font-family: Courier New;text-align:center; width: 100px; border-style: none;' value ='".$row['AssetType']."'</td>"; ?>
      <?php echo "<td><input type='text' name='Duration".$i."' readonly style='font-family: Courier New;text-align:center; width: 80px; border-style: none;' value ='".$row['Duration']."'</td>"; ?>
      <?php echo "<td><input type='text' name='StartDate".$i."' readonly style='font-family: Courier New;text-align:center; width: 120px; border-style: none;' value ='".$row['StartDate']."'</td>"; ?>
      <?php echo "<td><input type='text' name='EndDate".$i."' readonly style='font-family: Courier New;text-align:center; width: 120px; border-style: none;' value ='".$row['EndDate']."'</td>"; ?>
      <?php echo "<td><input type='text' name='Reason".$i."' readonly style='font-family: Courier New;text-align:center; width: 250px; border-style: none;' value ='".$row['Reason']."'</td>"; ?>
      <?php echo "<td><input type='text' name='Laptop".$i."' readonly style='font-family: Courier New;text-align:center; width: 50px; border-style: none;' value ='".$row['Laptop']."'</td>"; ?>
      <?php echo "<td><input type='text' name='Mouse".$i."' readonly style='font-family: Courier New;text-align:center; width: 50px; border-style: none;' value ='".$row['Mouse']."'</td>"; ?>
      <?php echo "<td><input type='text' name='Keyboard".$i."' readonly style='font-family: Courier New;text-align:center; width: 50px; border-style: none;' value ='".$row['Keyboard']."'</td>"; ?>
      <?php echo "<td><input type='text' name='Tablet".$i."' readonly style='font-family: Courier New;text-align:center; width: 50px; border-style: none;' value ='".$row['Tablet']."'</td>"; ?>
      <?php echo "<td><input type='text' name='Monitor".$i."' readonly style='font-family: Courier New;text-align:center; width: 50px; border-style: none;' value ='".$row['Monitor']."'</td>"; ?>
      <?php echo "<td><input type='text' name='Desktop".$i."' readonly style='font-family: Courier New;text-align:center; width: 50px; border-style: none;' value ='".$row['Desktop']."'</td>"; ?>
      <?php echo "<td><input type='text' name='Scanner".$i."' readonly style='font-family: Courier New;text-align:center; width: 50px; border-style: none;' value ='".$row['Scanner']."'</td>"; ?>
      <?php echo "<td><input type='text' name='MultimediaProjector".$i."' readonly style='font-family: Courier New;text-align:center; width: 50px; border-style: none;' value ='".$row['MultimediaProjector']."'</td>"; ?>
      <?php echo "<td><input type='text' name='Printer".$i."' readonly style='font-family: Courier New;text-align:center; width: 50px; border-style: none;' value ='".$row['Printer']."'</td>"; ?>
      <?php echo "<td><input type='text' name='DateSubmitted".$i."' readonly style='font-family: Courier New;text-align:center; width: 120px; border-style: none;' value ='".$row['DateSubmitted']."'</td>"; ?>
      <?php echo "<td><input type='text' name='TimeSubmitted".$i."' readonly style='font-family: Courier New;text-align:center; width: 100px; border-style: none;' value ='".$row['TimeSubmitted']."'</td>"; ?>
      <?php echo "<td><input type='text' name='RequestedBy".$i."' readonly style='font-family: Courier New;text-align:center; width: 250px; border-style: none;' value ='".$row['RequestedBy']."'</td>"; ?>
      <?php echo "<td><input type='text' name='status".$i."' readonly style='font-family: Courier New;text-align:center; width: 100px; border-style: none;' value ='".$row['Status']."'</td>"; ?>
      </tr>
      <?php
        }
      ?>
  </tbody>
</table>
</div> <!-- table division -->

</div>
</form>
<?php
        if(!empty($_POST['View']))
        {
            $no = $_POST['View'];
            $no2 = 'ControlNumber'.$no;
            $no3 = $_POST[$no2];

            $fnd = odbc_exec($hris, "SELECT Status, Editable, Duration, AssetType, EndDate, RequestType from [dbo].[ITASSET_RequestForm_Sample1] where ControlNumber='".$no3."'");
            
            while ($row = odbc_fetch_array($fnd))
            {
                $stat = odbc_result($fnd,1);
                $edit = odbc_result($fnd,2);
                $dura = odbc_result($fnd,3);
                $asse = odbc_result($fnd,4);
                $endt = odbc_result($fnd,5);
                $reqt = odbc_result($fnd,6);

                if($endt < $dt)
                {
                    echo "<script>alert('( ✘ ) The request duration has expired !');</script>";
                }
                else
                {
                    if($reqt=='Issued')
                    {
                        /*odbc_exec($hris, "UPDATE [dbo].[ITASSET_RequestForm_Sample1] set Status = 'Approved', Editable = 'No' where ControlNumber='".$no3."'");
                        odbc_exec($hris, "UPDATE [misInv].[dbo].[itemmaster] set AllowCode = '".$dura."', RequestNumber = '".$no3."', InOutFlag='' where ItemCode='".$asse."'");
                        echo "<script>alert('( ✔ ) Issued Request Successfully Approved .');</script>";*/
                    }
                    elseif($reqt=='Borrowed')
                    {
                        
                        //header('location: BorrowApproveRequest.php.php');

                    }
                }
            }
        }




include_once('conn/footer.php');
?>
</body>
<?php
}//login to proceed
?>
</html>