<?php
declare(strict_types=1);

header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/Keys.php';

require_once __DIR__ . '/app/services/curl.php';
require_once __DIR__ . '/app/utils/isUkrainian.php';

require_once __DIR__ . '/app/useE2u.php';
require_once __DIR__ . '/app/useGlosbe.php';
require_once __DIR__ . '/app/processJisho.php';
require_once __DIR__ . '/app/gtranslate.php';
require_once __DIR__ . '/app/kanjiLookup.php';

// echo '<pre>';
// print_r($_SERVER);
// print_r($_GET);

try {
    $dic = $_GET['dic'] ?? '';
    $word = $_GET['word'] ?? '';
    $dic = 'e2u';
    $dic = 'glosbe';
    // $dic = 'gtranslate';
    $word = 'snake';
    // $word = 'поміж нас';

    if ($dic === 'e2u') {
        // $word = str_replace(' ', '+', $word);
        // $url = 'https://e2u.org.ua/s?w='.$word.'&dicts=all&highlight=on&filter_lines=on';
        useE2u($word);
    } else if ($dic === 'glosbe') {
        // $word = str_replace(' ', '%20', $word);
        // $url = 'https://uk.glosbe.com/en/uk/'.$word;
        useGlosbe($word);
    } else if ($dic === 'jisho') {
        $word = urlencode($word);
        $url = 'https://jisho.org/search/'.$word;
    } else if ($dic === 'gtranslate') {
        gtranslate($word);
        exit();
    } else if ($dic === 'kanji-lookup') {
        kanjiLookup($word);
        exit();
    } else {
        echo 'Wrong input!';
        exit();
    }

    // $pageContent = file_get_contents($url); 
    // $ch = curl_init($url);
    // // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt_array($ch, [
    //     CURLOPT_RETURNTRANSFER => true,
    //     CURLOPT_FOLLOWLOCATION => true,
    //     CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 Chrome/119.0.0.0 Safari/537.36',
    //     CURLOPT_REFERER => 'https://e2u.org.ua/',
    //     CURLOPT_HTTPHEADER => [
    //         'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
    //         'Accept-Language: en-US,en;q=0.9',
    //     ],
    // ]);

    // $pageContent = curl_exec($ch);
    // curl_close($ch);

    // // echo $pageContent;

    // call_user_func_array('process'.$dic, [$pageContent, $word]);
} catch(Error $e) {
    echo $e;
    echo 'Error happend!';
    exit();
}