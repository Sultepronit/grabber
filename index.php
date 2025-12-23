<?php
declare(strict_types=1);

header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/Keys.php';

require_once __DIR__ . '/app/services/curl.php';
require_once __DIR__ . '/app/services/useGemini.php';
require_once __DIR__ . '/app/utils/isUkrainian.php';

require_once __DIR__ . '/app/useE2u.php';
require_once __DIR__ . '/app/geminiEn.php';
require_once __DIR__ . '/app/useSlovnyk.php';
require_once __DIR__ . '/app/useGlosbe.php';
require_once __DIR__ . '/app/useJisho.php';
require_once __DIR__ . '/app/gtranslate.php';
require_once __DIR__ . '/app/kanjiLookup.php';

try {
    $dic = $_GET['dic'] ?? '';
    $word = $_GET['word'] ?? '';
    // $dic = 'e2u';
    // // $dic = 'glosbe';
    // // $dic = 'gtranslate';
    // $dic = 'jisho';
    // $dic = 'kanji-lookup';
    // $dic = 'gem-en';
    // $dic = 'ua-ua';
    // $word = 'snake';
    // $word = 'поміж нас';
    // $word = '湖';
    // $word = '格';
    // $word = '亦心'; // 恋
    // $word = '木公';
    // $word = '女生';
    // $word = '疲';
    // $word = '心門文'; // 憫
    // $word = '周'; // 彫
    // $word = '論';
    // $word = '殴';
    // $word = 'down the road';
    // // $word = 'apple pie';
    // $word = 'in my heart of hearts';
    // $word = 'in my heart of herts';
    // $word = 'give me a break';
    // $word = 'if I was you I\'d wanna be me too';
    // $word = 'вражаюча повня';
    // $word = 'très bien';
    // $word = 'donning an ominous air';
    // $word = 'офіс президента України';
    // $word = 'even as experts go';
    // $word = 'повня';
    // $word = "hard-fast";
    // $word = "execute by degrees";
    // $word = "go belly up";
    // $word = "without knowing my left from my right";

    if ($dic === 'e2u') {
        useE2u($word);
    } else if ($dic === 'gem-en') {
        useGeminiEn($word);
    } else if ($dic === 'ua-ua') {
        useSlovnyk($word);
    } else if ($dic === 'glosbe') {
        useGlosbe($word);
    } else if ($dic === 'jisho') {
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