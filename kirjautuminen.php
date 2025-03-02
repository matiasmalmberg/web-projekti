<?php
session_start(); 

$palvelin = "db";
$kayttaja = "root";
$salasana = "password";
$salasanapankki = "salasanapankki";

$conn = new mysqli($palvelin, $kayttaja, $salasana, $salasanapankki);

if ($conn->connect_error) {
    die("Yhteys epäonnistui: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $anna_kayttaja = $_POST["kayttajanimi"]; 
    $anna_salasana = $_POST["kantasalasana"]; 

    $stmt = $conn->prepare("SELECT kantasalasana FROM kantasalasanat WHERE kayttajanimi = ?");
    
    if ($stmt) {
        $stmt->bind_param("s", $anna_kayttaja);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($tulos);
            $stmt->fetch();

            if (password_verify($anna_salasana, $tulos)) {
                $_SESSION["kayttajanimi"] = $anna_kayttaja; 
                header("Location: tietokantakatselu.html"); 
                exit(); 
            } else {
                echo "Virheellinen salasana!"; 
            }
        } else {
            echo "Käyttäjää ei löytynyt!"; 
        }


        $stmt->close();
    } else {
        echo "Virhe tietokannan kyselyssä: " . $conn->error; 
    }
}

$conn->close(); 
?>
