<?php
declare(strict_types=1);

header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/Keys.php';

require_once __DIR__ . '/app/services/curl.php';
require_once __DIR__ . '/app/utils/isUkrainian.php';

require_once __DIR__ . '/app/useE2u.php';
require_once __DIR__ . '/app/useGlosbe.php';
require_once __DIR__ . '/app/useJisho.php';
require_once __DIR__ . '/app/gtranslate.php';
require_once __DIR__ . '/app/kanjiLookup.php';

try {
    $dic = $_GET['dic'] ?? '';
    $word = $_GET['word'] ?? '';
    $dic = 'e2u';
    // $dic = 'glosbe';
    // $dic = 'gtranslate';
    $dic = 'jisho';
    $dic = 'kanji-lookup';
    $word = 'snake';
    // $word = 'поміж нас';
    $word = '湖';

    if ($dic === 'e2u') {
        useE2u($word);
    } else if ($dic === 'glosbe') {
        useGlosbe($word);
    } else if ($dic === 'jisho') {
        // $word = urlencode($word);
        // $url = 'https://jisho.org/search/'.$word;
        useJisho($word);
    } else if ($dic === 'gtranslate') {
        gtranslate($word);
    } else if ($dic === 'kanji-lookup') {
        kanjiLookup($word);
    } else {
        echo 'Wrong input!';
    }
} catch(Error $e) {
    // echo $e;
    echo 'Error happend!';
    exit();
}