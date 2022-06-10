<?php

namespace BlackJack;

/**
 * @implements \IteratorAggregate<int, Card>
 */
class Deck implements \Countable, \IteratorAggregate
{
    /** @var list<Card> */
    private array $cards = [];

    public function __construct()
    {
        foreach (['A', 'B', 'C', 'D'] as $suit) {
            foreach (range(1, 13) as $value) {
                $this->cards[] = new Card($suit, $value);
            }
        }
    }

    public function shuffle(): void
    {
        shuffle($this->cards);
    }

    public function draw(): Card
    {
        if (0 === count($this->cards)) {
            throw new \RuntimeException('No cards left in the deck');
        }

        return array_shift($this->cards);
    }

    /**
     * @return list<Card>
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    public function count(): int
    {
        return count($this->cards);
    }

    /**
     * @return \ArrayIterator<int, Card>
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->cards);
    }
}
