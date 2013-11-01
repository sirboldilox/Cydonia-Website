<?php // <CHANGE THIS TO NEW PAGE DISCRIPTION>

require_once "../settings/auth.php";

// Manually change for page access, Defualt=false;
$lockpage = true;

// Manually Lock out the page
if($lockpage)
{
	redirect();
	exit();
}

// Process MySQL post add
if(isset($_POST["username"]) && isset($_POST["password"]))
{
	updatePass($_POST["username"],$_POST["password"],1);
}

?>
<html>
<meta charset="UTF-8" />
<meta name="google" content="notranslate">
<meta http-equiv="Content-Language" content="en" />

<head>
 <link rel="stylesheet" type="text/css" href="/stylesheets/reset.css">
 <link rel="stylesheet" type="text/css" href="/stylesheets/style.css">
 <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
 <title>Cydonia MC</title>
</head>
<body>
       <div id="newsfeed">
                <div class="post" >
                        <div class="headder">
                                <h4 class="center"> Reset </h4>
                        </div>
                        <div class="content">
                                <form method="post" action="/admin/password.php"><pre>
                                Username <input type="text" name="username"/>
                                Password <input type="text" name="password"/>
                                <input type="submit" value="Submit"/>
                                </pre></form>
                                <?php if($bad_login) echo('<span class="red-text"> Invalid Username or Password <span>'); ?>
                        </div>
                </div>
	</div>
</body>
</html>
