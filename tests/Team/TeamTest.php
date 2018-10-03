<?php
declare(strict_types=1);


namespace BallGame\Tests\Team;


use BallGame\Domain\Exception\BadTeamNameException;
use BallGame\Domain\Team\Team;
use PHPUnit\Framework\TestCase;

class TeamTest extends TestCase
{
    /**
     * @var Team
     */
    private $team;

    public function setUp()
    {
        $this->team = Team::create('Elephants');
    }

    public function testGetName()
    {
        $name = $this->team->getName();

        $this->assertEquals('Elephants', $name);
    }

    public function testTeamWithoutNameCantBeCreated()
    {
        $this->expectException(BadTeamNameException::class);

        Team::create('');
    }
}
