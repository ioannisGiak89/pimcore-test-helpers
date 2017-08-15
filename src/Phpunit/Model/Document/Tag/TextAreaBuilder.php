<?php

namespace Byng\Pimcore\Phpunit\Model\Document\Tag;

use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use Pimcore\Model\Document\Tag\TextArea;

/**
 * Class TextAreaBuilder
 *
 * @author Ioannis Giakoumidis <ioannis@byng.co>
 */
class TextAreaBuilder extends TestCase
{
    /**
     * @var MockObject
     */
    private $textAreaStub;

    /**
     * @var string
     */
    private $returnText;


    /**
     * TextAreaStub constructor.
     *
     * @param string $returnText
     */
    public function __construct($returnText = "")
    {
        parent::__construct();
        $this->textAreaStub = $this->getMockBuilder(TextArea::class)->getMock();
        $this->returnText = $returnText;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->textAreaStub->text = $text;
    }

    /**
     * @return MockObject
     */
    public function build()
    {
        $this->setText($this->returnText);
        return $this->textAreaStub;
    }
}