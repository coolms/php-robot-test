<?php


class Turn implements TurnInterface
{
    private string $direction;

    public function __construct(string $direction)
    {
        if (!in_array($direction, static::DIRECTIONS)) {
            throw new Exception('Unknown direction');
        }

        $this->direction = $direction;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }
}
