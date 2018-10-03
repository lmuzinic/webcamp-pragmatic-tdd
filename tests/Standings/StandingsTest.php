<?php
declare(strict_types=1);


namespace BallGame\Tests\Standings;


use BallGame\Domain\Match\Match;
use BallGame\Domain\Standings\Standings;
use BallGame\Domain\Team\Team;
use PHPUnit\Framework\TestCase;

class StandingsTest extends TestCase
{
    /**
     * @var Standings
     */
    private $standings;

    public function setUp()
    {
        $this->standings = new Standings();
    }

    public function testGetStandingReturnsSortedLeagueStandings()
    {
        // Given
        $elephants = Team::create('Elephants');
        $tigers = Team::create('Tigers');

        $match = Match::create($elephants, $tigers, 3, 1);

        $this->standings->record($match);

        // When
        $actualStandings = $this->standings->getSortedStandings();

        // Then
        $this->assertSame(
            [
                ['Elephants', 3, 1, 3],
                ['Tigers', 1, 3, 0],
            ],
            $actualStandings);
    }

    public function testGetStandingReturnsSortedLeagueStandingsWhenAwayTeamFinishesFirst()
    {
        // Given
        $elephants = Team::create('Elephants');
        $tigers = Team::create('Tigers');

        $match = Match::create($elephants, $tigers, 0, 1);

        $this->standings->record($match);

        // When
        $actualStandings = $this->standings->getSortedStandings();

        // Then
        $this->assertSame(
            [
                ['Tigers', 1, 0, 3],
                ['Elephants', 0, 1, 0],
            ],
            $actualStandings);
    }
}
