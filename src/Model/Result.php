<?php
namespace Lsv\FussballElo\Model;

class Result
{

    /**
     * Player A rating.
     *
     * @var Rating
     */
    public $playerA;

    /**
     * Player B rating.
     *
     * @var Rating
     */
    public $playerB;

    /**
     * @param Rating $playerA
     * @param Rating $playerB
     */
    public function __construct(Rating $playerA, Rating $playerB)
    {
        $this->playerA = $playerA;
        $this->playerB = $playerB;
    }

    /**
     * @return Rating
     */
    public function getPlayerA()
    {
        return $this->playerA;
    }

    /**
     * @return Rating
     */
    public function getPlayerB()
    {
        return $this->playerB;
    }
}
