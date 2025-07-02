<?php
declare(strict_types=1);

function useJisho($query) {
    $query = urlencode($query);
    $url = 'https://jisho.org/search/'.$query;
    $pageContent = useCurl($url);

    libxml_use_internal_errors(true);
    $html = new DOMDocument();
    $html->loadHTML($pageContent);
    $mainPart = $html->getElementById('primary');

    echo $html->saveHTML($mainPart);
}