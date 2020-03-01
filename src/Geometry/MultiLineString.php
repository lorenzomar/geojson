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
use GeoJSON\Utils;
use GeoJSON\Type;

/**
 * Class MultiLineString.
 *  {
 * "type": "MultiLineString",
 * "coordinates": [
 * [
 * [100.0, 0.0],
 * [101.0, 1.0]
 * ],
 * [
 * [102.0, 2.0],
 * [103.0, 3.0]
 * ]
 * ]
 * }
 *
 * @package GeoJSON
 * @author Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 * @link https://github.com/lorenzomar/geojson
 */
class MultiLineString extends Geometry
{
    /**
     * @var Position[][]
     */
    protected $coordinates = [];

    public function __construct(array $lineStrings, BoundingBox $bbox = null)
    {
        parent::__construct(Type::MULTILINESTRING(), $bbox);

        foreach ($lineStrings as $lineString) {
            if (is_array($lineString)) {
                $coordinates = Utils::filterPositions($lineString);

                try {
                    new LineString($coordinates);

                    $this->coordinates[] = $coordinates;
                } catch (\Exception $e) {
                    continue;
                }
            } elseif ($lineString instanceof LineString) {
                $this->coordinates[] = $lineString->coordinates();
            }
        }
    }

    /**
     * coordinates.
     *
     * @return Position[][]
     */
    public function coordinates(): array
    {
        return $this->coordinates;
    }

    /**
     * lineStrings.
     *
     * @return LineString[]
     */
    public function lineStrings(): array
    {
        return array_map(function (array $coordinates) {
            return new LineString($coordinates);
        }, $this->coordinates);
    }

    /**
     * @inheritdoc.
     *
     * @param GeoJson|MultiLineString $geoJson
     */
    public function equals(GeoJson $geoJson): bool
    {
        $equals = parent::equals($geoJson);

        $equals = $equals && count($this->coordinates) === count($geoJson->coordinates);

        if (!$equals) {
            return $equals;
        }

        foreach ($this->coordinates as $k => $coordinates) {
            $equals = $equals && $this->checkPositionSetsEquality($coordinates, $geoJson->coordinates[$k]);
        }

        return $equals;
    }
}