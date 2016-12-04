<?php
namespace Lsv\FussballElo\Model;

class TeamWinExpectancies
{

    /**
     * Winning Expectancies.
     *
     * @var float
     */
    public $winExpectancies;

    /**
     * Expected result in points
     *
     * @return float
     */
    public function getWinExpectancies()
    {
        return $this->winExpectancies;
    }

    /**
     * Expected result in percentage
     *
     * @param int $digits Number of decimals
     *
     * @return float
     */
    public function getWinExpectanciesInPercent($digits = 2)
    {
        return round($this->getWinExpectancies() * 100, $digits);
    }

}
