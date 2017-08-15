<?php

namespace Byng\Pimcore\Phpunit\Model\Document\Tag;

use Pimcore\Model\Document\Tag\Select;
use PHPUnit\Framework\TestCase;

/**
 * Class SelectBuilder
 *
 * @author Ioannis Giakoumidis  <ioannis@byng.co>
 */
class SelectBuilder extends TestCase
{
    /**
     * @var MockObject
     */
    private $selectStub;

    /**
     * @var string
     */
    private $returnText;


    /**
     * SelectStub constructor.
     *
     * @param string $returnText
     */
    public function __construct($returnText = "")
    {
        parent::__construct();
        $this->selectStub = $this->getMockBuilder(Select::class)->getMock();
        $this->returnText = $returnText;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->selectStub->text = $text;
    }

    /**
     * @return MockObject
     */
    public function build()
    {
        $this->setText($this->returnText);
        return $this->selectStub;
    }
}