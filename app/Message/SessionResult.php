<?php

namespace BrasseursDApplis\Arrows\App\Message;

use BrasseursDApplis\Arrows\VO\Duration;
use BrasseursDApplis\Arrows\VO\MillisecondTimestamp;
use BrasseursDApplis\Arrows\VO\Orientation;

class SessionResult implements Message, \JsonSerializable
{
    const TYPE = 'session.result';

    /** @var string */
    private $orientation;

    /** @var int */
    private $startingTime;

    /** @var int */
    private $endingTime;

    /**
     * Response constructor.
     *
     * @param string $orientation
     * @param int    $startingTime
     * @param int    $endingTime
     */
    public function __construct($orientation, $startingTime, $endingTime)
    {
        $this->orientation = $orientation;
        $this->startingTime = $startingTime;
        $this->endingTime = $endingTime;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return self::TYPE;
    }

    /**
     * @return Orientation
     */
    public function getOrientation()
    {
        switch ($this->orientation) {
            case Orientation::LEFT:
                return Orientation::left();
            case Orientation::RIGHT:
                return Orientation::right();
            default:
                throw new \InvalidArgumentException('Orientation not recognized');
        }
    }

    /**
     * @return Duration
     */
    public function getDuration()
    {
        return new Duration(new MillisecondTimestamp($this->startingTime), new MillisecondTimestamp($this->endingTime));
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     *        which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
            'type' => self::TYPE,
            'orientation' => $this->orientation,
            'startingTime' => $this->startingTime,
            'endingTime' => $this->endingTime
        ];
    }
}