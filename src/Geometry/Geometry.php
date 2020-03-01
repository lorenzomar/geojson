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

use GeoJSON\GeoJson;

/**
 * Class Geometry.
 *
 * @package GeoJSON
 * @author Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 * @link https://github.com/lorenzomar/geojson
 */
abstract class Geometry extends GeoJson
{
    /**
     * checkPositionSetsEquality.
     *
     * @param Position[] $set1
     * @param Position[] $set2
     *
     * @return bool
     */
    protected function checkPositionSetsEquality($set1, $set2): bool
    {
        if (!is_array($set1) || !is_array($set2)) {
            return false;
        }

        /** @var Position[] $set1 */
        $set1 = array_values($set1);

        /** @var Position[] $set2 */
        $set2 = array_values($set2);

        if (count($set1) !== count($set2)) {
            return false;
        }

        foreach ($set1 as $k => $position) {
            if (!$position->equals($set2[$k])) {
                return false;
            }
        }

        return true;
    }
}