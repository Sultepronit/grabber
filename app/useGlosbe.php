<?php
declare(strict_types=1);

function useGlosbe($query) {
    $query = str_replace(' ', '%20', $query);
    $url = 'https://uk.glosbe.com/en/uk/'.$query;
    $pageContent = useCurl($url);

    libxml_use_internal_errors(true);
    $html = new DOMDocument();
    $html->loadHTML($pageContent);
  
    foreach($html->getElementsByTagName('div') as $tag) {
        $class = $tag->getAttribute('class');
        if($class === 'w-1/2 dir-aware-pr-1 ') {
            $tag->setAttribute('class', 'glosbe-eng');
            echo $html->saveHtml($tag);
        }
        if($class === 'w-1/2 dir-aware-pl-1 ') {
            $tag->setAttribute('class', 'glosbe-ukr');
            echo $html->saveHTML($tag);
        }
        if($class === 'flex') {
            echo "<p class='glosbe-source'>{$tag->textContent}</p>";
        }
    }
}

