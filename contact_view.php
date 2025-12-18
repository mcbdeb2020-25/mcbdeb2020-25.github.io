<?php

 
require('db.php');

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>View Records</title>
<style>
      table {
        width: 70%;
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
<center><h2>IT Personnel Contact Details</h2></center>



    <table>
      <thead>
<tr>

	<th>Name</th>
	<th>Blood Group</th>
	<th>Spouse Contact</th>
    <th>Family Contact</th>
    <th>Present Address</th>
    <th>Parmanent Address</th>

</tr>
</thead>
<?php
$count=1;
$sel_query="SELECT * FROM user ";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
<tr>

	<td align="center"><?php echo $row["u_name"]; ?></td>
	<td align="center"><?php echo $row["blood"]; ?></td>
	<td align="center"><?php echo $row["s_number"]; ?></td>
    <td align="center"><?php echo $row["f_number"]; ?></td>
    <td align="center"><?php echo $row["pr_address"]; ?></td>
    <td align="center"><?php echo $row["pa_address"]; ?></td>

<?php $count++; } ?>
  </tbody>
    </table>

<br />

</div>
</body>
</html>



