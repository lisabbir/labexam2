<?php

if(isset($_POST['submitReg']))
{
	if($_POST['name']=="" or $_POST['email']=="" or $_POST['username']=="" or $_POST['password']=="" or $_POST['confirmPassword']=="" or $_POST['gender']=="nill" or $_POST['date']=="" or $_POST['month']=="" or $_POST['year']=="")
	{
		echo	
		"<fieldset>
			<legend><b>REGISTRATION</b></legend>
			<center><p>Fill all the field</p></center>
		</fieldset>";
	}
	else
	{
		if($_POST['password'] == $_POST['confirmPassword'])
		{
			$conn = new mysqli("localhost", "root", "", "finalexam");
			if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			}
			
			$name=trim($_POST['name']);
			$email=trim($_POST['email']);
			$username=trim($_POST['username']);
			$password=trim($_POST['password']);
			$gender=trim($_POST['gender']);

			$dob=$_POST['date']."/".$_POST['month']."/".$_POST['year'];
			$sql = "insert into user values($name,$email,$username,$password,$gender,$dob)";

		`	if ($conn->query($sql) === TRUE) {
				echo "<fieldset>
						<legend><b>REGISTRATION</b></legend>
							<center><p>Registration Successful</p></center><br/>
							<a href="login.html">Login</a>
						</fieldset>";";
			} else {
			echo "Error: " . $conn->error;
			}
		}
		else
		{
			echo	
		"<fieldset>
			<legend><b>REGISTRATION</b></legend>
			<center><p>Both password didn't match</p></center>
		</fieldset>";	
		}

$conn->close();
		
		
	}
	
	
}