<?php
/**
 * ArchFramework (ArchFW in short) is modern, new, fast and dedicated framework for most my modern projects
 *
 * Visit https://github.com/okbrcz/ArchFW/ for more info.
 *
 * PHP version 7.2
 *
 * @category  Framework
 * @package   ArchFW
 * @author    Oskar Barcz <kontakt@archi-tektur.pl>
 * @copyright 2018 Oskar 'archi_tektur' Barcz
 * @license   MIT
 * @version   4.0
 * @link      https://github.com/archi-tektur/ArchFW/
 */

namespace ArchFW\Controller;

use ArchFW\Controller\Interfaces\IError;

/**
 * Class shows verbose or JSON errors, easy to extend and add user's own action.
 */
class Error implements IError
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
    protected $_code;

    /**
     * Holds error message
     *
     * @var string
     */
    protected $_message;

    /**
     * Showing visual or JSON style errors.
     *
     * @param integer $code HTTP code of an error to be thrown
     * @param string $message message to be shown
     * @param string $method Choose between method to show error, values: html|plain|json
     *
     * @return void
     */
    public function __construct(int $code, string $message, string $method)
    {
        $this->_code = $code;
        $this->_message = $message;

        $this->action();

        http_response_code($code);
        switch ($method) {
            case self::HTML:
                $this->_htmlError();
                break;
            case self::JSON:
                $this->_jsonError();
                break;
            case self::PLAIN:
                $this->_plainError(false);
                break;
            default:
                $this->_plainError(true);
        }
    }

    /**
     * Throw verbose HTML error
     *
     * @return void
     */
    protected function _htmlError(): void
    {
        $path = CONFIG['pathToErrorPages'] . "/$this->_code.html";
        if (file_exists($path)) {
            require_once($path);
            exit;
        } else {
            $this->_plainError(true);
        }
    }

    /**
     * Throw JSON error response
     *
     * @return void
     */
    protected function _jsonError(): void
    {
        header('Content-Type: application/json');
        exit(json_encode(['error' => true, 'errorCode' => $this->_code, 'errorMessage' => $this->_message,]));
    }

    /**
     * Throw plaintext error
     *
     * @var bool set true to force plain error
     *
     * @return void
     */
    protected function _plainError(bool $force /* FORCE */): void
    {
        if (!CONFIG['dev'] or !$force) {
            $this->_htmlError();
        } else {
            header('Content-Type: text/plain');
            exit("ERROR $this->_code OCCURED, WITH MESSAGE '$this->_message'. ERROR-SPECIFIC FILES WERE NOT FOUND, OR DEV MODE IS TURNED ON.");
        }
    }

    /**
     * Action which is given to user. By default it's doing nothing, but while overriding this function by inheritance user may add his own needs.
     *
     * @return void
     */
    public function action(): void
    {

    }
}

