<?php


namespace App\Service;


class Slugger
{

    /**
     * Method to return a slug
     * @param string $string
     * @return string
     */
    public function Slugify(string $string): string
    {
        return preg_replace(
            '/\s+/',
            '-',
            \mb_strtolower(trim(strip_tags($string)), 'UTF-8')
        );
    }
}