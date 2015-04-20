<?php namespace App\Library;


class Utils
{

    static public function getplaintextintrofromhtml($html, $numchars = 30)
    {
        // Remove the HTML tags
        $html = strip_tags($html);
        // Convert HTML entities to single characters
        $html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');
        // Make the string the desired number of characters
        // Note that substr is not good as it counts by bytes and not characters
        $html = mb_substr($html, 0, $numchars, 'UTF-8');
        if ($html != '') { // Add an elipsis
            $html .= "…";
        };
        return $html;
    }

}