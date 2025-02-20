<?php

$palvelin = "db";
$kayttaja = "root";
$salasana = "password";

$conn = new mysqli($palvelin, $kayttaja, $salasana);

if ($conn->connect_error) {
    die("Yhteys epäonnistui: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS asiakashakemukset CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
if ($conn->query($sql) === TRUE) {
    echo "Tietokanta luotu onnistuneesti!<br>";
} else {
    echo "Virhe tietokannan luonnissa: " . $conn->error;
}

$conn->select_db("asiakashakemukset");

$sql = "CREATE TABLE IF NOT EXISTS asiakkaat (
  id INT PRIMARY KEY AUTO_INCREMENT,
  sahkoposti VARCHAR(50) NOT NULL UNIQUE,
  puhelinnumero VARCHAR(15) NOT NULL UNIQUE, 
  nimi VARCHAR(50) NOT NULL,
  toivomukset VARCHAR(500) NOT NULL,
  luontiaika TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX (sahkoposti)
)";
if ($conn->query($sql) === TRUE) {
    echo "Taulu 'asiakkaat' luotu onnistuneesti!";
} else {
    echo "Virhe taulun luonnissa: " . $conn->error;
}

$conn->close();
?>