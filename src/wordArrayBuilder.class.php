<?php

class wordArrayBuilder {
  
  protected $_Buffer  = '';
  protected $_Array   = [];

  public function concatenateBuffer($vValue) {
    $this->_Buffer .= $vValue;
  }
  
  public function getBuffer() {
    return $this->_Buffer;
  }
  
  public function resetBuffer() {
    $this->_Buffer = '';
  }
  
  public function pushBuffer() {
    
  }
  
  public function toArray() {
    
  }

}
