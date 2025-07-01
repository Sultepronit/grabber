<?php
declare(strict_types=1);

/**
 * @param 'sly'|'post' $mode
 */
function useCurl(string $url, string $mode) {
    $options = [
        CURLOPT_RETURNTRANSFER => true,
    ];

    $ch = curl_init($url);
    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

useCurl('');