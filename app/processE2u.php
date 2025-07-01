<?php
declare(strict_types=1);

// function processE2u($pageContent, $word) {
function useE2u($query) {
    $query = str_replace(' ', '+', $query);
    $url = 'https://e2u.org.ua/s?w='.$query.'&dicts=all&highlight=on&filter_lines=on';
    $pageContent = useCurl($url, 'sly', 'https://e2u.org.ua/');

    libxml_use_internal_errors(true);
    $html = new DOMDocument();
    $html->loadHTML($pageContent);

    function isArticleMain($article, $query) {
        $header = $article->getElementsByTagName('b')[0]?->textContent;
        if(!$header) return false;
        
        $header = explode('(-', $header)[0];
        $header = preg_split('/[0-9]/', $header)[0];
        $header = trim($header);
        $header = str_replace('|', '', $header);
        $header = str_replace('́', '', $header);
        
        return strtolower($header) === strtolower($query);
    }

    $articles = ['main' => [], 'other' => [], 'context' => []];
    foreach($html->getElementsByTagName('td') as $tag) {
        $class = $tag->getAttribute('class');
        // echo $class, '<br>';
        if($class === 'result_row') {
            $articles['context'][] = $tag;
            continue;
        }

        if(isArticleMain($tag, $query)) {
            $articles['main'][] = $tag;
        } else {
            $articles['other'][] = $tag;
        }
    }

    foreach($articles as $group => $list) {
        echo "<table class={$group}><tbody>";
        foreach($list as $article) {
            echo '<tr>' . $html->saveHTML($article) . '</tr>';
        }
        echo '</table></tbody>';
    }
}

