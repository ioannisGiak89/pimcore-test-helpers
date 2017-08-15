<?php

namespace Byng\Pimcore\Phpunit\Model\Document;

use Byng\Pimcore\Phpunit\Model\Document\Tag\ImageBuilder;
use Byng\Pimcore\Phpunit\Model\Document\Tag\TextAreaBuilder;
use Byng\Pimcore\Phpunit\Model\Document\Tag\InputBuilder;
use Byng\Pimcore\Phpunit\Model\Document\Tag\SelectBuilder;
use Byng\Pimcore\Phpunit\Model\Document\Tag\DateBuilder;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use PHPUnit_Framework_MockObject_Matcher_InvokedCount as InvokedCount;
use PHPUnit_Framework_Constraint_IsEqual as IsEqual;
use Pimcore\Model\Document\Page;

/**
 * Class PageBuilder
 *
 * @author Ioannis Giakoumidis <ioannis@byng.co>
 */
class PageBuilder extends TestCase
{
    /** @var MockObject */
    private $pageStub;

    /** @var  array */
    private $pageProperties;

    /** @var array */
    private $methods = [
        "getFullPath",
        "getElement",
        "getController",
        "getAction",
        "getTitle",
        "getCreationDate"
    ];


    /**
     * PageBuilder constructor.
     *
     * @param array $pageProperties
     */
    public function __construct($pageProperties = [])
    {
        parent::__construct();

        $this->pageStub = $this->getMockBuilder(Page::class)
            ->setMethods($this->methods)
            ->getMock();

        $this->pageProperties = $pageProperties;

    }

    /**
     * @return MockObject
     */
    public function build()
    {

        $pimcoreTags = [];
        foreach ($this->pageProperties as $pageProperty) {

            $name = $pageProperty[0];
            $type = strtolower($pageProperty[1]);
            $value = $pageProperty[2];

            switch ($type) {
                case "property":
                    $this->setProperty($name, $type, $value);
                    break;
                case "image":

                    if ($value) {
                        $imageBuilder = new ImageBuilder();
                        $value = $imageBuilder->build();
                    }
                    break;
                case "textarea":

                    if ($value) {
                        $textAreaBuilder = new TextAreaBuilder($value);
                        $value = $textAreaBuilder->build();
                    }
                    break;
                case "input":

                    if ($value) {
                        $inputBuilder = new InputBuilder($value);
                        $value = $inputBuilder->build();
                    }
                    break;
                case "select":

                    if ($value) {
                        $selectBuilder = new SelectBuilder($value);
                        $value = $selectBuilder->build();
                    }
                    break;
                case "date":
                    $dateBuilder = new DateBuilder($value);

                    if ($value) {
                        $value = $dateBuilder->build();
                    }
                    break;
                default:
                    throw new \Exception($type . " type is not supported");
            }

            if ($type !== "property") {
                $pimcoreTags[] = [ $name, $value ];
            }
        }

        if (!empty($pimcoreTags)) {
            $this->stubMethodWithValuesMap(
                "getElement",
                $pimcoreTags
            );
        }

        return $this->pageStub;
    }

    /**
     * @param string            $methodName
     * @param string            $returnValue
     * @param InvokedCount|null $callTimes
     */
    public function stubMethod($methodName, $returnValue, InvokedCount $callTimes = null)
    {
        if (!$callTimes) {
            $callTimes = $this->any();
        }

        $this->pageStub->expects($callTimes)
            ->method($methodName)
            ->willReturn($returnValue);
    }

    /**
     * @param string            $methodName
     * @param string            $returnValue
     * @param IsEqual           $with
     * @param InvokedCount|null $callTimes
     */
    public function stubMethodWithArg($methodName, $returnValue, IsEqual $with, InvokedCount $callTimes = null)
    {
        if (!$callTimes) {
            $callTimes = $this->any();
        }

        $this->pageStub
            ->method($methodName)
            ->with($with)
            ->willReturn($returnValue);
    }

    /**
     * @param string            $methodName
     * @param array             $returnValueMap
     * @param InvokedCount|null $callTimes
     */
    public function stubMethodWithValuesMap($methodName, array $returnValueMap, InvokedCount $callTimes = null)
    {
        if (!$callTimes) {
            $callTimes = $this->any();
        }

        $this->pageStub->expects($callTimes)
            ->method($methodName)
            ->will($this->returnValueMap($returnValueMap));
    }

    /**
     * @param string $name
     * @param string $type
     * @param string $value
     */
    private function setProperty($name, $type, $value)
    {
        switch (strtolower($name)) {
            case "controller":
                $this->stubMethod("getController", $value);
                break;
            case "action":
                $this->stubMethod("getAction", $value);
                break;
            case "title":
                $this->stubMethod("getTitle", $value);
                break;
            case "creationdate":
                $date = new \Zend_Date($value);
                $this->stubMethod("getCreationDate", $date->getTimestamp());
                break;
            default:
                throw new \Exception($name . " name is not supported");
        }

    }
}