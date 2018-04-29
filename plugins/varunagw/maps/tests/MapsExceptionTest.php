<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use VarunAgw\Maps\MapsException;

final class MapsExceptionTest extends TestCase {

    public function testExpectException() {
        $this->assertInstanceOf(Exception::class, new MapsException());
        $this->assertInstanceOf(MapsException::class, new MapsException());
    }

}
