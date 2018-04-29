<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use VarunAgw\Maps\Maps;

final class MapsTest extends TestCase {

    protected $_maps;

    protected function setUp() {
        $this->_maps = new Maps;
    }

    public function testInstance() {
        $this->assertInstanceOf(
                Maps::class, $this->_maps
        );
    }

    /**
     * @depends testInstance
     */
    public function testInvalidAddress() {
        $this->assertSame(
                null, $this->_maps->getAddressDetails('dasdasdasdqq3wd')
        );
    }

    /**
     * @depends testInstance
     */
    public function testValidAddress() {
        $this->assertSame([
            'street_number' => '126',
            'route' => 'Köpenicker Straße',
            'sublocality_level_1' => 'Mitte',
            'locality' => 'Berlin',
            'administrative_area_level_1' => 'Berlin',
            'country' => 'Germany',
            'postal_code' => '10179',
        ], (array) $this->_maps->getAddressDetails('Köpenicker Str. 126'));
    }

}
