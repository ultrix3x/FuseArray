# FuseArray
FuseArray is an implementation of an array with read-only capabilities.

## Functions
### public function Get($name)
A plain get-function. Identical to __get

### public function Set($name, $value, $fuseOut = false)
An extended set-function which alse has the ability to set the property as
read-only. If $fuseOut is set to true then the property will be read-only.

### public function FuseOut($name)
FuseOut will set the property defined by $name as read-only.

### public static function Convert($data, $fuseOut = false)
Convert is a static conservsion to FuseArray from a standard array or
another FuseArray.

### public function Import($data, $fuseOut = false)
Import is a dynamic conservsion to FuseArray from a standard array or
another FuseArray.

## Implemented functions
These functions are either basic functions in the class or functions for
the implemented interfaces.
### public function __construct()

### public function __destruct()

### public function __get($name)

### public function __set($name, $value)

### public function count()

### public function offsetExists($offset)

### public function offsetGet($offset)

### public function offsetSet($offset, $value)

### public function offsetUnset($offset)

### public function serialize()

### public function unserialize($serialized)

### public function current()

### public function key()

### public function next()

### public function prev()

### public function rewind()

### public function valid()

## Usage
Can be used more or less as a standard array in many cases. The array
functions in PHP (array_\*) will not work since the arrays produced by
FuseArray are objects and not real arrays.

# ConfigArray
ConfigArray is an extend of FuseArray which implements a simple way to
handle configurations based on ini-files.

## Functions
### public static function ConvertIni($iniData, $fuseOut = true)

ConvertIni is a static method that will take either an dual layered array
or a filename as its first argument and convert this into an config array.

```ini
[section]
property=value
```

Will be converted into
```
section.property=value
```

### public function ImportIni($iniData, $fuseOut = true)**

ImportIni is a dynamic method that will take either an dual layered array
or a filename as its first argument and convert this into an config array.

```ini
[section]
property=value
```

Will be converted into
```
section.property=value
```

##Repositories
This package can be found at the following places.

## PHPClasses.org
[http://www.phpclasses.org/fuse-array](http://www.phpclasses.org/fuse-array)

## GitHub
[https://github.com/ultrix3x/FuseArray](https://github.com/ultrix3x/FuseArray)
