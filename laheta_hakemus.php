<?php

$palvelin = "db";
$kayttaja = "root";
$salasana = "password";
$tietokanta = "asiakashakemukset";

$conn = new mysqli($palvelin, $kayttaja, $salasana, $tietokanta);

if ($conn->connect_error) {
    die("Yhteys epäonnistui: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sahkoposti = $conn->real_escape_string($_POST['sahkoposti']);
    $puhelin = $conn->real_escape_string($_POST['puhelin']);
    $nimi = $conn->real_escape_string($_POST['nimi']);
    $toivo = $conn->real_escape_string($_POST['toivo']);

    
    $sql = "INSERT INTO asiakkaat (sahkoposti, puhelinnumero, nimi, toivomukset) 
            VALUES ('$sahkoposti', '$puhelin', '$nimi', '$toivo')";

    if ($conn->query($sql) === TRUE) {
        echo "Hakemus lähetetty onnistuneesti!";
    } else {
        echo "Virhe: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>