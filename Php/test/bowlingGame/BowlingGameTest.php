<?php

namespace joseahernandez\bowlingGame;

class BowlingGameTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BowlingGame
     */
    private $bowlingGame;

    protected function setUp()
    {
        $this->bowlingGame = new BowlingGame();
    }

    /**
     * @test
     */
    public function initialScoreIs0()
    {
        $this->assertSame(0, $this->bowlingGame->score());
    }

    /**
     * @test
     */
    public function rolling0PinsInEachRollResultIn0Points()
    {
        for ($i = 0; $i < BowlingGame::FRAMES * 2; $i++) {
            $this->bowlingGame->roll(0);
        }

        $this->assertSame(0, $this->bowlingGame->score());
    }

    /**
     * @test
     */
    public function rolling1PinInEachRollResultIn20Points()
    {
        for($i = 0; $i < BowlingGame::FRAMES * 2; $i++) {
            $this->bowlingGame->roll(1);
        }

        $this->assertSame(20, $this->bowlingGame->score());
    }

    /**
     * @test
     */
    public function oneSpare()
    {
        $this->doASpare($this->bowlingGame);
        $this->bowlingGame->roll(2);

        for ($i = 0; $i < 17; $i++) {
            $this->bowlingGame->roll(0);
        }

        $this->assertSame(14, $this->bowlingGame->score());
    }

    /**
     * @param BowlingGame $bowlingGame
     */
    private function doASpare(BowlingGame $bowlingGame)
    {
        $bowlingGame->roll(5);
        $bowlingGame->roll(5);
    }

    /**
     * @test
     */
    public function oneStrike()
    {
        $this->doAStrike($this->bowlingGame);
        $this->bowlingGame->roll(2);
        $this->bowlingGame->roll(6);

        for ($i = 0; $i < 16; $i++) {
            $this->bowlingGame->roll(0);
        }

        $this->assertSame(26, $this->bowlingGame->score());
    }

    /**
     * @param BowlingGame $bowlingGame
     */
    private function doAStrike(BowlingGame $bowlingGame)
    {
        $bowlingGame->roll(10);
    }

    /**
     * @test
     */
    public function perfectGame()
    {
        for ($i = 0; $i < 19; $i++) {
            $this->bowlingGame->roll(10);
        }

        $this->assertSame(300, $this->bowlingGame->score());
    }
}