<?php
declare(strict_types=1);

function useGemini($req): string {
    $key = Keys::$gemini;

    $models = [
        'gemini-flash-latest',
        'gemini-2.5-flash-lite',
        'gemini-3-flash-preview',
        'gemini-2.5-flash',
    ];
    $model = $models[rand(0, 1)];
    
    $url = "https://generativelanguage.googleapis.com/v1beta/models/$model:generateContent?key=$key";

    $data = [
        'contents' => [
            [
                'parts' => [
                    ['text' => $req]
                ]
            ]
        ]
    ];

    $response = useCurl($url, 'post', null, $data);
    // echo $response;

    $array = json_decode($response, true);
    $text = $array['candidates'][0]['content']['parts'][0]['text'];

    return $text;
}