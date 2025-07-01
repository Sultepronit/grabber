<?php
declare(strict_types=1);

function processJisho($pageContent) {
    libxml_use_internal_errors(true);
    $html = new DOMDocument();
    $html->loadHTML($pageContent);
    $mainPart = $html->getElementById('primary');

    echo $html->saveHTML($mainPart);
}