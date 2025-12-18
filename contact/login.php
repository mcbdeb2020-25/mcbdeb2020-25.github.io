
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>

      <link rel="stylesheet" href="css/style.css">
      
</head>

<?php
	require('budbconnection.php');
	session_start();
    // If form submitted, insert values into the database.
    if (isset($_POST['username'])){
		
		$username = stripslashes($_REQUEST['username']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
		
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `users` WHERE username='$username' and password='".md5($password)."'";
		$result = mysqli_query($con,$query) or die(mysqli_error($con));
		$rows = mysqli_num_rows($result);
        if($rows==1) {
			$_SESSION['username'] = $username;
			header("location: view_member.php"); // Redirect user to index.php
            }else{
				echo "<div class='form'><h3>Username/password is incorrect.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
				}
    }else{
?>

<center><h2>Please Login</h2>
<div class="form">
<form action="" method="post" name="login">
	
<input type="text" name="username" placeholder="Username" required />
<br>
		
<input type="password" name="password" placeholder="Password" required />
<br>
<input name="submit" type="submit" value="Login" />
</form>

<p><a href='http://115.127.80.7:9085/'>Back to Home</a></p>

<br /><br />

</div>
<?php } ?>


</body>
</html>
