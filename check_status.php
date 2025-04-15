<?php
$api_key = $_POST['api_key'];
$activation_id = $_POST['activation_id'];

$url = "https://api.sms-activate.ae/stubs/handler_api.php?api_key=$api_key&action=getStatus&id=$activation_id";
$response = file_get_contents($url);

if (strpos($response, 'STATUS_OK') !== false) {
    $code = explode(':', $response)[1];
    echo "<h2>Received Code: $code</h2>";
} else {
    echo "<p>Status: $response</p>";
    echo "<form method='POST'>
            <input type='hidden' name='api_key' value='$api_key'>
            <input type='hidden' name='activation_id' value='$activation_id'>
            <button type='submit'>Refresh</button>
          </form>";
}
?>
