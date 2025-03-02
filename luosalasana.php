<?php

$palvelin = "db";
$kayttaja = "root";
$salasana = "password";

$conn = new mysqli($palvelin, $kayttaja, $salasana);

if ($conn->connect_error) {
    die("Yhteys epäonnistui: " . $conn->connect_error);
}

$conn->query("CREATE DATABASE IF NOT EXISTS salasanapankki");
$conn->select_db("salasanapankki"); 

$sql = "CREATE TABLE IF NOT EXISTS kantasalasanat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kayttajanimi VARCHAR(50) NOT NULL,
    kantasalasana VARCHAR(255) NOT NULL
);";

if ($conn->query($sql) === TRUE) {
    echo "Tietokanta luotu onnistuneesti!<br>";
} else {
    echo "Virhe tietokannan luonnissa: " . $conn->error;
}

$salasanan_enkryptio = password_hash("salasana", PASSWORD_BCRYPT);
$kantakayttajanimi = "admin";


$stmt = $conn->prepare("INSERT INTO kantasalasanat (kayttajanimi, kantasalasana) SELECT ?, ? WHERE NOT EXISTS (SELECT 1 FROM kantasalasanat WHERE kayttajanimi = ?)");
$stmt->bind_param("sss", $kantakayttajanimi, $salasanan_enkryptio, $kantakayttajanimi); 
$stmt->execute();

?>