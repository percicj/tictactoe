<?php

namespace Cache;

class FileStorageRepository implements CacheRepositoryInterface
{
    const CACHE_DIR = ROOTDIR . '/tmp';

    const CACHE_FILE = self::CACHE_DIR . DIRECTORY_SEPARATOR . 'tttcache';

    /**
     * FileStorageRepository constructor.
     */
    public function __construct()
    {
        if (!file_exists(self::CACHE_FILE)) {
            $this->clearCache();
        }
    }

    /**
     * clears the cache
     */
    public function clearCache(): void
    {
        $this->setCache('');
    }

    /**
     * Stores string into cache
     *
     * @param string $content
     */
    public function setCache(string $content): void
    {
        file_put_contents(self::CACHE_FILE, $content);
    }

    /**
     * Retrieves cached string
     *
     * @return string
     */
    public function getCache(): string
    {
        return file_get_contents(self::CACHE_FILE);
    }
}