<?php
$dotenv = parse_ini_file('.env');
$apiKey = $dotenv['OPENAI_API_KEY'];

$data = [
  'model' => 'command',
  'prompt' => 'Your input here',
  'max_tokens' => 100
];

$ch = curl_init('https://api.cohere.ai/v1/generate');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  'Content-Type: application/json',
  'Authorization: ' . 'Bearer ' . $apiKey,
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);
echo $result['generations'][0]['text'];

?>

