<?php

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="css/style.css" />
<link rel="icon" href="img/BRAC_University_logo.jpg">
</head>
<body>
<?php
	require('db.php');
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['username'])){
		$username = stripslashes($_REQUEST['username']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
		$email = stripslashes($_REQUEST['email']);
		$email = mysqli_real_escape_string($con,$email);
        $mobile_no = stripslashes($_REQUEST['mobile_no']);
        $mobile_no = mysqli_real_escape_string($con,$mobile_no);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);

		$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, mobile_no, email, trn_date) VALUES ('$username', '".md5($password)."', '$mobile_no','$email', '$trn_date')";
        $result = mysqli_query($con,$query);
        $username = $_POST['username'];
        $checkdup = "SELECT * FROM users WHERE username = '".$username."'";
         $dupresult = $con->query($checkdup);
    if($dupresult = 1)
{
     
      
        print "<center> <p>Please contact you your admin";
}
        if($result){
            echo "<div class='form'><h3>You are registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
        }
    }else{


?>
<center><div class="form">
<h1>Complete your Registration</h1>
<form name="registration" action="" method="post">
<input type="text" name="username" placeholder="Username" required />
<br>
<input type="email" name="email" placeholder="Email" required />
<br>
<input type="mobile_no" name="mobile_no" placeholder="Mobile no" required />
<br>
<input type="password" name="password" placeholder="Password" required />
<br>
<input type="submit" name="submit" value="Register" />
</form>
<br /><br />
</div>
<?php } ?>
</body>
</html>
