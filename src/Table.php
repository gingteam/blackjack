<?php

namespace BlackJack;

use PHPImageWorkshop\Core\ImageWorkshopLayer;
use PHPImageWorkshop\ImageWorkshop;

class Table
{
    public const IMAGE_DIR = __DIR__.DIRECTORY_SEPARATOR.'poker';

    private ImageWorkshopLayer $table;

    /** @var list<Card> */
    private array $playerCards = [];

    /** @var list<Card> */
    private array $aiCards = [];

    public function __construct()
    {
        $this->table = $this->getLayer('table');
    }

    public function addPlayerCard(Card $card): void
    {
        $this->playerCards[] = $card;
    }

    public function addAICard(Card $card): void
    {
        $this->aiCards[] = $card;
    }

    /** @return list<Card> */
    public function getPlayerCards(): array
    {
        return $this->playerCards;
    }

    /** @return list<Card> */
    public function getAICards(): array
    {
        return $this->aiCards;
    }

    public function getTable(bool $end = false): ImageWorkshopLayer
    {
        foreach ($this->getPlayerCards() as $i => $card) {
            $this->table->addLayerOnTop(
                $this->getLayer($card->getName()),
                100 + $i * 102,
                530
            );
        }

        $last = count($this->getAICards()) - 1;
        foreach ($this->getAICards() as $i => $card) {
            $name = (!$end && $i === $last) ? 'poker_cards_large_back' : $card->getName();
            $this->table->addLayerOnTop(
                $this->getLayer($name),
                100 + $i * 102,
                100
            );
        }

        return $this->table;
    }

    private function getLayer(string $name): ImageWorkshopLayer
    {
        return ImageWorkshop::initFromPath(self::IMAGE_DIR.DIRECTORY_SEPARATOR.$name.'.png');
    }

    /**
     * @param array<Card> $cards
     */
    public static function getScore(array $cards): int
    {
        $score = 0;
        foreach ($cards as $card) {
            $value = $card->getValue();

            if ($value > 10) {
                $score += 10;

                continue;
            }

            if (1 === $value && $score < 11) {
                $score += 11;

                continue;
            }

            $score += $value;
        }

        return $score;
    }
}
