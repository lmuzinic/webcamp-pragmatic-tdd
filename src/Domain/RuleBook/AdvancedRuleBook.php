<?php
declare(strict_types=1);


namespace BallGame\Domain\RuleBook;


use BallGame\Domain\Standings\TeamPosition;

class AdvancedRuleBook implements RuleBookInterface
{
    public function decide(TeamPosition $teamA, TeamPosition $teamB)
    {
        if ($teamA->getPoints() > $teamB->getPoints()) {
            return -1;
        }

        if ($teamB->getPoints() > $teamA->getPoints()) {
            return 1;
        }

        if ($teamA->getPoints() === $teamB->getPoints()) {
            if ($teamA->getPointsScored() > $teamB->getPointsScored()) {
                return -1;
            }

            if ($teamB->getPointsScored() > $teamA->getPointsScored()) {
                return 1;
            }
        }

        return 0;
    }
}
