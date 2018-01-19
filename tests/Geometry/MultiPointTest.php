<?php

/**
 * This file is part of the GeoJSON package.
 *
 * (c) Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GeoJSON\Tests\Geometry;

use GeoJSON\Geometry\MultiPoint;
use GeoJSON\Geometry\Point;
use GeoJSON\Geometry\Position;
use GeoJSON\Type;
use PHPUnit\Framework\TestCase;

/**
 * Class MultiPointTest.
 *
 * @package GeoJSON
 * @author Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 * @link https://github.com/lorenzomar/geojson
 */
class MultiPointTest extends TestCase
{
    /**
     * @var Position[]
     */
    protected $positions;

    /**
     * @var Point[]
     */
    protected $points;

    public function __construct(string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->positions = [
            new Position(10, 20, 3),
            new Position(-20, 45, 0),
            new Position(3, 4, 5),
        ];

        $this->points = [
            new Point($this->positions[0]),
            new Point($this->positions[1]),
            new Point($this->positions[2]),
        ];
    }

    public function testConstructWithPositions()
    {
        $multiPoint = new MultiPoint($this->positions);

        $property = (new \ReflectionClass(MultiPoint::class))->getProperty('coordinates');
        $property->setAccessible(true);

        $this->assertSame($this->positions, $property->getValue($multiPoint));
    }

    public function testConstructWithPoints()
    {
        $multiPoint = new MultiPoint($this->points);

        $property = (new \ReflectionClass(MultiPoint::class))->getProperty('coordinates');
        $property->setAccessible(true);

        $this->assertSame($this->positions, $property->getValue($multiPoint));
    }

    public function testConstructWithMixedTypes()
    {
        $data = [
            $this->points[0],
            $this->positions[1],
            $this->points[2],
        ];

        $multiPoint = new MultiPoint($data);

        $property = (new \ReflectionClass(MultiPoint::class))->getProperty('coordinates');
        $property->setAccessible(true);

        $this->assertSame($this->positions, $property->getValue($multiPoint));
    }

    public function testType()
    {
        $multipoint = new MultiPoint([]);

        $this->assertTrue($multipoint->type()->is(Type::MULTIPOINT()));
    }

    public function testCoordinatesFromPositions()
    {
        $multiPoint = new MultiPoint($this->positions);

        $this->assertSame($this->positions, $multiPoint->coordinates());
    }

    public function testCoordinatesFromPoints()
    {
        $multiPoint = new MultiPoint($this->points);

        $this->assertSame($this->positions, $multiPoint->coordinates());
    }

    public function testPointsFromCoordinates()
    {
        $multiPoint = new MultiPoint($this->positions);

        $this->assertCount(count($this->positions), $multiPoint->points());

        foreach ($multiPoint->points() as $i => $point) {
            $this->assertTrue($point->coordinates()->equals($this->points[$i]->coordinates()));
        }
    }

    public function testEquals()
    {
        $multiPoints1 = new MultiPoint($this->positions);
        $multiPoints2 = new MultiPoint($this->positions);
        $multiPoints3 = new MultiPoint([new Position(1, 2, 3),]);

        $this->assertTrue($multiPoints1->equals($multiPoints2));
        $this->assertTrue($multiPoints2->equals($multiPoints1));
        $this->assertFalse($multiPoints1->equals($multiPoints3));
        $this->assertFalse($multiPoints3->equals($multiPoints1));
        $this->assertFalse($multiPoints2->equals($multiPoints3));
        $this->assertFalse($multiPoints3->equals($multiPoints2));
    }
}
