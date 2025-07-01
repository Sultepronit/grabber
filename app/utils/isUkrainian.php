<?php
declare(strict_types=1);

function isUkrainian(string $text): bool {
    return preg_match('/[а-яА-Я]/u', $text) === 1;
}