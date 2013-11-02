<?php // <CHANGE THIS TO NEW PAGE DISCRIPTION>

require_once "../lib/auth.php";

// Redirect none logged in users, or none admins.
if(isset($_SESSION["username"]))
{
	if(!$_SESSION["admin"])
	{
		redirect();
		exit();
	}
}
else
{
	redirect();
	exit();
}

// Quick Messy server starter
//
if(isset($_POST["serverstart"]))
{
	echo shell_exec("/home/beast/script/mcstart.sh FTB/Unleashed");
	echo "Server Started";
}

// Process MySQL post add
elseif(isset($_POST["headder"]) && isset($_POST["content"]))
{
	$headder = $_POST["headder"];
	$username = $_SESSION["username"];
	$content = $_POST["content"];

	$QUERY = "INSERT INTO newsfeed (headder,username,postdate,content) VALUES ('$headder','$username',now(),'$content');";

	// echo($QUERY);
	$QueryReturn = mysql_query($QUERY);

	//var_dump($QueryReturn);
	echo("POST ADDED");
}

// Headder template and functions
require_once "../lib/headder.php";

// CONTENT
echo("<div id='content'>");
	//echo("Admin Panel");

?>
       <div id="newsfeed">
                <div class="post" >
                        <div class="headder">
                                <h4 class="center"> Add new post </h4>
                        </div>
                        <div class="content">
                                <form method="post" action="/admin/index.php"><pre>
                                Title <input type="text" name="headder"/>
                                <textarea cols="40" rows="5" name="content"></textarea>
                                <input type="submit" value="Submit"/>
                                </pre></form>
                                <?php if($bad_login) echo('<span class="red-text"> Invalid Username or Password <span>'); ?>
                        </div>
                </div>
	</div>

	<div id="sidepanel">
		<div class="post">
			<div class="headder">
				<h4 class="center"> Side Thing </h4>
			</div>
			<div class="content center">
				<form method="post" action="/admin/index.php">
				<input type="submit" name="serverstart" value="Start Server"/>
				</form>
			</div>
			<div class="content">
			</div>
		</div>
	</div>
<?php
echo("</div>");
// END OF CONTENT

// Footer contents and closing.
require_once "../settings/footer.php";

?>
