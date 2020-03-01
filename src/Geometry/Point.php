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
 * Class Point.
 *
 * @package GeoJSON
 * @author Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 * @link https://github.com/lorenzomar/geojson
 */
class Point extends Geometry
{
    /**
     * @var Position
     */
    protected $coordinates;

    public function __construct(Position $coordinates, BoundingBox $bbox = null)
    {
        parent::__construct(Type::POINT(), $bbox);

        $this->coordinates = $coordinates;
    }

    /**
     * coordinates.
     *
     * @return Position
     */
    public function coordinates(): Position
    {
        return $this->coordinates;
    }

    /**
     * @inheritdoc.
     *
     * @param GeoJson|Point $geoJson
     */
    public function equals(GeoJson $geoJson): bool
    {
        return parent::equals($geoJson) && $this->coordinates->equals($geoJson->coordinates);
    }
}