<html>
<head>
<title>Validation Stage</title>
</head>

<?php
if(isset($_POST['submitReg']))
{
	if($_POST['name']=="" or $_POST['email']=="" or $_POST['userName']=="" 
		or $_POST['password']=="" or $_POST['confirmPassword']=="" or $_POST['gender']=="nill" 
		or $_POST['date']=="" or $_POST['month']=="" or $_POST['year']=="")
	{
		echo
		"<fieldset>
			<legend><h3>REGISTRATION</h3></legend>
				<p>check all the field</p>
				<br/>
				<a href='registration.html'>Back</a>
		</fieldset>";
	}
	else
	{
		
		if($_POST['password'] == $_POST['confirmPassword'])
		{			
			$conn = new mysqli("localhost", "root", "", "finalexam");	
			if ($conn->connect_error)
			{
				die("Connection failed: ".$conn->connect_error);
			}
			
			$name = trim($_POST['name']);
			$email = trim($_POST['email']);
			$username = trim($_POST['userName']);
			$password = trim($_POST['password']);
			$gender = trim($_POST['gender']);
			$dob = $_POST['date']."/".$_POST['month']."/".$_POST['year'];
			
			$sql = "INSERT INTO user (name,email,username,password,dob,gender) VALUES ('$name','$email','$username','$password','$dob','$gender')";
			
			if ($conn->query($sql))
			{	echo
				"<fieldset>
					<legend><h3>REGISTRATION</h3></legend>
					<p>registration successful</p>
					<br/>
					<a href='login.html'>login</a>
				</fieldset>";
			}
			else
			{	echo
				"<fieldset>
					<legend><h3>REGISTRATION</h3></legend>
					<p>registration failed, please try again later</p>
					<br/>
					<a href='registration.html'>Back</a>
				</fieldset>".$conn->error;
			}
		}
		else
		{
			echo
			"<fieldset>
				<legend><h3>REGISTRATION</h3></legend>
					<p>Both password were not same</p>
					<br/>
					<a href='registration.html'>Back</a>
			</fieldset>";
		}
	}
}


?>
</html>