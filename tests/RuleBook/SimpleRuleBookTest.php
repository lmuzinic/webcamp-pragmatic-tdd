<?php
declare(strict_types=1);


namespace BallGame\Tests\Team;


use BallGame\Domain\RuleBook\SimpleRuleBook;
use BallGame\Domain\Standings\TeamPosition;
use BallGame\Domain\Team\Team;
use PHPUnit\Framework\TestCase;

class SimpleRuleBookTest extends TestCase
{
    /**
     * @var SimpleRuleBook
     */
    protected $simpleRuleBook;

    /**
     * @var TeamPosition|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $teamAPosition;

    /**
     * @var TeamPosition|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $teamBPosition;

    public function setUp()
    {
        $this->teamAPosition = $this->getMockBuilder(TeamPosition::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->teamBPosition = $this->getMockBuilder(TeamPosition::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->simpleRuleBook = new SimpleRuleBook();
    }

    public function testDecideReturnsLessThenZeroWhenFirstTeamHasMorePoints()
    {
        $this->teamAPosition->method('getPoints')->willReturn(5);
        $this->teamBPosition->method('getPoints')->willReturn(4);

        $this->assertSame(-1, $this->simpleRuleBook->decide($this->teamAPosition, $this->teamBPosition));
    }

    public function testDecideReturnsMoreThenZeroWhenSecondTeamHasMorePoints()
    {
        $this->teamAPosition->method('getPoints')->willReturn(3);
        $this->teamBPosition->method('getPoints')->willReturn(4);

        $this->assertSame(1, $this->simpleRuleBook->decide($this->teamAPosition, $this->teamBPosition));
    }

    public function testDecideReturnsZeroWhenBothTeamHaveEqualPoints()
    {
        $this->teamAPosition->method('getPoints')->willReturn(1);
        $this->teamBPosition->method('getPoints')->willReturn(1);

        $this->assertSame(0, $this->simpleRuleBook->decide($this->teamAPosition, $this->teamBPosition));
    }
}
