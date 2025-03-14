<?php
declare(strict_types=1);

header('Access-Control-Allow-Origin: *');

require_once 'processE2u.php';
require_once 'processGlosbe.php';
require_once 'processJisho.php';
require_once 'Keys.php';
require_once 'gtranslate.php';
require_once 'kanjiLookup.php';

// echo '<pre>';
// print_r($_SERVER);
// print_r($_GET);

try {
    $dic = $_GET['dic'] ?? '';
    $word = $_GET['word'] ?? '';

    if ($dic === 'e2u') {
        $word = str_replace(' ', '+', $word);
        $url = 'https://e2u.org.ua/s?w='.$word.'&dicts=all&highlight=on&filter_lines=on';
    } else if ($dic === 'glosbe') {
        $word = str_replace(' ', '%20', $word);
        $url = 'https://uk.glosbe.com/en/uk/'.$word;
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
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $pageContent = curl_exec($ch);
    curl_close($ch);

    // echo $pageContent;

    call_user_func_array('process'.$dic, [$pageContent, $word]);
} catch(Error $e) {
    // echo $e;
    echo 'Error happend!';
    exit();
}