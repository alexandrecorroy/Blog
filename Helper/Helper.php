<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 27/02/2018
 * Time: 18:23
 */
namespace Helper;

class Helper
{

    public function formatDate($dateTime)
    {
        $formatter = new \IntlDateFormatter('fr_FR',\IntlDateFormatter::LONG,
            \IntlDateFormatter::SHORT,
            'Europe/Paris',
            \IntlDateFormatter::GREGORIAN );
        $date = new \DateTime($dateTime);
        $date = $formatter->format($date);
        return str_replace(':', 'h', $date);
    }

}