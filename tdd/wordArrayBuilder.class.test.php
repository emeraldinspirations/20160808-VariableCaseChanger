<?php

include_once '../src/wordArrayBuilder.class.php';
include_once 'classTester.class.php';

class wordArrayBuilderTester extends classTester {
  
  static function test_Tester() {
    return TRUE;
  }
  
  static function runTests() {
    self::_runTests(__class__);
  }
  
}

wordArrayBuilderTester::runTests();
