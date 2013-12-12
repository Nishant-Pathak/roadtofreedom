<?php

define("HOST", "localhost"); // The host you want to connect to.
define("USER", "root"); // The database username.
define("PASSWORD", "freebsd"); // The database password. 
define("DATABASE", "roadtofreedom"); // The database name.

$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
?>
