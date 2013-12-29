<?php // Login page

// Requirements
require_once "./lib/auth.php";

$bad_login = 0;

// Prevent logged in users from acessing the page.
if (isset($_SESSION["username"]))
{
	redirect();
	exit();
}

// Check if form has been filled out.
if (isset($_POST['username']) && isset($_POST['password']))
{
	$_POST["username"] = strtolower($_POST["username"]);

	if (authenticate($_POST['username'],$_POST['password']))
	{
		$_SESSION["username"] = $_POST["username"];
		$_SESSION["displayname"] = getDisplayname($_POST["username"]);
		$_SESSION["admin"] = isAdmin($_POST["username"]);

		$username = $_SESSION["username"];
		$displayname = $_SESSION["displayname"];
		$admin = $_SESSION["admin"];
		
		$_SESSION["User"] = new User($username,$displayname,$admin);
		
		// Redirect away from login page
		redirect();
		exit();
	}
	else
	{
		$bad_login = 1;
	}

}

$nerf_stat_counter = 1;

// Requirements
require_once "./lib/headder.php";

// CONTENT

echo("<div id='content'>");
?>

       <div id="logincontent">
                <div class="post" >
                        <div class="headder">
                                <h4 class="center"> Login </h4>
                        </div>
                        <div class="content">
                                <form method="post" action="login.php" onsubmit="validate(this)" name="login"><pre>
                                <label> Username </label> <input type="text" name="username" required />
                                <label> Password </label> <input type="password" name="password" required />
                                <input type="submit" value="Sign In"/>
				</pre></form>
				<?php if($bad_login) echo('<span class="red-text"> Invalid Username or Password <span>'); ?>
                        </div>
                </div>

	</div>

<?php
echo("</div>");
// END OF CONTENT

// Footer contents and closing.
require_once "./settings/footer.php";

?>
