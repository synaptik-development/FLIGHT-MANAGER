<?php
$hash = 'kkdiiekkd2223d55dppkkejnbeoqq582*eoioknn';

$today = new DateTime('now');

function checkEgality($var)
{
    return date_format($var->departure, 'd-m-Y') === date_format(new DateTime('now'), 'd-m-Y');
}

function checkInegality($var)
{
    return $var->arrival > new DateTime('now');
}