<?php

namespace BlackJack;

class Card implements CardInterface
{
    private string $suit;

    private int $value;

    public function __construct(string $suit, int $value)
    {
        $this->suit = $suit;
        $this->value = $value;
    }

    public function getSuit(): string
    {
        return $this->suit;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getName(): string
    {
        return 'poker_cards_large_'.$this->suit.str_pad((string) $this->value, 2, '0', STR_PAD_LEFT);
    }
}
