<?php
$ime = $_POST['ime'];
$lozinka = $_POST['lozinka'];
$email = $_POST['email'];

//Baza
$conn = new mysqli('localhost','root','','accounts');
if($conn->connect_error){
    die('Povezivanje nije uspjelo : '.$conn->connect_error);

} else {
    $stmt = $conn->prepare("insert into korisnici(ime,lozinka,email)
    values(?,?,?)");
    $stmt->bind_param("sss", $ime, $email, $lozinka);
    $stmt->execute();
    echo "Registracija je bila uspjesna!";
    $stmt->close();
    $conn->close();
}

?>