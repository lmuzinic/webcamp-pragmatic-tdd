<?php
declare(strict_types=1);


namespace BallGame\Domain\Team;


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
        return new self($name);
    }
}
