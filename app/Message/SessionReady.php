<?php

namespace BrasseursDApplis\Arrows\App\Message;

class SessionReady implements \JsonSerializable
{
    const TYPE = 'session.ready';

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
        return [ 'type' => self::TYPE ];
    }
}