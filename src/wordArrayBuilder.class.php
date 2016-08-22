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

  /**
   * Takes the buffer and pushes onto the end of the array
   * 
   * Resets the buffer after pushing
   * 
   * @return void
   */
  public function pushBuffer() {
    array_push($this->_Array, $this->_Buffer);
    $this->resetBuffer();
  }
  
  /**
   * Returns the current array
   * 
   * @return array
   */
  public function toArray() {
    return $this->_Array;
  }

}