<?php
namespace Lsv\FussballEloTest;

use Lsv\FussballElo\Calculator;

class ResultPointTest extends AbstractTest
{

    public function resultPointDataprovider()
    {
        return [
            [1, 0, 1, 0],
            [0, 1, 0, 1],
            [0, 0, 0.5, 0.5],
            [2, 2, 0.5, 0.5]
        ];
    }

    /**
     * @dataProvider resultPointDataprovider
     * @param int $homescore
     * @param int $awayscore
     * @param float $expectedHomeresult
     * @param float $expectedAwayresult
     */
    public function test_resultpoint($homescore, $awayscore, $expectedHomeresult, $expectedAwayresult)
    {
        $calculator = new Calculator();
        $ratings = $calculator->getRatings(1500, 1500, $homescore, $awayscore);

        $this->assertEquals($expectedHomeresult, $ratings->getHomeTeam()->getResultPoint());
        $this->assertEquals($expectedAwayresult, $ratings->getAwayTeam()->getResultPoint());
    }

}
