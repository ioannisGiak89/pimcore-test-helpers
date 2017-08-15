<?php

namespace Byng\Pimcore\Phpunit\Model\Document\Tag;

use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use Byng\Pimcore\Phpunit\Model\Asset\ImageAssetBuilder;
use Pimcore\Model\Document\Tag\Image;

/**
 * Class ImageBuilder
 *
 * @author Ioannis Giakoumidis <ioannis@byng.co>
 */
class ImageBuilder extends TestCase
{
    /**
     * @var MockObject
     */
    private $imageStub;

    /** @var array */
    private $methods = [
        "getImage"
    ];


    /**
     * ImageStub constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->imageStub = $this->getMockBuilder(Image::class)
            ->setMethods($this->methods)
            ->getMock();
    }

    /**
     * @return MockObject
     */
    public function build()
    {
        $assetImageStub = new ImageAssetBuilder();
        $this->imageStub
            ->method("getImage")
            ->willReturn($assetImageStub);

        return $this->imageStub;
    }
}