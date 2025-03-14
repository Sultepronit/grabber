<?php

function kanjiLookup($kanji) {
    $key = Keys::$gemini;
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$key";

    // $req = "generate a list of kanji (kanji only, comma separated) that contains same lements as $kanji and resemble it";
    $req = "generate a list of kanji (kanji only, comma separated) that contain same/similar elements as $kanji and may resemble it";

    $data = [
        'contents' => [
            [
                'parts' => [
                    ['text' => $req]
                ]
            ]
        ]
    ];

    // echo json_encode($data);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    curl_close($ch);
    // echo $response;

    preg_match_all('/\p{Han}+/u', $response, $matches);
    // print_r($matches[0]);
    echo json_encode($matches[0], JSON_UNESCAPED_UNICODE);
}