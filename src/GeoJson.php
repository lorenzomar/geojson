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

/**
 * Class GeoJson.
 *
 * @package GeoJSON
 * @author Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 * @link https://github.com/lorenzomar/geojson
 */
abstract class GeoJson
{
    /**
     * @var Type
     */
    protected $type;

    /**
     * @var null|BoundingBox
     */
    protected $bbox;

    public function __construct(Type $type, BoundingBox $bbox = null)
    {
        $this->type = $type;
        $this->bbox = $bbox;
    }

    /**
     * type.
     *
     * @return Type
     */
    public function type(): Type
    {
        return $this->type;
    }

    /**
     * bbox.
     *
     * @return null|BoundingBox
     */
    public function bbox(): BoundingBox
    {
        return $this->bbox;
    }

    /**
     * equals.
     *
     * @param GeoJson $geoJson
     *
     * @return bool
     */
    public function equals(GeoJson $geoJson): bool
    {
        $equals = $this->type->is($geoJson->type);

        if ($this->bbox instanceof BoundingBox && $geoJson->bbox instanceof BoundingBox) {
            $equals = $equals && $this->bbox->equals($geoJson->bbox);
        } elseif ($this->bbox === $geoJson->bbox) {
            $equals = $equals && true;
        } else {
            $equals = false;
        }

        return $equals;
    }
}