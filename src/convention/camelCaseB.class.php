<?php

/**
 * Description of camelCaseA
 *
 * @author emeraldinspirations
 */
class camelCaseB {
  use tConvention;
  
  public function toString() {
    $pReturn    = '';
    
    foreach($this->_WordArray as $pWord) {
      $pReturn  .=  strtoupper(substr($pWord, 0, 1))
                .   strtolower(substr($pWord, 1));
    }
    
    return $pReturn;
  }

}