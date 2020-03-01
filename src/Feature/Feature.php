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
use GeoJSON\Geometry\Geometry;
use GeoJSON\Type;

/**
 * Class Feature.
 *
 * @package GeoJSON
 * @author Lorenzo Marzullo <marzullo.lorenzo@gmail.com>
 * @link https://github.com/lorenzomar/geojson
 */
class Feature extends GeoJson
{
    /**
     * @var Geometry
     */
    protected $geometry;

    /**
     * @var null|array
     */
    protected $properties;

    /**
     * @var null|string|int|float
     */
    protected $id;

    public function __construct(Geometry $geometry, array $properties = null, $id = null, BoundingBox $bbox = null)
    {
        parent::__construct(Type::FEATURE(), $bbox);

        $this->validateId($id);

        $this->geometry = $geometry;
        $this->properties = $properties;
        $this->id = $id;
    }

    /**
     * geometry.
     *
     * @return Geometry
     */
    public function geometry(): Geometry
    {
        return $this->geometry;
    }

    /**
     * id.
     *
     * @return null|string|int|float
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * setProperties.
     *
     * @param array $properties
     */
    public function setProperties(array $properties)
    {
        foreach ($properties as $key => $value) {
            $this->setProperty($key, $value);
        }
    }

    /**
     * setProperty.
     *
     * @param string $key
     * @param mixed $value
     */
    public function setProperty(string $key, $value)
    {
        $this->properties[$key] = $value;
    }

    /**
     * unsetProperty.
     *
     * @param string $key
     */
    public function unsetProperty(string $key)
    {
        if (isset($this->properties[$key])) {
            unset($this->properties[$key]);
        }

        if (empty($this->properties)) {
            $this->properties = null;
        }
    }

    /**
     * getProperty.
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function getProperty(string $key, $default = null)
    {
        return isset($this->properties[$key]) ? $this->properties[$key] : $default;
    }

    /**
     * validateId.
     *
     * @param mixed $id
     *
     * @throws \InvalidArgumentException
     */
    private function validateId($id)
    {
        if (!is_null($id) && !is_numeric($id) && !is_string($id)) {
            throw new \InvalidArgumentException("The value of id member must be either a JSON string or a number");
        }
    }
}