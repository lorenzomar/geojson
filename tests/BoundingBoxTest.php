<?php

/**
 * This file is part of the GeoJSON package.
 *
 * (c) Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GeoJSON\Tests;

use GeoJSON\BoundingBox;
use GeoJSON\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Class BoundingBoxTest.
 *
 * @package GeoJSON
 * @author Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 * @link https://github.com/lorenzomar/geojson
 */
class BoundingBoxTest extends TestCase
{
    public function testConstructNotNumericException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("BoundingBox values must be integers or floats");

        new BoundingBox(['foo', 'bar', 'test', 10]);
    }

    public function testConstructInvalidMinValuesException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("BoundingBox requires at least four values");

        new BoundingBox([-180, -90]);
    }

    public function testConstructInvalidOrderException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("BoundingBox min values must precede max values");

        new BoundingBox([180, 90, -180, -90]);
    }

    public function testBoundsIntFloat()
    {
        $bounds = [-180, -90, 180.5, 90];
        $bbox = new BoundingBox($bounds);

        $this->assertSame($bounds, $bbox->bounds());
    }

    public function testBoundsNumeric()
    {
        $expected = [-180, -90, 180.5, 90.0];
        $bounds = [-180, -90, "180.5", "90.0"];
        $bbox = new BoundingBox($bounds);

        $this->assertSame($expected, $bbox->bounds());
    }

    public function testEquals()
    {
        $bbox1 = new BoundingBox([-180, -90, 180.5, 90.0]);
        $bbox2 = new BoundingBox([-180, -90, "180.5", 90.0]);
        $bbox3 = new BoundingBox([-180, -90, 30, 90.0]);

        $this->assertTrue($bbox1->equals($bbox2));
        $this->assertTrue($bbox2->equals($bbox1));
        $this->assertFalse($bbox1->equals($bbox3));
        $this->assertFalse($bbox3->equals($bbox1));
        $this->assertFalse($bbox2->equals($bbox3));
        $this->assertFalse($bbox3->equals($bbox2));
    }
}
