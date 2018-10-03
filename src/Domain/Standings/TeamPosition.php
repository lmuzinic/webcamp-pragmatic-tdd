<?php
declare(strict_types=1);


namespace BallGame\Domain\Standings;


use BallGame\Domain\Team\Team;

class TeamPosition
{
    /**
     * @var int
     */
    private $pointsAgainst = 0 ;

    /**
     * @var int
     */
    private $pointsScored = 0;

    /**
     * @var int
     */
    private $points = 0;

    /**
     * @var Team
     */
    private $team;

    /**
     * @param Team $team
     */
    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Records three points
     */
    public function recordWin()
    {
        $this->points += 3;
    }

    /**
     * @return int
     */
    public function getPointsScored()
    {
        return $this->pointsScored;
    }

    /**
     * @param int $points
     */
    public function recordPointsScored(int $points)
    {
        $this->pointsScored += $points;
    }

    /**
     * @return int
     */
    public function getPointsAgainst()
    {
        return $this->pointsAgainst;
    }

    /**
     * @param int $points
     */
    public function recordPointsAgainst(int $points)
    {
        $this->pointsAgainst += $points;
    }

    /**
     * @return Team
     */
    public function getTeam(): Team
    {
        return $this->team;
    }
}
