<?php

function gtranslate($expression) {
    $key = Keys::$translate;
    $url = "https://translation.googleapis.com/language/translate/v2?key=$key";

    $data = [
        'q' => $expression,
        'source' => 'en',
        'target' => 'uk',
        'format' => 'text',
    ];

    // $ch = curl_init($url);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_POST, true);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // $response = curl_exec($ch);
    // curl_close($ch);
    // echo $response;

    $response = useCurl($url, 'post', null, $data);

    $result = json_decode($response, true);
    echo $result['data']['translations'][0]['translatedText'];
}