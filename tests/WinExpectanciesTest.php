<?php
namespace Lsv\FussballEloTest;

use Lsv\FussballElo\Calculator;

class WinExpectanciesTest extends AbstractTest
{

    public function winExpectanciesDataProvider()
    {
        return [
            [1000, 0.5, 0.5],
            [1010, 0.514, 0.486],
            [1280, 0.834, 0.166]
        ];
    }

    /**
     * @dataProvider winExpectanciesDataProvider
     * @param int $homerating
     * @param float $expectedHomeExpectancies
     * @param float $expectedAwayExpectancies
     */
    public function test_win_expectancies($homerating, $expectedHomeExpectancies, $expectedAwayExpectancies)
    {
        $calculator = new Calculator(false);
        $ratings = $calculator->getWinExpectancies($homerating, 1000);

        $this->assertEquals(round($expectedHomeExpectancies, 3), $ratings->getHomeTeam()->getWinExpectancies(), 'home');
        $this->assertEquals(round($expectedAwayExpectancies, 3), $ratings->getAwayTeam()->getWinExpectancies(), 'away');
    }

}
