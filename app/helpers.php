<?php

declare(strict_types=1);

function formatDolarAmount(float $amount)
{
    $isNegative = $amount < 0;
    return (($isNegative ? '-' : '') . '$' . number_format(abs($amount), 2));
}
function formatMoney(string $money)
{
    $formattedMoney = (float) str_replace(['$', ','], '', $money);

    return $formattedMoney;
}
function formatDate($date)
{
    $formatter = new IntlDateFormatter('tr_TR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
    $formattedDate = $formatter->format(strtotime($date));

    return $formattedDate;
}
