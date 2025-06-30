<?php
session_start();

// Informations d'identification admin
$admin_username = 'admin';
$admin_password = 'password123';

// Vérification des identifiants
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
    } else {
        $error_message = 'Identifiants incorrects';
    }
}

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.html');
    exit;
}

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'contact_form');

// Récupérer les messages
$sql = "SELECT * FROM messages ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0a0a1a;
            color: #e0e0ff;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .dashboard-container {
            padding: 40px;
            background: rgba(10, 10, 26, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 247, 255, 0.5);
            width: 80%;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border: 1px solid #00f7ff;
            text-align: left;
        }

        th {
            background-color: #00f7ff;
            color: #0a0a1a;
        }

        td {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .logout-btn {
            background-color: #ff00e6;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        .logout-btn:hover {
            background-color: #ff6f61;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Dashboard Admin</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Sujet</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['subject']}</td>
                            <td>{$row['message']}</td>
                            <td>{$row['created_at']}</td>
                          </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Aucun message trouvé</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="logout.php" class="logout-btn">Se déconnecter</a>
    </div>
</body>
</html>
