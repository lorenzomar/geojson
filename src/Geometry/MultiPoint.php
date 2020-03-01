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
use GeoJSON\GeoJson;
use GeoJSON\Type;

/**
 * Class MultiPoint.
 *
 * @package GeoJSON
 * @author Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 * @link https://github.com/lorenzomar/geojson
 */
class MultiPoint extends Geometry
{
    /**
     * @var Position[]
     */
    protected $coordinates = [];

    public function __construct(array $points, BoundingBox $bbox = null)
    {
        parent::__construct(Type::MULTIPOINT(), $bbox);

        foreach ($points as $point) {
            if ($point instanceof Point) {
                $this->coordinates[] = $point->coordinates();
            } elseif ($point instanceof Position) {
                $this->coordinates[] = $point;
            }
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
     * @param GeoJson|MultiPoint $geoJson
     */
    public function equals(GeoJson $geoJson): bool
    {
        return parent::equals($geoJson) && $this->checkPositionSetsEquality($this->coordinates, $geoJson->coordinates);
    }
}