<?php

/**
 * A file to store class wordArrayBuilder
 * 
 * @category    QuickTools
 * @package     20160808-VariableCaseChanger
 * @author      Matthew "Juniper" Barlett <emeraldinspirations@gmail.com>
 * @copyright   2016 Matthew "Juniper" Barlett
 * @license     MIT
 * @link        ../../LICENSE License
 */

/**
 * Builds an array via a string buffer
 * 
 * This class is used to concatenate strings, then push the result at the end of
 * the array.  Once all relevant strings are pushed, the array can be outputted.
 * 
 * <pre><code>// Example:
 * $pBuilder = new wordArrayBuilder();
 * $pBuilder->concatenateBuffer('Sample');
 * $pBuilder->concatenateBuffer('Text');
 * $pBuilder->pushBuffer();
 * $pBuilder->concatenateBuffer('Pushed');
 * $pBuilder->pushBuffer();
 * print_r($pBuilder->toArray());
 * </code></pre>
 * 
 * <pre><code>// Results:
 * Array
 * (
 *     [0] => SampleText
 *     [1] => Pushed
 * )
 * </code></pre>
 * 
 * @version    GIT: $Id$ In development.
 */
class wordArrayBuilder {
  
  // {{{ properties
  
  /**
   * A storage space for the buffer string
   * 
   * When no value has yet been concatenated, a zero-length string <code>''
   * </code> is stored.
   * 
   * @var string
   * @access protected
   * @see wordArrayBuilder::concatenateBuffer() The function to append a string
   *                                            to this property
   * @see wordArrayBuilder::getBuffer()         The function to retrieve the
   *                                            current value of this property
   * @see wordArrayBuilder::resetBuffer()       The function to clear this
   *                                            property
   * @see wordArrayBuilder::pushBuffer()        The function to append this
   *                                            property to the end of the array
   */
  protected $_Buffer  = '';
  
  /**
   * A storage space for the array
   * 
   * Each time pushBuffer is called, the value of the _Buffer property is
   * appended to the end of this property.  At initilization, this property is
   * set to an empty array <code>[]</code>.
   * 
   * @var string[]
   * @access protected
   * @see wordArrayBuilder::pushBuffer()        The function to append the
   *                                            buffer to this property
   * @see wordArrayBuilder::toArray()           The function to retrieve the
   *                                            current value of this property
   */
  protected $_Array   = [];
  
  // }}}
  // {{{ functions  
  
  /**
   * Appends the supplied string to the buffer
   * 
   * @param string $vValue
   * @return void
   * @access public
   */
  public function concatenateBuffer($vValue) {
    $this->_Buffer .= $vValue;
  }
  
  /**
   * Returns the current buffer
   * 
   * @return string
   * @access public
   */
  public function getBuffer() {
    return $this->_Buffer;
  }
  
  /**
   * Clears the current buffer
   * 
   * @return void
   * @access public
   */
  public function resetBuffer() {
    $this->_Buffer = '';
  }

  /**
   * Takes the buffer and pushes onto the end of the array
   * 
   * Resets the buffer after pushing
   * 
   * @return void
   * @access public
   */
  public function pushBuffer() {
    array_push($this->_Array, $this->_Buffer);
    $this->resetBuffer();
  }
  
  /**
   * Returns the current array
   * 
   * @return array
   * @access public
   */
  public function toArray() {
    return $this->_Array;
  }
  
  /**
   * Returns the number of pushes in the array
   * 
   * @return integer
   * @access public
   */
  public function count() {
    
    return count($this->_Array);
    
  }
  
  // }}}

}