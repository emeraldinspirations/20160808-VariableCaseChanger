<?php

include_once '../src/firstIterationIdentifier.class.php';
include_once 'classTester.class.php';

class firstIterationIdentifierTester extends classTester {
  
  function test_construct() {
    
    $pSample = new firstIterationIdentifier();
    
    self::typeTest('Object creation failed', 'firstIterationIdentifier', $pSample);
    
    return TRUE;
  }
  
  function test_isFirst() {
    $pInstance = new firstIterationIdentifier();
    
    for($x=0;$x<10;$x++) {
      $pTestValue = $pInstance->isFirst();
      if( $pTestValue !== TRUE ) {
        throw new Exception (
          'ISSUE:    Pre-Mature iteration'."\n".
          'EXPECTED: TRUE'."\n".
          'ACTUAL:   '.var_export($pTestValue, true)
        );
      }
    }
    
    $pTestValue = $pInstance->isFirst( TRUE );
    if( $pTestValue !== TRUE ) {
      throw new Exception (
        'ISSUE:    Pre-Mature isteration, when iterate set TRUE'."\n".
        'EXPECTED: TRUE'."\n".
        'ACTUAL:   '.var_export($pTestValue, true)
      );
    }
    
    for($x=0;$x<10;$x++) {
      $pTestValue = $pInstance->isFirst( 'A' );
      if( $pTestValue === TRUE ) {
        throw new Exception (
          'ISSUE:    Iteration not retained'."\n".
          'EXPECTED: FALSE'."\n".
          'ACTUAL:   '.var_export($pTestValue, true)
        );
      } elseif ( $pTestValue !== FALSE ) {
        throw new Exception (
          'ISSUE:    Future iterations override existing'."\n".
          'EXPECTED: FALSE'."\n".
          'ACTUAL:   '.var_export($pTestValue, true)
        );
      }
    }
    
    return TRUE;
  }
  
  public function test_getFirstValue() {
    $pInstance = new firstIterationIdentifier();
    
    $pTestValue = $pInstance->getFirstValue();
    if( ! is_null($pTestValue) ) {
      throw new Exception (
        'ISSUE:    Pre-Mature iteration'."\n".
        'EXPECTED: NULL'."\n".
        'ACTUAL:   '.var_export($pTestValue, true)
      );
    }
    
    $pInstance->iterateValue('A');
    $pTestValue = $pInstance->getFirstValue();
    if( $pTestValue != 'A' ) {
      throw new Exception (
        'ISSUE:    Iteration not retained'."\n".
        'EXPECTED: A'."\n".
        'ACTUAL:   '.var_export($pTestValue, true)
      );
    }
    
    $pInstance->iterateValue('B');
    $pTestValue = $pInstance->getFirstValue();
    if( $pTestValue != 'A' ) {
      throw new Exception (
        'ISSUE:    Future iterations override existing'."\n".
        'EXPECTED: A'."\n".
        'ACTUAL:   '.var_export($pTestValue, true)
      );
    }
    
    return TRUE;
  }
  
  public function test_reset() {
    $pInstance = new firstIterationIdentifier();
    
    $pInstance->iterateValue('A');
    $pInstance->iterateValue('B');
    $pInstance->reset();
    $pInstance->iterateValue('C');
    $pInstance->iterateValue('D');
    $pTestValue = $pInstance->getFirstValue();
    if( $pTestValue != 'C' ) {
      throw new Exception (
        'ISSUE:    Reset Failed'."\n".
        'EXPECTED: C'."\n".
        'ACTUAL:   '.var_export($pTestValue, true)
      );
    }
    
    return TRUE;
  }
  
  static function runTests() {
    self::_runTests(__class__);
  }
  
}

firstIterationIdentifierTester::runTests();
