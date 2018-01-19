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

use GeoJSON\Exception\InvalidArgumentException;
use GeoJSON\Geometry\LineString;
use GeoJSON\Geometry\Point;
use GeoJSON\Geometry\Position;
use GeoJSON\Tests\AbstractTestCase;
use GeoJSON\Type;

/**
 * Class LineStringTest.
 *
 * @package GeoJSON
 * @author Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 * @link https://github.com/lorenzomar/geojson
 */
class LineStringTest extends AbstractTestCase
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

    public function testConstructWithLessThan2Coordinates()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Type::LINESTRING()->getValue() . " requires at least 2 positions");

        new LineString([$this->positions[0]]);
    }

    public function testConstructWithPositions()
    {
        $lineString = new LineString($this->positions);

        $this->assertSame($this->positions, $this->extractObjectProperty($lineString, 'coordinates'));
    }

    public function testConstructWithPoints()
    {
        $lineString = new LineString($this->points);

        $this->assertSame($this->positions, $this->extractObjectProperty($lineString, 'coordinates'));
    }

    public function testConstructWithMixedTypes()
    {
        $data = [
            $this->points[0],
            $this->positions[1],
            $this->points[2],
        ];

        $lineString = new LineString($data);

        $this->assertSame($this->positions, $this->extractObjectProperty($lineString, 'coordinates'));
    }

    public function testType()
    {
        $lineString = new LineString($this->positions);

        $this->assertTrue($lineString->type()->is(Type::LINESTRING()));
    }

    public function testCoordinatesFromPositions()
    {
        $lineString = new LineString($this->positions);

        $this->assertSame($this->positions, $lineString->coordinates());
    }

    public function testCoordinatesFromPoints()
    {
        $lineString = new LineString($this->points);

        $this->assertSame($this->positions, $lineString->coordinates());
    }

    public function testPointsFromCoordinates()
    {
        $lineString = new LineString($this->positions);

        $this->assertCount(count($this->positions), $lineString->points());

        foreach ($lineString->points() as $i => $point) {
            $this->assertTrue($point->coordinates()->equals($this->points[$i]->coordinates()));
        }
    }

    public function testEquals()
    {
        $lineString1 = new LineString($this->positions);
        $lineString2 = new LineString($this->positions);
        $lineString3 = new LineString([
            new Position(1, 2, 3),
            new Position(2, 3, 4),
        ]);

        $this->assertTrue($lineString1->equals($lineString2));
        $this->assertTrue($lineString2->equals($lineString1));
        $this->assertFalse($lineString1->equals($lineString3));
        $this->assertFalse($lineString3->equals($lineString1));
        $this->assertFalse($lineString2->equals($lineString3));
        $this->assertFalse($lineString3->equals($lineString2));
    }
}
