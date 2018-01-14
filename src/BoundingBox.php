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

use GeoJSON\Exception\InvalidArgumentException;

/**
 * Class BoundingBox.
 *
 * @package GeoJSON
 * @author Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 * @link https://github.com/lorenzomar/geojson
 */
class BoundingBox
{
    /**
     * @var array
     */
    protected $bounds;

    public function __construct(array $bounds)
    {
        foreach ($bounds as $value) {
            if (!is_numeric($value) || (!is_int($value * 1) && !is_float($value * 1))) {
                throw new InvalidArgumentException('BoundingBox values must be integers or floats');
            }
        }

        if (count($bounds) < 4) {
            throw new InvalidArgumentException('BoundingBox requires at least four values');
        }

        if (count($bounds) % 2) {
            throw new InvalidArgumentException('BoundingBox requires an even number of values');
        }

        for ($i = 0; $i < (count($bounds) / 2); $i++) {
            if ($bounds[$i] > $bounds[$i + (count($bounds) / 2)]) {
                throw new InvalidArgumentException('BoundingBox min values must precede max values');
            }
        }

        $this->bounds = array_map(function ($bound) {
            return $bound * 1;
        }, $bounds);
    }

    /**
     * bounds.
     *
     * @return array
     */
    public function bounds(): array
    {
        return $this->bounds;
    }

    /**
     * equals.
     *
     * @param BoundingBox $bbox
     *
     * @return true
     */
    public function equals(BoundingBox $bbox)
    {
        return $this->bounds === $bbox->bounds;
    }
}