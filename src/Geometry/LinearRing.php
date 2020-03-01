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

/**
 * Class LinearRing.
 *  {
        "type": "LineString",
        "coordinates": [
            [100.0, 0.0],
            [101.0, 1.0],
            [101.0, 1.0],
            [101.0, 0.0]
        ]
    }
 *
 * @package GeoJSON
 * @author Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 * @link https://github.com/lorenzomar/geojson
 */
class LinearRing extends LineString
{
    /**
     * validateCoordinates.
     *
     * @param Position[] $coordinates
     *
     * @throws \InvalidArgumentException
     */
    protected function validateCoordinates(array $coordinates)
    {
        if (count($coordinates) < 4) {
            throw new \InvalidArgumentException("LinearRing requires at least 4 positions");
        }

        $last = end($coordinates);
        $first = reset($coordinates);

        if (!$first->equals($last)) {
            throw new \InvalidArgumentException("LinearRing requires that first and last positions are equivalent");
        }
    }
}