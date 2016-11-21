<?php
namespace Lsv\FussballElo\Model;

class Rating
{

    /**
     * The player point change
     *
     * @var float
     */
    public $pointChange;

    /**
     * The player old rating
     *
     * @var int
     */
    public $oldRating;

    /**
     * Tournament index factor (eloFactor) for this calculation
     *
     * @var int
     */
    public $tournamentIndexFactor;

    /**
     * The goal difference in calculated points
     *
     * @var float
     */
    public $goalDifference;

    /**
     * Expected result, can be used as a percentage of winning
     *
     * @var float
     */
    public $expectedResult;

    /**
     * The wintype point
     *
     * @var int
     */
    public $winType;

    /**
     * Number of goals scored by this user
     *
     * @var int
     */
    public $goalScore;

    /**
     * @param int $oldRating
     * @param int $goalScore
     * @param int $tournamentIndexFactor
     */
    public function __construct($oldRating, $goalScore, $tournamentIndexFactor)
    {
        $this->oldRating = $oldRating;
        $this->goalScore = $goalScore;
        $this->tournamentIndexFactor = $tournamentIndexFactor;
    }

    /**
     * The player new rating
     *
     * @return int
     */
    public function getRating()
    {
        return floor($this->getOldRating() + $this->getPointChange());
    }

    /**
     * The player point change
     *
     * @return float
     */
    public function getPointChange()
    {
        return $this->pointChange;
    }

    /**
     * The player old rating
     *
     * @return int
     */
    public function getOldRating()
    {
        return $this->oldRating;
    }

    /**
     * Tournament index factor (eloFactor) for this calculation
     *
     * @return int
     */
    public function getTournamentIndexFactor()
    {
        return $this->tournamentIndexFactor;
    }

    /**
     * The goal difference in calculated points
     *
     * @return float
     */
    public function getGoalDifference()
    {
        return $this->goalDifference;
    }

    /**
     * Expected result, can be used as a percentage of winning
     *
     * @return float
     */
    public function getExpectedResult()
    {
        return $this->expectedResult;
    }

    /**
     * The wintype point
     *
     * @return int
     */
    public function getWinType()
    {
        return $this->winType;
    }

    /**
     * Number of goals scored by this user
     *
     * @return int
     */
    public function getGoalScore()
    {
        return $this->goalScore;
    }
}
