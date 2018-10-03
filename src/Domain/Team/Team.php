<?php
declare(strict_types=1);


namespace BallGame\Domain\Team;


use BallGame\Domain\Exception\BadTeamNameException;

class Team
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    private function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Team
     */
    public static function create(string $name): Team
    {
        if (empty($name)) {
            throw new BadTeamNameException();
        }

        return new self($name);
    }
}
