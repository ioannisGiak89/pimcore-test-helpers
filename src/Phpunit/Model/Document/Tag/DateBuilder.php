<?php

namespace Byng\Pimcore\Phpunit\Model\Document\Tag;

use Pimcore\Model\Document\Tag\Date;
use PHPUnit\Framework\TestCase;

/**
 * Class DateBuilder
 *
 * @author Ioannis Giakoumidis  <ioannis@byng.co>
 */
class DateBuilder extends TestCase
{
    /**
     * @var MockObject
     */
    private $dateStub;

    /**
     * @var array
     */
    private $methods = [
        "getData",
        "getTimestamp"
    ];

    /**
     * @var string
     */
    private $returnDate;


    /**
     * DateStub constructor.
     * @param string $returnDate
     */
    public function __construct($returnDate)
    {
        parent::__construct();

        $this->dateStub = $this->getMockBuilder(Date::class)
            ->setMethods($this->methods)
            ->getMock();

        $this->returnDate = $returnDate;
    }

    /**
     * @return MockObject
     */
    public function build()
    {
        $date = new \Zend_Date($this->returnDate);
        $this->dateStub
            ->method("getData")
            ->willReturn($date);

        $this->dateStub
            ->method("getTimestamp")
            ->willReturn($date->getTimestamp());

        return $this->dateStub;
    }

}