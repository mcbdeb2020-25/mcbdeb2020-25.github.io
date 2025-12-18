
<?php

 
require('db.php');
include("auth.php");

$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$trn_date = date("Y-m-d H:i:s");
$duty_date = $_REQUEST['duty_date'];
$morning =$_REQUEST['morning'];
$evening = $_REQUEST['evening'];
$submittedby = $_SESSION["username"];
$ins_query="insert into requisition (`trn_date`,
`duty_date`,
`morning`,`evening`,`submittedby`) 
values ('$trn_date','$duty_date','$morning','$evening','$submittedby')";
mysqli_query($con,$ins_query) or die(mysql_error());
$status = "New Record Inserted Successfully.</br>";

}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>IT Personnel Duty form</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/styles.css">

</head>
<center>
<div class="form">
</center>
  <center>
  <div>
<style>
body {
  background-image: url("picture1.jpg");
  background-repeat: repeat;
}
</style>
  </body>
  <style>
  header {
  text-align: center;
  font-size: 20px;
  color: black;
  background-color: skyblue;
 
}
</style>
<header>
  <h2>Enter the IT Personnel Name List </h2>
</header>
<form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" />
 <center> <table> 
  
<tr>
  <tr>
   <td>Duty Date:</td>
<td>
<input type="date" name="duty_date"></td>
    
 </tr>

   <tr>
   <td>Morning:</td> 
   <td><textarea name="morning" rows="5" cols="40"></textarea></td>

   </tr>
   <tr>
   <td>Evening:</td> 
  <td><textarea name="evening" rows="5" cols="40"></textarea>
   </td>

 
</tr>
 </table></center>
 <br>
 <center><div>
  <input type="submit" value="Submit">
</div>
  </center>
 </form>
</div>
<center>

<center><p style="color:#F633FF;"><?php echo $status; ?></p>

<h4 align="center" class="pages"><a href="employee_menu.html" style="font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 16px">Back</a></h4>
</div>
</div>
</body>
</html>