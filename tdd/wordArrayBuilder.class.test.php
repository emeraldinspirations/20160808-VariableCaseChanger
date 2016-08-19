<?php

include_once '../src/wordArrayBuilder.class.php';
include_once 'classTester.class.php';

class wordArrayBuilderTester extends classTester {
  
  public function test_concatBuffer() {
    $pInstance = new wordArrayBuilder();
    
    $pBuffer = $pInstance->getBuffer();
    if($pBuffer !== '') {
      throw new Exception(
        'ISSUE:     Buffer not empty on construct'."\n" .
        'EXPECTED:  \'\''."\n" .
        'ACTUAL:    '.var_export($pBuffer, TRUE)
      );
    }
    
    $pInstance->concatenateBuffer('This');
    $pInstance->concatenateBuffer('Is');
    $pInstance->concatenateBuffer('A');
    $pInstance->concatenateBuffer('Test');
    $pBuffer = $pInstance->getBuffer();
    if($pBuffer != 'ThisIsATest') {
      throw new Exception(
        'ISSUE:     Concatination failed'."\n" .
        'EXPECTED:  \'ThisIsATest\''."\n" .
        'ACTUAL:    '.var_export($pBuffer, TRUE)
      );
    }
    
    return TRUE;
  }
  
  static function runTests() {
    self::_runTests(__class__);
  }
  
}

wordArrayBuilderTester::runTests();
