<?php

include_once '../src/convention/tConvention.trait.php';
include_once '../src/convention/camelCaseA.class.php';
include_once '../src/firstIterationIdentifier.class.php';

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-08-26 at 02:03:47.
 */
class camelCaseATest extends PHPUnit_Framework_TestCase {

  /**
   * @var camelCaseA
   */
  protected $object;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    //$this->object = new camelCaseA;
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    
  }
  
  protected $_WordArray = ['This', 'is', 'a', 'word', 'array'];
  
  public function testConstruct() {
    $this->object = camelCaseA::fromWordArray([]);
    $this->assertInstanceOf(
            'camelCaseA',
            $this->object,
            'construct Failed');
  }
  
  /**
   * @covers camelCaseA::toString
   * @covers camelCaseA::fromWordArray($vWordArray)
   */
  public function testToString() {
    
    $this->object = camelCaseA::fromWordArray($this->_WordArray);
    
    $this->assertEquals(
            'thisIsAWordArray',
            $this->object->toString(),
            'Convention Conversion Failed');
    
  }

}
