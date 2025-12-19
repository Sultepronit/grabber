<?php
declare(strict_types=1);

function kanjiLookup($kanji) {
    // $req = "generate a list of kanji (kanji only, comma separated) that contains same lements as $kanji and resemble it";
    // $req = "generate a list of kanji (kanji only, comma separated) that contain same/similar elements as $kanji and may resemble it";
    // $req = "generate a list of kanji (kanji only, comma separated) that contain same/similar elements as $kanji and may look similar";
    $req = "generate a list of kanji (kanji only, no separator) that contains same/similar elements as $kanji and/or look similar";

    $response = useGemini($req);
    preg_match_all('/\p{Han}+/u', $response, $matches);
    $allKanji = implode('', $matches[0]);
    $uniqueKanji = array_unique(preg_split('//u', $allKanji, -1, PREG_SPLIT_NO_EMPTY));
    // print_r($matches[0]);
    // echo json_encode($matches[0], JSON_UNESCAPED_UNICODE);
    echo implode('', $uniqueKanji);
}

// $kanji = '湖'; // той, що вже є
// $response = '淇涸沽湘潮湖測'; // відповідь від Gemini
// 糊醐江河海潮漢韓朝津波深涯濁濯渇汗

// // Фільтруємо кожен символ, залишаючи лише ті, що не дорівнюють $kanji
// $filtered = implode('', array_filter(
//     preg_split('//u', $response, -1, PREG_SPLIT_NO_EMPTY),
//     fn($char) => $char !== $kanji
// ));

// echo $filtered; // наприклад: 淇涸沽湘潮測
