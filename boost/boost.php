<?php
$summ = $_POST['summ'];
$divizija = $_POST['divizija'];
$email = $_POST['email'];
$regija = $_POST['regija'];

if (!empty($summ) || !empty($divizija) || !empty($email) !empty($regija)) {
 $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "accounts";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From obrasci Where email = ? Limit 1";
     $INSERT = "INSERT Into obrasci (summ, divizija, email,regija) values(?, ?, ?,?)";
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
      $stmt->bind_param("ssss", $summ, $divizija, $email,$regija);
      $stmt->execute();
      echo "Hvala, pregledat cemo tvoj obrazac!";
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