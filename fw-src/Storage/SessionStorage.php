<?php declare(strict_types=1);

namespace ArchFW\Storage;

use ArchFW\Exceptions\Session\SessionCannotStartException;

/**
 * Stores data in session
 *
 * @package ArchFW\Storage
 */
class SessionStorage implements StorageInterface
{
    /**
     * Initiates new session storage
     */
    public function construct(): void
    {
        if (isset($_SESSION['sessionInitKey']) && !session_start(['sessionInitKey' => true])) {
            throw new SessionCannotStartException('Session cannot start.');
        }
    }

    /**
     * Retrieve value from storage
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return $_SESSION[$key];
    }

    /**
     * Set value in storage
     *
     * @param string $key
     * @param        $value
     */
    public function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Checks if value exists in storage
     *
     * @param $key
     * @return bool
     */
    public function exist($key): bool
    {
        return array_key_exists($key, $_SESSION);
    }
}
