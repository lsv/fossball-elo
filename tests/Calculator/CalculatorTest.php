<?php
namespace Lsv\FussballEloTest\Calculator;

use Lsv\FussballElo\Calculator\Calculator;
use Lsv\FussballEloTest\AbstractTest;

class CalculatorTest extends AbstractTest
{

    public function test_rating_example11()
    {
        $class = new Calculator(3);
        $ratings = $class->getRatings(Calculator::WINNER_A, 630, 500, 3, 1);
        $this->assertTrue(is_array($ratings));
        $this->assertCount(2, $ratings);

        $player = $ratings[0];
        $this->assertEquals(20, $player->getTournamentIndexFactor());
        $this->assertEquals(1.5, $player->getGoalDifference());
        $this->assertEquals(1, $player->getWinType());
        $this->assertEquals(0.679, $player->getExpectedResult());
        $this->assertEquals(9.63, $player->getPointChange());
        $this->assertEquals(639, $player->getRating());

        $player = $ratings[1];
        $this->assertEquals(20, $player->getTournamentIndexFactor());
        $this->assertEquals(1.5, $player->getGoalDifference());
        $this->assertEquals(0, $player->getWinType());
        $this->assertEquals(0.321, $player->getExpectedResult());
        $this->assertEquals(-9.63, $player->getPointChange());
        $this->assertEquals(490, $player->getRating());

    }

    public function test_rating_example12()
    {
        $class = new Calculator(3);
        $ratings = $class->getRatings(Calculator::WINNER_B, 630, 500, 1, 3);
        $this->assertTrue(is_array($ratings));
        $this->assertCount(2, $ratings);

        $player = $ratings[0];
        $this->assertEquals(20, $player->getTournamentIndexFactor());
        $this->assertEquals(1.5, $player->getGoalDifference());
        $this->assertEquals(0, $player->getWinType());
        $this->assertEquals(0.679, $player->getExpectedResult());
        $this->assertEquals(-20.37, $player->getPointChange());
        $this->assertEquals(609, $player->getRating());

        $player = $ratings[1];
        $this->assertEquals(20, $player->getTournamentIndexFactor());
        $this->assertEquals(1.5, $player->getGoalDifference());
        $this->assertEquals(1, $player->getWinType());
        $this->assertEquals(0.321, $player->getExpectedResult());
        $this->assertEquals(+20.37, $player->getPointChange());
        $this->assertEquals(520, $player->getRating());

    }

    public function test_rating_example13()
    {
        $class = new Calculator(3);
        $ratings = $class->getRatings(Calculator::DRAW, 630, 500, 2, 2);
        $this->assertTrue(is_array($ratings));
        $this->assertCount(2, $ratings);

        $player = $ratings[0];
        $this->assertEquals(20, $player->getTournamentIndexFactor());
        $this->assertEquals(1, $player->getGoalDifference());
        $this->assertEquals(0.5, $player->getWinType());
        $this->assertEquals(0.679, $player->getExpectedResult());
        $this->assertEquals(-3.58, $player->getPointChange());
        $this->assertEquals(626, $player->getRating());

        $player = $ratings[1];
        $this->assertEquals(20, $player->getTournamentIndexFactor());
        $this->assertEquals(1, $player->getGoalDifference());
        $this->assertEquals(0.5, $player->getWinType());
        $this->assertEquals(0.321, $player->getExpectedResult());
        $this->assertEquals(3.58, $player->getPointChange());
        $this->assertEquals(503, $player->getRating());

    }

    public function test_rating_example21()
    {
        $class = new Calculator(3);
        $ratings = $class->getRatings(Calculator::WINNER_A, 500, 480, 3, 1);
        $this->assertTrue(is_array($ratings));
        $this->assertCount(2, $ratings);

        $player = $ratings[0];
        $this->assertEquals(20, $player->getTournamentIndexFactor());
        $this->assertEquals(1.5, $player->getGoalDifference());
        $this->assertEquals(1, $player->getWinType());
        $this->assertEquals(0.529, $player->getExpectedResult());
        $this->assertEquals(14.13, $player->getPointChange());
        $this->assertEquals(514, $player->getRating());

        $player = $ratings[1];
        $this->assertEquals(20, $player->getTournamentIndexFactor());
        $this->assertEquals(1.5, $player->getGoalDifference());
        $this->assertEquals(0, $player->getWinType());
        $this->assertEquals(0.471, $player->getExpectedResult());
        $this->assertEquals(-14.13, $player->getPointChange());
        $this->assertEquals(465, $player->getRating());
    }

    public function test_rating_example22()
    {
        $class = new Calculator(3);
        $ratings = $class->getRatings(Calculator::WINNER_B, 500, 480, 1, 3);
        $this->assertTrue(is_array($ratings));
        $this->assertCount(2, $ratings);

        $player = $ratings[0];
        $this->assertEquals(20, $player->getTournamentIndexFactor());
        $this->assertEquals(1.5, $player->getGoalDifference());
        $this->assertEquals(0, $player->getWinType());
        $this->assertEquals(0.529, $player->getExpectedResult());
        $this->assertEquals(-15.87, $player->getPointChange());
        $this->assertEquals(484, $player->getRating());

        $player = $ratings[1];
        $this->assertEquals(20, $player->getTournamentIndexFactor());
        $this->assertEquals(1.5, $player->getGoalDifference());
        $this->assertEquals(1, $player->getWinType());
        $this->assertEquals(0.471, $player->getExpectedResult());
        $this->assertEquals(15.87, $player->getPointChange());
        $this->assertEquals(495, $player->getRating());

    }

    public function test_rating_example23()
    {
        $class = new Calculator(3);
        $ratings = $class->getRatings(Calculator::DRAW, 500, 480, 2, 2);
        $this->assertTrue(is_array($ratings));
        $this->assertCount(2, $ratings);

        $player = $ratings[0];
        $this->assertEquals(20, $player->getTournamentIndexFactor());
        $this->assertEquals(1, $player->getGoalDifference());
        $this->assertEquals(0.5, $player->getWinType());
        $this->assertEquals(0.529, $player->getExpectedResult());
        $this->assertEquals(-0.58, $player->getPointChange());
        $this->assertEquals(499, $player->getRating());

        $player = $ratings[1];
        $this->assertEquals(20, $player->getTournamentIndexFactor());
        $this->assertEquals(1, $player->getGoalDifference());
        $this->assertEquals(0.5, $player->getWinType());
        $this->assertEquals(0.471, $player->getExpectedResult());
        $this->assertEquals(0.58, $player->getPointChange());
        $this->assertEquals(480, $player->getRating());
    }

    public function test_invalidWinner()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('$winner variable should be either "DRAW" "A" or "B"');

        $class = new Calculator(3);
        $class->getRatings('foo', 500, 480, 2, 2);
    }

}
