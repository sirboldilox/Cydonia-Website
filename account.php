<?php // <CHANGE THIS TO NEW PAGE DISCRIPTION>

// Authentication functions.
require_once "./lib/auth.php";

$bad_login = 0;

// Prevent logged in users from acessing the page.
if (!isset($_SESSION["username"]))
{
	redirect();
	exit();
}

// Check if form has been filled out.
if (isset($_POST['oldpassword']) && isset($_POST['newpassword']) )
{
	if( ($_POST["newpassword"] == $_POST["renewpassword"]) && ($_POST["oldpassword"] != $_POST["newpassword"] ) )
	{
		if (authenticate($_SESSION["username"],$_POST["oldpassword"]))
		{
			updatePass($_SESSION["username"],$_POST["newpassword"] );

			$bad_login = 0;
			$pwd_sucess = 1;

			//redirect();
			//exit();*/
		}
		else
		{
			$bad_login = 1;
		}
	}
	else
	{
		$bad_login = 1;
	}
}

$nerf_stat_counter = 1;

// Headder template and functions
require_once "./lib/headder.php";

// CONTENT

echo("<div id='content'>");
?>

       <div id="logincontent">
                <div class="post" >
                        <div class="headder">
                                <h4 class="center"> Account Settings </h4>
                        </div>
                        <div class="content">
                                <form class="left-align" method="post" action="account.php" name="passchange" ><pre>
                                <label> Display Name </label><input type="text" name="displayname" autocomplete="off" value=<?php echo($_SESSION["displayname"]); ?> required /><br>
				<label> Old Password </label><input type="password" name="oldpassword" required />
                                <label> New Password </label><input type="password" name="newpassword" required /> 
                                <label> Retype New Password </label><input type="password" name="renewpassword" onchange="checkMatch()" required />
				<input type="submit" value="Submit"/>
				</pre></form>
				<?php if($bad_login) echo('<span class="red-text"> Invalid Password </span>');
				      elseif(isset($pwd_sucess)) echo('<span class="green-text"> Password Change Sucessful. </span>');
                                ?>

			</div>
                </div>

	</div>

<script type="text/javascript">

function checkMatch()
{
	if( document.passchange.newpassword.value == document.passchange.renewpassword.value )
	{
		return true;
	}
	else
	{
		alert("Passwords must match");
		document.passchange.renewpassword.focus;
		return false;
	}
}

</script>

<?php
echo("</div>");
// END OF CONTENT

// Footer contents and closing.
require_once "./settings/footer.php";

?>
