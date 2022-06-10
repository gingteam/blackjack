<?php

use BlackJack\Card;
use BlackJack\Deck;
use BlackJack\Table;
use PHPUnit\Framework\TestCase;

test('deck', function () {
    /** @var TestCase $this */
    $deck = new Deck();
    $this->assertEquals(52, count($deck));
    $deck->draw();
    $this->assertEquals(51, count($deck));
});

test('score', function () {
    /** @var TestCase $this */
    $cards = [new Card('A', 1), new Card('A', 1), new Card('A', 1), new Card('A', 1)];
    $this->assertEquals(14, Table::getScore($cards));
});
