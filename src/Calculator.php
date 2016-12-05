<?php

namespace Lsv\FussballElo;

use Lsv\FussballElo\Model\Team;
use Lsv\FussballElo\Model\Result;

class Calculator
{
    const WEIGHT_FRIENDLY = 20;
    const WEIGHT_TOURNAMENT = 30;
    const WEIGHT_WORLDCUP_QUALIFIER = 40;
    const WEIGHT_MAJOR_TOURNAMENT = 50;
    const WEIGHT_WORLDCUP_FINAL = 60;

    /**
     * Use hometeam advantage
     *
     * @var bool
     */
    private $useHometeamAdvantage;

    /**
     * @param bool $useHometeamAdvantage Use hometeam advantage
     */
    public function __construct($useHometeamAdvantage = false)
    {
        $this->useHometeamAdvantage = $useHometeamAdvantage;
    }

    /**
     * Calculate new ratings from a match played.
     *
     * Match weights normally in use are the following.
     * 60 for World Cup finals.
     * 50 for continental championship finals and major intercontinental tournaments.
     * 40 for World Cup and continental qualifiers and major tournaments.
     * 30 for all other tournaments.
     * 20 for friendly matches.
     *
     * @param int $homeRating   Hometeam current rating
     * @param int $awayRating   Awayteam current rating
     * @param int $homeScore    Hometeam goal score
     * @param int $awayScore    Awayteam goal score
     * @param int $matchWeight  Weight constant for the tournament played
     *
     * @return Result Match result
     */
    public function getRatings($homeRating, $awayRating, $homeScore, $awayScore, $matchWeight = self::WEIGHT_FRIENDLY)
    {
        $playerA = new Team($homeRating, $homeScore);
        $playerB = new Team($awayRating, $awayScore);
        $this->calculateResultPoint($playerA, $playerB);
        $this->calculateWinExpectancies($playerA, $playerB);

        $result = new Result();
        $result->matchWeight = $matchWeight;
        $result->matchWeightGoalscoreAdjusted = $this->calculateMatchweightAdjusted($result, $playerA, $playerB);

        $playerA->rating = $this->calculateNewRating($result, $playerA);
        $playerB->rating = $this->calculateNewRating($result, $playerB);

        $result->homeTeam = $playerA;
        $result->awayTeam = $playerB;
        return $result;
    }

    /**
     * Calculate win expectancies between two teams.
     *
     * @param int $homeRating
     * @param int $awayRating
     * @return Result
     */
    public function getWinExpectancies($homeRating, $awayRating)
    {
        $playerA = new Team($homeRating, 0);
        $playerB = new Team($awayRating, 0);
        $this->calculateWinExpectancies($playerA, $playerB);

        $result = new Result();
        $result->homeTeam = $playerA;
        $result->awayTeam = $playerB;
        return $result;
    }

    /**
     * Adjust match weight with goal score.
     *
     * Formular.
     * Matchweight is increased by half if a game is won by two goals.
     * Matchweight is increased by 3/4 if a game is won by three goals.
     * Matchweight is increased by 3/4 + (N-3)/8 if the game is won by four or more goals.
     *
     * @param Result $result
     * @param Team $hometeam
     * @param Team $awayteam
     *
     * @return float
     */
    protected function calculateMatchweightAdjusted(Result $result, Team $hometeam, Team $awayteam)
    {
        // Find winner
        $winScore = $hometeam->getGoalScore();
        $loseScore = $awayteam->getGoalScore();
        if ($hometeam->getGoalScore() < $awayteam->getGoalScore()) {
            $winScore = $awayteam->getGoalScore();
            $loseScore = $hometeam->getGoalScore();
        }

        // Dont adjust match weight if game not won by two goals.
        if ($winScore <= ($loseScore + 1)) {
            return $result->getMatchWeight();
        }

        // Matchweight is increased by half if a game is won by two goals.
        if ($winScore == ($loseScore + 2)) {
            return $result->getMatchWeight() + ($result->getMatchWeight() * 0.5);
        }

        // Matchweight is increased by 3/4 if a game is won by three goals.
        if ($winScore == ($loseScore + 3)) {
            return $result->getMatchWeight() + ($result->getMatchWeight() * 0.75);
        }

        // Matchweight is increased by 3/4 + (N-3)/8 if the game is won by four or more goals,
        // N is the goal difference.
        $goaldiff = (($winScore - $loseScore) - 3) / 8;
        return $result->getMatchWeight() + (($result->getMatchWeight() * 0.75) + $goaldiff);
    }

    /**
     * Calculate point change.
     *
     * Formular.
     * Rn = Ro + K × (W - We).
     * Rn is the new rating.
     * Ro is the old (pre-match) rating.
     * K is the weight constant for the tournament played.
     * W is the result of the game (1 for a win, 0.5 for a draw, and 0 for a loss).
     * We is the expected result (win expectancy).
     *
     * @param Result $result
     * @param Team $player
     * @return float
     */
    protected function calculateNewRating(Result $result, Team $player)
    {
        return
            $player->getOldRating() +
            $result->getMatchWeightGoalscoreAdjusted() *
            ($player->getResultPoint() - $player->getWinExpectancies())
        ;
    }

    /**
     * Calculate result point.
     *
     * Formular.
     * 1 for a win.
     * 0.5 for a draw.
     * 0 for a loss.
     *
     * @param Team $hometeam
     * @param Team $awayteam
     */
    protected function calculateResultPoint(Team $hometeam, Team $awayteam)
    {
        $hometeam->resultPoint = 0.5;
        $awayteam->resultPoint = 0.5;
        if ($hometeam->getGoalScore() > $awayteam->getGoalScore()) {
            $hometeam->resultPoint = 1;
            $awayteam->resultPoint = 0;
        } elseif ($hometeam->getGoalScore() < $awayteam->getGoalScore()) {
            $hometeam->resultPoint = 0;
            $awayteam->resultPoint = 1;
        }
    }

    /**
     * Calculate win expectancies
     *
     * Formular.
     * 1 / (10^(-dr/400) + 1)
     * dr equals the difference in ratings.
     * If use hometeam advantage is true then add 100 points to the hometeam.
     *
     * @param Team $hometeam
     * @param Team $awayteam
     */
    protected function calculateWinExpectancies(Team $hometeam, Team $awayteam)
    {
        $hometeamRating = $this->useHometeamAdvantage ?
            $hometeam->getOldRating() + 100 :
            $hometeam->getOldRating()
        ;

        $calculation = function ($ratingDifference) {
            $formular = 1 / (pow(10, $ratingDifference / 400) + 1);
            return round($formular, 3);
        };

        $hometeam->winExpectancies = $calculation($awayteam->getOldRating() - $hometeamRating);
        $awayteam->winExpectancies = $calculation($hometeamRating - $awayteam->getOldRating());
    }
}
