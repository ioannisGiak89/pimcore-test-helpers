<?php

namespace Byng\Pimcore\Phpunit\Model\Document\Tag;

use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use Pimcore\Model\Document\Tag\Input;

/**
 * Class InputBuilder
 *
 * @author Ioannis Giakoumidis <ioannis@byng.co>
 */
class InputBuilder extends TestCase
{
    /**
     * @var MockObject
     */
    private $inputStub;

    /**
     * @var string
     */
    private $returnText;


    /**
     * InputStub constructor.
     *
     * @param string $returnText
     */
    public function __construct($returnText = "")
    {
        parent::__construct();
        $this->inputStub = $this->getMockBuilder(Input::class)->getMock();
        $this->returnText = $returnText;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->inputStub->text = $text;
    }

    /**
     * @return MockObject
     */
    public function build()
    {
        $this->setText($this->returnText);
        return $this->inputStub;
    }
}