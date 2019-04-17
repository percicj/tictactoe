<?php

namespace Cache;

interface CacheRepositoryInterface
{
    /**
     * clears the cache
     */
    public function clearCache() : void;

    /**
     * Stores string into cache
     *
     * @param string $content
     */
    public function setCache(string $content) : void;

    /**
     * Retrieves cached string
     *
     * @return string
     */
    public function getCache() : string;
}