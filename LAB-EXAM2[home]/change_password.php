<?php
	if(isset($_COOKIE["user"]) )
	{
		
		$usrname = trim($_COOKIE["user"]);
		$conn = new mysqli("localhost", "root", "", "finalexam");	
		if ($conn->connect_error)
		{
			die("Connection failed: ".$conn->connect_error);
		}
		$sql = "SELECT password FROM user WHERE username = '$usrname'";
		$res = $conn->query($sql);
		$row = $res->fetch_assoc();
	
		if(isset($_POST['submit']) && (!($_POST['oldPas'] == "" or $_POST['newPas'] == "" or $_POST['newPasv'] == "")) && (trim($_POST['oldPas']) == $row['password']))
		{
			if(($_POST['oldPas'] != $_POST['newPas']) && ($_POST['newPas'] == $_POST['newPasv']))
			{
				$pas = $_POST['newPas'];
				$sql = "UPDATE user SET password = '$pas' WHERE username = '$usrname'";
				
				if ($conn->query($sql))
				{	echo
					"<fieldset>
						<legend><h3>CHANGE PASSWORD</h3></legend>
						<p>password changed successfully</p>
						<br/>
						<a href='loggedin_layout.php'>HOME</a>
					</fieldset>";
				}
				else
				{	echo
					"<fieldset>
						<legend><h3>CHANGE PASSWORD</h3></legend>
						<p>Failed to change the password</p>
						<br/>
						<a href='loggedin_layout.php'>HOME</a>
					</fieldset>".$conn->error;
				}
			}
		}
		else
		{
?>

<fieldset>
    <legend><b>CHANGE PASSWORD</b></legend>
    <form action="#" method="POST">
        <table>
            <tr>
                <td><font size="3">Current Password</font></td>
				<td>:</td>
                <td><input type="password" name="oldPas"/>
				<?php if(isset($_POST['submit']) && $_POST['oldPas'] == "" ) {?><font style="color:red"> fill the field</font><?php } ?>
				<?php if(isset($_POST['submit']) && $_POST['oldPas'] != "" && $_POST['oldPas'] != $row['password']) {?><font style="color:red"> wrong password</font><?php echo $row['password']."--".$_POST['oldPas']; } ?>
				</td>
                <td></td>
            </tr>
            <tr>
                <td><font size="3" color="green">New Password</font></td>
				<td>:</td>
                <td><input type="password" name="newPas" />
				<?php if(isset($_POST['submit']) && $_POST['newPas'] == "" ) {?><font style="color:red"> fill the field</font><?php } ?>
				<?php if(isset($_POST['submit']) && $_POST['oldPas'] == $_POST['newPas']) {?><font style="color:red"> same as old password</font><?php } ?>
				</td>
                <td></td>
            </tr>
            <tr>
                <td><font size="3" color="red">Retype New Password</font></td>
				<td>:</td>
                <td><input type="password" name="newPasv" />
				<?php if(isset($_POST['submit']) && $_POST['newPasv'] == "" ) {?><font style="color:red"> fill the field</font><?php } ?>
				<?php if(isset($_POST['submit']) && $_POST['newPasv'] != $_POST['newPas']) {?><font style="color:red"> did not match with new password</font><?php } ?>
				</td>
                <td></td>
            </tr>
        </table>
        <hr />
        <input type="submit" value="Submit" name="submit" />
    </form>
</fieldset>
<?php
		}
	}
	else
	{
		echo "Please login first";
	}
?>