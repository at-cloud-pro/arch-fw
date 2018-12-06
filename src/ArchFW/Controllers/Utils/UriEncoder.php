<?php
/**
 * ArchFramework (ArchFW in short) is universal template for server-side rendered applications and services.
 * ArchFW comes with pre-installed router and JSON API functionality.
 * Visit https://github.com/archi-tektur/ArchFW/ for more info.
 *
 * PHP version 7.2
 *
 * @category  Framework/Boilerplate
 * @package   ArchFW
 * @author    Oskar 'archi-tektur' Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   MIT https://opensource.org/licenses/MIT
 * @version   2.7.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */

namespace ArchFW\Controllers\Utils;

use function base64_decode;
use function base64_encode;
use function strtr;

/**
 * Utilities used to encode and decode values in BASE64 URL-save style
 *
 * @package ArchFW\Controller\Utils
 */
class UriEncoder
{

    private const DEFAULT_KEY_REPLACEMENT = '._-';

    /**
     * Decodes string in BASE64 that can be safely used in links
     *
     * @param string $input
     * @return string
     */
    public static function encode(string $input): string
    {
        return strtr(base64_encode($input), '+/=', self::DEFAULT_KEY_REPLACEMENT);
    }

    /**
     * Decodes given value from URL-safe BASE64
     *
     * @param $input
     * @return bool|string
     */
    public static function decode($input): string
    {
        return base64_decode(strtr($input, self::DEFAULT_KEY_REPLACEMENT, '+/='));
    }

}