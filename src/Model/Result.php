<?php

namespace Lsv\FussballElo\Model;

class Result
{
    /**
     * Hometeam.
     *
     * @var Team
     */
    public $homeTeam;

    /**
     * Awayteam.
     *
     * @var Team
     */
    public $awayTeam;

    /**
     * Match weight for this game.
     *
     * @var int
     */
    public $matchWeight;

    /**
     * Match weight adjusted with goal score.
     *
     * @var float
     */
    public $matchWeightGoalscoreAdjusted;

    /**
     * Get the result hometeam
     *
     * @return Team
     */
    public function getHomeTeam()
    {
        return $this->homeTeam;
    }

    /**
     * Get the result awayteam
     *
     * @return Team
     */
    public function getAwayTeam()
    {
        return $this->awayTeam;
    }

    /**
     * Tournament index factor (eloFactor) for this calculation.
     *
     * @return int
     */
    public function getMatchWeight()
    {
        return $this->matchWeight;
    }

    /**
     * The goal difference in calculated points.
     *
     * @return float
     */
    public function getMatchWeightGoalscoreAdjusted()
    {
        return $this->matchWeightGoalscoreAdjusted;
    }
}
