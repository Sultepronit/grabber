<?php
declare(strict_types=1);

enum CurlMode: string {
    case sly = 'sly';
    case post = 'post';
}

enum CurlMode2 {
    case sly;
    case post;
}

var_dump(CurlMode::sly);
var_dump(CurlMode2::sly);

$mode1 = CurlMode::sly;
var_dump($mode1->value);
$mode2 = CurlMode2::sly;
var_dump($mode2->value);

function useCurl2(string $url, CurlMode $mode) {
    $options = [
        CURLOPT_RETURNTRANSFER => true,
    ];

    $ch = curl_init($url);
    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}
