<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Connexion à la base de données
    $conn = new mysqli('localhost', 'root', '', 'contact_form');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insertion des données dans la base
    $sql = "INSERT INTO messages (name, email, subject, message) 
            VALUES ('$name', '$email', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Message envoyé avec succès";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
