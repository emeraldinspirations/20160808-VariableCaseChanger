<?php

class {
  
  protected $_FirstValue  = NULL;
  
  public function isFirst() {
    return isnull($this->$_FirstValue);
  }
  
  public function getFirstValue() {
    return $_FirstValue;
  }
  
  public function iterateValue($vValue = TRUE) {
    if($this->isFirst()) {
      $this->_FirstValue = $vValue;
      return $vValue;
    }
    return FALSE;
  }

}
