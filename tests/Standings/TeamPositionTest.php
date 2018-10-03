<?php
declare(strict_types=1);


namespace BallGame\Tests\Standings;


use BallGame\Domain\Standings\TeamPosition;
use BallGame\Domain\Team\Team;
use PHPUnit\Framework\TestCase;

class TeamPositionTest extends TestCase
{
    /**
     * @var TeamPosition
     */
    private $teamPosition;

    public function setUp()
    {
        $team = Team::create('Elephants');

        $this->teamPosition = new TeamPosition($team);
    }

    public function testGetPointsReturnsZero()
    {
        $this->assertSame(0, $this->teamPosition->getPoints());
    }

    public function testGetPointsAfterThreeWins()
    {
        $this->teamPosition->recordWin();
        $this->teamPosition->recordWin();
        $this->teamPosition->recordWin();

        $this->assertSame(9, $this->teamPosition->getPoints());
    }

    public function testGetPointsScoredReturnsZeroWhenThereAreNoMatches()
    {
        $this->assertSame(0, $this->teamPosition->getPointsScored());
    }

    public function testGetPointsScoredReturnsSixAfterThreeGames()
    {
        $this->teamPosition->recordPointsScored(1);
        $this->teamPosition->recordPointsScored(2);
        $this->teamPosition->recordPointsScored(3);

        $this->assertSame(6, $this->teamPosition->getPointsScored());
    }

    public function testGetPointsAgainstReturnsZeroWhenThereAreNoMatches()
    {
        $this->assertSame(0, $this->teamPosition->getPointsAgainst());
    }

    public function testGetPointsAgainstReturnsSixAfterThreeGames()
    {
        $this->teamPosition->recordPointsAgainst(10);
        $this->teamPosition->recordPointsAgainst(20);
        $this->teamPosition->recordPointsAgainst(30);

        $this->assertSame(60, $this->teamPosition->getPointsAgainst());
    }
}
