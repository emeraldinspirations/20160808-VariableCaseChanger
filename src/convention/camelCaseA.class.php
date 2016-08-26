<?php

/**
 * Description of camelCaseA
 *
 * @author emeraldinspirations
 */
class camelCaseA implements iConvention {
 
  protected $_WordArray = [];
  
  static function fromWordArray(array $vWordArray) {
    $pReturn = new camelCaseA();
    $pReturn->_WordArray = $vWordArray;
    return $pReturn;
  }
  
  public function toString() {
    
  }

}
