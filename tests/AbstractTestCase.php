<?php

/**
 * This file is part of the GeoJSON package.
 *
 * (c) Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GeoJSON\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Class AbstractTestCase.
 *
 * @package GeoJSON
 * @author Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 * @link https://github.com/lorenzomar/geojson
 */
abstract class AbstractTestCase extends TestCase
{
    protected function extractObjectProperty($obj, string $property)
    {
        $reflection = new \ReflectionClass(get_class($obj));

        if (!$reflection->hasProperty($property)) {
            throw new \InvalidArgumentException("Property $property doesn't exists in given object.");
        }

        $property = $reflection->getProperty('coordinates');

        if ($property->isPrivate() || $property->isProtected()) {
            $property->setAccessible(true);
        }

        return $property->getValue($obj);
    }
}