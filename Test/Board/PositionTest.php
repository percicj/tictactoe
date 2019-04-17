<?php

namespace Test\Board;

use Board\Position;
use PHPUnit\Framework\TestCase;

class PositionTest extends TestCase
{
    const TEST_POSITION = [0,1,'X'];

    /**
     * @var Position
     */
    private $position;

    protected function setUp(): void
    {
        $this->position = new Position(self::TEST_POSITION);
    }


    public function testGetUnit()
    {
        $this->assertEquals('X', $this->position->getUnit());
    }

    public function testGetX()
    {
        $this->assertEquals('1', $this->position->getX());
    }

    public function testGetY()
    {
        $this->assertEquals('0', $this->position->getY());
    }
}
