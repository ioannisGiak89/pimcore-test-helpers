<?php

namespace Byng\Pimcore\Phpunit\Model\Asset;

use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use Pimcore\Model\Asset\Image;

/**
 * Class ImageAssetBuilder
 *
 * @author Ioannis Giakoumidis <ioannis@byng.co>
 */
class ImageAssetBuilder extends TestCase
{
    /**
     * @var MockObject
     */
    private $imageStub;


    /**
     * ImageStub constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->imageStub = $this->getMockBuilder(Image::class)->getMock();
    }

    /**
     * @return MockObject
     */
    public function build()
    {
        return $this->imageStub;
    }
}