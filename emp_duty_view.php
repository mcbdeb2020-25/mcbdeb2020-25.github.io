<?php

 
require('db.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Roster Duty Plan</title>
<link rel="icon" type="image/x-icon" href="logo.svg">
<style>
      table {
        width: 90%;
        border-collapse: collapse;
  
        margin: auto;
      }
      table,
      th,
      td {
        border: 2px solid black;
        padding: 15px;
      }
      thead {
        background-color: #1c87c9;
        color: #ffffff;
        font-size: 20px;;
      }
      th {
        text-align: center;
        height: 30px;
      }
      tbody tr:nth-child(odd) {
        background: #D5F5E3;
      }
      tbody tr:nth-child(even) {
        background:  #EBDEF0;
      }
    </style>
</head>
<body>

<div class="form">
<center><h2>Todays IT Personnel List</h2></center>
<h4 align="center" class="pages"><a href="index.html" style="font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 16px"></a></h4>

    <table>
      <thead>
<tr>


	<th>Morning (7.45AM-4.15PM)</th>
	<th>Evening (1.00PM-9.30PM)</th>
  <th>Leave list</th>




</tr>
</thead>
<?php
$count=1;
$sel_query="SELECT * FROM requisition WHERE duty_date = CURDATE()";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
<tr>


<tr>
    <td align="center"><?php echo $row["morning"]; ?></td>
    <td align="center"><?php echo $row["evening"]; ?></td>
    <td align="center"><?php echo $row["Leave_list"]; ?></td>
</tr>

  
<?php $count++; } ?>
  </tbody>
    </table>

<br />
<h4 align="center" class="pages"><a href="index.html" style="font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 16px"></a></h4>
</div>
</body>
</html>



