<?php
if((isset($_POST['submitLogin']) and (!($_POST['usrName'] == "" or $_POST['pas'] == ""))))
{
	$conn = new mysqli("localhost", "root", "", "finalexam");	
	if ($conn->connect_error)
	{
		die("Connection failed: ".$conn->connect_error);
	}
	$username = trim($_POST['usrName']);
	$password = trim($_POST['pas']);
	
	$sql = "SELECT name, password, email, dob, gender FROM user WHERE username = '$username'";
	$res = $conn->query($sql);
	if($res->num_rows == 0)
	{
		echo
		"<fieldset>
			<legend><h3>LOGIN</h3></legend>
			<p>Username didn't match</p>
			<a href='login.php'>try again</a>
		</fieldset>";
	}
	else
	{
		$row = $res->fetch_assoc();
		if( $row['password'] == $password )
		{
			setcookie("user", $username, time()+(86400 *30), "/");
			header("Location: loggedin_layout.php");
		}
		else
		{
			echo
			"<fieldset>
				<legend><h3>LOGIN</h3></legend>
				<p>Password didn't match</p>
				<a href='login.php'>try again</a>
			</fieldset>";
		}
	}
}
else
{
?>

<fieldset>
    <legend><b>LOGIN</b></legend>
    <form action="#" method="POST">
        <table>
            <tr>
                <td>User Name</td>
				<td>:</td>
                <td><input type="text" name="usrName"><?php if(isset($_POST['submitLogin']) && $_POST['usrName'] == "" ) {?><font style="color:red"> fill username first</font><?php } ?></td>
            </tr>
            <tr>
                <td>Password</td>
				<td>:</td>
                <td><input type="password" name="pas"><?php if(isset($_POST['submitLogin']) && $_POST['pas'] == "") {?><font style="color:red"> fill password first</font><?php } ?></td>
            </tr>
        </table>
        <hr />
		<input name="remember" type="checkbox">Remember Me
		<br/><br/>
        <input type="submit" value="Submit" name="submitLogin">        
		<a href="forgot_password.html">Forgot Password?</a>
    </form>
</fieldset>
<?php
}
?>