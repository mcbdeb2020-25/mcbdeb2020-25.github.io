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
        width: 30%;
        border-collapse: collapse;
        margin: auto;
        text-size-adjust: 60px;
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
        font-size: 20px;
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

      /* Blinking Animation */
      @keyframes blink {
        0% { background-color: ghostwhite; }
        50% { background-color: paleturquoise; }
        100% { background-color: cornsilk; }
        0% { color: green; }
        50% { color: blue; }
        100% { color: orchid; }
      }

      .highlight td:first-child {
        animation: blink 1s infinite alternate;
        font-size: 24px; /* Adjust font size as needed */
    
      }
      body {
  background-image: url("picture1.jpg");

}
</style>
</head>
<body>

<div class="form">
<center><h2>Todays Active list</h2></center>
<h4 align="center" class="pages"><a href="index.html" style="font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 16px"></a></h4>

    <table>
      <thead>
       
      </thead>
      <tbody>
<?php
$count = 1;
$sel_query = "SELECT * FROM name_list WHERE DATE(trn_date) = CURDATE()";
$result = mysqli_query($con, $sel_query);
if ($result) {
    while($row = mysqli_fetch_assoc($result)) {
        // Add 'highlight' class to each row
        echo "<tr class='highlight'>";
        echo "<td align='center'>" . $row["name"] . "</td>";
        echo "</tr>";
        $count++;
    }
} else {
    echo "Error: " . mysqli_error($con);
}
?>
      </tbody>
    </table>

<br />
<h4 align="center" class="pages"><a href="index.html" style="font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 16px"></a></h4>
</div>
</body>
</html>
