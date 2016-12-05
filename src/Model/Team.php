<?php

namespace Lsv\FussballElo\Model;

class Team extends TeamWinExpectancies
{

    /**
     * The player new rating
     *
     * @var int
     */
    public $rating;

    /**
     * The player old rating.
     *
     * @var int
     */
    public $oldRating;

    /**
     * The result point.
     *
     * @var int
     */
    public $resultPoint;

    /**
     * Number of goals scored by this user.
     *
     * @var int
     */
    public $goalScore;

    /**
     * @param int $oldRating
     * @param int $goalScore
     */
    public function __construct($oldRating, $goalScore)
    {
        $this->oldRating = $oldRating;
        $this->goalScore = $goalScore;
    }

    /**
     * The team new rating.
     *
     * @return int
     */
    public function getRating()
    {
        return round($this->rating, 0);
    }

    /**
     * The team rating change.
     *
     * @return int
     */
    public function getPointChange()
    {
        return $this->getRating() - $this->getOldRating();
    }

    /**
     * The team old rating.
     *
     * @return int
     */
    public function getOldRating()
    {
        return $this->oldRating;
    }

    /**
     * The wintype point.
     *
     * @return int
     */
    public function getResultPoint()
    {
        return $this->resultPoint;
    }

    /**
     * Number of goals scored by this team.
     *
     * @return int
     */
    public function getGoalScore()
    {
        return $this->goalScore;
    }
}
