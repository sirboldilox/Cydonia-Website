<!DOCTYPE html>
<html>

<head>
 <link rel="stylesheet" type="text/css" href="reset.css">
 <link rel="stylesheet" type="text/css" href="./loginstyle.css">
 <link rel="icon" href="/images/setting.png" type="image/x-icon">
 <title> Settings </title>
</head>

<?php
	include './phpfunc.php';
	 /* debuging */ var_dump($_POST);


	if(!$_POST) $LOGIN=0;
	elseif( ($_POST["user"]=="news") && ($POST_["pass"]="editthis") ) $LOGIN=1;
	elseif( ($_POST["title"]) || ($_POST["comment"]) ) $LOGIN=1;

	if(!$LOGIN)
		{
		//Display Login Form

		echo("<div id='login'>");
		echo("<h1>Login</h1>");
		echo("<form action='admin.php' method='post'>");
		echo("Username: <input type='text' name='user'><br>");
		echo("Password: <input type='text' name='pass'><input type='submit'>");
		echo("</form>");
		echo("</div>");
		}
	else { ?>

<body>
    <div id="container">
	<div id="banner">
		<div id = "bannerimage">
			<a href="/" ><img src="/images/cydoniamc.png" alt="Cydonia MC" height="75" width="418"></a>
		</div>
		<div id="titlebanner">
			<h1> Custom Webpage Admin    </h1>
		</div>
	</div id="form">
		<h3>News Feed Form</h3>
		<form action='admin.php' method='post'>
		Title: <input type="text" name='title'><br>
		<textarea cols="50" rows="4" name="comment"></textarea>
		<input type="submit">
		</form>
	</div>

</body>

<?php }

?>
</html>
