<?php
namespace Lsv\FussballEloTest;

use Lsv\FussballElo\Calculator;

class AdjustMatchWeightTest extends AbstractTest
{

    public function matchWeightDataprovider()
    {
        return [
            [20, 0, 20], // Dont adjust match weight if game not won by two goals.
            [20, 1, 20], // Dont adjust match weight if game not won by two goals.
            [20, 2, 30], // Matchweight is increased by half if a game is won by two goals.
            [20, 3, 35], // Matchweight is increased by 3/4 if a game is won by three goals.
            [20, 4, 35.125], // Matchweight is increased by 3/4 + (N-3)/8 if the game is won by four or more goals,
            [20, 5, 35.25], // Matchweight is increased by 3/4 + (N-3)/8 if the game is won by four or more goals,
            [20, 6, 35.375], // Matchweight is increased by 3/4 + (N-3)/8 if the game is won by four or more goals,
            [20, 7, 35.5], // Matchweight is increased by 3/4 + (N-3)/8 if the game is won by four or more goals,

            [50, 0, 50], // Dont adjust match weight if game not won by two goals.
            [50, 1, 50], // Dont adjust match weight if game not won by two goals.
            [50, 2, 75], // Matchweight is increased by half if a game is won by two goals.
            [50, 3, 87.5], // Matchweight is increased by 3/4 if a game is won by three goals.
            [50, 4, 87.625], // Matchweight is increased by 3/4 + (N-3)/8 if the game is won by four or more goals,
            [50, 5, 87.75], // Matchweight is increased by 3/4 + (N-3)/8 if the game is won by four or more goals,
            [50, 6, 87.875], // Matchweight is increased by 3/4 + (N-3)/8 if the game is won by four or more goals,
            [50, 7, 88], // Matchweight is increased by 3/4 + (N-3)/8 if the game is won by four or more goals,
        ];
    }

    /**
     * @dataProvider matchWeightDataprovider
     * @param int $matchWeight
     * @param int $goalscore
     * @param float $adjustedWeight
     */
    public function test_matchweight_hometeam($matchWeight, $goalscore, $adjustedWeight)
    {
        $calculator = new Calculator();
        $result = $calculator->getRatings(1500, 1500, $goalscore, 0, $matchWeight);
        $this->assertEquals($adjustedWeight, $result->getMatchWeightGoalscoreAdjusted());
    }

    /**
     * @dataProvider matchWeightDataprovider
     * @param int $matchWeight
     * @param int $goalscore
     * @param float $adjustedWeight
     */
    public function test_matchweight_awayteam($matchWeight, $goalscore, $adjustedWeight)
    {
        $calculator = new Calculator();
        $result = $calculator->getRatings(1500, 1500, 0, $goalscore, $matchWeight);
        $this->assertEquals($adjustedWeight, $result->getMatchWeightGoalscoreAdjusted());
    }

}
