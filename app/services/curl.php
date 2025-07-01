<?php
declare(strict_types=1);

function prepareSlyOptions(string $refrerer) {
    return [
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/119.0.0.0 Safari/537.36',
        CURLOPT_REFERER => $refrerer,
        CURLOPT_HTTPHEADER => [
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
            'Accept-Language: en-US,en;q=0.9',
        ]
    ];
}

function preparePostOptions($data) {
    return [
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS => json_encode($data)
    ];
} 

/**
 * @param 'sly'|'post'|null $mode
 */
function useCurl(
    string $url,
    ?string $mode = null,
    ?string $refrerer = null,
    mixed $postData = null
) {
    $options = [
        CURLOPT_RETURNTRANSFER => true,
    ];


    switch($mode) {
        case 'sly':
            $options += prepareSlyOptions($refrerer);
            break;
        case 'post':
            $options += preparePostOptions($postData);
            break;
    }

    $ch = curl_init($url);
    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

// useCurl('', 'sly');