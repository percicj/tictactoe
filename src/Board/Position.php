<?php

namespace Board;

class Position
{
    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;

    /**
     * @var string
     */
    private $unit;

    /**
     * Position constructor.
     * @param array $position
     */
    public function __construct(array $position)
    {
        $this->x = $position[1];
        $this->y = $position[0];
        $this->unit = $position[2];
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

}