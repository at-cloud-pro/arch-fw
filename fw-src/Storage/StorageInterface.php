<?php declare(strict_types=1);

namespace ArchFW\Storage;

/**
 * Defines methods for all kind of storage's
 *
 * @package ArchFW\Storage
 */
interface StorageInterface
{
    /**
     * Retrieve value from storage
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key);

    /**
     * Set value in storage
     *
     * @param string $key
     * @param        $value
     */
    public function set(string $key, $value): void;

    /**
     * Checks if value exists in storage
     *
     * @param $key
     * @return bool
     */
    public function exist($key): bool;
}
