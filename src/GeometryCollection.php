<?php

/**
 * This file is part of the GeoJSON package.
 *
 * (c) Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GeoJSON;

use GeoJSON\Geometry\Geometry;

/**
 * Class GeometryCollection.
 *
 * @package GeoJSON
 * @author Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 * @link https://github.com/lorenzomar/geojson
 */
class GeometryCollection extends GeoJson implements \Countable, \IteratorAggregate
{
    /**
     * @var Geometry[]
     */
    protected $geometries = [];

    public function __construct(array $geometries, BoundingBox $bbox = null)
    {
        parent::__construct(Type::GEOMETRYCOLLECTION(), $bbox);
        $this->geometries = Utils::filterValuesByClass($geometries, Geometry::class);
    }

    /**
     * add.
     *
     * @param Geometry $geometry
     */
    public function add(Geometry $geometry)
    {
        $this->geometries[] = $geometry;
    }

    /**
     * geometries.
     *
     * @return Geometry[]
     */
    public function geometries(): array
    {
        return $this->geometries;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->geometries);
    }

    public function count(): int
    {
        return count($this->geometries);
    }
}