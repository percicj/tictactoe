<?php

namespace Test\Cache;

use Cache\CacheModel;
use Cache\CacheRepositoryInterface;
use PHPUnit\Framework\TestCase;

class CacheModelTest extends TestCase
{
    private $repositoryStub;

    const CACHE_CONTENT = [
        ['X', 'O', 'X'],
        ['','',''],
        ['X', '', 'X'],
    ];

    protected function setUp(): void
    {
        $this->repositoryStub = $this->getMockBuilder(CacheRepositoryInterface::class)
            ->setMethods(['clearCache', 'getCache', 'setCache'])
            ->getMock();
    }


    public function testGetCache()
    {
        $expectedResult = self::CACHE_CONTENT;
        $this->repositoryStub->expects($this->once())->method('getCache')->willReturn(json_encode(self::CACHE_CONTENT));
        $cacheModel = new CacheModel($this->repositoryStub);
        $result = $cacheModel->getCache();
        $this->assertEquals($expectedResult, $result);
    }

    public function testClearCache()
    {
        $this->repositoryStub->expects($this->once())->method('clearCache');
        $cacheModel = new CacheModel($this->repositoryStub);
        $cacheModel->clearCache();
    }

    public function testSetCache()
    {
        $expectedResult = json_encode(self::CACHE_CONTENT);

        $this->repositoryStub->expects($this->once())
            ->method('setCache')
            ->with($this->equalTo($expectedResult));

        $cacheModel = new CacheModel($this->repositoryStub);
        $cacheModel->setCache(self::CACHE_CONTENT);
    }
}
