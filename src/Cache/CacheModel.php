<?php

namespace Cache;

class CacheModel
{
    /**
     * @var CacheRepositoryInterface
     */
    private $cacheRepository;

    /**
     * CacheModel constructor.
     * @param CacheRepositoryInterface $cacheRepository
     */
    public function __construct(CacheRepositoryInterface $cacheRepository)
    {
        $this->cacheRepository = $cacheRepository;
    }

    /**
     * clears the cache
     */
    public function clearCache()
    {
        $this->cacheRepository->clearCache();
    }

    /**
     * Stores json to cache
     *
     * @param $content
     */
    public function setCache($content)
    {
        $this->cacheRepository->setCache(json_encode($content));
    }

    /**
     * Retrieves cache and json decodes it
     *
     * @return mixed
     */
    public function getCache()
    {
        return json_decode($this->cacheRepository->getCache(), true);
    }
}