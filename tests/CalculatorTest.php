<?php
namespace Lsv\FussballEloTest;

use Lsv\FussballElo\Calculator;
use Lsv\FussballElo\Model\Result;

class CalculatorTest extends AbstractTest
{

    public function test_rating_example11()
    {
        $class = new Calculator(3);
        $ratings = $class->getRatings(630, 500, 3, 1);
        $this->assertInstanceOf(Result::class, $ratings);

        $player = $ratings->getPlayerA();
        $this->assertEquals(20, $player->getTournamentIndexFactor());
        $this->assertEquals(1.5, $player->getGoalDifference());
        $this->assertEquals(1, $player->getWinType());
        $this->assertEquals(0.679, $player->getExpectedResult());
        $this->assertEquals(9.63, $player->getPointChange());
        $this->assertEquals(639, $player->getRating());

        $player = $ratings->getPlayerB();
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
        $ratings = $class->getRatings(630, 500, 1, 3);

        $player = $ratings->getPlayerA();
        $this->assertEquals(20, $player->getTournamentIndexFactor());
        $this->assertEquals(1.5, $player->getGoalDifference());
        $this->assertEquals(0, $player->getWinType());
        $this->assertEquals(0.679, $player->getExpectedResult());
        $this->assertEquals(-20.37, $player->getPointChange());
        $this->assertEquals(609, $player->getRating());

        $player = $ratings->getPlayerB();
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
        $ratings = $class->getRatings(630, 500, 2, 2);

        $player = $ratings->getPlayerA();
        $this->assertEquals(20, $player->getTournamentIndexFactor());
        $this->assertEquals(1, $player->getGoalDifference());
        $this->assertEquals(0.5, $player->getWinType());
        $this->assertEquals(0.679, $player->getExpectedResult());
        $this->assertEquals(-3.58, $player->getPointChange());
        $this->assertEquals(626, $player->getRating());

        $player = $ratings->getPlayerB();
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
        $ratings = $class->getRatings(500, 480, 3, 1);

        $player = $ratings->getPlayerA();
        $this->assertEquals(20, $player->getTournamentIndexFactor());
        $this->assertEquals(1.5, $player->getGoalDifference());
        $this->assertEquals(1, $player->getWinType());
        $this->assertEquals(0.529, $player->getExpectedResult());
        $this->assertEquals(14.13, $player->getPointChange());
        $this->assertEquals(514, $player->getRating());

        $player = $ratings->getPlayerB();
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
        $ratings = $class->getRatings(500, 480, 1, 3);

        $player = $ratings->getPlayerA();
        $this->assertEquals(20, $player->getTournamentIndexFactor());
        $this->assertEquals(1.5, $player->getGoalDifference());
        $this->assertEquals(0, $player->getWinType());
        $this->assertEquals(0.529, $player->getExpectedResult());
        $this->assertEquals(-15.87, $player->getPointChange());
        $this->assertEquals(484, $player->getRating());

        $player = $ratings->getPlayerB();
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
        $ratings = $class->getRatings(500, 480, 2, 2);

        $player = $ratings->getPlayerA();
        $this->assertEquals(20, $player->getTournamentIndexFactor());
        $this->assertEquals(1, $player->getGoalDifference());
        $this->assertEquals(0.5, $player->getWinType());
        $this->assertEquals(0.529, $player->getExpectedResult());
        $this->assertEquals(-0.58, $player->getPointChange());
        $this->assertEquals(499, $player->getRating());

        $player = $ratings->getPlayerB();
        $this->assertEquals(20, $player->getTournamentIndexFactor());
        $this->assertEquals(1, $player->getGoalDifference());
        $this->assertEquals(0.5, $player->getWinType());
        $this->assertEquals(0.471, $player->getExpectedResult());
        $this->assertEquals(0.58, $player->getPointChange());
        $this->assertEquals(480, $player->getRating());
    }

    public function test_rating_example31()
    {
        $class = new Calculator(3);
        $ratings = $class->getRatings(500, 480, 3, 2);

        $player = $ratings->getPlayerA();
        $this->assertEquals(1, $player->getGoalDifference());

        $player = $ratings->getPlayerB();
        $this->assertEquals(1, $player->getGoalDifference());
    }

    public function test_rating_example32()
    {
        $class = new Calculator(3);
        $ratings = $class->getRatings(500, 480, 2, 3);

        $player = $ratings->getPlayerA();
        $this->assertEquals(1, $player->getGoalDifference());

        $player = $ratings->getPlayerB();
        $this->assertEquals(1, $player->getGoalDifference());
    }

    public function test_rating_example41()
    {
        $class = new Calculator(3);
        $ratings = $class->getRatings(500, 480, 10, 2);

        $player = $ratings->getPlayerA();
        $this->assertEquals(2.375, $player->getGoalDifference());

        $player = $ratings->getPlayerB();
        $this->assertEquals(2.375, $player->getGoalDifference());
    }

    public function test_rating_example42()
    {
        $class = new Calculator(3);
        $ratings = $class->getRatings(500, 480, 2, 10);

        $player = $ratings->getPlayerA();
        $this->assertEquals(2.375, $player->getGoalDifference());

        $player = $ratings->getPlayerB();
        $this->assertEquals(2.375, $player->getGoalDifference());
    }

}
