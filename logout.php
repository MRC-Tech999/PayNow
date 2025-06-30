<?php
session_start();
session_destroy(); // Détruire la session pour déconnecter l'admin
header('Location: login.html'); // Rediriger vers la page de connexion
exit;
?>
