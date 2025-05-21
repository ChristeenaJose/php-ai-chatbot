<?php
$dotenv = parse_ini_file('.env');
$apiKey = $dotenv['OPENAI_API_KEY'];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $prompt = $_POST['prompt'];

    $apiKey = 'YOUR_OPENAI_API_KEY'; // replace or load from .env

    $postData = [
        'model' => 'gpt-3.5-turbo',
        'messages' => [['role' => 'user', 'content' => $prompt]],
    ];

    $ch = curl_init('https://api.openai.com/v1/chat/completions');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: ' . 'Bearer ' . $apiKey,
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);
    $reply = $result['choices'][0]['message']['content'];

    echo "<h2>AI Response:</h2><p>$reply</p>";
    echo '<a href="index.html">Back</a>';
} else {
    echo "Invalid request.";
}
?>

