<!DOCTYPE html>
<html lang="en">
	<?php
  include 'db_connect.php';
  include 'login_security_functions.php';
  $username = 'Guest';
  sec_session_start();
  if(login_check($mysqli) != true) {
		session_destroy();
		header('Location: ../index.php?login=false');
		exit();
	}
  $user_id = $_SESSION['user_id'];
  $result = mysqli_query($mysqli, "SELECT * FROM members WHERE id= $user_id" );
  if(! $result) {
    die("SQL Error: " . mysqli_error($mysqli));
  }
  while ($row = mysqli_fetch_array($result)) {
    $username = $row['username'];
  }
	?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--link rel="shortcut icon" href="../../assets/ico/favicon.png"-->

    <title>Road To Freedom</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sticky-footer-navbar.css" rel="stylesheet">

  </head>

  <body>
    <!-- Wrap all page content here -->
    <div id="wrap">
