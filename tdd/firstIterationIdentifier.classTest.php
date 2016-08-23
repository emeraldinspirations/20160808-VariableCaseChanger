<?php

include_once '../src/firstIterationIdentifier.class.php';

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-08-23 at 05:41:01.
 * @ignore phpUnit Test Class
 */
class firstIterationIdentifierTest extends PHPUnit_Framework_TestCase {

  /**
   * @var firstIterationIdentifier
   */
  protected $object;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->object = new firstIterationIdentifier;
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    
  }
  
  /**
   * @covers firstIterationIdentifier::_construct
   */
  public function testConstruct() {
    $this->assertInstanceOf(
            'firstIterationIdentifier',
            $this->object,
            'Object creation failed');
  }

  /**
   * @covers firstIterationIdentifier::isFirst
   */
  public function testIsFirst() {
    
    for($x=0;$x<10;$x++) {
      $this->assertEquals(
              TRUE,
              $this->object->isFirst(),
              'Pre-Mature iteration');
    }
    
    $this->assertEquals(
            TRUE,
            $this->object->isFirst( TRUE ),
            'Pre-Mature isteration, when iterate set TRUE');
    
    for($x=0;$x<5;$x++) {
      
      $this->assertNotEquals(
              'A',
              $this->object->isFirst( 'A' ),
              'Future iterations override existing');
      
      $this->assertEquals(
              FALSE,
              $this->object->isFirst( 'A' ),
              'Iteration not retained');
      
    }
    
  }

  /**
   * @covers firstIterationIdentifier::getFirstValue
   * @covers firstIterationIdentifier::iterateValue
   */
  public function testGetFirstValue() {
    
    $this->assertNull(
            $this->object->getFirstValue(),
            'Pre-Mature iteration');
    
    $this->object->iterateValue('A');
    
    $this->assertEquals(
            'A',
            $this->object->getFirstValue(),
            'Iteration not retained');
    
    $this->object->iterateValue('B');
    
    $this->assertEquals(
            'A',
            $this->object->getFirstValue(),
            'Future iterations override existing');
    
  }

  /**
   * @covers firstIterationIdentifier::reset
   */
  public function testReset() {
    
    $this->object->iterateValue('A');
    $this->object->iterateValue('B');
    $this->object->reset();
    $this->object->iterateValue('C');
    $this->object->iterateValue('D');
    
    $this->assertEquals(
            'C',
            $this->object->getFirstValue(),
            'Reset Failed');
    
  }

}
