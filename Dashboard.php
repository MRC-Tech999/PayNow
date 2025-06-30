<?php
session_start();

// Informations d'identification admin
$admin_username = 'admin';
$admin_password = 'password123';

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
    } else {
        $error_message = 'Identifiants incorrects';
    }
}

// Si l'admin n'est pas connecté, rediriger vers la page de connexion
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Bienvenue sur le Dashboard Admin</h2>
        <p>Nombre de messages reçus : <strong>50</strong></p> <!-- Exemple de statistiques -->
        <p>Visites sur le site : <strong>100</strong></p>
        
        <a href="logout.php" class="logout-btn">Se déconnecter</a>
    </div>
</body>
</html>
