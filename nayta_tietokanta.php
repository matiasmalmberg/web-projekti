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
    echo "<tr>
            <th>ID</th>
            <th>Sähköposti</th>
            <th>Puhelinnumero</th>
            <th>Nimi</th>
            <th>Toivomukset</th>
            <th>Luontiaika</th>
          </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["sahkoposti"] . "</td>";
        echo "<td>" . $row["puhelinnumero"] . "</td>";
        echo "<td>" . $row["nimi"] . "</td>";
        echo "<td>" . $row["toivomukset"] . "</td>";
        echo "<td>" . $row["luontiaika"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Ei asiakkaita löytynyt.";
}

$conn->close();
?>