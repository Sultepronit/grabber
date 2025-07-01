<?php

function kanjiLookup($kanji) {
    $key = Keys::$gemini;
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$key";

    // $req = "generate a list of kanji (kanji only, comma separated) that contains same lements as $kanji and resemble it";
    // $req = "generate a list of kanji (kanji only, comma separated) that contain same/similar elements as $kanji and may resemble it";
    // $req = "generate a list of kanji (kanji only, comma separated) that contain same/similar elements as $kanji and may look similar";
    $req = "generate a list of kanji (kanji only, no separator) that contains same/similar elements as $kanji and/or looks similar";

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
    echo $response;

    preg_match_all('/\p{Han}+/u', $response, $matches);
    $allKanji = implode('', $matches[0]);
    $uniqueKanji = array_unique(preg_split('//u', $allKanji, -1, PREG_SPLIT_NO_EMPTY));
    // print_r($matches[0]);
    // echo json_encode($matches[0], JSON_UNESCAPED_UNICODE);
    echo implode('', $uniqueKanji);
}