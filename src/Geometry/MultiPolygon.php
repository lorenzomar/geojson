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
use GeoJSON\Type;

/**
 * Class MultiPolygon.
 *
 * @package GeoJSON
 * @author Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 * @link https://github.com/lorenzomar/geojson
 */
class MultiPolygon extends Geometry
{
    /**
     * @var Position[][][]
     */
    protected $coordinates = [];

    public function __construct(array $polygonOrCoordinates, BoundingBox $bbox = null)
    {
        parent::__construct(Type::MULTIPOLYGON(), $bbox);

        foreach ($polygonOrCoordinates as $polygonOrCoordinate) {
            if (is_array($polygonOrCoordinate)) {
                $this->coordinates[] = (new Polygon($polygonOrCoordinate))->coordinates();
            } elseif ($polygonOrCoordinate instanceof Polygon) {
                $this->coordinates[] = $polygonOrCoordinate->coordinates();
            }
        }
    }
}