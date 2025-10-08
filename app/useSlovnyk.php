<?php
declare(strict_types=1);

function useSlovnyk($query) {
    $query = urlencode($query);
    $url = 'https://slovnyk.ua/index.php?swrd='.$query;
    $pageContent = useCurl($url);

    libxml_use_internal_errors(true);
    $html = new DOMDocument();
    $html->loadHTML('<?xml encoding="UTF-8">' . $pageContent);
    
    $divs = $html->getElementsByTagName('div');
    foreach ($divs as $div) {
        $class = $div->getAttribute('class');
        if($class === 'toggle-content') {
            $article = $div;
            break;
        }
    }

    $links = $article->getElementsByTagName('a');
    foreach ($links as $link) {
        $link->removeAttribute('href');
        $link->removeAttribute('target');
        $link->removeAttribute('class');
    }

    echo $html->saveHTML($article);
}