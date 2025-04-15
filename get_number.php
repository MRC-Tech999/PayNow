<?php
$api_key = $_POST['api_key'];
$country = $_POST['country'];
$operator = $_POST['operator'];

// Étape 1: Obtenir un numéro
$url = "https://api.sms-activate.ae/stubs/handler_api.php?api_key=$api_key&action=getNumber&service=wa&country=$country&operator=$operator";
$response = file_get_contents($url);
$data = explode(':', $response);

if ($data[0] == "ACCESS_NUMBER") {
    $activation_id = $data[1];
    $number = $data[2];

    echo "<h2>Virtual Number: $number</h2>";
    echo "<p>Activation ID: $activation_id</p>";
    echo "<form action='check_status.php' method='POST'>
            <input type='hidden' name='api_key' value='$api_key'>
            <input type='hidden' name='activation_id' value='$activation_id'>
            <button type='submit'>Check SMS Code</button>
          </form>";
} else {
    echo "<p>Error: $response</p>";
}
?>
