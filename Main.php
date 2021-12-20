<?php

class Main implements Stringable
{
    private int $currentX;
    private int $currentY;
    private array $fDirections = InitPositionInterface::DIRECTIONS;

    public function __construct(InitPositionInterface $initPosition)
    {
        $this->setInitPosition($initPosition);
    }

    public function setInitPosition(InitPositionInterface $initPosition): void
    {
        $this->currentX = $initPosition->getX();
        $this->currentY = $initPosition->getY();
        while (current($this->fDirections) !== $initPosition->getF()) {
            next($this->fDirections);
        }
    }

    public function applyTurnCommand(TurnInterface $turn): void
    {
        $method = 'turn' . ucfirst($turn->getDirection());
        $this->$method();
    }

    private function turnLeft(): void
    {
        key($this->fDirections) === 0 ? end($this->fDirections) :
            prev($this->fDirections);
    }

    private function turnRight(): void
    {
        key($this->fDirections) === end($this->fDirections) ? reset($this->fDirections) :
            next($this->fDirections);
    }

    public function move(): void
    {
        switch (current($this->fDirections)) {
            case 'NORTH':
                $this->incY();
                break;
            case 'EAST':
                $this->incX();
                break;
            case 'SOUTH':
                $this->decY();
                break;
            case 'WEST':
                $this->decX();
                break;
        }
    }

    private function incY(): void
    {
        if ($this->currentY < PlaceInterface::maxY) {
            $this->currentY++;
        }
    }

    private function incX(): void
    {
        if ($this->currentX < PlaceInterface::maxX) {
            $this->currentX++;
        }
    }

    private function decY(): void
    {
        if ($this->currentY > 0) {
            $this->currentY--;
        }
    }

    private function decX(): void
    {
        if ($this->currentX > 0) {
            $this->currentX--;
        }
    }

    public function report(): array
    {
        return [
            $this->currentX,
            $this->currentY,
            current($this->fDirections)
        ];
    }

    public function __toString(): string
    {
        return implode(',', $this->report());
    }
}
