<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $phone = $_POST['phone'];
  $message = $_POST['message'];

  $ch = curl_init('https://textbelt.com/text');
  $data = array(
    'phone' => $phone,
    'message' => $message,
    // Add your API key directly here
    'key' => '40b29c6f951a66973f706c9027dcd1caf35d1524l4EC44JyrfO90g5BzmsmFQjh0',
  );

  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $response = curl_exec($ch);
  curl_close($ch);

  $result = json_decode($response, true);

  echo "<h3>SMS Status:</h3>";
  if ($result['success']) {
    echo "✅ SMS sent successfully to $phone!";
  } else {
    echo "❌ Failed to send SMS. Error: " . htmlspecialchars(json_encode($result));
  }
}
?>
