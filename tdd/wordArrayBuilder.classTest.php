<?php

include_once '../src/wordArrayBuilder.class.php';

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-08-23 at 02:02:10.
 * @ignore phpUnit Test Class
 */
class wordArrayBuilderTest extends PHPUnit_Framework_TestCase {

  /**
   * @var wordArrayBuilder
   */
  protected $object;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->object = new wordArrayBuilder;
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    
  }

  /**
   * @covers wordArrayBuilder::concatenateBuffer
   * @covers wordArrayBuilder::getBuffer
   */
  public function testConcatenateBuffer() {

    $this->assertEquals(
            '',
            $this->object->getBuffer(),
            'Buffer not empty on construct');
    
    $this->object->concatenateBuffer('This');
    $this->object->concatenateBuffer('Is');
    $this->object->concatenateBuffer('A');
    $this->object->concatenateBuffer('Test');
    
    $this->assertEquals(
            'ThisIsATest',
            $this->object->getBuffer(),
            'Concatination failed');
    
  }

  /**
   * @covers wordArrayBuilder::resetBuffer
   */
  public function testResetBuffer() {
    
    $this->object->concatenateBuffer('TestContents');
    $this->assertEquals(
            'TestContents',
            $this->object->getBuffer(),
            'Concatination failed');
    
    $this->object->resetBuffer();
    $this->assertEquals(
            '',
            $this->object->getBuffer(),
            'Buffer not empty after reset');
    
  }

  /**
   * @covers wordArrayBuilder::pushBuffer
   * @covers wordArrayBuilder::toArray
   */
  public function testPushBuffer() {

    $this->assertEquals(
            [],
            $this->object->toArray(),
            'Array not returned on toArray');
    
    $this->object->concatenateBuffer('Entry1');
    $this->object->pushBuffer();
    $this->object->concatenateBuffer('Entry2');
    $this->object->pushBuffer();
    $this->object->concatenateBuffer('Entry3');
    $this->object->pushBuffer();

    $this->assertEquals(
            ['Entry1','Entry2','Entry3'],
            $this->object->toArray(),
            'Array not populated correctly');
    
  }

}
