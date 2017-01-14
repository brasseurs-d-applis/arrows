<?php

namespace BrasseursDApplis\Arrows\VO;

use BrasseursDApplis\Arrows\Exception\ScenarioAssertion;
use BrasseursDApplis\Arrows\Exception\ScenarioException;

class Scenario
{
    /** @var SequenceCollection */
    private $sequences;

    /** @var int */
    private $currentPosition;

    /**
     * Scenario constructor.
     *
     * @param SequenceCollection $sequences
     */
    public function __construct(SequenceCollection $sequences)
    {
        $this->sequences = $sequences;
        $this->currentPosition = null;
    }

    /**
     * @return Sequence
     */
    public function run()
    {
        $this->ensureScenarioIsNotAlreadyRunning();

        $this->currentPosition = 0;

        return $this->current();
    }

    /**
     * Stop the run
     */
    public function stop()
    {
        $this->currentPosition = null;
    }

    /**
     * @return Sequence
     */
    public function current()
    {
        $this->ensureScenarioIsRunning();

        return $this->sequences->get($this->currentPosition);
    }

    /**
     * @return Sequence
     */
    public function next()
    {
        $this->ensureScenarioIsRunning();
        $this->ensureNextPositionIsInBounds();

        $this->currentPosition++;

        return $this->current();
    }

    /**
     * @return bool
     */
    public function isRunning()
    {
        return $this->currentPosition !== null;
    }

    /**
     * @return bool
     */
    public function hasNext()
    {
        return $this->currentPosition < $this->sequences->count() - 1;
    }

    /**
     * @throws ScenarioException
     */
    private function ensureNextPositionIsInBounds()
    {
        ScenarioAssertion::true($this->hasNext(), 'There is no next position.');
    }

    /**
     * @throws ScenarioException
     */
    private function ensureScenarioIsNotAlreadyRunning()
    {
        ScenarioAssertion::null($this->currentPosition, 'ScenarioTemplate is already running.');
    }

    /**
     * @throws ScenarioException
     */
    private function ensureScenarioIsRunning()
    {
        ScenarioAssertion::notNull($this->currentPosition, 'ScenarioTemplate is not running.');
    }
}