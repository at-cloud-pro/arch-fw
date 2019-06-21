<?php declare(strict_types=1);

namespace ArchFW\Utilities;

/**
 * URI parsing toolset
 *
 * @package ArchFW\Utilities
 */
class UriParser
{
    /**
     * Returns array of GET values in URI
     *
     * Simple gets all data after '?', then puts it in an array. Required if
     * using REST style routing. Run function and assign returned values to $_GET variable.
     *
     * @param string $getVars
     * @return array
     */
    public static function getVariables(string $getVars): array
    {
        $args = explode('&', $getVars);
        $output = [];
        if (count($args) > 0) {
            foreach ($args as $arg) {
                $str = explode('=', $arg);
                if (array_key_exists(1, $str)) {
                    $output += [$str[0] => $str[1]];
                } elseif ($str[0] !== '') {
                    $output += [$str[0] => null];
                }
            }
        }
        return $output;
    }
}