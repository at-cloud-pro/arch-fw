<?php declare(strict_types=1);

namespace ArchFW\Configuration;

use ArchFW\Storage\LocalStorage;

class ConfigStorage extends LocalStorage
{
    /**
     * Loads whole configuration in one method
     *
     * @param array $data
     */
    public function loadAll(array $data): void
    {
        $this->storage = $data;
    }

}
