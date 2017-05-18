<?php
namespace Routey;

use Exception;

abstract class BaseObject
{
    /**
     * Default getter for properties
     *
     * Checks if a getter method exists and if so calls the getter. If not, checks if the property exists and if so
     * returns the property.
     *
     * @param $property
     * @return mixed
     * @throws Exception
     */
    public function __get($property)
    {
        //check if there is a defined getter method for the function and call that if it is there
        $getterMethod = "get" . ucfirst($property);

        if (method_exists($this, $getterMethod))
            return $this->$getterMethod();
        else if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new Exception("Undefined property $property. Unable to get $property");
        }
    }

    /**
     * Default setter for properties
     *
     * Checks if a setter for that method exists and if it does, sets that property. If not, throws an exception
     * @param $property
     * @param $value
     * @throws Exception
     */
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            throw new Exception("Undefined property $property. Unable to set $property");
        }

    }

}
