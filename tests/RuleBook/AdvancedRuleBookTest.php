<?php
declare(strict_types=1);


namespace BallGame\Tests\Team;


use BallGame\Domain\RuleBook\AdvancedRuleBook;
use BallGame\Domain\Standings\TeamPosition;
use PHPUnit\Framework\TestCase;

class AdvancedRuleBookTest extends TestCase
{
    /**
     * @var AdvancedRuleBook
     */
    protected $advancedRuleBook;

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

        $this->advancedRuleBook = new AdvancedRuleBook();
    }

    public function testDecideReturnsLessThenZeroWhenFirstTeamHasMorePoints()
    {
        $this->teamAPosition->method('getPoints')->willReturn(5);
        $this->teamBPosition->method('getPoints')->willReturn(4);

        $this->assertSame(-1, $this->advancedRuleBook->decide($this->teamAPosition, $this->teamBPosition));
    }

    public function testDecideReturnsMoreThenZeroWhenSecondTeamHasMorePoints()
    {
        $this->teamAPosition->method('getPoints')->willReturn(3);
        $this->teamBPosition->method('getPoints')->willReturn(4);

        $this->assertSame(1, $this->advancedRuleBook->decide($this->teamAPosition, $this->teamBPosition));
    }

    public function testDecideReturnsLessThanZeroWhenBothTeamHaveEqualPointsButFirstTeamHasMorePointsScored()
    {
        $this->teamAPosition->method('getPoints')->willReturn(1);
        $this->teamBPosition->method('getPoints')->willReturn(1);

        $this->teamAPosition->method('getPointsScored')->willReturn(5);
        $this->teamBPosition->method('getPointsScored')->willReturn(4);

        $this->assertSame(-1, $this->advancedRuleBook->decide($this->teamAPosition, $this->teamBPosition));
    }

    public function testDecideReturnsMoreThanZeroWhenBothTeamHaveEqualPointsButSecondTeamHasMorePointsScored()
    {
        $this->teamAPosition->method('getPoints')->willReturn(1);
        $this->teamBPosition->method('getPoints')->willReturn(1);

        $this->teamAPosition->method('getPointsScored')->willReturn(3);
        $this->teamBPosition->method('getPointsScored')->willReturn(4);

        $this->assertSame(1, $this->advancedRuleBook->decide($this->teamAPosition, $this->teamBPosition));
    }

    public function testDecideReturnsZeroWhenBothTeamHaveEqualPointsAndEqualPointsScored()
    {
        $this->teamAPosition->method('getPoints')->willReturn(1);
        $this->teamBPosition->method('getPoints')->willReturn(1);

        $this->teamAPosition->method('getPointsScored')->willReturn(5);
        $this->teamBPosition->method('getPointsScored')->willReturn(5);

        $this->assertSame(0, $this->advancedRuleBook->decide($this->teamAPosition, $this->teamBPosition));
    }
}
