<?php

include_once "./lib/auth.php";

unset($_SESSION["username"]);
unset($_SESSION["admin"]);

redirect();

?>
