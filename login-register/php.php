<?php
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

if (!empty($username) || !empty($password) || !empty($email)) {
 $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "registracija";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From register Where email = ? Limit 1";
     $INSERT = "INSERT Into register (username, password, email) values(?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sss", $username, $password, $email);
      $stmt->execute();
      echo "Uspjesna prijava!";
     } else {
      echo "Netko se vec prijavio sa tim e-mailom.";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "Potrebna su sva polja.";
 die();
}
?>