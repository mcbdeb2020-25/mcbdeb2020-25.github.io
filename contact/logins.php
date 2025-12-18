
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style.css">
      <style>
body {
  background-image: url("picture1.jpg");
  background-repeat: repeat;
  background-attachment: fixed;  
  background-size: cover;
}
</style>
  </body>
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
		$result = mysqli_query($con,$query) or die(mysqli_error());
		$rows = mysqli_num_rows($result);
        if($rows==1) {
			$_SESSION['username'] = $username;
			header("location: /contact/staff_directory.php"); // Redirect user to index.php
            }else{
				echo "<div class='form'><h3>Username/password is incorrect.</h3><br/>Click here to <a href='logins.php'>Login</a></div>";
				}
    }else{
?>
<br /><br /><br /><br /><br /><br /><br /><br />
<center><h2>Please Login</h2>
<div class="form">
<form action="" method="post" name="login">
	
<input type="text" name="username" placeholder="Username" required />
<br>
		
<input type="password" name="password" placeholder="Password" required />
<br>
<input name="submit" type="submit" value="Login" />
</form>

<p><a href="#">Back to Home</a></p>

<br /><br />

</div>
<?php } ?>


</body>
</html>
