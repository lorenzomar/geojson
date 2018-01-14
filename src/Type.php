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

use MabeEnum\Enum;

/**
 * Class Type.
 *
 * @package GeoJSON
 * @author Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 * @link https://github.com/lorenzomar/geojson
 *
 * @method static static POINT()
 * @method static static MULTIPOINT
 * @method static static LINESTRING
 * @method static static MULTILINESTRING
 * @method static static POLYGON
 * @method static static MULTIPOLYGON
 * @method static static GEOMETRYCOLLECTION
 * @method static static FEATURE()
 * @method static static FEATURECOLLECTION()
 */
class Type extends Enum
{
    const POINT = 'Point';
    const MULTIPOINT = 'MultiPoint';
    const LINESTRING = 'LineString';
    const MULTILINESTRING = 'MultiLineString';
    const POLYGON = 'Polygon';
    const MULTIPOLYGON = 'MultiPolygon';
    const GEOMETRYCOLLECTION = 'GeometryCollection';
    const FEATURE = 'Feature';
    const FEATURECOLLECTION = 'FeatureCollection';
}