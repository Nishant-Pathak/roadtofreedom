<?php
include 'db_connect.php';
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} 

// The hashed password from the form
$password = md5($_POST['password']);

// Create a random salt
$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
// Create salted password (Careful not to over season)
$password = hash('sha512', $password.$random_salt);
$username = $_POST['username'];
$email = $_POST['email'];
 
// Add your insert to database script here. 
// Make sure you use prepared statements!
$existing_email = "SELECT * FROM members WHERE email='".$email."'";
$result = mysqli_query($mysqli,$existing_email);
$rCount = mysqli_num_rows($result);

if( $rCount == 0) {
   if ($insert_stmt = $mysqli->prepare("INSERT INTO members (username, email, password, salt) VALUES (?, ?, ?, ?)")) {    
      $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt); 
      // Execute the prepared query.
      if($insert_stmt->execute()) {
	       header('Location: ../dashboard/?success=true');
	   }
   }
} else { 
	       header('Location: ../dashboard/?error=true');
}

?>
