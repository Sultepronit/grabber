<?php
declare(strict_types=1);

function useGemini($req, $smart = false): string {
    $key = Keys::$gemini;

    $models = [
        'gemini-flash-latest',
        'gemini-3-flash-preview',
        'gemini-2.5-flash-lite',
        'gemini-2.5-flash',
    ];
    $max = $smart ? 1 : 2;
    $rn = rand(0, 2);
    // echo "rn: $rn";
    $model = $models[$rn];
    
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