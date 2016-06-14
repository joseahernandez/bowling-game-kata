<?php

namespace joseahernandez\bowlingGame;

class BowlingGame {
    const FRAMES = 10;
    const MAX_PINS_IN_ROLL = 10;
    const MAX_ROLLS_IN_GAME = 21;

    /**
     * @var int
     */
    private $currentRoll;

    /**
     * @var int[]
     */
    private $rolls;

    /**
     * BowlingGame constructor.
     */
    public function __construct()
    {
        $this->currentRoll = 0;
        $this->rolls = array_fill(0, self::MAX_ROLLS_IN_GAME, 0);
    }

    /**
     * @param int $pins
     */
    public function roll($pins)
    {
        $this->rolls[$this->currentRoll] = $pins;
        $this->currentRoll++;
    }

    /**
     * @return int
     */
    public function score()
    {
        $score = 0;
        $index = 0;

        for ($frame = 0; $frame < self::FRAMES; $frame++) {
            if ($this->isStrike($index)) {
                $score += $this->pointsInStrike($index);
                $index++;
            } else if ($this->isSpare($index)) {
                $score += $this->pointsInSpare($index);
                $index += 2;
            } else {
                $score += $this->rolls[$index] + $this->rolls[$index + 1];
                $index += 2;
            }
        }

        return $score;
    }

    /**
     * @param int $index
     * @return bool
     */
    private function isStrike($index)
    {
        return $this->rolls[$index] === self::MAX_PINS_IN_ROLL;
    }

    /**
     * @param int $index
     * @return int
     */
    private function pointsInStrike($index)
    {
        return self::MAX_PINS_IN_ROLL + $this->rolls[$index + 1] + $this->rolls[$index + 2];
    }

    /**
     * @param int $index
     * @return bool
     */
    private function isSpare($index)
    {
        return $this->rolls[$index] + $this->rolls[$index + 1] === self::MAX_PINS_IN_ROLL;
    }

    /**
     * @param int $index
     * @return int
     */
    private function pointsInSpare($index)
    {
        return self::MAX_PINS_IN_ROLL + $this->rolls[$index + 2];
    }
}