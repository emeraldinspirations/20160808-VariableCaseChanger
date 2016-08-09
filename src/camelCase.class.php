<?php

class_alias('variableCaseChanger', 'vcc');

class camelCase implements iVariableType {
  
  protected $_WordArray = [];
  
                                                                          |    
  /**
   * Variable Names that are in camelCase start with a lower case letter
   *  and do not have any deliminer charichtars
   */
  public static function canBeType($vVariableName) {
    
    if(vcc::strposArray(
      $vVariableName, vcc::KNOWN_DELIMITER_ARRAY
    ) === FALSE) {
      return FALSE;
    } elseif (
      vcc::getCharType(substr($vVariableName, 0, 1)) == MB_CASE_LOWER
    ) {
      return TRUE;
    }
    
    return FALSE;
  }
  
  public function __construct($vWordArray) {
    $this->$_WordArray = $vWordArray;
  }
  
  public static function fromVariableName($vVariableName) {
    
  }
  
  public static function fromWordArray(array $vWordArray) {
    
  }
  
  public function toVariableName() {
    $pReturn  = '';
    $pFirst   = TRUE;
    
    foreach($this->_WordArray as $pWord) {
      if($pFirst) {
        $pReturn  .=  strtolower($pWord);
        $pFirst   =   FALSE;
      } else {
        $pReturn  .=  strtoupper(sub_str($pWord, 0, 1));
        $pReturn  .=  strtolower(sub_str($pWord, 1));
      }
    }
    
    return $pReturn;
  }
  
  public function toWordArray() {
    return $this->_WordArray;
  }
  
}
