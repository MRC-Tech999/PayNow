<?php
// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'contact_form');

// Nombre de messages
$sql_messages = "SELECT COUNT(*) AS total_messages FROM messages";
$result_messages = $conn->query($sql_messages);
$row_messages = $result_messages->fetch_assoc();
$total_messages = $row_messages['total_messages'];

// Nombre de visites
$sql_visits = "SELECT COUNT(*) AS total_visits FROM visits";
$result_visits = $conn->query($sql_visits);
$row_visits = $result_visits->fetch_assoc();
$total_visits = $row_visits['total_visits'];

$conn->close();
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
    <h2>Messages reçus</h2>
    <h3>Statistiques</h3>
    <ul>
        <li>Messages reçus : <?php echo $total_messages; ?></li>
        <li>Visites sur le site : <?php echo $total_visits; ?></li>
    </ul>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>WhatsApp</th>
                <th>Message</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Récupérer les messages
            $conn = new mysqli('localhost', 'root', '', 'contact_form');
            $sql = "SELECT * FROM messages ORDER BY created_at DESC";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['name'] . "</td>
                            <td id='email-" . $row['id'] . "'>" . $row['email'] . "</td>
                            <td id='whatsapp-" . $row['id'] . "'>" . $row['whatsapp'] . "</td>
                            <td id='message-" . $row['id'] . "'>" . $row['message'] . "</td>
                            <td>" . $row['created_at'] . "</td>
                            <td>
                                <button onclick=\"copyText('email-" . $row['id'] . "')\">Copier Email</button>
                                <button onclick=\"copyText('whatsapp-" . $row['id'] . "')\">Copier WhatsApp</button>
                                <button onclick=\"copyText('message-" . $row['id'] . "')\">Copier Message</button>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Aucun message</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        function copyText(id) {
            var text = document.getElementById(id).textContent;
            navigator.clipboard.writeText(text).then(function() {
                alert('Texte copié : ' + text);
            }, function(err) {
                alert('Erreur lors de la copie : ' + err);
            });
        }
    </script>
</body>
</html>
