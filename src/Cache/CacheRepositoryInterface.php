<?php

namespace Cache;

interface CacheRepositoryInterface
{
    public function clearCache() : void;

    public function setCache(string $content) : void;

    public function getCache() : string;
}