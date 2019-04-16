<?php

namespace Cache;

class FileStorageRepository implements CacheRepositoryInterface
{
    const CACHE_DIR = ROOTDIR . '/tmp';

    const CACHE_FILE = self::CACHE_DIR . DIRECTORY_SEPARATOR . 'tttcache';

    public function __construct()
    {
        if (!file_exists(self::CACHE_FILE)) {
            $this->clearCache();
        }
    }

    public function clearCache(): void
    {
        $this->setCache('');
    }

    public function setCache(string $content): void
    {
        file_put_contents(self::CACHE_FILE, $content);
    }

    public function getCache(): string
    {
        return file_get_contents(self::CACHE_FILE);
    }
}