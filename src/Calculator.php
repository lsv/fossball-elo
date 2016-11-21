<?php

namespace Lsv\FussballElo;

use Lsv\FussballElo\Model\Rating;
use Lsv\FussballElo\Model\Result;

class Calculator
{
    /**
     * @param int $aRating   Player A current rating
     * @param int $bRating   Player B current rating
     * @param int $aScore    Player A goal score
     * @param int $bScore    Player B goal score
     * @param int $eloFactor The status of the match is incorporated by the use of a weight constant
     *
     * @return Result
     */
    public function getRatings($aRating, $bRating, $aScore, $bScore, $eloFactor = 20)
    {
        $playerA = new Rating($aRating, $aScore, $eloFactor);
        $playerB = new Rating($bRating, $bScore, $eloFactor);

        $playerA->goalDifference = $playerB->goalDifference = $this->getGoalIndex($playerA, $playerB);
        $playerA->expectedResult = $this->getExpectedScores($aRating, $bRating);
        $playerB->expectedResult = $this->getExpectedScores($bRating, $aRating);

        $playerA->winType = 0.5;
        $playerB->winType = 0.5;
        if ($playerA->getGoalScore() > $playerB->getGoalScore()) {
            $playerA->winType = 1;
            $playerB->winType = 0;
        } elseif ($playerA->getGoalScore() < $playerB->getGoalScore()) {
            $playerA->winType = 0;
            $playerB->winType = 1;
        }

        $playerA->pointChange = $this->calculatePointChange(
            $eloFactor,
            $playerA->getGoalDifference(),
            $playerA->getWinType(),
            $playerA->getExpectedResult()
        );

        $playerB->pointChange = $this->calculatePointChange(
            $eloFactor,
            $playerB->getGoalDifference(),
            $playerB->getWinType(),
            $playerB->getExpectedResult()
        );

        return new Result($playerA, $playerB);
    }

    /**
     * @param int   $factor
     * @param float $goalindex
     * @param float $winpoints
     * @param float $expected
     *
     * @return float
     */
    private function calculatePointChange($factor, $goalindex, $winpoints, $expected)
    {
        return $factor * $goalindex * ($winpoints - $expected);
    }

    /**
     * @param Rating $ratingA
     * @param Rating $ratingB
     *
     * @return float
     */
    private function getGoalIndex(Rating $ratingA, Rating $ratingB)
    {
        if ($ratingA->getGoalScore() == $ratingB->getGoalScore()) {
            return 1;
        }

        $scoreA = $ratingA->getGoalScore();
        $scoreB = $ratingB->getGoalScore();
        if ($ratingA->getGoalScore() > $ratingB->getGoalScore()) {
            $scoreA = $ratingB->getGoalScore();
            $scoreB = $ratingA->getGoalScore();
        }

        if (($scoreB - 1) <= $scoreA) {
            return 1;
        }

        if (($scoreB - 2) <= $scoreA) {
            return 3 / 2;
        }

        return (11 + ($scoreB - $scoreA)) / 8;
    }

    /**
     * @param int $ratingA
     * @param int $ratingB
     *
     * @return float
     */
    private function getExpectedScores($ratingA, $ratingB)
    {
        return round(1 / (1 + (pow(10, ($ratingB - $ratingA) / 400))), 3);
    }
}
