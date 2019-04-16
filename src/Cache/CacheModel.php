<?php

namespace Cache;

class CacheModel
{
    private $cacheRepository;

    public function __construct(CacheRepositoryInterface $cacheRepository)
    {
        $this->cacheRepository = $cacheRepository;
    }

    public function clearCache()
    {
        $this->cacheRepository->clearCache();
    }

    public function setCache($content)
    {
        $this->cacheRepository->setCache(json_encode($content));
    }

    public function getCache()
    {
        return json_decode($this->cacheRepository->getCache(), true);
    }
}