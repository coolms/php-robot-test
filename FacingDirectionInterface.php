<?php


interface FacingDirectionInterface
{
    public const DIRECTIONS = ['NORTH', 'EAST', 'SOUTH', 'WEST'];

    public function getF(): string;
}
