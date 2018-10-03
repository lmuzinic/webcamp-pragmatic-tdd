<?php
declare(strict_types=1);


namespace BallGame\Tests\Team;


use BallGame\Domain\Exception\BadMatchException;
use BallGame\Domain\Match\Match;
use BallGame\Domain\Team\Team;
use PHPUnit\Framework\TestCase;

class MatchTest extends TestCase
{
    public function testMatchBetweenSameTeamsCantBeAllowed()
    {
        $this->expectException(BadMatchException::class);

        Match::create(
            Team::create('Elephants'),
            Team::create('Elephants'),
            3,
            1
        );
    }
}
