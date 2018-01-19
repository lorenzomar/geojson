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
 * Class Position.
 *
 * @package GeoJSON
 * @author Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 * @link https://github.com/lorenzomar/geojson
 */
final class Position
{
    /**
     * @var float
     */
    private $longitude;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var null|float
     */
    private $elevation;

    public function __construct(float $longitude, float $latitude, float $elevation = null)
    {
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->elevation = $elevation;
    }

    /**
     * longitude.
     *
     * @return float
     */
    public function longitude(): float
    {
        return $this->longitude;
    }

    /**
     * latitude.
     *
     * @return float
     */
    public function latitude(): float
    {
        return $this->latitude;
    }

    /**
     * elevation.
     *
     * @return float|null
     */
    public function elevation(): float
    {
        return $this->elevation;
    }

    /**
     * equals.
     *
     * @param Position $position
     *
     * @return bool
     */
    public function equals(Position $position): bool
    {
        return $this->longitude === $position->longitude &&
            $this->latitude === $position->latitude &&
            $this->elevation === $position->elevation;
    }
}