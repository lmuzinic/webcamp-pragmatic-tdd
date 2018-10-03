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

    /**
     * @var TeamPosition[]
     */
    protected $teamPositions;

    public function record(Match $match)
    {
        $this->matches[] = $match;
    }

    public function getSortedStandings()
    {
        foreach ($this->matches as $match) {
            if (!isset($this->teamPositions[spl_object_hash($match->getHomeTeam())])) {
                $this->teamPositions[spl_object_hash($match->getHomeTeam())] = new TeamPosition($match->getHomeTeam());
            }
            $homeTeamPosition = $this->teamPositions[spl_object_hash($match->getHomeTeam())];

            if (!isset($this->teamPositions[spl_object_hash($match->getAwayTeam())])) {
                $this->teamPositions[spl_object_hash($match->getAwayTeam())] = new TeamPosition($match->getAwayTeam());
            }
            $awayTeamPosition = $this->teamPositions[spl_object_hash($match->getAwayTeam())];

            // Yay, home team won!
            if ($match->getHomeTeamPoints() > $match->getAwayTeamPoints()) {
                $homeTeamPosition->recordWin();
            }

            // Boo, away team won :(
            if ($match->getAwayTeamPoints() > $match->getHomeTeamPoints()) {
                $awayTeamPosition->recordWin();
            }

            $homeTeamPosition->recordPointsScored($match->getHomeTeamPoints());
            $homeTeamPosition->recordPointsAgainst($match->getAwayTeamPoints());

            $awayTeamPosition->recordPointsScored($match->getAwayTeamPoints());
            $awayTeamPosition->recordPointsAgainst($match->getHomeTeamPoints());
        }

        uasort($this->teamPositions, function (TeamPosition $teamA, TeamPosition $teamB) {
            if ($teamA->getPoints() > $teamB->getPoints()) {
                return -1;
            }

            if ($teamB->getPoints() > $teamA->getPoints()) {
                return 1;
            }

            return 0;
        });

        $finalStandings = [];
        foreach ($this->teamPositions as $teamPosition) {
            $finalStandings[] = [
                $teamPosition->getTeam()->getName(),
                $teamPosition->getPointsScored(),
                $teamPosition->getPointsAgainst(),
                $teamPosition->getPoints()
            ];
        }

        return $finalStandings;
    }
}
