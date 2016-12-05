<?php
namespace Lsv\FussballEloTest;

use Lsv\FussballElo\Calculator;

class NewRatingTest extends AbstractTest
{

    public function dataProvider()
    {
        return [
            // homeresult, homerating, homerating change, awayresult, awayrating, awayrating change
            [0, 1200, -7, 1, 1411, 7],
            [1, 1250, 2, 1, 1413, -2],
            [0, 1194, -2, 2, 1743, 2],
            [1, 1665, 7, 0, 1668, -7],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param $homeResult
     * @param $homeRating
     * @param $expectedHomeChange
     * @param $awayResult
     * @param $awayRating
     * @param $expectedAwayChange
     */
    public function test_rating_change($homeResult, $homeRating, $expectedHomeChange, $awayResult, $awayRating, $expectedAwayChange)
    {
        $calculator = new Calculator(true);
        $ratings = $calculator->getRatings($homeRating, $awayRating, $homeResult, $awayResult);

        $this->assertEquals($expectedHomeChange, $ratings->getHomeTeam()->getPointChange());
        $this->assertEquals($expectedAwayChange, $ratings->getAwayTeam()->getPointChange());
    }

}
