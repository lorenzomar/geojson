<?php

/**
 * This file is part of the GeoJSON package.
 *
 * (c) Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 */

namespace GeoJSON\Geometry\Tests;

use GeoJSON\Geometry\Point;
use GeoJSON\Geometry\Position;
use GeoJSON\Type;
use PHPUnit\Framework\TestCase;

class PointTest extends TestCase
{
    public function testType()
    {
        $point = new Point(new Position(10, 20, 3));

        $this->assertTrue($point->type()->is(Type::POINT()));
    }

    public function testCoordinates()
    {
        $position = new Position(10, 20, 3);
        $point = new Point($position);

        $this->assertTrue($point->coordinates()->equals($position));
    }

    public function testEquals()
    {
        $point1 = new Point(new Position(10, 20, 3));
        $point2 = new Point(new Position(10, 20, 3));
        $point3 = new Point(new Position(30, 10, 0));

        $this->assertTrue($point1->equals($point2));
        $this->assertTrue($point2->equals($point1));
        $this->assertFalse($point1->equals($point3));
        $this->assertFalse($point3->equals($point1));
        $this->assertFalse($point2->equals($point3));
        $this->assertFalse($point3->equals($point2));
    }
}
