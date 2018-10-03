<?php
declare(strict_types=1);


namespace BallGame\Tests\Standings;


use BallGame\Domain\Match\Match;
use BallGame\Domain\RuleBook\AdvancedRuleBook;
use BallGame\Domain\Standings\Standings;
use BallGame\Domain\Team\Team;
use PHPUnit\Framework\TestCase;

class StandingsWithAdvancedRuleBookTest extends TestCase
{
    /**
     * @var Standings
     */
    private $standings;

    public function setUp()
    {
        $rulebook = new AdvancedRuleBook();

        $this->standings = new Standings('Advanced season 2019', $rulebook);
    }

    public function testGetStandingReturnsSortedLeagueStandingsWhenTeamsAreTied()
    {
        // Given
        $elephants = Team::create('Elephants');
        $tigers = Team::create('Tigers');

        $match = Match::create($elephants, $tigers, 3, 1);
        $this->standings->record($match);

        $match = Match::create($tigers, $elephants, 1, 0);
        $this->standings->record($match);

        // When
        $actualStandings = $this->standings->getSortedStandings();

        // Then
        $this->assertSame(
            [
                ['Elephants', 3, 2, 3],
                ['Tigers', 2, 3, 3],
            ],
            $actualStandings);
    }
}
