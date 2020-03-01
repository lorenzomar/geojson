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
use GeoJSON\Exception\InvalidArgumentException;
use GeoJSON\GeoJson;
use GeoJSON\Type;

/**
 * Class LineString.
 *
 * @package GeoJSON
 * @author Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 * @link https://github.com/lorenzomar/geojson
 */
class LineString extends Geometry
{
    /**
     * @var Position[]
     */
    protected $coordinates = [];

    public function __construct(array $coordinates, BoundingBox $bbox = null)
    {
        parent::__construct(Type::LINESTRING(), $bbox);

        foreach ($coordinates as $coordinate) {
            if ($coordinate instanceof Point) {
                $this->coordinates[] = $coordinate->coordinates();
            } elseif ($coordinate instanceof Position) {
                $this->coordinates[] = $coordinate;
            }
        }

        if (count($this->coordinates) < 2) {
            throw new InvalidArgumentException("{$this->type->getValue()} requires at least 2 positions");
        }
    }

    /**
     * coordinates.
     *
     * @return Position[]
     */
    public function coordinates(): array
    {
        return $this->coordinates;
    }

    /**
     * points.
     *
     * @return Point[]
     */
    public function points(): array
    {
        return array_map(function (Position $position) {
            return new Point($position);
        }, $this->coordinates);
    }

    /**
     * @inheritdoc.
     *
     * @param GeoJson|LineString $geoJson
     */
    public function equals(GeoJson $geoJson): bool
    {
        return parent::equals($geoJson) && $this->checkPositionSetsEquality($this->coordinates, $geoJson->coordinates);
    }
}