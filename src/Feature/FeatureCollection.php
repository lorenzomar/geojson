<?php

/**
 * This file is part of the GeoJSON package.
 *
 * (c) Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GeoJSON\Feature;

use GeoJSON\BoundingBox;
use GeoJSON\GeoJson;
use GeoJSON\Type;
use GeoJSON\Utils;

/**
 * Class FeatureCollection.
 *
 * @package GeoJSON
 * @author Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 * @link https://github.com/lorenzomar/geojson
 */
class FeatureCollection extends GeoJson implements \Countable, \IteratorAggregate
{
    /**
     * @var Feature[]
     */
    protected $features;

    public function __construct(array $features, BoundingBox $bbox = null)
    {
        parent::__construct(Type::FEATURECOLLECTION(), $bbox);
        $this->features = Utils::filterValuesByClass($features, Feature::class);
    }

    /**
     * add.
     *
     * @param Feature $feature
     */
    public function add(Feature $feature)
    {
        $this->features[] = $feature;
    }

    /**
     * features.
     *
     * @return Feature[]
     */
    public function features(): array
    {
        return $this->features;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->features);
    }

    public function count(): int
    {
        return count($this->features);
    }
}