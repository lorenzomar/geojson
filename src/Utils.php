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

use GeoJSON\Geometry\Position;

/**
 * Class Utils.
 *
 * @package GeoJSON
 * @author Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 * @link https://github.com/lorenzomar/geojson
 */
class Utils
{
    /**
     * filterValuesByClass.
     *
     * @param array $values
     * @param string $classFqn
     *
     * @return array
     */
    public static function filterValuesByClass(array $values, string $classFqn): array
    {
        return array_values(array_filter($values, function ($value) use ($classFqn) {
            return get_class($value) === $classFqn;
        }));
    }

    /**
     * filterPositions.
     *
     * @param array $positions
     *
     * @return array
     */
    public static function filterPositions(array $positions): array
    {
        return static::filterValuesByClass($positions, Position::class);
    }
}