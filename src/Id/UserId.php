<?php

namespace BrasseursApplis\Arrows\Id;

use Assert\Assertion;

class UserId
{
    /** @var string */
    private $id;

    /**
     * SessionId constructor.
     *
     * @param string $id
     */
    public function __construct($id)
    {
        Assertion::uuid($id);

        $this->id = (string) $id;
    }

    /**
     * @return string
     */
    function __toString()
    {
        return $this->id;
    }
}