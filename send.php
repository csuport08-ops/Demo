<!DOCTYPE html>
<html>
<head>
  <title>Bulk SMS Sender</title>
</head>
<body>
  <h2>Send Bulk SMS</h2>
  <form method="POST">
    <label>Phone Numbers (comma-separated with country code):</label><br>
    <textarea name="phones" rows="4" cols="50" placeholder="+18146105117,+919999999999" required></textarea><br><br>

    <label>Message:</label><br>
    <textarea name="message" rows="4" cols="50" placeholder="Your message here" required></textarea><br><br>

    <input type="submit" value="Send SMS">
  </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $phones = explode(',', str_replace(' ', '', $_POST['phones']));
  $message = $_POST['message'];
  $apiKey = '40b29c6f951a66973f706c9027dcd1caf35d1524l4EC44JyrfO90g5BzmsmFQjh0'; // Replace with your paid key

  foreach ($phones as $phone) {
    $ch = curl_init('https://textbelt.com/text');
    $data = array(
      'phone' => $phone,
      'message' => $message,
      'key' => $apiKey,
    );

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    if ($result['success']) {
      echo "✅ SMS sent to $phone<br>";
    } else {
      echo "❌ Failed to send to $phone: " . htmlspecialchars($result['error']) . "<br>";
    }
  }
}
?>
</body>
</html>
