<?php


interface TurnInterface
{
    public const DIRECTIONS = ['LEFT', 'RIGHT'];

    public function getDirection(): string;
}
