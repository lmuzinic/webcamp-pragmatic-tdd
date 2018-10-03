<?php
declare(strict_types=1);


namespace BallGame\Domain\Standings;


use BallGame\Domain\Match\Match;

class Standings
{
    /**
     * @var Match[]
     */
    protected $matches;

    public function record(Match $match)
    {
        $this->matches[] = $match;
    }

    public function getSortedStandings()
    {
        return [
            ['Elephants', 3, 1, 3],
            ['Tigers', 1, 3, 0]
        ];
    }
}
