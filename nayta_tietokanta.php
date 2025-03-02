<?php

$palvelin = "db";
$kayttaja = "root";
$salasana = "password";

$conn = new mysqli($palvelin, $kayttaja, $salasana);

if ($conn->connect_error) {
    die("Yhteys epäonnistui: " . $conn->connect_error);
}

$conn->select_db("asiakashakemukset");

$sql = "SELECT * FROM asiakkaat";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div style='border: 1px solid #ccc; padding: 10px; margin: 10px 0;'>";
        echo "<strong>ID:</strong> " . $row["id"] . "<br>";
        echo "<strong>Sähköposti:</strong> " . $row["sahkoposti"] . "<br>";
        echo "<strong>Puhelinnumero:</strong> " . $row["puhelinnumero"] . "<br>";
        echo "<strong>Nimi:</strong> " . $row["nimi"] . "<br>";
        echo "<strong>Toivomukset:</strong> " . $row["toivomukset"] . "<br>";
        echo "<strong>Luontiaika:</strong> " . $row["luontiaika"] . "<br>";
        echo "</div>";
    }
} else {
    echo "Ei asiakkaita löytynyt.";
}

$conn->close();
?>
