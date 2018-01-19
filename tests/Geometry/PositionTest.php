<?php

/**
 * This file is part of the GeoJSON package.
 *
 * (c) Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 */

namespace GeoJSON\Tests\Geometry;

use GeoJSON\Geometry\Position;
use GeoJSON\Tests\AbstractTestCase;

/**
 * Class PositionTest.
 *
 * @package GeoJSON
 * @author Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 * @link https://github.com/lorenzomar/geojson
 */
class PositionTest extends AbstractTestCase
{
    public function testLongitude()
    {
        $position = new Position(22, 18.5, 2);

        $this->assertSame($position->longitude(), (float)22);
    }

    public function testLongitudeNegative()
    {
        $position = new Position(-22, 18.5, 2);

        $this->assertSame($position->longitude(), (float)-22);
    }

    public function testLatitude()
    {
        $position = new Position(22, 18.5, 2);

        $this->assertSame($position->latitude(), (float)18.5);
    }

    public function testLatitudeNegative()
    {
        $position = new Position(22, -18.5, 2);

        $this->assertSame($position->latitude(), (float)-18.5);
    }

    public function testElevation()
    {
        $position = new Position(22, -18.5, 2);

        $this->assertSame($position->elevation(), (float)2);
    }

    public function testElevationNegative()
    {
        $position = new Position(22, -18.5, -2);

        $this->assertSame($position->elevation(), (float)-2);
    }

    public function testSameOf()
    {
        $position1 = new Position(22, -18.5, -2);
        $position2 = new Position(22, -18.5, -2);
        $position2Bad = new Position(22, -18.5, null);

        $this->assertTrue($position1->equals($position2));
        $this->assertTrue($position2->equals($position1));
        $this->assertFalse($position1->equals($position2Bad));
        $this->assertFalse($position2Bad->equals($position1));
    }
}
