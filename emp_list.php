<?php
require('db.php');

$status = "";

if(isset($_POST['new']) && $_POST['new'] == 1) {
    $trn_date = date("Y-m-d H:i:s");

    // Check if name is set
    if(isset($_POST['name'])) {
        $name = $_POST['name'];

        // Check if the name already exists for the current date
        $check_query = "SELECT * FROM name_list WHERE name = '$name' AND DATE(trn_date) = CURDATE()";
        $check_result = mysqli_query($con, $check_query);

        if(mysqli_num_rows($check_result) > 0) {
            $status = "Error: This name already exists for today.";
        } else {
            // Insert the new record if the name doesn't exist for today
            $ins_query = "INSERT INTO name_list (`trn_date`,`name`) 
                        VALUES ('$trn_date','$name')";
            mysqli_query($con, $ins_query) or die(mysqli_error($con));
            $status = "New Record Inserted Successfully.</br>";
        }
    } else {
        $status = "Error: Name is required.";
    }
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
     <td>Name:</td>
    
   <td> <select id='selUser' name="name" style='width: 200px;' required>
                            <option value=''>-- Select Name --</option>  
                               <option value="Mohadab Chandra Bormon">Mohadab Chandra Bormon</option>
                               <option value="Kazi Shahadat Hossain">Kazi Shahadat Hossain</option>
                               <option value="Mohammad Mohsin Rumi">Mohammad Mohsin Rumi</option>
                               <option value="Minhajur Rahman">Minhajur Rahman</option>
                               <option value="Khairul Kabir">Khairul Kabir</option>
                               <option value="Shoyaib Forhad">Shoyaib Forhad</option>
                               <option value="Saddam Hossain">Saddam Hossain</option>
                               <option value="Naeem Masud">Naeem Masud</option>
                               <option value="Ajijul Hakim Khandakar Turag">Ajijul Hakim Khandakar Turag</option>
                               <option value="Salahuddin">Salahuddin</option>
                               <option value="Saidur Rahman">Saidur Rahman</option>
                               <option value="Shah Alam Palash">Shah Alam Palash</option>
                               <option value="Shanaullh Raton">Shanaullh Raton</option>
                               <option value=" Afsarul Amin"> Afsarul Amin</option>
                               <option value="Alamgir Hossain">Alamgir Hossain</option>
                               <option value="Naser Md. Isteaque Alam">Naser Md. Isteaque Alam</option>
                               <option value="Abdul Malek">Abdul Malek</option>
                               <option value="Sarjil Mahmud">Sarjil Mahmud</option>
                               <option value="Shanaullh Raton">Shanaullh Raton</option>
                               <option value="Saddam Hossain Bhuiyan">Saddam Hossain Bhuiyan</option>
                             
                            </select>    
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

<h4 align="center" class="pages"><a href="" style="font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 16px">Back</a></h4>
</div>
</div>
</body>
</html>
