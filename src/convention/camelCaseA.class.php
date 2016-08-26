<?php

/**
 * Description of camelCaseA
 *
 * @author emeraldinspirations
 */
class camelCaseA {
  use tConvention;
  
  public function toString() {
    $pReturn    = '';
    $pFirstWord = new firstIterationIdentifier();
    
    foreach($this->_WordArray as $pWord) {
      if($pFirstWord->isFirst( TRUE )) {
        $pReturn  .= strtolower($pWord);
      } else {
        $pReturn  .=  strtoupper(substr($pWord, 0, 1))
                  .   strtolower(substr($pWord, 1));
      }
    }
    
    return $pReturn;
  }

}