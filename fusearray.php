<?php
class FuseArray implements Countable, Serializable, Iterator, ArrayAccess {
  protected $data;
  
  public function __construct() {
    $this->data = array();
  }
  
  public function __destruct() {
    $this->data = null;;
  }
  
  public function __get($name) {
    if(isset($this->data[$name])) {
      return $this->data[$name][0];
    }
    return null;
  }
  
  public function __set($name, $value) {
    if(isset($this->data[$name])) {
      if($this->data[$name][1] === false) {
        $this->data[$name][0] = $value;
      } else {
        throw new Exception('Property is read-only');
      }
    } else {
      $this->data[$name] = array($value, false);
    }
  }

  public function count() {
    return count($this->data);
  }

  public function offsetExists($offset) {
    return isset($this->data[$offset]);
  }

  public function offsetGet($offset) {
    if(isset($this->data[$offset])) {
      return $this->data[$offset][0];
    }
    return null;
  }

  public function offsetSet($offset, $value) {
    if($offset === null) {
      $this->data[] = array($value, 0);
    } elseif(isset($this->data[$offset])) {
      if($this->data[$offset][1] === false) {
        $this->data[$offset][0] = $value;
      } else {
        throw new Exception('Property is read-only');
      }
    } else {
      $this->data[$offset] = array($value, false);
    }
  }

  public function offsetUnset($offset) {
    if(isset($this->data[$offset])) {
      if($this->data[$offset][1] === true) {
        throw new Exception('Property is read-only');
      } else {
        unset($this->data[$offset]);
      }
    }
  }

  public function serialize() {
    return serialize($this->data);
  }

  public function unserialize($serialized) {
    $this->data = unserialize($serialized);
    if(!is_array($this->data)) {
      $this->data = array();
    }
  }

  public function current() {
    $data = current($this->data);
    if(is_array($data)) {
      return $data[0];
    }
    return $data;
  }

  public function key() {
    return key($this->data);
  }

  public function next() {
    $data = next($this->data);
    if(is_array($data)) {
      return $data[0];
    }
    return $data;
  }

  public function prev() {
    $data = prev($this->data);
    if(is_array($data)) {
      return $data[0];
    }
    return $data;
  }

  public function rewind() {
    $data = reset($this->data);
    if(is_array($data)) {
      return $data[0];
    }
    return $data;
  }

  public function valid() {
    return (key($this->data) !== null);
  }


  
  public function Get($name) {
    return $this->__get($name);
  }

  public function Set($name, $value, $fuseOut = false) {
    if(isset($this->data[$name])) {
      if($this->data[$name][1] === false) {
        $this->data[$name][0] = $value;
        $this->data[$name][1] = $fuseOut;
      } else {
        throw new \Exception('Property is read-only');
      }
    } else {
      $this->data[$name] = array($value, $fuseOut);
    }
  }
  
  public function FuseOut($name) {
    if(isset($this->data[$name]) && ($this->data[$name][1] === false)) {
      $this->data[$name][1] = true;
      return true;
    }
    return false;
  }
  
  public static function Convert($data, $fuseOut = false) {
    $class = get_called_class();
    $array = new $class();
    if(is_array($data) || ($data instanceof FuseArray)) {
      foreach($data as $key => $value) {
        if(is_array($value)) {
          $valueObj = new $class();
          $valueObj->Import($value);
          $array->Set($key, $valueObj, $fuseOut);
        } elseif($value instanceof FuseArray) {
          $valueClass = get_class($value);
          $valueObj = new $valueClass();
          $valueObj->Import($value);
          $array->Set($key, $valueObj, $fuseOut);
        } else {
          $array->Set($key, $value, $fuseOut);
        }
      }
    }
    return $array;
  }
  
  public function Import($data, $fuseOut = false) {
    if(is_array($data) || ($data instanceof FuseArray)) {
      foreach($data as $key => $value) {
        if(is_array($value)) {
          $valueObj = new $class();
          $valueObj->Import($value);
          $this->Set($key, $valueObj, $fuseOut);
        } elseif($value instanceof FuseArray) {
          $valueClass = get_class($value);
          $valueObj = new $valueClass();
          $valueObj->Import($value);
          $this->Set($key, $valueObj, $fuseOut);
        } else {
          $this->Set($key, $value, $fuseOut);
        }
      }
    }
    return $this;
  }

}
