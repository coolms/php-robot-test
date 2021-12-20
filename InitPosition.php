<?php


class InitPosition implements InitPositionInterface
{
    private int $x;
    private int $y;
    private string $f;

    public function __construct(int $x, int $y, string $f)
    {
        if ($x > static::maxX) {
            throw new Exception(sprintf('Max X value should be %s', static::maxX));
        }

        $this->x = $x;

        if ($y > static::maxY) {
            throw new Exception(sprintf('Max Y value should be %s', static::maxY));
        }

        $this->y = $y;

        if (!in_array($f, static::DIRECTIONS)) {
            throw new Exception('Unknown facing direction');
        }

        $this->f = $f;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function getF(): string
    {
        return  $this->f;
    }
}
