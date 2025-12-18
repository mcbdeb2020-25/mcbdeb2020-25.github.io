<?php

 
require('db.php');
include("auth.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>View Records</title>
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
      }
      thead {
        background-color: #1c87c9;
        color: #ffffff;
        font-size: 20px;;
      }
      th {
        text-align: center;
        height: 50px;
      }
      tbody tr:nth-child(odd) {
        background: #D5F5E3;
      }
      tbody tr:nth-child(even) {
        background: #EBDEF0;
      }
    </style>
</head>
<body>

<div class="form">
<center><h2>Roster Duty Plan_April 2024</h2></center>

<h4 align="center" class="pages"><a href="employee_menu.php" style="font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 16px">Back</a></h4>

    <table>
      <thead>
<tr>
<center><input type="text" id="search-input" onkeyup="searchContacts()" placeholder="Search by name">
	<th>Roster Duty Date</th>
	<th>Morning (7.45AM-4.15PM)</th>
	<th>Evening (1.00PM-9.30PM)</th>

	<th>Edit</th>
	<th>sub.by</th>

</tr>
</thead>
<?php
$count=1;
$sel_query="SELECT * FROM requisition WHERE duty_date BETWEEN '2024-04-01' AND '2024-04-30'";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
<tr>

	<td align="center"><?php echo $row["duty_date"]; ?></td>
	<td align="center"><?php echo $row["morning"]; ?></td>
	<td align="center"><?php echo $row["evening"]; ?></td>
	<td align="center"><a href="emp_form_edit.php?id=<?php echo $row["id"]; ?>">Edit</a></td>
	<td align="center"><?php echo $row["submittedby"]; ?></td> </tr>
<?php $count++; } ?>
  </tbody>
    </table>

<br />
<h4 align="center" class="pages"><a href="employee_menu.php" style="font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 16px">Back</a></h4>
</div>
</body>
</html>



