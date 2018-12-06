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

namespace ArchFW\Controllers;

use ArchFW\Interfaces\Errorable;
use function file_exists;
use function header;
use function http_response_code;
use function json_encode;

/**
 * Class shows verbose or JSON errors, easy to extend and add user's own action.
 */
class Error implements Errorable
{
    /**
     * Defining class
     */
    public const JSON = 'json';
    public const HTML = 'html';
    public const PLAIN = 'plain';

    /**
     * Holds error code
     *
     * @var integer
     */
    protected $code;

    /**
     * Holds error message
     *
     * @var string
     */
    protected $message;

    /**
     * Showing visual or JSON style errors.
     *
     * @param integer $code HTTP code of an error to be thrown
     * @param string $message message to be shown
     * @param string $method Choose between method to show error, values: html|plain|json
     *
     */
    public function __construct(int $code, string $message, string $method)
    {
        $this->code = $code;
        $this->message = $message;

        $this->action();

        http_response_code($code);
        switch ($method) {
            case self::HTML:
                $this->htmlError();
                break;
            case self::JSON:
                $this->jsonError();
                break;
            case self::PLAIN:
                $this->plainError(false);
                break;
            default:
                $this->plainError(true);
        }
    }

    /**
     * Action which is given to user. By default it's doing nothing,
     * but while overriding this function by inheritance user may add his own needs.
     *
     * @return void
     */
    public function action(): void
    {
    }

    /**
     * Throw verbose HTML error
     *
     * @return void
     */
    protected function htmlError(): void
    {
        $path = Config::get(Config::SECTION_APP, 'pathToErrorPages') . "/$this->code.html";
        if (file_exists($path)) {
            require_once $path;
        } else {
            $this->plainError(true);
        }
    }

    /**
     * Throw plaintext error
     *
     * @var bool set true to force plain error
     *
     * @return void
     */
    protected function plainError(bool $force /* FORCE */): void
    {
        if (Config::get(Config::SECTION_APP, 'production') or $force) {
            $this->htmlError();
        } else {
            header('Content-Type: text/plain');
            echo "ERROR {$this->code} OCCURED, WITH MESSAGE '{$this->message}'. " . '
                 ERROR-SPECIFIC FILES WERE NOT FOUND, OR PROD MODE IS TURNED OFF.';
        }
    }

    /**
     * Throw JSON error response
     *
     * @return void
     */
    protected function jsonError(): void
    {
        header('Content-Type: application/json');
        echo json_encode(['error' => true, 'errorCode' => $this->code, 'errorMessage' => $this->message]);
    }
}
