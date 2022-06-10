<?php

namespace BlackJack;

interface CardInterface
{
    public function getSuit(): string;

    public function getValue(): int;
}
