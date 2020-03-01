<?php

/**
 * This file is part of the GeoJSON package.
 *
 * (c) Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GeoJSON\Geometry;

use GeoJSON\BoundingBox;
use GeoJSON\Utils;
use GeoJSON\Type;

/**
 * Class Polygon.
 *  {
 * "type": "Polygon",
 * "coordinates": [
 * [
 * [0, 0], [10, 10], [10, 0], [0, 0], External ring
 * ],
 * [
 * [0, 0], [10, 10], [10, 0], [0, 0], Internal ring 1
 * ],
 * [
 * [0, 0], [10, 10], [10, 0], [0, 0], Internal ring 2
 * ]
 * ]
 * }
 *  {
 * "type": "Polygon",
 * "coordinates": [
 *      {Position,Position,Position,Position}, // LinearRing
 *      [
 *          [0, 0], [10, 10], [10, 0], [0, 0], Internal ring 1
 *      ],
 * ]
 * }
 *
 * @package GeoJSON
 * @author Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 * @link https://github.com/lorenzomar/geojson
 */
class Polygon extends Geometry
{
    /**
     * @var Position[][]
     */
    protected $coordinates = [];

    public function __construct(array $linearRingsOrCoordinates, BoundingBox $bbox = null)
    {
        parent::__construct(Type::POLYGON(), $bbox);

        // Case 1: an array of 4 or more Position objects
        if (
            count($linearRingsOrCoordinates) >= 4 &&
            count(Utils::filterPositions($linearRingsOrCoordinates)) === count($linearRingsOrCoordinates)
        ) {
            $linearRingsOrCoordinates = [$this->initLinearRing($linearRingsOrCoordinates)];
        }

        foreach ($linearRingsOrCoordinates as $linearRingsOrCoordinate) {
            if (is_array($linearRingsOrCoordinate)) {
                if (!empty($linearRingsOrCoordinate)) {
                    $linearRingsOrCoordinate = $this->initLinearRing(Utils::filterPositions($linearRingsOrCoordinate));
                }
            }

            $this->coordinates[] = $linearRingsOrCoordinate->coordinates();
        }
    }

    protected function initLinearRing($coordinates): LinearRing
    {
        try {
            return new LinearRing($coordinates);
        } catch (\Exception $e) {
            throw new \InvalidArgumentException("Invalid coordinates. The only allowed values are: an array of 4 or more 
            Position objects, an array of LinearRing objects, an array of mixed LinearRing objects and array of 4 or more 
            Position objects");
        }
    }

    private function test()
    {
        $s = new static(['pos1', 'pos2', 'pos3', 'pos4', 'pos5']);
        $s = new static([
            ['pos1', 'pos2', 'pos3', 'pos4', 'pos5'], // External ring
            ['pos1', 'pos2', 'pos3', 'pos4', 'pos5'], // Internal ring
        ]);
        $s = new static([
            new LinearRing(['pos1', 'pos2', 'pos3', 'pos4', 'pos5']), // External
            new LinearRing(['pos1', 'pos2', 'pos3', 'pos4', 'pos5']), // Internal
        ]);
    }

    /**
     * coordinates.
     *
     * @return Position[][]
     */
    public function coordinates(): array
    {
        return $this->coordinates;
    }

    /**
     * linearRings.
     *
     * @return LinearRing[]
     */
    public function linearRings(): array
    {
        return array_map(function (array $coordinates) {
            return new LinearRing($coordinates);
        }, $this->coordinates);
    }
}