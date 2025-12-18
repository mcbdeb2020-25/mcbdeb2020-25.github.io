<?php

 
require('db.php');
include("auth.php");
$id=$_REQUEST['id'];
$query = "SELECT * from requisition where id='".$id."'"; 
$result = mysqli_query($con, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><center>Update Record</center></title>
<link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<div class="form">
<h2><center>Update Record</center></h2>
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_REQUEST['id'];
$trn_date = date("Y-m-d H:i:s");
$duty_date =$_REQUEST['duty_date'];
$morning = $_REQUEST['morning'];
$evening = $_REQUEST['evening'];
$submittedby = $_SESSION["username"];
$update="update requisition set trn_date='".$trn_date."', 
 duty_date='".$duty_date."', 
 morning='".$morning."',
 evening='".$evening."',
 submittedby='".$submittedby."' where id='".$id."'";
mysqli_query($con, $update) or die(mysqli_error());

$status = "<center>Record Updated Successfully. </br><center></br><a href='emp_form_view.php'>View Updated Record</a>";
echo '<p style="color:#FF0000;">'.$status.'</p>';
}else {
?>
<div>
<form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['id'];?>" />
<center> <table> 
<tr>
   <tr>
   <td>Duty Date:</td> 
   <td><input type="date" name="duty_date" required value="<?php echo $row['duty_date'];?>" /></td>
   </tr>
   <tr>
   <td>Morning:</td> 
   <td><textarea  name="morning"><?php  echo $row['morning'];?></textarea></td>
   </tr>
   <tr>
   <td>Evening:</td> 
   <td><textarea  name="evening"><?php  echo $row['evening'];?></textarea></td>
</tr>

   <tr>
   <td> <center>

     <td><input type="submit" value="Submit"/></td>  
</tr>
 </table>
 </form>
<?php } ?>

<br /><br /><br /><br />
<h4 align="center" class="pages"><a href="emp_form_view.php" style="font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 16px">Back</a></h4>
</div>
</div>
</body>
</html>
