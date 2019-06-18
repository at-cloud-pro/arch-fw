<?php declare(strict_types=1);

namespace ArchFW\Storage;

class LocalStorage implements StorageInterface
{
    /**
     * There are stored all values
     *
     * @var array
     */
    protected $storage = [];

    /**
     * Retrieve value from storage
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        if ($this->exist($key)) {
            return $this->storage[$key];
        }
        return null;
    }

    /**
     * Set value in storage
     *
     * @param string $key
     * @param        $value
     */
    public function set(string $key, $value): void
    {
        $this->storage[$key] = $value;
    }

    /**
     * Checks if value exists in storage
     *
     * @param $key
     * @return bool
     */
    public function exist($key): bool
    {
        return array_key_exists($key, $this->storage);
    }
}
