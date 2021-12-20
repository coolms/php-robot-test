<?php


interface PlaceInterface
{
    public const maxX = 4;
    public const maxY = 4;

    public function getX(): int;
    public function getY(): int;
}
