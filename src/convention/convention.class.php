<?php

/**
 * Description of convention
 *
 * @author emeraldinspirations
 */
abstract class convention {
 
  protected $_WordArray = [];
  
  static function fromWordArray(array $vWordArray) {
    $pReturn = new self();
    $pReturn->_WordArray = $vWordArray;
    return $pReturn;
  }
  
  abstract public function toString();
  
}
