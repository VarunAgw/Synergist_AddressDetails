<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use VarunAgw\Framework\Config;

final class ConfigTest extends TestCase {

    protected $_config;

    protected function setUp() {
        $this->_config = new Config;
    }

    public function testInstance() {
        $this->assertInstanceOf(
                Config::class, $this->_config
        );
    }

    /**
     * @depends testInstance
     */
    public function testReadwithExistingKey() {
        $this->assertNotEmpty(
                $this->_config->read('Google.Maps.key')
        );
    }

    /**
     * @depends testInstance
     */
    public function testReadwWithExistingArray() {
        $this->assertInternalType('array'
                , $this->_config->read('Google.Maps')
        );
    }

    /**
     * @depends testInstance
     */
    public function testReadWithInvalidKey() {
        $this->assertNull(
                $this->_config->read('Google.Maps.kedasy')
        );
    }

    /**
     * @depends testInstance
     */
    public function testReadwOrFailWithExistingKey() {
        $this->assertNotEmpty(
                $this->_config->readOrFail('Google.Maps.key')
        );
    }

    /**
     * @depends testInstance
     */
    public function testReadOrFailWithInvalidKey() {
        $this->expectException(
                \Exception::class
        );

        $this->_config->readOrFail('Google.Maps.kedasdasy');
    }

}
