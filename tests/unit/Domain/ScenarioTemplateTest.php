<?php

namespace BrasseursApplis\Arrows\Test\Unit\Domain;

use BrasseursApplis\Arrows\Exception\ScenarioException;
use BrasseursApplis\Arrows\Id\ResearcherId;
use BrasseursApplis\Arrows\Id\ScenarioTemplateId;
use BrasseursApplis\Arrows\ScenarioTemplate;
use BrasseursApplis\Arrows\VO\Orientation as O;
use BrasseursApplis\Arrows\VO\Position as P;
use BrasseursApplis\Arrows\VO\Sequence;
use Faker\Factory;

class ScenarioTemplateTest extends \PHPUnit_Framework_TestCase
{
    /** @var ScenarioTemplateId */
    private $id;

    /** @var ResearcherId */
    private $author;

    /** @var string */
    private $name;

    /** @var int */
    private $nbSequences;

    /** @var Sequence */
    private $firstSequence;

    /** @var Sequence */
    private $secondSequence;

    /** @var Sequence */
    private $thirdSequence;

    /** @var Sequence */
    private $fourthSequence;

    /** @var ScenarioTemplate */
    private $serviceUnderTest;

    /**
     * Init
     */
    public function setUp()
    {
        $faker = Factory::create();

        $this->id = new ScenarioTemplateId($faker->uuid);
        $this->author = new ResearcherId($faker->uuid);
        $this->name = $faker->userName;
        $this->nbSequences = 3;

        $this->firstSequence = new Sequence(P::top(), O::left(), O::right(), O::left());
        $this->secondSequence = new Sequence(P::bottom(), O::left(), O::left(), O::left());
        $this->thirdSequence = new Sequence(P::top(), O::right(), O::right(), O::left());
        $this->fourthSequence = new Sequence(P::bottom(), O::left(), O::right(), O::right());

        $this->serviceUnderTest = new ScenarioTemplate($this->id, $this->author, $this->name, $this->nbSequences);
    }

    /**
     * Close
     */
    public function tearDown()
    {
        \Mockery::close();
    }

    /**
     * @test
     */
    public function itShouldHaveAnId()
    {
        $this->assertEquals($this->id, $this->serviceUnderTest->getId());
    }

    /**
     * @test
     */
    public function itShouldHaveAnAuthor()
    {
        $this->assertEquals($this->author, $this->serviceUnderTest->getAuthor());
    }

    /**
     * @test
     */
    public function itShouldHaveAName()
    {
        $this->assertEquals($this->name, $this->serviceUnderTest->getName());
    }

    /**
     * @test
     */
    public function itShouldAllowToReplaceASequence()
    {
        $this->givenACompleteScenarioTemplate();

        $this->serviceUnderTest->replaceSequence(0, $this->fourthSequence);
        $this->assertEquals($this->fourthSequence, $this->serviceUnderTest->getSequence(0));
    }

    /**
     * @test
     */
    public function itShouldNotAllowToReplaceANonExistingSequence()
    {
        $this->setExpectedException(ScenarioException::class);

        $this->serviceUnderTest->replaceSequence(0, $this->fourthSequence);
    }

    /**
     * @test
     */
    public function itShouldBePossibleToGetACompleteScenarioFromTheTemplate()
    {
        $this->givenACompleteScenarioTemplate();

        $scenario = $this->serviceUnderTest->getScenario();
        $this->assertEquals($this->firstSequence, $scenario->run());
        $this->assertEquals($this->secondSequence, $scenario->next());
        $this->assertEquals($this->thirdSequence, $scenario->next());
    }

    protected function givenACompleteScenarioTemplate()
    {
        $this->serviceUnderTest->addSequence($this->firstSequence);
        $this->serviceUnderTest->addSequence($this->secondSequence);
        $this->serviceUnderTest->addSequence($this->thirdSequence);
    }
}
